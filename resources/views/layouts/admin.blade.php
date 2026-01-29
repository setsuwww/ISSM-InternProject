<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    <link rel="icon" href="">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .menu-item-transition {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .icon-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (max-width: 768px) {
            .sidebar-transition {
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
        }

        @media (max-width: 768px) {
            .overflow-y-auto {
                -webkit-overflow-scrolling: touch;
            }
        }

        .menu-item {
            position: relative;
            overflow: hidden;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(14, 165, 233, 0.1), transparent);
            transition: left 0.5s ease-in-out;
        }

        .menu-item:hover::before {
            left: 100%;
        }

        .menu-item:hover {
            transform: translateX(4px) scale(1.02);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.15);
        }

        .menu-item:active {
            transform: translateX(2px) scale(0.98);
        }

        .menu-item:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.3), 0 4px 12px rgba(14, 165, 233, 0.15);
            transform: translateX(2px);
        }

        .menu-item:focus-visible {
            outline: 2px solid #0ea5e9;
            outline-offset: 2px;
        }

        .menu-item:hover .icon-hover {
            transform: scale(1.15) rotate(5deg);
            filter: drop-shadow(0 2px 4px rgba(14, 165, 233, 0.3));
        }

        .menu-item:active .icon-hover {
            transform: scale(1.05) rotate(-2deg);
        }

        .tooltip {
            pointer-events: none;
            z-index: 9999;
            backdrop-filter: blur(8px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }

        .live-clock {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 1px solid rgba(14, 165, 233, 0.2);
            animation: clockPulse 2s ease-in-out infinite;
        }

        @keyframes clockPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(14, 165, 233, 0.4);
            }

            50% {
                box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
            }
        }

        .btn-primary {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease-in-out;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0) scale(0.98);
        }

        .sidebar-toggle:hover {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            transform: scale(1.1) rotate(180deg);
        }

        @media (max-width: 640px) {
            .menu-item:hover {
                transform: translateX(2px) scale(1.01);
            }
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
        }

        html,
        body {
            overflow-x: hidden;
        }

        .tooltip {
            max-width: calc(100vw - 6rem);
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .tooltip-right {
            left: calc(100% + 0.5rem) !important;
            right: auto !important;
            z-index: 9999;
        }

        aside.sidebar-transition {
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            will-change: transform;
        }
    </style>
</head>

<body class="flex h-screen bg-gray-100">

    <x-admin.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">

        <x-admin.header />

        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            initializeLiveClock();
        });

        document.addEventListener('alpine:init', () => {
            setTimeout(() => {
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            }, 100);
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                document.activeElement.blur();
                const mobileMenuToggle = document.querySelector('[x-data]');
                if (mobileMenuToggle && window.innerWidth < 768) {
                    mobileMenuToggle.__x.$data.mobileMenuOpen = false;
                }
            }

            if (e.altKey && e.key === 's') {
                e.preventDefault();
                const sidebarToggle = document.querySelector('.sidebar-toggle');
                if (sidebarToggle) {
                    sidebarToggle.click();
                }
            }

            if (e.altKey && e.key === 'm' && window.innerWidth < 768) {
                e.preventDefault();
                const mobileToggle = document.querySelector('[x-show="isMobile"]');
                if (mobileToggle) {
                    mobileToggle.click();
                }
            }
        });

        document.documentElement.style.scrollBehavior = 'smooth';

        window.addEventListener('beforeunload', function () {
            document.body.style.opacity = '0.7';
            document.body.style.pointerEvents = 'none';
        });
    </script>

    @stack('scripts')
</body>

</html>