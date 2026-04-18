<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FSL extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('FSLModel');
        $this->load->model('LessonModel');
        $this->load->model('PracticeModel');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');

        // Check if user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('Login');
        }
    }

    /**
     * Main Dashboard
     */
    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        
        $data['title'] = 'FSL Learning Dashboard';
        $data['stats'] = $this->PracticeModel->get_user_statistics($user_id);
        $data['featured_signs'] = $this->FSLModel->get_featured_signs(6);
        $data['recent_lessons'] = $this->LessonModel->get_all_lessons(array('is_published' => 1), 4);
        $data['categories'] = $this->FSLModel->get_all_categories();
        
        // Add progress info to lessons
        foreach ($data['recent_lessons'] as &$lesson) {
            $lesson->progress = $this->LessonModel->get_user_lesson_progress($user_id, $lesson->lesson_id);
        }

        $this->load->view('dashboard', $data);
    }

    /**
     * FSL Dictionary
     */
    public function dictionary()
    {
        $filters = array();
        
        if ($this->input->get('category')) {
            $filters['category_id'] = $this->input->get('category');
        }
        
        if ($this->input->get('type')) {
            $filters['sign_type'] = $this->input->get('type');
        }
        
        if ($this->input->get('search')) {
            $filters['search'] = $this->input->get('search');
        }

        $data['title'] = 'FSL Dictionary';
        $data['signs'] = $this->FSLModel->get_all_signs($filters);
        $data['categories'] = $this->FSLModel->get_all_categories();
        $data['stats'] = $this->FSLModel->get_signs_statistics();
        $data['filters'] = $filters;

        $this->load->view('dictionary', $data);
    }

    /**
     * Sign Detail View
     */
    public function sign_detail($sign_id)
    {
        $user_id = $this->session->userdata('user_id');
        
        $data['title'] = 'Sign Detail';
        $data['sign'] = $this->FSLModel->get_sign_by_id($sign_id);
        
        if (!$data['sign']) {
            show_404();
        }

        $data['user_progress'] = $this->PracticeModel->get_user_sign_progress($user_id, $sign_id);
        $data['related_signs'] = $this->FSLModel->get_signs_by_category($data['sign']->category_id);

        $this->load->view('sign_detail', $data);
    }

    /**
     * Lessons List
     */
    public function lessons()
    {
        $user_id = $this->session->userdata('user_id');
        
        $filters = array('is_published' => 1);
        
        if ($this->input->get('difficulty')) {
            $filters['difficulty_level'] = $this->input->get('difficulty');
        }

        $data['title'] = 'FSL Lessons';
        $data['lessons'] = $this->LessonModel->get_all_lessons($filters);
        $data['categories'] = $this->FSLModel->get_all_categories();
        
        // Add progress to each lesson
        foreach ($data['lessons'] as &$lesson) {
            $lesson->user_progress = $this->LessonModel->get_user_lesson_progress($user_id, $lesson->lesson_id);
        }

        $this->load->view('lessons', $data);
    }

    /**
     * Lesson Detail
     */
    public function lesson($lesson_id)
    {
        $user_id = $this->session->userdata('user_id');
        
        $data['title'] = 'Lesson';
        $data['lesson'] = $this->LessonModel->get_lesson_by_id($lesson_id);
        
        if (!$data['lesson']) {
            show_404();
        }

        $data['user_progress'] = $this->LessonModel->get_user_lesson_progress($user_id, $lesson_id);
        $data['next_lesson'] = $this->LessonModel->get_next_lesson($user_id, $lesson_id);

        $this->load->view('lesson_detail', $data);
    }

    /**
     * Categories
     */
    public function categories()
    {
        $data['title'] = 'Categories';
        $data['categories'] = $this->FSLModel->get_all_categories();
        
        // Get sign counts for each category
        foreach ($data['categories'] as &$category) {
            $category->sign_count = $this->FSLModel->count_signs(array('category_id' => $category->category_id));
        }

        $this->load->view('categories', $data);
    }

    /**
     * Category Detail
     */
    public function category($category_id)
    {
        $data['title'] = 'Category';
        $data['category'] = $this->FSLModel->get_category_by_id($category_id);
        
        if (!$data['category']) {
            show_404();
        }

        $data['signs'] = $this->FSLModel->get_signs_by_category($category_id);

        $this->load->view('category_detail', $data);
    }

    /**
     * User Progress Page
     */
    public function progress()
    {
        $user_id = $this->session->userdata('user_id');
        
        $data['title'] = 'My Progress';
        $data['stats'] = $this->PracticeModel->get_user_statistics($user_id);
        $data['all_progress'] = $this->PracticeModel->get_all_user_progress($user_id);
        $data['achievements'] = $this->PracticeModel->get_user_achievements($user_id);

        $this->load->view('progress', $data);
    }

    /**
     * API: Search signs
     */
    public function search()
    {
        $query = $this->input->get('q');
        $results = $this->FSLModel->search_signs($query, 10);
        
        echo json_encode(array('success' => true, 'results' => $results));
    }

    /**
     * API: Get sign info
     */
    public function api_get_sign($sign_id)
    {
        $sign = $this->FSLModel->get_sign_by_id($sign_id);
        
        if ($sign) {
            echo json_encode(array('success' => true, 'sign' => $sign));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Sign not found'));
        }
    }

    /**
     * Alphabet Learning Page
     */
    public function alphabet()
    {
        $data['title'] = 'Learn the FSL Alphabet';
        $data['letters'] = $this->FSLModel->get_signs_by_type('alphabet');

        $this->load->view('alphabet', $data);
    }

    /**
     * Numbers Learning Page
     */
    public function numbers()
    {
        $data['title'] = 'Learn FSL Numbers';
        $data['numbers'] = $this->FSLModel->get_signs_by_type('number');

        $this->load->view('numbers', $data);
    }
}
