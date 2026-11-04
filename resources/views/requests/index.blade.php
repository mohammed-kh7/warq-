@extends('layouts.app')

@section('title', 'طلبات الكتب غير المتوفرة — ' . config('app.name'))

@section('content')
<main class="workspace-page">
    <div class="container-ofuq workspace-shell">
        <div class="workspace-heading">
            <div>
                <span class="platform-pill">
                    <i class="fas fa-search-plus text-sky"></i>
                    <span>توفير المحتوى المعرفي</span>
                </span>
                <h1>طلبات الكتب <span class="gradient-text">غير المتوفرة</span></h1>
                <p>هل تبحث عن كتاب أو مذكرات أكاديمية ولم تجدها في المكتبة؟ أضف طلبك وصوّت لتوفيره بأسرع وقت.</p>
            </div>
            @auth
                <button type="button" class="button button--primary" onclick="document.getElementById('newRequestBox').scrollIntoView({behavior: 'smooth'});">
                    <i class="fas fa-plus"></i>
                    <span>طلب كتاب غير متوفر</span>
                </button>
            @else
                <a href="{{ route('login') }}" class="button button--primary">
                    <span>تسجيل الدخول للطلب</span>
                    <i class="fas fa-arrow-left"></i>
                </a>
            @endauth
        </div>

        @if(session()->has('success'))
            <div class="workspace-notice mt-4">
                <i class="fas fa-check-circle"></i>
                <span>{{ session()->get('success') }}</span>
            </div>
        @endif

        <div class="workspace-grid mt-5">
            <div class="workspace-main">
                <!-- Request Submission Form -->
                @auth
                <div class="glass-form-card mb-5" id="newRequestBox" style="border: 1px solid var(--border-hover);">
                    <h4 class="text-white fw-bold mb-3 fs-6">
                        <i class="fas fa-book-medical text-sky me-2"></i> اقترح كتاباً أو مرجعاً غير متوفر في المنظومة
                    </h4>
                    <form action="{{ route('contentRequests.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-8">
                                <div class="form-group-custom">
                                    <input
                                        type="text"
                                        name="title"
                                        class="form-input-custom"
                                        placeholder="اسم الكتاب، الكاتب، أو المرجع الدراسي..."
                                        required
                                    >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group-custom">
                                    <select name="type" class="form-input-custom">
                                        <option value="كتاب رقمي">كتاب رقمي</option>
                                        <option value="سلايدات جامعية">سلايدات جامعية</option>
                                        <option value="مرجع أبحاث">مرجع أبحاث</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group-custom mt-2">
                            <textarea
                                name="description"
                                class="form-input-custom form-textarea-custom"
                                rows="3"
                                placeholder="صف أهمية الكتاب أو المنهج أو سبب احتياجك له..."
                                required
                            ></textarea>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="button button--primary">
                                <i class="fas fa-paper-plane"></i>
                                <span>إرسال طلب توفير الكتاب</span>
                            </button>
                        </div>
                    </form>
                </div>
                @endauth

                <!-- Requests List -->
                <h3 class="text-white fw-bold fs-5 mb-4">قائمة الكتب المطلوبة من المجتمع</h3>

                @if($requests->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-clipboard-check fa-3x text-muted mb-3"></i>
                        <h4 class="text-white fw-bold mb-2">لا توجد طلبات معلقة</h4>
                        <p class="text-muted small mb-0">جميع الكتب المقترحة تم توفيرها في فهرس المكتبة.</p>
                    </div>
                @else
                    <div class="workspace-list">
                        @foreach($requests as $req)
                            <article>
                                <span class="workspace-list__icon" style="background: rgba(36, 117, 233, 0.15); color: var(--sky);">
                                    <i class="fas fa-book"></i>
                                </span>
                                <div>
                                    <small>{{ $req->type }} · طُلب بواسطة: {{ $req->user->name ?? 'طالب' }}</small>
                                    <h3>{{ $req->title }}</h3>
                                    <p class="text-muted small mb-0">{{ \Illuminate\Support\Str::limit($req->description, 85) }}</p>
                                </div>

                                @if($req->status === 'fulfilled')
                                    <span class="status-pill status-pill--success"><i class="fas fa-check me-1"></i> تم توفيره</span>
                                @else
                                    <span class="status-pill status-pill--pending"><i class="fas fa-hourglass-half me-1"></i> جاري التوفير</span>
                                @endif

                                <div>
                                    <form action="{{ route('contentRequests.vote', $req->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="button button--secondary btn-sm" title="أنا أيضاً أحتاج هذا الكتاب">
                                            <i class="fas fa-arrow-up text-sky"></i>
                                            <span>{{ $req->votes_count }} صوت</span>
                                        </button>
                                    </form>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="workspace-summary">
                <small class="text-muted">الكتب المطلوبة</small>
                <strong>{{ $requests->count() }}</strong>
                <p>عناوين مقترحة للتوفير والشراء من الإدارة والمؤلفين.</p>

                <div><span>قيد البحث:</span> <b>{{ $requests->where('status', 'open')->count() }}</b></div>
                <div><span>تم توفيرها:</span> <b class="text-success">{{ $requests->where('status', 'fulfilled')->count() }}</b></div>
                <div><span>نظام التصويت:</span> <b class="text-sky">تفاعلي مباشر</b></div>

                <a href="{{ route('searchProducts.index') }}" class="button button--secondary mt-4 w-100 justify-content-center">
                    <i class="fas fa-compass"></i>
                    <span>تصفح المتوفر حالياً</span>
                </a>
            </div>
        </div>
    </div>
</main>
@endsection
