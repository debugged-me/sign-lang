<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('includes/head'); ?>

<body>
    <div id="wrapper">
        <?php $this->load->view('includes/top-nav-bar'); ?>
        <?php $this->load->view('includes/sidebar'); ?>

        <?php
        // Active letter: first by default, or via query string
        $activeLetter = null;
        $activeId = $this->input->get('active');
        if (!empty($letters)) {
            if ($activeId) {
                foreach ($letters as $l) {
                    if ($l->sign_id == $activeId) { $activeLetter = $l; break; }
                }
            }
            if (!$activeLetter) { $activeLetter = $letters[0]; }
        }

        // Group letters by handshape family for color variety
        $handshapeGroups = [
            'A' => ['from' => '#0E7490', 'to' => '#22D3EE'], 'B' => ['from' => '#155E75', 'to' => '#0891B2'], 'C' => ['from' => '#0891B2', 'to' => '#67E8F9'],
            'D' => ['from' => '#1E3A8A', 'to' => '#3B82F6'], 'E' => ['from' => '#3730A3', 'to' => '#818CF8'], 'F' => ['from' => '#5B21B6', 'to' => '#A78BFA'],
            'G' => ['from' => '#0E7490', 'to' => '#22D3EE'], 'H' => ['from' => '#155E75', 'to' => '#0891B2'], 'I' => ['from' => '#0891B2', 'to' => '#67E8F9'],
            'J' => ['from' => '#1E3A8A', 'to' => '#3B82F6'], 'K' => ['from' => '#3730A3', 'to' => '#818CF8'], 'L' => ['from' => '#5B21B6', 'to' => '#A78BFA'],
            'M' => ['from' => '#0E7490', 'to' => '#22D3EE'], 'N' => ['from' => '#155E75', 'to' => '#0891B2'], 'O' => ['from' => '#0891B2', 'to' => '#67E8F9'],
            'P' => ['from' => '#1E3A8A', 'to' => '#3B82F6'], 'Q' => ['from' => '#3730A3', 'to' => '#818CF8'], 'R' => ['from' => '#5B21B6', 'to' => '#A78BFA'],
            'S' => ['from' => '#0E7490', 'to' => '#22D3EE'], 'T' => ['from' => '#155E75', 'to' => '#0891B2'], 'U' => ['from' => '#0891B2', 'to' => '#67E8F9'],
            'V' => ['from' => '#1E3A8A', 'to' => '#3B82F6'], 'W' => ['from' => '#3730A3', 'to' => '#818CF8'], 'X' => ['from' => '#5B21B6', 'to' => '#A78BFA'],
            'Y' => ['from' => '#0E7490', 'to' => '#22D3EE'], 'Z' => ['from' => '#155E75', 'to' => '#0891B2'],
        ];
        $gradFor = function($name) use ($handshapeGroups) {
            $key = strtoupper(mb_substr($name, 0, 1));
            return isset($handshapeGroups[$key]) ? $handshapeGroups[$key] : ['from' => '#0E7490', 'to' => '#22D3EE'];
        };
        ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid" style="max-width:1400px;">

                    <!-- Page header + toggle -->
                    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4" style="gap:16px;">
                        <div class="sl-page-header mb-0">
                            <h1 class="sl-page-title">FSL Alphabet</h1>
                            <p class="sl-page-subtitle" style="max-width:640px;">Master the <?= count($letters) ?> handshapes that form the foundation of Filipino Sign Language fingerspelling.</p>
                        </div>
                        <div class="sl-filter-group">
                            <a href="<?= base_url('FSL/alphabet') ?>" class="sl-filter-btn active"><i class="mdi mdi-alphabetical-variant mr-1"></i> Alphabet</a>
                            <a href="<?= base_url('FSL/numbers') ?>" class="sl-filter-btn"><i class="mdi mdi-numeric mr-1"></i> Numbers</a>
                        </div>
                    </div>

                    <!-- Intro hero: explains the system -->
                    <div class="sl-hero mb-4" style="padding:32px;min-height:180px;">
                        <div class="row align-items-center" style="position:relative;z-index:2;">
                            <div class="col-md-8">
                                <span class="sl-badge" style="background:rgba(255,255,255,0.22);color:#fff;margin-bottom:10px;">
                                    <i class="mdi mdi-hand-back-right-outline mr-1"></i> Fingerspelling
                                </span>
                                <h2 style="color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(1.5rem,2.5vw,2rem);margin:6px 0 10px;letter-spacing:-0.02em;">
                                    Your hand is the pen. Your palm is the page.
                                </h2>
                                <p style="color:rgba(255,255,255,0.9);font-family:'Manrope',sans-serif;font-size:0.9375rem;line-height:1.6;max-width:520px;margin:0;">
                                    Most letters use the dominant hand at shoulder height. Keep movements crisp and consistent — muscle memory comes from deliberate repetition.
                                </p>
                            </div>
                            <div class="col-md-4 d-none d-md-flex justify-content-end">
                                <div style="display:flex;gap:10px;">
                                    <span style="width:60px;height:78px;border-radius:16px;background:rgba(255,255,255,0.22);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2.25rem;letter-spacing:-0.04em;transform:rotate(-8deg);">A</span>
                                    <span style="width:60px;height:78px;border-radius:16px;background:rgba(255,255,255,0.35);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2.25rem;letter-spacing:-0.04em;">B</span>
                                    <span style="width:60px;height:78px;border-radius:16px;background:rgba(255,255,255,0.22);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2.25rem;letter-spacing:-0.04em;transform:rotate(8deg);">C</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Letter grid + quick reference -->
                        <div class="col-lg-8 mb-4">
                            <div class="sl-card" style="padding:28px;border-radius:var(--sl-radius-xl);">
                                <div class="d-flex justify-content-between align-items-center mb-3" style="gap:8px;flex-wrap:wrap;">
                                    <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.125rem;color:var(--sl-text);margin:0;">A → Z</h4>
                                    <span style="color:var(--sl-text-muted);font-size:0.8125rem;">Tap any letter to preview the handshape</span>
                                </div>

                                <div class="row">
                                    <?php if (!empty($letters)): ?>
                                        <?php foreach ($letters as $i => $letter):
                                            $isActive = $activeLetter && $letter->sign_id == $activeLetter->sign_id;
                                            $g = $gradFor($letter->sign_name);
                                        ?>
                                            <div class="col-md-2 col-sm-3 col-3 mb-3">
                                                <a href="<?= base_url('FSL/alphabet?active=' . $letter->sign_id) ?>" class="text-decoration-none">
                                                    <div style="aspect-ratio:1/1;background:<?= $isActive ? 'linear-gradient(135deg,'.$g['from'].' 0%,'.$g['to'].' 100%)' : 'linear-gradient(135deg,#F0FDFA 0%,#CFFAFE 100%)' ?>;border-radius:var(--sl-radius);display:flex;align-items:center;justify-content:center;box-shadow:<?= $isActive ? '0 12px 28px rgba(14,116,144,0.28)' : 'var(--sl-shadow)' ?>;transition:all 0.3s;position:relative;overflow:hidden;">
                                                        <?php if ($letter->image_path && file_exists(FCPATH . $letter->image_path)): ?>
                                                            <img src="<?= base_url($letter->image_path) ?>" alt="<?= htmlspecialchars($letter->sign_name) ?>" style="max-width:75%;max-height:75%;object-fit:contain;<?= $isActive ? 'filter:drop-shadow(0 4px 10px rgba(0,0,0,0.25));' : '' ?>">
                                                        <?php else: ?>
                                                            <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(1.75rem,3vw,2.5rem);color:<?= $isActive ? '#fff' : $g['from'] ?>;letter-spacing:-0.04em;<?= $isActive ? 'text-shadow:0 4px 12px rgba(0,0,0,0.22);' : '' ?>"><?= htmlspecialchars($letter->sign_name) ?></span>
                                                        <?php endif; ?>
                                                        <?php if ($isActive): ?>
                                                            <span style="position:absolute;top:8px;right:8px;width:10px;height:10px;border-radius:50%;background:#fff;box-shadow:0 0 0 3px rgba(255,255,255,0.35);"></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <?php foreach (range('A', 'Z') as $ltr):
                                            $g = $gradFor($ltr);
                                        ?>
                                            <div class="col-md-2 col-sm-3 col-3 mb-3">
                                                <div style="aspect-ratio:1/1;background:linear-gradient(135deg,#F0FDFA 0%,#CFFAFE 100%);border-radius:var(--sl-radius);display:flex;align-items:center;justify-content:center;box-shadow:var(--sl-shadow);">
                                                    <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(1.75rem,3vw,2.5rem);color:<?= $g['from'] ?>;letter-spacing:-0.04em;"><?= $ltr ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>

                                <!-- Learning tip strips -->
                                <div class="row mt-3">
                                    <div class="col-md-4 mb-2">
                                        <div style="background:linear-gradient(135deg,#ECFEFF 0%,#CFFAFE 100%);border-radius:var(--sl-radius);padding:14px 16px;display:flex;align-items:center;gap:12px;">
                                            <span style="width:36px;height:36px;border-radius:50%;background:#fff;color:var(--sl-primary);display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="mdi mdi-hand-back-right-outline"></i></span>
                                            <div style="min-width:0;">
                                                <p style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.8125rem;color:var(--sl-primary-dark);margin:0;">Dominant Hand</p>
                                                <p style="color:var(--sl-text-muted);font-size:0.75rem;margin:0;line-height:1.3;">Right or left — pick one and stay consistent.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div style="background:linear-gradient(135deg,#DBEAFE 0%,#BFDBFE 100%);border-radius:var(--sl-radius);padding:14px 16px;display:flex;align-items:center;gap:12px;">
                                            <span style="width:36px;height:36px;border-radius:50%;background:#fff;color:#1E3A8A;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="mdi mdi-target"></i></span>
                                            <div style="min-width:0;">
                                                <p style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.8125rem;color:#1E3A8A;margin:0;">Shoulder Height</p>
                                                <p style="color:var(--sl-text-muted);font-size:0.75rem;margin:0;line-height:1.3;">Sign in a clear, visible zone.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div style="background:linear-gradient(135deg,#FEF3C7 0%,#FDE68A 100%);border-radius:var(--sl-radius);padding:14px 16px;display:flex;align-items:center;gap:12px;">
                                            <span style="width:36px;height:36px;border-radius:50%;background:#fff;color:#B45309;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="mdi mdi-eye-outline"></i></span>
                                            <div style="min-width:0;">
                                                <p style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.8125rem;color:#B45309;margin:0;">Eye Contact</p>
                                                <p style="color:var(--sl-text-muted);font-size:0.75rem;margin:0;line-height:1.3;">Look at the viewer, not your hand.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active Sign sidebar -->
                        <div class="col-lg-4 mb-4">
                            <?php if ($activeLetter):
                                $g = $gradFor($activeLetter->sign_name);
                            ?>
                                <div class="sl-card" style="padding:24px;border-radius:var(--sl-radius-xl);position:sticky;top:90px;">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <span class="sl-badge" style="background:rgba(14,116,144,0.12);color:var(--sl-primary-dark);"><i class="mdi mdi-star mr-1"></i> Active Sign</span>
                                            <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2rem;color:var(--sl-text);margin:10px 0 0;letter-spacing:-0.02em;">Letter <?= htmlspecialchars($activeLetter->sign_name) ?></h3>
                                        </div>
                                        <a href="<?= base_url('FSL/sign_detail/' . $activeLetter->sign_id) ?>" title="Open detail" style="width:40px;height:40px;border-radius:50%;background:var(--sl-surface-low);color:var(--sl-primary);display:flex;align-items:center;justify-content:center;text-decoration:none;">
                                            <i class="mdi mdi-open-in-new"></i>
                                        </a>
                                    </div>

                                    <div style="position:relative;background:linear-gradient(135deg,<?= $g['from'] ?> 0%,<?= $g['to'] ?> 100%);border-radius:var(--sl-radius-lg);aspect-ratio:1/1;display:flex;align-items:center;justify-content:center;overflow:hidden;margin-bottom:18px;box-shadow:0 14px 30px rgba(14,116,144,0.25);">
                                        <?php if ($activeLetter->image_path && file_exists(FCPATH . $activeLetter->image_path)): ?>
                                            <img src="<?= base_url($activeLetter->image_path) ?>" alt="<?= htmlspecialchars($activeLetter->sign_name) ?>" style="max-width:80%;max-height:80%;object-fit:contain;filter:drop-shadow(0 10px 24px rgba(0,0,0,0.3));">
                                        <?php else: ?>
                                            <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:7rem;color:#fff;letter-spacing:-0.04em;text-shadow:0 8px 26px rgba(0,0,0,0.32);"><?= htmlspecialchars($activeLetter->sign_name) ?></span>
                                        <?php endif; ?>
                                        <span class="sl-badge" style="position:absolute;bottom:14px;left:14px;background:rgba(15,23,42,0.78);color:#fff;">
                                            <i class="mdi mdi-record-circle mr-1" style="color:#EF4444;"></i> Live Demo
                                        </span>
                                        <span style="position:absolute;top:14px;right:14px;width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.28);backdrop-filter:blur(8px);color:#fff;display:flex;align-items:center;justify-content:center;">
                                            <i class="mdi mdi-volume-high"></i>
                                        </span>
                                    </div>

                                    <?php if (!empty($activeLetter->description)): ?>
                                        <p style="color:var(--sl-body-text);font-family:'Manrope',sans-serif;font-size:0.875rem;line-height:1.6;margin:0 0 14px;"><?= htmlspecialchars($activeLetter->description) ?></p>
                                    <?php endif; ?>

                                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9375rem;color:var(--sl-text);margin:0 0 10px;">
                                        <span style="color:var(--sl-accent);">●</span> Positioning Tips
                                    </h5>
                                    <ul style="list-style:none;padding:0;margin:0 0 18px;">
                                        <li style="display:flex;align-items:flex-start;gap:10px;margin-bottom:8px;">
                                            <span style="width:20px;height:20px;border-radius:50%;background:rgba(14,116,144,0.12);color:var(--sl-primary);display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                                                <i class="mdi mdi-check" style="font-size:12px;"></i>
                                            </span>
                                            <span style="color:var(--sl-body-text);font-family:'Manrope',sans-serif;font-size:0.8625rem;line-height:1.5;"><?= !empty($activeLetter->handshape_description) ? htmlspecialchars($activeLetter->handshape_description) : 'Keep fingers aligned and the palm facing outward.' ?></span>
                                        </li>
                                        <li style="display:flex;align-items:flex-start;gap:10px;">
                                            <span style="width:20px;height:20px;border-radius:50%;background:rgba(14,116,144,0.12);color:var(--sl-primary);display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                                                <i class="mdi mdi-check" style="font-size:12px;"></i>
                                            </span>
                                            <span style="color:var(--sl-body-text);font-family:'Manrope',sans-serif;font-size:0.8625rem;line-height:1.5;"><?= !empty($activeLetter->movement_description) ? htmlspecialchars($activeLetter->movement_description) : 'Hold for a beat before moving on — clarity beats speed.' ?></span>
                                        </li>
                                    </ul>

                                    <a href="<?= base_url('Practice/category/1') ?>" class="sl-btn sl-btn-primary w-100 justify-content-center">
                                        <i class="mdi mdi-camera"></i> Practice the Alphabet
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Bottom stat row -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="sl-stat-card sl-card-animated d-flex align-items-center" style="gap:16px;padding:22px;">
                                <div class="sl-stat-icon success" style="margin-bottom:0;"><i class="mdi mdi-check-decagram"></i></div>
                                <div>
                                    <p style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--sl-text-muted);margin:0 0 2px;font-weight:700;">Letters Mastered</p>
                                    <p class="sl-stat-value" style="font-size:1.5rem;margin:0;"><?= isset($stats['mastered']) ? $stats['mastered'] : 0 ?> <span style="color:var(--sl-text-muted);font-size:0.9rem;font-weight:500;">/ <?= count($letters) ?></span></p>
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
