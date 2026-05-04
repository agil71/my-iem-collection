<?php

namespace App\View\Composers;

use App\Services\CartService;
use Illuminate\View\View;

class CartItemsComposer
{
    public function __construct(private CartService $cart) {}

    public function compose(View $view): void
    {
        $view->with('cartItems', $this->cart->getCart());
    }
}