<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class StockAlertController extends Controller
{
    public function index()
    {
        // Fetch low stock products (stock_quantity < min_stock_level)
        $lowStockProducts = Product::whereColumn('stock_quantity', '<', 'min_stock_level')->get();

        // Count total low stock products
        $lowStockCount = $lowStockProducts->count();
     $title="Stock Alert";
        return view('dashboard.reports.low_stock_report', compact('lowStockProducts', 'lowStockCount','title'));
    }
}
