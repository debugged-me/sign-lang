<?php
$CI = &get_instance();
if (!isset($CI->SettingsModel)) {
    $CI->load->model('SettingsModel');
}
$currentSettingsId = $CI->session->userdata('settingsID');
if (empty($currentSettingsId)) {
    $currentSettingsId = $CI->SettingsModel->get_active_settings_id();
    if (!empty($currentSettingsId)) {
        $CI->session->set_userdata('settingsID', $currentSettingsId);
    }
}
$companyInfo = null;
if (!empty($currentSettingsId)) {
    $companyInfo = $CI->SettingsModel->get_company_info($currentSettingsId);
}
$__firstName = trim((string) $this->session->userdata('fname'));
if ($__firstName === '') { $__firstName = 'Guest'; }
?>
<div class="navbar-custom d-flex align-items-center">
    <!-- Left: hamburger + search (logo lives in the sidebar) -->
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
                        <input type="text" class="form-control" placeholder="Search signs, lessons, quizzes...">
                    </div>
                </div>
            </form>
        </li>
    </ul>

    <!-- Right menu -->
    <ul class="list-unstyled topnav-menu float-right mb-0 d-flex align-items-center ml-auto pr-2" style="gap:4px;">
        <?php if ($this->session->userdata('level') !== 'Student'): ?>
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" title="Birthday Celebrants">
                    <i class="mdi mdi-cake-variant"></i>
                    <?php if (!empty($birthday_count) && $birthday_count > 0): ?>
                        <span class="badge badge-danger rounded-circle noti-icon-badge"><?= $birthday_count; ?></span>
                    <?php endif; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                    <div class="dropdown-item noti-title">
                        <h5 class="font-16 m-0" style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:var(--sl-text);">Birthday Celebrants</h5>
                    </div>
                    <div class="slimscroll noti-scroll">
                        <div class="inbox-widget">
                            <a href="<?= base_url(); ?>Page/birthdays_today">
                                <div class="inbox-item">
                                    <div class="inbox-item-img">
                                        <img src="<?= base_url(); ?>assets/images/cake.png" class="rounded-circle" alt="">
                                    </div>
                                    <p class="inbox-item-author">Today's</p>
                                    <p class="inbox-item-text text-truncate">Birthday Celebrants</p>
                                </div>
                            </a>
                            <a href="<?= base_url(); ?>Page/birthdays_month">
                                <div class="inbox-item">
                                    <div class="inbox-item-img">
                                        <img src="<?= base_url(); ?>assets/images/cake.png" class="rounded-circle" alt="">
                                    </div>
                                    <p class="inbox-item-author">This Month's</p>
                                    <p class="inbox-item-text text-truncate">Birthday Celebrants</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        <?php endif; ?>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="<?= base_url(); ?>upload/profile/<?php echo $this->session->userdata('avatar'); ?>" alt="user-image" class="rounded-circle">
                <span class="pro-user-name"><?= htmlspecialchars($__firstName) ?></span>
                <i class="mdi mdi-chevron-down pro-user-chevron"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                <a href="<?= base_url(); ?>Page/changeDP?id=<?php echo $this->session->userdata('username'); ?>" class="dropdown-item notify-item">
                    <i class="mdi mdi-image-edit-outline mr-2"></i>
                    <span>Change Profile Pic</span>
                </a>

                <?php if ($this->session->userdata('level') === 'Student'): ?>
                    <a href="<?= base_url(); ?>Page/studentsprofile" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-outline mr-2"></i>
                        <span>My Profile</span>
                    </a>
                <?php else: ?>
                    <a href="<?= base_url(); ?>Page/staffprofile?id=<?php echo $this->session->userdata('IDNumber'); ?>" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-outline mr-2"></i>
                        <span>My Profile</span>
                    </a>
                <?php endif; ?>

                <a href="<?= base_url(); ?>Page/lockScreen?id=<?php echo $this->session->userdata('username'); ?>" class="dropdown-item notify-item">
                    <i class="mdi mdi-lock-outline mr-2"></i>
                    <span>Lock Screen</span>
                </a>

                <div class="dropdown-divider"></div>

                <a href="<?php echo site_url('login/logout'); ?>" class="dropdown-item notify-item" style="color:var(--sl-danger);">
                    <i class="mdi mdi-logout-variant mr-2"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>

        <li class="dropdown notification-list">
            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect" title="Settings">
                <i class="mdi mdi-cog-outline"></i>
            </a>
        </li>
    </ul>
</div>
