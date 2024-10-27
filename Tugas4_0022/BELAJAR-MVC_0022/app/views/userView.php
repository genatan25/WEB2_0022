<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title> <!-- Judul halaman informasi pengguna -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Menggunakan Bootstrap untuk gaya tampilan -->
</head>
<body>
    <div class="container mt-5">
        <h1>User Details</h1> <!-- Judul tampilan detail pengguna -->
        <?php if ($user): ?> <!-- Mengecek apakah data pengguna tersedia -->
            <p><strong>ID:</strong> <?php echo $user['id']; ?></p> <!-- Menampilkan ID pengguna -->
            <p><strong>Name:</strong> <?php echo $user['name']; ?></p> <!-- Menampilkan nama pengguna -->
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p> <!-- Menampilkan email pengguna -->
        <?php else: ?>
            <p>User not found.</p> <!-- Pesan jika data pengguna tidak ditemukan -->
        <?php endif; ?>
        <a href="index.php" class="btn btn-primary">Back to User List</a> <!-- Tombol kembali ke daftar pengguna -->
    </div>
</body>
</html>
