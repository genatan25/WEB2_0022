<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link rel="stylesheet" href="assets/admin-lte/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
    <section class="content mt-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Transaksi</h3>
                    <div class="card-tools">
                        <a href="index.php?controller=transaksi&action=add" class="btn btn-primary btn-sm">Tambah Transaksi</a>
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
                                <th style="width: 15%">ID Transaksi</th>
                                <th style="width: 15%">Kode Barang</th>
                                <th style="width: 15%">ID Pelanggan</th>
                                <th style="width: 10%">Jumlah</th>
                                <th style="width: 15%">Tanggal</th>
                                <th style="width: 15%">Total Harga</th>
                                <th style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): 
                                $id_transaksi = htmlspecialchars($row['id_transaksi']);
                                $kode_barang = htmlspecialchars($row['kode_barang']);
                                $id_pelanggan = htmlspecialchars($row['id_pelanggan']);
                                $jumlah = htmlspecialchars($row['jumlah']);
                                $tanggal = htmlspecialchars($row['tanggal']);
                                $total_harga = htmlspecialchars($row['total_harga']);
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><a><?= $id_transaksi ?></a></td>
                                <td><?= $kode_barang ?></td>
                                <td><?= $id_pelanggan ?></td>
                                <td><?= $jumlah ?></td>
                                <td><?= $tanggal ?></td>
                                <td><?= $total_harga ?></td>
                                <td class="project-actions text-right">
                                    <a href="index.php?controller=transaksi&action=edit&id_transaksi=<?= $id_transaksi ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <form action="index.php?controller=transaksi&action=delete" method="POST" style="display:inline;">
                                        <input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endwhile; ?>
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
