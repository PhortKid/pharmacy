<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Sale;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        
         $title="sales report";
         return 'soon';
       // return view('dashboard.reports.sales_report', compact('salesData', 'topProducts', 'salesChart', 'startDate', 'endDate','title'));
    }
}
