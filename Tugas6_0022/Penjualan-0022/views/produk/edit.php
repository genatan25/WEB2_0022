<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
 <!-- AdminLTE CSS -->
 <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <!-- Font Awesome (required by AdminLTE) -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page bg-light">
    <div class="container mt-5">
        <div class="card card-warning">
            <div class="card-header">
                <h2 class="card-title text-center">Edit Produk</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?controller=produk&action=edit">
                    <input type="hidden" name="kode_barang" value="<?= htmlspecialchars($produk['kode_barang']) ?>">

                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="<?= htmlspecialchars($produk['nama_barang']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" step="0.01" name="harga" id="harga" value="<?= htmlspecialchars($produk['harga']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok" id="stok" value="<?= htmlspecialchars($produk['stok']) ?>" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/adminlte.min.js"></script>
</body>
</html>
