<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExpiryReportController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Count total products
        $totalProducts = DB::table('products')->count();

        // Count expired products based on purchases
        $expiredCount = DB::table('purchases')
            ->whereDate('expire_date', '<', $today)
            ->count();

        // Count expiring soon (within 7 days)
        $expiringSoonCount = DB::table('purchases')
            ->whereDate('expire_date', '>=', $today)
            ->whereDate('expire_date', '<=', $today->copy()->addDays(7))
            ->count();

        // Get expired product list
        $expiredProducts = DB::table('purchases')
            ->join('products', 'purchases.product_id', '=', 'products.id')
            ->whereDate('expire_date', '<', $today)
            ->select('products.name', 'purchases.expire_date')
            ->get();

            $expiringProducts = DB::table('purchases')
            ->join('products', 'purchases.product_id', '=', 'products.id')
            ->whereDate('expire_date', '>=', $today)
            ->whereDate('expire_date', '<=', $today->copy()->addDays(30))
            ->select('products.name', 'purchases.expire_date')
            ->orderBy('expire_date', 'asc')
            ->get();
        
        // Add days_remaining manually using Carbon
        $expiringProducts = $expiringProducts->map(function ($product) use ($today) {
            $product->days_remaining = Carbon::parse($product->expire_date)->diffInDays($today);
            return $product;
        });
        

        $title = "";

        return view('dashboard.reports.expiry_report', compact(
            'totalProducts', 'expiredCount', 'expiringSoonCount',
            'expiredProducts', 'expiringProducts', 'title'
        ));
    }
}
