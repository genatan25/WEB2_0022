<?php
// app/Controllers/User/TentangKamiController.php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class TentangKamiController extends BaseController
{
    /**
     * Menampilkan halaman "Tentang Kami"
     * URL: GET /user/tentang-kami
     */
    public function index()
    {
        // Menyiapkan data view jika diperlukan
        $data = [
            // Tambahkan data tambahan jika diperlukan
        ];

        // Memuat view
        return view('user/tentang_kami', $data);
    }
}
