<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admins'; 
    protected $primaryKey       = 'id_admin'; 
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'username',
        'password',
        'nama_lengkap',
        'profile_color',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Mengambil admin berdasarkan username
     *
     * @param string $username
     * @return array|null
     */
    public function getAdminByUsername(string $username): ?array
    {
        return $this->where('username', $username)->first();
    }

    /**
     * Menghasilkan kelas warna profil secara acak
     *
     * @return string
     */
    public function generateProfileColor(): string
    {
        $colors = ['bg-primary', 'bg-secondary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-dark'];
        return $colors[array_rand($colors)];
    }
}
