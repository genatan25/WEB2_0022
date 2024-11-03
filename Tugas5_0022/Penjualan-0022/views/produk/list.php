<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1 class="display-6">Daftar Produk</h1>
            <a href="index.php?controller=produk&action=add" class="btn btn-primary">Tambah Produk</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th> 
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 1; 
                        foreach ($data_produk as $produk): 
                    ?>
                        <tr class="text-center align-middle">
                            <td><?= $no++; ?></td> 
                            <td><?= htmlspecialchars($produk['kode_barang']) ?></td>
                            <td><?= htmlspecialchars($produk['nama_barang']) ?></td>
                            <td><?= htmlspecialchars($produk['harga']) ?></td>
                            <td><?= htmlspecialchars($produk['stok']) ?></td>
                            <td>
                                <a href="index.php?controller=produk&action=edit&kode_barang=<?= htmlspecialchars($produk['kode_barang']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?controller=produk&action=delete&kode_barang=<?= htmlspecialchars($produk['kode_barang']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
