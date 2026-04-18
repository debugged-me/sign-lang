<?php
// User-focused topbar — this is the learner dashboard.
// Admin controls live in the dedicated admin area, not here.
$__firstName = trim((string) $this->session->userdata('fname'));
$__lastName  = trim((string) $this->session->userdata('lname'));
if ($__firstName === '') $__firstName = 'Learner';
$__fullName  = trim($__firstName . ' ' . $__lastName);
$__userType  = strtolower((string) $this->session->userdata('user_type'));
$__avatar    = (string) $this->session->userdata('avatar');
if ($__avatar === '') $__avatar = 'default.jpg';

$__roleLabel = 'Learner';
if ($__userType === 'admin')      $__roleLabel = 'Admin';
elseif ($__userType === 'instructor') $__roleLabel = 'Instructor';
?>
<div class="navbar-custom d-flex align-items-center">
    <!-- Left: hamburger + search -->
    <ul class="list-unstyled topnav-menu topnav-menu-left m-0 d-flex align-items-center pl-2" style="gap:10px;">
        <li>
            <button class="button-menu-mobile waves-effect" aria-label="Toggle menu">
                <i class="mdi mdi-menu" style="font-size:1.5rem;"></i>
            </button>
        </li>

        <li class="d-none d-lg-block">
            <form class="app-search" onsubmit="return false;">
                <div class="app-search-box">
                    <div class="input-group">
                        <div class="input-group-append">
                            <button class="btn" type="submit" aria-label="Search">
                                <i class="mdi mdi-magnify" style="font-size:1.15rem;"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control" placeholder="Search signs, lessons, quizzes…">
                    </div>
                </div>
            </form>
        </li>
    </ul>

    <!-- Right: user chip only -->
    <ul class="list-unstyled topnav-menu float-right mb-0 d-flex align-items-center ml-auto pr-3" style="gap:6px;">
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="<?= base_url(); ?>upload/profile/<?= htmlspecialchars($__avatar) ?>" alt="user-image" class="rounded-circle" onerror="this.src='<?= base_url('upload/profile/default.jpg') ?>';">
                <span class="pro-user-meta">
                    <span class="pro-user-name"><?= htmlspecialchars($__fullName !== '' ? $__fullName : $__firstName) ?></span>
                    <span class="pro-user-role"><?= $__roleLabel ?></span>
                </span>
                <i class="mdi mdi-chevron-down pro-user-chevron"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                <a href="<?= base_url() ?>Page/changeDP?id=<?= htmlspecialchars((string)$this->session->userdata('username')) ?>" class="dropdown-item notify-item">
                    <i class="mdi mdi-image-edit-outline mr-2"></i>
                    <span>Change Profile Pic</span>
                </a>

                <a href="<?= base_url('FSL/progress') ?>" class="dropdown-item notify-item">
                    <i class="mdi mdi-chart-box-outline mr-2"></i>
                    <span>My Progress</span>
                </a>

                <?php if ($__userType === 'admin'): ?>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url('Admin') ?>" class="dropdown-item notify-item">
                        <i class="mdi mdi-shield-account-outline mr-2"></i>
                        <span>Admin Console</span>
                    </a>
                <?php endif; ?>

                <div class="dropdown-divider"></div>

                <a href="<?= site_url('login/logout') ?>" class="dropdown-item notify-item" style="color:var(--sl-danger);">
                    <i class="mdi mdi-logout-variant mr-2"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>
    </ul>
</div>
