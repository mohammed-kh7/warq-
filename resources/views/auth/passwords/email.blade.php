@extends('layouts.auth')

@section('title', 'استعادة كلمة المرور — ' . config('app.name'))

@section('content')
<main class="auth-page">
    <!-- Grid & Ambient Glows -->
    <div class="grid-bg" aria-hidden="true"></div>
    <div class="glow glow--one" aria-hidden="true"></div>

    <!-- Left / Brand Showcase -->
    <div class="auth-brand">
        <a href="{{ url('/') }}" class="brand">
            <img src="{{ asset('images/waraq-logo.png') }}" alt="{{ config('app.name') }}">
            <span>{{ config('app.name') }}</span>
        </a>
        <h2>
            أمان حسابك
            <br>
            <span class="gradient-text">أولويتنا الدائمة.</span>
        </h2>
        <p>سنرسل لك رابطاً آمناً عبر بريدك الإلكتروني لإعادة تعيين كلمة المرور واستعادة الوصول لمكتبتك وحسابك.</p>
    </div>

    <!-- Right / Form Card -->
    <div class="auth-card">
        <a href="{{ route('login') }}" class="auth-close" aria-label="الرجوع لتسجيل الدخول" title="الرجوع">
            <i class="fas fa-arrow-right"></i>
        </a>

        <div class="platform-pill mb-3" style="width: fit-content;">
            <i class="fas fa-shield-alt text-lavender"></i>
            <span>أمان الحساب</span>
        </div>

        <h1>استعادة كلمة المرور</h1>
        <p>أدخل بريدك الإلكتروني المسجل وسنرسل لك رابط الاستعادة فوراً.</p>

        @if (session('status'))
            <div class="alert alert-success d-flex align-items-center gap-2 mb-3" style="background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); color: #86efac; border-radius: 12px; font-size: 13px;">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="auth-error mb-3">
                <i class="fas fa-exclamation-circle me-1"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label for="email">
                <span>البريد الإلكتروني المسجل</span>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="name@example.com"
                    required
                    autocomplete="email"
                    autofocus
                >
            </label>

            <button type="submit" class="button button--primary w-100 justify-content-center mt-2">
                <span>إرسال رابط الاستعادة</span>
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>

        <div class="auth-switch">
            تذكرت كلمة المرور؟
            <a href="{{ route('login') }}">العودة لتسجيل الدخول</a>
        </div>
    </div>
</main>
@endsection
