<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/title.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ✅ SAFE SPEED BOOST (no trim): preconnect for faster asset loading -->
    <link rel="dns-prefetch" href="<?= base_url(); ?>">
    <link rel="preconnect" href="<?= base_url(); ?>" crossorigin>

    <!--===============================================================================================-->
    <link rel="icon" type="<?= base_url(); ?>assets/image/png" href="<?= base_url(); ?>assets/images/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/main.css">
    <!--===============================================================================================-->
    <style>
        /* Wrapper position */
        .wrap-input100 {
            position: relative;
        }

        /* IG-style floating label */
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
            /* << Instagram key */
            padding: 0 10px;
            /* << cuts the border */
            z-index: 3;
            /* sits above border */
        }

        /* On focus or has value */
        .input100:focus+.focus-input100+.label-input100,
        .has-val.input100+.focus-input100+.label-input100 {
            top: -8px;
            /* sits on border */
            transform: none;
            font-size: 14px;
            color: #2563eb;
            /* blue text like border */
            background: #f7f7f7;
            /* keeps border cut */
            padding: 0 8px;
        }

        /* The blue border element */
        .focus-input100 {
            z-index: 1;
        }

        /* Keep the blue outline visible when the field already has a value */
        .has-val.input100+.focus-input100 {
            visibility: visible;
            opacity: 1;
            transform: scale(1);
        }

        .portal-links-wrap {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin: 8px 0 6px;
        }

        @media (max-width: 576px) {
            .portal-links-wrap {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <style>
        .password-wrap {
            position: relative;
        }

        .password-wrap .input100 {
            padding-right: 45px;
            /* space for eye icon */
        }

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

        .toggle-password:hover {
            color: #333;
        }
    </style>



</head>

<body style="background-color: #666666;">

    <?php
    // ✅ SAFE FALLBACKS (prevents undefined index errors)
    $logo = (!empty($data) && isset($data[0]->login_form_image)) ? $data[0]->login_form_image : '';
    $bg   = (!empty($data) && isset($data[0]->loginFormImage)) ? $data[0]->loginFormImage : '';
    $logoUrl = $logo ? base_url('upload/banners/' . $logo) : '';
    $bgUrl   = $bg ? base_url('upload/banners/' . $bg) : '';
    $apkPath = FCPATH . 'Download/app-release.apk';
    $apkUrl = base_url('Download/app-release.apk');
    $hasApkDownload = is_file($apkPath);
    ?>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">

                <form action="<?php echo site_url('Login/auth'); ?>" method="post" class="login100-form validate-form">
                    <input type="hidden" name="next" value="<?= html_escape($this->input->get('next')) ?>">

                    <span class="login100-form-title p-b-43"></span>
                    <span class="login100-form-title p-b-43">

                        <?php if ($logoUrl): ?>
                            <!-- ✅ SAFE SPEED BOOST: lazy + async decode -->
                            <img
                                src="<?= $logoUrl; ?>"
                                alt="mySRMS Portal"
                                height="150"
                                width="150"
                                loading="lazy"
                                decoding="async">
                        <?php endif; ?>

                        <!-- <img src="<?= base_url(); ?>upload/banners/<?php echo $data[0]->login_form_image; ?>" alt="mySRMS Portal" width="100%"> -->
                    </span>

                    <div style="text-align:center; color:#f8f7fc; background-color:#050168;text-transform:uppercase; style:bold;">
                        <small><?php echo $this->session->flashdata('msg'); ?></small>
                        <small><?php echo $this->session->flashdata('danger'); ?></small>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <!-- ✅ SAFE: better autofill, does not break -->
                        <input class="input100" type="text" autocomplete="username" name="username" id="loginUsername">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Username</span>
                    </div>

                    <div class="wrap-input100 validate-input password-wrap" data-validate="Password is required">
                        <input class="input100" type="password" autocomplete="current-password" name="password" id="loginPassword">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>

                        <span class="toggle-password" onclick="togglePassword()" id="togglePassword">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>

                    <input class="input100" type="hidden" name="sy" value="<?php echo isset($active_sy) ? $active_sy : ''; ?>">
                    <input class="input100" type="hidden" name="semester" value="<?php echo isset($active_sem) ? $active_sem : ''; ?>">

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
                            <?php if (isset($allow_signup) && $allow_signup == 'Yes') : ?>
                                <a href="<?= base_url(); ?>Registration"><span style="color: #3498db">CREATE AN ACCOUNT</span></a> |
                            <?php endif; ?>
                            <a href="#" data-toggle="modal" data-target="#forgotModal">FORGOT PASSWORD</a>
                        </span>
                    </div>

                    <div class="portal-links-wrap">
                        <?php if ($hasApkDownload): ?>
                            <a
                                href="<?= html_escape($apkUrl); ?>"
                                target="_blank"
                                rel="noopener"
                                download
                                class="portal-link-btn">
                                <span class="portal-link-icon">📱</span>
                                <span>Download Mobile APK</span>
                            </a>
                        <?php endif; ?>

                        <a
                            href="<?= base_url('srms/steps-for-enrollment.php'); ?>"
                            target="_blank"
                            class="portal-link-btn portal-link-btn-outline">
                            <span class="portal-link-icon">📘</span>
                            <span>Enrollment Guide</span>
                        </a>
                    </div>

                </form>

                <!-- ✅ IMPORTANT: keep your design but delay heavy bg image -->
                <div class="login100-more"
                    <?php if ($bgUrl): ?>
                    data-bg="<?= $bgUrl; ?>"
                    <?php else: ?>
                    style="background-color:#444;"
                    <?php endif; ?>>
                </div>

            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>assets/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/popper.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>assets/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>assets/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url(); ?>assets/js/main.js"></script>

    <script>
        (function($) {
            var $fields = $('.wrap-input100 .input100').filter('[type="text"],[type="password"]');

            function toggleHasVal() {
                $(this).toggleClass('has-val', $.trim($(this).val()).length > 0);
            }

            $fields.each(function() {
                toggleHasVal.call(this);
            });

            $fields.on('input blur', toggleHasVal);

            // Re-run shortly after load to catch autofill
            setTimeout(function() {
                $fields.each(function() {
                    toggleHasVal.call(this);
                });
            }, 300);
        })(jQuery);
    </script>

    <script>
        (function($) {
            $(function() {
                var params = new URLSearchParams(window.location.search || '');
                if (!params.get('prefill_registration')) return;

                var payload = null;
                try {
                    payload = JSON.parse(sessionStorage.getItem('srmsRegistrationCredentials') || 'null');
                } catch (e) {
                    payload = null;
                }

                if (!payload) return;

                var $username = $('#loginUsername');
                var $password = $('#loginPassword');

                if ($username.length && payload.username) {
                    $username.val(payload.username).addClass('has-val');
                }

                if ($password.length && payload.password) {
                    $password.val(payload.password).addClass('has-val');
                }

                try {
                    sessionStorage.removeItem('srmsRegistrationCredentials');
                } catch (e) {}
            });
        })(jQuery);
    </script>

    <script>
        // ✅ SAFE SPEED BOOST: Load big background AFTER first paint
        (function($) {
            $(function() {
                var $bg = $('.login100-more');
                var url = $bg.attr('data-bg');
                if (!url) return;

                // Preload image first
                var img = new Image();
                img.onload = function() {
                    $bg.css('background-image', "url('" + url + "')");
                };
                img.src = url;
            });
        })(jQuery);
    </script>

</body>

<!-- Forgot Password Modal -->
<style>
    #forgotModal .reset-status {
        font-size: 12px;
        margin-top: 4px;
        min-height: 16px;
    }

    #forgotModal .reset-status.is-error {
        color: #dc3545;
    }

    #forgotModal .reset-status.is-success {
        color: #198754;
    }

    #forgotModal .reset-status.is-checking {
        color: #6c757d;
    }

    #forgotModal .pw-wrap {
        position: relative;
    }

    #forgotModal .pw-wrap .toggle-eye {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
        background: transparent;
        border: 0;
        z-index: 5;
        padding: 4px;
    }

    #forgotModal .pw-wrap input {
        padding-right: 36px;
    }
</style>
<div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="forgotModalLabel" style="color:black">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="forgotModalLabel">Forgot Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="resetPassword" name="resetPassword" method="post" action="<?php echo base_url(); ?>login/forgot_pass">
                    <input type="hidden" name="reset_mode" id="reset_mode" value="email">

                    <p class="text-muted small mb-2" id="resetHintEmail">
                        Enter your registered email and we will send you a temporary password.
                    </p>
                    <p class="text-muted small mb-2" id="resetHintManual" style="display:none;">
                        Enter your Username/Student ID, registered email, and a new password.
                        The account and email must match for the change to be accepted.
                    </p>

                    <div class="form-group">
                        <label for="forgot_email" class="small font-weight-bold mb-1">Email</label>
                        <div class="input-group">
                            <input type="email" name="email" id="forgot_email" class="form-control" placeholder="Enter your email" required autocomplete="email">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                            </div>
                        </div>
                        <div id="emailCheckStatus" class="reset-status"></div>
                    </div>

                    <div id="manualResetFields" style="display:none;">
                        <div class="form-group">
                            <label for="forgot_identifier" class="small font-weight-bold mb-1">Username / Student ID</label>
                            <div class="input-group">
                                <input type="text" name="identifier" id="forgot_identifier" class="form-control" placeholder="Enter your username or Student ID">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                                </div>
                            </div>
                            <div id="identifierCheckStatus" class="reset-status"></div>
                        </div>
                        <div class="form-group">
                            <label for="forgot_new_password" class="small font-weight-bold mb-1">New Password</label>
                            <div class="pw-wrap">
                                <input type="password" name="new_password" id="forgot_new_password" class="form-control" placeholder="At least 8 characters" minlength="8" autocomplete="new-password">
                                <button type="button" class="toggle-eye" data-target="forgot_new_password" aria-label="Show password"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="forgot_confirm_password" class="small font-weight-bold mb-1">Confirm New Password</label>
                            <div class="pw-wrap">
                                <input type="password" name="confirm_password" id="forgot_confirm_password" class="form-control" placeholder="Re-enter your new password" minlength="8" autocomplete="new-password">
                                <button type="button" class="toggle-eye" data-target="forgot_confirm_password" aria-label="Show password"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <a href="#" id="toggleManualReset" class="small" style="color:#2563eb;">Set password manually instead</a>
                    </div>

                    <button type="submit" id="forgotSubmitBtn" class="btn btn-primary btn-block">Request a New Password</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Forgot Password Modal -->

<script>
    (function() {
        var toggleLink = document.getElementById('toggleManualReset');
        var manualFields = document.getElementById('manualResetFields');
        var modeInput = document.getElementById('reset_mode');
        var submitBtn = document.getElementById('forgotSubmitBtn');
        var hintEmail = document.getElementById('resetHintEmail');
        var hintManual = document.getElementById('resetHintManual');
        var identifierInput = document.getElementById('forgot_identifier');
        var newPasswordInput = document.getElementById('forgot_new_password');
        var confirmPasswordInput = document.getElementById('forgot_confirm_password');
        var emailInput = document.getElementById('forgot_email');
        var emailStatus = document.getElementById('emailCheckStatus');
        var identifierStatus = document.getElementById('identifierCheckStatus');

        if (!toggleLink) return;

        function setManualMode(isManual) {
            if (isManual) {
                manualFields.style.display = 'block';
                modeInput.value = 'manual';
                submitBtn.textContent = 'Update Password';
                toggleLink.textContent = 'Send temporary password by email instead';
                hintEmail.style.display = 'none';
                hintManual.style.display = 'block';
                identifierInput.setAttribute('required', 'required');
                newPasswordInput.setAttribute('required', 'required');
                confirmPasswordInput.setAttribute('required', 'required');
            } else {
                manualFields.style.display = 'none';
                modeInput.value = 'email';
                submitBtn.textContent = 'Request a New Password';
                toggleLink.textContent = 'Set password manually instead';
                hintEmail.style.display = 'block';
                hintManual.style.display = 'none';
                identifierInput.removeAttribute('required');
                newPasswordInput.removeAttribute('required');
                confirmPasswordInput.removeAttribute('required');
            }
        }

        toggleLink.addEventListener('click', function(e) {
            e.preventDefault();
            setManualMode(modeInput.value !== 'manual');
        });

        // Eye icon toggle for both new password fields
        document.querySelectorAll('#forgotModal .toggle-eye').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var targetId = this.getAttribute('data-target');
                var input = document.getElementById(targetId);
                if (!input) return;
                var icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    if (icon) {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    }
                } else {
                    input.type = 'password';
                    if (icon) {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                }
            });
        });

        // ── Email auto-checker ────────────────────────────────────────────────
        var checkUrl = '<?php echo base_url(); ?>login/check_reset_email';
        var checkIdUrl = '<?php echo base_url(); ?>login/check_reset_identifier';
        var lastEmailChecked = '';
        var emailValid = false;
        var lastIdentifierChecked = '';
        var identifierValid = false;
        var debounceTimer = null;
        var identifierDebounceTimer = null;
        var activeXhr = null;
        var activeIdXhr = null;

        function setStatus(cls, text) {
            emailStatus.className = 'reset-status ' + cls;
            emailStatus.textContent = text;
        }

        function clearStatus() {
            emailStatus.className = 'reset-status';
            emailStatus.textContent = '';
        }

        function isValidFormat(v) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
        }

        function checkEmail() {
            var val = (emailInput.value || '').trim();
            if (val === '') {
                clearStatus();
                emailValid = false;
                return;
            }
            if (!isValidFormat(val)) {
                setStatus('is-error', 'Please enter a valid email address.');
                emailValid = false;
                return;
            }
            if (val === lastEmailChecked) return;
            lastEmailChecked = val;
            setStatus('is-checking', 'Checking…');

            if (activeXhr) {
                try {
                    activeXhr.abort();
                } catch (e) {}
            }
            activeXhr = new XMLHttpRequest();
            activeXhr.open('POST', checkUrl, true);
            activeXhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            activeXhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            activeXhr.onreadystatechange = function() {
                if (activeXhr.readyState !== 4) return;
                if (activeXhr.status === 200) {
                    try {
                        var resp = JSON.parse(activeXhr.responseText);
                        if (resp.exists) {
                            setStatus('is-success', '✓ Email found in our records.');
                            emailValid = true;
                        } else {
                            setStatus('is-error', '✗ This email is not registered in the system.');
                            emailValid = false;
                        }
                    } catch (e) {
                        clearStatus();
                        emailValid = false;
                    }
                } else if (activeXhr.status !== 0) {
                    clearStatus();
                    emailValid = false;
                }
            };
            activeXhr.send('email=' + encodeURIComponent(val));
        }

        emailInput.addEventListener('input', function() {
            if (debounceTimer) clearTimeout(debounceTimer);
            lastEmailChecked = ''; // force re-check on change
            setStatus('is-checking', 'Checking…');
            debounceTimer = setTimeout(checkEmail, 450);
        });
        emailInput.addEventListener('blur', function() {
            if (debounceTimer) clearTimeout(debounceTimer);
            checkEmail();
        });

        // Re-check when modal opens (in case value was prefilled)
        $('#forgotModal').on('shown.bs.modal', function() {
            lastEmailChecked = '';
            if ((emailInput.value || '').trim() !== '') checkEmail();
            else clearStatus();
        });

        // ── Username / Student ID auto-checker ───────────────────────────────
        function setIdStatus(cls, text) {
            identifierStatus.className = 'reset-status ' + cls;
            identifierStatus.textContent = text;
        }

        function clearIdStatus() {
            identifierStatus.className = 'reset-status';
            identifierStatus.textContent = '';
        }

        function checkIdentifier() {
            var val = (identifierInput.value || '').trim();
            var emailVal = (emailInput.value || '').trim();
            if (val === '') {
                clearIdStatus();
                identifierValid = false;
                return;
            }

            var cacheKey = val + '|' + emailVal;
            if (cacheKey === lastIdentifierChecked) return;
            lastIdentifierChecked = cacheKey;
            setIdStatus('is-checking', 'Checking…');

            if (activeIdXhr) {
                try {
                    activeIdXhr.abort();
                } catch (e) {}
            }
            activeIdXhr = new XMLHttpRequest();
            activeIdXhr.open('POST', checkIdUrl, true);
            activeIdXhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            activeIdXhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            activeIdXhr.onreadystatechange = function() {
                if (activeIdXhr.readyState !== 4) return;
                if (activeIdXhr.status === 200) {
                    try {
                        var resp = JSON.parse(activeIdXhr.responseText);
                        if (!resp.exists) {
                            setIdStatus('is-error', '✗ No account found with this Username / Student ID.');
                            identifierValid = false;
                        } else if (resp.matches_email === false) {
                            setIdStatus('is-error', '✗ This account does not match the email above.');
                            identifierValid = false;
                        } else if (resp.matches_email === true) {
                            setIdStatus('is-success', '✓ Account verified — matches the email above.');
                            identifierValid = true;
                        } else {
                            // exists but no email provided to cross-check yet
                            setIdStatus('is-success', '✓ Account found. Make sure the email above is correct.');
                            identifierValid = true;
                        }
                    } catch (e) {
                        clearIdStatus();
                        identifierValid = false;
                    }
                } else if (activeIdXhr.status !== 0) {
                    clearIdStatus();
                    identifierValid = false;
                }
            };
            activeIdXhr.send('identifier=' + encodeURIComponent(val) + '&email=' + encodeURIComponent(emailVal));
        }

        identifierInput.addEventListener('input', function() {
            if (identifierDebounceTimer) clearTimeout(identifierDebounceTimer);
            lastIdentifierChecked = '';
            setIdStatus('is-checking', 'Checking…');
            identifierDebounceTimer = setTimeout(checkIdentifier, 450);
        });
        identifierInput.addEventListener('blur', function() {
            if (identifierDebounceTimer) clearTimeout(identifierDebounceTimer);
            checkIdentifier();
        });

        // When the email changes and we're in manual mode, re-verify the identifier
        // pairing so the "matches email" status stays accurate.
        emailInput.addEventListener('blur', function() {
            if (modeInput.value === 'manual' && (identifierInput.value || '').trim() !== '') {
                lastIdentifierChecked = '';
                checkIdentifier();
            }
        });

        // Client-side validation before submit
        var form = document.getElementById('resetPassword');
        form.addEventListener('submit', function(e) {
            // Block submit if the email is clearly not in the system
            if (!emailValid) {
                e.preventDefault();
                setStatus('is-error', '✗ This email is not registered in the system.');
                emailInput.focus();
                return;
            }
            if (modeInput.value !== 'manual') return;
            if (!identifierValid) {
                e.preventDefault();
                setIdStatus('is-error', '✗ Please enter a valid Username / Student ID that matches the email.');
                identifierInput.focus();
                return;
            }
            if (newPasswordInput.value.length < 8) {
                e.preventDefault();
                alert('New password must be at least 8 characters.');
                return;
            }
            if (newPasswordInput.value !== confirmPasswordInput.value) {
                e.preventDefault();
                alert('New password and confirmation do not match.');
            }
        });
    })();
</script>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('loginPassword');
        const toggleIcon = document.querySelector('#togglePassword i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>

</html>