@extends('layouts.landing')
@section('title', 'أهلاً وسهلاً في منصة ورقة')

@section('content')
<div class="landing-page">
    <section class="hero-section text-center py-5 mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">مرحباً بك في منصة <span class="text-primary">ورقة</span></h1>
            <p class="lead text-muted mb-4">
                منصة مجتمعية لتبادل الكتب الرقمية والورقية، طلب المراجع، والنداءات العاجلة
            </p>
            <div class="d-flex gap-3 justify-content-center">
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-book-plus me-2" aria-hidden="true"></i> نشر كتاب
                </a>
                <a href="{{ route('emergancyRequest.create') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-exclamation-triangle me-2" aria-hidden="true"></i> نداء عاجل
                </a>
            </div>
        </div>
    </section>

    <section class="features-section py-5 mb-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-book-reader fa-2x text-primary"></i>
                    </div>
                    <h3>قراءة الكتب</h3>
                    <p>عارض متقدم للكتب الرقمية مع حفظ التقدم تلقائياً</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-users fa-2x text-success"></i>
                    </div>
                    <h3>مجتمع قرّاء</h3>
                    <p>تبادل المراجع، طلبات المحتوى، والنقاشات الأكاديمية</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-shield-alt fa-2x text-warning"></i>
                    </div>
                    <h3>حماية المحتوى</h3>
                    <p>حماية متقدمة من النسخ غير المشروع</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section py-5 mb-5">
        <div class="container text-center">
            <h2 class="mb-4">جاهز للبدء؟</h2>
            <p class="text-muted mb-4">انضم إلينا اليوم لتصبح جزءاً من مجتمع القرّاء</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-sign-in-alt me-2" aria-hidden="true"></i> تسجيل الدخول
            </a>
        </div>
    </section>
</div>
@endsection