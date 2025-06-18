<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierPayment;
use Illuminate\Http\Request;

class SupplierPaymentController extends Controller
{
    public function index()
    {
        $title = "Supplier Payments";
        $payments = SupplierPayment::with('supplier')->latest()->paginate(10);
        $suppliers = Supplier::all();
        return view('dashboard.payments.index', compact('payments', 'suppliers', 'title'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('dashboard.payments.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|max:255',
        ]);

        $supplier = Supplier::findOrFail($request->supplier_id);

        // Hifadhi malipo
        SupplierPayment::create($request->all());

        // Punguza deni la supplier
        $supplier->total_debt -= $request->amount;
        $supplier->save();

        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully!');
    }
}
