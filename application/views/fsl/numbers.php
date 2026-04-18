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
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <a href="<?= base_url('Practice/category/2') ?>" class="btn btn-primary">
                                        <i class="mdi mdi-play"></i> Practice Numbers
                                    </a>
                                </div>
                                <h4 class="page-title">FSL Numbers</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Numbers Grid -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Learn Numbers 0-9 in Filipino Sign Language</h4>
                                <p class="text-muted mb-4">Click on any number to view details and practice.</p>

                                <div class="row justify-content-center">
                                    <?php foreach ($numbers as $number): ?>
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                                            <a href="<?= base_url('FSL/sign_detail/' . $number->sign_id) ?>" class="text-decoration-none">
                                                <div class="card number-card h-100 text-center">
                                                    <div class="card-body">
                                                        <?php if ($number->image_path): ?>
                                                            <img src="<?= base_url($number->image_path) ?>" alt="<?= $number->sign_name ?>" class="img-fluid mb-2" style="max-height: 120px;">
                                                        <?php else: ?>
                                                            <div class="number-placeholder bg-light d-flex align-items-center justify-content-center mb-2 rounded" style="height: 120px;">
                                                                <span class="display-3 font-weight-bold text-primary"><?= $number->sign_name ?></span>
                                                            </div>
                                                        <?php endif; ?>
                                                        <h2 class="mb-0"><?= $number->sign_name ?></h2>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tips -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box bg-light">
                                <h5 class="mb-3"><i class="mdi mdi-lightbulb-outline"></i> Tips for Learning FSL Numbers</h5>
                                <ul class="mb-0">
                                    <li><strong>0-5 are simple:</strong> Most use a single hand with extended fingers</li>
                                    <li><strong>6-9 use touch:</strong> These numbers touch the thumb to different fingers</li>
                                    <li><strong>Practice counting:</strong> Try signing numbers in sequence</li>
                                    <li><strong>Use real scenarios:</strong> Practice signing your age, phone number, etc.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="<?= base_url('Practice/category/2') ?>" class="btn btn-success btn-lg mr-2">
                                <i class="mdi mdi-camera"></i> Practice with Camera
                            </a>
                            <a href="<?= base_url('FSL/dictionary?type=number') ?>" class="btn btn-outline-primary btn-lg">
                                <i class="mdi mdi-book-open"></i> View in Dictionary
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end content -->

    <?php $this->load->view('includes/footer'); ?>
    </div>
    <!-- End Page content -->
    </div>
    <!-- END wrapper -->

    <?php $this->load->view('includes/footer_plugins'); ?>
    <style>
        .number-card {
            transition: transform 0.2s;
        }

        .number-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</body>

</html>