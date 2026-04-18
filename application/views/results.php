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
                        <a href="<?= base_url('Quiz') ?>" class="sl-btn sl-btn-outline mb-3">
                            <i class="mdi mdi-arrow-left mr-2"></i> Back to Quiz
                        </a>
                        <h1 class="sl-page-title">Quiz Results</h1>
                        <p class="sl-page-subtitle">See how you performed</p>
                    </div>

                    <!-- Results Summary -->
                    <?php
                    $score = $score_data['score'];
                    $grade = $score >= 90 ? 'A' : ($score >= 80 ? 'B' : ($score >= 70 ? 'C' : ($score >= 60 ? 'D' : 'F')));
                    $gradeColor = $score >= 90 ? 'var(--sl-success)' : ($score >= 70 ? 'var(--sl-warning)' : 'var(--sl-danger)');
                    $gradeBg = $score >= 90 ? 'rgba(16, 185, 129, 0.1)' : ($score >= 70 ? 'rgba(245, 158, 11, 0.1)' : 'rgba(239, 68, 68, 0.1)');
                    ?>
                    <div class="sl-hero mb-4 text-center">
                        <div class="position-relative" style="z-index: 1;">
                            <div class="mb-4">
                                <div class="d-inline-flex align-items-center justify-content-center" style="width: 140px; height: 140px; background: white; border-radius: 50%; box-shadow: var(--sl-shadow-lg); animation: pulse 2s ease-in-out infinite;">
                                    <span style="font-size: 5rem; font-weight: 800; color: <?= $gradeColor ?>;"><?= $grade ?></span>
                                </div>
                            </div>
                            <h2 class="text-white mb-2">Score: <?= round($score, 1) ?>%</h2>
                            <p class="text-white" style="opacity: 0.95; font-size: 1.1rem;">
                                You got <?= $score_data['correct'] ?> out of <?= $score_data['total'] ?> questions correct
                            </p>
                            <div class="mt-4">
                                <a href="<?= base_url('Quiz') ?>" class="sl-btn mr-2" style="background: white; color: var(--sl-primary);">
                                    <i class="mdi mdi-refresh mr-2"></i>Try Again
                                </a>
                                <a href="<?= base_url('FSL/progress') ?>" class="sl-btn" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3);">
                                    <i class="mdi mdi-chart-line mr-2"></i>View Progress
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Row -->
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <div class="sl-card p-4 text-center sl-card-animated">
                                <div class="sl-stat-value" style="font-size: 2.5rem; color: var(--sl-primary);"><?= $session->total_attempts ?></div>
                                <div class="sl-stat-label">Total Questions</div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="sl-card p-4 text-center sl-card-animated" style="animation-delay: 0.05s;">
                                <div class="sl-stat-value" style="font-size: 2.5rem; color: var(--sl-accent);"><?= gmdate("i:s", $session->duration_seconds) ?></div>
                                <div class="sl-stat-label">Time Taken</div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="sl-card p-4 text-center sl-card-animated" style="animation-delay: 0.1s;">
                                <div class="sl-stat-value" style="font-size: 2.5rem; color: <?= $gradeColor ?>;"><?= round(($score_data['correct'] / max($score_data['total'], 1)) * 100) ?>%</div>
                                <div class="sl-stat-label">Accuracy</div>
                            </div>
                        </div>
                    </div>

                    <!-- Question Review -->
                    <div class="sl-card">
                        <div class="p-4 border-bottom" style="border-color: var(--sl-border) !important;">
                            <span class="sl-section-subtitle">Review your answers</span>
                            <h4 class="font-weight-bold mb-0" style="color: var(--sl-text);">Question Review</h4>
                        </div>
                        <div class="p-0">
                            <div class="table-responsive">
                                <table class="sl-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 60px;">#</th>
                                            <th>Sign</th>
                                            <th>Your Answer</th>
                                            <th style="width: 120px;">Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1;
                                        foreach ($attempts as $attempt): ?>
                                            <tr>
                                                <td><span class="font-weight-semibold" style="color: var(--sl-text-muted);"><?= $counter++ ?></span></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <?php if ($attempt->image_path): ?>
                                                            <img src="<?= base_url($attempt->image_path) ?>" alt="<?= $attempt->sign_name ?>" style="height: 40px; width: 40px; object-fit: contain;" class="mr-3 rounded">
                                                        <?php else: ?>
                                                            <div class="d-flex align-items-center justify-content-center mr-3 rounded" style="width: 40px; height: 40px; background: var(--sl-muted-surface);">
                                                                <i class="mdi mdi-hand-pointing-right" style="color: var(--sl-text-muted);"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                        <span class="font-weight-medium" style="color: var(--sl-text);"><?= $attempt->sign_name ?></span>
                                                    </div>
                                                </td>
                                                <td><span style="color: var(--sl-text);"><?= $attempt->recognized_sign ?></span></td>
                                                <td>
                                                    <?php if ($attempt->is_correct): ?>
                                                        <span class="sl-badge" style="background: rgba(16, 185, 129, 0.1); color: var(--sl-success);">
                                                            <i class="mdi mdi-check mr-1"></i>Correct
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="sl-badge" style="background: rgba(239, 68, 68, 0.1); color: var(--sl-danger);">
                                                            <i class="mdi mdi-close mr-1"></i>Incorrect
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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