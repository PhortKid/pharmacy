<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; // Hakikisha una model ya Notification

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()->limit(5)->get();
        return view('dashboard.index', compact('notifications'));
    } 
}
