<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function getDataSales() {
        $sales = Sales::select('id', 'name', 'phone_number', 'email', 'address', 'created_at', 'updated_at')->get();

        return view('sales', [
            'sales' => $sales ?? collect([])
        ]);
    }
    public function getDetailDataSales($id) {
        $sales = Sales::findOrFail($id);
        return view('form.update-sales', compact('sales'));
    }
    public function createSales(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
        ]);
        Sales::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'address' => $request->address,
        ]);
        return redirect('/sales')->with('success', 'Sales created successfully.');
    }
    public function updateSales(Request $request, $id) {
        $request->validate([
            'name'         => 'required|string|max:100',
            'phone_number' => 'required|string|max:20',
            'email'        => 'required|email|unique:sales,email,' . $id,
            'address'      => 'nullable|string|max:255',
        ]);

        $sales = Sales::findOrFail($id);
        $sales->name = $request->name;
        $sales->phone_number = $request->phone_number;
        $sales->email = $request->email;
        $sales->address = $request->address;

        $sales->save();

        return redirect('/sales')->with('success', 'Sales updated successfully.');
    }
    public function deleteSales($id) {
        $sales= Sales::findOrFail($id);
        $sales->delete();

        return redirect('/sales')->with('success', 'Sales deleted successfully.');
    }
}
