<?php
class User
{
    private $db;

    // Konstruktor, menginisialisasi koneksi database
    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    // Mengambil semua pengguna
    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT * FROM users"); // Menjalankan query untuk mengambil semua data pengguna
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengembalikan hasil sebagai array asosiatif
    }

    // Mengambil pengguna berdasarkan ID
    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id"); // Query untuk mengambil data pengguna berdasarkan ID
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Mengikat parameter ID
        $stmt->execute(); // Menjalankan query
        return $stmt->fetch(PDO::FETCH_ASSOC); // Mengembalikan hasil sebagai array asosiatif tunggal
    }

    // Menambahkan pengguna baru
    public function createUser($name, $email)
    {
        $stmt = $this->db->prepare("INSERT INTO users (name, email) VALUES (:name, :email)"); // Query untuk menambahkan pengguna baru
        $stmt->bindParam(':name', $name); // Mengikat parameter nama
        $stmt->bindParam(':email', $email); // Mengikat parameter email
        return $stmt->execute(); // Menjalankan query dan mengembalikan hasilnya
    }

    // Mengupdate data pengguna
    public function updateUser($id, $name, $email)
    {
        $stmt = $this->db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id"); // Query untuk memperbarui data pengguna berdasarkan ID
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Mengikat parameter ID
        $stmt->bindParam(':name', $name); // Mengikat parameter nama
        $stmt->bindParam(':email', $email); // Mengikat parameter email
        return $stmt->execute(); // Menjalankan query dan mengembalikan hasilnya
    }

    // Menghapus pengguna
    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id"); // Query untuk menghapus pengguna berdasarkan ID
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Mengikat parameter ID
        return $stmt->execute(); // Menjalankan query dan mengembalikan hasilnya
    }
}
?>
