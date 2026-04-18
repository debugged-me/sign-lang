<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('includes/head'); ?>

<body>
    <div id="wrapper">
        <?php $this->load->view('includes/top-nav-bar'); ?>
        <?php $this->load->view('includes/sidebar'); ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid" style="max-width:1400px;">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="mb-2">
                        <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-family:'Manrope',sans-serif;font-size:0.8125rem;">
                            <li class="breadcrumb-item"><a href="<?= base_url('FSL/dictionary') ?>" style="color:var(--sl-text-muted);">Dictionary</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('FSL/dictionary?type=' . $sign->sign_type) ?>" style="color:var(--sl-text-muted);"><?= ucfirst($sign->sign_type) ?></a></li>
                            <li class="breadcrumb-item active" style="color:var(--sl-text);font-weight:600;" aria-current="page"><?= htmlspecialchars($sign->sign_name) ?></li>
                        </ol>
                    </nav>

                    <div class="sl-page-header" style="margin-bottom:28px;">
                        <h1 class="sl-page-title" style="margin-bottom:6px;"><?= htmlspecialchars($sign->sign_name) ?></h1>
                        <p class="sl-page-subtitle">Master the handshape, movement, and context</p>
                    </div>

                    <div class="row">
                        <!-- Visual pane -->
                        <div class="col-lg-5 mb-4">
                            <div class="sl-card" style="padding:20px;border-radius:var(--sl-radius-xl);position:sticky;top:90px;">
                                <div style="position:relative;background:linear-gradient(135deg,#67E8F9 0%,#22D3EE 50%,#0E7490 100%);border-radius:var(--sl-radius-lg);aspect-ratio:1/1;display:flex;align-items:center;justify-content:center;overflow:hidden;margin-bottom:16px;">
                                    <?php if ($sign->image_path && file_exists(FCPATH . $sign->image_path)): ?>
                                        <img src="<?= base_url($sign->image_path) ?>" alt="<?= htmlspecialchars($sign->sign_name) ?>" style="max-width:85%;max-height:85%;object-fit:contain;">
                                    <?php else: ?>
                                        <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:7rem;color:#fff;letter-spacing:-0.04em;text-shadow:0 4px 20px rgba(14,116,144,0.4);"><?= htmlspecialchars(mb_substr($sign->sign_name, 0, 4)) ?></span>
                                    <?php endif; ?>
                                    <span class="sl-badge" style="position:absolute;top:14px;right:14px;background:rgba(15,23,42,0.78);color:#fff;">
                                        <?= ucfirst($sign->sign_type) ?>
                                    </span>
                                </div>

                                <?php if ($sign->video_path): ?>
                                    <video controls class="w-100" style="border-radius:var(--sl-radius);box-shadow:var(--sl-shadow);">
                                        <source src="<?= base_url($sign->video_path) ?>" type="video/mp4">
                                    </video>
                                <?php endif; ?>

                                <a href="<?= base_url('Practice/category/' . $sign->category_id) ?>" class="sl-btn sl-btn-primary sl-btn-pulse w-100 justify-content-center mt-3">
                                    <i class="mdi mdi-camera"></i> Practice This Sign
                                </a>
                            </div>
                        </div>

                        <!-- Info pane -->
                        <div class="col-lg-7">
                            <!-- Meta chips -->
                            <div class="d-flex flex-wrap mb-4" style="gap:10px;">
                                <span class="sl-badge" style="background:rgba(14,116,144,0.12);color:var(--sl-primary);">
                                    <i class="mdi mdi-tag-outline mr-1"></i> <?= ucfirst($sign->sign_type) ?>
                                </span>
                                <?php if ($sign->category_name): ?>
                                    <span class="sl-badge" style="background:var(--sl-surface-low);color:var(--sl-text);">
                                        <i class="mdi mdi-folder-outline mr-1"></i> <?= htmlspecialchars($sign->category_name) ?>
                                    </span>
                                <?php endif; ?>
                                <span class="sl-badge sl-badge-<?= $sign->difficulty_level ?>"><?= ucfirst($sign->difficulty_level) ?></span>
                            </div>

                            <!-- Info blocks -->
                            <?php if ($sign->description): ?>
                                <div class="sl-card mb-3" style="padding:24px;border-radius:var(--sl-radius-lg);">
                                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1rem;color:var(--sl-text);margin:0 0 10px;">
                                        <span style="color:var(--sl-accent);">●</span> Description
                                    </h5>
                                    <p style="color:var(--sl-body-text);font-family:'Manrope',sans-serif;font-size:0.9375rem;line-height:1.65;margin:0;"><?= $sign->description ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if ($sign->handshape_description): ?>
                                <div class="sl-card mb-3" style="padding:24px;border-radius:var(--sl-radius-lg);">
                                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1rem;color:var(--sl-text);margin:0 0 10px;">
                                        <span style="color:var(--sl-accent);">●</span> Handshape
                                    </h5>
                                    <p style="color:var(--sl-body-text);font-family:'Manrope',sans-serif;font-size:0.9375rem;line-height:1.65;margin:0;"><?= $sign->handshape_description ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if ($sign->movement_description): ?>
                                <div class="sl-card mb-3" style="padding:24px;border-radius:var(--sl-radius-lg);">
                                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1rem;color:var(--sl-text);margin:0 0 10px;">
                                        <span style="color:var(--sl-accent);">●</span> Movement
                                    </h5>
                                    <p style="color:var(--sl-body-text);font-family:'Manrope',sans-serif;font-size:0.9375rem;line-height:1.65;margin:0;"><?= $sign->movement_description ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if ($sign->usage_example): ?>
                                <div style="background:linear-gradient(135deg,#ECFEFF 0%,#CFFAFE 100%);border-radius:var(--sl-radius-lg);padding:22px 24px;margin-bottom:16px;">
                                    <p style="font-family:'Manrope',sans-serif;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.14em;color:var(--sl-primary-dark);font-weight:700;margin:0 0 6px;">Usage Example</p>
                                    <p style="color:var(--sl-text);font-family:'Plus Jakarta Sans',sans-serif;font-style:italic;font-size:1rem;line-height:1.5;margin:0;">
                                        <i class="mdi mdi-format-quote-open" style="color:var(--sl-primary);"></i>
                                        <?= $sign->usage_example ?>
                                    </p>
                                </div>
                            <?php endif; ?>

                            <!-- Progress -->
                            <div class="sl-card" style="padding:24px;border-radius:var(--sl-radius-lg);">
                                <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1rem;color:var(--sl-text);margin:0 0 16px;">Your Progress</h5>
                                <?php if ($user_progress): ?>
                                    <div class="row">
                                        <div class="col-4 text-center">
                                            <div style="margin-bottom:6px;">
                                                <span class="sl-badge <?= $user_progress->status == 'mastered' ? 'sl-badge-mastered' : ($user_progress->status == 'practiced' ? 'sl-badge-intermediate' : '') ?>"
                                                    style="<?= $user_progress->status == 'new' ? 'background:var(--sl-surface-low);color:var(--sl-text-muted);' : '' ?>">
                                                    <?= ucfirst($user_progress->status) ?>
                                                </span>
                                            </div>
                                            <p style="color:var(--sl-text-muted);font-size:0.75rem;margin:0;">Status</p>
                                        </div>
                                        <div class="col-4 text-center">
                                            <div class="sl-stat-value" style="font-size:1.5rem;" data-plugin="counterup"><?= $user_progress->practice_count ?></div>
                                            <p style="color:var(--sl-text-muted);font-size:0.75rem;margin:0;">Practice Count</p>
                                        </div>
                                        <div class="col-4 text-center">
                                            <div class="sl-stat-value" style="font-size:1.5rem;color:<?= $user_progress->average_score >= 80 ? 'var(--sl-success)' : ($user_progress->average_score >= 60 ? 'var(--sl-warning)' : 'var(--sl-danger)') ?>;">
                                                <?= round($user_progress->average_score, 1) ?>%
                                            </div>
                                            <p style="color:var(--sl-text-muted);font-size:0.75rem;margin:0;">Accuracy</p>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-3">
                                        <i class="mdi mdi-school-outline" style="font-size:42px;color:var(--sl-text-soft);"></i>
                                        <p style="color:var(--sl-text-muted);margin:8px 0 0;font-size:0.875rem;">You haven't practiced this sign yet.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Related signs -->
                    <?php if (!empty($related_signs) && count($related_signs) > 1): ?>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between align-items-end mb-3">
                                <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.375rem;color:var(--sl-text);margin:0;">Related Signs</h3>
                                <a href="<?= base_url('FSL/dictionary') ?>" style="color:var(--sl-primary);font-weight:700;font-size:0.8125rem;text-decoration:none;">View all →</a>
                            </div>
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
                                                <div class="sl-sign-preview" style="height:110px;">
                                                    <?php if ($related->image_path): ?>
                                                        <img src="<?= base_url($related->image_path) ?>" alt="<?= htmlspecialchars($related->sign_name) ?>">
                                                    <?php else: ?>
                                                        <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2rem;color:var(--sl-primary);"><?= htmlspecialchars(mb_substr($related->sign_name, 0, 3)) ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="sl-sign-name" style="font-size:0.9375rem;"><?= htmlspecialchars($related->sign_name) ?></div>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                                    endif;
                                endforeach;
                                ?>
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
