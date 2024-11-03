<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="h4 text-center">Edit Pelanggan</h2>
            </div>
            <div class="card-body">
                <?php if ($pelanggan): ?>
                    <form action="index.php?controller=pelanggan&action=edit" method="POST">
                        <input type="hidden" name="id_pelanggan" value="<?= htmlspecialchars($pelanggan['id_pelanggan']) ?>">

                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" value="<?= htmlspecialchars($pelanggan['nama_pelanggan']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="3" required><?= htmlspecialchars($pelanggan['alamat']) ?></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                <?php else: ?>
                    <p class="text-danger text-center">Pelanggan tidak ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
