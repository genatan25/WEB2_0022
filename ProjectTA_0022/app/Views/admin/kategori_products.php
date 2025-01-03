<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Daftar Kategori</title>
    <link href="<?php echo base_url('template/css/styles.css'); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="#">Hallo Admin</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Cari kategori..." />
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu Admin</div>
                        <a class="nav-link" href="dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduk" aria-expanded="false" aria-controls="collapseProduk">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Produk
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProduk" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="manageproducts">Daftar Produk</a>
                                <a class="nav-link" href="manageCategories">Kategori Produk</a>
                            </nav>
                        </div>

                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Tampilan Depan
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Admin
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Manajemen Kategori</h1>
                    
                    <!-- Category Stats Overview -->
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body">
                                    <h5>Total Kategori</h5>
                                    <h3><?= count($categories ?? []) ?></h3>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="text-white">Jumlah kategori aktif</div>
                                    <div class="text-white"><i class="fas fa-folder"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card bg-success text-white h-100">
                                <div class="card-body">
                                    <h5>Kategori Terpopuler</h5>
                                    <h3>Kaos Polos</h3>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="text-white">Berdasarkan jumlah produk</div>
                                    <div class="text-white"><i class="fas fa-chart-line"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card bg-info text-white h-100">
                                <div class="card-body">
                                    <h5>Rata-rata Produk</h5>
                                    <h3>15</h3>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="text-white">Produk per kategori</div>
                                    <div class="text-white"><i class="fas fa-calculator"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category Management Table -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5><i class="fas fa-folder-open me-2"></i>Daftar Kategori</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                <i class="fas fa-plus me-2"></i>Tambah Kategori
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="30%">Nama Kategori</th>
                                        <th width="20%">Jumlah Produk</th>
                                        <th width="20%">Tanggal Dibuat</th>
                                        <th width="25%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($categories) && is_array($categories)) : ?>
                                        <?php foreach($categories as $category) : ?>
                                            <tr>
                                                <td><?= $category['id_kategori'] ?></td>
                                                <td><?= $category['nama_kategori'] ?></td>
                                                <td><?= $category['product_count'] ?? 0 ?> produk</td>
                                                <td><?= date('d/m/Y', strtotime($category['created_at'])) ?></td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal<?= $category['id_kategori'] ?>">
                                                        <i class="fas fa-edit me-1"></i>Ubah
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="deleteCategory(<?= $category['id_kategori'] ?>)">
                                                        <i class="fas fa-trash me-1"></i>Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add Category Modal -->
                <div class="modal fade" id="addCategoryModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Kategori Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="<?= base_url('admin/category/add') ?>" method="post">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="categoryName" class="form-label">Nama Kategori</label>
                                        <input type="text" class="form-control" id="categoryName" name="nama_kategori" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Genatan Kaos 2023</div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('template/js/scripts.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script>
        // Initialize DataTable
        const dataTable = new simpleDatatables.DataTable("#datatablesSimple");

        // Delete category confirmation
        function deleteCategory(id) {
            if(confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                window.location.href = `<?= base_url('admin/category/delete/') ?>${id}`;
            }
        }
    </script>
</body>
</html>