<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Practice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('FSLModel');
        $this->load->model('PracticeModel');
        $this->load->model('LessonModel');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');

        if (!$this->session->userdata('user_id')) {
            redirect('Login');
        }
    }

    /**
     * Practice Mode Selection
     */
    public function index()
    {
        $data['title'] = 'Practice Mode';
        $data['categories'] = $this->FSLModel->get_all_categories();
        $data['lessons'] = $this->LessonModel->get_all_lessons(array('is_published' => 1), 10);

        $this->load->view('includes/head');
        $this->load->view('practice/index', $data);
        $this->load->view('includes/footer');
    }

    /**
     * Start Practice by Category
     */
    public function category($category_id)
    {
        $user_id = $this->session->userdata('user_id');
        
        // Create practice session
        $session_id = $this->PracticeModel->create_session(array(
            'user_id' => $user_id,
            'session_type' => 'practice',
            'category_id' => $category_id
        ));

        // Get signs for practice
        $signs = $this->FSLModel->get_signs_by_category($category_id);

        if (empty($signs)) {
            $this->session->set_flashdata('error', 'No signs available in this category');
            redirect('Practice');
        }

        $data['title'] = 'Practice - Category';
        $data['session_id'] = $session_id;
        $data['category'] = $this->FSLModel->get_category_by_id($category_id);
        $data['signs'] = $signs;
        $data['total_signs'] = count($signs);

        $this->load->view('includes/head');
        $this->load->view('practice/session', $data);
        $this->load->view('includes/footer');
    }

    /**
     * Start Practice by Lesson
     */
    public function lesson($lesson_id)
    {
        $user_id = $this->session->userdata('user_id');
        
        // Create practice session
        $session_id = $this->PracticeModel->create_session(array(
            'user_id' => $user_id,
            'session_type' => 'lesson',
            'lesson_id' => $lesson_id
        ));

        // Get signs for lesson
        $signs = $this->LessonModel->get_lesson_signs($lesson_id);

        if (empty($signs)) {
            $this->session->set_flashdata('error', 'No signs available in this lesson');
            redirect('FSL/lessons');
        }

        $data['title'] = 'Practice - Lesson';
        $data['session_id'] = $session_id;
        $data['lesson'] = $this->LessonModel->get_lesson_by_id($lesson_id);
        $data['signs'] = $signs;
        $data['total_signs'] = count($signs);

        $this->load->view('includes/head');
        $this->load->view('practice/session', $data);
        $this->load->view('includes/footer');
    }

    /**
     * Free Practice Mode
     */
    public function free_practice()
    {
        $user_id = $this->session->userdata('user_id');
        
        // Get signs the user should practice
        $signs = $this->PracticeModel->get_recommended_signs($user_id, 10);

        if (empty($signs)) {
            // Get random beginner signs if no recommendations
            $signs = $this->FSLModel->get_signs_by_type('alphabet', 10);
        }

        // Create practice session
        $session_id = $this->PracticeModel->create_session(array(
            'user_id' => $user_id,
            'session_type' => 'practice'
        ));

        $data['title'] = 'Free Practice';
        $data['session_id'] = $session_id;
        $data['signs'] = $signs;
        $data['total_signs'] = count($signs);
        $data['is_free_practice'] = true;

        $this->load->view('includes/head');
        $this->load->view('practice/session', $data);
        $this->load->view('includes/footer');
    }

    /**
     * Process recognition result via AJAX
     */
    public function process_recognition()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $user_id = $this->session->userdata('user_id');
        $session_id = $this->input->post('session_id');
        $sign_id = $this->input->post('sign_id');
        $recognized_label = $this->input->post('recognized_label');
        $confidence = $this->input->post('confidence');

        // Get the expected sign
        $expected_sign = $this->FSLModel->get_sign_by_id($sign_id);
        
        if (!$expected_sign) {
            echo json_encode(array('success' => false, 'message' => 'Sign not found'));
            return;
        }

        // Check if recognition is correct
        $is_correct = (strtoupper($recognized_label) == strtoupper($expected_sign->model_label));

        // Record the attempt
        $attempt_data = array(
            'session_id' => $session_id,
            'user_id' => $user_id,
            'sign_id' => $sign_id,
            'recognized_sign' => $recognized_label,
            'is_correct' => $is_correct ? 1 : 0,
            'confidence_score' => $confidence
        );

        $this->PracticeModel->record_attempt($attempt_data);

        // Check for achievements
        $new_achievements = $this->PracticeModel->check_achievements($user_id);

        echo json_encode(array(
            'success' => true,
            'is_correct' => $is_correct,
            'expected' => $expected_sign->sign_name,
            'recognized' => $recognized_label,
            'achievements' => $new_achievements
        ));
    }

    /**
     * Complete practice session
     */
    public function complete_session()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $session_id = $this->input->post('session_id');
        $total_attempts = $this->input->post('total_attempts');
        $correct_attempts = $this->input->post('correct_attempts');
        $duration_seconds = $this->input->post('duration_seconds');

        $score = $total_attempts > 0 ? ($correct_attempts / $total_attempts) * 100 : 0;

        $stats = array(
            'total_attempts' => $total_attempts,
            'correct_attempts' => $correct_attempts,
            'score' => round($score, 2),
            'duration_seconds' => $duration_seconds
        );

        $this->PracticeModel->complete_session($session_id, $stats);

        echo json_encode(array(
            'success' => true,
            'score' => $stats['score'],
            'correct' => $correct_attempts,
            'total' => $total_attempts
        ));
    }

    /**
     * Show session results
     */
    public function results($session_id)
    {
        $data['title'] = 'Practice Results';
        $data['session'] = $this->PracticeModel->get_session($session_id);
        $data['attempts'] = $this->PracticeModel->get_session_attempts($session_id);

        if (!$data['session']) {
            show_404();
        }

        $this->load->view('includes/head');
        $this->load->view('practice/results', $data);
        $this->load->view('includes/footer');
    }

    /**
     * Practice History
     */
    public function history()
    {
        $user_id = $this->session->userdata('user_id');
        
        $data['title'] = 'Practice History';
        $data['sessions'] = $this->PracticeModel->get_user_sessions($user_id);

        $this->load->view('includes/head');
        $this->load->view('practice/history', $data);
        $this->load->view('includes/footer');
    }

    /**
     * AI Recognition endpoint - Proxy to Python service
     */
    public function recognize()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $image_data = $this->input->post('image');
        
        if (!$image_data) {
            echo json_encode(array('success' => false, 'message' => 'No image data received'));
            return;
        }

        // Send to Python AI service
        $ai_service_url = 'http://localhost:5000/predict';
        
        $ch = curl_init($ai_service_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('image' => $image_data)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code == 200 && $response) {
            echo $response;
        } else {
            echo json_encode(array(
                'success' => false, 
                'message' => 'AI service unavailable',
                'prediction' => null,
                'confidence' => 0
            ));
        }
    }

    /**
     * Test camera view
     */
    public function test_camera()
    {
        $data['title'] = 'Camera Test';
        
        $this->load->view('includes/head');
        $this->load->view('practice/test_camera', $data);
        $this->load->view('includes/footer');
    }
}
