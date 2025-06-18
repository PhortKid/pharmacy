<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExpiryReportController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Counting statistics
        $totalProducts = DB::table('products')->count();
        $expiredCount = DB::table('products')->whereDate('expiry_date', '<', $today)->count();
        $expiringSoonCount = DB::table('products')
            ->whereDate('expiry_date', '>=', $today)
            ->whereDate('expiry_date', '<=', $today->addDays(7))
            ->count();

        // Expired Products
        $expiredProducts = DB::table('products')
            ->whereDate('expiry_date', '<', $today)
            ->select('name', 'expiry_date')
            ->get();

        // Expiring Soon (Products expiring within 30 days)
        $expiringProducts = DB::table('products')
            ->select('name', 'expiry_date', 
                DB::raw("DATEDIFF(expiry_date, CURDATE()) as days_remaining"))
            ->whereDate('expiry_date', '>=', Carbon::today())
            ->orderBy('expiry_date', 'asc')
            ->get();
       $title="";
        return view('dashboard.reports.expiry_report', compact(
            'totalProducts', 'expiredCount', 'expiringSoonCount', 
            'expiredProducts', 'expiringProducts','title'
        ));
    }
}
