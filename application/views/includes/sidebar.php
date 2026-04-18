<?php
// Echo Flow — docked rounded sidebar with pill active state
$__currentUrl = strtolower($this->uri->uri_string());
$__is = function ($needle) use ($__currentUrl) {
    $needle = strtolower(trim($needle, '/'));
    if ($needle === '') {
        return $__currentUrl === '' || strpos($__currentUrl, 'fsl') === 0;
    }
    return strpos($__currentUrl, $needle) === 0;
};
$__dictOpen = ($__is('fsl/dictionary') || $__is('fsl/alphabet') || $__is('fsl/numbers') || $__is('fsl/sign_detail'));
$__dashActive = ($__is('fsl') && !$__dictOpen && !$__is('fsl/lessons') && !$__is('fsl/lesson') && !$__is('fsl/progress'));
$__userType   = strtolower((string) $this->session->userdata('user_type'));
$__isAdmin    = ($__userType === 'admin' || $__userType === 'instructor');
?>
<div class="left-side-menu fsl-sidebar">
    <div class="slimscroll-menu d-flex flex-column h-100">

        <!-- Brand -->
        <a href="<?= base_url('FSL') ?>" class="sidebar-brand" style="text-decoration:none;">
            <div class="d-flex align-items-center" style="gap:10px;">
                <div class="sidebar-brand-mark">
                    <img src="<?= base_url('upload/banners/FSL-LOGO.png') ?>" alt="SignLearn logo">
                </div>
                <div>
                    <h1>SignLearn</h1>
                </div>
            </div>
        </a>

        <!-- Sidemenu -->
        <div id="sidebar-menu" class="flex-grow-1">
            <div class="sidebar-section-label">Learn</div>
            <ul class="metismenu" id="side-menu">
                <li class="<?= $__dashActive ? 'active' : '' ?>">
                    <a href="<?= base_url('FSL'); ?>">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="<?= $__dictOpen ? 'active mm-active' : '' ?>">
                    <a href="javascript: void(0);" class="has-arrow waves-effect <?= $__dictOpen ? 'mm-active' : '' ?>" aria-expanded="<?= $__dictOpen ? 'true' : 'false' ?>">
                        <i class="mdi mdi-dictionary"></i>
                        <span>Dictionary</span>
                    </a>
                    <ul class="nav-second-level <?= $__dictOpen ? 'mm-collapse mm-show' : 'mm-collapse' ?>" aria-expanded="<?= $__dictOpen ? 'true' : 'false' ?>">
                        <li class="<?= $__is('fsl/dictionary') && !$__is('fsl/sign_detail') ? 'active' : '' ?>">
                            <a href="<?= base_url('FSL/dictionary'); ?>"><span class="sub-dot"></span>All Signs</a>
                        </li>
                        <li class="<?= $__is('fsl/alphabet') ? 'active' : '' ?>">
                            <a href="<?= base_url('FSL/alphabet'); ?>"><span class="sub-dot"></span>Alphabet</a>
                        </li>
                        <li class="<?= $__is('fsl/numbers') ? 'active' : '' ?>">
                            <a href="<?= base_url('FSL/numbers'); ?>"><span class="sub-dot"></span>Numbers</a>
                        </li>
                    </ul>
                </li>

                <li class="<?= ($__is('fsl/lessons') || $__is('fsl/lesson')) ? 'active' : '' ?>">
                    <a href="<?= base_url('FSL/lessons'); ?>">
                        <i class="mdi mdi-school-outline"></i>
                        <span>Lessons</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-section-label">Practice</div>
            <ul class="metismenu">
                <li class="<?= $__is('practice') ? 'active' : '' ?>">
                    <a href="<?= base_url('Practice'); ?>">
                        <i class="mdi mdi-camera-outline"></i>
                        <span>Practice</span>
                    </a>
                </li>

                <li class="<?= $__is('quiz') ? 'active' : '' ?>">
                    <a href="<?= base_url('Quiz'); ?>">
                        <i class="mdi mdi-trophy-outline"></i>
                        <span>Quiz</span>
                    </a>
                </li>

                <li class="<?= $__is('fsl/progress') ? 'active' : '' ?>">
                    <a href="<?= base_url('FSL/progress'); ?>">
                        <i class="mdi mdi-chart-line"></i>
                        <span>Progress</span>
                    </a>
                </li>
            </ul>

            <?php if ($__isAdmin): ?>
                <div class="sidebar-section-label">Manage</div>
                <ul class="metismenu">
                    <li>
                        <a href="<?= base_url('Admin') ?>">
                            <i class="mdi mdi-shield-account-outline"></i>
                            <span>Admin Console</span>
                        </a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Sign Out pinned at bottom -->
        <div class="sidebar-footer">
            <a href="<?= base_url('Login/logout'); ?>" class="sidebar-logout">
                <i class="mdi mdi-logout-variant"></i>
                <span>Sign Out</span>
            </a>
        </div>
    </div>
</div>