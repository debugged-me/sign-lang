<div class="left-side-menu fsl-sidebar">
    <div class="slimscroll-menu d-flex flex-column h-100">

        <!-- Sidemenu -->
        <div id="sidebar-menu" class="flex-grow-1">
            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="<?= base_url('FSL'); ?>">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-book-open-page-variant-outline"></i>
                        <span>Dictionary</span>
                        <i class="mdi mdi-menu"></i>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?= base_url('FSL/dictionary'); ?>">All Signs</a></li>
                        <li><a href="<?= base_url('FSL/alphabet'); ?>">Alphabet</a></li>
                        <li><a href="<?= base_url('FSL/numbers'); ?>">Numbers</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?= base_url('FSL/lessons'); ?>">
                        <i class="mdi mdi-school-outline"></i>
                        <span>Lessons</span>
                    </a>
                </li>

                <li class="menu-divider"></li>

                <li>
                    <a href="<?= base_url('Practice'); ?>">
                        <i class="mdi mdi-camera-outline"></i>
                        <span>Practice</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('Quiz'); ?>">
                        <i class="mdi mdi-trophy-outline"></i>
                        <span>Quiz</span>
                    </a>
                </li>

                <li>
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