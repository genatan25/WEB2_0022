<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductDetailsModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class ProductDetails extends BaseController
{
    protected $productDetailsModel;
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productDetailsModel = new ProductDetailsModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $productDetails = $this->productDetailsModel->getAllDetails();
        $products = $this->productModel->findAll();
        $categories = $this->categoryModel->findAll();

        $data = [
            'products'       => $products,
            'productDetails' => $productDetails,
            'categories'     => $categories,
            'adminName'      => session()->get('adminName') ?? 'Admin',
        ];

        return view('admin/manage_product_details', $data);
    }

    public function add()
    {
        if ($this->request->getMethod() !== 'POST') {
            return redirect()->back()->with('error', 'Metode HTTP tidak diperbolehkan.');
        }

        $rules = [
            'id_produk' => 'required|integer',
            'key'       => 'required|string|max_length[100]',
            'value'     => 'required|string',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $id_produk = $this->request->getPost('id_produk');
        if (!$this->productModel->find($id_produk)) {
            return redirect()->back()->withInput()->with('error', 'Produk dengan ID tersebut tidak ditemukan.');
        }

        $data = [
            'id_produk' => $id_produk,
            'key'       => $this->request->getPost('key'),
            'value'     => $this->request->getPost('value'),
        ];

        if ($this->productDetailsModel->addDetail($data)) {
            return redirect()->to('/admin/productDetails')->with('success', 'Detail produk berhasil ditambahkan.');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan detail produk. Mungkin duplikat data.');
    }

    public function edit()
    {
        if ($this->request->getMethod() !== 'POST') {
            return redirect()->back()->with('error', 'Metode HTTP tidak diperbolehkan.');
        }

        $rules = [
            'id_detail' => 'required|integer',
            'key'       => 'required|string|max_length[100]',
            'value'     => 'required|string',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $id_detail = $this->request->getPost('id_detail');
        $detail = $this->productDetailsModel->find($id_detail);
        if (!$detail) {
            return redirect()->back()->with('error', 'Detail produk tidak ditemukan.');
        }

        $data = [
            'key'   => $this->request->getPost('key'),
            'value' => $this->request->getPost('value'),
        ];

        if ($this->productDetailsModel->updateDetail($id_detail, $data)) {
            return redirect()->to('/admin/productDetails')->with('success', 'Detail produk berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui detail produk. Mungkin duplikat data.');
    }

    public function delete($id_detail = null)
    {
        if (!$id_detail || !is_numeric($id_detail)) {
            return redirect()->back()->with('error', 'ID detail produk tidak valid.');
        }

        $detail = $this->productDetailsModel->find($id_detail);
        if (!$detail) {
            return redirect()->back()->with('error', 'Detail produk tidak ditemukan.');
        }

        if ($this->productDetailsModel->deleteDetail($id_detail)) {
            return redirect()->to('/admin/productDetails')->with('success', 'Detail produk berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Gagal menghapus detail produk.');
    }
}
