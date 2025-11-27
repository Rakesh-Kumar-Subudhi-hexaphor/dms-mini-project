<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function productView()
    {
        $products = Product::all();
        return view('user.product', compact('products'));
    }
    public function store(Request $request)
    {
        $stock = Stock::where('product_id', $request->product_id)->first();

        if (!$stock) {
            return back()->with('error', 'Stock not found for this product.');
        }

        // Default order values
        $orderQtyStatus = "resume";
        $status = $request->status;
        $paymentMethod = $request->payment_method;
        $permission = "pending";

        if ($stock->quantity < $request->unit) {
            $orderQtyStatus = "hold";
            $permission = "hold";
            $paymentMethod = "cod";
            $status = "unpaid";
        }

        $lastOrder = Order::orderBy('id', 'desc')->first();

        $nextNumber = $lastOrder ? $lastOrder->id + 1 : 1;

        $orderNo = 'ORD-' . str_pad($nextNumber, 10, '0', STR_PAD_LEFT);
        $order = Order::create([
            'order_no'   => $orderNo,
            'user_id'    => auth()->id(),
            'product_id' => $request->product_id,
            'unit'       => $request->unit,
            'price'      => $request->price,
            'payment_method'      => $request->payment_method,
            'permission' => 'pending',
            'order_qty_status'  => $orderQtyStatus,
            'status'     => $request->status,
        ]);


        // // 2. If payment is online → save to payments table
        // if ($request->payment_method === 'online') {

        //     Payment::create([
        //         'order_id'   => $order->id,
        //         'user_id'    => auth()->id(),
        //         'payment_id' => $request->razorpay_payment_id,
        //         'amount'     => $request->price,
        //         'method'     => 'razorpay',
        //         'status'     => 'success'
        //     ]);
        // }
        if ($orderQtyStatus == "resume") {
            $stock->quantity = $stock->quantity - $request->unit;
            $stock->save();
        }

        return back()->with('success', $orderQtyStatus === "hold"
            ? 'Order placed but on HOLD due to insufficient stock!'
            : 'Order placed successfully!');
    }


    public function orderList()
    {
        // Get only orders for the currently logged-in user
        $orders = Order::where('user_id', Auth::id())->get();

        return view('user.order-list', compact('orders'));
    }
}
