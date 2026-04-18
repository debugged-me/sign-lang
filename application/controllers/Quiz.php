<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quiz extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('QuizModel');
        $this->load->model('PracticeModel');
        $this->load->model('FSLModel');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');

        if (!$this->session->userdata('user_id')) {
            redirect('Login');
        }
    }

    /**
     * Quiz Selection Page
     */
    public function index()
    {
        $data['title'] = 'Quiz Mode';
        $data['categories'] = $this->FSLModel->get_all_categories();
        
        $user_id = $this->session->userdata('user_id');
        $data['quiz_history'] = $this->QuizModel->get_user_quiz_history($user_id, 5);

        $this->load->view('index', $data);
    }

    /**
     * Start Quiz
     */
    public function start()
    {
        $user_id = $this->session->userdata('user_id');
        
        $difficulty = $this->input->get('difficulty') ? $this->input->get('difficulty') : 'easy';
        $category_id = $this->input->get('category') ? $this->input->get('category') : null;
        $question_count = $this->input->get('count') ? intval($this->input->get('count')) : 5;

        // Get questions
        if ($category_id) {
            $questions = $this->QuizModel->get_quiz_by_category($category_id, $question_count);
        } else {
            $questions = $this->QuizModel->get_questions($difficulty, $question_count);
        }

        if (empty($questions)) {
            $this->session->set_flashdata('error', 'No questions available for this category/difficulty');
            redirect('Quiz');
        }

        // Create session
        $session_id = $this->PracticeModel->create_session(array(
            'user_id' => $user_id,
            'session_type' => 'quiz'
        ));

        // Store quiz data in session
        $quiz_data = array(
            'quiz_session_id' => $session_id,
            'quiz_questions' => $questions,
            'current_question' => 0,
            'answers' => array(),
            'start_time' => time()
        );
        $this->session->set_userdata('quiz_data', $quiz_data);

        redirect('Quiz/question/0');
    }

    /**
     * Show Question
     */
    public function question($question_index)
    {
        $quiz_data = $this->session->userdata('quiz_data');
        
        if (!$quiz_data || !isset($quiz_data['quiz_questions'][$question_index])) {
            redirect('Quiz');
        }

        $data['title'] = 'Quiz Question ' . ($question_index + 1);
        $data['question'] = $quiz_data['quiz_questions'][$question_index];
        $data['question_index'] = $question_index;
        $data['total_questions'] = count($quiz_data['quiz_questions']);
        $data['is_last'] = ($question_index == count($quiz_data['quiz_questions']) - 1);

        // Generate multiple choice options
        if ($data['question']->question_type == 'multiple_choice' && !empty($data['question']->options)) {
            $data['options'] = json_decode($data['question']->options);
        } else {
            // Generate options from other signs
            $wrong_answers = $this->QuizModel->get_random_signs($data['question']->sign_id, 3);
            $options = array($data['question']->correct_answer);
            foreach ($wrong_answers as $wa) {
                $options[] = $wa->sign_name;
            }
            shuffle($options);
            $data['options'] = $options;
        }

        $this->load->view('question', $data);
    }

    /**
     * Submit Answer (AJAX)
     */
    public function submit_answer()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $user_id = $this->session->userdata('user_id');
        $quiz_data = $this->session->userdata('quiz_data');
        
        $question_index = $this->input->post('question_index');
        $answer = $this->input->post('answer');

        if (!$quiz_data || !isset($quiz_data['quiz_questions'][$question_index])) {
            echo json_encode(array('success' => false, 'message' => 'Invalid question'));
            return;
        }

        $question = $quiz_data['quiz_questions'][$question_index];
        $is_correct = (strtoupper($answer) == strtoupper($question->correct_answer));

        // Record attempt
        $attempt_data = array(
            'session_id' => $quiz_data['quiz_session_id'],
            'user_id' => $user_id,
            'sign_id' => $question->sign_id,
            'attempted_sign' => $answer,
            'recognized_sign' => $answer,
            'is_correct' => $is_correct ? 1 : 0
        );

        $this->PracticeModel->record_attempt($attempt_data);

        // Store answer
        $quiz_data['answers'][$question_index] = array(
            'question_id' => $question->question_id,
            'answer' => $answer,
            'is_correct' => $is_correct,
            'correct_answer' => $question->correct_answer
        );
        $quiz_data['current_question'] = $question_index + 1;
        $this->session->set_userdata('quiz_data', $quiz_data);

        echo json_encode(array(
            'success' => true,
            'is_correct' => $is_correct,
            'correct_answer' => $question->correct_answer,
            'next_question' => $question_index + 1
        ));
    }

    /**
     * Submit Recognition Answer (for sign-to-text questions)
     */
    public function submit_recognition()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $user_id = $this->session->userdata('user_id');
        $quiz_data = $this->session->userdata('quiz_data');
        
        $question_index = $this->input->post('question_index');
        $recognized_label = $this->input->post('recognized_label');
        $confidence = $this->input->post('confidence');

        if (!$quiz_data || !isset($quiz_data['quiz_questions'][$question_index])) {
            echo json_encode(array('success' => false, 'message' => 'Invalid question'));
            return;
        }

        $question = $quiz_data['quiz_questions'][$question_index];
        
        // Check if recognition matches the expected sign's model label
        $this->load->model('FSLModel');
        $expected_sign = $this->FSLModel->get_sign_by_id($question->sign_id);
        $is_correct = $expected_sign && (strtoupper($recognized_label) == strtoupper($expected_sign->model_label));

        // Record attempt
        $attempt_data = array(
            'session_id' => $quiz_data['quiz_session_id'],
            'user_id' => $user_id,
            'sign_id' => $question->sign_id,
            'attempted_sign' => $recognized_label,
            'recognized_sign' => $recognized_label,
            'is_correct' => $is_correct ? 1 : 0,
            'confidence_score' => $confidence
        );

        $this->PracticeModel->record_attempt($attempt_data);

        // Store answer
        $quiz_data['answers'][$question_index] = array(
            'question_id' => $question->question_id,
            'answer' => $recognized_label,
            'is_correct' => $is_correct,
            'correct_answer' => $question->correct_answer
        );
        $quiz_data['current_question'] = $question_index + 1;
        $this->session->set_userdata('quiz_data', $quiz_data);

        echo json_encode(array(
            'success' => true,
            'is_correct' => $is_correct,
            'correct_answer' => $question->correct_answer,
            'expected_label' => $expected_sign ? $expected_sign->model_label : null,
            'next_question' => $question_index + 1
        ));
    }

    /**
     * Complete Quiz
     */
    public function complete()
    {
        $user_id = $this->session->userdata('user_id');
        $quiz_data = $this->session->userdata('quiz_data');

        if (!$quiz_data) {
            redirect('Quiz');
        }

        // Calculate results
        $total = count($quiz_data['answers']);
        $correct = 0;
        foreach ($quiz_data['answers'] as $answer) {
            if ($answer['is_correct']) {
                $correct++;
            }
        }

        $duration = time() - $quiz_data['start_time'];
        $score = $total > 0 ? ($correct / $total) * 100 : 0;

        // Complete session
        $stats = array(
            'total_attempts' => $total,
            'correct_attempts' => $correct,
            'score' => round($score, 2),
            'duration_seconds' => $duration
        );

        $this->PracticeModel->complete_session($quiz_data['quiz_session_id'], $stats);

        // Check achievements
        $new_achievements = $this->PracticeModel->check_achievements($user_id);

        // Clear quiz data
        $this->session->unset_userdata('quiz_data');

        // Redirect to results
        redirect('Quiz/results/' . $quiz_data['quiz_session_id']);
    }

    /**
     * Quiz Results
     */
    public function results($session_id)
    {
        $data['title'] = 'Quiz Results';
        $data['session'] = $this->PracticeModel->get_session($session_id);
        $data['attempts'] = $this->PracticeModel->get_session_attempts($session_id);
        $data['score_data'] = $this->QuizModel->calculate_score($session_id);

        if (!$data['session']) {
            show_404();
        }

        $this->load->view('results', $data);
    }

    /**
     * Quiz History
     */
    public function history()
    {
        $user_id = $this->session->userdata('user_id');
        
        $data['title'] = 'Quiz History';
        $data['quiz_history'] = $this->QuizModel->get_user_quiz_history($user_id);

        $this->load->view('quiz_history', $data);
    }
}
