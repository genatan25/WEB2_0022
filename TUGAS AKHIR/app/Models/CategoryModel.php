<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id_kategori';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nama_kategori',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules    = [
        'nama_kategori' => 'required|min_length[3]|max_length[50]|is_unique[categories.nama_kategori,id_kategori,{id_kategori}]'
    ];

    protected $validationMessages = [
        'nama_kategori' => [
            'required'   => 'Nama kategori harus diisi.',
            'min_length' => 'Nama kategori minimal 3 karakter.',
            'max_length' => 'Nama kategori maksimal 50 karakter.',
            'is_unique'  => 'Nama kategori sudah ada.'
        ]
    ];

    /**
     * Mendapatkan semua kategori dengan jumlah produk
     *
     * @return array
     */
    public function getAllWithProducts(): array
    {
        return $this->select('categories.*, COUNT(products.id_produk) as total_produk')
                    ->join('products', 'products.id_kategori = categories.id_kategori', 'left')
                    ->groupBy('categories.id_kategori')
                    ->findAll();
    }
}
