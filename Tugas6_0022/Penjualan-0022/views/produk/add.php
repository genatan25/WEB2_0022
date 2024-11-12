<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <!-- Font Awesome (required by AdminLTE) -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="background-color: #f4f6f9;">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card card-primary shadow" style="width: 100%; max-width: 500px;">
            <div class="card-header text-center">
                <h3 class="card-title">Tambah Produk</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="index.php?controller=produk&action=add" method="POST">
                    <div class="form-group mb-3">
                        <label for="kode_barang">Kode Barang</label>
                        <input type="text" class="form-control" name="kode_barang" id="kode_barang" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga" id="harga" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" name="stok" id="stok" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <!-- AdminLTE and dependencies -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/adminlte.min.js"></script>
</body>
</html>
