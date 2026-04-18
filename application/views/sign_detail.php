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
                                <li class="breadcrumb-item"><a href="<?= base_url('FSL/dictionary') ?>" style="color: var(--sl-text-muted);">Dictionary</a></li>
                                <li class="breadcrumb-item active" style="color: var(--sl-text);" aria-current="page"><?= $sign->sign_name ?></li>
                            </ol>
                        </nav>
                        <h1 class="sl-page-title"><?= $sign->sign_name ?></h1>
                        <p class="sl-page-subtitle">Learn and practice this sign</p>
                    </div>

                    <div class="row">
                        <!-- Sign Visual -->
                        <div class="col-lg-5 mb-4 mb-lg-0">
                            <div class="sl-card">
                                <div class="p-4">
                                    <div class="sl-sign-display" style="height: 360px;">
                                        <?php if ($sign->image_path && file_exists(FCPATH . $sign->image_path)): ?>
                                            <img src="<?= base_url($sign->image_path) ?>" alt="<?= $sign->sign_name ?>" class="img-fluid" style="max-height: 320px;">
                                        <?php else: ?>
                                            <i class="mdi mdi-hand-pointing-right" style="font-size: 100px; color: #CBD5E1;"></i>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($sign->video_path): ?>
                                        <div class="mt-4">
                                            <video controls class="w-100 rounded" style="border-radius: var(--sl-radius-sm);">
                                                <source src="<?= base_url($sign->video_path) ?>" type="video/mp4">
                                            </video>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Sign Info -->
                        <div class="col-lg-7">
                            <!-- Information Card -->
                            <div class="sl-card mb-4">
                                <div class="p-4 border-bottom" style="border-color: var(--sl-border) !important;">
                                    <span class="sl-section-subtitle">Details</span>
                                    <h4 class="font-weight-bold mb-0" style="color: var(--sl-text);">Sign Information</h4>
                                </div>
                                <div class="p-4">
                                    <div class="row mb-4">
                                        <div class="col-sm-6 mb-3">
                                            <small class="d-block mb-1" style="color: var(--sl-text-muted); text-transform: uppercase; font-weight: 600; font-size: 0.75rem; letter-spacing: 0.05em;">Type</small>
                                            <span class="sl-badge" style="background: rgba(37, 99, 235, 0.1); color: var(--sl-primary);"><?= ucfirst($sign->sign_type) ?></span>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <small class="d-block mb-1" style="color: var(--sl-text-muted); text-transform: uppercase; font-weight: 600; font-size: 0.75rem; letter-spacing: 0.05em;">Category</small>
                                            <span style="color: var(--sl-text); font-weight: 500;"><?= $sign->category_name ? $sign->category_name : 'N/A' ?></span>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <small class="d-block mb-1" style="color: var(--sl-text-muted); text-transform: uppercase; font-weight: 600; font-size: 0.75rem; letter-spacing: 0.05em;">Difficulty</small>
                                            <span class="sl-badge sl-badge-<?= $sign->difficulty_level ?>"><?= ucfirst($sign->difficulty_level) ?></span>
                                        </div>
                                    </div>

                                    <?php if ($sign->description): ?>
                                        <div class="mb-4">
                                            <h5 class="font-weight-semibold mb-2" style="color: var(--sl-text);">Description</h5>
                                            <p style="color: var(--sl-text-muted); line-height: 1.7;"><?= $sign->description ?></p>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($sign->handshape_description): ?>
                                        <div class="mb-4">
                                            <h5 class="font-weight-semibold mb-2" style="color: var(--sl-text);">Handshape</h5>
                                            <p style="color: var(--sl-text-muted); line-height: 1.7;"><?= $sign->handshape_description ?></p>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($sign->movement_description): ?>
                                        <div class="mb-4">
                                            <h5 class="font-weight-semibold mb-2" style="color: var(--sl-text);">Movement</h5>
                                            <p style="color: var(--sl-text-muted); line-height: 1.7;"><?= $sign->movement_description ?></p>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($sign->usage_example): ?>
                                        <div class="p-3 rounded" style="background: #F8FAFC; border-left: 4px solid var(--sl-primary);">
                                            <small class="d-block mb-1" style="color: var(--sl-text-muted); font-weight: 600;">USAGE EXAMPLE</small>
                                            <p class="mb-0" style="color: var(--sl-text); font-style: italic;">
                                                <i class="mdi mdi-format-quote-open mr-1" style="color: var(--sl-primary);"></i>
                                                <?= $sign->usage_example ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Progress Card -->
                            <div class="sl-card mb-4">
                                <div class="p-4 border-bottom" style="border-color: var(--sl-border) !important;">
                                    <span class="sl-section-subtitle">Your stats</span>
                                    <h4 class="font-weight-bold mb-0" style="color: var(--sl-text);">Your Progress</h4>
                                </div>
                                <div class="p-4">
                                    <?php if ($user_progress): ?>
                                        <div class="row mb-4">
                                            <div class="col-4 text-center">
                                                <div class="mb-2">
                                                    <span class="sl-badge <?= $user_progress->status == 'mastered' ? 'sl-badge-mastered' : ($user_progress->status == 'practiced' ? 'sl-badge-intermediate' : '') ?>"
                                                        style="<?= $user_progress->status == 'new' ? 'background: rgba(100, 116, 139, 0.1); color: var(--sl-text-muted);' : '' ?>">
                                                        <?= ucfirst($user_progress->status) ?>
                                                    </span>
                                                </div>
                                                <small style="color: var(--sl-text-muted);">Status</small>
                                            </div>
                                            <div class="col-4 text-center">
                                                <div class="sl-stat-value" style="font-size: 1.5rem;" data-plugin="counterup"><?= $user_progress->practice_count ?></div>
                                                <small style="color: var(--sl-text-muted);">Practice Count</small>
                                            </div>
                                            <div class="col-4 text-center">
                                                <div class="sl-stat-value" style="font-size: 1.5rem; color: <?= $user_progress->average_score >= 80 ? 'var(--sl-success)' : ($user_progress->average_score >= 60 ? 'var(--sl-warning)' : 'var(--sl-danger)') ?>;">
                                                    <?= round($user_progress->average_score, 1) ?>%
                                                </div>
                                                <small style="color: var(--sl-text-muted);">Accuracy</small>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="text-center py-4">
                                            <i class="mdi mdi-school-outline mb-3" style="font-size: 48px; color: #CBD5E1;"></i>
                                            <p style="color: var(--sl-text-muted);">You haven't practiced this sign yet.</p>
                                        </div>
                                    <?php endif; ?>
                                    <a href="<?= base_url('Practice/category/' . $sign->category_id) ?>" class="sl-btn sl-btn-primary w-100">
                                        <i class="mdi mdi-camera mr-2"></i>Practice This Sign
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Signs -->
                    <?php if (!empty($related_signs) && count($related_signs) > 1): ?>
                        <div class="sl-card">
                            <div class="p-4 border-bottom" style="border-color: var(--sl-border) !important;">
                                <span class="sl-section-subtitle">More to explore</span>
                                <h4 class="font-weight-bold mb-0" style="color: var(--sl-text);">Related Signs</h4>
                            </div>
                            <div class="p-4">
                                <div class="row">
                                    <?php
                                    $count = 0;
                                    foreach ($related_signs as $related):
                                        if ($related->sign_id != $sign->sign_id && $count < 6):
                                            $count++;
                                    ?>
                                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                                                <a href="<?= base_url('FSL/sign_detail/' . $related->sign_id) ?>" class="text-decoration-none">
                                                    <div class="sl-sign-card">
                                                        <div class="sl-sign-preview" style="height: 120px;">
                                                            <?php if ($related->image_path): ?>
                                                                <img src="<?= base_url($related->image_path) ?>" alt="<?= $related->sign_name ?>">
                                                            <?php else: ?>
                                                                <i class="mdi mdi-hand-pointing-right" style="font-size: 36px; color: #94A3B8;"></i>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="sl-sign-name" style="font-size: 0.875rem;"><?= $related->sign_name ?></div>
                                                    </div>
                                                </a>
                                            </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </div>
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