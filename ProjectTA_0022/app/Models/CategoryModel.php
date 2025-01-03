<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    
    protected $allowedFields = ['nama_kategori', 'created_at', 'updated_at'];

    protected $validationRules = [
        'nama_kategori' => 'required|min_length[3]|max_length[50]|is_unique[kategori.nama_kategori,id_kategori,{id_kategori}]'
    ];

    protected $validationMessages = [
        'nama_kategori' => [
            'required' => 'Nama kategori harus diisi',
            'min_length' => 'Nama kategori minimal 3 karakter',
            'max_length' => 'Nama kategori maksimal 50 karakter',
            'is_unique' => 'Nama kategori sudah ada'
        ]
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getAllWithProducts()
    {
        return $this->select('kategori.*, COUNT(produk.id_produk) as total_produk')
                    ->join('produk', 'produk.id_kategori = kategori.id_kategori', 'left')
                    ->groupBy('kategori.id_kategori')
                    ->findAll();
    }

    public function deleteWithValidation($id)
    {
        $productModel = new ProductModel();
        $hasProducts = $productModel->where('id_kategori', $id)->countAllResults() > 0;
        
        if ($hasProducts) {
            return ['success' => false, 'message' => 'Kategori masih memiliki produk'];
        }
        
        return ['success' => $this->delete($id), 'message' => 'Kategori berhasil dihapus'];
    }
}