@extends('layouts.app')

@section('title', 'لوحة تحكم المؤلف — ' . config('app.name'))

@section('content')
<main class="workspace-page">
    <div class="container-ofuq workspace-shell">
        <div class="workspace-heading">
            <div>
                <span class="platform-pill">
                    <i class="fas fa-feather-alt text-sky"></i>
                    <span>أُفُق وَرَق — مساحة النشر</span>
                </span>
                <h1>لوحة <span class="gradient-text">المؤلف والكاتب</span></h1>
                <p>مرحباً، <strong>{{ Auth::user()->name }}</strong> — أدر منشوراتك الأكاديمية وكتبي الرقمية وإحصائيات القراء.</p>
            </div>
            <a href="{{ route('products.create') }}" class="button button--primary">
                <i class="fas fa-plus"></i>
                <span>إضافة كتاب جديد</span>
            </a>
        </div>

        <div class="workspace-tabs">
            <a href="{{ route('author.workspace') }}" class="active">كتبي المنشورة</a>
            <a href="{{ route('products.create') }}">إضافة كتاب أو مذكرة</a>
            <a href="{{ route('user.myProducts') }}">مكتبتي ومشاركاتي</a>
            <a href="{{ route('account.roles') }}">صلاحيات الحساب</a>
        </div>

        <div class="workspace-grid">
            <div class="workspace-main">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-white fw-bold fs-5 m-0">الكتب والمراجع الرقمية المعتمدة</h3>
                    <span class="text-muted small">إجمالي الكتب: {{ $myBooks->count() }}</span>
                </div>

                @if($myBooks->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                        <h4 class="text-white fw-bold mb-2">لم تنشر أي مؤلفات بعد</h4>
                        <p class="text-muted small mb-4">ابدأ بإضافة أول كتاب رقمي أو سلايدات ومذكرات أكاديمية لتصل للقراء.</p>
                        <a href="{{ route('products.create') }}" class="button button--primary">
                            <span>إضافة كتاب الآن</span>
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                @else
                    <div class="workspace-list">
                        @foreach($myBooks as $book)
                            <article>
                                <span class="workspace-list__icon">
                                    <i class="fas fa-book"></i>
                                </span>
                                <div>
                                    <small>التصنيف: {{ $book->category ?? 'عام' }} · متوفر: {{ $book->quantity }} نسخة</small>
                                    <h3>{{ $book->name }}</h3>
                                    <p class="text-muted small mb-0">{{ \Illuminate\Support\Str::limit($book->description, 80) }}</p>
                                </div>
                                <span class="status-pill status-pill--success"><i class="fas fa-check-circle me-1"></i> منشور</span>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('products.edit', $book->slug) }}" class="button button--ghost text-lavender btn-sm" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ url('/products/' . $book->slug) }}" class="button button--secondary btn-sm">
                                        عرض
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="workspace-summary">
                <small class="text-muted">مؤشرات التأثير والانتشار</small>
                <strong>{{ $totalDownloads }}</strong>
                <p>قراءة وتحميل لمؤلفاتك ومذكراتك على المنظومة.</p>

                <div><span>الكتب النشطة:</span> <b>{{ $myBooks->count() }}</b></div>
                <div><span>حقوق النشر:</span> <b class="text-success">محمية ومسجلة</b></div>
                <div><span>معدل التقييم:</span> <b class="text-warning"><i class="fas fa-star"></i> 4.9</b></div>
                <div><span>الموقع:</span> <b>{{ Auth::user()->location ?? 'غزة' }}</b></div>

                <a href="{{ route('products.create') }}" class="button button--primary mt-4 w-100 justify-content-center">
                    <i class="fas fa-plus-circle"></i>
                    <span>نشر عمل جديد</span>
                </a>
            </div>
        </div>
    </div>
</main>
@endsection
