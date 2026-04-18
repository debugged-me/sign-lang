<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('includes/head'); ?>

<body>
    <div id="wrapper">
        <?php $this->load->view('includes/top-nav-bar'); ?>
        <?php $this->load->view('includes/sidebar'); ?>

        <?php
        $typeMeta = [
            'alphabet' => ['label' => 'Letters',  'icon' => 'mdi-alphabetical-variant', 'from' => '#0E7490', 'to' => '#22D3EE', 'chip' => '#CFFAFE', 'chipText' => '#0E7490'],
            'number'   => ['label' => 'Numbers',  'icon' => 'mdi-numeric',              'from' => '#1E3A8A', 'to' => '#60A5FA', 'chip' => '#DBEAFE', 'chipText' => '#1E3A8A'],
            'phrase'   => ['label' => 'Phrases',  'icon' => 'mdi-hand-wave',            'from' => '#B45309', 'to' => '#FCD34D', 'chip' => '#FEF3C7', 'chipText' => '#B45309'],
            'word'     => ['label' => 'Words',    'icon' => 'mdi-comment-text-outline', 'from' => '#5B21B6', 'to' => '#A78BFA', 'chip' => '#EDE9FE', 'chipText' => '#5B21B6'],
        ];
        $activeType = isset($filters['sign_type']) ? $filters['sign_type'] : null;
        ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid" style="max-width:1400px;">

                    <!-- Page title -->
                    <div class="sl-page-header">
                        <h1 class="sl-page-title">FSL Dictionary</h1>
                        <p class="sl-page-subtitle">Explore <?= $stats['total'] ?> signs in the Filipino Sign Language library — letters, numbers, phrases, and everyday words.</p>
                    </div>

                    <!-- Stats strip: counts per type with distinct palettes -->
                    <div class="row" style="margin-bottom:22px;">
                        <?php foreach ($typeMeta as $key => $meta):
                            $count = isset($stats[$key]) ? $stats[$key] : 0;
                        ?>
                            <div class="col-md-3 col-6 mb-3">
                                <a href="<?= base_url('FSL/dictionary?type=' . $key) ?>" class="text-decoration-none">
                                    <div class="sl-card sl-card-animated d-flex align-items-center" style="gap:14px;padding:18px 20px;border-radius:var(--sl-radius-lg);<?= $activeType === $key ? 'box-shadow:0 14px 32px rgba(14,116,144,0.14);outline:2px solid '.$meta['from'].';outline-offset:-2px;' : '' ?>">
                                        <div style="width:50px;height:50px;border-radius:14px;background:linear-gradient(135deg,<?= $meta['from'] ?> 0%,<?= $meta['to'] ?> 100%);color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 6px 16px rgba(0,0,0,0.08);">
                                            <i class="mdi <?= $meta['icon'] ?>" style="font-size:1.35rem;"></i>
                                        </div>
                                        <div style="min-width:0;">
                                            <p style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.5rem;color:var(--sl-text);margin:0;line-height:1;letter-spacing:-0.02em;"><?= $count ?></p>
                                            <p style="color:var(--sl-text-muted);font-size:0.75rem;margin:4px 0 0;text-transform:uppercase;letter-spacing:0.12em;font-weight:700;"><?= $meta['label'] ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Featured Sign of the Day -->
                    <?php
                    $featured = !empty($signs) ? $signs[0] : null;
                    if ($featured):
                        $fMeta = isset($typeMeta[$featured->sign_type]) ? $typeMeta[$featured->sign_type] : $typeMeta['alphabet'];
                    ?>
                        <div class="sl-hero mb-4" style="padding:36px;background:linear-gradient(135deg,<?= $fMeta['from'] ?> 0%,<?= $fMeta['to'] ?> 100%);">
                            <div class="row align-items-center" style="position:relative;z-index:2;">
                                <div class="col-lg-7 mb-3 mb-lg-0">
                                    <span class="sl-badge" style="background:rgba(255,255,255,0.22);color:#fff;margin-bottom:12px;">
                                        <i class="mdi mdi-star mr-1"></i> Featured sign of the day
                                    </span>
                                    <h2 style="color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(1.75rem,3vw,2.75rem);letter-spacing:-0.025em;margin:10px 0 14px;"><?= htmlspecialchars($featured->sign_name) ?></h2>
                                    <p style="color:rgba(255,255,255,0.92);font-family:'Manrope',sans-serif;font-size:1rem;line-height:1.6;max-width:480px;margin-bottom:22px;">
                                        <?= !empty($featured->description) ? htmlspecialchars(mb_substr($featured->description, 0, 150)) . (mb_strlen($featured->description) > 150 ? '…' : '') : 'A core sign in daily FSL communication. Learn the handshape, movement, and context — then take it into practice.' ?>
                                    </p>
                                    <div class="d-flex flex-wrap" style="gap:10px;">
                                        <a href="<?= base_url('FSL/sign_detail/' . $featured->sign_id) ?>" class="sl-btn" style="background:#fff;color:<?= $fMeta['from'] ?>;font-weight:700;">
                                            <i class="mdi mdi-play-circle"></i> Watch Tutorial
                                        </a>
                                        <a href="<?= base_url('Practice/free_practice') ?>" class="sl-btn" style="background:rgba(255,255,255,0.14);color:#fff;">
                                            <i class="mdi mdi-camera"></i> Practice This Sign
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-5 text-center">
                                    <div style="background:rgba(15,23,42,0.35);border-radius:var(--sl-radius-lg);padding:32px;display:inline-flex;align-items:center;justify-content:center;min-height:220px;width:100%;box-shadow:0 20px 40px rgba(0,0,0,0.18);backdrop-filter:blur(6px);">
                                        <?php if ($featured->image_path && file_exists(FCPATH . $featured->image_path)): ?>
                                            <img src="<?= base_url($featured->image_path) ?>" alt="<?= htmlspecialchars($featured->sign_name) ?>" style="max-height:220px;max-width:100%;object-fit:contain;filter:drop-shadow(0 8px 22px rgba(0,0,0,0.25));">
                                        <?php else: ?>
                                            <span style="color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:5.5rem;letter-spacing:-0.04em;text-shadow:0 8px 22px rgba(0,0,0,0.3);"><?= htmlspecialchars(mb_substr($featured->sign_name, 0, 4)) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div style="position:absolute;right:-40px;bottom:-40px;width:260px;height:260px;background:rgba(255,255,255,0.12);border-radius:50%;filter:blur(60px);"></div>
                        </div>
                    <?php endif; ?>

                    <!-- Filter row (pill-shaped) + Search -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4" style="gap:16px;">
                        <div class="d-flex flex-wrap align-items-center" style="gap:10px;">
                            <div class="sl-filter-group">
                                <a href="<?= base_url('FSL/dictionary') ?>"
                                    class="sl-filter-btn <?= empty($filters['sign_type']) && empty($filters['category_id']) ? 'active' : '' ?>">All Signs</a>
                                <?php foreach ($typeMeta as $key => $meta): ?>
                                    <a href="<?= base_url('FSL/dictionary?type=' . $key) ?>"
                                        class="sl-filter-btn <?= $activeType == $key ? 'active' : '' ?>"><?= $meta['label'] ?></a>
                                <?php endforeach; ?>
                            </div>
                            <form action="<?= base_url('FSL/dictionary') ?>" method="get" class="d-flex align-items-center" style="gap:6px;">
                                <?php if ($activeType): ?><input type="hidden" name="type" value="<?= htmlspecialchars($activeType) ?>"><?php endif; ?>
                                <div style="position:relative;">
                                    <i class="mdi mdi-magnify" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--sl-text-muted);"></i>
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Search a sign..."
                                        value="<?= isset($filters['search']) ? htmlspecialchars($filters['search']) : '' ?>"
                                        style="padding-left:40px;border-radius:var(--sl-radius-full);background:var(--sl-surface);min-width:240px;">
                                </div>
                            </form>
                        </div>

                        <?php if (!empty($categories)): ?>
                            <div class="dropdown">
                                <button class="sl-btn sl-btn-outline dropdown-toggle" type="button" data-toggle="dropdown" style="font-size:0.8125rem;">
                                    <i class="mdi mdi-shape-outline mr-1"></i> Browse by Category
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <?php foreach ($categories as $cat): ?>
                                        <a class="dropdown-item" href="<?= base_url('FSL/dictionary?category=' . $cat->category_id) ?>">
                                            <i class="mdi mdi-folder-outline mr-2" style="color:var(--sl-primary);"></i>
                                            <?= htmlspecialchars($cat->category_name) ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Signs Grid (per-type gradients) -->
                    <div class="row">
                        <?php foreach ($signs as $i => $sign):
                            $m = isset($typeMeta[$sign->sign_type]) ? $typeMeta[$sign->sign_type] : $typeMeta['alphabet'];
                        ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                                <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="text-decoration-none">
                                    <div class="sl-card sl-card-animated" style="padding:0;overflow:hidden;border-radius:var(--sl-radius-lg);">
                                        <div style="position:relative;aspect-ratio:1/1;background:linear-gradient(135deg,<?= $m['from'] ?> 0%,<?= $m['to'] ?> 100%);display:flex;align-items:center;justify-content:center;overflow:hidden;">
                                            <?php if ($sign->image_path && file_exists(FCPATH . $sign->image_path)): ?>
                                                <img src="<?= base_url($sign->image_path) ?>" alt="<?= htmlspecialchars($sign->sign_name) ?>" style="max-width:80%;max-height:80%;object-fit:contain;filter:drop-shadow(0 6px 18px rgba(0,0,0,0.2));transition:transform 0.5s;">
                                            <?php else: ?>
                                                <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(2.5rem,4vw,4rem);color:#fff;letter-spacing:-0.04em;text-shadow:0 6px 18px rgba(0,0,0,0.22);"><?= htmlspecialchars(mb_substr($sign->sign_name, 0, 3)) ?></span>
                                            <?php endif; ?>
                                            <span class="sl-badge" style="position:absolute;top:12px;right:12px;background:rgba(15,23,42,0.78);color:#fff;">
                                                <i class="mdi <?= $m['icon'] ?> mr-1"></i><?= ucfirst($sign->sign_type) ?>
                                            </span>
                                            <?php if (isset($sign->difficulty_level)): ?>
                                                <span class="sl-badge" style="position:absolute;bottom:12px;left:12px;background:rgba(255,255,255,0.22);color:#fff;backdrop-filter:blur(8px);"><?= ucfirst($sign->difficulty_level) ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div style="padding:16px 18px;">
                                            <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.0625rem;color:var(--sl-text);margin-bottom:4px;"><?= htmlspecialchars($sign->sign_name) ?></h5>
                                            <p style="color:var(--sl-text-muted);font-size:0.75rem;margin:0 0 10px;text-transform:uppercase;letter-spacing:0.08em;font-weight:600;"><?= $sign->category_name ? htmlspecialchars($sign->category_name) : ucfirst($sign->sign_type) ?></p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span style="color:<?= $m['from'] ?>;font-weight:700;font-size:0.8125rem;">Quick View →</span>
                                                <span style="width:28px;height:28px;border-radius:50%;background:<?= $m['chip'] ?>;color:<?= $m['chipText'] ?>;display:inline-flex;align-items:center;justify-content:center;">
                                                    <i class="mdi mdi-bookmark-outline" style="font-size:0.875rem;"></i>
                                                </span>
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
