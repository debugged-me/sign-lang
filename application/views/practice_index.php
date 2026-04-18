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
                        <span class="sl-section-subtitle">Interactive Learning</span>
                        <h1 class="sl-page-title">Practice Mode</h1>
                        <p class="sl-page-subtitle">Use your camera to practice signs with AI-powered feedback</p>
                    </div>

                    <!-- Free Practice Hero -->
                    <div class="sl-hero mb-4">
                        <div class="row align-items-center position-relative" style="z-index: 1;">
                            <div class="col-lg-8">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 72px; height: 72px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); animation: pulse 2s ease-in-out infinite;">
                                        <i class="mdi mdi-camera text-white" style="font-size: 36px;"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-white font-weight-bold mb-1" style="font-size: 2rem;">Free Practice</h2>
                                        <p class="mb-0" style="color: rgba(255,255,255,0.8);">AI-powered sign recognition</p>
                                    </div>
                                </div>
                                <p class="text-white" style="font-size: 1.1rem; opacity: 0.95; line-height: 1.7;">
                                    Practice with recommended signs based on your learning progress. Our AI system analyzes your hand gestures and provides real-time feedback.
                                </p>
                            </div>
                            <div class="col-lg-4 text-lg-right mt-4 mt-lg-0">
                                <a href="<?= base_url('Practice/free_practice') ?>" class="sl-btn" style="background: white; color: var(--sl-primary); font-size: 1.1rem; padding: 18px 36px; animation: float 3s ease-in-out infinite;">
                                    <i class="mdi mdi-play-circle mr-2"></i>Start Free Practice
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Practice by Category -->
                    <div class="sl-card mb-4">
                        <div class="p-4 border-bottom" style="border-color: var(--sl-border) !important;">
                            <span class="sl-section-subtitle">Browse categories</span>
                            <h4 class="font-weight-bold mb-0" style="color: var(--sl-text);">Practice by Category</h4>
                        </div>
                        <div class="p-4">
                            <div class="row">
                                <?php foreach ($categories as $category): ?>
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <a href="<?= base_url('Practice/category/' . $category->category_id) ?>" class="text-decoration-none">
                                            <div class="p-4 rounded text-center h-100 sl-card-animated" style="background: var(--sl-bg); border: 1px solid var(--sl-border); transition: all var(--sl-transition-base);">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 72px; height: 72px; background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(20, 184, 166, 0.1) 100%); animation: float 4s ease-in-out infinite;">
                                                    <i class="mdi mdi-folder-outline" style="font-size: 36px; color: var(--sl-primary);"></i>
                                                </div>
                                                <h5 class="font-weight-semibold mb-1" style="color: var(--sl-text);"><?= $category->category_name ?></h5>
                                                <small style="color: var(--sl-text-muted);">Practice signs</small>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Practice by Lesson -->
                    <div class="sl-card mb-4">
                        <div class="p-4 border-bottom d-flex justify-content-between align-items-center" style="border-color: var(--sl-border) !important;">
                            <div>
                                <span class="sl-section-subtitle">Guided practice</span>
                                <h4 class="font-weight-bold mb-0" style="color: var(--sl-text);">Practice by Lesson</h4>
                            </div>
                            <a href="<?= base_url('FSL/lessons') ?>" class="sl-btn sl-btn-outline" style="padding: 10px 20px; font-size: 0.875rem;">
                                View All Lessons
                            </a>
                        </div>
                        <div class="p-0">
                            <div class="table-responsive">
                                <table class="sl-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Lesson</th>
                                            <th>Level</th>
                                            <th>Signs</th>
                                            <th>Duration</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($lessons as $lesson): ?>
                                            <tr>
                                                <td>
                                                    <div class="font-weight-semibold" style="color: var(--sl-text);"><?= $lesson->lesson_title ?></div>
                                                    <small style="color: var(--sl-text-muted);"><?= substr($lesson->lesson_description, 0, 60) ?>...</small>
                                                </td>
                                                <td>
                                                    <span class="sl-badge sl-badge-<?= $lesson->difficulty_level ?>">
                                                        <?= ucfirst($lesson->difficulty_level) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span style="color: var(--sl-text);"><i class="mdi mdi-format-list-bulleted mr-1" style="color: var(--sl-primary);"></i><?= $lesson->total_signs ?></span>
                                                </td>
                                                <td>
                                                    <span style="color: var(--sl-text-muted);"><i class="mdi mdi-clock-outline mr-1"></i><?= $lesson->estimated_duration ?> min</span>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('Practice/lesson/' . $lesson->lesson_id) ?>" class="sl-btn sl-btn-primary" style="padding: 8px 16px; font-size: 0.8125rem;">
                                                        <i class="mdi mdi-play mr-1"></i>Practice
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="<?= base_url('FSL/alphabet') ?>" class="sl-btn sl-btn-outline w-100 justify-content-center">
                                <i class="mdi mdi-alpha mr-2" style="font-size: 1.2rem;"></i>Learn Alphabet
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="<?= base_url('FSL/numbers') ?>" class="sl-btn sl-btn-outline w-100 justify-content-center">
                                <i class="mdi mdi-numeric mr-2" style="font-size: 1.2rem;"></i>Learn Numbers
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="<?= base_url('Practice/history') ?>" class="sl-btn sl-btn-outline w-100 justify-content-center">
                                <i class="mdi mdi-history mr-2" style="font-size: 1.2rem;"></i>Practice History
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <?php $this->load->view('includes/footer'); ?>
        </div>
    </div>

    <?php $this->load->view('includes/footer_plugins'); ?>
</body>

</html>