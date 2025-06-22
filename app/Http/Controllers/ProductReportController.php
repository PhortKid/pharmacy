<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductReportController extends Controller
{

    /*
    public function index(Request $request)
    { 
        $pharmacy_id=Auth::user()->pharmacy_id;
        // Fetch all categories
        $categories = Category::with('products')->get();



        // Fetch products based on selected category
        $query = Product::with(['category','purchase']);

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->with('purchase')->get();
        $title="product report";

        return view('dashboard.reports.product_report', compact('categories', 'products','title'));
    
    }

    */


    public function index(Request $request)
    {
        $pharmacy_id = Auth::user()->pharmacy_id;

        // Fetch all categories with their products
        $categories = Category::with('products')->get();

        // Start purchase query with relationships
        $query = Purchase::with(['product.category']);

        // Filter by category if selected
        if ($request->has('category_id') && $request->category_id != '') {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        $purchases = $query->get();
        $title = "Purchase Report";

        return view('dashboard.reports.product_report', compact('categories', 'purchases', 'title'));
    }
}
