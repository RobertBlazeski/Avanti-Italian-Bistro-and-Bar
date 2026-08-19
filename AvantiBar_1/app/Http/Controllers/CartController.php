<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cartItems()->with('dish')->get();
        $total = $cartItems->sum(function($item) {
            return $item->dish->price * $item->quantity;
        });
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add($dishId)
    {
        $cartItem = CartItem::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'dish_id' => $dishId
            ],
            ['quantity' => 0]
        );

        $cartItem->increment('quantity');

        $cartCount = auth()->user()->cartItems()->sum('quantity');

        return response()->json([
            'success' => true,
            'cartCount' => $cartCount
        ]);
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        
        $cartItem->update(['quantity' => $request->quantity]);
        
        return response()->json([
            'success' => true,
            'total' => $cartItem->dish->price * $cartItem->quantity,
            'cartCount' => auth()->user()->cartItems()->sum('quantity')
        ]);
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
        
        return back()->with('success', 'Item removed from cart');
    }
}