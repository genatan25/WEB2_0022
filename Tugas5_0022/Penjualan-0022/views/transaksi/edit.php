<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="h4 text-center">Edit Transaksi</h2>
            </div>
            <div class="card-body">
                <form action="index.php?controller=transaksi&action=edit" method="post">
                    <input type="hidden" name="id_transaksi" value="<?= htmlspecialchars($transaction['id_transaksi']); ?>">

                    <div class="mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" name="kode_barang" id="kode_barang" value="<?= htmlspecialchars($transaction['kode_barang']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
                        <input type="text" class="form-control" name="id_pelanggan" id="id_pelanggan" value="<?= htmlspecialchars($transaction['id_pelanggan']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah" value="<?= htmlspecialchars($transaction['jumlah']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="datetime-local" class="form-control" name="tanggal" id="tanggal" value="<?= htmlspecialchars($transaction['tanggal']); ?>" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
