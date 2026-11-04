@extends('layouts.app')

@section('title', 'مركز الإشعارات — ' . config('app.name'))

@section('content')
<div class="notifications-page-wrap position-relative">
    <!-- Ambient Glows & Grid -->
    <div class="glow glow--one" aria-hidden="true"></div>
    <div class="glow glow--two" aria-hidden="true"></div>
    <div class="grid-bg" aria-hidden="true"></div>

    <div class="container-ofuq position-relative py-5" style="z-index: 5;">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-5 pb-3 border-bottom" style="border-color: var(--border) !important;">
            <div>
                <div class="platform-pill mb-2">
                    <i class="fas fa-bell text-lavender"></i>
                    <span>التنبيهات المباشرة</span>
                </div>
                <h1 class="text-white fw-extrabold m-0" style="font-size: clamp(28px, 3.5vw, 40px);">
                    مركز <span class="gradient-text">الإشعارات</span>
                </h1>
                <p class="text-muted small mt-1 mb-0">تابع كل المستجدات على كتبك، النداءات التي شاركت بها، وردود المجتمع.</p>
            </div>

            @if(auth()->user()->notifications->isNotEmpty())
                <div>
                    <form action="{{ route('notifications.clear') }}" method="POST" onsubmit="return confirm('هل تريد مسح جميع الإشعارات؟');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button button--ghost text-danger">
                            <i class="fas fa-trash-alt"></i>
                            <span>مسح جميع الإشعارات</span>
                        </button>
                    </form>
                </div>
            @endif
        </div>

        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-4" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #fca5a5; border-radius: 14px;">
                <i class="fas fa-exclamation-triangle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if(session()->has('success'))
            <div class="alert alert-success d-flex align-items-center gap-2 mb-4" style="background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); color: #86efac; border-radius: 14px;">
                <i class="fas fa-check-circle"></i>
                <span>{{ session()->get('success') }}</span>
            </div>
        @endif

        @if(auth()->user()->notifications->isEmpty())
            <div class="glass-card text-center py-5 mx-auto" style="max-width: 600px; border-radius: 24px;">
                <i class="fas fa-bell-slash fa-4x text-muted mb-3"></i>
                <h4 class="text-white fw-bold mb-2">لا توجد إشعارات جديدة</h4>
                <p class="text-muted small mb-0">ستصلك تنبيهات فورية عند وجود تفاعل مع كتبك أو نداءاتك العاجلة.</p>
            </div>
        @else
            <div class="d-flex flex-column gap-3">
                @foreach(auth()->user()->notifications as $notification)
                    <div class="glass-card p-4 d-flex flex-wrap justify-content-between align-items-center gap-3" style="border-radius: 18px; border: 1px solid var(--border-hover);">
                        <div class="d-flex align-items-start gap-3">
                            <div class="p-3 rounded-circle mt-1" style="background: rgba(98, 70, 217, 0.2); color: var(--lavender);">
                                <i class="fas fa-bell fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="text-white fw-bold mb-1 fs-6">
                                    {{ $notification->data['title'] ?? 'إشعار جديد' }}
                                </h5>
                                <p class="text-muted small mb-2 lh-base">
                                    {{ $notification->data['description'] ?? '' }}
                                </p>
                                <span class="text-muted" style="font-size: 11px;">
                                    <i class="far fa-clock me-1"></i>
                                    {{ $notification->created_at ? $notification->created_at->diffForHumans() : '' }}
                                </span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('notification.view', ['notificationId' => $notification->id]) }}" class="button button--primary" style="padding: 7px 16px; font-size: 11px;">
                                <span>عرض الطلب</span>
                                <i class="fas fa-arrow-left"></i>
                            </a>

                            <form action="{{ route('notification.destroy', $notification->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button--ghost text-muted p-2" title="حذف هذا الإشعار">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
