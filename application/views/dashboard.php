<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('includes/head'); ?>

<body>
    <div id="wrapper">
        <?php $this->load->view('includes/top-nav-bar'); ?>
        <?php $this->load->view('includes/sidebar'); ?>

        <?php
        // Safe defaults for optional controller data
        $alphabetPreview = isset($alphabet_preview) && is_array($alphabet_preview) ? $alphabet_preview : [];
        $numbersPreview  = isset($numbers_preview)  && is_array($numbers_preview)  ? $numbers_preview  : [];
        $phrasePreview   = isset($phrase_preview)   && is_array($phrase_preview)   ? $phrase_preview   : [];
        $wordPreview     = isset($word_preview)     && is_array($word_preview)     ? $word_preview     : [];
        $signStats       = isset($sign_stats)       && is_array($sign_stats)       ? $sign_stats       : ['total' => 0, 'alphabet' => 0, 'number' => 0, 'word' => 0, 'phrase' => 0];
        $featured        = isset($featured_signs)   && is_array($featured_signs)   ? $featured_signs   : [];
        ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid" style="max-width:1400px;">

                    <!-- ============================================================
                         HERO + CONTINUE LEARNING
                         ============================================================ -->
                    <section class="row" style="margin-bottom:28px;">
                        <div class="col-lg-8 mb-4 mb-lg-0">
                            <div class="sl-hero h-100" style="min-height:300px;padding:42px 44px;">
                                <div class="row align-items-center" style="position:relative;z-index:2;">
                                    <div class="col-md-7">
                                        <span class="sl-badge" style="background:rgba(255,255,255,0.22);color:#fff;backdrop-filter:blur(8px);padding:6px 14px;margin-bottom:14px;">
                                            <i class="mdi mdi-hand-wave mr-1"></i> Welcome Back, <?= htmlspecialchars($this->session->userdata('fname')) ?>
                                        </span>
                                        <h2 style="color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(1.75rem,3vw,2.5rem);line-height:1.1;letter-spacing:-0.025em;margin:8px 0 14px;">
                                            Your FSL journey is <?= $stats['overall_accuracy'] ?>% along.
                                        </h2>
                                        <p style="color:rgba(255,255,255,0.92);font-family:'Manrope',sans-serif;font-size:1rem;line-height:1.6;max-width:460px;margin-bottom:22px;">
                                            You've learned <strong><?= $stats['total_learned'] ?></strong> signs and mastered <strong><?= $stats['mastered'] ?></strong>. Keep the momentum going.
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
                                    <!-- FSL hand figure -->
                                    <div class="col-md-5 d-none d-md-flex justify-content-center">
                                        <div style="position:relative;width:200px;height:200px;">
                                            <div style="position:absolute;inset:0;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.25) 0%,transparent 70%);"></div>
                                            <div style="position:absolute;inset:14px;border-radius:50%;background:rgba(255,255,255,0.10);backdrop-filter:blur(16px);display:flex;align-items:center;justify-content:center;box-shadow:inset 0 0 40px rgba(255,255,255,0.18);">
                                                <i class="mdi mdi-human-handsup" style="font-size:120px;color:#fff;opacity:0.95;"></i>
                                            </div>
                                            <span style="position:absolute;top:14px;right:-6px;width:48px;height:48px;border-radius:50%;background:#fff;color:var(--sl-primary);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 22px rgba(0,0,0,0.22);animation:gentleBounce 2.8s ease-in-out infinite;">
                                                <i class="mdi mdi-hand-back-right-outline" style="font-size:24px;"></i>
                                            </span>
                                            <span style="position:absolute;bottom:0;left:-4px;width:42px;height:42px;border-radius:50%;background:var(--sl-accent);color:var(--sl-primary-dark);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 22px rgba(0,0,0,0.2);animation:float 3.4s ease-in-out infinite;">
                                                <i class="mdi mdi-gesture-tap" style="font-size:22px;"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div style="position:absolute;right:-40px;bottom:-40px;width:260px;height:260px;background:var(--sl-accent);opacity:0.14;border-radius:50%;filter:blur(60px);"></div>
                            </div>
                        </div>

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
                                        <div style="position:relative;border-radius:var(--sl-radius);overflow:hidden;aspect-ratio:16/10;background:linear-gradient(135deg,#155E75 0%,#0E7490 55%,#22D3EE 130%);margin-bottom:16px;display:flex;align-items:center;justify-content:center;">
                                            <i class="mdi mdi-human-handsup" style="color:#fff;font-size:72px;opacity:0.25;position:absolute;right:-8px;bottom:-12px;"></i>
                                            <i class="mdi mdi-play-circle" style="color:#fff;font-size:64px;opacity:0.9;position:relative;z-index:2;"></i>
                                            <div style="position:absolute;inset:0;background:radial-gradient(circle at 30% 30%,rgba(34,211,238,0.35),transparent 60%);"></div>
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

                    <!-- ============================================================
                         STAT GRID
                         ============================================================ -->
                    <section class="row" style="margin-bottom:32px;">
                        <div class="col-lg-3 col-sm-6 mb-3">
                            <div class="sl-stat-card sl-card-animated primary d-flex align-items-center" style="gap:18px;padding:22px;">
                                <div class="sl-stat-icon primary" style="margin-bottom:0;"><i class="mdi mdi-fire"></i></div>
                                <div>
                                    <p style="font-size:0.6875rem;text-transform:uppercase;letter-spacing:0.14em;font-weight:700;color:var(--sl-text-muted);margin:0 0 4px;">Signs Learned</p>
                                    <p class="sl-stat-value" style="font-size:1.75rem;margin:0;" data-plugin="counterup"><?= $stats['total_learned'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-3">
                            <div class="sl-stat-card sl-card-animated accent d-flex align-items-center" style="gap:18px;padding:22px;">
                                <div class="sl-stat-icon accent" style="margin-bottom:0;"><i class="mdi mdi-hand-wave"></i></div>
                                <div>
                                    <p style="font-size:0.6875rem;text-transform:uppercase;letter-spacing:0.14em;font-weight:700;color:var(--sl-text-muted);margin:0 0 4px;">Mastered</p>
                                    <p class="sl-stat-value" style="font-size:1.75rem;margin:0;" data-plugin="counterup"><?= $stats['mastered'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-3">
                            <div class="sl-stat-card sl-card-animated success d-flex align-items-center" style="gap:18px;padding:22px;">
                                <div class="sl-stat-icon success" style="margin-bottom:0;"><i class="mdi mdi-trophy-outline"></i></div>
                                <div>
                                    <p style="font-size:0.6875rem;text-transform:uppercase;letter-spacing:0.14em;font-weight:700;color:var(--sl-text-muted);margin:0 0 4px;">Sessions</p>
                                    <p class="sl-stat-value" style="font-size:1.75rem;margin:0;" data-plugin="counterup"><?= $stats['total_sessions'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-3">
                            <div class="sl-stat-card sl-card-animated secondary d-flex align-items-center" style="gap:18px;padding:22px;">
                                <div class="sl-stat-icon secondary" style="margin-bottom:0;"><i class="mdi mdi-target"></i></div>
                                <div>
                                    <p style="font-size:0.6875rem;text-transform:uppercase;letter-spacing:0.14em;font-weight:700;color:var(--sl-text-muted);margin:0 0 4px;">Accuracy</p>
                                    <p class="sl-stat-value" style="font-size:1.75rem;margin:0;"><span data-plugin="counterup"><?= $stats['overall_accuracy'] ?></span>%</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- ============================================================
                         START WITH THE BASICS — three distinct learning paths
                         ============================================================ -->
                    <section style="margin-bottom:32px;">
                        <div class="d-flex justify-content-between align-items-end mb-3">
                            <div>
                                <p style="font-family:'Manrope',sans-serif;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.14em;color:var(--sl-primary);font-weight:700;margin:0 0 4px;">Foundations</p>
                                <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.625rem;color:var(--sl-text);margin:0;letter-spacing:-0.02em;">Start with the Basics</h3>
                            </div>
                            <a href="<?= base_url('FSL/dictionary') ?>" style="color:var(--sl-primary);font-weight:700;font-size:0.875rem;text-decoration:none;">Explore Library →</a>
                        </div>

                        <div class="row">
                            <!-- Alphabet path (cyan) -->
                            <div class="col-md-4 mb-3">
                                <a href="<?= base_url('FSL/alphabet') ?>" class="text-decoration-none">
                                    <div class="sl-lesson-card h-100" style="overflow:hidden;">
                                        <div style="position:relative;height:170px;background:linear-gradient(135deg,#0E7490 0%,#0891B2 55%,#22D3EE 130%);display:flex;align-items:center;justify-content:center;">
                                            <div style="display:flex;gap:8px;z-index:2;">
                                                <span style="width:56px;height:72px;border-radius:14px;background:rgba(255,255,255,0.2);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2rem;letter-spacing:-0.03em;transform:rotate(-6deg);">A</span>
                                                <span style="width:56px;height:72px;border-radius:14px;background:rgba(255,255,255,0.32);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2rem;letter-spacing:-0.03em;">B</span>
                                                <span style="width:56px;height:72px;border-radius:14px;background:rgba(255,255,255,0.2);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2rem;letter-spacing:-0.03em;transform:rotate(6deg);">C</span>
                                            </div>
                                            <span class="sl-badge" style="position:absolute;top:14px;left:14px;background:rgba(255,255,255,0.24);color:#fff;backdrop-filter:blur(8px);">Alphabet</span>
                                        </div>
                                        <div style="padding:20px;">
                                            <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.0625rem;color:var(--sl-text);margin-bottom:6px;">FSL Alphabet</h4>
                                            <p style="color:var(--sl-text-muted);font-size:0.875rem;margin-bottom:14px;line-height:1.5;">Handshapes for every letter — the foundation of fingerspelling.</p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span style="color:var(--sl-text-muted);font-size:0.8125rem;font-weight:600;"><?= $signStats['alphabet'] ?> letters</span>
                                                <span style="color:var(--sl-primary);font-weight:700;font-size:0.875rem;">Start →</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Numbers path (deep teal) -->
                            <div class="col-md-4 mb-3">
                                <a href="<?= base_url('FSL/numbers') ?>" class="text-decoration-none">
                                    <div class="sl-lesson-card h-100" style="overflow:hidden;">
                                        <div style="position:relative;height:170px;background:linear-gradient(135deg,#1E3A8A 0%,#3B82F6 50%,#60A5FA 130%);display:flex;align-items:center;justify-content:center;">
                                            <div style="display:flex;gap:8px;z-index:2;">
                                                <span style="width:56px;height:72px;border-radius:14px;background:rgba(255,255,255,0.2);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2rem;letter-spacing:-0.03em;transform:rotate(-6deg);">1</span>
                                                <span style="width:56px;height:72px;border-radius:14px;background:rgba(255,255,255,0.32);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2rem;letter-spacing:-0.03em;">2</span>
                                                <span style="width:56px;height:72px;border-radius:14px;background:rgba(255,255,255,0.2);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2rem;letter-spacing:-0.03em;transform:rotate(6deg);">3</span>
                                            </div>
                                            <span class="sl-badge" style="position:absolute;top:14px;left:14px;background:rgba(255,255,255,0.24);color:#fff;backdrop-filter:blur(8px);">Numbers</span>
                                        </div>
                                        <div style="padding:20px;">
                                            <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.0625rem;color:var(--sl-text);margin-bottom:6px;">FSL Numbers 0-9</h4>
                                            <p style="color:var(--sl-text-muted);font-size:0.875rem;margin-bottom:14px;line-height:1.5;">Count, share your age, give a phone number — handshapes for digits.</p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span style="color:var(--sl-text-muted);font-size:0.8125rem;font-weight:600;"><?= $signStats['number'] ?> numbers</span>
                                                <span style="color:#3B82F6;font-weight:700;font-size:0.875rem;">Start →</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Greetings path (amber / warm accent for contrast) -->
                            <div class="col-md-4 mb-3">
                                <a href="<?= base_url('FSL/dictionary?type=phrase') ?>" class="text-decoration-none">
                                    <div class="sl-lesson-card h-100" style="overflow:hidden;">
                                        <div style="position:relative;height:170px;background:linear-gradient(135deg,#B45309 0%,#F59E0B 55%,#FCD34D 130%);display:flex;align-items:center;justify-content:center;">
                                            <div style="position:relative;z-index:2;display:flex;flex-direction:column;align-items:center;">
                                                <i class="mdi mdi-hand-wave" style="font-size:64px;color:#fff;text-shadow:0 4px 18px rgba(0,0,0,0.25);"></i>
                                                <p style="color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9rem;margin:6px 0 0;letter-spacing:-0.01em;text-shadow:0 2px 6px rgba(0,0,0,0.25);">Kumusta!</p>
                                            </div>
                                            <span class="sl-badge" style="position:absolute;top:14px;left:14px;background:rgba(255,255,255,0.26);color:#fff;backdrop-filter:blur(8px);">Everyday</span>
                                        </div>
                                        <div style="padding:20px;">
                                            <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.0625rem;color:var(--sl-text);margin-bottom:6px;">Greetings &amp; Phrases</h4>
                                            <p style="color:var(--sl-text-muted);font-size:0.875rem;margin-bottom:14px;line-height:1.5;">Say hello, thank you, and connect through daily Filipino expressions.</p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span style="color:var(--sl-text-muted);font-size:0.8125rem;font-weight:600;"><?= $signStats['phrase'] ?> phrases</span>
                                                <span style="color:#B45309;font-weight:700;font-size:0.875rem;">Start →</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </section>

                    <!-- ============================================================
                         FSL ALPHABET PREVIEW — actual letter tiles with images
                         ============================================================ -->
                    <section class="sl-card" style="padding:28px;border-radius:var(--sl-radius-xl);margin-bottom:28px;">
                        <div class="d-flex flex-wrap justify-content-between align-items-end mb-3" style="gap:12px;">
                            <div>
                                <p style="font-family:'Manrope',sans-serif;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.14em;color:var(--sl-primary);font-weight:700;margin:0 0 4px;">
                                    <span style="width:6px;height:6px;border-radius:50%;background:var(--sl-accent);display:inline-block;margin-right:6px;vertical-align:middle;"></span>
                                    Dictionary
                                </p>
                                <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.375rem;color:var(--sl-text);margin:0;letter-spacing:-0.02em;">The FSL Alphabet</h3>
                                <p style="color:var(--sl-text-muted);font-size:0.9375rem;margin:4px 0 0;">Tap any letter to see its handshape, movement, and context.</p>
                            </div>
                            <a href="<?= base_url('FSL/alphabet') ?>" class="sl-btn sl-btn-outline" style="padding:8px 18px;font-size:0.8125rem;">View all letters →</a>
                        </div>

                        <?php if (!empty($alphabetPreview)): ?>
                            <div class="row" style="margin-top:10px;">
                                <?php foreach (array_slice($alphabetPreview, 0, 12) as $letter): ?>
                                    <div class="col-lg-1 col-md-2 col-3 mb-3" style="flex:0 0 calc(100% / 12);max-width:calc(100% / 12);">
                                        <a href="<?= base_url('FSL/sign_detail/' . $letter->sign_id) ?>" class="text-decoration-none">
                                            <div style="aspect-ratio:1/1;background:linear-gradient(135deg,#F0FDFA 0%,#CFFAFE 100%);border-radius:var(--sl-radius);display:flex;align-items:center;justify-content:center;box-shadow:var(--sl-shadow);transition:all 0.3s;position:relative;overflow:hidden;">
                                                <?php if ($letter->image_path && file_exists(FCPATH . $letter->image_path)): ?>
                                                    <img src="<?= base_url($letter->image_path) ?>" alt="<?= htmlspecialchars($letter->sign_name) ?>" style="max-width:80%;max-height:80%;object-fit:contain;">
                                                <?php else: ?>
                                                    <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.875rem;color:var(--sl-primary-dark);letter-spacing:-0.03em;"><?= htmlspecialchars($letter->sign_name) ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <!-- No DB rows yet — show styled A-L preview so the section never looks empty -->
                            <div class="row" style="margin-top:10px;">
                                <?php foreach (range('A', 'L') as $fallbackLetter): ?>
                                    <div class="col-lg-1 col-md-2 col-3 mb-3" style="flex:0 0 calc(100% / 12);max-width:calc(100% / 12);">
                                        <div style="aspect-ratio:1/1;background:linear-gradient(135deg,#F0FDFA 0%,#CFFAFE 100%);border-radius:var(--sl-radius);display:flex;align-items:center;justify-content:center;box-shadow:var(--sl-shadow);">
                                            <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.875rem;color:var(--sl-primary-dark);letter-spacing:-0.03em;"><?= $fallbackLetter ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </section>

                    <!-- ============================================================
                         NUMBERS PREVIEW + COMMON WORDS
                         ============================================================ -->
                    <section class="row" style="margin-bottom:32px;">
                        <div class="col-lg-6 mb-3">
                            <div class="sl-card h-100" style="padding:26px;border-radius:var(--sl-radius-xl);background:linear-gradient(135deg,#ffffff 0%,#F0F9FF 100%);">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <p style="font-family:'Manrope',sans-serif;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.14em;color:#1E3A8A;font-weight:700;margin:0 0 4px;">Numbers</p>
                                        <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.25rem;color:var(--sl-text);margin:0;">Count in FSL</h4>
                                    </div>
                                    <a href="<?= base_url('FSL/numbers') ?>" style="color:#3B82F6;font-weight:700;font-size:0.8125rem;text-decoration:none;">View all →</a>
                                </div>
                                <div class="row" style="margin-top:6px;">
                                    <?php
                                    $showNums = !empty($numbersPreview) ? array_slice($numbersPreview, 0, 10) : [];
                                    if (empty($showNums)):
                                        foreach (range(0, 9) as $n):
                                    ?>
                                        <div class="col-2 mb-2 px-1">
                                            <div style="aspect-ratio:1/1;background:linear-gradient(135deg,#DBEAFE 0%,#93C5FD 100%);border-radius:var(--sl-radius-sm);display:flex;align-items:center;justify-content:center;box-shadow:var(--sl-shadow);">
                                                <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.5rem;color:#1E3A8A;letter-spacing:-0.03em;"><?= $n ?></span>
                                            </div>
                                        </div>
                                    <?php
                                        endforeach;
                                    else:
                                        foreach ($showNums as $num):
                                    ?>
                                        <div class="col-2 mb-2 px-1">
                                            <a href="<?= base_url('FSL/sign_detail/' . $num->sign_id) ?>" class="text-decoration-none">
                                                <div style="aspect-ratio:1/1;background:linear-gradient(135deg,#DBEAFE 0%,#93C5FD 100%);border-radius:var(--sl-radius-sm);display:flex;align-items:center;justify-content:center;box-shadow:var(--sl-shadow);transition:transform 0.25s;">
                                                    <?php if ($num->image_path && file_exists(FCPATH . $num->image_path)): ?>
                                                        <img src="<?= base_url($num->image_path) ?>" alt="<?= htmlspecialchars($num->sign_name) ?>" style="max-width:75%;max-height:75%;object-fit:contain;">
                                                    <?php else: ?>
                                                        <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.5rem;color:#1E3A8A;letter-spacing:-0.03em;"><?= htmlspecialchars($num->sign_name) ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </a>
                                        </div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                                <p style="color:var(--sl-text-muted);font-size:0.8125rem;margin:12px 0 0;line-height:1.5;">
                                    <i class="mdi mdi-lightbulb-outline" style="color:#F59E0B;"></i>
                                    Numbers 0-5 extend fingers; 6-9 touch thumb to fingers.
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div class="sl-card h-100" style="padding:26px;border-radius:var(--sl-radius-xl);background:linear-gradient(135deg,#ffffff 0%,#FFF7ED 100%);">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <p style="font-family:'Manrope',sans-serif;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.14em;color:#B45309;font-weight:700;margin:0 0 4px;">Greetings &amp; Words</p>
                                        <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.25rem;color:var(--sl-text);margin:0;">Everyday Filipino</h4>
                                    </div>
                                    <a href="<?= base_url('FSL/dictionary?type=phrase') ?>" style="color:#B45309;font-weight:700;font-size:0.8125rem;text-decoration:none;">View all →</a>
                                </div>

                                <?php
                                $combined = array_merge($phrasePreview, $wordPreview);
                                $combined = array_slice($combined, 0, 4);
                                ?>
                                <?php if (!empty($combined)): ?>
                                    <div class="row">
                                        <?php foreach ($combined as $p): ?>
                                            <div class="col-6 mb-2">
                                                <a href="<?= base_url('FSL/sign_detail/' . $p->sign_id) ?>" class="text-decoration-none">
                                                    <div style="background:#fff;border-radius:var(--sl-radius-sm);padding:14px;box-shadow:var(--sl-shadow);display:flex;align-items:center;gap:12px;transition:transform 0.25s;">
                                                        <div style="width:46px;height:46px;border-radius:12px;background:linear-gradient(135deg,#FEF3C7 0%,#FCD34D 100%);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                                            <?php if ($p->image_path && file_exists(FCPATH . $p->image_path)): ?>
                                                                <img src="<?= base_url($p->image_path) ?>" alt="<?= htmlspecialchars($p->sign_name) ?>" style="max-width:80%;max-height:80%;object-fit:contain;">
                                                            <?php else: ?>
                                                                <i class="mdi mdi-hand-wave" style="color:#B45309;font-size:1.25rem;"></i>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div style="min-width:0;">
                                                            <p style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9375rem;color:var(--sl-text);margin:0;line-height:1.2;"><?= htmlspecialchars($p->sign_name) ?></p>
                                                            <p style="color:var(--sl-text-muted);font-size:0.75rem;margin:2px 0 0;text-transform:uppercase;letter-spacing:0.08em;font-weight:600;"><?= ucfirst($p->sign_type) ?></p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="row">
                                        <?php
                                        $fallbackPhrases = [
                                            ['Kumusta', 'Hello'],
                                            ['Salamat', 'Thank you'],
                                            ['Oo', 'Yes'],
                                            ['Hindi', 'No'],
                                        ];
                                        foreach ($fallbackPhrases as $fp):
                                        ?>
                                            <div class="col-6 mb-2">
                                                <div style="background:#fff;border-radius:var(--sl-radius-sm);padding:14px;box-shadow:var(--sl-shadow);display:flex;align-items:center;gap:12px;">
                                                    <div style="width:46px;height:46px;border-radius:12px;background:linear-gradient(135deg,#FEF3C7 0%,#FCD34D 100%);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                                        <i class="mdi mdi-hand-wave" style="color:#B45309;font-size:1.25rem;"></i>
                                                    </div>
                                                    <div style="min-width:0;">
                                                        <p style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9375rem;color:var(--sl-text);margin:0;line-height:1.2;"><?= $fp[0] ?></p>
                                                        <p style="color:var(--sl-text-muted);font-size:0.75rem;margin:2px 0 0;"><?= $fp[1] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>

                    <!-- ============================================================
                         RECOMMENDED + BROWSE TOPICS
                         ============================================================ -->
                    <section class="row">
                        <div class="col-lg-8 mb-4">
                            <?php
                            $__recommended = array_slice($featured, 0, 2);
                            $__quickBrowse = count($featured) > 2 ? array_slice($featured, 2, 6) : [];
                            ?>

                            <div class="d-flex justify-content-between align-items-end mb-3">
                                <div>
                                    <p style="font-family:'Manrope',sans-serif;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.14em;color:var(--sl-primary);font-weight:700;margin:0 0 4px;">For You</p>
                                    <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.5rem;color:var(--sl-text);margin:0;letter-spacing:-0.02em;">Recommended Signs</h3>
                                </div>
                                <a href="<?= base_url('FSL/dictionary') ?>" style="color:var(--sl-primary);font-weight:700;font-size:0.875rem;text-decoration:none;">Full library →</a>
                            </div>

                            <?php if (!empty($__recommended)): ?>
                                <div class="row">
                                    <?php foreach ($__recommended as $sign):
                                        $gradient = ($sign->sign_type === 'number')
                                            ? 'linear-gradient(135deg,#1E3A8A 0%,#3B82F6 60%,#60A5FA 130%)'
                                            : (($sign->sign_type === 'phrase' || $sign->sign_type === 'word')
                                                ? 'linear-gradient(135deg,#B45309 0%,#F59E0B 60%,#FCD34D 130%)'
                                                : 'linear-gradient(135deg,#0E7490 0%,#0891B2 60%,#22D3EE 130%)');
                                    ?>
                                        <div class="col-md-6 mb-3">
                                            <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="text-decoration-none">
                                                <div class="sl-lesson-card h-100" style="overflow:hidden;">
                                                    <div style="position:relative;height:190px;background:<?= $gradient ?>;overflow:hidden;display:flex;align-items:center;justify-content:center;">
                                                        <?php if ($sign->image_path && file_exists(FCPATH . $sign->image_path)): ?>
                                                            <img src="<?= base_url($sign->image_path) ?>" alt="<?= htmlspecialchars($sign->sign_name) ?>" style="max-width:75%;max-height:80%;object-fit:contain;filter:drop-shadow(0 8px 24px rgba(0,0,0,0.25));">
                                                        <?php else: ?>
                                                            <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:5rem;color:#fff;letter-spacing:-0.04em;text-shadow:0 6px 24px rgba(0,0,0,0.25);"><?= htmlspecialchars(mb_substr($sign->sign_name, 0, 2)) ?></span>
                                                        <?php endif; ?>
                                                        <span class="sl-badge" style="position:absolute;top:14px;right:14px;background:rgba(15,23,42,0.78);color:#fff;"><?= ucfirst($sign->sign_type) ?></span>
                                                    </div>
                                                    <div style="padding:20px;">
                                                        <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.0625rem;color:var(--sl-text);margin-bottom:6px;"><?= htmlspecialchars($sign->sign_name) ?></h4>
                                                        <p style="color:var(--sl-text-muted);font-size:0.875rem;margin-bottom:0;line-height:1.5;">
                                                            <?= !empty($sign->description) ? htmlspecialchars(mb_substr($sign->description, 0, 90)) . (mb_strlen($sign->description) > 90 ? '…' : '') : 'Tap to learn the handshape, movement, and context.' ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <!-- No featured signs yet — point users to practice + quiz -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <a href="<?= base_url('Practice') ?>" class="text-decoration-none">
                                            <div class="sl-lesson-card h-100" style="overflow:hidden;">
                                                <div style="position:relative;height:190px;background:linear-gradient(135deg,#0E7490 0%,#0891B2 50%,#22D3EE 120%);display:flex;align-items:center;justify-content:center;">
                                                    <i class="mdi mdi-camera-plus-outline" style="font-size:80px;color:#fff;opacity:0.9;"></i>
                                                </div>
                                                <div style="padding:20px;">
                                                    <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.0625rem;color:var(--sl-text);margin-bottom:6px;">Camera Practice</h4>
                                                    <p style="color:var(--sl-text-muted);font-size:0.875rem;margin-bottom:0;line-height:1.5;">Real-time AI feedback on your handshape and movement.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <a href="<?= base_url('Quiz') ?>" class="text-decoration-none">
                                            <div class="sl-lesson-card h-100" style="overflow:hidden;">
                                                <div style="position:relative;height:190px;background:linear-gradient(135deg,#B45309 0%,#F59E0B 50%,#FCD34D 120%);display:flex;align-items:center;justify-content:center;">
                                                    <i class="mdi mdi-trophy-outline" style="font-size:80px;color:#fff;opacity:0.9;"></i>
                                                </div>
                                                <div style="padding:20px;">
                                                    <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.0625rem;color:var(--sl-text);margin-bottom:6px;">Take a Quiz</h4>
                                                    <p style="color:var(--sl-text-muted);font-size:0.875rem;margin-bottom:0;line-height:1.5;">Test your recall of letters, numbers, and phrases.</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Quick Browse strip -->
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
                                                        <?php if ($sign->image_path && file_exists(FCPATH . $sign->image_path)): ?>
                                                            <img src="<?= base_url($sign->image_path) ?>" alt="<?= htmlspecialchars($sign->sign_name) ?>">
                                                        <?php else: ?>
                                                            <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2rem;color:var(--sl-primary);letter-spacing:-0.03em;"><?= htmlspecialchars(mb_substr($sign->sign_name, 0, 2)) ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="sl-sign-name" style="font-size:0.9375rem;"><?= htmlspecialchars($sign->sign_name) ?></div>
                                                    <div class="sl-sign-type"><?= ucfirst($sign->sign_type) ?></div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php elseif (!empty($recent_lessons)): ?>
                                <div class="d-flex justify-content-between align-items-end mb-3 mt-4">
                                    <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.125rem;color:var(--sl-text);margin:0;">Jump Back In</h4>
                                    <a href="<?= base_url('FSL/lessons') ?>" style="color:var(--sl-primary);font-weight:600;font-size:0.8125rem;text-decoration:none;">All lessons →</a>
                                </div>
                                <div class="row">
                                    <?php
                                    $lessonGradients = [
                                        'linear-gradient(135deg,#0E7490 0%,#22D3EE 100%)',
                                        'linear-gradient(135deg,#155E75 0%,#0891B2 100%)',
                                        'linear-gradient(135deg,#1E3A8A 0%,#3B82F6 100%)',
                                    ];
                                    foreach (array_slice($recent_lessons, 0, 3) as $idx => $l):
                                        $lp = isset($l->user_progress) ? $l->user_progress : ['progress_percentage' => 0];
                                        $gr = $lessonGradients[$idx % count($lessonGradients)];
                                    ?>
                                        <div class="col-md-4 col-6 mb-3">
                                            <a href="<?= base_url('FSL/lesson/' . $l->lesson_id) ?>" class="text-decoration-none">
                                                <div class="sl-sign-card" style="text-align:left;">
                                                    <div class="sl-sign-preview" style="height:96px;background:<?= $gr ?>;">
                                                        <i class="mdi mdi-play-circle" style="font-size:38px;color:#fff;opacity:0.92;"></i>
                                                    </div>
                                                    <div class="sl-sign-name" style="font-size:0.9375rem;"><?= htmlspecialchars($l->lesson_title) ?></div>
                                                    <div class="sl-sign-type"><?= ucfirst($l->difficulty_level) ?> · <?= $lp['progress_percentage'] ?>%</div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Browse Topics: richer visual tiles instead of a plain list -->
                        <div class="col-lg-4 mb-4">
                            <div class="d-flex justify-content-between align-items-end mb-3">
                                <div>
                                    <p style="font-family:'Manrope',sans-serif;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.14em;color:var(--sl-primary);font-weight:700;margin:0 0 4px;">Explore</p>
                                    <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.5rem;color:var(--sl-text);margin:0;letter-spacing:-0.02em;">Browse Topics</h3>
                                </div>
                            </div>

                            <div class="sl-card" style="padding:18px;border-radius:var(--sl-radius-xl);">
                                <?php
                                $catGradients = [
                                    ['bg' => 'linear-gradient(135deg,#CFFAFE,#67E8F9)', 'fg' => '#0E7490', 'icon' => 'mdi-alphabetical-variant'],
                                    ['bg' => 'linear-gradient(135deg,#DBEAFE,#93C5FD)', 'fg' => '#1E3A8A', 'icon' => 'mdi-numeric'],
                                    ['bg' => 'linear-gradient(135deg,#FEF3C7,#FCD34D)', 'fg' => '#B45309', 'icon' => 'mdi-hand-wave'],
                                    ['bg' => 'linear-gradient(135deg,#FCE7F3,#F9A8D4)', 'fg' => '#9D174D', 'icon' => 'mdi-heart-outline'],
                                    ['bg' => 'linear-gradient(135deg,#D1FAE5,#6EE7B7)', 'fg' => '#065F46', 'icon' => 'mdi-food-apple-outline'],
                                    ['bg' => 'linear-gradient(135deg,#EDE9FE,#C4B5FD)', 'fg' => '#5B21B6', 'icon' => 'mdi-shape-outline'],
                                ];
                                $catsToShow = array_slice($categories, 0, 6);
                                if (!empty($catsToShow)):
                                    foreach ($catsToShow as $i => $category):
                                        $g = $catGradients[$i % count($catGradients)];
                                ?>
                                    <a href="<?= base_url('FSL/category/' . $category->category_id) ?>"
                                        class="d-flex align-items-center text-decoration-none"
                                        style="padding:12px;border-radius:var(--sl-radius-sm);background:var(--sl-surface);transition:all 0.25s;margin-bottom:8px;">
                                        <div style="width:44px;height:44px;border-radius:12px;background:<?= $g['bg'] ?>;color:<?= $g['fg'] ?>;display:flex;align-items:center;justify-content:center;margin-right:12px;flex-shrink:0;">
                                            <i class="mdi <?= $g['icon'] ?>" style="font-size:1.25rem;"></i>
                                        </div>
                                        <div style="flex:1;min-width:0;">
                                            <p style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9375rem;color:var(--sl-text);margin:0;line-height:1.2;"><?= htmlspecialchars($category->category_name) ?></p>
                                            <p style="color:var(--sl-text-muted);font-size:0.75rem;margin:2px 0 0;font-weight:500;">Tap to explore</p>
                                        </div>
                                        <i class="mdi mdi-chevron-right" style="color:var(--sl-text-soft);font-size:1.25rem;"></i>
                                    </a>
                                <?php
                                    endforeach;
                                else:
                                    $fallbackCats = [
                                        ['Alphabet', 'mdi-alphabetical-variant', 0],
                                        ['Numbers', 'mdi-numeric', 1],
                                        ['Greetings', 'mdi-hand-wave', 2],
                                    ];
                                    foreach ($fallbackCats as $fc):
                                        $g = $catGradients[$fc[2]];
                                ?>
                                    <div style="padding:12px;border-radius:var(--sl-radius-sm);background:var(--sl-surface);margin-bottom:8px;display:flex;align-items:center;">
                                        <div style="width:44px;height:44px;border-radius:12px;background:<?= $g['bg'] ?>;color:<?= $g['fg'] ?>;display:flex;align-items:center;justify-content:center;margin-right:12px;">
                                            <i class="mdi <?= $fc[1] ?>" style="font-size:1.25rem;"></i>
                                        </div>
                                        <p style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9375rem;color:var(--sl-text);margin:0;"><?= $fc[0] ?></p>
                                    </div>
                                <?php
                                    endforeach;
                                endif;
                                ?>

                                <a href="<?= base_url('FSL/dictionary') ?>" class="sl-btn sl-btn-outline w-100 justify-content-center mt-2">
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
