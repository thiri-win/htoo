<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DatabaseBackupController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\VoucherPrintController;
use App\Models\Record;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

// Route::get('/', function(){ return 'hello'; });

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard', [
        'records' => Record::with('category')->get(),
        'vouchers' => Voucher::all(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::resource('vouchers', VoucherController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('records', RecordController::class);
    Route::get('/backup-database', [DatabaseBackupController::class, 'download'])->name('backup-database');
});

Route::get('/vouchers/{voucher}/print', [VoucherPrintController::class, 'print'])->name('vouchers.print');
