<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockReportController extends Controller
{
    public function index(Request $request)
    {
       
      
       $title="report";
       return 'soon';
        //return view('dashboard.reports.stock_report', compact('purchasedStock', 'sales', 'profitLoss','title'));
    }
}    
