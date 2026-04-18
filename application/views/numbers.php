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
                            <h1 class="sl-page-title">FSL Dictionary</h1>
                            <p class="sl-page-subtitle" style="max-width:640px;">Learn to sign numbers 0-9 in Filipino Sign Language. Perfect for counting, expressing age, sharing phone numbers, and everyday numerical communication.</p>
                        </div>
                        <div class="sl-filter-group">
                            <a href="<?= base_url('FSL/alphabet') ?>" class="sl-filter-btn">Alphabet</a>
                            <a href="<?= base_url('FSL/numbers') ?>" class="sl-filter-btn active">Numbers</a>
                        </div>
                    </div>

                    <?php $activeNumber = !empty($numbers) ? $numbers[0] : null; ?>

                    <div class="row">
                        <div class="col-lg-8 mb-4">
                            <div class="sl-card" style="padding:28px;border-radius:var(--sl-radius-xl);">
                                <div class="row justify-content-center">
                                    <?php foreach ($numbers as $i => $number):
                                        $isActive = $activeNumber && $number->sign_id == $activeNumber->sign_id;
                                    ?>
                                        <div class="col-md-3 col-sm-4 col-4 mb-3">
                                            <a href="<?= base_url('FSL/numbers?active=' . $number->sign_id) ?>" class="text-decoration-none">
                                                <div style="aspect-ratio:1/1;background:<?= $isActive ? 'linear-gradient(135deg,#ECFEFF 0%,#CFFAFE 100%)' : 'var(--sl-surface)' ?>;border-radius:var(--sl-radius);display:flex;align-items:center;justify-content:center;box-shadow:<?= $isActive ? '0 8px 24px rgba(14,116,144,0.18)' : 'var(--sl-shadow)' ?>;transition:all 0.3s;position:relative;">
                                                    <?php if ($number->image_path && file_exists(FCPATH . $number->image_path)): ?>
                                                        <img src="<?= base_url($number->image_path) ?>" alt="<?= htmlspecialchars($number->sign_name) ?>" style="max-width:70%;max-height:70%;object-fit:contain;">
                                                    <?php else: ?>
                                                        <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(2rem,4vw,3rem);color:<?= $isActive ? 'var(--sl-primary-dark)' : 'var(--sl-primary)' ?>;letter-spacing:-0.03em;"><?= htmlspecialchars($number->sign_name) ?></span>
                                                    <?php endif; ?>
                                                    <?php if ($isActive): ?>
                                                        <span style="position:absolute;top:6px;right:6px;width:8px;height:8px;border-radius:50%;background:var(--sl-accent);"></span>
                                                    <?php endif; ?>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div style="background:linear-gradient(135deg,#BFDBFE 0%,#93C5FD 100%);border-radius:var(--sl-radius-lg);padding:22px 24px;margin-top:18px;">
                                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:#1E3A8A;margin:0 0 8px;font-size:1.0625rem;">
                                        <i class="mdi mdi-lightbulb-outline mr-1"></i> Quick Reference
                                    </h5>
                                    <p style="color:#1E3A8A;font-family:'Manrope',sans-serif;font-size:0.9375rem;line-height:1.55;margin:0;">
                                        Numbers 0-5 use a single hand with extended fingers. Numbers 6-9 touch the thumb to different fingers.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-4">
                            <?php if ($activeNumber): ?>
                                <div class="sl-card" style="padding:26px;border-radius:var(--sl-radius-xl);position:sticky;top:90px;">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <span class="sl-badge" style="background:rgba(245,158,11,0.18);color:#B45309;">Active Number</span>
                                            <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:2.25rem;color:var(--sl-text);margin:10px 0 0;letter-spacing:-0.02em;"><?= htmlspecialchars($activeNumber->sign_name) ?></h3>
                                        </div>
                                        <button title="Play audio" style="width:40px;height:40px;border-radius:50%;background:var(--sl-surface-low);border:none;color:var(--sl-primary);display:flex;align-items:center;justify-content:center;">
                                            <i class="mdi mdi-volume-high"></i>
                                        </button>
                                    </div>

                                    <div style="position:relative;background:linear-gradient(135deg,#DBEAFE 0%,#93C5FD 100%);border-radius:var(--sl-radius-lg);aspect-ratio:1/1;display:flex;align-items:center;justify-content:center;overflow:hidden;margin-bottom:18px;">
                                        <?php if ($activeNumber->image_path && file_exists(FCPATH . $activeNumber->image_path)): ?>
                                            <img src="<?= base_url($activeNumber->image_path) ?>" alt="<?= htmlspecialchars($activeNumber->sign_name) ?>" style="max-width:80%;max-height:80%;object-fit:contain;">
                                        <?php else: ?>
                                            <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:7rem;color:#fff;letter-spacing:-0.04em;text-shadow:0 4px 20px rgba(30,58,138,0.3);"><?= htmlspecialchars($activeNumber->sign_name) ?></span>
                                        <?php endif; ?>
                                        <span class="sl-badge" style="position:absolute;bottom:12px;left:12px;background:rgba(15,23,42,0.78);color:#fff;">
                                            <i class="mdi mdi-record-circle mr-1" style="color:#EF4444;"></i> Live Demo
                                        </span>
                                    </div>

                                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1rem;color:var(--sl-text);margin:0 0 12px;">
                                        <span style="color:var(--sl-accent);">●</span> Positioning Tips
                                    </h5>
                                    <ul style="list-style:none;padding:0;margin:0 0 20px;">
                                        <li style="display:flex;align-items:flex-start;gap:10px;margin-bottom:10px;">
                                            <span style="width:18px;height:18px;border-radius:50%;background:rgba(14,116,144,0.12);color:var(--sl-primary);display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                                                <i class="mdi mdi-check" style="font-size:12px;"></i>
                                            </span>
                                            <span style="color:var(--sl-body-text);font-family:'Manrope',sans-serif;font-size:0.875rem;line-height:1.5;">Keep the palm facing outward at shoulder height.</span>
                                        </li>
                                        <li style="display:flex;align-items:flex-start;gap:10px;">
                                            <span style="width:18px;height:18px;border-radius:50%;background:rgba(14,116,144,0.12);color:var(--sl-primary);display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                                                <i class="mdi mdi-check" style="font-size:12px;"></i>
                                            </span>
                                            <span style="color:var(--sl-body-text);font-family:'Manrope',sans-serif;font-size:0.875rem;line-height:1.5;">Hold for one beat before transitioning to the next number.</span>
                                        </li>
                                    </ul>

                                    <a href="<?= base_url('Practice/category/2') ?>" class="sl-btn sl-btn-primary w-100 justify-content-center">
                                        <i class="mdi mdi-plus-circle"></i> Add to Practice Deck
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
                                    <p class="sl-stat-value" style="font-size:1.5rem;margin:0;"><?= isset($stats['practice_hours']) ? $stats['practice_hours'] : '2.8' ?> hrs</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="sl-stat-card sl-card-animated d-flex align-items-center" style="gap:16px;padding:22px;">
                                <div class="sl-stat-icon accent" style="margin-bottom:0;"><i class="mdi mdi-fire"></i></div>
                                <div>
                                    <p style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--sl-text-muted);margin:0 0 2px;font-weight:700;">Daily Streak</p>
                                    <p class="sl-stat-value" style="font-size:1.5rem;margin:0;"><?= isset($stats['streak']) ? $stats['streak'] : '5' ?> Days</p>
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
