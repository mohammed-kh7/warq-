@extends('layouts.app')
@section('title', 'طلبات الكتب')

@section('content')
<div class="job-posts-page main-content">
    <div class="container px-3 py-4">
        <header class="job-posts__hero text-center">
            <p class="job-posts__eyebrow"><i class="fas fa-book-wrapped me-2" aria-hidden="true"></i> طلبات الكتب</p>
            <h1 class="job-posts__title">طلبات الكتب المتوفرة</h1>
            <p class="job-posts__stat">ابحث عن الكتب المطلوبة أو قدّم طلباً مباشرة</p>
        </header>

        @if(session()->has('message'))
        <div class="alert alert-success job-posts__alert d-flex align-items-center gap-2" role="alert">
            <i class="fas fa-check-circle" aria-hidden="true"></i>
            <span>{{ session()->get('message') }}</span>
        </div>
        @endif

        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="fas fa-book-plus fa-2x text-primary"></i>
                        </div>
                        <h3 class="card-title mb-3">طلب كتاب جديد</h3>
                        <p class="card-text text-muted">لم تجد الكتاب المطلوب؟ اطلبه من المجتمع</p>
                        <a href="{{ route('emergancyRequest.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2" aria-hidden="true"></i> طلب كتاب
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-search me-2" aria-hidden="true"></i> البحث في طلبات الكتب</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('searchProducts.index') }}" method="GET" class="d-flex gap-2 mb-3">
                            <input type="text" name="search" class="form-control" placeholder="ابحث عن كتاب أو موضوع محدد..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                        <p class="text-muted small">أدخل اسم الكتاب، الموضوع، أو الكاتب للبحث عن طلبات مشابهة</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-header mb-4">
            <h2 class="section-title"><i class="fas fa-exclamation-triangle me-2 text-warning" aria-hidden="true"></i> طلبات عاجلة</h2>
        </div>

        @if($urgentRequests->count() > 0)
        <div class="row g-4 mb-4">
            @foreach($urgentRequests->take(3) as $request)
            <div class="col-md-4">
                <div class="urgent-request-card h-100">
                    <div class="urgent-request-card__media">
                        @include('partials.urgent-request-visual')
                        <span class="badge urgent-badge">عاجل</span>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{ \Illuminate\Support\Str::limit($request->description, 50) }}</h4>
                        <p class="card-text text-muted small"><i class="fas fa-map-marker-alt me-1" aria-hidden="true"></i> {{ $request->location }}</p>
                        <a href="{{ route('emergancyRequest.show', $request->id) }}" class="btn urgent-card-cta">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mb-4">
            <a href="{{ route('emergancyRequest.index') }}" class="btn btn-outline-primary">عرض جميع الطلبات العاجلة</a>
        </div>
        @else
        <div class="empty-state mb-4">
            <div class="empty-icon text-center mb-3">
                <i class="fas fa-book-open fa-3x text-muted"></i>
            </div>
            <h4 class="text-center">لا توجد طلبات عاجلة حالياً</h4>
            <p class="text-center text-muted">كن أول من يقدّم طلباً مساعداً المجتمع</p>
        </div>
        @endif

        <div class="section-header mb-4">
            <h2 class="section-title"><i class="fas fa-book me-2 text-primary" aria-hidden="true"></i> الكتب المطلوبة</h2>
        </div>

        @if($requestedBooks->count() > 0)
        <div class="row g-4 mb-4">
            @foreach($requestedBooks as $book)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-img-top">
                        @if($book->image_path)
                        <img src="{{ asset('images/' . $book->image_path) }}" class="img-fluid" alt="{{ $book->name }}">
                        @else
                        <div class="d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                            <i class="fas fa-book fa-2x text-muted"></i>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{ $book->name }}</h4>
                        <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit($book->description, 80) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-info">{{ $book->location }}</span>
                            <a href="#" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-envelope me-1" aria-hidden="true"></i> تواصل
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state mb-4">
            <div class="empty-icon text-center mb-3">
                <i class="fas fa-book-mark fa-3x text-muted"></i>
            </div>
            <h4 class="text-center">لا توجد كتب مطلوبة حالياً</h4>
            <p class="text-center text-muted">شارك معرفتك بعرض كتاب جديد</p>
        </div>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('homePage') }}" class="home-btn"><span>العودة للصفحة الرئيسية</span> <i class="fas fa-arrow-left" aria-hidden="true"></i></a>
        </div>
    </div>
</div>
@endsection