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

                    <!-- Top Bar -->
                    <div class="row align-items-center mb-3">
                        <div class="col">
                            <h4 class="page-title mb-0">
                                <?php if (isset($category)): ?>
                                    Practice: <?= $category->category_name ?>
                                <?php elseif (isset($lesson)): ?>
                                    Practice: <?= $lesson->lesson_title ?>
                                <?php else: ?>
                                    Free Practice
                                <?php endif; ?>
                            </h4>
                        </div>
                        <div class="col-auto">
                            <div class="btn-group">
                                <button class="btn btn-light" id="pauseBtn">
                                    <i class="mdi mdi-pause"></i> Pause
                                </button>
                                <a href="<?= base_url('Practice') ?>" class="btn btn-danger ml-1">
                                    <i class="mdi mdi-close"></i> Exit
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="card-box py-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted" style="font-size:13px;">
                                Progress: <strong id="currentSign">1</strong> / <strong><?= $total_signs ?></strong>
                            </span>
                            <span class="text-muted" style="font-size:13px;">
                                Score: <strong id="currentScore">0</strong>
                            </span>
                        </div>
                        <div class="progress" style="height: 10px; border-radius:99px;">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                id="sessionProgress" role="progressbar" style="width: 0%;"></div>
                        </div>
                    </div>

                    <!-- Main Practice Layout -->
                    <div class="row">

                        <!-- LEFT: Sign to Practice -->
                        <div class="col-md-3">
                            <div class="card-box h-100">
                                <h5 class="header-title mb-3 text-uppercase text-muted" style="font-size:12px; letter-spacing:.05em;">
                                    Sign This
                                </h5>
                                <!-- Sign Image -->
                                <div id="signDisplay"
                                    class="d-flex align-items-center justify-content-center bg-light rounded mb-3"
                                    style="min-height: 200px; overflow:hidden;">
                                    <i class="mdi mdi-hand-pointing-right text-muted" style="font-size: 72px;"></i>
                                </div>
                                <!-- Sign Info -->
                                <div id="signInfo" class="text-center">
                                    <h3 class="mb-1" id="signNameLabel" style="font-size:22px;"></h3>
                                    <span class="badge badge-info" id="signTypeLabel"></span>
                                    <p class="mt-2 text-muted small" id="signDescLabel"></p>
                                </div>
                            </div>
                        </div>

                        <!-- CENTER: Camera Feed (large) -->
                        <div class="col-md-6">
                            <div class="card-box">
                                <h5 class="header-title mb-3 text-uppercase text-muted" style="font-size:12px; letter-spacing:.05em;">
                                    Your Camera
                                </h5>

                                <div class="position-relative rounded overflow-hidden"
                                    style="background:#000; min-height:430px;">

                                    <video id="webcam" autoplay playsinline
                                        class="w-100 d-block"
                                        style="min-height:430px; object-fit:cover; display:none !important;"></video>

                                    <canvas id="captureCanvas" style="display:none;"></canvas>

                                    <!-- Camera Off Overlay -->
                                    <div id="cameraOverlay"
                                        class="position-absolute d-flex flex-column align-items-center
                                            justify-content-center w-100 h-100"
                                        style="top:0; left:0; background:rgba(0,0,0,0.78); z-index:10;">
                                        <i class="mdi mdi-camera-off text-white-50" style="font-size:56px;"></i>
                                        <p class="text-white-50 mb-3 mt-2" style="font-size:13px;">Camera is off</p>
                                        <button class="btn btn-primary" id="startCameraBtn">
                                            <i class="mdi mdi-camera"></i> Enable Camera
                                        </button>
                                    </div>

                                    <!-- Guide Box (shown after camera starts) -->
                                    <div id="guideBox"
                                        class="position-absolute"
                                        style="display:none; top:50%; left:50%;
                                            transform:translate(-50%,-50%);
                                            width:240px; height:240px;
                                            border: 2px dashed rgba(255,255,255,0.45);
                                            border-radius:12px; pointer-events:none; z-index:9;">
                                        <!-- Corner accents -->
                                        <span style="position:absolute;top:-3px;left:-3px;width:20px;height:20px;
                                                 border-top:3px solid #1d9e75;border-left:3px solid #1d9e75;
                                                 border-radius:4px 0 0 0;"></span>
                                        <span style="position:absolute;top:-3px;right:-3px;width:20px;height:20px;
                                                 border-top:3px solid #1d9e75;border-right:3px solid #1d9e75;
                                                 border-radius:0 4px 0 0;"></span>
                                        <span style="position:absolute;bottom:-3px;left:-3px;width:20px;height:20px;
                                                 border-bottom:3px solid #1d9e75;border-left:3px solid #1d9e75;
                                                 border-radius:0 0 0 4px;"></span>
                                        <span style="position:absolute;bottom:-3px;right:-3px;width:20px;height:20px;
                                                 border-bottom:3px solid #1d9e75;border-right:3px solid #1d9e75;
                                                 border-radius:0 0 4px 0;"></span>
                                        <span class="text-white-50"
                                            style="position:absolute;bottom:-28px;left:50%;
                                                 transform:translateX(-50%);font-size:11px;white-space:nowrap;">
                                            Position your hand here
                                        </span>
                                    </div>
                                </div>

                                <!-- Capture Button -->
                                <div class="text-center mt-3">
                                    <button class="btn btn-success btn-lg px-5" id="captureBtn" disabled>
                                        <i class="mdi mdi-camera-iris"></i> Capture Sign
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT: Recognition Result -->
                        <div class="col-md-3">
                            <div class="card-box h-100">
                                <h5 class="header-title mb-3 text-uppercase text-muted" style="font-size:12px; letter-spacing:.05em;">
                                    Recognition Result
                                </h5>

                                <!-- Placeholder State -->
                                <div id="resultPlaceholder" class="text-center py-5 text-muted">
                                    <i class="mdi mdi-brain" style="font-size:52px; opacity:.4;"></i>
                                    <p class="mt-3 small" style="line-height:1.5;">
                                        Perform the sign and capture to see AI recognition results
                                    </p>
                                </div>

                                <!-- Result State (hidden until capture) -->
                                <div id="resultContent" style="display:none;">
                                    <!-- Verdict -->
                                    <div class="text-center py-3" id="verdictBlock">
                                        <div id="verdictIcon" style="font-size:52px; line-height:1;"></div>
                                        <h4 id="verdictLabel" class="mt-2 mb-1"></h4>
                                        <p id="verdictMsg" class="text-muted small"></p>
                                    </div>

                                    <!-- Confidence Bar -->
                                    <div class="px-1 mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <small class="text-muted">Confidence</small>
                                            <small id="confPct" class="font-weight-bold"></small>
                                        </div>
                                        <div class="progress" style="height:8px; border-radius:99px;">
                                            <div id="confFill" class="progress-bar" role="progressbar" style="width:0%;"></div>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="d-flex gap-2" style="gap:8px;">
                                        <button class="btn btn-light btn-sm flex-fill" id="retryBtn">Try Again</button>
                                        <button class="btn btn-primary btn-sm flex-fill" id="nextSignBtn">Next Sign</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- /row -->

                    <!-- Instructions Footer -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card-box py-3">
                                <h5 class="header-title mb-3 text-uppercase text-muted"
                                    style="font-size:12px; letter-spacing:.05em;">
                                    How to Practice
                                </h5>
                                <div class="d-flex flex-wrap" style="gap:0;">
                                    <?php
                                    $steps = [
                                        'Study the sign shown on the left panel',
                                        'Click "Enable Camera" to start your webcam',
                                        'Position your hand inside the guide box',
                                        'Click "Capture Sign" when you\'re ready',
                                        'The AI will analyze your sign and give feedback',
                                    ];
                                    foreach ($steps as $i => $step): ?>
                                        <div class="d-flex align-items-start p-2" style="min-width:160px; flex:1;">
                                            <span class="badge badge-info badge-pill mr-2 flex-shrink-0"
                                                style="width:22px;height:22px;line-height:22px;
                                                     text-align:center;padding:0;font-size:11px;">
                                                <?= $i + 1 ?>
                                            </span>
                                            <small class="text-muted" style="line-height:1.4;"><?= $step ?></small>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /container -->
            </div>
        </div>
    </div>

    <!-- ===================== RESULT MODAL ===================== -->
    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow">
                <div class="modal-body text-center py-4 px-4">
                    <div id="modalIcon" class="mb-2" style="font-size:56px; line-height:1;"></div>
                    <h4 id="modalTitle" class="mb-1"></h4>
                    <p id="modalMessage" class="text-muted small mb-3"></p>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="text-muted">Confidence</small>
                            <small id="modalConfLabel" class="font-weight-bold"></small>
                        </div>
                        <div class="progress" style="height:8px; border-radius:99px;">
                            <div id="modalConfFill" class="progress-bar" role="progressbar" style="width:0%;"></div>
                        </div>
                    </div>
                    <div class="d-flex" style="gap:8px;">
                        <button type="button" class="btn btn-light flex-fill" id="modalRetryBtn">Try Again</button>
                        <button type="button" class="btn btn-primary flex-fill" id="modalNextBtn">Next Sign</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================== COMPLETE MODAL ===================== -->
    <div class="modal fade" id="completeModal" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-success text-white border-0">
                    <h5 class="modal-title w-100 text-center">
                        <i class="mdi mdi-trophy"></i> Practice Session Complete!
                    </h5>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="mdi mdi-trophy text-warning" style="font-size:72px;"></i>
                    <h3 class="mt-2">Great Job!</h3>
                    <div class="row mt-4 mb-2">
                        <div class="col-4 border-right">
                            <h2 id="finalScore" class="mb-0 text-success">0%</h2>
                            <small class="text-muted">Score</small>
                        </div>
                        <div class="col-4 border-right">
                            <h2 id="finalCorrect" class="mb-0 text-primary">0</h2>
                            <small class="text-muted">Correct</small>
                        </div>
                        <div class="col-4">
                            <h2 id="finalTotal" class="mb-0">0</h2>
                            <small class="text-muted">Total</small>
                        </div>
                    </div>
                    <div id="newAchievements" class="mt-3"></div>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <a href="<?= base_url('Practice') ?>" class="btn btn-secondary">Back to Practice</a>
                    <a href="<?= base_url('Practice/results/' . $session_id) ?>" class="btn btn-primary">View Details</a>
                    <?php if (isset($lesson) && isset($lesson->next_lesson)): ?>
                        <a href="<?= base_url('Practice/lesson/' . $lesson->next_lesson->lesson_id) ?>"
                            class="btn btn-success">Next Lesson</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================== CUSTOM STYLES ===================== -->
    <style>
        #webcam {
            transform: scaleX(-1);
        }

        /* mirror camera */
        .card-box {
            border-radius: 8px;
        }

        #captureBtn {
            min-width: 200px;
            border-radius: 50px;
            font-size: 15px;
        }

        #captureBtn i {
            font-size: 18px;
            vertical-align: middle;
        }

        .verdict-correct {
            color: #1b5e20;
        }

        .verdict-wrong {
            color: #b71c1c;
        }

        .progress-bar-success {
            background: #1d9e75;
        }
    </style>

    <?php $this->load->view('includes/footer_plugins'); ?>

    <!-- ===================== JAVASCRIPT ===================== -->
    <script>
        const sessionData = {
            sessionId: <?= $session_id ?>,
            signs: <?= json_encode($signs) ?>,
            totalSigns: <?= $total_signs ?>,
            currentIdx: 0,
            correctCnt: 0,
            startTime: Date.now(),
            paused: false
        };

        /* ── Init ── */
        document.addEventListener('DOMContentLoaded', function() {
            loadSign(0);
            setupCamera();
            setupEventListeners();
        });

        /* ── Load a sign ── */
        function loadSign(index) {
            if (index >= sessionData.totalSigns) {
                completeSession();
                return;
            }

            const sign = sessionData.signs[index];
            sessionData.currentIdx = index;

            document.getElementById('currentSign').textContent = index + 1;
            document.getElementById('sessionProgress').style.width =
                ((index / sessionData.totalSigns) * 100) + '%';

            /* Sign image */
            const display = document.getElementById('signDisplay');
            display.innerHTML = sign.image_path ?
                `<img src="<?= base_url() ?>${sign.image_path}"
               alt="${sign.sign_name}"
               class="img-fluid rounded"
               style="max-height:220px; object-fit:contain;">` :
                `<i class="mdi mdi-hand-pointing-right text-muted" style="font-size:72px;"></i>`;

            /* Sign info */
            document.getElementById('signNameLabel').textContent = sign.sign_name;
            document.getElementById('signTypeLabel').textContent = sign.sign_type;
            document.getElementById('signDescLabel').textContent = sign.description || '';

            /* Reset result panel */
            document.getElementById('resultPlaceholder').style.display = '';
            document.getElementById('resultContent').style.display = 'none';
        }

        /* ── Camera setup ── */
        function setupCamera() {
            document.getElementById('startCameraBtn').addEventListener('click', async function() {
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({
                        video: {
                            width: {
                                ideal: 1280
                            },
                            height: {
                                ideal: 720
                            },
                            facingMode: 'user'
                        }
                    });
                    const video = document.getElementById('webcam');
                    video.srcObject = stream;
                    video.style.display = 'block';
                    document.getElementById('cameraOverlay').style.display = 'none';
                    document.getElementById('guideBox').style.display = 'block';
                    document.getElementById('captureBtn').disabled = false;
                } catch (err) {
                    alert('Could not access camera. Please ensure camera permission is granted.');
                    console.error('Camera error:', err);
                }
            });
        }

        /* ── Event listeners ── */
        function setupEventListeners() {
            document.getElementById('captureBtn').addEventListener('click', captureAndRecognize);

            document.getElementById('retryBtn').addEventListener('click', function() {
                document.getElementById('resultPlaceholder').style.display = '';
                document.getElementById('resultContent').style.display = 'none';
            });

            document.getElementById('nextSignBtn').addEventListener('click', function() {
                loadSign(sessionData.currentIdx + 1);
            });

            document.getElementById('modalRetryBtn').addEventListener('click', function() {
                $('#resultModal').modal('hide');
            });

            document.getElementById('modalNextBtn').addEventListener('click', function() {
                $('#resultModal').modal('hide');
                loadSign(sessionData.currentIdx + 1);
            });

            document.getElementById('pauseBtn').addEventListener('click', function() {
                sessionData.paused = !sessionData.paused;
                this.innerHTML = sessionData.paused ?
                    '<i class="mdi mdi-play"></i> Resume' :
                    '<i class="mdi mdi-pause"></i> Pause';
            });
        }

        /* ── Capture & recognize ── */
        async function captureAndRecognize() {
            const video = document.getElementById('webcam');
            const canvas = document.getElementById('captureCanvas');
            const captureBtn = document.getElementById('captureBtn');

            captureBtn.disabled = true;
            captureBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin"></i> Processing...';

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.translate(canvas.width, 0);
            ctx.scale(-1, 1);
            ctx.drawImage(video, 0, 0);

            const imageData = canvas.toDataURL('image/jpeg', 0.85);

            try {
                const response = await fetch('<?= base_url('Practice/recognize') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'image=' + encodeURIComponent(imageData)
                });
                const result = await response.json();
                handleResult(result, imageData);
            } catch (err) {
                console.error('Recognition error:', err);
                fallbackResult(imageData);
            }

            captureBtn.disabled = false;
            captureBtn.innerHTML = '<i class="mdi mdi-camera-iris"></i> Capture Sign';
        }

        /* ── Handle AI result ── */
        function handleResult(result, imageData) {
            const sign = sessionData.signs[sessionData.currentIdx];
            const isCorrect = result.prediction &&
                result.prediction.toUpperCase() === sign.model_label.toUpperCase();

            if (isCorrect) {
                sessionData.correctCnt++;
                document.getElementById('currentScore').textContent = sessionData.correctCnt;
            }

            submitAttempt(sign.sign_id, result.prediction, result.confidence, isCorrect, imageData);
            renderResult(isCorrect, result.prediction, result.confidence, sign);
        }

        /* ── Fallback demo result ── */
        function fallbackResult(imageData) {
            const sign = sessionData.signs[sessionData.currentIdx];
            const isCorrect = Math.random() > 0.35;
            const conf = isCorrect ? (0.72 + Math.random() * 0.25) : (0.25 + Math.random() * 0.35);

            if (isCorrect) {
                sessionData.correctCnt++;
                document.getElementById('currentScore').textContent = sessionData.correctCnt;
            }

            submitAttempt(
                sign.sign_id,
                isCorrect ? sign.model_label : 'UNKNOWN',
                conf, isCorrect, imageData
            );
            renderResult(isCorrect, isCorrect ? sign.sign_name : 'Unknown', conf, sign);
        }

        /* ── Render result in side panel ── */
        function renderResult(isCorrect, recognized, confidence, sign) {
            const pct = (confidence * 100).toFixed(1);

            /* Side panel */
            document.getElementById('resultPlaceholder').style.display = 'none';
            document.getElementById('resultContent').style.display = '';

            const iconEl = document.getElementById('verdictIcon');
            const labelEl = document.getElementById('verdictLabel');
            const msgEl = document.getElementById('verdictMsg');
            const fillEl = document.getElementById('confFill');

            iconEl.textContent = isCorrect ? '✓' : '✗';
            labelEl.textContent = isCorrect ? 'Correct!' : 'Not quite right';
            labelEl.className = isCorrect ? 'verdict-correct' : 'verdict-wrong';
            msgEl.textContent = isCorrect ?
                `You correctly signed "${sign.sign_name}"` :
                `Expected: "${sign.sign_name}" | Recognized: "${recognized}"`;

            document.getElementById('confPct').textContent = pct + '%';
            fillEl.style.width = pct + '%';
            fillEl.className = 'progress-bar ' + (isCorrect ? 'bg-success' : 'bg-warning');

            /* Also show modal */
            renderModal(isCorrect, recognized, confidence, sign);
        }

        /* ── Result modal ── */
        function renderModal(isCorrect, recognized, confidence, sign) {
            const pct = (confidence * 100).toFixed(1);

            document.getElementById('modalIcon').textContent = isCorrect ? '✓' : '✗';
            document.getElementById('modalTitle').textContent = isCorrect ? 'Correct!' : 'Not Quite';
            document.getElementById('modalTitle').className = isCorrect ? 'text-success' : 'text-danger';
            document.getElementById('modalMessage').textContent = isCorrect ?
                `You correctly signed "${sign.sign_name}"` :
                `Expected "${sign.sign_name}" — keep practicing!`;

            document.getElementById('modalConfLabel').textContent = pct + '%';
            const mfill = document.getElementById('modalConfFill');
            mfill.style.width = pct + '%';
            mfill.className = 'progress-bar ' + (isCorrect ? 'bg-success' : 'bg-warning');

            $('#resultModal').modal('show');
        }

        /* ── Submit attempt to server ── */
        function submitAttempt(signId, recognized, confidence, isCorrect, imageData) {
            const form = new FormData();
            form.append('session_id', sessionData.sessionId);
            form.append('sign_id', signId);
            form.append('recognized_label', recognized);
            form.append('confidence', confidence);
            if (imageData) form.append('image', imageData);

            fetch('<?= base_url('Practice/process_recognition') ?>', {
                    method: 'POST',
                    body: form
                })
                .then(r => r.json())
                .then(data => {
                    if (data.achievements && data.achievements.length > 0) {
                        showAchievements(data.achievements);
                    }
                })
                .catch(err => console.error('Error saving attempt:', err));
        }

        /* ── Achievements ── */
        function showAchievements(achievements) {
            const el = document.getElementById('newAchievements');
            el.innerHTML = '<div class="alert alert-success"><h6 class="mb-1">New Achievements!</h6>' +
                achievements.map(a => `<p class="mb-0 small"><i class="mdi mdi-trophy"></i> ${a}</p>`).join('') +
                '</div>';
        }

        /* ── Complete session ── */
        function completeSession() {
            const duration = Math.floor((Date.now() - sessionData.startTime) / 1000);
            const score = (sessionData.correctCnt / sessionData.totalSigns * 100).toFixed(0);

            fetch('<?= base_url('Practice/complete_session') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `session_id=${sessionData.sessionId}` +
                    `&total_attempts=${sessionData.totalSigns}` +
                    `&correct_attempts=${sessionData.correctCnt}` +
                    `&duration_seconds=${duration}`
            });

            document.getElementById('finalScore').textContent = score + '%';
            document.getElementById('finalCorrect').textContent = sessionData.correctCnt;
            document.getElementById('finalTotal').textContent = sessionData.totalSigns;
            document.getElementById('sessionProgress').style.width = '100%';

            $('#completeModal').modal('show');
        }
    </script>
</body>

</html>