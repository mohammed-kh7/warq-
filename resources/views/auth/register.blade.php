@extends('layouts.auth')
@section('title', 'التسجيل')

@section('content')
<div class="auth-page">
    <div class="auth-page__bg" aria-hidden="true"></div>
    <div class="auth-page__wave" aria-hidden="true">
        <svg viewBox="0 0 1440 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path fill="rgba(255,255,255,0.11)" d="M0,48 C280,100 560,4 900,40 C1180,66 1320,32 1440,18 L1440,0 L0,0 Z" />
            <path fill="rgba(255,255,255,0.06)" d="M0,82 C420,22 720,98 1080,46 C1260,22 1360,36 1440,56 L1440,0 L0,0 Z" />
        </svg>
    </div>
    <svg class="auth-page__leaf" viewBox="0 0 240 200" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M24 168 Q120 24 228 84 Q136 124 24 168" fill="none" stroke="#fff" stroke-width="2.5" opacity="0.32" />
        <path d="M50 148 Q118 58 198 92" fill="none" stroke="#fff" stroke-width="1.5" opacity="0.22" />
    </svg>

    <div class="auth-shell">
        <div class="auth-card">
            <div class="auth-logo">
                <span class="auth-logo-stack">
                    <i class="fas fa-book-open" aria-hidden="true"></i>
                    <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                </span>
            </div>
            <h1 class="auth-title">إنشاء حساب جديد</h1>
            <p class="auth-sub">ابدأ رحلتك نحو القراءة والتعلّم</p>

            <form id="signupForm" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="auth-field">
                    <span class="auth-field__icon" aria-hidden="true"><i class="far fa-user"></i></span>
                    <input type="text" id="fullName" class="auth-field__input @error('name') is-invalid @enderror" name="name" placeholder="الاسم الكامل" value="{{ old('name') }}" required autocomplete="name">
                </div>
                @error('name')
                <span class="auth-invalid-feedback" role="alert">{{ $message }}</span>
                @enderror

                <div class="auth-field">
                    <span class="auth-field__icon" aria-hidden="true"><i class="far fa-envelope"></i></span>
                    <input type="email" id="email" class="auth-field__input @error('email') is-invalid @enderror" name="email" placeholder="البريد الإلكتروني" value="{{ old('email') }}" required autocomplete="email">
                </div>
                @error('email')
                <span class="auth-invalid-feedback" role="alert">{{ $message }}</span>
                @enderror

                <div class="auth-field">
                    <span class="auth-field__icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
                    <input type="password" id="password" class="auth-field__input @error('password') is-invalid @enderror" name="password" placeholder="كلمة المرور" required autocomplete="new-password">
                </div>
                @error('password')
                <span class="auth-invalid-feedback" role="alert">{{ $message }}</span>
                @enderror

                <div class="auth-field">
                    <span class="auth-field__icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
                    <input type="password" class="auth-field__input" id="confirmPassword" name="password_confirmation" placeholder="تأكيد كلمة المرور" required autocomplete="new-password">
                </div>

                <button type="submit" class="auth-submit">إنشاء حساب</button>
            </form>

            <p class="auth-footer">
                لديك حساب بالفعل؟
                <a href="{{ route('login') }}">تسجيل الدخول</a>
            </p>
        </div>
    </div>
</div>
@endsection
