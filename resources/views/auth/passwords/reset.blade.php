@extends('layouts.auth')

@section('title', 'تعيين كلمة مرور جديدة — ' . config('app.name'))

@section('content')
<main class="auth-page">
    <!-- Grid & Ambient Glows -->
    <div class="grid-bg" aria-hidden="true"></div>
    <div class="glow glow--two" aria-hidden="true"></div>

    <!-- Left / Brand Showcase -->
    <div class="auth-brand">
        <a href="{{ url('/') }}" class="brand">
            <img src="{{ asset('images/waraq-logo.png') }}" alt="{{ config('app.name') }}">
            <span>{{ config('app.name') }}</span>
        </a>
        <h2>
            تعيين كلمة
            <br>
            <span class="gradient-text">مرور جديدة.</span>
        </h2>
        <p>قم باختيار كلمة مرور قوية لحماية حسابك ومكتبتك الرقمية على منصة أُفُق.</p>
    </div>

    <!-- Right / Form Card -->
    <div class="auth-card">
        <a href="{{ route('login') }}" class="auth-close" aria-label="الرجوع" title="الرجوع">
            <i class="fas fa-times"></i>
        </a>

        <div class="platform-pill mb-3" style="width: fit-content;">
            <i class="fas fa-lock text-lavender"></i>
            <span>تحديث الأمان</span>
        </div>

        <h1>كلمة مرور جديدة</h1>
        <p>أدخل بياناتك الجديدة لتأكيد إعادة التعيين.</p>

        @if($errors->any())
            <div class="auth-error mb-3">
                <i class="fas fa-exclamation-circle me-1"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <label for="email">
                <span>البريد الإلكتروني</span>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ $email ?? old('email') }}"
                    placeholder="name@example.com"
                    required
                    autocomplete="email"
                    autofocus
                >
            </label>

            <label for="password">
                <span>كلمة المرور الجديدة (٨ خانات على الأقل)</span>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    autocomplete="new-password"
                >
            </label>

            <label for="password-confirm">
                <span>تأكيد كلمة المرور</span>
                <input
                    id="password-confirm"
                    type="password"
                    name="password_confirmation"
                    placeholder="••••••••"
                    required
                    autocomplete="new-password"
                >
            </label>

            <button type="submit" class="button button--primary w-100 justify-content-center mt-2">
                <span>حفظ كلمة المرور والدخول</span>
                <i class="fas fa-arrow-left"></i>
            </button>
        </form>

        <div class="auth-switch">
            <a href="{{ route('login') }}">العودة لتسجيل الدخول</a>
        </div>
    </div>
</main>
@endsection
