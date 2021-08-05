<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponsController;
use App\Http\Middleware\UserAuth;

Route::prefix('coupons')->group(function () {
    Route::get('/', [CouponsController::class, 'index'])->name('coupons');
    Route::post('/', [CouponsController::class, 'update'])->name('couponsSave');
    Route::post('/validate', [CouponsController::class, 'validateCoupon'])->name('validateCoupon');
});

