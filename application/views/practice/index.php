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
                                <h4 class="page-title">Practice Mode</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Free Practice -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box bg-primary text-white">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h3 class="text-white">Free Practice</h3>
                                        <p class="mb-0">Practice with recommended signs based on your learning progress. Our AI will help you improve your signing accuracy.</p>
                                    </div>
                                    <div class="col-md-4 text-md-right">
                                        <a href="<?= base_url('Practice/free_practice') ?>" class="btn btn-light btn-lg">
                                            <i class="mdi mdi-camera"></i> Start Free Practice
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Practice by Category -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Practice by Category</h4>
                                <div class="row">
                                    <?php foreach ($categories as $category): ?>
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <a href="<?= base_url('Practice/category/' . $category->category_id) ?>" class="text-decoration-none">
                                            <div class="category-card p-4 border rounded text-center h-100">
                                                <i class="mdi mdi-folder-outline" style="font-size: 48px; color: #5b69bc;"></i>
                                                <h5 class="mt-3 mb-1"><?= $category->category_name ?></h5>
                                                <small class="text-muted">Practice signs</small>
                                            </div>
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Practice by Lesson -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="header-title m-0">Practice by Lesson</h4>
                                    <a href="<?= base_url('FSL/lessons') ?>" class="btn btn-sm btn-outline-primary">View All Lessons</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Lesson</th>
                                                <th>Difficulty</th>
                                                <th>Signs</th>
                                                <th>Duration</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($lessons as $lesson): ?>
                                            <tr>
                                                <td>
                                                    <strong><?= $lesson->lesson_title ?></strong>
                                                    <br><small class="text-muted"><?= substr($lesson->lesson_description, 0, 60) ?>...</small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-<?= $lesson->difficulty_level == 'beginner' ? 'success' : ($lesson->difficulty_level == 'intermediate' ? 'warning' : 'danger') ?>">
                                                        <?= ucfirst($lesson->difficulty_level) ?>
                                                    </span>
                                                </td>
                                                <td><?= $lesson->total_signs ?></td>
                                                <td><?= $lesson->estimated_duration ?> min</td>
                                                <td>
                                                    <a href="<?= base_url('Practice/lesson/' . $lesson->lesson_id) ?>" class="btn btn-sm btn-primary">
                                                        <i class="mdi mdi-play"></i> Practice
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Quick Practice Links</h4>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <a href="<?= base_url('FSL/alphabet') ?>" class="btn btn-outline-info btn-block">
                                            <i class="mdi mdi-alpha"></i> Learn Alphabet
                                        </a>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <a href="<?= base_url('FSL/numbers') ?>" class="btn btn-outline-info btn-block">
                                            <i class="mdi mdi-numeric"></i> Learn Numbers
                                        </a>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <a href="<?= base_url('Practice/history') ?>" class="btn btn-outline-secondary btn-block">
                                            <i class="mdi mdi-history"></i> Practice History
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('includes/footer_plugins'); ?>
</body>
</html>
