<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\Browsershot\Browsershot;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('quotation/Index', [
            'quotations' => Quotation::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('quotation/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Quotation::create($request->all());
        return redirect()->route('quotations.index')->with('success', 'Updated Voucher');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quotation $quotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quotation $quotation)
    {
        return Inertia::render('quotation/Edit',[
            'quotation' => $quotation,
        ])->with('success', 'Updated Voucher');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quotation $quotation)
    {
        $quotation->update($request->all());
        return redirect()->route('quotations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation)
    {
        //
    }

    public function print(Quotation $quotation)
    {
        return Pdf::view('quotation.show', ['data' => $quotation])
            ->headerView('partials._quotationheader', ['data' => $quotation])
            ->footerView('partials._footer')
            ->format('A4')
            ->margins(97, 10, 10, 10)
            ->name($quotation['subject'] . '.pdf');
        }
}
