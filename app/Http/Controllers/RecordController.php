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
        Record::create($request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'amount' => 'required',
            'remark' => 'sometimes'
        ]));
        return redirect()->route('records.create')->with('success', 'Record Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {
        return Inertia::render('record/Show', [
            'record' => $record->load('category')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record)
    {
        return Inertia::render('record/Create', [
            'categories' => Category::all(),
            'record' => $record
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        $record->update($request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'amount' => 'required',
            'remark' => 'sometimes',
        ]));
        return redirect()->back()->with('success', 'Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        //
    }
}
