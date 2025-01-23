<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users'; // Nama tabel
    protected $primaryKey       = 'id_user'; // Primary key

    protected $useAutoIncrement = true; // Auto increment primary key
    
    protected $returnType       = 'array'; // Format hasil query (array/object)
    protected $useSoftDeletes   = false; // Soft delete jika dibutuhkan

    protected $allowedFields    = [
        'username',
        'email',
        'password',
        'created_at',
        'updated_at'
    ]; // Field yang diizinkan untuk diisi

    protected $useTimestamps    = true; // Aktifkan timestamps
    protected $createdField     = 'created_at'; // Field untuk waktu pembuatan
    protected $updatedField     = 'updated_at'; // Field untuk waktu update
    protected $deletedField     = null; // Tidak digunakan jika soft delete dinonaktifkan

    protected $validationRules  = [
        'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username,id_user,{id}]',
        'email'    => 'required|valid_email|is_unique[users.email,id_user,{id}]',
        'password' => 'required|min_length[8]'
    ]; // Validasi field

    protected $validationMessages = [
        'username' => [
            'required'   => 'Username harus diisi.',
            'min_length' => 'Username minimal 3 karakter.',
            'max_length' => 'Username maksimal 50 karakter.',
            'is_unique'  => 'Username sudah terdaftar.'
        ],
        'email' => [
            'required'    => 'Email harus diisi.',
            'valid_email' => 'Email tidak valid.',
            'is_unique'   => 'Email sudah terdaftar.'
        ],
        'password' => [
            'required'   => 'Password harus diisi.',
            'min_length' => 'Password minimal 8 karakter.'
        ]
    ]; // Pesan error validasi

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

    protected $skipValidation = false; // Jangan skip validasi
}
