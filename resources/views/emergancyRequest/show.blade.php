@extends('layouts.app')

@section('title', 'تفاصيل النداء العاجل — ' . config('app.name'))

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

<div class="urgent-detail-wrap position-relative">
    <!-- Ambient Glows & Grid -->
    <div class="glow glow--one" aria-hidden="true" style="background: radial-gradient(circle, rgba(239, 68, 68, 0.25), transparent 70%);"></div>
    <div class="glow glow--two" aria-hidden="true"></div>
    <div class="grid-bg" aria-hidden="true"></div>

    <div class="container-ofuq position-relative py-5" style="z-index: 5;">
        <!-- Breadcrumb / Back -->
        <div class="mb-4">
            <a href="{{ route('emergancyRequest.index') }}" class="text-link">
                <i class="fas fa-arrow-right me-1"></i>
                <span>العودة لجميع النداءات العاجلة</span>
            </a>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success d-flex align-items-center gap-2 mb-4" style="background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); color: #86efac; border-radius: 14px;">
                <i class="fas fa-check-circle"></i>
                <span>{{ session()->get('message') }}</span>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="glass-card p-5" style="border-radius: 28px; border: 1px solid rgba(239, 68, 68, 0.35); background: radial-gradient(circle at 100% 0%, rgba(239, 68, 68, 0.12), rgba(15, 17, 28, 0.92));">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge rounded-pill bg-danger px-3 py-2" style="font-size: 12px;">
                                <i class="fas fa-bolt me-1"></i> نداء طارئ
                            </span>
                            @if($emergencyRequest->type)
                                <span class="badge px-3 py-2" style="background: rgba(98, 70, 217, 0.25); color: var(--lavender); border: 1px solid var(--border-hover); font-size: 12px;">
                                    {{ $emergencyRequest->type }}
                                </span>
                            @endif
                        </div>
                        <div class="text-muted small">
                            <i class="far fa-clock me-1"></i>
                            <span>{{ $publishedAt->diffForHumans() }} ({{ $publishedAt->format('Y-m-d') }})</span>
                        </div>
                    </div>

                    <h2 class="text-white fw-bold mb-4" style="font-size: 26px; line-height: 1.5;">
                        {{ $emergencyRequest->description }}
                    </h2>

                    <div class="row g-3 py-3 my-3 border-top border-bottom" style="border-color: var(--border) !important;">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-3 rounded-circle" style="background: rgba(255, 255, 255, 0.05); color: var(--lavender);">
                                    <i class="fas fa-map-marker-alt fa-lg text-danger"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">الموقع والمدينة</small>
                                    <strong class="text-white">{{ $emergencyRequest->location ?? 'غير محدد' }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-3 rounded-circle" style="background: rgba(255, 255, 255, 0.05); color: var(--lavender);">
                                    <i class="fab fa-whatsapp fa-lg text-success"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">رقم التواصل المباشر</small>
                                    <strong class="text-white" dir="ltr">{{ $emergencyRequest->whatsapp ?? 'غير متوفر' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-3 mt-4">
                        @if($waUrl)
                            <a href="{{ $waUrl }}" target="_blank" class="button button--primary" style="background: #25D366; border-color: #25D366;">
                                <i class="fab fa-whatsapp fa-lg"></i>
                                <span>تواصل عبر واتساب لمساعدة الطالب</span>
                            </a>
                        @endif

                        <a href="{{ route('emergancyRequest.index') }}" class="button button--secondary">
                            <span>العودة للقائمة</span>
                        </a>

                        @auth
                            @if(Auth::id() === $emergencyRequest->user_id || Auth::user()->is_admin)
                                <form action="{{ route('emergancyRequest.destroy', $emergencyRequest->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا النداء؟');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button button--ghost text-danger">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>حذف الطلب</span>
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
