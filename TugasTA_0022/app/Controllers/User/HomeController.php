<?php
// app/Controllers/User/HomeController.php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\ProductuserModel;
use App\Models\ProductModel;

class HomeController extends BaseController
{
    protected $productUserModel;
    protected $productModel;

    public function __construct()
    {
        $this->productUserModel = new ProductuserModel();
        $this->productModel = new ProductModel();
    }

    /**
     * Menampilkan halaman beranda
     * URL: GET /user/
     */
    public function index()
    {
        // Mengambil 6 produk terbaru
        $latestProducts = $this->productUserModel->getLatestProducts(6);

        // Menyiapkan data view
        $data = [
            'latestProducts' => $latestProducts,
        ];

        // Memuat view
        return view('user/home', $data);
    }

    /**
     * Menampilkan detail produk
     * URL: GET /user/product-detail/{id}
     */
    public function productDetail($productId)
    {
        // Mencari produk berdasarkan ID dengan detailnya
        $product = $this->productModel
            ->select('products.*, GROUP_CONCAT(CONCAT(product_details.key, ":", product_details.value) SEPARATOR ",") as details')
            ->join('product_details', 'product_details.id_produk = products.id_produk', 'left')
            ->where('products.id_produk', $productId)
            ->groupBy('products.id_produk')
            ->first();

        // Jika produk tidak ditemukan
        if (!$product) {
            return redirect()->to('/user/product-list')->with('error', 'Produk tidak ditemukan');
        }

        // Menyiapkan data view
        return view('user/product_detail', [
            'product' => $product,
            'details' => explode(",", $product['details']),
        ]);
    }
}
