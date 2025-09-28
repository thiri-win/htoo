<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DatabaseBackupController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\VoucherPrintController;
use App\Models\Category;
use App\Models\Record;
use App\Models\Voucher;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// Route::get('/', function(){ return 'hello'; });

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {

    $now = now();
    $startOfMonth = $now->copy()->startOfMonth();
    $endOfMonth = $now->copy()->endOfMonth();

    $categorySums = Category::withSum(['records' => function ($query) use ($startOfMonth, $endOfMonth) {
        $query->whereBetween('date', [$startOfMonth->toDateString(), $endOfMonth->toDateString()]);
    }], 'amount')->get();

    return 'hello';

    // $startOfThisYear = now()->startOfYear();
    // $endOfThisYear   = now()->endOfYear();

    // // Step 1: Get all categories and add "Voucher" as a virtual category
    // $categories = DB::table('categories')->pluck('title')->push('Voucher')->toArray();

    // // Step 2: Get sums from records, grouped by category and month
    // // $recordsData = DB::table('categories')
    // //     ->join('records', 'categories.id', '=', 'records.category_id')
    // //     ->select(
    // //         'categories.title',
    // //         DB::raw("strftime('%m', records.date) as month_num"),
    // //         DB::raw('SUM(records.amount) as sum')
    // //     )
    // //     ->whereBetween('records.date', [$startOfThisYear, $endOfThisYear])
    // //     ->groupBy('categories.title', DB::raw("strftime('%m', records.date)"))
    // //     ->get();

    // // Step 2b: Get sums from vouchers, grouped by month
    // $vouchersData = DB::table('vouchers')
    //     ->select(
    //         DB::raw("'Voucher' as title"),
    //         DB::raw("strftime('%m', date) as month_num"),
    //         DB::raw('SUM(total) as sum')
    //     )
    //     ->whereBetween('date', [$startOfThisYear, $endOfThisYear])
    //     ->groupBy(DB::raw("strftime('%m', date)"))
    //     ->get();

    // // Step 2c: Merge both data collections
    // // $data = $recordsData->merge($vouchersData);

    // // Step 3: Prepare all months
    // $months = collect(range(1, 12))->map(function ($m) {
    //     return Carbon::create()->month($m)->format('F');
    // });

    // // Step 4: Build final result, ensuring all categories (including Voucher) are present for each month
    // $categorySumsThisYear = [
    //     $startOfThisYear->year => $months->mapWithKeys(function ($monthName) use ($categories, $data) {
    //         $monthNum = Carbon::parse($monthName)->format('m');
    //         $cats = collect($categories)->map(function ($cat) use ($data, $monthNum) {
    //             $found = $data->first(function ($row) use ($cat, $monthNum) {
    //                 return $row->title === $cat && $row->month_num === $monthNum;
    //             });
    //             return [
    //                 'title' => $cat,
    //                 'sum'   => $found ? (float) $found->sum : 0
    //             ];
    //         })->toArray();
    //         return [$monthName => $cats];
    //     })->toArray()
    // ];

    // return Inertia::render('Dashboard', [
    //     'records' => Record::with('category')->get(),
    //     'vouchers' => Voucher::all(),
    //     'categorySums' => $categorySums,
    //     'categorySumsThisYear' => $categorySumsThisYear,
    // ]);
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
