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
                                <h4 class="page-title">Filipino Sign Language Learning Dashboard</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card-box widget-box-two widget-two-custom">
                                <div class="wigdet-two-content">
                                    <p class="m-0 text-uppercase font-bold font-secondary text-overflow">Signs Learned</p>
                                    <h2 class="font-600"><span data-plugin="counterup"><?= $stats['total_learned'] ?></span></h2>
                                    <p class="m-0">of <?= $stats['total_learned'] + 10 ?> total</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-box widget-box-two widget-two-custom">
                                <div class="wigdet-two-content">
                                    <p class="m-0 text-uppercase font-bold font-secondary text-overflow">Mastered</p>
                                    <h2 class="font-600"><span data-plugin="counterup"><?= $stats['mastered'] ?></span></h2>
                                    <p class="m-0">Keep practicing!</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-box widget-box-two widget-two-custom">
                                <div class="wigdet-two-content">
                                    <p class="m-0 text-uppercase font-bold font-secondary text-overflow">Practice Sessions</p>
                                    <h2 class="font-600"><span data-plugin="counterup"><?= $stats['total_sessions'] ?></span></h2>
                                    <p class="m-0">completed</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-box widget-box-two widget-two-custom">
                                <div class="wigdet-two-content">
                                    <p class="m-0 text-uppercase font-bold font-secondary text-overflow">Accuracy</p>
                                    <h2 class="font-600"><span data-plugin="counterup"><?= $stats['overall_accuracy'] ?></span>%</h2>
                                    <p class="m-0">overall score</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Quick Actions</h4>
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <a href="<?= base_url('Practice/free_practice') ?>" class="btn btn-primary btn-block btn-lg">
                                            <i class="mdi mdi-camera"></i> Start Practice
                                        </a>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <a href="<?= base_url('Quiz') ?>" class="btn btn-success btn-block btn-lg">
                                            <i class="mdi mdi-trophy"></i> Take Quiz
                                        </a>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <a href="<?= base_url('FSL/dictionary') ?>" class="btn btn-info btn-block btn-lg">
                                            <i class="mdi mdi-book-open"></i> FSL Dictionary
                                        </a>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <a href="<?= base_url('FSL/progress') ?>" class="btn btn-warning btn-block btn-lg">
                                            <i class="mdi mdi-chart-line"></i> My Progress
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Categories & Lessons -->
                    <div class="row">
                        <!-- Categories -->
                        <div class="col-md-4">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Categories</h4>
                                <div class="list-group">
                                    <?php foreach ($categories as $category): ?>
                                        <a href="<?= base_url('FSL/category/' . $category->category_id) ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <?= $category->category_name ?>
                                            <span class="badge badge-primary badge-pill">View</span>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Lessons -->
                        <div class="col-md-8">
                            <div class="card-box">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="header-title m-0">Continue Learning</h4>
                                    <a href="<?= base_url('FSL/lessons') ?>" class="btn btn-sm btn-outline-primary">View All</a>
                                </div>

                                <?php if (!empty($recent_lessons)): ?>
                                    <?php foreach ($recent_lessons as $lesson): ?>
                                        <div class="lesson-item mb-3 p-3 border rounded">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="m-0"><?= isset($lesson->lesson_title) ? $lesson->lesson_title : 'Untitled Lesson' ?></h5>
                                                    <small class="text-muted"><?= $lesson->difficulty_level ?> | <?= isset($lesson->total_signs) ? $lesson->total_signs : 0 ?> signs</small>
                                                </div>
                                                <div class="text-right">
                                                    <div class="progress mb-1" style="width: 150px; height: 8px;">
                                                        <?php
                                                        $progress_pct = isset($lesson->progress) && isset($lesson->progress['progress_percentage']) ? $lesson->progress['progress_percentage'] : 0;
                                                        $is_completed = isset($lesson->progress) && isset($lesson->progress['is_completed']) ? $lesson->progress['is_completed'] : false;
                                                        ?>
                                                        <div class="progress-bar" role="progressbar" style="width: <?= $progress_pct ?>%"></div>
                                                    </div>
                                                    <small><?= $progress_pct ?>% complete</small>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <?php if ($is_completed): ?>
                                                    <span class="badge badge-success">Completed</span>
                                                <?php else: ?>
                                                    <a href="<?= base_url('Practice/lesson/' . $lesson->lesson_id) ?>" class="btn btn-sm btn-primary">Practice</a>
                                                    <a href="<?= base_url('FSL/lesson/' . $lesson->lesson_id) ?>" class="btn btn-sm btn-outline-secondary">Learn</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-muted">No lessons available. Check back soon!</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Signs -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Featured Signs</h4>
                                <div class="row">
                                    <?php foreach ($featured_signs as $sign): ?>
                                        <div class="col-md-2 col-sm-4 col-6 mb-3">
                                            <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="text-decoration-none">
                                                <div class="sign-card text-center p-3 border rounded h-100">
                                                    <?php if ($sign->image_path): ?>
                                                        <img src="<?= base_url($sign->image_path) ?>" alt="<?= $sign->sign_name ?>" class="img-fluid mb-2" style="max-height: 100px;">
                                                    <?php else: ?>
                                                        <div class="sign-placeholder bg-light d-flex align-items-center justify-content-center mb-2" style="height: 100px;">
                                                            <i class="mdi mdi-hand-pointing-right" style="font-size: 48px;"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <h6 class="m-0"><?= $sign->sign_name ?></h6>
                                                    <small class="text-muted"><?= ucfirst($sign->sign_type) ?></small>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
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