<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Main content -->
            <main class="col-md-12 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                    <h1><i class="fas fa-shopping-cart"></i> Kelola Order</h1>
                </div>

                <!-- Order Statistics -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Order</h5>
                                <h2><?= $stats['total'] ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <h5 class="card-title">Pending</h5>
                                <h2><?= $stats['pending'] ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5 class="card-title">Diproses</h5>
                                <h2><?= $stats['processing'] ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">Selesai</h5>
                                <h2><?= $stats['completed'] ?></h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#Order</th>
                                        <th>Pelanggan</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order): ?>
                                        <tr>
                                            <td><?= $order['id_order'] ?></td>
                                            <td>
                                                <?= esc($order['username']) ?><br>
                                                <small class="text-muted"><?= esc($order['email']) ?></small>
                                            </td>
                                            <td>Rp <?= number_format($order['total_harga'], 0, ',', '.') ?></td>
                                            <td>
                                                <span class="badge bg-<?=
                                                                        $order['status'] == 'pending' ? 'warning' : ($order['status'] == 'processing' ? 'info' : ($order['status'] == 'completed' ? 'success' : 'danger'))
                                                                        ?>">
                                                    <?= ucfirst($order['status']) ?>
                                                </span>
                                            </td>
                                            <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="<?= base_url('admin/orders/' . $order['id_order']) ?>"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button"
                                                        class="btn btn-sm btn-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown">
                                                        Update Status
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#"
                                                                onclick="updateStatus(<?= $order['id_order'] ?>, 'processing')">
                                                                Proses
                                                            </a></li>
                                                        <li><a class="dropdown-item" href="#"
                                                                onclick="updateStatus(<?= $order['id_order'] ?>, 'completed')">
                                                                Selesai
                                                            </a></li>
                                                        <li><a class="dropdown-item" href="#"
                                                                onclick="updateStatus(<?= $order['id_order'] ?>, 'cancelled')">
                                                                Batal
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateStatus(orderId, status) {
            if (confirm('Yakin ingin mengubah status order?')) {
                fetch('<?= base_url('admin/orders/update-status') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id_order: orderId,
                            status: status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert('Gagal mengupdate status');
                        }
                    });
            }
        }
    </script>
</body>

</html>