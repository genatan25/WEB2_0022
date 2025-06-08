<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - <?= esc($product['nama_produk']); ?></title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .product-title {
            font-weight: 700;
        }

        .product-price {
            font-size: 1.5rem;
            color: #ff6347;
            font-weight: 700;
        }

        .product-description {
            margin-top: 20px;
        }

        .back-button {
            margin-top: 20px;
        }

        .product-details ul {
            list-style-type: none;
            padding: 0;
        }

        .product-details li {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <img src="<?= esc(base_url($product['gambar'])); ?>" alt="<?= esc($product['nama_produk']); ?>" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h1 class="product-title"><?= esc($product['nama_produk']); ?></h1>
                <p class="product-price">Rp <?= number_format($product['harga'], 0, ',', '.'); ?></p>
                <div class="product-description">
                    <p><?= esc($product['deskripsi']); ?></p>
                </div>
                <div class="product-details">
                    <h3>Detail Produk</h3>
                    <ul>
                        <?php foreach ($details as $detail):
                            $parts = explode(':', $detail); ?>
                            <li><strong><?= esc($parts[0]); ?>:</strong> <?= esc($parts[1]); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <button class="btn btn-primary add-to-cart" 
                        data-id="<?= esc($product['id_produk']); ?>" 
                        data-name="<?= esc($product['nama_produk']); ?>" 
                        data-price="<?= esc($product['harga']); ?>" 
                        data-image="<?= esc(base_url($product['gambar'])); ?>">
                    Tambahkan ke Keranjang
                </button>
                <a href="<?= base_url('/user/product-list'); ?>" class="btn btn-secondary back-button">Kembali</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk menambahkan produk ke keranjang
        function addToCart(id, name, price, image) {
            // Ambil data keranjang dari localStorage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            
            // Periksa apakah produk sudah ada di keranjang
            const existingProduct = cart.find(item => item.id === id);
            if (existingProduct) {
                // Jika ada, tambahkan jumlahnya
                existingProduct.quantity += 1;
            } else {
                // Jika tidak ada, tambahkan produk baru
                cart.push({
                    id,
                    name,
                    price,
                    image,
                    quantity: 1
                });
            }

            // Simpan keranjang kembali ke localStorage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Tampilkan notifikasi dengan SweetAlert2
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: `${name} berhasil ditambahkan ke keranjang.`,
                showConfirmButton: false,
                timer: 2000,
                toast: true,
                position: 'top-end',
                background: '#ff6347',
                color: '#fff',
                iconColor: '#fff'
            });
        }

        // Event listener untuk tombol "Tambah ke Keranjang"
        document.querySelector('.add-to-cart').addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const price = parseInt(this.getAttribute('data-price'));
            const image = this.getAttribute('data-image');

            addToCart(id, name, price, image);
        });
    </script>
</body>

</html>
