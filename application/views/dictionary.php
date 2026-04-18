<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('includes/head'); ?>

<body>
    <div id="wrapper">
        <?php $this->load->view('includes/top-nav-bar'); ?>
        <?php $this->load->view('includes/sidebar'); ?>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <!-- Page Header -->
                    <div class="sl-page-header">
                        <span class="sl-section-subtitle">Browse & Learn</span>
                        <h1 class="sl-page-title">FSL Dictionary</h1>
                        <p class="sl-page-subtitle">Explore <?= $stats['total'] ?> signs in the Filipino Sign Language dictionary</p>
                    </div>

                    <!-- Stats Overview -->
                    <div class="row mb-4">
                        <div class="col-md-3 col-6 mb-3">
                            <div class="sl-card p-4 text-center sl-card-animated">
                                <div class="sl-stat-value" style="font-size: 2.5rem; color: var(--sl-primary);" data-plugin="counterup"><?= $stats['total'] ?></div>
                                <div class="sl-stat-label">Total Signs</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="sl-card p-4 text-center sl-card-animated" style="animation-delay: 0.05s;">
                                <div class="sl-stat-value" style="font-size: 2.5rem; color: var(--sl-secondary);" data-plugin="counterup"><?= $stats['alphabet'] ?></div>
                                <div class="sl-stat-label">Alphabet</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="sl-card p-4 text-center sl-card-animated" style="animation-delay: 0.1s;">
                                <div class="sl-stat-value" style="font-size: 2.5rem; color: var(--sl-accent);" data-plugin="counterup"><?= $stats['number'] ?></div>
                                <div class="sl-stat-label">Numbers</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="sl-card p-4 text-center sl-card-animated" style="animation-delay: 0.15s;">
                                <div class="sl-stat-value" style="font-size: 2.5rem; color: var(--sl-success);" data-plugin="counterup"><?= $stats['word'] + $stats['phrase'] ?></div>
                                <div class="sl-stat-label">Words & Phrases</div>
                            </div>
                        </div>
                    </div>

                    <!-- Search & Filters -->
                    <div class="sl-card mb-4">
                        <div class="p-4">
                            <div class="row align-items-center">
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <form action="<?= base_url('FSL/dictionary') ?>" method="get">
                                        <div class="input-group" style="border: 2px solid var(--sl-border); border-radius: 12px; overflow: hidden;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-0 bg-white" style="padding-left: 16px;">
                                                    <i class="mdi mdi-magnify" style="color: var(--sl-text-muted);"></i>
                                                </span>
                                            </div>
                                            <input type="text" name="search" class="form-control border-0"
                                                placeholder="Search signs..."
                                                value="<?= isset($filters['search']) ? $filters['search'] : '' ?>"
                                                style="font-weight: 500;">
                                            <div class="input-group-append">
                                                <button class="sl-btn sl-btn-primary" type="submit" style="border-radius: 0; padding: 12px 20px;">
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-8">
                                    <div class="d-flex flex-wrap align-items-center gap-2">
                                        <div class="sl-filter-group mr-3">
                                            <a href="<?= base_url('FSL/dictionary') ?>"
                                                class="sl-filter-btn <?= empty($filters['sign_type']) && empty($filters['category_id']) ? 'active' : '' ?>">All Signs</a>
                                            <a href="<?= base_url('FSL/dictionary?type=alphabet') ?>"
                                                class="sl-filter-btn <?= isset($filters['sign_type']) && $filters['sign_type'] == 'alphabet' ? 'active' : '' ?>">ABC</a>
                                            <a href="<?= base_url('FSL/dictionary?type=number') ?>"
                                                class="sl-filter-btn <?= isset($filters['sign_type']) && $filters['sign_type'] == 'number' ? 'active' : '' ?>">123</a>
                                        </div>
                                        <div class="sl-filter-group mr-3">
                                            <a href="<?= base_url('FSL/dictionary?type=word') ?>"
                                                class="sl-filter-btn <?= isset($filters['sign_type']) && $filters['sign_type'] == 'word' ? 'active' : '' ?>">Words</a>
                                            <a href="<?= base_url('FSL/dictionary?type=phrase') ?>"
                                                class="sl-filter-btn <?= isset($filters['sign_type']) && $filters['sign_type'] == 'phrase' ? 'active' : '' ?>">Phrases</a>
                                        </div>
                                        <div class="dropdown">
                                            <button class="sl-btn sl-btn-outline dropdown-toggle" type="button" data-toggle="dropdown">
                                                <i class="mdi mdi-folder-outline mr-2"></i>Categories
                                            </button>
                                            <div class="dropdown-menu" style="border-radius: 12px; border: 1px solid var(--sl-border); box-shadow: var(--sl-shadow-lg);">
                                                <?php foreach ($categories as $cat): ?>
                                                    <a class="dropdown-item py-2" href="<?= base_url('FSL/dictionary?category=' . $cat->category_id) ?>">
                                                        <?= $cat->category_name ?>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Signs Grid -->
                    <div class="row">
                        <?php foreach ($signs as $sign): ?>
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                                <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="text-decoration-none">
                                    <div class="sl-sign-card h-100">
                                        <div class="sl-sign-preview" style="height: 160px;">
                                            <?php if ($sign->image_path && file_exists(FCPATH . $sign->image_path)): ?>
                                                <img src="<?= base_url($sign->image_path) ?>" alt="<?= $sign->sign_name ?>">
                                            <?php else: ?>
                                                <i class="mdi mdi-hand-pointing-right" style="font-size: 48px; color: #CBD5E1;"></i>
                                            <?php endif; ?>
                                        </div>
                                        <div class="sl-sign-name"><?= $sign->sign_name ?></div>
                                        <span class="sl-badge" style="background: rgba(37, 99, 235, 0.1); color: var(--sl-primary);">
                                            <?= ucfirst($sign->sign_type) ?>
                                        </span>
                                        <?php if ($sign->category_name): ?>
                                            <div class="mt-2" style="font-size: 0.75rem; color: var(--sl-text-muted);">
                                                <?= $sign->category_name ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if (empty($signs)): ?>
                        <div class="sl-card">
                            <div class="sl-empty-state">
                                <i class="mdi mdi-book-open-page-variant"></i>
                                <h4 style="color: var(--sl-text);">No signs found</h4>
                                <p style="color: var(--sl-text-muted);">Try adjusting your filters or search query</p>
                                <a href="<?= base_url('FSL/dictionary') ?>" class="sl-btn sl-btn-outline mt-3">
                                    <i class="mdi mdi-refresh mr-2"></i>Clear Filters
                                </a>
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