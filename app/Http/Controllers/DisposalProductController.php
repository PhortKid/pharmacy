<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DisposalProduct;
use App\Models\Product;
use App\Models\Purchase;
use Carbon\Carbon;

class DisposalProductController extends Controller
{
    public function index()
    {
        $DisposalProducts = DisposalProduct::with('purchase')->latest()->get();
        $purchases= Purchase::all(); 
        $title="Waste";
        return view('dashboard.waste.index', compact('DisposalProducts','purchases','title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'purchase_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'reason' => 'required|string',
        ]);

        $purchase=Purchase::find($request->purchase_id);
        if($purchase->quantity_bought<$request->quantity)
        {

          
            return redirect()->back()->with('danger', 'The Quantity Entered Exceeds the available Quantity');
        }else{
             
            $purchase->quantity_bought=$purchase->quantity_bought-$request->quantity;
            $purchase->save();

                DisposalProduct::create([
                    'purchase_id' => $request->purchase_id,
                    'quantity_disposed' => $request->quantity,
                    'reason' => $request->reason,
                    'disposed_at' => Carbon::now(),
                ]);
                return redirect()->back()->with('success', 'Product marked as Disposal successfully.');
        
        }

    
    }
}
