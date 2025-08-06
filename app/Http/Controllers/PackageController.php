<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Category;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function getDataPackage() {
        $packages = Package::with('category')
            ->select('id', 'category_id', 'name', 'description', 'cost', 'created_at', 'updated_at')
            ->get();

        $packages->each(function ($package) {
            $package->category_name = $package->category->name ?? '-';
        });

        return view('packages', [
            'packages' => $packages,
        ]);
    }
    public function getDetailDataPackage($id) {
        $package = Package::findOrFail($id);
        $categories = Category::all();
        return view('form.update-package', compact('package', 'categories'));
    }
    public function showFormCreatePackage() {
        $categories = Category::select('id', 'name')->get();
        return view('form/create-package', [
            'categories' => $categories
        ]);
    }
    public function createPackage(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:1000',
            'cost' => 'required|numeric|min:0',
        ]);
        Package::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'cost' => $request->cost,
        ]);
        return redirect('/packages')->with('success', 'Package created successfully.');
    }
    public function updatePackage(Request $request, $id) {
        $request->validate([
            'name'         => 'required|string|max:50',
            'category_id'  => 'required|exists:categories,id',
            'description'  => 'nullable|string|max:255',
            'cost'         => 'required|numeric|min:0',
        ]);

        $package = Package::findOrFail($id);
        $package->name = $request->name;
        $package->category_id = $request->category_id;
        $package->description = $request->description;
        $package->cost = $request->cost;

        $package->save();

        return redirect('/packages')->with('success', 'Package updated successfully.');
    }
    public function deletePackage($id) {
        $package= Package::findOrFail($id);
        $package->delete();

        return redirect('/packages')->with('success', 'Package deleted successfully.');
    }
}
