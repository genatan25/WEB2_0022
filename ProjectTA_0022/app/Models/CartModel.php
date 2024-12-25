<?php
namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'genatan_kaos_cart';
    protected $primaryKey = 'id_cart';
    protected $allowedFields = [
        'id_user',
        'id_produk',
        'jumlah',
        'subtotal'
    ];
}
