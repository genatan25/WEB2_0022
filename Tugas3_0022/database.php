<?php

class Database {
    // Konfigurasi untuk koneksi ke database
    public $host = "localhost";  // Alamat host database
    public $username = "root";    // Nama pengguna untuk koneksi ke database
    public $password = "";        // Kata sandi untuk koneksi ke database
    public $database = "db_php_0022"; // Nama database yang digunakan
    public $connect;              // Variabel untuk menyimpan koneksi database

    // Constructor untuk menginisialisasi koneksi ke database
    function __construct() {
        // Mencoba untuk menghubungkan ke database menggunakan mysqli
        $this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        // Memeriksa apakah koneksi berhasil
        if (!$this->connect) {
            die("Koneksi gagal: " . mysqli_connect_error()); // Jika gagal, tampilkan pesan error
        }

        // Jika berhasil, tidak perlu echo
        // echo "Koneksi Berhasil </br>";
    }

    // Fungsi untuk menampilkan semua data dari tabel tb_users_0022
    function tampilData() {
        $data = mysqli_query($this->connect, "SELECT * FROM tb_users_0022"); // Melakukan query untuk mengambil semua data
        if (!$data) {
            die("Query Error: " . mysqli_error($this->connect)); // Jika query gagal, tampilkan pesan error
        }

        $rows = mysqli_fetch_all($data, MYSQLI_ASSOC); // Mengambil semua hasil query sebagai array asosiatif
        return $rows; // Mengembalikan data yang diambil
    }

    // Fungsi untuk menambahkan data ke dalam tabel tb_users_0022
    function tambahData($nama, $alamat, $nohp, $foto, $jenis_kelamin, $email) {
        // Menyiapkan statement SQL untuk menyisipkan data
        $stmt = mysqli_prepare($this->connect, "INSERT INTO tb_users_0022 (nama, alamat, nohp, foto, jeniskelamin, email) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssssss', $nama, $alamat, $nohp, $foto, $jenis_kelamin, $email); // Mengikat parameter ke statement

        if (mysqli_stmt_execute($stmt)) {
            return true; // Mengembalikan true jika eksekusi berhasil
        } else {
            die("Query Error: " . mysqli_error($this->connect)); // Jika gagal, tampilkan pesan error
        }
    }

    // Fungsi untuk menampilkan data pengguna berdasarkan ID
    function editData($id) {
        // Menyiapkan statement SQL untuk mengambil data berdasarkan ID
        $stmt = mysqli_prepare($this->connect, "SELECT * FROM tb_users_0022 WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id); // Mengikat parameter ID
        mysqli_stmt_execute($stmt); // Eksekusi statement

        $result = mysqli_stmt_get_result($stmt); // Mendapatkan hasil dari eksekusi
        if ($result) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC); // Mengembalikan semua data sebagai array asosiatif
        } else {
            die("Query Error: " . mysqli_error($this->connect)); // Jika gagal, tampilkan pesan error
        }
    }

    // Fungsi untuk memperbarui data pengguna berdasarkan ID
    function updateData($id, $nama, $alamat, $nohp, $foto, $jenis_kelamin, $email) {
        // Menyiapkan statement SQL untuk memperbarui data
        $stmt = mysqli_prepare($this->connect, "UPDATE tb_users_0022 SET nama=?, alamat=?, nohp=?, foto=?, jeniskelamin=?, email=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'ssssssi', $nama, $alamat, $nohp, $foto, $jenis_kelamin, $email, $id); // Mengikat semua parameter

        if (mysqli_stmt_execute($stmt)) {
            return true; // Mengembalikan true jika eksekusi berhasil
        } else {
            die("Query Error: " . mysqli_error($this->connect)); // Jika gagal, tampilkan pesan error
        }
    }

    // Fungsi untuk menghapus data berdasarkan ID
    function hapusData($id) {
        // Menyiapkan statement SQL untuk menghapus data berdasarkan ID
        $stmt = mysqli_prepare($this->connect, "DELETE FROM tb_users_0022 WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id); // Mengikat parameter ID

        if (mysqli_stmt_execute($stmt)) {
            return true; // Mengembalikan true jika eksekusi berhasil
        } else {
            die("Query Error: " . mysqli_error($this->connect)); // Jika gagal, tampilkan pesan error
        }
    }
}
?>
