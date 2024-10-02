<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        // Example companies (replace with actual database queries)
        $companies = collect([
            (object)[
                'name' => 'Mountain Adventures',
                'description' => 'Explore the world\'s highest peaks with expert guides.',
                'trending_score' => 95,
            ],
            (object)[
                'name' => 'Oceanic Wonders',
                'description' => 'Dive into the most beautiful coral reefs and experience marine life like never before.',
                'trending_score' => 90,
            ],
            (object)[
                'name' => 'Safari Thrills',
                'description' => 'Join us for an unforgettable safari experience across Africa\'s savannas.',
                'trending_score' => 88,
            ],
            (object)[
                'name' => 'Cityscapes & Culture',
                'description' => 'Discover urban wonders and cultural heritage across the world\'s most iconic cities.',
                'trending_score' => 85,
            ],
            (object)[
                'name' => 'Tropical Paradise',
                'description' => 'Escape to serene tropical islands with white sandy beaches and crystal-clear waters.',
                'trending_score' => 82,
            ],
            (object)[
                'name' => 'Arctic Expeditions',
                'description' => 'Journey to the ends of the Earth and explore the breathtaking Arctic landscapes.',
                'trending_score' => 80,
            ]
        ]);

        return view('company', compact('companies'));
    }
}
