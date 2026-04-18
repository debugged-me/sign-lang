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

                    <!-- Page title -->
                    <div class="sl-page-header">
                        <h1 class="sl-page-title">Dictionary</h1>
                        <p class="sl-page-subtitle">Explore <?= $stats['total'] ?> signs in the Filipino Sign Language library</p>
                    </div>

                    <!-- Featured Sign of the Day -->
                    <?php $featured = !empty($signs) ? $signs[0] : null; ?>
                    <?php if ($featured): ?>
                        <div class="sl-hero mb-4" style="padding:36px;">
                            <div class="row align-items-center" style="position:relative;z-index:2;">
                                <div class="col-lg-7 mb-3 mb-lg-0">
                                    <span class="sl-badge" style="background:rgba(255,255,255,0.22);color:#fff;margin-bottom:12px;">⭐ Featured sign of the day</span>
                                    <h2 style="color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(1.75rem,3vw,2.75rem);letter-spacing:-0.025em;margin:10px 0 14px;"><?= htmlspecialchars($featured->sign_name) ?></h2>
                                    <p style="color:rgba(255,255,255,0.88);font-family:'Manrope',sans-serif;font-size:1rem;line-height:1.6;max-width:480px;margin-bottom:22px;">
                                        A core sign in daily FSL communication. Learn the handshape, movement, and context — then take it into practice.
                                    </p>
                                    <div class="d-flex flex-wrap" style="gap:10px;">
                                        <a href="<?= base_url('FSL/sign_detail/' . $featured->sign_id) ?>" class="sl-btn" style="background:#fff;color:var(--sl-primary-dark);font-weight:700;">
                                            <i class="mdi mdi-play-circle"></i> Watch Tutorial
                                        </a>
                                        <a href="<?= base_url('Practice/free_practice') ?>" class="sl-btn" style="background:rgba(255,255,255,0.14);color:#fff;">
                                            <i class="mdi mdi-bookmark-outline"></i> Save to Practice
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-5 text-center">
                                    <div style="background:rgba(15,23,42,0.45);border-radius:var(--sl-radius-lg);padding:32px;display:inline-flex;align-items:center;justify-content:center;min-height:200px;width:100%;box-shadow:0 20px 40px rgba(0,0,0,0.18);">
                                        <?php if ($featured->image_path && file_exists(FCPATH . $featured->image_path)): ?>
                                            <img src="<?= base_url($featured->image_path) ?>" alt="<?= htmlspecialchars($featured->sign_name) ?>" style="max-height:220px;max-width:100%;object-fit:contain;">
                                        <?php else: ?>
                                            <span style="color:var(--sl-accent);font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:5rem;letter-spacing:-0.04em;"><?= htmlspecialchars(mb_substr($featured->sign_name, 0, 6)) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Filter row (pill-shaped) + Sort -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4" style="gap:16px;">
                        <div class="d-flex flex-wrap align-items-center" style="gap:10px;">
                            <div class="sl-filter-group">
                                <a href="<?= base_url('FSL/dictionary') ?>"
                                    class="sl-filter-btn <?= empty($filters['sign_type']) && empty($filters['category_id']) ? 'active' : '' ?>">All Signs</a>
                                <a href="<?= base_url('FSL/dictionary?type=alphabet') ?>"
                                    class="sl-filter-btn <?= isset($filters['sign_type']) && $filters['sign_type'] == 'alphabet' ? 'active' : '' ?>">Alphabet</a>
                                <a href="<?= base_url('FSL/dictionary?type=number') ?>"
                                    class="sl-filter-btn <?= isset($filters['sign_type']) && $filters['sign_type'] == 'number' ? 'active' : '' ?>">Numbers</a>
                                <a href="<?= base_url('FSL/dictionary?type=phrase') ?>"
                                    class="sl-filter-btn <?= isset($filters['sign_type']) && $filters['sign_type'] == 'phrase' ? 'active' : '' ?>">Phrases</a>
                                <a href="<?= base_url('FSL/dictionary?type=word') ?>"
                                    class="sl-filter-btn <?= isset($filters['sign_type']) && $filters['sign_type'] == 'word' ? 'active' : '' ?>">Words</a>
                            </div>
                            <form action="<?= base_url('FSL/dictionary') ?>" method="get" class="d-flex align-items-center" style="gap:6px;">
                                <div style="position:relative;">
                                    <i class="mdi mdi-magnify" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--sl-text-muted);"></i>
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Search a sign..."
                                        value="<?= isset($filters['search']) ? htmlspecialchars($filters['search']) : '' ?>"
                                        style="padding-left:40px;border-radius:var(--sl-radius-full);background:var(--sl-surface);min-width:240px;">
                                </div>
                            </form>
                        </div>

                        <div class="dropdown">
                            <button class="sl-btn sl-btn-outline dropdown-toggle" type="button" data-toggle="dropdown" style="font-size:0.8125rem;">
                                <i class="mdi mdi-sort-alphabetical-ascending mr-1"></i> Sort by: A-Z Alphabetical
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <?php foreach ($categories as $cat): ?>
                                    <a class="dropdown-item" href="<?= base_url('FSL/dictionary?category=' . $cat->category_id) ?>">
                                        <?= htmlspecialchars($cat->category_name) ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Signs Grid (editorial) -->
                    <div class="row">
                        <?php foreach ($signs as $i => $sign):
                            // status chip: just rotate based on sign_type for visual variety
                            $chipBg = '#10B981'; $chipTxt = 'Beginner';
                            if ($sign->sign_type === 'phrase' || $sign->sign_type === 'word') { $chipBg = '#22D3EE'; $chipTxt = 'Mastered'; }
                            elseif ($sign->sign_type === 'number') { $chipBg = '#F59E0B'; $chipTxt = 'Number'; }
                            elseif ($sign->sign_type === 'alphabet') { $chipBg = '#10B981'; $chipTxt = 'Letter'; }
                        ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                                <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="text-decoration-none">
                                    <div class="sl-card sl-card-animated" style="padding:0;overflow:hidden;border-radius:var(--sl-radius-lg);">
                                        <div style="position:relative;aspect-ratio:1/1;background:linear-gradient(135deg,var(--sl-surface-low) 0%,#ECFEFF 100%);display:flex;align-items:center;justify-content:center;overflow:hidden;">
                                            <?php if ($sign->image_path && file_exists(FCPATH . $sign->image_path)): ?>
                                                <img src="<?= base_url($sign->image_path) ?>" alt="<?= htmlspecialchars($sign->sign_name) ?>" style="width:100%;height:100%;object-fit:cover;transition:transform 0.5s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                                            <?php else: ?>
                                                <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(2.5rem,4vw,4rem);color:var(--sl-primary);letter-spacing:-0.03em;"><?= htmlspecialchars(mb_substr($sign->sign_name, 0, 4)) ?></span>
                                            <?php endif; ?>
                                            <div style="position:absolute;top:12px;right:12px;">
                                                <span class="sl-badge" style="background:<?= $chipBg ?>;color:#fff;"><?= $chipTxt ?></span>
                                            </div>
                                        </div>
                                        <div style="padding:16px 18px;">
                                            <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.0625rem;color:var(--sl-text);margin-bottom:2px;"><?= htmlspecialchars($sign->sign_name) ?></h5>
                                            <p style="color:var(--sl-text-muted);font-size:0.75rem;margin:0 0 8px;"><?= $sign->category_name ? htmlspecialchars($sign->category_name) : ucfirst($sign->sign_type) ?></p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span style="color:var(--sl-primary);font-weight:700;font-size:0.8125rem;">Quick View →</span>
                                                <i class="mdi mdi-heart-outline" style="color:var(--sl-text-muted);"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if (empty($signs)): ?>
                        <div class="sl-card">
                            <div class="sl-empty-state">
                                <i class="mdi mdi-book-open-page-variant"></i>
                                <h4 style="color:var(--sl-text);">No signs found</h4>
                                <p style="color:var(--sl-text-muted);">Try adjusting your filters or search query</p>
                                <a href="<?= base_url('FSL/dictionary') ?>" class="sl-btn sl-btn-outline mt-3">
                                    <i class="mdi mdi-refresh mr-2"></i>Clear Filters
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center mt-4 mb-2">
                            <button class="sl-btn sl-btn-primary" onclick="return false;">
                                <i class="mdi mdi-reload"></i> Load More Signs
                            </button>
                            <p class="mt-3" style="color:var(--sl-text-muted);font-size:0.8125rem;">Showing <?= count($signs) ?> of <?= $stats['total'] ?> active signs</p>
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
