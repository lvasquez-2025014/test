<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Prime T'))</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}?v={{ file_exists(public_path('vendor/fontawesome-free/css/all.min.css')) ? filemtime(public_path('vendor/fontawesome-free/css/all.min.css')) : time() }}">

    <!-- Custom Dashboard Styles -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}?v={{ file_exists(public_path('css/dashboard.css')) ? filemtime(public_path('css/dashboard.css')) : time() }}">
    @yield('styles')
    @yield('css')
</head>
<body>
    <!-- Toast Notifications Flotantes (Superior Derecha) -->
    @if(session('success') || session('error') || session('status'))
        <div class="toast-floating-container" id="toastFloatingContainer">
            @if(session('success'))
                <div class="saas-toast saas-toast-success" role="alert">
                    <div class="saas-toast-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="saas-toast-message">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="saas-toast-close" onclick="this.closest('.saas-toast').remove()" aria-label="Cerrar">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="saas-toast saas-toast-danger" role="alert">
                    <div class="saas-toast-icon">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                    <div class="saas-toast-message">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="saas-toast-close" onclick="this.closest('.saas-toast').remove()" aria-label="Cerrar">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif
            @if(session('status'))
                <div class="saas-toast saas-toast-success" role="alert">
                    <div class="saas-toast-icon">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="saas-toast-message">
                        {{ session('status') }}
                    </div>
                    <button type="button" class="saas-toast-close" onclick="this.closest('.saas-toast').remove()" aria-label="Cerrar">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif
        </div>
    @endif

    <div class="app-wrapper">
        <!-- Sidebar Modular -->
        @include('components.sidebar')

        <!-- Contenido Central -->
        <div class="app-main">
            <main class="main-content">
                @hasSection('content_header')
                    <div class="content-header">
                        @yield('content_header')
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Vendor Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Scripts del Dashboard -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    @yield('scripts')
    @yield('js')
    @stack('scripts')
    <!-- Auto-hide Toasts en 3 segundos -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toasts = document.querySelectorAll('.saas-toast');
            if (toasts.length > 0) {
                setTimeout(function () {
                    toasts.forEach(toast => {
                        toast.classList.add('toast-hiding');
                        setTimeout(() => toast.remove(), 350);
                    });
                }, 3000);
            }
        });
    </script>
</body>
</html>
