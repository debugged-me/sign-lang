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
                                <h4 class="page-title">Quiz Mode</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Quiz Options -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Select Quiz Options</h4>
                                <form action="<?= base_url('Quiz/start') ?>" method="get">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Difficulty Level</label>
                                                <select name="difficulty" class="form-control">
                                                    <option value="easy">Easy</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="hard">Hard</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Category (Optional)</label>
                                                <select name="category" class="form-control">
                                                    <option value="">All Categories</option>
                                                    <?php foreach ($categories as $category): ?>
                                                        <option value="<?= $category->category_id ?>"><?= $category->category_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Number of Questions</label>
                                                <select name="count" class="form-control">
                                                    <option value="5">5 Questions</option>
                                                    <option value="10" selected>10 Questions</option>
                                                    <option value="15">15 Questions</option>
                                                    <option value="20">20 Questions</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="mdi mdi-play"></i> Start Quiz
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Quiz Buttons -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Quick Start</h4>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <a href="<?= base_url('Quiz/start?difficulty=easy&count=5') ?>" class="btn btn-outline-success btn-block btn-lg">
                                            <i class="mdi mdi-school"></i> Easy Quiz (5)
                                        </a>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <a href="<?= base_url('Quiz/start?difficulty=medium&count=10') ?>" class="btn btn-outline-warning btn-block btn-lg">
                                            <i class="mdi mdi-school"></i> Medium Quiz (10)
                                        </a>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <a href="<?= base_url('Quiz/start?difficulty=hard&count=15') ?>" class="btn btn-outline-danger btn-block btn-lg">
                                            <i class="mdi mdi-school"></i> Hard Quiz (15)
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quiz History -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Recent Quiz Results</h4>
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
                                                        <td><?= gmdate("i:s", $quiz->duration_seconds) ?></td>
                                                        <td>
                                                            <a href="<?= base_url('Quiz/results/' . $quiz->session_id) ?>" class="btn btn-sm btn-outline-primary">View</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted">No quiz history yet. Take your first quiz!</p>
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