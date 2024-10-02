<?php

namespace App\Http\Controllers;

use App\Models\Booking; // Assuming you have a Booking model
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // Fetch the most recent 10 bookings (you can adjust the limit or paginate)
        $bookings = Booking::orderBy('created_at', 'desc')->take(10)->get();

        // Return the bookings view with the fetched bookings data
        return view('bookings', compact('bookings'));
    }
}
