@extends('layouts.app')
@section('title', 'جميع الطلبات العاجلة')

@section('content')
@php
    $requests = $emergancyRequest;
    $requestCount = $requests->count();
@endphp
<div class="urgent-requests-index-page main-content">
    <div class="container px-3 py-4">
        <header class="urgent-requests-index__hero text-center">
            <p class="urgent-requests-index__eyebrow"><i class="fas fa-exclamation-circle ms-1" aria-hidden="true"></i> نداءات المجتمع</p>
            <h1 class="urgent-requests-index__title">جميع الطلبات العاجلة</h1>
            @if($requestCount > 0)
            <p class="urgent-requests-index__stat"><span class="urgent-requests-index__stat-num">{{ $requestCount }}</span> {{ $requestCount === 1 ? 'طلب نشط' : 'طلبات نشطة' }}</p>
            @endif
        </header>

        @if(session()->has('message'))
        <div class="alert alert-success urgent-requests-index__alert d-flex align-items-center gap-2 justify-content-center" role="alert">
            <i class="fas fa-check-circle" aria-hidden="true"></i>
            <span>{{ session()->get('message') }}</span>
        </div>
        @endif

        @if($requestCount === 0)
        <div class="urgent-requests-index__empty">
            <div class="urgent-requests-index__empty-icon" aria-hidden="true"><i class="fas fa-hand-holding-heart"></i></div>
            <h2 class="urgent-requests-index__empty-title">لا توجد طلبات عاجلة بعد</h2>
            <p class="urgent-requests-index__empty-text">عند نشر نداءات جديدة ستظهر هنا مرتبة في بطاقات. يمكنك العودة لاحقًا أو إضافة طلب عند الحاجة.</p>
            @auth
            <a href="{{ route('emergancyRequest.create') }}" class="btn urgent-requests-index__empty-cta">إضافة طلب عاجل</a>
            @endauth
        </div>
        @else
        <div class="urgent-requests-index__list-wrap">
            <div class="row g-4 urgent-requests-index__grid">
                @foreach($requests as $request)
                <div class="col-sm-6 col-lg-4">
                    <article class="urgent-request-card h-100">
                        <div class="urgent-request-card__media">
                            @include('partials.urgent-request-visual')
                            <span class="urgent-request-card__badge">عاجل</span>
                        </div>
                        <div class="urgent-request-card__body">
                            <h2 class="urgent-request-card__title">{{ \Illuminate\Support\Str::limit($request->description, 78) }}</h2>
                            <p class="urgent-request-card__meta">
                                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                <span>{{ \Illuminate\Support\Str::limit($request->location, 48) }}</span>
                            </p>
                            <a href="{{ route('emergancyRequest.show', $request->id) }}" class="btn urgent-card-cta">عرض التفاصيل</a>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="text-center urgent-requests-index__actions">
            <a href="{{ route('homePage') }}" class="custom-btn urgent-btn urgent-requests-index__home-link">
                العودة للصفحة الرئيسية <i class="fas fa-arrow-left" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</div>
@endsection
