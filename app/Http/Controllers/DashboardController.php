<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Record;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $now = now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        $sixMonthsStart = $now->copy()->subMonths(5)->startOfMonth();

        $categorySums = Category::withSum(['records' => function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('date', [$startOfMonth->toDateString(), $endOfMonth->toDateString()]);
        }], 'grand_total')->get();

        $allRecords = Record::with('category')->get();
        $recordsThisYear = $allRecords->filter(fn ($record) => $record->date->year === $now->year);
        $recordsThisMonth = $allRecords->filter(fn ($record) => $record->date->between($startOfMonth, $endOfMonth));
        $recordsLastSixMonths = $allRecords->filter(fn ($record) => $record->date >= $sixMonthsStart);
        $categoryTitles = Category::pluck('title');

        return Inertia::render('Dashboard', [
            'categorySums' => $categorySums,
            'monthlyProfitThisYear' => $this->monthlyProfitThisYear($recordsThisYear, $now->year),
            'categorySumByMonth' => $this->categorySumByPeriod($recordsThisYear, $categoryTitles, fn ($record) => $record->date->format('n')),
            'categorySumByDay' => $this->categorySumByDay($recordsThisMonth, $categoryTitles, $endOfMonth->day),
            'monthlyBalance' => $this->incomeExpenseSummaryByPeriod($recordsLastSixMonths, fn ($record) => $record->date->format('Y-M')),
            'yearlySummary' => $this->incomeExpenseSummaryByPeriod($allRecords, fn ($record) => $record->date->format('Y'))->sortKeys(),
        ]);
    }

    private function incomeExpenseSummary(Collection $records): array
    {
        $sumTotal = $records
            ->filter(fn ($record) => $record->category?->status === 'sum')
            ->sum('grand_total');

        $subTotal = $records
            ->filter(fn ($record) => $record->category?->status === 'sub')
            ->sum('grand_total');

        return [
            'sum_total' => $sumTotal,
            'sub_total' => $subTotal,
            'diff' => $sumTotal - $subTotal,
        ];
    }

    private function incomeExpenseSummaryByPeriod(Collection $records, callable $groupKey): Collection
    {
        return $records
            ->groupBy($groupKey)
            ->map(fn ($group) => $this->incomeExpenseSummary($group));
    }

    private function monthlyProfitThisYear(Collection $recordsThisYear, int $year): Collection
    {
        $monthlyProfit = $recordsThisYear
            ->groupBy(fn ($record) => $record->date->format('Y-m'))
            ->map(function ($recordsInMonth) {
                return $recordsInMonth->reduce(function ($carry, $record) {
                    if ($record->category?->status === 'sum') {
                        return $carry + $record->grand_total;
                    }

                    return $carry - $record->grand_total;
                }, 0);
            });

        $allMonths = collect(range(1, 12))->mapWithKeys(function ($month) use ($year) {
            $key = $year.'-'.str_pad((string) $month, 2, '0', STR_PAD_LEFT);

            return [$key => 0];
        });

        return $allMonths->merge($monthlyProfit)->sortKeys();
    }

    private function categorySumByPeriod(Collection $records, Collection $categoryTitles, callable $groupKey): Collection
    {
        return $records
            ->groupBy($groupKey)
            ->sortKeys()
            ->map(function ($recordsInPeriod) use ($categoryTitles) {
                $sums = $recordsInPeriod
                    ->groupBy('category.title')
                    ->map(fn ($recordsInCategory) => $recordsInCategory->sum('grand_total'));

                return $categoryTitles
                    ->mapWithKeys(fn ($title) => [$title => 0])
                    ->merge($sums);
            });
    }

    private function categorySumByDay(Collection $recordsThisMonth, Collection $categoryTitles, int $daysInMonth): Collection
    {
        $grouped = $this->categorySumByPeriod(
            $recordsThisMonth,
            $categoryTitles,
            fn ($record) => $record->date->format('j'),
        );

        $zeroCategories = $categoryTitles->mapWithKeys(fn ($title) => [$title => 0]);

        return collect(range(1, $daysInMonth))->mapWithKeys(function ($day) use ($grouped, $zeroCategories) {
            $key = (string) $day;

            return [$key => $grouped->get($key, $zeroCategories)];
        });
    }
}
