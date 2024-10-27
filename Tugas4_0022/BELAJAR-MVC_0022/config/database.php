<?php
function getDBConnection() {
    try {
        // Membuat koneksi ke database menggunakan PDO
        $db = new PDO('mysql:host=localhost;dbname=dbmvc_0022', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mengatur mode error agar melempar exception jika ada kesalahan
        return $db; // Mengembalikan objek koneksi database
    } catch (PDOException $e) {
        // Menangkap dan menampilkan pesan error jika koneksi gagal
        echo 'Connection failed: ' . $e->getMessage();
        exit; // Menghentikan eksekusi jika koneksi gagal
    }
}
?>
