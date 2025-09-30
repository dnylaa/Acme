<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);

        return response()->json($order->items);
    }

    public function show($id)
    {
        $item = OrderItem::findOrFail($id);

        return response()->json($item);
    }

    // optional, kalau kamu mau update item di order (jarang dipakai)
    public function update(Request $request, $id)
    {
        $item = OrderItem::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1',
            'price_per_unit' => 'required|numeric|min:0',
        ]);

        $item->update([
            'quantity' => $request->quantity,
            'price_per_unit' => $request->price_per_unit,
        ]);

        return response()->json($item);
    }

    // optional, hapus item dari order (jarang dipakai)
    public function destroy($id)
    {
        $item = OrderItem::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Order item removed']);
    }
}
