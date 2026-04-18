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
                                    <a href="<?= base_url('Practice/category/1') ?>" class="btn btn-primary">
                                        <i class="mdi mdi-play"></i> Practice Alphabet
                                    </a>
                                </div>
                                <h4 class="page-title">FSL Alphabet</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Alphabet Grid -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Learn the Filipino Sign Language Alphabet (A-Z)</h4>
                                <p class="text-muted mb-4">Click on any letter to view details and practice.</p>

                                <div class="row">
                                    <?php foreach ($letters as $letter): ?>
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                                            <a href="<?= base_url('FSL/sign_detail/' . $letter->sign_id) ?>" class="text-decoration-none">
                                                <div class="card alphabet-card h-100 text-center">
                                                    <div class="card-body">
                                                        <?php if ($letter->image_path): ?>
                                                            <img src="<?= base_url($letter->image_path) ?>" alt="<?= $letter->sign_name ?>" class="img-fluid mb-2" style="max-height: 120px;">
                                                        <?php else: ?>
                                                            <div class="alphabet-placeholder bg-light d-flex align-items-center justify-content-center mb-2 rounded" style="height: 120px;">
                                                                <span class="display-4 font-weight-bold text-primary"><?= $letter->sign_name ?></span>
                                                            </div>
                                                        <?php endif; ?>
                                                        <h3 class="mb-0"><?= $letter->sign_name ?></h3>
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
                                <h5 class="mb-3"><i class="mdi mdi-lightbulb-outline"></i> Tips for Learning the FSL Alphabet</h5>
                                <ul class="mb-0">
                                    <li><strong>Start with A-G:</strong> Focus on one group of letters at a time</li>
                                    <li><strong>Practice hand positioning:</strong> Pay attention to finger placement</li>
                                    <li><strong>Use the practice mode:</strong> Test your signs with the AI recognition</li>
                                    <li><strong>Practice daily:</strong> Consistency is key to mastering FSL</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="<?= base_url('Practice/category/1') ?>" class="btn btn-success btn-lg mr-2">
                                <i class="mdi mdi-camera"></i> Practice with Camera
                            </a>
                            <a href="<?= base_url('FSL/dictionary?type=alphabet') ?>" class="btn btn-outline-primary btn-lg">
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
        .alphabet-card {
            transition: transform 0.2s;
        }

        .alphabet-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</body>

</html>