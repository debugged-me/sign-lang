<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FSLHub — Filipino Sign Language</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;0,900;1,400;1,700&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --cream: #fdf8f0;
            --cream-deep: #f5eddb;
            --parchment: #ede3cb;
            --gold: #b8861b;
            --gold-bright: #d4a82a;
            --gold-pale: #f0d898;
            --gold-glow: rgba(184, 134, 27, .18);
            --teal: #0e6674;
            --teal-light: #1a8a9c;
            --teal-pale: #c8eef4;
            --teal-glow: rgba(14, 102, 116, .12);
            --ink: #1a1208;
            --ink-soft: #3d2f1a;
            --body: #4a3f30;
            --muted: #8a7860;
            --border: rgba(184, 134, 27, .18);
            --surface: rgba(255, 252, 245, .85);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            font-size: 16px;
        }

        body {
            background: var(--cream);
            color: var(--ink);
            font-family: 'Jost', sans-serif;
            overflow-x: hidden;
            cursor: none;
        }

        /* CURSOR */
        #cur {
            width: 10px;
            height: 10px;
            background: var(--gold);
            border-radius: 50%;
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 9999;
            transition: transform .07s;
        }

        #cur-ring {
            width: 34px;
            height: 34px;
            border: 1.5px solid var(--gold);
            border-radius: 50%;
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 9998;
            opacity: .45;
            transition: transform .16s cubic-bezier(.23, 1, .32, 1), width .3s, height .3s, opacity .3s;
        }

        #cur-ring.big {
            width: 56px;
            height: 56px;
            opacity: .3;
        }

        /* GRAIN */
        .grain {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 9990;
            opacity: .028;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
        }

        /* FILM BARS */
        .film-bar {
            position: fixed;
            left: 0;
            right: 0;
            height: clamp(18px, 2.8vw, 38px);
            background: var(--ink);
            z-index: 800;
            pointer-events: none;
        }

        .film-bar.top {
            top: 0;
        }

        .film-bar.bot {
            bottom: 0;
        }

        /* NAV */
        nav {
            position: fixed;
            top: clamp(18px, 2.8vw, 38px);
            left: 0;
            right: 0;
            z-index: 700;
            padding: 1.1rem 3.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background .5s, box-shadow .5s;
        }

        nav.scrolled {
            background: rgba(253, 248, 240, .93);
            backdrop-filter: blur(22px);
            box-shadow: 0 1px 0 var(--border);
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: .75rem;
            text-decoration: none;
        }

        .nav-logo-mark {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            border-radius: 8px;
            display: grid;
            place-items: center;
            font-size: 1rem;
            box-shadow: 0 4px 12px var(--teal-glow);
        }

        .nav-logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: .02em;
        }

        .nav-logo-text span {
            color: var(--teal);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            align-items: center;
        }

        .nav-links a {
            font-size: .72rem;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: var(--muted);
            text-decoration: none;
            transition: color .3s;
            font-weight: 500;
        }

        .nav-links a:hover {
            color: var(--teal);
        }

        .nav-cta {
            background: var(--teal) !important;
            color: white !important;
            padding: .5rem 1.4rem;
            border-radius: 999px;
            letter-spacing: .1em !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 16px var(--teal-glow);
            transition: transform .3s, box-shadow .3s !important;
        }

        .nav-cta:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 24px var(--teal-glow) !important;
        }

        ::-webkit-scrollbar {
            width: 3px;
        }

        ::-webkit-scrollbar-track {
            background: var(--cream);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gold);
        }

        /* ── SCENE 1 HERO ── */
        #s1 {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding-top: clamp(18px, 2.8vw, 38px);
        }

        .s1-bg {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 80% 70% at 60% 40%, rgba(212, 168, 42, .1) 0%, transparent 60%), radial-gradient(ellipse 50% 60% at 20% 80%, rgba(14, 102, 116, .07) 0%, transparent 55%), radial-gradient(ellipse 60% 50% at 80% 90%, rgba(184, 134, 27, .06) 0%, transparent 50%), var(--cream);
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
            animation: orbFloat ease-in-out infinite;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            top: -100px;
            right: -80px;
            background: radial-gradient(circle, rgba(212, 168, 42, .13), transparent 70%);
            animation-duration: 14s;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            bottom: -80px;
            left: -60px;
            background: radial-gradient(circle, rgba(14, 102, 116, .1), transparent 70%);
            animation-duration: 11s;
            animation-delay: -4s;
        }

        .orb-3 {
            width: 280px;
            height: 280px;
            top: 35%;
            left: 42%;
            background: radial-gradient(circle, rgba(184, 134, 27, .07), transparent 70%);
            animation-duration: 9s;
            animation-delay: -7s;
        }

        @keyframes orbFloat {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -20px) scale(1.05);
            }

            66% {
                transform: translate(-20px, 15px) scale(.97);
            }
        }

        .s1-grid {
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(184, 134, 27, .05) 1px, transparent 1px), linear-gradient(90deg, rgba(184, 134, 27, .05) 1px, transparent 1px);
            background-size: 64px 64px;
            pointer-events: none;
        }

        .s1-grid-fade {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 80% 80% at 50% 50%, transparent 20%, var(--cream) 100%);
        }

        .mote {
            position: absolute;
            border-radius: 50%;
            background: var(--gold-bright);
            animation: moteDrift linear infinite;
            pointer-events: none;
        }

        @keyframes moteDrift {
            0% {
                transform: translateY(110vh) translateX(0) scale(0);
                opacity: 0;
            }

            8% {
                opacity: .9;
            }

            92% {
                opacity: .4;
            }

            100% {
                transform: translateY(-10vh) translateX(var(--dx, 0px)) scale(1.5);
                opacity: 0;
            }
        }

        .s1-inner {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
            max-width: 1300px;
            width: 100%;
            padding: 0 4rem;
        }

        .s1-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            background: rgba(14, 102, 116, .08);
            border: 1px solid rgba(14, 102, 116, .15);
            color: var(--teal);
            padding: .35rem .95rem;
            border-radius: 999px;
            font-size: .68rem;
            letter-spacing: .2em;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 1.75rem;
            opacity: 0;
            animation: fadeUp .7s .3s ease forwards;
        }

        .s1-ey-dot {
            width: 6px;
            height: 6px;
            background: var(--teal-light);
            border-radius: 50%;
            animation: pulseGlow 2s ease-in-out infinite;
        }

        .s1-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3.2rem, 5.5vw, 5.5rem);
            font-weight: 900;
            line-height: .96;
            letter-spacing: -.02em;
            color: var(--ink);
            margin-bottom: 1.75rem;
            overflow: hidden;
        }

        .s1-title .tline {
            display: block;
            opacity: 0;
            transform: translateY(110%);
            animation: lineUp .85s cubic-bezier(.16, 1, .3, 1) forwards;
        }

        .s1-title .tline:nth-child(1) {
            animation-delay: .4s;
        }

        .s1-title .tline:nth-child(2) {
            animation-delay: .58s;
            font-style: italic;
            color: var(--gold);
        }

        .s1-title .tline:nth-child(3) {
            animation-delay: .74s;
            color: var(--teal);
        }

        .s1-sub {
            font-size: 1rem;
            line-height: 1.8;
            color: var(--body);
            max-width: 440px;
            margin-bottom: 2.5rem;
            opacity: 0;
            animation: fadeUp .7s .9s ease forwards;
        }

        .s1-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            opacity: 0;
            animation: fadeUp .7s 1.1s ease forwards;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            color: white;
            padding: .85rem 2rem;
            border-radius: 999px;
            font-size: .78rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            font-weight: 600;
            text-decoration: none;
            cursor: none;
            box-shadow: 0 8px 28px var(--teal-glow), 0 2px 6px rgba(14, 102, 116, .15);
            transition: transform .3s, box-shadow .3s;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, .18), transparent);
            transform: translateX(-100%);
            transition: transform .5s;
        }

        .btn-primary:hover::before {
            transform: translateX(100%);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 36px rgba(14, 102, 116, .3);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            color: var(--teal);
            padding: .85rem 1.75rem;
            border-radius: 999px;
            border: 1.5px solid rgba(14, 102, 116, .25);
            font-size: .78rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            font-weight: 500;
            text-decoration: none;
            cursor: none;
            transition: all .3s;
        }

        .btn-outline:hover {
            background: rgba(14, 102, 116, .06);
            border-color: var(--teal);
            transform: translateY(-2px);
        }

        /* HERO VISUAL */
        .s1-right {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .s1-visual {
            position: relative;
            width: 460px;
            height: 520px;
        }

        .hero-hand-wrap {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -54%);
            animation: handFloat 5s ease-in-out infinite;
            filter: drop-shadow(0 24px 48px rgba(14, 102, 116, .18)) drop-shadow(0 8px 16px rgba(184, 134, 27, .12));
            z-index: 3;
        }

        @keyframes handFloat {

            0%,
            100% {
                transform: translate(-50%, -54%) translateY(0) rotate(-.5deg);
            }

            50% {
                transform: translate(-50%, -54%) translateY(-14px) rotate(.5deg);
            }
        }

        .hero-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            border: 1px solid rgba(184, 134, 27, .15);
            animation: ringPulse ease-out infinite;
        }

        .hero-ring:nth-child(1) {
            width: 180px;
            height: 180px;
            animation-duration: 3s;
        }

        .hero-ring:nth-child(2) {
            width: 270px;
            height: 270px;
            animation-duration: 3s;
            animation-delay: .8s;
            border-color: rgba(14, 102, 116, .1);
        }

        .hero-ring:nth-child(3) {
            width: 380px;
            height: 380px;
            animation-duration: 3s;
            animation-delay: 1.6s;
            border-color: rgba(184, 134, 27, .07);
        }

        @keyframes ringPulse {
            0% {
                opacity: .7;
                transform: translate(-50%, -50%) scale(.95);
            }

            100% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(1.1);
            }
        }

        .orbit-track {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 340px;
            height: 340px;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            border: 1px dashed rgba(184, 134, 27, .2);
            animation: orbitSpin 20s linear infinite;
        }

        .orbit-dot {
            width: 12px;
            height: 12px;
            background: linear-gradient(135deg, var(--gold), var(--gold-bright));
            border-radius: 50%;
            position: absolute;
            top: -6px;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 0 12px var(--gold-glow);
        }

        .orbit-track-2 {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 240px;
            height: 240px;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            border: 1px dashed rgba(14, 102, 116, .15);
            animation: orbitSpin 14s linear infinite reverse;
        }

        .orbit-dot-2 {
            width: 8px;
            height: 8px;
            background: var(--teal-light);
            border-radius: 50%;
            position: absolute;
            bottom: -4px;
            right: 40px;
            box-shadow: 0 0 8px var(--teal-glow);
        }

        @keyframes orbitSpin {
            from {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .hero-blob {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -52%);
            width: 300px;
            height: 300px;
            background: radial-gradient(ellipse, rgba(14, 102, 116, .08) 0%, rgba(184, 134, 27, .06) 60%, transparent 100%);
            border-radius: 60% 40% 30% 70%/60% 30% 70% 40%;
            animation: blobMorph 8s ease-in-out infinite, handFloat 7s ease-in-out infinite;
            z-index: 1;
        }

        @keyframes blobMorph {

            0%,
            100% {
                border-radius: 60% 40% 30% 70%/60% 30% 70% 40%;
            }

            33% {
                border-radius: 30% 60% 70% 40%/50% 60% 30% 60%;
            }

            66% {
                border-radius: 50% 60% 30% 60%/30% 40% 70% 60%;
            }
        }

        .chip {
            position: absolute;
            background: white;
            border: 1px solid rgba(184, 134, 27, .2);
            border-radius: 999px;
            padding: .45rem 1rem;
            font-size: .78rem;
            font-weight: 600;
            color: var(--teal);
            box-shadow: 0 4px 16px rgba(14, 102, 116, .08), 0 1px 4px rgba(0, 0, 0, .04);
            white-space: nowrap;
            z-index: 4;
            animation: chipFloat ease-in-out infinite;
        }

        .chip-1 {
            top: 6%;
            left: 0%;
            animation-duration: 4.2s;
            animation-delay: 0s;
        }

        .chip-2 {
            top: 18%;
            right: -2%;
            animation-duration: 5s;
            animation-delay: 1.3s;
        }

        .chip-3 {
            bottom: 26%;
            left: -4%;
            animation-duration: 4.7s;
            animation-delay: .7s;
        }

        .chip-4 {
            bottom: 12%;
            right: 4%;
            animation-duration: 3.8s;
            animation-delay: 1.8s;
        }

        @keyframes chipFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .s1-stats {
            display: flex;
            gap: 1.25rem;
            flex-wrap: wrap;
            margin-top: 2.5rem;
            opacity: 0;
            animation: fadeUp .7s 1.3s ease forwards;
        }

        .s1-stat {
            background: white;
            border: 1px solid rgba(184, 134, 27, .15);
            border-radius: 14px;
            padding: .7rem 1.2rem;
            box-shadow: 0 4px 16px rgba(184, 134, 27, .06);
            text-align: center;
        }

        .s1-stat-n {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--teal);
            line-height: 1;
            letter-spacing: -.02em;
        }

        .s1-stat-l {
            font-size: .62rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
            margin-top: .2rem;
        }

        .s1-scroll {
            position: absolute;
            bottom: 2.5rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .6rem;
            opacity: 0;
            animation: fadeUp .7s 1.8s ease forwards;
            color: var(--muted);
            font-size: .65rem;
            letter-spacing: .2em;
            text-transform: uppercase;
        }

        .scroll-mouse {
            width: 22px;
            height: 36px;
            border: 1.5px solid rgba(184, 134, 27, .4);
            border-radius: 11px;
            position: relative;
        }

        .scroll-dot {
            width: 3px;
            height: 7px;
            background: var(--gold);
            border-radius: 999px;
            position: absolute;
            top: 6px;
            left: 50%;
            transform: translateX(-50%);
            animation: scrollBob 1.5s ease-in-out infinite;
        }

        @keyframes scrollBob {

            0%,
            100% {
                top: 6px;
                opacity: 1;
            }

            50% {
                top: 18px;
                opacity: .3;
            }
        }

        /* TICKER */
        .ticker-wrap {
            overflow: hidden;
            padding: .85rem 0;
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            position: relative;
        }

        .ticker-wrap::before,
        .ticker-wrap::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 80px;
            z-index: 2;
        }

        .ticker-wrap::before {
            left: 0;
            background: linear-gradient(90deg, var(--teal), transparent);
        }

        .ticker-wrap::after {
            right: 0;
            background: linear-gradient(-90deg, var(--teal-light), transparent);
        }

        .ticker-track {
            display: flex;
            gap: 3.5rem;
            width: max-content;
            animation: ticker 28s linear infinite;
        }

        .ticker-item {
            display: flex;
            align-items: center;
            gap: .8rem;
            font-size: .68rem;
            letter-spacing: .2em;
            text-transform: uppercase;
            font-weight: 500;
            color: rgba(255, 255, 255, .75);
            white-space: nowrap;
        }

        .tdot {
            width: 4px;
            height: 4px;
            background: var(--gold-pale);
            border-radius: 50%;
            opacity: .7;
        }

        @keyframes ticker {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        /* SCENE 2 — STATS */
        #s2 {
            min-height: 70vh;
            background: linear-gradient(180deg, var(--cream) 0%, white 100%);
            display: flex;
            align-items: center;
            padding: 7rem 4rem;
            position: relative;
            overflow: hidden;
        }

        .s2-bg-num {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Playfair Display', serif;
            font-size: 26vw;
            font-weight: 900;
            color: rgba(184, 134, 27, .04);
            pointer-events: none;
            user-select: none;
            letter-spacing: -.04em;
            white-space: nowrap;
        }

        .s2-inner {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            position: relative;
            z-index: 2;
        }

        .s2-stat {
            text-align: center;
            padding: 3rem 2rem;
            position: relative;
        }

        .s2-stat:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 20%;
            right: 0;
            bottom: 20%;
            width: 1px;
            background: var(--border);
        }

        .s2-num {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 6vw, 5.5rem);
            font-weight: 900;
            line-height: 1;
            letter-spacing: -.03em;
            background: linear-gradient(135deg, var(--teal), var(--gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: .6rem;
        }

        .s2-label {
            font-size: .7rem;
            letter-spacing: .22em;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 500;
        }

        .s2-sub {
            font-size: .85rem;
            color: var(--body);
            margin-top: .5rem;
            line-height: 1.6;
            max-width: 200px;
            margin-left: auto;
            margin-right: auto;
        }

        /* SCENE 3 — HORIZONTAL SCROLL */
        #s3-wrapper {
            position: relative;
        }

        .s3-scroll-space {
            height: 500vh;
        }

        .s3-sticky {
            position: sticky;
            top: clamp(18px, 2.8vw, 38px);
            height: calc(100vh - clamp(36px, 5.6vw, 76px));
            overflow: hidden;
            display: flex;
            align-items: center;
            background: var(--cream-deep);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .s3-bg-pat {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 20% 50%, rgba(14, 102, 116, .05) 0%, transparent 40%), radial-gradient(ellipse at 80% 50%, rgba(184, 134, 27, .05) 0%, transparent 40%);
        }

        .s3-bg-lines {
            position: absolute;
            inset: 0;
            background-image: repeating-linear-gradient(90deg, transparent, transparent 100px, rgba(184, 134, 27, .04) 100px, rgba(184, 134, 27, .04) 101px);
        }

        .s3-label {
            position: absolute;
            top: 50%;
            left: 2.5rem;
            transform: translateY(-50%) rotate(-90deg);
            font-size: .62rem;
            letter-spacing: .3em;
            text-transform: uppercase;
            color: var(--muted);
            white-space: nowrap;
            font-weight: 500;
        }

        .s3-prog-area {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: .65rem;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .s3-pbar {
            width: 140px;
            height: 1px;
            background: var(--parchment);
            position: relative;
        }

        .s3-pfill {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background: linear-gradient(90deg, var(--teal), var(--gold));
            transition: width .08s;
        }

        .s3-track {
            display: flex;
            gap: 4rem;
            padding: 0 12vw;
            width: max-content;
            position: relative;
            z-index: 2;
            will-change: transform;
        }

        .s3-panel {
            flex-shrink: 0;
            width: min(400px, 78vw);
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .s3-panel-no {
            font-size: .68rem;
            letter-spacing: .25em;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: 600;
        }

        .s3-panel-frame {
            width: 100%;
            aspect-ratio: 3/4;
            background: white;
            border: 1px solid rgba(184, 134, 27, .15);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 12px 40px rgba(184, 134, 27, .08), 0 4px 12px rgba(14, 102, 116, .04);
        }

        .s3-panel-frame::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at top left, rgba(14, 102, 116, .06), transparent 50%), radial-gradient(ellipse at bottom right, rgba(184, 134, 27, .06), transparent 50%);
        }

        .fc-corner {
            position: absolute;
            width: 20px;
            height: 20px;
            border-color: rgba(184, 134, 27, .3);
            border-style: solid;
        }

        .fc-corner.tl {
            top: 10px;
            left: 10px;
            border-width: 1.5px 0 0 1.5px;
        }

        .fc-corner.tr {
            top: 10px;
            right: 10px;
            border-width: 1.5px 1.5px 0 0;
        }

        .fc-corner.bl {
            bottom: 10px;
            left: 10px;
            border-width: 0 0 1.5px 1.5px;
        }

        .fc-corner.br {
            bottom: 10px;
            right: 10px;
            border-width: 0 1.5px 1.5px 0;
        }

        .s3-hand-art {
            width: 52%;
            filter: drop-shadow(0 16px 32px rgba(14, 102, 116, .12));
        }

        .s3-panel-word {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -.01em;
        }

        .s3-panel-eng {
            font-size: .7rem;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--teal);
            font-weight: 500;
        }

        .s3-panel-desc {
            font-size: .88rem;
            line-height: 1.8;
            color: var(--body);
            max-width: 340px;
            border-left: 2px solid var(--gold-pale);
            padding-left: 1rem;
        }

        /* SCENE 4 — QUOTE */
        #s4 {
            min-height: 100vh;
            background: linear-gradient(160deg, white 0%, var(--cream) 50%, var(--cream-deep) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6rem 4rem;
            position: relative;
            overflow: hidden;
        }

        .s4-bg-art {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Playfair Display', serif;
            font-size: 22vw;
            font-weight: 900;
            color: rgba(184, 134, 27, .04);
            pointer-events: none;
            user-select: none;
            letter-spacing: -.04em;
            white-space: nowrap;
        }

        .s4-circle {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(184, 134, 27, .08);
        }

        .s4-c1 {
            width: 600px;
            height: 600px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .s4-c2 {
            width: 900px;
            height: 900px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .s4-inner {
            position: relative;
            z-index: 2;
            max-width: 860px;
            text-align: center;
        }

        .s4-ornament {
            font-family: 'Playfair Display', serif;
            font-size: 6rem;
            font-weight: 400;
            color: var(--gold-pale);
            line-height: 1;
            margin-bottom: .5rem;
            display: block;
        }

        .s4-quote {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.6rem, 3.5vw, 2.8rem);
            font-weight: 400;
            font-style: italic;
            line-height: 1.4;
            color: var(--ink);
            margin-bottom: 2rem;
        }

        .s4-quote em {
            font-style: normal;
            color: var(--teal);
            font-weight: 700;
        }

        .s4-rule {
            width: 60px;
            height: 1px;
            background: var(--gold);
            margin: 0 auto 1.5rem;
        }

        .s4-source {
            font-size: .68rem;
            letter-spacing: .28em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .s4-badge {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            color: white;
            padding: .5rem 1.25rem;
            border-radius: 999px;
            font-size: .68rem;
            letter-spacing: .15em;
            text-transform: uppercase;
            font-weight: 600;
            margin-top: 2rem;
            box-shadow: 0 4px 16px var(--teal-glow);
        }

        /* SECTION WIPE */
        .section-wipe {
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, var(--gold-pale) 30%, var(--teal-pale) 70%, transparent 100%);
            opacity: .4;
        }

        /* AWARENESS */
        .awareness {
            background: linear-gradient(135deg, rgba(14, 102, 116, .06), rgba(184, 134, 27, .04));
            border-top: 1px solid rgba(184, 134, 27, .12);
            border-bottom: 1px solid rgba(184, 134, 27, .12);
            padding: 2.5rem 4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .aw-text h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: .3rem;
        }

        .aw-text p {
            font-size: .88rem;
            color: var(--body);
            line-height: 1.65;
            max-width: 540px;
        }

        .aw-icons {
            display: flex;
            gap: .75rem;
            font-size: 1.8rem;
        }

        .aw-icon {
            animation: chipFloat 3s ease-in-out infinite;
        }

        .aw-icon:nth-child(2) {
            animation-delay: .5s;
        }

        .aw-icon:nth-child(3) {
            animation-delay: 1s;
        }

        /* SCENE 5 — ALPHABET */
        #s5 {
            padding: 8rem 4rem;
            background: white;
            position: relative;
            overflow: hidden;
        }

        .s5-header {
            text-align: center;
            margin-bottom: 4rem;
            position: relative;
            z-index: 2;
        }

        .section-eyebrow {
            font-size: .68rem;
            letter-spacing: .3em;
            text-transform: uppercase;
            color: var(--teal);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            font-weight: 700;
            line-height: 1.05;
            color: var(--ink);
        }

        .section-title em {
            font-style: italic;
            color: var(--gold);
        }

        .section-sub {
            font-size: .95rem;
            line-height: 1.75;
            color: var(--body);
            max-width: 500px;
            margin: 1rem auto 0;
        }

        .s5-ghost {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Playfair Display', serif;
            font-size: 40vw;
            font-weight: 900;
            pointer-events: none;
            user-select: none;
            color: rgba(14, 102, 116, .04);
            z-index: 0;
            transition: opacity .4s;
            display: none;
        }

        .alpha-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(96px, 1fr));
            gap: 10px;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .alpha-cell {
            aspect-ratio: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: .35rem;
            background: var(--cream);
            border: 1px solid rgba(184, 134, 27, .1);
            border-radius: 12px;
            cursor: none;
            transition: all .35s cubic-bezier(.34, 1.56, .64, 1);
            position: relative;
            overflow: hidden;
        }

        .alpha-cell::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(14, 102, 116, .06), rgba(184, 134, 27, .06));
            opacity: 0;
            transition: opacity .3s;
            border-radius: 12px;
        }

        .alpha-cell:hover {
            background: white;
            border-color: rgba(14, 102, 116, .2);
            transform: translateY(-6px) scale(1.04);
            box-shadow: 0 12px 32px rgba(14, 102, 116, .1), 0 4px 8px rgba(184, 134, 27, .08);
            z-index: 10;
        }

        .alpha-cell:hover::after {
            opacity: 1;
        }

        .alpha-cell:hover .cell-em {
            transform: scale(1.3) translateY(-3px);
        }

        .alpha-cell:hover .cell-lt {
            color: var(--teal);
        }

        .cell-em {
            font-size: 1.7rem;
            transition: transform .4s cubic-bezier(.34, 1.56, .64, 1);
            position: relative;
            z-index: 1;
        }

        .cell-lt {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--ink-soft);
            transition: color .3s;
            position: relative;
            z-index: 1;
        }

        .cell-tg {
            font-size: .52rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
            position: relative;
            z-index: 1;
        }

        /* SCENE 6 — FEATURES BENTO */
        #s6 {
            padding: 8rem 4rem;
            background: var(--cream);
            position: relative;
            overflow: hidden;
        }

        .s6-bg {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 60% 50% at 85% 20%, rgba(14, 102, 116, .06), transparent 60%), radial-gradient(ellipse 50% 40% at 10% 80%, rgba(184, 134, 27, .06), transparent 55%);
        }

        .s6-header {
            max-width: 1200px;
            margin: 0 auto 4rem;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
        }

        .s6-sub {
            font-size: .9rem;
            line-height: 1.75;
            color: var(--body);
            max-width: 300px;
        }

        .feat-bento {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-template-rows: auto;
            gap: 16px;
            position: relative;
            z-index: 2;
        }

        .fc {
            background: white;
            border: 1px solid rgba(184, 134, 27, .12);
            border-radius: 20px;
            padding: 2.2rem;
            cursor: none;
            position: relative;
            overflow: hidden;
            transition: transform .4s cubic-bezier(.16, 1, .3, 1), box-shadow .4s;
        }

        .fc::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--teal), var(--gold));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .5s cubic-bezier(.16, 1, .3, 1);
        }

        .fc:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(14, 102, 116, .08), 0 4px 12px rgba(184, 134, 27, .06);
        }

        .fc:hover::before {
            transform: scaleX(1);
        }

        .fc:hover .fc-icon {
            transform: scale(1.15) rotate(5deg);
        }

        .fc-a {
            grid-column: span 5;
            grid-row: span 2;
            background: linear-gradient(145deg, var(--teal), var(--teal-light));
            color: white;
        }

        .fc-a::before {
            background: linear-gradient(90deg, rgba(255, 255, 255, .3), rgba(212, 168, 42, .5));
        }

        .fc-b {
            grid-column: span 7;
        }

        .fc-c {
            grid-column: span 4;
        }

        .fc-d {
            grid-column: span 3;
        }

        .fc-e {
            grid-column: span 7;
        }

        .fc-f {
            grid-column: span 5;
        }

        .fc-icon {
            font-size: 2rem;
            margin-bottom: 1.25rem;
            display: block;
            transition: transform .4s cubic-bezier(.34, 1.56, .64, 1);
        }

        .fc-no {
            font-size: .65rem;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: .5rem;
            font-weight: 600;
        }

        .fc-a .fc-no {
            color: rgba(255, 255, 255, .6);
        }

        .fc-name {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: .5rem;
        }

        .fc-a .fc-name {
            color: white;
            font-size: 1.2rem;
            font-family: 'Playfair Display', serif;
            font-style: italic;
        }

        .fc-desc {
            font-size: .85rem;
            line-height: 1.7;
            color: var(--body);
        }

        .fc-a .fc-desc {
            color: rgba(255, 255, 255, .8);
        }

        .fc-bignum {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 900;
            line-height: 1;
            background: linear-gradient(135deg, var(--teal), var(--gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: .25rem;
        }

        .fc-a .fc-bignum {
            background: linear-gradient(135deg, rgba(255, 255, 255, .9), var(--gold-pale));
            -webkit-background-clip: text;
            background-clip: text;
            font-size: 4.5rem;
        }

        /* SCENE 7 — SIGNER */
        #s7 {
            padding: 8rem 4rem;
            background: linear-gradient(180deg, white, var(--cream));
            position: relative;
            overflow: hidden;
        }

        .s7-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6rem;
            align-items: center;
        }

        .s7-visual {
            position: relative;
            height: 520px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .s7-fig-bg {
            position: absolute;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(14, 102, 116, .07) 0%, rgba(184, 134, 27, .05) 60%, transparent 100%);
            animation: orbFloat 7s ease-in-out infinite;
        }

        .s7-svg-wrap {
            position: relative;
            z-index: 2;
            animation: handFloat 5s ease-in-out infinite;
            filter: drop-shadow(0 24px 50px rgba(14, 102, 116, .15));
        }

        .sign-chips {
            display: flex;
            flex-wrap: wrap;
            gap: .65rem;
            margin-top: 1.75rem;
        }

        .schip {
            background: white;
            border: 1.5px solid rgba(14, 102, 116, .15);
            color: var(--body);
            padding: .45rem 1rem;
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 500;
            cursor: none;
            transition: all .3s;
        }

        .schip:hover,
        .schip.active {
            background: linear-gradient(135deg, var(--teal), var(--teal-light));
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px var(--teal-glow);
        }

        .chip-display {
            margin-top: 1.25rem;
            padding: 1rem 1.25rem;
            background: rgba(14, 102, 116, .05);
            border-left: 3px solid var(--teal);
            border-radius: 0 10px 10px 0;
            font-size: .88rem;
            color: var(--teal);
            font-weight: 500;
        }

        /* SCENE 8 — COMMUNITY */
        #s8 {
            padding: 8rem 4rem;
            background: var(--cream-deep);
            position: relative;
            overflow: hidden;
        }

        .s8-bg {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 70% 60% at 50% 50%, rgba(14, 102, 116, .04), transparent 70%);
        }

        .s8-header {
            text-align: center;
            margin-bottom: 5rem;
            position: relative;
            z-index: 2;
        }

        .s8-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .tcard {
            background: white;
            border: 1px solid rgba(184, 134, 27, .1);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            position: relative;
            overflow: hidden;
            cursor: none;
            transition: transform .4s cubic-bezier(.16, 1, .3, 1), box-shadow .4s, border-color .4s;
        }

        .tcard:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 24px 50px rgba(14, 102, 116, .1);
            border-color: rgba(14, 102, 116, .15);
        }

        .tcard::before {
            content: '\201C';
            position: absolute;
            top: .5rem;
            right: 1.5rem;
            font-family: 'Playfair Display', serif;
            font-size: 6rem;
            font-weight: 400;
            color: rgba(184, 134, 27, .1);
            line-height: 1;
        }

        .tc-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--teal-pale), rgba(240, 216, 152, .5));
            border: 2px solid rgba(14, 102, 116, .15);
            display: grid;
            place-items: center;
            font-size: 1.4rem;
            margin-bottom: 1.25rem;
        }

        .tc-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: .2rem;
        }

        .tc-role {
            font-size: .65rem;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: var(--teal);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .tc-quote {
            font-size: .88rem;
            line-height: 1.8;
            color: var(--body);
            font-style: italic;
        }

        .tc-stars {
            margin-top: 1.25rem;
            color: var(--gold-bright);
            letter-spacing: .1em;
            font-size: .8rem;
        }

        /* SCENE 9 — WHY BENTO */
        #s9 {
            padding: 8rem 4rem;
            background: white;
            position: relative;
            overflow: hidden;
        }

        .s9-header {
            max-width: 1200px;
            margin: 0 auto 4rem;
            position: relative;
            z-index: 2;
        }

        .why-bento {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 14px;
            position: relative;
            z-index: 2;
        }

        .wc {
            background: var(--cream);
            border: 1px solid rgba(184, 134, 27, .1);
            border-radius: 20px;
            padding: 2rem;
            cursor: none;
            position: relative;
            overflow: hidden;
            transition: transform .4s cubic-bezier(.16, 1, .3, 1), box-shadow .4s;
        }

        .wc:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(184, 134, 27, .08);
        }

        .wc-a {
            grid-column: span 5;
            grid-row: span 2;
            background: linear-gradient(145deg, var(--teal), var(--teal-light));
            color: white;
        }

        .wc-b {
            grid-column: span 7;
        }

        .wc-c {
            grid-column: span 4;
        }

        .wc-d {
            grid-column: span 3;
        }

        .wc-e {
            grid-column: span 5;
        }

        .wc-f {
            grid-column: span 4;
        }

        .wc-g {
            grid-column: span 5;
        }

        .wc-h {
            grid-column: span 7;
        }

        .wc-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .wc-lbl {
            font-size: .65rem;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: .4rem;
            font-weight: 600;
        }

        .wc-a .wc-lbl {
            color: rgba(255, 255, 255, .55);
        }

        .wc-bignum {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 900;
            line-height: 1;
            margin-bottom: .3rem;
            background: linear-gradient(135deg, var(--teal), var(--gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .wc-a .wc-bignum {
            background: linear-gradient(135deg, rgba(255, 255, 255, .95), var(--gold-pale));
            -webkit-background-clip: text;
            background-clip: text;
            font-size: 4rem;
        }

        .wc-name {
            font-size: 1rem;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: .4rem;
        }

        .wc-a .wc-name {
            color: white;
            font-size: 1.2rem;
            font-family: 'Playfair Display', serif;
        }

        .wc-desc {
            font-size: .83rem;
            line-height: 1.68;
            color: var(--body);
        }

        .wc-a .wc-desc {
            color: rgba(255, 255, 255, .75);
        }

        .wc-bar {
            height: 4px;
            background: rgba(184, 134, 27, .1);
            border-radius: 99px;
            margin-top: 1rem;
            overflow: hidden;
        }

        .wc-bar-fill {
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, var(--teal), var(--gold));
            width: 0;
            transition: width 1.5s cubic-bezier(.16, 1, .3, 1);
        }

        /* SCENE 10 — CTA */
        #s10 {
            min-height: 100vh;
            background: linear-gradient(150deg, var(--cream-deep) 0%, white 50%, var(--cream) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 6rem 4rem;
            position: relative;
            overflow: hidden;
        }

        .s10-rings {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .s10-ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(184, 134, 27, .08);
            transform: translate(-50%, -50%);
        }

        .s10-ring:nth-child(1) {
            width: 300px;
            height: 300px;
        }

        .s10-ring:nth-child(2) {
            width: 500px;
            height: 500px;
            border-color: rgba(14, 102, 116, .06);
        }

        .s10-ring:nth-child(3) {
            width: 750px;
            height: 750px;
            border-color: rgba(184, 134, 27, .04);
        }

        .s10-ring:nth-child(4) {
            width: 1000px;
            height: 1000px;
            border-color: rgba(14, 102, 116, .03);
        }

        .s10-glow {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 400px;
            background: radial-gradient(ellipse, rgba(14, 102, 116, .07) 0%, rgba(184, 134, 27, .05) 40%, transparent 70%);
            pointer-events: none;
            filter: blur(20px);
        }

        .s10-inner {
            position: relative;
            z-index: 2;
            max-width: 800px;
        }

        .s10-hand {
            font-size: 3rem;
            display: block;
            margin-bottom: 1.5rem;
            animation: handFloat 4s ease-in-out infinite;
            filter: drop-shadow(0 6px 12px rgba(14, 102, 116, .15));
        }

        .s10-eyebrow {
            font-size: .68rem;
            letter-spacing: .3em;
            text-transform: uppercase;
            color: var(--teal);
            margin-bottom: 1.75rem;
            font-weight: 600;
        }

        .s10-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 7vw, 7rem);
            font-weight: 900;
            line-height: .95;
            color: var(--ink);
            margin-bottom: 1.5rem;
            letter-spacing: -.02em;
        }

        .s10-title em {
            font-style: italic;
            color: var(--gold);
        }

        .s10-title .tl {
            color: var(--teal);
        }

        .s10-sub {
            font-size: 1rem;
            line-height: 1.8;
            color: var(--body);
            max-width: 500px;
            margin: 0 auto 3rem;
        }

        .s10-btns {
            display: flex;
            gap: 1.25rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* FOOTER */
        footer {
            background: var(--ink);
            color: rgba(245, 240, 232, .6);
            padding: 5rem 4rem 3rem;
        }

        .footer-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 4rem;
            margin-bottom: 3rem;
        }

        .fb-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: .75rem;
            letter-spacing: .02em;
        }

        .fb-name span {
            color: #1a8a9c;
        }

        .fb-desc {
            font-size: .83rem;
            line-height: 1.75;
            max-width: 260px;
        }

        .fh {
            font-size: .62rem;
            letter-spacing: .25em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1.25rem;
            opacity: .75;
        }

        .fl {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: .65rem;
        }

        .fl a {
            font-size: .83rem;
            color: rgba(245, 240, 232, .4);
            text-decoration: none;
            transition: color .3s;
        }

        .fl a:hover {
            color: var(--gold-pale);
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            border-top: 1px solid rgba(245, 240, 232, .06);
            padding-top: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .fcopy {
            font-size: .72rem;
            color: rgba(245, 240, 232, .25);
            letter-spacing: .05em;
        }

        .fmotto {
            font-size: .75rem;
            color: rgba(245, 240, 232, .2);
            font-style: italic;
            font-family: 'Playfair Display', serif;
        }

        /* REVEAL SYSTEM */
        .cr {
            opacity: 0;
            transform: translateY(36px);
            transition: opacity .9s ease, transform .9s cubic-bezier(.16, 1, .3, 1);
        }

        .cr.fl2 {
            transform: translateX(-48px);
        }

        .cr.fr2 {
            transform: translateX(48px);
        }

        .cr.sc {
            transform: scale(.93);
        }

        .cr.vis {
            opacity: 1;
            transform: none;
        }

        .crs .cr:nth-child(1) {
            transition-delay: .05s;
        }

        .crs .cr:nth-child(2) {
            transition-delay: .15s;
        }

        .crs .cr:nth-child(3) {
            transition-delay: .25s;
        }

        .crs .cr:nth-child(4) {
            transition-delay: .35s;
        }

        .crs .cr:nth-child(5) {
            transition-delay: .45s;
        }

        .crs .cr:nth-child(6) {
            transition-delay: .55s;
        }

        .crs .cr:nth-child(7) {
            transition-delay: .65s;
        }

        .crs .cr:nth-child(8) {
            transition-delay: .75s;
        }

        /* KEYFRAMES */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes lineUp {
            from {
                opacity: 0;
                transform: translateY(110%);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulseGlow {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(26, 138, 156, .3);
            }

            50% {
                box-shadow: 0 0 0 6px rgba(26, 138, 156, 0);
            }
        }

        /* RESPONSIVE */
        @media(max-width:900px) {
            .s1-inner {
                grid-template-columns: 1fr;
                padding: 0 2rem;
                text-align: center;
            }

            .s1-right {
                display: none;
            }

            .s1-stats {
                justify-content: center;
            }

            .s2-inner {
                grid-template-columns: 1fr;
            }

            .s2-stat::after {
                display: none;
            }

            .s7-inner {
                grid-template-columns: 1fr;
            }

            .s8-grid {
                grid-template-columns: 1fr;
            }

            .feat-bento,
            .why-bento {
                grid-template-columns: 1fr 1fr;
            }

            .fc-a,
            .wc-a {
                grid-column: span 2;
                grid-row: span 1;
            }

            .fc-b,
            .fc-c,
            .fc-d,
            .fc-e,
            .fc-f,
            .wc-b,
            .wc-c,
            .wc-d,
            .wc-e,
            .wc-f,
            .wc-g,
            .wc-h {
                grid-column: span 2;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }

            section,
            #s5,
            #s6,
            #s7,
            #s8,
            #s9 {
                padding: 5rem 2rem;
            }

            nav {
                padding: 1rem 1.5rem;
            }

            .nav-links {
                display: none;
            }

            .awareness {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    <div id="cur"></div>
    <div id="cur-ring"></div>
    <div class="grain"></div>
    <div class="film-bar top"></div>
    <div class="film-bar bot"></div>

    <nav id="mainNav">
        <a class="nav-logo" href="#">
            <div class="nav-logo-mark">🤟</div>
            <div class="nav-logo-text">FSL<span>Hub</span></div>
        </a>
        <ul class="nav-links">
            <li><a href="#s5">Alphabet</a></li>
            <li><a href="#s6">Features</a></li>
            <li><a href="#s8">Community</a></li>
            <li><a href="#s4">About FSL</a></li>
            <li><a href="#s10" class="nav-cta">Begin Learning →</a></li>
        </ul>
    </nav>

    <!-- HERO -->
    <section id="s1">
        <div class="s1-bg"></div>
        <div class="s1-grid"></div>
        <div class="s1-grid-fade"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div id="moteContainer"></div>
        <div class="s1-inner">
            <div class="s1-left">
                <div class="s1-eyebrow">
                    <div class="s1-ey-dot"></div>Filipino Sign Language · Wikang Senyas
                </div>
                <h1 class="s1-title">
                    <span class="tline">Speak With</span>
                    <span class="tline">Your Hands,</span>
                    <span class="tline">Touch Hearts</span>
                </h1>
                <p class="s1-sub">FSLHub bridges the gap between hearing and deaf communities across the 7,600+ islands of the Philippines. Learn, practice, and celebrate Filipino Sign Language — the living visual language of over 120,000 deaf Filipinos.</p>
                <div class="s1-actions">
                    <a href="Login" class="btn-primary">🤟 Start Learning Free</a>
                    <a href="#s3-wrapper" class="btn-outline">▶ Explore the Signs</a>
                </div>
                <div class="s1-stats">
                    <div class="s1-stat">
                        <div class="s1-stat-n" data-count="120000">0</div>
                        <div class="s1-stat-l">Deaf Filipinos</div>
                    </div>
                    <div class="s1-stat">
                        <div class="s1-stat-n" data-count="2800">0</div>
                        <div class="s1-stat-l">FSL Signs</div>
                    </div>
                    <div class="s1-stat">
                        <div class="s1-stat-n" data-count="2018">0</div>
                        <div class="s1-stat-l">Year Recognized</div>
                    </div>
                </div>
            </div>
            <div class="s1-right">
                <div class="s1-visual">
                    <div class="orbit-track">
                        <div class="orbit-dot"></div>
                    </div>
                    <div class="orbit-track-2">
                        <div class="orbit-dot-2"></div>
                    </div>
                    <div class="hero-ring"></div>
                    <div class="hero-ring"></div>
                    <div class="hero-ring"></div>
                    <div class="hero-blob"></div>
                    <div class="hero-hand-wrap">
                        <svg width="260" height="320" viewBox="0 0 200 260" fill="none">
                            <defs>
                                <linearGradient id="palmG" x1="38" y1="140" x2="162" y2="240" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#c8eef4" />
                                    <stop offset="100%" stop-color="#a0dce8" />
                                </linearGradient>
                                <linearGradient id="fingG" x1="0" y1="0" x2="0" y2="1" gradientUnits="objectBoundingBox">
                                    <stop offset="0%" stop-color="#e0f7fa" />
                                    <stop offset="100%" stop-color="#b2ebf2" />
                                </linearGradient>
                            </defs>
                            <ellipse cx="100" cy="248" rx="50" ry="8" fill="rgba(14,102,116,.1)" />
                            <rect x="68" y="220" width="65" height="38" rx="18" fill="url(#palmG)" />
                            <ellipse cx="100" cy="186" rx="62" ry="52" fill="url(#palmG)" />
                            <path d="M42 172 Q28 155 25 138 Q22 120 32 112 Q44 107 52 122 Q58 137 56 158 Z" fill="url(#fingG)" stroke="rgba(14,102,116,.15)" stroke-width=".5" />
                            <rect x="68" y="88" width="22" height="88" rx="11" fill="url(#fingG)" stroke="rgba(14,102,116,.12)" stroke-width=".5" />
                            <rect x="93" y="72" width="22" height="104" rx="11" fill="url(#fingG)" stroke="rgba(14,102,116,.12)" stroke-width=".5" />
                            <rect x="118" y="82" width="22" height="94" rx="11" fill="url(#fingG)" stroke="rgba(14,102,116,.12)" stroke-width=".5" />
                            <rect x="143" y="98" width="18" height="80" rx="9" fill="url(#fingG)" stroke="rgba(14,102,116,.1)" stroke-width=".5" />
                            <ellipse cx="79" cy="175" rx="10" ry="5" fill="rgba(14,102,116,.08)" />
                            <ellipse cx="104" cy="175" rx="10" ry="5" fill="rgba(14,102,116,.08)" />
                            <ellipse cx="129" cy="175" rx="10" ry="5" fill="rgba(14,102,116,.08)" />
                            <ellipse cx="95" cy="148" rx="28" ry="16" fill="rgba(255,255,255,.3)" />
                            <circle cx="30" cy="88" r="4" fill="#1a8a9c" opacity=".6">
                                <animate attributeName="opacity" values=".6;.1;.6" dur="2s" repeatCount="indefinite" />
                                <animate attributeName="r" values="4;6;4" dur="2s" repeatCount="indefinite" />
                            </circle>
                            <circle cx="172" cy="58" r="3" fill="#b8861b" opacity=".5">
                                <animate attributeName="opacity" values=".5;.1;.5" dur="2.8s" repeatCount="indefinite" />
                            </circle>
                            <circle cx="52" cy="52" r="2.5" fill="#0e6674" opacity=".5">
                                <animate attributeName="opacity" values=".5;0;.5" dur="1.9s" repeatCount="indefinite" />
                            </circle>
                        </svg>
                    </div>
                    <div class="chip chip-1">🤙 Kamusta</div>
                    <div class="chip chip-2">✌️ Peace</div>
                    <div class="chip chip-3">🤝 Magkaisa</div>
                    <div class="chip chip-4">👐 Pag-ibig</div>
                </div>
            </div>
        </div>
        <div class="s1-scroll">
            <div class="scroll-mouse">
                <div class="scroll-dot"></div>
            </div><span>Scroll to explore</span>
        </div>
    </section>

    <!-- TICKER -->
    <div class="ticker-wrap">
        <div class="ticker-track">
            <div class="ticker-item">
                <div class="tdot"></div>Filipino Sign Language
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>Wikang Senyas ng Pilipinas
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>Kamusta Ka — How Are You
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>🇵🇭 Deaf Pride Philippines
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>Mahal Kita — I Love You
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>Republic Act 11106
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>Salita ng Kamay — Language of Hands
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>Learn · Practice · Connect · Celebrate
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>Filipino Sign Language
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>Wikang Senyas ng Pilipinas
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>Kamusta Ka — How Are You
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>🇵🇭 Deaf Pride Philippines
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>Mahal Kita — I Love You
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>Republic Act 11106
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>Salita ng Kamay — Language of Hands
            </div>
            <div class="ticker-item">
                <div class="tdot"></div>Learn · Practice · Connect · Celebrate
            </div>
        </div>
    </div>

    <!-- STATS -->
    <section id="s2">
        <div class="s2-bg-num">FSL</div>
        <div class="s2-inner crs">
            <div class="s2-stat cr">
                <div class="s2-num"><span data-count="120000">0</span>+</div>
                <div class="s2-label">Deaf Filipinos</div>
                <div class="s2-sub">Rely on FSL as their primary language for daily life</div>
            </div>
            <div class="s2-stat cr">
                <div class="s2-num"><span data-count="2800">0</span>+</div>
                <div class="s2-label">Signs Documented</div>
                <div class="s2-sub">High-quality videos by native deaf signers nationwide</div>
            </div>
            <div class="s2-stat cr">
                <div class="s2-num"><span data-count="2018">0</span></div>
                <div class="s2-label">Year Recognized</div>
                <div class="s2-sub">RA 11106 — the landmark law for deaf rights in PH</div>
            </div>
        </div>
    </section>

    <div class="section-wipe"></div>

    <!-- HORIZONTAL SCROLL SIGNS -->
    <div id="s3-wrapper">
        <div class="s3-scroll-space">
            <div class="s3-sticky" id="s3sticky">
                <div class="s3-bg-pat"></div>
                <div class="s3-bg-lines"></div>
                <div class="s3-label">The Signs of FSL</div>
                <div class="s3-track" id="s3track">
                    <div class="s3-panel">
                        <div class="s3-panel-no">001 / 006</div>
                        <div class="s3-panel-frame">
                            <div class="fc-corner tl"></div>
                            <div class="fc-corner tr"></div>
                            <div class="fc-corner bl"></div>
                            <div class="fc-corner br"></div>
                            <svg class="s3-hand-art" viewBox="0 0 120 160" fill="none">
                                <defs>
                                    <linearGradient id="hg1" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#c8eef4" />
                                        <stop offset="100%" stop-color="#8fd4e2" />
                                    </linearGradient>
                                </defs>
                                <ellipse cx="60" cy="126" rx="40" ry="28" fill="url(#hg1)" opacity=".8" />
                                <rect x="36" y="52" width="14" height="68" rx="7" fill="url(#hg1)" />
                                <rect x="52" y="40" width="14" height="80" rx="7" fill="url(#hg1)" />
                                <rect x="68" y="48" width="14" height="72" rx="7" fill="url(#hg1)" />
                                <rect x="84" y="58" width="12" height="62" rx="6" fill="url(#hg1)" opacity=".85" />
                                <path d="M22 120 Q12 106 14 93 Q17 82 26 81 Q36 80 37 93 Q38 104 33 116Z" fill="url(#hg1)" />
                                <ellipse cx="60" cy="98" rx="20" ry="11" fill="rgba(255,255,255,.25)" />
                                <circle cx="22" cy="55" r="3" fill="#1a8a9c" opacity=".5">
                                    <animate attributeName="opacity" values=".5;.1;.5" dur="2s" repeatCount="indefinite" />
                                </circle>
                            </svg>
                        </div>
                        <div class="s3-panel-word">Kamusta</div>
                        <div class="s3-panel-eng">Hello / How Are You</div>
                        <div class="s3-panel-desc">A flat open hand raised to the forehead, then swept forward in a graceful arc — the greeting that opens every conversation in the Filipino Deaf community.</div>
                    </div>
                    <div class="s3-panel">
                        <div class="s3-panel-no">002 / 006</div>
                        <div class="s3-panel-frame">
                            <div class="fc-corner tl"></div>
                            <div class="fc-corner tr"></div>
                            <div class="fc-corner bl"></div>
                            <div class="fc-corner br"></div>
                            <svg class="s3-hand-art" viewBox="0 0 120 160" fill="none">
                                <defs>
                                    <linearGradient id="hg2" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#d4e8f0" />
                                        <stop offset="100%" stop-color="#a0ccd8" />
                                    </linearGradient>
                                </defs>
                                <ellipse cx="60" cy="126" rx="40" ry="28" fill="url(#hg2)" opacity=".8" />
                                <rect x="44" y="36" width="14" height="84" rx="7" fill="url(#hg2)" />
                                <rect x="60" y="36" width="14" height="84" rx="7" fill="url(#hg2)" />
                                <rect x="20" y="68" width="12" height="52" rx="6" fill="url(#hg2)" opacity=".8" />
                                <rect x="76" y="68" width="12" height="52" rx="6" fill="url(#hg2)" opacity=".8" />
                                <rect x="24" y="88" width="12" height="32" rx="6" fill="url(#hg2)" opacity=".65" />
                                <ellipse cx="60" cy="100" rx="20" ry="11" fill="rgba(255,255,255,.25)" />
                            </svg>
                        </div>
                        <div class="s3-panel-word">Mahal Kita</div>
                        <div class="s3-panel-eng">I Love You</div>
                        <div class="s3-panel-desc">Index finger, pinky, and thumb extended — a gesture of the heart, made uniquely Filipino in expression and carried across generations.</div>
                    </div>
                    <div class="s3-panel">
                        <div class="s3-panel-no">003 / 006</div>
                        <div class="s3-panel-frame">
                            <div class="fc-corner tl"></div>
                            <div class="fc-corner tr"></div>
                            <div class="fc-corner bl"></div>
                            <div class="fc-corner br"></div>
                            <svg class="s3-hand-art" viewBox="0 0 120 160" fill="none">
                                <defs>
                                    <linearGradient id="hg3" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#c8eef4" />
                                        <stop offset="100%" stop-color="#a0d8e0" />
                                    </linearGradient>
                                </defs>
                                <ellipse cx="60" cy="126" rx="40" ry="28" fill="url(#hg3)" opacity=".8" />
                                <ellipse cx="60" cy="88" rx="34" ry="42" fill="url(#hg3)" opacity=".7" />
                                <rect x="46" y="44" width="14" height="48" rx="7" fill="url(#hg3)" />
                                <rect x="62" y="36" width="14" height="56" rx="7" fill="url(#hg3)" />
                                <path d="M28 110 Q18 96 20 84 Q23 74 32 73 Q42 72 43 85 Q44 97 38 108Z" fill="url(#hg3)" opacity=".85" />
                                <ellipse cx="60" cy="100" rx="18" ry="10" fill="rgba(255,255,255,.25)" />
                            </svg>
                        </div>
                        <div class="s3-panel-word">Salamat</div>
                        <div class="s3-panel-eng">Thank You</div>
                        <div class="s3-panel-desc">Fingers together touching the chin, then flowing gracefully outward — gratitude given form, a bow of appreciation made beautifully visible.</div>
                    </div>
                    <div class="s3-panel">
                        <div class="s3-panel-no">004 / 006</div>
                        <div class="s3-panel-frame">
                            <div class="fc-corner tl"></div>
                            <div class="fc-corner tr"></div>
                            <div class="fc-corner bl"></div>
                            <div class="fc-corner br"></div>
                            <svg class="s3-hand-art" viewBox="0 0 120 160" fill="none">
                                <ellipse cx="60" cy="126" rx="40" ry="28" fill="#c8eef4" opacity=".8" />
                                <rect x="36" y="50" width="14" height="72" rx="7" fill="#c8eef4" />
                                <rect x="52" y="42" width="14" height="80" rx="7" fill="#c8eef4" />
                                <rect x="68" y="48" width="14" height="74" rx="7" fill="#c8eef4" />
                                <rect x="84" y="60" width="12" height="62" rx="6" fill="#c8eef4" opacity=".85" />
                                <path d="M18 122 Q8 108 10 95 Q13 84 22 83 Q32 82 33 95 Q34 106 28 118Z" fill="#c8eef4" opacity=".85" />
                                <ellipse cx="60" cy="98" rx="20" ry="11" fill="rgba(255,255,255,.25)" />
                            </svg>
                        </div>
                        <div class="s3-panel-word">Pamilya</div>
                        <div class="s3-panel-eng">Family</div>
                        <div class="s3-panel-desc">Both hands forming an unbroken circle — the boundless, unbreakable bond of the Filipino family, captured in a single timeless gesture.</div>
                    </div>
                    <div class="s3-panel">
                        <div class="s3-panel-no">005 / 006</div>
                        <div class="s3-panel-frame">
                            <div class="fc-corner tl"></div>
                            <div class="fc-corner tr"></div>
                            <div class="fc-corner bl"></div>
                            <div class="fc-corner br"></div>
                            <svg class="s3-hand-art" viewBox="0 0 120 160" fill="none">
                                <ellipse cx="60" cy="126" rx="40" ry="28" fill="#c8eef4" opacity=".8" />
                                <rect x="42" y="38" width="14" height="82" rx="7" fill="#c8eef4" />
                                <ellipse cx="60" cy="82" rx="32" ry="40" fill="#c8eef4" opacity=".5" />
                                <path d="M72 68 Q84 53 90 45 Q96 38 102 43 Q108 49 103 61 Q98 73 85 82 L72 87Z" fill="#c8eef4" />
                                <ellipse cx="60" cy="99" rx="18" ry="10" fill="rgba(255,255,255,.25)" />
                            </svg>
                        </div>
                        <div class="s3-panel-word">Kaibigan</div>
                        <div class="s3-panel-eng">Friend</div>
                        <div class="s3-panel-desc">Hooked index fingers interlock and release — two lives momentarily yet meaningfully entwined, capturing the warmth of Filipino friendship.</div>
                    </div>
                    <div class="s3-panel">
                        <div class="s3-panel-no">006 / 006</div>
                        <div class="s3-panel-frame">
                            <div class="fc-corner tl"></div>
                            <div class="fc-corner tr"></div>
                            <div class="fc-corner bl"></div>
                            <div class="fc-corner br"></div>
                            <svg class="s3-hand-art" viewBox="0 0 120 160" fill="none">
                                <ellipse cx="60" cy="126" rx="40" ry="28" fill="#c8eef4" opacity=".8" />
                                <rect x="46" y="44" width="14" height="76" rx="7" fill="#c8eef4" />
                                <path d="M72 95 Q88 79 95 69 Q102 59 108 64 Q114 69 109 82 Q103 95 88 106 L72 110Z" fill="#c8eef4" />
                                <rect x="30" y="56" width="12" height="66" rx="6" fill="#c8eef4" opacity=".8" />
                                <ellipse cx="60" cy="100" rx="18" ry="10" fill="rgba(255,255,255,.25)" />
                            </svg>
                        </div>
                        <div class="s3-panel-word">Pilipinas</div>
                        <div class="s3-panel-eng">Philippines</div>
                        <div class="s3-panel-desc">The P handshape — representing the proud archipelago that gave birth to this vibrant, distinctly Filipino language of the hands.</div>
                    </div>
                </div>
                <div class="s3-prog-area"><span id="s3counter">01</span>
                    <div class="s3-pbar">
                        <div class="s3-pfill" id="s3fill"></div>
                    </div><span>06</span>
                </div>
            </div>
        </div>
    </div>

    <div class="section-wipe"></div>

    <!-- QUOTE -->
    <section id="s4">
        <div class="s4-circle s4-c1"></div>
        <div class="s4-circle s4-c2"></div>
        <div class="s4-bg-art">FSL</div>
        <div class="s4-inner">
            <span class="s4-ornament cr">"</span>
            <p class="s4-quote cr">Filipino Sign Language is hereby recognized as the <em>national sign language</em> of the Filipino Deaf and the <em>official sign language</em> of the government.</p>
            <div class="s4-rule cr"></div>
            <div class="s4-source cr">Republic Act No. 11106 · The Filipino Sign Language Act · Signed 2018</div>
            <div class="s4-badge cr">⚖️ A Historic Victory for Deaf Rights</div>
        </div>
    </section>

    <div class="section-wipe"></div>

    <!-- AWARENESS -->
    <div class="awareness cr">
        <div class="aw-text">
            <h3>🌟 Did you know? FSL is the official sign language of the Philippines</h3>
            <p>Republic Act 11106 mandates FSL interpreters in government services, public media, and schools — a landmark step toward a truly inclusive Philippines where no voice goes unheard.</p>
        </div>
        <div class="aw-icons">
            <div class="aw-icon">🇵🇭</div>
            <div class="aw-icon">🤟</div>
            <div class="aw-icon">⚖️</div>
        </div>
    </div>

    <!-- ALPHABET -->
    <section id="s5">
        <div class="s5-header">
            <div class="section-eyebrow cr">Manual Alphabet</div>
            <h2 class="section-title cr">The <em>Finger Alphabet</em><br>of Filipino Sign Language</h2>
            <p class="section-sub cr">Hover any letter to see it come alive. Each handshape carries the soul of Filipino deaf culture and identity.</p>
        </div>
        <div class="alpha-grid crs" id="alphaGrid"></div>
        <div class="s5-ghost" id="ghostLetter">A</div>
    </section>

    <div class="section-wipe"></div>

    <!-- FEATURES BENTO -->
    <section id="s6">
        <div class="s6-bg"></div>
        <div class="s6-header">
            <div>
                <div class="section-eyebrow cr">Platform Features</div>
                <h2 class="section-title cr">A Complete<br><em>FSL Ecosystem</em></h2>
            </div>
            <p class="s6-sub cr">Everything you need to learn, practice, and immerse yourself in Filipino Sign Language — built with and for the Filipino Deaf community.</p>
        </div>
        <div class="feat-bento crs">
            <div class="fc fc-a cr"><span class="fc-icon">🤟</span>
                <div class="fc-no">Flagship</div>
                <div class="fc-bignum">FSL</div>
                <div class="fc-name">Your Complete Learning Hub</div>
                <div class="fc-desc">From your very first handshape to fluid, expressive signing — FSLHub is the most comprehensive Filipino Sign Language platform ever built, designed with and for the Filipino Deaf community.</div>
            </div>
            <div class="fc fc-b cr"><span class="fc-icon">📸</span>
                <div class="fc-no">02</div>
                <div class="fc-name">AI Hand Recognition</div>
                <div class="fc-desc">Real-time camera-based handshape recognition gives you instant, accurate feedback as you practice — like having a deaf mentor by your side, 24/7.</div>
            </div>
            <div class="fc fc-c cr"><span class="fc-icon">🎯</span>
                <div class="fc-no">03</div>
                <div class="fc-name">Adaptive Learning</div>
                <div class="fc-desc">Curriculum built with deaf educators. Personalizes to your pace, from first sign to full fluency.</div>
            </div>
            <div class="fc fc-d cr"><span class="fc-icon">🎬</span>
                <div class="fc-no">04</div>
                <div class="fc-bignum" style="font-size:2rem;">2,800+</div>
                <div class="fc-name">Video Signs</div>
                <div class="fc-desc">Native deaf signers. Every region.</div>
            </div>
            <div class="fc fc-e cr"><span class="fc-icon">👥</span>
                <div class="fc-no">05</div>
                <div class="fc-name">Live Community Practice</div>
                <div class="fc-desc">Join live signing sessions, group video chats, and weekly challenges with FSL learners and deaf mentors from across the archipelago.</div>
            </div>
            <div class="fc fc-f cr"><span class="fc-icon">🌺</span>
                <div class="fc-no">06</div>
                <div class="fc-name">Cultural Context</div>
                <div class="fc-desc">Signs within authentic Filipino cultural contexts — festivals, food, family, everyday life across all 7,600 islands.</div>
            </div>
        </div>
    </section>

    <div class="section-wipe"></div>

    <!-- SIGNER + ABOUT -->
    <section id="s7">
        <div class="s7-inner">
            <div class="s7-visual cr sc">
                <div class="s7-fig-bg"></div>
                <div class="s7-svg-wrap">
                    <svg width="300" height="400" viewBox="0 0 320 420" fill="none">
                        <defs>
                            <linearGradient id="hG2" x1="110" y1="116" x2="210" y2="220">
                                <stop offset="0%" stop-color="#e0f7fa" />
                                <stop offset="100%" stop-color="#b2ebf2" />
                            </linearGradient>
                            <linearGradient id="bG2" x1="118" y1="230" x2="202" y2="400">
                                <stop offset="0%" stop-color="#0e6674" />
                                <stop offset="100%" stop-color="#155E75" />
                            </linearGradient>
                            <linearGradient id="aG2" x1="0" y1="0" x2="1" y2="0" gradientUnits="objectBoundingBox">
                                <stop offset="0%" stop-color="#1a8a9c" />
                                <stop offset="100%" stop-color="#0e6674" />
                            </linearGradient>
                            <linearGradient id="lG2" x1="0" y1="0" x2="0" y2="1" gradientUnits="objectBoundingBox">
                                <stop offset="0%" stop-color="#155E75" />
                                <stop offset="100%" stop-color="#0C4A6E" />
                            </linearGradient>
                        </defs>
                        <ellipse cx="160" cy="415" rx="60" ry="8" fill="rgba(14,102,116,.08)" />
                        <rect x="128" y="368" width="32" height="52" rx="14" fill="url(#lG2)" />
                        <rect x="162" y="368" width="32" height="52" rx="14" fill="url(#lG2)" />
                        <ellipse cx="160" cy="340" rx="55" ry="58" fill="url(#bG2)" opacity=".9" />
                        <rect x="118" y="228" width="84" height="122" rx="20" fill="url(#bG2)" />
                        <rect x="148" y="194" width="24" height="38" rx="12" fill="#c8eef4" />
                        <circle cx="160" cy="168" r="52" fill="url(#hG2)" />
                        <ellipse cx="145" cy="162" rx="8" ry="9" fill="white" opacity=".9" />
                        <ellipse cx="175" cy="162" rx="8" ry="9" fill="white" opacity=".9" />
                        <circle cx="145" cy="164" r="5" fill="#0e6674" />
                        <circle cx="175" cy="164" r="5" fill="#0e6674" />
                        <circle cx="146.5" cy="162.5" r="2" fill="white" />
                        <circle cx="176.5" cy="162.5" r="2" fill="white" />
                        <path d="M146 183 Q160 194 174 183" stroke="#0e6674" stroke-width="2.5" stroke-linecap="round" fill="none" />
                        <path d="M110 148 Q112 115 160 112 Q208 110 212 148" fill="#155E75" opacity=".35" />
                        <path d="M118 255 Q80 240 55 210 Q42 196 48 182 Q55 168 70 178 Q84 188 95 208 L118 255Z" fill="url(#aG2)" />
                        <circle cx="48" cy="178" r="22" fill="#c8eef4" />
                        <rect x="40" y="153" width="9" height="26" rx="4.5" fill="#b2ebf2" />
                        <rect x="51" y="149" width="9" height="30" rx="4.5" fill="#b2ebf2" />
                        <rect x="62" y="153" width="9" height="26" rx="4.5" fill="#b2ebf2" />
                        <path d="M202 255 Q240 240 265 210 Q278 196 272 182 Q265 168 250 178 Q236 188 225 208 L202 255Z" fill="url(#aG2)" />
                        <circle cx="272" cy="178" r="22" fill="#e0f7fa" />
                        <rect x="265" y="153" width="9" height="26" rx="4.5" fill="#c8eef4" />
                        <rect x="276" y="149" width="9" height="30" rx="4.5" fill="#c8eef4" />
                        <circle cx="48" cy="178" r="30" fill="rgba(14,102,116,.06)">
                            <animate attributeName="r" values="28;38;28" dur="2.2s" repeatCount="indefinite" />
                            <animate attributeName="opacity" values=".3;.7;.3" dur="2.2s" repeatCount="indefinite" />
                        </circle>
                        <circle cx="272" cy="178" r="30" fill="rgba(184,134,27,.06)">
                            <animate attributeName="r" values="28;38;28" dur="2.8s" repeatCount="indefinite" />
                            <animate attributeName="opacity" values=".3;.7;.3" dur="2.8s" repeatCount="indefinite" />
                        </circle>
                        <line x1="18" y1="155" x2="36" y2="168" stroke="#1a8a9c" stroke-width="1.5" stroke-dasharray="4 4">
                            <animate attributeName="opacity" values="0;.6;0" dur="1.5s" repeatCount="indefinite" />
                        </line>
                        <line x1="14" y1="175" x2="33" y2="178" stroke="#1a8a9c" stroke-width="1.5" stroke-dasharray="4 4">
                            <animate attributeName="opacity" values="0;.6;0" dur="1.5s" begin=".3s" repeatCount="indefinite" />
                        </line>
                    </svg>
                </div>
            </div>
            <div class="s7-text">
                <div class="section-eyebrow cr" style="margin-bottom:1rem;">A Living Language</div>
                <h2 class="section-title cr" style="font-size:clamp(2rem,4vw,3.5rem);margin-bottom:1.5rem;">Born in the<br><em>Philippines</em></h2>
                <p class="cr" style="font-size:.95rem;line-height:1.8;color:var(--body);margin-bottom:1.25rem;">Filipino Sign Language (FSL) is the natural visual-gestural language of the Filipino Deaf community. It evolved organically within deaf schools and communities — distinct from ASL, British, or any other sign language in the world.</p>
                <p class="cr" style="font-size:.95rem;line-height:1.8;color:var(--body);margin-bottom:2rem;">With its own grammar, syntax, and rich vocabulary, FSL carries the culture, humor, and soul of the Filipino people. RA 11106 officially recognized it as a national language in 2018 — a historic step for deaf inclusion and cultural pride.</p>
                <div class="sign-chips cr">
                    <button class="schip active" onclick="selectChip(this,'Hello / Kamusta')">Kamusta</button>
                    <button class="schip" onclick="selectChip(this,'I Love You / Mahal Kita')">Mahal Kita</button>
                    <button class="schip" onclick="selectChip(this,'Thank You / Salamat')">Salamat</button>
                    <button class="schip" onclick="selectChip(this,'Philippines / Pilipinas')">Pilipinas</button>
                    <button class="schip" onclick="selectChip(this,'Family / Pamilya')">Pamilya</button>
                    <button class="schip" onclick="selectChip(this,'Friend / Kaibigan')">Kaibigan</button>
                </div>
                <div class="chip-display cr" id="chipDisplay">Now showing: Hello / Kamusta — watch the signer above!</div>
            </div>
        </div>
    </section>

    <div class="section-wipe"></div>

    <!-- COMMUNITY -->
    <section id="s8">
        <div class="s8-bg"></div>
        <div class="s8-header">
            <div class="section-eyebrow cr">Voices of FSLHub</div>
            <h2 class="section-title cr">Stories of <em>Connection</em></h2>
        </div>
        <div class="s8-grid crs">
            <div class="tcard cr">
                <div class="tc-avatar">👩‍🦻</div>
                <div class="tc-name">Maria Santos</div>
                <div class="tc-role">FSL Instructor · Maynila</div>
                <div class="tc-quote">"FSL is not just a language — it is our identity, our pride, and our bridge to the world. Teaching it fills my heart with purpose every single day."</div>
                <div class="tc-stars">★★★★★</div>
            </div>
            <div class="tcard cr">
                <div class="tc-avatar">👨</div>
                <div class="tc-name">Rodel Reyes</div>
                <div class="tc-role">Parent of a Deaf Child · Cebu</div>
                <div class="tc-quote">"Learning FSL changed everything for our family. I can now have real conversations with my daughter — laugh, cry, and share stories in her language."</div>
                <div class="tc-stars">★★★★★</div>
            </div>
            <div class="tcard cr">
                <div class="tc-avatar">👩</div>
                <div class="tc-name">Ana Dela Cruz</div>
                <div class="tc-role">Deaf Advocate · Davao</div>
                <div class="tc-quote">"When RA 11106 was signed, we cried tears of joy. FSL being recognized is proof that our voice — our hands — will never be silenced again."</div>
                <div class="tc-stars">★★★★★</div>
            </div>
        </div>
    </section>

    <div class="section-wipe"></div>

    <!-- WHY FSL BENTO -->
    <section id="s9">
        <div class="s9-header">
            <div class="section-eyebrow cr">The Bigger Picture</div>
            <h2 class="section-title cr">Why <em>FSL</em> Matters</h2>
        </div>
        <div class="why-bento crs">
            <div class="wc wc-a cr">
                <div class="wc-lbl">Community Impact</div>
                <div class="wc-bignum">120K+</div>
                <div class="wc-name">Deaf Filipinos Served</div>
                <div class="wc-desc">Over 120,000 deaf Filipinos rely on FSL as their primary language for daily communication, education, and community life across the archipelago.</div>
            </div>
            <div class="wc wc-b cr">
                <div class="wc-icon">⚖️</div>
                <div class="wc-lbl">Legal Recognition</div>
                <div class="wc-name">Republic Act 11106</div>
                <div class="wc-desc">The FSL Act mandates interpreters in government, schools, and media — a landmark win for deaf rights in the Philippines.</div>
                <div class="wc-bar">
                    <div class="wc-bar-fill" data-width="85"></div>
                </div>
            </div>
            <div class="wc wc-c cr">
                <div class="wc-icon">🎓</div>
                <div class="wc-lbl">Education</div>
                <div class="wc-name">Bilingual Deaf Education</div>
                <div class="wc-desc">FSL is now a medium of instruction in Philippine schools for the deaf, enabling authentic bilingual learning nationwide.</div>
            </div>
            <div class="wc wc-d cr">
                <div class="wc-bignum" style="font-size:2.2rem;">2018</div>
                <div class="wc-lbl">Recognized</div>
                <div class="wc-desc">RA 11106 signed into law</div>
            </div>
            <div class="wc wc-e cr">
                <div class="wc-icon">🌺</div>
                <div class="wc-lbl">Cultural Heritage</div>
                <div class="wc-name">Uniquely Filipino</div>
                <div class="wc-desc">FSL blends early missionary influences with generations of indigenous Filipino deaf communication — a distinctly Filipino language born from the community itself.</div>
                <div class="wc-bar">
                    <div class="wc-bar-fill" data-width="70"></div>
                </div>
            </div>
            <div class="wc wc-f cr">
                <div class="wc-bignum" style="font-size:2rem;">7,600+</div>
                <div class="wc-lbl">Islands</div>
                <div class="wc-name">One Language</div>
                <div class="wc-desc">Unifying deaf Filipinos across the entire archipelago.</div>
            </div>
            <div class="wc wc-g cr">
                <div class="wc-icon">💙</div>
                <div class="wc-lbl">Inclusion</div>
                <div class="wc-name">Breaking Barriers</div>
                <div class="wc-desc">Every hearing person who learns FSL creates a more inclusive Philippines where no Filipino is left unheard.</div>
            </div>
            <div class="wc wc-h cr">
                <div class="wc-icon">🏅</div>
                <div class="wc-lbl">Gamified Learning</div>
                <div class="wc-name">Progress That Feels Like Play</div>
                <div class="wc-desc">Earn badges, maintain streaks, climb leaderboards. Structured achievement milestones make the journey to FSL fluency genuinely joyful.</div>
                <div class="wc-bar">
                    <div class="wc-bar-fill" data-width="90"></div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-wipe"></div>

    <!-- CTA -->
    <section id="s10">
        <div class="s10-rings">
            <div class="s10-ring"></div>
            <div class="s10-ring"></div>
            <div class="s10-ring"></div>
            <div class="s10-ring"></div>
        </div>
        <div class="s10-glow"></div>
        <div class="s10-inner">
            <span class="s10-hand cr">🤟</span>
            <div class="s10-eyebrow cr">Join 12,000+ Learners</div>
            <h2 class="s10-title cr">Start Your<br><em>FSL</em><br><span class="tl">Journey</span></h2>
            <p class="s10-sub cr">Learn Filipino Sign Language for free and help build a Philippines where every Filipino — hearing and deaf alike — can communicate without barriers.</p>
            <div class="s10-btns cr">
                <a href="Login" class="btn-primary" style="font-size:.8rem;padding:1rem 2.2rem;">🤟 Start for Free</a>
                <a href="#s5" class="btn-outline" style="font-size:.8rem;padding:1rem 2rem;">📚 Explore Lessons</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-grid">
            <div>
                <div class="fb-name">🤟 FSL<span>Hub</span></div>
                <p class="fb-desc">Celebrating and preserving Filipino Sign Language — the vibrant visual language of the Philippine Deaf community. Made with love for our deaf brothers and sisters.</p>
            </div>
            <div>
                <div class="fh">Learn</div>
                <ul class="fl">
                    <li><a href="#">FSL Alphabet</a></li>
                    <li><a href="#">Basic Signs</a></li>
                    <li><a href="#">Conversations</a></li>
                    <li><a href="#">Advanced Lessons</a></li>
                    <li><a href="#">Video Dictionary</a></li>
                </ul>
            </div>
            <div>
                <div class="fh">Community</div>
                <ul class="fl">
                    <li><a href="#">Deaf Stories</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Interpreter Directory</a></li>
                    <li><a href="#">Advocacy</a></li>
                </ul>
            </div>
            <div>
                <div class="fh">About</div>
                <ul class="fl">
                    <li><a href="#">Our Mission</a></li>
                    <li><a href="#">RA 11106</a></li>
                    <li><a href="#">Research</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom"><span class="fcopy">© 2025 FSLHub — Made with 🤟 for Deaf Filipinos</span><span class="fmotto">Salita ng Kamay, Wika ng Puso</span></div>
    </footer>

    <style>
        .s10-hand {
            font-size: 3rem;
            display: block;
            margin-bottom: 1.5rem;
            animation: handFloat 4s ease-in-out infinite;
            filter: drop-shadow(0 6px 12px rgba(14, 102, 116, .15));
        }

        .s10-eyebrow {
            font-size: .68rem;
            letter-spacing: .3em;
            text-transform: uppercase;
            color: var(--teal);
            margin-bottom: 1.75rem;
            font-weight: 600;
        }

        .s10-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 7vw, 7rem);
            font-weight: 900;
            line-height: .95;
            color: var(--ink);
            margin-bottom: 1.5rem;
            letter-spacing: -.02em;
        }

        .s10-title em {
            font-style: italic;
            color: var(--gold);
        }

        .s10-title .tl {
            color: var(--teal);
        }

        .s10-sub {
            font-size: 1rem;
            line-height: 1.8;
            color: var(--body);
            max-width: 500px;
            margin: 0 auto 3rem;
        }

        .s10-btns {
            display: flex;
            gap: 1.25rem;
            justify-content: center;
            flex-wrap: wrap;
        }
    </style>

    <script>
        /* CURSOR */
        const cur = document.getElementById('cur'),
            ring = document.getElementById('cur-ring');
        let mx = 0,
            my = 0,
            rx = 0,
            ry = 0;
        document.addEventListener('mousemove', e => {
            mx = e.clientX;
            my = e.clientY;
            cur.style.transform = `translate(${mx-5}px,${my-5}px)`;
        });
        (function animR() {
            rx += (mx - rx) * .12;
            ry += (my - ry) * .12;
            ring.style.transform = `translate(${rx-17}px,${ry-17}px)`;
            requestAnimationFrame(animR);
        })();
        document.querySelectorAll('a,button,.alpha-cell,.fc,.wc,.tcard').forEach(el => {
            el.addEventListener('mouseenter', () => ring.classList.add('big'));
            el.addEventListener('mouseleave', () => ring.classList.remove('big'));
        });

        /* NAV */
        window.addEventListener('scroll', () => {
            document.getElementById('mainNav').classList.toggle('scrolled', scrollY > 80);
        }, {
            passive: true
        });

        /* DUST MOTES */
        const mc = document.getElementById('moteContainer');
        for (let i = 0; i < 24; i++) {
            const m = document.createElement('div');
            m.className = 'mote';
            m.style.cssText = `left:${Math.random()*100}%;width:${1+Math.random()*3}px;height:${1+Math.random()*3}px;animation-duration:${10+Math.random()*18}s;animation-delay:${Math.random()*14}s;opacity:${Math.random()*.4};`;
            m.style.setProperty('--dx', (Math.random() * 160 - 80) + 'px');
            mc.appendChild(m);
        }

        /* COUNTERS */
        function animCount(el, target) {
            let c = 0;
            const step = target / (2200 / 16);
            const t = setInterval(() => {
                c = Math.min(c + step, target);
                el.textContent = Math.floor(c).toLocaleString();
                if (c >= target) clearInterval(t);
            }, 16);
        }
        const cntObs = new IntersectionObserver(ents => {
            ents.forEach(e => {
                if (e.isIntersecting) {
                    animCount(e.target, +e.target.dataset.count);
                    cntObs.unobserve(e.target);
                }
            });
        }, {
            threshold: .4
        });
        document.querySelectorAll('[data-count]').forEach(el => cntObs.observe(el));

        /* REVEAL */
        const revObs = new IntersectionObserver(ents => {
            ents.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('vis');
                    revObs.unobserve(e.target);
                }
            });
        }, {
            threshold: .1
        });
        document.querySelectorAll('.cr').forEach(el => revObs.observe(el));

        /* PROGRESS BARS */
        const pbObs = new IntersectionObserver(ents => {
            ents.forEach(e => {
                if (e.isIntersecting) {
                    const b = e.target.querySelector('.wc-bar-fill');
                    if (b) setTimeout(() => {
                        b.style.width = b.dataset.width + '%';
                    }, 400);
                    pbObs.unobserve(e.target);
                }
            });
        }, {
            threshold: .3
        });
        document.querySelectorAll('.wc').forEach(el => pbObs.observe(el));

        /* HORIZONTAL SCROLL */
        function updateH() {
            const w = document.getElementById('s3-wrapper');
            if (!w) return;
            const r = w.getBoundingClientRect();
            const total = w.offsetHeight - window.innerHeight;
            const scrolled = Math.max(0, -r.top);
            const prog = Math.min(1, Math.max(0, scrolled / total));
            const track = document.getElementById('s3track');
            const maxTx = -(track.scrollWidth - window.innerWidth + 120);
            track.style.transform = `translateX(${prog*maxTx}px)`;
            document.getElementById('s3fill').style.width = (prog * 100) + '%';
            document.getElementById('s3counter').textContent = String(Math.min(6, Math.floor(prog * 6) + 1)).padStart(2, '0');
        }
        window.addEventListener('scroll', updateH, {
            passive: true
        });
        updateH();

        /* PARALLAX */
        window.addEventListener('scroll', () => {
            const y = scrollY;
            document.querySelectorAll('.orb').forEach((o, i) => {
                o.style.transform = `translateY(${y*(0.06+i*0.02)}px)`;
            });
        }, {
            passive: true
        });

        /* ALPHABET */
        const letters = [{
                l: 'A',
                e: '✊',
                t: 'Fist'
            }, {
                l: 'B',
                e: '🖐',
                t: 'Flat hand'
            }, {
                l: 'C',
                e: '🤏',
                t: 'Curved'
            },
            {
                l: 'D',
                e: '☝️',
                t: 'Index up'
            }, {
                l: 'E',
                e: '🤞',
                t: 'Bent'
            }, {
                l: 'F',
                e: '👌',
                t: 'OK shape'
            },
            {
                l: 'G',
                e: '👆',
                t: 'Point right'
            }, {
                l: 'H',
                e: '🤙',
                t: 'Two fingers'
            }, {
                l: 'I',
                e: '🤙',
                t: 'Pinky up'
            },
            {
                l: 'J',
                e: '🤙',
                t: 'J motion'
            }, {
                l: 'K',
                e: '✌️',
                t: 'Victory'
            }, {
                l: 'L',
                e: '🤟',
                t: 'L shape'
            },
            {
                l: 'M',
                e: '✊',
                t: 'Three over'
            }, {
                l: 'N',
                e: '✊',
                t: 'Two over'
            }, {
                l: 'O',
                e: '👌',
                t: 'Circle'
            },
            {
                l: 'P',
                e: '☝️',
                t: 'P shape'
            }, {
                l: 'Q',
                e: '👇',
                t: 'Point down'
            }, {
                l: 'R',
                e: '🤞',
                t: 'Crossed'
            },
            {
                l: 'S',
                e: '✊',
                t: 'Thumb over'
            }, {
                l: 'T',
                e: '✊',
                t: 'Thumb thru'
            }, {
                l: 'U',
                e: '✌️',
                t: 'Two up'
            },
            {
                l: 'V',
                e: '✌️',
                t: 'V sign'
            }, {
                l: 'W',
                e: '🖖',
                t: 'Three up'
            }, {
                l: 'X',
                e: '☝️',
                t: 'Hook'
            },
            {
                l: 'Y',
                e: '🤙',
                t: 'Y shape'
            }, {
                l: 'Z',
                e: '☝️',
                t: 'Z trace'
            }
        ];
        const ghost = document.getElementById('ghostLetter');
        const grid = document.getElementById('alphaGrid');
        letters.forEach(item => {
            const cell = document.createElement('div');
            cell.className = 'alpha-cell cr';
            cell.innerHTML = `<span class="cell-em">${item.e}</span><div class="cell-lt">${item.l}</div><div class="cell-tg">${item.t}</div>`;
            cell.addEventListener('mouseenter', () => {
                ghost.textContent = item.l;
                ghost.style.display = 'block';
            });
            cell.addEventListener('mouseleave', () => {
                ghost.style.display = 'none';
            });
            grid.appendChild(cell);
            revObs.observe(cell);
        });

        /* CHIPS */
        function selectChip(el, label) {
            document.querySelectorAll('.schip').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('chipDisplay').textContent = 'Now showing: ' + label + ' — watch the signer above!';
        }
    </script>
</body>

</html>