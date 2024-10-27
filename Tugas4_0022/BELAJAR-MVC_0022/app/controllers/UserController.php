<?php
require_once 'app/models/User.php';

class UserController
{
    private $userModel;

    // Konstruktor, menginisialisasi User model dengan koneksi database
    public function __construct($dbConnection)
    {
        $this->userModel = new User($dbConnection);
    }

    // Fungsi untuk menampilkan semua pengguna
    public function index()
    {
        $users = $this->userModel->getAllUsers(); // Mendapatkan semua data pengguna
        require_once 'app/views/userList.php'; // Memuat tampilan daftar pengguna
    }

    // Fungsi untuk menampilkan detail pengguna berdasarkan ID
    public function show($id)
    {
        $user = $this->userModel->getUserById($id); // Mengambil data pengguna berdasarkan ID
        require_once 'app/views/userView.php'; // Memuat tampilan detail pengguna
    }

    // Fungsi untuk menampilkan form tambah atau edit
    public function form($id = null)
    {
        $user = null;
        if ($id) {
            $user = $this->userModel->getUserById($id); // Mengambil data user jika ID ada
        }
        require_once 'app/views/userForm.php'; // Menampilkan form (tambah/edit)
    }

    // Fungsi untuk menyimpan data pengguna baru atau mengupdate pengguna
    public function save($data)
    {
        if (isset($data['id'])) {
            // Jika ID ada, update pengguna
            $this->userModel->updateUser($data['id'], $data['name'], $data['email']);
        } else {
            // Jika ID tidak ada, tambahkan pengguna baru
            $this->userModel->createUser($data['name'], $data['email']);
        }
        header('Location: index.php'); // Mengalihkan ke halaman utama
    }

    // Fungsi untuk menghapus pengguna berdasarkan ID
    public function delete($id)
    {
        $this->userModel->deleteUser($id); // Menghapus data pengguna berdasarkan ID
        header('Location: index.php'); // Mengalihkan ke halaman utama
    }
}
?>
