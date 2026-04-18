<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'FSL';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['Page/saveAdminFromSuperAdmin'] = 'Page/saveAdminFromSuperAdmin';
$route['Page/saveSuperAdmin'] = 'Page/saveSuperAdmin';
$route['Page/addNewSuperAdmin'] = 'Page/addNewSuperAdmin';

// ==========================================
// Login & Authentication Routes
// ==========================================
$route['Login'] = 'Login';
$route['Login/index'] = 'Login/index';
$route['Login/login'] = 'Login/login';
$route['Login/logout'] = 'Login/logout';
$route['Login/register'] = 'Login/register';
$route['Login/do_register'] = 'Login/do_register';
$route['Login/demo'] = 'Login/demo';

// ==========================================
// FSL Learning System Routes
// ==========================================

// Dashboard & Main Pages
$route['FSL'] = 'FSL';
$route['FSL/index'] = 'FSL/index';
$route['FSL/dashboard'] = 'FSL/index';

// Dictionary
$route['FSL/dictionary'] = 'FSL/dictionary';
$route['FSL/sign/(:num)'] = 'FSL/sign_detail/$1';
$route['FSL/sign_detail/(:num)'] = 'FSL/sign_detail/$1';
$route['FSL/search'] = 'FSL/search';

// Lessons
$route['FSL/lessons'] = 'FSL/lessons';
$route['FSL/lesson/(:num)'] = 'FSL/lesson/$1';

// Categories
$route['FSL/categories'] = 'FSL/categories';
$route['FSL/category/(:num)'] = 'FSL/category/$1';

// Learning Pages
$route['FSL/alphabet'] = 'FSL/alphabet';
$route['FSL/numbers'] = 'FSL/numbers';

// User Progress
$route['FSL/progress'] = 'FSL/progress';

// Practice Mode
$route['Practice'] = 'Practice';
$route['Practice/index'] = 'Practice/index';
$route['Practice/category/(:num)'] = 'Practice/category/$1';
$route['Practice/lesson/(:num)'] = 'Practice/lesson/$1';
$route['Practice/free_practice'] = 'Practice/free_practice';
$route['Practice/results/(:num)'] = 'Practice/results/$1';
$route['Practice/history'] = 'Practice/history';
$route['Practice/test_camera'] = 'Practice/test_camera';

// Practice AJAX endpoints
$route['Practice/process_recognition'] = 'Practice/process_recognition';
$route['Practice/complete_session'] = 'Practice/complete_session';
$route['Practice/recognize'] = 'Practice/recognize';

// Quiz Mode
$route['Quiz'] = 'Quiz';
$route['Quiz/index'] = 'Quiz/index';
$route['Quiz/start'] = 'Quiz/start';
$route['Quiz/question/(:num)'] = 'Quiz/question/$1';
$route['Quiz/submit_answer'] = 'Quiz/submit_answer';
$route['Quiz/submit_recognition'] = 'Quiz/submit_recognition';
$route['Quiz/complete'] = 'Quiz/complete';
$route['Quiz/results/(:num)'] = 'Quiz/results/$1';
$route['Quiz/history'] = 'Quiz/history';

// API Routes
$route['FSL/api/sign/(:num)'] = 'FSL/api_get_sign/$1';
$route['FSL/api/search'] = 'FSL/search';
