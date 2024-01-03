<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManufacturerRequest;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Manufacturer::all();
    }

    /**
     * Store a newly created resource in storage.
     */

    //  change Request to the newly created request folder 
    public function store(ManufacturerRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $propertyOwner = Manufacturer::create($validated);

        return $propertyOwner;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Manufacturer::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ManufacturerRequest $request, string $id)
    {
        $validated = $request->validated();

        $propertyOwner = Manufacturer::findOrFail($id);

        $propertyOwner->update($validated);

        return $propertyOwner;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $propertyOwner = Manufacturer::findOrFail($id);
        $propertyOwner->delete();

        return $propertyOwner;
    }
}
