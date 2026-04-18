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
                    <!-- Page Header -->
                    <div class="sl-page-header">
                        <span class="sl-section-subtitle">Structured Learning Path</span>
                        <h1 class="sl-page-title">FSL Lessons</h1>
                        <p class="sl-page-subtitle">Master Filipino Sign Language through guided lessons</p>
                    </div>

                    <!-- Difficulty Filter -->
                    <div class="sl-card mb-4">
                        <div class="p-4">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <span class="font-weight-semibold mr-3" style="color: var(--sl-text);">Filter by level:</span>
                                <div class="sl-filter-group">
                                    <a href="<?= base_url('FSL/lessons') ?>"
                                        class="sl-filter-btn <?= !$this->input->get('difficulty') ? 'active' : '' ?>">All Levels</a>
                                    <a href="<?= base_url('FSL/lessons?difficulty=beginner') ?>"
                                        class="sl-filter-btn <?= $this->input->get('difficulty') == 'beginner' ? 'active' : '' ?>">Beginner</a>
                                    <a href="<?= base_url('FSL/lessons?difficulty=intermediate') ?>"
                                        class="sl-filter-btn <?= $this->input->get('difficulty') == 'intermediate' ? 'active' : '' ?>">Intermediate</a>
                                    <a href="<?= base_url('FSL/lessons?difficulty=advanced') ?>"
                                        class="sl-filter-btn <?= $this->input->get('difficulty') == 'advanced' ? 'active' : '' ?>">Advanced</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lessons Grid -->
                    <div class="row">
                        <?php foreach ($lessons as $lesson):
                            $progress = isset($lesson->user_progress) ? $lesson->user_progress : array('progress_percentage' => 0, 'is_completed' => false);
                        ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="sl-lesson-card h-100">
                                    <div class="sl-lesson-header">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <span class="sl-badge sl-badge-<?= $lesson->difficulty_level ?>">
                                                <?= ucfirst($lesson->difficulty_level) ?>
                                            </span>
                                            <?php if ($progress['is_completed']): ?>
                                                <span class="sl-badge sl-badge-mastered">
                                                    <i class="mdi mdi-check-circle mr-1"></i>Completed
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <h4 class="font-weight-bold mb-2" style="color: var(--sl-text);"><?= $lesson->lesson_title ?></h4>
                                        <p style="color: var(--sl-text-muted); font-size: 0.9375rem; line-height: 1.6;">
                                            <?= $lesson->lesson_description ?>
                                        </p>
                                    </div>
                                    <div class="sl-lesson-body">
                                        <div class="d-flex align-items-center mb-4" style="color: var(--sl-text-muted);">
                                            <span class="mr-4"><i class="mdi mdi-format-list-bulleted mr-2" style="color: var(--sl-primary);"></i><?= $lesson->total_signs ?> signs</span>
                                            <span><i class="mdi mdi-clock-outline mr-2" style="color: var(--sl-primary);"></i><?= $lesson->estimated_duration ?> min</span>
                                        </div>
                                        <div class="mb-2">
                                            <div class="d-flex justify-content-between small mb-1">
                                                <span style="color: var(--sl-text-muted);">Your Progress</span>
                                                <span class="font-weight-semibold" style="color: var(--sl-primary);"><?= $progress['progress_percentage'] ?>%</span>
                                            </div>
                                            <div class="sl-progress">
                                                <div class="sl-progress-bar" style="width: <?= $progress['progress_percentage'] ?>%; background: linear-gradient(90deg, var(--sl-primary) 0%, var(--sl-primary-light) 100%);"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sl-lesson-footer">
                                        <div class="d-flex gap-2">
                                            <a href="<?= base_url('FSL/lesson/' . $lesson->lesson_id) ?>"
                                                class="sl-btn sl-btn-outline flex-fill text-center"
                                                style="padding: 10px 20px; font-size: 0.875rem;">
                                                <i class="mdi mdi-book-open-outline mr-2"></i>Learn
                                            </a>
                                            <a href="<?= base_url('Practice/lesson/' . $lesson->lesson_id) ?>"
                                                class="sl-btn sl-btn-primary flex-fill text-center"
                                                style="padding: 10px 20px; font-size: 0.875rem;">
                                                <i class="mdi mdi-camera mr-2"></i>Practice
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if (empty($lessons)): ?>
                        <div class="sl-card">
                            <div class="sl-empty-state">
                                <i class="mdi mdi-school-outline"></i>
                                <h4 style="color: var(--sl-text);">No lessons available</h4>
                                <p style="color: var(--sl-text-muted);">Check back soon for new lessons!</p>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <?php $this->load->view('includes/footer'); ?>
        </div>
    </div>

    <?php $this->load->view('includes/footer_plugins'); ?>
</body>

</html>