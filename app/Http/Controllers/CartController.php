<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        
        $cart = session()->get('cart', []);
        
        return view('cart.shopingcart', compact('cart')); 
    }

    public function add(Request $request, $id)
    {
        $medicine = Medicine::findOrFail($id);
        $cart = session()->get('cart', []);

        // If item is already in cart, just increase the quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // If item is not in cart, add it with a quantity of 1
            $cart[$id] = [
                "name" => $medicine->name, // Adjust database column names as needed
                "quantity" => 1,
                "price" => $medicine->price,
                "image" => $medicine->image 
            ];
        }

        // Save the updated cart back to the session
        session()->put('cart', $cart);

        // Redirect back to the page with a success message
        return redirect()->back()->with('success', 'Medicine added to cart successfully!');
    }

    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed from cart successfully!');
    }
    // CartController.php

public function addToCart(Request $request)
{
    $productId = $request->input('product_id');
    
    // ... Your logic to save the item to the database or session ...

    // Calculate the new total number of items in the cart
    $totalItems = 5; // Replace this with your actual cart counting logic

    // Return the new count as JSON
    return response()->json([
        'success' => true,
        'total_items' => $totalItems
    ]);
}
}