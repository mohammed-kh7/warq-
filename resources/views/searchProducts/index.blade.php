@extends('layouts.app')

@section('title', 'ابحث عن كتابك القادم — أُفُق وَرَق')

@section('content')
<div class="catalog-page">
    <!-- Ambient Glows & Grid -->
    <div class="glow glow--one" aria-hidden="true"></div>
    <div class="glow glow--two" aria-hidden="true"></div>
    <div class="grid-bg" aria-hidden="true"></div>

    <div class="container-ofuq position-relative" style="z-index: 5;">
        <!-- Header & Search Box -->
        <div class="catalog-header">
            <h1 class="catalog-title">
                ابحث عن <span class="gradient-text">كتابك القادم.</span>
            </h1>

            <div class="catalog-search-wrap">
                <form action="{{ route('searchProducts.index') }}" method="GET" class="catalog-search-form">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="...ابحث بالعنوان أو المؤلف أو الموضوع"
                        class="catalog-search-input"
                        autocomplete="off"
                    >
                    @if(!empty($category) && $category !== 'الكل')
                        <input type="hidden" name="category" value="{{ $category }}">
                    @endif
                    <button type="submit" class="catalog-search-btn">
                        <span>بحث</span>
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Catalog Layout (Main Grid + Filter Sidebar) -->
        <div class="catalog-layout">
            <!-- Books Column -->
            <div class="catalog-main">
                <!-- Toolbar -->
                <div class="catalog-toolbar">
                    <div>
                        <span>عدد النتائج: </span>
                        <strong class="text-white">{{ $products->count() }}</strong>
                        @if(!empty($category) && $category !== 'الكل')
                            <span class="badge bg-purple ms-2" style="background: rgba(98, 70, 217, 0.25); color: var(--lavender); border: 1px solid var(--border-hover);">
                                {{ $category }}
                            </span>
                        @endif
                    </div>
                    <div>
                        <span class="text-muted small">عرض الكتب المتوفرة والمشاركات</span>
                    </div>
                </div>

                <!-- Books 3D Grid -->
                @if($products->isEmpty())
                    <div class="text-center py-5 glass-card">
                        <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                        <h4 class="text-white">لم يتم العثور على كتب مطابقة للبحث</h4>
                        <p class="text-muted small">جرب البحث بكلمات أخرى أو اختر تصنيفاً مختلفاً</p>
                        <a href="{{ route('searchProducts.index') }}" class="button button--secondary mt-2">
                            عرض جميع الكتب
                        </a>
                    </div>
                @else
                    <div class="catalogue-books">
                        @php
                            $colors = ['violet', 'blue', 'lavender', 'deep'];
                        @endphp
                        @foreach($products as $index => $product)
                            @php
                                $color = $colors[$index % 4];
                            @endphp
                            <article>
                                <a href="{{ url('/products/' . $product->slug) }}" class="book book--{{ $color }}">
                                    <span class="book__mark">
                                        <img src="{{ asset('images/waraq-logo.png') }}" alt="أُفُق">
                                    </span>
                                    <small>{{ $product->category ?? 'عام' }}</small>
                                    <strong>{{ $product->name }}</strong>
                                    <i></i>
                                    <em>{{ $product->user->name ?? 'مؤلف معتمد' }}</em>
                                </a>
                            </article>
                        @endforeach
                    </div>
                @endif

                <!-- Matching Urgent Requests (if searched) -->
                @if($emergencyRequest->isNotEmpty())
                    <div class="mt-5 pt-4 border-top border-secondary">
                        <h3 class="text-white mb-3 d-flex align-items-center gap-2">
                            <i class="fas fa-bolt text-warning"></i>
                            <span>طلبات عاجلة مطابقة للبحث</span>
                        </h3>
                        <div class="row g-3">
                            @foreach($emergencyRequest as $req)
                                <div class="col-md-6">
                                    <div class="glass-card p-3">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="badge bg-danger">طلب عاجل</span>
                                            <small class="text-muted"><i class="fas fa-map-marker-alt"></i> {{ $req->location }}</small>
                                        </div>
                                        <p class="text-white small mb-3">{{ $req->description }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="https://wa.me/{{ $req->whatsapp }}" target="_blank" class="btn btn-sm btn-success rounded-pill">
                                                <i class="fab fa-whatsapp me-1"></i> تواصل
                                            </a>
                                            <a href="{{ url('/emergancyRequest/' . $req->id) }}" class="btn btn-sm button--ghost text-sky">
                                                التفاصيل
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Filter Sidebar (Right in RTL) -->
            <aside class="filter-sidebar">
                <h3 class="filter-title">
                    <i class="fas fa-sliders-h text-lavender"></i>
                    <span>تصفية النتائج</span>
                </h3>

                <div class="filter-group">
                    @foreach($categories as $catKey => $catLabel)
                        @php
                            $isActive = ($category === $catKey) || (empty($category) && $catKey === 'الكل');
                            $urlParams = array_filter([
                                'search' => $search ?? null,
                                'category' => $catKey === 'الكل' ? null : $catKey,
                                'sort' => $sort ?? null,
                            ]);
                            $catUrl = route('searchProducts.index', $urlParams);
                        @endphp
                        <a href="{{ $catUrl }}" class="filter-pill-btn {{ $isActive ? 'active' : '' }}">
                            <span>{{ $catLabel }}</span>
                            <span class="radio-circle"></span>
                        </a>
                    @endforeach
                </div>

                <hr class="my-4" style="border-color: var(--border);">

                <div class="d-grid gap-2">
                    <a href="{{ auth()->check() ? route('products.create') : route('login') }}" class="button button--primary text-center">
                        <i class="fas fa-plus-circle"></i>
                        <span>تبرع بكتاب جديد</span>
                    </a>
                    <a href="{{ auth()->check() ? route('emergency.create') : route('login') }}" class="button button--secondary text-center">
                        <i class="fas fa-bolt text-warning"></i>
                        <span>إرسال طلب عاجل</span>
                    </a>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
