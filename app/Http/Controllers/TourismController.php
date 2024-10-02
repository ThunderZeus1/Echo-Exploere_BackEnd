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
        // Eager load 'packages' relationship to reduce queries
        $companies = TourismCompany::with('packages')->get();

        // Return the view with the companies and packages data
        return view('tours', compact('companies')); // Changed view to 'tours.index' for consistency
    }

    // Add a new tourism company
    public function storeCompany(Request $request)
    {
        // Validate the request input
        $request->validate([
            'name' => 'required|string|max:255|unique:tourism_companies,name', // Ensure unique company name
        ]);

        // Create a new tourism company
        TourismCompany::create($request->only('name'));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Tourism Company Added Successfully');
    }

    // Add a new tour package to a company
    public function storePackage(Request $request)
    {
        // Validate the request input
        $request->validate([
            'tourism_company_id' => 'required|exists:tourism_companies,id', // Ensure company exists
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1', // Ensure duration is at least 1
        ]);

        // Create a new tour package
        TourPackage::create($request->only('tourism_company_id', 'name', 'price', 'duration'));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Tour Package Added Successfully');
    }

    // Update a tourism company
    public function updateCompany(Request $request, TourismCompany $company)
    {
        // Validate the request input
        $request->validate([
            'name' => 'required|string|max:255|unique:tourism_companies,name,' . $company->id,
        ]);

        // Update the company information
        $company->update($request->only('name'));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Tourism Company Updated Successfully');
    }

    // Delete a tourism company
    public function deleteCompany(TourismCompany $company)
    {
        // Delete associated packages first to maintain referential integrity
        $company->packages()->delete();

        // Delete the tourism company
        $company->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Tourism Company Deleted Successfully');
    }

    // Update a tour package
    public function updatePackage(Request $request, TourPackage $package)
    {
        // Validate the request input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);

        // Update the package information
        $package->update($request->only('name', 'price', 'duration'));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Tour Package Updated Successfully');
    }

    // Delete a tour package
    public function deletePackage(TourPackage $package)
    {
        // Delete the tour package
        $package->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Tour Package Deleted Successfully');
    }

    // Fetch packages based on the selected company (for AJAX)
    public function getPackagesByCompany($companyId)
    {
        // Fetch all packages for the given tourism company
        $packages = TourPackage::where('tourism_company_id', $companyId)->get();

        // Return the packages as a JSON response for the AJAX request
        return response()->json([
            'packages' => $packages
        ]);
    }
}
