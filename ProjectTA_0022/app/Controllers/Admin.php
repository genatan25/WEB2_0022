<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\Files\UploadedFile;

class Admin extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $validation;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->validation = \Config\Services::validation();
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'totalProducts' => $this->productModel->countAll(),
            'totalCategories' => $this->categoryModel->countAll(),
        ];
        return view('admin/dashboard', $data);
    }

    public function manageProducts()
    {
        $data = [
            'title' => 'Kelola Produk',
            'products' => $this->productModel->getWithCategory(),
            'categories' => $this->categoryModel->findAll()
        ];
        return view('admin/manage_products', $data);
    }

    public function manageCategories()
    {
        $data = [
            'title' => 'Kelola Kategori',
            'categories' => $this->categoryModel->getAllWithProducts()
        ];
        return view('admin/kategori_products', $data);
    }

    public function addProduct()
{
    $rules = [
        'nama_produk' => 'required|min_length[3]|max_length[100]',
        'deskripsi' => 'required|min_length[10]',
        'harga' => 'required|numeric|greater_than[0]',
        'stok' => 'required|integer|greater_than_equal_to[0]',
        'id_kategori' => 'required|integer',
        'gambar' => 'uploaded[gambar]|is_image[gambar]|max_size[gambar,2048]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()
            ->with('error', $this->validator->getErrors())
            ->withInput();
    }

    $img = $this->request->getFile('gambar');
    $newName = $img->getRandomName();

    try {
        if ($img->isValid() && !$img->hasMoved()) {
            $img->move(WRITEPATH . 'uploads/products', $newName);
        }

        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'gambar' => $newName
        ];

        $this->productModel->insert($data);
        return redirect()->to('/admin/manage-products')->with('success', 'Produk berhasil ditambahkan');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Gagal menambahkan produk: ' . $e->getMessage())
            ->withInput();
    }
}

public function editProduct($id = null)
{
    if ($id === null) {
        return redirect()->back()->with('error', 'ID Produk tidak ditemukan');
    }

    $rules = [
        'nama_produk' => 'required|min_length[3]|max_length[100]',
        'deskripsi' => 'required|min_length[10]',
        'harga' => 'required|numeric|greater_than[0]',
        'stok' => 'required|integer|greater_than_equal_to[0]',
        'id_kategori' => 'required|integer',
        'gambar' => 'if_exist|is_image[gambar]|max_size[gambar,2048]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()
            ->with('error', $this->validator->getErrors())
            ->withInput();
    }

    $data = [
        'nama_produk' => $this->request->getPost('nama_produk'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'harga' => $this->request->getPost('harga'),
        'stok' => $this->request->getPost('stok'),
        'id_kategori' => $this->request->getPost('id_kategori')
    ];

    $img = $this->request->getFile('gambar');

    try {
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $product = $this->productModel->find($id);
            if ($product && !empty($product['gambar'])) {
                $oldImagePath = WRITEPATH . 'uploads/products/' . $product['gambar'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $newName = $img->getRandomName();
            $img->move(WRITEPATH . 'uploads/products', $newName);
            $data['gambar'] = $newName;
        }

        $this->productModel->update($id, $data);
        return redirect()->to('/admin/manage-products')->with('success', 'Produk berhasil diperbarui');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Gagal memperbarui produk: ' . $e->getMessage())
            ->withInput();
    }
}

public function deleteProduct($id = null)
{
    if ($id === null) {
        return redirect()->back()->with('error', 'ID Produk tidak ditemukan');
    }

    try {
        $product = $this->productModel->find($id);
        if ($product && !empty($product['gambar'])) {
            $imagePath = WRITEPATH . 'uploads/products/' . $product['gambar'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $this->productModel->delete($id);
        return redirect()->to('/admin/manage-products')->with('success', 'Produk berhasil dihapus');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
    }
}

    public function deleteCategory($id = null)
    {
        if ($id === null) {
            return redirect()->back()->with('error', 'ID Kategori tidak ditemukan');
        }

        $result = $this->categoryModel->deleteWithValidation($id);
        if ($result['success']) {
            return redirect()->to('/admin/manage-categories')->with('success', $result['message']);
        }

        return redirect()->back()->with('error', $result['message']);
    }
}
