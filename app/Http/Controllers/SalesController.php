<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    /**
     * Display a listing of the stock movements.
     */
    public function index()
    {
        $title="Stock Movement";
        $stockMovements = Sale::with('product')->latest()->get();
        $products = Purchase::all(); // Fetch all purchase for dropdown selection
        
        return view('dashboard.sales.index', compact('stockMovements', 'products','title'));
    }

    /**
     * Store a newly created stock movement.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'movement_type' => 'required|in:purchase,sale,return,adjustment',
            'quantity' => 'required|integer|min:1',
            'price_at_time' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $pharmacy_id=Auth::user()->pharmacy_id;

       
        //$movement = StockMovement::create($request->all(),);
       $movement=Sale::create(['product_id'=>$request->product_id,'movement_type'=>$request->movement_type,'quantity'=>$request->quantity,'price_at_time'=>$request->price_at_time,'pharmacy_id'=>$pharmacy_id]);

  

        // Sasisha stock ya bidhaa husika
      $this->updateStock($request->product_id, $request->movement_type, $request->quantity);

       return redirect()->back()->with('success', 'Stock movement recorded successfully.');
    }

    /**
     * Update the specified stock movement.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'movement_type' => 'required|in:purchase,sale,return,adjustment',
            'quantity' => 'required|integer|min:1',
            'price_at_time' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $movement = Sale::findOrFail($id);

        // Reverse old movement before updating
        $this->reverseStock($movement);

        $movement->update($request->all());

        // Apply new movement changes
        $this->updateStock($request->product_id, $request->movement_type, $request->quantity);

        return redirect()->back()->with('success', 'Stock movement updated successfully.');
    }

    /**
     * Remove the specified stock movement.
     */
    public function destroy($id)
    {
        $movement = Sale::findOrFail($id);

        // Reverse stock before deleting
        $this->reverseStock($movement);

        $movement->delete();

        return redirect()->back()->with('success', 'Stock movement deleted successfully.');
    }

    /**
     * Update stock based on movement type.
     */
    private function updateStock($product_id, $movement_type, $quantity)
    {
        $product = Product::findOrFail($product_id);
        if ($movement_type == 'purchase' || $movement_type == 'return') {
            $product->stock_quantity += $quantity;
        } elseif ($movement_type == 'sale' || $movement_type == 'adjustment') {
            $product->stock_quantity -= $quantity;
        }
        $product->save();
    }

    /**
     * Reverse stock changes before updating or deleting movement.
     */
    private function reverseStock($movement)
    {
        $product = Product::findOrFail($movement->product_id);
        if ($movement->movement_type == 'purchase' || $movement->movement_type == 'return') {
            $product->stock_quantity -= $movement->quantity;
        } elseif ($movement->movement_type == 'sale' || $movement->movement_type == 'adjustment') {
            $product->stock_quantity += $movement->quantity;
        }
        $product->save();
    }
}
