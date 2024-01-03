<?php

namespace App\Http\Controllers\Api;

use App\Models\Dealer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DealerRequest;

class DealerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Dealer::all();
    }

    /**
     * Store a newly created resource in storage.
     */

    //  change Request to the newly created request folder 
    public function store(DealerRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $propertyOwner = Dealer::create($validated);

        return $propertyOwner;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Dealer::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(DealerRequest $request, string $id)
    {
        $validated = $request->validated();

        $propertyOwner = Dealer::findOrFail($id);

        $propertyOwner->update($validated);

        return $propertyOwner;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $propertyOwner = Dealer::findOrFail($id);
        $propertyOwner->delete();

        return $propertyOwner;
    }
}
