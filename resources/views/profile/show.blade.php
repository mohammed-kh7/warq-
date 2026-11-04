@extends('layouts.app')

@section('title', 'الملف الشخصي — ' . config('app.name'))

@section('content')
<div class="profile-page-wrap position-relative">
    <!-- Ambient Glows & Grid -->
    <div class="glow glow--one" aria-hidden="true"></div>
    <div class="glow glow--two" aria-hidden="true"></div>
    <div class="grid-bg" aria-hidden="true"></div>

    <div class="container-ofuq position-relative py-5" style="z-index: 5;">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-5 pb-3 border-bottom" style="border-color: var(--border) !important;">
            <div>
                <div class="platform-pill mb-2">
                    <i class="fas fa-id-card text-lavender"></i>
                    <span>نظام الحساب الموحد</span>
                </div>
                <h1 class="text-white fw-extrabold m-0" style="font-size: clamp(28px, 3.5vw, 40px);">
                    الملف <span class="gradient-text">الشخصي</span>
                </h1>
                <p class="text-muted small mt-1 mb-0">بيانات حسابك في منظومة أُفُق وصلاحياتك المعتمدة.</p>
            </div>

            <div>
                <a href="{{ route('profile.edit') }}" class="button button--primary">
                    <i class="fas fa-edit"></i>
                    <span>تعديل الملف الشخصي</span>
                </a>
            </div>
        </div>

        @if(session()->has('success'))
            <div class="alert alert-success d-flex align-items-center gap-2 mb-4" style="background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); color: #86efac; border-radius: 14px;">
                <i class="fas fa-check-circle"></i>
                <span>{{ session()->get('success') }}</span>
            </div>
        @endif

        <div class="row g-4 justify-content-center">
            <!-- Aside: Avatar & Basic Info -->
            <div class="col-lg-4">
                <div class="glass-card p-4 text-center h-100" style="border-radius: 24px; border: 1px solid var(--border-hover);">
                    <div class="position-relative d-inline-block my-3">
                        <img
                            src="{{ asset('images/' . (Auth::user()->image ?? 'personalPictur.jpg')) }}"
                            alt="{{ Auth::user()->name }}"
                            class="rounded-circle shadow"
                            style="width: 120px; height: 120px; object-fit: cover; border: 3px solid var(--border-hover); box-shadow: 0 0 25px rgba(98, 70, 217, 0.35) !important;"
                        >
                        <span class="position-absolute bottom-0 end-0 p-2 bg-success border border-dark rounded-circle" title="حساب نشط"></span>
                    </div>

                    <h3 class="text-white fw-bold mb-1 fs-5">{{ Auth::user()->name }}</h3>
                    <p class="text-muted small mb-3">{{ Auth::user()->email }}</p>

                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <span class="badge" style="background: rgba(98, 70, 217, 0.25); color: var(--lavender); border: 1px solid var(--border-hover); padding: 6px 12px; font-size: 11px;">
                            <i class="fas fa-user-check me-1"></i> حساب موحد نشط
                        </span>
                        @if(Auth::user()->is_admin)
                            <span class="badge bg-danger" style="padding: 6px 12px; font-size: 11px;">
                                <i class="fas fa-crown me-1"></i> مسؤول المنصة
                            </span>
                        @endif
                    </div>

                    <div class="pt-3 border-top" style="border-color: var(--border) !important;">
                        <a href="{{ route('user.myProducts') }}" class="button button--secondary w-100 justify-content-center mb-2">
                            <i class="fas fa-book-reader"></i>
                            <span>مكتبتي ومشاركاتي</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile Details Grid -->
            <div class="col-lg-8">
                <div class="glass-card p-4 p-md-5" style="border-radius: 24px; border: 1px solid var(--border-hover);">
                    <h4 class="text-white fw-bold mb-4 fs-5">
                        <i class="fas fa-shield-alt text-lavender me-2"></i> البيانات الشخصية وإعدادات الحساب
                    </h4>

                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="p-3 rounded-4" style="background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border);">
                                <small class="text-muted d-block mb-1">
                                    <i class="fas fa-user text-lavender me-1"></i> الاسم الكامل
                                </small>
                                <strong class="text-white fs-6">{{ Auth::user()->name }}</strong>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 rounded-4" style="background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border);">
                                <small class="text-muted d-block mb-1">
                                    <i class="fas fa-envelope text-lavender me-1"></i> البريد الإلكتروني
                                </small>
                                <strong class="text-white fs-6">{{ Auth::user()->email }}</strong>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 rounded-4" style="background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border);">
                                <small class="text-muted d-block mb-1">
                                    <i class="fas fa-phone-alt text-lavender me-1"></i> رقم الجوال للتواصل
                                </small>
                                <strong class="text-white fs-6" dir="ltr">{{ Auth::user()->phone ?? 'لم يُحدد بعد' }}</strong>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 rounded-4" style="background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border);">
                                <small class="text-muted d-block mb-1">
                                    <i class="fas fa-map-marker-alt text-lavender me-1"></i> المدينة / الموقع
                                </small>
                                <strong class="text-white fs-6">{{ Auth::user()->location ?? 'لم يُحدد بعد' }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top d-flex flex-wrap justify-content-between align-items-center gap-3" style="border-color: var(--border) !important;">
                        <span class="text-muted small">
                            <i class="fas fa-lock me-1"></i> كلمة المرور محمية ومشفرة وفق أعلى معايير الأمان.
                        </span>
                        <a href="{{ route('profile.edit') }}" class="button button--secondary">
                            <i class="fas fa-key"></i>
                            <span>تغيير كلمة المرور أو البيانات</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
