<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('voucher/Index', [
            'vouchers' => Voucher::orderBy('date', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('voucher/Create', [
            'voucher' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required',
            'customer_name' => 'sometimes',
            'customer_phone' => 'sometimes',
            'car_brand' => 'sometimes',
            'car_model' => 'sometimes',
            'car_number' => 'sometimes',
            'sub_total' => 'required',
            'discount' => 'required',
            'grand_total' => 'required',
            'remark' => 'sometimes',
            'sales' => 'required|array',
            'sales.*.description' => 'required',
            'sales.*.quantity' => 'required',
            'sales.*.unit_price' => 'required',
            'sales.*.total' => 'required',
        ]);
        $validated['description'] = $validated['car_number'];
        $validated['category_id'] = 1;

        $record = Record::create($validated);
        $record->sales()->createMany($validated['sales']);
        $record->car()->create($validated);
        
        return redirect()->route('records.index')->with('success', 'Added New Voucher');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        return Inertia::render('voucher/Show', [
            'voucher' => $voucher->load('sales')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $voucher)
    {
        return Inertia::render('voucher/Create', [
            'voucher' => $voucher->load(['sales', 'car'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $voucher)
    {
        $validated = $request->validate([
            'date' => 'required',
            'customer_name' => 'sometimes',
            'customer_phone' => 'sometimes',
            'car_brand' => 'required',
            'car_model' => 'required',
            'car_number' => 'required',
            'sub_total' => 'required',
            'discount' => 'required',
            'grand_total' => 'required',
            'remark' => 'sometimes',
            'sales' => 'required|array',
            'sales.*.id' => 'sometimes',
            'sales.*.description' => 'required',
            'sales.*.quantity' => 'required',
            'sales.*.unit_price' => 'required',
            'sales.*.total' => 'required',
        ]);
        
        // $voucher->update($validated);

        // return $voucher->sales;   

        $salesData = $validated['sales'];

        return $salesData;
        foreach ($salesData as $sale) {
            if (isset($sale['id'])) {
                $voucher->sales()->find($sale['id'])->update($sale);
            } else {
                $voucher->sales()->create($sale);
            }
        }

        return redirect()->route('records.index')->with('success', 'Updated Voucher');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        //
    }
}
