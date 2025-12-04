<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Symfony\Component\Routing\Alias;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('car/Index', [
            'cars' => Car::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('car/Create', [
            'car' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_number' => 'required|unique:cars,car_number',
            'car_brand' => 'sometimes',
            'car_model' => 'sometimes',
            'customer_name' => 'sometimes',
            'customer_phone' => 'sometimes',
        ]);

        Car::create($validated);
        return redirect(route('cars.index'))->with('success', 'New Car Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return Inertia::render('car/Show', [
            'car' => $car->load(['records' => function ($query) {
                $query->latest('date')->with(['category', 'items']);
            }]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return Inertia::render('car/Create', [
            'car' => $car
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'car_number' => ['required', Rule::unique('cars', 'car_number')->ignore($car->id)],
            'car_brand' => 'sometimes',
            'car_model' => 'sometimes',
            'customer_name' => 'sometimes',
            'customer_phone' => 'sometimes',
        ]);
        $car->update($validated);
        return redirect(route('cars.index'))->with('success', 'Car Info Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
