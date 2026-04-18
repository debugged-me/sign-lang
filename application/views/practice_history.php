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
                                <h4 class="page-title">Practice History</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <?php if (!empty($sessions)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Type</th>
                                                    <th>Score</th>
                                                    <th>Attempts</th>
                                                    <th>Duration</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($sessions as $session): ?>
                                                    <tr>
                                                        <td><?= date('M d, Y H:i', strtotime($session->completed_at)) ?></td>
                                                        <td><?= ucfirst($session->session_type) ?></td>
                                                        <td>
                                                            <span class="badge badge-<?= $session->score >= 80 ? 'success' : ($session->score >= 60 ? 'warning' : 'danger') ?>">
                                                                <?= round($session->score, 1) ?>%
                                                            </span>
                                                        </td>
                                                        <td><?= $session->correct_attempts ?> / <?= $session->total_attempts ?></td>
                                                        <td><?= gmdate('i:s', $session->duration_seconds) ?></td>
                                                        <td>
                                                            <a href="<?= base_url('Practice/results/' . $session->session_id) ?>" class="btn btn-sm btn-outline-primary">View</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted mb-0">No completed practice sessions yet.</p>
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