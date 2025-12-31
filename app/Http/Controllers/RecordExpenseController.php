<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Models\Record;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecordExpenseController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('recordexpense/Create', [
            'cars' => Car::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'sometimes',
            // cars
            'car_id' => 'sometimes',
            // record
            'date' => 'required',
            'sub_total' => 'required',
            'discount' => 'required',
            'advance' => 'required',
            'grand_total' => 'required',
            'remark' => 'sometimes',
            // record items
            'items' => 'required|array',
            'items.*.description' => 'required',
            'items.*.quantity' => 'required',
            'items.*.unit_price' => 'required',
            'items.*.total' => 'required',
        ]);
        $validated['category_id'] = 2;

        $record = Record::create($validated);

        $record->items()->createMany($validated['items']);

        return redirect()->route('records.index')->with('success', 'Record Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $expense)
    {
        if ($expense->items()->exists()) {
            return Inertia::render('recordexpense/Edit', [
                'expense' => $expense->load(['items', 'car']),
                'cars' => Car::all(),
            ]);
        }
        return Inertia::render('record/Create', [
            'categories' => Category::all(),
            'record' => $expense->load('items', 'category')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $expense)
    {
        $validated = $request->validate([
            'description' => 'sometimes',
            // car
            'car_id' => 'sometimes',
            // record
            'date' => 'required',
            'sub_total' => 'required',
            'discount' => 'required',
            'advance' => 'required',
            'grand_total' => 'required',
            'remark' => 'sometimes',
            // record items
            'items' => 'required|array',
            'items.*.id' => 'sometimes',
            'items.*.description' => 'required',
            'items.*.quantity' => 'required',
            'items.*.unit_price' => 'required',
            'items.*.total' => 'required',
        ]);

        $itemsData = $validated['items'];

        $incomingItemIds = collect($itemsData)
            ->pluck('id')
            ->filter(fn($id) => is_numeric($id) && $id > 0)
            ->map(fn($id) => (int) $id)
            ->all();

        $expense->items()->whereNotIn('id', $incomingItemIds)->delete();

        foreach ($itemsData as $item) {
            if (!is_numeric($item['id'])) {
                $expense->items()->create($item);
            } else {
                $expense->items()->find($item['id'])->update($item);
            }
        }

        $expense->update($validated);

        return redirect()->route('records.index')->with('success', 'Updated Voucher');
    }
}
