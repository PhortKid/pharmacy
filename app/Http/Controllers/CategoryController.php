<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
   
    // Show the list of categories
    public function index()
    {   
        $pharmacyId = Auth::user()->pharmacy_id; 
        $title="category";
        $categories = Category::all(); // Fetch all categories
      //$categories = Category::all();
        return view('dashboard.categories.index', compact('categories','title'));
    }

    // Show the form to create a new category
    public function create()
    {
        return view('categories.create');
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);
        $pharmacyId = Auth::user()->pharmacy_id; 
        Category::create([
            'name' => $request->name,
            'unit' => $request->unit,
            //'pharmacy_id' => $pharmacyId,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Show the form to edit a category
    public function edit($id)
    {
     //   $category = Category::findOrFail($id);
      //  return view('categories.edit', compact('category'));
      return 'soon';
    
    }

    // Update the category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'unit' => $request->unit,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete a category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
