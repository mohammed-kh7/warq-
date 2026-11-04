@extends('layouts.auth')

@section('title', 'تسجيل الدخول — ' . config('app.name'))

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
            معرفة تمتد
            <br>
            <span class="gradient-text">إلى ما هو أبعد.</span>
        </h2>
        <p>حساب موحد يجمع رحلتك في مَسار ووَرَق وصِلة—تعلم، اقرأ، وشارك في بيئة عربية فاخرة.</p>
    </div>

    <!-- Right / Form Card -->
    <div class="auth-card">
        <a href="{{ url('/') }}" class="auth-close" aria-label="الرجوع للرئيسية" title="الرجوع للرئيسية">
            <i class="fas fa-times"></i>
        </a>

        <div class="platform-pill mb-3" style="width: fit-content;">
            <i class="fas fa-key text-lavender"></i>
            <span>نظام الحساب الموحد</span>
        </div>

        <h1>تسجيل الدخول</h1>
        <p>أكمل رحلتك المعرفية من حيث توقفت في منصة أُفُق.</p>

        @if($errors->any())
            <div class="auth-error mb-3">
                <i class="fas fa-exclamation-circle me-1"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <label for="email">
                <span>البريد الإلكتروني</span>
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

            <label for="password">
                <div class="d-flex justify-content-between align-items-center">
                    <span>كلمة المرور</span>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-muted small" style="text-decoration: none; font-size: 11px;">
                            نسيت كلمة المرور؟
                        </a>
                    @endif
                </div>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                >
            </label>

            <div class="d-flex align-items-center justify-content-between my-2">
                <label class="d-flex align-items-center gap-2 mb-0" style="cursor: pointer;">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: var(--purple);">
                    <span class="text-muted small">تذكرني على هذا الجهاز</span>
                </label>
            </div>

            <button type="submit" class="button button--primary w-100 justify-content-center">
                <span>تسجيل الدخول</span>
                <i class="fas fa-arrow-left"></i>
            </button>
        </form>

        <div class="auth-switch">
            ليس لديك حساب بعد؟
            <a href="{{ route('register') }}">أنشئ حساباً جديداً</a>
        </div>
    </div>
</main>
@endsection
