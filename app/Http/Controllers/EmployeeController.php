<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;
use InternalIterator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('employee/Index', [
            'employees' => Employee::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('employee/Create', [
            'employee' => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = Employee::create($request->validate([
            'name' => 'required',
            'dob' => 'sometimes',
            'base_salary' => 'required',
            'join_date' => 'sometimes',
            'leave_date' => 'sometimes',
        ]));

        $employee->salaryHistories()->create([
            'base_salary' => $request->base_salary,
        ]);

        return redirect(route('employees.index'))->with('success', 'New Employee Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return Inertia::render('employee/Show', [
            'employee' => $employee->load('salaryHistories', 'latestSalary')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return Inertia::render('employee/Create', [
            'employee' => $employee->load(['salaryHistories' => function ($query) {
                $query->latest()->first();
            }])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required',
            'dob' => 'sometimes',
            'join_date' => 'sometimes',
            'leave_date' => 'sometimes',
            'base_salary' => 'sometimes',
        ]);
        $employee->update($validated);

        if ($employee->salaryHistories()->latest()->first()->base_salary != $request->base_salary) {
            $employee->salaryHistories()->create(['base_salary' => $request->base_salary]);
        }
        return redirect(route('employees.index'))->with('success', 'Employee Info Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
