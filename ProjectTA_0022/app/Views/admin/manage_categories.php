<?php
// app/Views/admin/manage_categories.php

// Pastikan bahwa semua variabel yang diperlukan diatur oleh controller
// $adminName, $initials, $colorClass, $categories
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori</title>
    <!-- Styles -->
    <link href="<?= base_url('template/css/styles.css'); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <!-- Navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="<?= base_url('/admin/dashboard'); ?>">Hallo Admin</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Form Pencarian (opsional) -->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Cari kategori..." aria-label="Cari kategori">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
        <!-- Navbar Kanan -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" 
                   id="navbarDropdown" 
                   href="#" 
                   role="button" 
                   data-bs-toggle="dropdown" 
                   aria-expanded="false">
                   <!-- Tampilkan Inisial dengan Warna Profil -->
                   <div class="rounded-circle text-white <?= esc($colorClass ?? 'bg-secondary'); ?> d-flex align-items-center justify-content-center" style="width:30px; height:30px;">
                       <?= esc($initials ?? 'A'); ?>
                   </div>
                   <span class="ms-2 d-none d-lg-inline text-white"><?= esc($adminName ?? 'Admin'); ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="<?= base_url('/admin/logout'); ?>">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Sidebar & Konten -->
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
                        
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduk">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Produk
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProduk" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?= base_url('/admin/manageProducts'); ?>">Daftar Produk</a>
                                <a class="nav-link" href="<?= base_url('/admin/manageCategories'); ?>">Kategori Produk</a>
                            </nav>
                        </div>

                        <a class="nav-link" href="<?= base_url('/admin/manage_layout'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Tampilan Depan
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?= esc($adminName ?? 'Admin'); ?>
                </div>
            </nav>
        </div>

        <!-- Konten Utama -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Manajemen Kategori</h1>

                    <!-- Breadcrumb (Optional) -->
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manajemen Kategori</li>
                    </ol>

                    <!-- Flashdata success / error -->
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

                    <!-- Card Stats (Optional) -->
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body">
                                    <h5>Total Kategori</h5>
                                    <h3><?= esc(count($categories ?? [])) ?></h3>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="text-white">Jumlah kategori aktif</div>
                                    <div class="text-white"><i class="fas fa-folder"></i></div>
                                </div>
                            </div>
                        </div>
                        <!-- Tambahkan kartu lain jika diperlukan -->
                    </div>

                    <!-- Tabel Kategori -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5><i class="fas fa-folder-open me-2"></i> Daftar Kategori</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                <i class="fas fa-plus me-2"></i> Tambah Kategori
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
                                    <?php if(!empty($categories) && is_array($categories)) : ?>
                                        <?php foreach($categories as $category) : ?>
                                            <tr>
                                                <td><?= esc($category['id_kategori']) ?></td>
                                                <td><?= esc($category['nama_kategori']) ?></td>
                                                <td><?= esc($category['total_produk'] ?? 0) ?> produk</td>
                                                <td><?= esc(date('d/m/Y', strtotime($category['created_at']))) ?></td>
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <button 
                                                        class="btn btn-success btn-sm edit-btn" 
                                                        data-id="<?= esc($category['id_kategori']) ?>"
                                                        data-nama="<?= esc($category['nama_kategori']) ?>"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editCategoryModal">
                                                        <i class="fas fa-edit me-1"></i> Ubah
                                                    </button>
                                                    <!-- Tombol Hapus -->
                                                    <button 
                                                        class="btn btn-danger btn-sm delete-btn" 
                                                        data-id="<?= esc($category['id_kategori']) ?>">
                                                        <i class="fas fa-trash me-1"></i> Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada data kategori.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Tambah Kategori -->
                <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="<?= base_url('admin/categories/add') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori Baru</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                        <input type="text" class="form-control <?= isset(session('errors')['nama_kategori']) ? 'is-invalid' : '' ?>" id="nama_kategori" name="nama_kategori" required value="<?= old('nama_kategori') ?>">
                                        <?php if (isset(session('errors')['nama_kategori'])): ?>
                                            <div class="invalid-feedback">
                                                <?= esc(session('errors')['nama_kategori']) ?>
                                            </div>
                                        <?php endif; ?>
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
                <!-- End Modal Tambah Kategori -->

                <!-- Modal Edit Kategori -->
                <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="editCategoryForm" method="post" action="<?= base_url('admin/categories/edit') ?>">
                                <?= csrf_field() ?>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCategoryModalLabel">Ubah Kategori</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Hidden field untuk ID Kategori -->
                                    <input type="hidden" name="id_kategori" id="edit_id_kategori">
                                    <div class="mb-3">
                                        <label for="edit_nama_kategori" class="form-label">Nama Kategori</label>
                                        <input type="text" class="form-control <?= isset(session('errors')['nama_kategori']) ? 'is-invalid' : '' ?>" id="edit_nama_kategori" name="nama_kategori" required value="<?= old('nama_kategori') ?>">
                                        <?php if (isset(session('errors')['nama_kategori'])): ?>
                                            <div class="invalid-feedback">
                                                <?= esc(session('errors')['nama_kategori']) ?>
                                            </div>
                                        <?php endif; ?>
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
                <!-- End Modal Edit Kategori -->
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
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Scripts -->
    <script src="<?= base_url('template/js/scripts.js'); ?>"></script>
    <!-- Simple DataTables -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
    <script>
        // Inisialisasi DataTable
        const dataTable = new simpleDatatables.DataTable("#datatablesSimple");

        // Menangani Klik Tombol Edit
        const editCategoryModal = document.getElementById('editCategoryModal');
        editCategoryModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');

            const editIdKategori = editCategoryModal.querySelector('#edit_id_kategori');
            const editNamaKategori = editCategoryModal.querySelector('#edit_nama_kategori');

            editIdKategori.value = id;
            editNamaKategori.value = nama;
        });

        // Menangani Klik Tombol Hapus
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                    window.location.href = "<?= base_url('admin/categories/delete/') ?>" + id;
                }
            });
        });
    </script>
</body>
</html>
