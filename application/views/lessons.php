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

                    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4" style="gap:16px;">
                        <div class="sl-page-header mb-0">
                            <h1 class="sl-page-title">Lessons</h1>
                            <p class="sl-page-subtitle" style="max-width:640px;">Guided, step-by-step FSL lessons. Start at your level and progress at your pace — each card carries you one module closer to fluency.</p>
                        </div>
                        <div class="sl-filter-group">
                            <a href="<?= base_url('FSL/lessons') ?>" class="sl-filter-btn <?= !$this->input->get('difficulty') ? 'active' : '' ?>">All Levels</a>
                            <a href="<?= base_url('FSL/lessons?difficulty=beginner') ?>" class="sl-filter-btn <?= $this->input->get('difficulty') == 'beginner' ? 'active' : '' ?>">Beginner</a>
                            <a href="<?= base_url('FSL/lessons?difficulty=intermediate') ?>" class="sl-filter-btn <?= $this->input->get('difficulty') == 'intermediate' ? 'active' : '' ?>">Intermediate</a>
                            <a href="<?= base_url('FSL/lessons?difficulty=advanced') ?>" class="sl-filter-btn <?= $this->input->get('difficulty') == 'advanced' ? 'active' : '' ?>">Advanced</a>
                        </div>
                    </div>

                    <!-- Lessons editorial grid -->
                    <div class="row">
                        <?php
                        $palette = [
                            ['from' => '#0E7490', 'to' => '#155E75'],
                            ['from' => '#22D3EE', 'to' => '#0891B2'],
                            ['from' => '#67E8F9', 'to' => '#0E7490'],
                            ['from' => '#155E75', 'to' => '#0C4A6E'],
                            ['from' => '#0891B2', 'to' => '#155E75'],
                            ['from' => '#22D3EE', 'to' => '#155E75'],
                        ];
                        foreach ($lessons as $i => $lesson):
                            $progress = isset($lesson->user_progress) ? $lesson->user_progress : ['progress_percentage' => 0, 'is_completed' => false];
                            $p = $palette[$i % count($palette)];
                        ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="sl-lesson-card h-100">
                                    <!-- Visual header -->
                                    <div style="height:170px;background:linear-gradient(135deg,<?= $p['from'] ?> 0%,<?= $p['to'] ?> 100%);position:relative;overflow:hidden;">
                                        <div style="position:absolute;top:14px;left:14px;">
                                            <span class="sl-badge" style="background:rgba(255,255,255,0.24);color:#fff;backdrop-filter:blur(8px);"><?= ucfirst($lesson->difficulty_level) ?></span>
                                        </div>
                                        <?php if ($progress['is_completed']): ?>
                                            <div style="position:absolute;top:14px;right:14px;">
                                                <span class="sl-badge" style="background:rgba(16,185,129,0.92);color:#fff;"><i class="mdi mdi-check-circle mr-1"></i>Completed</span>
                                            </div>
                                        <?php endif; ?>
                                        <div style="position:absolute;bottom:14px;left:18px;color:#fff;">
                                            <p style="font-family:'Manrope',sans-serif;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.14em;opacity:0.85;margin:0 0 4px;">Module <?= $i + 1 ?></p>
                                            <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.25rem;margin:0;line-height:1.2;letter-spacing:-0.02em;"><?= htmlspecialchars($lesson->lesson_title) ?></h4>
                                        </div>
                                        <div style="position:absolute;right:-20px;bottom:-20px;opacity:0.18;font-size:120px;color:#fff;line-height:1;">
                                            <i class="mdi mdi-gesture-tap"></i>
                                        </div>
                                    </div>

                                    <div style="padding:22px;">
                                        <p style="color:var(--sl-text-muted);font-family:'Manrope',sans-serif;font-size:0.9375rem;line-height:1.55;margin:0 0 14px;min-height:3em;">
                                            <?= htmlspecialchars($lesson->lesson_description) ?>
                                        </p>
                                        <div class="d-flex align-items-center mb-3" style="gap:18px;font-family:'Manrope',sans-serif;font-size:0.8125rem;color:var(--sl-text-muted);">
                                            <span><i class="mdi mdi-format-list-bulleted mr-1" style="color:var(--sl-primary);"></i><?= $lesson->total_signs ?> signs</span>
                                            <span><i class="mdi mdi-clock-outline mr-1" style="color:var(--sl-primary);"></i><?= $lesson->estimated_duration ?> min</span>
                                        </div>
                                        <div class="d-flex justify-content-between small mb-1">
                                            <span style="color:var(--sl-text-muted);font-weight:600;">Progress</span>
                                            <span style="color:var(--sl-primary);font-weight:700;"><?= $progress['progress_percentage'] ?>%</span>
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
