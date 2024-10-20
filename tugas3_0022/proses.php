<?php
include 'database.php';
$db = new Database;
$aksi = $_GET['aksi'];

// Proses upload foto, jika ada file yang diupload
$foto = '';  // Inisialisasi variabel foto
if (isset($_FILES['foto']) && $_FILES['foto']['name'] != '') {
    $foto = $_FILES['foto']['name'];

    // Path penyimpanan gambar
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($foto);

    // Memeriksa apakah file yang diupload adalah gambar
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES['foto']['tmp_name']);
    if ($check !== false) {
        // Memindahkan file ke folder uploads
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {
            // Jika berhasil, lakukan sesuatu atau lanjutkan proses
        } else {
            echo "Gagal mengupload gambar.";
            exit;
        }
    } else {
        echo "File yang diupload bukan gambar.";
        exit;
    }
} 

// Logika untuk menambah data
if ($aksi == "tambah") {
    // Jika tidak ada foto yang di-upload, gunakan foto default
    if ($foto == '') {
        $foto = 'default.jpg';
    }

    $db->tambahData($_POST['nama'], $_POST['alamat'], $_POST['nohp'], $foto, $_POST['jeniskelamin'], $_POST['email']);
    header("Location: index.php");
    exit;

// Logika untuk memperbarui data
} elseif ($aksi == "update") {
    // Jika tidak ada foto baru yang di-upload, gunakan foto lama dari database
    if ($foto == '') {
        $existingData = $db->editData($_POST['id']);
        $foto = $existingData[0]['foto']; // Mengambil foto lama
    }

    $db->updateData($_POST['id'], $_POST['nama'], $_POST['alamat'], $_POST['nohp'], $foto, $_POST['jeniskelamin'], $_POST['email']);
    header("Location: index.php");
    exit;

// Logika untuk menghapus data
} elseif ($aksi == "hapus") {
    $db->hapusData($_GET['id']);
    header("Location: index.php");
    exit;
}
?>
