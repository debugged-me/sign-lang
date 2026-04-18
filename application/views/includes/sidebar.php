<div class="left-side-menu">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>

                <li>
                    <a href="<?= base_url('FSL'); ?>">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-hand-pointing-right"></i>
                        <span>FSL Dictionary</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?= base_url('FSL/dictionary'); ?>">All Signs</a></li>
                        <li><a href="<?= base_url('FSL/alphabet'); ?>">Alphabet</a></li>
                        <li><a href="<?= base_url('FSL/numbers'); ?>">Numbers</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?= base_url('FSL/lessons'); ?>">
                        <i class="mdi mdi-book-open-variant"></i>
                        <span>Lessons</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('Practice'); ?>">
                        <i class="mdi mdi-camera"></i>
                        <span>Practice</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('Quiz'); ?>">
                        <i class="mdi mdi-trophy"></i>
                        <span>Quiz</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('FSL/progress'); ?>">
                        <i class="mdi mdi-chart-line"></i>
                        <span>My Progress</span>
                    </a>
                </li>

                <li class="menu-title">Account</li>

                <li>
                    <a href="<?= base_url('Login/logout'); ?>">
                        <i class="mdi mdi-logout"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>