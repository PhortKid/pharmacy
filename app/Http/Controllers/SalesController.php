<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    /**
     * Display all sales.
     */
    public function index()
    {
        $title = "Sales";
        $sales = Sale::with(['purchase.product', 'user'])->latest()->get();
        $purchases = Purchase::with('product')->get();

        return view('dashboard.sales.index', compact('sales', 'purchases', 'title'));
    }

    /**
     * Store a new sale.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_id' => 'required|exists:purchases,id',
            'quantity_sold' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'receipt_no' => 'nullable|string|max:255',
        ]);
    
        $purchase = Purchase::with('product')->findOrFail($validated['purchase_id']);
        $product = $purchase->product;
    
        $validated['user_id'] = Auth::id();
    
        Sale::create($validated);
    
        $product->save();

        $decrease_purchase=Purchase::find($request->purchase_id);
        if($decrease_purchase->quantity_bought<$request->quantity_sold){
           

            return redirect()->back()->with('danger', 'Sale error');
        }
           $decrease_purchase->quantity_bought=$decrease_purchase->quantity_bought-$request->quantity_sold;
           $decrease_purchase->save();
    
        return redirect()->back()->with('success', 'Sale recorded successfully.');
    }
    
    /**
     * Update a sale.
     */
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'purchase_id' => 'required|exists:purchases,id',
        'quantity_sold' => 'required|integer|min:1',
        'total_price' => 'required|numeric|min:0',
        'receipt_no' => 'nullable|string|max:255',
    ]);

    $sale = Sale::findOrFail($id);
    $oldQuantity = $sale->quantity_sold;

    $purchase = Purchase::with('product')->findOrFail($validated['purchase_id']);
    $product = $purchase->product;

    $product->stock_quantity += $oldQuantity;

    $sale->update($validated);

   
    $product->save();

    return redirect()->back()->with('success', 'Sale updated successfully.');
}


    /**
     * Delete a sale.
     */
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $product = $sale->purchase->product;

        // Revert stock
        $product->stock_quantity += $sale->quantity_sold;
        $product->save();

        $sale->delete();

        return redirect()->back()->with('success', 'Sale deleted successfully.');
    }
}
