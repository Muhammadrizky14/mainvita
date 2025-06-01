<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SpesialisController;
use App\Http\Controllers\YogaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\AccountUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Admin\SpasController;
use App\Http\Controllers\Admin\YogasController;
use App\Http\Controllers\Admin\SpesialisisController;
use App\Http\Controllers\Admin\SpaServicesController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\VouchersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatNotificationController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Arahkan root ke dashboard
Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

// User-facing voucher route
Route::get('/voucher', [VouchersController::class, 'index'])->name('voucher');

// Sisa rute Anda tetap sama
Route::post('/admin/apply-voucher', [VoucherController::class, 'apply'])->name('admin.apply.voucher');

Route::get('/admin/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
Route::patch('/admin/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');

// Fixed Google auth routes - passing 'google' as the provider parameter
Route::get('auth/google', [SocialAuthController::class, 'redirectToProvider'])->name('auth.google')->middleware('guest');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleProviderCallback'])->middleware('guest');

// Cuaca
Route::get('/weather', [WeatherController::class, 'getWeather']);

// Notifikasi
Route::get('/notifications', [NotificationController::class, 'getNotifications']);
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead']);

// Autentikasi
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');

// Autentikasi Media Sosial
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);

// Rute Publik
Route::get('/contact', function () {
    return view('fitur.contact');
})->name('contact');

Route::get('/aboutUs', function () {
    return view('fitur.aboutUs');
})->name('aboutus');

Route::get('/service', function () {
    return view('fitur.service');
})->name('service');

Route::get('/detailEvent', function () {
    return view('fitur.detailEvent');
});

// Rute yang sebelumnya terotentikasi
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// API route to save payment - accessible without admin middleware
Route::post('/api/save-payment', [PaymentController::class, 'savePayment']);

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Check if user is admin in the controller
    // Voucher routes
    Route::get('/vouchers', [VoucherController::class, 'index'])->name('vouchers.index');
    Route::get('/vouchers/create', [VoucherController::class, 'create'])->name('vouchers.create');
    Route::post('/vouchers', [VoucherController::class, 'store'])->name('vouchers.store');
    Route::get('/vouchers/{voucher}', [VoucherController::class, 'show'])->name('vouchers.show');
    Route::get('/vouchers/{voucher}/edit', [VoucherController::class, 'edit'])->name('vouchers.edit');
    Route::put('/vouchers/{voucher}', [VoucherController::class, 'update'])->name('vouchers.update');
    Route::delete('/vouchers/{voucher}', [VoucherController::class, 'destroy'])->name('vouchers.destroy');
    
    // Booking management routes
    // Route::get('/bookings', [BookingsController::class, 'index'])->name('bookings.index');
    // Route::get('/bookings/{id}', [BookingsController::class, 'show'])->name('bookings.show');
    // Route::put('/bookings/{id}/status', [BookingsController::class, 'updateStatus'])->name('bookings.update-status');
    // Route::get('/bookings-export', [BookingsController::class, 'export'])->name('bookings.export');
    
    //account
    Route::get('/account/create', [AdminController::class, 'create'])->name('account.create');
    Route::post('/account', [AdminController::class, 'store'])->name('account.store');
    Route::get('/account/{user}/edit', [AdminController::class, 'edit'])->name('account.edit');
    Route::put('/account/{user}', [AdminController::class, 'update'])->name('account.update');
    Route::delete('/account/{user}', [AdminController::class, 'destroy'])->name('account.destroy');
    
    // Payment routes
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::put('/payments/{kode}/status', [PaymentController::class, 'updateStatus'])->name('payments.updateStatus');
    
    // Spa Services routes
    Route::get('/spas/{spaId}/services', [SpaServicesController::class, 'index'])->name('spas.services.index');
    Route::get('/spas/{spaId}/services/create', [SpaServicesController::class, 'create'])->name('spas.services.create');
    Route::post('/spas/{spaId}/services', [SpaServicesController::class, 'store'])->name('spas.services.store');
    Route::get('/spas/{spaId}/services/{serviceId}/edit', [SpaServicesController::class, 'edit'])->name('spas.services.edit');
    Route::put('/spas/{spaId}/services/{serviceId}', [SpaServicesController::class, 'update'])->name('spas.services.update');
    Route::delete('/spas/{spaId}/services/{serviceId}', [SpaServicesController::class, 'destroy'])->name('spas.services.destroy');
});

// Rute pengguna
Route::get('/spa', [SpaController::class, 'index'])->name('spa.index');
Route::get('/{id_spesialis}/bayar', [SpesialisController::class, 'bayar'])->name('spesialis.bayar');
Route::get('/spesialis', [SpesialisController::class, 'showSpes'])->name('spesialis');
Route::get('/spesialisFilter', [SpesialisController::class, 'spesFilter'])->name('spesialisFilter');
Route::get('/pembayaran', function () {
    return view('fitur.spesBayar');
});
Route::get('/spesialis/{id_spesialis}/whatsapp', [SpesialisController::class, 'getWhatsAppNumber'])->name('spesialis.whatsapp');
Route::get('/yoga', [YogaController::class, 'index'])->name('yoga.index');
Route::get('/event', [EventController::class, 'index'])->name('event.index');
Route::get('/events/search', [EventController::class, 'search'])->name('search.events');

// Rute profil
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::patch('/profile/email', [ProfileController::class, 'updateEmail'])->name('profile.update.email');
Route::post('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.update.image');

// Admin profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'Adminhomepage'])->name('admin.dashboard');
    Route::get('/website-usage-data', [DashboardController::class, 'getWebsiteUsageData']);

    Route::get('/admin/formspa', [SpaController::class, 'create'])->name('admin.formspa');
    Route::post('/admin/spa', [SpaController::class, 'store'])->name('spa.store');

    Route::get('/admin/formyoga', [YogaController::class, 'create'])->name('admin.formyoga');
    Route::post('/admin/yoga', [YogaController::class, 'store'])->name('yoga.store');

    Route::get('/admin/formspesialis', [SpesialisController::class, 'create'])->name('admin.formspesialis');
    Route::post('/admin/spesialis', [SpesialisController::class, 'store'])->name('spesialis.store');

    Route::post('/admin/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('/admin/feedback', [FeedbackController::class, 'index'])->name('admin.feedback');

    Route::get('/admin/accountuser', [AccountUserController::class, 'index'])->name('admin.accountuser');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/event', [EventController::class, 'adminIndex'])->name('event.index');
    Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/event', [EventController::class, 'store'])->name('event.store');
    Route::get('/event/{id_event}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/event/{id_event}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/{id_event}', [EventController::class, 'destroy'])->name('event.destroy');
});

// Admin Spa - UPDATED to show index page first
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Index page is the default landing page
    Route::get('/spas', [SpasController::class, 'index'])->name('spas.index');
    // Create route redirects to existing form
    Route::get('/spas/create', [SpasController::class, 'create'])->name('spas.create');
    // Store route is not used directly, existing route is used instead
    Route::get('/spas/{id_spa}', [SpasController::class, 'show'])->name('spas.show');
    Route::get('/spas/{id_spa}/edit', [SpasController::class, 'edit'])->name('spas.edit');
    Route::put('/spas/{id_spa}', [SpasController::class, 'update'])->name('spas.update');
    Route::delete('/spas/{id_spa}', [SpasController::class, 'destroy'])->name('spas.destroy');
});

// Admin Yoga - UPDATED with complete CRUD routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/yogas', [YogasController::class, 'index'])->name('yogas.index');
    Route::get('/yogas/create', [YogasController::class, 'create'])->name('yogas.create');
    Route::post('/yogas', [YogasController::class, 'store'])->name('yogas.store');
    Route::get('/yogas/{id_yoga}', [YogasController::class, 'show'])->name('yogas.show');
    Route::get('/yogas/{id_yoga}/edit', [YogasController::class, 'edit'])->name('yogas.edit');
    Route::put('/yogas/{id_yoga}', [YogasController::class, 'update'])->name('yogas.update');
    Route::delete('/yogas/{id_yoga}', [YogasController::class, 'destroy'])->name('yogas.destroy');
});


// Admin Spesialis
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/spesialisis', [SpesialisisController::class, 'index'])->name('spesialisis.index');
    Route::get('/spesialisis/{id_spesialis}', [SpesialisisController::class, 'show'])->name('spesialisis.show');
    Route::get('/spesialisis/{id_spesialis}/edit', [SpesialisisController::class, 'edit'])->name('spesialisis.edit');
    Route::put('/spesialisis/{id_spesialis}', [SpesialisisController::class, 'update'])->name('spesialisis.update');
    Route::delete('/spesialisis/{id_spesialis}', [SpesialisisController::class, 'destroy'])->name('spesialisis.destroy');
});

// Replace the chat routes with these corrected versions

// Chat routes for users
Route::middleware(['auth'])->group(function () {
    Route::get('/chat/conversation', [App\Http\Controllers\ChatController::class, 'getOrCreateConversation']);
    Route::post('/chat/send', [App\Http\Controllers\ChatController::class, 'sendMessage']);
});

// Chat routes for admins - without using middleware
Route::prefix('admin')->group(function () {
    // Admin chat view
    Route::get('/chat', function () {
        // Check if user is admin
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access. Admin privileges required.');
        }
        return view('admin.chat.index');
    })->name('admin.chat');

    // Admin chat API routes
    Route::get('/chat/conversations', [App\Http\Controllers\ChatController::class, 'adminGetConversations']);
    Route::get('/chat/conversations/{conversationId}', [App\Http\Controllers\ChatController::class, 'adminGetMessages']);
    Route::post('/chat/conversations/{conversationId}/send', [App\Http\Controllers\ChatController::class, 'adminSendMessage']);
    Route::put('/chat/conversations/{conversationId}/close', [App\Http\Controllers\ChatController::class, 'adminCloseConversation']);
    Route::put('/chat/conversations/{conversationId}/reopen', [App\Http\Controllers\ChatController::class, 'adminReopenConversation']);

    // Chat notifications
    Route::get('/chat/notifications/unread', [App\Http\Controllers\ChatNotificationController::class, 'getUnreadCount']);
});

// Add this test route at the end of your web.php file
Route::get('/chat-test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Chat system is working correctly',
        'timestamp' => now()->toDateTimeString(),
        'php_version' => PHP_VERSION,
        'laravel_version' => app()->version(),
    ]);
});


// Other Routes
Route::get('/spaadmin', function () {
    return view('spaadmin');
});

// Social Login Routes - FIXED to use the provider parameter
Route::get('auth/{provider}', [SocialAuthController::class, 'redirectToProvider'])
    ->name('social.login');
    
Route::get('auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])
    ->name('social.callback');

// Midtrans notification handler
// Route::post('/booking/notification', [BookingController::class, 'handlePaymentNotification'])->name('booking.notification');
// Tambahkan route berikut sebelum require __DIR__ . '/auth.php';
Route::post('/spa/booking', [BookingController::class, 'process'])->name('spa.booking');
Route::get('/booking/payment/{id}', [BookingController::class, 'payment'])->name('booking.payment');
Route::post('/midtrans/callback', [BookingController::class, 'handleMidtransCallback']);
Route::get('/booking/confirmation/{id}', [BookingController::class, 'confirmation']);

Route::post('/change-language', [LanguageController::class, 'changeLanguage']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__ . '/auth.php';