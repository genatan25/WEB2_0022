<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Penghitung Belanja</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #40E0D0; 
            height: 100vh; 
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card p-4">
                    <h1 class="text-center">Penghitung Total Belanja</h1>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="totalBelanja" class="form-label">Total Belanja (Rp)</label>
                            <input type="number" class="form-control" id="totalBelanja" name="total_belanja" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apakah Anda Member?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="member" id="memberYes" value="yes" required>
                                <label class="form-check-label" for="memberYes">Ya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="member" id="memberNo" value="no" required>
                                <label class="form-check-label" for="memberNo">Tidak</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Hitung Total</button>
                    </form>

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $totalBelanja = $_POST['total_belanja'];
                        $isMember = $_POST['member'] === 'yes';
                        $diskon = 0;
                        $potonganMember = 0;

                        if ($isMember) {
                            // Logika untuk Member
                            $potonganMember = 10; // Potongan member 10% selalu ada untuk member
                            if ($totalBelanja > 1000000) {
                                $diskon = 15; // Diskon 15% jika belanja > 1.000.000
                            } elseif ($totalBelanja >= 500000) {
                                $diskon = 10; // Diskon 10% jika belanja >= 500.000 dan <= 1.000.000
                            }
                        } else {
                            // Logika untuk Non-member
                            if ($totalBelanja > 1000000) {
                                $diskon = 10; // Diskon 10% jika belanja > 1.000.000
                            } elseif ($totalBelanja >= 500000) {
                                $diskon = 5; // Diskon 5% jika belanja >= 500.000 dan <= 1.000.000
                            }
                        }

                        // Menghitung total potongan
                        $potonganMemberValue = ($potonganMember / 100) * $totalBelanja;
                        $potonganDiskonValue = ($diskon / 100) * $totalBelanja;
                        $totalPotongan = $potonganMemberValue + $potonganDiskonValue;
                        $totalAkhir = $totalBelanja - $totalPotongan;
                    ?>
                    <div class="alert alert-info mt-3">
                        <p>Total Belanja: Rp <?= number_format($totalBelanja, 0, ',', '.') ?></p>
                        <p>Potongan Member: Rp <?= number_format($potonganMemberValue, 0, ',', '.') ?> (10%)</p>
                        <p>Diskon: Rp <?= number_format($potonganDiskonValue, 0, ',', '.') ?> (<?= $diskon ?>%)</p>
                        <p>Total Potongan: Rp <?= number_format($totalPotongan, 0, ',', '.') ?></p>
                        <p>Total yang Harus Dibayar: Rp <?= number_format($totalAkhir, 0, ',', '.') ?></p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
