@extends('layouts.app')
@section( 'title', 'الاشعارات')

@section('content')
<div class="main-content container_h2">
    <div class="header-message">
        <h2>الإشعارات <i class="fas fa-bell"></i></h2>
        <div class="description text-center">
            <p>اطلع على آخر الإشعارات حول الطلبات والأنشطة الجديدة.</p>
        </div>
    </div>

    <!-- رسالة تنبيه بحذف الطلب -->
    @if(session('error'))
    <div id="notification-alert" class="alert text-center mt-3" role="alert"
        style="background-color: #f8d7da; color: #721c24; border: 1px solid #dc3545; padding: 15px; border-radius: 8px; font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
        <i class="fas fa-exclamation-triangle" style="color: #dc3545; font-size: 1.3rem; margin-right: 8px;"></i>
        عذرًا، الطلب المرتبط بهذا الإشعار قد تم حذفه.
    </div>
    @endif

    @if(session()->has('success'))
    <div class="edit_done">
        <h4>
            {{ session()->get('success') }}
            <i class="fas fa-check-circle"></i>
        </h4>
    </div>
    @endif

    @foreach(auth()->user()->notifications as $notification)
    <!-- إشعارات الطلبات الطارئة -->
    <div class="list-group mt-4">
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">{{ $notification->data['title'] }}</h5>
                <p class="mb-1">{{ $notification->data['description'] }}</p>
                <small class="text-muted">تاريخ الإشعار: 2025-01-25 10:30</small>
            </div>
            <div>
                <a href="{{ route('notification.view', ['notificationId' => $notification->id]) }}" class="btn btn-primary btn-sm me-2">عرض الطلب</a>
                <form action="{{ route('notification.destroy', $notification->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> حذف
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    @if(auth()->user()->notifications->isNotEmpty())
    <!-- زر حذف الكل -->
    <div class="text-center mt-4">
        <form action="{{ route('notifications.clear') }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-lg">
                <i class="fas fa-trash-alt"></i> حذف الكل
            </button>
        </form>
    </div>
    @endif
</div>
@endsection
