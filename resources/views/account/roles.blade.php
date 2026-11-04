@extends('layouts.app')

@section('title', 'أدواري وصلاحياتي — ' . config('app.name'))

@section('content')
<main class="workspace-page">
    <div class="container-ofuq workspace-shell">
        <div class="workspace-heading">
            <div>
                <span class="platform-pill">
                    <i class="fas fa-id-card text-lavender"></i>
                    <span>نظام الحساب الموحد</span>
                </span>
                <h1>أدواري <span class="gradient-text">وصلاحياتي</span></h1>
                <p>الحساب الموحد يتيح لك ممارسة عدة أدوار داخل مَسار ووَرَق وصِلة: <strong>{{ Auth::user()->name }}</strong></p>
            </div>
            <a href="{{ route('account.apply') }}" class="button button--primary">
                <i class="fas fa-plus"></i>
                <span>طلب دور جديد (مؤلف / معلم)</span>
            </a>
        </div>

        <!-- Navigation Tabs -->
        <div class="workspace-tabs">
            <a href="{{ route('profile.show') }}">الملف الشخصي</a>
            <a href="{{ route('account.roles') }}" class="active">أدواري الحالية</a>
            <a href="{{ route('account.applications') }}">متابعة طلبات الأدوار</a>
            <a href="{{ route('account.security') }}">الأمان وكلمة المرور</a>
        </div>

        @if(session()->has('success'))
            <div class="workspace-notice">
                <i class="fas fa-check-circle"></i>
                <span>{{ session()->get('success') }}</span>
            </div>
        @endif

        <div class="workspace-grid">
            <div class="workspace-main">
                <h3 class="text-white fw-bold fs-5 mb-4">الأدوار المعتمدة لحسابك في المنظومة</h3>

                <div class="workspace-list">
                    <!-- Student Role (Always Active) -->
                    <article>
                        <span class="workspace-list__icon"><i class="fas fa-graduation-cap"></i></span>
                        <div>
                            <small>مفعل تلقائياً لكافة المستخدمين</small>
                            <h3>دور الطالب / القارئ</h3>
                            <p class="text-muted small mb-0">يمكنك تصفح المكتبة، قراءة الكتب، التبرع، حفظ المفضلة، واستخدام المساعد الذكي.</p>
                        </div>
                        <span class="status-pill status-pill--success"><i class="fas fa-check me-1"></i> معتمد ونشط</span>
                        <a href="{{ route('searchProducts.index') }}" class="button button--ghost text-lavender btn-sm">استكشف</a>
                    </article>

                    <!-- Author Role -->
                    <article>
                        <span class="workspace-list__icon" style="background: rgba(36, 117, 233, 0.15); color: var(--sky);"><i class="fas fa-feather-alt"></i></span>
                        <div>
                            <small>منصة أُفُق وَرَق</small>
                            <h3>دور المؤلف وناشر الكتب</h3>
                            <p class="text-muted small mb-0">نشر كتب رقمية ومذكرات دراسية، متابعة حقوق النشر، وإحصائيات القراء والتحميلات.</p>
                        </div>
                        @if(Auth::user()->is_author)
                            <span class="status-pill status-pill--success"><i class="fas fa-check me-1"></i> مؤلف معتمد</span>
                            <a href="{{ route('author.workspace') }}" class="button button--primary btn-sm">لوحة المؤلف</a>
                        @else
                            <span class="status-pill"><i class="fas fa-clock me-1"></i> غير مفعل</span>
                            <a href="{{ route('account.apply') }}" class="button button--secondary btn-sm">تقديم طلب</a>
                        @endif
                    </article>

                    <!-- Teacher Role -->
                    <article>
                        <span class="workspace-list__icon" style="background: rgba(98, 70, 217, 0.15); color: var(--lavender);"><i class="fas fa-chalkboard-teacher"></i></span>
                        <div>
                            <small>منصة أُفُق مَسار</small>
                            <h3>دور المعلم والمدرّب</h3>
                            <p class="text-muted small mb-0">إنشاء مسارات تعليمية، رفع الدروس التفاعلية، وإدارة الطلاب والتقييمات في مَسار.</p>
                        </div>
                        @if(Auth::user()->is_teacher)
                            <span class="status-pill status-pill--success"><i class="fas fa-check me-1"></i> معلم معتمد</span>
                            <a href="http://localhost:3000/masar/instructor" class="button button--primary btn-sm">لوحة المعلم</a>
                        @else
                            <span class="status-pill"><i class="fas fa-clock me-1"></i> غير مفعل</span>
                            <a href="{{ route('account.apply') }}" class="button button--secondary btn-sm">تقديم طلب</a>
                        @endif
                    </article>

                    <!-- Moderator / Admin Role -->
                    @if(Auth::user()->is_admin || Auth::user()->is_moderator)
                    <article>
                        <span class="workspace-list__icon" style="background: rgba(239, 68, 68, 0.15); color: #f87171;"><i class="fas fa-shield-alt"></i></span>
                        <div>
                            <small>الإدارة والرقابة</small>
                            <h3>دور المشرف / مسؤول المنظومة</h3>
                            <p class="text-muted small mb-0">مراجعة المحتوى والكتب، البلاغات، والموافقة على طلبات المعلمين والمؤلفين.</p>
                        </div>
                        <span class="status-pill status-pill--urgent"><i class="fas fa-crown me-1"></i> صلاحيات إدارية</span>
                        <a href="{{ route('admin.workspace') }}" class="button button--secondary btn-sm">لوحة الإدارة</a>
                    </article>
                    @endif
                </div>
            </div>

            <div class="workspace-summary">
                <small class="text-muted">حالة الحساب الموحد</small>
                <strong>{{ (Auth::user()->is_author ? 1 : 0) + (Auth::user()->is_teacher ? 1 : 0) + 1 }}</strong>
                <p>أدوار نشطة ومعتمدة في منظومة أُفُق المعرفية.</p>

                <div><span>معرف الحساب:</span> <b>#{{ Auth::id() }}</b></div>
                <div><span>البريد الإلكتروني:</span> <b>{{ Auth::user()->email }}</b></div>
                <div><span>تاريخ الانضمام:</span> <b>{{ Auth::user()->created_at->format('Y-m-d') }}</b></div>

                <a href="{{ route('account.applications') }}" class="button button--secondary mt-4 w-100 justify-content-center">
                    <span>متابعة حالة الطلبات</span>
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
</main>
@endsection
