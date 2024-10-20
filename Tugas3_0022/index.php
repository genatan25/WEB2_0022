<?php
include 'database.php'; // Mengimpor file database.php untuk menggunakan kelas Database
$db = new Database; // Membuat instance baru dari kelas Database

// Jika ada id yang dikirim, tampilkan detail, jika tidak tampilkan tabel data
if (isset($_GET['id'])) {
    $detail = $db->editData($_GET['id']); // Mengambil detail pengguna berdasarkan ID
} else {
    $dataUserList = $db->tampilData(); // Mengambil semua data pengguna jika ID tidak ada
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>OOP PHP CRUD</title>
</head>
<body>
<div class="container mt-3">
    <h1>OOP PHP CRUD</h1>
    <hr>

    <?php if (isset($detail) && !empty($detail)) { ?>
        <!-- Bagian untuk Detail Pengguna -->
        <h2>Detail Pengguna</h2>
        <?php foreach ($detail as $dataUser) { ?>
            <div class="card mb-3" style="width: 18rem;">
                <?php
                // Cek apakah gambar ada
                $imagePath = "uploads/" . $dataUser['foto'];
                if (file_exists($imagePath) && !empty($dataUser['foto'])) {
                    echo '<img src="' . $imagePath . '" class="card-img-top" alt="Foto Pengguna">'; // Menampilkan foto pengguna jika ada
                } else {
                    // Tampilkan gambar placeholder jika tidak ada
                    echo '<img src="uploads/default.jpg" class="card-img-top" alt="Gambar tidak tersedia">'; // Gambar placeholder
                }
                ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($dataUser['nama']); ?></h5> <!-- Menampilkan nama pengguna -->
                    <p class="card-text"><strong>Jenis Kelamin:</strong> <?php echo htmlspecialchars($dataUser['jeniskelamin']); ?></p> <!-- Menampilkan jenis kelamin -->
                    <p class="card-text"><strong>No HP:</strong> <?php echo htmlspecialchars($dataUser['nohp']); ?></p> <!-- Menampilkan nomor HP -->
                    <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($dataUser['email']); ?></p> <!-- Menampilkan email -->
                    <p class="card-text"><strong>Alamat:</strong> <?php echo htmlspecialchars($dataUser['alamat']); ?></p> <!-- Menampilkan alamat -->
                    <a href="index.php" class="btn btn-primary">Kembali</a> <!-- Tombol untuk kembali ke halaman utama -->
                </div>
            </div>
        <?php } ?>

    <?php } else { ?>
        <!-- Bagian untuk Tabel Data -->
        <a href="input.php" class="btn btn-success">Tambah Data</a> <!-- Tombol untuk menambah data pengguna -->
        <hr>
        <?php if (!empty($dataUserList)) { ?>
            <table class="table table-hover"> <!-- Tabel untuk menampilkan daftar pengguna -->
                <thead>
                <tr>
                    <td scope="col">No</td>
                    <td scope="col">Nama</td>
                    <td scope="col">Alamat</td>
                    <td scope="col">No HP</td>
                    <td scope="col">Aksi</td>
                </tr>
                </thead>
                <tbody>
                <?php
                $nomor = 1; // Variabel untuk nomor urut
                foreach ($dataUserList as $dataUser) { ?>
                    <tr>
                        <th scope="row"><?php echo $nomor++; ?></th> <!-- Menampilkan nomor urut -->
                        <td><?php echo htmlspecialchars($dataUser['nama']); ?></td> <!-- Menampilkan nama pengguna -->
                        <td><?php echo htmlspecialchars($dataUser['alamat']); ?></td> <!-- Menampilkan alamat pengguna -->
                        <td><?php echo htmlspecialchars($dataUser['nohp']); ?></td> <!-- Menampilkan nomor HP pengguna -->
                        <td>
                            <a href="edit.php?id=<?php echo $dataUser['id']; ?>" class="btn btn-warning btn-sm">Edit</a> <!-- Tombol untuk mengedit pengguna -->
                            <a href="proses.php?id=<?php echo $dataUser['id']; ?>&aksi=hapus" class="btn btn-danger btn-sm">Hapus</a> <!-- Tombol untuk menghapus pengguna -->
                            <a href="index.php?id=<?php echo $dataUser['id']; ?>" class="btn btn-info btn-sm">Detail</a> <!-- Tombol untuk melihat detail pengguna -->
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Tidak ada data pengguna yang tersedia.</p> <!-- Pesan jika tidak ada data pengguna -->
        <?php } ?>
    <?php } ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
