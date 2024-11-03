<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="text-center">
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
            <div class="navbar-nav">
                <a class="nav-link btn btn-outline-primary mx-2" href="?controller=home&action=index">Home</a>
                <a class="nav-link btn btn-outline-primary mx-2" href="?controller=produk&action=list">Barang</a>
                <a class="nav-link btn btn-outline-primary mx-2" href="?controller=pelanggan&action=list">Pelanggan</a>
                <a class="nav-link btn btn-outline-primary mx-2" href="?controller=transaksi&action=list">Transaksi</a>
            </div>
        </nav>
        <hr>
    </div>

    <div class="text-center">
        <?php
        require_once 'controllers/ProdukController.php';
        require_once 'controllers/PelangganController.php';
        require_once 'controllers/TransaksiController.php';

        $controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        switch ($controller) {
            case 'home':
                echo "<h1>Selamat datang di aplikasi penjualan</h1>";
                break;

            case 'produk':
                $produkController = new ProdukController();
                if (method_exists($produkController, $action)) {
                    $produkController->$action();
                } else {
                    echo "Aksi tidak ditemukan!";
                }
                break;

            case 'pelanggan':
                $pelangganController = new PelangganController();
                if (method_exists($pelangganController, $action)) {
                    $pelangganController->$action();
                } else {
                    echo "Aksi tidak ditemukan!";
                }
                break;

            case 'transaksi':
                $transaksiController = new TransaksiController();
                if (method_exists($transaksiController, $action)) {
                    $transaksiController->$action();
                } else {
                    echo "Aksi tidak ditemukan!";
                }
                break;

            default:
                echo "Controller tidak ditemukan!";
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
