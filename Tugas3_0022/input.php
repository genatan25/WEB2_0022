<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-3">
        <!-- Menambahkan teks judul -->
        <h1>OOP PHP CRUD</h1>
        <h4>Tambah Data</h4>
        <hr class="mt-0">
        
        <!-- Membuat form input data user -->
        <form method="POST" action="proses.php?aksi=tambah" enctype="multipart/form-data">
            <!-- Nama input -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            
            <!-- Alamat input -->
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
            </div>
            
            <!-- No HP input -->
            <div class="mb-3">
                <label for="nohp" class="form-label">No HP</label>
                <input type="number" class="form-control" id="nohp" name="nohp" required>
            </div>
            
            <!-- Jenis Kelamin input -->
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label><br>
                <input type="radio" id="laki" name="jeniskelamin" value="Laki-laki" required>
                <label for="laki">Laki-laki</label>
                <input type="radio" id="perempuan" name="jeniskelamin" value="Perempuan" required>
                <label for="perempuan">Perempuan</label>
            </div>
            
            <!-- Email input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <!-- Foto input -->
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
            </div>
            
            <!-- Tombol submit -->
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+G7mDkLcM/a8dIY5Kj2vKJp5LGiG9"
            crossorigin="anonymous"></script>
</body>
</html>
