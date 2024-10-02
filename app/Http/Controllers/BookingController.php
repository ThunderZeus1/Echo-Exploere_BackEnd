<?php

namespace App\Http\Controllers;

use App\Models\Booking; // Assuming you have a Booking model
use App\Models\TourismCompany; // Assuming you have a TourismCompany model
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Display the most recent bookings and companies for the form
    public function index()
    {
        // Fetch the most recent 10 bookings (you can adjust the limit or paginate)
        $bookings = Booking::orderBy('created_at', 'desc')->take(10)->get();

        // Fetch all tourism companies to populate the dropdown
        $companies = TourismCompany::all();

        // Return the bookings view with the fetched bookings and companies data
        return view('bookings', compact('bookings', 'companies'));
    }

    // Method for storing a new booking
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'company_id' => 'required|exists:tourism_companies,id',
            'package_id' => 'required|exists:tour_packages,id',
            'customer_name' => 'required|string|max:255',
            'tour_name' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:confirmed,pending,canceled',
            'amount' => 'required|numeric|min:0',
        ]);

        // Create a new booking in the database
        Booking::create($validatedData);

        // Redirect back to the bookings index with a success message
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }
}
