<?php

namespace App\Http\Controllers\Api;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Vehicle::all();
    }

    /**
     * Store a newly created resource in storage.
     */

    //  change Request to the newly created request folder 
    public function store(VehicleRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $propertyOwner = Vehicle::create($validated);

        return $propertyOwner;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Vehicle::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleRequest $request, string $id)
    {
        $validated = $request->validated();

        $propertyOwner = Vehicle::findOrFail($id);

        $propertyOwner->update($validated);

        return $propertyOwner;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $propertyOwner = Vehicle::findOrFail($id);
        $propertyOwner->delete();

        return $propertyOwner;
    }
}
