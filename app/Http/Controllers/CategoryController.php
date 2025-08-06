<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getDataCategory() {
        $categories = Category::select('id', 'name', 'description', 'created_at', 'updated_at')->get();

        return view('categories', [
            'categories' => $categories ?? collect([])
        ]);
    }
    public function getDetailDataCategory($id) {
        $categories = Category::findOrFail($id);
        return view('form.update-category', compact('categories'));
    }
    public function createCategory(Request $request) {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:500',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect('/categories')->with('success', 'Category created successfully.');
    }
    public function updateCategory(Request $request, $id) {
        $request->validate([
            'name'        => 'required|string|max:50',
            'description' => 'nullable|string|max:500',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();

        return redirect('/categories')->with('success', 'Category updated successfully.');
    }
    public function deleteCategory($id) {
        $category= Category::findOrFail($id);
        $category->delete();

        return redirect('/categories')->with('success', 'Category deleted successfully.');
    }
}
