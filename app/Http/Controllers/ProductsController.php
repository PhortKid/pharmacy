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

    // Store the new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            //'category_id' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'min_stock_level' => 'required|integer',
            'expiry_date' => 'required|date',
        ]);

        $pharmacyId = Auth::user()->pharmacy_id; // Get the authenticated user's pharmacy ID

        Product::create([
            'name' => $request->name,
            'pharmacy_id' => $pharmacyId, // Automatically assign the product to the user's pharmacy
            'category_id' => $request->category_id,
            'manufacturer' => $request->manufacturer,
            'unit' => $request->unit,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'stock_quantity' => $request->stock_quantity,
            'min_stock_level' => $request->min_stock_level,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->route('product_management.index')->with('success', 'Product created successfully.');
    }

    // Show the form to edit a product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $pharmacyId = Auth::user()->pharmacy_id; // Get the authenticated user's pharmacy ID
        return view('dashboard.products.edit', compact('product', 'pharmacyId'));
    }

    // Update the product
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
           // 'category' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'min_stock_level' => 'required|integer',
            'expiry_date' => 'required|date',
        ]);

        $product = Product::findOrFail($id);
        
        // Ensure the product belongs to the authenticated user's pharmacy
        if ($product->pharmacy_id !== Auth::user()->pharmacy_id) {
            return redirect()->route('products.index')->with('error', 'You are not authorized to edit this product.');
        }

        $product->update($request->all());

        return redirect()->route('product_management.index')->with('success', 'Product updated successfully.');
    }

    // Delete the product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Ensure the product belongs to the authenticated user's pharmacy
        if ($product->pharmacy_id !== Auth::user()->pharmacy_id) {
            return redirect()->route('products.index')->with('error', 'You are not authorized to delete this product.');
        }

        $product->delete();

        return redirect()->route('product_management.index')->with('success', 'Product deleted successfully.');
    }
}
