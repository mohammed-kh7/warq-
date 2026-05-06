<section class="home-hero-section" aria-label="مقدمة المنصة">
    <div class="hero-modern">
        <div class="hero-modern__scene" style="background-image: url('{{ asset('images/hero-desk-scene.svg') }}');"></div>
        <div class="hero-modern__overlay" aria-hidden="true"></div>
        <div class="hero-modern__inner container py-4">
            <h1 class="display-4 fw-bold hero-main-title hero-modern__title">تعلّم بذكاء، وشارك الكتب</h1>
            <p class="hero-modern__brand mb-0">{{ config('app.name') }}</p>
            <p class="lead mt-3 mb-4 hero-modern__lead">منصة مجتمعية لتبادل الكتب، طلب المراجع، والنداءات العاجلة — مجتمع قرّاء يدعم بعضه.</p>
            @if(Auth::check())
            <a href="{{ route('homePage') }}#latest-resources" class="btn btn-primary btn-lg px-5 hero-modern__cta">تصفّح الكتب</a>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 hero-modern__cta">ابدأ الآن</a>
            @endif
            <div class="d-flex flex-wrap justify-content-center gap-3 gap-md-4 hero-modern__icons">
                <div class="icon-box text-center hero-icon-pill">
                    <i class="fas fa-book-medical fa-2x" style="color: var(--app-primary);"></i>
                    <p class="mt-2 mb-0 small">تبرع بالكتب</p>
                </div>
                <div class="icon-box text-center hero-icon-pill">
                    <i class="fas fa-arrows-rotate fa-2x" style="color: var(--app-primary);"></i>
                    <p class="mt-2 mb-0 small">تبادل آمن</p>
                </div>
                <div class="icon-box text-center hero-icon-pill">
                    <i class="fas fa-bell fa-2x" style="color: var(--app-primary);"></i>
                    <p class="mt-2 mb-0 small">طلبات عاجلة</p>
                </div>
                <div class="icon-box text-center hero-icon-pill">
                    <i class="fas fa-users fa-2x" style="color: var(--app-primary);"></i>
                    <p class="mt-2 mb-0 small">مجتمع القرّاء</p>
                </div>
            </div>
        </div>
    </div>
</section>
