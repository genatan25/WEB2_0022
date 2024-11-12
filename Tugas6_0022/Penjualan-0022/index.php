<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Penjualan Genatan_0022</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav ml-auto">
            <!-- Fullscreen button -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <!-- Sidebar minimize toggle button -->
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <span class="brand-text font-weight-light">Penjualan App</span>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="mt-3 mb-2 text-center">
                <h5 class="text-white">Menu Utama</h5>
            </div>
            
            <!-- Daftar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="?controller=home&amp;action=index" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Menu Penjualan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?controller=produk&amp;action=list" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Barang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?controller=pelanggan&amp;action=list" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Pelanggan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?controller=transaksi&amp;action=list" class="nav-link">
                            <i class="nav-icon fas fa-exchange-alt"></i>
                            <p>Transaksi</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <!-- /.sidebar -->

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Aplikasi Penjualan</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
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
                            ?>
                            <!-- Tampilkan card hanya di halaman Menu Penjualan -->
                            <div class="row mt-4">
                                <div class="col-lg-3 col-6">
                                    <!-- small card -->
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>Barang</h3>
                                            <p>Data Barang</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-box"></i>
                                        </div>
                                        <a href="?controller=produk&amp;action=list" class="small-box-footer">
                                            Lihat Barang <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3>Pelanggan</h3>
                                            <p>Data Pelanggan</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <a href="?controller=pelanggan&amp;action=list" class="small-box-footer">
                                            Lihat Pelanggan <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>Transaksi</h3>
                                            <p>Data Transaksi</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-exchange-alt"></i>
                                        </div>
                                        <a href="?controller=transaksi&amp;action=list" class="small-box-footer">
                                            Lihat Transaksi <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
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
        </section>
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- Main Footer -->
<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
        Aplikasi Penjualan-0022-TugasWebPertemuan6-2024
    </div>
    <strong>&copy; 2024 <a href="#">Aplikasi Penjualan</a>.</strong> All rights reserved.
</footer>
<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
