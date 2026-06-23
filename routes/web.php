<?php

use Illuminate\Support\Facades\Route;

// Import semua Controller yang digunakan
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;

// 1. PUBLIC ROUTES (Bisa diakses siapa saja)
Route::get('/', [HomeController::class, 'home'])->name('home');


// 2. GUEST ROUTES (Hanya untuk yang BELUM LOGIN)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login_post'])->name('login.post');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'register_post'])->name('register.post');
    Route::get('/forgetpw', [AuthController::class, 'forgetpw'])->name('forgetpw');

    // Rute OTP Register
    Route::post('/register/send-otp', [OtpController::class, 'sendOtp'])->middleware('throttle:3,1')->name('register.sendOtp');
    Route::post('/register/verify-otp', [OtpController::class, 'verifyOtp'])->middleware('throttle:5,1')->name('register.verifyOtp');

    // Rute OTP Lupa Password
    Route::post('/forgetpw/send-otp', [OtpController::class, 'sendResetOtp'])->middleware('throttle:3,1')->name('forgetpw.sendOtp');
    Route::post('/forgetpw/verify-otp', [OtpController::class, 'verifyResetOtp'])->middleware('throttle:5,1')->name('forgetpw.verifyOtp');
    Route::post('/forgetpw/reset', [OtpController::class, 'resetPassword'])->name('forgetpw.reset');
});


// 3. AUTH ROUTES (Untuk Pelanggan & Admin yang SUDAH LOGIN)
Route::middleware('auth')->group(function () {
    // Logout Auth
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profile
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');

    // Transaksi Booking
    Route::get('/booking', [BookingController::class, 'booking'])->name('booking');
    Route::post('/booking', [BookingController::class, 'store_booking'])->name('booking.store');
    Route::get('/mybooking', [BookingController::class, 'mybooking'])->name('mybooking');
    Route::post('/mybooking/{id_booking}/cancel', [BookingController::class, 'cancelBooking'])->name('booking.cancel');
    Route::post('/mybooking/{id_booking}/reschedule', [BookingController::class, 'rescheduleBooking'])->name('booking.reschedule');
    Route::post('/cancel-reschedule', [BookingController::class, 'cancelRescheduleSession'])->name('cancel.reschedule.session');

    // Pembayaran
    Route::get('/payment/{id_booking}', [PaymentController::class, 'payment'])->name('payment.page');
    Route::post('/payment/{id_booking}', [PaymentController::class, 'storePayment'])->name('payment.store');
});

// 4. ADMIN ROUTES (Hanya untuk role ADMIN)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // Dashboard & Notifikasi
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/notifications/{id}/mark-read', [DashboardController::class, 'markNotificationRead'])->name('admin.notifications.mark-read');

    // Data Pelanggan
    Route::get('/pelanggan', [UserController::class, 'index'])->name('admin.pelanggan');
    Route::get('/pelanggan/{id}/detail', [UserController::class, 'detail'])->name('admin.pelanggan.detail');
    Route::put('/pelanggan/{id}/update', [UserController::class, 'update'])->name('admin.pelanggan.update');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'laporan'])->name('admin.laporan');
    Route::get('/laporan/cetak-perbandingan', [LaporanController::class, 'cetakPerbandingan'])->name('admin.laporan.cetak-perbandingan');
    Route::get('/laporan/data-pendapatan', [LaporanController::class, 'getPendapatanData'])->name('admin.laporan.data-pendapatan');
    Route::get('/laporan/cetak-pendapatan', [LaporanController::class, 'cetakPendapatan'])->name('admin.laporan.cetak-pendapatan');

    // Kelola Jadwal Lapangan
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/generate', [JadwalController::class, 'create'])->name('jadwal.generate');
    Route::post('/jadwal/generate', [JadwalController::class, 'storeGenerate'])->name('jadwal.storeGenerate');
    Route::get('/jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

    // Kelola Harga Dasar & Ketersediaan
    Route::get('/harga', [HargaController::class, 'index'])->name('harga.index');
    Route::post('/harga/mass-update', [HargaController::class, 'updatePengaturanMassal'])->name('harga.massUpdate');
    Route::post('/harga', [HargaController::class, 'store'])->name('harga.store');
    Route::delete('/harga/{id}', [HargaController::class, 'destroy'])->name('harga.destroy');

    // Verifikasi Pembayaran
    Route::get('/verifikasi', [PaymentController::class, 'indexAdmin'])->name('admin.verifikasi');
    Route::post('/verifikasi/{id_pembayaran}/verify', [PaymentController::class, 'verify'])->name('admin.payment.verify');
    Route::post('/verifikasi/{id_pembayaran}/expired-action', [PaymentController::class, 'expiredAction'])->name('admin.payment.expired-action');
});