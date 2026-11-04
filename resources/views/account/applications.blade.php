@extends('layouts.app')

@section('title', 'متابعة طلبات الأدوار — ' . config('app.name'))

@section('content')
<main class="workspace-page">
    <div class="container-ofuq workspace-shell">
        <div class="workspace-heading">
            <div>
                <span class="platform-pill">
                    <i class="fas fa-history text-lavender"></i>
                    <span>سجل الطلبات والقرارات</span>
                </span>
                <h1>متابعة <span class="gradient-text">طلبات الأدوار</span></h1>
                <p>تتبع حالة طلباتك للحصول على دور معلم أو مؤلف وقرارات الإدارة: <strong>{{ Auth::user()->name }}</strong></p>
            </div>
            <a href="{{ route('account.apply') }}" class="button button--primary">
                <i class="fas fa-plus"></i>
                <span>تقديم طلب جديد</span>
            </a>
        </div>

        <div class="workspace-tabs">
            <a href="{{ route('profile.show') }}">الملف الشخصي</a>
            <a href="{{ route('account.roles') }}">أدواري الحالية</a>
            <a href="{{ route('account.applications') }}" class="active">متابعة طلبات الأدوار</a>
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
                <h3 class="text-white fw-bold fs-5 mb-4">سجل الطلبات المقدمة</h3>

                @if($applications->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                        <h4 class="text-white fw-bold mb-2">لا توجد طلبات سابقة</h4>
                        <p class="text-muted small mb-4">لم تقم بتقديم أي طلب للحصول على صلاحيات معلم أو مؤلف بعد.</p>
                        <a href="{{ route('account.apply') }}" class="button button--primary">
                            <span>تقديم طلب الآن</span>
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                @else
                    <div class="workspace-list">
                        @foreach($applications as $app)
                            <article>
                                <span class="workspace-list__icon" style="background: {{ $app->role_requested === 'author' ? 'rgba(36, 117, 233, 0.15)' : 'rgba(98, 70, 217, 0.15)' }}; color: {{ $app->role_requested === 'author' ? 'var(--sky)' : 'var(--lavender)' }};">
                                    <i class="fas {{ $app->role_requested === 'author' ? 'fa-feather-alt' : 'fa-chalkboard-teacher' }}"></i>
                                </span>
                                <div>
                                    <small>تاريخ التقديم: {{ $app->created_at->format('Y-m-d H:i') }}</small>
                                    <h3>طلب اعتماد {{ $app->role_requested === 'author' ? 'مؤلف كتب (وَرَق)' : 'معلم دورات (مَسار)' }}</h3>
                                    <p class="text-muted small mb-1">{{ \Illuminate\Support\Str::limit($app->experience, 90) }}</p>
                                    @if($app->admin_notes)
                                        <div class="p-2 rounded-3 mt-2" style="background: rgba(255, 255, 255, 0.04); font-size: 11px; color: var(--lavender);">
                                            <i class="fas fa-comment-dots me-1"></i> ملاحظة الإدارة: {{ $app->admin_notes }}
                                        </div>
                                    @endif
                                </div>

                                @if($app->status === 'approved')
                                    <span class="status-pill status-pill--success"><i class="fas fa-check-circle me-1"></i> تم القبول</span>
                                @elseif($app->status === 'rejected')
                                    <span class="status-pill status-pill--urgent"><i class="fas fa-times-circle me-1"></i> مرفوض</span>
                                @else
                                    <span class="status-pill status-pill--pending"><i class="fas fa-clock me-1"></i> قيد المراجعة</span>
                                @endif

                                <div></div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="workspace-summary">
                <small class="text-muted">إجمالي الطلبات</small>
                <strong>{{ $applications->count() }}</strong>
                <p>طلبات اعتماد مقدمة للإشراف والإدارة.</p>

                <div><span>قيد المراجعة:</span> <b>{{ $applications->where('status', 'pending')->count() }}</b></div>
                <div><span>المقبولة:</span> <b class="text-success">{{ $applications->where('status', 'approved')->count() }}</b></div>
                <div><span>المرفوضة:</span> <b class="text-danger">{{ $applications->where('status', 'rejected')->count() }}</b></div>
            </div>
        </div>
    </div>
</main>
@endsection
