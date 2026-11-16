<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\DaftarServiceController;
use App\Http\Controllers\DataServiceController;
use App\Http\Controllers\PembayaranController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('pelanggan', PelangganController::class);

Route::resource('kendaraan', KendaraanController::class);

Route::resource('daftar-service', DaftarServiceController::class)
    ->parameters([
        'daftar-service' => 'daftarService',
    ]);

Route::resource('data-service', DataServiceController::class)
    ->parameters([
        'data-service' => 'dataService',
    ]);

Route::resource('pembayaran', PembayaranController::class);