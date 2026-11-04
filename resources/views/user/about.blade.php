@extends('layouts.app')
@section('title', 'عن المنصة')

@section('content')
<div class="about-page main-content">
    <div class="container px-3 py-4">
        <div class="row g-4 align-items-center mb-5">
            <div class="col-lg-6">
                <h1 class="display-6 fw-bold mb-4">منصة <span class="text-primary">وفقة</span> للكتب الرقمية</h1>
                <p class="lead text-muted mb-4">
                    منصة مجتمعية تهدف إلى تعزيز الثقافة ونشر المعرفة بين القراء من خلال تسهيل تبادل وبيع الكتب بمختلف أنواعها.
                </p>
                <p class="mb-3">
                    نحن نؤمن بأن المعرفة يجب أن تكون متاحة للجميع، لذا نقدّم منهجية حديثة للنشر والتبادل الرقمي.
                </p>
                <div class="row g-3 mt-4">
                    <div class="col-6">
                        <div class="stats-box text-center p-3 border rounded">
                            <h3 class="text-primary mb-1">500+</h3>
                            <small>كتاب</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stats-box text-center p-3 border rounded">
                            <h3 class="text-success mb-1">1000+</h3>
                            <small>عضو</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="{{ asset('images/about-platform-desk.png') }}" class="img-fluid rounded shadow" alt="منصة وفقة">
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-4">
                <div class="feature-card text-center h-100 p-4 border rounded">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-book-reader fa-2x text-primary"></i>
                    </div>
                    <h3>قراءة الكتب الرقمية</h3>
                    <p>عارض متقدم يدعم PDF والملفات الأكاديمية مع حفظ التقدم تلقائياً.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feature-card text-center h-100 p-4 border rounded">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-users fa-2x text-success"></i>
                    </div>
                    <h3>مجتمع قرّاء متخصص</h3>
                    <p>منصة لتبادل المراجع، طلبات المحتوى، والنقاشات الأكاديمية.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feature-card text-center h-100 p-4 border rounded">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-shield-alt fa-2x text-warning"></i>
                    </div>
                    <h3>حماية المحتوى</h3>
                    <p>حماية متقدمة من النسخ غير المشروع وحفظ الملكية الفكرية.</p>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-question-circle me-2" aria-hidden="true"></i> الأسئلة المتشابكة</h5>
                    </div>
                    <div class="card-body">
                        <div class="faq-item mb-3">
                            <h6 class="mb-2">كيف أضيف كتاباً؟</h6>
                            <p class="text-muted small">انقر على "نشر كتاب" من القائمة الجانبية واملأ النموذج المدعوم.</p>
                        </div>
                        <div class="faq-item mb-3">
                            <h6 class="mb-2">هل أرباحي آمنة؟</h6>
                            <p class="text-muted small">نعم، جميع المعاملات محمية وتتم عبر بوابات دفع موثوقة.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-contact-mail me-2" aria-hidden="true"></i> تواصل معنا</h5>
                    </div>
                    <div class="card-body">
                        <div class="contact-info">
                            <div class="mb-3">
                                <strong>البريد الإلكتروني:</strong>
                                <br><small>support@wugha.com</small>
                            </div>
                            <div class="mb-3">
                                <strong>الدعم الفني:</strong>
                                <br><small>24/7 على مدار 24 ساعة</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('homePage') }}" class="home-btn"><span>العودة للصفحة الرئيسية</span> <i class="fas fa-arrow-left" aria-hidden="true"></i></a>
        </div>
    </div>
</div>
@endsection