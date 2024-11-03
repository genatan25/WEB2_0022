<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1 class="display-6 mb-0">Daftar Transaksi</h1>
            <a href="index.php?controller=transaksi&action=add" class="btn btn-primary">Tambah Transaksi</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Kode Barang</th>
                        <th>ID Pelanggan</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
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
                    <tr class="text-center align-middle">
                        <td><?= $no++ ?></td>
                        <td><?= $id_transaksi ?></td>
                        <td><?= $kode_barang ?></td>
                        <td><?= $id_pelanggan ?></td>
                        <td><?= $jumlah ?></td>
                        <td><?= $tanggal ?></td>
                        <td><?= $total_harga ?></td>
                        <td>
                            <a href="index.php?controller=transaksi&action=edit&id_transaksi=<?= $id_transaksi ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form action="index.php?controller=transaksi&action=delete" method="POST" style="display:inline;">
                                <input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
