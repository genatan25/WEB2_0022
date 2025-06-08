<?php
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
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
                <input class="form-control" type="text" placeholder="Cari produk..." aria-label="Cari produk">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
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

        <!-- Konten Utama -->
        <div id="layoutSidenav_content">
            <main class="container-fluid px-4">
                <h1 class="mt-4">Daftar Produk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Produk</li>
                </ol>

                <!-- Flashdata success / error -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= esc(session()->getFlashdata('success')) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <?php $errorData = session()->getFlashdata('error'); ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php
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

                <!-- Tabel Produk -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5><i class="fas fa-table me-1"></i> Daftar Produk</h5>
                        <!-- Tombol Tambah Produk -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="fas fa-plus me-2"></i> Tambah Produk
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- Tabel Produk -->
                        <table id="datatablesSimple" class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Gambar</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal Input</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <tr>
                                            <td><?= esc($product['id_produk']) ?></td>
                                            <td><?= esc($product['nama_produk']) ?></td>
                                            <td><?= esc($product['nama_kategori']) ?></td>
                                            <td>Rp <?= number_format($product['harga'], 0, ',', '.') ?></td>
                                            <td><?= esc($product['stok']) ?></td>
                                            <td>
                                                <?php if (!empty($product['gambar'])): ?>
                                                    <img src="<?= base_url($product['gambar']) ?>" width="50" alt="<?= esc($product['nama_produk']) ?>" class="img-thumbnail">
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td><?= esc($product['deskripsi']) ?></td>
                                            <td><?= esc(date('d/m/Y', strtotime($product['created_at']))) ?></td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <button
                                                    class="btn btn-success btn-sm edit-btn"
                                                    data-product='<?= json_encode($product) ?>'
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editProductModal">
                                                    <i class="fas fa-edit me-1"></i> Ubah
                                                </button>
                                                <!-- Tombol Hapus -->
                                                <button
                                                    class="btn btn-danger btn-sm delete-btn"
                                                    data-id="<?= esc($product['id_produk']) ?>">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="text-center">Belum ada produk.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

            <!-- Modal Tambah Produk -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="addProductForm" method="post" action="<?= base_url('admin/products/add') ?>" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="addProductModalLabel">Tambah Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nama_produk" class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control <?= isset(session('errors')['nama_produk']) ? 'is-invalid' : '' ?>" name="nama_produk" id="nama_produk" required value="<?= old('nama_produk') ?>">
                                        <?php if (isset(session('errors')['nama_produk'])): ?>
                                            <div class="invalid-feedback">
                                                <?= esc(session('errors')['nama_produk']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="id_kategori" class="form-label">Kategori</label>
                                        <select class="form-select <?= isset(session('errors')['id_kategori']) ? 'is-invalid' : '' ?>" name="id_kategori" id="id_kategori" required>
                                            <option value="">Pilih Kategori</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= esc($category['id_kategori']) ?>" <?= old('id_kategori') == $category['id_kategori'] ? 'selected' : '' ?>>
                                                    <?= esc($category['nama_kategori']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (isset(session('errors')['id_kategori'])): ?>
                                            <div class="invalid-feedback">
                                                <?= esc(session('errors')['id_kategori']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="number" class="form-control <?= isset(session('errors')['harga']) ? 'is-invalid' : '' ?>" name="harga" id="harga" min="1" required value="<?= old('harga') ?>">
                                        <?php if (isset(session('errors')['harga'])): ?>
                                            <div class="invalid-feedback">
                                                <?= esc(session('errors')['harga']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="stok" class="form-label">Stok</label>
                                        <input type="number" class="form-control <?= isset(session('errors')['stok']) ? 'is-invalid' : '' ?>" name="stok" id="stok" min="0" required value="<?= old('stok') ?>">
                                        <?php if (isset(session('errors')['stok'])): ?>
                                            <div class="invalid-feedback">
                                                <?= esc(session('errors')['stok']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="gambar" class="form-label">Gambar Produk</label>
                                        <input type="file" class="form-control <?= isset(session('errors')['gambar']) ? 'is-invalid' : '' ?>" name="gambar" id="gambar" accept="image/*" required>
                                        <?php if (isset(session('errors')['gambar'])): ?>
                                            <div class="invalid-feedback">
                                                <?= esc(session('errors')['gambar']) ?>
                                            </div>
                                        <?php endif; ?>
                                        <img id="addImagePreview" src="#" alt="Preview Gambar" class="modal-img-preview" style="display: none;">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                                        <textarea class="form-control <?= isset(session('errors')['deskripsi']) ? 'is-invalid' : '' ?>" name="deskripsi" id="deskripsi" rows="4" required><?= esc(old('deskripsi')) ?></textarea>
                                        <?php if (isset(session('errors')['deskripsi'])): ?>
                                            <div class="invalid-feedback">
                                                <?= esc(session('errors')['deskripsi']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
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
            <!-- End Modal Tambah Produk -->

            <!-- Modal Edit Produk -->
            <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="editProductForm" method="post" action="<?= base_url('admin/products/edit') ?>" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProductModalLabel">Ubah Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <!-- Hidden field untuk ID Produk -->
                                    <div class="col-md-12">
                                        <input type="hidden" name="id_produk" id="edit_id_produk">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_nama_produk" class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control <?= isset(session('errors')['nama_produk']) ? 'is-invalid' : '' ?>" name="nama_produk" id="edit_nama_produk" required>
                                        <?php if (isset(session('errors')['nama_produk'])): ?>
                                            <div class="invalid-feedback">
                                                <?= esc(session('errors')['nama_produk']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_id_kategori" class="form-label">Kategori</label>
                                        <select class="form-select <?= isset(session('errors')['id_kategori']) ? 'is-invalid' : '' ?>" name="id_kategori" id="edit_id_kategori" required>
                                            <option value="">Pilih Kategori</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= esc($category['id_kategori']) ?>">
                                                    <?= esc($category['nama_kategori']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (isset(session('errors')['id_kategori'])): ?>
                                            <div class="invalid-feedback">
                                                <?= esc(session('errors')['id_kategori']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_harga" class="form-label">Harga</label>
                                        <input type="number" class="form-control <?= isset(session('errors')['harga']) ? 'is-invalid' : '' ?>" name="harga" id="edit_harga" min="1" required>
                                        <?php if (isset(session('errors')['harga'])): ?>
                                            <div class="invalid-feedback">
                                                <?= esc(session('errors')['harga']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_stok" class="form-label">Stok</label>
                                        <input type="number" class="form-control <?= isset(session('errors')['stok']) ? 'is-invalid' : '' ?>" name="stok" id="edit_stok" min="0" required>
                                        <?php if (isset(session('errors')['stok'])): ?>
                                            <div class="invalid-feedback">
                                                <?= esc(session('errors')['stok']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="edit_gambar" class="form-label">Gambar Produk (Opsional)</label>
                                        <input type="file" class="form-control <?= isset(session('errors')['gambar']) ? 'is-invalid' : '' ?>" name="gambar" id="edit_gambar" accept="image/*">
                                        <?php if (isset(session('errors')['gambar'])): ?>
                                            <div class="invalid-feedback">
                                                <?= esc(session('errors')['gambar']) ?>
                                            </div>
                                        <?php endif; ?>
                                        <img id="editImagePreview" src="#" alt="Preview Gambar" style="display: none; max-width: 100%; height: auto; max-height: 200px; border: 1px solid #ddd; margin-top: 10px;">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="edit_deskripsi" class="form-label">Deskripsi Produk</label>
                                        <textarea class="form-control <?= isset(session('errors')['deskripsi']) ? 'is-invalid' : '' ?>" name="deskripsi" id="edit_deskripsi" rows="4" required></textarea>
                                        <?php if (isset(session('errors')['deskripsi'])): ?>
                                            <div class="invalid-feedback">
                                                <?= esc(session('errors')['deskripsi']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
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
            <!-- End Modal Edit Produk -->

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
        const editProductModal = document.getElementById('editProductModal');
        editProductModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const product = JSON.parse(button.getAttribute('data-product'));

            const modalTitle = editProductModal.querySelector('.modal-title');
            const editIdProduk = editProductModal.querySelector('#edit_id_produk');
            const editNamaProduk = editProductModal.querySelector('#edit_nama_produk');
            const editIdKategori = editProductModal.querySelector('#edit_id_kategori');
            const editHarga = editProductModal.querySelector('#edit_harga');
            const editStok = editProductModal.querySelector('#edit_stok');
            const editDeskripsi = editProductModal.querySelector('#edit_deskripsi');
            const editImagePreview = editProductModal.querySelector('#editImagePreview');

            modalTitle.textContent = 'Ubah Produk';
            editIdProduk.value = product.id_produk;
            editNamaProduk.value = product.nama_produk;
            editIdKategori.value = product.id_kategori;
            editHarga.value = product.harga;
            editStok.value = product.stok;
            editDeskripsi.value = product.deskripsi;

            // Menampilkan gambar saat ini jika ada
            if (product.gambar) {
                editImagePreview.src = "<?= base_url('/') ?>" + product.gambar;
                editImagePreview.style.display = 'block';
            } else {
                editImagePreview.src = '#';
                editImagePreview.style.display = 'none';
            }
        });

        // Menangani Klik Tombol Hapus
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                if (confirm('Anda yakin ingin menghapus produk ini?')) {
                    window.location.href = "<?= base_url('admin/products/delete/') ?>" + id;
                }
            });
        });

        // Preview Gambar untuk Tambah Produk
        document.getElementById('gambar').addEventListener('change', function() {
            const [file] = this.files;
            if (file) {
                const preview = document.getElementById('addImagePreview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                const preview = document.getElementById('addImagePreview');
                preview.src = '#';
                preview.style.display = 'none';
            }
        });

        // Preview Gambar untuk Edit Produk
        document.getElementById('edit_gambar').addEventListener('change', function() {
            const [file] = this.files;
            if (file) {
                const preview = document.getElementById('editImagePreview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                const preview = document.getElementById('editImagePreview');
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>
</body>

</html>