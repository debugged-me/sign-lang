<!DOCTYPE html>
<html lang="en">

<head>
    <title>SignLearn – Sign In</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?= base_url(); ?>assets/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/main.css">

    <style>
        @font-face { font-family: 'Plus Jakarta Sans'; src: url('<?= base_url() ?>assets/fonts/Jakarta-fonts/PlusJakartaSans-Regular.ttf'); font-weight: 400; }
        @font-face { font-family: 'Plus Jakarta Sans'; src: url('<?= base_url() ?>assets/fonts/Jakarta-fonts/PlusJakartaSans-Medium.ttf'); font-weight: 500; }
        @font-face { font-family: 'Plus Jakarta Sans'; src: url('<?= base_url() ?>assets/fonts/Jakarta-fonts/PlusJakartaSans-SemiBold.ttf'); font-weight: 600; }
        @font-face { font-family: 'Plus Jakarta Sans'; src: url('<?= base_url() ?>assets/fonts/Jakarta-fonts/PlusJakartaSans-Bold.ttf'); font-weight: 700; }

        body, .login100-form, .input100, .label-input100, .login100-form-btn, .txt2, .txt2 a, .txt2 span {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
    </style>

    <style>
        .wrap-input100 { position: relative; }

        .label-input100 {
            display: inline-block;
            width: auto;
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #9b9b9b;
            font-size: 16px;
            font-weight: 600;
            pointer-events: none;
            transition: 0.2s ease;
            background: #f7f7f7;
            padding: 0 10px;
            z-index: 3;
        }

        .input100:focus + .focus-input100 + .label-input100,
        .has-val.input100 + .focus-input100 + .label-input100 {
            top: -8px;
            transform: none;
            font-size: 14px;
            color: #2563eb;
            background: #f7f7f7;
            padding: 0 8px;
        }

        .focus-input100 { z-index: 1; }

        .has-val.input100 + .focus-input100 {
            visibility: visible;
            opacity: 1;
            transform: scale(1);
        }

        .password-wrap { position: relative; }
        .password-wrap .input100 { padding-right: 45px; }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 10;
            color: #666;
            font-size: 16px;
        }
        .toggle-password:hover { color: #333; }

        .container-login100 {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .wrap-login100 {
            display: flex;
            align-items: stretch;
            min-height: 100vh;
            width: 100%;
        }

        .login100-form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 55px;
        }

        .login100-more {
            flex: 1;
        }
    </style>
</head>

<body style="background-color: #666666;">

    <?php
        $bgUrl   = (!empty($settings) && !empty($settings->login_bg_image))
                    ? base_url('upload/banners/' . $settings->login_bg_image) : '';
        $logoUrl = (!empty($settings) && !empty($settings->login_logo))
                    ? base_url('upload/banners/' . $settings->login_logo) : '';
        $siteName = (!empty($settings) && !empty($settings->site_name)) ? $settings->site_name : 'SignLearn';
    ?>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">

                <form action="<?= site_url('Login/login') ?>" method="post" class="login100-form validate-form">

                    <span class="login100-form-title p-b-43">
                        <?php if ($logoUrl): ?>
                            <img src="<?= $logoUrl ?>" alt="<?= $siteName ?>" height="150" width="150" loading="lazy" decoding="async">
                        <?php else: ?>
                            <span style="font-size:22px;font-weight:700;color:#333;"><?= $siteName ?></span>
                        <?php endif; ?>
                    </span>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div style="text-align:center;color:#fff;background:#c0392b;border-radius:6px;padding:8px 14px;margin-bottom:14px;font-size:14px;">
                            <i class="fa fa-exclamation-circle"></i>
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('success')): ?>
                        <div style="text-align:center;color:#fff;background:#27ae60;border-radius:6px;padding:8px 14px;margin-bottom:14px;font-size:14px;">
                            <i class="fa fa-check-circle"></i>
                            <?= $this->session->flashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <input class="input100" type="text" autocomplete="username" name="username" id="loginUsername" placeholder="">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Username</span>
                    </div>

                    <div class="wrap-input100 validate-input password-wrap" data-validate="Password is required">
                        <input class="input100" type="password" autocomplete="current-password" name="password" id="loginPassword" placeholder="">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                        <span class="toggle-password" onclick="togglePassword()" id="togglePassword">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">Login</button>
                    </div>

                    <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
                            <a href="<?= site_url('Login/register') ?>"><span style="color:#3498db">CREATE AN ACCOUNT</span></a>
                            &nbsp;|&nbsp;
                            <a href="<?= site_url('Login/demo') ?>">TRY DEMO</a>
                        </span>
                    </div>

                </form>

                <div class="login100-more"
                    <?php if ($bgUrl): ?>data-bg="<?= $bgUrl ?>"<?php else: ?>style="background-color:#1a2a4a;"<?php endif; ?>>
                </div>

            </div>
        </div>
    </div>

    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/animsition/js/animsition.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/popper.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/select2/select2.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/countdowntime/countdowntime.js"></script>
    <script src="<?= base_url(); ?>assets/js/main.js"></script>

    <script>
        (function($) {
            var $fields = $('.wrap-input100 .input100').filter('[type="text"],[type="password"]');

            function toggleHasVal() {
                $(this).toggleClass('has-val', $.trim($(this).val()).length > 0);
            }

            $fields.each(function() { toggleHasVal.call(this); });
            $fields.on('input blur', toggleHasVal);

            setTimeout(function() {
                $fields.each(function() { toggleHasVal.call(this); });
            }, 300);
        })(jQuery);
    </script>

    <script>
        // Lazy-load background image after first paint
        (function($) {
            $(function() {
                var $bg = $('.login100-more');
                var url = $bg.attr('data-bg');
                if (!url) return;
                var img = new Image();
                img.onload = function() {
                    $bg.css('background-image', "url('" + url + "')");
                };
                img.src = url;
            });
        })(jQuery);
    </script>

    <script>
        function togglePassword() {
            var input = document.getElementById('loginPassword');
            var icon = document.querySelector('#togglePassword i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>

</body>
</html>
