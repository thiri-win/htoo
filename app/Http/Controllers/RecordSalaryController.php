<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Record;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecordSalaryController extends Controller
{
    public function create()
    {
        return Inertia::render('recordsalary/Create', [
            'employees' => Employee::with('latestSalary')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required',
            'employee_id' => 'required',
        ]);
        $validated['description'] = Employee::find($request->employee_id)->name;
        $validated['category_id'] = 4;
        $validated['remark'] = "salary($request->base_salary),attendance_details(". json_encode($request->attendance_details) .")";
        dd($validated);
        Record::create($validated);
        return redirect()->route('records.index')->with('success', 'Salary Added Successfully');
    }
}
