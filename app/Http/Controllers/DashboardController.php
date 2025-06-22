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
        $expiringSoonCount = Product::whereBetween('expiry_date', [now(), now()->addDays(7)])
            ->count();

   

           
           $title="dashboard";
           $daa=1;

        return view('dashboard.index', compact(
            'totalProducts', 'expiredCount', 'expiringSoonCount', 
           'title','daa'
        ));
    }

   

public function auditLogs()
{
    $logs = AuditLog::with('user')->latest()->paginate(10);
    $title="audit log";
    return view('dashboard.audit_logs', compact('logs','title'));
}
}
