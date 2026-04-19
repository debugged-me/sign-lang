<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FSL — Filipino Sign Language</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
    <style>
        :root {
            --sl-primary: #0E7490;
            --sl-primary-light: #0891B2;
            --sl-primary-dark: #155E75;
            --sl-secondary: #155E75;
            --sl-secondary-light: #0891B2;
            --sl-secondary-dark: #0C4A6E;
            --sl-accent: #22D3EE;
            --sl-accent-soft: #67E8F9;
            --sl-soft-accent: #22D3EE;
            --sl-bg: #F8FAFC;
            --sl-surface: #FFFFFF;
            --sl-surface-low: #F1F5F9;
            --sl-muted-surface: #F1F5F9;
            --sl-soft-surface: #F8FAFC;
            --sl-surface-high: #E2E8F0;
            --sl-border: rgba(14, 116, 144, 0.08);
            --sl-text: #0F172A;
            --sl-body-text: #334155;
            --sl-text-muted: #64748B;
            --sl-text-soft: #94A3B8;
            --sl-success: #10B981;
            --sl-danger: #EF4444;
            --sl-info: #22D3EE;
            --sl-warning: #F59E0B;
            --sl-primary-rgb: 14, 116, 144;
            --sl-secondary-rgb: 21, 94, 117;
            --sl-accent-rgb: 34, 211, 238;
            --sl-radius: 1rem;
            --sl-radius-sm: 0.75rem;
            --sl-radius-lg: 1.5rem;
            --sl-radius-xl: 2rem;
            --sl-radius-full: 9999px;
            --sl-shadow: 0 4px 14px rgba(14, 116, 144, 0.04), 0 2px 4px rgba(14, 116, 144, 0.03);
            --sl-shadow-md: 0 12px 28px rgba(14, 116, 144, 0.06), 0 4px 10px rgba(14, 116, 144, 0.04);
            --sl-shadow-lg: 0 20px 40px rgba(14, 116, 144, 0.06);
            --sl-shadow-glow: 0 8px 24px rgba(14, 116, 144, 0.18);
            --sl-transition-fast: 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            --sl-transition-base: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --sl-transition-slow: 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif !important;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--sl-bg);
            color: var(--sl-text);
            overflow-x: hidden;
            cursor: none;
        }

        /* CUSTOM CURSOR */
        .cursor {
            width: 12px;
            height: 12px;
            background: var(--sl-accent);
            border-radius: 50%;
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.1s ease;
            mix-blend-mode: multiply;
        }

        .cursor-ring {
            width: 36px;
            height: 36px;
            border: 2px solid rgba(var(--sl-accent-rgb), 0.4);
            border-radius: 50%;
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 9998;
            transition: transform 0.25s cubic-bezier(0.23, 1, 0.32, 1), width 0.3s, height 0.3s, opacity 0.3s;
        }

        .cursor-ring.hovered {
            width: 56px;
            height: 56px;
            opacity: 0.5;
        }

        /* SCROLLBAR */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--sl-surface-low);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--sl-accent);
            border-radius: 99px;
        }

        /* ====== KEYFRAMES ====== */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-14px) rotate(1deg);
            }

            66% {
                transform: translateY(-7px) rotate(-1deg);
            }
        }

        @keyframes floatSlow {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes spin-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes spin-reverse {
            from {
                transform: rotate(360deg);
            }

            to {
                transform: rotate(0deg);
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(var(--sl-accent-rgb), 0.3);
            }

            50% {
                box-shadow: 0 0 0 20px rgba(var(--sl-accent-rgb), 0);
            }
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }

            100% {
                transform: scale(2.2);
                opacity: 0;
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
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

        @keyframes slideLeft {
            from {
                opacity: 0;
                transform: translateX(60px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideRight {
            from {
                opacity: 0;
                transform: translateX(-60px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes waveHand {

            0%,
            100% {
                transform: rotate(0deg) scale(1);
            }

            15% {
                transform: rotate(-20deg) scale(1.1);
            }

            30% {
                transform: rotate(15deg) scale(1.05);
            }

            45% {
                transform: rotate(-10deg) scale(1.08);
            }

            60% {
                transform: rotate(12deg) scale(1.03);
            }

            75% {
                transform: rotate(-5deg) scale(1.06);
            }
        }

        @keyframes fingerTap {

            0%,
            100% {
                transform: scaleY(1);
            }

            50% {
                transform: scaleY(0.7) translateY(6px);
            }
        }

        @keyframes morphBlob {

            0%,
            100% {
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            }

            33% {
                border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%;
            }

            66% {
                border-radius: 50% 60% 30% 60% / 30% 40% 70% 60%;
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200% center;
            }

            100% {
                background-position: 200% center;
            }
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes particleDrift {
            0% {
                transform: translateY(100vh) translateX(0) scale(0);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 0.6;
            }

            100% {
                transform: translateY(-20vh) translateX(var(--drift)) scale(1.5);
                opacity: 0;
            }
        }

        @keyframes drawLine {
            from {
                stroke-dashoffset: 800;
            }

            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes ripple {
            0% {
                transform: scale(0);
                opacity: 0.6;
            }

            100% {
                transform: scale(4);
                opacity: 0;
            }
        }

        @keyframes textReveal {
            from {
                clip-path: inset(0 100% 0 0);
            }

            to {
                clip-path: inset(0 0% 0 0);
            }
        }

        @keyframes handSign1 {

            0%,
            20% {
                d: path("M60 100 Q60 70 65 50 Q68 35 72 30 Q76 25 80 30 Q84 35 82 55 L82 80 Q90 70 95 65 Q100 60 104 65 Q108 70 105 85 L102 95 Q108 88 113 83 Q118 78 121 83 Q124 88 120 102 L116 112 Q120 107 124 104 Q128 100 130 105 Q132 110 128 122 L118 140 Q112 152 100 158 Q85 162 72 155 Q62 148 58 135 Z");
            }

            40%,
            60% {
                d: path("M60 100 Q55 75 58 52 Q60 38 65 33 Q70 28 75 34 Q80 40 78 60 L78 82 Q87 73 92 68 Q98 63 102 68 Q106 73 103 88 L100 97 Q106 90 111 86 Q116 81 119 86 Q122 91 118 104 L114 114 Q118 109 122 106 Q126 102 128 107 Q130 112 126 124 L115 142 Q108 154 97 159 Q81 163 68 156 Q59 149 56 136 Z");
            }

            80%,
            100% {
                d: path("M60 100 Q60 70 65 50 Q68 35 72 30 Q76 25 80 30 Q84 35 82 55 L82 80 Q90 70 95 65 Q100 60 104 65 Q108 70 105 85 L102 95 Q108 88 113 83 Q118 78 121 83 Q124 88 120 102 L116 112 Q120 107 124 104 Q128 100 130 105 Q132 110 128 122 L118 140 Q112 152 100 158 Q85 162 72 155 Q62 148 58 135 Z");
            }
        }

        @keyframes bounce-subtle {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        /* ====== NAV ====== */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 1.25rem 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(248, 250, 252, 0.82);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--sl-border);
            animation: fadeIn 0.8s ease both;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--sl-primary-dark);
        }

        .nav-logo-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--sl-primary), var(--sl-accent));
            border-radius: var(--sl-radius-sm);
            display: grid;
            place-items: center;
            animation: pulse-glow 3s ease-in-out infinite;
            font-size: 1.3rem;
        }

        .nav-logo-text {
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: -0.03em;
        }

        .nav-logo-text span {
            color: var(--sl-accent);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--sl-body-text);
            font-weight: 500;
            font-size: 0.9rem;
            position: relative;
            transition: color var(--sl-transition-base);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--sl-accent);
            border-radius: 99px;
            transition: width var(--sl-transition-base);
        }

        .nav-links a:hover {
            color: var(--sl-primary);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-cta {
            background: linear-gradient(135deg, var(--sl-primary), var(--sl-primary-light));
            color: white !important;
            padding: 0.6rem 1.4rem;
            border-radius: var(--sl-radius-full);
            font-weight: 600 !important;
            transition: transform var(--sl-transition-base), box-shadow var(--sl-transition-base) !important;
            box-shadow: var(--sl-shadow-glow);
        }

        .nav-cta::after {
            display: none !important;
        }

        .nav-cta:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 12px 32px rgba(var(--sl-primary-rgb), 0.35) !important;
        }

        /* ====== HERO ====== */
        .hero {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            padding: 8rem 5rem 4rem;
            position: relative;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 60% at 70% 50%, rgba(var(--sl-accent-rgb), 0.07) 0%, transparent 70%),
                radial-gradient(ellipse 40% 40% at 20% 80%, rgba(var(--sl-primary-rgb), 0.05) 0%, transparent 60%),
                var(--sl-bg);
            z-index: 0;
        }

        .hero-grid-lines {
            position: absolute;
            inset: 0;
            z-index: 0;
            opacity: 0.04;
            background-image:
                linear-gradient(var(--sl-primary) 1px, transparent 1px),
                linear-gradient(90deg, var(--sl-primary) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        .hero-particles {
            position: absolute;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--sl-accent);
            border-radius: 50%;
            animation: particleDrift linear infinite;
            opacity: 0;
        }

        .hero-left {
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(var(--sl-accent-rgb), 0.1);
            border: 1px solid rgba(var(--sl-accent-rgb), 0.25);
            color: var(--sl-primary-dark);
            padding: 0.4rem 1rem;
            border-radius: var(--sl-radius-full);
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            margin-bottom: 1.5rem;
            animation: fadeUp 0.6s ease both;
        }

        .hero-badge-dot {
            width: 7px;
            height: 7px;
            background: var(--sl-accent);
            border-radius: 50%;
            animation: pulse-glow 2s ease-in-out infinite;
        }

        .hero-title {
            font-size: clamp(2.8rem, 5vw, 4.2rem);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.04em;
            color: var(--sl-text);
            margin-bottom: 1.25rem;
            animation: fadeUp 0.7s 0.1s ease both;
        }

        .hero-title .accent {
            background: linear-gradient(135deg, var(--sl-primary), var(--sl-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-title .shimmer-text {
            background: linear-gradient(90deg, var(--sl-primary-dark), var(--sl-accent), var(--sl-primary-dark));
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 3s linear infinite;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: var(--sl-body-text);
            line-height: 1.7;
            max-width: 480px;
            margin-bottom: 2.5rem;
            font-weight: 400;
            animation: fadeUp 0.7s 0.2s ease both;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: fadeUp 0.7s 0.3s ease both;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: linear-gradient(135deg, var(--sl-primary-dark), var(--sl-primary));
            color: white;
            padding: 0.9rem 2rem;
            border-radius: var(--sl-radius-full);
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            box-shadow: var(--sl-shadow-glow);
            transition: transform var(--sl-transition-base), box-shadow var(--sl-transition-base);
            border: none;
            cursor: none;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }

        .btn-primary:hover::before {
            transform: translateX(100%);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(var(--sl-primary-rgb), 0.4);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            color: var(--sl-primary);
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            padding: 0.9rem 1.5rem;
            border-radius: var(--sl-radius-full);
            border: 2px solid rgba(var(--sl-primary-rgb), 0.2);
            transition: all var(--sl-transition-base);
            cursor: none;
        }

        .btn-secondary:hover {
            background: rgba(var(--sl-primary-rgb), 0.06);
            border-color: rgba(var(--sl-primary-rgb), 0.4);
            transform: translateY(-2px);
        }

        /* HERO RIGHT - HAND SVG FIGURE */
        .hero-right {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-visual-container {
            position: relative;
            width: 480px;
            height: 520px;
        }

        .hero-blob {
            position: absolute;
            width: 360px;
            height: 360px;
            background: linear-gradient(135deg, rgba(var(--sl-accent-rgb), 0.15), rgba(var(--sl-primary-rgb), 0.12));
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: morphBlob 8s ease-in-out infinite, floatSlow 6s ease-in-out infinite;
        }

        .hero-blob-2 {
            position: absolute;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, rgba(var(--sl-accent-rgb), 0.08), rgba(var(--sl-primary-rgb), 0.06));
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
            top: 10%;
            right: 5%;
            animation: morphBlob 6s 2s ease-in-out infinite reverse, floatSlow 5s 1s ease-in-out infinite;
        }

        .hand-svg-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: float 5s ease-in-out infinite;
            filter: drop-shadow(0 20px 40px rgba(var(--sl-primary-rgb), 0.2));
        }

        .pulse-ring-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .pulse-ring {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 2px solid rgba(var(--sl-accent-rgb), 0.5);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: pulse-ring 2.5s ease-out infinite;
        }

        .pulse-ring:nth-child(2) {
            animation-delay: 0.8s;
        }

        .pulse-ring:nth-child(3) {
            animation-delay: 1.6s;
        }

        .floating-letter {
            position: absolute;
            background: var(--sl-surface);
            border: 1px solid rgba(var(--sl-accent-rgb), 0.3);
            border-radius: var(--sl-radius-sm);
            padding: 0.6rem 0.9rem;
            font-weight: 700;
            font-size: 1rem;
            color: var(--sl-primary-dark);
            box-shadow: var(--sl-shadow-md);
            animation: float ease-in-out infinite;
        }

        .fl-1 {
            top: 8%;
            left: 5%;
            animation-duration: 4s;
            animation-delay: 0s;
        }

        .fl-2 {
            top: 20%;
            right: 2%;
            animation-duration: 5s;
            animation-delay: 1s;
        }

        .fl-3 {
            bottom: 22%;
            left: 2%;
            animation-duration: 4.5s;
            animation-delay: 0.5s;
        }

        .fl-4 {
            bottom: 10%;
            right: 8%;
            animation-duration: 3.5s;
            animation-delay: 1.5s;
        }

        .hero-stats {
            position: absolute;
            bottom: -1rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 1.5rem;
            animation: fadeUp 0.8s 0.5s ease both;
        }

        .hero-stat {
            background: var(--sl-surface);
            border: 1px solid rgba(var(--sl-primary-rgb), 0.08);
            border-radius: var(--sl-radius);
            padding: 0.8rem 1.4rem;
            text-align: center;
            box-shadow: var(--sl-shadow-md);
            white-space: nowrap;
        }

        .hero-stat-num {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--sl-primary);
            letter-spacing: -0.03em;
        }

        .hero-stat-label {
            font-size: 0.72rem;
            color: var(--sl-text-muted);
            font-weight: 500;
            margin-top: 0.1rem;
        }

        /* ====== SECTION WRAPPER ====== */
        section {
            padding: 6rem 5rem;
            position: relative;
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--sl-primary);
            margin-bottom: 1rem;
        }

        .section-label::before {
            content: '';
            display: block;
            width: 24px;
            height: 2px;
            background: var(--sl-accent);
            border-radius: 99px;
        }

        .section-title {
            font-size: clamp(2rem, 3.5vw, 3rem);
            font-weight: 800;
            letter-spacing: -0.04em;
            color: var(--sl-text);
            line-height: 1.1;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.05rem;
            color: var(--sl-body-text);
            line-height: 1.7;
            max-width: 560px;
        }

        /* ====== MARQUEE / SCROLL TICKER ====== */
        .ticker-section {
            padding: 1.5rem 0;
            overflow: hidden;
            background: linear-gradient(135deg, var(--sl-primary-dark), var(--sl-primary));
            position: relative;
        }

        .ticker-track {
            display: flex;
            gap: 3rem;
            animation: scroll-ticker 20s linear infinite;
            width: max-content;
        }

        @keyframes scroll-ticker {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        .ticker-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.03em;
            white-space: nowrap;
        }

        .ticker-dot {
            width: 6px;
            height: 6px;
            background: var(--sl-accent);
            border-radius: 50%;
        }

        /* ====== SIGN ALPHABET INTERACTIVE ====== */
        .alphabet-section {
            background: var(--sl-bg);
        }

        .alphabet-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 1rem;
            margin-top: 3rem;
        }

        .letter-card {
            background: var(--sl-surface);
            border: 2px solid transparent;
            border-radius: var(--sl-radius);
            padding: 1.25rem 0.75rem;
            text-align: center;
            cursor: none;
            transition: all var(--sl-transition-base);
            box-shadow: var(--sl-shadow);
            position: relative;
            overflow: hidden;
        }

        .letter-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(var(--sl-accent-rgb), 0.06), transparent);
            opacity: 0;
            transition: opacity var(--sl-transition-base);
        }

        .letter-card:hover {
            border-color: rgba(var(--sl-accent-rgb), 0.4);
            transform: translateY(-6px) scale(1.04);
            box-shadow: var(--sl-shadow-glow);
        }

        .letter-card:hover::before {
            opacity: 1;
        }

        .letter-card:hover .letter-hand-icon {
            animation: waveHand 0.8s ease;
        }

        .letter-hand-icon {
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            display: block;
            filter: drop-shadow(0 2px 4px rgba(var(--sl-primary-rgb), 0.1));
        }

        .letter-char {
            font-size: 1rem;
            font-weight: 800;
            color: var(--sl-primary-dark);
            letter-spacing: -0.02em;
        }

        .letter-tag {
            font-size: 0.65rem;
            color: var(--sl-text-muted);
            font-weight: 500;
            margin-top: 0.2rem;
        }

        .letter-card.active {
            border-color: var(--sl-accent);
            background: linear-gradient(135deg, rgba(var(--sl-accent-rgb), 0.08), var(--sl-surface));
        }

        /* RIPPLE EFFECT */
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(var(--sl-accent-rgb), 0.25);
            animation: ripple 0.6s ease-out forwards;
            pointer-events: none;
        }

        /* ====== FEATURES ====== */
        .features-section {
            background: var(--sl-surface-low);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 3.5rem;
        }

        .feature-card {
            background: var(--sl-surface);
            border-radius: var(--sl-radius-lg);
            padding: 2rem;
            border: 1px solid var(--sl-border);
            box-shadow: var(--sl-shadow);
            transition: all var(--sl-transition-base);
            cursor: none;
            position: relative;
            overflow: hidden;
        }

        .feature-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--sl-primary), var(--sl-accent));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform var(--sl-transition-slow);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--sl-shadow-lg);
        }

        .feature-card:hover::after {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, rgba(var(--sl-primary-rgb), 0.1), rgba(var(--sl-accent-rgb), 0.1));
            border-radius: var(--sl-radius);
            display: grid;
            place-items: center;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
            transition: transform var(--sl-transition-base);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--sl-text);
            margin-bottom: 0.6rem;
        }

        .feature-desc {
            font-size: 0.9rem;
            color: var(--sl-body-text);
            line-height: 1.65;
        }

        /* ====== ANIMATED FIGURE / SIGNER ====== */
        .signer-section {
            background: linear-gradient(180deg, var(--sl-surface-low), var(--sl-bg));
            overflow: hidden;
        }

        .signer-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .signer-text {
            animation: slideRight 0.7s 0.1s ease both;
        }

        .signer-visual {
            position: relative;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signer-figure-bg {
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(var(--sl-accent-rgb), 0.12) 0%, transparent 70%);
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .signer-svg-wrap {
            position: relative;
            z-index: 1;
            animation: floatSlow 4s ease-in-out infinite;
            filter: drop-shadow(0 24px 48px rgba(var(--sl-primary-rgb), 0.18));
        }

        /* Interactive sign words */
        .sign-word-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 2rem;
        }

        .sign-chip {
            background: var(--sl-surface);
            border: 2px solid rgba(var(--sl-primary-rgb), 0.15);
            color: var(--sl-body-text);
            padding: 0.5rem 1.1rem;
            border-radius: var(--sl-radius-full);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: none;
            transition: all var(--sl-transition-base);
        }

        .sign-chip:hover,
        .sign-chip.active {
            background: linear-gradient(135deg, var(--sl-primary), var(--sl-primary-light));
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: var(--sl-shadow-glow);
        }

        /* ====== WHY FSL ====== */
        .why-section {
            background: var(--sl-surface);
        }

        .why-bento {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-template-rows: auto;
            gap: 1.25rem;
            margin-top: 3.5rem;
        }

        .bento-card {
            background: var(--sl-surface-low);
            border-radius: var(--sl-radius-lg);
            padding: 2rem;
            border: 1px solid var(--sl-border);
            overflow: hidden;
            position: relative;
            transition: all var(--sl-transition-base);
            cursor: none;
        }

        .bento-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--sl-shadow-lg);
        }

        .bc-1 {
            grid-column: span 5;
            grid-row: span 2;
            background: linear-gradient(135deg, var(--sl-primary-dark), var(--sl-primary));
            color: white;
        }

        .bc-2 {
            grid-column: span 7;
        }

        .bc-3 {
            grid-column: span 4;
        }

        .bc-4 {
            grid-column: span 3;
        }

        .bc-5 {
            grid-column: span 7;
            grid-row: span 1;
        }

        .bc-6 {
            grid-column: span 5;
        }

        .bc-7 {
            grid-column: span 7;
        }

        .bento-num {
            font-size: 4rem;
            font-weight: 800;
            letter-spacing: -0.05em;
            background: linear-gradient(135deg, var(--sl-primary), var(--sl-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .bc-1 .bento-num {
            background: linear-gradient(135deg, var(--sl-accent), white);
            -webkit-background-clip: text;
            background-clip: text;
        }

        .bento-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            color: var(--sl-accent);
        }

        .bc-1 .bento-label {
            color: rgba(255, 255, 255, 0.6);
        }

        .bento-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--sl-text);
            margin-bottom: 0.4rem;
        }

        .bc-1 .bento-title {
            color: white;
            font-size: 1.3rem;
        }

        .bento-desc {
            font-size: 0.85rem;
            color: var(--sl-body-text);
            line-height: 1.6;
        }

        .bc-1 .bento-desc {
            color: rgba(255, 255, 255, 0.75);
        }

        .bento-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .bento-decorline {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--sl-accent), var(--sl-primary));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform var(--sl-transition-slow);
        }

        .bento-card:hover .bento-decorline {
            transform: scaleX(1);
        }

        .bento-progress {
            height: 6px;
            background: rgba(var(--sl-primary-rgb), 0.1);
            border-radius: 99px;
            margin-top: 1rem;
            overflow: hidden;
        }

        .bento-progress-bar {
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, var(--sl-primary), var(--sl-accent));
            transition: width 1.5s cubic-bezier(0.23, 1, 0.32, 1);
            width: 0;
        }

        /* ====== COMMUNITY ====== */
        .community-section {
            background: var(--sl-bg);
        }

        .community-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 3.5rem;
        }

        .community-card {
            background: var(--sl-surface);
            border-radius: var(--sl-radius-lg);
            padding: 2.5rem 2rem;
            border: 1px solid var(--sl-border);
            box-shadow: var(--sl-shadow);
            transition: all var(--sl-transition-base);
            position: relative;
            overflow: hidden;
            cursor: none;
            text-align: center;
        }

        .community-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--sl-shadow-lg);
        }

        .community-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin: 0 auto 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            background: linear-gradient(135deg, rgba(var(--sl-accent-rgb), 0.15), rgba(var(--sl-primary-rgb), 0.1));
            border: 3px solid rgba(var(--sl-accent-rgb), 0.3);
            animation: bounce-subtle 3s ease-in-out infinite;
        }

        .community-card:nth-child(2) .community-avatar {
            animation-delay: 1s;
        }

        .community-card:nth-child(3) .community-avatar {
            animation-delay: 2s;
        }

        .community-name {
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--sl-text);
            margin-bottom: 0.25rem;
        }

        .community-role {
            font-size: 0.78rem;
            color: var(--sl-primary);
            font-weight: 600;
            letter-spacing: 0.03em;
            margin-bottom: 1rem;
        }

        .community-quote {
            font-size: 0.88rem;
            color: var(--sl-body-text);
            line-height: 1.65;
            font-style: italic;
        }

        .community-stars {
            color: var(--sl-warning);
            font-size: 0.85rem;
            margin-top: 1rem;
            letter-spacing: 0.1em;
        }

        /* ====== CTA SECTION ====== */
        .cta-section {
            background: linear-gradient(135deg, var(--sl-primary-dark) 0%, var(--sl-primary) 50%, var(--sl-primary-light) 100%);
            text-align: center;
            padding: 8rem 5rem;
            position: relative;
            overflow: hidden;
        }

        .cta-bg-dots {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
        }

        .cta-orb {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            animation: floatSlow 6s ease-in-out infinite;
        }

        .cta-orb-1 {
            width: 300px;
            height: 300px;
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .cta-orb-2 {
            width: 200px;
            height: 200px;
            bottom: -80px;
            right: -60px;
            animation-delay: 2s;
        }

        .cta-content {
            position: relative;
            z-index: 1;
        }

        .cta-title {
            font-size: clamp(2rem, 4vw, 3.5rem);
            font-weight: 800;
            letter-spacing: -0.04em;
            color: white;
            margin-bottom: 1.25rem;
            line-height: 1.1;
        }

        .cta-subtitle {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 520px;
            margin: 0 auto 2.5rem;
            line-height: 1.7;
        }

        .cta-actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .btn-white {
            background: white;
            color: var(--sl-primary-dark);
            padding: 0.9rem 2.2rem;
            border-radius: var(--sl-radius-full);
            font-weight: 700;
            text-decoration: none;
            font-size: 0.95rem;
            transition: all var(--sl-transition-base);
            cursor: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .btn-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2);
        }

        .btn-outline-white {
            background: transparent;
            color: white;
            padding: 0.9rem 2rem;
            border-radius: var(--sl-radius-full);
            font-weight: 600;
            text-decoration: none;
            font-size: 0.95rem;
            border: 2px solid rgba(255, 255, 255, 0.4);
            transition: all var(--sl-transition-base);
            cursor: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
        }

        .btn-outline-white:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.7);
            transform: translateY(-2px);
        }

        /* ====== FOOTER ====== */
        footer {
            background: var(--sl-primary-dark);
            color: rgba(255, 255, 255, 0.7);
            padding: 4rem 5rem 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-brand-name {
            font-size: 1.2rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.75rem;
            letter-spacing: -0.03em;
        }

        .footer-brand-desc {
            font-size: 0.85rem;
            line-height: 1.7;
            max-width: 280px;
        }

        .footer-heading {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--sl-accent);
            margin-bottom: 1.25rem;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.85rem;
            transition: color var(--sl-transition-fast);
        }

        .footer-links a:hover {
            color: var(--sl-accent);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
        }

        .footer-heart {
            color: var(--sl-accent);
        }

        .footer-socials {
            display: flex;
            gap: 1rem;
        }

        .footer-social {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 0.9rem;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.6);
            transition: all var(--sl-transition-base);
        }

        .footer-social:hover {
            background: rgba(var(--sl-accent-rgb), 0.2);
            color: var(--sl-accent);
            transform: translateY(-3px);
        }

        /* ====== SCROLL REVEAL ====== */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-delay-1 {
            transition-delay: 0.1s;
        }

        .reveal-delay-2 {
            transition-delay: 0.2s;
        }

        .reveal-delay-3 {
            transition-delay: 0.3s;
        }

        /* FSL HAND SVG STYLES */
        .hand-svg {
            width: 260px;
            height: 320px;
        }

        .fsl-hands-row {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .mini-hand-card {
            background: var(--sl-surface);
            border-radius: var(--sl-radius);
            padding: 1rem;
            box-shadow: var(--sl-shadow-md);
            border: 1px solid rgba(var(--sl-accent-rgb), 0.2);
            text-align: center;
            transition: all var(--sl-transition-base);
            cursor: none;
        }

        .mini-hand-card:hover {
            transform: translateY(-6px) scale(1.05);
            box-shadow: var(--sl-shadow-glow);
        }

        .mini-hand-card svg {
            width: 80px;
            height: 100px;
        }

        .mini-hand-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--sl-primary);
            margin-top: 0.5rem;
            letter-spacing: 0.05em;
        }

        /* AWARENESS BANNER */
        .awareness-strip {
            background: linear-gradient(135deg, rgba(var(--sl-accent-rgb), 0.08), rgba(var(--sl-primary-rgb), 0.06));
            border-top: 1px solid rgba(var(--sl-accent-rgb), 0.15);
            border-bottom: 1px solid rgba(var(--sl-accent-rgb), 0.15);
            padding: 2.5rem 5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
        }

        .awareness-text h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--sl-text);
            margin-bottom: 0.25rem;
        }

        .awareness-text p {
            font-size: 0.9rem;
            color: var(--sl-body-text);
        }

        .awareness-icons {
            display: flex;
            gap: 1rem;
            font-size: 2rem;
        }

        .awareness-icon {
            animation: bounce-subtle 2s ease-in-out infinite;
        }

        .awareness-icon:nth-child(2) {
            animation-delay: 0.4s;
        }

        .awareness-icon:nth-child(3) {
            animation-delay: 0.8s;
        }

        /* TYPEWRITER */
        .typewriter-text::after {
            content: '|';
            color: var(--sl-accent);
            animation: blink 1s step-end infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: 0
            }
        }

        /* SCROLL INDICATOR */
        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            color: var(--sl-text-muted);
            font-size: 0.75rem;
            font-weight: 500;
            animation: fadeUp 1s 1s ease both;
        }

        .scroll-mouse {
            width: 24px;
            height: 38px;
            border: 2px solid rgba(var(--sl-primary-rgb), 0.3);
            border-radius: 12px;
            position: relative;
        }

        .scroll-dot {
            width: 4px;
            height: 8px;
            background: var(--sl-accent);
            border-radius: 99px;
            position: absolute;
            top: 6px;
            left: 50%;
            transform: translateX(-50%);
            animation: scroll-dot 1.5s ease-in-out infinite;
        }

        @keyframes scroll-dot {

            0%,
            100% {
                top: 6px;
                opacity: 1;
            }

            50% {
                top: 18px;
                opacity: 0.3;
            }
        }

        /* Orbit decoration */
        .orbit-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 420px;
            height: 420px;
            pointer-events: none;
        }

        .orbit-ring {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 1px dashed rgba(var(--sl-primary-rgb), 0.12);
            animation: spin-slow linear infinite;
        }

        .orbit-ring-2 {
            position: absolute;
            inset: 40px;
            border-radius: 50%;
            border: 1px dashed rgba(var(--sl-accent-rgb), 0.15);
            animation: spin-reverse 15s linear infinite;
        }

        .orbit-dot {
            width: 10px;
            height: 10px;
            background: var(--sl-accent);
            border-radius: 50%;
            position: absolute;
            top: -5px;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 0 8px rgba(var(--sl-accent-rgb), 0.6);
        }

        .orbit-dot-2 {
            width: 7px;
            height: 7px;
            background: var(--sl-primary);
            border-radius: 50%;
            position: absolute;
            bottom: -3px;
            right: 40px;
        }
    </style>
</head>

<body>

    <!-- CURSOR -->
    <div class="cursor" id="cursor"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <!-- PARTICLES -->
    <div class="hero-particles" id="particles"></div>

    <!-- NAV -->
    <nav>
        <a class="nav-logo" href="<?php echo base_url(); ?>">
            <div class="nav-logo-icon">🤟</div>
            <div class="nav-logo-text">FSL<span>Hub</span></div>
        </a>
        <ul class="nav-links">
            <li><a href="#alphabet">Alphabet</a></li>
            <li><a href="#features">Features</a></li>
            <li><a href="#community">Community</a></li>
            <li><a href="#about">About FSL</a></li>
            <li><a href="<?php echo base_url('Login'); ?>" class="nav-cta">Get Started →</a></li>
        </ul>
    </nav>

    <!-- HERO -->
    <section class="hero" style="padding-top: 7rem;">
        <div class="hero-bg"></div>
        <div class="hero-grid-lines"></div>

        <div class="hero-left">
            <div class="hero-badge">
                <div class="hero-badge-dot"></div>
                Filipino Sign Language · Wikang Senyas
            </div>
            <h1 class="hero-title">
                Speak with<br>
                <span class="shimmer-text">Your Hands,</span><br>
                <span class="accent">Touch Hearts</span>
            </h1>
            <p class="hero-subtitle">
                FSLHub bridges the gap between hearing and deaf communities in the Philippines. Learn, practice, and celebrate Filipino Sign Language — the vibrant visual language of over 100,000 deaf Filipinos.
            </p>
            <div class="hero-actions">
                <a href="<?php echo base_url('Login'); ?>" class="btn-primary">
                    🤟 Start Learning
                </a>
                <a href="#features" class="btn-secondary">
                    ▶ Watch Demo
                </a>
            </div>
        </div>

        <div class="hero-right">
            <div class="hero-visual-container">
                <div class="orbit-container">
                    <div class="orbit-ring" style="animation-duration: 20s;">
                        <div class="orbit-dot"></div>
                    </div>
                    <div class="orbit-ring-2">
                        <div class="orbit-dot-2"></div>
                    </div>
                </div>

                <div class="hero-blob"></div>
                <div class="hero-blob-2"></div>

                <div class="pulse-ring-container">
                    <div class="pulse-ring"></div>
                    <div class="pulse-ring"></div>
                    <div class="pulse-ring"></div>
                </div>

                <!-- MAIN HAND SVG -->
                <div class="hand-svg-container">
                    <svg class="hand-svg" viewBox="0 0 200 260" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Palm base -->
                        <ellipse cx="100" cy="190" rx="62" ry="52" fill="url(#palmGrad)" />
                        <!-- Thumb -->
                        <path d="M42 175 Q28 158 25 140 Q22 122 32 115 Q44 110 52 125 Q58 140 56 162 Z" fill="url(#fingerGrad)" />
                        <!-- Index finger -->
                        <rect x="68" y="90" width="22" height="88" rx="11" fill="url(#fingerGrad)" class="finger-index" />
                        <!-- Middle finger -->
                        <rect x="93" y="74" width="22" height="104" rx="11" fill="url(#fingerGrad)" class="finger-middle" />
                        <!-- Ring finger -->
                        <rect x="118" y="84" width="22" height="94" rx="11" fill="url(#fingerGrad)" class="finger-ring" />
                        <!-- Pinky -->
                        <rect x="143" y="100" width="18" height="80" rx="9" fill="url(#fingerGrad)" class="finger-pinky" />
                        <!-- Knuckle details -->
                        <ellipse cx="79" cy="178" rx="10" ry="5" fill="rgba(14,116,144,0.12)" />
                        <ellipse cx="104" cy="178" rx="10" ry="5" fill="rgba(14,116,144,0.12)" />
                        <ellipse cx="129" cy="178" rx="10" ry="5" fill="rgba(14,116,144,0.12)" />
                        <ellipse cx="152" cy="178" rx="8" ry="4" fill="rgba(14,116,144,0.12)" />
                        <!-- Shine -->
                        <ellipse cx="95" cy="150" rx="30" ry="18" fill="rgba(255,255,255,0.15)" />
                        <!-- Wrist -->
                        <rect x="68" y="225" width="65" height="35" rx="16" fill="url(#palmGrad)" />
                        <!-- Sparkle dots -->
                        <circle cx="30" cy="90" r="4" fill="#22D3EE" opacity="0.7">
                            <animate attributeName="opacity" values="0.7;0.1;0.7" dur="2s" repeatCount="indefinite" />
                            <animate attributeName="r" values="4;6;4" dur="2s" repeatCount="indefinite" />
                        </circle>
                        <circle cx="170" cy="60" r="3" fill="#22D3EE" opacity="0.5">
                            <animate attributeName="opacity" values="0.5;0.1;0.5" dur="2.5s" repeatCount="indefinite" />
                        </circle>
                        <circle cx="55" cy="55" r="2.5" fill="#0891B2" opacity="0.6">
                            <animate attributeName="opacity" values="0.6;0;0.6" dur="1.8s" repeatCount="indefinite" />
                        </circle>
                        <defs>
                            <linearGradient id="palmGrad" x1="38" y1="140" x2="162" y2="240" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#cffafe" />
                                <stop offset="100%" stop-color="#a5f3fc" />
                            </linearGradient>
                            <linearGradient id="fingerGrad" x1="0" y1="0" x2="0" y2="1" gradientUnits="objectBoundingBox">
                                <stop offset="0%" stop-color="#e0f7fa" />
                                <stop offset="100%" stop-color="#b2ebf2" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>

                <!-- FLOATING LETTER CHIPS -->
                <div class="floating-letter fl-1">🤙 Kamusta</div>
                <div class="floating-letter fl-2">✌️ Peace</div>
                <div class="floating-letter fl-3">🤝 Magkaisa</div>
                <div class="floating-letter fl-4">👐 Pag-ibig</div>
            </div>

            <!-- HERO STATS -->
            <div class="hero-stats" style="margin-top: 1rem; position: relative; bottom: auto; left: auto; transform: none; display: flex; gap: 1rem; margin-top: 2rem;">
                <div class="hero-stat">
                    <div class="hero-stat-num" data-count="100000">0</div>
                    <div class="hero-stat-label">Deaf Filipinos</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num" data-count="2800">0</div>
                    <div class="hero-stat-label">FSL Signs</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num" data-count="47">0</div>
                    <div class="hero-stat-label">Provinces</div>
                </div>
            </div>
        </div>

        <div class="scroll-indicator">
            <div class="scroll-mouse">
                <div class="scroll-dot"></div>
            </div>
            Scroll to explore
        </div>
    </section>

    <!-- TICKER -->
    <div class="ticker-section">
        <div class="ticker-track" id="ticker">
            <div class="ticker-item">
                <div class="ticker-dot"></div> Filipino Sign Language
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> 🤟 Wikang Senyas ng Pilipinas
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> Kamusta Ka?
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> 🇵🇭 Deaf Pride Philippines
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> Mahal Kita ✌️
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> Accessibility for All
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> 👐 Salita ng Kamay
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> Learn · Practice · Connect
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> Filipino Sign Language
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> 🤟 Wikang Senyas ng Pilipinas
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> Kamusta Ka?
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> 🇵🇭 Deaf Pride Philippines
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> Mahal Kita ✌️
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> Accessibility for All
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> 👐 Salita ng Kamay
            </div>
            <div class="ticker-item">
                <div class="ticker-dot"></div> Learn · Practice · Connect
            </div>
        </div>
    </div>

    <!-- ALPHABET SECTION -->
    <section class="alphabet-section" id="alphabet">
        <div class="section-label">Interactive Alphabet</div>
        <h2 class="section-title reveal">The FSL<br>Finger Alphabet</h2>
        <p class="section-subtitle reveal reveal-delay-1">Tap any letter to see the handshape. Filipino Sign Language uses a unique manual alphabet that blends indigenous Filipino influences with its own visual grammar.</p>

        <div class="alphabet-grid" id="alphabetGrid"></div>
    </section>

    <!-- AWARENESS STRIP -->
    <div class="awareness-strip reveal">
        <div class="awareness-text">
            <h3>🌟 Did you know? FSL is the official sign language of the Philippines</h3>
            <p>Republic Act 11106 (Filipino Sign Language Act) was signed in 2018, recognizing FSL as the national sign language of the Filipino Deaf.</p>
        </div>
        <div class="awareness-icons">
            <div class="awareness-icon">🇵🇭</div>
            <div class="awareness-icon">🤟</div>
            <div class="awareness-icon">⚖️</div>
        </div>
    </div>

    <!-- FEATURES -->
    <section class="features-section" id="features">
        <div style="max-width: 600px;">
            <div class="section-label reveal">Why Choose FSLHub</div>
            <h2 class="section-title reveal reveal-delay-1">Everything You Need<br>to Learn FSL</h2>
            <p class="section-subtitle reveal reveal-delay-2">A complete ecosystem for learning, practicing, and immersing yourself in Filipino Sign Language.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card reveal">
                <div class="feature-icon">🎯</div>
                <div class="feature-title">Adaptive Learning Paths</div>
                <div class="feature-desc">Personalized lessons that adapt to your pace. From complete beginner to advanced — structured curriculum built with deaf educators and community leaders.</div>
            </div>
            <div class="feature-card reveal reveal-delay-1">
                <div class="feature-icon">📸</div>
                <div class="feature-title">AI Hand Recognition</div>
                <div class="feature-desc">Practice in real-time with our camera-based handshape recognition. Get instant feedback and corrections as you sign.</div>
            </div>
            <div class="feature-card reveal reveal-delay-2">
                <div class="feature-icon">🎬</div>
                <div class="feature-title">Video Dictionary</div>
                <div class="feature-desc">2,800+ high-quality FSL sign videos recorded by native deaf signers from across the Philippine archipelago.</div>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon">👥</div>
                <div class="feature-title">Community Practice</div>
                <div class="feature-desc">Join live signing sessions, group video chats, and challenges with our growing community of FSL learners and deaf mentors.</div>
            </div>
            <div class="feature-card reveal reveal-delay-1">
                <div class="feature-icon">🏅</div>
                <div class="feature-title">Gamified Progress</div>
                <div class="feature-desc">Earn badges, maintain streaks, and climb leaderboards as you master each lesson. Learning FSL has never been more engaging.</div>
            </div>
            <div class="feature-card reveal reveal-delay-2">
                <div class="feature-icon">🌐</div>
                <div class="feature-title">Filipino Cultural Context</div>
                <div class="feature-desc">Learn signs within authentic Filipino cultural contexts — festivals, food, family, and everyday life situations across regions.</div>
            </div>
        </div>
    </section>

    <!-- SIGNER SECTION -->
    <section class="signer-section" id="about">
        <div class="signer-grid">
            <div class="signer-visual reveal">
                <div class="signer-figure-bg"></div>
                <!-- Animated FSL figure doing hand signs -->
                <div class="signer-svg-wrap">
                    <svg width="320" height="420" viewBox="0 0 320 420" fill="none" xmlns="http://www.w3.org/2000/svg" id="signerFigure">
                        <!-- Body -->
                        <ellipse cx="160" cy="340" rx="55" ry="60" fill="url(#bodyGrad)" opacity="0.9" />
                        <!-- Torso -->
                        <rect x="118" y="230" width="84" height="120" rx="20" fill="url(#bodyGrad)" />
                        <!-- Neck -->
                        <rect x="148" y="195" width="24" height="38" rx="12" fill="#cffafe" />
                        <!-- Head -->
                        <circle cx="160" cy="168" r="52" fill="url(#headGrad)" />
                        <!-- Face features -->
                        <ellipse cx="145" cy="162" rx="8" ry="9" fill="white" opacity="0.9" />
                        <ellipse cx="175" cy="162" rx="8" ry="9" fill="white" opacity="0.9" />
                        <circle cx="145" cy="164" r="5" fill="#0E7490" />
                        <circle cx="175" cy="164" r="5" fill="#0E7490" />
                        <circle cx="146.5" cy="162.5" r="2" fill="white" />
                        <circle cx="176.5" cy="162.5" r="2" fill="white" />
                        <!-- Smile -->
                        <path d="M146 183 Q160 194 174 183" stroke="#0E7490" stroke-width="2.5" stroke-linecap="round" fill="none" />
                        <!-- Hair hint -->
                        <path d="M110 148 Q112 115 160 112 Q208 110 212 148" fill="#155E75" opacity="0.4" />
                        <!-- LEFT ARM - signing position -->
                        <g id="leftArm">
                            <path d="M118 255 Q80 240 55 210 Q42 196 48 182 Q55 168 70 178 Q84 188 95 208 L118 255Z" fill="url(#armGrad)" />
                            <!-- Left hand signing -->
                            <circle cx="48" cy="178" r="22" fill="url(#handGradL)" />
                            <rect x="40" y="152" width="9" height="26" rx="4.5" fill="#b2ebf2" class="lf1" />
                            <rect x="51" y="148" width="9" height="30" rx="4.5" fill="#b2ebf2" class="lf2" />
                            <rect x="62" y="152" width="9" height="26" rx="4.5" fill="#b2ebf2" class="lf3" />
                        </g>
                        <!-- RIGHT ARM -->
                        <g id="rightArm">
                            <path d="M202 255 Q240 240 265 210 Q278 196 272 182 Q265 168 250 178 Q236 188 225 208 L202 255Z" fill="url(#armGrad)" />
                            <!-- Right hand signing -->
                            <circle cx="272" cy="178" r="22" fill="url(#handGradR)" />
                            <rect x="265" y="152" width="9" height="26" rx="4.5" fill="#cffafe" class="rf1" />
                            <rect x="276" y="148" width="9" height="30" rx="4.5" fill="#cffafe" class="rf2" />
                        </g>
                        <!-- Leg hints -->
                        <rect x="130" y="370" width="30" height="50" rx="14" fill="url(#legGrad)" />
                        <rect x="162" y="370" width="30" height="50" rx="14" fill="url(#legGrad)" />
                        <!-- Motion lines -->
                        <line x1="20" y1="155" x2="40" y2="168" stroke="#22D3EE" stroke-width="2" stroke-dasharray="4 4" opacity="0.5">
                            <animate attributeName="opacity" values="0;0.6;0" dur="1.5s" repeatCount="indefinite" />
                        </line>
                        <line x1="15" y1="175" x2="35" y2="178" stroke="#22D3EE" stroke-width="2" stroke-dasharray="4 4" opacity="0.5">
                            <animate attributeName="opacity" values="0;0.6;0" dur="1.5s" begin="0.3s" repeatCount="indefinite" />
                        </line>
                        <line x1="295" y1="155" x2="280" y2="165" stroke="#0891B2" stroke-width="2" stroke-dasharray="4 4" opacity="0.5">
                            <animate attributeName="opacity" values="0;0.6;0" dur="1.8s" repeatCount="indefinite" />
                        </line>
                        <!-- Glows -->
                        <circle cx="48" cy="178" r="30" fill="rgba(34,211,238,0.1)">
                            <animate attributeName="r" values="28;36;28" dur="2s" repeatCount="indefinite" />
                            <animate attributeName="opacity" values="0.3;0.6;0.3" dur="2s" repeatCount="indefinite" />
                        </circle>
                        <circle cx="272" cy="178" r="30" fill="rgba(14,116,144,0.1)">
                            <animate attributeName="r" values="28;36;28" dur="2.5s" repeatCount="indefinite" />
                            <animate attributeName="opacity" values="0.3;0.6;0.3" dur="2.5s" repeatCount="indefinite" />
                        </circle>
                        <defs>
                            <linearGradient id="headGrad" x1="110" y1="116" x2="210" y2="220">
                                <stop offset="0%" stop-color="#e0f7fa" />
                                <stop offset="100%" stop-color="#b2ebf2" />
                            </linearGradient>
                            <linearGradient id="bodyGrad" x1="118" y1="230" x2="202" y2="400">
                                <stop offset="0%" stop-color="#0E7490" />
                                <stop offset="100%" stop-color="#155E75" />
                            </linearGradient>
                            <linearGradient id="armGrad" x1="0" y1="0" x2="1" y2="0" gradientUnits="objectBoundingBox">
                                <stop offset="0%" stop-color="#0891B2" />
                                <stop offset="100%" stop-color="#0E7490" />
                            </linearGradient>
                            <linearGradient id="handGradL" x1="26" y1="156" x2="70" y2="200">
                                <stop offset="0%" stop-color="#cffafe" />
                                <stop offset="100%" stop-color="#a5f3fc" />
                            </linearGradient>
                            <linearGradient id="handGradR" x1="250" y1="156" x2="294" y2="200">
                                <stop offset="0%" stop-color="#e0f7fa" />
                                <stop offset="100%" stop-color="#b2ebf2" />
                            </linearGradient>
                            <linearGradient id="legGrad" x1="0" y1="0" x2="0" y2="1" gradientUnits="objectBoundingBox">
                                <stop offset="0%" stop-color="#155E75" />
                                <stop offset="100%" stop-color="#0C4A6E" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>

                <!-- Mini hand sign cards -->
                <div class="fsl-hands-row" style="margin-top: 0; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); display: flex; gap: 0.75rem;">
                    <div class="mini-hand-card">
                        <svg viewBox="0 0 80 100">
                            <ellipse cx="40" cy="72" rx="26" ry="22" fill="#cffafe" />
                            <rect x="26" y="30" width="10" height="42" rx="5" fill="#b2ebf2" />
                            <rect x="38" y="22" width="10" height="50" rx="5" fill="#b2ebf2" />
                            <rect x="50" y="28" width="10" height="44" rx="5" fill="#b2ebf2" />
                            <rect x="62" y="36" width="8" height="36" rx="4" fill="#b2ebf2" />
                            <path d="M18 68 Q10 56 12 46 Q14 38 20 36 Q28 34 30 44 Q32 54 28 64Z" fill="#cffafe" />
                        </svg>
                        <div class="mini-hand-label">KAMUSTA</div>
                    </div>
                    <div class="mini-hand-card">
                        <svg viewBox="0 0 80 100">
                            <ellipse cx="40" cy="72" rx="26" ry="22" fill="#a5f3fc" />
                            <rect x="32" y="22" width="10" height="50" rx="5" fill="#b2ebf2" />
                            <rect x="44" y="22" width="10" height="50" rx="5" fill="#b2ebf2" />
                            <rect x="20" y="42" width="8" height="32" rx="4" fill="#b2ebf2" />
                            <rect x="56" y="42" width="8" height="32" rx="4" fill="#b2ebf2" />
                            <rect x="24" y="58" width="8" height="24" rx="4" fill="#b2ebf2" />
                        </svg>
                        <div class="mini-hand-label">MAHAL</div>
                    </div>
                    <div class="mini-hand-card">
                        <svg viewBox="0 0 80 100">
                            <ellipse cx="40" cy="72" rx="26" ry="22" fill="#cffafe" />
                            <rect x="28" y="26" width="10" height="46" rx="5" fill="#b2ebf2" />
                            <rect x="40" y="20" width="10" height="52" rx="5" fill="#b2ebf2" />
                            <rect x="52" y="26" width="10" height="46" rx="5" fill="#b2ebf2" />
                            <path d="M15 65 Q8 52 11 42 Q14 34 21 33 Q29 32 30 44 Q31 54 26 63Z" fill="#a5f3fc" />
                        </svg>
                        <div class="mini-hand-label">SALAMAT</div>
                    </div>
                </div>
            </div>

            <div class="signer-text">
                <div class="section-label reveal">Meet the Language</div>
                <h2 class="section-title reveal reveal-delay-1">A Living Language<br>Born in the Philippines</h2>
                <p class="section-subtitle reveal reveal-delay-2" style="margin-bottom: 1.5rem;">
                    Filipino Sign Language (FSL) is the natural visual-gestural language of the Filipino Deaf community. It evolved organically within deaf schools and communities across the Philippines — distinct from ASL, British, or any other sign language.
                </p>
                <p style="font-size: 0.95rem; color: var(--sl-body-text); line-height: 1.7; margin-bottom: 2rem;" class="reveal reveal-delay-3">
                    With its own grammar, syntax, and rich vocabulary, FSL carries the culture, humor, and soul of the Filipino people. RA 11106 officially recognized it as a national language in 2018 — a historic step for deaf inclusion.
                </p>

                <div class="sign-word-chips reveal">
                    <button class="sign-chip active" onclick="selectChip(this, 'Hello / Kamusta')">Kamusta</button>
                    <button class="sign-chip" onclick="selectChip(this, 'I Love You / Mahal Kita')">Mahal Kita</button>
                    <button class="sign-chip" onclick="selectChip(this, 'Thank You / Salamat')">Salamat</button>
                    <button class="sign-chip" onclick="selectChip(this, 'Philippines / Pilipinas')">Pilipinas</button>
                    <button class="sign-chip" onclick="selectChip(this, 'Family / Pamilya')">Pamilya</button>
                    <button class="sign-chip" onclick="selectChip(this, 'Friend / Kaibigan')">Kaibigan</button>
                </div>
                <div id="chipDisplay" style="margin-top: 1.25rem; padding: 1rem 1.25rem; background: rgba(var(--sl-accent-rgb), 0.08); border-radius: var(--sl-radius); border-left: 3px solid var(--sl-accent); font-size: 0.9rem; color: var(--sl-primary-dark); font-weight: 600;">
                    Now showing: Hello / Kamusta — watch the signer above!
                </div>
            </div>
        </div>
    </section>

    <!-- WHY FSL BENTO -->
    <section class="why-section">
        <div class="section-label reveal">The Bigger Picture</div>
        <h2 class="section-title reveal reveal-delay-1">Why FSL Matters</h2>
        <p class="section-subtitle reveal reveal-delay-2">Sign language isn't just communication — it's identity, culture, and connection.</p>

        <div class="why-bento reveal">
            <div class="bento-card bc-1">
                <div class="bento-label">Community Impact</div>
                <div class="bento-num">120K+</div>
                <div class="bento-title">Deaf Filipinos Served</div>
                <div class="bento-desc" style="margin-top: 0.5rem;">Over 120,000 deaf Filipinos rely on FSL as their primary language for daily communication, education, and community life.</div>
                <div class="bento-decorline"></div>
            </div>
            <div class="bento-card bc-2">
                <div class="bento-icon">⚖️</div>
                <div class="bento-label">Legal Recognition</div>
                <div class="bento-title">Republic Act 11106</div>
                <div class="bento-desc">The FSL Act mandates FSL interpreters in government services, schools, and media — a landmark win for deaf rights in the Philippines.</div>
                <div class="bento-progress">
                    <div class="bento-progress-bar" data-width="85"></div>
                </div>
                <div class="bento-decorline"></div>
            </div>
            <div class="bento-card bc-3">
                <div class="bento-icon">🎓</div>
                <div class="bento-label">Education</div>
                <div class="bento-title">Bilingual Deaf Education</div>
                <div class="bento-desc">FSL is now a medium of instruction in Philippine schools for the deaf, enabling authentic bilingual education.</div>
                <div class="bento-decorline"></div>
            </div>
            <div class="bento-card bc-4">
                <div class="bento-num" style="font-size: 2.5rem;">2018</div>
                <div class="bento-label">Year Recognized</div>
                <div class="bento-desc">RA 11106 signed into law</div>
                <div class="bento-decorline"></div>
            </div>
            <div class="bento-card bc-5">
                <div class="bento-icon">🌺</div>
                <div class="bento-label">Cultural Heritage</div>
                <div class="bento-title">Uniquely Filipino</div>
                <div class="bento-desc">FSL blends influences from American Sign Language (brought by early missionaries) with indigenous Filipino deaf communication evolved over generations of local deaf communities — creating a vibrant, distinctly Filipino language.</div>
                <div class="bento-progress">
                    <div class="bento-progress-bar" data-width="70"></div>
                </div>
                <div class="bento-decorline"></div>
            </div>
            <div class="bento-card bc-6">
                <div class="bento-num" style="font-size: 2.5rem;">7,600+</div>
                <div class="bento-label">Islands</div>
                <div class="bento-title">One Language</div>
                <div class="bento-desc">Unifying deaf Filipinos across the archipelago.</div>
                <div class="bento-decorline"></div>
            </div>
            <div class="bento-card bc-7">
                <div class="bento-icon">💙</div>
                <div class="bento-label">Inclusion</div>
                <div class="bento-title">Breaking Barriers of Silence</div>
                <div class="bento-desc">Learning FSL isn't just for deaf people — it's for anyone who wants to include, connect with, and uplift the deaf community. Every hearing person who learns FSL creates a more inclusive Philippines.</div>
                <div class="bento-progress">
                    <div class="bento-progress-bar" data-width="92"></div>
                </div>
                <div class="bento-decorline"></div>
            </div>
        </div>
    </section>

    <!-- COMMUNITY -->
    <section class="community-section" id="community">
        <div style="text-align: center; max-width: 600px; margin: 0 auto;">
            <div class="section-label reveal" style="justify-content: center;">Stories</div>
            <h2 class="section-title reveal reveal-delay-1">Voices of Our Community</h2>
            <p class="section-subtitle reveal reveal-delay-2" style="margin: 0 auto;">Deaf Filipinos, interpreters, teachers, and families — all united by the language of hands.</p>
        </div>

        <div class="community-cards">
            <div class="community-card reveal">
                <div class="community-avatar">👩‍🦻</div>
                <div class="community-name">Maria Santos</div>
                <div class="community-role">FSL Instructor · Maynila</div>
                <div class="community-quote">"FSL is not just a language — it is our identity, our pride, and our bridge to the world. Teaching it fills my heart with purpose every single day."</div>
                <div class="community-stars">★★★★★</div>
            </div>
            <div class="community-card reveal reveal-delay-1">
                <div class="community-avatar">👨</div>
                <div class="community-name">Rodel Reyes</div>
                <div class="community-role">Parent of a Deaf Child · Cebu</div>
                <div class="community-quote">"Learning FSL changed everything for our family. I can now have real conversations with my daughter — laugh, cry, and share stories in her language."</div>
                <div class="community-stars">★★★★★</div>
            </div>
            <div class="community-card reveal reveal-delay-2">
                <div class="community-avatar">👩</div>
                <div class="community-name">Ana Dela Cruz</div>
                <div class="community-role">Deaf Advocate · Davao</div>
                <div class="community-quote">"When the government passed RA 11106, we cried tears of joy. FSL being recognized is proof that the deaf community's voice — our hands — will never be silenced."</div>
                <div class="community-stars">★★★★★</div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section" id="start">
        <div class="cta-bg-dots"></div>
        <div class="cta-orb cta-orb-1"></div>
        <div class="cta-orb cta-orb-2"></div>
        <div class="cta-content">
            <div class="hero-badge" style="display: inline-flex; margin-bottom: 1.5rem; background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); color: white;">
                <div class="hero-badge-dot" style="background: white;"></div>
                Join 12,000+ learners today
            </div>
            <h2 class="cta-title">Start Your FSL<br>Journey Today 🤟</h2>
            <p class="cta-subtitle">Learn Filipino Sign Language for free and help build a world where every Filipino — hearing and deaf alike — can communicate without barriers.</p>
            <div class="cta-actions">
                <a href="<?php echo base_url('Login'); ?>" class="btn-white">🤟 Start for Free</a>
                <a href="<?php echo base_url('Login'); ?>" class="btn-outline-white">📚 Explore Lessons</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-grid">
            <div>
                <div class="footer-brand-name">🤟 FSLHub</div>
                <p class="footer-brand-desc">Celebrating and preserving Filipino Sign Language — the vibrant visual language of the Philippine Deaf community. Made with love for our deaf brothers and sisters.</p>
                <div class="footer-socials" style="margin-top: 1.5rem;">
                    <a href="#" class="footer-social">📘</a>
                    <a href="#" class="footer-social">📷</a>
                    <a href="#" class="footer-social">🐦</a>
                    <a href="#" class="footer-social">▶</a>
                </div>
            </div>
            <div>
                <div class="footer-heading">Learn</div>
                <ul class="footer-links">
                    <li><a href="#">FSL Alphabet</a></li>
                    <li><a href="#">Basic Signs</a></li>
                    <li><a href="#">Conversations</a></li>
                    <li><a href="#">Advanced Lessons</a></li>
                    <li><a href="#">Video Dictionary</a></li>
                </ul>
            </div>
            <div>
                <div class="footer-heading">Community</div>
                <ul class="footer-links">
                    <li><a href="#">Deaf Stories</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Interpreter Directory</a></li>
                    <li><a href="#">Schools for the Deaf</a></li>
                    <li><a href="#">Advocacy</a></li>
                </ul>
            </div>
            <div>
                <div class="footer-heading">About</div>
                <ul class="footer-links">
                    <li><a href="#">Our Mission</a></li>
                    <li><a href="#">RA 11106</a></li>
                    <li><a href="#">Research</a></li>
                    <li><a href="#">Partners</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© 2025 FSLHub — Made with <span class="footer-heart">🤟</span> for Deaf Filipinos</span>
            <span style="color: rgba(255,255,255,0.4);">Salita ng Kamay, Wika ng Puso</span>
        </div>
    </footer>

    <script>
        // ====== CURSOR ======
        const cursor = document.getElementById('cursor');
        const cursorRing = document.getElementById('cursorRing');
        let mouseX = 0,
            mouseY = 0,
            ringX = 0,
            ringY = 0;
        document.addEventListener('mousemove', e => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            cursor.style.transform = `translate(${mouseX - 6}px, ${mouseY - 6}px)`;
        });

        function animateRing() {
            ringX += (mouseX - ringX) * 0.12;
            ringY += (mouseY - ringY) * 0.12;
            cursorRing.style.transform = `translate(${ringX - 18}px, ${ringY - 18}px)`;
            requestAnimationFrame(animateRing);
        }
        animateRing();
        document.querySelectorAll('a, button, .letter-card, .feature-card, .sign-chip, .mini-hand-card, .community-card').forEach(el => {
            el.addEventListener('mouseenter', () => cursorRing.classList.add('hovered'));
            el.addEventListener('mouseleave', () => cursorRing.classList.remove('hovered'));
        });

        // ====== PARTICLES ======
        const container = document.getElementById('particles');
        for (let i = 0; i < 20; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            p.style.left = Math.random() * 100 + '%';
            p.style.animationDuration = (6 + Math.random() * 12) + 's';
            p.style.animationDelay = (Math.random() * 8) + 's';
            p.style.setProperty('--drift', (Math.random() * 200 - 100) + 'px');
            p.style.width = p.style.height = (2 + Math.random() * 4) + 'px';
            p.style.opacity = Math.random() * 0.6;
            container.appendChild(p);
        }

        // ====== COUNTER ANIMATION ======
        function animateCount(el, target) {
            let current = 0;
            const duration = 2000;
            const step = target / (duration / 16);
            const timer = setInterval(() => {
                current = Math.min(current + step, target);
                el.textContent = Math.floor(current).toLocaleString();
                if (current >= target) clearInterval(timer);
            }, 16);
        }
        const observer = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    const t = parseInt(e.target.dataset.count);
                    animateCount(e.target, t);
                    observer.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.5
        });
        document.querySelectorAll('[data-count]').forEach(el => observer.observe(el));

        // ====== SCROLL REVEAL ======
        const revealObs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('revealed');
                    revealObs.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.15
        });
        document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

        // ====== PROGRESS BARS ======
        const progressObs = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    const bar = e.target.querySelector('.bento-progress-bar');
                    if (bar) {
                        setTimeout(() => {
                            bar.style.width = bar.dataset.width + '%';
                        }, 300);
                    }
                    progressObs.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.3
        });
        document.querySelectorAll('.bento-card').forEach(el => progressObs.observe(el));

        // ====== ALPHABET GRID ======
        const letters = [{
                l: 'A',
                emoji: '✊',
                tag: 'Fist'
            },
            {
                l: 'B',
                emoji: '🖐',
                tag: 'Flat hand'
            },
            {
                l: 'C',
                emoji: '🤏',
                tag: 'Curved'
            },
            {
                l: 'D',
                emoji: '☝️',
                tag: 'Index up'
            },
            {
                l: 'E',
                emoji: '🤞',
                tag: 'Bent'
            },
            {
                l: 'F',
                emoji: '👌',
                tag: 'OK shape'
            },
            {
                l: 'G',
                emoji: '👆',
                tag: 'Point right'
            },
            {
                l: 'H',
                emoji: '🤙',
                tag: 'Two fingers'
            },
            {
                l: 'I',
                emoji: '🤙',
                tag: 'Pinky up'
            },
            {
                l: 'J',
                emoji: '🤙',
                tag: 'J motion'
            },
            {
                l: 'K',
                emoji: '✌️',
                tag: 'Victory'
            },
            {
                l: 'L',
                emoji: '🤟',
                tag: 'L shape'
            },
            {
                l: 'M',
                emoji: '✊',
                tag: 'Three over'
            },
            {
                l: 'N',
                emoji: '✊',
                tag: 'Two over'
            },
            {
                l: 'O',
                emoji: '👌',
                tag: 'Circle'
            },
            {
                l: 'P',
                emoji: '☝️',
                tag: 'P shape'
            },
            {
                l: 'Q',
                emoji: '👇',
                tag: 'Point down'
            },
            {
                l: 'R',
                emoji: '🤞',
                tag: 'Crossed'
            },
            {
                l: 'S',
                emoji: '✊',
                tag: 'Thumb over'
            },
            {
                l: 'T',
                emoji: '✊',
                tag: 'Thumb thru'
            },
            {
                l: 'U',
                emoji: '✌️',
                tag: 'Two up'
            },
            {
                l: 'V',
                emoji: '✌️',
                tag: 'V sign'
            },
            {
                l: 'W',
                emoji: '🖖',
                tag: 'Three up'
            },
            {
                l: 'X',
                emoji: '☝️',
                tag: 'Hook'
            },
            {
                l: 'Y',
                emoji: '🤙',
                tag: 'Y shape'
            },
            {
                l: 'Z',
                emoji: '☝️',
                tag: 'Z trace'
            },
        ];

        const grid = document.getElementById('alphabetGrid');
        letters.forEach(item => {
            const card = document.createElement('div');
            card.className = 'letter-card';
            card.innerHTML = `<span class="letter-hand-icon">${item.emoji}</span><div class="letter-char">${item.l}</div><div class="letter-tag">${item.tag}</div>`;
            card.addEventListener('click', function(e) {
                document.querySelectorAll('.letter-card').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                // Ripple
                const r = document.createElement('div');
                r.className = 'ripple-effect';
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height) * 2;
                r.style.width = r.style.height = size + 'px';
                r.style.left = (e.clientX - rect.left - size / 2) + 'px';
                r.style.top = (e.clientY - rect.top - size / 2) + 'px';
                this.appendChild(r);
                setTimeout(() => r.remove(), 700);
            });
            grid.appendChild(card);
        });

        // ====== SIGN CHIPS ======
        function selectChip(el, label) {
            document.querySelectorAll('.sign-chip').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('chipDisplay').textContent = 'Now showing: ' + label + ' — watch the signer above!';
        }

        // ====== SIGNER ANIMATION - arm wobble on hover ======
        const signerFig = document.getElementById('signerFigure');
        if (signerFig) {
            signerFig.parentElement.addEventListener('mouseenter', () => {
                signerFig.style.animation = 'none';
            });
        }

        // ====== NAV SCROLL EFFECT ======
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 60) {
                nav.style.boxShadow = 'var(--sl-shadow-md)';
                nav.style.borderBottomColor = 'rgba(14,116,144,0.12)';
            } else {
                nav.style.boxShadow = 'none';
                nav.style.borderBottomColor = 'var(--sl-border)';
            }
        });
    </script>
</body>

</html>