<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;

class CheckoutController extends Controller
{
    public function index()
    {
        // Check if user is logged in and has 'user' role
        if (Auth::user()->role !== 'user') {
            return redirect()->route('main-dishes')->with('error', 'Unauthorized access');
        }

        $cartItems = CartItem::where('user_id', Auth::id())->with('dish')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('main-dishes')->with('error', 'Your cart is empty');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->dish->price * $item->quantity;
        });

        return view('checkout.index', [
            'cartItems' => $cartItems,
            'total' => $total,
            'deliveryFee' => 5.00
        ]);
    }

    public function processCheckout(Request $request)
{
    // Check if user is logged in and has 'user' role
    if (Auth::user()->role !== 'user') {
        return redirect()->route('main-dishes')->with('error', 'Unauthorized access');
    }

    // Add more detailed validation
    $validator = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:500'
    ]);

    $cartItems = CartItem::where('user_id', Auth::id())->with('dish')->get();
    
    if ($cartItems->isEmpty()) {
        return redirect()->route('main-dishes')->with('error', 'Your cart is empty');
    }

    $total = $cartItems->sum(function ($item) {
        return $item->dish->price * $item->quantity;
    }) + 5.00; // Include delivery fee

    DB::beginTransaction();
    try {
        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'delivery_fee' => 5.00,
            'status' => 'pending',
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'payment_method' => 'cash'
        ]);

        // Create order items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'dish_id' => $cartItem->dish_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->dish->price
            ]);
        }

        // Clear the cart
        CartItem::where('user_id', Auth::id())->delete();

        DB::commit();

        // Add logging or dd() to debug
        \Log::info('Order created successfully', [
            'order_id' => $order->id,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('checkout.success')
            ->with('order_id', $order->id);
    } catch (\Exception $e) {
        DB::rollBack();
        
        // Log the full error
        \Log::error('Order processing failed', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return back()
            ->withInput()
            ->with('error', 'Order processing failed: ' . $e->getMessage());
    }
}

    public function success()
    {
        // Check if user is logged in and has 'user' role
        if (Auth::user()->role !== 'user') {
            return redirect()->route('main-dishes')->with('error', 'Unauthorized access');
        }

        $orderId = session('order_id');
        if (!$orderId) {
            return redirect()->route('main-dishes');
        }

        $order = Order::findOrFail($orderId);
        return view('checkout.success', compact('order'));
    }
}