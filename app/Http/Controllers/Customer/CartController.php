<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);

        $cart = session('cart', []);
        $cart[$productId] = [
            'name' => $product->product_name,
            'price' => $product->discounted_price ?? $product->regular_price,
            'quantity' => ($cart[$productId]['quantity'] ?? 0) + 1,
            'image' => $product->images->where('its_primary', 1)->first()?->img_path ?? $product->images->first()?->img_path ?? null,
        ];
        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function index()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('customer.cart.cart', compact('cart', 'total'));
    }

    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cart = session('cart', []);
        if (isset($cart[$productId]) && $quantity > 0) {
            $cart[$productId]['quantity'] = $quantity;
            session(['cart' => $cart]);
        }

        return redirect()->route('customer.cart')->with('success', 'Cart updated!');
    }

    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }

        return redirect()->route('customer.cart')->with('success', 'Item removed from cart!');
    }
}
