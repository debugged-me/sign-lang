-- ===========================================
-- Filipino Sign Language Learning System Database Schema
-- ===========================================

-- Create database (if not exists)
CREATE DATABASE IF NOT EXISTS sign_language CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sign_language;

-- ===========================================
-- 1. USERS TABLE (for FSL learners)
-- ===========================================
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    avatar VARCHAR(255) DEFAULT 'default.jpg',
    user_type ENUM('learner', 'admin', 'instructor') DEFAULT 'learner',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ===========================================
-- 2. FSL CATEGORIES TABLE
-- ===========================================
CREATE TABLE IF NOT EXISTS fsl_categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL,
    category_description TEXT,
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ===========================================
-- 3. SIGN LANGUAGE TABLE (Main FSL Dictionary)
-- ===========================================
CREATE TABLE IF NOT EXISTS sign_language (
    sign_id INT AUTO_INCREMENT PRIMARY KEY,
    sign_name VARCHAR(100) NOT NULL,
    sign_type ENUM('alphabet', 'number', 'word', 'phrase') NOT NULL,
    category_id INT,
    
    -- Media files
    image_path VARCHAR(255),
    video_path VARCHAR(255),
    
    -- Descriptions
    description TEXT,
    usage_example TEXT,
    handshape_description TEXT,
    movement_description TEXT,
    
    -- Difficulty level for learning progression
    difficulty_level ENUM('beginner', 'intermediate', 'advanced') DEFAULT 'beginner',
    
    -- AI/Recognition metadata
    model_label VARCHAR(50),
    model_confidence_threshold DECIMAL(3,2) DEFAULT 0.70,
    
    -- Status
    is_active TINYINT(1) DEFAULT 1,
    is_featured TINYINT(1) DEFAULT 0,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (category_id) REFERENCES fsl_categories(category_id) ON DELETE SET NULL,
    INDEX idx_sign_type (sign_type),
    INDEX idx_category (category_id),
    INDEX idx_difficulty (difficulty_level)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ===========================================
-- 4. LESSONS TABLE
-- ===========================================
CREATE TABLE IF NOT EXISTS lessons (
    lesson_id INT AUTO_INCREMENT PRIMARY KEY,
    lesson_title VARCHAR(100) NOT NULL,
    lesson_description TEXT,
    category_id INT,
    
    -- Lesson structure
    lesson_order INT DEFAULT 0,
    difficulty_level ENUM('beginner', 'intermediate', 'advanced') DEFAULT 'beginner',
    
    -- Content
    estimated_duration INT COMMENT 'Estimated time in minutes',
    total_signs INT DEFAULT 0,
    
    -- Status
    is_active TINYINT(1) DEFAULT 1,
    is_published TINYINT(1) DEFAULT 0,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (category_id) REFERENCES fsl_categories(category_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ===========================================
-- 5. LESSON SIGNS (Many-to-Many: Lessons to Signs)
-- ===========================================
CREATE TABLE IF NOT EXISTS lesson_signs (
    lesson_sign_id INT AUTO_INCREMENT PRIMARY KEY,
    lesson_id INT NOT NULL,
    sign_id INT NOT NULL,
    sign_order INT DEFAULT 0,
    
    FOREIGN KEY (lesson_id) REFERENCES lessons(lesson_id) ON DELETE CASCADE,
    FOREIGN KEY (sign_id) REFERENCES sign_language(sign_id) ON DELETE CASCADE,
    UNIQUE KEY unique_lesson_sign (lesson_id, sign_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ===========================================
-- 6. USER PROGRESS TABLE
-- ===========================================
CREATE TABLE IF NOT EXISTS user_progress (
    progress_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    sign_id INT NOT NULL,
    lesson_id INT,
    
    -- Progress tracking
    status ENUM('not_started', 'learning', 'practiced', 'mastered') DEFAULT 'not_started',
    practice_count INT DEFAULT 0,
    correct_count INT DEFAULT 0,
    
    -- Scores
    highest_score DECIMAL(5,2) DEFAULT 0,
    average_score DECIMAL(5,2) DEFAULT 0,
    
    -- Timestamps
    first_attempt TIMESTAMP NULL,
    last_practice TIMESTAMP NULL,
    mastered_at TIMESTAMP NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (sign_id) REFERENCES sign_language(sign_id) ON DELETE CASCADE,
    FOREIGN KEY (lesson_id) REFERENCES lessons(lesson_id) ON DELETE SET NULL,
    UNIQUE KEY unique_user_sign (user_id, sign_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ===========================================
-- 7. PRACTICE SESSIONS TABLE
-- ===========================================
CREATE TABLE IF NOT EXISTS practice_sessions (
    session_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    session_type ENUM('practice', 'quiz', 'lesson') DEFAULT 'practice',
    lesson_id INT,
    category_id INT,
    
    -- Session stats
    total_attempts INT DEFAULT 0,
    correct_attempts INT DEFAULT 0,
    score DECIMAL(5,2) DEFAULT 0,
    duration_seconds INT DEFAULT 0,
    
    -- Session status
    is_completed TINYINT(1) DEFAULT 0,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_at TIMESTAMP NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (lesson_id) REFERENCES lessons(lesson_id) ON DELETE SET NULL,
    FOREIGN KEY (category_id) REFERENCES fsl_categories(category_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ===========================================
-- 8. PRACTICE ATTEMPTS TABLE (Detailed)
-- ===========================================
CREATE TABLE IF NOT EXISTS practice_attempts (
    attempt_id INT AUTO_INCREMENT PRIMARY KEY,
    session_id INT NOT NULL,
    user_id INT NOT NULL,
    sign_id INT NOT NULL,
    
    -- Recognition result
    attempted_sign VARCHAR(100),
    recognized_sign VARCHAR(100),
    is_correct TINYINT(1) DEFAULT 0,
    confidence_score DECIMAL(5,4) DEFAULT 0,
    
    -- Media capture (optional - for review)
    captured_image_path VARCHAR(255),
    
    -- Timestamps
    attempted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (session_id) REFERENCES practice_sessions(session_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (sign_id) REFERENCES sign_language(sign_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ===========================================
-- 9. QUIZ QUESTIONS TABLE
-- ===========================================
CREATE TABLE IF NOT EXISTS quiz_questions (
    question_id INT AUTO_INCREMENT PRIMARY KEY,
    question_text VARCHAR(255),
    question_type ENUM('sign_to_text', 'text_to_sign', 'multiple_choice') DEFAULT 'sign_to_text',
    sign_id INT,
    correct_answer VARCHAR(100) NOT NULL,
    options TEXT COMMENT 'JSON array for multiple choice',
    difficulty_level ENUM('easy', 'medium', 'hard') DEFAULT 'easy',
    points INT DEFAULT 1,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (sign_id) REFERENCES sign_language(sign_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ===========================================
-- 10. USER ACHIEVEMENTS/BADGES TABLE
-- ===========================================
CREATE TABLE IF NOT EXISTS user_achievements (
    achievement_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    achievement_type VARCHAR(50) NOT NULL,
    achievement_title VARCHAR(100) NOT NULL,
    achievement_description TEXT,
    icon_path VARCHAR(255),
    earned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ===========================================
-- 11. AI MODEL METADATA TABLE
-- ===========================================
CREATE TABLE IF NOT EXISTS ai_models (
    model_id INT AUTO_INCREMENT PRIMARY KEY,
    model_name VARCHAR(100) NOT NULL,
    model_version VARCHAR(20) NOT NULL,
    model_path VARCHAR(255),
    model_type ENUM('tensorflow', 'pytorch', 'sklearn') DEFAULT 'tensorflow',
    
    -- Performance metrics
    accuracy DECIMAL(5,4) DEFAULT 0,
    precision_score DECIMAL(5,4) DEFAULT 0,
    recall DECIMAL(5,4) DEFAULT 0,
    f1_score DECIMAL(5,4) DEFAULT 0,
    
    -- Supported signs
    total_signs INT DEFAULT 0,
    supported_signs TEXT COMMENT 'JSON array of sign_ids',
    
    -- Status
    is_active TINYINT(1) DEFAULT 0,
    is_default TINYINT(1) DEFAULT 0,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ===========================================
-- INSERT DEFAULT DATA
-- ===========================================

-- Insert default categories
INSERT INTO fsl_categories (category_name, category_description, display_order) VALUES
('Alphabet', 'Filipino Sign Language alphabet letters A-Z', 1),
('Numbers', 'Numbers 0-9 in FSL', 2),
('Greetings', 'Common greetings and salutations', 3),
('Daily Expressions', 'Everyday words and phrases', 4),
('Classroom', 'School and education related signs', 5),
('Family', 'Family members and relationships', 6),
('Food', 'Food and drink related signs', 7),
('Emotions', 'Emotional expressions and feelings', 8);

-- Insert FSL Alphabet
INSERT INTO sign_language (sign_name, sign_type, category_id, description, difficulty_level, model_label) VALUES
('A', 'alphabet', 1, 'Filipino Sign Language letter A - fist with thumb on side', 'beginner', 'A'),
('B', 'alphabet', 1, 'Filipino Sign Language letter B - flat hand palm forward', 'beginner', 'B'),
('C', 'alphabet', 1, 'Filipino Sign Language letter C - curved hand shape', 'beginner', 'C'),
('D', 'alphabet', 1, 'Filipino Sign Language letter D - index finger up, others curved', 'beginner', 'D'),
('E', 'alphabet', 1, 'Filipino Sign Language letter E - claw shape with bent fingers', 'beginner', 'E'),
('F', 'alphabet', 1, 'Filipino Sign Language letter F - thumb and index finger touch', 'beginner', 'F'),
('G', 'alphabet', 1, 'Filipino Sign Language letter G - index finger pointing', 'beginner', 'G'),
('H', 'alphabet', 1, 'Filipino Sign Language letter H - index and middle finger parallel', 'beginner', 'H'),
('I', 'alphabet', 1, 'Filipino Sign Language letter I - pinky finger up', 'beginner', 'I'),
('J', 'alphabet', 1, 'Filipino Sign Language letter J - pinky finger with J motion', 'beginner', 'J'),
('K', 'alphabet', 1, 'Filipino Sign Language letter K - peace sign with thumb', 'beginner', 'K'),
('L', 'alphabet', 1, 'Filipino Sign Language letter L - L shape with thumb and index', 'beginner', 'L'),
('M', 'alphabet', 1, 'Filipino Sign Language letter M - three fingers over thumb', 'beginner', 'M'),
('N', 'alphabet', 1, 'Filipino Sign Language letter N - two fingers over thumb', 'beginner', 'N'),
('O', 'alphabet', 1, 'Filipino Sign Language letter O - O shape with fingers', 'beginner', 'O'),
('P', 'alphabet', 1, 'Filipino Sign Language letter P - K shape pointing down', 'beginner', 'P'),
('Q', 'alphabet', 1, 'Filipino Sign Language letter Q - G shape pointing down', 'beginner', 'Q'),
('R', 'alphabet', 1, 'Filipino Sign Language letter R - crossed fingers', 'beginner', 'R'),
('S', 'alphabet', 1, 'Filipino Sign Language letter S - fist', 'beginner', 'S'),
('T', 'alphabet', 1, 'Filipino Sign Language letter T - fist with thumb between fingers', 'beginner', 'T'),
('U', 'alphabet', 1, 'Filipino Sign Language letter U - parallel fingers', 'beginner', 'U'),
('V', 'alphabet', 1, 'Filipino Sign Language letter V - victory sign', 'beginner', 'V'),
('W', 'alphabet', 1, 'Filipino Sign Language letter W - three fingers up', 'beginner', 'W'),
('X', 'alphabet', 1, 'Filipino Sign Language letter X - bent index finger', 'beginner', 'X'),
('Y', 'alphabet', 1, 'Filipino Sign Language letter Y - Y shape with pinky and thumb', 'beginner', 'Y'),
('Z', 'alphabet', 1, 'Filipino Sign Language letter Z - Z motion with index finger', 'beginner', 'Z');

-- Insert Numbers
INSERT INTO sign_language (sign_name, sign_type, category_id, description, difficulty_level, model_label) VALUES
('0', 'number', 2, 'Number zero in FSL', 'beginner', '0'),
('1', 'number', 2, 'Number one in FSL - index finger up', 'beginner', '1'),
('2', 'number', 2, 'Number two in FSL - two fingers', 'beginner', '2'),
('3', 'number', 2, 'Number three in FSL - three fingers', 'beginner', '3'),
('4', 'number', 2, 'Number four in FSL - four fingers', 'beginner', '4'),
('5', 'number', 2, 'Number five in FSL - open hand', 'beginner', '5'),
('6', 'number', 2, 'Number six in FSL - thumb touching pinky', 'beginner', '6'),
('7', 'number', 2, 'Number seven in FSL - thumb touching ring finger', 'beginner', '7'),
('8', 'number', 2, 'Number eight in FSL - thumb touching middle finger', 'beginner', '8'),
('9', 'number', 2, 'Number nine in FSL - thumb touching index finger', 'beginner', '9');

-- Insert Greetings
INSERT INTO sign_language (sign_name, sign_type, category_id, description, usage_example, difficulty_level, model_label) VALUES
('Hello', 'word', 3, 'Greeting to say hello', 'Hello! How are you?', 'beginner', 'HELLO'),
('Good Morning', 'phrase', 3, 'Greeting used in the morning', 'Good morning! Have a nice day!', 'intermediate', 'GOOD_MORNING'),
('Good Afternoon', 'phrase', 3, 'Greeting used in the afternoon', 'Good afternoon everyone!', 'intermediate', 'GOOD_AFTERNOON'),
('Good Evening', 'phrase', 3, 'Greeting used in the evening', 'Good evening friends!', 'intermediate', 'GOOD_EVENING'),
('Thank You', 'word', 3, 'Expression of gratitude', 'Thank you for your help.', 'beginner', 'THANK_YOU'),
('Please', 'word', 3, 'Polite request', 'Please help me.', 'beginner', 'PLEASE'),
('Sorry', 'word', 3, 'Expression of apology', 'I am sorry for being late.', 'beginner', 'SORRY');

-- Insert Common Words
INSERT INTO sign_language (sign_name, sign_type, category_id, description, usage_example, difficulty_level, model_label) VALUES
('Yes', 'word', 4, 'Affirmative response', 'Yes, I understand.', 'beginner', 'YES'),
('No', 'word', 4, 'Negative response', 'No, thank you.', 'beginner', 'NO'),
('Help', 'word', 4, 'Request for assistance', 'I need help.', 'beginner', 'HELP'),
('Eat', 'word', 4, 'Action of eating food', 'I want to eat.', 'beginner', 'EAT'),
('Drink', 'word', 4, 'Action of drinking', 'I drink water.', 'beginner', 'DRINK'),
('School', 'word', 5, 'Educational institution', 'I go to school.', 'beginner', 'SCHOOL'),
('Teacher', 'word', 5, 'Educator or instructor', 'My teacher is kind.', 'beginner', 'TEACHER'),
('Student', 'word', 5, 'Person studying', 'I am a student.', 'beginner', 'STUDENT'),
('Friend', 'word', 6, 'Companion or buddy', 'You are my friend.', 'beginner', 'FRIEND'),
('Family', 'word', 6, 'Group of relatives', 'I love my family.', 'beginner', 'FAMILY');

-- Create beginner lessons
INSERT INTO lessons (lesson_title, lesson_description, category_id, lesson_order, difficulty_level, estimated_duration, total_signs, is_published) VALUES
('FSL Alphabet - Part 1', 'Learn letters A-G of the Filipino Sign Language alphabet', 1, 1, 'beginner', 15, 7, 1),
('FSL Alphabet - Part 2', 'Learn letters H-N of the Filipino Sign Language alphabet', 1, 2, 'beginner', 15, 7, 1),
('FSL Alphabet - Part 3', 'Learn letters O-T of the Filipino Sign Language alphabet', 1, 3, 'beginner', 15, 6, 1),
('FSL Alphabet - Part 4', 'Learn letters U-Z of the Filipino Sign Language alphabet', 1, 4, 'beginner', 15, 6, 1),
('Numbers 0-5', 'Learn to sign numbers 0 through 5 in FSL', 2, 5, 'beginner', 10, 6, 1),
('Numbers 6-9', 'Learn to sign numbers 6 through 9 in FSL', 2, 6, 'beginner', 10, 4, 1),
('Basic Greetings', 'Learn common FSL greetings like Hello and Thank You', 3, 7, 'beginner', 15, 3, 1),
('Daily Expressions', 'Learn everyday words like Yes, No, Please, Sorry', 4, 8, 'beginner', 15, 4, 1);

-- Link signs to lessons
INSERT INTO lesson_signs (lesson_id, sign_id, sign_order) VALUES
-- Lesson 1: A-G
(1, 1, 1), (1, 2, 2), (1, 3, 3), (1, 4, 4), (1, 5, 5), (1, 6, 6), (1, 7, 7),
-- Lesson 2: H-N
(2, 8, 1), (2, 9, 2), (2, 10, 3), (2, 11, 4), (2, 12, 5), (2, 13, 6), (2, 14, 7),
-- Lesson 3: O-T
(3, 15, 1), (3, 16, 2), (3, 17, 3), (3, 18, 4), (3, 19, 5), (3, 20, 6),
-- Lesson 4: U-Z
(4, 21, 1), (4, 22, 2), (4, 23, 3), (4, 24, 4), (4, 25, 5), (4, 26, 6),
-- Lesson 5: Numbers 0-5
(5, 27, 1), (5, 28, 2), (5, 29, 3), (5, 30, 4), (5, 31, 5), (5, 32, 6),
-- Lesson 6: Numbers 6-9
(6, 33, 1), (6, 34, 2), (6, 35, 3), (6, 36, 4),
-- Lesson 7: Basic Greetings
(7, 37, 1), (7, 41, 2), (7, 42, 3),
-- Lesson 8: Daily Expressions
(8, 44, 1), (8, 45, 2), (8, 46, 3), (8, 47, 4);

-- Create sample quiz questions
INSERT INTO quiz_questions (question_text, question_type, sign_id, correct_answer, difficulty_level, points) VALUES
('What letter is this?', 'sign_to_text', 1, 'A', 'easy', 1),
('What letter is this?', 'sign_to_text', 5, 'E', 'easy', 1),
('What number is this?', 'sign_to_text', 28, '1', 'easy', 1),
('What is the sign for "Hello"?', 'text_to_sign', 37, 'HELLO', 'easy', 1),
('What is the sign for "Thank You"?', 'text_to_sign', 41, 'THANK_YOU', 'easy', 1),
('How do you say "Yes" in FSL?', 'text_to_sign', 44, 'YES', 'easy', 1);

-- Insert default admin user (password: admin123)
INSERT INTO users (username, email, password_hash, first_name, last_name, user_type, is_active) VALUES
('admin', 'admin@signlearn.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System', 'Administrator', 'admin', 1);

-- ===========================================
-- VIEWS FOR REPORTING
-- ===========================================

-- View: User Learning Statistics
CREATE VIEW IF NOT EXISTS v_user_learning_stats AS
SELECT 
    u.user_id,
    u.username,
    u.first_name,
    u.last_name,
    COUNT(DISTINCT up.sign_id) as signs_learned,
    COUNT(DISTINCT CASE WHEN up.status = 'mastered' THEN up.sign_id END) as signs_mastered,
    COUNT(DISTINCT ps.session_id) as total_sessions,
    SUM(ps.correct_attempts) as total_correct,
    SUM(ps.total_attempts) as total_attempts,
    ROUND((SUM(ps.correct_attempts) / NULLIF(SUM(ps.total_attempts), 0)) * 100, 2) as overall_accuracy
FROM users u
LEFT JOIN user_progress up ON u.user_id = up.user_id
LEFT JOIN practice_sessions ps ON u.user_id = ps.user_id AND ps.is_completed = 1
WHERE u.user_type = 'learner'
GROUP BY u.user_id, u.username, u.first_name, u.last_name;

-- View: Sign Popularity
CREATE VIEW IF NOT EXISTS v_sign_popularity AS
SELECT 
    sl.sign_id,
    sl.sign_name,
    sl.sign_type,
    fc.category_name,
    COUNT(up.progress_id) as times_learned,
    COUNT(CASE WHEN up.status = 'mastered' THEN 1 END) as times_mastered,
    AVG(up.average_score) as avg_score,
    COUNT(pa.attempt_id) as total_practice_attempts,
    ROUND((COUNT(CASE WHEN pa.is_correct = 1 THEN 1 END) / NULLIF(COUNT(pa.attempt_id), 0)) * 100, 2) as recognition_accuracy
FROM sign_language sl
LEFT JOIN fsl_categories fc ON sl.category_id = fc.category_id
LEFT JOIN user_progress up ON sl.sign_id = up.sign_id
LEFT JOIN practice_attempts pa ON sl.sign_id = pa.sign_id
WHERE sl.is_active = 1
GROUP BY sl.sign_id, sl.sign_name, sl.sign_type, fc.category_name
ORDER BY times_learned DESC;
