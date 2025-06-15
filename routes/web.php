<?php

use App\Http\Controllers\VoucherController;
use App\Http\Controllers\VoucherPrintController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::resource('vouchers', VoucherController::class);
});

Route::get('/vouchers/{voucher}/print', [VoucherPrintController::class, 'print'])->name('vouchers.print');
