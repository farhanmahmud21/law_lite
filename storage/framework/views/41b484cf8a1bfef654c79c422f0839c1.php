<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('app.name', 'LawLite')); ?> - Bangladesh Legal AI Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <style>
        :root {
            --primary: #0f172a;
            --primary-light: #1e293b;
            --accent: #10b981;
            --accent-light: #34d399;
            --accent-dark: #059669;
            --gold: #f59e0b;
            --purple: #8b5cf6;
            --blue: #3b82f6;
            --pink: #ec4899;
            --muted: #64748b;
            --light-bg: #f8fafc;
            --gradient-primary: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
            --gradient-accent: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --gradient-gold: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            --gradient-purple: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            --gradient-mesh: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --shadow-glow: 0 0 40px rgba(16, 185, 129, 0.3);
            --shadow-glow-purple: 0 0 40px rgba(139, 92, 246, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            background-color: #fff;
            color: #0f172a;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        /* Custom Cursor */
        .custom-cursor {
            width: 20px;
            height: 20px;
            border: 2px solid var(--accent);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.15s ease, opacity 0.15s ease;
            mix-blend-mode: difference;
        }

        /* Modern Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
        ::-webkit-scrollbar-track {
            background: linear-gradient(180deg, #f1f5f9 0%, #e2e8f0 100%);
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--accent) 0%, var(--accent-dark) 100%);
            border-radius: 5px;
            border: 2px solid #f1f5f9;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, var(--accent-dark) 0%, #047857 100%);
        }

        /* Page Loader */
        .page-loader {
            position: fixed;
            inset: 0;
            background: var(--primary);
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .page-loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-content {
            text-align: center;
        }

        .loader-logo {
            width: 80px;
            height: 80px;
            background: var(--gradient-accent);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            animation: pulse-loader 1.5s ease-in-out infinite;
        }

        @keyframes pulse-loader {
            0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
            50% { transform: scale(1.05); box-shadow: 0 0 0 20px rgba(16, 185, 129, 0); }
        }

        .loader-text {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .loader-bar {
            width: 200px;
            height: 4px;
            background: rgba(255,255,255,0.1);
            border-radius: 2px;
            margin: 1rem auto 0;
            overflow: hidden;
        }

        .loader-bar-inner {
            height: 100%;
            background: var(--gradient-accent);
            border-radius: 2px;
            animation: loading-bar 1.5s ease-in-out infinite;
        }

        @keyframes loading-bar {
            0% { width: 0%; margin-left: 0; }
            50% { width: 70%; margin-left: 15%; }
            100% { width: 0%; margin-left: 100%; }
        }

        /* Logo Styles */
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.02);
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            background: var(--gradient-accent);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.4);
            transition: all 0.3s ease;
        }

        .logo:hover .logo-icon {
            box-shadow: var(--shadow-glow);
            transform: rotate(-5deg);
        }

        .logo-icon::before {
            content: '';
            position: absolute;
            inset: 2px;
            background: white;
            border-radius: 12px;
        }

        .logo-icon svg {
            position: relative;
            z-index: 1;
            width: 26px;
            height: 26px;
            transition: transform 0.3s ease;
        }

        .logo:hover .logo-icon svg {
            transform: scale(1.1);
        }

        .logo-text {
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .logo-text .law {
            color: var(--primary);
        }

        .logo-text .lite {
            background: var(--gradient-accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Header */
        .site-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .site-header.scrolled {
            box-shadow: var(--shadow-md);
        }

        /* Navigation */
        .nav-link {
            color: var(--primary) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            color: var(--accent) !important;
            background: rgba(16, 185, 129, 0.08);
        }

        .nav-link.active {
            color: var(--accent) !important;
        }

        /* Buttons with Advanced Animations */
        .btn {
            font-weight: 600;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
            z-index: -1;
        }

        .btn:hover::before {
            transform: translateX(100%);
        }

        .btn-primary {
            background: var(--gradient-accent);
            color: white;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.45);
        }

        .btn-primary:active {
            transform: translateY(-1px) scale(0.98);
        }

        .btn-outline-primary {
            border: 2px solid var(--accent);
            color: var(--accent);
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: var(--accent);
            color: white;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-dark {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.35);
        }

        .btn-dark:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.45);
        }

        .btn-accent {
            background: var(--gradient-gold);
            color: #0b2540;
            font-weight: 700;
        }

        .btn-accent:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.5);
        }

        .btn-glow {
            animation: btn-glow-pulse 2s ease-in-out infinite;
        }

        @keyframes btn-glow-pulse {
            0%, 100% { box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35); }
            50% { box-shadow: 0 4px 30px rgba(16, 185, 129, 0.6); }
        }

        /* Magnetic Button Effect */
        .btn-magnetic {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Cards with 3D Effect */
        .card {
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 20px;
            box-shadow: var(--shadow-sm);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.03) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-2xl);
            transform: translateY(-8px) rotateX(2deg);
            border-color: rgba(16, 185, 129, 0.2);
        }

        .card:hover::before {
            opacity: 1;
        }

        /* Glass Effect Cards */
        .card-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Form Controls with Glow */
        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            padding: 0.875rem 1.25rem;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15), var(--shadow-glow);
            background: white;
            transform: scale(1.01);
        }

        .form-control::placeholder {
            color: #94a3b8;
            transition: opacity 0.3s ease;
        }

        .form-control:focus::placeholder {
            opacity: 0.5;
        }

        /* Text Colors */
        .text-primary {
            color: var(--primary) !important;
        }

        .text-accent {
            color: var(--accent) !important;
        }

        .text-gradient {
            background: var(--gradient-accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Backgrounds */
        .bg-light-section {
            background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
        }

        .bg-gradient-dark {
            background: var(--gradient-primary);
        }

        /* Utilities */
        .small-muted {
            color: var(--muted);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Footer */
        .modern-footer {
            background: var(--gradient-primary);
            position: relative;
            overflow: hidden;
        }

        .modern-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
        }

        .footer-logo .logo-icon {
            background: rgba(255, 255, 255, 0.1);
            box-shadow: none;
        }

        .footer-logo .logo-icon::before {
            background: transparent;
        }

        .footer-logo .logo-icon svg {
            color: var(--accent);
        }

        .footer-logo .logo-text .law {
            color: white;
        }

        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.4); }
            50% { box-shadow: 0 0 40px rgba(16, 185, 129, 0.6); }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        /* Badge Styles */
        .badge-modern {
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            border: 1px solid rgba(16, 185, 129, 0.2);
            transition: all 0.3s ease;
        }

        .badge-modern:hover {
            background: rgba(16, 185, 129, 0.15);
            transform: scale(1.05);
        }

        /* Dropdown with Animation */
        .dropdown-menu {
            border: none;
            border-radius: 16px;
            box-shadow: var(--shadow-2xl);
            padding: 0.75rem;
            animation: dropdown-fade 0.3s ease;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
        }

        @keyframes dropdown-fade {
            from { opacity: 0; transform: translateY(-10px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .dropdown-item {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent);
            transform: translateX(5px);
        }

        /* Scroll Reveal Animations */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal-left.active {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal-right.active {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-scale {
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal-scale.active {
            opacity: 1;
            transform: scale(1);
        }

        /* Stagger Animation */
        .stagger-1 { transition-delay: 0.1s; }
        .stagger-2 { transition-delay: 0.2s; }
        .stagger-3 { transition-delay: 0.3s; }
        .stagger-4 { transition-delay: 0.4s; }
        .stagger-5 { transition-delay: 0.5s; }

        /* Parallax Effect */
        .parallax-bg {
            transition: transform 0.1s linear;
            will-change: transform;
        }

        /* Tilt Effect */
        .tilt-effect {
            transition: transform 0.3s ease;
            transform-style: preserve-3d;
        }

        /* Typing Animation */
        .typing-text {
            overflow: hidden;
            border-right: 3px solid var(--accent);
            white-space: nowrap;
            animation: typing 3s steps(40, end), blink-caret 0.75s step-end infinite;
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: var(--accent); }
        }

        /* Gradient Text Animation */
        .gradient-text-animate {
            background: linear-gradient(90deg, var(--accent), var(--blue), var(--purple), var(--accent));
            background-size: 300% 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient-shift 4s ease infinite;
        }

        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Morphing Background */
        .morph-bg {
            position: absolute;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            animation: morph 8s ease-in-out infinite;
            filter: blur(40px);
        }

        @keyframes morph {
            0% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
            100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
        }

        /* Particle Effect */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: var(--accent);
            border-radius: 50%;
            opacity: 0.3;
            animation: particle-float 15s linear infinite;
        }

        @keyframes particle-float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 0.3; }
            90% { opacity: 0.3; }
            100% { transform: translateY(-100vh) rotate(720deg); opacity: 0; }
        }

        /* Glowing Border */
        .glow-border {
            position: relative;
        }

        .glow-border::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(45deg, var(--accent), var(--blue), var(--purple), var(--accent));
            background-size: 400% 400%;
            border-radius: inherit;
            z-index: -1;
            animation: glow-rotate 3s linear infinite;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .glow-border:hover::before {
            opacity: 1;
        }

        @keyframes glow-rotate {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Ripple Effect */
        .ripple {
            position: relative;
            overflow: hidden;
        }

        .ripple::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            background-image: radial-gradient(circle, var(--accent) 10%, transparent 10.01%);
            background-repeat: no-repeat;
            background-position: 50%;
            transform: scale(10, 10);
            opacity: 0;
            transition: transform 0.5s, opacity 1s;
        }

        .ripple:active::after {
            transform: scale(0, 0);
            opacity: 0.3;
            transition: 0s;
        }

        /* Hover Underline Animation */
        .hover-underline {
            position: relative;
        }

        .hover-underline::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-accent);
            transition: width 0.3s ease;
        }

        .hover-underline:hover::after {
            width: 100%;
        }

        /* Icon Bounce */
        .icon-bounce:hover i {
            animation: icon-bounce 0.5s ease;
        }

        @keyframes icon-bounce {
            0%, 100% { transform: translateY(0); }
            25% { transform: translateY(-5px); }
            50% { transform: translateY(0); }
            75% { transform: translateY(-3px); }
        }

        /* Counter Animation */
        .counter {
            display: inline-block;
        }

        /* Social Icons */
        .social-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .social-icon::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--gradient-accent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }

        .social-icon:hover::before {
            opacity: 1;
        }

        .social-icon i {
            position: relative;
            z-index: 1;
        }

        /* Footer Link Hover */
        .footer-link {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            padding-left: 0;
        }

        .footer-link:hover {
            color: white;
            padding-left: 10px;
        }

        .footer-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 0;
            height: 2px;
            background: var(--accent);
            transform: translateY(-50%);
            transition: width 0.3s ease;
        }

        .footer-link:hover::before {
            width: 5px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .logo-text {
                font-size: 1.35rem;
            }
            .logo-icon {
                width: 40px;
                height: 40px;
            }
            .page-loader .loader-logo {
                width: 60px;
                height: 60px;
            }
        }

        /* Prefers Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-content">
            <div class="loader-logo">
                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="40" height="40">
                    <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                    <path d="M2 17l10 5 10-5"/>
                    <path d="M2 12l10 5 10-5"/>
                </svg>
            </div>
            <div class="loader-text">LawLite</div>
            <div class="loader-bar">
                <div class="loader-bar-inner"></div>
            </div>
        </div>
    </div>

    <!-- Particles Background -->
    <div class="particles" id="particles"></div>

    <?php echo $__env->make('components.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="modern-footer text-white py-5 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0 reveal reveal-left">
                    <a href="<?php echo e(url('/')); ?>" class="logo footer-logo text-decoration-none mb-3 d-inline-flex">
                        <div class="logo-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                                <path d="M2 17l10 5 10-5"/>
                                <path d="M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <span class="logo-text">
                            <span class="law">Law</span><span class="lite">Lite</span>
                        </span>
                    </a>
                    <p class="text-white-50 mt-3"><?php echo e(__('messages.hero_desc')); ?></p>
                    <div class="d-flex gap-2 mt-4">
                        <a href="#" class="social-icon">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-4 mb-md-0 reveal stagger-1">
                    <h6 class="fw-bold mb-3 text-white"><?php echo e(__('messages.footer_platform')); ?></h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo e(route('ai.features')); ?>" class="footer-link">AI Features</a></li>
                        <li class="mb-2"><a href="<?php echo e(route('lawyers.index')); ?>" class="footer-link"><?php echo e(__('messages.find_lawyers')); ?></a></li>
                        <li class="mb-2"><a href="<?php echo e(route('articles.index')); ?>" class="footer-link"><?php echo e(__('messages.articles')); ?></a></li>
                        <li class="mb-2"><a href="<?php echo e(route('appointments.index')); ?>" class="footer-link"><?php echo e(__('messages.appointments')); ?></a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-6 mb-4 mb-md-0 reveal stagger-2">
                    <h6 class="fw-bold mb-3 text-white"><?php echo e(__('messages.footer_company')); ?></h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo e(route('about')); ?>" class="footer-link"><?php echo e(__('messages.footer_about')); ?></a></li>
                        <li class="mb-2"><a href="<?php echo e(route('contact')); ?>" class="footer-link"><?php echo e(__('messages.footer_contact')); ?></a></li>
                        <li class="mb-2"><a href="<?php echo e(route('privacy')); ?>" class="footer-link"><?php echo e(__('messages.footer_privacy')); ?></a></li>
                    </ul>
                </div>
                <div class="col-md-4 reveal reveal-right">
                    <h6 class="fw-bold mb-3 text-white"><?php echo e(__('messages.footer_subscribe')); ?></h6>
                    <p class="text-white-50 small mb-3">Get the latest legal updates and AI features</p>
                    <form class="d-flex gap-2">
                        <input type="email" class="form-control" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white;" placeholder="<?php echo e(__('messages.email_placeholder')); ?>">
                        <button class="btn btn-accent btn-glow" type="button"><?php echo e(__('messages.footer_subscribe_btn')); ?></button>
                    </form>
                </div>
            </div>
            <div class="border-top border-secondary mt-4 pt-4 d-flex flex-wrap justify-content-between align-items-center reveal">
                <small class="text-white-50">&copy; <?php echo e(date('Y')); ?> LawLite. <?php echo e(__('messages.footer_rights')); ?></small>
                <small class="text-white-50">
                    <span class="me-2">🇧🇩</span> Made with <span style="color: #ef4444;">❤</span> for Bangladesh
                </small>
            </div>
        </div>
    </footer>

    <?php echo $__env->make('components.chat_ui', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('components.appointment_modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Page Loader
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('pageLoader').classList.add('hidden');
            }, 800);
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.site-header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Scroll Reveal Animation
        function reveal() {
            const reveals = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
            
            reveals.forEach(element => {
                const windowHeight = window.innerHeight;
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < windowHeight - elementVisible) {
                    element.classList.add('active');
                }
            });
        }

        window.addEventListener('scroll', reveal);
        reveal(); // Initial check

        // Parallax Effect
        window.addEventListener('scroll', function() {
            const parallaxElements = document.querySelectorAll('.parallax-bg');
            parallaxElements.forEach(element => {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.3;
                element.style.transform = `translateY(${rate}px)`;
            });
        });

        // Create Particles
        function createParticles() {
            const container = document.getElementById('particles');
            if (!container) return;
            
            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
                particle.style.animationDelay = Math.random() * 10 + 's';
                particle.style.width = (Math.random() * 4 + 2) + 'px';
                particle.style.height = particle.style.width;
                container.appendChild(particle);
            }
        }

        createParticles();

        // Counter Animation
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, 30);
        }

        // Observe counters
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(entry.target.dataset.target);
                    animateCounter(entry.target, target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.counter').forEach(counter => {
            counterObserver.observe(counter);
        });

        // Tilt Effect
        document.querySelectorAll('.tilt-effect').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = (y - centerY) / 20;
                const rotateY = (centerX - x) / 20;
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
            });
        });

        // Magnetic Button Effect
        document.querySelectorAll('.btn-magnetic').forEach(btn => {
            btn.addEventListener('mousemove', (e) => {
                const rect = btn.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                btn.style.transform = `translate(${x * 0.3}px, ${y * 0.3}px)`;
            });
            
            btn.addEventListener('mouseleave', () => {
                btn.style.transform = 'translate(0, 0)';
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
    <!-- Pusher & Echo (optional - requires Pusher keys in .env) -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.iife.js"></script>
    <script>
        window.LAWLITE_USER_ID = <?php echo e(auth()->id() ?? 'null'); ?>;
        try {
            Pusher.logToConsole = false;
            const echo = new Echo({
                broadcaster: 'pusher',
                key: '<?php echo e(env('PUSHER_APP_KEY')); ?>',
                cluster: '<?php echo e(env('PUSHER_APP_CLUSTER')); ?>',
                forceTLS: true
            });

            if (window.LAWLITE_USER_ID) {
                echo.private('user.' + window.LAWLITE_USER_ID).listen('MessageSent', function(e) {
                    console.log('MessageSent event', e);
                });
            }
        } catch (e) {
            console.warn('Echo/Pusher not configured', e);
        }
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH G:\CG\LawLite\resources\views/layouts/landing.blade.php ENDPATH**/ ?>