<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    private const CART_KEY = 'cart';

    public function getCart(): array
    {
        return Session::get(self::CART_KEY, []);
    }

    public function add(Product $product, int $qty = 1): array
    {
        $cart = $this->getCart();
        $id = (string) $product->id;

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += $qty;
        } else {
            $cart[$id] = [
                'product_id' => $product->id,
                'title'      => $product->title,
                'price'      => $product->price,
                'image'      => $product->image,
                'stock'      => $product->stock,
                'qty'        => $qty,
            ];
        }

        Session::put(self::CART_KEY, $cart);
        return $cart;
    }

    public function remove(string $productId): array
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        Session::put(self::CART_KEY, $cart);
        return $cart;
    }

    public function update(string $productId, int $qty): array
    {
        $cart = $this->getCart();
        if (isset($cart[$productId])) {
            if ($qty <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['qty'] = min($qty, $cart[$productId]['stock']);
            }
        }
        Session::put(self::CART_KEY, $cart);
        return $cart;
    }

    public function clear(): array
    {
        Session::forget(self::CART_KEY);
        return [];
    }

    public function count(): int
    {
        return array_sum(array_column($this->getCart(), 'qty'));
    }

    public function total(): int
    {
        $cart = $this->getCart();
        return array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['qty']), 0);
    }

    public function items(): array
    {
        return array_values($this->getCart());
    }
}