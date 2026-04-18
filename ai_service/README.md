# Filipino Sign Language Recognition AI Service

This is a Flask-based AI service for recognizing Filipino Sign Language (FSL) hand gestures.

## Features

- Real-time hand gesture recognition
- MediaPipe hand landmark detection
- Deep learning model for sign classification
- Supports FSL Alphabet (A-Z), Numbers (0-9), and common words

## Installation

1. Install Python 3.8 or higher
2. Create a virtual environment:
   ```bash
   python -m venv venv
   source venv/bin/activate  # On Windows: venv\Scripts\activate
   ```

3. Install dependencies:
   ```bash
   pip install -r requirements.txt
   ```

## Running the Service

Start the AI service:
```bash
python app.py
```

The service will run on `http://localhost:5000`

## API Endpoints

### Health Check
```
GET /health
```

### Predict Sign
```
POST /predict
Content-Type: application/json

{
    "image": "base64_encoded_image_data"
}
```

### Get Supported Classes
```
GET /classes
```

### Extract Landmarks
```
POST /landmarks
Content-Type: application/json

{
    "image": "base64_encoded_image_data"
}
```

## Supported Signs

- **Alphabet**: A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X, Y, Z
- **Numbers**: 0, 1, 2, 3, 4, 5, 6, 7, 8, 9
- **Words**: HELLO, THANK_YOU, PLEASE, SORRY, YES, NO, HELP, EAT, DRINK, SCHOOL, TEACHER, STUDENT

## Model Training

To train your own model:
1. Collect FSL dataset images
2. Preprocess using `preprocess.py` (create this file)
3. Train model using `train.py` (create this file)
4. Save model to `models/fsl_model.h5`

## Integration with CodeIgniter

The CodeIgniter application sends base64-encoded images to this service for recognition. The service returns the predicted sign label and confidence score.
