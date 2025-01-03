<?php

namespace App\Controllers;

use App\Models\ProductModel;

class User extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel(); // Inisialisasi model produk
    }

    // Menampilkan halaman utama pengguna
    public function home()
    {
        return view('user/home');
    }

    // Menampilkan daftar produk
    public function productList()
    {
        $data['products'] = $this->productModel->findAll(); // Mengambil semua data produk
        return view('user/product_list', $data);
    }
}
