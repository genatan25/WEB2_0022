<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'genatan_kaos_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'username',
        'password',
        'email',
        'nama_lengkap',
        'alamat',
        'telepon',
        'created_at'
    ];
}
