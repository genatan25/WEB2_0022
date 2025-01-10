<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $validation;

    public function __construct()
    {
        $this->productModel  = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->validation    = \Config\Services::validation();
        helper(['form', 'url']);
    }

    /**
     * Menampilkan daftar produk
     * URL: GET /admin/manageProducts
     */
    public function index()
    {
        // Cek apakah admin sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Mendapatkan semua produk dengan nama kategori
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->findAll();

        // Ambil data admin dari session
        $adminName = session()->get('nama_lengkap') ?? 'Admin';
        $initials  = $this->getInitials($adminName);
        $colorClass = session()->get('profile_color') ?? 'bg-secondary';

        // Kirim data ke view
        $data = [
            'adminName'   => esc($adminName),
            'initials'    => esc($initials),
            'colorClass'  => esc($colorClass),
            'products'    => $products,
            'categories'  => $categories,
        ];

        // Memuat view
        return view('admin/manage_products', $data);
    }

    /**
     * Menambahkan produk baru (CREATE)
     * URL: POST /admin/products/add
     */
    public function addProduct()
    {
        // Validasi input
        $rules = [
            'nama_produk' => 'required|min_length[3]|max_length[100]',
            'deskripsi'   => 'required|min_length[10]',
            'harga'       => 'required|numeric|greater_than[0]',
            'stok'        => 'required|integer|greater_than_equal_to[0]',
            'id_kategori' => 'required|integer|is_not_unique[categories.id_kategori]',
            'gambar'      => 'uploaded[gambar]|is_image[gambar]|max_size[gambar,2048]' // Maksimal 2MB
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('error', $this->validator->getErrors())
                ->withInput();
        }

        // Menangani unggahan file
        $img = $this->request->getFile('gambar');
        if (!$img->isValid()) {
            return redirect()->back()
                ->with('error', ['gambar' => 'Gambar tidak valid atau tidak terupload.'])
                ->withInput();
        }

        // Menghasilkan nama acak baru
        $imgName = $img->getRandomName();

        try {
            // Pastikan direktori uploads/products ada
            $uploadPath = FCPATH . 'uploads/products';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Memindahkan file ke public/uploads/products
            $img->move($uploadPath, $imgName);

            // Menyisipkan data dengan melewati validasi model
            $this->productModel->skipValidation(true)->insert([
                'nama_produk' => $this->request->getPost('nama_produk'),
                'deskripsi'   => $this->request->getPost('deskripsi'),
                'harga'       => $this->request->getPost('harga'),
                'stok'        => $this->request->getPost('stok'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'gambar'      => 'uploads/products/' . $imgName
            ]);

            return redirect()
                ->to('/admin/manageProducts')
                ->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Menghapus file yang diunggah jika penyisipan gagal
            if (file_exists(FCPATH . 'uploads/products/' . $imgName)) {
                unlink(FCPATH . 'uploads/products/' . $imgName);
            }

            return redirect()->back()
                ->with('error', 'Gagal menambahkan produk: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Mengedit produk (UPDATE)
     * URL: POST /admin/products/edit
     */
    public function editProduct()
    {
        $id_produk = $this->request->getPost('id_produk');
        if (empty($id_produk)) {
            return redirect()->back()->with('error', 'ID Produk tidak ditemukan.');
        }

        // Mendapatkan produk yang ada
        $product = $this->productModel->find($id_produk);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Validasi input
        $rules = [
            'nama_produk' => 'required|min_length[3]|max_length[100]',
            'deskripsi'   => 'required|min_length[10]',
            'harga'       => 'required|numeric|greater_than[0]',
            'stok'        => 'required|integer|greater_than_equal_to[0]',
            'id_kategori' => 'required|integer|is_not_unique[categories.id_kategori]',
            'gambar'      => 'permit_empty|is_image[gambar]|max_size[gambar,2048]' // Memungkinkan unggahan opsional
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('error', $this->validator->getErrors())
                ->withInput();
        }

        // Menyiapkan data untuk diperbarui
        $updateData = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'id_kategori' => $this->request->getPost('id_kategori'),
        ];

        // Memeriksa apakah ada gambar baru yang diunggah
        $img = $this->request->getFile('gambar');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            // Menghasilkan nama acak baru
            $newName = $img->getRandomName();

            try {
                // Pastikan direktori uploads/products ada
                $uploadPath = FCPATH . 'uploads/products';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                // Memindahkan gambar baru
                $img->move($uploadPath, $newName);

                // Menghapus gambar lama jika ada
                if (!empty($product['gambar'])) {
                    $oldImagePath = FCPATH . $product['gambar'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Memperbarui path gambar
                $updateData['gambar'] = 'uploads/products/' . $newName;
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'Gagal mengupload gambar: ' . $e->getMessage())
                    ->withInput();
            }
        }

        try {
            // Memperbarui produk dengan melewati validasi model
            $this->productModel->skipValidation(true)->update($id_produk, $updateData);

            return redirect()
                ->to('/admin/manageProducts')
                ->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui produk: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Menghapus produk (DELETE)
     * URL: GET /admin/products/delete/(:num)
     *
     * @param int $id_produk
     */
    public function deleteProduct($id_produk = null)
    {
        if (!$id_produk) {
            return redirect()->back()->with('error', 'ID Produk tidak ditemukan.');
        }

        try {
            // Mendapatkan produk
            $product = $this->productModel->find($id_produk);
            if (!$product) {
                return redirect()->back()->with('error', 'Produk tidak ditemukan.');
            }

            // Menghapus gambar jika ada
            if (!empty($product['gambar'])) {
                $imagePath = FCPATH . $product['gambar'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Menghapus produk
            $this->productModel->delete($id_produk);

            return redirect()
                ->to('/admin/manageProducts')
                ->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
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
