<?php
require_once 'config.php'; 
require_once 'models/Pelanggan.php'; 

class PelangganController {
    private $model;

    public function __construct() {
        $db = new Database();
        $this->model = new Pelanggan($db->getConnection());
    }

    public function list() {
        $stmt = $this->model->readAll();
        include 'views/pelanggan/list.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->id_pelanggan = $_POST['id_pelanggan'];
            $this->model->nama_pelanggan = $_POST['nama_pelanggan'];
            $this->model->alamat = $_POST['alamat'];
            if ($this->model->create()) {
                header("Location: index.php?controller=pelanggan&action=list");
                exit();
            } else {
                echo "Error: Pelanggan gagal ditambahkan.";
            }
        } else {
            include 'views/pelanggan/add.php';
        }
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->id_pelanggan = $_POST['id_pelanggan'];
            $this->model->nama_pelanggan = $_POST['nama_pelanggan'];
            $this->model->alamat = $_POST['alamat'];
            if ($this->model->update()) {
                header("Location: index.php?controller=pelanggan&action=list");
                exit();
            } else {
                echo "Error: Pelanggan gagal diupdate.";
            }
        } else {
            $pelanggan = $this->model->readOne($_GET['id_pelanggan']);
            include 'views/pelanggan/edit.php';
        }
    }

    public function delete() {
        if (isset($_GET['id_pelanggan'])) {
            $this->model->id_pelanggan = $_GET['id_pelanggan'];
            if ($this->model->delete()) {
                header("Location: index.php?controller=pelanggan&action=list");
                exit();
            } else {
                echo "Error: Pelanggan gagal dihapus.";
            }
        } else {
            header("Location: index.php?controller=pelanggan&action=list");
            exit();
        }
    }
}
?>