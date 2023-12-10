<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, Products $product)
    {
        // Validate the request
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Check if the item is already in the cart
        $existingItem = CartItem::where('product_id', $product->id)->first();

        if ($existingItem) {
            // If the item exists, update the quantity
            $existingItem->update(['quantity' => $existingItem->quantity + $request->quantity]);
        } else {
            // If the item doesn't exist, create a new cart item
            CartItem::create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart.');
    }

    public function removeFromCart(CartItem $cartItem)
    {
        // Remove the item from the cart
        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    public function viewCart()
    {
        // Fetch all cart items
        $cartItems = CartItem::with('product')->get();

        return view('cart.view', compact('cartItems'));
    }
}

