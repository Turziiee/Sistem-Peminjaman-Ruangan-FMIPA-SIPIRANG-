<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\BookingApprovalController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\RoomCatalogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
});

Route::middleware(['auth', 'admin'])
    ->get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('rooms', RoomController::class);
    });

Route::middleware('auth')->group(function () {
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/bookings', [BookingApprovalController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/{booking}', [BookingApprovalController::class, 'show'])->name('bookings.show');
        Route::post('/bookings/{booking}/approve', [BookingApprovalController::class, 'approve'])->name('bookings.approve');
        Route::post('/bookings/{booking}/reject', [BookingApprovalController::class, 'reject'])->name('bookings.reject');
    });

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('admin.activity.index');
});

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('faqs', AdminFaqController::class);
    });

Route::get('/my-bookings', [BookingController::class, 'myBookings'])
    ->middleware('auth')
    ->name('booking.my');

Route::middleware('auth')->group(function () {
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/contact', [AdminContactController::class, 'index'])->name('contact.index');
        Route::get('/contact/{message}', [AdminContactController::class, 'show'])->name('contact.show');
        Route::delete('/contact/{message}', [AdminContactController::class, 'destroy'])->name('contact.destroy');
    });

Route::get('/room-catalog', [RoomCatalogController::class, 'index'])->name('room.catalog.index');

Route::get('/room-catalog/{room}', [RoomCatalogController::class, 'show'])->name('room.catalog.show');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
});
