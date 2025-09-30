<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
    'customer_name' => 'required|string|max:255',
    'customer_email' => 'required|email',
    'shipping_address' => 'required|string',
    'shipping_city' => 'required|string',
    'shipping_province' => 'required|string',
]);
        $cart = Cart::with('items.product')
            ->where('user_id', auth()->id())
            ->orWhere('session_id', $request->session()->getId())
            ->firstOrFail();

        $total = $cart->items->sum(function ($item) {
            return ($item->price_at_add - $item->discount_at_add) * $item->quantity;
        });

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => strtoupper(Str::random(10)),
            'total_amount' => $total,
            'status' => 'pending',
            'payment_status' => 'pending',
            'payment_method' => $request->payment_method,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'shipping_address' => $request->shipping_address,
            'shipping_city' => $request->shipping_city,
            'shipping_province' => $request->shipping_province,
            'shipping_postal_code' => $request->shipping_postal_code,
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->title,
                'product_sku' => $item->product->sku,
                'product_image' => $item->product->image,
                'quantity' => $item->quantity,
                'price_per_unit' => $item->price_at_add,
                'discount_per_unit' => $item->discount_at_add,
            ]);
        }

        // Kosongkan cart
        $cart->items()->delete();
        $cart->delete();

        return redirect('/orders/' . $order->id)
            ->with('success', 'Order berhasil dibuat!');
    }

    public function show(Order $order)
    {
        $order->load('items');
        return view('home.orders.show', compact('order'));
    }

    public function showDashboard($id)
{
    $order = Order::findOrFail($id);
    return view('home.orders.showdashboard', compact('order'));
}


    public function checkoutForm(Request $request)
{
    $cart = Cart::with('items.product')
        ->where('user_id', auth()->id())
        ->orWhere('session_id', $request->session()->getId())
        ->firstOrFail();

        $user = auth()->user();
    return view('home.checkout', compact('cart', 'user'));
}

}
