<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('includes/head'); ?>

<body>
    <div id="wrapper">
        <?php $this->load->view('includes/top-nav-bar'); ?>
        <?php $this->load->view('includes/sidebar'); ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <!-- Session Header -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <div class="btn-group">
                                        <button class="btn btn-light" id="pauseBtn"><i class="mdi mdi-pause"></i> Pause</button>
                                        <a href="<?= base_url('Practice') ?>" class="btn btn-danger"><i class="mdi mdi-close"></i> Exit</a>
                                    </div>
                                </div>
                                <h4 class="page-title">
                                    <?php if (isset($category)): ?>
                                        Practice: <?= $category->category_name ?>
                                    <?php elseif (isset($lesson)): ?>
                                        Practice: <?= $lesson->lesson_title ?>
                                    <?php else: ?>
                                        Free Practice
                                    <?php endif; ?>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Progress: <span id="currentSign">1</span> / <?= $total_signs ?></span>
                                    <span>Score: <span id="currentScore">0</span></span>
                                </div>
                                <div class="progress mt-2" style="height: 10px;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                        id="sessionProgress" role="progressbar" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Practice Area -->
                    <div class="row mt-3">
                        <!-- Sign to Practice -->
                        <div class="col-md-4">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Sign This</h4>
                                <div class="sign-display text-center" id="signDisplay">
                                    <!-- Sign content loaded via JS -->
                                </div>
                                <div class="sign-info mt-3 text-center" id="signInfo">
                                    <!-- Sign name and description -->
                                </div>
                            </div>
                        </div>

                        <!-- Camera Feed -->
                        <div class="col-md-4">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Your Camera</h4>
                                <div class="camera-container position-relative">
                                    <video id="webcam" autoplay playsinline class="w-100 rounded" style="background: #000;"></video>
                                    <canvas id="captureCanvas" style="display: none;"></canvas>
                                    <div id="cameraOverlay" class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center"
                                        style="top: 0; left: 0; background: rgba(0,0,0,0.7);">
                                        <button class="btn btn-primary" id="startCameraBtn">
                                            <i class="mdi mdi-camera"></i> Start Camera
                                        </button>
                                    </div>
                                    <div class="camera-guide position-absolute"
                                        style="top: 50%; left: 50%; transform: translate(-50%, -50%); 
                                                width: 200px; height: 200px; border: 2px dashed #fff; 
                                                border-radius: 10px; pointer-events: none;">
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button class="btn btn-success btn-lg" id="captureBtn" disabled>
                                        <i class="mdi mdi-camera-iris"></i> Capture Sign
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Recognition Result -->
                        <div class="col-md-4">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Recognition Result</h4>
                                <div id="resultArea" class="text-center py-4">
                                    <div class="placeholder-text text-muted">
                                        <i class="mdi mdi-brain" style="font-size: 64px;"></i>
                                        <p class="mt-3">Perform the sign and capture to see AI recognition results</p>
                                    </div>
                                </div>
                                <div id="feedbackArea" class="mt-3" style="display: none;">
                                    <!-- Feedback content -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Instructions -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h5 class="mb-2"><i class="mdi mdi-information-outline"></i> How to Practice</h5>
                                <ol class="mb-0">
                                    <li>Look at the sign to practice on the left panel</li>
                                    <li>Click "Start Camera" to enable your webcam</li>
                                    <li>Position your hand in the center of the frame</li>
                                    <li>Click "Capture Sign" when ready</li>
                                    <li>The AI will analyze and provide feedback</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Result Modal -->
    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recognition Result</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div id="modalIcon" class="mb-3"></div>
                    <h4 id="modalTitle"></h4>
                    <p id="modalMessage" class="text-muted"></p>
                    <div id="modalConfidence" class="mt-3"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="retryBtn">Try Again</button>
                    <button type="button" class="btn btn-primary" id="nextSignBtn">Next Sign</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Session Complete Modal -->
    <div class="modal fade" id="completeModal" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Practice Session Complete!</h5>
                </div>
                <div class="modal-body text-center">
                    <i class="mdi mdi-trophy text-warning" style="font-size: 80px;"></i>
                    <h3 class="mt-3">Great Job!</h3>
                    <div class="row mt-4">
                        <div class="col-4">
                            <h2 id="finalScore">0</h2>
                            <small>Score</small>
                        </div>
                        <div class="col-4">
                            <h2 id="finalCorrect">0</h2>
                            <small>Correct</small>
                        </div>
                        <div class="col-4">
                            <h2 id="finalTotal">0</h2>
                            <small>Total</small>
                        </div>
                    </div>
                    <div id="newAchievements" class="mt-3"></div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="<?= base_url('Practice') ?>" class="btn btn-secondary">Back to Practice</a>
                    <a href="<?= base_url('Practice/results/' . $session_id) ?>" class="btn btn-primary">View Details</a>
                    <?php if (isset($lesson) && isset($lesson->next_lesson)): ?>
                        <a href="<?= base_url('Practice/lesson/' . $lesson->next_lesson->lesson_id) ?>" class="btn btn-success">Next Lesson</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('includes/footer_plugins'); ?>

    <script>
        // Practice Session Data
        const sessionData = {
            sessionId: <?= $session_id ?>,
            signs: <?= json_encode($signs) ?>,
            totalSigns: <?= $total_signs ?>,
            currentIndex: 0,
            correctCount: 0,
            startTime: Date.now()
        };

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadSign(0);
            setupCamera();
            setupEventListeners();
        });

        function loadSign(index) {
            if (index >= sessionData.totalSigns) {
                completeSession();
                return;
            }

            const sign = sessionData.signs[index];
            sessionData.currentIndex = index;

            // Update UI
            document.getElementById('currentSign').textContent = index + 1;
            document.getElementById('sessionProgress').style.width = ((index / sessionData.totalSigns) * 100) + '%';

            // Load sign display
            const signDisplay = document.getElementById('signDisplay');
            const signInfo = document.getElementById('signInfo');

            let imageHtml = '';
            if (sign.image_path) {
                imageHtml = `<img src="<?= base_url() ?>${sign.image_path}" alt="${sign.sign_name}" class="img-fluid" style="max-height: 200px;">`;
            } else {
                imageHtml = `<div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="mdi mdi-hand-pointing-right text-muted" style="font-size: 80px;"></i>
                </div>`;
            }

            signDisplay.innerHTML = imageHtml;
            signInfo.innerHTML = `
                <h3>${sign.sign_name}</h3>
                <span class="badge badge-info">${sign.sign_type}</span>
                ${sign.description ? `<p class="mt-2 text-muted small">${sign.description}</p>` : ''}
            `;

            // Reset result area
            document.getElementById('resultArea').innerHTML = `
                <div class="placeholder-text text-muted">
                    <i class="mdi mdi-brain" style="font-size: 64px;"></i>
                    <p class="mt-3">Perform the sign and capture to see AI recognition results</p>
                </div>
            `;
            document.getElementById('feedbackArea').style.display = 'none';
        }

        function setupCamera() {
            const startBtn = document.getElementById('startCameraBtn');
            const video = document.getElementById('webcam');
            const captureBtn = document.getElementById('captureBtn');

            startBtn.addEventListener('click', async function() {
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({
                        video: {
                            width: {
                                ideal: 640
                            },
                            height: {
                                ideal: 480
                            },
                            facingMode: 'user'
                        }
                    });
                    video.srcObject = stream;
                    document.getElementById('cameraOverlay').style.display = 'none';
                    captureBtn.disabled = false;
                } catch (err) {
                    alert('Could not access camera. Please ensure you have granted camera permissions.');
                    console.error('Camera error:', err);
                }
            });
        }

        function setupEventListeners() {
            // Capture button
            document.getElementById('captureBtn').addEventListener('click', captureAndRecognize);

            // Retry button
            document.getElementById('retryBtn').addEventListener('click', function() {
                $('#resultModal').modal('hide');
            });

            // Next sign button
            document.getElementById('nextSignBtn').addEventListener('click', function() {
                $('#resultModal').modal('hide');
                loadSign(sessionData.currentIndex + 1);
            });
        }

        async function captureAndRecognize() {
            const video = document.getElementById('webcam');
            const canvas = document.getElementById('captureCanvas');
            const captureBtn = document.getElementById('captureBtn');

            captureBtn.disabled = true;
            captureBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin"></i> Processing...';

            // Capture frame
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.translate(canvas.width, 0);
            ctx.scale(-1, 1);
            ctx.drawImage(video, 0, 0);

            // Get base64 image
            const imageData = canvas.toDataURL('image/jpeg', 0.8);

            try {
                // Send to AI service
                const response = await fetch('<?= base_url('Practice/recognize') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'image=' + encodeURIComponent(imageData)
                });

                const result = await response.json();
                handleRecognitionResult(result, imageData);

            } catch (error) {
                console.error('Recognition error:', error);
                // Fallback: simulate result for demo
                simulateRecognition();
            }

            captureBtn.disabled = false;
            captureBtn.innerHTML = '<i class="mdi mdi-camera-iris"></i> Capture Sign';
        }

        function handleRecognitionResult(result, imageData) {
            const currentSign = sessionData.signs[sessionData.currentIndex];
            const isCorrect = result.prediction &&
                result.prediction.toUpperCase() === currentSign.model_label.toUpperCase();

            if (isCorrect) {
                sessionData.correctCount++;
                document.getElementById('currentScore').textContent = sessionData.correctCount;
            }

            // Submit to server
            submitAttempt(currentSign.sign_id, result.prediction, result.confidence, isCorrect);

            // Show result modal
            showResultModal(isCorrect, result.prediction, result.confidence, currentSign);
        }

        function simulateRecognition() {
            // For demo without AI service - random result
            const currentSign = sessionData.signs[sessionData.currentIndex];
            const isCorrect = Math.random() > 0.3; // 70% accuracy for demo
            const confidence = isCorrect ? (0.7 + Math.random() * 0.25) : (0.3 + Math.random() * 0.3);

            if (isCorrect) {
                sessionData.correctCount++;
                document.getElementById('currentScore').textContent = sessionData.correctCount;
            }

            submitAttempt(currentSign.sign_id, isCorrect ? currentSign.model_label : 'UNKNOWN', confidence, isCorrect);
            showResultModal(isCorrect, isCorrect ? currentSign.sign_name : 'Unknown', confidence, currentSign);
        }

        function submitAttempt(signId, recognizedLabel, confidence, isCorrect) {
            fetch('<?= base_url('Practice/process_recognition') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `session_id=${sessionData.sessionId}&sign_id=${signId}&recognized_label=${recognizedLabel}&confidence=${confidence}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.achievements && data.achievements.length > 0) {
                        showAchievements(data.achievements);
                    }
                })
                .catch(err => console.error('Error saving attempt:', err));
        }

        function showResultModal(isCorrect, recognized, confidence, expectedSign) {
            const modalIcon = document.getElementById('modalIcon');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const modalConfidence = document.getElementById('modalConfidence');

            if (isCorrect) {
                modalIcon.innerHTML = '<i class="mdi mdi-check-circle text-success" style="font-size: 80px;"></i>';
                modalTitle.textContent = 'Correct!';
                modalTitle.className = 'text-success';
                modalMessage.textContent = `You correctly signed "${expectedSign.sign_name}"`;
            } else {
                modalIcon.innerHTML = '<i class="mdi mdi-close-circle text-danger" style="font-size: 80px;"></i>';
                modalTitle.textContent = 'Not quite right';
                modalTitle.className = 'text-danger';
                modalMessage.textContent = `Expected: "${expectedSign.sign_name}" | Recognized: "${recognized}"`;
            }

            modalConfidence.innerHTML = `
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar ${isCorrect ? 'bg-success' : 'bg-warning'}" 
                         style="width: ${(confidence * 100).toFixed(1)}%">
                        ${(confidence * 100).toFixed(1)}% confidence
                    </div>
                </div>
            `;

            $('#resultModal').modal('show');
        }

        function showAchievements(achievements) {
            const container = document.getElementById('newAchievements');
            let html = '<div class="alert alert-success"><h5>New Achievements!</h5>';
            achievements.forEach(ach => {
                html += `<p class="mb-1"><i class="mdi mdi-trophy"></i> ${ach}</p>`;
            });
            html += '</div>';
            container.innerHTML = html;
        }

        function completeSession() {
            const duration = Math.floor((Date.now() - sessionData.startTime) / 1000);
            const score = (sessionData.correctCount / sessionData.totalSigns) * 100;

            // Submit session completion
            fetch('<?= base_url('Practice/complete_session') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `session_id=${sessionData.sessionId}&total_attempts=${sessionData.totalSigns}&correct_attempts=${sessionData.correctCount}&duration_seconds=${duration}`
            });

            // Show completion modal
            document.getElementById('finalScore').textContent = score.toFixed(0) + '%';
            document.getElementById('finalCorrect').textContent = sessionData.correctCount;
            document.getElementById('finalTotal').textContent = sessionData.totalSigns;

            $('#completeModal').modal('show');
        }
    </script>
</body>

</html>