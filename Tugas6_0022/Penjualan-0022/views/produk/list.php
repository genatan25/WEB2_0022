<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="assets/admin-lte/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
    <section class="content mt-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Produk</h3>
                    <div class="card-tools">
                        <a href="index.php?controller=produk&action=add" class="btn btn-primary btn-sm">Tambah Produk</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th style="width: 20%">Kode Barang</th>
                                <th style="width: 30%">Nama Barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1; 
                                foreach ($data_produk as $produk): 
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><a><?= htmlspecialchars($produk['kode_barang']) ?></a></td>
                                <td><a><?= htmlspecialchars($produk['nama_barang']) ?></a></td>
                                <td><?= htmlspecialchars($produk['harga']) ?></td>
                                <td><?= htmlspecialchars($produk['stok']) ?></td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="index.php?controller=produk&action=edit&kode_barang=<?= htmlspecialchars($produk['kode_barang']) ?>">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="index.php?controller=produk&action=delete&kode_barang=<?= htmlspecialchars($produk['kode_barang']) ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="assets/admin-lte/js/jquery.min.js"></script>
<script src="assets/admin-lte/js/adminlte.min.js"></script>
</body>
</html>
