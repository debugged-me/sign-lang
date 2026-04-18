<head>
    <meta charset="utf-8" />
    <title>SignLearn - Filipino Sign Language Learning Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Interactive Filipino Sign Language Learning Platform" name="description" />
    <meta content="SignLearn" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.ico">

    <!-- DM Sans Font -->
    <style>
        @font-face {
            font-family: 'DM Sans';
            src: url('<?= base_url() ?>assets/fonts/DM_Sans/DMSans-Light.ttf');
            font-weight: 300;
            font-style: normal;
        }

        @font-face {
            font-family: 'DM Sans';
            src: url('<?= base_url() ?>assets/fonts/DM_Sans/DMSans-Regular.ttf');
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'DM Sans';
            src: url('<?= base_url() ?>assets/fonts/DM_Sans/DMSans-Medium.ttf');
            font-weight: 500;
            font-style: normal;
        }

        @font-face {
            font-family: 'DM Sans';
            src: url('<?= base_url() ?>assets/fonts/DM_Sans/DMSans-SemiBold.ttf');
            font-weight: 600;
            font-style: normal;
        }

        @font-face {
            font-family: 'DM Sans';
            src: url('<?= base_url() ?>assets/fonts/DM_Sans/DMSans-Bold.ttf');
            font-weight: 700;
            font-style: normal;
        }

        @font-face {
            font-family: 'DM Sans';
            src: url('<?= base_url() ?>assets/fonts/DM_Sans/DMSans-ExtraBold.ttf');
            font-weight: 800;
            font-style: normal;
        }

        :root {
            /* ============================================
       CORE PALETTE - calmer, clearer, more visual
       ============================================ */
            --sl-primary: #4F46E5;
            --sl-primary-light: #6366F1;
            --sl-primary-dark: #3730A3;

            --sl-secondary: #06B6D4;
            --sl-secondary-light: #67E8F9;
            --sl-secondary-dark: #0891B2;

            --sl-accent: #F59E0B;
            --sl-soft-accent: #FB7185;

            /* ============================================
       SURFACES
       ============================================ */
            --sl-bg: #EAEEF4;
            --sl-surface: #F8FAFC;
            --sl-muted-surface: #E2E8F0;
            --sl-soft-surface: #F1F5F9;
            --sl-border: #D1D5DB;

            /* ============================================
       TEXT
       ============================================ */
            --sl-text: #0F172A;
            --sl-body-text: #334155;
            --sl-text-muted: #475569;
            --sl-text-soft: #64748B;

            /* ============================================
       STATES
       ============================================ */
            --sl-success: #10B981;
            --sl-danger: #EF4444;
            --sl-info: #0EA5E9;
            --sl-warning: #F59E0B;

            /* ============================================
       RGB HELPERS FOR RGBA USAGE
       ============================================ */
            --sl-primary-rgb: 79, 70, 229;
            --sl-secondary-rgb: 6, 182, 212;
            --sl-accent-rgb: 245, 158, 11;
            --sl-soft-accent-rgb: 251, 113, 133;
            --sl-success-rgb: 16, 185, 129;
            --sl-danger-rgb: 239, 68, 68;
            --sl-text-rgb: 15, 23, 42;

            /* ============================================
       RADII
       ============================================ */
            --sl-radius: 20px;
            --sl-radius-sm: 14px;
            --sl-radius-lg: 28px;

            /* ============================================
       SHADOWS
       ============================================ */
            --sl-shadow: 0 4px 10px rgba(var(--sl-text-rgb), 0.05), 0 2px 4px rgba(var(--sl-text-rgb), 0.03);
            --sl-shadow-md: 0 12px 24px rgba(var(--sl-text-rgb), 0.08), 0 4px 8px rgba(var(--sl-text-rgb), 0.04);
            --sl-shadow-lg: 0 24px 48px rgba(var(--sl-text-rgb), 0.10), 0 8px 16px rgba(var(--sl-text-rgb), 0.05);

            /* ============================================
       TIMING
       ============================================ */
            --sl-transition-fast: 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            --sl-transition-base: 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            --sl-transition-slow: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif !important;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--sl-bg) !important;
            color: var(--sl-body-text) !important;
            font-weight: 400;
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ============================================
           ANIMATION KEYFRAMES
           ============================================ */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes progressPulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        @keyframes gentleBounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* ============================================
           MODERN CARD STYLES
           ============================================ */
        .sl-card {
            background: var(--sl-surface);
            border-radius: var(--sl-radius);
            border: 1px solid var(--sl-border);
            box-shadow: var(--sl-shadow);
            transition: transform var(--sl-transition-base), box-shadow var(--sl-transition-base);
            animation: fadeInUp 0.5s ease-out;
        }

        .sl-card:hover {
            box-shadow: var(--sl-shadow-lg);
            transform: translateY(-4px);
        }

        .sl-card-animated {
            animation: fadeInUp 0.6s ease-out backwards;
        }

        .sl-card-animated:nth-child(1) {
            animation-delay: 0.05s;
        }

        .sl-card-animated:nth-child(2) {
            animation-delay: 0.1s;
        }

        .sl-card-animated:nth-child(3) {
            animation-delay: 0.15s;
        }

        .sl-card-animated:nth-child(4) {
            animation-delay: 0.2s;
        }

        /* ============================================
           BUTTON STYLES
           ============================================ */
        .sl-btn {
            border-radius: 14px;
            font-weight: 600;
            padding: 14px 28px;
            transition: all var(--sl-transition-base);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            font-size: 0.9375rem;
        }

        .sl-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .sl-btn:hover::after {
            left: 100%;
        }

        .sl-btn:active {
            transform: scale(0.98);
        }

        .sl-btn-primary {
            background: linear-gradient(135deg, var(--sl-primary) 0%, var(--sl-primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
        }

        .sl-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.35);
            color: white;
        }

        .sl-btn-secondary {
            background: linear-gradient(135deg, var(--sl-secondary) 0%, #0D9488 100%);
            color: white;
            box-shadow: 0 4px 14px rgba(20, 184, 166, 0.25);
        }

        .sl-btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(20, 184, 166, 0.35);
            color: white;
        }

        .sl-btn-success {
            background: linear-gradient(135deg, var(--sl-success) 0%, #16A34A 100%);
            color: white;
            box-shadow: 0 4px 14px rgba(34, 197, 94, 0.25);
        }

        .sl-btn-accent {
            background: linear-gradient(135deg, var(--sl-accent) 0%, #D97706 100%);
            color: white;
            box-shadow: 0 4px 14px rgba(245, 158, 11, 0.25);
        }

        .sl-btn-outline {
            background: transparent;
            border: 2px solid var(--sl-border);
            color: var(--sl-body-text);
        }

        .sl-btn-outline:hover {
            border-color: var(--sl-primary);
            color: var(--sl-primary);
            background: rgba(37, 99, 235, 0.04);
        }

        .sl-btn-ghost {
            background: transparent;
            color: var(--sl-body-text);
        }

        .sl-btn-ghost:hover {
            background: var(--sl-muted-surface);
            color: var(--sl-primary);
        }

        /* ============================================
           SECTION HEADERS
           ============================================ */
        .sl-section-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--sl-text);
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }

        .sl-section-subtitle {
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--sl-primary);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ============================================
           STATS CARDS
           ============================================ */
        .sl-stat-card {
            background: var(--sl-surface);
            border-radius: var(--sl-radius);
            padding: 28px;
            border: 1px solid var(--sl-border);
            position: relative;
            overflow: hidden;
            transition: all var(--sl-transition-base);
        }

        .sl-stat-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--sl-shadow-md);
        }

        .sl-stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .sl-stat-card.primary::before {
            background: linear-gradient(90deg, var(--sl-primary), var(--sl-primary-light));
        }

        .sl-stat-card.secondary::before {
            background: linear-gradient(90deg, var(--sl-secondary), #2DD4BF);
        }

        .sl-stat-card.accent::before {
            background: linear-gradient(90deg, var(--sl-accent), #FBBF24);
        }

        .sl-stat-card.success::before {
            background: linear-gradient(90deg, var(--sl-success), #4ADE80);
        }

        .sl-stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 20px;
            transition: transform var(--sl-transition-base);
        }

        .sl-stat-card:hover .sl-stat-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        .sl-stat-icon.primary {
            background: rgba(var(--sl-primary-rgb), 0.10);
            color: var(--sl-primary);
        }

        .sl-stat-icon.secondary {
            background: rgba(var(--sl-secondary-rgb), 0.10);
            color: var(--sl-secondary);
        }

        .sl-stat-icon.accent {
            background: rgba(var(--sl-accent-rgb), 0.10);
            color: var(--sl-accent);
        }

        .sl-stat-icon.success {
            background: rgba(var(--sl-success-rgb), 0.10);
            color: var(--sl-success);
        }

        .sl-stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--sl-text);
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .sl-stat-label {
            font-size: 0.9375rem;
            color: var(--sl-text-muted);
            font-weight: 500;
            margin-top: 8px;
        }

        /* ============================================
           PROGRESS BARS
           ============================================ */
        .sl-progress {
            height: 10px;
            background: var(--sl-border);
            border-radius: 100px;
            overflow: hidden;
            position: relative;
        }

        .sl-progress-bar {
            height: 100%;
            border-radius: 100px;
            transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(90deg, var(--sl-primary), var(--sl-primary-light));
            position: relative;
            overflow: hidden;
        }

        .sl-progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        .sl-progress-bar.animated {
            animation: progressPulse 2s ease-in-out infinite;
        }

        /* ============================================
           SIGN CARDS - Enhanced for visual learning
           ============================================ */
        .sl-sign-card {
            background: var(--sl-surface);
            border-radius: var(--sl-radius-sm);
            border: 1px solid var(--sl-border);
            padding: 20px;
            text-align: center;
            transition: all var(--sl-transition-base);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .sl-sign-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--sl-primary), var(--sl-secondary));
            transform: scaleX(0);
            transition: transform var(--sl-transition-base);
        }

        .sl-sign-card:hover {
            border-color: var(--sl-primary);
            box-shadow: var(--sl-shadow-md);
            transform: translateY(-6px);
        }

        .sl-sign-card:hover::before {
            transform: scaleX(1);
        }

        .sl-sign-preview {
            width: 100%;
            height: 160px;
            border-radius: var(--sl-radius-sm);
            background: linear-gradient(135deg, var(--sl-muted-surface) 0%, var(--sl-bg) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            overflow: hidden;
            transition: all var(--sl-transition-base);
            border: 2px solid transparent;
        }

        .sl-sign-card:hover .sl-sign-preview {
            border-color: rgba(37, 99, 235, 0.2);
            background: linear-gradient(135deg, #EFF6FF 0%, var(--sl-muted-surface) 100%);
        }

        .sl-sign-preview img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            transition: transform var(--sl-transition-base);
        }

        .sl-sign-card:hover .sl-sign-preview img {
            transform: scale(1.08);
        }

        .sl-sign-name {
            font-weight: 700;
            font-size: 1.0625rem;
            color: var(--sl-text);
            margin-bottom: 6px;
            letter-spacing: -0.01em;
        }

        .sl-sign-type {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--sl-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* ============================================
           BADGES
           ============================================ */
        .sl-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            transition: all var(--sl-transition-fast);
        }

        .sl-badge:hover {
            transform: scale(1.05);
        }

        .sl-badge-beginner {
            background: rgba(var(--sl-success-rgb), 0.12);
            color: var(--sl-success);
        }

        .sl-badge-intermediate {
            background: rgba(var(--sl-accent-rgb), 0.12);
            color: var(--sl-accent);
        }

        .sl-badge-advanced {
            background: rgba(var(--sl-soft-accent-rgb), 0.12);
            color: var(--sl-soft-accent);
        }

        .sl-badge-mastered {
            background: rgba(34, 197, 94, 0.18);
            color: #15803D;
        }

        /* ============================================
           NAVIGATION
           ============================================ */
        .content-page {
            margin-left: 280px;
            overflow: hidden;
            background: var(--sl-bg) !important;
            min-height: 100vh;
        }

        .content {
            padding: 32px 24px !important;
        }

        /* Page Header */
        .sl-page-header {
            margin-bottom: 40px;
            animation: fadeInUp 0.5s ease-out;
        }

        .sl-page-title {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--sl-text);
            margin-bottom: 12px;
            letter-spacing: -0.03em;
            line-height: 1.2;
        }

        .sl-page-subtitle {
            color: var(--sl-text-muted);
            font-size: 1.0625rem;
            font-weight: 500;
        }

        /* Sidebar Base */
        .left-side-menu {
            background: var(--sl-surface) !important;
            border-right: 1px solid var(--sl-border);
            width: 260px;
        }

        #sidebar-menu>ul>li>a {
            padding: 12px 24px;
            font-weight: 500;
            color: var(--sl-body-text);
            border-radius: 0 10px 10px 0;
            margin: 2px 12px 2px 0;
            transition: all var(--sl-transition-base);
            display: flex;
            align-items: center;
            font-size: 0.9375rem;
            position: relative;
        }

        #sidebar-menu>ul>li>a:hover {
            background: transparent;
            color: var(--sl-primary);
        }

        #sidebar-menu>ul>li.active>a {
            background: rgba(var(--sl-primary-rgb), 0.08);
            color: var(--sl-primary);
            font-weight: 600;
        }

        #sidebar-menu>ul>li>a i {
            font-size: 1.25rem;
            margin-right: 14px;
            color: var(--sl-text-soft);
            transition: all var(--sl-transition-base);
        }

        #sidebar-menu>ul>li>a:hover i,
        #sidebar-menu>ul>li.active>a i {
            color: var(--sl-primary);
        }

        /* ============================================
           MINIMAL SIDEBAR
           ============================================ */
        .fsl-sidebar .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid var(--sl-border);
        }

        .sidebar-logo {
            max-width: 140px;
            max-height: 60px;
            width: auto;
            height: auto;
            object-fit: contain;
            transition: transform var(--sl-transition-base);
        }

        .sidebar-logo:hover {
            transform: scale(1.02);
        }

        /* ============================================
           FOOTER
           ============================================ */
        .footer {
            background: linear-gradient(135deg, var(--sl-primary) 0%, var(--sl-primary-dark) 100%);
            padding: 16px 0;
            margin-top: auto;
        }

        .footer-content {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
        }

        .footer-logo-img {
            max-height: 28px;
            width: auto;
            filter: brightness(0) invert(1);
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
            font-weight: 500;
            margin: 0;
        }

        .footer-copy {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.75rem;
            margin: 0;
        }

        .menu-divider {
            height: 1px;
            background: var(--sl-border);
            margin: 12px 24px;
        }

        /* Fix menu arrow - replace burger with chevron */
        #sidebar-menu .menu-arrow {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            display: inline-block;
            font-family: 'Material Design Icons';
            font-size: 1rem;
            color: var(--sl-text-soft);
            transition: transform 0.2s ease;
            width: auto;
            height: auto;
            background: none;
            border: none;
            box-shadow: none;
        }

        #sidebar-menu .menu-arrow:before {
            content: '\F0140';
            /* mdi-chevron-down */
        }

        #sidebar-menu [aria-expanded="true"]>a>.menu-arrow {
            transform: translateY(-50%) rotate(180deg);
        }

        /* Topbar */
        .navbar-custom {
            background: var(--sl-surface) !important;
            border-bottom: 1px solid var(--sl-border);
            box-shadow: var(--sl-shadow);
        }

        .nav-user {
            padding: 10px 18px;
            border-radius: 14px;
            background: var(--sl-bg);
            border: 1px solid var(--sl-border);
            transition: all var(--sl-transition-base);
        }

        .nav-user:hover {
            border-color: var(--sl-primary);
            box-shadow: var(--sl-shadow);
        }

        /* ============================================
           TABLES
           ============================================ */
        .sl-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .sl-table th {
            background: var(--sl-bg);
            padding: 18px 20px;
            font-weight: 700;
            font-size: 0.6875rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--sl-text-muted);
            border-bottom: 2px solid var(--sl-border);
        }

        .sl-table td {
            padding: 18px 20px;
            border-bottom: 1px solid var(--sl-border);
            vertical-align: middle;
            color: var(--sl-body-text);
        }

        .sl-table tr {
            transition: all var(--sl-transition-fast);
        }

        .sl-table tr:hover td {
            background: var(--sl-muted-surface);
            transform: scale(1.005);
        }

        /* ============================================
           LESSON CARDS
           ============================================ */
        .sl-lesson-card {
            background: var(--sl-surface);
            border-radius: var(--sl-radius);
            border: 1px solid var(--sl-border);
            overflow: hidden;
            transition: all var(--sl-transition-base);
            animation: fadeInUp 0.5s ease-out backwards;
        }

        .sl-lesson-card:hover {
            box-shadow: var(--sl-shadow-md);
            transform: translateY(-6px);
            border-color: rgba(37, 99, 235, 0.2);
        }

        .sl-lesson-header {
            padding: 28px;
            border-bottom: 1px solid var(--sl-border);
        }

        .sl-lesson-body {
            padding: 28px;
        }

        .sl-lesson-footer {
            padding: 20px 28px;
            background: var(--sl-muted-surface);
            border-top: 1px solid var(--sl-border);
        }

        /* ============================================
           FILTER BUTTONS
           ============================================ */
        .sl-filter-group {
            display: inline-flex;
            background: var(--sl-bg);
            border-radius: 14px;
            padding: 5px;
            border: 1px solid var(--sl-border);
        }

        .sl-filter-btn {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--sl-text-muted);
            transition: all var(--sl-transition-fast);
            border: none;
            background: transparent;
        }

        .sl-filter-btn.active,
        .sl-filter-btn:hover {
            background: var(--sl-surface);
            color: var(--sl-primary);
            box-shadow: var(--sl-shadow);
        }

        .sl-filter-btn.active {
            background: var(--sl-primary);
            color: white;
        }

        /* ============================================
           PRACTICE/QUIZ INTERFACE
           ============================================ */
        .sl-practice-card {
            background: var(--sl-surface);
            border-radius: var(--sl-radius);
            border: 1px solid var(--sl-border);
            padding: 40px;
            animation: fadeInUp 0.6s ease-out;
        }

        .sl-camera-container {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
            border-radius: var(--sl-radius);
            aspect-ratio: 4/3;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            box-shadow: inset 0 0 40px rgba(0, 0, 0, 0.3);
        }

        .sl-sign-display {
            background: linear-gradient(135deg, var(--sl-muted-surface) 0%, var(--sl-bg) 100%);
            border-radius: var(--sl-radius);
            aspect-ratio: 4/3;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 2px solid var(--sl-border);
        }

        /* ============================================
           ACHIEVEMENT CARDS
           ============================================ */
        .sl-achievement {
            background: var(--sl-surface);
            border-radius: var(--sl-radius-sm);
            padding: 28px;
            text-align: center;
            border: 1px solid var(--sl-border);
            transition: all var(--sl-transition-base);
        }

        .sl-achievement:hover {
            transform: translateY(-4px);
            box-shadow: var(--sl-shadow-md);
        }

        .sl-achievement-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
            animation: float 3s ease-in-out infinite;
        }

        /* ============================================
           EMPTY STATES
           ============================================ */
        .sl-empty-state {
            text-align: center;
            padding: 80px 32px;
            animation: fadeInUp 0.5s ease-out;
        }

        .sl-empty-state i {
            font-size: 72px;
            color: var(--sl-border);
            margin-bottom: 28px;
            animation: gentleBounce 2s ease-in-out infinite;
        }

        /* ============================================
           HERO SECTIONS
           ============================================ */
        .sl-hero {
            background: linear-gradient(135deg, var(--sl-primary) 0%, var(--sl-primary-light) 45%, var(--sl-secondary) 100%);
            background-size: 200% 200%;
            animation: gradientShift 8s ease infinite;
            border-radius: var(--sl-radius);
            padding: 48px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .sl-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        /* ============================================
           FLOATING ACCENTS
           ============================================ */
        .sl-float-accent {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, var(--sl-accent) 0%, transparent 70%);
            opacity: 0.1;
            filter: blur(40px);
            animation: float 8s ease-in-out infinite;
        }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 768px) {
            .content-page {
                margin-left: 0;
            }

            .sl-page-title {
                font-size: 1.75rem;
            }

            .sl-stat-value {
                font-size: 2rem;
            }

            .sl-practice-card {
                padding: 24px;
            }
        }
    </style>

    <!-- Plugins css-->
    <link href="<?= base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/libs/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

    <!-- third party css -->
    <link href="<?= base_url(); ?>assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
</head>