<?php
class Produk {
    private $conn;
    private $table = 'produk_0022';

    public $kode_barang;
    public $nama_barang;
    public $harga;
    public $stok;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE kode_barang = :kode_barang";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':kode_barang', $this->kode_barang);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (kode_barang, nama_barang, harga, stok) VALUES (:kode_barang, :nama_barang, :harga, :stok)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':kode_barang', $this->kode_barang);
        $stmt->bindParam(':nama_barang', $this->nama_barang);
        $stmt->bindParam(':harga', $this->harga);
        $stmt->bindParam(':stok', $this->stok);

        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET nama_barang = :nama_barang, harga = :harga, stok = :stok WHERE kode_barang = :kode_barang";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':kode_barang', $this->kode_barang);
        $stmt->bindParam(':nama_barang', $this->nama_barang);
        $stmt->bindParam(':harga', $this->harga);
        $stmt->bindParam(':stok', $this->stok);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE kode_barang = :kode_barang";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':kode_barang', $this->kode_barang);

        return $stmt->execute();
    }
}
?>
