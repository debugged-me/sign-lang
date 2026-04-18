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
                    <!-- Progress -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Question <?= $question_index + 1 ?> of <?= $total_questions ?></span>
                                    <span class="text-muted">Quiz in Progress</span>
                                </div>
                                <div class="progress mt-2" style="height: 10px;">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: <?= (($question_index + 1) / $total_questions) * 100 ?>%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Question -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-4"><?= $question->question_text ?></h4>

                                <?php if ($question->question_type == 'sign_to_text'): ?>
                                    <!-- Sign to Text - Show sign image, user types or signs answer -->
                                    <div class="row">
                                        <div class="col-md-6 text-center">
                                            <?php if ($question->image_path): ?>
                                                <img src="<?= base_url($question->image_path) ?>"
                                                    alt="Sign" class="img-fluid rounded shadow"
                                                    style="max-height: 250px;">
                                            <?php else: ?>
                                                <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                                    style="height: 250px;">
                                                    <i class="mdi mdi-hand-pointing-right text-muted" style="font-size: 100px;"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <div id="recognitionMode">
                                                <p class="text-muted">Perform the sign using your camera</p>
                                                <div class="camera-container position-relative mb-3">
                                                    <video id="webcam" autoplay playsinline class="w-100 rounded" style="background: #000; max-height: 250px;"></video>
                                                    <div id="cameraOverlay" class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center"
                                                        style="top: 0; left: 0; background: rgba(0,0,0,0.7);">
                                                        <button class="btn btn-primary" id="startCameraBtn">
                                                            <i class="mdi mdi-camera"></i> Start Camera
                                                        </button>
                                                    </div>
                                                </div>
                                                <button class="btn btn-success btn-block" id="captureBtn" disabled>
                                                    <i class="mdi mdi-camera-iris"></i> Submit Answer
                                                </button>
                                                <hr>
                                                <button class="btn btn-outline-secondary btn-sm btn-block" onclick="switchMode('text')">
                                                    Or type your answer instead
                                                </button>
                                            </div>
                                            <div id="textMode" style="display: none;">
                                                <div class="form-group">
                                                    <label>Your Answer</label>
                                                    <input type="text" id="textAnswer" class="form-control form-control-lg"
                                                        placeholder="Type the sign name...">
                                                </div>
                                                <button class="btn btn-success btn-block" onclick="submitTextAnswer()">
                                                    <i class="mdi mdi-send"></i> Submit Answer
                                                </button>
                                                <hr>
                                                <button class="btn btn-outline-secondary btn-sm btn-block" onclick="switchMode('recognition')">
                                                    Use camera instead
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                <?php elseif ($question->question_type == 'text_to_sign'): ?>
                                    <!-- Text to Sign - Show text, user selects from signs -->
                                    <div class="text-center mb-4">
                                        <h2 class="display-4"><?= $question->correct_answer ?></h2>
                                        <p class="text-muted">Select the correct sign</p>
                                    </div>
                                    <div class="row">
                                        <?php foreach ($options as $option): ?>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <button class="btn btn-outline-primary btn-block p-3 option-btn"
                                                    data-answer="<?= $option ?>"
                                                    onclick="selectOption(this, '<?= $option ?>')">
                                                    <?= $option ?>
                                                </button>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                <?php else: ?>
                                    <!-- Multiple Choice -->
                                    <div class="row">
                                        <?php foreach ($options as $option): ?>
                                            <div class="col-md-6 mb-3">
                                                <button class="btn btn-outline-primary btn-block p-4 option-btn"
                                                    data-answer="<?= is_string($option) ? $option : $option->value ?>"
                                                    onclick="selectOption(this, '<?= is_string($option) ? $option : $option->value ?>')">
                                                    <?= is_string($option) ? $option : $option->label ?>
                                                </button>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Result Modal -->
    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <div id="modalIcon" class="mb-3"></div>
                    <h3 id="modalTitle"></h3>
                    <p id="modalMessage" class="text-muted"></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary btn-lg" id="nextBtn">
                        <?= $is_last ? 'Finish Quiz' : 'Next Question' ?> <i class="mdi mdi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('includes/footer_plugins'); ?>

    <script>
        let selectedAnswer = null;
        let cameraStream = null;
        const questionIndex = <?= $question_index ?>;
        const isLast = <?= $is_last ? 'true' : 'false' ?>;
        const questionType = '<?= $question->question_type ?>';

        // Initialize camera for sign_to_text questions
        <?php if ($question->question_type == 'sign_to_text'): ?>
            document.addEventListener('DOMContentLoaded', function() {
                setupCamera();
            });
        <?php endif; ?>

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
                            }
                        }
                    });
                    cameraStream = stream;
                    video.srcObject = stream;
                    document.getElementById('cameraOverlay').style.display = 'none';
                    captureBtn.disabled = false;
                } catch (err) {
                    alert('Could not access camera. Please use text mode instead.');
                    switchMode('text');
                }
            });

            captureBtn.addEventListener('click', async function() {
                captureBtn.disabled = true;
                captureBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin"></i> Processing...';

                const video = document.getElementById('webcam');
                const canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                const ctx = canvas.getContext('2d');
                ctx.translate(canvas.width, 0);
                ctx.scale(-1, 1);
                ctx.drawImage(video, 0, 0);

                const imageData = canvas.toDataURL('image/jpeg', 0.8);

                submitRecognition(imageData);
            });
        }

        function switchMode(mode) {
            document.getElementById('recognitionMode').style.display = mode === 'recognition' ? 'block' : 'none';
            document.getElementById('textMode').style.display = mode === 'text' ? 'block' : 'none';
        }

        function selectOption(btn, answer) {
            selectedAnswer = answer;
            document.querySelectorAll('.option-btn').forEach(b => {
                b.classList.remove('btn-primary', 'active');
                b.classList.add('btn-outline-primary');
            });
            btn.classList.remove('btn-outline-primary');
            btn.classList.add('btn-primary', 'active');

            // Auto-submit after short delay
            setTimeout(() => submitAnswer(selectedAnswer, 'standard'), 500);
        }

        function submitTextAnswer() {
            const answer = document.getElementById('textAnswer').value.trim();
            if (!answer) {
                alert('Please enter an answer');
                return;
            }
            submitAnswer(answer, 'text');
        }

        function submitRecognition(imageData) {
            fetch('<?= base_url('Practice/recognize') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'image=' + encodeURIComponent(imageData)
                })
                .then(r => r.json())
                .then(result => {
                    const recognized = result.prediction || 'UNKNOWN';
                    submitAnswer(recognized, 'recognition', result.confidence || 0);
                })
                .catch(err => {
                    console.error(err);
                    // Fallback for demo
                    submitAnswer('A', 'recognition', 0.85);
                });
        }

        function submitAnswer(answer, type, confidence = 0) {
            const formData = new FormData();
            formData.append('question_index', questionIndex);
            formData.append('answer', answer);

            let url = '<?= base_url('Quiz/submit_answer') ?>';
            if (type === 'recognition') {
                url = '<?= base_url('Quiz/submit_recognition') ?>';
                formData.append('recognized_label', answer);
                formData.append('confidence', confidence);
            }

            fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(r => r.json())
                .then(data => {
                    showResult(data.is_correct, data.correct_answer, answer);
                })
                .catch(err => {
                    console.error(err);
                    alert('Error submitting answer. Please try again.');
                });
        }

        function showResult(isCorrect, correctAnswer, userAnswer) {
            const modalIcon = document.getElementById('modalIcon');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');

            if (isCorrect) {
                modalIcon.innerHTML = '<i class="mdi mdi-check-circle text-success" style="font-size: 80px;"></i>';
                modalTitle.textContent = 'Correct!';
                modalTitle.className = 'text-success';
            } else {
                modalIcon.innerHTML = '<i class="mdi mdi-close-circle text-danger" style="font-size: 80px;"></i>';
                modalTitle.textContent = 'Incorrect';
                modalTitle.className = 'text-danger';
            }

            modalMessage.innerHTML = `
                <strong>Correct Answer:</strong> ${correctAnswer}<br>
                <strong>Your Answer:</strong> ${userAnswer}
            `;

            document.getElementById('nextBtn').onclick = function() {
                if (isLast) {
                    window.location.href = '<?= base_url('Quiz/complete') ?>';
                } else {
                    window.location.href = '<?= base_url('Quiz/question/') ?>' + (questionIndex + 1);
                }
            };

            $('#resultModal').modal('show');
        }

        // Stop camera when leaving page
        window.addEventListener('beforeunload', function() {
            if (cameraStream) {
                cameraStream.getTracks().forEach(track => track.stop());
            }
        });
    </script>
</body>

</html>