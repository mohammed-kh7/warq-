@extends('layouts.auth')
@section('title', 'تسجيل الدخول')

@section('content')
<div class="auth-page">
    <div class="auth-page__bg" aria-hidden="true"></div>
    <div class="auth-page__wave" aria-hidden="true">
        <svg viewBox="0 0 1440 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path fill="rgba(255,255,255,0.11)" d="M0,52 C320,102 520,8 880,44 C1140,68 1300,36 1440,22 L1440,0 L0,0 Z" />
            <path fill="rgba(255,255,255,0.06)" d="M0,78 C400,28 680,96 1040,50 C1240,28 1360,40 1440,58 L1440,0 L0,0 Z" />
        </svg>
    </div>
    <svg class="auth-page__leaf" viewBox="0 0 240 200" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M20 170 Q110 30 220 90 Q130 130 20 170" fill="none" stroke="#fff" stroke-width="2.5" opacity="0.35" />
        <path d="M45 155 Q100 70 180 100" fill="none" stroke="#fff" stroke-width="1.5" opacity="0.25" />
    </svg>

    <div class="auth-shell">
        <div class="auth-card">
            <div class="auth-logo">
                <span class="auth-logo-stack">
                    <i class="fas fa-book-open" aria-hidden="true"></i>
                    <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                </span>
            </div>
            <h1 class="auth-title">تسجيل الدخول</h1>
            <p class="auth-sub">مرحباً بعودتك</p>

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <div class="auth-field">
                    <span class="auth-field__icon" aria-hidden="true"><i class="far fa-envelope"></i></span>
                    <input id="email" type="email" class="auth-field__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="البريد الإلكتروني" required autocomplete="email" autofocus>
                </div>
                @error('email')
                <span class="auth-invalid-feedback" role="alert">{{ $message }}</span>
                @enderror

                <div class="auth-field">
                    <span class="auth-field__icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
                    <input id="password" type="password" class="auth-field__input @error('password') is-invalid @enderror" name="password" placeholder="كلمة المرور" required autocomplete="current-password">
                </div>
                @error('password')
                <span class="auth-invalid-feedback" role="alert">{{ $message }}</span>
                @enderror

                <div class="auth-row-between">
                    <span></span>
                    @if (Route::has('password.request'))
                    <a class="auth-link-muted" href="{{ route('password.request') }}">نسيت كلمة المرور؟</a>
                    @endif
                </div>

                <button type="submit" class="auth-submit">تسجيل الدخول</button>
            </form>

            <p class="auth-footer">
                ليس لديك حساب؟
                <a href="{{ route('register') }}">إنشاء حساب جديد</a>
            </p>
        </div>
    </div>
</div>
@endsection
