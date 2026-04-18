<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
    }

    /**
     * Login Page
     */
    public function index()
    {
        // If already logged in, redirect to FSL dashboard
        if ($this->session->userdata('user_id')) {
            redirect('FSL');
        }

        $data['title'] = 'Login';
        $data['settings'] = $this->db->get('site_settings')->row();
        $this->load->view('home_page', $data);
    }

    /**
     * Process Login
     */
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (empty($username) || empty($password)) {
            $this->session->set_flashdata('error', 'Please enter username and password');
            redirect('Login');
        }

        // Check user credentials
        $this->db->where('username', $username);
        $this->db->where('is_active', 1);
        $user = $this->db->get('users')->row();

        if ($user && sha1($password) === $user->password_hash) {
            // Set session data
            $session_data = array(
                'user_id' => $user->user_id,
                'username' => $user->username,
                'email' => $user->email,
                'fname' => $user->first_name,
                'lname' => $user->last_name,
                'avatar' => $user->avatar,
                'user_type' => $user->user_type,
                'logged_in' => TRUE
            );

            $this->session->set_userdata($session_data);

            // Update last login
            $this->db->where('user_id', $user->user_id);
            $this->db->update('users', array('last_login' => date('Y-m-d H:i:s')));

            redirect('FSL');
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('Login');
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Login');
    }

    /**
     * Registration Page
     */
    public function register()
    {
        $data['title'] = 'Register';
        $this->load->view('register', $data);
    }

    /**
     * Process Registration
     */
    public function do_register()
    {
        $data = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password_hash' => sha1($this->input->post('password')),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'user_type' => 'learner',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s')
        );

        // Check if username exists
        $this->db->where('username', $data['username']);
        if ($this->db->count_all_results('users') > 0) {
            $this->session->set_flashdata('error', 'Username already exists');
            redirect('Login/register');
        }

        // Check if email exists
        $this->db->where('email', $data['email']);
        if ($this->db->count_all_results('users') > 0) {
            $this->session->set_flashdata('error', 'Email already exists');
            redirect('Login/register');
        }

        if ($this->db->insert('users', $data)) {
            $this->session->set_flashdata('success', 'Registration successful. Please login.');
            redirect('Login');
        } else {
            $this->session->set_flashdata('error', 'Registration failed. Please try again.');
            redirect('Login/register');
        }
    }

    /**
     * Demo Login - Quick access for testing
     */
    public function demo()
    {
        // Create demo session without login
        $session_data = array(
            'user_id' => 1,
            'username' => 'demo',
            'email' => 'demo@signlearn.com',
            'fname' => 'Demo',
            'lname' => 'User',
            'avatar' => 'default.jpg',
            'user_type' => 'learner',
            'logged_in' => TRUE
        );

        $this->session->set_userdata($session_data);
        redirect('FSL');
    }
}
