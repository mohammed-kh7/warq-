@extends('layouts.app')

@section('title', $product->name . ' — أُفُق وَرَق')

@section('content')

@php
    $waDigits = preg_replace('/\D+/', '', (string) $product->whatsapp);
    if (strlen($waDigits) > 0 && str_starts_with($waDigits, '0')) {
        $waDigits = '970' . substr($waDigits, 1);
    }
    $waUrl = strlen($waDigits) > 0 ? 'https://wa.me/' . $waDigits : null;
@endphp

<div class="book-detail-hero">
    <!-- Cosmic Glow Orbs -->
    <div class="glow glow--one" aria-hidden="true"></div>
    <div class="glow glow--two" aria-hidden="true"></div>
    <div class="grid-bg" aria-hidden="true"></div>

    <div class="container-ofuq position-relative" style="z-index: 5;">
        @if(session()->has('message'))
            <div class="alert alert-success d-flex align-items-center gap-2 mb-4 rounded-4" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: #6ee7b7;">
                <i class="fas fa-check-circle"></i>
                <span>{{ session()->get('message') }}</span>
            </div>
        @endif

        <div class="book-detail-layout">
            <!-- Right Column: Info & Chapters -->
            <div class="book-detail-main">
                <div class="book-detail-meta-tag">
                    <i class="fas fa-bookmark"></i>
                    <span>{{ $product->category ?? 'التقنية' }} · محتوى معرفي</span>
                </div>

                <h1 class="book-detail-title">
                    {{ $product->name }}
                </h1>

                <p class="book-detail-lead">
                    {{ $product->description }}
                </p>

                <!-- Author Strip -->
                <div class="book-author-strip">
                    <div class="book-author-avatar">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <div class="book-author-info">
                        <small>تأليف / نشر بواسطة</small>
                        <strong>{{ $product->user->name ?? 'مؤلف معتمد' }}</strong>
                    </div>
                </div>

                <!-- Perks List -->
                <div class="book-perks-list">
                    <div class="book-perk-item">
                        <i class="fas fa-check-circle"></i>
                        <span>محتوى عربي واضح ومنسق بعناية</span>
                    </div>
                    <div class="book-perk-item">
                        <i class="fas fa-check-circle"></i>
                        <span>تجربة قراءة وتصفح متاحة على جميع الشاشات</span>
                    </div>
                    <div class="book-perk-item">
                        <i class="fas fa-check-circle"></i>
                        <span>تواصل مباشر مع صاحب الكتاب وتنسيق التسليم أو القراءة</span>
                    </div>
                    @if($product->location)
                        <div class="book-perk-item">
                            <i class="fas fa-map-marker-alt text-sky"></i>
                            <span>منطقة الاستلام / الموقع: <strong class="text-white">{{ $product->location }}</strong></span>
                        </div>
                    @endif
                </div>

                <!-- Accordion Chapters Section (Figma Match) -->
                <section class="book-accordion-section">
                    <div class="book-accordion-header">
                        <small>عن الكتاب</small>
                        <h2>مساحة للفكرة والمعنى</h2>
                    </div>

                    <div class="chapter-accordion-list">
                        <!-- Chapter 1 -->
                        <div class="chapter-accordion-item active">
                            <button type="button" class="chapter-accordion-trigger" onclick="toggleChapter(this)">
                                <div>
                                    <span class="chapter-num">01</span>
                                    <span>مقدمة وبناء الأساس</span>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <small class="text-muted">١٨ صفحة</small>
                                    <i class="fas fa-chevron-down icon-chevron"></i>
                                </div>
                            </button>
                            <div class="chapter-accordion-body">
                                نظرة مختصرة على محاور هذا المرجع مع إمكانية متابعة القراءة وتلخيص الفصول عبر المساعد الذكي.
                            </div>
                        </div>

                        <!-- Chapter 2 -->
                        <div class="chapter-accordion-item">
                            <button type="button" class="chapter-accordion-trigger" onclick="toggleChapter(this)">
                                <div>
                                    <span class="chapter-num">02</span>
                                    <span>المفاهيم الجوهرية والتحليل</span>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <small class="text-muted">٢٦ صفحة</small>
                                    <i class="fas fa-chevron-down icon-chevron"></i>
                                </div>
                            </button>
                            <div class="chapter-accordion-body">
                                استعراض لأهم النظريات والتطبيقات الواردة في المرجع، مع روابط للمصادر المعتمدة وملاحظات القراءة.
                            </div>
                        </div>

                        <!-- Chapter 3 -->
                        <div class="chapter-accordion-item">
                            <button type="button" class="chapter-accordion-trigger" onclick="toggleChapter(this)">
                                <div>
                                    <span class="chapter-num">03</span>
                                    <span>تطبيق عملي ونماذج موجهة</span>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <small class="text-muted">٣٤ صفحة</small>
                                    <i class="fas fa-chevron-down icon-chevron"></i>
                                </div>
                            </button>
                            <div class="chapter-accordion-body">
                                تدريبات وأمثلة عملية واقعية تساعد القارئ على ترسيخ المعرفة وتحويل الفكرة إلى ممارسة حقيقية.
                            </div>
                        </div>

                        <!-- Chapter 4 -->
                        <div class="chapter-accordion-item">
                            <button type="button" class="chapter-accordion-trigger" onclick="toggleChapter(this)">
                                <div>
                                    <span class="chapter-num">04</span>
                                    <span>مشروع ختامي وخلاصة المعرفة</span>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <small class="text-muted">٤٢ صفحة</small>
                                    <i class="fas fa-chevron-down icon-chevron"></i>
                                </div>
                            </button>
                            <div class="chapter-accordion-body">
                                خاتمة المرجع مع مسرد المصطلحات وقائمة القراءات المقترحة لدعم الاستمرارية المعرفية.
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Left Column: Sticky Side Card (Actions & WhatsApp) -->
            <aside class="book-detail-card-side">
                <div class="book-side-cover-frame">
                    @if($product->image_path)
                        <img src="{{ asset('images/' . $product->image_path) }}" alt="{{ $product->name }}">
                    @else
                        <div class="text-center p-4">
                            <i class="fas fa-book-open fa-4x text-lavender opacity-50 mb-3"></i>
                            <div class="small text-muted">{{ $product->name }}</div>
                        </div>
                    @endif
                </div>

                <div class="book-price-strip">
                    <span class="text-muted small">حالة الكتاب:</span>
                    <span class="book-price-val gradient-text">
                        {{ $product->quantity > 0 ? $product->quantity . ' متاح' : 'متوفر' }}
                    </span>
                </div>

                <div class="d-grid gap-2 mb-3">
                    @auth
                        <!-- Add to Library -->
                        <form action="{{ route('library.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="button button--primary w-100">
                                <i class="fas fa-book-reader"></i>
                                <span>أضف إلى مكتبتي</span>
                            </button>
                        </form>

                        <!-- Add to Favorites -->
                        <form action="{{ route('favorites.store', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="button button--secondary w-100">
                                <i class="fas fa-heart text-danger"></i>
                                <span>إضافة للمفضلة</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="button button--primary w-100">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>سجل لإضافة الكتاب لمكتبتك</span>
                        </a>
                    @endauth

                    <!-- WhatsApp Direct Contact -->
                    @if($waUrl)
                        <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-success rounded-pill py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <i class="fab fa-whatsapp fa-lg"></i>
                            <span>تواصل عبر واتساب</span>
                        </a>
                    @endif

                    <a href="{{ route('searchProducts.index') }}" class="button button--ghost w-100 text-center">
                        <i class="fas fa-arrow-right"></i>
                        <span>العودة لجميع الكتب</span>
                    </a>
                </div>

                <!-- Owner Actions (Edit / Delete) -->
                @if(Auth::user() && Auth::user()->id == $product->user_id)
                    <div class="pt-3 border-top border-secondary d-flex gap-2">
                        <a href="{{ url('/products/' . $product->slug . '/edit') }}" class="button button--secondary flex-fill text-center py-2" style="font-size: 12px;">
                            <i class="fas fa-edit"></i> تعديل
                        </a>
                        <form action="{{ url('/products/' . $product->slug) }}" method="post" class="flex-fill" onsubmit="return confirm('هل أنت متأكد من حذف هذا الكتاب؟');">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger w-100 rounded-pill py-2" style="font-size: 12px;">
                                <i class="fas fa-trash-alt"></i> حذف
                            </button>
                        </form>
                    </div>
                @endif
            </aside>
        </div>
    </div>
</div>

<script>
    function toggleChapter(btn) {
        const item = btn.closest('.chapter-accordion-item');
        if (item) {
            item.classList.toggle('active');
        }
    }
</script>
@endsection
