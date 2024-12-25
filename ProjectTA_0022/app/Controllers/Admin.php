<?php
namespace App\Controllers;

class Admin extends BaseController
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function manageProducts()
    {
        return view('admin/manage_products');
    }
}
