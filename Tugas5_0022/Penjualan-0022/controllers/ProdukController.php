<?php
require_once 'config.php';
require_once 'models/Produk.php';

class ProdukController {
    private $model;

    public function __construct() {
        $db = new Database();
        $this->model = new Produk($db->getConnection());
    }

    public function list() {
        $stmt = $this->model->readAll();
        $data_produk = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include 'views/produk/list.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->kode_barang = $_POST['kode_barang'];
            $this->model->nama_barang = $_POST['nama_barang'];
            $this->model->harga = $_POST['harga'];
            $this->model->stok = $_POST['stok'];
            if ($this->model->create()) {
                header("Location: index.php?controller=produk&action=list");
                exit();
            } else {
                echo "Error: Produk gagal ditambahkan.";
            }
        } else {
            include 'views/produk/add.php';
        }
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->kode_barang = $_POST['kode_barang'];
            $this->model->nama_barang = $_POST['nama_barang'];
            $this->model->harga = $_POST['harga'];
            $this->model->stok = $_POST['stok'];
            if ($this->model->update()) {
                header("Location: index.php?controller=produk&action=list");
                exit();
            } else {
                echo "Error: Produk gagal diupdate.";
            }
        } else {
            $this->model->kode_barang = $_GET['kode_barang'];
            $produk = $this->model->readOne();
            include 'views/produk/edit.php';
        }
    }

    public function delete() {
        if (isset($_GET['kode_barang'])) {
            $this->model->kode_barang = $_GET['kode_barang'];
            if ($this->model->delete()) {
                header("Location: index.php?controller=produk&action=list");
                exit();
            } else {
                echo "Error: Produk gagal dihapus.";
            }
        } else {
            header("Location: index.php?controller=produk&action=list");
            exit();
        }
    }
}
?>
