<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('includes/head'); ?>
<body>
    <div id="wrapper">
        <?php $this->load->view('includes/header'); ?>
        
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">FSL Categories</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Categories Grid -->
                    <div class="row">
                        <?php foreach ($categories as $category): ?>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card category-card h-100">
                                <div class="card-body text-center">
                                    <div class="category-icon mb-3">
                                        <i class="mdi mdi-folder-outline text-primary" style="font-size: 64px;"></i>
                                    </div>
                                    <h4 class="card-title"><?= $category->category_name ?></h4>
                                    <p class="card-text text-muted"><?= $category->category_description ?></p>
                                    <div class="mt-3">
                                        <span class="badge badge-info"><?= $category->sign_count ?> signs</span>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent text-center">
                                    <div class="btn-group">
                                        <a href="<?= base_url('FSL/category/' . $category->category_id) ?>" class="btn btn-outline-primary">Learn</a>
                                        <a href="<?= base_url('Practice/category/' . $category->category_id) ?>" class="btn btn-primary">Practice</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('includes/footer_plugins'); ?>
    <style>
        .category-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
    </style>
</body>
</html>
