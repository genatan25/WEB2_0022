<?php

namespace App\Controllers\User;

use App\Models\UserModel;
use App\Controllers\BaseController;

class AuthUser extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session(); // Menginisialisasi session
    }

    /**
     * Menampilkan halaman login
     */
    public function login()
    {
        return view('user/login');
    }

    /**
     * Menangani proses login
     */
    public function loginProcess()
    {
        $data = $this->request->getPost();

        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $user = $this->userModel->where('username', $data['username'])->first();

        if (!$user || !password_verify($data['password'], $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
        }

        $this->session->set([
            'id_user'    => $user['id_user'],
            'username'   => $user['username'],
            'isLoggedIn' => true,
        ]);

        return redirect()->to('/user')->with('message', 'Login berhasil.');
    }

    /**
     * Menangani proses logout
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/user/auth/login')->with('message', 'Anda telah logout.');
    }

    /**
     * Menampilkan halaman registrasi
     */
    public function register()
    {
        return view('user/register');
    }

    /**
     * Menangani proses registrasi pengguna baru
     */
    public function registerProcess()
    {
        $data = $this->request->getPost();

        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->userModel->save($data);

        return redirect()->to('/user/auth/login')->with('message', 'Registrasi berhasil. Silakan login.');
    }
}
