@extends('layouts.auth')

@section('title', 'إنشاء حساب جديد — ' . config('app.name'))

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
            ابدأ رحلتك
            <br>
            <span class="gradient-text">في عالم المعرفة.</span>
        </h2>
        <p>انضم إلى مجتمع القرّاء، وتصفح آلاف الكتب والسلايدات، وشارك بالتبرع أو طلب المراجع بنقرة زر واحدة.</p>
    </div>

    <!-- Right / Form Card -->
    <div class="auth-card">
        <a href="{{ url('/') }}" class="auth-close" aria-label="الرجوع للرئيسية" title="الرجوع للرئيسية">
            <i class="fas fa-times"></i>
        </a>

        <div class="platform-pill mb-3" style="width: fit-content;">
            <i class="fas fa-user-plus text-lavender"></i>
            <span>حساب جديد</span>
        </div>

        <h1>إنشاء حساب جديد</h1>
        <p>انضم إلى منظومة عربية صُممت للمعرفة والتضامن الأكاديمي.</p>

        @if($errors->any())
            <div class="auth-error mb-3">
                <i class="fas fa-exclamation-circle me-1"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" id="signupForm">
            @csrf

            <label for="fullName">
                <span>الاسم الكامل</span>
                <input
                    id="fullName"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="اكتب اسمك الكامل"
                    required
                    autocomplete="name"
                    autofocus
                >
            </label>

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
                >
            </label>

            <label for="password">
                <span>كلمة المرور (٨ خانات على الأقل)</span>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    autocomplete="new-password"
                >
            </label>

            <label for="confirmPassword">
                <span>تأكيد كلمة المرور</span>
                <input
                    id="confirmPassword"
                    type="password"
                    name="password_confirmation"
                    placeholder="••••••••"
                    required
                    autocomplete="new-password"
                >
            </label>

            <button type="submit" class="button button--primary w-100 justify-content-center">
                <span>إنشاء الحساب والبدء</span>
                <i class="fas fa-arrow-left"></i>
            </button>
        </form>

        <div class="auth-switch">
            لديك حساب بالفعل؟
            <a href="{{ route('login') }}">تسجيل الدخول</a>
        </div>
    </div>
</main>
@endsection
