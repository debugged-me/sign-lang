# Filipino Sign Language (FSL) Learning and Recognition System

A web-based Filipino Sign Language learning and recognition system built with **CodeIgniter 3**, **PHP**, **MariaDB**, and **Python AI Service**.

## System Architecture

### Tech Stack
- **Backend**: CodeIgniter 3 (PHP)
- **Database**: MariaDB/MySQL
- **AI Recognition**: Python Flask + TensorFlow + MediaPipe
- **Frontend**: HTML5, JavaScript, Bootstrap
- **Server**: XAMPP (Apache)

### System Flow
1. User logs in to the web application
2. User selects FSL lesson or practice mode
3. Webcam opens for sign recognition
4. User performs a sign
5. Frame is sent to Python AI service
6. AI predicts the FSL sign
7. Result shows on the page
8. CodeIgniter stores history, score, progress, and analytics

---

## Installation & Setup

### 1. Database Setup

Import the database schema:

```bash
mysql -u root -p sign_language < database/fsl_database.sql
```

Or use phpMyAdmin to import `/Applications/XAMPP/xamppfiles/htdocs/SignLearn/database/fsl_database.sql`

The database includes:
- **36+ FSL signs** (Alphabet A-Z, Numbers 0-9, Common words)
- **8 Categories** (Alphabet, Numbers, Greetings, Daily Expressions, etc.)
- **8 Lessons** for progressive learning
- **Quiz questions** for assessment

### 2. AI Service Setup

Navigate to the AI service directory and install dependencies:

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/SignLearn/ai_service

# Create virtual environment
python3 -m venv venv
source venv/bin/activate  # On Windows: venv\Scripts\activate

# Install dependencies
pip install -r requirements.txt
```

Start the AI service:

```bash
python app.py
```

The AI service runs on `http://localhost:5000`

### 3. Web Application

The CodeIgniter application is already configured. Database settings are in:
- `/Applications/XAMPP/xamppfiles/htdocs/SignLearn/application/config/database.php`

Default database: `sign_language`
Default credentials: `root` / `(empty)`

---

## Project Structure

```
SignLearn/
├── application/
│   ├── config/
│   │   ├── database.php          # Database configuration
│   │   └── routes.php            # URL routing rules
│   ├── controllers/
│   │   ├── FSL.php              # Main FSL controller
│   │   ├── Practice.php         # Practice mode controller
│   │   └── Quiz.php             # Quiz controller
│   ├── models/
│   │   ├── FSLModel.php         # FSL dictionary model
│   │   ├── LessonModel.php      # Lessons model
│   │   ├── PracticeModel.php    # Practice/Progress model
│   │   └── QuizModel.php        # Quiz model
│   └── views/
│       ├── fsl/
│       │   ├── dashboard.php     # User dashboard
│       │   ├── dictionary.php    # FSL dictionary
│       │   ├── lessons.php     # Lessons list
│       │   ├── sign_detail.php # Sign details
│       │   ├── categories.php    # Categories
│       │   ├── category_detail.php
│       │   ├── alphabet.php      # Alphabet learning
│       │   ├── numbers.php      # Numbers learning
│       │   └── progress.php     # User progress
│       ├── practice/
│       │   ├── index.php        # Practice selection
│       │   ├── session.php      # Practice session with camera
│       │   └── results.php      # Session results
│       └── quiz/
│           ├── index.php        # Quiz selection
│           ├── question.php     # Quiz question
│           └── results.php      # Quiz results
├── ai_service/
│   ├── app.py                   # Flask AI service
│   ├── requirements.txt         # Python dependencies
│   └── README.md               # AI service documentation
├── database/
│   └── fsl_database.sql        # Database schema & seed data
└── README_FSL.md               # This file
```

---

## Features

### A. User Management
- Login/Register system
- User profile with avatar
- Learner progress tracking

### B. FSL Dictionary
- Browse all signs (Alphabet, Numbers, Words, Phrases)
- Filter by category
- Search functionality
- Sign details with images/videos

### C. Lessons
- Structured learning paths
- Progressive difficulty levels
- Alphabet lessons (A-G, H-N, O-T, U-Z)
- Numbers lessons (0-5, 6-9)
- Basic greetings and expressions

### D. Practice Mode
- **Free Practice**: AI-recommended signs
- **Category Practice**: Practice specific categories
- **Lesson Practice**: Practice signs from lessons
- Real-time webcam capture
- AI recognition feedback
- Progress tracking

### E. Quiz Mode
- Difficulty levels (Easy, Medium, Hard)
- Sign-to-text questions
- Recognition-based answers
- Score tracking
- Performance analytics

### F. Progress & Analytics
- Signs learned counter
- Mastered signs tracking
- Accuracy statistics
- Difficult signs identification
- Achievement system
- Practice history

### G. AI Recognition
- Hand detection using MediaPipe
- Deep learning classification
- Confidence scoring
- Real-time processing

---

## Available Routes

### Dashboard & Dictionary
- `GET /FSL` - Main dashboard
- `GET /FSL/dictionary` - FSL dictionary
- `GET /FSL/sign_detail/{id}` - Sign details
- `GET /FSL/search?q={query}` - Search signs

### Lessons
- `GET /FSL/lessons` - All lessons
- `GET /FSL/lesson/{id}` - Lesson details
- `GET /FSL/alphabet` - Alphabet learning
- `GET /FSL/numbers` - Numbers learning

### Categories
- `GET /FSL/categories` - All categories
- `GET /FSL/category/{id}` - Category details

### Practice
- `GET /Practice` - Practice selection
- `GET /Practice/category/{id}` - Practice by category
- `GET /Practice/lesson/{id}` - Practice by lesson
- `GET /Practice/free_practice` - Free practice mode
- `POST /Practice/process_recognition` - Submit recognition result
- `POST /Practice/complete_session` - Complete practice session

### Quiz
- `GET /Quiz` - Quiz selection
- `GET /Quiz/start` - Start quiz
- `GET /Quiz/question/{index}` - Quiz question
- `POST /Quiz/submit_answer` - Submit answer
- `POST /Quiz/submit_recognition` - Submit recognition answer
- `GET /Quiz/complete` - Complete quiz
- `GET /Quiz/results/{id}` - Quiz results

### User
- `GET /FSL/progress` - User progress
- `GET /Practice/history` - Practice history

---

## AI Service API

### Endpoints

**Health Check**
```
GET http://localhost:5000/health
```

**Predict Sign**
```
POST http://localhost:5000/predict
Content-Type: application/json

{
    "image": "base64_encoded_image_string"
}
```

**Response**
```json
{
    "success": true,
    "prediction": "A",
    "confidence": 0.95,
    "all_predictions": [
        {"label": "A", "confidence": 0.95},
        {"label": "B", "confidence": 0.03},
        {"label": "C", "confidence": 0.02}
    ],
    "hand_detected": true
}
```

**Get Supported Classes**
```
GET http://localhost:5000/classes
```

---

## Database Tables

| Table | Description |
|-------|-------------|
| `users` | User accounts |
| `sign_language` | FSL signs dictionary |
| `fsl_categories` | Sign categories |
| `lessons` | Learning lessons |
| `lesson_signs` | Lesson-sign relationships |
| `user_progress` | User learning progress |
| `practice_sessions` | Practice session records |
| `practice_attempts` | Individual practice attempts |
| `quiz_questions` | Quiz question bank |
| `user_achievements` | User badges/achievements |
| `ai_models` | AI model metadata |

---

## Default Data Included

### Categories
1. Alphabet (A-Z)
2. Numbers (0-9)
3. Greetings (Hello, Thank You, etc.)
4. Daily Expressions (Yes, No, Please, etc.)
5. Classroom (School, Teacher, Student)
6. Family
7. Food
8. Emotions

### Signs (49 total)
- **Alphabet**: A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X, Y, Z
- **Numbers**: 0, 1, 2, 3, 4, 5, 6, 7, 8, 9
- **Greetings**: Hello, Thank You, Please, Sorry, Good Morning, Good Afternoon, Good Evening
- **Words**: Yes, No, Help, Eat, Drink, School, Teacher, Student, Friend, Family

---

## Next Steps

1. **Import the database** using the SQL file
2. **Start the AI service** (Python Flask app)
3. **Configure XAMPP** and start Apache
4. **Access the application** at `http://localhost/SignLearn/FSL`

---

## Future Enhancements

- Advanced phrase recognition
- Sentence-level translation
- Video tutorial integration
- Mobile app companion
- Speech-to-text integration
- Community features
- More comprehensive FSL dictionary

---

## License

This project is for educational purposes.
