<?php
require_once 'config/database.php'; // Memuat file konfigurasi database
require_once 'app/controllers/UserController.php'; // Memuat file controller pengguna

// Koneksi ke database
$dbConnection = getDBConnection();
$controller = new UserController($dbConnection); // Membuat instance UserController dengan koneksi database

// Mengambil ID pengguna dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : null; // Memastikan ID adalah angka (jika ada)

if ($id) {
    $controller->delete($id); // Menghapus pengguna jika ID ada
} else {
    header('Location: index.php'); // Mengalihkan ke halaman utama jika ID tidak ada
}
?>
