<?php

namespace App\Http\Controllers\Api;

use App\Models\Engine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EngineRequest;

class EngineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Engine::all();
    }

    /**
     * Store a newly created resource in storage.
     */

    //  change Request to the newly created request folder 
    public function store(EngineRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $propertyOwner = Engine::create($validated);

        return $propertyOwner;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Engine::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EngineRequest $request, string $id)
    {
        $validated = $request->validated();

        $propertyOwner = Engine::findOrFail($id);

        $propertyOwner->update($validated);

        return $propertyOwner;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $propertyOwner = Engine::findOrFail($id);
        $propertyOwner->delete();

        return $propertyOwner;
    }
}
