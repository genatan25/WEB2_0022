<?php
class Transaksi {
    private $conn;
    private $table = 'transaksi_0022';

    public $id_transaksi;
    public $kode_barang;
    public $id_pelanggan;
    public $jumlah;
    public $total_harga;
    public $tanggal;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readById($id_transaksi) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_transaksi = :id_transaksi";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_transaksi', $id_transaksi);
        $stmt->execute();
        return $stmt;
    }

    public function create() {

        $query_produk = "SELECT harga FROM produk_0022 WHERE kode_barang = :kode_barang";
        $stmt_produk = $this->conn->prepare($query_produk);
        $stmt_produk->bindParam(":kode_barang", $this->kode_barang);
        $stmt_produk->execute();
        $produk = $stmt_produk->fetch(PDO::FETCH_ASSOC);

        if ($produk) {
            $this->total_harga = $this->jumlah * $produk['harga'];
        } else {
            return false; 
        }

        $query = "INSERT INTO " . $this->table . " (kode_barang, id_pelanggan, jumlah, total_harga, tanggal) 
                  VALUES (:kode_barang, :id_pelanggan, :jumlah, :total_harga, :tanggal)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":kode_barang", $this->kode_barang);
        $stmt->bindParam(":id_pelanggan", $this->id_pelanggan);
        $stmt->bindParam(":jumlah", $this->jumlah);
        $stmt->bindParam(":total_harga", $this->total_harga);
        $stmt->bindParam(":tanggal", $this->tanggal);

        return $stmt->execute();
    }

    public function update() {
     
        $query_produk = "SELECT harga FROM produk_0022 WHERE kode_barang = :kode_barang";
        $stmt_produk = $this->conn->prepare($query_produk);
        $stmt_produk->bindParam(":kode_barang", $this->kode_barang);
        $stmt_produk->execute();
        $produk = $stmt_produk->fetch(PDO::FETCH_ASSOC);

        if ($produk) {
            $this->total_harga = $this->jumlah * $produk['harga'];
        } else {
            return false; 
        }

        $query = "UPDATE " . $this->table . " SET 
                  kode_barang = :kode_barang, 
                  id_pelanggan = :id_pelanggan, 
                  jumlah = :jumlah, 
                  total_harga = :total_harga, 
                  tanggal = :tanggal 
                  WHERE id_transaksi = :id_transaksi";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_transaksi", $this->id_transaksi);
        $stmt->bindParam(":kode_barang", $this->kode_barang);
        $stmt->bindParam(":id_pelanggan", $this->id_pelanggan);
        $stmt->bindParam(":jumlah", $this->jumlah);
        $stmt->bindParam(":total_harga", $this->total_harga);
        $stmt->bindParam(":tanggal", $this->tanggal);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id_transaksi = :id_transaksi";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_transaksi", $this->id_transaksi);
        return $stmt->execute();
    }
}
?>