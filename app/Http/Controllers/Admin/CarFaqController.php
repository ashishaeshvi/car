<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarFaq;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarFaqController extends Controller
{
    // List FAQs
    public function index($carId)
    {
        $faqs = CarFaq::where('car_id', $carId)->get();
        return view('admin.cars.faqs', compact('faqs', 'carId'));
    }

    // Add FAQ
    public function store(Request $request, $carId)
    {
        $data = $request->validate([
            'section' => 'required|string|max:100',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $data['car_id'] = $carId;
        CarFaq::create($data);

        return redirect()->back()->with('success', 'FAQ added successfully!');
    }

    // Delete FAQ
    public function destroy($id)
    {
        $faq = CarFaq::findOrFail($id);
        $faq->delete();

        return redirect()->back()->with('success', 'FAQ deleted successfully!');
    }
}