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
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('dashboard.purchases.index', compact('purchases', 'suppliers', 'products', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'      => 'required|exists:suppliers,id',
            'product_id'       => 'required|exists:products,id',
            'quantity_bought'  => 'required|integer|min:1',
            'unit_price'       => 'required|numeric|min:0.01',
            'selling_price'    => 'required|numeric|min:0.01',
            'total_purchase'   => 'required|numeric|min:0.01',
            'payment_method'   => 'required',
            'date_of_purchase' => 'required|date',
            'expire_date'      => 'required|date',
            'manufacturer'     => 'required|string|max:255',
        ]);
    
        Purchase::create([
            'supplier_id'      => $request->supplier_id,
            'product_id'       => $request->product_id,
            'quantity_bought'  => $request->quantity_bought,
            'unit_price'       => $request->unit_price,
            'selling_price'    => $request->selling_price,
            'total_purchase'   => $request->total_purchase,
            'payment_method'   => $request->payment_method,
            'date_of_purchase' => $request->date_of_purchase,
            'expire_date'      => $request->expire_date,
            'manufacturer'     => $request->manufacturer,
        ]);
    
        return redirect()->route('purchases.index')->with('success', 'Purchase recorded successfully!');
    }


    public function update(Request $request, Purchase $purchase)
{
    $request->validate([
        'supplier_id'      => 'required|exists:suppliers,id',
        'product_id'       => 'required|exists:products,id',
        'quantity_bought'  => 'required|integer|min:1',
        'unit_price'       => 'required|numeric|min:0.01',
        'selling_price'    => 'required|numeric|min:0.01',
        'total_purchase'   => 'required|numeric|min:0.01',
        'payment_method'   => 'required',
        'date_of_purchase' => 'required|date',
        'expire_date'      => 'required|date',
        'manufacturer'     => 'required|string|max:255',
    ]);

    $purchase->update([
        'supplier_id'      => $request->supplier_id,
        'product_id'       => $request->product_id,
        'quantity_bought'  => $request->quantity_bought,
        'unit_price'       => $request->unit_price,
        'selling_price'    => $request->selling_price,
        'total_purchase'   => $request->total_purchase,
        'payment_method'   => $request->payment_method,
        'date_of_purchase' => $request->date_of_purchase,
        'expire_date'      => $request->expire_date,
        'manufacturer'     => $request->manufacturer,
    ]);

    return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully!');
}

public function destroy(Purchase $purchase)
{
    $purchase->delete();
    return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully!');
}

    
}
