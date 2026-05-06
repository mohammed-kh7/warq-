@extends('layouts.app')
@section('title', 'تفاصيل الطلب العاجل')

@section('content')
@php
    $waDigits = preg_replace('/\D+/', '', (string) $emergencyRequest->whatsapp);
    if (strlen($waDigits) > 0 && str_starts_with($waDigits, '0')) {
        $waDigits = '970' . substr($waDigits, 1);
    }
    $waUrl = strlen($waDigits) > 0 ? 'https://wa.me/' . $waDigits : null;
    $publishedAt = $emergencyRequest->created_at instanceof \Carbon\Carbon
        ? $emergencyRequest->created_at
        : \Carbon\Carbon::parse($emergencyRequest->created_at);
@endphp
<div class="emergency-detail-page main-content">
    <div class="container px-3 py-4">
        @if(session()->has('message'))
        <div class="alert alert-success emergency-detail-page__alert d-flex align-items-center gap-2" role="alert">
            <i class="fas fa-check-circle" aria-hidden="true"></i>
            <span>{{ session()->get('message') }}</span>
        </div>
        @endif

        <header class="emergency-detail-page__hero text-center">
            <p class="emergency-detail-page__eyebrow"><i class="fas fa-bolt ms-1" aria-hidden="true"></i> طلب عاجل</p>
            <h1 class="emergency-detail-page__title">تفاصيل الطلب</h1>
        </header>

        <div class="emergency-detail-page__card">
            <div class="emergency-detail-page__media">
                @include('partials.urgent-request-visual')
            </div>
            <dl class="emergency-detail-page__fields">
                @if($emergencyRequest->type)
                <div class="emergency-detail-page__row">
                    <dt class="emergency-detail-page__dt"><i class="fas fa-tag ms-1" aria-hidden="true"></i> نوع الطلب</dt>
                    <dd class="emergency-detail-page__dd">{{ $emergencyRequest->type }}</dd>
                </div>
                @endif
                <div class="emergency-detail-page__row">
                    <dt class="emergency-detail-page__dt"><i class="fas fa-align-right ms-1" aria-hidden="true"></i> وصف الطلب</dt>
                    <dd class="emergency-detail-page__dd">{{ $emergencyRequest->description }}</dd>
                </div>
                <div class="emergency-detail-page__row">
                    <dt class="emergency-detail-page__dt"><i class="fas fa-map-marker-alt ms-1" aria-hidden="true"></i> الموقع</dt>
                    <dd class="emergency-detail-page__dd">{{ $emergencyRequest->location }}</dd>
                </div>
                <div class="emergency-detail-page__row">
                    <dt class="emergency-detail-page__dt"><i class="fas fa-clock ms-1" aria-hidden="true"></i> تاريخ النشر</dt>
                    <dd class="emergency-detail-page__dd emergency-detail-page__dd--mono">{{ $publishedAt->format('Y-m-d H:i') }}</dd>
                </div>
                <div class="emergency-detail-page__row">
                    <dt class="emergency-detail-page__dt"><i class="fab fa-whatsapp ms-1" aria-hidden="true"></i> واتساب</dt>
                    <dd class="emergency-detail-page__dd emergency-detail-page__dd--mono">{{ $emergencyRequest->whatsapp }}</dd>
                </div>
            </dl>

            <div class="emergency-detail-page__actions">
                @if($waUrl)
                <a href="{{ $waUrl }}" class="btn emergency-detail-page__btn emergency-detail-page__btn--contact" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-whatsapp" aria-hidden="true"></i> تواصل عبر واتساب
                </a>
                @endif
                <a href="{{ route('emergancyRequest.index') }}" class="btn emergency-detail-page__btn emergency-detail-page__btn--outline">
                    <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i> العودة لجميع الطلبات
                </a>
                @if(Auth::user() && Auth::user()->id == $emergencyRequest->user_id)
                <div class="emergency-detail-page__owner-actions">
                    <a href="{{ route('emergancyRequest.edit', $emergencyRequest->id) }}" class="btn emergency-detail-page__btn emergency-detail-page__btn--edit">
                        <i class="fas fa-edit" aria-hidden="true"></i> تعديل
                    </a>
                    <form action="{{ route('emergancyRequest.destroy', $emergencyRequest->id) }}" method="post" class="emergency-detail-page__delete-form" onsubmit="return confirm('هل أنت متأكد من حذف هذا الطلب؟');">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn emergency-detail-page__btn emergency-detail-page__btn--delete">
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
