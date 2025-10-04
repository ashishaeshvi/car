<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarMileage;
use App\Models\FuelType;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class CarMileageController extends Controller
{
    // List mileages for a car
    public function index($carId)
    {
        $mileages = CarMileage::with('fuelType')->where('car_id', $carId)->get();
         $fuelTypes = FuelType::select('id', 'name')->where('status', 'active')->get();
        return view('admin.cars.mileages', compact('mileages', 'carId','fuelTypes'));
    }

    // Add a new mileage row
    public function store(Request $request, $carId)
    {
        $data = $request->validate([
            'fuel_type_id' => 'required|string|max:50',
            'transmission' => 'required|string|max:50',
            'mileage' => 'required|string|max:50',
            'city_mileage' => 'required|string|max:50',
            'highway_mileage' => 'required|string|max:50',
        ]);

        $data['car_id'] = $carId;
        CarMileage::create($data);

        return redirect()->back()->with('success', 'Mileage added successfully!');
    }

    // Delete a mileage row
    public function destroy($id)
    {
        $mileage = CarMileage::findOrFail($id);
        $mileage->delete();

        return redirect()->back()->with('success', 'Mileage deleted successfully!');
    }
}