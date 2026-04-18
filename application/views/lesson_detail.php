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
                    <div class="sl-page-header">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent p-0 mb-2">
                                <li class="breadcrumb-item"><a href="<?= base_url('FSL/lessons') ?>" style="color: var(--sl-text-muted);">Lessons</a></li>
                                <li class="breadcrumb-item active" style="color: var(--sl-text);" aria-current="page"><?= $lesson->lesson_title ?></li>
                            </ol>
                        </nav>
                        <h1 class="sl-page-title"><?= $lesson->lesson_title ?></h1>
                        <p class="sl-page-subtitle"><?= $lesson->lesson_description ?></p>
                    </div>

                    <!-- Lesson Info -->
                    <div class="sl-card mb-4">
                        <div class="p-4">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <div class="d-flex flex-wrap gap-2 mb-4">
                                        <span class="sl-badge sl-badge-<?= $lesson->difficulty_level ?>">
                                            <?= ucfirst($lesson->difficulty_level) ?>
                                        </span>
                                        <span class="sl-badge" style="background: rgba(37, 99, 235, 0.1); color: var(--sl-primary);
                                            <i class=" mdi mdi-format-list-bulleted mr-1"></i><?= count($lesson->signs) ?> signs
                                        </span>
                                        <span class="sl-badge" style="background: rgba(100, 116, 139, 0.1); color: var(--sl-text-muted);">
                                            <i class="mdi mdi-clock-outline mr-1"></i><?= $lesson->estimated_duration ?> min
                                        </span>
                                    </div>
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="font-weight-semibold" style="color: var(--sl-text);">Your Progress</span>
                                            <span class="font-weight-bold" style="color: var(--sl-primary); font-size: 1.25rem;"><?= $user_progress['progress_percentage'] ?>%</span>
                                        </div>
                                        <div class="sl-progress" style="height: 12px;">
                                            <div class="sl-progress-bar" style="width: <?= $user_progress['progress_percentage'] ?>%; background: linear-gradient(90deg, var(--sl-primary) 0%, var(--sl-primary-light) 100%);"></div>
                                        </div>
                                        <small class="d-block mt-2" style="color: var(--sl-text-muted);">
                                            <?= $user_progress['mastered_signs'] ?> of <?= $user_progress['total_signs'] ?> signs mastered
                                        </small>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <a href="<?= base_url('Practice/lesson/' . $lesson->lesson_id) ?>" class="sl-btn sl-btn-success w-100 mb-3">
                                        <i class="mdi mdi-play mr-2"></i>Start Practice
                                    </a>
                                    <?php if ($user_progress['is_completed'] && isset($next_lesson)): ?>
                                        <a href="<?= base_url('FSL/lesson/' . $next_lesson->lesson_id) ?>" class="sl-btn sl-btn-primary w-100">
                                            Next Lesson <i class="mdi mdi-arrow-right ml-2"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lesson Signs -->
                    <div class="sl-card">
                        <div class="p-4 border-bottom" style="border-color: var(--sl-border) !important;">
                            <span class="sl-section-subtitle">Learning content</span>
                            <h4 class="font-weight-bold mb-0" style="color: var(--sl-text);">Signs in this Lesson</h4>
                        </div>
                        <div class="p-4">
                            <div class="row">
                                <?php foreach ($lesson->signs as $index => $sign): ?>
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <div class="sl-sign-card" style="position: relative;">
                                            <span class="position-absolute font-weight-bold" style="top: 12px; left: 12px; width: 28px; height: 28px; background: var(--sl-primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.875rem;">
                                                <?= $index + 1 ?>
                                            </span>
                                            <div class="sl-sign-preview" style="height: 160px;">
                                                <?php if ($sign->image_path && file_exists(FCPATH . $sign->image_path)): ?>
                                                    <img src="<?= base_url($sign->image_path) ?>" alt="<?= $sign->sign_name ?>">
                                                <?php else: ?>
                                                    <i class="mdi mdi-hand-pointing-right" style="font-size: 48px; color: #94A3B8;"></i>
                                                <?php endif; ?>
                                            </div>
                                            <div class="sl-sign-name"><?= $sign->sign_name ?></div>
                                            <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="sl-btn sl-btn-outline w-100" style="padding: 8px 16px; font-size: 0.875rem;">
                                                <i class="mdi mdi-information-outline mr-2"></i>Learn More
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
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