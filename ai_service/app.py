"""
Filipino Sign Language Recognition AI Service
Flask-based API for hand gesture recognition using MediaPipe and TensorFlow
"""

from flask import Flask, request, jsonify
from flask_cors import CORS
import base64
import io
import numpy as np
from PIL import Image
import cv2
import mediapipe as mp
import tensorflow as tf
import os
import json
import logging

# Setup logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

app = Flask(__name__)
CORS(app)

# Initialize MediaPipe Hands
mp_hands = mp.solutions.hands
mp_drawing = mp.solutions.drawing_utils
mp_drawing_styles = mp.solutions.drawing_styles

hands = mp_hands.Hands(
    static_image_mode=True,
    max_num_hands=1,
    min_detection_confidence=0.5,
    min_tracking_confidence=0.5
)

# Model configuration
MODEL_PATH = os.path.join(os.path.dirname(__file__), 'models', 'fsl_model.h5')
CLASS_NAMES = [
    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
    'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
    '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
    'HELLO', 'THANK_YOU', 'PLEASE', 'SORRY', 'YES', 'NO', 'HELP',
    'EAT', 'DRINK', 'SCHOOL', 'TEACHER', 'STUDENT'
]

# Load model (or create a simple model if not exists)
model = None


def load_model():
    """Load the FSL recognition model"""
    global model
    try:
        if os.path.exists(MODEL_PATH):
            model = tf.keras.models.load_model(MODEL_PATH)
            logger.info("Model loaded successfully")
        else:
            logger.warning("Model file not found, creating demo model")
            model = create_demo_model()
    except Exception as e:
        logger.error(f"Error loading model: {e}")
        model = create_demo_model()


def create_demo_model():
    """Create a simple demo model for testing"""
    # Simple CNN model for 64x64 grayscale images
    model = tf.keras.Sequential([
        tf.keras.layers.Conv2D(32, (3, 3), activation='relu', input_shape=(64, 64, 1)),
        tf.keras.layers.MaxPooling2D((2, 2)),
        tf.keras.layers.Conv2D(64, (3, 3), activation='relu'),
        tf.keras.layers.MaxPooling2D((2, 2)),
        tf.keras.layers.Conv2D(64, (3, 3), activation='relu'),
        tf.keras.layers.Flatten(),
        tf.keras.layers.Dense(64, activation='relu'),
        tf.keras.layers.Dense(len(CLASS_NAMES), activation='softmax')
    ])
    model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])
    return model


def preprocess_image(image_data):
    """
    Preprocess image for model prediction
    
    Args:
        image_data: Base64 encoded image string
    
    Returns:
        Preprocessed numpy array or None if processing fails
    """
    try:
        # Decode base64 image
        if ',' in image_data:
            image_data = image_data.split(',')[1]
        
        image_bytes = base64.b64decode(image_data)
        image = Image.open(io.BytesIO(image_bytes))
        
        # Convert to RGB if necessary
        if image.mode != 'RGB':
            image = image.convert('RGB')
        
        # Convert to numpy array
        image_array = np.array(image)
        
        # Process with MediaPipe Hands
        results = hands.process(image_array)
        
        if not results.multi_hand_landmarks:
            logger.warning("No hand detected in image")
            # Return original image processed for model input
            gray = cv2.cvtColor(image_array, cv2.COLOR_RGB2GRAY)
            resized = cv2.resize(gray, (64, 64))
            normalized = resized / 255.0
            return normalized.reshape(1, 64, 64, 1), None
        
        # Extract hand landmarks
        hand_landmarks = results.multi_hand_landmarks[0]
        
        # Get bounding box from landmarks
        h, w, _ = image_array.shape
        x_coords = [lm.x * w for lm in hand_landmarks.landmark]
        y_coords = [lm.y * h for lm in hand_landmarks.landmark]
        
        x_min, x_max = int(min(x_coords)), int(max(x_coords))
        y_min, y_max = int(min(y_coords)), int(max(y_coords))
        
        # Add padding
        padding = 40
        x_min = max(0, x_min - padding)
        y_min = max(0, y_min - padding)
        x_max = min(w, x_max + padding)
        y_max = min(h, y_max + padding)
        
        # Crop hand region
        hand_region = image_array[y_min:y_max, x_min:x_max]
        
        # Convert to grayscale and resize
        gray = cv2.cvtColor(hand_region, cv2.COLOR_RGB2GRAY)
        resized = cv2.resize(gray, (64, 64))
        normalized = resized / 255.0
        
        return normalized.reshape(1, 64, 64, 1), hand_landmarks
        
    except Exception as e:
        logger.error(f"Error preprocessing image: {e}")
        return None, None


def extract_landmarks(image_data):
    """
    Extract hand landmarks from image
    
    Args:
        image_data: Base64 encoded image string
    
    Returns:
        List of 21 landmarks (x, y, z) coordinates
    """
    try:
        # Decode base64 image
        if ',' in image_data:
            image_data = image_data.split(',')[1]
        
        image_bytes = base64.b64decode(image_data)
        image = Image.open(io.BytesIO(image_bytes))
        
        if image.mode != 'RGB':
            image = image.convert('RGB')
        
        image_array = np.array(image)
        
        # Process with MediaPipe
        results = hands.process(image_array)
        
        if results.multi_hand_landmarks:
            landmarks = results.multi_hand_landmarks[0].landmark
            return [[lm.x, lm.y, lm.z] for lm in landmarks]
        
        return None
        
    except Exception as e:
        logger.error(f"Error extracting landmarks: {e}")
        return None


def predict_sign(image_data):
    """
    Predict the FSL sign from image
    
    Args:
        image_data: Base64 encoded image string
    
    Returns:
        Dictionary with prediction result
    """
    try:
        # Preprocess image
        processed_image, landmarks = preprocess_image(image_data)
        
        if processed_image is None:
            return {
                'success': False,
                'prediction': None,
                'confidence': 0,
                'message': 'Failed to process image'
            }
        
        # Make prediction
        if model is None:
            load_model()
        
        predictions = model.predict(processed_image, verbose=0)
        predicted_class = np.argmax(predictions[0])
        confidence = float(predictions[0][predicted_class])
        
        # Get top 3 predictions
        top_3_indices = np.argsort(predictions[0])[-3:][::-1]
        top_3_predictions = [
            {
                'label': CLASS_NAMES[i],
                'confidence': float(predictions[0][i])
            }
            for i in top_3_indices
        ]
        
        result = {
            'success': True,
            'prediction': CLASS_NAMES[predicted_class],
            'confidence': confidence,
            'all_predictions': top_3_predictions,
            'hand_detected': landmarks is not None
        }
        
        logger.info(f"Prediction: {result['prediction']} (confidence: {confidence:.2f})")
        
        return result
        
    except Exception as e:
        logger.error(f"Error making prediction: {e}")
        return {
            'success': False,
            'prediction': None,
            'confidence': 0,
            'message': str(e)
        }


# API Routes

@app.route('/')
def index():
    """Health check endpoint"""
    return jsonify({
        'status': 'ok',
        'service': 'FSL Recognition API',
        'version': '1.0.0',
        'model_loaded': model is not None
    })


@app.route('/predict', methods=['POST'])
def predict():
    """
    Predict FSL sign from image
    
    Request body:
        {
            "image": "base64_encoded_image_string"
        }
    
    Response:
        {
            "success": true/false,
            "prediction": "A",
            "confidence": 0.95,
            "all_predictions": [...],
            "hand_detected": true/false
        }
    """
    try:
        data = request.get_json()
        
        if not data or 'image' not in data:
            return jsonify({
                'success': False,
                'message': 'No image data provided'
            }), 400
        
        result = predict_sign(data['image'])
        return jsonify(result)
        
    except Exception as e:
        logger.error(f"Error in predict endpoint: {e}")
        return jsonify({
            'success': False,
            'message': str(e)
        }), 500


@app.route('/landmarks', methods=['POST'])
def landmarks():
    """
    Extract hand landmarks from image
    
    Request body:
        {
            "image": "base64_encoded_image_string"
        }
    
    Response:
        {
            "success": true/false,
            "landmarks": [[x, y, z], ...] or null
        }
    """
    try:
        data = request.get_json()
        
        if not data or 'image' not in data:
            return jsonify({
                'success': False,
                'message': 'No image data provided'
            }), 400
        
        landmarks_data = extract_landmarks(data['image'])
        
        return jsonify({
            'success': landmarks_data is not None,
            'landmarks': landmarks_data
        })
        
    except Exception as e:
        logger.error(f"Error in landmarks endpoint: {e}")
        return jsonify({
            'success': False,
            'message': str(e)
        }), 500


@app.route('/classes', methods=['GET'])
def get_classes():
    """Get list of supported sign classes"""
    return jsonify({
        'success': True,
        'classes': CLASS_NAMES,
        'total': len(CLASS_NAMES)
    })


@app.route('/health', methods=['GET'])
def health():
    """Health check endpoint"""
    return jsonify({
        'status': 'healthy',
        'model_loaded': model is not None,
        'supported_classes': len(CLASS_NAMES)
    })


if __name__ == '__main__':
    # Create models directory if not exists
    os.makedirs(os.path.dirname(MODEL_PATH), exist_ok=True)
    
    # Load model on startup
    load_model()
    
    # Run Flask app
    app.run(host='0.0.0.0', port=5000, debug=True)
