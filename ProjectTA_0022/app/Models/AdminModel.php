<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin'; // Nama tabel sesuai dengan database
    protected $primaryKey = 'id_admin'; // Primary key
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'username',
        'password',
        'nama_lengkap',
        'profile_color',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'username'     => 'required|min_length[5]|is_unique[admin.username]',
        'password'     => 'required|min_length[8]',
        'nama_lengkap' => 'required',
    ];

    protected $validationMessages = [
        'username' => [
            'required'    => 'Username wajib diisi.',
            'min_length'  => 'Username minimal harus 5 karakter.',
            'is_unique'   => 'Username sudah digunakan.',
        ],
        'password' => [
            'required'    => 'Password wajib diisi.',
            'min_length'  => 'Password minimal harus 8 karakter.',
        ],
        'nama_lengkap' => [
            'required'    => 'Nama lengkap wajib diisi.',
        ],
    ];

    protected $skipValidation = false;

    /**
     * Generate random profile color for an admin.
     *
     * @return string
     */
    public function generateProfileColor()
    {
        $colors = ['#4285f4', '#34a853', '#fbbc05', '#ea4335', '#46bdc6', '#9c27b0'];
        return $colors[array_rand($colors)];
    }

    /**
     * Get admin data by username.
     *
     * @param string $username
     * @return array|null
     */
    public function getAdminByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
