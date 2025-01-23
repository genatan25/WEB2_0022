<?php
// app/Controllers/User/ProductListController.php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\ProductuserModel;
use App\Models\CategoryModel;

class ProductListController extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        // Inisialisasi model yang akan digunakan
        $this->productModel = new ProductuserModel();
        $this->categoryModel = new CategoryModel();

        // Memuat helper yang diperlukan
        helper(['url', 'form', 'text']);
    }

    /**
     * Menampilkan daftar produk
     * URL: GET /user/product-list
     */
    public function index()
    {
        // Mengambil semua kategori
        $data['categories'] = $this->categoryModel->findAll();

        // Mengambil produk berdasarkan kategori jika filter diterapkan
        $categoryId = $this->request->getGet('category');
        if ($categoryId && is_numeric($categoryId)) {
            $data['products'] = $this->productModel->getProductsByCategory($categoryId);
            $data['selectedCategory'] = $categoryId;
        } else {
            $data['products'] = $this->productModel->getAllProducts();
            $data['selectedCategory'] = null;
        }

        // Memuat view dengan data yang telah disiapkan
        return view('user/product_list', $data);
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
