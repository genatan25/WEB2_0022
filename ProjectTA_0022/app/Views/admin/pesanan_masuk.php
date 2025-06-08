<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <!-- Styles -->
    <link href="<?= base_url('template/css/styles.css'); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Print Styles -->
    <style>
        @media print {
            body {
                font-family: Arial, sans-serif;
            }

            .container-fluid {
                max-width: 100%;
            }

            .navbar,
            .footer,
            #layoutSidenav_nav {
                display: none;
            }

            .content-wrapper {
                margin-top: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }

            table th,
            table td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }

            table th {
                background-color: #f2f2f2;
            }

            #transactionDetails {
                margin-top: 20px;
            }

            #transactionDetails table {
                width: 100%;
                border: 1px solid #ddd;
            }

            #transactionDetails table th,
            #transactionDetails table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            #transactionDetails img {
                width: 50px;
                height: auto;
            }

            #transactionDetails h6 {
                margin: 10px 0;
            }
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <!-- Navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="<?= base_url('/admin/dashboard'); ?>">Hallo Admin</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Cari transaksi..." aria-label="Cari produk">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center"
                    id="navbarDropdown"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="rounded-circle text-white <?= esc($colorClass ?? 'bg-secondary'); ?> d-flex align-items-center justify-content-center" style="width:30px; height:30px;">
                        <?= esc($initials ?? 'A'); ?>
                    </div>
                    <span class="ms-2 d-none d-lg-inline text-white"><?= esc($adminName ?? 'Admin'); ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?= base_url('/admin/logout'); ?>">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Sidebar & Content -->
    <div id="layoutSidenav">
        <!-- Sidebar -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu Admin</div>
                        <a class="nav-link" href="<?= base_url('/admin/dashboard'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed" href="#"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseProduk"
                            aria-expanded="false">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Produk
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProduk" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?= base_url('/admin/manageProducts'); ?>">Daftar Produk</a>
                                <a class="nav-link" href="<?= base_url('/admin/manageCategories'); ?>">Kategori Produk</a>
                                <a class="nav-link" href="<?= base_url('admin/productDetails'); ?>">Detail Produk</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="<?= base_url('/admin/orders'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-bag"></i></div>
                            Pesanan Masuk
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?= esc($adminName ?? 'Admin'); ?>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div id="layoutSidenav_content">
            <main class="container-fluid px-4">
                <h1 class="mt-4">Data Transaksi</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard'); ?>">Dashboard</a></li>
                </ol>

                <!-- Transaction Table -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5><i class="fas fa-table me-1"></i> Daftar Transaksi</h5>
                        <button class="btn btn-success" onclick="window.print();">
                            <i class="fas fa-print"></i> Cetak
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nama Pengguna</th>
                                    <th>Jumlah Produk</th>
                                    <th>Grand Total</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($transactions)): ?>
                                    <?php foreach ($transactions as $transaction): ?>
                                        <tr>
                                            <td><?= esc($transaction['username']) ?></td>
                                            <td><?= esc($transaction['jml_produk']) ?></td>
                                            <td>Rp <?= number_format($transaction['grand_total'], 0, ',', '.') ?></td>
                                            <td><?= esc(date('d/m/Y', strtotime($transaction['tgl_transaksi']))) ?></td>
                                            <td>
                                                <button class="btn btn-info btn-sm view-detail-btn"
                                                    data-id="<?= esc($transaction['id_transaction']) ?>">
                                                    <i class="fas fa-eye me-1"></i> Lihat Detail
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada transaksi.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal for Transaction Details -->
                <div class="modal fade" id="viewTransactionModal" tabindex="-1" aria-labelledby="viewTransactionModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewTransactionModalLabel">Detail Transaksi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="transactionDetails">
                                    <!-- Transaction details will be loaded through JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const viewDetailButtons = document.querySelectorAll('.view-detail-btn');
                        const transactionDetails = document.getElementById('transactionDetails');
                        const transactionModal = new bootstrap.Modal(document.getElementById('viewTransactionModal'));

                        viewDetailButtons.forEach(button => {
                            button.addEventListener('click', function() {
                                const transactionId = this.getAttribute('data-id');

                                // Show loading message while fetching data
                                transactionDetails.innerHTML = '<p class="text-center">Memuat data...</p>';

                                // Fetch transaction details via AJAX
                                fetch(`<?= base_url('/admin/orders/getTransactionDetails') ?>/${transactionId}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            const products = data.products.map(product => `
                                                <tr>
                                                    <td>
                                                        <img src="<?= base_url('/') ?>${product.gambar}" alt="${product.nama_produk}" width="50" class="me-2">
                                                        ${product.nama_produk}
                                                    </td>
                                                    <td>${product.jumlah}</td>
                                                    <td>Rp ${parseInt(product.harga).toLocaleString('id-ID')}</td>
                                                    <td>Rp ${parseInt(product.total_harga).toLocaleString('id-ID')}</td>
                                                </tr>
                                            `).join('');

                                            transactionDetails.innerHTML = `
                                                <h6>Nama Pengguna: ${data.username}</h6>
                                                <h6>Tanggal Transaksi: ${data.tgl_transaksi}</h6>
                                                <hr>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Produk</th>
                                                            <th>Jumlah</th>
                                                            <th>Harga</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        ${products}
                                                    </tbody>
                                                </table>
                                            `;
                                        } else {
                                            transactionDetails.innerHTML = '<p class="text-center text-danger">Gagal memuat detail transaksi.</p>';
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        transactionDetails.innerHTML = '<p class="text-center text-danger">Terjadi kesalahan saat memuat data.</p>';
                                    });

                                // Show modal
                                transactionModal.show();
                            });
                        });
                    });
                </script>
            </main>

            <!-- Footer -->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; Genatan Kaos <?= date('Y'); ?></div>
                        <div>
                            <a href="#">Privacy Policy</a> &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('template/js/scripts.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script>
        // Initialize DataTable
        const dataTable = new simpleDatatables.DataTable("#datatablesSimple");
    </script>
</body>

</html>