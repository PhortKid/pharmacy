<?php 
namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index()
    {
        $title = "Purchases";
        $purchases = Purchase::with(['supplier', 'product'])->latest()->paginate(10);
        $suppliers = Supplier::where('pharmacy_id',Auth::user()->pharmacy_id)->get();
        $products = Product::where('pharmacy_id',Auth::user()->pharmacy_id)->get();
        return view('dashboard.purchases.index', compact('purchases', 'suppliers', 'products', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0.01',
            'status' => 'required|in:pending,paid'
        ]);

        $total_price = $request->quantity * $request->unit_price;

        Purchase::create([
            'supplier_id' => $request->supplier_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total_price' => $total_price,
            'status' => $request->status
        ]);

        return redirect()->route('purchases.index')->with('success', 'Purchase recorded successfully!');
    }
}
