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

        $dealer = Dealer::create($validated);

        return $dealer;
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

        $dealer = Dealer::findOrFail($id);

        $dealer->update($validated);

        return $dealer;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dealer = Dealer::findOrFail($id);
        $dealer->delete();

        return $dealer;
    }
}
