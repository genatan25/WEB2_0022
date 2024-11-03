<?php
require_once 'config.php';
require_once 'models/Transaksi.php';

class TransaksiController {
    private $model;

    public function __construct() {
        $db = new Database();
        $this->model = new Transaksi($db->getConnection());
    }

    public function list() {
        $stmt = $this->model->readAll();
        include 'views/transaksi/list.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->kode_barang = $_POST['kode_barang'];
            $this->model->id_pelanggan = $_POST['id_pelanggan'];
            $this->model->jumlah = $_POST['jumlah'];
            $this->model->tanggal = $_POST['tanggal'];

            if ($this->model->create()) {
                header("Location: index.php?controller=transaksi&action=list");
                exit();
            } else {
                echo "Error: Gagal menambahkan transaksi.";
            }
        } else {
            include 'views/transaksi/add.php';
        }
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->id_transaksi = $_POST['id_transaksi'];
            $this->model->kode_barang = $_POST['kode_barang'];
            $this->model->id_pelanggan = $_POST['id_pelanggan'];
            $this->model->jumlah = $_POST['jumlah'];
            $this->model->tanggal = $_POST['tanggal'];

            if ($this->model->update()) {
                header("Location: index.php?controller=transaksi&action=list");
                exit();
            } else {
                echo "Error: Gagal mengupdate transaksi.";
            }
        } else {
            $this->model->id_transaksi = $_GET['id_transaksi'];
            $stmt = $this->model->readById($this->model->id_transaksi);
            $transaction = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($transaction) {
                include 'views/transaksi/edit.php';
            } else {
                echo "Error: Transaksi tidak ditemukan.";
            }
        }
    }

    public function delete() {
        if (isset($_GET['id_transaksi'])) {
            $this->model->id_transaksi = $_GET['id_transaksi'];
            if ($this->model->delete()) {
                header("Location: index.php?controller=transaksi&action=list");
                exit();
            } else {
                echo "Error: Gagal menghapus transaksi.";
            }
        } else {
            echo "Error: ID tidak ditemukan.";
        }
    }
}
?>