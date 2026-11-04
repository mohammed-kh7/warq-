@extends('layouts.app')

@section('title', 'لوحة تحكم المشرف — ' . config('app.name'))

@section('content')
<main class="workspace-page">
    <div class="container-ofuq workspace-shell">
        <div class="workspace-heading">
            <div>
                <span class="platform-pill" style="background: rgba(239, 68, 68, 0.12); border-color: rgba(239, 68, 68, 0.3); color: #fca5a5;">
                    <i class="fas fa-shield-alt"></i>
                    <span>منظومة الرقابة والإشراف</span>
                </span>
                <h1>لوحة <span class="gradient-text">الإشراف والمراجعة</span></h1>
                <p>مراجعة الكتب المضافة حديثاً، تدقيق محتوى النداءات العاجلة، وحفظ جودة البيئة التعليمية.</p>
            </div>
            <a href="{{ route('admin.workspace') }}" class="button button--secondary">
                <i class="fas fa-crown"></i>
                <span>لوحة الإدارة الشاملة</span>
            </a>
        </div>

        <div class="workspace-tabs">
            <a href="{{ route('moderation.workspace') }}" class="active">مراجعة الكتب والمحتوى</a>
            <a href="{{ route('emergancyRequest.index') }}">متابعة النداءات العاجلة</a>
            <a href="{{ route('account.applications') }}">طلبات الأدوار</a>
        </div>

        <div class="workspace-grid">
            <div class="workspace-main">
                <h3 class="text-white fw-bold fs-5 mb-4">أحدث الكتب المضافة للمراجعة والتدقيق</h3>

                <div class="workspace-list">
                    @forelse($pendingProducts as $book)
                        <article>
                            <span class="workspace-list__icon" style="background: rgba(36, 117, 233, 0.15); color: var(--sky);">
                                <i class="fas fa-book"></i>
                            </span>
                            <div>
                                <small>أضيف بواسطة: {{ $book->user->name ?? 'مستخدم' }} · التصنيف: {{ $book->category }}</small>
                                <h3>{{ $book->name }}</h3>
                                <p class="text-muted small mb-0">{{ \Illuminate\Support\Str::limit($book->description, 80) }}</p>
                            </div>
                            <span class="status-pill status-pill--success"><i class="fas fa-check me-1"></i> معتمد</span>
                            <div class="d-flex gap-2">
                                <a href="{{ url('/products/' . $book->slug) }}" class="button button--ghost text-lavender btn-sm">
                                    معاينة
                                </a>
                            </div>
                        </article>
                    @empty
                        <p class="text-muted small py-4 text-center">لا توجد كتب بانتظار المراجعة.</p>
                    @endforelse
                </div>
            </div>

            <div class="workspace-summary">
                <small class="text-muted">مؤشرات الإشراف</small>
                <strong>{{ $pendingProducts->count() }}</strong>
                <p>عنصراً تم تدقيقه والتأكد من مطابقة شروط النشر والمحتوى العلمي.</p>

                <div><span>الكتب المدققة:</span> <b>{{ $pendingProducts->count() }}</b></div>
                <div><span>النداءات النشطة:</span> <b>{{ $urgentAppeals->count() }}</b></div>
                <div><span>حالة المنظومة:</span> <b class="text-success">آمنة ومستقرة</b></div>
            </div>
        </div>
    </div>
</main>
@endsection
