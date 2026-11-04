@extends('layouts.app')

@section('title', 'إعدادات الحساب والأمان — ' . config('app.name'))

@section('content')
<main class="workspace-page">
    <div class="container-ofuq workspace-shell">
        <div class="workspace-heading">
            <div>
                <span class="platform-pill">
                    <i class="fas fa-shield-alt text-lavender"></i>
                    <span>الأمان والجلسات الموحدة</span>
                </span>
                <h1>إعدادات <span class="gradient-text">الحساب والأمان</span></h1>
                <p>إدارة كلمة المرور وحماية حسابك عبر جميع منصات المنظومة: <strong>{{ Auth::user()->name }}</strong></p>
            </div>
            <a href="{{ route('profile.show') }}" class="button button--secondary">
                <i class="fas fa-user-circle"></i>
                <span>الملف الشخصي</span>
            </a>
        </div>

        <div class="workspace-tabs">
            <a href="{{ route('profile.show') }}">الملف الشخصي</a>
            <a href="{{ route('account.roles') }}">أدواري الحالية</a>
            <a href="{{ route('account.applications') }}">متابعة طلبات الأدوار</a>
            <a href="{{ route('account.security') }}" class="active">الأمان وكلمة المرور</a>
        </div>

        @if(session()->has('success'))
            <div class="workspace-notice">
                <i class="fas fa-check-circle"></i>
                <span>{{ session()->get('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mb-4" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #fca5a5; border-radius: 14px;">
                <i class="fas fa-exclamation-circle me-1"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <div class="workspace-grid">
            <div class="workspace-main">
                <h3 class="text-white fw-bold fs-5 mb-4">
                    <i class="fas fa-key text-lavender me-2"></i> تغيير كلمة المرور
                </h3>

                <form action="{{ route('account.security.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group-custom">
                        <label for="current_password" class="form-label-custom">كلمة المرور الحالية</label>
                        <div class="input-with-icon-wrap">
                            <i class="fas fa-lock input-icon-inner"></i>
                            <input
                                type="password"
                                name="current_password"
                                id="current_password"
                                class="form-input-custom"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label for="new_password" class="form-label-custom">كلمة المرور الجديدة</label>
                                <div class="input-with-icon-wrap">
                                    <i class="fas fa-shield-alt input-icon-inner"></i>
                                    <input
                                        type="password"
                                        name="new_password"
                                        id="new_password"
                                        class="form-input-custom"
                                        placeholder="٨ خانات على الأقل"
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label for="new_password_confirmation" class="form-label-custom">تأكيد كلمة المرور</label>
                                <div class="input-with-icon-wrap">
                                    <i class="fas fa-shield-alt input-icon-inner"></i>
                                    <input
                                        type="password"
                                        name="new_password_confirmation"
                                        id="new_password_confirmation"
                                        class="form-input-custom"
                                        placeholder="تكرار كلمة المرور"
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="button button--primary">
                            <i class="fas fa-save"></i>
                            <span>تحديث كلمة المرور</span>
                        </button>
                    </div>
                </form>

                <hr class="my-5" style="border-color: var(--border);">

                <h3 class="text-white fw-bold fs-5 mb-3">
                    <i class="fas fa-laptop-code text-sky me-2"></i> الجلسات النشطة والحساب الموحد
                </h3>
                <p class="text-muted small mb-4">أنت مسجل الدخول حالياً عبر منصات أُفُق بموجب نظام الجلسة الموحدة (SSO-10).</p>

                <div class="p-3 rounded-4 d-flex justify-content-between align-items-center" style="background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border);">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-desktop fa-2x text-lavender"></i>
                        <div>
                            <strong class="text-white d-block">الجلسة الحالية على هذا المتصفح</strong>
                            <small class="text-muted">عنوان IP: {{ request()->ip() }} — نشط الآن</small>
                        </div>
                    </div>
                    <span class="status-pill status-pill--success">الجلسة الرئيسية</span>
                </div>
            </div>

            <div class="workspace-summary">
                <small class="text-muted">مستوى أمان الحساب</small>
                <strong class="text-success">ممتاز</strong>
                <p>الحساب محمي بكلمة مرور مشفرة ونظام تحقق متكامل.</p>

                <div><span>حالة البريد:</span> <b class="text-success">موثق ومؤكد</b></div>
                <div><span>الجلسة الموحدة:</span> <b>صامتة ومستمرة</b></div>
                <div><span>نوع التشفير:</span> <b>Bcrypt Hash</b></div>
            </div>
        </div>
    </div>
</main>
@endsection
