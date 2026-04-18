<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('includes/head'); ?>

<body>
    <div id="wrapper">
        <?php $this->load->view('includes/top-nav-bar'); ?>
        <?php $this->load->view('includes/sidebar'); ?>

        <?php
        $activeLevel = $this->input->get('difficulty');

        // Level metadata (distinct gradients)
        $levelMeta = [
            'beginner'     => ['from' => '#0E7490', 'to' => '#22D3EE', 'soft' => '#CFFAFE', 'text' => '#0E7490', 'icon' => 'mdi-seed-outline', 'label' => 'Beginner'],
            'intermediate' => ['from' => '#B45309', 'to' => '#FCD34D', 'soft' => '#FEF3C7', 'text' => '#B45309', 'icon' => 'mdi-leaf',         'label' => 'Intermediate'],
            'advanced'     => ['from' => '#5B21B6', 'to' => '#A78BFA', 'soft' => '#EDE9FE', 'text' => '#5B21B6', 'icon' => 'mdi-tree-outline', 'label' => 'Advanced'],
        ];

        // Count lessons per level + completion
        $levelCounts = ['beginner' => 0, 'intermediate' => 0, 'advanced' => 0, 'completed' => 0];
        foreach ($lessons as $l) {
            if (isset($levelCounts[$l->difficulty_level])) { $levelCounts[$l->difficulty_level]++; }
            if (!empty($l->user_progress['is_completed'])) { $levelCounts['completed']++; }
        }
        $totalLessons = count($lessons);
        $overallPct = $totalLessons > 0 ? round(($levelCounts['completed'] / $totalLessons) * 100) : 0;
        ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid" style="max-width:1400px;">

                    <!-- Hero: learning path intro -->
                    <div class="sl-hero mb-4" style="padding:36px;min-height:220px;">
                        <div class="row align-items-center" style="position:relative;z-index:2;">
                            <div class="col-lg-8">
                                <span class="sl-badge" style="background:rgba(255,255,255,0.22);color:#fff;margin-bottom:10px;">
                                    <i class="mdi mdi-school-outline mr-1"></i> Guided Learning Path
                                </span>
                                <h1 style="color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(1.75rem,3vw,2.5rem);margin:8px 0 12px;letter-spacing:-0.025em;line-height:1.1;">
                                    FSL Lessons
                                </h1>
                                <p style="color:rgba(255,255,255,0.92);font-family:'Manrope',sans-serif;font-size:1rem;line-height:1.6;max-width:560px;margin:0 0 18px;">
                                    Step-by-step modules from alphabet basics to fluent conversation. Each lesson unlocks the next — progress at your own pace.
                                </p>
                                <div style="max-width:480px;">
                                    <div class="d-flex justify-content-between small mb-2" style="font-family:'Manrope',sans-serif;">
                                        <span style="color:rgba(255,255,255,0.85);font-weight:600;">Overall Journey</span>
                                        <span style="color:#fff;font-weight:700;"><?= $levelCounts['completed'] ?> / <?= $totalLessons ?> · <?= $overallPct ?>%</span>
                                    </div>
                                    <div style="height:10px;background:rgba(255,255,255,0.22);border-radius:var(--sl-radius-full);overflow:hidden;">
                                        <div style="height:100%;width:<?= $overallPct ?>%;background:linear-gradient(90deg,#fff,var(--sl-accent));border-radius:var(--sl-radius-full);"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 d-none d-lg-flex justify-content-end">
                                <div style="position:relative;width:180px;height:180px;">
                                    <div style="position:absolute;inset:0;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.22) 0%,transparent 70%);"></div>
                                    <div style="position:absolute;inset:14px;border-radius:50%;background:rgba(255,255,255,0.10);backdrop-filter:blur(16px);display:flex;align-items:center;justify-content:center;">
                                        <i class="mdi mdi-book-open-page-variant-outline" style="font-size:100px;color:#fff;opacity:0.95;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Level breakdown stat row -->
                    <div class="row" style="margin-bottom:22px;">
                        <?php foreach ($levelMeta as $lvl => $m): ?>
                            <div class="col-md-4 col-6 mb-3">
                                <a href="<?= base_url('FSL/lessons?difficulty=' . $lvl) ?>" class="text-decoration-none">
                                    <div class="sl-card sl-card-animated d-flex align-items-center" style="gap:14px;padding:18px 20px;border-radius:var(--sl-radius-lg);<?= $activeLevel === $lvl ? 'outline:2px solid '.$m['from'].';outline-offset:-2px;box-shadow:0 14px 32px rgba(14,116,144,0.14);' : '' ?>">
                                        <div style="width:52px;height:52px;border-radius:14px;background:linear-gradient(135deg,<?= $m['from'] ?> 0%,<?= $m['to'] ?> 100%);color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 6px 16px rgba(0,0,0,0.08);">
                                            <i class="mdi <?= $m['icon'] ?>" style="font-size:1.4rem;"></i>
                                        </div>
                                        <div style="min-width:0;">
                                            <p style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.5rem;color:var(--sl-text);margin:0;line-height:1;letter-spacing:-0.02em;"><?= $levelCounts[$lvl] ?></p>
                                            <p style="color:var(--sl-text-muted);font-size:0.75rem;margin:4px 0 0;text-transform:uppercase;letter-spacing:0.12em;font-weight:700;"><?= $m['label'] ?> Modules</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Filter pills -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4" style="gap:12px;">
                        <div class="sl-filter-group">
                            <a href="<?= base_url('FSL/lessons') ?>" class="sl-filter-btn <?= !$activeLevel ? 'active' : '' ?>">All Levels</a>
                            <a href="<?= base_url('FSL/lessons?difficulty=beginner') ?>" class="sl-filter-btn <?= $activeLevel == 'beginner' ? 'active' : '' ?>">Beginner</a>
                            <a href="<?= base_url('FSL/lessons?difficulty=intermediate') ?>" class="sl-filter-btn <?= $activeLevel == 'intermediate' ? 'active' : '' ?>">Intermediate</a>
                            <a href="<?= base_url('FSL/lessons?difficulty=advanced') ?>" class="sl-filter-btn <?= $activeLevel == 'advanced' ? 'active' : '' ?>">Advanced</a>
                        </div>
                        <span style="color:var(--sl-text-muted);font-size:0.8125rem;"><?= $totalLessons ?> <?= $totalLessons === 1 ? 'module' : 'modules' ?> available</span>
                    </div>

                    <!-- Lesson grid -->
                    <div class="row">
                        <?php
                        // Rotating icon set so cards don't all look identical
                        $lessonIcons = ['mdi-hand-back-right-outline', 'mdi-hand-wave', 'mdi-numeric', 'mdi-alphabetical-variant', 'mdi-comment-text-outline', 'mdi-heart-outline', 'mdi-account-group-outline', 'mdi-gesture-tap'];
                        foreach ($lessons as $i => $lesson):
                            $progress = isset($lesson->user_progress) ? $lesson->user_progress : ['progress_percentage' => 0, 'is_completed' => false];
                            $m = isset($levelMeta[$lesson->difficulty_level]) ? $levelMeta[$lesson->difficulty_level] : $levelMeta['beginner'];
                            $lessonIcon = $lessonIcons[$i % count($lessonIcons)];
                        ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="sl-lesson-card h-100" style="display:flex;flex-direction:column;">
                                    <!-- Visual header -->
                                    <div style="height:180px;background:linear-gradient(135deg,<?= $m['from'] ?> 0%,<?= $m['to'] ?> 100%);position:relative;overflow:hidden;">
                                        <div style="position:absolute;top:14px;left:14px;">
                                            <span class="sl-badge" style="background:rgba(255,255,255,0.26);color:#fff;backdrop-filter:blur(8px);">
                                                <i class="mdi <?= $m['icon'] ?> mr-1"></i><?= ucfirst($lesson->difficulty_level) ?>
                                            </span>
                                        </div>
                                        <?php if ($progress['is_completed']): ?>
                                            <div style="position:absolute;top:14px;right:14px;">
                                                <span class="sl-badge" style="background:rgba(16,185,129,0.92);color:#fff;"><i class="mdi mdi-check-circle mr-1"></i>Completed</span>
                                            </div>
                                        <?php elseif ($progress['progress_percentage'] > 0): ?>
                                            <div style="position:absolute;top:14px;right:14px;">
                                                <span class="sl-badge" style="background:rgba(255,255,255,0.26);color:#fff;backdrop-filter:blur(8px);"><i class="mdi mdi-progress-clock mr-1"></i>In Progress</span>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Big handshape icon centerpiece -->
                                        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                                            <div style="width:80px;height:80px;border-radius:22px;background:rgba(255,255,255,0.18);backdrop-filter:blur(12px);display:flex;align-items:center;justify-content:center;transform:rotate(-6deg);">
                                                <i class="mdi <?= $lessonIcon ?>" style="font-size:44px;color:#fff;"></i>
                                            </div>
                                        </div>

                                        <div style="position:absolute;bottom:14px;left:18px;right:18px;color:#fff;">
                                            <p style="font-family:'Manrope',sans-serif;font-size:0.6875rem;text-transform:uppercase;letter-spacing:0.14em;opacity:0.88;margin:0 0 4px;font-weight:700;">Module <?= $i + 1 ?></p>
                                            <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.125rem;margin:0;line-height:1.2;letter-spacing:-0.02em;text-shadow:0 2px 12px rgba(0,0,0,0.15);"><?= htmlspecialchars($lesson->lesson_title) ?></h4>
                                        </div>
                                    </div>

                                    <div style="padding:22px;display:flex;flex-direction:column;flex:1;">
                                        <p style="color:var(--sl-text-muted);font-family:'Manrope',sans-serif;font-size:0.9375rem;line-height:1.55;margin:0 0 14px;flex:1;">
                                            <?= htmlspecialchars(mb_substr($lesson->lesson_description, 0, 120)) ?><?= mb_strlen($lesson->lesson_description) > 120 ? '…' : '' ?>
                                        </p>
                                        <div class="d-flex align-items-center mb-3" style="gap:18px;font-family:'Manrope',sans-serif;font-size:0.8125rem;color:var(--sl-text-muted);">
                                            <span><i class="mdi mdi-format-list-bulleted mr-1" style="color:<?= $m['from'] ?>;"></i><?= $lesson->total_signs ?> signs</span>
                                            <span><i class="mdi mdi-clock-outline mr-1" style="color:<?= $m['from'] ?>;"></i><?= $lesson->estimated_duration ?> min</span>
                                        </div>
                                        <div class="d-flex justify-content-between small mb-1">
                                            <span style="color:var(--sl-text-muted);font-weight:600;">Progress</span>
                                            <span style="color:<?= $m['from'] ?>;font-weight:700;"><?= $progress['progress_percentage'] ?>%</span>
                                        </div>
                                        <div class="sl-progress mb-3"><div class="sl-progress-bar" style="width:<?= $progress['progress_percentage'] ?>%;"></div></div>
                                        <div class="d-flex" style="gap:8px;">
                                            <a href="<?= base_url('FSL/lesson/' . $lesson->lesson_id) ?>" class="sl-btn sl-btn-outline flex-fill justify-content-center" style="padding:10px 16px;font-size:0.8125rem;">
                                                <i class="mdi mdi-book-open-outline"></i> Learn
                                            </a>
                                            <a href="<?= base_url('Practice/lesson/' . $lesson->lesson_id) ?>" class="sl-btn sl-btn-primary flex-fill justify-content-center" style="padding:10px 16px;font-size:0.8125rem;">
                                                <i class="mdi mdi-camera"></i> Practice
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
                                <h4 style="color:var(--sl-text);">No lessons available</h4>
                                <p style="color:var(--sl-text-muted);">Check back soon for new lessons!</p>
                                <?php if ($activeLevel): ?>
                                    <a href="<?= base_url('FSL/lessons') ?>" class="sl-btn sl-btn-outline mt-3">
                                        <i class="mdi mdi-refresh mr-2"></i>Show all levels
                                    </a>
                                <?php endif; ?>
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
