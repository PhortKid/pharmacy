<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductReportController extends Controller
{
    public function index(Request $request)
    {
        $pharmacy_id=Auth::user()->pharmacy_id;
        // Fetch all categories
        $categories = Category::with('products')->where('pharmacy_id',$pharmacy_id)->get();



        // Fetch products based on selected category
        $query = Product::with('category');

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->where('pharmacy_id',$pharmacy_id)->get();
        $title="product report";

        return view('dashboard.reports.product_report', compact('categories', 'products','title'));
    
    }
}
