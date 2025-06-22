<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalesReportController extends Controller
{

  
    public function index(Request $request)
    {
        $startDate = $request->start_date ?? Carbon::now()->startOfMonth()->toDateString();
        $endDate = $request->end_date ?? Carbon::now()->endOfMonth()->toDateString();

        // Total sales & revenue
        $salesData = DB::table('sales')
            ->join('purchases', 'sales.purchase_id', '=', 'purchases.id')
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->selectRaw('SUM(sales.quantity_sold) as total_sold, SUM(sales.total_price) as total_revenue')
            ->first();

        // Top selling products
        $topProducts = DB::table('sales')
            ->join('purchases', 'sales.purchase_id', '=', 'purchases.id')
            ->join('products', 'purchases.product_id', '=', 'products.id')
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->select('products.name', DB::raw('SUM(sales.quantity_sold) as total_sold'))
            ->groupBy('products.name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        // Sales & revenue chart data by date
        $salesChart = DB::table('sales')
            ->join('purchases', 'sales.purchase_id', '=', 'purchases.id')
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->selectRaw('DATE(sales.created_at) as date, SUM(sales.quantity_sold) as total_sold, SUM(sales.total_price) as total_revenue')
            ->groupBy(DB::raw('DATE(sales.created_at)'))
            ->orderBy('date')
            ->get();

        $title = "Sales Report";

        return view('dashboard.reports.sales_report', compact(
            'salesData',
            'topProducts',
            'salesChart',
            'startDate',
            'endDate',
            'title'
        ));
    }

    
  

}
