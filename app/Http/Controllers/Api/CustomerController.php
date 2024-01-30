<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return all customer
        // return Customer::all();

        // Query builder instance
        $query = Customer::query();

        // Cater Search use "keyword"
        if ($request->keyword) {
            $query->where(function ($query) use ($request) {
                $query->where('customer_name', 'like', '%' . $request->keyword . '%');
            });
        }

        // Pagination based on the number set; You can change the number below
        $perPage = 6;
        return $query->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     */

    //  change Request to the newly created request folder 
    public function store(CustomerRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $customer = Customer::create($validated);

        return $customer;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Customer::findOrFail($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $id)
    {
        $validated = $request->validated();

        $customer = Customer::findOrFail($id);

        $customer->update($validated);

        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return $customer;
    }
}
