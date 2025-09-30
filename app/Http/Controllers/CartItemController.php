<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', auth()->id())
            ->first();

        return response()->json($cart ? $cart->items : []);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
            'session_id' => $request->session()->getId(),
        ]);

        $product = Product::findOrFail($request->product_id);

        $item = CartItem::updateOrCreate(
            [
                'cart_id' => $cart->id,
                'product_id' => $product->id,
            ],
            [
                'quantity' => $request->quantity,
                'price_at_add' => $product->price,
                'discount_at_add' => $product->discount ?? 0,
            ]
        );

        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = CartItem::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item->update([
            'quantity' => $request->quantity,
        ]);

        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item removed']);
    }
}
