<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class UserOrderController extends Controller
{
    // Loads the main "My Orders" list page
    public function index()
    {
        // 🛠️ FIX: Grab orders using 'user_id' instead of 'email'
        $orders = Order::where('user_id', Auth::id())
                       ->with('items') 
                       ->latest()
                       ->get();

        return view('myorders.index', compact('orders'));
    }

    // Loads the individual "Track Order" page
    public function track($id)
    {
        // Find the specific order and load its items
        $order = Order::with('items')->findOrFail($id);
        
        // 🛠️ FIX: Security check now verifies the user_id matches
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('myorders.track', compact('order'));
    }
}