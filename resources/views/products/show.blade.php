@extends('layouts.app')
@section('title', $product->name)

@section('content')
@php
    $waDigits = preg_replace('/\D+/', '', (string) $product->whatsapp);
    if (strlen($waDigits) > 0 && str_starts_with($waDigits, '0')) {
        $waDigits = '970' . substr($waDigits, 1);
    }
    $waUrl = strlen($waDigits) > 0 ? 'https://wa.me/' . $waDigits : null;
@endphp
<div class="product-detail-page main-content">
    <div class="container px-3 py-4">
        @if(session()->has('message'))
        <div class="alert alert-success product-detail-page__alert d-flex align-items-center gap-2" role="alert">
            <i class="fas fa-check-circle" aria-hidden="true"></i>
            <span>{{ session()->get('message') }}</span>
        </div>
        @endif

        <header class="product-detail-page__hero text-center">
            <p class="product-detail-page__eyebrow"><i class="fas fa-book-open ms-1" aria-hidden="true"></i> تفاصيل الكتاب</p>
            <h1 class="product-detail-page__title">{{ $product->name }}</h1>
        </header>

        <div class="product-detail-page__card">
            <div class="product-detail-page__media">
                <img src="{{ asset('images/' . $product->image_path) }}" alt="{{ $product->name }}" class="product-detail-page__img">
            </div>
            <dl class="product-detail-page__fields">
                <div class="product-detail-page__row">
                    <dt class="product-detail-page__dt"><i class="fas fa-align-right ms-1" aria-hidden="true"></i> الوصف</dt>
                    <dd class="product-detail-page__dd">{{ $product->description }}</dd>
                </div>
                <div class="product-detail-page__row">
                    <dt class="product-detail-page__dt"><i class="fas fa-cubes ms-1" aria-hidden="true"></i> الكمية</dt>
                    <dd class="product-detail-page__dd">{{ $product->quantity }}</dd>
                </div>
                <div class="product-detail-page__row">
                    <dt class="product-detail-page__dt"><i class="fas fa-map-marker-alt ms-1" aria-hidden="true"></i> الموقع</dt>
                    <dd class="product-detail-page__dd">{{ $product->location }}</dd>
                </div>
                <div class="product-detail-page__row">
                    <dt class="product-detail-page__dt"><i class="fab fa-whatsapp ms-1" aria-hidden="true"></i> واتساب</dt>
                    <dd class="product-detail-page__dd product-detail-page__dd--mono">{{ $product->whatsapp }}</dd>
                </div>
            </dl>

            <div class="product-detail-page__actions">
                @if($waUrl)
                <a href="{{ $waUrl }}" class="btn product-detail-page__btn product-detail-page__btn--wa" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-whatsapp" aria-hidden="true"></i> تواصل عبر واتساب
                </a>
                @endif
                <a href="{{ url('/products') }}" class="btn product-detail-page__btn product-detail-page__btn--outline">
                    <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i> العودة للكتب
                </a>
                @if(Auth::user() && Auth::user()->id == $product->user_id)
                <div class="product-detail-page__owner-actions">
                    <a href="{{ url('/products/' . $product->slug . '/edit') }}" class="btn product-detail-page__btn product-detail-page__btn--edit">
                        <i class="fas fa-edit" aria-hidden="true"></i> تعديل
                    </a>
                    <form action="{{ url('/products/' . $product->slug) }}" method="post" class="product-detail-page__delete-form" onsubmit="return confirm('هل أنت متأكد من حذف هذا الكتاب؟');">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn product-detail-page__btn product-detail-page__btn--delete">
                            <i class="fas fa-trash-alt" aria-hidden="true"></i> حذف
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
