<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    
    protected $allowedFields = [
        'nama_produk', 'deskripsi', 'harga', 'gambar',
        'id_kategori', 'stok', 'created_at', 'updated_at'
    ];

    protected $validationRules = [
        'nama_produk' => 'required|min_length[3]|max_length[100]',
        'deskripsi' => 'required|min_length[10]',
        'harga' => 'required|numeric|greater_than[0]',
        'id_kategori' => 'required|integer|is_not_unique[kategori.id_kategori]',
        'stok' => 'required|integer|greater_than_equal_to[0]',
        'gambar' => 'uploaded[gambar]|is_image[gambar]|max_size[gambar,2048]'
    ];

    protected $validationMessages = [
        'nama_produk' => [
            'required' => 'Nama produk harus diisi',
            'min_length' => 'Nama produk minimal 3 karakter'
        ],
        'deskripsi' => [
            'required' => 'Deskripsi harus diisi',
            'min_length' => 'Deskripsi terlalu pendek'
        ],
        'harga' => [
            'required' => 'Harga harus diisi',
            'numeric' => 'Harga harus berupa angka',
            'greater_than' => 'Harga harus lebih dari 0'
        ],
        'id_kategori' => [
            'required' => 'Kategori harus dipilih',
            'is_not_unique' => 'Kategori tidak valid'
        ],
        'gambar' => [
            'uploaded' => 'Gambar harus diupload',
            'is_image' => 'File harus berupa gambar',
            'max_size' => 'Ukuran gambar maksimal 2MB'
        ]
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getWithCategory($id = null)
    {
        $builder = $this->select('produk.*, kategori.nama_kategori')
                       ->join('kategori', 'kategori.id_kategori = produk.id_kategori');
        
        return $id ? $builder->find($id) : $builder->findAll();
    }

    public function updateStock($id, $quantity)
    {
        $product = $this->find($id);
        if (!$product) return false;
        
        $newStock = $product['stok'] + $quantity;
        if ($newStock < 0) return false;
        
        return $this->update($id, ['stok' => $newStock]);
    }

    public function search($keyword)
    {
        return $this->select('produk.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id_kategori = produk.id_kategori')
                    ->like('nama_produk', $keyword)
                    ->orLike('deskripsi', $keyword)
                    ->orLike('kategori.nama_kategori', $keyword)
                    ->findAll();
    }
}