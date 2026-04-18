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
                    <!-- Breadcrumb -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?= base_url('FSL/categories') ?>">Categories</a></li>
                                        <li class="breadcrumb-item active"><?= $category->category_name ?></li>
                                    </ol>
                                </div>
                                <h4 class="page-title"><?= $category->category_name ?></h4>
                            </div>
                        </div>
                    </div>

                    <!-- Category Info -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h5><?= $category->category_name ?></h5>
                                        <p class="text-muted mb-0"><?= $category->category_description ?></p>
                                    </div>
                                    <div class="col-md-4 text-md-right">
                                        <span class="badge badge-primary badge-pill"><?= count($signs) ?> Signs</span>
                                        <a href="<?= base_url('Practice/category/' . $category->category_id) ?>" class="btn btn-success ml-2">
                                            <i class="mdi mdi-play"></i> Practice All
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Signs Grid -->
                    <div class="row">
                        <?php foreach ($signs as $sign): ?>
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                                <div class="card sign-card h-100">
                                    <div class="card-body text-center">
                                        <?php if ($sign->image_path && file_exists(FCPATH . $sign->image_path)): ?>
                                            <img src="<?= base_url($sign->image_path) ?>" alt="<?= $sign->sign_name ?>" class="img-fluid mb-2" style="max-height: 100px;">
                                        <?php else: ?>
                                            <div class="sign-placeholder bg-light d-flex align-items-center justify-content-center mb-2 rounded" style="height: 100px;">
                                                <i class="mdi mdi-hand-pointing-right text-muted" style="font-size: 40px;"></i>
                                            </div>
                                        <?php endif; ?>
                                        <h6 class="card-title mb-1"><?= $sign->sign_name ?></h6>
                                        <span class="badge badge-info"><?= ucfirst($sign->sign_type) ?></span>
                                    </div>
                                    <div class="card-footer text-center p-2">
                                        <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="btn btn-sm btn-outline-primary">View</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if (empty($signs)): ?>
                        <div class="row">
                            <div class="col-12 text-center py-5">
                                <i class="mdi mdi-folder-open-outline" style="font-size: 64px; color: #ccc;"></i>
                                <h4 class="mt-3 text-muted">No signs in this category</h4>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('includes/footer_plugins'); ?>
</body>

</html>