@extends('layouts.app')
@section('title', 'مشاركة')

@section('content')
<div class="sharing-page main-content">
    <div class="container px-3 py-4">
        <header class="sharing__hero text-center">
            <p class="sharing__eyebrow"><i class="fas fa-share-alt me-2" aria-hidden="true"></i> مشاركة</p>
            <h1 class="sharing__title">شارك محتواك مع المجتمع</h1>
            <p class="sharing__stat">ساهم في نشر المعرفة وتعزيز التضامن المجتمعي</p>
        </header>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="fas fa-book-share fa-2x text-primary"></i>
                        </div>
                        <h3 class="card-title mb-3">شارك كتاباً</h3>
                        <p class="card-text text-muted">أضف كتاب جديد للمنصة وساعد الآخرين في العثور عليه</p>
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2" aria-hidden="true"></i> نشر كتاب
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="fas fa-bolt fa-2x text-warning"></i>
                        </div>
                        <h3 class="card-title mb-3">قدّم طلباً عاجلاً</h3>
                        <p class="card-text text-muted">لا تملك الكتاب؟ اطلبه من المجتمع</p>
                        <a href="{{ route('emergancyRequest.create') }}" class="btn btn-warning text-white">
                            <i class="fas fa-exclamation-triangle me-2" aria-hidden="true"></i> نداء عاجل
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="fas fa-heart fa-2x text-danger"></i>
                        </div>
                        <h3 class="card-title mb-3">تبرع بكتاب</h3>
                        <p class="card-text text-muted">تبرع بكتابك لمن يحتاجه</p>
                        <a href="#" class="btn btn-danger">
                            <i class="fas fa-gift me-2" aria-hidden="true"></i> تبرع
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-users me-2" aria-hidden="true"></i> كيف تساهم؟</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="d-flex">
                            <div class="step-number bg-primary text-white rounded-circle me-3">١</div>
                            <div>
                                <h6>أنشئ حساباً</h6>
                                <p class="mb-0 text-muted">الانضمام سهل ومجاني</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex">
                            <div class="step-number bg-success text-white rounded-circle me-3">٢</div>
                            <div>
                                <h6>شارك أو اطلب</h6>
                                <p class="mb-0 text-muted">أضف كتاباً أو اطلب ما تحتاجه</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex">
                            <div class="step-number bg-warning text-white rounded-circle me-3">٣</div>
                            <div>
                                <h6>تواصل وتعاون</h6>
                                <p class="mb-0 text-muted">تواصل مباشر مع المتبرعين والباحثين</p>
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