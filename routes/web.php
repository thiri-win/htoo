<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DatabaseBackupController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RecordExpenseController;
use App\Http\Controllers\RecordSalaryController;
use App\Http\Controllers\VoucherController;
use App\Models\Category;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\Browsershot\Browsershot;

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
    Route::resource('records/expenses', RecordExpenseController::class)->except('index', 'destroy');
    Route::resource('records/vouchers', VoucherController::class);
    Route::resource('records/salary', RecordSalaryController::class)->only('create', 'store');
    Route::get('/backup-database', [DatabaseBackupController::class, 'download'])->name('backup-database');
});

Route::get('/records/vouchers/{record}/print', function (Record $record) {
    return Pdf::view('quotation.show', ['quotation' => $record])
        ->headerView('partials._invoiceheader', ['quotation' => $record])
        ->footerView('partials._footer')
        ->format('A4')
        ->margins(95, 10, 30, 10)
        ->name('invoice.pdf');
})->name('vouchers.print');

Route::get('/prepare/quotation', function () {
    return Inertia::render('prepare/Quotation');
})->name('prepare-quotation');

Route::get('/pdf/quotation', function (Request $request) {

    $quotationData = $request->all();

    // 1. Blade view တွေကို HTML string အဖြစ် ပြောင်းလဲခြင်း
    $html = view('quotation.show', ['quotation' => $quotationData])->render();
    $headerHtml = view('partials._quotationheader', ['quotation' => $quotationData])->render();
    $footerHtml = view('partials._footer')->render();

    // 2. Browsershot ကို တိုက်ရိုက်အသုံးပြုပြီး PDF ထုတ်ခြင်း
    $pdfData = Browsershot::html($html)
        // PATH ကို override လုပ်ပြီး လမ်းကြောင်းအမှန်ကို ထည့်သွင်းပေးခြင်း
        ->setIncludePath('$PATH:/var/www/.nvm/versions/node/22/bin')
        ->noSandbox() // Server environment များအတွက် မဖြစ်မနေလိုအပ်သည်
        ->headerHtml($headerHtml)
        ->footerHtml($footerHtml)
        ->format('A4')
        ->margins(95, 10, 30, 10, 'mm') // margin unit ကို mm လို့ သတ်မှတ်ပေးခြင်း
        ->scale(0.8)
        ->pdf();

    // 3. PDF ကို browser မှာ download လုပ်ရန်အတွက် Response ပြန်ပေးခြင်း
    return response($pdfData)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="quotation.pdf"');
})->name('pdf-quotation');

Route::get('/find-node', function () {
    $path = shell_exec('which node');
    if ($path) {
        return "<br>Node.js executable found at: <pre>" . trim($path) . "</pre> Please use this path.";
    }

    return "Could not find Node.js executable using 'which node'. You may need to contact laravel.cloud support to get the correct path.";
});
