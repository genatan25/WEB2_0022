<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class CategoryController extends BaseController
{
    protected $categoryModel;
    protected $productModel;
    protected $validation;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->productModel  = new ProductModel();
        $this->validation    = \Config\Services::validation();
        helper(['form', 'url']);
    }

    /**
     * Menampilkan daftar kategori
     * URL: GET /admin/manageCategories
     */
    public function index()
    {
        // Cek apakah admin sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Mendapatkan semua kategori dengan jumlah produk
        $categories = $this->categoryModel->getAllWithProducts();

        // Ambil data admin dari session
        $adminName   = session()->get('nama_lengkap') ?? 'Admin';
        $initials    = $this->getInitials($adminName);
        $colorClass  = session()->get('profile_color') ?? 'bg-secondary';

        // Kirim data ke view
        $data = [
            'adminName'   => esc($adminName),
            'initials'    => esc($initials),
            'colorClass'  => esc($colorClass),
            'categories'  => $categories,
        ];

        // Memuat view
        return view('admin/manage_categories', $data);
    }

    /**
     * Menambahkan kategori baru (CREATE)
     * URL: POST /admin/categories/add
     */
    public function addCategory()
    {
        // Aturan validasi
        $rules = [
            'nama_kategori' => 'required|min_length[3]|max_length[50]|is_unique[categories.nama_kategori]'
        ];

        // Validasi input
        if (!$this->validate($rules)) {
            return redirect()->back()
                             ->with('error', $this->validator->getErrors())
                             ->withInput();
        }

        try {
            // Menyisipkan data
            $this->categoryModel->insert([
                'nama_kategori' => $this->request->getPost('nama_kategori')
            ]);

            return redirect()
                ->to('/admin/manageCategories')
                ->with('success', 'Kategori berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan kategori: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Mengedit kategori (UPDATE)
     * URL: POST /admin/categories/edit
     */
    public function editCategory()
    {
        $id_kategori = $this->request->getPost('id_kategori');
        if (empty($id_kategori)) {
            return redirect()->back()->with('error', 'ID Kategori tidak ditemukan.');
        }

        // Mendapatkan kategori yang ada
        $category = $this->categoryModel->find($id_kategori);
        if (!$category) {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
        }

        // Aturan validasi
        $rules = [
            'nama_kategori' => 'required|min_length[3]|max_length[50]|is_unique[categories.nama_kategori,id_kategori,' . $id_kategori . ']'
        ];

        // Validasi input
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('error', $this->validator->getErrors())
                ->withInput();
        }

        try {
            // Memperbarui data
            $this->categoryModel->update($id_kategori, [
                'nama_kategori' => $this->request->getPost('nama_kategori')
            ]);

            return redirect()
                ->to('/admin/manageCategories')
                ->with('success', 'Kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui kategori: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Menghapus kategori (DELETE)
     * URL: GET /admin/categories/delete/(:num)
     *
     * @param int $id_kategori
     */
    public function deleteCategory($id_kategori = null)
    {
        if (!$id_kategori) {
            return redirect()->back()->with('error', 'ID Kategori tidak ditemukan.');
        }

        try {
            // Memeriksa apakah kategori memiliki produk terkait
            $count = $this->productModel->where('id_kategori', $id_kategori)->countAllResults();

            if ($count > 0) {
                return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk terkait.');
            }

            // Menghapus kategori
            $deleted = $this->categoryModel->delete($id_kategori);

            if ($deleted) {
                return redirect()
                    ->to('/admin/manageCategories')
                    ->with('success', 'Kategori berhasil dihapus.');
            } else {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kategori.');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }

    /**
     * Mendapatkan inisial dari nama admin
     *
     * @param string $nama
     * @return string
     */
    private function getInitials(string $nama): string
    {
        $initials = '';
        $names = explode(' ', $nama);
        foreach ($names as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        return $initials;
    }
}
