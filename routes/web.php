<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\searchProductController;
use App\Http\Controllers\EmergencyRequestsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ترحيل للزائر (هيرو فقط) + الصفحة الكاملة بعد تسجيل الدخول
Route::get('/', [PagesController::class, 'index'])->name('landing');
Route::get('/homePage', [PagesController::class, 'homepage'])->name('homePage');
Route::get('/searchProducts', [searchProductController::class, 'index'])->name('searchProducts.index');

// تسجيل الدخول والتسجيل
Auth::routes();
Route::get('/home', [HomeController::class, 'index']);

// الصفحات الخاصة باليوزر المسجّل فقط
Route::middleware('auth')->group(function () {

    // المنتجات - إضافة، تعديل، حذف فقط للمسجلين

    Route::resource('/products', ProductsController::class);
    Route::get('/user/myProducts', [ProductsController::class, 'showUserData'])->name('user.myProducts');

    // الطلبات الطارئة - إضافة، تعديل، حذف فقط للمسجلين

    Route::resource('/emergancyRequest', EmergencyRequestsController::class);
    Route::get('/emergency/create', [EmergencyRequestsController::class, 'create'])->name('emergency.create');
    Route::post('/emergency', [EmergencyRequestsController::class, 'store'])->name('emergency.store');

    // الإشعارات
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');
    Route::get('/notification/{notificationId}/view', [NotificationController::class, 'showAndMarkAsRead'])->name('notification.view');
    Route::delete('/notification/{id}', [NotificationController::class, 'destroy'])->name('notification.destroy');
    Route::delete('/notifications/clear', [NotificationController::class, 'clear'])->name('notifications.clear');

    // البروفايل
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
});
