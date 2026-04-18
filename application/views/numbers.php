<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('includes/head'); ?>

<body>
    <div id="wrapper">
        <?php $this->load->view('includes/top-nav-bar'); ?>
        <?php $this->load->view('includes/sidebar'); ?>

        <?php
        // Active number: first by default, or via query string
        $activeNumber = null;
        $activeId = $this->input->get('active');
        if (!empty($numbers)) {
            if ($activeId) {
                foreach ($numbers as $n) {
                    if ($n->sign_id == $activeId) { $activeNumber = $n; break; }
                }
            }
            if (!$activeNumber) { $activeNumber = $numbers[0]; }
        }

        // Palette splits 0-5 (extended fingers) vs 6-9 (thumb-touch)
        $numGroup = function($name) {
            $n = (int) preg_replace('/\D/', '', $name);
            return $n <= 5
                ? ['from' => '#1E3A8A', 'to' => '#3B82F6', 'label' => 'Extended Fingers']
                : ['from' => '#5B21B6', 'to' => '#A78BFA', 'label' => 'Thumb Touch'];
        };
        ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid" style="max-width:1400px;">

                    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4" style="gap:16px;">
                        <div class="sl-page-header mb-0">
                            <h1 class="sl-page-title">FSL Numbers</h1>
                            <p class="sl-page-subtitle" style="max-width:640px;">Count, express age, and share phone numbers in Filipino Sign Language. <?= count($numbers) ?> handshapes to learn.</p>
                        </div>
                        <div class="sl-filter-group">
                            <a href="<?= base_url('FSL/alphabet') ?>" class="sl-filter-btn"><i class="mdi mdi-alphabetical-variant mr-1"></i> Alphabet</a>
                            <a href="<?= base_url('FSL/numbers') ?>" class="sl-filter-btn active"><i class="mdi mdi-numeric mr-1"></i> Numbers</a>
                        </div>
                    </div>

                    <!-- Intro hero -->
                    <div class="sl-hero mb-4" style="padding:32px;min-height:180px;background:linear-gradient(135deg,#1E3A8A 0%,#3B82F6 50%,#60A5FA 130%);">
                        <div class="row align-items-center" style="position:relative;z-index:2;">
                            <div class="col-md-8">
                                <span class="sl-badge" style="background:rgba(255,255,255,0.22);color:#fff;margin-bottom:10px;">
                                    <i class="mdi mdi-counter mr-1"></i> Numerical Communication
                                </span>
                                <h2 style="color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(1.5rem,2.5vw,2rem);margin:6px 0 10px;letter-spacing:-0.02em;">
                                    One hand. Ten digits. Endless possibilities.
                                </h2>
                                <p style="color:rgba(255,255,255,0.92);font-family:'Manrope',sans-serif;font-size:0.9375rem;line-height:1.6;max-width:520px;margin:0;">
                                    Numbers <strong>0–5</strong> use extended fingers. Numbers <strong>6–9</strong> touch the thumb to different fingers.
                                </p>
                            </div>
                            <div class="col-md-4 d-none d-md-flex justify-content-end">
                                <div style="display:flex;gap:10px;">
                                    <span style="width:60px;height:78px;border-radius:16px;background:rgba(255,255,255,0.22);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2.25rem;letter-spacing:-0.04em;transform:rotate(-8deg);">1</span>
                                    <span style="width:60px;height:78px;border-radius:16px;background:rgba(255,255,255,0.35);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2.25rem;letter-spacing:-0.04em;">2</span>
                                    <span style="width:60px;height:78px;border-radius:16px;background:rgba(255,255,255,0.22);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2.25rem;letter-spacing:-0.04em;transform:rotate(8deg);">3</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 mb-4">
                            <div class="sl-card" style="padding:28px;border-radius:var(--sl-radius-xl);">
                                <div class="d-flex justify-content-between align-items-center mb-3" style="gap:8px;flex-wrap:wrap;">
                                    <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.125rem;color:var(--sl-text);margin:0;">0 → 9</h4>
                                    <span style="color:var(--sl-text-muted);font-size:0.8125rem;">Tap any number to preview the handshape</span>
                                </div>

                                <div class="row justify-content-center">
                                    <?php if (!empty($numbers)): ?>
                                        <?php foreach ($numbers as $i => $number):
                                            $isActive = $activeNumber && $number->sign_id == $activeNumber->sign_id;
                                            $g = $numGroup($number->sign_name);
                                        ?>
                                            <div class="col-md-3 col-sm-4 col-4 mb-3">
                                                <a href="<?= base_url('FSL/numbers?active=' . $number->sign_id) ?>" class="text-decoration-none">
                                                    <div style="aspect-ratio:1/1;background:<?= $isActive ? 'linear-gradient(135deg,'.$g['from'].' 0%,'.$g['to'].' 100%)' : 'linear-gradient(135deg,#DBEAFE 0%,#EDE9FE 100%)' ?>;border-radius:var(--sl-radius);display:flex;align-items:center;justify-content:center;box-shadow:<?= $isActive ? '0 14px 30px rgba(59,130,246,0.3)' : 'var(--sl-shadow)' ?>;transition:all 0.3s;position:relative;">
                                                        <?php if ($number->image_path && file_exists(FCPATH . $number->image_path)): ?>
                                                            <img src="<?= base_url($number->image_path) ?>" alt="<?= htmlspecialchars($number->sign_name) ?>" style="max-width:75%;max-height:75%;object-fit:contain;<?= $isActive ? 'filter:drop-shadow(0 6px 14px rgba(0,0,0,0.25));' : '' ?>">
                                                        <?php else: ?>
                                                            <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(2rem,4vw,3rem);color:<?= $isActive ? '#fff' : $g['from'] ?>;letter-spacing:-0.04em;<?= $isActive ? 'text-shadow:0 4px 12px rgba(0,0,0,0.22);' : '' ?>"><?= htmlspecialchars($number->sign_name) ?></span>
                                                        <?php endif; ?>
                                                        <?php if ($isActive): ?>
                                                            <span style="position:absolute;top:8px;right:8px;width:10px;height:10px;border-radius:50%;background:#fff;box-shadow:0 0 0 3px rgba(255,255,255,0.35);"></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <?php foreach (range(0, 9) as $n):
                                            $g = $numGroup((string) $n);
                                        ?>
                                            <div class="col-md-3 col-sm-4 col-4 mb-3">
                                                <div style="aspect-ratio:1/1;background:linear-gradient(135deg,#DBEAFE 0%,#EDE9FE 100%);border-radius:var(--sl-radius);display:flex;align-items:center;justify-content:center;box-shadow:var(--sl-shadow);">
                                                    <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(2rem,4vw,3rem);color:<?= $g['from'] ?>;letter-spacing:-0.04em;"><?= $n ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>

                                <!-- Two-rule callouts -->
                                <div class="row mt-3">
                                    <div class="col-md-6 mb-2">
                                        <div style="background:linear-gradient(135deg,#DBEAFE 0%,#BFDBFE 100%);border-radius:var(--sl-radius-lg);padding:18px 20px;display:flex;gap:14px;align-items:center;">
                                            <div style="width:48px;height:48px;border-radius:14px;background:#fff;color:#1E3A8A;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.125rem;">0–5</div>
                                            <div style="min-width:0;">
                                                <p style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:#1E3A8A;margin:0;font-size:0.9375rem;">Extended Fingers</p>
                                                <p style="color:#1E3A8A;opacity:0.78;font-size:0.8125rem;margin:2px 0 0;line-height:1.4;">Raise the corresponding number of fingers, palm outward.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div style="background:linear-gradient(135deg,#EDE9FE 0%,#DDD6FE 100%);border-radius:var(--sl-radius-lg);padding:18px 20px;display:flex;gap:14px;align-items:center;">
                                            <div style="width:48px;height:48px;border-radius:14px;background:#fff;color:#5B21B6;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.125rem;">6–9</div>
                                            <div style="min-width:0;">
                                                <p style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:#5B21B6;margin:0;font-size:0.9375rem;">Thumb Touch</p>
                                                <p style="color:#5B21B6;opacity:0.78;font-size:0.8125rem;margin:2px 0 0;line-height:1.4;">Thumb touches the pinky (6), ring (7), middle (8), or index (9).</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-4">
                            <?php if ($activeNumber):
                                $g = $numGroup($activeNumber->sign_name);
                            ?>
                                <div class="sl-card" style="padding:24px;border-radius:var(--sl-radius-xl);position:sticky;top:90px;">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <span class="sl-badge" style="background:rgba(59,130,246,0.14);color:#1E3A8A;"><i class="mdi mdi-counter mr-1"></i> <?= $g['label'] ?></span>
                                            <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2rem;color:var(--sl-text);margin:10px 0 0;letter-spacing:-0.02em;">Number <?= htmlspecialchars($activeNumber->sign_name) ?></h3>
                                        </div>
                                        <a href="<?= base_url('FSL/sign_detail/' . $activeNumber->sign_id) ?>" title="Open detail" style="width:40px;height:40px;border-radius:50%;background:var(--sl-surface-low);color:#1E3A8A;display:flex;align-items:center;justify-content:center;text-decoration:none;">
                                            <i class="mdi mdi-open-in-new"></i>
                                        </a>
                                    </div>

                                    <div style="position:relative;background:linear-gradient(135deg,<?= $g['from'] ?> 0%,<?= $g['to'] ?> 100%);border-radius:var(--sl-radius-lg);aspect-ratio:1/1;display:flex;align-items:center;justify-content:center;overflow:hidden;margin-bottom:18px;box-shadow:0 14px 30px rgba(59,130,246,0.22);">
                                        <?php if ($activeNumber->image_path && file_exists(FCPATH . $activeNumber->image_path)): ?>
                                            <img src="<?= base_url($activeNumber->image_path) ?>" alt="<?= htmlspecialchars($activeNumber->sign_name) ?>" style="max-width:80%;max-height:80%;object-fit:contain;filter:drop-shadow(0 10px 24px rgba(0,0,0,0.3));">
                                        <?php else: ?>
                                            <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:7rem;color:#fff;letter-spacing:-0.04em;text-shadow:0 8px 26px rgba(0,0,0,0.32);"><?= htmlspecialchars($activeNumber->sign_name) ?></span>
                                        <?php endif; ?>
                                        <span class="sl-badge" style="position:absolute;bottom:14px;left:14px;background:rgba(15,23,42,0.78);color:#fff;">
                                            <i class="mdi mdi-record-circle mr-1" style="color:#EF4444;"></i> Live Demo
                                        </span>
                                    </div>

                                    <?php if (!empty($activeNumber->description)): ?>
                                        <p style="color:var(--sl-body-text);font-family:'Manrope',sans-serif;font-size:0.875rem;line-height:1.6;margin:0 0 14px;"><?= htmlspecialchars($activeNumber->description) ?></p>
                                    <?php endif; ?>

                                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9375rem;color:var(--sl-text);margin:0 0 10px;">
                                        <span style="color:#3B82F6;">●</span> Positioning Tips
                                    </h5>
                                    <ul style="list-style:none;padding:0;margin:0 0 18px;">
                                        <li style="display:flex;align-items:flex-start;gap:10px;margin-bottom:8px;">
                                            <span style="width:20px;height:20px;border-radius:50%;background:rgba(59,130,246,0.14);color:#1E3A8A;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                                                <i class="mdi mdi-check" style="font-size:12px;"></i>
                                            </span>
                                            <span style="color:var(--sl-body-text);font-family:'Manrope',sans-serif;font-size:0.8625rem;line-height:1.5;"><?= !empty($activeNumber->handshape_description) ? htmlspecialchars($activeNumber->handshape_description) : 'Keep the palm facing outward at shoulder height.' ?></span>
                                        </li>
                                        <li style="display:flex;align-items:flex-start;gap:10px;">
                                            <span style="width:20px;height:20px;border-radius:50%;background:rgba(59,130,246,0.14);color:#1E3A8A;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                                                <i class="mdi mdi-check" style="font-size:12px;"></i>
                                            </span>
                                            <span style="color:var(--sl-body-text);font-family:'Manrope',sans-serif;font-size:0.8625rem;line-height:1.5;"><?= !empty($activeNumber->movement_description) ? htmlspecialchars($activeNumber->movement_description) : 'Hold for one beat before transitioning to the next number.' ?></span>
                                        </li>
                                    </ul>

                                    <a href="<?= base_url('Practice/category/2') ?>" class="sl-btn sl-btn-primary w-100 justify-content-center">
                                        <i class="mdi mdi-camera"></i> Practice Numbers
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="sl-stat-card sl-card-animated d-flex align-items-center" style="gap:16px;padding:22px;">
                                <div class="sl-stat-icon success" style="margin-bottom:0;"><i class="mdi mdi-check-decagram"></i></div>
                                <div>
                                    <p style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--sl-text-muted);margin:0 0 2px;font-weight:700;">Numbers Mastered</p>
                                    <p class="sl-stat-value" style="font-size:1.5rem;margin:0;"><?= isset($stats['mastered']) ? $stats['mastered'] : 0 ?> <span style="color:var(--sl-text-muted);font-size:0.9rem;font-weight:500;">/ <?= count($numbers) ?></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="sl-stat-card sl-card-animated d-flex align-items-center" style="gap:16px;padding:22px;">
                                <div class="sl-stat-icon primary" style="margin-bottom:0;"><i class="mdi mdi-clock-outline"></i></div>
                                <div>
                                    <p style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--sl-text-muted);margin:0 0 2px;font-weight:700;">Practice Time</p>
                                    <p class="sl-stat-value" style="font-size:1.5rem;margin:0;"><?= isset($stats['practice_hours']) ? $stats['practice_hours'] : '0' ?> hrs</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="sl-stat-card sl-card-animated d-flex align-items-center" style="gap:16px;padding:22px;">
                                <div class="sl-stat-icon accent" style="margin-bottom:0;"><i class="mdi mdi-fire"></i></div>
                                <div>
                                    <p style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--sl-text-muted);margin:0 0 2px;font-weight:700;">Daily Streak</p>
                                    <p class="sl-stat-value" style="font-size:1.5rem;margin:0;"><?= isset($stats['streak']) ? $stats['streak'] : '0' ?> Days</p>
                                </div>
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
