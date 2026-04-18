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
                                <h4 class="page-title">FSL Lessons</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Difficulty Filter -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('FSL/lessons') ?>" class="btn btn-outline-primary <?= !$this->input->get('difficulty') ? 'active' : '' ?>">All Levels</a>
                                <a href="<?= base_url('FSL/lessons?difficulty=beginner') ?>" class="btn btn-outline-primary <?= $this->input->get('difficulty') == 'beginner' ? 'active' : '' ?>">Beginner</a>
                                <a href="<?= base_url('FSL/lessons?difficulty=intermediate') ?>" class="btn btn-outline-primary <?= $this->input->get('difficulty') == 'intermediate' ? 'active' : '' ?>">Intermediate</a>
                                <a href="<?= base_url('FSL/lessons?difficulty=advanced') ?>" class="btn btn-outline-primary <?= $this->input->get('difficulty') == 'advanced' ? 'active' : '' ?>">Advanced</a>
                            </div>
                        </div>
                    </div>

                    <!-- Lessons Grid -->
                    <div class="row">
                        <?php foreach ($lessons as $lesson):
                            $progress = isset($lesson->user_progress) ? $lesson->user_progress : array('progress_percentage' => 0, 'is_completed' => false);
                        ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card lesson-card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="badge badge-<?= $lesson->difficulty_level == 'beginner' ? 'success' : ($lesson->difficulty_level == 'intermediate' ? 'warning' : 'danger') ?>">
                                                <?= ucfirst($lesson->difficulty_level) ?>
                                            </span>
                                            <?php if ($progress['is_completed']): ?>
                                                <span class="badge badge-success"><i class="mdi mdi-check-circle"></i> Completed</span>
                                            <?php endif; ?>
                                        </div>

                                        <h4 class="card-title"><?= $lesson->lesson_title ?></h4>
                                        <p class="card-text text-muted"><?= $lesson->lesson_description ?></p>

                                        <div class="lesson-meta mb-3">
                                            <span class="mr-3"><i class="mdi mdi-format-list-bulleted"></i> <?= $lesson->total_signs ?> signs</span>
                                            <span><i class="mdi mdi-clock-outline"></i> <?= $lesson->estimated_duration ?> min</span>
                                        </div>

                                        <div class="progress mb-2" style="height: 8px;">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: <?= $progress['progress_percentage'] ?>%"
                                                aria-valuenow="<?= $progress['progress_percentage'] ?>"
                                                aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                        <small class="text-muted"><?= $progress['progress_percentage'] ?>% complete</small>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <div class="btn-group w-100">
                                            <a href="<?= base_url('FSL/lesson/' . $lesson->lesson_id) ?>" class="btn btn-outline-primary">Learn</a>
                                            <a href="<?= base_url('Practice/lesson/' . $lesson->lesson_id) ?>" class="btn btn-primary">Practice</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if (empty($lessons)): ?>
                        <div class="row">
                            <div class="col-12 text-center py-5">
                                <i class="mdi mdi-book-open-variant" style="font-size: 64px; color: #ccc;"></i>
                                <h4 class="mt-3 text-muted">No lessons available</h4>
                                <p class="text-muted">Check back soon for new lessons!</p>
                            </div>
                        </div>
                    <?php endif; ?>

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
</body>

</html>