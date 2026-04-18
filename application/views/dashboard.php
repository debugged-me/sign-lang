<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('includes/head'); ?>

<body>

    <style>
        .content-page .content {
            padding-bottom: 40px;
        }
    </style>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <?php $this->load->view('includes/top-nav-bar'); ?>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <?php $this->load->view('includes/sidebar'); ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Filipino Sign Language Learning Dashboard</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb p-0 m-0">
                                        <li class="breadcrumb-item"><a href="#">Welcome <?= $this->session->userdata('fname') ?>!</a></li>
                                    </ol>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Stats Cards -->
                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-style-1 bg-info">
                                <div class="card-body">
                                    <div class="my-4 text-white">
                                        <i class="mdi mdi-hand-pointing-right"></i>
                                        <h2 class="my-0 text-white"><span data-plugin="counterup"><?= $stats['total_learned'] ?></span></h2>
                                        <div>Signs Learned</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-style-1 bg-success">
                                <div class="card-body">
                                    <div class="my-4 text-white">
                                        <i class="mdi mdi-trophy"></i>
                                        <h2 class="my-0 text-white"><span data-plugin="counterup"><?= $stats['mastered'] ?></span></h2>
                                        <div>Mastered</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-style-1 bg-warning">
                                <div class="card-body">
                                    <div class="my-4 text-white">
                                        <i class="mdi mdi-play-circle"></i>
                                        <h2 class="my-0 text-white"><span data-plugin="counterup"><?= $stats['total_sessions'] ?></span></h2>
                                        <div>Practice Sessions</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card widget-style-1 bg-purple">
                                <div class="card-body">
                                    <div class="my-4 text-white">
                                        <i class="mdi mdi-chart-line"></i>
                                        <h2 class="my-0 text-white"><span data-plugin="counterup"><?= $stats['overall_accuracy'] ?></span>%</h2>
                                        <div>Accuracy</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <!-- Quick Actions -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="header-title mb-0">Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-2">
                                            <a href="<?= base_url('Practice/free_practice') ?>" class="btn btn-primary btn-block btn-lg">
                                                <i class="mdi mdi-camera"></i> Start Practice
                                            </a>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <a href="<?= base_url('Quiz') ?>" class="btn btn-success btn-block btn-lg">
                                                <i class="mdi mdi-trophy"></i> Take Quiz
                                            </a>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <a href="<?= base_url('FSL/dictionary') ?>" class="btn btn-info btn-block btn-lg">
                                                <i class="mdi mdi-book-open"></i> FSL Dictionary
                                            </a>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <a href="<?= base_url('FSL/progress') ?>" class="btn btn-warning btn-block btn-lg">
                                                <i class="mdi mdi-chart-line"></i> My Progress
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <!-- Categories & Lessons -->
                    <div class="row">
                        <!-- Categories -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="header-title mb-0">Categories</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <?php foreach ($categories as $category): ?>
                                            <a href="<?= base_url('FSL/category/' . $category->category_id) ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                <?= $category->category_name ?>
                                                <span class="badge badge-primary badge-pill">View</span>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Lessons -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="header-title mb-0">Continue Learning</h5>
                                    <div class="card-widgets">
                                        <a href="<?= base_url('FSL/lessons') ?>"><i class="mdi mdi-arrow-right"></i> View All</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($recent_lessons)): ?>
                                        <?php foreach ($recent_lessons as $lesson):
                                            $progress_pct = isset($lesson->progress) && isset($lesson->progress['progress_percentage']) ? $lesson->progress['progress_percentage'] : 0;
                                            $is_completed = isset($lesson->progress) && isset($lesson->progress['is_completed']) ? $lesson->progress['is_completed'] : false;
                                        ?>
                                            <div class="lesson-item mb-3 p-3 border rounded">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h5 class="m-0"><?= isset($lesson->lesson_title) ? $lesson->lesson_title : 'Untitled Lesson' ?></h5>
                                                        <small class="text-muted"><?= $lesson->difficulty_level ?> | <?= isset($lesson->total_signs) ? $lesson->total_signs : 0 ?> signs</small>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="progress mb-1" style="width: 150px; height: 8px;">
                                                            <div class="progress-bar" role="progressbar" style="width: <?= $progress_pct ?>%"></div>
                                                        </div>
                                                        <small><?= $progress_pct ?>% complete</small>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <?php if ($is_completed): ?>
                                                        <span class="badge badge-success">Completed</span>
                                                    <?php else: ?>
                                                        <a href="<?= base_url('Practice/lesson/' . $lesson->lesson_id) ?>" class="btn btn-sm btn-primary">Practice</a>
                                                        <a href="<?= base_url('FSL/lesson/' . $lesson->lesson_id) ?>" class="btn btn-sm btn-outline-secondary">Learn</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-muted">No lessons available. Check back soon!</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <!-- Featured Signs -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="header-title mb-0">Featured Signs</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php foreach ($featured_signs as $sign): ?>
                                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                                                <a href="<?= base_url('FSL/sign_detail/' . $sign->sign_id) ?>" class="text-decoration-none">
                                                    <div class="sign-card text-center p-3 border rounded h-100">
                                                        <?php if ($sign->image_path): ?>
                                                            <img src="<?= base_url($sign->image_path) ?>" alt="<?= $sign->sign_name ?>" class="img-fluid mb-2" style="max-height: 100px;">
                                                        <?php else: ?>
                                                            <div class="sign-placeholder bg-light d-flex align-items-center justify-content-center mb-2" style="height: 100px;">
                                                                <i class="mdi mdi-hand-pointing-right" style="font-size: 48px;"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                        <h6 class="m-0"><?= $sign->sign_name ?></h6>
                                                        <small class="text-muted"><?= ucfirst($sign->sign_type) ?></small>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div>
                <!-- end container-fluid -->

            </div>
            <!-- end content -->

            <!-- Footer Start -->
            <?php $this->load->view('includes/footer'); ?>
            <!-- end Footer -->

        </div>
        <!-- End Page content -->

    </div>
    <!-- END wrapper -->

    <!-- Vendor js -->
    <script src="<?= base_url(); ?>assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="<?= base_url(); ?>assets/js/app.min.js"></script>

    <!-- Datatable js -->
    <script src="<?= base_url(); ?>assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/datatables/dataTables.bootstrap4.min.js"></script>

</body>

</html>