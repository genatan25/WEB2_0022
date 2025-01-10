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
                    <li><hr class="dropdown-divider"></li>
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
                            </nav>
                        </div>

                        <!-- Frontend Layout -->
                        <a class="nav-link" href="<?= base_url('/admin/manage_layout'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Tampilan Depan
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

                    <!-- Recent Sales Chart (Optional) -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-line me-1"></i>
                                    Grafik Penjualan
                                </div>
                                <div class="card-body">
                                    <canvas id="salesChart" width="100%" height="40"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Recent Orders or Other Widgets -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-list me-1"></i>
                                    Pesanan Terbaru
                                </div>
                                <div class="card-body">
                                    <!-- Contoh Daftar Pesanan -->
                                    <ul class="list-group">
                                        <li class="list-group-item">Pesanan #001 - Rp 150.000</li>
                                        <li class="list-group-item">Pesanan #002 - Rp 200.000</li>
                                        <li class="list-group-item">Pesanan #003 - Rp 350.000</li>
                                        <li class="list-group-item">Pesanan #004 - Rp 120.000</li>
                                        <li class="list-group-item">Pesanan #005 - Rp 500.000</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products Table -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5><i class="fas fa-tshirt me-1"></i> Daftar Produk</h5>
                            <!-- Add Product Button -->
                            <a href="<?= base_url('/admin/manageProducts/add'); ?>" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i> Tambah Produk
                            </a>
                        </div>
                        <div class="card-body">
                            <!-- Data Table -->
                            <table id="datatablesSimple" class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($products) && is_array($products)): ?>
                                        <?php foreach ($products as $idx => $p): ?>
                                            <tr>
                                                <td><?= esc($idx + 1); ?></td>
                                                <td><?= esc($p['nama_produk']); ?></td>
                                                <td>Rp <?= number_format($p['harga'], 0, ',', '.'); ?></td>
                                                <td><?= esc($p['stok']); ?></td>
                                                <td><?= esc($p['nama_kategori']); ?></td>
                                                <td>
                                                    <a href="<?= base_url('/admin/manageProducts/edit/' . $p['id_produk']); ?>" class="btn btn-success btn-sm me-2">
                                                        <i class="fas fa-edit me-1"></i> Ubah
                                                    </a>
                                                    <a href="<?= base_url('/admin/manageProducts/delete/' . $p['id_produk']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?');">
                                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data produk.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>

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
        // Example Sales Chart
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Penjualan Bulanan',
                    data: [500000, 700000, 800000, 600000, 900000, 1000000, 850000, 750000, 950000, 1100000, 1200000, 1300000],
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        },
                        title: {
                            display: true,
                            text: 'Total Penjualan'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
