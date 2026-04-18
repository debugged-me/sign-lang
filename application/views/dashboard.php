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
                        <div class="d-flex justify-content-between align-items-end">
                            <div>
                                <span class="sl-section-subtitle">Welcome back, <?= $this->session->userdata('fname') ?>!</span>
                                <h1 class="sl-page-title">Dashboard</h1>
                                <p class="sl-page-subtitle">Continue your Filipino Sign Language journey</p>
                            </div>
                            <div class="d-none d-md-block">
                                <span class="sl-badge" style="background: rgba(37, 99, 235, 0.1); color: var(--sl-primary);
                                    <i class=" mdi mdi-calendar-today mr-1"></i> <?= date('F j, Y') ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="sl-stat-card primary sl-card-animated">
                                <div class="sl-stat-icon primary">
                                    <i class="mdi mdi-hand-pointing-right"></i>
                                </div>
                                <div class="sl-stat-value" data-plugin="counterup"><?= $stats['total_learned'] ?></div>
                                <div class="sl-stat-label">Signs Learned</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="sl-stat-card success sl-card-animated">
                                <div class="sl-stat-icon success">
                                    <i class="mdi mdi-trophy"></i>
                                </div>
                                <div class="sl-stat-value" data-plugin="counterup"><?= $stats['mastered'] ?></div>
                                <div class="sl-stat-label">Mastered Signs</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="sl-stat-card secondary sl-card-animated">
                                <div class="sl-stat-icon secondary">
                                    <i class="mdi mdi-play-circle"></i>
                                </div>
                                <div class="sl-stat-value" data-plugin="counterup"><?= $stats['total_sessions'] ?></div>
                                <div class="sl-stat-label">Practice Sessions</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb-3">
                            <div class="sl-stat-card accent sl-card-animated">
                                <div class="sl-stat-icon accent">
                                    <i class="mdi mdi-chart-line"></i>
                                </div>
                                <div class="sl-stat-value"><span data-plugin="counterup"><?= $stats['overall_accuracy'] ?></span>%</div>
                                <div class="sl-stat-label">Accuracy Rate</div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="sl-card mb-4">
                        <div class="p-4">
                            <h5 class="font-weight-bold mb-3" style="color: var(--sl-text);">Quick Actions</h5>
                            <div class="row">
                                <div class="col-md-3 col-6 mb-2">
                                    <a href="<?= base_url('Practice/free_practice') ?>" class="sl-btn sl-btn-primary w-100 justify-content-center">
                                        <i class="mdi mdi-camera"></i> Start Practice
                                    </a>
                                </div>
                                <div class="col-md-3 col-6 mb-2">
                                    <a href="<?= base_url('Quiz') ?>" class="sl-btn sl-btn-success w-100 justify-content-center">
                                        <i class="mdi mdi-trophy"></i> Take Quiz
                                    </a>
                                </div>
                                <div class="col-md-3 col-6 mb-2">
                                    <a href="<?= base_url('FSL/dictionary') ?>" class="sl-btn sl-btn-outline w-100 justify-content-center">
                                        <i class="mdi mdi-book-open"></i> Dictionary
                                    </a>
                                </div>
                                <div class="col-md-3 col-6 mb-2">
                                    <a href="<?= base_url('FSL/progress') ?>" class="sl-btn sl-btn-outline w-100 justify-content-center">
                                        <i class="mdi mdi-chart-line"></i> My Progress
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Continue Learning & Categories -->
                    <div class="row">
                        <!-- Continue Learning -->
                        <div class="col-lg-8 mb-4">
                            <div class="sl-card h-100">
                                <div class="p-4 border-bottom" style="border-color: var(--sl-border) !important;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="sl-section-subtitle">Pick up where you left off</span>
                                            <h4 class="font-weight-bold mb-0" style="color: var(--sl-text);">Continue Learning</h4>
                                        </div>
                                        <a href="<?= base_url('FSL/lessons') ?>" class="sl-btn sl-btn-outline">
                                            View All <i class="mdi mdi-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <?php if (!empty($recent_lessons)): ?>
                                        <div class="row">
                                            <?php foreach ($recent_lessons as $lesson):
                                                $progress_pct = isset($lesson->progress) && isset($lesson->progress['progress_percentage']) ? $lesson->progress['progress_percentage'] : 0;
                                                $is_completed = isset($lesson->progress) && isset($lesson->progress['is_completed']) ? $lesson->progress['is_completed'] : false;
                                            ?>
                                                <div class="col-md-6 mb-3">
                                                    <div class="p-3 rounded sl-card" style="border: 1px solid var(--sl-border); box-shadow: none;">
                                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                                            <span class="sl-badge sl-badge-<?= $lesson->difficulty_level ?>">
                                                                <?= ucfirst($lesson->difficulty_level) ?>
                                                            </span>
                                                            <?php if ($is_completed): ?>
                                                                <span class="sl-badge sl-badge-mastered">
                                                                    <i class="mdi mdi-check-circle mr-1"></i>Completed
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <h5 class="font-weight-semibold mb-1" style="color: var(--sl-text);">
                                                            <?= isset($lesson->lesson_title) ? $lesson->lesson_title : 'Untitled Lesson' ?>
                                                        </h5>
                                                        <p class="small mb-3" style="color: var(--sl-text-muted);">
                                                            <?= isset($lesson->total_signs) ? $lesson->total_signs : 0 ?> signs to learn
                                                        </p>
                                                        <div class="mb-3">
                                                            <div class="d-flex justify-content-between small mb-1">
                                                                <span style="color: var(--sl-text-muted);">Progress</span>
                                                                <span class="font-weight-semibold" style="color: var(--sl-primary);"><?= $progress_pct ?>%</span>
                                                            </div>
                                                            <div class="sl-progress">
                                                                <div class="sl-progress-bar" style="width: <?= $progress_pct ?>%; background: linear-gradient(90deg, var(--sl-primary) 0%, var(--sl-primary-light) 100%);"></div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex gap-2">
                                                            <?php if (!$is_completed): ?>
                                                                <a href="<?= base_url('FSL/lesson/' . $lesson->lesson_id) ?>" class="sl-btn sl-btn-outline flex-fill text-center" style="padding: 8px 16px; font-size: 0.875rem;">
                                                                    Learn
                                                                </a>
                                                                <a href="<?= base_url('Practice/lesson/' . $lesson->lesson_id) ?>" class="sl-btn sl-btn-primary flex-fill text-center" style="padding: 8px 16px; font-size: 0.875rem;">
                                                                    Practice
                                                                </a>
                                                            <?php else: ?>
                                                                <a href="<?= base_url('FSL/lesson/' . $lesson->lesson_id) ?>" class="sl-btn sl-btn-outline w-100 text-center" style="padding: 8px 16px; font-size: 0.875rem;">
                                                                    <i class="mdi mdi-refresh mr-1"></i>Review
                                                                </a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="sl-empty-state">
                                            <i class="mdi mdi-school"></i>
                                            <h5 style="color: var(--sl-text);">No lessons started yet</h5>
                                            <p class="mb-3" style="color: var(--sl-text-muted);">Begin your FSL journey with our structured lessons</p>
                                            <a href="<?= base_url('FSL/lessons') ?>" class="sl-btn sl-btn-primary">
                                                <i class="mdi mdi-play mr-2"></i>Start First Lesson
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="col-lg-4 mb-4">
                            <div class="sl-card h-100">
                                <div class="p-4 border-bottom" style="border-color: var(--sl-border) !important;">
                                    <span class="sl-section-subtitle">Browse by topic</span>
                                    <h4 class="font-weight-bold mb-0" style="color: var(--sl-text);">Categories</h4>
                                </div>
                                <div class="p-2">
                                    <?php foreach ($categories as $category): ?>
                                        <a href="<?= base_url('FSL/category/' . $category->category_id) ?>"
                                            class="d-flex align-items-center p-3 text-decoration-none rounded"
                                            style="color: var(--sl-text); transition: all 0.2s;">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                                style="width: 44px; height: 44px; background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%);">
                                                <i class="mdi mdi-folder-outline" style="color: var(--sl-primary);"></i>
                                            </div>
                                            <div class="flex-fill">
                                                <div class="font-weight-semibold"><?= $category->category_name ?></div>
                                                <small style="color: var(--sl-text-muted);">Explore signs</small>
                                            </div>
                                            <i class="mdi mdi-chevron-right" style="color: var(--sl-text-muted);"></i>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Signs -->
                    <div class="row">
                        <div class="col-12">
                            <div class="sl-card">
                                <div class="p-4 border-bottom" style="border-color: var(--sl-border) !important;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="sl-section-subtitle">Popular this week</span>
                                            <h4 class="font-weight-bold mb-0" style="color: var(--sl-text);">Featured Signs</h4>
                                        </div>
                                        <a href="<?= base_url('FSL/dictionary') ?>" class="sl-btn sl-btn-outline" style="padding: 8px 16px; font-size: 0.875rem;">
                                            View All <i class="mdi mdi-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="row">
                                        <?php foreach ($featured_signs as $sign): ?>
                                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                                                <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="text-decoration-none">
                                                    <div class="sl-sign-card">
                                                        <div class="sl-sign-preview">
                                                            <?php if ($sign->image_path): ?>
                                                                <img src="<?= base_url($sign->image_path) ?>" alt="<?= $sign->sign_name ?>">
                                                            <?php else: ?>
                                                                <i class="mdi mdi-hand-pointing-right" style="font-size: 48px; color: #94A3B8;"></i>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="sl-sign-name"><?= $sign->sign_name ?></div>
                                                        <div class="sl-sign-type"><?= ucfirst($sign->sign_type) ?></div>
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
            <?php $this->load->view('includes/footer'); ?>
        </div>
    </div>

    <?php $this->load->view('includes/footer_plugins'); ?>
</body>

</html>