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
?>
<div class="left-side-menu fsl-sidebar">
    <div class="slimscroll-menu d-flex flex-column h-100">

        <!-- Brand -->
        <div class="sidebar-brand">
            <h1 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:1.375rem;color:var(--sl-primary);letter-spacing:-0.02em;margin:0 0 2px 4px;">SignLearn</h1>
            <p style="font-family:'Manrope',sans-serif;font-size:0.625rem;text-transform:uppercase;letter-spacing:0.16em;color:var(--sl-text-muted);font-weight:700;margin:0 0 0 4px;opacity:0.75;">FSL Learning Platform</p>
        </div>

        <!-- Sidemenu -->
        <div id="sidebar-menu" class="flex-grow-1">
            <ul class="metismenu" id="side-menu">
                <li class="<?= ($__is('fsl') && !$__is('fsl/dictionary') && !$__is('fsl/alphabet') && !$__is('fsl/numbers') && !$__is('fsl/lessons') && !$__is('fsl/progress')) ? 'active' : '' ?>">
                    <a href="<?= base_url('FSL'); ?>">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="<?= ($__is('fsl/dictionary') || $__is('fsl/alphabet') || $__is('fsl/numbers')) ? 'active' : '' ?>">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-book-open-page-variant-outline"></i>
                        <span>Dictionary</span>
                        <i class="mdi mdi-menu menu-arrow"></i>
                    </a>
                    <ul class="nav-second-level" aria-expanded="<?= ($__is('fsl/dictionary') || $__is('fsl/alphabet') || $__is('fsl/numbers')) ? 'true' : 'false' ?>">
                        <li><a href="<?= base_url('FSL/dictionary'); ?>">All Signs</a></li>
                        <li><a href="<?= base_url('FSL/alphabet'); ?>">Alphabet</a></li>
                        <li><a href="<?= base_url('FSL/numbers'); ?>">Numbers</a></li>
                    </ul>
                </li>

                <li class="<?= $__is('fsl/lessons') ? 'active' : '' ?>">
                    <a href="<?= base_url('FSL/lessons'); ?>">
                        <i class="mdi mdi-school-outline"></i>
                        <span>Lessons</span>
                    </a>
                </li>

                <li class="menu-divider"></li>

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
                        <i class="mdi mdi-chart-box-outline"></i>
                        <span>Progress</span>
                    </a>
                </li>

                <li class="menu-divider"></li>

                <li>
                    <a href="<?= base_url('Login/logout'); ?>">
                        <i class="mdi mdi-logout-variant"></i>
                        <span>Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>
