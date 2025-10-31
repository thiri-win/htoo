<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DatabaseBackupController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\VoucherPrintController;
use App\Models\Category;
use App\Models\Record;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {

    $now = now();
    $startOfMonth = $now->copy()->startOfMonth();
    $endOfMonth = $now->copy()->endOfMonth();

    $categorySums = Category::withSum(['records' => function ($query) use ($startOfMonth, $endOfMonth) {
        $query->whereBetween('date', [$startOfMonth->toDateString(), $endOfMonth->toDateString()]);
    }], 'grand_total')->get();

    $monthlyProfitThisYear = Record::with('category')->whereYear('date', now()->year)
        ->get()
        ->groupBy(function ($record) {
            return $record->date->format('Y-m');
        })
        ->map(function ($recordsInMonth) {
            return $recordsInMonth->reduce(function ($carry, $record) {
                if ($record->category && $record->category->status == 'sum') {
                    return $carry + $record->grand_total;
                }
                return $carry - $record->grand_total;
            }, 0);
        });

    $allMonths = collect(range(1, 12))->mapWithKeys(function ($month) {
        $key = now()->year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
        return [$key => 0];
    });

    $monthlyProfitThisYear = $allMonths->merge($monthlyProfitThisYear)->sortKeys();

    $categoryTitle = Category::pluck('title');

    $categorySumByMonth = Record::with('category')->whereYear('date', now()->year)
        ->get()
        ->groupBy(function ($record) {
            return $record->date->format('n');
        })
        ->sortKeys()
        ->map(function ($recordsInMonth) use ($categoryTitle) {
            $sumsForThisMonth = $recordsInMonth
                ->groupBy('category.title')
                ->map(function ($recordsInCategory) {
                    return $recordsInCategory->sum('grand_total');
                });

            $allCategoriesWithZero = $categoryTitle->mapWithKeys(fn($title) => [$title => 0]);

            return $allCategoriesWithZero->merge($sumsForThisMonth);
        });

    return Inertia::render('Dashboard', [
        'categorySums' => $categorySums,
        'monthlyProfitThisYear' => $monthlyProfitThisYear,
        'categorySumByMonth' => $categorySumByMonth,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('records', RecordController::class);
    Route::resource('records/vouchers', VoucherController::class);
    Route::get('/salary-calculate', function() {
        return Inertia::render('SalaryCalculate');
    });
    Route::get('/backup-database', [DatabaseBackupController::class, 'download'])->name('backup-database');
});

Route::get('/vouchers/{voucher}/print', [VoucherPrintController::class, 'print'])->name('vouchers.print');
