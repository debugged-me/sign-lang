<!DOCTYPE html>
<html lang="en">

<head>
    <title>SignLearn – Sign In</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url(); ?>assets/images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --blue: #2563eb;
            --blue-dark: #1d4ed8;
            --blue-light: #eff6ff;
            --text: #111827;
            --text-muted: #6b7280;
            --border: #d1d5db;
            --bg: #f3f4f6;
            --white: #ffffff;
            --danger-bg: #fef2f2;
            --danger-text: #b91c1c;
            --success-bg: #f0fdf4;
            --success-text: #15803d;
            --radius: 12px;
        }

        html,
        body {
            height: 100%;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        /* ── PAGE LAYOUT ── */
        .page {
            display: flex;
            min-height: 100vh;
        }

        /* ── LEFT PANEL ── */
        .panel-left {
            flex: 1;
            background: url('<?= base_url("upload/banners/Payroll.jpg") ?>') center center / cover no-repeat;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 56px;
        }

        .panel-left::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(10, 20, 50, 0.82) 0%, rgba(10, 20, 50, 0.15) 55%);
        }

        .panel-left-content {
            position: relative;
            z-index: 1;
            color: var(--white);
        }

        .panel-left-content h1 {
            font-size: 36px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 14px;
        }

        .panel-left-content p {
            font-size: 16px;
            opacity: 0.75;
            max-width: 420px;
            line-height: 1.7;
        }

        /* ── RIGHT PANEL — wider ── */
        .panel-right {
            width: 560px;
            flex-shrink: 0;
            background: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 64px 60px;
            border-left: 1px solid var(--border);
        }

        /* ── LOGO ── */
        .logo-wrap {
            margin-bottom: 40px;
        }

        .logo-wrap img {
            height: 48px;
            width: auto;
            display: block;
        }

        /* ── HEADING ── */
        .form-heading {
            margin-bottom: 36px;
        }

        .form-heading h2 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
        }

        .form-heading p {
            font-size: 15px;
            color: var(--text-muted);
        }

        /* ── ALERTS ── */
        .alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 16px;
            border-radius: var(--radius);
            font-size: 14px;
            margin-bottom: 24px;
        }

        .alert-danger {
            background: var(--danger-bg);
            color: var(--danger-text);
        }

        .alert-success {
            background: var(--success-bg);
            color: var(--success-text);
        }

        .alert i {
            font-size: 15px;
            flex-shrink: 0;
        }

        /* ================================================================
           MATERIAL OUTLINE FLOATING LABEL
           The label lives inside the field at rest, then rises to sit
           exactly on the top border — splitting it — when focused or
           when the field has a value.

           How the "gap" in the border works:
           The input has a full border. The label gets a white background
           and is positioned so its vertical centre aligns with the top
           border (top: 0, transform: translateY(-50%)). The white bg
           of the label paints over the border line, creating the gap.
           ================================================================ */
        .form-group {
            position: relative;
            margin-bottom: 32px;
        }

        /* Input — flat padding, no top offset needed */
        .form-group input {
            width: 100%;
            height: 58px;
            padding: 0 52px 0 52px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            font-size: 16px;
            color: var(--text);
            background: var(--white);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input.has-toggle {
            padding-right: 52px;
        }

        .form-group input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        /* ── Label: default state (inside the field, vertically centred) ── */
        .form-group label {
            position: absolute;
            left: 46px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 15px;
            color: var(--text-muted);
            pointer-events: none;
            background: var(--white);
            padding: 0 6px;
            line-height: 1;
            transition:
                top 0.18s ease,
                font-size 0.18s ease,
                color 0.18s ease,
                transform 0.18s ease;
        }

        /* ── Label: floated state — sits on the top border, piercing it ── */
        .form-group input:focus~label,
        .form-group input:not(:placeholder-shown)~label {
            top: 0;
            transform: translateY(-50%);
            font-size: 12px;
            font-weight: 600;
            color: var(--blue);
            letter-spacing: 0.04em;
        }

        /* Left icon */
        .field-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 17px;
            color: var(--text-muted);
            pointer-events: none;
            transition: color 0.2s;
        }

        .form-group:focus-within .field-icon {
            color: var(--blue);
        }

        /* Password toggle button */
        .btn-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-muted);
            font-size: 16px;
            padding: 6px;
            line-height: 1;
            transition: color 0.15s;
        }

        .btn-toggle:hover {
            color: var(--text);
        }

        /* ── SUBMIT ── */
        .btn-primary {
            width: 100%;
            height: 54px;
            background: var(--blue);
            color: var(--white);
            border: none;
            border-radius: var(--radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            margin-top: 4px;
            letter-spacing: 0.01em;
        }

        .btn-primary:hover {
            background: var(--blue-dark);
        }

        .btn-primary:active {
            transform: scale(0.99);
        }

        /* ── FOOTER LINKS ── */
        .form-footer {
            margin-top: 28px;
            text-align: center;
        }

        .form-footer a {
            color: var(--blue);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .form-footer .sep {
            color: var(--border);
            margin: 0 10px;
        }

        /* ── HINT BOX ── */
        .hint-box {
            margin-top: 22px;
            padding: 12px 16px;
            background: var(--blue-light);
            border-radius: var(--radius);
            font-size: 13px;
            color: #1e40af;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .hint-box i {
            font-size: 14px;
            flex-shrink: 0;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .panel-left {
                display: none;
            }

            .panel-right {
                width: 100%;
                padding: 48px 32px;
            }
        }
    </style>
</head>

<body>

    <div class="page">

        <!-- LEFT: background image panel -->
        <div class="panel-left">
            <div class="panel-left-content">
                <h1>Learn Sign Language<br>Anywhere, Anytime</h1>
                <p>Build real communication skills with interactive lessons and step-by-step progress tracking.</p>
            </div>
        </div>

        <!-- RIGHT: login form -->
        <div class="panel-right">

            <div class="logo-wrap">
                <img src="<?= base_url('upload/banners/softtech_logo111.jpg') ?>" alt="SignLearn">
            </div>

            <div class="form-heading">
                <h2>Welcome back</h2>
                <p>Sign in to your account to continue</p>
            </div>

            <!-- Flash Messages -->
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?= $this->session->flashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <?= $this->session->flashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('Login/login') ?>" method="post">
                <input type="hidden" name="next" value="<?= html_escape($this->input->get('next')) ?>">

                <!--
                IMPORTANT: input must come BEFORE label in the markup.
                The CSS uses the ~ (general sibling) selector:
                  input:focus ~ label  →  only works when label comes AFTER input.
                placeholder=" " (a single space) is intentional — it makes
                :not(:placeholder-shown) fire correctly when the field has a value.
            -->

                <!-- Username -->
                <div class="form-group">
                    <input
                        type="text"
                        id="loginUsername"
                        name="username"
                        autocomplete="username"
                        placeholder=" "
                        required>
                    <label for="loginUsername">Username</label>
                    <i class="fa-regular fa-user field-icon"></i>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input
                        type="password"
                        id="loginPassword"
                        name="password"
                        class="has-toggle"
                        autocomplete="current-password"
                        placeholder=" "
                        required>
                    <label for="loginPassword">Password</label>
                    <i class="fa-solid fa-lock field-icon"></i>
                    <button type="button" class="btn-toggle" id="togglePassword" aria-label="Show password">
                        <i class="fa-regular fa-eye" id="toggleIcon"></i>
                    </button>
                </div>

                <button type="submit" class="btn-primary">Sign in</button>
            </form>

            <div class="form-footer">
                <a href="<?= base_url('Login/register') ?>">Create account</a>
                <span class="sep">|</span>
                <a href="<?= base_url('Login/demo') ?>">Try demo</a>
            </div>

            <div class="hint-box">
                <i class="fa-solid fa-circle-info"></i>
                Default credentials: <strong>admin</strong> / <strong>admin123</strong>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            var input = document.getElementById('loginPassword');
            var icon = document.getElementById('toggleIcon');
            var isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            icon.className = isHidden ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
            this.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
        });
    </script>

</body>

</html>