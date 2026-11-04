{{-- هيرو أُفُق وَرَق الرسمي (1:1 مطابقة الفيجما) --}}

<section class="hero" aria-label="مقدمة منصة أُفُق ورقة">
    <!-- Cosmic Glow Orbs -->
    <div class="glow glow--one" aria-hidden="true"></div>
    <div class="glow glow--two" aria-hidden="true"></div>
    <!-- Interactive Background Grid -->
    <div class="grid-bg" aria-hidden="true"></div>

    <div class="container-ofuq">
        <div class="hero__layout">
            <!-- Right Column: Content & Actions -->
            <div class="hero__content">
                <!-- Eyebrow Badge -->
                <div class="hero-badge">
                    <span class="dot"></span>
                    <i class="fas fa-book-open"></i>
                    <span>أُفُق وَرَق · عالم من الكتب والمعرفة</span>
                </div>

                <!-- Main Heading -->
                <h1>
                    <span>مساحتك الهادئة</span>
                    <strong>للأفكار.</strong>
                </h1>

                <!-- Subtitle -->
                <p>
                    مكتبة رقمية عربية بتجربة قراءة منتقاة، مصممة لتقرّب منك الكتاب المناسب في الوقت المناسب. استمتع بقراءة الكتب، تصفح المراجع، والمشاركة في مجتمع معرفي متكامل.
                </p>

                <!-- CTA Action Buttons -->
                <div class="hero__actions">
                    <a href="{{ route('searchProducts.index') }}" class="button button--primary">
                        <span>تصفّح المكتبة</span>
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <a href="{{ auth()->check() ? route('user.myProducts') : route('login') }}" class="button button--secondary">
                        <i class="fas fa-columns"></i>
                        <span>لوحة العرض</span>
                    </a>
                </div>

                <!-- 4 Quick Feature Cards (الروابط الأربعة المطلوبة) -->
                <div class="hero-quick-features">
                    <!-- 1. تصفح الكتب -->
                    <a href="{{ route('searchProducts.index') }}" class="hero-quick-card" title="تصفح الكتب والمراجع">
                        <div class="hero-quick-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h3 class="hero-quick-title">تصفح الكتب</h3>
                    </a>

                    <!-- 2. تبرع بالكتب -->
                    <a href="{{ auth()->check() ? route('products.create') : route('login') }}" class="hero-quick-card" title="أضف كتاباً يصل لمن يحتاجه">
                        <div class="hero-quick-icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h3 class="hero-quick-title">تبرع بالكتب</h3>
                    </a>

                    <!-- 3. طلبات عاجلة -->
                    <a href="{{ auth()->check() ? route('emergency.create') : route('login') }}" class="hero-quick-card" title="نداءات سريعة لتوفير مراجع">
                        <div class="hero-quick-icon">
                            <i class="fas fa-bolt text-warning"></i>
                        </div>
                        <h3 class="hero-quick-title">طلبات عاجلة</h3>
                    </a>

                    <!-- 4. مجتمع القرّاء -->
                    <a href="{{ route('homePage') }}#about" class="hero-quick-card" title="مناقشات وأندية القراءة">
                        <div class="hero-quick-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="hero-quick-title">مجتمع القرّاء</h3>
                    </a>
                </div>
            </div>

            <!-- Left Column: 3D Visual & Floating Tracker -->
            <div class="hero__visual" aria-hidden="true">
                <div class="logo-orbit logo-orbit--outer"></div>
                <div class="logo-orbit logo-orbit--inner"></div>

                <div class="hero-logo-shell">
                    <img src="{{ asset('images/waraq-logo.png') }}" alt="شعار أُفُق وَرَق">
                </div>

                <!-- Floating Tracker Card (Figma 1:1 Match) -->
                <div class="float-card float-card--book">
                    <span>
                        <i class="fas fa-bookmark"></i>
                    </span>
                    <div>
                        <small>رحلتك هذا الأسبوع</small>
                        <strong>١٢٤ صفحة</strong>
                        <div style="width: 120px; height: 5px; background: rgba(255,255,255,0.1); border-radius: 999px; margin-top: 6px; overflow: hidden;">
                            <div style="width: 68%; height: 100%; background: linear-gradient(90deg, var(--purple), var(--sky)); border-radius: 999px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
