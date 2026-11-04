{{-- ناف بار أُفُق وَرَق الرسمي (1:1 مطابقة الفيجما) --}}
<header class="header" id="ofuqHeader">
    <div class="container-ofuq header__inner">
        <!-- Logo -->
        <a href="{{ auth()->check() ? route('homePage') : route('landing') }}" class="brand" aria-label="أُفُق وَرَق">
            <img src="{{ asset('images/waraq-logo.png') }}" alt="أُفُق وَرَق">
            <span>أُفُق وَرَق</span>
        </a>

        <!-- Desktop Navigation Links -->
        <nav class="desktop-nav" aria-label="التنقل الرئيسي">
            <a href="{{ auth()->check() ? route('homePage') : route('landing') }}" @class(['active' => request()->routeIs('landing') || request()->routeIs('homePage')])>
                الرئيسية
            </a>
            <a href="{{ route('searchProducts.index') }}" @class(['active' => request()->routeIs('searchProducts.index')])>
                اكتشف
            </a>
            <a href="{{ route('community.index') }}" @class(['active' => request()->routeIs('community.index')])>
                المجتمع
            </a>
            <button type="button" class="nav-ai-btn d-inline-flex align-items-center gap-2" onclick="document.getElementById('chatbotToggle')?.click();" title="المساعد المعرفي الذكي (AI)">
                <i class="fas fa-sparkles text-lavender"></i>
                <span>المساعد الذكي</span>
                <span class="badge" style="background: linear-gradient(135deg, var(--purple), var(--blue)); color: #fff; font-size: 9px; padding: 2px 6px; border-radius: 6px;">AI</span>
            </button>

            <!-- Platform Switcher Dropdown -->
            <div class="switcher-wrap">
                <button type="button" class="nav-switcher" id="platformSwitcherBtn" onclick="togglePlatformMenu(event)">
                    <span>المنصات</span>
                    <i class="fas fa-chevron-down" style="font-size: 11px;"></i>
                </button>
                <div class="platform-menu" id="platformMenu" style="display: none;">
                    <a href="http://localhost:3000/">
                        <span class="menu-icon"><i class="fas fa-th-large"></i></span>
                        <span>
                            <strong>أُفُق</strong>
                            <small>الرئيسية والهوية الجامعة</small>
                        </span>
                        <i class="fas fa-arrow-left text-muted"></i>
                    </a>
                    <a href="http://localhost:3000/masar">
                        <span class="menu-icon"><i class="fas fa-graduation-cap"></i></span>
                        <span>
                            <strong>مَسار</strong>
                            <small>الدورات ومسارات التعلّم</small>
                        </span>
                        <i class="fas fa-arrow-left text-muted"></i>
                    </a>
                    <a href="{{ url('/') }}" style="background: rgba(98, 70, 217, 0.15);">
                        <span class="menu-icon" style="background: var(--purple); color: #fff;"><i class="fas fa-book-open"></i></span>
                        <span>
                            <strong>وَرَق (الحالية)</strong>
                            <small>المكتبة والقراءة وتبادل الكتب</small>
                        </span>
                        <i class="fas fa-check text-purple"></i>
                    </a>
                    <a href="http://localhost:3000/sila">
                        <span class="menu-icon"><i class="fas fa-users"></i></span>
                        <span>
                            <strong>صِلة</strong>
                            <small>المجتمع والمساعد المعرفي</small>
                        </span>
                        <i class="fas fa-arrow-left text-muted"></i>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Header Actions -->
        <div class="header__actions">
            <!-- AI Launcher Button -->
            <button type="button" class="theme-toggle ai-action-btn" onclick="document.getElementById('chatbotToggle')?.click();" title="المساعد المعرفي الذكي (AI)" style="background: rgba(98, 70, 217, 0.15); border-color: rgba(98, 70, 217, 0.35); color: var(--lavender);">
                <i class="fas fa-sparkles"></i>
                <span style="font-weight: 700;">AI</span>
            </button>

            <!-- Notifications Bell (Always Visible) -->
            @auth
                <a href="{{ route('notification.index') }}" class="button button--ghost position-relative px-2" title="الإشعارات" aria-label="الإشعارات">
                    <i class="fas fa-bell"></i>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    @endif
                </a>
            @else
                <a href="{{ route('login') }}" class="button button--ghost position-relative px-2" title="الإشعارات — تسجيل الدخول" aria-label="الإشعارات">
                    <i class="fas fa-bell"></i>
                </a>
            @endauth

            <!-- Theme Toggle -->
            <button type="button" class="theme-toggle" id="themeToggleBtn" onclick="toggleThemeMode()" aria-label="تبديل المظهر">
                <i class="fas fa-sparkles text-lavender" id="themeIcon"></i>
                <span id="themeLabel">فاتح</span>
            </button>

            @guest
                <a href="{{ route('login') }}" class="button button--ghost">
                    دخول
                </a>
                <a href="{{ route('register') }}" class="button button--primary">
                    انضم إلينا
                </a>
            @else
                <!-- User Dropdown -->
                <div class="dropdown d-inline-block">
                    <button class="button button--secondary dropdown-toggle" type="button" id="userMenuBtn" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userMenuBtn" style="background: var(--surface); border: 1px solid var(--border-hover); border-radius: 14px;">
                        <li>
                            <a class="dropdown-item text-white py-2" href="{{ route('profile.show') }}">
                                <i class="fas fa-id-badge me-2 text-lavender"></i> الملف الشخصي
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-white py-2" href="{{ route('account.roles') }}">
                                <i class="fas fa-user-shield me-2 text-sky"></i> أدواري وصلاحياتي
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-white py-2" href="{{ route('myLibrary.index') }}">
                                <i class="fas fa-book-reader me-2 text-lavender"></i> مكتبتي الرقمية
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-white py-2" href="{{ route('user.myProducts') }}">
                                <i class="fas fa-book me-2 text-sky"></i> كتبي ومشاركاتي
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-white py-2" href="{{ route('favorites.index') }}">
                                <i class="fas fa-heart me-2 text-danger"></i> المفضلات
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-white py-2" href="{{ route('contentRequests.index') }}">
                                <i class="fas fa-search-plus me-2 text-warning"></i> طلبات الكتب غير المتوفرة
                            </a>
                        </li>
                        @if(Auth::user()->is_author)
                        <li>
                            <a class="dropdown-item text-white py-2" href="{{ route('author.workspace') }}">
                                <i class="fas fa-feather-alt me-2 text-sky"></i> لوحة المؤلف
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->is_admin || Auth::user()->is_moderator)
                        <li>
                            <a class="dropdown-item text-white py-2" href="{{ route('admin.workspace') }}">
                                <i class="fas fa-crown me-2 text-warning"></i> لوحة الإدارة والمشرف
                            </a>
                        </li>
                        @endif
                        <li>
                            <a class="dropdown-item text-white py-2" href="{{ route('account.security') }}">
                                <i class="fas fa-lock me-2 text-muted"></i> الأمان وكلمة المرور
                            </a>
                        </li>
                        <li><hr class="dropdown-divider border-secondary"></li>
                        <li>
                            <a class="dropdown-item text-danger py-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> تسجيل الخروج
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest
        </div>
    </div>
</header>

<script>
    // Header Scroll Backdrop
    window.addEventListener('scroll', function () {
        const header = document.getElementById('ofuqHeader');
        if (header) {
            if (window.scrollY > 30) {
                header.classList.add('header--scrolled');
            } else {
                header.classList.remove('header--scrolled');
            }
        }
    });

    // Platform Switcher Dropdown
    function togglePlatformMenu(e) {
        e.stopPropagation();
        const menu = document.getElementById('platformMenu');
        const btn = document.getElementById('platformSwitcherBtn');
        if (menu) {
            const isShown = menu.style.display !== 'none';
            menu.style.display = isShown ? 'none' : 'block';
            if (btn) btn.classList.toggle('active', !isShown);
        }
    }

    document.addEventListener('click', function (e) {
        const menu = document.getElementById('platformMenu');
        const btn = document.getElementById('platformSwitcherBtn');
        if (menu && !menu.contains(e.target) && e.target !== btn) {
            menu.style.display = 'none';
            if (btn) btn.classList.remove('active');
        }
    });

    // Theme Toggle (Dark / Light)
    function toggleThemeMode() {
        const currentTheme = document.documentElement.dataset.theme === 'light' ? 'light' : 'dark';
        const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
        document.documentElement.dataset.theme = nextTheme;
        localStorage.setItem('ofuq-theme', nextTheme);
        updateThemeUI(nextTheme);
    }

    function updateThemeUI(theme) {
        const label = document.getElementById('themeLabel');
        const icon = document.getElementById('themeIcon');
        if (label) label.textContent = theme === 'dark' ? 'فاتح' : 'داكن';
        if (icon) icon.className = theme === 'dark' ? 'fas fa-sparkles text-lavender' : 'fas fa-moon text-purple';
    }

    // Initialize Theme
    (function () {
        const saved = localStorage.getItem('ofuq-theme') || 'dark';
        document.documentElement.dataset.theme = saved;
        updateThemeUI(saved);
    })();
</script>
