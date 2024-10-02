<?php

namespace App\Http\Controllers;

use App\Models\TourismCompany;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourismController extends Controller
{
    // Display the list of tourism companies and their packages
    public function index()
    {
        $companies = TourismCompany::with('packages')->get();
        return view('tours', compact('companies'));
    }

    // Add a new tourism company
    public function storeCompany(Request $request)
    {
        $request->validate(['name' => 'required']);
        TourismCompany::create($request->only('name'));
        return redirect()->back()->with('success', 'Tourism Company Added Successfully');
    }

    // Add a new tour package to a company
    public function storePackage(Request $request)
    {
        $request->validate([
            'tourism_company_id' => 'required|exists:tourism_companies,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|integer'
        ]);

        TourPackage::create($request->all());
        return redirect()->back()->with('success', 'Tour Package Added Successfully');
    }

    // Update a tourism company
    public function updateCompany(Request $request, TourismCompany $company)
    {
        $request->validate(['name' => 'required']);
        $company->update($request->only('name'));
        return redirect()->back()->with('success', 'Tourism Company Updated Successfully');
    }

    // Delete a tourism company
    public function deleteCompany(TourismCompany $company)
    {
        $company->delete();
        return redirect()->back()->with('success', 'Tourism Company Deleted Successfully');
    }

    // Update a tour package
    public function updatePackage(Request $request, TourPackage $package)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|integer'
        ]);

        $package->update($request->all());
        return redirect()->back()->with('success', 'Tour Package Updated Successfully');
    }

    // Delete a tour package
    public function deletePackage(TourPackage $package)
    {
        $package->delete();
        return redirect()->back()->with('success', 'Tour Package Deleted Successfully');
    }
}
