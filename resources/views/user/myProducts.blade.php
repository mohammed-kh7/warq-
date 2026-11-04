@extends('layouts.app')

@section('title', 'مكتبتي ومشاركاتي — ' . config('app.name'))

@section('content')
<div class="user-dashboard-wrap position-relative">
    <!-- Ambient Glows & Grid -->
    <div class="glow glow--one" aria-hidden="true"></div>
    <div class="glow glow--two" aria-hidden="true"></div>
    <div class="grid-bg" aria-hidden="true"></div>

    <div class="container-ofuq position-relative py-5" style="z-index: 5;">
        <!-- Dashboard Top Bar -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-5 pb-3 border-bottom" style="border-color: var(--border) !important;">
            <div>
                <div class="platform-pill mb-2">
                    <i class="fas fa-bookmark text-lavender"></i>
                    <span>مساحتي الخاصة</span>
                </div>
                <h1 class="text-white fw-extrabold m-0" style="font-size: clamp(28px, 3.5vw, 42px);">
                    مكتبتي <span class="gradient-text">ومشاركاتي</span>
                </h1>
                <p class="text-muted small mt-1 mb-0">أهلاً بك، {{ Auth::user()->name }} — تتبع كتبك المعروضة ونداءاتك الطارئة.</p>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('products.create') }}" class="button button--primary">
                    <i class="fas fa-plus-circle"></i>
                    <span>نشر كتاب جديد</span>
                </a>
                <a href="{{ route('emergency.create') }}" class="button button--secondary" style="border-color: rgba(239, 68, 68, 0.4); color: #fca5a5;">
                    <i class="fas fa-bolt"></i>
                    <span>إرسال نداء عاجل</span>
                </a>
            </div>
        </div>

        <!-- Quick Metrics Overview -->
        <div class="row g-4 mb-5">
            <div class="col-sm-6 col-md-4">
                <div class="glass-card p-4 d-flex align-items-center gap-3" style="border-radius: 20px;">
                    <div class="p-3 rounded-4" style="background: rgba(98, 70, 217, 0.2); color: var(--lavender);">
                        <i class="fas fa-book-open fa-2x"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">إجمالي كتبي المنشورة</small>
                        <strong class="text-white fs-3 fw-bold">{{ $products->count() }}</strong>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="glass-card p-4 d-flex align-items-center gap-3" style="border-radius: 20px;">
                    <div class="p-3 rounded-4" style="background: rgba(239, 68, 68, 0.2); color: #f87171;">
                        <i class="fas fa-bolt fa-2x"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">طلباتي العاجلة</small>
                        <strong class="text-white fs-3 fw-bold">{{ $emergencyRequests->count() }}</strong>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="glass-card p-4 d-flex align-items-center gap-3" style="border-radius: 20px;">
                    <div class="p-3 rounded-4" style="background: rgba(36, 117, 233, 0.2); color: var(--sky);">
                        <i class="fas fa-user-check fa-2x"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">حالة الحساب الموحد</small>
                        <strong class="text-white fs-5 fw-bold">عضو نشط في أُفُق</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 1: My Books -->
        <section class="mb-5 pb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-white fw-bold m-0 fs-4">
                    <i class="fas fa-book-reader text-lavender me-2"></i> الكتب التي قمت بمشاركتها
                </h3>
            </div>

            @if($products->isEmpty())
                <div class="glass-card text-center py-5" style="border-radius: 24px;">
                    <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-white fw-bold mb-2">لم تقم بإضافة أي كتب بعد</h5>
                    <p class="text-muted small mb-4">ساهم بنشر أول كتاب أو مذكرات دراسية لتصل لمن يحتاجها من الطلاب والقراء.</p>
                    <a href="{{ route('products.create') }}" class="button button--primary">
                        <span>إضافة كتاب الآن</span>
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            @else
                <div class="books-3d-grid">
                    @foreach($products as $product)
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
                                    {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                                </p>

                                <div class="book-card-footer">
                                    <a href="{{ route('products.edit', $product->slug) }}" class="button button--ghost text-lavender" style="padding: 6px 12px; font-size: 11px;">
                                        <i class="fas fa-edit"></i> تعديل
                                    </a>
                                    <a href="{{ url('/products/' . $product->slug) }}" class="book-card-btn">
                                        عرض
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- Section 2: My Urgent Requests -->
        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-white fw-bold m-0 fs-4">
                    <i class="fas fa-bolt text-danger me-2"></i> طلباتي ونداءاتي العاجلة
                </h3>
            </div>

            @if($emergencyRequests->isEmpty())
                <div class="glass-card text-center py-5" style="border-radius: 24px;">
                    <i class="fas fa-check-circle fa-3x text-muted mb-3"></i>
                    <h5 class="text-white fw-bold mb-2">ليس لديك طلبات عاجلة حالياً</h5>
                    <p class="text-muted small mb-3">إذا تعثرت في الحصول على كتاب أو مرجع امتحانات، يمكنك نشره كطلب عاجل.</p>
                    <a href="{{ route('emergency.create') }}" class="button button--secondary" style="border-color: rgba(239, 68, 68, 0.4); color: #fca5a5;">
                        <span>إرسال طلب عاجل</span>
                    </a>
                </div>
            @else
                <div class="row g-4">
                    @foreach($emergencyRequests as $req)
                        <div class="col-md-6">
                            <div class="glass-card p-4 h-100 d-flex flex-column justify-content-between" style="border-radius: 20px; border: 1px solid rgba(239, 68, 68, 0.28);">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge rounded-pill bg-danger px-3 py-1">طلب عاجل</span>
                                        <span class="text-muted small"><i class="fas fa-map-marker-alt text-danger"></i> {{ $req->location ?? 'غير محدد' }}</span>
                                    </div>
                                    <h5 class="text-white fw-bold mt-2 mb-3">{{ $req->description }}</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center pt-3 border-top" style="border-color: var(--border) !important;">
                                    <a href="{{ route('emergancyRequest.show', $req->id) }}" class="text-link">
                                        <span>عرض التفاصيل والتواصل</span>
                                        <i class="fas fa-arrow-left"></i>
                                    </a>

                                    <form action="{{ route('emergancyRequest.destroy', $req->id) }}" method="POST" onsubmit="return confirm('هل تريد إغلاق وحذف هذا الطلب؟');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button button--ghost text-danger" style="padding: 5px 10px; font-size: 11px;">
                                            <i class="fas fa-trash-alt"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

    </div>
</div>
@endsection
