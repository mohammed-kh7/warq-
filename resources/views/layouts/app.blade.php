<!DOCTYPE html>
<html @class(['landing-viewport-lock' => $fillViewportHero ?? false])>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $__pageTitle = trim($__env->yieldContent('title'));
        $__appName = config('app.name');
        $__docTitle = ($__pageTitle === '' || $__pageTitle === $__appName) ? $__appName : $__pageTitle . ' — ' . $__appName;
    @endphp
    <title>{{ $__docTitle }}</title>
    <link rel="icon" href="{{ asset('images/logo2.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo2.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-6.4.2-web/css/all.min.css') }}">
    @yield('head')
</head>

<body @class(['page-landing-index' => $fillViewportHero ?? false])>
    <div id="app">
        @unless($hideNavbar ?? false)
        @guest
        <nav class="navbar navbar-expand-lg app-navbar">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand d-flex align-items-center me-3" href="{{ auth()->check() ? route('homePage') : route('landing') }}">
                        <img src="{{ asset('images/logo2.png') }}" alt="{{ config('app.name') }}" class="navbar-logo-img" style="height: 63px; width: auto;">
                        <span class="text-white navbar-brand-text">{{ config('app.name') }}</span>
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ auth()->check() ? route('homePage') : route('landing') }}">الصفحة الرئيسية</a>
                        </li>
                    </ul>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="تبديل التنقل">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">تسجيل</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">تسجيل الدخول</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @else
        <nav class="navbar navbar-expand-lg app-navbar">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand d-flex align-items-center me-3" href="{{ auth()->check() ? route('homePage') : route('landing') }}">
                        <img src="{{ asset('images/logo2.png') }}" alt="{{ config('app.name') }}" class="navbar-logo-img" style="height: 63px; width: auto;">
                        <span class="text-white navbar-brand-text">{{ config('app.name') }}</span>
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ auth()->check() ? route('homePage') : route('landing') }}">الصفحة الرئيسية</a>
                        </li>
                    </ul>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="تبديل التنقل">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item me-3 position-relative">
                            <a class="nav-link text-white position-relative" href="
{{ route('notification.index') }}">
                                <i class="fas fa-bell" style="font-size: 1.5rem;"></i>
                                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle">
                                    {{ auth()->user()->unreadNotifications->count()}}
                                </span>
                            </a>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="/" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ url('profile') }}"><i class="fas fa-user"></i>الملف الشخصي</a></li>
                                <li><a class="dropdown-item" href="{{ url('/user/myProducts') }}"><i class="fas fa-book"></i> كتبي</a></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>تسجيل الخروج</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @endguest
        @endunless

        <main class="content">
            @yield('content')
        </main>

        @unless($hideFooter ?? false)
        @include('layouts.footer')
        @endunless
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- أي سكريبتات إضافية -->
    <!-- @stack('scripts') -->
</body>

</html>
