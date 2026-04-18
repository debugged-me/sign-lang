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
                            <li class="breadcrumb-item"><a href="<?= base_url('FSL/lessons') ?>" style="color:var(--sl-text-muted);">Lessons</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('FSL/lessons') ?>" style="color:var(--sl-text-muted);"><?= ucfirst($lesson->difficulty_level) ?></a></li>
                            <li class="breadcrumb-item active" style="color:var(--sl-text);font-weight:600;" aria-current="page"><?= htmlspecialchars($lesson->lesson_title) ?></li>
                        </ol>
                    </nav>

                    <!-- Title + Progress -->
                    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4" style="gap:16px;">
                        <div>
                            <h1 class="sl-page-title" style="margin-bottom:6px;"><?= htmlspecialchars($lesson->lesson_title) ?></h1>
                            <p class="sl-page-subtitle" style="max-width:680px;"><?= htmlspecialchars($lesson->lesson_description) ?></p>
                        </div>
                        <div style="min-width:240px;">
                            <div class="d-flex justify-content-between small mb-2" style="font-family:'Manrope',sans-serif;">
                                <span style="color:var(--sl-text-muted);font-weight:600;">Module Progress</span>
                                <span style="color:var(--sl-primary);font-weight:700;"><?= $user_progress['progress_percentage'] ?>%</span>
                            </div>
                            <div class="sl-progress"><div class="sl-progress-bar" style="width:<?= $user_progress['progress_percentage'] ?>%;"></div></div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Main column -->
                        <div class="col-lg-8 mb-4">
                            <!-- Illustrated sign card -->
                            <div style="background:linear-gradient(135deg,#67E8F9 0%,#22D3EE 45%,#0E7490 100%);border-radius:var(--sl-radius-xl);padding:32px;position:relative;overflow:hidden;box-shadow:0 20px 50px rgba(14,116,144,0.22);margin-bottom:24px;min-height:280px;">
                                <div class="row align-items-center" style="position:relative;z-index:2;">
                                    <div class="col-md-7">
                                        <div style="display:inline-flex;align-items:center;justify-content:center;width:160px;height:200px;background:rgba(255,255,255,0.12);backdrop-filter:blur(8px);border-radius:var(--sl-radius-lg);">
                                            <i class="mdi mdi-human-handsup" style="font-size:120px;color:#fff;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text-md-right mt-3 mt-md-0">
                                        <div style="background:rgba(15,23,42,0.85);border-radius:var(--sl-radius);padding:14px;display:inline-block;box-shadow:0 8px 24px rgba(0,0,0,0.22);">
                                            <div style="background:#0F172A;border-radius:var(--sl-radius-sm);aspect-ratio:16/10;width:200px;display:flex;align-items:center;justify-content:center;">
                                                <i class="mdi mdi-video-outline" style="color:var(--sl-accent);font-size:40px;"></i>
                                            </div>
                                            <p style="color:#fff;font-family:'Manrope',sans-serif;font-size:0.75rem;margin:8px 0 0;text-align:center;">Video Demo</p>
                                        </div>
                                    </div>
                                </div>
                                <div style="position:absolute;bottom:-30px;left:20px;right:20px;height:6px;background:rgba(255,255,255,0.25);border-radius:var(--sl-radius-full);"></div>
                            </div>

                            <!-- Numbered steps -->
                            <div class="row">
                                <?php
                                $steps = [
                                    ['num' => '1', 'title' => 'Hand Shape', 'desc' => 'Place fingers together, flat and slightly angled against the palm.', 'icon' => 'mdi-hand-back-right-outline'],
                                    ['num' => '2', 'title' => 'Starting Point', 'desc' => 'Touch the fingertips of your dominant hand to your forehead or temple.', 'icon' => 'mdi-target'],
                                    ['num' => '3', 'title' => 'The Movement', 'desc' => 'Move the hand outward and slightly downward in a small arc motion.', 'icon' => 'mdi-arrow-expand-all'],
                                ];
                                foreach ($steps as $step):
                                ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="sl-card h-100" style="padding:22px;border-radius:var(--sl-radius-lg);text-align:center;">
                                            <div style="width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--sl-primary) 0%,var(--sl-primary-dark) 100%);color:#fff;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.125rem;box-shadow:0 6px 16px rgba(14,116,144,0.28);">
                                                <?= $step['num'] ?>
                                            </div>
                                            <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.0625rem;color:var(--sl-text);margin:0 0 8px;"><?= $step['title'] ?></h5>
                                            <p style="color:var(--sl-text-muted);font-family:'Manrope',sans-serif;font-size:0.875rem;line-height:1.5;margin:0;"><?= $step['desc'] ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Signs in this lesson -->
                            <div class="sl-card mt-3" style="padding:26px;border-radius:var(--sl-radius-lg);">
                                <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.125rem;color:var(--sl-text);margin:0 0 18px;">Signs in this lesson</h4>
                                <div class="row">
                                    <?php foreach ($lesson->signs as $index => $sign): ?>
                                        <div class="col-md-3 col-sm-6 mb-3">
                                            <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="text-decoration-none">
                                                <div class="sl-sign-card h-100" style="position:relative;">
                                                    <span style="position:absolute;top:10px;left:10px;width:26px;height:26px;background:linear-gradient(135deg,var(--sl-primary),var(--sl-primary-dark));color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.75rem;z-index:2;">
                                                        <?= $index + 1 ?>
                                                    </span>
                                                    <div class="sl-sign-preview" style="height:120px;">
                                                        <?php if ($sign->image_path && file_exists(FCPATH . $sign->image_path)): ?>
                                                            <img src="<?= base_url($sign->image_path) ?>" alt="<?= htmlspecialchars($sign->sign_name) ?>">
                                                        <?php else: ?>
                                                            <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2rem;color:var(--sl-primary);"><?= htmlspecialchars(mb_substr($sign->sign_name, 0, 3)) ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="sl-sign-name" style="font-size:0.9375rem;"><?= htmlspecialchars($sign->sign_name) ?></div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="col-lg-4 mb-4">
                            <!-- Common Mistakes -->
                            <div style="background:linear-gradient(135deg,#FEE2E2 0%,#FECACA 100%);border-radius:var(--sl-radius-lg);padding:22px;margin-bottom:20px;">
                                <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1rem;color:#991B1B;margin:0 0 14px;">
                                    <i class="mdi mdi-alert-circle-outline mr-1"></i> Common Mistakes
                                </h5>
                                <div style="margin-bottom:12px;">
                                    <p style="font-weight:700;color:#991B1B;margin:0 0 3px;font-size:0.875rem;">Wrist Tension</p>
                                    <p style="color:#7F1D1D;font-family:'Manrope',sans-serif;font-size:0.8125rem;line-height:1.5;margin:0;">Don't keep your wrist too stiff. Let the movement flow naturally from the elbow.</p>
                                </div>
                                <div>
                                    <p style="font-weight:700;color:#991B1B;margin:0 0 3px;font-size:0.875rem;">Placement</p>
                                    <p style="color:#7F1D1D;font-family:'Manrope',sans-serif;font-size:0.8125rem;line-height:1.5;margin:0;">Avoid starting the sign from your chest — keep it near the head.</p>
                                </div>
                            </div>

                            <!-- Master this sign CTA -->
                            <div class="sl-card" style="padding:24px;border-radius:var(--sl-radius-lg);margin-bottom:20px;">
                                <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.0625rem;color:var(--sl-text);margin:0 0 10px;">Master this Sign</h5>
                                <p style="color:var(--sl-text-muted);font-family:'Manrope',sans-serif;font-size:0.875rem;line-height:1.55;margin:0 0 18px;">Use your camera to review your form and get real-time feedback on hand positioning and movement.</p>
                                <a href="<?= base_url('Practice/lesson/' . $lesson->lesson_id) ?>" class="sl-btn sl-btn-primary sl-btn-pulse w-100 justify-content-center">
                                    <i class="mdi mdi-camera"></i> Practice this Sign
                                </a>
                                <div class="d-flex align-items-center justify-content-between mt-3" style="color:var(--sl-text-muted);font-size:0.75rem;">
                                    <div class="d-flex align-items-center" style="gap:6px;">
                                        <span style="width:8px;height:8px;border-radius:50%;background:var(--sl-success);"></span>
                                        <span>Practising now</span>
                                    </div>
                                    <div class="d-flex" style="gap:-6px;">
                                        <span style="width:22px;height:22px;border-radius:50%;background:var(--sl-surface-high);display:inline-block;"></span>
                                        <span style="width:22px;height:22px;border-radius:50%;background:var(--sl-accent-soft);display:inline-block;margin-left:-6px;"></span>
                                        <span style="width:22px;height:22px;border-radius:50%;background:var(--sl-primary);display:inline-block;margin-left:-6px;"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Coming up -->
                            <?php if (isset($next_lesson)): ?>
                                <div style="background:linear-gradient(135deg,#D1FAE5 0%,#A7F3D0 100%);border-radius:var(--sl-radius-lg);padding:20px;">
                                    <span class="sl-badge" style="background:rgba(6,95,70,0.18);color:#064E3B;margin-bottom:10px;">Coming Up</span>
                                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9375rem;color:#064E3B;margin:6px 0 4px;line-height:1.35;"><?= htmlspecialchars($next_lesson->lesson_title) ?></h5>
                                    <a href="<?= base_url('FSL/lesson/' . $next_lesson->lesson_id) ?>" style="color:#047857;font-family:'Manrope',sans-serif;font-size:0.8125rem;font-weight:600;text-decoration:none;">Learn about the next step →</a>
                                </div>
                            <?php endif; ?>
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
