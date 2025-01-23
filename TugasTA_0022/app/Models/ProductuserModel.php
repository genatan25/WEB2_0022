<?php
// app/Models/ProductuserModel.php

namespace App\Models;

use CodeIgniter\Model;

class ProductuserModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nama_produk',
        'deskripsi',
        'harga',
        'gambar',
        'id_kategori',
        'stok',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules    = [
        'nama_produk' => 'required|min_length[3]|max_length[100]',
        'deskripsi'   => 'required|min_length[10]',
        'harga'       => 'required|numeric|greater_than[0]',
        'id_kategori' => 'required|integer|is_not_unique[categories.id_kategori]',
        'stok'        => 'required|integer|greater_than_equal_to[0]',
        'gambar'      => 'permit_empty|is_image[gambar]|max_size[gambar,2048]'
    ];

    protected $validationMessages = [
        'nama_produk' => [
            'required'   => 'Nama produk harus diisi.',
            'min_length' => 'Nama produk minimal 3 karakter.',
            'max_length' => 'Nama produk maksimal 100 karakter.'
        ],
        'deskripsi' => [
            'required'   => 'Deskripsi harus diisi.',
            'min_length' => 'Deskripsi minimal 10 karakter.'
        ],
        'harga' => [
            'required'     => 'Harga harus diisi.',
            'numeric'      => 'Harga harus berupa angka.',
            'greater_than' => 'Harga harus lebih dari 0.'
        ],
        'id_kategori' => [
            'required'      => 'Kategori harus dipilih.',
            'is_not_unique' => 'Kategori tidak valid.'
        ],
        'stok' => [
            'required'                => 'Stok harus diisi.',
            'integer'                 => 'Stok harus berupa angka.',
            'greater_than_equal_to'   => 'Stok tidak boleh kurang dari 0.'
        ],
        'gambar' => [
            'is_image' => 'File yang diupload harus berupa gambar.',
            'max_size' => 'Ukuran gambar maksimal 2MB.'
        ]
    ];

    /**
     * Mendapatkan semua produk dengan nama kategori
     *
     * @return array
     */
    public function getAllProducts(): array
    {
        return $this->select('products.*, categories.nama_kategori')
                    ->join('categories', 'categories.id_kategori = products.id_kategori')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Mendapatkan produk berdasarkan kategori
     *
     * @param int $categoryId ID kategori
     * @return array
     */
    public function getProductsByCategory(int $categoryId): array
    {
        return $this->select('products.*, categories.nama_kategori')
                    ->join('categories', 'categories.id_kategori = products.id_kategori')
                    ->where('products.id_kategori', $categoryId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Mendapatkan produk terbaru
     *
     * @param int $limit Jumlah produk yang diambil
     * @return array
     */
    public function getLatestProducts(int $limit = 6): array
    {
        return $this->select('products.*, categories.nama_kategori')
                    ->join('categories', 'categories.id_kategori = products.id_kategori')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}
