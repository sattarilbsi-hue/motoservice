<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PelangganApiController;
use App\Http\Controllers\Api\KendaraanApiController;
use App\Http\Controllers\Api\DaftarServiceApiController;
use App\Http\Controllers\Api\DataServiceApiController;
use App\Http\Controllers\Api\PembayaranApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::apiResource('pelanggan', PelangganApiController::class)
    ->names('api.pelanggan');

Route::apiResource('kendaraan', KendaraanApiController::class)
    ->names('api.kendaraan');

Route::apiResource('daftar-service', DaftarServiceApiController::class)
    ->names('api.daftar-service');

Route::apiResource('data-service', DataServiceApiController::class)
    ->names('api.data-service');

Route::apiResource('pembayaran', PembayaranApiController::class)
    ->names('api.pembayaran');