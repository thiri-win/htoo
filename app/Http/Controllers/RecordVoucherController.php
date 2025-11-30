<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Record;
use Inertia\Inertia;

class RecordVoucherController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('voucher/Create', [
            'voucher' => [],
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
            'grand_total' => 'required',
            'remark' => 'sometimes',
            // record items
            'items' => 'required|array',
            'items.*.description' => 'required',
            'items.*.quantity' => 'required',
            'items.*.unit_price' => 'required',
            'items.*.total' => 'required',
        ]);
        $validated['category_id'] = 1;

        $record = Record::create($validated);
        $record->items()->createMany($validated['items']);
        $record->car()->create($validated);

        return redirect()->route('records.index')->with('success', 'Added New Voucher');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $voucher)
    {
        return Inertia::render('voucher/Create', [
            'voucher' => $voucher->load(['items', 'car']),
            'cars' => Car::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $voucher)
    {
        $validated = $request->validate([
            'description' => 'sometimes',
            // car
            'car_id' => 'required',
            // record
            'date' => 'required',
            'sub_total' => 'required',
            'discount' => 'required',
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

        foreach ($itemsData as $item) {
            if (isset($item['id'])) {
                $voucher->items()->find($item['id'])->update($item);
            } else {
                $voucher->items()->create($item);
            }
        }
        $voucher->update($validated);

        return redirect()->route('records.index')->with('success', 'Updated Voucher');
    }
}
