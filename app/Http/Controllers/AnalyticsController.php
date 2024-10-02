<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        return view('analytics'); // Create an 'analytics.blade.php' file.
    }
}
