<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class StockAlertController extends Controller
{
  
    public function index()
    {
        $lowStockProducts = DB::table('purchases')
            ->join('products', 'purchases.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.id as product_id',
                'products.name as product_name',
                'products.min_stock_level',
                'categories.name as category_name',
                DB::raw('SUM(purchases.quantity_bought) as total_stock'),
                DB::raw('MAX(purchases.manufacturer) as manufacturer')
            )
            ->groupBy('products.id', 'products.name', 'products.min_stock_level', 'categories.name')
            ->havingRaw('SUM(purchases.quantity_bought) < products.min_stock_level')
            ->get();
    
        $lowStockCount = $lowStockProducts->count();
        $title = "Stock Alert";
    
        return view('dashboard.reports.low_stock_report', compact(
            'lowStockProducts',
            'lowStockCount',
            'title'
        ));
    }
    
    
}
