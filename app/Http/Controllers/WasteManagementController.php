<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WasteProduct;
use App\Models\Product;
use Carbon\Carbon;

class WasteManagementController extends Controller
{
    public function index()
    {
        $wasteProducts = WasteProduct::with('products')->latest()->get();
        $products = Product::all(); 
        $title="Waste";
        return view('dashboard.waste.index', compact('wasteProducts','products','title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'reason' => 'required|string',
        ]);

        WasteProduct::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'reason' => $request->reason,
            'wasted_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Product marked as waste successfully.');
    }
}
