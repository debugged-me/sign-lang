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
                                <div class="page-title-right">
                                    <a href="<?= base_url('Quiz') ?>" class="btn btn-primary">
                                        <i class="mdi mdi-arrow-left"></i> Back to Quiz
                                    </a>
                                </div>
                                <h4 class="page-title">Quiz Results</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Results Summary -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box bg-light text-center py-5">
                                <?php
                                $score = $score_data['score'];
                                $grade = $score >= 90 ? 'A' : ($score >= 80 ? 'B' : ($score >= 70 ? 'C' : ($score >= 60 ? 'D' : 'F')));
                                $gradeColor = $score >= 90 ? 'success' : ($score >= 70 ? 'warning' : 'danger');
                                ?>
                                <div class="mb-4">
                                    <span class="display-1 text-<?= $gradeColor ?> font-weight-bold"><?= $grade ?></span>
                                </div>
                                <h2 class="mb-2">Score: <?= round($score, 1) ?>%</h2>
                                <p class="lead">
                                    You got <?= $score_data['correct'] ?> out of <?= $score_data['total'] ?> questions correct
                                </p>
                                <div class="mt-4">
                                    <a href="<?= base_url('Quiz') ?>" class="btn btn-success btn-lg mr-2">
                                        <i class="mdi mdi-refresh"></i> Try Again
                                    </a>
                                    <a href="<?= base_url('FSL/progress') ?>" class="btn btn-outline-primary btn-lg">
                                        <i class="mdi mdi-chart-line"></i> View Progress
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attempts Detail -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Question Review</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Question</th>
                                                <th>Sign</th>
                                                <th>Your Answer</th>
                                                <th>Result</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $counter = 1;
                                            foreach ($attempts as $attempt):
                                            ?>
                                                <tr>
                                                    <td><?= $counter++ ?></td>
                                                    <td><?= ucfirst($session->session_type) ?> Question</td>
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
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Session Stats</h4>
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <h3><?= $session->total_attempts ?></h3>
                                        <small>Total Questions</small>
                                    </div>
                                    <div class="col-md-4">
                                        <h3><?= gmdate("i:s", $session->duration_seconds) ?></h3>
                                        <small>Time Taken</small>
                                    </div>
                                    <div class="col-md-4">
                                        <h3><?= round(($score_data['correct'] / max($score_data['total'], 1)) * 100) ?>%</h3>
                                        <small>Accuracy</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('includes/footer_plugins'); ?>
</body>

</html>