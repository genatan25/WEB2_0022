<?php
class Pelanggan {
    private $conn;
    private $table = 'pelanggan_0022';

    public $id_pelanggan;
    public $nama_pelanggan;
    public $alamat;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne($id_pelanggan) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_pelanggan = :id_pelanggan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pelanggan', $id_pelanggan);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (id_pelanggan, nama_pelanggan, alamat) VALUES (:id_pelanggan, :nama_pelanggan, :alamat)";
        $stmt = $this->conn->prepare($query);

        $this->id_pelanggan = htmlspecialchars(strip_tags($this->id_pelanggan));
        $this->nama_pelanggan = htmlspecialchars(strip_tags($this->nama_pelanggan));
        $this->alamat = htmlspecialchars(strip_tags($this->alamat));

        $stmt->bindParam(':id_pelanggan', $this->id_pelanggan);
        $stmt->bindParam(':nama_pelanggan', $this->nama_pelanggan);
        $stmt->bindParam(':alamat', $this->alamat);

        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET nama_pelanggan = :nama_pelanggan, alamat = :alamat WHERE id_pelanggan = :id_pelanggan";
        $stmt = $this->conn->prepare($query);

        $this->id_pelanggan = htmlspecialchars(strip_tags($this->id_pelanggan));
        $this->nama_pelanggan = htmlspecialchars(strip_tags($this->nama_pelanggan));
        $this->alamat = htmlspecialchars(strip_tags($this->alamat));

        $stmt->bindParam(':id_pelanggan', $this->id_pelanggan);
        $stmt->bindParam(':nama_pelanggan', $this->nama_pelanggan);
        $stmt->bindParam(':alamat', $this->alamat);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id_pelanggan = :id_pelanggan";
        $stmt = $this->conn->prepare($query);

        $this->id_pelanggan = htmlspecialchars(strip_tags($this->id_pelanggan));

        $stmt->bindParam(':id_pelanggan', $this->id_pelanggan);

        return $stmt->execute();
    }
}
?>