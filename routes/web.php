<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RecordExpenseController;
use App\Http\Controllers\RecordSalaryController;
use App\Http\Controllers\RecordVoucherController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\DashboardController;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\LaravelPdf\Facades\Pdf;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    Route::resource('categories', CategoryController::class);

    Route::resource('records', RecordController::class);
    Route::resource('records/expenses', RecordExpenseController::class)->except('index', 'destroy');
    Route::resource('records/vouchers', RecordVoucherController::class)->except('index', 'destroy');
    Route::resource('records/salary', RecordSalaryController::class)->only('create', 'store');
    Route::get('/records/vouchers/{record}/print', function (Record $record) {
        return Pdf::view('voucher.show', ['data' => $record])
        ->headerView('partials._invoiceheader', ['data' => $record])
        ->footerView('partials._footer')
        ->format('A4')
        ->margins(97, 10, 10, 10)
        ->name('invoice.pdf');
    })->name('vouchers.print');

    Route::resource('cars', CarController::class);

    Route::resource('quotations', QuotationController::class);
    Route::get('quotations/{quotation}/print-to-pdf', [QuotationController::class, 'print'])->name('quotations.print');

});

Route::get('/prepare/note', function () {
    return Inertia::render('prepare/Note');
})->name('prepare-note');

Route::post('/pdf/note', function (Request $request) {
    $htmlContent = $request->input('content');
    return Pdf::view('note.show', ['data' => $htmlContent])
        ->headerView('partials._noteheader')
        ->footerView('partials._footer')
        ->format('A4')
        ->margins(60, 10, 10, 10)
        ->name('note.pdf');
})->name('pdf-note');

Route::get("/backup-database", function () {
    $dbName = config('database.connections.mysql.database');
    $username = config('database.connections.mysql.username');
    $password = config('database.connections.mysql.password');
    $host = config('database.connections.mysql.host');

    $filename = 'backup-' . date('Y-m-d-His') . '.sql';
    return response()->streamDownload(function () use ($dbName, $username, $password, $host) {
        $command = "mysqldump --user={$username} --password={$password} --host={$host} --single-transaction --quick {$dbName}";
        passthru($command);
    }, $filename);
})->middleware('auth')->name('backup-database');