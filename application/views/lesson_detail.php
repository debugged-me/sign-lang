<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('includes/head'); ?>

<body>
    <div id="wrapper">
        <?php $this->load->view('includes/top-nav-bar'); ?>
        <?php $this->load->view('includes/sidebar'); ?>

        <?php
        // ──────────────────────────────────────────────────────────
        // Level-aware palette & icon meta
        // ──────────────────────────────────────────────────────────
        $levelMeta = [
            'beginner'     => ['from' => '#0E7490', 'to' => '#22D3EE', 'soft' => '#CFFAFE', 'ink' => '#0C4A6E', 'label' => 'Beginner',     'icon' => 'mdi-seed-outline'],
            'intermediate' => ['from' => '#B45309', 'to' => '#FCD34D', 'soft' => '#FEF3C7', 'ink' => '#78350F', 'label' => 'Intermediate', 'icon' => 'mdi-leaf'],
            'advanced'     => ['from' => '#5B21B6', 'to' => '#A78BFA', 'soft' => '#EDE9FE', 'ink' => '#4C1D95', 'label' => 'Advanced',     'icon' => 'mdi-tree-outline'],
        ];
        $level = isset($levelMeta[$lesson->difficulty_level]) ? $lesson->difficulty_level : 'beginner';
        $meta  = $levelMeta[$level];

        // Per-sign-type accent (used in Signs in this Lesson grid)
        $typeMeta = [
            'alphabet' => ['from' => '#0E7490', 'to' => '#22D3EE', 'icon' => 'mdi-alphabetical-variant'],
            'number'   => ['from' => '#1E3A8A', 'to' => '#60A5FA', 'icon' => 'mdi-numeric'],
            'phrase'   => ['from' => '#B45309', 'to' => '#FCD34D', 'icon' => 'mdi-hand-wave'],
            'word'     => ['from' => '#5B21B6', 'to' => '#A78BFA', 'icon' => 'mdi-comment-text-outline'],
        ];

        $signsArr      = isset($lesson->signs) && is_array($lesson->signs) ? $lesson->signs : [];
        $totalSigns    = count($signsArr);
        $masteredSigns = isset($user_progress['mastered_signs']) ? (int) $user_progress['mastered_signs'] : 0;
        $progressPct   = isset($user_progress['progress_percentage']) ? (float) $user_progress['progress_percentage'] : 0;
        $isCompleted   = !empty($user_progress['is_completed']);

        // Pull handshape / movement from first sign that has them for the "How to sign" section
        $handshapeText = '';
        $movementText  = '';
        $descriptionText = '';
        foreach ($signsArr as $s) {
            if (!$handshapeText && !empty($s->handshape_description)) $handshapeText = $s->handshape_description;
            if (!$movementText && !empty($s->movement_description))   $movementText  = $s->movement_description;
            if (!$descriptionText && !empty($s->description))          $descriptionText = $s->description;
            if ($handshapeText && $movementText && $descriptionText) break;
        }

        // Rotating focus icons for per-sign breakdown
        $focusIcons = ['mdi-hand-back-right-outline', 'mdi-gesture-tap', 'mdi-hand-okay', 'mdi-hand-peace', 'mdi-hand-pointing-right', 'mdi-hand-wave'];
        ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid" style="max-width:1400px;">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="mb-2">
                        <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-family:'Manrope',sans-serif;font-size:0.8125rem;">
                            <li class="breadcrumb-item"><a href="<?= base_url('FSL/lessons') ?>" style="color:var(--sl-text-muted);">Lessons</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('FSL/lessons?level=' . $level) ?>" style="color:var(--sl-text-muted);"><?= $meta['label'] ?></a></li>
                            <li class="breadcrumb-item active" style="color:var(--sl-text);font-weight:600;" aria-current="page"><?= htmlspecialchars($lesson->lesson_title) ?></li>
                        </ol>
                    </nav>

                    <!-- ══════════════════════════════════════════════════════════════ -->
                    <!-- HERO — Level-themed cover with progress                         -->
                    <!-- ══════════════════════════════════════════════════════════════ -->
                    <div style="background:linear-gradient(135deg,<?= $meta['from'] ?> 0%,<?= $meta['to'] ?> 100%);border-radius:var(--sl-radius-xl);padding:34px 32px;position:relative;overflow:hidden;box-shadow:0 24px 60px rgba(15,23,42,0.18);margin-bottom:24px;">
                        <div style="position:absolute;top:-60px;right:-40px;width:260px;height:260px;border-radius:50%;background:rgba(255,255,255,0.12);"></div>
                        <div style="position:absolute;bottom:-80px;left:30%;width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,0.08);"></div>
                        <div class="row align-items-center" style="position:relative;z-index:2;">
                            <div class="col-lg-8 text-white">
                                <div class="d-flex flex-wrap align-items-center mb-3" style="gap:8px;">
                                    <span style="background:rgba(255,255,255,0.22);backdrop-filter:blur(8px);color:#fff;padding:6px 14px;border-radius:var(--sl-radius-full);font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.75rem;letter-spacing:0.04em;text-transform:uppercase;">
                                        <i class="mdi <?= $meta['icon'] ?> mr-1"></i><?= $meta['label'] ?>
                                    </span>
                                    <?php if (!empty($lesson->category_name)): ?>
                                        <span style="background:rgba(15,23,42,0.22);color:#fff;padding:6px 14px;border-radius:var(--sl-radius-full);font-family:'Manrope',sans-serif;font-weight:600;font-size:0.75rem;">
                                            <i class="mdi mdi-folder-outline mr-1"></i><?= htmlspecialchars($lesson->category_name) ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if (!empty($lesson->lesson_order)): ?>
                                        <span style="background:rgba(15,23,42,0.22);color:#fff;padding:6px 14px;border-radius:var(--sl-radius-full);font-family:'Manrope',sans-serif;font-weight:600;font-size:0.75rem;">
                                            Module <?= (int) $lesson->lesson_order ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if ($isCompleted): ?>
                                        <span style="background:#10B981;color:#fff;padding:6px 14px;border-radius:var(--sl-radius-full);font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.75rem;">
                                            <i class="mdi mdi-check-circle mr-1"></i>Completed
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <h1 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2.25rem;line-height:1.18;color:#fff;margin:0 0 10px;letter-spacing:-0.02em;">
                                    <?= htmlspecialchars($lesson->lesson_title) ?>
                                </h1>
                                <p style="color:rgba(255,255,255,0.92);font-family:'Manrope',sans-serif;font-size:1rem;line-height:1.6;margin:0 0 22px;max-width:680px;">
                                    <?= htmlspecialchars($lesson->lesson_description) ?>
                                </p>

                                <div class="d-flex flex-wrap" style="gap:18px;">
                                    <div style="color:#fff;">
                                        <div style="font-family:'Manrope',sans-serif;font-size:0.75rem;opacity:0.82;text-transform:uppercase;letter-spacing:0.06em;">Signs</div>
                                        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.375rem;"><?= $totalSigns ?></div>
                                    </div>
                                    <?php if (!empty($lesson->estimated_duration)): ?>
                                        <div style="color:#fff;">
                                            <div style="font-family:'Manrope',sans-serif;font-size:0.75rem;opacity:0.82;text-transform:uppercase;letter-spacing:0.06em;">Duration</div>
                                            <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.375rem;"><?= (int) $lesson->estimated_duration ?>m</div>
                                        </div>
                                    <?php endif; ?>
                                    <div style="color:#fff;">
                                        <div style="font-family:'Manrope',sans-serif;font-size:0.75rem;opacity:0.82;text-transform:uppercase;letter-spacing:0.06em;">Mastered</div>
                                        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.375rem;"><?= $masteredSigns ?>/<?= $totalSigns ?></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 text-center mt-4 mt-lg-0">
                                <div style="background:rgba(255,255,255,0.14);backdrop-filter:blur(10px);border-radius:var(--sl-radius-xl);padding:26px;display:inline-block;">
                                    <div style="width:140px;height:140px;border-radius:50%;background:rgba(255,255,255,0.22);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                                        <i class="mdi <?= $meta['icon'] ?>" style="font-size:82px;color:#fff;"></i>
                                    </div>
                                    <div style="font-family:'Manrope',sans-serif;font-size:0.8125rem;color:rgba(255,255,255,0.9);margin-bottom:6px;text-transform:uppercase;letter-spacing:0.08em;">Your Progress</div>
                                    <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2.25rem;color:#fff;line-height:1;"><?= round($progressPct) ?>%</div>
                                    <div class="mt-3" style="height:8px;background:rgba(255,255,255,0.25);border-radius:var(--sl-radius-full);overflow:hidden;width:200px;margin:12px auto 0;">
                                        <div style="height:100%;width:<?= $progressPct ?>%;background:#fff;border-radius:var(--sl-radius-full);"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- ══════════════════════════════════════════════════════════ -->
                        <!-- MAIN COLUMN                                                 -->
                        <!-- ══════════════════════════════════════════════════════════ -->
                        <div class="col-lg-8 mb-4">

                            <!-- How to sign this lesson (data-driven) -->
                            <?php if ($handshapeText || $movementText || $descriptionText): ?>
                                <div class="sl-card mb-4" style="padding:28px;border-radius:var(--sl-radius-lg);">
                                    <div class="d-flex align-items-center mb-3" style="gap:10px;">
                                        <span style="width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,<?= $meta['from'] ?>,<?= $meta['to'] ?>);display:inline-flex;align-items:center;justify-content:center;color:#fff;">
                                            <i class="mdi mdi-lightbulb-on-outline" style="font-size:22px;"></i>
                                        </span>
                                        <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.1875rem;color:var(--sl-text);margin:0;">How to Sign</h4>
                                    </div>

                                    <div class="row">
                                        <?php if ($descriptionText): ?>
                                            <div class="col-md-12 mb-3">
                                                <div style="padding:18px;border-radius:var(--sl-radius-lg);background:<?= $meta['soft'] ?>;">
                                                    <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:<?= $meta['ink'] ?>;font-size:0.8125rem;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:6px;">Overview</div>
                                                    <p style="color:var(--sl-text);font-family:'Manrope',sans-serif;font-size:0.9375rem;line-height:1.65;margin:0;"><?= htmlspecialchars($descriptionText) ?></p>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($handshapeText): ?>
                                            <div class="col-md-6 mb-3">
                                                <div style="padding:18px;border-radius:var(--sl-radius-lg);border:1px solid var(--sl-border);height:100%;">
                                                    <div class="d-flex align-items-center mb-2" style="gap:8px;">
                                                        <i class="mdi mdi-hand-back-right-outline" style="color:<?= $meta['from'] ?>;font-size:22px;"></i>
                                                        <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:var(--sl-text);font-size:0.9375rem;">Handshape</span>
                                                    </div>
                                                    <p style="color:var(--sl-text-muted);font-family:'Manrope',sans-serif;font-size:0.875rem;line-height:1.6;margin:0;"><?= htmlspecialchars($handshapeText) ?></p>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($movementText): ?>
                                            <div class="col-md-6 mb-3">
                                                <div style="padding:18px;border-radius:var(--sl-radius-lg);border:1px solid var(--sl-border);height:100%;">
                                                    <div class="d-flex align-items-center mb-2" style="gap:8px;">
                                                        <i class="mdi mdi-arrow-expand-all" style="color:<?= $meta['to'] ?>;font-size:22px;"></i>
                                                        <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:var(--sl-text);font-size:0.9375rem;">Movement</span>
                                                    </div>
                                                    <p style="color:var(--sl-text-muted);font-family:'Manrope',sans-serif;font-size:0.875rem;line-height:1.6;margin:0;"><?= htmlspecialchars($movementText) ?></p>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Signs in this lesson -->
                            <div class="sl-card" style="padding:28px;border-radius:var(--sl-radius-lg);">
                                <div class="d-flex justify-content-between align-items-center mb-3" style="gap:12px;">
                                    <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.1875rem;color:var(--sl-text);margin:0;">
                                        Signs in this Lesson
                                    </h4>
                                    <span style="font-family:'Manrope',sans-serif;font-size:0.8125rem;color:var(--sl-text-muted);">
                                        <?= $totalSigns ?> sign<?= $totalSigns === 1 ? '' : 's' ?>
                                    </span>
                                </div>

                                <?php if ($totalSigns === 0): ?>
                                    <div style="padding:30px;text-align:center;border-radius:var(--sl-radius-lg);background:var(--sl-surface-high);">
                                        <i class="mdi mdi-hand-back-right-off-outline" style="font-size:44px;color:var(--sl-text-muted);"></i>
                                        <p style="margin:10px 0 0;font-family:'Manrope',sans-serif;color:var(--sl-text-muted);">No signs have been added to this lesson yet.</p>
                                    </div>
                                <?php else: ?>
                                    <div class="row">
                                        <?php foreach ($signsArr as $index => $sign):
                                            $st   = $sign->sign_type ?? 'word';
                                            $tMeta = $typeMeta[$st] ?? $typeMeta['word'];
                                            $fIcon = $focusIcons[$index % count($focusIcons)];
                                        ?>
                                            <div class="col-lg-4 col-md-6 mb-3">
                                                <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="text-decoration-none">
                                                    <div class="sl-sign-card h-100" style="position:relative;overflow:hidden;">
                                                        <span style="position:absolute;top:12px;left:12px;width:28px;height:28px;background:linear-gradient(135deg,<?= $tMeta['from'] ?>,<?= $tMeta['to'] ?>);color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:0.75rem;z-index:2;box-shadow:0 4px 10px rgba(15,23,42,0.18);">
                                                            <?= $index + 1 ?>
                                                        </span>
                                                        <span style="position:absolute;top:12px;right:12px;background:rgba(255,255,255,0.95);padding:4px 10px;border-radius:var(--sl-radius-full);font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.6875rem;text-transform:uppercase;letter-spacing:0.06em;color:<?= $tMeta['from'] ?>;z-index:2;">
                                                            <?= ucfirst($st) ?>
                                                        </span>
                                                        <div class="sl-sign-preview" style="height:140px;background:linear-gradient(135deg,<?= $tMeta['from'] ?>15 0%,<?= $tMeta['to'] ?>15 100%);">
                                                            <?php if (!empty($sign->image_path) && file_exists(FCPATH . $sign->image_path)): ?>
                                                                <img src="<?= base_url($sign->image_path) ?>" alt="<?= htmlspecialchars($sign->sign_name) ?>">
                                                            <?php else: ?>
                                                                <div class="d-flex flex-column align-items-center" style="gap:6px;">
                                                                    <i class="mdi <?= $fIcon ?>" style="font-size:34px;color:<?= $tMeta['from'] ?>;opacity:0.55;"></i>
                                                                    <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.5rem;color:<?= $tMeta['from'] ?>;letter-spacing:-0.01em;">
                                                                        <?= htmlspecialchars(mb_substr($sign->sign_name, 0, 6)) ?>
                                                                    </span>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div style="padding:12px 14px;">
                                                            <div class="sl-sign-name" style="font-size:0.9375rem;margin-bottom:2px;"><?= htmlspecialchars($sign->sign_name) ?></div>
                                                            <?php if (!empty($sign->description)): ?>
                                                                <div style="font-family:'Manrope',sans-serif;font-size:0.75rem;color:var(--sl-text-muted);line-height:1.45;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">
                                                                    <?= htmlspecialchars($sign->description) ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- ══════════════════════════════════════════════════════════ -->
                        <!-- SIDEBAR                                                     -->
                        <!-- ══════════════════════════════════════════════════════════ -->
                        <div class="col-lg-4 mb-4">

                            <!-- Practice CTA -->
                            <div style="background:linear-gradient(135deg,<?= $meta['from'] ?> 0%,<?= $meta['to'] ?> 100%);border-radius:var(--sl-radius-xl);padding:26px;margin-bottom:20px;color:#fff;box-shadow:0 18px 40px rgba(15,23,42,0.18);position:relative;overflow:hidden;">
                                <div style="position:absolute;top:-30px;right:-30px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,0.12);"></div>
                                <div style="position:relative;z-index:2;">
                                    <div style="width:48px;height:48px;border-radius:12px;background:rgba(255,255,255,0.22);display:inline-flex;align-items:center;justify-content:center;margin-bottom:14px;">
                                        <i class="mdi mdi-camera" style="font-size:26px;color:#fff;"></i>
                                    </div>
                                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.125rem;color:#fff;margin:0 0 8px;">Practice this Lesson</h5>
                                    <p style="color:rgba(255,255,255,0.92);font-family:'Manrope',sans-serif;font-size:0.875rem;line-height:1.55;margin:0 0 18px;">
                                        Turn on your camera to review your form and get real-time feedback on each sign.
                                    </p>
                                    <a href="<?= base_url('Practice/lesson/' . $lesson->lesson_id) ?>" style="display:inline-flex;align-items:center;gap:8px;background:#fff;color:<?= $meta['from'] ?>;padding:12px 22px;border-radius:var(--sl-radius-full);font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9375rem;text-decoration:none;">
                                        <i class="mdi mdi-play-circle"></i> Start Practice
                                    </a>
                                </div>
                            </div>

                            <!-- Lesson Info -->
                            <div class="sl-card" style="padding:22px;border-radius:var(--sl-radius-lg);margin-bottom:20px;">
                                <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1rem;color:var(--sl-text);margin:0 0 14px;">Lesson Info</h5>

                                <div style="display:flex;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid var(--sl-border);">
                                    <i class="mdi <?= $meta['icon'] ?>" style="color:<?= $meta['from'] ?>;font-size:20px;width:24px;"></i>
                                    <div style="flex:1;">
                                        <div style="font-family:'Manrope',sans-serif;font-size:0.75rem;color:var(--sl-text-muted);">Level</div>
                                        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:var(--sl-text);font-size:0.9375rem;"><?= $meta['label'] ?></div>
                                    </div>
                                </div>

                                <div style="display:flex;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid var(--sl-border);">
                                    <i class="mdi mdi-hand-back-right-outline" style="color:var(--sl-primary);font-size:20px;width:24px;"></i>
                                    <div style="flex:1;">
                                        <div style="font-family:'Manrope',sans-serif;font-size:0.75rem;color:var(--sl-text-muted);">Total Signs</div>
                                        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:var(--sl-text);font-size:0.9375rem;"><?= $totalSigns ?></div>
                                    </div>
                                </div>

                                <?php if (!empty($lesson->estimated_duration)): ?>
                                    <div style="display:flex;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid var(--sl-border);">
                                        <i class="mdi mdi-clock-outline" style="color:var(--sl-primary);font-size:20px;width:24px;"></i>
                                        <div style="flex:1;">
                                            <div style="font-family:'Manrope',sans-serif;font-size:0.75rem;color:var(--sl-text-muted);">Estimated</div>
                                            <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:var(--sl-text);font-size:0.9375rem;"><?= (int) $lesson->estimated_duration ?> minutes</div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($lesson->category_name)): ?>
                                    <div style="display:flex;align-items:center;gap:10px;padding:10px 0;">
                                        <i class="mdi mdi-folder-outline" style="color:var(--sl-primary);font-size:20px;width:24px;"></i>
                                        <div style="flex:1;">
                                            <div style="font-family:'Manrope',sans-serif;font-size:0.75rem;color:var(--sl-text-muted);">Category</div>
                                            <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:var(--sl-text);font-size:0.9375rem;"><?= htmlspecialchars($lesson->category_name) ?></div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Progress Snapshot -->
                            <div class="sl-card" style="padding:22px;border-radius:var(--sl-radius-lg);margin-bottom:20px;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1rem;color:var(--sl-text);margin:0;">Your Progress</h5>
                                    <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;color:<?= $meta['from'] ?>;font-size:1.125rem;"><?= round($progressPct) ?>%</span>
                                </div>
                                <div class="sl-progress" style="margin-bottom:12px;"><div class="sl-progress-bar" style="width:<?= $progressPct ?>%;background:linear-gradient(90deg,<?= $meta['from'] ?>,<?= $meta['to'] ?>);"></div></div>
                                <div class="d-flex justify-content-between" style="font-family:'Manrope',sans-serif;font-size:0.8125rem;color:var(--sl-text-muted);">
                                    <span><?= $masteredSigns ?> mastered</span>
                                    <span><?= max(0, $totalSigns - $masteredSigns) ?> to go</span>
                                </div>
                            </div>

                            <!-- Coming up -->
                            <?php if (!empty($next_lesson)):
                                $nextLevel = isset($levelMeta[$next_lesson->difficulty_level]) ? $next_lesson->difficulty_level : 'beginner';
                                $nMeta     = $levelMeta[$nextLevel];
                            ?>
                                <div style="background:linear-gradient(135deg,<?= $nMeta['soft'] ?> 0%,#fff 100%);border:1px solid <?= $nMeta['to'] ?>55;border-radius:var(--sl-radius-lg);padding:20px;">
                                    <span style="display:inline-block;background:<?= $nMeta['ink'] ?>;color:#fff;padding:4px 12px;border-radius:var(--sl-radius-full);font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.6875rem;letter-spacing:0.06em;text-transform:uppercase;margin-bottom:10px;">
                                        <i class="mdi mdi-arrow-right-circle mr-1"></i>Coming Up
                                    </span>
                                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9375rem;color:<?= $nMeta['ink'] ?>;margin:6px 0 8px;line-height:1.35;"><?= htmlspecialchars($next_lesson->lesson_title) ?></h5>
                                    <?php if (!empty($next_lesson->lesson_description)): ?>
                                        <p style="color:var(--sl-text-muted);font-family:'Manrope',sans-serif;font-size:0.8125rem;line-height:1.5;margin:0 0 12px;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;"><?= htmlspecialchars($next_lesson->lesson_description) ?></p>
                                    <?php endif; ?>
                                    <a href="<?= base_url('FSL/lesson/' . $next_lesson->lesson_id) ?>" style="color:<?= $nMeta['from'] ?>;font-family:'Manrope',sans-serif;font-size:0.8125rem;font-weight:700;text-decoration:none;">Continue the journey →</a>
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
