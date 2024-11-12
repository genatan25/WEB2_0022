<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
    <link rel="stylesheet" href="assets/admin-lte/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
    <section class="content mt-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pelanggan</h3>
                    <div class="card-tools">
                        <a href="index.php?controller=pelanggan&action=add" class="btn btn-primary btn-sm">Tambah Pelanggan</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th style="width: 20%">ID Pelanggan</th>
                                <th style="width: 30%">Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th style="width: 8%" class="text-center">Status</th>
                                <th style="width: 20%">Aksi</th>
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
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><a><?= $id_pelanggan ?></a></td>
                                <td><a><?= $nama_pelanggan ?></a></td>
                                <td><?= $alamat ?></td>
                                <td class="project-state">
                                    <span class="badge badge-success">Active</span>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="index.php?controller=pelanggan&action=edit&id_pelanggan=<?= $id_pelanggan ?>">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="index.php?controller=pelanggan&action=delete&id_pelanggan=<?= $id_pelanggan ?>" onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="assets/admin-lte/js/jquery.min.js"></script>
<script src="assets/admin-lte/js/adminlte.min.js"></script>
</body>
</html>
