<?php
namespace App\Controllers;

use App\Models\CartModel;

class Cart extends BaseController
{
    public function cart()
    {
        return view('cart/cart');
    }

    public function checkout()
    {
        return view('cart/checkout');
    }
}
