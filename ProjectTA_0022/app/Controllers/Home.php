<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends BaseController
{
    protected $session;
    protected $userModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = new \App\Models\UserModel();
    }

    public function index()
    {
        $data = [
            'is_logged_in' => $this->session->get('is_logged_in'),
            'user_data' => $this->session->get('is_logged_in') 
                ? $this->userModel->find($this->session->get('id_user')) 
                : null,
        ];

        return view('user/home', $data);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }
}
