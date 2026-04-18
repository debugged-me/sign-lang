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
                        <span class="sl-section-subtitle">Track Your Journey</span>
                        <h1 class="sl-page-title">My Learning Progress</h1>
                        <p class="sl-page-subtitle">Monitor your achievements and identify areas for improvement</p>
                    </div>

                    <!-- Stats Row -->
                    <div class="row mb-4">
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="sl-stat-card primary sl-card-animated">
                                <div class="sl-stat-icon primary"><i class="mdi mdi-school"></i></div>
                                <div class="sl-stat-value" data-plugin="counterup"><?= $stats['total_learned'] ?></div>
                                <div class="sl-stat-label">Signs Learned</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="sl-stat-card success sl-card-animated" style="animation-delay: 0.05s;">
                                <div class="sl-stat-icon success"><i class="mdi mdi-trophy"></i></div>
                                <div class="sl-stat-value" data-plugin="counterup"><?= $stats['mastered'] ?></div>
                                <div class="sl-stat-label">Mastered</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="sl-stat-card secondary sl-card-animated" style="animation-delay: 0.1s;">
                                <div class="sl-stat-icon secondary"><i class="mdi mdi-progress-clock"></i></div>
                                <div class="sl-stat-value" data-plugin="counterup"><?= $stats['learning'] ?></div>
                                <div class="sl-stat-label">In Progress</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="sl-stat-card accent sl-card-animated" style="animation-delay: 0.15s;">
                                <div class="sl-stat-icon accent"><i class="mdi mdi-bullseye-arrow"></i></div>
                                <div class="sl-stat-value"><span data-plugin="counterup"><?= $stats['overall_accuracy'] ?></span>%</div>
                                <div class="sl-stat-label">Accuracy</div>
                            </div>
                        </div>
                    </div>

                    <!-- Achievements -->
                    <div class="sl-card mb-4">
                        <div class="p-4 border-bottom" style="border-color: var(--sl-border) !important;">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 48px; height: 48px; background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%); animation: float 3s ease-in-out infinite;">
                                    <i class="mdi mdi-trophy" style="font-size: 24px; color: var(--sl-accent);"></i>
                                </div>
                                <div>
                                    <span class="sl-section-subtitle">Milestones</span>
                                    <h4 class="font-weight-bold mb-0" style="color: var(--sl-text);">Your Achievements</h4>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <?php if (!empty($achievements)): ?>
                                <div class="row">
                                    <?php foreach ($achievements as $achievement): ?>
                                        <div class="col-md-3 col-sm-6 mb-3">
                                            <div class="sl-achievement">
                                                <div class="sl-achievement-icon">
                                                    <i class="mdi mdi-medal" style="color: var(--sl-accent);"></i>
                                                </div>
                                                <h5 class="font-weight-semibold mb-1" style="color: var(--sl-text);"><?= $achievement->achievement_title ?></h5>
                                                <small style="color: var(--sl-text-muted);"><?= date('M d, Y', strtotime($achievement->earned_at)) ?></small>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="sl-empty-state" style="padding: 40px;">
                                    <i class="mdi mdi-trophy-outline" style="font-size: 48px;"></i>
                                    <p class="mb-0" style="color: var(--sl-text-muted);">No achievements yet. Keep practicing to earn badges!</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Sign Progress Table -->
                    <div class="sl-card mb-4">
                        <div class="p-4 border-bottom" style="border-color: var(--sl-border) !important;">
                            <span class="sl-section-subtitle">Detailed breakdown</span>
                            <h4 class="font-weight-bold mb-0" style="color: var(--sl-text);">Sign Progress</h4>
                        </div>
                        <div class="p-0">
                            <div class="table-responsive">
                                <table class="sl-table mb-0" id="progressTable">
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
                                                    <div class="d-flex align-items-center">
                                                        <?php if ($progress->image_path): ?>
                                                            <img src="<?= base_url($progress->image_path) ?>" alt="<?= $progress->sign_name ?>" style="height: 40px; width: 40px; object-fit: contain;" class="mr-3 rounded">
                                                        <?php else: ?>
                                                            <div class="d-flex align-items-center justify-content-center mr-3 rounded" style="width: 40px; height: 40px; background: #F1F5F9;">
                                                                <i class="mdi mdi-hand-pointing-right" style="color: #94A3B8;"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                        <span class="font-weight-medium" style="color: var(--sl-text);"><?= $progress->sign_name ?></span>
                                                    </div>
                                                </td>
                                                <td style="color: var(--sl-text-muted);"><?= $progress->category_name ?></td>
                                                <td>
                                                    <span class="sl-badge <?= $progress->status == 'mastered' ? 'sl-badge-mastered' : ($progress->status == 'practiced' ? 'sl-badge-intermediate' : '') ?>"
                                                        style="<?= $progress->status == 'new' ? 'background: rgba(100, 116, 139, 0.1); color: var(--sl-text-muted);' : '' ?>">
                                                        <?= ucfirst($progress->status) ?>
                                                    </span>
                                                </td>
                                                <td style="color: var(--sl-text);"><?= $progress->practice_count ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="sl-progress mr-2" style="width: 60px;">
                                                            <div class="sl-progress-bar" style="width: <?= $progress->average_score ?>%; background: <?= $progress->average_score >= 80 ? 'var(--sl-success)' : ($progress->average_score >= 60 ? 'var(--sl-warning)' : 'var(--sl-danger)') ?>;"></div>
                                                        </div>
                                                        <small class="font-weight-semibold" style="color: var(--sl-text);"><?= round($progress->average_score, 1) ?>%</small>
                                                    </div>
                                                </td>
                                                <td style="color: var(--sl-text-muted);"><?= $progress->last_practice ? date('M d, Y', strtotime($progress->last_practice)) : 'Never' ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Difficult Signs -->
                    <?php if (!empty($stats['difficult_signs'])): ?>
                        <div class="sl-card mb-4">
                            <div class="p-4 border-bottom" style="border-color: var(--sl-border) !important;">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 48px; height: 48px; background: rgba(239, 68, 68, 0.1);">
                                        <i class="mdi mdi-alert" style="font-size: 24px; color: var(--sl-danger);"></i>
                                    </div>
                                    <div>
                                        <span class="sl-section-subtitle">Focus areas</span>
                                        <h4 class="font-weight-bold mb-0" style="color: var(--sl-text);">Signs to Practice More</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4">
                                <p class="mb-4" style="color: var(--sl-text-muted);">These signs have lower accuracy. Consider practicing them more to improve.</p>
                                <div class="row">
                                    <?php foreach ($stats['difficult_signs'] as $sign): ?>
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                                            <div class="sl-sign-card">
                                                <div class="sl-sign-preview" style="height: 100px;">
                                                    <?php if ($sign->image_path): ?>
                                                        <img src="<?= base_url($sign->image_path) ?>" alt="<?= $sign->sign_name ?>">
                                                    <?php else: ?>
                                                        <i class="mdi mdi-hand-pointing-right" style="font-size: 32px; color: #94A3B8;"></i>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="sl-sign-name" style="font-size: 0.875rem;"><?= $sign->sign_name ?></div>
                                                <small class="font-weight-semibold" style="color: var(--sl-danger);"><?= round($sign->average_score, 1) ?>% accuracy</small>
                                                <a href="<?= base_url('Practice/category/' . $sign->category_id) ?>" class="sl-btn sl-btn-outline w-100 mt-2" style="padding: 6px 12px; font-size: 0.75rem;">
                                                    Practice
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <?php $this->load->view('includes/footer'); ?>
        </div>
    </div>

    <?php $this->load->view('includes/footer_plugins'); ?>
    <script>
        $(document).ready(function() {
            $('#progressTable').DataTable({
                pageLength: 25,
                order: [
                    [3, 'desc']
                ],
                language: {
                    search: '',
                    searchPlaceholder: 'Search signs...'
                }
            });
        });
    </script>
</body>

</html>