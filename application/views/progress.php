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
                                <h4 class="page-title">My Learning Progress</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Row -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card-box widget-box-two widget-two-custom">
                                <div class="wigdet-two-content">
                                    <p class="m-0 text-uppercase font-bold font-secondary text-overflow">Signs Learned</p>
                                    <h2 class="font-600"><span data-plugin="counterup"><?= $stats['total_learned'] ?></span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-box widget-box-two widget-two-custom">
                                <div class="wigdet-two-content">
                                    <p class="m-0 text-uppercase font-bold font-secondary text-overflow">Mastered</p>
                                    <h2 class="font-600"><span data-plugin="counterup"><?= $stats['mastered'] ?></span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-box widget-box-two widget-two-custom">
                                <div class="wigdet-two-content">
                                    <p class="m-0 text-uppercase font-bold font-secondary text-overflow">In Progress</p>
                                    <h2 class="font-600"><span data-plugin="counterup"><?= $stats['learning'] ?></span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-box widget-box-two widget-two-custom">
                                <div class="wigdet-two-content">
                                    <p class="m-0 text-uppercase font-bold font-secondary text-overflow">Accuracy</p>
                                    <h2 class="font-600"><span data-plugin="counterup"><?= $stats['overall_accuracy'] ?></span>%</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Achievements -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3"><i class="mdi mdi-trophy"></i> Achievements</h4>
                                <?php if (!empty($achievements)): ?>
                                    <div class="row">
                                        <?php foreach ($achievements as $achievement): ?>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="achievement-card p-3 border rounded text-center">
                                                    <i class="mdi mdi-medal text-warning" style="font-size: 48px;"></i>
                                                    <h5 class="mt-2 mb-1"><?= $achievement->achievement_title ?></h5>
                                                    <small class="text-muted"><?= date('M d, Y', strtotime($achievement->earned_at)) ?></small>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted">No achievements yet. Keep practicing to earn badges!</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Sign Progress -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Sign Progress</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="progressTable">
                                        <thead>
                                            <tr>
                                                <th>Sign</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Practice Count</th>
                                                <th>Accuracy</th>
                                                <th>Last Practice</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($all_progress as $progress): ?>
                                                <tr>
                                                    <td>
                                                        <?php if ($progress->image_path): ?>
                                                            <img src="<?= base_url($progress->image_path) ?>" alt="<?= $progress->sign_name ?>" style="height: 40px;" class="mr-2">
                                                        <?php endif; ?>
                                                        <?= $progress->sign_name ?>
                                                    </td>
                                                    <td><?= $progress->category_name ?></td>
                                                    <td>
                                                        <span class="badge badge-<?= $progress->status == 'mastered' ? 'success' : ($progress->status == 'practiced' ? 'info' : 'secondary') ?>">
                                                            <?= ucfirst($progress->status) ?>
                                                        </span>
                                                    </td>
                                                    <td><?= $progress->practice_count ?></td>
                                                    <td>
                                                        <div class="progress" style="width: 100px; height: 8px;">
                                                            <div class="progress-bar" style="width: <?= $progress->average_score ?>%"></div>
                                                        </div>
                                                        <small><?= round($progress->average_score, 1) ?>%</small>
                                                    </td>
                                                    <td><?= $progress->last_practice ? date('M d, Y H:i', strtotime($progress->last_practice)) : 'Never' ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Difficult Signs -->
                    <?php if (!empty($stats['difficult_signs'])): ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title mb-3"><i class="mdi mdi-alert"></i> Signs to Practice More</h4>
                                    <p class="text-muted">These signs have lower accuracy. Consider practicing them more.</p>
                                    <div class="row">
                                        <?php foreach ($stats['difficult_signs'] as $sign): ?>
                                            <div class="col-md-2 col-sm-4 col-6 mb-3">
                                                <div class="sign-card text-center p-3 border rounded">
                                                    <?php if ($sign->image_path): ?>
                                                        <img src="<?= base_url($sign->image_path) ?>" alt="<?= $sign->sign_name ?>" class="img-fluid mb-2" style="max-height: 80px;">
                                                    <?php else: ?>
                                                        <div class="sign-placeholder bg-light d-flex align-items-center justify-content-center mb-2" style="height: 80px;">
                                                            <i class="mdi mdi-hand-pointing-right text-muted" style="font-size: 32px;"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <h6 class="m-0"><?= $sign->sign_name ?></h6>
                                                    <small class="text-danger"><?= round($sign->average_score, 1) ?>% accuracy</small>
                                                    <br>
                                                    <a href="<?= base_url('Practice/category/' . $sign->category_id) ?>" class="btn btn-sm btn-outline-primary mt-2">Practice</a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
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
    <script>
        $(document).ready(function() {
            $('#progressTable').DataTable({
                pageLength: 25,
                order: [
                    [3, 'desc']
                ]
            });
        });
    </script>
</body>

</html>