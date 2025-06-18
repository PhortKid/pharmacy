<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ProductsController extends Controller
{
     

    // Show the list of products related to the authenticated user's pharmacy
    public function index()
    {
        $pharmacyId = Auth::user()->pharmacy_id; // Get the authenticated user's pharmacy ID
        $products = Product::all(); // Get products related to the user's pharmacy
        $title="Product";
        $categories = Category::all(); 
        $totalProducts=Product::all()->count();
          // Count expired products
             
        
            return view('dashboard.products.index', compact('products', 'title', 'categories', 'totalProducts'));
    }

    // Show the form to create a new product
    public function create()
    {
        $pharmacyId = Auth::user()->pharmacy_id; // Get the authenticated user's pharmacy ID
        return view('dashboard.products.create', compact('pharmacyId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'min_stock_level' => 'required|integer|min:1',
        ]);

        Product::create($request->all());

        return redirect()->route('product_management.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'min_stock_level' => 'required|integer|min:1',
        ]);

        $product=Product::find($id);
        $product->name=$request->name;
        $product->category_id=$request->category_id;
        $product->min_stock_level=$request->min_stock_level;
        $product->save();

        return redirect()->route('product_management.index')->with('success', 'Product updated successfully.');
    }


    // Delete the product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);      
        $product->delete();
        return redirect()->route('product_management.index')->with('success', 'Product deleted successfully.');
    }
}
