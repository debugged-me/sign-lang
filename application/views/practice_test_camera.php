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
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <a href="<?= base_url('Practice') ?>" class="btn btn-primary">
                                        <i class="mdi mdi-arrow-left"></i> Back to Practice
                                    </a>
                                </div>
                                <h4 class="page-title">Camera Test</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Webcam Preview</h4>
                                <video id="webcam" autoplay playsinline class="w-100 rounded" style="background:#000; min-height: 360px;"></video>
                                <div class="mt-3">
                                    <button class="btn btn-primary" id="startCameraBtn">
                                        <i class="mdi mdi-camera"></i> Start Camera
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Status</h4>
                                <p class="text-muted mb-0" id="cameraStatus">Camera not started.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('includes/footer_plugins'); ?>
    <script>
        document.getElementById('startCameraBtn').addEventListener('click', async function() {
            const status = document.getElementById('cameraStatus');
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                document.getElementById('webcam').srcObject = stream;
                status.textContent = 'Camera connected.';
            } catch (error) {
                status.textContent = 'Unable to access camera: ' + error.message;
            }
        });
    </script>
</body>

</html>