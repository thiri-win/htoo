<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Record;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('record/Index',[
            'records' => Record::all(),
            'vouchers' => Voucher::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('record/Create',[
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
            'records' => 'required|array',
            'records.*.description' => 'required',
            'records.*.category_id' => 'required',
            'records.*.grand_total' => 'required',
            'records.*.remark' => 'sometimes',
        ]);

        foreach ($validated['records'] as $recordData) {
            Record::create([
                'date' => $validated['date'],
                'description' => $recordData['description'],
                'category_id' => $recordData['category_id'],
                'sub_total' => 0,
                'discount' => 0,
                'grand_total' => $recordData['grand_total'],
                'remark' => $recordData['remark'] ?? null,
            ]);
        }

        return redirect()->route('records.index')->with('success', 'Record Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {
        return Inertia::render('record/Show', [
            'record' => $record->load('category')->load('sales')->load('car')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record)
    {
        return Inertia::render('record/Edit', [
            'categories' => Category::all(),
            'record' => $record->load('sales')->load('category')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        $record->update($request->validate([
            'date' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'grand_total' => 'required',
            'remark' => 'sometimes',
        ]));
        return redirect()->route('records.index')->with('success', 'Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        //
    }
}
