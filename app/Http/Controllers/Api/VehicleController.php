<?php

namespace App\Http\Controllers\Api;

use App\Models\Dealer;
use App\Models\Vehicle;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Vehicle::with(['models.brand']);

        // Search by "Keyword" specific brand
        if ($request->has('keyword')) {
            $query->whereHas('models.brand', function ($query) use ($request) {
                $query->where('brand_name', $request->keyword);
            });
        }

        $perPage = 3;
        $vehicles = $query->paginate($perPage);

        return $vehicles;
    }

    /**
     * Display a listing of the resource.
     */
    public function all(Request $request)
    {
        // Show data based on logged vehicle
        return Vehicle::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleRequest $request)
    {
        // $validated = $request->validated();

        // $validated['password'] = Hash::make($validated['password']);

        // $vehicle = vehicle::create($validated);

        // return $vehicle;

        // Retrieve the validated input data...
        $validated = $request->validated();

        // Store in carousel folder the image
        $validated['image'] = $request->file('image')->storePublicly('vehicle', 'public');

        $vehicle = Vehicle::create($validated);

        return $vehicle;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Vehicle::findOrFail($id);
    }

    /**
     * Display the dealer for a specific vehicle.
     */
    public function viewDealer(string $id)
    {
        // Find the vehicle by id
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            // Handle the case where the vehicle is not found
            return response()->json(['error' => 'Vehicle not found'], 404);
        }

        // Fetch the dealer information for the specified dealer_id of the vehicle
        $dealer = Dealer::find($vehicle->dealer_id);

        if (!$dealer) {
            // Handle the case where the dealer is not found
            return response()->json(['error' => 'Dealer not found'], 404);
        }

        // Fetch inventory items for the specified dealer_id
        $dealerItems = Inventory::where('dealer_id', $vehicle->dealer_id)->get();

        // You can customize the response format based on your needs
        return response()->json(['dealer' => $dealer]);

        // add this in return response if you want to get the information of the vehicle and inventory 
        // 'vehicle' => $vehicle,'inventory' => $dealerItems
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleRequest $request, string $id)
    {
        $validated = $request->validated();

        // Upload Image to Backend and Store Image Path
        $validated['image'] = $request->file('image')->storePublicly('vehicle', 'public');

        // Get Info by Id 
        $vehicle = Vehicle::findOrFail($id);

        // Delete Previous Image
        if (!is_null($vehicle->image)) {
            Storage::disk('public')->delete($vehicle->image);
        }

        // Update New Info
        $vehicle->update($validated);

        return $vehicle;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        Storage::disk('public')->delete($vehicle->image);
        $vehicle->delete();
        return $vehicle;
    }
}
