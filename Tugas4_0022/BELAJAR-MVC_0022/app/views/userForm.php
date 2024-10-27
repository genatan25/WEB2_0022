<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($user) ? 'Edit User' : 'Tambah User'; ?></title> <!-- Menampilkan judul 'Edit User' jika ada data user, jika tidak, 'Tambah User' -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Menggunakan Bootstrap untuk gaya tampilan -->
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo isset($user) ? 'Edit User' : 'Tambah User'; ?></h1> <!-- Menampilkan judul sesuai kondisi (edit atau tambah user) -->
        <form action="index.php?action=save" method="POST"> <!-- Form mengarah ke index.php dengan aksi simpan data pengguna -->
            <?php if (isset($user)): ?>
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>"> <!-- Input tersembunyi untuk menyimpan ID jika edit user -->
            <?php endif; ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($user) ? $user['name'] : ''; ?>" required> <!-- Input untuk nama pengguna -->
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($user) ? $user['email'] : ''; ?>" required> <!-- Input untuk email pengguna -->
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button> <!-- Tombol untuk menyimpan data -->
            <a href="index.php" class="btn btn-secondary">Batal</a> <!-- Tombol untuk batal dan kembali ke halaman utama -->
        </form>
    </div>
</body>
</html>
