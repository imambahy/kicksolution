<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubTreatmentController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\TreatmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function() {
    Route::post('admin', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::group([
    'middleware' => 'api'
], function(){
    Route::resources([
        'treatments' => TreatmentController::class,
        'subtreatments' => SubTreatmentController::class,
        'shoes' => ShoeController::class,
        'testimonis' => TestimoniController::class,
        'orders' => OrderController::class,
    ]);

    Route::get('pesanan/baru', [OrderController::class, 'baru']);
    Route::get('pesanan/dikonfirmasi', [OrderController::class, 'dikonfirmasi']);
    Route::get('pesanan/dicuci', [OrderController::class, 'dicuci']);
    Route::get('pesanan/dikirim', [OrderController::class, 'dikirim']);
    Route::get('pesanan/diterima', [OrderController::class, 'diterima']);
    Route::get('pesanan/selesai', [OrderController::class, 'selesai']);

    Route::post('pesanan/ubah_status/{order}', [OrderController::class, 'ubah_status']);

    // Route::get('/reports', [ReportController::class, 'get_reports']);
    
});

