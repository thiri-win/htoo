<?php

namespace App\Http\Controllers;

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
            'car_brand' => 'required',
            'car_model' => 'required',
            'car_number' => 'required',
            'discount' => 'required',
            'total' => 'required',
            'note' => 'sometimes',
            'sales' => 'required|array',
            'sales.*.description' => 'required',
            'sales.*.quantity' => 'required',
            'sales.*.unit_price' => 'required',
            'sales.*.sub_total' => 'required',
        ]);
        $voucher = Voucher::create($validated);
        $voucher->sales()->createMany($validated['sales']);
        return redirect()->route('vouchers.index')->with('success', 'Added New Voucher');
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
    public function edit(Voucher $voucher)
    {
        return Inertia::render('voucher/Create', [
            'voucher' => $voucher->load('sales')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $voucher)
    {
        $validated = $request->validate([
            'date' => 'required',
            'customer_name' => 'sometimes',
            'customer_phone' => 'sometimes',
            'car_brand' => 'required',
            'car_model' => 'required',
            'car_number' => 'required',
            'discount' => 'required',
            'total' => 'required',
            'note' => 'sometimes',
            'sales' => 'required|array',
            'sales.*.id' => 'sometimes',
            'sales.*.description' => 'required',
            'sales.*.quantity' => 'required',
            'sales.*.unit_price' => 'required',
            'sales.*.sub_total' => 'required',
        ]);
        
        $voucher->update($validated);

        $salesData = $validated['sales'];
        foreach ($salesData as $sale) {
            if (isset($sale['id'])) {
                $voucher->sales()->find($sale['id'])->update($sale);
            } else {
                $voucher->sales()->create($sale);
            }
        }

        return redirect()->back()->with('success', 'Updated Voucher');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        //
    }
}
