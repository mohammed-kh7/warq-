@extends('layouts.app')

@section('title', 'تقديم طلب دور معلم أو مؤلف — ' . config('app.name'))

@section('content')
<main class="workspace-page">
    <div class="container-ofuq workspace-shell">
        <div class="workspace-heading">
            <div>
                <span class="platform-pill">
                    <i class="fas fa-user-plus text-lavender"></i>
                    <span>توسيع الصلاحيات</span>
                </span>
                <h1>تقديم طلب <span class="gradient-text">معلم أو مؤلف</span></h1>
                <p>انضم إلى نخبة صانعي المحتوى المعرفي في أُفُق مَسار وأُفُق وَرَق: <strong>{{ Auth::user()->name }}</strong></p>
            </div>
            <a href="{{ route('account.roles') }}" class="button button--secondary">
                <i class="fas fa-arrow-right"></i>
                <span>العودة لأدواري</span>
            </a>
        </div>

        <div class="workspace-tabs">
            <a href="{{ route('profile.show') }}">الملف الشخصي</a>
            <a href="{{ route('account.roles') }}">أدواري الحالية</a>
            <a href="{{ route('account.applications') }}">متابعة طلبات الأدوار</a>
            <a href="{{ route('account.security') }}">الأمان وكلمة المرور</a>
        </div>

        @if(session('error'))
            <div class="alert alert-danger mb-4" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #fca5a5; border-radius: 14px;">
                <i class="fas fa-exclamation-circle me-1"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="glass-form-card">
                    <form action="{{ route('account.apply.store') }}" method="POST">
                        @csrf

                        <!-- Role Choice -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">اختر الدور المطلوب اعتماده</label>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="p-3 rounded-4 d-block" style="border: 1px solid var(--border-hover); background: rgba(36, 117, 233, 0.08); cursor: pointer;">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <input type="radio" name="role_requested" value="author" checked style="accent-color: var(--blue);">
                                            <strong class="text-white"><i class="fas fa-feather-alt text-sky me-1"></i> مؤلف كتب (وَرَق)</strong>
                                        </div>
                                        <small class="text-muted d-block">نشر كتب رقمية ومذكرات وسلايدات جامعية للقراء.</small>
                                    </label>
                                </div>

                                <div class="col-md-6">
                                    <label class="p-3 rounded-4 d-block" style="border: 1px solid var(--border-hover); background: rgba(98, 70, 217, 0.08); cursor: pointer;">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <input type="radio" name="role_requested" value="teacher" style="accent-color: var(--purple);">
                                            <strong class="text-white"><i class="fas fa-chalkboard-teacher text-lavender me-1"></i> معلم دورات (مَسار)</strong>
                                        </div>
                                        <small class="text-muted d-block">إعداد ونشر دورات تدريبية ومسارات تعليمية مصورة.</small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Experience and Qualifications -->
                        <div class="form-group-custom mt-3">
                            <label for="experience" class="form-label-custom">الخبرات السابقة والمؤهلات</label>
                            <div class="input-with-icon-wrap">
                                <i class="fas fa-graduation-cap input-icon-inner" style="top: 18px;"></i>
                                <textarea
                                    name="experience"
                                    id="experience"
                                    class="form-input-custom form-textarea-custom @error('experience') is-invalid @enderror"
                                    rows="4"
                                    placeholder="اكتب نبذة عن تخصصك، مؤهلاتك العلمية، أو مؤلفاتك وأعمالك السابقة..."
                                    required
                                >{{ old('experience') }}</textarea>
                            </div>
                            @error('experience')
                                <div class="error-msg-custom">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bio / Motivation -->
                        <div class="form-group-custom">
                            <label for="bio" class="form-label-custom">رسالة لصناع القرار في المنظومة (اختياري)</label>
                            <div class="input-with-icon-wrap">
                                <i class="fas fa-comment-alt input-icon-inner" style="top: 18px;"></i>
                                <textarea
                                    name="bio"
                                    id="bio"
                                    class="form-input-custom form-textarea-custom"
                                    rows="3"
                                    placeholder="ما الذي تخطط لتقديمه للمجتمع التعليمي في أُفُق؟"
                                >{{ old('bio') }}</textarea>
                            </div>
                        </div>

                        <div class="form-footer-note my-3 text-start">
                            <i class="fas fa-info-circle text-lavender me-1"></i>
                            <span>تتم مراجعة الطلب من قبل المشرفين والإدارة خلال 24 إلى 48 ساعة، ويصلك إشعار فوري بالقرار.</span>
                        </div>

                        <button type="submit" class="button button--primary w-100 justify-content-center mt-3">
                            <i class="fas fa-paper-plane"></i>
                            <span>إرسال الطلب للاعتماد</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
