<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\AdminModel;

class Admin extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $adminModel;
    protected $session;

    public function __construct()
    {
        $this->productModel  = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->adminModel    = new AdminModel();
        $this->session       = session();
    }

    /**
     * Mendapatkan informasi admin dan menyiapkan data untuk view.
     *
     * @return array
     */
    private function getAdminData(): array
    {
        // Pastikan admin telah login
        if (!$this->session->get('isLoggedIn')) {
            return [
                'adminName'      => 'Admin',
                'profileColor'   => 'bg-secondary',
                'profilePicture' => '',
                'initials'       => 'A',
                'colorClass'     => 'bg-secondary',
            ];
        }

        $adminName      = $this->session->get('nama_lengkap') ?? 'Admin';
        $profileColor   = $this->session->get('profile_color') ?? '#6c757d'; // Default ke warna Bootstrap-secondary
        $profilePicture = $this->session->get('profile_picture') ?? ''; // Path ke gambar profil atau string kosong

        // Menghasilkan inisial
        $initials = '';
        $names = explode(' ', $adminName);
        foreach ($names as $n) {
            if (strlen($n) > 0) {
                $initials .= strtoupper(substr($n, 0, 1));
            }
        }

        // Menentukan kelas warna berdasarkan nama admin
        $colors     = ['bg-primary', 'bg-secondary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-dark'];
        $hash       = crc32($adminName);
        $index      = $hash % count($colors);
        $colorClass = $colors[$index];

        return [
            'adminName'      => $adminName,
            'profileColor'   => $profileColor,
            'profilePicture' => $profilePicture,
            'initials'       => $initials,
            'colorClass'     => $colorClass,
        ];
    }

    /**
     * Dashboard Admin
     */
    public function dashboard()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $totalProducts    = $this->productModel->countAllResults();
        $totalCategories  = $this->categoryModel->countAllResults();

        $adminData = $this->getAdminData();

        $data = [
            'title'           => 'Dashboard Admin',
            'totalProducts'   => $totalProducts,
            'totalCategories' => $totalCategories,
            'adminName'       => $adminData['adminName'],
            'profileColor'    => $adminData['profileColor'],
            'profilePicture'  => $adminData['profilePicture'],
            'initials'        => $adminData['initials'],
            'colorClass'      => $adminData['colorClass'],
        ];

        return view('admin/dashboard', $data);
    }

    /**
     * Manage Categories
     */
    public function manageCategories()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $categories = $this->categoryModel->getAllWithProducts(); // Pastikan metode ini ada di CategoryModel

        $adminData = $this->getAdminData();

        $data = [
            'adminName'      => $adminData['adminName'],
            'profileColor'   => $adminData['profileColor'],
            'profilePicture' => $adminData['profilePicture'],
            'initials'       => $adminData['initials'],
            'colorClass'     => $adminData['colorClass'],
            'categories'     => $categories,
        ];

        return view('admin/manage_categories', $data);
    }

    /**
     * Manage Products
     */
    public function manageProducts()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $products    = $this->productModel->getWithCategory(); // Pastikan metode ini ada di ProductModel
        $categories  = $this->categoryModel->findAll();

        $adminData = $this->getAdminData();

        $data = [
            'adminName'      => $adminData['adminName'],
            'profileColor'   => $adminData['profileColor'],
            'profilePicture' => $adminData['profilePicture'],
            'initials'       => $adminData['initials'],
            'colorClass'     => $adminData['colorClass'],
            'products'       => $products,
            'categories'     => $categories,
        ];

        return view('admin/manage_products', $data);
    }

    /**
     * Logout Admin
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/admin/login')->with('info', 'Anda berhasil logout.');
    }

    /**
     * Tambahkan Kategori
     */
    public function addCategory()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Validasi input
        $rules = [
            'nama_kategori' => 'required|min_length[3]|max_length[50]|is_unique[categories.nama_kategori]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', $this->validator->getErrors())->withInput();
        }

        $nama_kategori = $this->request->getPost('nama_kategori');

        $data = [
            'nama_kategori' => $nama_kategori,
        ];

        try {
            $this->categoryModel->save($data);
            return redirect()->to('/admin/manageCategories')->with('success', 'Kategori berhasil ditambahkan.');
        } catch (\Exception $e) {
            log_message('error', 'Error adding category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan kategori.')->withInput();
        }
    }

    /**
     * Edit Kategori
     *
     * @param int $id_kategori
     */
    public function editCategory($id_kategori)
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Validasi input
        $rules = [
            'nama_kategori' => "required|min_length[3]|max_length[50]|is_unique[categories.nama_kategori,id_kategori,$id_kategori]"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', $this->validator->getErrors())->withInput();
        }

        $nama_kategori = $this->request->getPost('nama_kategori');

        $data = [
            'nama_kategori' => $nama_kategori,
        ];

        try {
            $this->categoryModel->update($id_kategori, $data);
            return redirect()->to('/admin/manageCategories')->with('success', 'Kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            log_message('error', 'Error editing category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui kategori.')->withInput();
        }
    }

    /**
     * Delete Kategori
     *
     * @param int $id_kategori
     */
    public function deleteCategory($id_kategori)
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        try {
            // Hapus dengan validasi
            if ($this->categoryModel->deleteWithValidation($id_kategori)) {
                return redirect()->to('/admin/manageCategories')->with('success', 'Kategori berhasil dihapus.');
            } else {
                return redirect()->to('/admin/manageCategories')->with('error', 'Kategori tidak bisa dihapus karena masih memiliki produk.');
            }
        } catch (\Exception $e) {
            log_message('error', 'Error deleting category: ' . $e->getMessage());
            return redirect()->to('/admin/manageCategories')->with('error', 'Terjadi kesalahan saat menghapus kategori.');
        }
    }

    /**
     * Tambahkan Produk
     */
    public function addProduct()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Validasi input
        $rules = [
            'nama_produk' => 'required|min_length[3]|max_length[100]',
            'deskripsi'   => 'required|min_length[10]',
            'harga'       => 'required|numeric|greater_than[0]',
            'id_kategori' => 'required|integer|is_not_unique[categories.id_kategori]',
            'stok'        => 'required|integer|greater_than_equal_to[0]',
            'gambar'      => 'uploaded[gambar]|is_image[gambar]|max_size[gambar,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', $this->validator->getErrors())->withInput();
        }

        // Ambil data dari form
        $nama_produk = $this->request->getPost('nama_produk');
        $deskripsi    = $this->request->getPost('deskripsi');
        $harga        = $this->request->getPost('harga');
        $id_kategori  = $this->request->getPost('id_kategori');
        $stok         = $this->request->getPost('stok');

        // Upload gambar
        $file = $this->request->getFile('gambar');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('writable/uploads/products/', $newName);
            $gambar = 'writable/uploads/products/' . $newName;
        } else {
            $gambar = ''; // Atau set ke default image
        }

        $data = [
            'nama_produk' => $nama_produk,
            'deskripsi'    => $deskripsi,
            'harga'        => $harga,
            'id_kategori'  => $id_kategori,
            'stok'         => $stok,
            'gambar'       => $gambar,
        ];

        try {
            $this->productModel->save($data);
            return redirect()->to('/admin/manageProducts')->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            log_message('error', 'Error adding product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan produk.')->withInput();
        }
    }

    /**
     * Edit Produk
     */
    public function editProduct()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Validasi input
        $rules = [
            'id_produk'   => 'required|integer',
            'nama_produk' => 'required|min_length[3]|max_length[100]',
            'deskripsi'   => 'required|min_length[10]',
            'harga'       => 'required|numeric|greater_than[0]',
            'id_kategori' => 'required|integer|is_not_unique[categories.id_kategori]',
            'stok'        => 'required|integer|greater_than_equal_to[0]',
            'gambar'      => 'permit_empty|is_image[gambar]|max_size[gambar,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', $this->validator->getErrors())->withInput();
        }

        // Ambil data dari form
        $id_produk   = $this->request->getPost('id_produk');
        $nama_produk = $this->request->getPost('nama_produk');
        $deskripsi    = $this->request->getPost('deskripsi');
        $harga        = $this->request->getPost('harga');
        $id_kategori  = $this->request->getPost('id_kategori');
        $stok         = $this->request->getPost('stok');

        // Cek apakah ada gambar yang diupload
        $file = $this->request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus gambar lama jika ada
            $oldProduct = $this->productModel->find($id_produk);
            if (!empty($oldProduct['gambar']) && file_exists($oldProduct['gambar'])) {
                unlink($oldProduct['gambar']);
            }

            // Upload gambar baru
            $newName = $file->getRandomName();
            $file->move('writable/uploads/products/', $newName);
            $gambar = 'writable/uploads/products/' . $newName;
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $oldProduct = $this->productModel->find($id_produk);
            $gambar = $oldProduct['gambar'] ?? '';
        }

        $data = [
            'nama_produk' => $nama_produk,
            'deskripsi'    => $deskripsi,
            'harga'        => $harga,
            'id_kategori'  => $id_kategori,
            'stok'         => $stok,
            'gambar'       => $gambar,
        ];

        try {
            $this->productModel->update($id_produk, $data);
            return redirect()->to('/admin/manageProducts')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            log_message('error', 'Error editing product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui produk.')->withInput();
        }
    }

    /**
     * Delete Produk
     *
     * @param int $id_produk
     */
    public function deleteProduct($id_produk)
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        try {
            // Hapus gambar jika ada
            $product = $this->productModel->find($id_produk);
            if (!empty($product['gambar']) && file_exists($product['gambar'])) {
                unlink($product['gambar']);
            }

            // Hapus produk
            $this->productModel->delete($id_produk);
            return redirect()->to('/admin/manageProducts')->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            log_message('error', 'Error deleting product: ' . $e->getMessage());
            return redirect()->to('/admin/manageProducts')->with('error', 'Terjadi kesalahan saat menghapus produk.');
        }
    }
}
