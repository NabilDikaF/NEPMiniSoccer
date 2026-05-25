<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_post'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register',[AuthController::class, 'register'])->name('register');
Route::get('/forgetpw',[AuthController::class, 'forgetpw'])->name('forgetpw');

Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/verifikasi', [DashboardController::class, 'verifikasi'])->name('admin.verifikasi');
Route::get('/admin/jadwal', [DashboardController::class, 'jadwal'])->name('admin.jadwal');
Route::get('/admin/pelanggan', [DashboardController::class, 'pelanggan'])->name('admin.pelanggan');

Route::get('/booking', [BookingController::class, 'booking'])->name('booking');
Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
Route::get('/mybooking', [BookingController::class, 'mybooking'])->name('mybooking');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');


