<head>
    <meta charset="utf-8" />
    <title>SignLearn - Filipino Sign Language Learning Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Interactive Filipino Sign Language Learning Platform" name="description" />
    <meta content="SignLearn" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.ico">

    <!-- Echo Flow: Plus Jakarta Sans + Manrope + Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">

    <style>
        /* ============================================
           ECHO FLOW — KINETIC EDITORIAL DESIGN SYSTEM
           FSL Learning Platform
           ============================================ */
        :root {
            /* Core Palette */
            --sl-primary: #0E7490;          /* Cyan 700 - focus, depth */
            --sl-primary-light: #0891B2;    /* Cyan 600 */
            --sl-primary-dark: #155E75;     /* Cyan 800 - deep anchor */

            --sl-secondary: #155E75;        /* Cyan 800 */
            --sl-secondary-light: #0891B2;
            --sl-secondary-dark: #0C4A6E;

            --sl-accent: #22D3EE;           /* Cyan 400 - highlights */
            --sl-accent-soft: #67E8F9;      /* Cyan 300 */
            --sl-soft-accent: #22D3EE;

            /* Surfaces — Slate 50 base, tonal layering (no borders) */
            --sl-bg: #F8FAFC;               /* Slate 50 */
            --sl-surface: #FFFFFF;          /* Card surface */
            --sl-surface-low: #F1F5F9;      /* Slate 100 tonal */
            --sl-muted-surface: #F1F5F9;
            --sl-soft-surface: #F8FAFC;
            --sl-surface-high: #E2E8F0;     /* Slate 200 */
            --sl-border: rgba(14, 116, 144, 0.08); /* ghost-border only */

            /* Text */
            --sl-text: #0F172A;             /* Slate 900 */
            --sl-body-text: #334155;        /* Slate 700 */
            --sl-text-muted: #64748B;       /* Slate 500 */
            --sl-text-soft: #94A3B8;        /* Slate 400 */

            /* States */
            --sl-success: #10B981;
            --sl-danger: #EF4444;           /* Echo Flow alert red */
            --sl-info: #22D3EE;
            --sl-warning: #F59E0B;

            /* RGB helpers */
            --sl-primary-rgb: 14, 116, 144;
            --sl-secondary-rgb: 21, 94, 117;
            --sl-accent-rgb: 34, 211, 238;
            --sl-soft-accent-rgb: 34, 211, 238;
            --sl-success-rgb: 16, 185, 129;
            --sl-danger-rgb: 239, 68, 68;
            --sl-text-rgb: 15, 23, 42;

            /* Roundness — ROUND_EIGHT */
            --sl-radius: 1rem;              /* 16px - cards & primary */
            --sl-radius-sm: 0.75rem;        /* 12px */
            --sl-radius-lg: 1.5rem;         /* 24px - hero / bento */
            --sl-radius-xl: 2rem;           /* 32px - feature containers */
            --sl-radius-full: 9999px;

            /* Kinetic Shadows — soft, multi-layered, cyan-tinted */
            --sl-shadow: 0 4px 14px rgba(14, 116, 144, 0.04), 0 2px 4px rgba(14, 116, 144, 0.03);
            --sl-shadow-md: 0 12px 28px rgba(14, 116, 144, 0.06), 0 4px 10px rgba(14, 116, 144, 0.04);
            --sl-shadow-lg: 0 20px 40px rgba(14, 116, 144, 0.06);
            --sl-shadow-glow: 0 8px 24px rgba(14, 116, 144, 0.18);

            /* Motion */
            --sl-transition-fast: 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            --sl-transition-base: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --sl-transition-slow: 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Global font — Plus Jakarta Sans per project rule */
        * {
            font-family: 'Plus Jakarta Sans', 'Manrope', -apple-system, BlinkMacSystemFont, sans-serif !important;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--sl-bg) !important;
            color: var(--sl-body-text) !important;
            font-weight: 400;
            line-height: 1.65;
            letter-spacing: -0.005em;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--sl-text);
        }

        .material-symbols-rounded,
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        /* ============================================
           MOTION KEYFRAMES
           ============================================ */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes gentlePulse {
            0%, 100% { transform: scale(1); box-shadow: 0 8px 24px rgba(14, 116, 144, 0.18); }
            50% { transform: scale(1.03); box-shadow: 0 12px 32px rgba(14, 116, 144, 0.28); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes gentleBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }
        /* backwards-compat aliases */
        @keyframes pulse { 0%,100%{transform:scale(1);} 50%{transform:scale(1.03);} }
        @keyframes progressPulse { 0%,100%{opacity:1;} 50%{opacity:0.75;} }
        @keyframes slideInRight { from{opacity:0;transform:translateX(30px);} to{opacity:1;transform:translateX(0);} }
        @keyframes gradientShift { 0%{background-position:0% 50%;} 50%{background-position:100% 50%;} 100%{background-position:0% 50%;} }

        /* ============================================
           CARDS — tonal shift, no hard borders
           ============================================ */
        .sl-card {
            background: var(--sl-surface);
            border-radius: var(--sl-radius);
            border: none;
            box-shadow: var(--sl-shadow-lg);
            transition: transform var(--sl-transition-base), box-shadow var(--sl-transition-base);
            animation: fadeInUp 0.5s ease-out;
        }
        .sl-card:hover {
            box-shadow: 0 28px 50px rgba(14, 116, 144, 0.09);
            transform: translateY(-4px);
        }
        .sl-card-animated { animation: fadeInUp 0.6s ease-out backwards; }
        .sl-card-animated:nth-child(1) { animation-delay: 0.05s; }
        .sl-card-animated:nth-child(2) { animation-delay: 0.10s; }
        .sl-card-animated:nth-child(3) { animation-delay: 0.15s; }
        .sl-card-animated:nth-child(4) { animation-delay: 0.20s; }

        /* ============================================
           BUTTONS — pill-shaped primary, kinetic
           ============================================ */
        .sl-btn {
            border-radius: var(--sl-radius-full);
            font-weight: 600;
            padding: 12px 26px;
            transition: all var(--sl-transition-base);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            font-size: 0.9375rem;
            letter-spacing: -0.005em;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }
        .sl-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
            transition: left 0.6s;
        }
        .sl-btn:hover::after { left: 100%; }
        .sl-btn:active { transform: scale(0.97); }

        .sl-btn-primary {
            background: linear-gradient(135deg, var(--sl-primary) 0%, var(--sl-primary-dark) 100%);
            color: #fff;
            box-shadow: 0 6px 18px rgba(14, 116, 144, 0.22);
        }
        .sl-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(14, 116, 144, 0.32);
            color: #fff;
        }

        .sl-btn-secondary {
            background: linear-gradient(135deg, var(--sl-primary-dark) 0%, #0C4A6E 100%);
            color: #fff;
            box-shadow: 0 6px 18px rgba(21, 94, 117, 0.22);
        }
        .sl-btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(21, 94, 117, 0.32);
            color: #fff;
        }

        .sl-btn-success {
            background: linear-gradient(135deg, var(--sl-success) 0%, #059669 100%);
            color: #fff;
            box-shadow: 0 6px 18px rgba(16, 185, 129, 0.22);
        }
        .sl-btn-success:hover { transform: translateY(-2px); color: #fff; }

        .sl-btn-accent {
            background: linear-gradient(135deg, var(--sl-accent) 0%, var(--sl-primary-light) 100%);
            color: var(--sl-secondary-dark);
            box-shadow: 0 6px 18px rgba(34, 211, 238, 0.28);
        }
        .sl-btn-accent:hover { transform: translateY(-2px); color: var(--sl-secondary-dark); }

        .sl-btn-outline {
            background: rgba(14, 116, 144, 0.06);
            color: var(--sl-primary);
        }
        .sl-btn-outline:hover {
            background: rgba(14, 116, 144, 0.12);
            color: var(--sl-primary-dark);
        }

        .sl-btn-ghost {
            background: transparent;
            color: var(--sl-body-text);
        }
        .sl-btn-ghost:hover {
            background: rgba(14, 116, 144, 0.06);
            color: var(--sl-primary);
        }

        /* Practice pulse — encourage action without distraction */
        .sl-btn-pulse {
            animation: gentlePulse 2.6s ease-in-out infinite;
        }

        /* ============================================
           SECTION HEADERS
           ============================================ */
        .sl-section-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--sl-text);
            margin-bottom: 1.25rem;
            letter-spacing: -0.02em;
        }
        .sl-section-subtitle {
            font-family: 'Manrope', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--sl-primary);
            text-transform: uppercase;
            letter-spacing: 0.14em;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ============================================
           STAT CARDS
           ============================================ */
        .sl-stat-card {
            background: var(--sl-surface);
            border-radius: var(--sl-radius-lg);
            padding: 26px;
            border: none;
            box-shadow: var(--sl-shadow-lg);
            position: relative;
            overflow: hidden;
            transition: all var(--sl-transition-base);
        }
        .sl-stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 28px 50px rgba(14, 116, 144, 0.10);
        }
        .sl-stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            opacity: 0.85;
        }
        .sl-stat-card.primary::before  { background: linear-gradient(90deg, var(--sl-primary), var(--sl-accent)); }
        .sl-stat-card.secondary::before { background: linear-gradient(90deg, var(--sl-primary-dark), var(--sl-primary-light)); }
        .sl-stat-card.accent::before   { background: linear-gradient(90deg, var(--sl-accent), var(--sl-primary-light)); }
        .sl-stat-card.success::before  { background: linear-gradient(90deg, var(--sl-success), #34D399); }

        .sl-stat-icon {
            width: 56px;
            height: 56px;
            border-radius: var(--sl-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 18px;
            transition: transform var(--sl-transition-base);
        }
        .sl-stat-card:hover .sl-stat-icon {
            transform: scale(1.08) rotate(-4deg);
        }
        .sl-stat-icon.primary   { background: rgba(14, 116, 144, 0.10);  color: var(--sl-primary); }
        .sl-stat-icon.secondary { background: rgba(21, 94, 117, 0.10);   color: var(--sl-primary-dark); }
        .sl-stat-icon.accent    { background: rgba(34, 211, 238, 0.16);  color: var(--sl-primary); }
        .sl-stat-icon.success   { background: rgba(16, 185, 129, 0.12);  color: var(--sl-success); }

        .sl-stat-value {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--sl-text);
            line-height: 1;
            letter-spacing: -0.03em;
        }
        .sl-stat-label {
            font-family: 'Manrope', sans-serif;
            font-size: 0.875rem;
            color: var(--sl-text-muted);
            font-weight: 500;
            margin-top: 8px;
        }

        /* ============================================
           PROGRESS BARS — animated cyan gradient
           ============================================ */
        .sl-progress {
            height: 10px;
            background: var(--sl-surface-high);
            border-radius: var(--sl-radius-full);
            overflow: hidden;
            position: relative;
        }
        .sl-progress-bar {
            height: 100%;
            border-radius: var(--sl-radius-full);
            transition: width 0.9s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(90deg, var(--sl-primary) 0%, var(--sl-primary-light) 50%, var(--sl-accent) 100%);
            background-size: 200% 100%;
            animation: gradientFlow 4s ease infinite;
            position: relative;
            overflow: hidden;
        }
        .sl-progress-bar::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.35), transparent);
            animation: shimmer 2.2s infinite;
        }

        /* ============================================
           SIGN CARDS
           ============================================ */
        .sl-sign-card {
            background: var(--sl-surface);
            border-radius: var(--sl-radius);
            border: none;
            box-shadow: var(--sl-shadow);
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
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--sl-primary), var(--sl-accent));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform var(--sl-transition-base);
        }
        .sl-sign-card:hover {
            box-shadow: var(--sl-shadow-lg);
            transform: translateY(-4px);
        }
        .sl-sign-card:hover::before { transform: scaleX(1); }

        .sl-sign-preview {
            width: 100%;
            height: 160px;
            border-radius: var(--sl-radius-sm);
            background: linear-gradient(135deg, var(--sl-surface-low) 0%, var(--sl-bg) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            overflow: hidden;
            transition: all var(--sl-transition-base);
        }
        .sl-sign-card:hover .sl-sign-preview {
            background: linear-gradient(135deg, #ECFEFF 0%, var(--sl-surface-low) 100%);
        }
        .sl-sign-preview img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sl-sign-card:hover .sl-sign-preview img { transform: scale(1.1); }

        .sl-sign-name {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 1.0625rem;
            color: var(--sl-text);
            margin-bottom: 6px;
            letter-spacing: -0.015em;
        }
        .sl-sign-type {
            font-family: 'Manrope', sans-serif;
            font-size: 0.6875rem;
            font-weight: 700;
            color: var(--sl-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }

        /* ============================================
           BADGES — rounded pill
           ============================================ */
        .sl-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: var(--sl-radius-full);
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: all var(--sl-transition-fast);
            font-family: 'Manrope', sans-serif;
        }
        .sl-badge:hover { transform: scale(1.04); }
        .sl-badge-beginner     { background: rgba(16, 185, 129, 0.14); color: #047857; }
        .sl-badge-intermediate { background: rgba(34, 211, 238, 0.18); color: var(--sl-primary-dark); }
        .sl-badge-advanced     { background: rgba(14, 116, 144, 0.14); color: var(--sl-primary-dark); }
        .sl-badge-mastered     { background: rgba(14, 116, 144, 0.18); color: var(--sl-primary-dark); }

        /* ============================================
           LAYOUT — sidebar + content
           ============================================ */
        .content-page {
            margin-left: 260px;
            overflow: hidden;
            background: var(--sl-bg) !important;
            min-height: 100vh;
            transition: margin-left var(--sl-transition-base);
        }
        .content {
            padding: 28px 28px !important;
        }

        /* Page Header */
        .sl-page-header {
            margin-bottom: 36px;
            animation: fadeInUp 0.5s ease-out;
        }
        .sl-page-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--sl-text);
            margin-bottom: 10px;
            letter-spacing: -0.03em;
            line-height: 1.15;
        }
        .sl-page-subtitle {
            color: var(--sl-text-muted);
            font-size: 1rem;
            font-weight: 500;
            font-family: 'Manrope', sans-serif;
        }

        /* ============================================
           SIDEBAR — Echo Flow docked, rounded, tonal shift
           ============================================ */
        .left-side-menu {
            background: var(--sl-surface) !important;
            border-right: none !important;
            width: 260px;
            padding: 0;
            box-shadow: 10px 0 30px rgba(14, 116, 144, 0.04);
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1001;
            overflow: hidden;
        }
        .left-side-menu .slimscroll-menu {
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            padding-bottom: 24px;
        }
        .fsl-sidebar .sidebar-brand {
            padding: 22px 24px 14px;
            border-bottom: none !important;
            position: sticky;
            top: 0;
            background: var(--sl-surface);
            z-index: 2;
        }
        .fsl-sidebar .sidebar-brand h1 { line-height: 1.1; }

        #sidebar-menu { padding-top: 6px; }
        #sidebar-menu > ul { padding: 0 14px; margin: 0; list-style: none; }
        #sidebar-menu > ul > li { list-style: none; }
        #sidebar-menu > ul > li > a {
            padding: 11px 16px;
            font-family: 'Manrope', sans-serif;
            font-weight: 500;
            font-size: 0.9125rem;
            color: var(--sl-text-muted);
            border-radius: var(--sl-radius-full);
            margin: 2px 0;
            transition: background var(--sl-transition-base), color var(--sl-transition-base), box-shadow var(--sl-transition-base);
            display: flex;
            align-items: center;
            position: relative;
            text-decoration: none;
        }
        #sidebar-menu > ul > li > a:hover {
            background: rgba(14, 116, 144, 0.06);
            color: var(--sl-primary);
        }
        #sidebar-menu > ul > li.active > a,
        #sidebar-menu > ul > li > a.active {
            background: linear-gradient(135deg, var(--sl-primary) 0%, var(--sl-primary-dark) 100%);
            color: #fff !important;
            font-weight: 600;
            box-shadow: 0 8px 20px rgba(14, 116, 144, 0.28);
        }
        #sidebar-menu > ul > li > a i {
            font-size: 1.2rem;
            margin-right: 12px;
            color: var(--sl-text-soft);
            transition: color var(--sl-transition-base);
            width: 22px;
            text-align: center;
        }
        #sidebar-menu > ul > li > a:hover i,
        #sidebar-menu > ul > li.active > a i { color: inherit; }
        #sidebar-menu > ul > li.active > a i { color: #fff; }

        /* Second-level nav */
        .nav-second-level {
            list-style: none;
            padding: 4px 0 6px 38px;
            margin: 0;
        }
        .nav-second-level li a {
            display: block;
            padding: 7px 14px;
            font-family: 'Manrope', sans-serif;
            font-size: 0.8625rem;
            color: var(--sl-text-muted);
            border-radius: var(--sl-radius-full);
            margin: 1px 0;
            transition: all var(--sl-transition-base);
            text-decoration: none;
        }
        .nav-second-level li a:hover {
            background: rgba(14, 116, 144, 0.06);
            color: var(--sl-primary);
        }

        .menu-divider {
            height: 1px;
            background: rgba(14, 116, 144, 0.08);
            margin: 10px 18px;
            list-style: none;
            padding: 0 !important;
        }
        .menu-divider > a { display: none; }

        /* Chevron arrow */
        #sidebar-menu .menu-arrow {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            display: inline-block;
            font-family: 'Material Design Icons';
            font-size: 1rem;
            color: var(--sl-text-soft);
            transition: transform 0.25s ease;
            width: auto;
            height: auto;
            background: none;
            border: none;
            box-shadow: none;
            margin-right: 0 !important;
        }
        #sidebar-menu .menu-arrow:before { content: '\F0140'; }
        #sidebar-menu [aria-expanded="true"] > a > .menu-arrow {
            transform: translateY(-50%) rotate(180deg);
        }

        /* ============================================
           TOPBAR — floating minimalist (no logo; sidebar owns brand)
           ============================================ */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: none !important;
            box-shadow: 0 1px 0 rgba(14, 116, 144, 0.05);
            padding: 0 16px;
            height: 70px;
            margin-left: 260px; /* sit beside the docked sidebar */
            min-height: 70px;
        }
        /* Logo-box removed from topbar — hide any residual theme markup */
        .logo-box { display: none !important; }

        .app-search .form-control {
            background: var(--sl-surface-low) !important;
            border: none !important;
            border-radius: var(--sl-radius-full) !important;
            padding: 10px 18px 10px 42px !important;
            height: 42px !important;
            font-family: 'Manrope', sans-serif;
            font-size: 0.9rem;
            color: var(--sl-text);
            transition: all var(--sl-transition-base);
            width: 260px;
        }
        .app-search .form-control:focus {
            background: var(--sl-surface) !important;
            box-shadow: 0 0 0 4px rgba(14, 116, 144, 0.12) !important;
            outline: none;
        }
        .app-search-box { position: relative; }
        .app-search-box .input-group-append {
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
        }
        .app-search-box .input-group-append .btn {
            background: transparent !important;
            border: none !important;
            color: var(--sl-text-muted);
            padding: 6px 8px;
        }

        .button-menu-mobile {
            background: transparent !important;
            border: none !important;
            color: var(--sl-primary) !important;
            width: 42px;
            height: 42px;
            border-radius: var(--sl-radius-full);
            transition: all var(--sl-transition-base);
        }
        .button-menu-mobile:hover {
            background: rgba(14, 116, 144, 0.08) !important;
        }

        .nav-user {
            padding: 5px 16px 5px 5px !important;
            border-radius: var(--sl-radius-full) !important;
            background: var(--sl-surface-low) !important;
            border: none !important;
            transition: all var(--sl-transition-base);
            display: inline-flex !important;
            align-items: center;
            gap: 10px;
            max-width: none !important;
        }
        .nav-user:hover {
            background: rgba(14, 116, 144, 0.08) !important;
            box-shadow: var(--sl-shadow);
        }
        .nav-user img {
            width: 34px;
            height: 34px;
            object-fit: cover;
            border: 2px solid rgba(14, 116, 144, 0.15);
            flex-shrink: 0;
        }
        .pro-user-name {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 600;
            color: var(--sl-text);
            font-size: 0.9rem;
            display: inline-block;
            max-width: none !important;
            width: auto !important;
            overflow: visible !important;
            text-overflow: unset !important;
            white-space: nowrap;
            line-height: 1.2;
        }
        .pro-user-chevron {
            color: var(--sl-text-muted);
            font-size: 1rem;
            line-height: 1;
        }

        .topnav-menu .nav-link {
            color: var(--sl-primary) !important;
            border-radius: var(--sl-radius-full);
            width: 42px;
            height: 42px;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            transition: all var(--sl-transition-base);
            margin: 0 2px;
        }
        .topnav-menu .nav-link:hover {
            background: rgba(14, 116, 144, 0.08);
        }

        .noti-icon-badge {
            background: var(--sl-danger) !important;
            color: #fff !important;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            font-family: 'Manrope', sans-serif;
        }

        .dropdown-menu {
            border: none !important;
            border-radius: var(--sl-radius) !important;
            box-shadow: var(--sl-shadow-lg) !important;
            padding: 8px !important;
            background: var(--sl-surface) !important;
        }
        .dropdown-menu .dropdown-item {
            border-radius: var(--sl-radius-sm) !important;
            padding: 10px 14px !important;
            font-family: 'Manrope', sans-serif;
            font-size: 0.9rem;
            color: var(--sl-body-text);
            transition: all var(--sl-transition-fast);
        }
        .dropdown-menu .dropdown-item:hover {
            background: rgba(14, 116, 144, 0.08) !important;
            color: var(--sl-primary) !important;
        }
        .dropdown-divider {
            border-top: 1px solid rgba(14, 116, 144, 0.08) !important;
            margin: 6px 4px !important;
        }

        /* ============================================
           FOOTER
           ============================================ */
        .footer {
            background: linear-gradient(135deg, var(--sl-primary) 0%, var(--sl-primary-dark) 100%);
            padding: 18px 0;
            margin-top: auto;
            border-top-left-radius: var(--sl-radius-lg);
            border-top-right-radius: var(--sl-radius-lg);
        }
        .footer-content {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        .footer-logo-img {
            max-height: 28px;
            width: auto;
            filter: brightness(0) invert(1);
        }
        .footer-text {
            color: rgba(255, 255, 255, 0.95);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: -0.005em;
            margin: 0;
        }
        .footer-copy {
            color: rgba(255, 255, 255, 0.75);
            font-family: 'Manrope', sans-serif;
            font-size: 0.75rem;
            margin: 0;
        }

        /* ============================================
           TABLES
           ============================================ */
        .sl-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--sl-surface);
            border-radius: var(--sl-radius);
            overflow: hidden;
        }
        .sl-table th {
            background: var(--sl-surface-low);
            padding: 16px 20px;
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            font-size: 0.6875rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--sl-text-muted);
            border-bottom: none;
        }
        .sl-table td {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(14, 116, 144, 0.06);
            vertical-align: middle;
            color: var(--sl-body-text);
            font-family: 'Manrope', sans-serif;
        }
        .sl-table tr { transition: background var(--sl-transition-fast); }
        .sl-table tr:hover td { background: rgba(14, 116, 144, 0.03); }

        /* ============================================
           LESSON CARDS
           ============================================ */
        .sl-lesson-card {
            background: var(--sl-surface);
            border-radius: var(--sl-radius-lg);
            border: none;
            box-shadow: var(--sl-shadow-lg);
            overflow: hidden;
            transition: all var(--sl-transition-base);
            animation: fadeInUp 0.5s ease-out backwards;
        }
        .sl-lesson-card:hover {
            box-shadow: 0 28px 50px rgba(14, 116, 144, 0.10);
            transform: translateY(-6px);
        }
        .sl-lesson-header {
            padding: 26px 28px;
            border-bottom: 1px solid rgba(14, 116, 144, 0.06);
        }
        .sl-lesson-body { padding: 26px 28px; }
        .sl-lesson-footer {
            padding: 18px 28px;
            background: var(--sl-surface-low);
            border-top: none;
        }

        /* ============================================
           FILTER BUTTONS
           ============================================ */
        .sl-filter-group {
            display: inline-flex;
            background: var(--sl-surface);
            border-radius: var(--sl-radius-full);
            padding: 5px;
            box-shadow: var(--sl-shadow);
        }
        .sl-filter-btn {
            padding: 10px 22px;
            border-radius: var(--sl-radius-full);
            font-family: 'Manrope', sans-serif;
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--sl-text-muted);
            transition: all var(--sl-transition-fast);
            border: none;
            background: transparent;
            cursor: pointer;
        }
        .sl-filter-btn:hover {
            color: var(--sl-primary);
        }
        .sl-filter-btn.active {
            background: linear-gradient(135deg, var(--sl-primary) 0%, var(--sl-primary-dark) 100%);
            color: #fff;
            box-shadow: 0 4px 14px rgba(14, 116, 144, 0.25);
        }

        /* ============================================
           PRACTICE / CAMERA / QUIZ
           ============================================ */
        .sl-practice-card {
            background: var(--sl-surface);
            border-radius: var(--sl-radius-lg);
            border: none;
            box-shadow: var(--sl-shadow-lg);
            padding: 36px;
            animation: fadeInUp 0.6s ease-out;
        }
        .sl-camera-container {
            background: linear-gradient(135deg, #0F172A 0%, var(--sl-primary-dark) 100%);
            border-radius: var(--sl-radius-lg);
            aspect-ratio: 4/3;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            box-shadow: inset 0 0 40px rgba(0, 0, 0, 0.3);
        }
        .sl-sign-display {
            background: linear-gradient(135deg, var(--sl-surface-low) 0%, var(--sl-bg) 100%);
            border-radius: var(--sl-radius-lg);
            aspect-ratio: 4/3;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: var(--sl-shadow);
        }

        /* ============================================
           ACHIEVEMENTS
           ============================================ */
        .sl-achievement {
            background: var(--sl-surface);
            border-radius: var(--sl-radius);
            padding: 28px;
            text-align: center;
            border: none;
            box-shadow: var(--sl-shadow-lg);
            transition: all var(--sl-transition-base);
        }
        .sl-achievement:hover {
            transform: translateY(-4px);
            box-shadow: 0 28px 50px rgba(14, 116, 144, 0.10);
        }
        .sl-achievement-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ECFEFF 0%, #CFFAFE 100%);
            color: var(--sl-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 34px;
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
            color: rgba(14, 116, 144, 0.18);
            margin-bottom: 22px;
            animation: gentleBounce 2.4s ease-in-out infinite;
        }

        /* ============================================
           HERO — animated cyan gradient
           ============================================ */
        .sl-hero {
            background: linear-gradient(135deg, var(--sl-primary) 0%, var(--sl-primary-dark) 50%, var(--sl-accent) 130%);
            background-size: 200% 200%;
            animation: gradientFlow 10s ease infinite;
            border-radius: var(--sl-radius-xl);
            padding: 46px;
            color: #fff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(14, 116, 144, 0.25);
        }
        .sl-hero::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -15%;
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(34, 211, 238, 0.22) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 7s ease-in-out infinite;
        }
        .sl-hero h1, .sl-hero h2, .sl-hero h3 { color: #fff; }

        /* ============================================
           FLOATING ACCENTS
           ============================================ */
        .sl-float-accent {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, var(--sl-accent) 0%, transparent 70%);
            opacity: 0.15;
            filter: blur(40px);
            animation: float 8s ease-in-out infinite;
        }

        /* ============================================
           FORM INPUTS — soft glow focus
           ============================================ */
        .form-control {
            border-radius: var(--sl-radius-sm) !important;
            border: 1px solid rgba(14, 116, 144, 0.12) !important;
            background: var(--sl-surface) !important;
            font-family: 'Manrope', sans-serif;
            padding: 10px 14px;
            transition: all var(--sl-transition-base);
        }
        .form-control:focus {
            border-color: var(--sl-primary) !important;
            box-shadow: 0 0 0 4px rgba(14, 116, 144, 0.12) !important;
            outline: none;
        }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 992px) {
            .content-page { margin-left: 0; }
            .navbar-custom { margin-left: 0; padding: 0 12px; }
            .left-side-menu {
                left: -280px;
                transition: left var(--sl-transition-base);
            }
            .sidebar-enable .left-side-menu { left: 0; }
        }
        @media (max-width: 768px) {
            .sl-page-title { font-size: 1.75rem; }
            .sl-stat-value { font-size: 2rem; }
            .sl-practice-card { padding: 24px; }
            .sl-hero { padding: 32px; }
            .app-search .form-control { width: 180px; }
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

    <style>
        /* Critical shell fixes after the base theme CSS. */
        #wrapper {
            overflow: visible !important;
            min-height: 100vh;
        }

        body:not(.enlarged) .left-side-menu.fsl-sidebar {
            top: 0 !important;
            left: 0 !important;
            bottom: 0 !important;
            width: 260px !important;
            padding: 0 !important;
            z-index: 1001 !important;
            overflow: hidden !important;
        }

        .left-side-menu.fsl-sidebar .slimScrollDiv,
        .left-side-menu.fsl-sidebar .slimscroll-menu {
            height: 100vh !important;
            min-height: 100vh;
            overflow-x: hidden !important;
        }

        .fsl-sidebar .sidebar-brand {
            display: block;
            padding: 34px 24px 26px !important;
        }

        .fsl-sidebar .sidebar-brand-mark {
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            border-radius: var(--sl-radius);
            background: linear-gradient(135deg, rgba(14, 116, 144, 0.12), rgba(34, 211, 238, 0.18));
            color: var(--sl-primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            overflow: hidden;
        }

        .fsl-sidebar .sidebar-brand-mark img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        .fsl-sidebar .sidebar-section-label {
            padding: 16px 24px 6px;
            color: var(--sl-body-text);
            font-family: 'Manrope', sans-serif !important;
            font-size: 0.8125rem;
            font-weight: 500;
        }

        .fsl-sidebar .sidebar-footer {
            margin-top: auto;
            padding: 12px 14px 24px;
        }

        .fsl-sidebar .sidebar-logout {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: var(--sl-radius-full);
            color: var(--sl-body-text);
            font-family: 'Manrope', sans-serif !important;
            font-size: 0.9125rem;
            font-weight: 500;
            text-decoration: none;
            transition: background var(--sl-transition-base), color var(--sl-transition-base);
        }

        .fsl-sidebar .sidebar-logout:hover {
            background: rgba(239, 68, 68, 0.08);
            color: var(--sl-danger);
            text-decoration: none;
        }

        .fsl-sidebar .sidebar-logout i {
            width: 22px;
            text-align: center;
            color: var(--sl-text-soft);
            font-size: 1.2rem;
        }

        body:not(.enlarged) .content-page {
            margin-left: 260px !important;
            margin-top: 70px !important;
            overflow: visible !important;
        }

        body:not(.enlarged) .navbar-custom {
            top: 0 !important;
            left: 260px !important;
            right: 0 !important;
            width: auto !important;
            margin-left: 0 !important;
            padding: 0 24px !important;
        }

        .navbar-custom .topnav-menu > li {
            float: none !important;
        }

        .navbar-custom .app-search {
            display: block !important;
            height: auto !important;
            max-width: none !important;
            margin-right: 0 !important;
            overflow: visible !important;
        }

        .navbar-custom .button-menu-mobile {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            width: 42px !important;
            height: 42px !important;
            line-height: 42px !important;
        }

        .navbar-custom .topnav-menu .nav-link.nav-user {
            width: auto !important;
            min-width: 0 !important;
            max-width: min(320px, calc(100vw - 340px)) !important;
            height: auto !important;
            min-height: 42px;
            line-height: 1.2 !important;
            justify-content: flex-start !important;
            text-align: left !important;
        }

        .nav-user .pro-user-meta {
            display: flex;
            min-width: 0;
            flex-direction: column;
        }

        .nav-user .pro-user-name {
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
        }

        .nav-user .pro-user-role {
            color: var(--sl-text-muted);
            font-size: 0.6875rem;
            font-weight: 600;
            line-height: 1.1;
        }

        body.enlarged .left-side-menu.fsl-sidebar {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            bottom: 0 !important;
            width: 70px !important;
            height: 100vh !important;
            padding: 0 !important;
            z-index: 1001 !important;
            overflow: hidden !important;
        }

        body.enlarged .left-side-menu.fsl-sidebar .slimScrollDiv,
        body.enlarged .left-side-menu.fsl-sidebar .slimscroll-menu {
            height: 100vh !important;
            min-height: 100vh !important;
            overflow-x: hidden !important;
        }

        body.enlarged .left-side-menu.fsl-sidebar #sidebar-menu > ul {
            padding: 0 14px !important;
        }

        body.enlarged .left-side-menu.fsl-sidebar #sidebar-menu > ul > li {
            width: 42px;
        }

        body.enlarged .left-side-menu.fsl-sidebar #sidebar-menu > ul > li > a,
        body.enlarged .left-side-menu.fsl-sidebar #sidebar-menu > ul > li:hover > a {
            display: flex !important;
            align-items: center;
            justify-content: center !important;
            width: 42px !important;
            min-width: 42px !important;
            height: 42px !important;
            min-height: 42px !important;
            padding: 0 !important;
            margin: 4px 0 !important;
            border-radius: var(--sl-radius-full) !important;
            position: relative !important;
        }

        body.enlarged .left-side-menu.fsl-sidebar #sidebar-menu > ul > li > a i {
            width: auto !important;
            margin: 0 !important;
            line-height: 1 !important;
            font-size: 1.18rem !important;
        }

        body.enlarged .left-side-menu.fsl-sidebar #sidebar-menu > ul > li > a span,
        body.enlarged .left-side-menu.fsl-sidebar #sidebar-menu > ul > li:hover > a span,
        body.enlarged .left-side-menu.fsl-sidebar .nav-second-level,
        body.enlarged .left-side-menu.fsl-sidebar #sidebar-menu > ul > li:hover > ul {
            display: none !important;
        }

        body.enlarged .fsl-sidebar .sidebar-brand h1,
        body.enlarged .fsl-sidebar .sidebar-brand p,
        body.enlarged .fsl-sidebar .sidebar-section-label,
        body.enlarged .fsl-sidebar .sidebar-footer span {
            display: none !important;
        }

        body.enlarged .fsl-sidebar .sidebar-brand {
            padding: 22px 14px 16px !important;
        }

        body.enlarged .fsl-sidebar .sidebar-brand-mark,
        body.enlarged .fsl-sidebar .sidebar-logout {
            justify-content: center;
        }

        body.enlarged .fsl-sidebar .sidebar-logout {
            width: 42px;
            height: 42px;
            min-height: 42px;
            padding: 0 !important;
        }

        body.enlarged .fsl-sidebar .sidebar-logout i {
            margin: 0 !important;
        }

        body.enlarged .content-page {
            margin-left: 70px !important;
            margin-top: 70px !important;
        }

        body.enlarged .navbar-custom {
            top: 0 !important;
            left: 70px !important;
            right: 0 !important;
            width: auto !important;
            margin-left: 0 !important;
        }

        @media (max-width: 992px) {
            body:not(.enlarged) .left-side-menu.fsl-sidebar,
            body.enlarged .left-side-menu.fsl-sidebar {
                left: -280px !important;
                top: 0 !important;
                width: 260px !important;
                transition: left var(--sl-transition-base);
            }

            body.sidebar-enable .left-side-menu.fsl-sidebar {
                left: 0 !important;
            }

            body:not(.enlarged) .content-page,
            body.enlarged .content-page {
                margin-left: 0 !important;
            }

            body:not(.enlarged) .navbar-custom,
            body.enlarged .navbar-custom {
                top: 0 !important;
                left: 0 !important;
                padding: 0 12px !important;
            }

            .navbar-custom .topnav-menu .nav-link.nav-user {
                max-width: min(260px, calc(100vw - 92px)) !important;
            }
        }
    </style>
</head>
