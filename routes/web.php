<?php

use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPageController;
use App\Http\Middleware\MustAdmin;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Mail\VerifyMail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;











// Route::middleware(['auth',MustAdmin::class])->group(function () {
//     Route::get('/', function () {
//         return view('adminpage.dashboard');
//     });

// });
Route::get('/news', [NewsController::class, 'userIndex'])->name('news.user.index');
Route::get('/', [UserPageController::class, 'dashboard'])->name('dashboard.page');

Route::get('/orders/create/{service}', [OrderController::class, 'create'])->name('user.orders.create');
Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        return view('userpage.home');
    });

});

Route::post('/logout', [AuthContoller::class, 'logout'])->name('logout');
Route::middleware('guest')->group(function () {
    // Authentication Routes...
    Route::get('/login', [AuthContoller::class, 'loginPage'])->name('login.page');
    Route::get('/register', [AuthContoller::class, 'registerPage'])->name('register.page');
    Route::post('/register', [AuthContoller::class, 'register'])->name('register');
    Route::post('/login', [AuthContoller::class, 'login'])->name('login');
    // end authentication

    // Password Reset Routes...
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
    Route::post('/forgot-password', [AuthContoller::class, 'forgotpassword'])->middleware('guest')->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->middleware('guest')->name('password.reset');
    Route::post('/reset-password', [AuthContoller::class, 'resetpassword'])->middleware('guest')->name('password.update');
    // end password reset
});

// Email Verification Routes...
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// end email verification

//Admin Routes
Route::middleware(['auth', MustAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('adminpage.dashboard');
    })->name('admin.dashboard');
    Route::resource('news', NewsController::class);
    Route::resource('portofolios', PortofolioController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('users', UserController::class);
    Route::resource('orders', OrderController::class);
    Route::put('admin/orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::resource('portofolios', PortofolioController::class);
    Route::resource('teams', TeamController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('pelamars', PelamarController::class);
    Route::resource('lowongans', LowonganController::class);
    Route::resource('documents', DocumentController::class);
     Route::get('/profile', [UserPageController::class, 'adminProfile'])->name('profile');
    Route::put('/profile', [UserPageController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/photo', [UserPageController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::put('/profile/password', [UserPageController::class, 'updatePassword'])->name('profile.updatePassword');
});
// end admin routes

//user routes
Route::middleware('auth')->group(function () {
    Route::post('/orders', [OrderController::class, 'store'])->name('user.orders.store');

    Route::put('/profile/photo', [UserPageController::class, 'updatePhoto'])->name('user.profile.updatePhoto');
    Route::get('/profile', [UserPageController::class, 'profile'])->name('user.profile');
    Route::get('/pelamar/create/{lowongan}', [PelamarController::class, 'create'])->name('user.pelamars.create');
    Route::post('/pelamar/store', [PelamarController::class, 'store'])->name('user.pelamars.store');
     Route::post('/logout', [AuthContoller::class, 'logout'])->name('logout');
});
