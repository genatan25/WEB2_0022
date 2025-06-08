<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaction';
    protected $primaryKey       = 'id_transaction';
    protected $allowedFields    = ['id_user','tgl_transaksi', 'jml_produk', 'grand_total'];

    // Dates
    protected $useTimestamps = false;
}
