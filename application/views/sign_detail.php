<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('includes/head'); ?>

<body>
    <div id="wrapper">
        <?php $this->load->view('includes/top-nav-bar'); ?>
        <?php $this->load->view('includes/sidebar'); ?>

        <?php
        // ──────────────────────────────────────────────────────────
        // Type-aware palette meta
        // ──────────────────────────────────────────────────────────
        $typeMeta = [
            'alphabet' => ['label' => 'Letter',  'icon' => 'mdi-alphabetical-variant',    'from' => '#0E7490', 'to' => '#22D3EE', 'soft' => '#CFFAFE', 'ink' => '#0C4A6E', 'accent' => '#67E8F9'],
            'number'   => ['label' => 'Number',  'icon' => 'mdi-numeric',                 'from' => '#1E3A8A', 'to' => '#60A5FA', 'soft' => '#DBEAFE', 'ink' => '#1E3A8A', 'accent' => '#93C5FD'],
            'phrase'   => ['label' => 'Phrase',  'icon' => 'mdi-hand-wave',               'from' => '#B45309', 'to' => '#FCD34D', 'soft' => '#FEF3C7', 'ink' => '#78350F', 'accent' => '#FDE68A'],
            'word'     => ['label' => 'Word',    'icon' => 'mdi-comment-text-outline',    'from' => '#5B21B6', 'to' => '#A78BFA', 'soft' => '#EDE9FE', 'ink' => '#4C1D95', 'accent' => '#C4B5FD'],
        ];
        $st   = isset($typeMeta[$sign->sign_type]) ? $sign->sign_type : 'word';
        $tm   = $typeMeta[$st];

        $diffIcon = [
            'beginner'     => 'mdi-seed-outline',
            'intermediate' => 'mdi-leaf',
            'advanced'     => 'mdi-tree-outline',
        ];
        $diff = isset($sign->difficulty_level) ? $sign->difficulty_level : 'beginner';

        // Display value for hero — letter, number, or word truncation
        $displayValue = htmlspecialchars(mb_substr($sign->sign_name, 0, 4));
        $isShortSign  = mb_strlen($sign->sign_name) <= 3;
        ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid" style="max-width:1400px;">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="mb-2">
                        <ol class="breadcrumb bg-transparent p-0 mb-0" style="font-family:'Manrope',sans-serif;font-size:0.8125rem;">
                            <li class="breadcrumb-item"><a href="<?= base_url('FSL/dictionary') ?>" style="color:var(--sl-text-muted);">Dictionary</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('FSL/dictionary?type=' . $sign->sign_type) ?>" style="color:var(--sl-text-muted);"><?= $tm['label'] ?>s</a></li>
                            <li class="breadcrumb-item active" style="color:var(--sl-text);font-weight:600;" aria-current="page"><?= htmlspecialchars($sign->sign_name) ?></li>
                        </ol>
                    </nav>

                    <!-- Title + meta row -->
                    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4" style="gap:16px;">
                        <div>
                            <div class="d-flex flex-wrap align-items-center mb-2" style="gap:8px;">
                                <span style="background:linear-gradient(135deg,<?= $tm['from'] ?>,<?= $tm['to'] ?>);color:#fff;padding:6px 14px;border-radius:var(--sl-radius-full);font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.75rem;letter-spacing:0.04em;text-transform:uppercase;">
                                    <i class="mdi <?= $tm['icon'] ?> mr-1"></i><?= $tm['label'] ?>
                                </span>
                                <?php if (!empty($sign->category_name)): ?>
                                    <span style="background:var(--sl-surface-high);color:var(--sl-text);padding:6px 14px;border-radius:var(--sl-radius-full);font-family:'Manrope',sans-serif;font-weight:600;font-size:0.75rem;">
                                        <i class="mdi mdi-folder-outline mr-1"></i><?= htmlspecialchars($sign->category_name) ?>
                                    </span>
                                <?php endif; ?>
                                <span style="background:var(--sl-surface-high);color:var(--sl-text);padding:6px 14px;border-radius:var(--sl-radius-full);font-family:'Manrope',sans-serif;font-weight:600;font-size:0.75rem;">
                                    <i class="mdi <?= $diffIcon[$diff] ?? 'mdi-seed-outline' ?> mr-1"></i><?= ucfirst($diff) ?>
                                </span>
                                <?php if (!empty($sign->is_featured)): ?>
                                    <span style="background:#FEF3C7;color:#78350F;padding:6px 14px;border-radius:var(--sl-radius-full);font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.75rem;">
                                        <i class="mdi mdi-star mr-1"></i>Featured
                                    </span>
                                <?php endif; ?>
                            </div>
                            <h1 class="sl-page-title" style="margin-bottom:4px;"><?= htmlspecialchars($sign->sign_name) ?></h1>
                            <p class="sl-page-subtitle" style="margin:0;">Master the handshape, movement, and context of this <?= strtolower($tm['label']) ?>.</p>
                        </div>
                    </div>

                    <div class="row">
                        <!-- ══════════════════════════════════════════════════════════ -->
                        <!-- VISUAL PANE                                                 -->
                        <!-- ══════════════════════════════════════════════════════════ -->
                        <div class="col-lg-5 mb-4">
                            <div class="sl-card" style="padding:20px;border-radius:var(--sl-radius-xl);position:sticky;top:90px;">

                                <!-- Hero figure — type-themed gradient -->
                                <div style="position:relative;background:linear-gradient(135deg,<?= $tm['accent'] ?> 0%,<?= $tm['to'] ?> 45%,<?= $tm['from'] ?> 100%);border-radius:var(--sl-radius-lg);aspect-ratio:1/1;display:flex;align-items:center;justify-content:center;overflow:hidden;margin-bottom:16px;box-shadow:0 18px 44px rgba(15,23,42,0.18);">

                                    <!-- Floating accent orbs -->
                                    <span style="position:absolute;top:-40px;right:-30px;width:140px;height:140px;border-radius:50%;background:rgba(255,255,255,0.18);"></span>
                                    <span style="position:absolute;bottom:-60px;left:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,0.1);"></span>

                                    <?php if (!empty($sign->image_path) && file_exists(FCPATH . $sign->image_path)): ?>
                                        <img src="<?= base_url($sign->image_path) ?>" alt="<?= htmlspecialchars($sign->sign_name) ?>" style="max-width:82%;max-height:82%;object-fit:contain;position:relative;z-index:2;filter:drop-shadow(0 10px 24px rgba(15,23,42,0.22));">
                                    <?php elseif ($isShortSign): ?>
                                        <span style="position:relative;z-index:2;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:9rem;color:#fff;letter-spacing:-0.04em;text-shadow:0 10px 30px rgba(15,23,42,0.35);"><?= $displayValue ?></span>
                                    <?php else: ?>
                                        <div style="position:relative;z-index:2;text-align:center;">
                                            <i class="mdi <?= $tm['icon'] ?>" style="font-size:150px;color:rgba(255,255,255,0.28);"></i>
                                            <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2.25rem;color:#fff;margin-top:-20px;letter-spacing:-0.02em;text-shadow:0 6px 18px rgba(15,23,42,0.3);"><?= htmlspecialchars($sign->sign_name) ?></div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Top-right type chip -->
                                    <span style="position:absolute;top:14px;right:14px;background:rgba(15,23,42,0.78);color:#fff;padding:6px 12px;border-radius:var(--sl-radius-full);font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.6875rem;letter-spacing:0.06em;text-transform:uppercase;z-index:3;">
                                        <?= $tm['label'] ?>
                                    </span>

                                    <!-- Bottom hand figure hint -->
                                    <div style="position:absolute;bottom:14px;left:14px;display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,0.2);backdrop-filter:blur(8px);padding:6px 12px;border-radius:var(--sl-radius-full);z-index:3;">
                                        <i class="mdi mdi-hand-back-right-outline" style="color:#fff;font-size:16px;"></i>
                                        <span style="color:#fff;font-family:'Manrope',sans-serif;font-size:0.75rem;font-weight:600;">FSL</span>
                                    </div>
                                </div>

                                <?php if (!empty($sign->video_path)): ?>
                                    <div style="background:#0F172A;border-radius:var(--sl-radius-lg);padding:10px;margin-bottom:14px;">
                                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;padding:0 4px;">
                                            <i class="mdi mdi-video-outline" style="color:<?= $tm['accent'] ?>;"></i>
                                            <span style="color:#fff;font-family:'Manrope',sans-serif;font-size:0.8125rem;font-weight:600;">Video Demo</span>
                                        </div>
                                        <video controls class="w-100" style="border-radius:var(--sl-radius);display:block;">
                                            <source src="<?= base_url($sign->video_path) ?>" type="video/mp4">
                                        </video>
                                    </div>
                                <?php endif; ?>

                                <a href="<?= base_url('Practice/category/' . $sign->category_id) ?>" style="display:flex;align-items:center;justify-content:center;gap:8px;background:linear-gradient(135deg,<?= $tm['from'] ?>,<?= $tm['to'] ?>);color:#fff;padding:14px 22px;border-radius:var(--sl-radius-full);font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9375rem;text-decoration:none;box-shadow:0 12px 28px rgba(15,23,42,0.18);">
                                    <i class="mdi mdi-camera"></i> Practice this <?= $tm['label'] ?>
                                </a>

                                <?php if (!empty($sign->model_label)): ?>
                                    <div class="mt-3" style="text-align:center;font-family:'Manrope',sans-serif;font-size:0.75rem;color:var(--sl-text-muted);">
                                        <i class="mdi mdi-robot-outline"></i>
                                        AI label: <code style="color:<?= $tm['from'] ?>;font-weight:700;background:<?= $tm['soft'] ?>;padding:2px 8px;border-radius:6px;"><?= htmlspecialchars($sign->model_label) ?></code>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- ══════════════════════════════════════════════════════════ -->
                        <!-- INFO PANE                                                   -->
                        <!-- ══════════════════════════════════════════════════════════ -->
                        <div class="col-lg-7">

                            <!-- Description -->
                            <?php if (!empty($sign->description)): ?>
                                <div class="sl-card mb-3" style="padding:24px;border-radius:var(--sl-radius-lg);border-left:4px solid <?= $tm['from'] ?>;">
                                    <div class="d-flex align-items-center mb-2" style="gap:10px;">
                                        <span style="width:34px;height:34px;border-radius:10px;background:<?= $tm['soft'] ?>;display:inline-flex;align-items:center;justify-content:center;color:<?= $tm['from'] ?>;">
                                            <i class="mdi mdi-information-outline" style="font-size:18px;"></i>
                                        </span>
                                        <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1rem;color:var(--sl-text);margin:0;">Description</h5>
                                    </div>
                                    <p style="color:var(--sl-body-text);font-family:'Manrope',sans-serif;font-size:0.9375rem;line-height:1.7;margin:0;"><?= $sign->description ?></p>
                                </div>
                            <?php endif; ?>

                            <!-- Handshape + Movement (paired) -->
                            <?php if (!empty($sign->handshape_description) || !empty($sign->movement_description)): ?>
                                <div class="row">
                                    <?php if (!empty($sign->handshape_description)): ?>
                                        <div class="col-md-6 mb-3">
                                            <div class="sl-card h-100" style="padding:22px;border-radius:var(--sl-radius-lg);">
                                                <div style="width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,<?= $tm['from'] ?>,<?= $tm['to'] ?>);display:inline-flex;align-items:center;justify-content:center;color:#fff;margin-bottom:12px;">
                                                    <i class="mdi mdi-hand-back-right-outline" style="font-size:22px;"></i>
                                                </div>
                                                <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9375rem;color:var(--sl-text);margin:0 0 8px;text-transform:uppercase;letter-spacing:0.04em;">Handshape</h5>
                                                <p style="color:var(--sl-body-text);font-family:'Manrope',sans-serif;font-size:0.9375rem;line-height:1.65;margin:0;"><?= $sign->handshape_description ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($sign->movement_description)): ?>
                                        <div class="col-md-6 mb-3">
                                            <div class="sl-card h-100" style="padding:22px;border-radius:var(--sl-radius-lg);">
                                                <div style="width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,<?= $tm['to'] ?>,<?= $tm['accent'] ?>);display:inline-flex;align-items:center;justify-content:center;color:#fff;margin-bottom:12px;">
                                                    <i class="mdi mdi-arrow-expand-all" style="font-size:22px;"></i>
                                                </div>
                                                <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9375rem;color:var(--sl-text);margin:0 0 8px;text-transform:uppercase;letter-spacing:0.04em;">Movement</h5>
                                                <p style="color:var(--sl-body-text);font-family:'Manrope',sans-serif;font-size:0.9375rem;line-height:1.65;margin:0;"><?= $sign->movement_description ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Usage example -->
                            <?php if (!empty($sign->usage_example)): ?>
                                <div style="background:linear-gradient(135deg,<?= $tm['soft'] ?> 0%,#fff 100%);border:1px solid <?= $tm['to'] ?>44;border-radius:var(--sl-radius-lg);padding:22px 24px;margin-bottom:16px;">
                                    <p style="font-family:'Manrope',sans-serif;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.14em;color:<?= $tm['ink'] ?>;font-weight:700;margin:0 0 8px;">
                                        <i class="mdi mdi-lightbulb-on-outline mr-1"></i>Usage Example
                                    </p>
                                    <p style="color:var(--sl-text);font-family:'Plus Jakarta Sans',sans-serif;font-style:italic;font-size:1.0625rem;line-height:1.55;margin:0;">
                                        <i class="mdi mdi-format-quote-open" style="color:<?= $tm['from'] ?>;font-size:1.25rem;vertical-align:middle;"></i>
                                        <?= $sign->usage_example ?>
                                    </p>
                                </div>
                            <?php endif; ?>

                            <!-- Progress card -->
                            <div class="sl-card" style="padding:24px;border-radius:var(--sl-radius-lg);">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1rem;color:var(--sl-text);margin:0;">Your Progress</h5>
                                    <?php if (!empty($user_progress)): ?>
                                        <?php
                                        $statusColor = 'var(--sl-text-muted)';
                                        if ($user_progress->status === 'mastered') $statusColor = 'var(--sl-success)';
                                        elseif ($user_progress->status === 'practiced') $statusColor = '#B45309';
                                        ?>
                                        <span style="background:<?= $user_progress->status === 'mastered' ? '#D1FAE5' : ($user_progress->status === 'practiced' ? '#FEF3C7' : 'var(--sl-surface-high)') ?>;color:<?= $statusColor ?>;padding:4px 12px;border-radius:var(--sl-radius-full);font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.04em;">
                                            <?= ucfirst($user_progress->status) ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($user_progress)): ?>
                                    <div class="row">
                                        <div class="col-6 col-md-4 text-center mb-2">
                                            <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.75rem;color:<?= $tm['from'] ?>;" data-plugin="counterup"><?= (int) $user_progress->practice_count ?></div>
                                            <p style="color:var(--sl-text-muted);font-family:'Manrope',sans-serif;font-size:0.75rem;margin:0;">Practice Count</p>
                                        </div>
                                        <div class="col-6 col-md-4 text-center mb-2">
                                            <?php
                                            $acc = (float) ($user_progress->average_score ?? 0);
                                            $accColor = $acc >= 80 ? 'var(--sl-success)' : ($acc >= 60 ? '#B45309' : 'var(--sl-danger)');
                                            ?>
                                            <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.75rem;color:<?= $accColor ?>;"><?= round($acc, 1) ?>%</div>
                                            <p style="color:var(--sl-text-muted);font-family:'Manrope',sans-serif;font-size:0.75rem;margin:0;">Accuracy</p>
                                        </div>
                                        <div class="col-12 col-md-4 text-center mb-2">
                                            <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1rem;color:var(--sl-text);"><?= !empty($user_progress->last_practiced) ? date('M d', strtotime($user_progress->last_practiced)) : '—' ?></div>
                                            <p style="color:var(--sl-text-muted);font-family:'Manrope',sans-serif;font-size:0.75rem;margin:0;">Last Practiced</p>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-3">
                                        <div style="width:64px;height:64px;border-radius:50%;background:<?= $tm['soft'] ?>;display:inline-flex;align-items:center;justify-content:center;margin-bottom:10px;">
                                            <i class="mdi mdi-school-outline" style="font-size:32px;color:<?= $tm['from'] ?>;"></i>
                                        </div>
                                        <p style="color:var(--sl-text-muted);font-family:'Manrope',sans-serif;margin:0 0 12px;font-size:0.875rem;">You haven't practiced this sign yet.</p>
                                        <a href="<?= base_url('Practice/category/' . $sign->category_id) ?>" style="display:inline-flex;align-items:center;gap:6px;color:<?= $tm['from'] ?>;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.875rem;text-decoration:none;">
                                            <i class="mdi mdi-play-circle"></i>Start practicing →
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- ══════════════════════════════════════════════════════════════ -->
                    <!-- RELATED SIGNS — type-themed                                     -->
                    <!-- ══════════════════════════════════════════════════════════════ -->
                    <?php if (!empty($related_signs) && count($related_signs) > 1): ?>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between align-items-end mb-3" style="gap:12px;">
                                <div>
                                    <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.375rem;color:var(--sl-text);margin:0 0 4px;">Related <?= $tm['label'] ?>s</h3>
                                    <p style="font-family:'Manrope',sans-serif;font-size:0.875rem;color:var(--sl-text-muted);margin:0;">Keep the momentum — signs from the same category.</p>
                                </div>
                                <a href="<?= base_url('FSL/dictionary?type=' . $sign->sign_type) ?>" style="color:<?= $tm['from'] ?>;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.8125rem;text-decoration:none;">View all →</a>
                            </div>
                            <div class="row">
                                <?php
                                $count = 0;
                                foreach ($related_signs as $related):
                                    if ($related->sign_id != $sign->sign_id && $count < 6):
                                        $count++;
                                        $rst  = $typeMeta[$related->sign_type] ?? $tm;
                                ?>
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                                        <a href="<?= base_url('FSL/sign_detail/' . $related->sign_id) ?>" class="text-decoration-none">
                                            <div class="sl-sign-card h-100" style="overflow:hidden;">
                                                <div class="sl-sign-preview" style="height:120px;background:linear-gradient(135deg,<?= $rst['from'] ?>15 0%,<?= $rst['to'] ?>15 100%);">
                                                    <?php if (!empty($related->image_path) && file_exists(FCPATH . $related->image_path)): ?>
                                                        <img src="<?= base_url($related->image_path) ?>" alt="<?= htmlspecialchars($related->sign_name) ?>">
                                                    <?php else: ?>
                                                        <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2rem;color:<?= $rst['from'] ?>;letter-spacing:-0.02em;"><?= htmlspecialchars(mb_substr($related->sign_name, 0, 3)) ?></span>
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
