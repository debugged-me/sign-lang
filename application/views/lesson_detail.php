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
                                        <li class="breadcrumb-item"><a href="<?= base_url('FSL/lessons') ?>">Lessons</a></li>
                                        <li class="breadcrumb-item active"><?= $lesson->lesson_title ?></li>
                                    </ol>
                                </div>
                                <h4 class="page-title"><?= $lesson->lesson_title ?></h4>
                            </div>
                        </div>
                    </div>

                    <!-- Lesson Info -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-md-8">
                                        <span class="badge badge-<?= $lesson->difficulty_level == 'beginner' ? 'success' : ($lesson->difficulty_level == 'intermediate' ? 'warning' : 'danger') ?>">
                                            <?= ucfirst($lesson->difficulty_level) ?>
                                        </span>
                                        <span class="badge badge-info"><?= count($lesson->signs) ?> signs</span>
                                        <span class="badge badge-secondary"><?= $lesson->estimated_duration ?> min</span>

                                        <p class="mt-3"><?= $lesson->lesson_description ?></p>

                                        <!-- Progress -->
                                        <div class="mt-3">
                                            <div class="d-flex justify-content-between">
                                                <span>Your Progress</span>
                                                <span><?= $user_progress['progress_percentage'] ?>%</span>
                                            </div>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar" role="progressbar" style="width: <?= $user_progress['progress_percentage'] ?>"></div>
                                            </div>
                                            <small class="text-muted"><?= $user_progress['mastered_signs'] ?> of <?= $user_progress['total_signs'] ?> signs mastered</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-md-right">
                                        <a href="<?= base_url('Practice/lesson/' . $lesson->lesson_id) ?>" class="btn btn-success btn-lg btn-block mb-2">
                                            <i class="mdi mdi-play"></i> Start Practice
                                        </a>
                                        <?php if ($user_progress['is_completed'] && isset($next_lesson)): ?>
                                            <a href="<?= base_url('FSL/lesson/' . $next_lesson->lesson_id) ?>" class="btn btn-primary btn-block">
                                                Next Lesson <i class="mdi mdi-arrow-right"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lesson Signs -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Signs in this Lesson</h4>
                                <div class="row">
                                    <?php foreach ($lesson->signs as $index => $sign): ?>
                                        <div class="col-md-3 col-sm-6 mb-3">
                                            <div class="card lesson-sign-card">
                                                <div class="card-body text-center">
                                                    <span class="badge badge-secondary position-absolute" style="top: 10px; left: 10px;"><?= $index + 1 ?></span>

                                                    <?php if ($sign->image_path && file_exists(FCPATH . $sign->image_path)): ?>
                                                        <img src="<?= base_url($sign->image_path) ?>" alt="<?= $sign->sign_name ?>" class="img-fluid mb-2" style="max-height: 100px;">
                                                    <?php else: ?>
                                                        <div class="bg-light d-flex align-items-center justify-content-center mb-2 rounded" style="height: 100px;">
                                                            <i class="mdi mdi-hand-pointing-right text-muted" style="font-size: 40px;"></i>
                                                        </div>
                                                    <?php endif; ?>

                                                    <h5 class="mb-1"><?= $sign->sign_name ?></h5>

                                                    <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="btn btn-sm btn-outline-primary mt-2">
                                                        Learn More
                                                    </a>
                                                </div>
                                            </div>
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