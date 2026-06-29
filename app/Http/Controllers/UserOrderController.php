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
        // Grab ONLY the orders belonging to the logged-in user
        $orders = Order::where('email', Auth::user()->email)
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
        
        // Security check: Make sure the logged-in user actually owns this order!
        if ($order->email !== Auth::user()->email) {
            abort(403, 'Unauthorized action.');
        }

        return view('myorders.track', compact('order'));
    }
}