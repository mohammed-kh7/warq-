@extends('layouts.app')

@section('title', 'النداءات والطلبات العاجلة — ' . config('app.name'))

@section('content')
@php
    $requests = $emergancyRequest;
    $requestCount = $requests->count();
@endphp

<div class="urgent-page-wrap position-relative">
    <!-- Ambient Glows & Grid -->
    <div class="glow glow--one" aria-hidden="true" style="background: radial-gradient(circle, rgba(239, 68, 68, 0.22), transparent 70%);"></div>
    <div class="glow glow--two" aria-hidden="true"></div>
    <div class="grid-bg" aria-hidden="true"></div>

    <div class="container-ofuq position-relative py-5" style="z-index: 5;">
        <!-- Header -->
        <div class="text-center mb-5">
            <div class="platform-pill mx-auto mb-3" style="background: rgba(239, 68, 68, 0.12); border-color: rgba(239, 68, 68, 0.3); color: #fca5a5;">
                <i class="fas fa-signal"></i>
                <span>تضامن مجتمعي طارئ</span>
            </div>
            <h1 class="text-white fw-extrabold mb-3" style="font-size: clamp(34px, 4.5vw, 54px);">
                النداءات والطلبات <span class="gradient-text">العاجلة.</span>
            </h1>
            <p class="text-muted fs-6 mx-auto" style="max-width: 650px; line-height: 1.8;">
                مساحة مخصصة للطلاب والباحثين لطلب المراجع والكتب الدراسية النادرة التي يصعب الحصول عليها، لتقديم العون المباشر والتضامن العلمي.
            </p>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ auth()->check() ? route('emergency.create') : route('login') }}" class="button button--primary" style="background: linear-gradient(135deg, #ef4444, #b91c1c); border-color: #f87171;">
                    <i class="fas fa-plus-circle"></i>
                    <span>إرسال طلب عاجل جديد</span>
                </a>
                <a href="{{ route('searchProducts.index') }}" class="button button--secondary">
                    <i class="fas fa-book"></i>
                    <span>تصفح الكتب المتوفرة</span>
                </a>
            </div>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success d-flex align-items-center gap-2 mx-auto mb-4" style="max-width: 700px; background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); color: #86efac; border-radius: 14px;">
                <i class="fas fa-check-circle"></i>
                <span>{{ session()->get('message') }}</span>
            </div>
        @endif

        <!-- Content -->
        @if($requestCount === 0)
            <div class="text-center py-5 glass-card mx-auto" style="max-width: 600px; border-radius: 24px;">
                <i class="fas fa-hands-helping fa-4x text-muted mb-3"></i>
                <h3 class="text-white fw-bold mb-2">لا توجد طلبات عاجلة مفتوحة حالياً</h3>
                <p class="text-muted small mb-4">تمت تلبية جميع النداءات أو لم يتم نشر طلبات جديدة بعد.</p>
                @auth
                    <a href="{{ route('emergency.create') }}" class="button button--primary">
                        أضف نداءك الآن
                    </a>
                @endauth
            </div>
        @else
            <div class="row g-4">
                @foreach($requests as $request)
                    <div class="col-md-6 col-lg-4">
                        <div class="glass-card p-4 h-100 d-flex flex-column justify-content-between" style="border-radius: 20px; border: 1px solid rgba(239, 68, 68, 0.28); background: radial-gradient(circle at 100% 0%, rgba(239, 68, 68, 0.1), rgba(15, 17, 28, 0.85));">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge rounded-pill bg-danger px-3 py-2" style="font-size: 11px;">
                                        <i class="fas fa-bolt me-1"></i> نداء عاجل
                                    </span>
                                    @if($request->location)
                                        <span class="text-muted small">
                                            <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $request->location }}
                                        </span>
                                    @endif
                                </div>
                                <h4 class="text-white fw-bold fs-6 lh-base mb-3" style="min-height: 48px;">
                                    {{ \Illuminate\Support\Str::limit($request->description, 95) }}
                                </h4>
                                @if($request->type)
                                    <div class="mb-3">
                                        <span class="badge" style="background: rgba(98, 70, 217, 0.2); color: var(--lavender); border: 1px solid var(--border-hover);">
                                            {{ $request->type }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-3 border-top" style="border-color: var(--border) !important;">
                                @php
                                    $wa = preg_replace('/\D+/', '', (string) $request->whatsapp);
                                    if (strlen($wa) > 0 && str_starts_with($wa, '0')) $wa = '970' . substr($wa, 1);
                                @endphp
                                @if($wa)
                                    <a href="https://wa.me/{{ $wa }}" target="_blank" class="button button--primary" style="padding: 6px 14px; font-size: 11px; background: #25D366; border-color: #25D366;">
                                        <i class="fab fa-whatsapp"></i>
                                        <span>تواصل واتساب</span>
                                    </a>
                                @else
                                    <span></span>
                                @endif
                                <a href="{{ route('emergancyRequest.show', $request->id) }}" class="text-link">
                                    <span>التفاصيل الكاملة</span>
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
