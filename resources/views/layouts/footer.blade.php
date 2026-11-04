<footer class="app-footer" role="contentinfo">
    <div class="container-ofuq footer-grid">
        <div class="footer-brand">
            <div class="brand mb-3">
                <img src="{{ asset('images/waraq-logo.png') }}" alt="{{ config('app.name') }}" style="height: 38px; width: auto;">
                <span class="text-white fw-bold fs-5 me-2">{{ config('app.name') }}</span>
            </div>
            <p>منظومة عربية رقمية متكاملة لتبادل المعرفة والكتب والقراءة المنتقاة في بيئة هادئة وفاخرة، تصنع مساحة للتعلم والمشاركة.</p>
        </div>

        <div>
            <strong>المنصات الشقيقة</strong>
            <a href="http://localhost:3000/">أُفُق الرئيسية</a>
            <a href="http://localhost:3000/masar">أُفُق مَسار (الدورات)</a>
            <a href="{{ url('/') }}" style="color: var(--lavender);">أُفُق وَرَق (المكتبة)</a>
            <a href="http://localhost:3000/sila">أُفُق صِلة (المجتمع)</a>
        </div>

        <div>
            <strong>استكشف المكتبة</strong>
            <a href="{{ route('searchProducts.index') }}">تصفح جميع الكتب</a>
            <a href="{{ route('searchProducts.index', ['category' => 'سلايدات جامعية']) }}">سلايدات ومذكرات جامعية</a>
            <a href="{{ route('emergancyRequest.index') }}">النداءات العاجلة</a>
            <a href="{{ auth()->check() ? route('products.create') : route('login') }}">تبرع بكتاب</a>
        </div>

        <div>
            <strong>الحساب الشخصي</strong>
            @guest
                <a href="{{ route('login') }}">تسجيل الدخول</a>
                <a href="{{ route('register') }}">إنشاء حساب جديد</a>
            @else
                <a href="{{ url('profile') }}">حسابي وإعداداتي</a>
                <a href="{{ route('myLibrary.index') }}">مكتبتي الشخصية</a>
                <a href="{{ route('favorites.index') }}">المفضلة</a>
            @endguest
        </div>
    </div>

    <div class="container-ofuq footer-bottom">
        <span>جميع الحقوق محفوظة © ٢٠٢٦ أُفُق وَرَق — مساحتك الهادئة للأفكار</span>
        <div>
            <a href="#">الخصوصية والأمان</a>
            <a href="#">شروط الاستخدام</a>
        </div>
    </div>
</footer>
