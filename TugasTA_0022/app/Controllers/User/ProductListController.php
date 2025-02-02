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
     * Menampilkan daftar produk dengan filter
     * URL: GET /user/product-list
     */
    public function index()
    {
        // Ambil semua kategori
        $data['categories'] = $this->categoryModel->findAll();

        // Ambil parameter query string untuk filter
        $categoryId = $this->request->getGet('category');
        $priceMin = $this->request->getGet('price_min');
        $priceMax = $this->request->getGet('price_max');
        $searchTerm = $this->request->getGet('search');

        // Logika filter untuk produk
        $builder = $this->productModel->builder();

        if ($categoryId && is_numeric($categoryId)) {
            $builder->where('id_kategori', $categoryId);
            $data['selectedCategory'] = $categoryId;
        } else {
            $data['selectedCategory'] = null;
        }

        if ($priceMin && is_numeric($priceMin)) {
            $builder->where('harga >=', $priceMin);
            $data['priceMin'] = $priceMin;
        } else {
            $data['priceMin'] = null;
        }

        if ($priceMax && is_numeric($priceMax)) {
            $builder->where('harga <=', $priceMax);
            $data['priceMax'] = $priceMax;
        } else {
            $data['priceMax'] = null;
        }

        if ($searchTerm) {
            $builder->like('nama_produk', $searchTerm);
            $data['searchTerm'] = $searchTerm;
        } else {
            $data['searchTerm'] = null;
        }

        // Ambil hasil produk setelah filter diterapkan
        $data['products'] = $builder->get()->getResultArray();

        // Menampilkan data produk ke view
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
