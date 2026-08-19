<?php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function index()
    {
        //show most recent orders first
        $orders = Order::with('orderItems.dish', 'user')->latest()->get();

        // Count new orders
        $newOrdersCount = Order::where('viewed', false)->count();
        //update checked timestamp
        auth()->user()->update(['last_orders_check' => now()]);

        return view('owner.orders.index', compact('orders', 'newOrdersCount'));
    }

    public function getNewOrdersCount()
{
    try {
        $lastCheck = Auth::user()->last_orders_check ?? now()->subYears(10);
        
        $count = Order::where('created_at', '>', $lastCheck)
                     ->where('status', 'pending')
                     ->count();
        
        return response()->json(['count' => $count]);
    } catch (\Exception $e) {
        \Log::error('Order count error: ' . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

   

    public function updateStatus(Request $request, Order $order)
    {
        // Validate
        $request->validate([
            'status' => 'required|in:pending,completed',
        ]);

        // Update orders status
        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Order status updated successfully!'], 200);
    }
}

