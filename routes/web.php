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
use App\Http\Controllers\MyLibraryController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\BookReaderController;
use App\Http\Controllers\EcosystemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ترحيل للزائر (هيرو فقط) + الصفحة الكاملة بعد تسجيل الدخول
Route::get('/', [PagesController::class, 'index'])->name('landing');
Route::get('/homePage', [PagesController::class, 'homepage'])->name('homePage');
Route::get('/searchProducts', [searchProductController::class, 'index'])->name('searchProducts.index');
Route::get('/products/{product}', [ProductsController::class, 'show'])->name('products.show');
Route::get('/read/{slug}', [BookReaderController::class, 'show'])->name('books.read');
Route::get('/emergancyRequest', [EmergencyRequestsController::class, 'index'])->name('emergancyRequest.index');
Route::get('/emergancyRequest/{emergancyRequest}', [EmergencyRequestsController::class, 'show'])->name('emergancyRequest.show');
Route::get('/community', [EcosystemController::class, 'community'])->name('community.index');
Route::get('/requests', [EcosystemController::class, 'contentRequests'])->name('contentRequests.index');

// تسجيل الدخول والتسجيل
Auth::routes();
Route::get('/home', [HomeController::class, 'index']);

// الصفحات الخاصة باليوزر المسجّل فقط
Route::middleware('auth')->group(function () {

    // المنتجات - إضافة، تعديل، حذف فقط للمسجلين
    Route::resource('/products', ProductsController::class)->except(['show']);
    Route::get('/user/myProducts', [ProductsController::class, 'showUserData'])->name('user.myProducts');

    // الطلبات الطارئة - إضافة، تعديل، حذف فقط للمسجلين
    Route::resource('/emergancyRequest', EmergencyRequestsController::class)->except(['index', 'show']);
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

    // مكتبتي
    Route::get('/myLibrary', [MyLibraryController::class, 'index'])->name('myLibrary.index');
    Route::post('/library/{productId}/add', [MyLibraryController::class, 'addToLibrary'])->name('library.add');
    Route::post('/library/{id}/reading', [MyLibraryController::class, 'markAsReading'])->name('library.reading');
    Route::put('/library/{id}/progress', [MyLibraryController::class, 'updateProgress'])->name('library.progress');

    // المفضلات
    Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
    Route::post('/products/{id}/favorite', [FavoritesController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{id}', [FavoritesController::class, 'destroy'])->name('favorites.destroy');

    // قارئ الكتب
    Route::post('/read/{slug}/progress', [BookReaderController::class, 'updateProgress'])->name('books.progress');
    Route::post('/read/{slug}/bookmark', [BookReaderController::class, 'addBookmark'])->name('books.bookmark');

    // أنظمة الحساب الموحد والأدوار (SSO-06..09)
    Route::get('/account/roles', [EcosystemController::class, 'roles'])->name('account.roles');
    Route::get('/account/security', [EcosystemController::class, 'security'])->name('account.security');
    Route::put('/account/security', [EcosystemController::class, 'updateSecurity'])->name('account.security.update');
    Route::get('/account/apply-role', [EcosystemController::class, 'applyRole'])->name('account.apply');
    Route::post('/account/apply-role', [EcosystemController::class, 'storeRoleApplication'])->name('account.apply.store');
    Route::get('/account/applications', [EcosystemController::class, 'applications'])->name('account.applications');

    // مساحات العمل والأدوار
    Route::get('/waraq/author', [EcosystemController::class, 'authorWorkspace'])->name('author.workspace');
    Route::get('/moderation', [EcosystemController::class, 'moderationWorkspace'])->name('moderation.workspace');
    Route::get('/admin/dashboard', [EcosystemController::class, 'adminWorkspace'])->name('admin.workspace');
    Route::post('/admin/applications/{id}/decision', [EcosystemController::class, 'handleApplicationDecision'])->name('admin.application.decision');

    // مجتمع القراء وطلبات المحتوى
    Route::post('/community', [EcosystemController::class, 'storeCommunityPost'])->name('community.store');
    Route::post('/requests', [EcosystemController::class, 'storeContentRequest'])->name('contentRequests.store');
    Route::post('/requests/{id}/vote', [EcosystemController::class, 'voteContentRequest'])->name('contentRequests.vote');
});
