<?php

namespace App\Http\Controllers;

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
            'categories' => Category::all(),
            'record' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required',
            'description' => 'sometimes',
            'sub_total' => 'required',
            'discount' => 'required',
            'grand_total' => 'required',
            'remark' => 'required',
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
        return Inertia::render('recordexpense/Edit', [
            'categories' => Category::all(),
            'record' => $expense->load('items')->load('category')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        // $record->update($request->validate([
        //     'date' => 'required',
        //     'description' => 'required',
        //     'category_id' => 'required',
        //     'grand_total' => 'required',
        //     'remark' => 'sometimes',
        // ]));
        // return redirect()->route('records.index')->with('success', 'Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        //
    }
}
