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
                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">FSL Dictionary</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Stats & Filters -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row text-center">
                                            <div class="col-3">
                                                <h3 class="m-0"><?= $stats['total'] ?></h3>
                                                <small>Total Signs</small>
                                            </div>
                                            <div class="col-3">
                                                <h3 class="m-0"><?= $stats['alphabet'] ?></h3>
                                                <small>Alphabet</small>
                                            </div>
                                            <div class="col-3">
                                                <h3 class="m-0"><?= $stats['number'] ?></h3>
                                                <small>Numbers</small>
                                            </div>
                                            <div class="col-3">
                                                <h3 class="m-0"><?= $stats['word'] + $stats['phrase'] ?></h3>
                                                <small>Words & Phrases</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="<?= base_url('FSL/dictionary') ?>" method="get" class="form-inline justify-content-end">
                                            <div class="input-group w-100">
                                                <input type="text" name="search" class="form-control" placeholder="Search signs..." value="<?= isset($filters['search']) ? $filters['search'] : '' ?>">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('FSL/dictionary') ?>" class="btn btn-outline-primary <?= empty($filters['sign_type']) && empty($filters['category_id']) ? 'active' : '' ?>">All</a>
                                <a href="<?= base_url('FSL/dictionary?type=alphabet') ?>" class="btn btn-outline-primary <?= isset($filters['sign_type']) && $filters['sign_type'] == 'alphabet' ? 'active' : '' ?>">Alphabet</a>
                                <a href="<?= base_url('FSL/dictionary?type=number') ?>" class="btn btn-outline-primary <?= isset($filters['sign_type']) && $filters['sign_type'] == 'number' ? 'active' : '' ?>">Numbers</a>
                                <a href="<?= base_url('FSL/dictionary?type=word') ?>" class="btn btn-outline-primary <?= isset($filters['sign_type']) && $filters['sign_type'] == 'word' ? 'active' : '' ?>">Words</a>
                                <a href="<?= base_url('FSL/dictionary?type=phrase') ?>" class="btn btn-outline-primary <?= isset($filters['sign_type']) && $filters['sign_type'] == 'phrase' ? 'active' : '' ?>">Phrases</a>
                            </div>

                            <div class="btn-group ml-2" role="group">
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                                    Categories
                                </button>
                                <div class="dropdown-menu">
                                    <?php foreach ($categories as $cat): ?>
                                        <a class="dropdown-item" href="<?= base_url('FSL/dictionary?category=' . $cat->category_id) ?>"><?= $cat->category_name ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Signs Grid -->
                    <div class="row">
                        <?php foreach ($signs as $sign): ?>
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                                <div class="card sign-card h-100">
                                    <div class="card-body text-center">
                                        <?php if ($sign->image_path && file_exists(FCPATH . $sign->image_path)): ?>
                                            <img src="<?= base_url($sign->image_path) ?>" alt="<?= $sign->sign_name ?>" class="img-fluid mb-2" style="max-height: 120px;">
                                        <?php else: ?>
                                            <div class="sign-placeholder bg-light d-flex align-items-center justify-content-center mb-2 rounded" style="height: 120px;">
                                                <i class="mdi mdi-hand-pointing-right text-muted" style="font-size: 48px;"></i>
                                            </div>
                                        <?php endif; ?>
                                        <h5 class="card-title mb-1"><?= $sign->sign_name ?></h5>
                                        <span class="badge badge-info"><?= ucfirst($sign->sign_type) ?></span>
                                        <?php if ($sign->category_name): ?>
                                            <br><small class="text-muted"><?= $sign->category_name ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-footer text-center p-2">
                                        <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="btn btn-sm btn-outline-primary">View</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if (empty($signs)): ?>
                        <div class="row">
                            <div class="col-12 text-center py-5">
                                <i class="mdi mdi-book-open-variant" style="font-size: 64px; color: #ccc;"></i>
                                <h4 class="mt-3 text-muted">No signs found</h4>
                                <p class="text-muted">Try adjusting your filters or search query.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end content -->

            <?php $this->load->view('includes/footer'); ?>
        </div>
        <!-- End Page content -->
    </div>
    <!-- END wrapper -->

    <?php $this->load->view('includes/footer_plugins'); ?>
</body>

</html>