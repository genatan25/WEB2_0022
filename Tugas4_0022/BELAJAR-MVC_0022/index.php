<?php
require_once 'config/database.php'; // Memuat file konfigurasi database
require_once 'app/controllers/UserController.php'; // Memuat file controller pengguna

// Koneksi ke database
$dbConnection = getDBConnection();
$controller = new UserController($dbConnection); // Membuat instance UserController dengan koneksi database

// Mendapatkan parameter dari URL untuk menentukan tindakan
$action = isset($_GET['action']) ? $_GET['action'] : 'index'; // Mengatur action default ke 'index' jika tidak ada parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : null; // Memastikan ID adalah angka (jika ada)

// Routing berdasarkan action
switch ($action) {
    case 'index':
        $controller->index(); // Menampilkan daftar pengguna
        break;
    case 'show':
        $controller->show($id); // Menampilkan detail pengguna berdasarkan ID
        break;
    case 'form':
        $controller->form($id); // Menampilkan form untuk tambah/edit pengguna
        break;
    case 'save':
        $controller->save($_POST); // Menyimpan data pengguna dari form
        break;
    default:
        $controller->index(); // Tindakan default jika action tidak dikenali, menampilkan daftar pengguna
}
?>
