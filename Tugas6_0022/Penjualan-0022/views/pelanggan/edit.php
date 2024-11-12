<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
 <!-- AdminLTE CSS -->
 <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <!-- Font Awesome (required by AdminLTE) -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card card-warning">
            <div class="card-header">
                <h2 class="card-title text-center">Edit Pelanggan</h2>
            </div>
            <div class="card-body">
                <?php if ($pelanggan): ?>
                    <form action="index.php?controller=pelanggan&action=edit" method="POST">
                        <input type="hidden" name="id_pelanggan" value="<?= htmlspecialchars($pelanggan['id_pelanggan']) ?>">

                        <div class="form-group">
                            <label for="nama_pelanggan">Nama Pelanggan</label>
                            <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" value="<?= htmlspecialchars($pelanggan['nama_pelanggan']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="3" required><?= htmlspecialchars($pelanggan['alamat']) ?></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        </div>
                    </form>
                <?php else: ?>
                    <p class="text-danger text-center">Pelanggan tidak ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/adminlte.min.js"></script>
</body>
</html>
