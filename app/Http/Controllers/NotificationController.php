<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use App\Models\EmergencyRequest;


class NotificationController extends Controller
{
    public function index()
    {
        $emergancyRequests = EmergencyRequest::all();  // أو استخدم الاستعلام المناسب للحصول على الطلبات

        // الحصول على الإشعارات غير المقروءة للمستخدم
        $notifications = auth()->user()->unreadNotifications;

        return view('notification.index', compact('notifications', 'emergancyRequests'));
    }

    // في NotificationController
    public function showAndMarkAsRead($notificationId)
    {
        // العثور على الإشعار
        $notification = auth()->user()->notifications->find($notificationId);

        if (!$notification) {
            return redirect()->route('notification.index')->with('error', 'الإشعار غير موجود.');
        }

        // تحديث الإشعار إلى مقروء
        $notification->markAsRead();

        // جلب الطلب المرتبط بالإشعار
        $emergencyRequest = EmergencyRequest::find($notification->data['emergency_request_id']);

        // التأكد من أن الطلب ما زال موجودًا
        if (!$emergencyRequest) {
            return redirect()->route('notification.index')->with('error', 'عذرًا، الطلب المرتبط بهذا الإشعار قد تم حذفه.');
        }

        // عرض الطلب
        return view('emergancyRequest.show', compact('emergencyRequest'));
    }

    public function destroy($id)
    {
        // العثور على الإشعار
        $notification = Auth::user()->notifications->find($id);

        // حذف الإشعار
        $notification->delete();

        // إعادة التوجيه بعد الحذف
        return redirect()->route('notification.index')->with('success', 'تم حذف الإشعار بنجاح');
    }

    public function clear()
    {
        $user = Auth::user();

        // التأكد من وجود إشعارات للمستخدم
        if ($user->notifications->count() > 0) {
            // حذف كل إشعار على حدة باستخدام each
            $user->notifications->each->delete();
        }

        return back()->with('success', 'تم حذف جميع الإشعارات بنجاح.');
    }
}
