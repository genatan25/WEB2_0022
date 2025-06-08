<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Detail Produk</title>
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
                <input class="form-control" type="text" placeholder="Cari Detail Produk..." aria-label="Cari kategori">
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
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?= base_url('/admin/logout'); ?>">Logout</a></li>
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

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Manajemen Detail Produk</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Detail Produk</li>
                    </ol>

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-info-circle me-2"></i>Daftar Detail Produk
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addDetailModal">
                                Tambah Detail
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID Detail</th>
                                        <th>ID Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Kunci</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($productDetails as $detail) : ?>
                                        <tr>
                                            <td><?= $detail['id_detail']; ?></td>
                                            <td><?= $detail['id_produk']; ?></td>
                                            <td><?= $detail['nama_produk']; ?></td>
                                            <td><?= $detail['key']; ?></td>
                                            <td><?= $detail['value']; ?></td>
                                            <td>
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editDetailModal"
                                                    data-id="<?= $detail['id_detail']; ?>"
                                                    data-id-produk="<?= $detail['id_produk']; ?>"
                                                    data-key="<?= $detail['key']; ?>"
                                                    data-value="<?= $detail['value']; ?>">Edit</button>
                                                <a href="<?= base_url('/admin/productDetails/delete/' . $detail['id_detail']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus detail ini?');">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal Tambah Detail -->
                    <div class="modal fade" id="addDetailModal" tabindex="-1" aria-labelledby="addDetailModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="<?= base_url('/admin/productDetails/add'); ?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addDetailModalLabel">Tambah Detail Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="id_produk" class="form-label">ID Produk</label>
                                            <input type="number" class="form-control" id="id_produk" name="id_produk" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="key" class="form-label">Kunci</label>
                                            <input type="text" class="form-control" id="key" name="key" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="value" class="form-label">Nilai</label>
                                            <input type="text" class="form-control" id="value" name="value" required>
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

                    <!-- Modal Edit Detail -->
                    <div class="modal fade" id="editDetailModal" tabindex="-1" aria-labelledby="editDetailModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="<?= base_url('/admin/productDetails/edit'); ?>">
                                    <input type="hidden" id="edit_id_detail" name="id_detail">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editDetailModalLabel">Edit Detail Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="edit_id_produk" class="form-label">ID Produk</label>
                                            <input type="number" class="form-control" id="edit_id_produk" name="id_produk" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_key" class="form-label">Kunci</label>
                                            <input type="text" class="form-control" id="edit_key" name="key" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_value" class="form-label">Nilai</label>
                                            <input type="text" class="form-control" id="edit_value" name="value" required>
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
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; Genatan Kaos <?= date('Y'); ?></div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            <span>&middot;</span>
                            <a href="#">Terms & Conditions</a>
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
        const dataTable = new simpleDatatables.DataTable("#datatablesSimple");
        const editDetailModal = document.getElementById('editDetailModal');

        editDetailModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const id_produk = button.getAttribute('data-id-produk');
            const key = button.getAttribute('data-key');
            const value = button.getAttribute('data-value');

            editDetailModal.querySelector('#edit_id_detail').value = id;
            editDetailModal.querySelector('#edit_id_produk').value = id_produk;
            editDetailModal.querySelector('#edit_key').value = key;
            editDetailModal.querySelector('#edit_value').value = value;
        });
    </script>
</body>

</html>