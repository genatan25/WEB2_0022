<?php
namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'genatan_kaos_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = [
        'id_user',
        'total_harga',
        'status',
        'created_at'
    ];
}
