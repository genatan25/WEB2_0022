<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user'; // Nama tabel sesuai dengan migrasi
    protected $primaryKey = 'id_user'; // Primary key sesuai dengan migrasi
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false; // Tidak menggunakan soft delete dalam model ini

    // Kolom yang boleh di-insert atau update
    protected $allowedFields = [
        'username',      // Username pengguna
        'password',      // Password pengguna
        'email',         // Email pengguna
        'nama_lengkap',  // Nama lengkap pengguna
        'alamat',        // Alamat pengguna
        'telepon',       // Nomor telepon pengguna
        'profile_color', // Warna profil pengguna
        'created_at',    // Tanggal dibuatnya pengguna
        'updated_at'     // Tanggal terakhir kali diperbarui
    ];

    // Menentukan penggunaan timestamps
    protected $useTimestamps = true;
    protected $createdField = 'created_at'; // Kolom untuk tanggal pembuatan
    protected $updatedField = 'updated_at'; // Kolom untuk tanggal pembaruan

    // Aturan validasi untuk tiap kolom
    protected $validationRules = [
        'username'     => 'required|min_length[5]|is_unique[user.username]', // Validasi username
        'password'     => 'required|min_length[8]', // Validasi password
        'email'        => 'required|valid_email|is_unique[user.email]', // Validasi email
        'nama_lengkap' => 'required', // Validasi nama lengkap
        'alamat'       => 'required', // Validasi alamat
        'telepon'      => 'required|numeric', // Validasi nomor telepon
    ];

    // Pesan validasi untuk tiap kolom
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

    /**
     * Generate warna profil secara acak.
     * @return string
     */
    public function generateProfileColor()
    {
        // Daftar warna yang dapat dipilih secara acak
        $colors = ['#4285f4', '#34a853', '#fbbc05', '#ea4335', '#46bdc6', '#9c27b0'];
        return $colors[array_rand($colors)];
    }

    /**
     * Ambil data user berdasarkan username.
     * @param string $username
     * @return array|null
     */
    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
