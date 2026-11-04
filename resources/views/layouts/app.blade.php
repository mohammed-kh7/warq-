<!DOCTYPE html>
<html lang="ar" dir="rtl">

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
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-6.4.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ofuq-waraq.css') }}">
    @yield('head')
</head>

<body class="ofuq-theme">
    <div id="app">
        @unless($hideNavbar ?? false)
            @include('partials.ofuq-header')
        @endunless

        <main class="content">
            @yield('content')
        </main>

        @unless($hideFooter ?? false)
        @include('layouts.footer')
        @endunless
    </div>
    @include('partials.ai-chatbot')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- أي سكريبتات إضافية -->
    <!-- @stack('scripts') -->
</body>

</html>
