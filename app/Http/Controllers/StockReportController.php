<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StockReportController extends Controller
{
    public function index(Request $request)
    {
        $pharmacy_id = Auth::user()->pharmacy_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        // Filter by date range if available
        $purchaseQuery = DB::table('purchases')
            ->join('products', 'purchases.product_id', '=', 'products.id')
            ->select(
                'products.name as product_name',
                DB::raw('SUM(purchases.quantity_bought) as total_purchased'),
                DB::raw('SUM(purchases.quantity_bought * purchases.unit_price) as total_cost')
            )
            ->groupBy('products.name');

        $salesQuery = DB::table('sales')
            ->join('purchases', 'sales.purchase_id', '=', 'purchases.id')
            ->join('products', 'purchases.product_id', '=', 'products.id')
            ->select(
                'products.name as product_name',
                DB::raw('SUM(sales.quantity_sold) as total_sold'),
                DB::raw('SUM(sales.total_price) as total_sales')
            )
            ->groupBy('products.name');

        $profitLossQuery = DB::table('sales')
            ->join('purchases', 'sales.purchase_id', '=', 'purchases.id')
            ->join('products', 'purchases.product_id', '=', 'products.id')
            ->select(
                'products.name as product_name',
                DB::raw('SUM(purchases.quantity_bought) as total_purchased'),
                DB::raw('SUM(sales.quantity_sold) as total_sold'),
                DB::raw('SUM((sales.total_price - (sales.quantity_sold * purchases.unit_price))) as profit_loss')
            )
            ->groupBy('products.name');

        // Apply date filters if set
        if ($start_date && $end_date) {
            $purchaseQuery->whereBetween('purchases.date_of_purchase', [$start_date, $end_date]);
            $salesQuery->whereBetween('sales.created_at', [$start_date, $end_date]);
            $profitLossQuery->whereBetween('sales.created_at', [$start_date, $end_date]);
        }

        $purchasedStock = $purchaseQuery->get();
        $sales = $salesQuery->get();
        $profitLoss = $profitLossQuery->get();

        $title = "Stock Report";

        return view('dashboard.reports.stock_report', compact(
            'purchasedStock',
            'sales',
            'profitLoss',
            'title'
        ));
    }
}
