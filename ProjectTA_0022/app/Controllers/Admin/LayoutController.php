<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LayoutModel;

class LayoutController extends BaseController
{
    protected $layoutModel;
    protected $session;

    public function __construct()
    {
        $this->layoutModel = new LayoutModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url']);
    }

    /**
     * Menampilkan form pengelolaan layout dan menangani form submission
     */
    public function manage_layout()
    {
        // Pastikan admin sudah login dan memiliki izin
        // Implementasikan autentikasi sesuai kebutuhan
        // Misalnya:
        // if (!$this->session->get('isLoggedIn')) {
        //     return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        // }

        if ($this->request->getMethod() === 'post') {
            // Aturan validasi
            $rules = [
                'hero_heading' => [
                    'rules'  => 'required|min_length[3]|max_length[255]',
                    'errors' => [
                        'required'   => 'Judul hero harus diisi.',
                        'min_length' => 'Judul hero minimal 3 karakter.',
                        'max_length' => 'Judul hero maksimal 255 karakter.',
                    ],
                ],
                'hero_subheading' => [
                    'rules'  => 'required|min_length[3]',
                    'errors' => [
                        'required'   => 'Subjudul hero harus diisi.',
                        'min_length' => 'Subjudul hero minimal 3 karakter.',
                    ],
                ],
                'background_image' => [
                    'rules'  => 'permit_empty|uploaded[background_image]|max_size[background_image,2048]|is_image[background_image]|mime_in[background_image,image/jpg,image/jpeg,image/png,image/gif]',
                    'errors' => [
                        'uploaded'   => 'Gambar latar harus diupload.',
                        'max_size'   => 'Ukuran gambar terlalu besar. Maksimal 2MB.',
                        'is_image'   => 'File yang diupload bukan gambar.',
                        'mime_in'    => 'Jenis file gambar tidak valid. Hanya JPG, PNG, dan GIF yang diperbolehkan.',
                    ],
                ],
            ];

            // Cek validasi
            if ($this->validate($rules)) {
                // Ambil data input
                $hero_heading = $this->request->getPost('hero_heading');
                $hero_subheading = $this->request->getPost('hero_subheading');

                // Persiapkan data untuk disimpan
                $data = [
                    'hero_heading'    => $hero_heading,
                    'hero_subheading' => $hero_subheading,
                    // 'background_image' akan ditangani secara terpisah
                ];

                // Simpan data teks
                $save = $this->layoutModel->updateSettings($data);

                if ($save) {
                    // Tangani upload gambar
                    $file = $this->request->getFile('background_image');

                    if ($file && $file->isValid() && !$file->hasMoved()) {
                        try {
                            $this->layoutModel->updateBackgroundImage($file);
                        } catch (\RuntimeException $e) {
                            // Jika terjadi kesalahan saat upload, tampilkan pesan error
                            return redirect()->back()->with('error', $e->getMessage())->withInput();
                        }
                    }

                    // Set flashdata sukses
                    return redirect()->back()->with('success', 'Pengaturan layout berhasil diperbarui.');
                } else {
                    // Set flashdata error jika gagal menyimpan data
                    return redirect()->back()->with('error', 'Gagal memperbarui pengaturan layout.')->withInput();
                }
            } else {
                // Jika validasi gagal, tampilkan error
                return redirect()->back()->with('validation', $this->validator)->withInput();
            }
        }

        // Jika GET request, tampilkan form dengan data saat ini
        $data['settings'] = $this->layoutModel->getSettings();

        return view('admin/layout_manager', $data);
    }
}
