<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order()
    {
        $orders = Order::with('user', 'product')->get();
        return view('admin.order-list', compact('orders'));
    }
    public function updatePermission(Request $request, Order $order)
    {
        // Update permission in database
        $order->update(['permission' => $request->permission]);

        return response()->json(['success' => true]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|string|in:Pending,Processing,Dispatched,Delivered',
        ]);

        $order->order_status = $request->order_status;
        $order->save();
        Notification::create([
            'order_id' => $order->id,
            'message' => "Your order #{$order->order_no} status changed to {$order->order_status}.",
        ]);
        return response()->json(['success' => true]);
    }
    public function updatePaymentStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Payment status updated']);
    }

    public function resumeQtyStatus($id)
    {
        $order = Order::findOrFail($id);
        $product = $order->product;

        if ($product->quantity >= $order->unit) {
            $order->order_qty_status = "resume";   // <---- UPDATE
            $order->permission = "pending";        // optional
            $order->save();

            return response()->json(['message' => 'Order resumed successfully']);
        }

        return response()->json(['message' => 'Stock still insufficient'], 400);
    }
}
