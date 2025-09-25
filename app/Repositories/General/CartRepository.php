<?php

namespace App\Repositories\General;

use App\Models\Product;
use App\Models\Order;

class CartRepository
{
    public function getCart()
    {
        return session()->get('cart', []);
    }

    public function getTotal($cart)
    {
        return collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function addToCart($productId)
    {

        $product = Product::findOrFail($productId);
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name'       => $product->name,
                'image' => $product->first_image ? $product->first_image->image_path : 'site/images/default.png',
                'price'      => $product->price,
                'store_id'   => $product->store_id,
                'store_name' => $product->store?->name,
                'quantity'   => 1,
            ];
        }

        session()->put('cart', $cart);

        return $cart;
    }

    public function removeFromCart($productId)
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return $cart;
    }

    public function checkout($request)
    {
        $cart = $this->getCart();

        if (empty($cart)) {
            return null;
        }

        $order = new Order([
            'order_number'   => uniqid('ORD-'),
            'user_id'        => auth()->id(),
            'total'          => $this->getTotal($cart),
            'type'           => 'order',
            'name'           => $request->name ?? auth()->user()->name ?? null,
            'email'          => $request->email ?? auth()->user()->email ?? null,
            'phone'          => $request->phone ?? auth()->user()->phone ?? null,
            'status'         => 'pending',
            'payment_status' => 'pending',
        ]);

        $order->save();

        foreach ($cart as $productId => $item) {
            $order->orderItems()->create([
                'product_id' => $productId,
                'store_id'   => $item['store_id'],
                'name'       => $item['name'],
                'image'      => $item['image'],
                'price'      => $item['price'],
            ]);
        }

        session()->forget('cart');

        return $order;
    }
}
