<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1 class="display-6">Daftar Pelanggan</h1>
            <a href="index.php?controller=pelanggan&action=add" class="btn btn-primary">Tambah Pelanggan</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th> 
                        <th>ID Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): 
                        $id_pelanggan = htmlspecialchars($row['id_pelanggan']);
                        $nama_pelanggan = htmlspecialchars($row['nama_pelanggan']);
                        $alamat = htmlspecialchars($row['alamat']);
                    ?>
                    <tr class="text-center align-middle">
                        <td><?= $no++; ?></td> 
                        <td><?= $id_pelanggan ?></td>
                        <td><?= $nama_pelanggan ?></td>
                        <td><?= $alamat ?></td>
                        <td>
                            <a href="index.php?controller=pelanggan&action=edit&id_pelanggan=<?= $id_pelanggan ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?controller=pelanggan&action=delete&id_pelanggan=<?= $id_pelanggan ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
