# CLAUDE.md

## Project Overview

This project is a **Web-Based Filipino Sign Language (FSL) Learning and Recognition System with AI Interaction**.

The system is designed to help users learn, practice, and recognize **Filipino Sign Language (FSL)** through a web platform. It combines a traditional PHP web application with an AI-powered sign recognition service.

### Main Stack
- **CodeIgniter 3**
- **PHP**
- **MariaDB / MySQL**
- **XAMPP**
- **Bootstrap**
- **jQuery / AJAX**
- **Python**
- **Flask or FastAPI**
- **OpenCV**
- **MediaPipe**
- **TensorFlow / Keras**

---

## Core Working Style

When helping in this repository:

- **Do the work directly**
- **Prefer direct fixes over long explanations**
- **Keep explanations minimal unless explicitly asked**
- **Give paste-ready code**
- **Prioritize correctness and working output**
- **Preserve existing behavior**
- **Avoid unnecessary rewrites**
- **Make practical decisions without excessive back-and-forth when context is already clear**
- **Act like a senior maintainer working on a live system**
- **Be accurate, careful, and implementation-focused**

Default behavior:
- provide the corrected code first
- keep commentary short
- avoid theory unless needed
- solve the actual issue, not just describe it

Preferred response structure:
1. Problem
2. Fix
3. Updated code

If the issue is obvious, go straight to the updated code.

---

## Architecture

The project has two major parts:

### 1. Main Web Application
The main system is built in **CodeIgniter 3** and handles:
- authentication
- dashboard
- FSL sign dictionary
- lessons
- quiz and practice pages
- progress tracking
- admin management
- history logs
- database operations

### 2. AI Recognition Service
The AI service is a separate **Python-based module** responsible for:
- webcam frame processing
- hand landmark extraction
- sign classification
- returning predicted FSL labels and confidence scores

### Integration Flow
1. User opens a practice or quiz page in CodeIgniter
2. Browser accesses webcam
3. Frame or processed input is sent to the Python AI service
4. AI service returns the predicted sign
5. CodeIgniter stores the result in MariaDB
6. The frontend displays prediction and progress

---

## Core Project Goal

The primary goal is to deliver a practical, realistic, and extensible **FSL learning and recognition platform**.

The initial system focus is:

- **FSL alphabet**
- **FSL numbers**
- **basic greetings**
- **common words**
- **practice mode**
- **quiz mode**
- **progress tracking**
- **AI sign recognition**

Do **not** assume this project supports full free-form sentence translation unless explicitly implemented.

---

## Development Priorities

When working on this codebase, prioritize the following:

1. **Preserve existing working behavior**
2. **Minimize breakage**
3. **Respect current CodeIgniter 3 structure**
4. **Give paste-ready code**
5. **Keep changes practical and production-safe**
6. **Prefer maintainable solutions over unnecessary rewrites**
7. **Do not overengineer**
8. **Keep compatibility with XAMPP, MariaDB, and local development flow**
9. **Treat this as a real capstone / production-like educational system**
10. **Use clean, modern, light-themed UI by default**
11. **Keep the experience visually friendly, accessible, and suitable for FSL learning**

---

## Global Font Rule

Use **Plus Jakarta Sans / Jakarta** as the **global font** across the system.

### Font Source
The font files are stored at:

```text id="zfnm9r"
/Applications/XAMPP/xamppfiles/htdocs/sign-lang/assets/fonts/Jakarta-fonts