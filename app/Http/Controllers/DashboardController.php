<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Notification;

use App\Models\Supplier;
use App\Models\SupplierPayment;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;


use App\Models\AuditLog;

class DashboardController extends Controller
{
    public function index()
    {
        $pharmacyId = Auth::user()->pharmacy_id; 
        $notifications = Notification::latest()->limit(5)->get();
        // Count total products
        $totalProducts = Product::count();

        // Count expired products
        $expiredCount = Purchase::whereDate('expiry_date', '<', now())
            ->count();

        // Count products expiring in 7 days
        $expiringSoonCount = Purchase::whereBetween('expire_date', [now(), now()->addDays(7)])
        ->count();

        $totalSalesLast30Days = Sale::where('created_at', '>=', now()->subDays(30))
    ->sum('total_price');


    $stockByCategory = DB::table('categories')
    ->join('products', 'categories.id', '=', 'products.category_id')
    ->join('purchases', 'products.id', '=', 'purchases.product_id')
    ->leftJoin('sales', 'purchases.id', '=', 'sales.purchase_id')
    ->select(
        'categories.name as category',
        DB::raw('SUM(purchases.quantity_bought) - SUM(COALESCE(sales.quantity_sold, 0)) as total_stock')
    )
    ->groupBy('categories.name')
    ->get();


    

   

           
           $title="dashboard";
           $daa=1;

           return view('dashboard.index', compact(
            'totalProducts',
            'expiredCount',
            'expiringSoonCount',
            'totalSalesLast30Days',
            'stockByCategory',
            'title',
            'daa'
        ));
    }

   

public function auditLogs()
{
    $logs = AuditLog::with('user')->latest()->paginate(10);
    $title="audit log";
    return view('dashboard.audit_logs', compact('logs','title'));
}
}
