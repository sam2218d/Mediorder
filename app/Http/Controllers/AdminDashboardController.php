<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Medicine;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function getDashboard()
    {
        // 1. Count today's orders using Laravel's today() helper
        $totalOrdersToday = Order::whereDate('created_at', today())->count();

        // 2. Add up the total_amount column for all non-cancelled orders
        $totalRevenue = Order::where('status', '!=', 'Cancelled')->sum('total_amount');

        $lowstock = Medicine::where('stock', '<', 11)->count();
        $firstname = Order::where('first_name', '!=', null)->count();
        $lastname = Order::where('last_name', '!=', null)->count();

        // 4. Get the 10 newest orders for the table
        $recentOrders = Order::orderBy('created_at', 'desc')->take(10)->get();
        $latestDate = Order::latest('created_at')->value('created_at');
        $lastupdated = $latestDate ? $latestDate->diffForHumans() : 'No orders yet';

        // 5. Send everything back to the frontend
        return view('admin.dashboard', compact('totalOrdersToday', 'totalRevenue', 'lowstock', 'recentOrders', 'firstname', 'lastname', 'lastupdated'   ));
    }


}

