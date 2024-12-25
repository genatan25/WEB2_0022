<?php
namespace App\Controllers;

class User extends BaseController
{
    public function home()
    {
        return view('user/home');
    }

    public function productList()
    {
        return view('user/product_list');
    }
}
