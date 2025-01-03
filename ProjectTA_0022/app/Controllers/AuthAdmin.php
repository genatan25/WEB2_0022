<?php

namespace App\Controllers;

use App\Models\AdminModel;

class AuthAdmin extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function login()
    {
        return view('admin/login_admin');
    }

    public function doLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $this->adminModel->getAdminByUsername($username);

        if ($admin && password_verify($password, $admin['password'])) {
            $session = session();
            $session->set([
                'admin_id' => $admin['id_admin'],
                'username' => $admin['username'],
                'nama_lengkap' => $admin['nama_lengkap'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->back()->with('error', 'Username atau password salah');
    }

    public function register_admin()
    {
        return view('admin/register_admin');
    }

    // Nama method diubah untuk konsistensi
    public function doRegister_admin()
    {
        // Data yang akan disimpan
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'profile_color' => $this->adminModel->generateProfileColor()
        ];

        // Validasi form
        $rules = [
            'username' => 'required|min_length[5]|is_unique[admin.username]',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
            'nama_lengkap' => 'required'
        ];

        $messages = [
            'username' => [
                'required' => 'Username wajib diisi.',
                'min_length' => 'Username minimal harus 5 karakter.',
                'is_unique' => 'Username sudah digunakan.'
            ],
            'password' => [
                'required' => 'Password wajib diisi.',
                'min_length' => 'Password minimal harus 8 karakter.'
            ],
            'confirm_password' => [
                'required' => 'Konfirmasi password wajib diisi.',
                'matches' => 'Konfirmasi password tidak sesuai.'
            ],
            'nama_lengkap' => [
                'required' => 'Nama lengkap wajib diisi.'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        try {
            if ($this->adminModel->insert($data)) {
                return redirect()->to('/admin/login')
                               ->with('success', 'Registrasi berhasil, silakan login');
            } else {
                return redirect()->back()
                               ->withInput()
                               ->with('error', 'Gagal melakukan registrasi: ' . implode(', ', $this->adminModel->errors()));
            }
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/admin/login');
    }
}