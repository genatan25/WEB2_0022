<?php
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'genatan_kaos_produk';
    protected $primaryKey = 'id_produk';
    protected $allowedFields = [
        'nama_produk',
        'deskripsi',
        'harga',
        'gambar',
        'id_kategori',
        'stok',
        'created_at',
        'updated_at'
    ];
}
