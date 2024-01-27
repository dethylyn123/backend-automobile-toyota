<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query builder instance
        $query = Supplier::query();

        // Cater Search use "keyword"
        if ($request->keyword) {
            $query->where(function ($query) use ($request) {
                $query->where('supplier_name', 'like', '%' . $request->keyword . '%');
            });
        }

        // Pagination based on the number set; You can change the number below
        $perPage = 3;
        return $query->paginate($perPage);

        // Show all data; Uncomment if necessary
        // return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */

    //  change Request to the newly created request folder 
    public function store(SupplierRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $supplier = Supplier::create($validated);

        return $supplier;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Supplier::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, string $id)
    {
        $validated = $request->validated();

        $supplier = Supplier::findOrFail($id);

        $supplier->update($validated);

        return $supplier;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return $supplier;
    }
}
