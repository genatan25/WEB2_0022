<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiModel extends Model
{
    protected $table            = 'detail_transaction';
    protected $primaryKey       = 'id_detail_transaction';
    protected $allowedFields    = ['id_transaction', 'id_produk', 'jumlah', 'total_harga'];

    // Dates
    protected $useTimestamps = false;
}
