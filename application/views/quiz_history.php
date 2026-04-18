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
                                    <a href="<?= base_url('Quiz') ?>" class="btn btn-primary">
                                        <i class="mdi mdi-arrow-left"></i> Back to Quiz
                                    </a>
                                </div>
                                <h4 class="page-title">Quiz History</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <?php if (!empty($quiz_history)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Score</th>
                                                    <th>Correct</th>
                                                    <th>Duration</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($quiz_history as $quiz): ?>
                                                    <tr>
                                                        <td><?= date('M d, Y H:i', strtotime($quiz->completed_at)) ?></td>
                                                        <td>
                                                            <span class="badge badge-<?= $quiz->score >= 80 ? 'success' : ($quiz->score >= 60 ? 'warning' : 'danger') ?>">
                                                                <?= round($quiz->score, 1) ?>%
                                                            </span>
                                                        </td>
                                                        <td><?= $quiz->correct_answers ?> / <?= $quiz->total_questions ?></td>
                                                        <td><?= gmdate('i:s', $quiz->duration_seconds) ?></td>
                                                        <td>
                                                            <a href="<?= base_url('Quiz/results/' . $quiz->session_id) ?>" class="btn btn-sm btn-outline-primary">View</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted mb-0">No completed quizzes yet.</p>
                                <?php endif; ?>
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