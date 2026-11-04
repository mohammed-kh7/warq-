<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم — ' . config('app.name'))</title>
    <link rel="icon" href="{{ asset('images/waraq-logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-6.4.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ofuq-waraq.css') }}">
    @yield('head')
</head>

<body class="ofuq-theme">
    <main class="dashboard-page">
        <div class="dashboard-layout">
            <!-- Figma Sidebar -->
            <aside class="dashboard-sidebar">
                <a href="{{ url('/') }}" class="brand" aria-label="أُفُق">
                    <img src="{{ asset('images/waraq-logo.png') }}" alt="أُفُق">
                    <span>أُفُق</span>
                </a>

                <nav aria-label="قائمة لوحة التحكم">
                    <a href="{{ route('homePage') }}" @class(['active' => request()->routeIs('homePage')])>
                        <i class="fas fa-th-large" style="font-size: 14px;"></i>
                        <span>نظرة عامة</span>
                    </a>
                    <a href="{{ route('user.myProducts') }}" @class(['active' => request()->routeIs('user.myProducts')])>
                        <i class="fas fa-graduation-cap" style="font-size: 14px;"></i>
                        <span>دوراتي</span>
                    </a>
                    <a href="{{ route('myLibrary.index') }}" @class(['active' => request()->routeIs('myLibrary.*')])>
                        <i class="fas fa-book" style="font-size: 14px;"></i>
                        <span>مكتبتي</span>
                    </a>
                    <a href="{{ route('favorites.index') }}" @class(['active' => request()->routeIs('favorites.*')])>
                        <i class="far fa-heart" style="font-size: 14px;"></i>
                        <span>المفضلة</span>
                    </a>
                    <a href="{{ route('profile.show') }}" @class(['active' => request()->routeIs('profile.*')])>
                        <i class="far fa-user" style="font-size: 14px;"></i>
                        <span>حسابي</span>
                    </a>
                </nav>

                <a href="{{ url('/') }}" class="back-home">
                    <i class="fas fa-arrow-right"></i>
                    <span>العودة للرئيسية</span>
                </a>
            </aside>

            <!-- Dashboard Main Container -->
            <section class="dashboard-main">
                <!-- Topbar with Date, Title & Profile Pill -->
                <div class="dashboard-top">
                    <div>
                        <span class="eyebrow">
                            @php
                                $arabicDays = ['Sunday'=>'الأحد', 'Monday'=>'الإثنين', 'Tuesday'=>'الثلاثاء', 'Wednesday'=>'الأربعاء', 'Thursday'=>'الخميس', 'Friday'=>'الجمعة', 'Saturday'=>'السبت'];
                                $arabicMonths = ['1'=>'يناير','2'=>'فبراير','3'=>'مارس','4'=>'أبريل','5'=>'مايو','6'=>'يونيو','7'=>'يوليو','8'=>'أغسطس','9'=>'سبتمبر','10'=>'أكتوبر','11'=>'نوفمبر','12'=>'ديسمبر'];
                                $dayName = $arabicDays[date('l')] ?? date('l');
                                $monthName = $arabicMonths[date('n')] ?? date('F');
                                echo $dayName . '، ' . date('j') . ' ' . $monthName;
                            @endphp
                        </span>
                        <h1>@yield('dashboard_title', 'مكتبتي')</h1>
                        <p>@yield('dashboard_subtitle', 'كل تفاصيل رحلتك محفوظة ومنظمة في مكان واحد.')</p>
                    </div>

                    <div class="profile-wrap">
                        <button type="button" class="profile-button" onclick="toggleProfileDropdown(event)">
                            <span>{{ mb_substr(Auth::user()->name ?? 'ل', 0, 1) }}</span>
                            <div>
                                <strong>{{ Auth::user()->name ?? 'ليان أحمد' }}</strong>
                                <small>{{ Auth::user()->is_author ? 'مؤلف معتمد' : (Auth::user()->is_admin ? 'مدير المنظومة' : 'طالبة') }}</small>
                            </div>
                            <i class="fas fa-chevron-left" style="font-size: 11px; margin-right: 8px;"></i>
                        </button>

                        <div class="profile-menu" id="profileDropdownMenu" style="display: none;">
                            <a href="{{ route('profile.show') }}"><i class="fas fa-id-card me-2"></i> الملف الشخصي</a>
                            <a href="{{ route('account.roles') }}"><i class="fas fa-user-shield me-2"></i> أدواري وصلاحياتي</a>
                            <a href="{{ route('account.security') }}"><i class="fas fa-lock me-2"></i> الأمان والجلسات</a>
                            <hr class="my-1 border-secondary">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('dash-logout-form').submit();" class="text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i> تسجيل الخروج
                            </a>
                            <form id="dash-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Content Area -->
                @yield('content')
            </section>
        </div>
    </main>

    @include('partials.ai-chatbot')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
    function toggleProfileDropdown(e) {
        e.stopPropagation();
        const menu = document.getElementById('profileDropdownMenu');
        if (menu) {
            menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
        }
    }
    document.addEventListener('click', function() {
        const menu = document.getElementById('profileDropdownMenu');
        if (menu) menu.style.display = 'none';
    });
    </script>
    @stack('scripts')
</body>

</html>
