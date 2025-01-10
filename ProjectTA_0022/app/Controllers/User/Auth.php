<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Menampilkan halaman login
    public function login()
    {
        return view('auth/login'); // Pastikan file ini ada di Views/auth/login.php
    }

    // Memproses login
    public function doLogin()
    {
        $session = session();
        $username = esc($this->request->getPost('username')); // Escape input untuk keamanan
        $password = $this->request->getPost('password');

        // Cari pengguna berdasarkan username
        $user = $this->userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            // Simpan data pengguna ke sesi
            $session->set([
                'id_user'      => $user['id_user'],
                'username'     => $user['username'],
                'is_logged_in' => true,
            ]);
            return redirect()->to('/'); // Redirect ke halaman utama setelah login
        }

        // Tampilkan pesan error jika login gagal
        $session->setFlashdata('error', 'Username atau password salah.');
        return redirect()->back()->withInput();
    }

    // Menampilkan halaman registrasi
    public function register()
    {
        return view('auth/register'); // Pastikan file ini ada di Views/auth/register.php
    }

    // Memproses registrasi
    public function doRegister()
    {
        $validation = \Config\Services::validation(); // Menggunakan layanan validasi

        // Ambil input dari form
        $data = [
            'username'     => esc($this->request->getPost('username')),
            'password'     => $this->request->getPost('password'),
            'email'        => esc($this->request->getPost('email')),
            'nama_lengkap' => esc($this->request->getPost('nama_lengkap')),
            'alamat'       => esc($this->request->getPost('alamat')),
            'telepon'      => esc($this->request->getPost('telepon')),
        ];

        // Validasi input
        if (!$validation->setRules($this->userModel->getValidationRules())->run($data)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Hash password sebelum menyimpan ke database
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        if ($this->userModel->insert($data)) {
            // Tampilkan pesan sukses dan arahkan ke halaman login
            session()->setFlashdata('success', 'Registrasi berhasil. Silakan login.');
            return redirect()->to('/login');
        }

        session()->setFlashdata('error', 'Terjadi kesalahan saat registrasi. Coba lagi.');
        return redirect()->back()->withInput();
    }

    // Logout pengguna
    public function logout()
    {
        session()->destroy(); // Hancurkan sesi untuk logout
        return redirect()->to('/login'); // Redirect ke halaman login setelah logout
    }
}
