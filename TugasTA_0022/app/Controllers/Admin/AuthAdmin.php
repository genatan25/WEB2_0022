<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class AuthAdmin extends BaseController
{
    protected $adminModel;
    protected $session;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->session    = session();
    }

    /**
     * Menampilkan halaman login admin
     */
    public function login()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard')->with('info', 'Anda sudah login!');
        }
        return view('admin/login_admin');
    }

    /**
     * Proses login admin
     */
    public function doLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $admin = $this->adminModel->getAdminByUsername($username);

        if ($admin && password_verify($password, $admin['password'])) {
            $this->session->set([
                'admin_id'     => $admin['id_admin'],
                'username'     => $admin['username'],
                'nama_lengkap' => $admin['nama_lengkap'],
                'profile_color'=> $admin['profile_color'],
                'isLoggedIn'   => true
            ]);
            return redirect()->to('/admin/dashboard')->with('success', 'Login berhasil!');
        }
        return redirect()->back()->with('error', 'Username atau password salah.')->withInput();
    }

    /**
     * Menampilkan halaman registrasi admin
     */
    public function register_admin()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard')->with('info', 'Anda sudah login!');
        }
        return view('admin/register_admin');
    }

    /**
     * Proses registrasi admin
     */
    public function doRegister_admin()
    {
        $rules = [
            'username'         => 'required|min_length[5]|is_unique[admins.username]',
            'password'         => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
            'nama_lengkap'     => 'required|min_length[3]|max_length[100]'
        ];

        $data = [
            'username'      => $this->request->getPost('username'),
            'password'      => $this->request->getPost('password'),
            'nama_lengkap'  => $this->request->getPost('nama_lengkap'),
            'profile_color' => $this->adminModel->generateProfileColor(),
            // 'profile_picture' => '' // Sudah dihapus
        ];

        if ($this->validate($rules)) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            if ($this->adminModel->insert($data)) {
                return redirect()->to('/admin/login')->with('success', 'Registrasi berhasil, silakan login.');
            } else {
                return redirect()->back()->with('error', 'Gagal registrasi, silakan coba lagi.')->withInput();
            }
        } else {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }
    }

    /**
     * Logout admin
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/admin/login')->with('info', 'Anda berhasil logout.');
    }
}
