<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'username',
        'password',
        'email',
        'nama_lengkap',
        'alamat',
        'telepon',
        'profile_color',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'username'     => 'required|min_length[5]|is_unique[user.username]',
        'password'     => 'required|min_length[8]',
        'email'        => 'required|valid_email|is_unique[user.email]',
        'nama_lengkap' => 'required',
        'alamat'       => 'required',
        'telepon'      => 'required|numeric',
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
        'email' => [
            'required'    => 'Email wajib diisi.',
            'valid_email' => 'Email tidak valid.',
            'is_unique'   => 'Email sudah terdaftar.',
        ],
        'telepon' => [
            'required'    => 'Nomor telepon wajib diisi.',
            'numeric'     => 'Nomor telepon hanya boleh berisi angka.',
        ],
    ];

    protected $skipValidation = false;

    public function generateProfileColor()
    {
        $colors = ['#4285f4', '#34a853', '#fbbc05', '#ea4335', '#46bdc6', '#9c27b0'];
        return $colors[array_rand($colors)];
    }

    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
