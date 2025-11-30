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
            'grand_total' => 'required',
        ]);
        $validated['category_id'] = 4;
        $validated['remark'] = 'leave_days='.$request->unpaid_leave_days.', fine='. $request->fine.', bonus='. $request->bonus;
        Record::create($validated);
        return redirect()->route('records.index')->with('success', 'Salary Added Successfully');
    }
}
