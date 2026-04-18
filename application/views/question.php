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
                    <!-- Progress Header -->
                    <div class="sl-card mb-4">
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="sl-section-subtitle">Question <?= $question_index + 1 ?> of <?= $total_questions ?></span>
                                    <h4 class="font-weight-bold mb-0" style="color: var(--sl-text);">Quiz in Progress</h4>
                                </div>
                                <div class="sl-badge" style="background: rgba(245, 158, 11, 0.1); color: var(--sl-accent);">
                                    <i class="mdi mdi-trophy mr-1"></i>Challenge Mode
                                </div>
                            </div>
                            <div class="sl-progress" style="height: 12px;">
                                <div class="sl-progress-bar" style="width: <?= (($question_index + 1) / $total_questions) * 100 ?>%; background: linear-gradient(90deg, var(--sl-accent) 0%, #FBBF24 100%);"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Question Card -->
                    <div class="sl-practice-card">
                        <div class="text-center mb-4">
                            <h3 class="font-weight-bold mb-2" style="color: var(--sl-text); font-size: 1.5rem;">
                                <?= $question->question_text ?>
                            </h3>
                        </div>

                        <?php if ($question->question_type == 'sign_to_text'): ?>
                            <!-- Sign to Text -->
                            <div class="row">
                                <div class="col-lg-6 mb-4 mb-lg-0">
                                    <div class="sl-sign-display" style="height: 320px;">
                                        <?php if ($question->image_path): ?>
                                            <img src="<?= base_url($question->image_path) ?>" alt="Sign" class="img-fluid" style="max-height: 280px;">
                                        <?php else: ?>
                                            <i class="mdi mdi-hand-pointing-right" style="font-size: 100px; color: #CBD5E1;"></i>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div id="recognitionMode">
                                        <div class="text-center mb-3">
                                            <div class="sl-camera-container mb-3" style="height: 240px;">
                                                <video id="webcam" autoplay playsinline class="w-100 h-100" style="object-fit: cover;"></video>
                                                <div id="cameraOverlay" class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center" style="top: 0; left: 0; background: rgba(0,0,0,0.7); border-radius: var(--sl-radius);">
                                                    <button class="sl-btn sl-btn-primary" id="startCameraBtn">
                                                        <i class="mdi mdi-camera mr-2"></i>Start Camera
                                                    </button>
                                                </div>
                                                <div class="position-absolute" style="top: 50%; left: 50%; transform: translate(-50%, -50%); width: 180px; height: 180px; border: 3px dashed rgba(255,255,255,0.5); border-radius: 12px; pointer-events: none;"></div>
                                            </div>
                                        </div>
                                        <button class="sl-btn sl-btn-success w-100 mb-3" id="captureBtn" disabled>
                                            <i class="mdi mdi-camera-iris mr-2"></i>Submit Answer
                                        </button>
                                        <button class="sl-btn sl-btn-outline w-100" onclick="switchMode('text')" style="padding: 10px 20px; font-size: 0.875rem;">
                                            <i class="mdi mdi-keyboard mr-2"></i>Or type your answer
                                        </button>
                                    </div>
                                    <div id="textMode" style="display: none;">
                                        <div class="mb-4">
                                            <label class="d-block font-weight-semibold mb-2" style="color: var(--sl-text);">Your Answer</label>
                                            <input type="text" id="textAnswer" class="form-control form-control-lg"
                                                placeholder="Type the sign name..."
                                                style="border-radius: 12px; border: 2px solid var(--sl-border); font-size: 1.1rem; padding: 16px;">
                                        </div>
                                        <button class="sl-btn sl-btn-success w-100 mb-3" onclick="submitTextAnswer()">
                                            <i class="mdi mdi-send mr-2"></i>Submit Answer
                                        </button>
                                        <button class="sl-btn sl-btn-outline w-100" onclick="switchMode('recognition')" style="padding: 10px 20px; font-size: 0.875rem;">
                                            <i class="mdi mdi-camera mr-2"></i>Use camera instead
                                        </button>
                                    </div>
                                </div>
                            </div>

                        <?php elseif ($question->question_type == 'text_to_sign'): ?>
                            <!-- Text to Sign -->
                            <div class="text-center mb-5">
                                <div class="p-4 rounded mb-4" style="background: linear-gradient(135deg, #F1F5F9 0%, #E2E8F0 100%); display: inline-block;">
                                    <h1 class="font-weight-bold m-0" style="font-size: 4rem; color: var(--sl-primary);">
                                        <?= $question->correct_answer ?>
                                    </h1>
                                </div>
                                <p style="color: var(--sl-text-muted);">Select the correct sign from the options below</p>
                            </div>
                            <div class="row">
                                <?php foreach ($options as $option): ?>
                                    <div class="col-md-3 col-6 mb-3">
                                        <button class="sl-btn sl-btn-outline w-100 p-4 option-btn" style="height: auto; font-size: 1.1rem;"
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
                                        <button class="sl-btn sl-btn-outline w-100 p-4 option-btn text-left" style="height: auto; font-size: 1.1rem;"
                                            data-answer="<?= is_string($option) ? $option : $option->value ?>"
                                            onclick="selectOption(this, '<?= is_string($option) ? $option : $option->value ?>')">
                                            <span class="rounded-circle d-inline-flex align-items-center justify-content-center mr-3" style="width: 36px; height: 36px; background: rgba(37, 99, 235, 0.1); color: var(--sl-primary);">
                                                <?= chr(65 + $loop->index) ?>
                                            </span>
                                            <?= is_string($option) ? $option : $option->label ?>
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <?php $this->load->view('includes/footer'); ?>
        </div>
    </div>

    <!-- Result Modal -->
    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: var(--sl-radius); border: none; box-shadow: var(--sl-shadow-lg);">
                <div class="modal-body text-center p-5">
                    <div id="modalIcon" class="mb-4"></div>
                    <h3 id="modalTitle" class="font-weight-bold mb-3"></h3>
                    <p id="modalMessage" style="color: var(--sl-text-muted);"></p>
                </div>
                <div class="modal-footer justify-content-center pb-5 pt-0 border-0">
                    <button type="button" class="sl-btn sl-btn-primary btn-lg" id="nextBtn" style="padding: 16px 32px; font-size: 1.1rem;">
                        <?= $is_last ? 'Finish Quiz' : 'Next Question' ?> <i class="mdi mdi-arrow-right ml-2"></i>
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
                captureBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin mr-2"></i>Processing...';

                const canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                const ctx = canvas.getContext('2d');
                ctx.translate(canvas.width, 0);
                ctx.scale(-1, 1);
                ctx.drawImage(video, 0, 0);

                submitRecognition(canvas.toDataURL('image/jpeg', 0.8));
            });
        }

        function switchMode(mode) {
            document.getElementById('recognitionMode').style.display = mode === 'recognition' ? 'block' : 'none';
            document.getElementById('textMode').style.display = mode === 'text' ? 'block' : 'none';
        }

        function selectOption(btn, answer) {
            selectedAnswer = answer;
            document.querySelectorAll('.option-btn').forEach(b => {
                b.style.background = '';
                b.style.color = '';
                b.style.borderColor = '';
            });
            btn.style.background = 'var(--sl-primary)';
            btn.style.color = 'white';
            btn.style.borderColor = 'var(--sl-primary)';
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
                    submitAnswer(result.prediction || 'UNKNOWN', 'recognition', result.confidence || 0);
                })
                .catch(err => {
                    console.error(err);
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
                .then(data => showResult(data.is_correct, data.correct_answer, answer))
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
                modalIcon.innerHTML = '<div class="rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px; background: rgba(16, 185, 129, 0.1);"><i class="mdi mdi-check" style="font-size: 60px; color: var(--sl-success);"></i></div>';
                modalTitle.textContent = 'Correct!';
                modalTitle.style.color = 'var(--sl-success)';
            } else {
                modalIcon.innerHTML = '<div class="rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px; background: rgba(239, 68, 68, 0.1);"><i class="mdi mdi-close" style="font-size: 60px; color: var(--sl-danger);"></i></div>';
                modalTitle.textContent = 'Not Quite';
                modalTitle.style.color = 'var(--sl-danger)';
            }

            modalMessage.innerHTML = `
                <div class="mb-2"><strong style="color: var(--sl-text);">Correct Answer:</strong> <span style="color: var(--sl-success);">${correctAnswer}</span></div>
                <div><strong style="color: var(--sl-text);">Your Answer:</strong> <span style="color: ${isCorrect ? 'var(--sl-success)' : 'var(--sl-danger)'};">${userAnswer}</span></div>
            `;

            document.getElementById('nextBtn').onclick = function() {
                window.location.href = isLast ? '<?= base_url('Quiz/complete') ?>' : '<?= base_url('Quiz/question/') ?>' + (questionIndex + 1);
            };

            $('#resultModal').modal('show');
        }

        window.addEventListener('beforeunload', function() {
            if (cameraStream) cameraStream.getTracks().forEach(track => track.stop());
        });
    </script>
</body>

</html>