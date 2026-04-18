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
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <a href="<?= base_url('Practice') ?>" class="btn btn-primary">
                                        <i class="mdi mdi-arrow-left"></i> Back to Practice
                                    </a>
                                </div>
                                <h4 class="page-title">Practice Session Results</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box bg-light">
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <h2 class="text-<?= $session->score >= 80 ? 'success' : ($session->score >= 60 ? 'warning' : 'danger') ?>">
                                            <?= round($session->score, 1) ?>%
                                        </h2>
                                        <small>Overall Score</small>
                                    </div>
                                    <div class="col-md-3">
                                        <h2><?= $session->correct_attempts ?> / <?= $session->total_attempts ?></h2>
                                        <small>Correct Attempts</small>
                                    </div>
                                    <div class="col-md-3">
                                        <h2><?= gmdate("i:s", $session->duration_seconds) ?></h2>
                                        <small>Duration</small>
                                    </div>
                                    <div class="col-md-3">
                                        <h2><?= ucfirst($session->session_type) ?></h2>
                                        <small>Session Type</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Attempt Details</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Sign</th>
                                                <th>Your Answer</th>
                                                <th>Result</th>
                                                <th>Confidence</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $counter = 1; ?>
                                            <?php foreach ($attempts as $attempt): ?>
                                                <tr>
                                                    <td><?= $counter++ ?></td>
                                                    <td>
                                                        <?php if ($attempt->image_path): ?>
                                                            <img src="<?= base_url($attempt->image_path) ?>" alt="<?= $attempt->sign_name ?>" style="height: 40px;" class="mr-2">
                                                        <?php endif; ?>
                                                        <?= $attempt->sign_name ?>
                                                    </td>
                                                    <td><?= $attempt->recognized_sign ?></td>
                                                    <td>
                                                        <?php if ($attempt->is_correct): ?>
                                                            <span class="badge badge-success"><i class="mdi mdi-check"></i> Correct</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-danger"><i class="mdi mdi-close"></i> Incorrect</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($attempt->confidence_score > 0): ?>
                                                            <div class="progress" style="width: 100px; height: 8px;">
                                                                <div class="progress-bar" style="width: <?= $attempt->confidence_score * 100 ?>%"></div>
                                                            </div>
                                                            <small><?= round($attempt->confidence_score * 100, 1) ?>%</small>
                                                        <?php else: ?>
                                                            <span class="text-muted">-</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= date('H:i:s', strtotime($attempt->attempted_at)) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="<?= base_url('Practice') ?>" class="btn btn-primary btn-lg mr-2">
                                <i class="mdi mdi-play"></i> Practice Again
                            </a>
                            <a href="<?= base_url('FSL/progress') ?>" class="btn btn-outline-secondary btn-lg">
                                <i class="mdi mdi-chart-line"></i> View Progress
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('includes/footer_plugins'); ?>
</body>

</html>