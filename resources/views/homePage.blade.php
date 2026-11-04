@extends('layouts.app')

@section('title', 'الصفحة الرئيسية — ' . config('app.name'))

@section('content')
<!-- 1. Hero Section (1:1 Figma) -->
@include('partials.hero-home')

<div class="homepage-wrap position-relative">
    <!-- Ambient Glows & Grid -->
    <div class="glow glow--one" aria-hidden="true"></div>
    <div class="glow glow--two" aria-hidden="true"></div>
    <div class="grid-bg" aria-hidden="true"></div>

    <div class="container-ofuq position-relative pt-4 pb-5" style="z-index: 5;">

        <!-- About Section -->
        <section class="mb-5 pb-4" id="about">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <div class="platform-pill mb-3">
                        <i class="fas fa-feather-alt text-lavender"></i>
                        <span>عن المنصة والرسالة</span>
                    </div>
                    <h1 class="text-white fw-extrabold mb-3" style="font-size: clamp(32px, 4vw, 48px); line-height: 1.25;">
                        منظومة <span class="gradient-text">{{ config('app.name') }}</span>
                    </h1>
                    <p class="text-muted fs-6 lh-lg mb-4">
                        منصة مجتمعية متكاملة تهدف إلى تعزيز الثقافة ونشر المعرفة بين القراء من خلال تسهيل تبادل، تبرع، وبيع الكتب بمختلف أنواعها—أدبية، علمية، أو سلايدات ومذكرات أكاديمية.
                    </p>
                    <p class="text-muted fs-6 lh-lg mb-4">
                        كما توفر المنصة مساحة مخصصة للنداءات العاجلة للبحث عن المراجع الدراسية النادرة التي يحتاجها الطلاب والباحثون بشكل طارئ، لتصل المعرفة إلى من يحتاجها في الوقت المناسب.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('searchProducts.index') }}" class="button button--primary">
                            <span>تصفح المكتبة</span>
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <a href="{{ auth()->check() ? route('products.create') : route('login') }}" class="button button--secondary">
                            <i class="fas fa-plus"></i>
                            <span>تبرع بكتاب</span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="glass-card p-4 text-center position-relative overflow-hidden" style="border-radius: 28px; background: radial-gradient(circle at 50% 0%, rgba(98, 70, 217, 0.2), rgba(17, 20, 33, 0.85)); border: 1px solid var(--border-hover);">
                        <div class="my-4">
                            <img src="{{ asset('images/waraq-logo.png') }}" alt="{{ config('app.name') }}" style="max-height: 120px; filter: drop-shadow(0 0 25px rgba(98, 70, 217, 0.45));">
                        </div>
                        <h4 class="text-white fw-bold mb-2">مساحتك الهادئة للأفكار</h4>
                        <p class="text-muted small mb-0">تبادل، تبرع، تضامن معرفي، ومذكرات دراسية لجميع الجامعات.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Action CTAs -->
        <section class="mb-5 pb-3">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="glass-card p-4 h-100 d-flex flex-column justify-content-between" style="border-radius: 24px; border: 1px solid var(--border-hover); background: linear-gradient(135deg, rgba(98, 70, 217, 0.12), rgba(15, 17, 28, 0.7));">
                        <div>
                            <div class="d-inline-flex p-3 rounded-4 mb-3" style="background: rgba(98, 70, 217, 0.25); color: var(--lavender);">
                                <i class="fas fa-book-reader fa-2x"></i>
                            </div>
                            <h3 class="text-white fw-bold fs-4 mb-2">تبرع بمعرفة أو أضف كتاباً</h3>
                            <p class="text-muted small lh-base mb-4">شارِك كتبك ومذكراتك الفائضة لتصل لمن يستحقها أو ساهم في إثراء المحتوى الأكاديمي.</p>
                        </div>
                        <div>
                            <a href="{{ auth()->check() ? route('products.create') : route('login') }}" class="button button--primary w-100 justify-content-center">
                                <span>أضف كتاباً أو مرجعاً الآن</span>
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="glass-card p-4 h-100 d-flex flex-column justify-content-between" style="border-radius: 24px; border: 1px solid rgba(239, 68, 68, 0.3); background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(15, 17, 28, 0.7));">
                        <div>
                            <div class="d-inline-flex p-3 rounded-4 mb-3" style="background: rgba(239, 68, 68, 0.25); color: #f87171;">
                                <i class="fas fa-bolt fa-2x"></i>
                            </div>
                            <h3 class="text-white fw-bold fs-4 mb-2">نداء أو طلب كتاب عاجل</h3>
                            <p class="text-muted small lh-base mb-4">هل تبحث عن كتاب نادر أو مرجع دراسي طارئ للاختبارات؟ انشر نداءك ليصل لمجتمع القراء.</p>
                        </div>
                        <div>
                            <a href="{{ auth()->check() ? route('emergency.create') : route('login') }}" class="button button--secondary w-100 justify-content-center" style="border-color: rgba(239, 68, 68, 0.4); color: #fca5a5;">
                                <span>إرسال طلب طارئ</span>
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Fast Search Bar -->
        <section class="mb-5 pb-2 text-center">
            <div class="search-box mx-auto" style="max-width: 680px;">
                <i class="fas fa-search text-muted me-2"></i>
                <form action="{{ route('searchProducts.index') }}" method="GET" class="d-flex w-100 align-items-center">
                    <input type="text" name="search" placeholder="ابحث بالعنوان، الكاتب، أو الموضوع..." class="w-100" autocomplete="off">
                    <button type="submit" class="button button--primary ms-2" style="padding: 10px 24px; min-height: 44px;">
                        <span>بحث</span>
                    </button>
                </form>
            </div>
        </section>

        <!-- Latest Books -->
        <section class="mb-5 pb-5">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
                <div>
                    <div class="platform-pill mb-2">
                        <i class="fas fa-sparkles text-lavender"></i>
                        <span>جديد على المنصة</span>
                    </div>
                    <h2 class="text-white fw-bold m-0" style="font-size: 28px;">الكتب والمراجع المضافة حديثاً</h2>
                </div>
                <a href="{{ route('searchProducts.index') }}" class="text-link mt-2 mt-sm-0">
                    <span>استكشف جميع الكتب</span>
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            @if($latestProducts->isEmpty())
                <div class="text-center py-5 glass-card" style="border-radius: 20px;">
                    <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-white">لا توجد كتب مضافة حديثاً بعد</h5>
                    <p class="text-muted small">كن أول من يضيف كتاباً للمكتبة الرقمية</p>
                    <a href="{{ auth()->check() ? route('products.create') : route('login') }}" class="button button--primary mt-2">
                        إضافة كتاب الآن
                    </a>
                </div>
            @else
                <div class="books-3d-grid">
                    @foreach($latestProducts as $product)
                        <article class="book-card-3d">
                            <a href="{{ url('/products/' . $product->slug) }}" class="book-card-cover-wrap">
                                <span class="book-category-tag">
                                    {{ $product->category ?? 'عام' }}
                                </span>
                                @if($product->image_path)
                                    <img src="{{ asset('images/' . $product->image_path) }}" alt="{{ $product->name }}" class="book-card-cover-img" loading="lazy">
                                @else
                                    <div class="text-center p-3 text-muted">
                                        <i class="fas fa-book fa-3x text-lavender opacity-50 mb-2"></i>
                                        <div class="small">{{ $product->name }}</div>
                                    </div>
                                @endif
                            </a>

                            <div class="book-card-content">
                                <h3 class="book-card-title">
                                    <a href="{{ url('/products/' . $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <p class="book-card-desc">
                                    {{ \Illuminate\Support\Str::limit($product->description, 85) }}
                                </p>

                                <div class="book-card-footer">
                                    <div class="book-author-meta">
                                        <i class="fas fa-user-circle"></i>
                                        <span>{{ $product->user->name ?? 'مؤلف غير مسجل' }}</span>
                                    </div>
                                    <a href="{{ url('/products/' . $product->slug) }}" class="book-card-btn">
                                        التفاصيل
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- Urgent Appeals Section -->
        <section class="mb-5 pb-5">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
                <div>
                    <div class="platform-pill mb-2" style="background: rgba(239, 68, 68, 0.1); border-color: rgba(239, 68, 68, 0.3); color: #fca5a5;">
                        <i class="fas fa-signal"></i>
                        <span>تضامن مجتمعي</span>
                    </div>
                    <h2 class="text-white fw-bold m-0" style="font-size: 28px;">النداءات والطلبات العاجلة</h2>
                </div>
                <a href="{{ route('emergancyRequest.index') }}" class="text-link mt-2 mt-sm-0" style="color: #fca5a5;">
                    <span>عرض كل النداءات</span>
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            @if($latestRequests->isEmpty())
                <div class="text-center py-5 glass-card" style="border-radius: 20px;">
                    <i class="fas fa-hands-helping fa-3x text-muted mb-3"></i>
                    <h5 class="text-white">لا توجد نداءات عاجلة مفتوحة حالياً</h5>
                    <p class="text-muted small">كل الطلبات تم الاستجابة لها بحمد الله</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach($latestRequests as $req)
                        <div class="col-md-4">
                            <div class="glass-card p-4 h-100 d-flex flex-column justify-content-between" style="border-radius: 20px; border: 1px solid rgba(239, 68, 68, 0.25);">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge rounded-pill bg-danger px-3 py-2">طلب عاجل</span>
                                        @if($req->location)
                                            <span class="text-muted small"><i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $req->location }}</span>
                                        @endif
                                    </div>
                                    <p class="text-white fs-6 lh-base mb-4">{{ \Illuminate\Support\Str::limit($req->description, 100) }}</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center pt-3 border-top" style="border-color: var(--border) !important;">
                                    @php
                                        $wa = preg_replace('/\D+/', '', (string) $req->whatsapp);
                                        if (strlen($wa) > 0 && str_starts_with($wa, '0')) $wa = '970' . substr($wa, 1);
                                    @endphp
                                    @if($wa)
                                        <a href="https://wa.me/{{ $wa }}" target="_blank" class="button button--primary" style="padding: 7px 16px; font-size: 11px; background: #25D366; border-color: #25D366;">
                                            <i class="fab fa-whatsapp"></i>
                                            <span>تواصل واتساب</span>
                                        </a>
                                    @else
                                        <span></span>
                                    @endif
                                    <a href="{{ url('/emergancyRequest/' . $req->id) }}" class="text-link">
                                        <span>التفاصيل</span>
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- 3 Simple Steps -->
        <section class="mb-5 py-4">
            <div class="text-center mb-5">
                <span class="platform-pill mx-auto mb-2">كيف تعمل المنظومة؟</span>
                <h2 class="text-white fw-bold">ثلاث خطوات لتجربة معرفية متكاملة</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="glass-card p-4 h-100 text-center" style="border-radius: 20px;">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 50px; height: 50px; background: rgba(98, 70, 217, 0.2); color: var(--lavender); font-weight: 800; font-size: 20px;">
                            ١
                        </div>
                        <h4 class="text-white fw-bold mb-2">أنشئ حسابك الموحد</h4>
                        <p class="text-muted small lh-base">سجّل بحساب أُفُق الموحد للتنقل بحرية بين مَسار، وَرَق، وصِلة دون الحاجة لتسجيلات متعددة.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="glass-card p-4 h-100 text-center" style="border-radius: 20px;">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 50px; height: 50px; background: rgba(98, 70, 217, 0.2); color: var(--lavender); font-weight: 800; font-size: 20px;">
                            ٢
                        </div>
                        <h4 class="text-white fw-bold mb-2">تصفح واقرأ وشارك</h4>
                        <p class="text-muted small lh-base">تصفح آلاف الكتب والسلايدات الأكاديمية المنتقاة، واقرأ مباشرة مع المساعد المعرفي الذكي.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="glass-card p-4 h-100 text-center" style="border-radius: 20px;">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 50px; height: 50px; background: rgba(98, 70, 217, 0.2); color: var(--lavender); font-weight: 800; font-size: 20px;">
                            ٣
                        </div>
                        <h4 class="text-white fw-bold mb-2">ساند أو اطلب العون</h4>
                        <p class="text-muted small lh-base">قدّم كتاباً لغيرك بنية التضامن المعرفي، أو انشر نداءً عاجلاً إذا تعثرت في إيجاد مرجع لدراستك.</p>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection
