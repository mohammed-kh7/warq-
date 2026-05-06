@extends('layouts.app')
@section('title', 'الكتب المتاحة للتبرع')

@section('content')
@php
    $totalCount = $products->count();
@endphp
<div class="products-catalog-page main-content">
    <div class="container px-3 py-4">
        <header class="products-catalog__hero text-center">
            <p class="products-catalog__eyebrow"><i class="fas fa-book-open ms-1" aria-hidden="true"></i> كتب ومراجع</p>
            <h1 class="products-catalog__title">الكتب المتاحة للتبرع</h1>
            @if($totalCount > 0)
            <p class="products-catalog__stat"><span class="products-catalog__stat-num">{{ $totalCount }}</span> {{ $totalCount > 1 ? 'كتب' : 'كتاب' }} في المنصة</p>
            @endif
        </header>

        @if(session()->has('message'))
        <div class="alert alert-success products-catalog__alert d-flex align-items-center gap-2" role="alert">
            <i class="fas fa-check-circle" aria-hidden="true"></i>
            <span>{{ session()->get('message') }}</span>
        </div>
        @endif

        @if($totalCount === 0)
        <div class="products-catalog__empty-global">
            <div class="products-catalog__empty-global-icon" aria-hidden="true"><i class="fas fa-box-open"></i></div>
            <h2 class="h5 fw-bold">لا توجد كتب مضافة بعد</h2>
            <p class="text-muted mb-3">عندما يضيف الأعضاء كتبهم ومراجعهم ستظهر هنا.</p>
            @auth
            <a href="{{ url('/products/create') }}" class="btn btn-primary">إضافة كتاب</a>
            @endauth
        </div>
        @else
        <section class="products-catalog-board" aria-labelledby="products-catalog-list-title">
            <div class="products-catalog-board__head">
                <span class="products-catalog-board__icon" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                <div class="products-catalog-board__head-text">
                    <h2 id="products-catalog-list-title" class="products-catalog-board__title">قائمة الكتب</h2>
                    <p class="products-catalog-board__meta">{{ $totalCount }} {{ $totalCount === 1 ? 'كتاب' : 'كتب' }}</p>
                </div>
            </div>
            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-sm-6 col-lg-4">
                    <article class="card product-catalog-card h-100 border-0 shadow-sm">
                        <div class="product-catalog-card__img-wrap">
                            <img src="{{ asset('images/' . $product->image_path) }}" class="card-img-top product-catalog-card__img" alt="{{ $product->name }}">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h3 class="h6 card-title product-catalog-card__name">{{ $product->name }}</h3>
                            <p class="card-text small text-muted flex-grow-1">{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
                            <a href="{{ url('/products/' . $product->slug) }}" class="btn btn-primary btn-sm mt-2">عرض التفاصيل</a>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <div class="text-center products-catalog__footer">
            <a href="{{ route('homePage') }}" class="home-btn"><span>العودة للصفحة الرئيسية</span> <i class="fas fa-arrow-left" aria-hidden="true"></i></a>
        </div>
    </div>
</div>
@endsection
