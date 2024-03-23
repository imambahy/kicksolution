<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\SubTreatmentController;
use App\Http\Controllers\TreatmentController;
use Illuminate\Support\Facades\Route;

// auth
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index']);

// treatment
Route::get('/treatment', [TreatmentController::class, 'list']);
Route::post('/treatment/store', [TreatmentController::class, 'store'])->name('insertTreatment');
Route::get('treatment/edit/{id}', [TreatmentController::class, 'edit']);
Route::post('treatment/update/', [TreatmentController::class, 'update']);

// subtreatment
Route::get('/subtreatment', [SubTreatmentController::class, 'list']);
Route::post('/subtreatment/store', [SubTreatmentController::class, 'store'])->name('insertSubtreatment');
Route::get('subtreatment/edit/{id}', [SubTreatmentController::class, 'edit']);
Route::post('subtreatment/update/', [SubTreatmentController::class, 'update']);

// shoe
Route::get('/shoe', [ShoeController::class, 'list']);
Route::post('/shoe/store', [ShoeController::class, 'store'])->name('insertShoe');
Route::get('/shoe/edit/{id}', [ShoeController::class, 'edit']);
Route::post('/shoe/update/', [ShoeController::class, 'update']);

// pesanan
Route::get('/pesanan/baru', [OrderController::class, 'list'])->name('pesanan_baru');
Route::get('/pesanan/dikonfirmasi', [OrderController::class, 'dikonfirmasi_list']);
Route::get('/pesanan/dicuci', [OrderController::class, 'dicuci_list']);
Route::get('/pesanan/dikirim', [OrderController::class, 'dikirim_list']);
Route::get('/pesanan/diterima', [OrderController::class, 'diterima_list']);
Route::get('/pesanan/selesai', [OrderController::class, 'selesai_list']);

// Home
Route::get('/', [HomeController::class, 'list']);
Route::post('/', [HomeController::class, 'store'])->name('home_regist');
Route::get('/home_member', [HomeController::class, 'index']);

// Route untuk menangani pengiriman formulir pengecekan status pesanan
Route::post('/check-order', [HomeController::class, 'checkOrder'])->name('check.order');
