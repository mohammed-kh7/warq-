@extends('layouts.app')
@section('title', 'كتبي')

@section('content')
<div class="user-dashboard container px-3 py-4">
    <section class="user-dash-section user-dash-section--products" aria-labelledby="dash-products-title">
        <header class="user-dash-section__head">
            <p class="user-dash-section__eyebrow"><i class="fas fa-book-open ms-1" aria-hidden="true"></i> مساهماتك</p>
            <h1 id="dash-products-title" class="user-dash-section__title">كتبي</h1>
        </header>
        @if($products->isEmpty())
        <div class="user-dash-empty user-dash-empty--teal">
            <div class="user-dash-empty__icon" aria-hidden="true"><i class="fas fa-book"></i></div>
            <p class="user-dash-empty__title">لا توجد كتب بعد</p>
            <p class="user-dash-empty__text">ابدأ بإضافة كتاب أو مرجع لتظهر هنا وتصل للأعضاء.</p>
            <a href="{{ url('/products/create') }}" class="btn btn-primary user-dash-empty__btn">إضافة كتاب</a>
        </div>
        @else
        <div class="row g-4 user-dash-section__grid">
            @foreach($products as $product)
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card user-dash-product-card h-100 border-0 shadow-sm position-relative">
                    <img src="{{ asset('images/' . $product->image_path) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body text-center d-flex flex-column">
                        <h2 class="card-title h6 user-dash-card-title">اسم الكتاب: {{ $product->name }}</h2>
                        <p class="card-text small text-muted flex-grow-1">{{ \Illuminate\Support\Str::limit($product->description, 120) }}</p>
                        <a href="{{ url('/products/' . $product->slug) }}" class="btn btn-primary btn-sm stretched-link">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </section>

    <section class="user-dash-section user-dash-section--urgent" aria-labelledby="dash-urgent-title">
        <header class="user-dash-section__head">
            <p class="user-dash-section__eyebrow user-dash-section__eyebrow--danger"><i class="fas fa-bolt ms-1" aria-hidden="true"></i> متابعة الطوارئ</p>
            <h2 id="dash-urgent-title" class="user-dash-section__title user-dash-section__title--danger">طلباتي الطارئة</h2>
            <p class="user-dash-section__sub">طلبات المساعدة العاجلة التي نشرتها؛ راقب الردود من صفحة كل طلب.</p>
        </header>
        @if($emergencyRequests->isEmpty())
        <div class="user-dash-empty user-dash-empty--danger">
            <div class="user-dash-empty__icon" aria-hidden="true"><i class="fas fa-exclamation-triangle"></i></div>
            <p class="user-dash-empty__title">لا توجد طلبات طارئة</p>
            <p class="user-dash-empty__text">عند الحاجة يمكنك إنشاء نداء جديد ليتابعه المجتمع.</p>
            <a href="{{ url('/emergancyRequest/create') }}" class="btn user-dash-empty__btn user-dash-empty__btn--danger">إضافة طلب عاجل</a>
        </div>
        @else
        <div class="row g-4 user-dash-section__grid">
            @foreach($emergencyRequests as $request)
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card user-dash-urgent-card h-100 border-0 shadow-sm position-relative">
                    <div class="user-dash-urgent-card__visual">
                        @include('partials.urgent-request-visual')
                    </div>
                    <div class="card-body text-center d-flex flex-column">
                        <h2 class="card-title h6">{{ \Illuminate\Support\Str::limit($request->description, 70) }}</h2>
                        <p class="card-text small text-muted">عرض التفاصيل</p>
                        <a href="{{ url('/emergancyRequest/' . $request->id) }}" class="btn urgent-card-cta btn-sm stretched-link">عرض التفاصيل</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </section>

    <div class="user-dash-footer text-center">
        <a href="{{ route('homePage') }}" class="home-btn"><span>العودة للصفحة الرئيسية</span> <i class="fas fa-arrow-left" aria-hidden="true"></i></a>
    </div>
</div>
@endsection
