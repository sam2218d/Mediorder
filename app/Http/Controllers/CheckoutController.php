<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem; // Needed to save the individual cart items!
use App\Models\Address;

class CheckoutController extends Controller
{
    // This method loads the checkout page
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/products');
        }

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += ((float)$item['price'] * (int)$item['quantity']);
        }

        $shipping = 50;
        $tax = $subtotal * 0.05;
        $total = $subtotal + $shipping + $tax;

          $savedAddresses = collect();
         if (auth()->check()) {
        $savedAddresses = auth()->user()->addresses()->latest()->get();
    } 
        

        return view('checkout.index', compact(
            'savedAddresses',
            'cart',
            'subtotal',
            'shipping',
            'tax',
            'total'
        ));
    }

    // This method handles the form submission
    public function store(Request $request)
    {
        // 1. Validate the incoming user data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'street_address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'total_amount' => 'required|numeric',
            'prescription_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'payment_proof' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'save_address' => 'nullable|boolean',
            'address_label' => 'nullable|string|max:50',
        ]);

        // 2. Create the main Order FIRST
        $order = Order::create([
            // ADD THIS LINE RIGHT HERE 👇
            'user_id' => Auth::id(), 
            
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'street_address' => $validated['street_address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'zip_code' => $validated['zip_code'],
            'total_amount' => $validated['total_amount'],
            'prescription_path' => $request->file('prescription_file')->store('prescriptions', 'public'),
            'payment_proof_path' => $request->file('payment_proof')->store('payments', 'public'),
        ]);

        // 3. Save address for future use if the user is logged in and checked "save address"
        if (auth()->check() && $request->boolean('save_address')) {
            $user = auth()->user();
            
            // Avoid duplicate addresses
            $exists = $user->addresses()
                ->where('street_address', $validated['street_address'])
                ->where('city', $validated['city'])
                ->where('state', $validated['state'])
                ->where('zip_code', $validated['zip_code'])
                ->exists();

            if (!$exists) {
                $label = $request->input('address_label', 'Home');
                
                // If this is the user's first address, make it default
                $isDefault = $user->addresses()->count() === 0;

                $user->addresses()->create([
                    'label' => $label,
                    'street_address' => $validated['street_address'],
                    'city' => $validated['city'],
                    'state' => $validated['state'],
                    'zip_code' => $validated['zip_code'],
                    'is_default' => $isDefault,
                ]);
            }
        }
        

        // 4. Loop through the cart and save EACH item to the order_items table
        $cart = session()->get('cart', []);
        
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id, // Links the item to the order we just created above!
                'item_name' => $item['name'],
                'item_image' => $item['image'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // 5. Clear the cart and redirect
        session()->forget('cart');
        
        return redirect()->route('checkout.success', ['order' => $order->id]);
    }

    // Delete a saved address
    public function deleteAddress($id)
    {
        if (auth()->check()) {
            $address = auth()->user()->addresses()->findOrFail($id);
            $address->delete();
        }

        return back()->with('success', 'Address deleted successfully.');
    }
}