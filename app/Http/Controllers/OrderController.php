<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
   public function index(Request $request)
    {
        // Start a query
        $query = Order::query();

        // Optional: Add simple search functionality
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('id', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('item_name', 'like', "%{$search}%");
                  
        }

        // Optional: Add status filtering
        if ($request->has('status') && $request->get('status') != '') {
            $query->where('status', $request->get('status'));
        }

        // Fetch orders, latest first, and paginate them (10 per page)
        $orders = $query->latest()->paginate(10);

        // Calculate some basic stats for the top cards (optional but helpful)
        $todayOrdersCount = Order::whereDate('created_at', today())->count();
        $pendingPrescriptionsCount = Order::where('status', 'pending')->whereNotNull('prescription_path')->count();

        // Return the view and pass the data
        return view('orders.index', compact('orders', 'todayOrdersCount', 'pendingPrescriptionsCount'));
    }

    /**
     * Display the specified order details.
     */
    public function show(Order $order)
    {
        // The Route Model Binding (Order $order) automatically fetches the correct order from the DB based on the ID in the URL.
        
        return view('orders.show', compact('order'));
    }

    /**
     * Update the status of the specified order.
     */
    public function updateStatus(Request $request, Order $order)
    {
        // 1. Validate the incoming status
        $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled'
        ]);

        // 2. Update the order in the database
        $order->update([
            'status' => $request->status
        ]);

        // 3. Redirect back to the page with a success message
        return back()->with('success', 'Order status has been updated successfully!');
    }
}
