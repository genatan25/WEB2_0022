<?php 
include 'database.php'; // Mengimpor file database.php untuk menggunakan kelas Database

$db = new Database; // Membuat instance baru dari kelas Database

// Validasi apakah id sudah diset
if (isset($_GET['id'])) {
    $detail = $db->editData($_GET['id']); // Mengambil detail data berdasarkan ID yang diberikan
} else {
    echo "ID tidak ditemukan."; // Pesan jika ID tidak ada
    exit; // Menghentikan eksekusi script
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP PHP CRUD - Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">
        <h1>OOP PHP CRUD</h1>
        <h2>Edit Data</h2>
        <hr class="mt-0">

        <!-- Periksa apakah data ditemukan -->
        <?php if (!empty($detail)) { ?>
            <form method="POST" action="proses.php?aksi=update" enctype="multipart/form-data">
                <?php foreach ($detail as $dataUser) { ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($dataUser['id']); ?>"> <!-- Menyimpan ID sebagai input tersembunyi -->
                
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($dataUser['nama']); ?>" required> <!-- Input untuk nama -->
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" required><?php echo htmlspecialchars($dataUser['alamat']); ?></textarea> <!-- Input untuk alamat -->
                </div>
                <div class="mb-3">
                    <label for="nohp" class="form-label">No HP</label>
                    <input type="text" class="form-control" id="nohp" name="nohp" value="<?php echo htmlspecialchars($dataUser['nohp']); ?>" required> <!-- Input untuk nomor HP -->
                </div>
                
                <!-- Input untuk foto -->
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto"> <!-- Input untuk mengunggah foto -->
                    <?php if (!empty($dataUser['foto'])) { ?>
                        <p>Foto saat ini: <img src="uploads/<?php echo htmlspecialchars($dataUser['foto']); ?>" alt="Foto Pengguna" width="100"></p> <!-- Menampilkan foto yang ada -->
                    <?php } else { ?>
                        <p>Foto belum diunggah.</p> <!-- Pesan jika foto belum ada -->
                    <?php } ?>
                </div>

                <!-- Input untuk jenis kelamin -->
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jeniskelamin" required> <!-- Dropdown untuk memilih jenis kelamin -->
                        <option value="Laki-laki" <?php echo ($dataUser['jeniskelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php echo ($dataUser['jeniskelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>

                <!-- Input untuk email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($dataUser['email']); ?>" required> <!-- Input untuk email -->
                </div>

                <button type="submit" class="btn btn-success">Simpan</button> <!-- Tombol untuk menyimpan perubahan -->
                <?php } ?>
            </form>
        <?php } else { ?>
            <p>Data tidak ditemukan.</p> <!-- Pesan jika tidak ada data -->
        <?php } ?>
    </div>
</body>
</html>
