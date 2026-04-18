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
                    <!-- Breadcrumb -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?= base_url('FSL/dictionary') ?>">Dictionary</a></li>
                                        <li class="breadcrumb-item active"><?= $sign->sign_name ?></li>
                                    </ol>
                                </div>
                                <h4 class="page-title"><?= $sign->sign_name ?></h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Sign Details -->
                        <div class="col-md-6">
                            <div class="card-box">
                                <div class="text-center mb-4">
                                    <?php if ($sign->image_path && file_exists(FCPATH . $sign->image_path)): ?>
                                        <img src="<?= base_url($sign->image_path) ?>" alt="<?= $sign->sign_name ?>" class="img-fluid rounded shadow" style="max-height: 300px;">
                                    <?php else: ?>
                                        <div class="sign-placeholder bg-light d-flex align-items-center justify-content-center rounded shadow" style="height: 300px;">
                                            <i class="mdi mdi-hand-pointing-right text-muted" style="font-size: 120px;"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if ($sign->video_path): ?>
                                    <div class="text-center mb-3">
                                        <video controls class="w-100 rounded">
                                            <source src="<?= base_url($sign->video_path) ?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Sign Info -->
                        <div class="col-md-6">
                            <div class="card-box">
                                <h4 class="header-title mb-3">Sign Information</h4>

                                <table class="table table-borderless">
                                    <tr>
                                        <td width="30%"><strong>Name:</strong></td>
                                        <td><?= $sign->sign_name ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Type:</strong></td>
                                        <td><span class="badge badge-info"><?= ucfirst($sign->sign_type) ?></span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Category:</strong></td>
                                        <td><?= $sign->category_name ? $sign->category_name : 'N/A' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Difficulty:</strong></td>
                                        <td><span class="badge badge-<?= $sign->difficulty_level == 'beginner' ? 'success' : ($sign->difficulty_level == 'intermediate' ? 'warning' : 'danger') ?>"><?= ucfirst($sign->difficulty_level) ?></span></td>
                                    </tr>
                                </table>

                                <?php if ($sign->description): ?>
                                    <h5 class="mt-4">Description</h5>
                                    <p><?= $sign->description ?></p>
                                <?php endif; ?>

                                <?php if ($sign->handshape_description): ?>
                                    <h5 class="mt-3">Handshape</h5>
                                    <p><?= $sign->handshape_description ?></p>
                                <?php endif; ?>

                                <?php if ($sign->movement_description): ?>
                                    <h5 class="mt-3">Movement</h5>
                                    <p><?= $sign->movement_description ?></p>
                                <?php endif; ?>

                                <?php if ($sign->usage_example): ?>
                                    <h5 class="mt-3">Usage Example</h5>
                                    <div class="alert alert-light border">
                                        <i class="mdi mdi-format-quote-open"></i>
                                        <?= $sign->usage_example ?>
                                        <i class="mdi mdi-format-quote-close"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- User Progress -->
                            <div class="card-box">
                                <h4 class="header-title mb-3">Your Progress</h4>

                                <?php if ($user_progress): ?>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span>Status:</span>
                                            <span class="badge badge-<?= $user_progress->status == 'mastered' ? 'success' : ($user_progress->status == 'practiced' ? 'info' : 'secondary') ?>">
                                                <?= ucfirst($user_progress->status) ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span>Practice Count:</span>
                                            <strong><?= $user_progress->practice_count ?></strong>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span>Accuracy:</span>
                                            <strong><?= round($user_progress->average_score, 1) ?>%</strong>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted">You haven't practiced this sign yet.</p>
                                <?php endif; ?>

                                <div class="text-center mt-4">
                                    <a href="<?= base_url('Practice/category/' . $sign->category_id) ?>" class="btn btn-primary btn-lg">
                                        <i class="mdi mdi-camera"></i> Practice Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Signs -->
                    <?php if (!empty($related_signs) && count($related_signs) > 1): ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title mb-3">Related Signs</h4>
                                    <div class="row">
                                        <?php
                                        $count = 0;
                                        foreach ($related_signs as $related):
                                            if ($related->sign_id != $sign->sign_id && $count < 6):
                                                $count++;
                                        ?>
                                                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                                                    <a href="<?= base_url('FSL/sign_detail/' . $related->sign_id) ?>" class="text-decoration-none">
                                                        <div class="sign-card text-center p-2 border rounded">
                                                            <?php if ($related->image_path): ?>
                                                                <img src="<?= base_url($related->image_path) ?>" alt="<?= $related->sign_name ?>" class="img-fluid mb-1" style="max-height: 80px;">
                                                            <?php else: ?>
                                                                <div class="sign-placeholder bg-light d-flex align-items-center justify-content-center mb-1" style="height: 80px;">
                                                                    <i class="mdi mdi-hand-pointing-right text-muted" style="font-size: 32px;"></i>
                                                                </div>
                                                            <?php endif; ?>
                                                            <h6 class="m-0"><?= $related->sign_name ?></h6>
                                                        </div>
                                                    </a>
                                                </div>
                                        <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('includes/footer_plugins'); ?>
</body>

</html>