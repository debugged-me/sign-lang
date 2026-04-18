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

                    <!-- Hero + Continue Learning Bento -->
                    <section class="row" style="margin-bottom:28px;">
                        <div class="col-lg-8 mb-4 mb-lg-0">
                            <div class="sl-hero h-100" style="min-height:260px;">
                                <div style="position:relative;z-index:2;">
                                    <span class="sl-badge" style="background:rgba(255,255,255,0.22);color:#fff;backdrop-filter:blur(8px);padding:6px 14px;margin-bottom:14px;">
                                        Welcome Back, <?= htmlspecialchars($this->session->userdata('fname')) ?>
                                    </span>
                                    <h2 style="color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(1.75rem,3vw,2.75rem);line-height:1.1;letter-spacing:-0.025em;margin:8px 0 14px;">
                                        Your FSL journey is <?= $stats['overall_accuracy'] ?>% along.
                                    </h2>
                                    <p style="color:rgba(255,255,255,0.88);font-family:'Manrope',sans-serif;font-size:1.0625rem;line-height:1.6;max-width:520px;margin-bottom:22px;">
                                        You've learned <?= $stats['total_learned'] ?> signs and mastered <?= $stats['mastered'] ?>. Keep the momentum going.
                                    </p>
                                    <div class="d-flex flex-wrap" style="gap:12px;">
                                        <a href="<?= base_url('Practice/free_practice') ?>" class="sl-btn sl-btn-pulse" style="background:#fff;color:var(--sl-primary-dark);font-weight:700;">
                                            <i class="mdi mdi-play-circle"></i> Resume Practice
                                        </a>
                                        <a href="<?= base_url('FSL/progress') ?>" class="sl-btn" style="background:rgba(255,255,255,0.14);color:#fff;backdrop-filter:blur(10px);">
                                            View Goals
                                        </a>
                                    </div>
                                </div>
                                <div style="position:absolute;right:-40px;bottom:-40px;width:260px;height:260px;background:var(--sl-accent);opacity:0.14;border-radius:50%;filter:blur(60px);"></div>
                                <div style="position:absolute;right:40px;top:30px;opacity:0.15;font-size:140px;line-height:1;">
                                    <i class="mdi mdi-hand-wave"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Continue Learning bento -->
                        <div class="col-lg-4">
                            <?php
                            $nextLesson = !empty($recent_lessons) ? $recent_lessons[0] : null;
                            $nextPct = $nextLesson && isset($nextLesson->progress['progress_percentage']) ? $nextLesson->progress['progress_percentage'] : 0;
                            ?>
                            <div class="sl-card h-100" style="padding:24px;border-radius:var(--sl-radius-xl);">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.125rem;color:var(--sl-text);margin:0;">Continue Learning</h3>
                                    <?php if ($nextLesson): ?>
                                        <span class="sl-badge sl-badge-<?= $nextLesson->difficulty_level ?>"><?= ucfirst($nextLesson->difficulty_level) ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if ($nextLesson): ?>
                                    <a href="<?= base_url('FSL/lesson/' . $nextLesson->lesson_id) ?>" class="d-block text-decoration-none" style="color:inherit;">
                                        <div style="position:relative;border-radius:var(--sl-radius);overflow:hidden;aspect-ratio:16/10;background:linear-gradient(135deg,var(--sl-primary) 0%,var(--sl-primary-dark) 100%);margin-bottom:16px;display:flex;align-items:center;justify-content:center;">
                                            <i class="mdi mdi-play-circle" style="color:#fff;font-size:64px;opacity:0.85;"></i>
                                            <div style="position:absolute;inset:0;background:radial-gradient(circle at 30% 30%,rgba(34,211,238,0.25),transparent 60%);"></div>
                                        </div>
                                        <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.0625rem;color:var(--sl-text);margin-bottom:6px;"><?= htmlspecialchars($nextLesson->lesson_title) ?></h4>
                                        <p style="color:var(--sl-text-muted);font-size:0.875rem;margin-bottom:14px;">
                                            <?= isset($nextLesson->total_signs) ? $nextLesson->total_signs : 0 ?> signs · <?= ucfirst($nextLesson->difficulty_level) ?>
                                        </p>
                                        <div class="d-flex justify-content-between small mb-1" style="color:var(--sl-text-muted);font-weight:600;">
                                            <span>Lesson Progress</span>
                                            <span style="color:var(--sl-primary);"><?= $nextPct ?>%</span>
                                        </div>
                                        <div class="sl-progress"><div class="sl-progress-bar" style="width:<?= $nextPct ?>%;"></div></div>
                                    </a>
                                <?php else: ?>
                                    <div class="sl-empty-state" style="padding:40px 16px;">
                                        <i class="mdi mdi-school-outline"></i>
                                        <p style="color:var(--sl-text-muted);margin:0 0 14px;">No lesson started yet.</p>
                                        <a href="<?= base_url('FSL/lessons') ?>" class="sl-btn sl-btn-primary">Start a Lesson</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>

                    <!-- Stat Grid -->
                    <section class="row" style="margin-bottom:28px;">
                        <div class="col-lg-3 col-sm-6 mb-3">
                            <div class="sl-stat-card sl-card-animated d-flex align-items-center" style="gap:18px;padding:22px;">
                                <div class="sl-stat-icon accent" style="margin-bottom:0;"><i class="mdi mdi-fire"></i></div>
                                <div>
                                    <p style="font-size:0.6875rem;text-transform:uppercase;letter-spacing:0.14em;font-weight:700;color:var(--sl-text-muted);margin:0 0 4px;">Signs Learned</p>
                                    <p class="sl-stat-value" style="font-size:1.75rem;margin:0;" data-plugin="counterup"><?= $stats['total_learned'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-3">
                            <div class="sl-stat-card sl-card-animated d-flex align-items-center" style="gap:18px;padding:22px;">
                                <div class="sl-stat-icon primary" style="margin-bottom:0;"><i class="mdi mdi-hand-wave"></i></div>
                                <div>
                                    <p style="font-size:0.6875rem;text-transform:uppercase;letter-spacing:0.14em;font-weight:700;color:var(--sl-text-muted);margin:0 0 4px;">Mastered</p>
                                    <p class="sl-stat-value" style="font-size:1.75rem;margin:0;" data-plugin="counterup"><?= $stats['mastered'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-3">
                            <div class="sl-stat-card sl-card-animated d-flex align-items-center" style="gap:18px;padding:22px;">
                                <div class="sl-stat-icon success" style="margin-bottom:0;"><i class="mdi mdi-trophy-outline"></i></div>
                                <div>
                                    <p style="font-size:0.6875rem;text-transform:uppercase;letter-spacing:0.14em;font-weight:700;color:var(--sl-text-muted);margin:0 0 4px;">Sessions</p>
                                    <p class="sl-stat-value" style="font-size:1.75rem;margin:0;" data-plugin="counterup"><?= $stats['total_sessions'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-3">
                            <div class="sl-stat-card sl-card-animated d-flex align-items-center" style="gap:18px;padding:22px;">
                                <div class="sl-stat-icon secondary" style="margin-bottom:0;"><i class="mdi mdi-target"></i></div>
                                <div>
                                    <p style="font-size:0.6875rem;text-transform:uppercase;letter-spacing:0.14em;font-weight:700;color:var(--sl-text-muted);margin:0 0 4px;">Accuracy</p>
                                    <p class="sl-stat-value" style="font-size:1.75rem;margin:0;"><span data-plugin="counterup"><?= $stats['overall_accuracy'] ?></span>%</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Recommended + Categories panel -->
                    <section class="row">
                        <div class="col-lg-8 mb-4">
                            <?php
                            $__signs       = is_array($featured_signs) ? $featured_signs : [];
                            $__total       = count($__signs);
                            $__recLimit    = min(2, $__total);
                            $__recommended = array_slice($__signs, 0, $__recLimit);
                            $__quickBrowse = $__total > 2 ? array_slice($__signs, 2, 6) : [];
                            ?>

                            <div class="d-flex justify-content-between align-items-end mb-3">
                                <div>
                                    <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.5rem;color:var(--sl-text);margin:0;">Recommended for You</h3>
                                    <p style="color:var(--sl-text-muted);margin:2px 0 0;font-size:0.9375rem;">Based on your learning progress</p>
                                </div>
                                <a href="<?= base_url('FSL/dictionary') ?>" style="color:var(--sl-primary);font-weight:700;font-size:0.875rem;text-decoration:none;">Explore Library →</a>
                            </div>

                            <?php if (!empty($__recommended)): ?>
                                <div class="row">
                                    <?php foreach ($__recommended as $sign): ?>
                                        <div class="col-md-6 mb-3">
                                            <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="text-decoration-none">
                                                <div class="sl-lesson-card h-100" style="overflow:hidden;">
                                                    <div style="position:relative;height:180px;background:linear-gradient(135deg,var(--sl-surface-low) 0%,#ECFEFF 100%);overflow:hidden;">
                                                        <?php if ($sign->image_path): ?>
                                                            <img src="<?= base_url($sign->image_path) ?>" alt="<?= htmlspecialchars($sign->sign_name) ?>" style="width:100%;height:100%;object-fit:cover;">
                                                        <?php else: ?>
                                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                                <i class="mdi mdi-hand-pointing-right" style="font-size:72px;color:var(--sl-primary);opacity:0.4;"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div style="position:absolute;top:14px;right:14px;">
                                                            <span class="sl-badge" style="background:rgba(14,116,144,0.9);color:#fff;"><?= ucfirst($sign->sign_type) ?></span>
                                                        </div>
                                                    </div>
                                                    <div style="padding:20px;">
                                                        <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.0625rem;color:var(--sl-text);margin-bottom:6px;"><?= htmlspecialchars($sign->sign_name) ?></h4>
                                                        <p style="color:var(--sl-text-muted);font-size:0.875rem;margin-bottom:14px;line-height:1.5;">Tap to learn the handshape, movement, and context.</p>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="d-flex align-items-center" style="gap:6px;color:var(--sl-text-muted);font-size:0.8125rem;">
                                                                <i class="mdi mdi-clock-outline" style="color:var(--sl-primary);"></i> Quick view
                                                            </div>
                                                            <span style="width:36px;height:36px;border-radius:50%;background:rgba(14,116,144,0.1);color:var(--sl-primary);display:inline-flex;align-items:center;justify-content:center;">
                                                                <i class="mdi mdi-plus"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <!-- Fallback: route users to Dictionary + Lessons when nothing is featured yet -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <a href="<?= base_url('FSL/dictionary') ?>" class="text-decoration-none">
                                            <div class="sl-lesson-card h-100" style="overflow:hidden;">
                                                <div style="position:relative;height:180px;background:linear-gradient(135deg,#67E8F9 0%,#22D3EE 50%,#0E7490 100%);display:flex;align-items:center;justify-content:center;">
                                                    <i class="mdi mdi-book-open-page-variant-outline" style="font-size:80px;color:#fff;opacity:0.85;"></i>
                                                </div>
                                                <div style="padding:20px;">
                                                    <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.0625rem;color:var(--sl-text);margin-bottom:6px;">Explore the Dictionary</h4>
                                                    <p style="color:var(--sl-text-muted);font-size:0.875rem;margin-bottom:14px;line-height:1.5;">Browse every sign in the library — alphabet, numbers, and everyday words.</p>
                                                    <span class="sl-btn sl-btn-outline" style="padding:8px 18px;font-size:0.8125rem;">Open Dictionary →</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <a href="<?= base_url('FSL/lessons') ?>" class="text-decoration-none">
                                            <div class="sl-lesson-card h-100" style="overflow:hidden;">
                                                <div style="position:relative;height:180px;background:linear-gradient(135deg,#155E75 0%,#0891B2 50%,#22D3EE 100%);display:flex;align-items:center;justify-content:center;">
                                                    <i class="mdi mdi-school-outline" style="font-size:80px;color:#fff;opacity:0.85;"></i>
                                                </div>
                                                <div style="padding:20px;">
                                                    <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.0625rem;color:var(--sl-text);margin-bottom:6px;">Start a Guided Lesson</h4>
                                                    <p style="color:var(--sl-text-muted);font-size:0.875rem;margin-bottom:14px;line-height:1.5;">Structured modules from beginner to advanced — learn at your own pace.</p>
                                                    <span class="sl-btn sl-btn-outline" style="padding:8px 18px;font-size:0.8125rem;">Browse Lessons →</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Featured Signs Strip / Quick Browse -->
                            <?php if (!empty($__quickBrowse)): ?>
                                <div class="d-flex justify-content-between align-items-end mb-3 mt-4">
                                    <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.125rem;color:var(--sl-text);margin:0;">Quick Browse</h4>
                                    <a href="<?= base_url('FSL/dictionary') ?>" style="color:var(--sl-primary);font-weight:600;font-size:0.8125rem;text-decoration:none;">View all →</a>
                                </div>
                                <div class="row">
                                    <?php foreach ($__quickBrowse as $sign): ?>
                                        <div class="col-lg-4 col-md-4 col-6 mb-3">
                                            <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="text-decoration-none">
                                                <div class="sl-sign-card">
                                                    <div class="sl-sign-preview" style="height:110px;">
                                                        <?php if ($sign->image_path): ?>
                                                            <img src="<?= base_url($sign->image_path) ?>" alt="<?= htmlspecialchars($sign->sign_name) ?>">
                                                        <?php else: ?>
                                                            <i class="mdi mdi-hand-pointing-right" style="font-size:36px;color:var(--sl-primary);opacity:0.45;"></i>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="sl-sign-name" style="font-size:0.9375rem;"><?= htmlspecialchars($sign->sign_name) ?></div>
                                                    <div class="sl-sign-type"><?= ucfirst($sign->sign_type) ?></div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <!-- Fallback strip: Jump Back In uses recent lessons when no extra signs are featured -->
                                <?php if (!empty($recent_lessons)): ?>
                                    <div class="d-flex justify-content-between align-items-end mb-3 mt-4">
                                        <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.125rem;color:var(--sl-text);margin:0;">Jump Back In</h4>
                                        <a href="<?= base_url('FSL/lessons') ?>" style="color:var(--sl-primary);font-weight:600;font-size:0.8125rem;text-decoration:none;">All lessons →</a>
                                    </div>
                                    <div class="row">
                                        <?php foreach (array_slice($recent_lessons, 0, 3) as $l):
                                            $lp = isset($l->user_progress) ? $l->user_progress : ['progress_percentage' => 0];
                                        ?>
                                            <div class="col-md-4 col-6 mb-3">
                                                <a href="<?= base_url('FSL/lesson/' . $l->lesson_id) ?>" class="text-decoration-none">
                                                    <div class="sl-sign-card" style="text-align:left;">
                                                        <div class="sl-sign-preview" style="height:90px;background:linear-gradient(135deg,var(--sl-primary) 0%,var(--sl-primary-dark) 100%);">
                                                            <i class="mdi mdi-play-circle" style="font-size:38px;color:#fff;opacity:0.9;"></i>
                                                        </div>
                                                        <div class="sl-sign-name" style="font-size:0.9375rem;"><?= htmlspecialchars($l->lesson_title) ?></div>
                                                        <div class="sl-sign-type"><?= ucfirst($l->difficulty_level) ?> · <?= $lp['progress_percentage'] ?>%</div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <!-- Categories / Side Panel -->
                        <div class="col-lg-4 mb-4">
                            <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.5rem;color:var(--sl-text);margin:0 0 16px;">Browse Topics</h3>
                            <div class="sl-card" style="padding:24px;border-radius:var(--sl-radius-xl);">
                                <div class="d-flex align-items-center mb-4" style="gap:14px;">
                                    <div style="width:48px;height:48px;background:rgba(34,211,238,0.18);color:var(--sl-primary);display:flex;align-items:center;justify-content:center;border-radius:var(--sl-radius);">
                                        <i class="mdi mdi-shape-outline" style="font-size:1.5rem;"></i>
                                    </div>
                                    <div>
                                        <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1rem;color:var(--sl-text);margin:0;">Categories</h4>
                                        <p style="color:var(--sl-text-muted);font-size:0.8125rem;margin:0;"><?= count($categories) ?> topics available</p>
                                    </div>
                                </div>
                                <div style="display:flex;flex-direction:column;gap:8px;">
                                    <?php foreach ($categories as $i => $category): ?>
                                        <a href="<?= base_url('FSL/category/' . $category->category_id) ?>"
                                            class="d-flex align-items-center justify-content-between text-decoration-none"
                                            style="padding:12px 14px;border-radius:var(--sl-radius);background:<?= $i === 0 ? 'rgba(14,116,144,0.06)' : 'var(--sl-surface-low)' ?>;color:var(--sl-text);transition:all 0.25s;">
                                            <div class="d-flex align-items-center" style="gap:12px;">
                                                <span style="width:28px;height:28px;border-radius:50%;background:var(--sl-surface);color:var(--sl-text-muted);display:inline-flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;"><?= $i + 1 ?></span>
                                                <span style="font-family:'Manrope',sans-serif;font-weight:600;font-size:0.9rem;"><?= htmlspecialchars($category->category_name) ?></span>
                                            </div>
                                            <i class="mdi mdi-chevron-right" style="color:var(--sl-text-muted);"></i>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                                <a href="<?= base_url('FSL/dictionary') ?>" class="sl-btn sl-btn-outline w-100 justify-content-center mt-3">
                                    Explore Full Dictionary
                                </a>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
            <?php $this->load->view('includes/footer'); ?>
        </div>
    </div>

    <!-- FAB — Quick Practice -->
    <a href="<?= base_url('Practice/free_practice') ?>"
        title="Start Quick Practice"
        style="position:fixed;bottom:28px;right:28px;width:62px;height:62px;border-radius:50%;background:linear-gradient(135deg,var(--sl-primary) 0%,var(--sl-primary-dark) 100%);color:#fff;display:flex;align-items:center;justify-content:center;box-shadow:0 14px 32px rgba(14,116,144,0.35);z-index:50;transition:transform 0.25s;text-decoration:none;"
        onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
        <i class="mdi mdi-camera-plus-outline" style="font-size:1.75rem;"></i>
    </a>

    <?php $this->load->view('includes/footer_plugins'); ?>
</body>

</html>
