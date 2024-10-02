<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index()
    {
        return view('tours'); // Create a 'tours.blade.php' file for this.
    }

}
