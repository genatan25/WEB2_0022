<?php
// app/Views/admin/dashboard.php
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title); ?></title>

    <!-- Main Stylesheet (CSS) -->
    <link href="<?= base_url('template/css/styles.css'); ?>" rel="stylesheet">

    <!-- Simple DataTables CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <!-- Top Navigation -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Brand -->
        <a class="navbar-brand ps-3" href="<?= base_url('/admin/dashboard'); ?>">Hallo Admin</a>

        <!-- Sidebar Toggle Button -->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Search Bar (Optional) -->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Cari..." aria-label="Cari">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>

        <!-- User Dropdown -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center"
                    id="navbarDropdown"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <?php if (!empty($profilePicture)): ?>
                        <img src="<?= base_url($profilePicture); ?>" alt="Profile" class="rounded-circle" width="30" height="30">
                    <?php else: ?>
                        <div class="rounded-circle text-white <?= esc($colorClass); ?> d-flex align-items-center justify-content-center" style="width:30px; height:30px;">
                            <?= esc($initials); ?>
                        </div>
                    <?php endif; ?>
                    <span class="ms-2 d-none d-lg-inline text-white"><?= esc($adminName); ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <!-- Logout -->
                        <a class="dropdown-item" href="<?= base_url('/admin/logout'); ?>">
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Layout Sidenav -->
    <div id="layoutSidenav">
        <!-- Sidebar -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu Admin</div>

                        <!-- Dashboard -->
                        <a class="nav-link" href="<?= base_url('/admin/dashboard'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <!-- Products -->
                        <a class="nav-link collapsed"
                            href="#"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseProduk"
                            aria-expanded="false">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Produk
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProduk" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <!-- Product List -->
                                <a class="nav-link" href="<?= base_url('/admin/manageProducts'); ?>">
                                    Daftar Produk
                                </a>
                                <!-- Product Categories -->
                                <a class="nav-link" href="<?= base_url('/admin/manageCategories'); ?>">
                                    Kategori Produk
                                </a>
                                <!-- detail produk -->
                                <a class="nav-link" href="<?= base_url('admin/productDetails'); ?>">
                                    Detail Produk
                                </a>
                            </nav>
                        </div>
                        <!-- pesanan -->
                        <a class="nav-link" href="<?= base_url('/admin/orders'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-bag"></i></div>
                            Pesanan Masuk
                        </a>
                    </div>
                </div>
                <!-- Sidebar Footer -->
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?= esc($adminName); ?>
                </div>
            </nav>
        </div>

        <!-- Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <!-- Page Title -->
                    <h1 class="mt-4">Dashboard Penjualan Genatan Kaos</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>

                    <!-- Flashdata sukses / error -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= esc(session()->getFlashdata('success')) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php
                            $errorData = session()->getFlashdata('error');
                            if (is_array($errorData)) {
                                foreach ($errorData as $err) {
                                    echo "<div>- " . esc($err) . "</div>";
                                }
                            } else {
                                echo esc($errorData);
                            }
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('info')): ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?= esc(session()->getFlashdata('info')) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Stats Overview -->
                    <div class="row">
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body">
                                    <div class="card-body-icon">
                                        <i class="fas fa-box-open"></i>
                                    </div>
                                    <div class="mr-5">Total Produk</div>
                                    <h3><?= esc($totalProducts); ?></h3>
                                </div>
                                <a class="card-footer text-white clearfix small z-1" href="<?= base_url('/admin/manageProducts'); ?>">
                                    <span class="float-start">Lihat Detail</span>
                                    <span class="float-end"><i class="fas fa-angle-right"></i></span>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card bg-success text-white h-100">
                                <div class="card-body">
                                    <div class="card-body-icon">
                                        <i class="fas fa-tags"></i>
                                    </div>
                                    <div class="mr-5">Total Kategori</div>
                                    <h3><?= esc($totalCategories); ?></h3>
                                </div>
                                <a class="card-footer text-white clearfix small z-1" href="<?= base_url('/admin/manageCategories'); ?>">
                                    <span class="float-start">Lihat Detail</span>
                                    <span class="float-end"><i class="fas fa-angle-right"></i></span>
                                </a>
                            </div>
                        </div>
                        <!-- Tambahkan kartu lainnya sesuai kebutuhan, seperti Total Penjualan, Produk Stok Rendah, dsb. -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card bg-warning text-white h-100">
                                <div class="card-body">
                                    <div class="card-body-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="mr-5">Total Penjualan</div>
                                    <h3>Rp <?= number_format(5000000, 0, ',', '.'); ?></h3> <!-- Contoh data -->
                                </div>
                                <a class="card-footer text-white clearfix small z-1" href="#">
                                    <span class="float-start">Lihat Detail</span>
                                    <span class="float-end"><i class="fas fa-angle-right"></i></span>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card bg-danger text-white h-100">
                                <div class="card-body">
                                    <div class="card-body-icon">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="mr-5">Produk Stok Rendah</div>
                                    <h3>5</h3> <!-- Contoh data -->
                                </div>
                                <a class="card-footer text-white clearfix small z-1" href="<?= base_url('/admin/manageProducts'); ?>">
                                    <span class="float-start">Lihat Detail</span>
                                    <span class="float-end"><i class="fas fa-angle-right"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-chart-line me-2"></i>Grafik Penjualan
                                    </h5>
                                    <button class="btn btn-sm btn-light" id="refreshSalesChart">
                                        <i class="fas fa-sync-alt"></i> Refresh
                                    </button>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted text-center mb-3">Analisis tren penjualan bulanan.</p>
                                    <canvas id="salesChart" width="100%" height="40"></canvas>
                                </div>
                                <div class="card-footer text-end">
                                    <small class="text-muted">Diperbarui terakhir: <span id="lastSalesUpdate">--/--/----</span></small>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header d-flex justify-content-between align-items-center bg-success text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-list me-2"></i>Pesanan Terbaru
                                    </h5>
                                    <button class="btn btn-sm btn-light" id="refreshOrders">
                                        <i class="fas fa-sync-alt"></i> Refresh
                                    </button>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <!-- Contoh daftar pesanan dengan data dinamis -->
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Pesanan #001
                                            <span class="badge bg-primary rounded-pill">Rp 150.000</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Pesanan #002
                                            <span class="badge bg-primary rounded-pill">Rp 200.000</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Pesanan #003
                                            <span class="badge bg-primary rounded-pill">Rp 350.000</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Pesanan #004
                                            <span class="badge bg-primary rounded-pill">Rp 120.000</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Pesanan #005
                                            <span class="badge bg-primary rounded-pill">Rp 500.000</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer text-end">
                                    <small class="text-muted">Diperbarui terakhir: <span id="lastOrdersUpdate">--/--/----</span></small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <footer class="py-4 bg-light mt-auto">
                        <div class="container-fluid px-4">
                            <div class="d-flex align-items-center justify-content-between small">
                                <div class="text-muted">&copy; Genatan Kaos <?= date('Y'); ?></div>
                                <div>
                                    <a href="#">Privacy Policy</a>
                                    &middot;
                                    <a href="#">Terms &amp; Conditions</a>
                                </div>
                            </div>
                        </div>
                    </footer>

                </div>
        </div>

        <!-- Bootstrap Bundle JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Custom Scripts -->
        <script src="<?= base_url('template/js/scripts.js'); ?>"></script>

        <!-- Simple DataTables -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
        <script>
            // Initialize Simple DataTables
            const dataTable = new simpleDatatables.DataTable("#datatablesSimple");
        </script>

        <!-- Chart.js for Sales Chart -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
        <script>
            document.getElementById('lastSalesUpdate').textContent = new Date().toLocaleDateString();
            document.getElementById('lastOrdersUpdate').textContent = new Date().toLocaleDateString();

            document.getElementById('refreshSalesChart').addEventListener('click', () => {
                alert('Grafik penjualan diperbarui!');
                // Tambahkan logika untuk memperbarui data grafik jika diperlukan
            });

            document.getElementById('refreshOrders').addEventListener('click', () => {
                alert('Daftar pesanan diperbarui!');
                // Tambahkan logika untuk memperbarui daftar pesanan jika diperlukan
            });
            // Data penjualan bulanan yang dihasilkan oleh server
            const monthlySales = [{
                    bulan: 'Jan',
                    total: 1500000
                },
                {
                    bulan: 'Feb',
                    total: 2000000
                },
                {
                    bulan: 'Mar',
                    total: 1800000
                },
                {
                    bulan: 'Apr',
                    total: 2200000
                },
                {
                    bulan: 'May',
                    total: 3000000
                },
                {
                    bulan: 'Jun',
                    total: 2800000
                }
            ];

            // Siapkan label dan data untuk Chart.js
            const labels = monthlySales.map(sale => sale.bulan);
            const data = monthlySales.map(sale => sale.total);

            // Inisialisasi Chart.js untuk grafik penjualan
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Penjualan Bulanan (Rp)',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        pointRadius: 5,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan',
                                font: {
                                    size: 14
                                }
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Total Penjualan (Rp)',
                                font: {
                                    size: 14
                                }
                            },
                            beginAtZero: true
                        }
                    }
                }
            });

            // Event untuk tombol refresh
            document.getElementById('refreshSalesChart').addEventListener('click', () => {
                alert('Data grafik diperbarui!');
                // Tambahkan logika untuk memperbarui data grafik dari server
            });
        </script>
</body>

</html>