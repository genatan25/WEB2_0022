<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title> <!-- Judul halaman daftar pengguna -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Menggunakan Bootstrap untuk gaya tampilan -->
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">User List</h1> <!-- Judul tampilan daftar pengguna -->
        <a href="index.php?action=form" class="btn btn-success mb-3">Tambah User</a> <!-- Tombol untuk menambah pengguna baru -->
        <table class="table table-bordered"> <!-- Tabel untuk menampilkan daftar pengguna -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th> <!-- Kolom aksi (detail, edit, hapus) -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?> <!-- Loop untuk menampilkan setiap pengguna dalam tabel -->
                    <tr>
                        <td><?php echo $user['id']; ?></td> <!-- Menampilkan ID pengguna -->
                        <td><?php echo $user['name']; ?></td> <!-- Menampilkan nama pengguna -->
                        <td><?php echo $user['email']; ?></td> <!-- Menampilkan email pengguna -->
                        <td>
                            <!-- Tombol untuk melihat detail pengguna -->
                            <a href="index.php?action=show&id=<?php echo $user['id']; ?>" class="btn btn-info btn-sm">Detail</a>
                            <!-- Tombol untuk mengedit pengguna -->
                            <a href="index.php?action=form&id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <!-- Tombol untuk menghapus pengguna, dengan konfirmasi sebelum menghapus -->
                            <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
