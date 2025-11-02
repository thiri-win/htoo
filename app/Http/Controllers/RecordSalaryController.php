<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecordSalaryController extends Controller
{
    public function create()
    {
        return Inertia::render('recordsalary/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'grand_total' => 'required',
            'remark' => 'sometimes',
        ]);

        Record::create($validated);
        return redirect()->route('records.index')->with('success', 'Salary Added Successfully');
    }
}
