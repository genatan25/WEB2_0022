<!-- app/Views/user/product_list.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Genatan Kaos</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Swiper CSS for Carousel -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Custom CSS -->
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        body.dark-mode .navbar,
        body.dark-mode .filter-form,
        body.dark-mode .card,
        body.dark-mode footer {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        body.dark-mode .navbar-brand,
        body.dark-mode .nav-link.active,
        body.dark-mode .nav-link:hover {
            color: #ff6347 !important;
        }

        body.dark-mode .form-label,
        body.dark-mode .form-select,
        body.dark-mode .form-control {
            background-color: #2c2c2c;
            color: #e0e0e0;
            border: 1px solid #444;
        }

        body.dark-mode .btn-primary {
            background-color: #ff6347;
            border: none;
        }

        body.dark-mode .btn-outline-primary {
            color: #ff6347;
            border-color: #ff6347;
        }

        body.dark-mode .btn-outline-primary:hover {
            background-color: #ff6347;
            color: #fff;
        }

        /* Navbar Customization */
        .navbar-brand {
            font-weight: 700;
            color: #ff6347 !important;
            /* Tomato color */
        }

        .nav-link.active {
            color: #ff6347 !important;
        }

        .nav-link:hover {
            color: #ff6347 !important;
        }

        .cart-icon,
        .wishlist-icon {
            position: relative;
            color: #ff6347;
            cursor: pointer;
        }

        .cart-badge,
        .wishlist-badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }

        /* Dark Mode Toggle */
        .dark-mode-toggle {
            cursor: pointer;
            color: #ff6347;
        }

        /* Hero Section with Carousel */
        .hero {
            position: relative;
            width: 100%;
            height: 60vh;
            margin-bottom: 30px;
        }

        .swiper-container {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            position: relative;
            text-align: center;
            color: #fff;
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .swiper-slide .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .swiper-slide .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
        }

        .swiper-slide .hero-content h1 {
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .swiper-slide .hero-content p {
            font-size: 1.2rem;
            margin-top: 10px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }

        /* Filter Kategori dan Pencarian */
        .filter-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        body.dark-mode .filter-form {
            background-color: #2c2c2c;
            box-shadow: 0 4px 6px rgba(255, 255, 255, 0.1);
        }

        /* Product Card */
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background-color: #ffffff;
        }

        body.dark-mode .card {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .card-body {
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-weight: 600;
            color: #333333;
            transition: color 0.3s;
        }

        body.dark-mode .card-title {
            color: #e0e0e0;
        }

        .card-text {
            color: #ff6347;
            font-weight: 700;
        }

        .btn-primary {
            background-color: #ff6347;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #e5533d;
        }

        .btn-outline-primary {
            color: #ff6347;
            border-color: #ff6347;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-outline-primary:hover {
            background-color: #ff6347;
            color: #fff;
        }

        /* Footer */
        footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 30px 0;
            margin-top: auto;
        }

        footer a {
            color: #ff6347;
            text-decoration: none;
        }

        footer a:hover {
            color: #ffffff;
            text-decoration: none;
        }

        /* Wishlist Icon */
        .wishlist-icon {
            margin-left: 15px;
        }

        /* Quick View Modal */
        .quick-view-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        /* Scroll to Top Button */
        #scrollTopBtn {
            position: fixed;
            bottom: 40px;
            right: 40px;
            z-index: 99;
            background-color: #ff6347;
            color: white;
            border: none;
            outline: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
        }

        #scrollTopBtn:hover {
            background-color: #e5533d;
        }

        /* Infinite Scroll Loader */
        #loader {
            text-align: center;
            display: none;
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <!-- SweetAlert2 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        <?php if (session('error')): ?>
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: '<?= session('error') ?>',
                showConfirmButton: true
            });
        <?php endif; ?>

        <?php if (session('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?= session('success') ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php endif; ?>
    </script>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <nav class="navbar navbar-light bg-light">
                <a class="navbar-brand" href="#">
                    <div style="display: flex; align-items: center;">
                        <div style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; margin-right: 10px;">
                            <img src="<?= base_url('uploads/logo.webp'); ?>" alt="Genatan Kaos" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <span style="font-size: 20px; font-weight: bold; color: #333;">Genatan Kaos</span>
                    </div>
                </a>
            </nav>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser" aria-controls="navbarUser" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarUser">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item">
                        <a class="nav-link <?= uri_string() == 'user' ? 'active' : ''; ?>" href="<?= base_url('/user'); ?>">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= uri_string() == 'user/product-list' ? 'active' : ''; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Produk
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach ($categories as $category): ?>
                                <li><a class="dropdown-item" href="<?= base_url('/user/product-list?category=' . esc($category['id_kategori'])); ?>"><?= esc($category['nama_kategori']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= uri_string() == 'user/tentang-kami' ? 'active' : ''; ?>" href="<?= base_url('/user/tentang-kami'); ?>">Tentang Kami</a>
                    </li>
                    <!-- Dark Mode Toggle -->
                    <li class="nav-item ms-3">
                        <a class="nav-link dark-mode-toggle" id="darkModeToggle">
                            <i class="fas fa-moon"></i>
                        </a>
                    </li>
                    <!-- Keranjang Belanja -->
                    <li class="nav-item ms-3">
                        <a class="nav-link position-relative" href="#" data-bs-toggle="modal" data-bs-target="#cartModal">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            <span class="cart-badge" id="cart-count">0</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #6c757d;">
                            <span class="badge rounded-circle text-uppercase me-2" style="background-color: #ff6347; font-size: 14px;">
                                <?= strtoupper(substr(session()->get('username'), 0, 1)); ?>
                            </span>
                            <span style="color: #28a745; font-weight: bold;">
                                <?= session()->get('username'); ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userMenu">
                            <li><a class="dropdown-item" href="<?= base_url('/user/auth/logout'); ?>" style="color: #dc3545; font-weight: bold;">Logout</a></li>
                        </ul>
                    </li>

                    </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Carousel -->
    <section class="hero">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <img src="<?= base_url('uploads/testimonials/7.webp'); ?>" alt="Promo 1">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <h1>Promo Musim Panas</h1>
                        <p>Dapatkan Kaos dengan Diskon hingga 50%</p>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <img src="<?= base_url('uploads/testimonials/8.webp'); ?>" alt="Promo 2">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <h1>Desain Terbaru</h1>
                        <p>Kaos dengan Desain Eksklusif dan Tren Terkini</p>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <img src="<?= base_url('uploads/testimonials/9.webp'); ?>" alt="Promo 3">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <h1>Gratis Ongkir</h1>
                        <p>Untuk Pembelian di atas Rp 200.000</p>
                    </div>
                </div>
            </div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Navigation Buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>

    <!-- Konten Utama -->
    <div class="container mt-5">
        <h2 class="mb-4 text-center fade-in">Daftar Produk Kami</h2>
        <hr>

        <!-- Filter Kategori, Pencarian, dan Harga -->
        <form method="get" action="<?= base_url('/user/product-list'); ?>" class="filter-form mb-4 fade-in">
            <div class="row g-3 align-items-center">
                <div class="col-lg-3 col-md-6">
                    <label for="category" class="form-label">Kategori:</label>
                    <select name="category" id="category" class="form-select">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= esc($category['id_kategori']); ?>" <?= ($selectedCategory == $category['id_kategori']) ? 'selected' : ''; ?>>
                                <?= esc($category['nama_kategori']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label for="price_min" class="form-label">Harga Minimal:</label>
                    <input type="number" name="price_min" id="price_min" class="form-control" placeholder="Rp 0" value="<?= esc($priceMin ?? ''); ?>">
                </div>
                <div class="col-lg-3 col-md-6">
                    <label for="price_max" class="form-label">Harga Maksimal:</label>
                    <input type="number" name="price_max" id="price_max" class="form-control" placeholder="Rp 0" value="<?= esc($priceMax ?? ''); ?>">
                </div>
                <div class="col-lg-3 col-md-6">
                    <label for="search" class="form-label">Cari Produk:</label>
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Nama produk..." value="<?= esc($searchTerm ?? ''); ?>">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row" id="product-list">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 fade-in">
                        <div class="card h-100">
                            <?php
                            $imagePath = !empty($product['gambar']) && file_exists(FCPATH . $product['gambar'])
                                ? base_url($product['gambar'])
                                : base_url('uploads/products/default.png');
                            ?>
                            <img src="<?= esc($imagePath); ?>" class="card-img-top" alt="<?= esc($product['nama_produk']); ?>">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= esc($product['nama_produk']); ?></h5>
                                <p class="card-text">Rp <?= number_format($product['harga'], 0, ',', '.'); ?></p>
                                <p class="card-text"><?= esc(word_limiter($product['deskripsi'], 15)); ?></p>
                                <div class="mt-auto d-flex justify-content-between">
                                    <a href="<?= base_url('/user/product-detail/' . esc($product['id_produk'])); ?>" class="btn btn-primary btn-sm">Detail</a>
                                    <button class="btn btn-outline-primary btn-sm add-to-cart" data-id="<?= esc($product['id_produk']); ?>" data-name="<?= esc($product['nama_produk']); ?>" data-price="<?= esc($product['harga']); ?>" data-image="<?= esc($imagePath); ?>">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Belum ada produk yang tersedia.</p>
            <?php endif; ?>
        </div>

        <!-- Infinite Scroll Loader -->
        <div id="loader" class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center text-lg-start">
        <div class="container p-4">
            <div class="row">
                <!-- Informasi Kontak -->
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Genatan Kaos</h5>
                    <p>
                        Alamat: Jl. Contoh No. 123, Jakarta<br>
                        Email: <a href="mailto:info@genatankaos.com">info@genatankaos.com</a><br>
                        Telepon: <a href="tel:+6281234567890">+62 812-3456-7890</a>
                    </p>
                </div>
                <!-- Link Cepat -->
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Link Cepat</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="<?= base_url('/user'); ?>" class="text-white">Beranda</a></li>
                        <li><a href="<?= base_url('/user/product-list'); ?>" class="text-white">Produk</a></li>
                        <li><a href="<?= base_url('/user/tentang-kami'); ?>" class="text-white">Tentang Kami</a></li>
                        <li><a href="<?= base_url('/user/kontak'); ?>" class="text-white">Kontak</a></li>
                    </ul>
                </div>
                <!-- Media Sosial -->
                <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Ikuti Kami</h5>
                    <a href="#" class="text-white me-4">
                        <i class="fab fa-facebook-f fa-lg"></i>
                    </a>
                    <a href="#" class="text-white me-4">
                        <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a href="#" class="text-white me-4">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="#" class="text-white me-4">
                        <i class="fab fa-linkedin fa-lg"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © <?= date('Y'); ?> Genatan Kaos. All rights reserved.
        </div>
    </footer>

    <!-- Keranjang Belanja Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Keranjang Belanja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" id="cart-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Item keranjang akan ditambahkan di sini secara dinamis -->
                        </tbody>
                    </table>
                    <div class="text-end">
                        <h5>Total: Rp <span id="cart-total">0</span></h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Lanjut Belanja</button>
                    <button type="button" class="btn btn-primary" id="checkout">Checkout</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('checkout').addEventListener('click', function(e) {
                e.preventDefault();

                if (cart.length === 0) {
                    console.log('Cart is empty');
                    Swal.fire({
                        icon: 'warning',
                        title: 'Keranjang Kosong',
                        text: 'Silakan tambahkan produk ke keranjang sebelum checkout.',
                    });
                    return;
                }

                console.log('Sending cart data to server:', cart); // Log data yang akan dikirim
                fetch('<?= base_url('/user/purchase'); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(cart), // Kirim data keranjang ke server
                    })
                    .then(response => {
                        console.log('Server response status:', response.status); // Log status respons
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data); // Log respons dari server
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Transaksi berhasil dilakukan.',
                                timer: 2000, // Durasi notifikasi sebelum refresh
                                showConfirmButton: false,
                            }).then(() => {
                                // Setelah notifikasi selesai, refresh halaman
                                localStorage.removeItem('cart'); // Hapus keranjang dari localStorage
                                window.location.reload(); // Refresh halaman
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: data.message || 'Terjadi kesalahan saat memproses transaksi.',
                                showConfirmButton: true,
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat memproses transaksi.',
                            showConfirmButton: true,
                        });
                    });
            });
        });
    </script>
    <!-- Wishlist Modal -->
    <div class="modal fade" id="wishlistModal" tabindex="-1" aria-labelledby="wishlistModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Wishlist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" id="wishlist-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Item wishlist akan ditambahkan di sini secara dinamis -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="<?= base_url('/user/wishlist'); ?>" class="btn btn-primary">Lihat Wishlist</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="" alt="Produk" id="quick-view-img" class="quick-view-img">
                        </div>
                        <div class="col-md-6">
                            <h3 id="quick-view-name"></h3>
                            <p id="quick-view-price"></p>
                            <p id="quick-view-description"></p>
                            <button class="btn btn-primary add-to-cart-quick" data-id="" data-name="" data-price="" data-image="">Tambah ke Keranjang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <button id="scrollTopBtn" title="Kembali ke atas">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS for Carousel -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Custom JS (Keranjang Belanja, Wishlist, Dark Mode, Infinite Scroll) -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Inisialisasi Swiper Carousel
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const body = document.body;

        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
            darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }

        darkModeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            } else {
                localStorage.setItem('darkMode', 'disabled');
                darkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
            }
        });

        // Scroll to Top Button
        const scrollTopBtn = document.getElementById('scrollTopBtn');

        window.onscroll = function() {
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                scrollTopBtn.style.display = "flex";
            } else {
                scrollTopBtn.style.display = "none";
            }
        };

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Inisialisasi keranjang belanja dan wishlist
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

        // Update tampilan keranjang
        function updateCart() {
            const cartTableBody = document.querySelector('#cart-table tbody');
            cartTableBody.innerHTML = '';
            let total = 0;
            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                const row = `
                    <tr>
                        <td>
                            <img src="${item.image}" alt="${item.name}" width="50" class="me-2">
                            ${item.name}
                        </td>
                        <td>Rp ${item.price.toLocaleString('id-ID')}</td>
                        <td>
                            <input type="number" min="1" class="form-control quantity" data-index="${index}" value="${item.quantity}">
                        </td>
                        <td>Rp ${itemTotal.toLocaleString('id-ID')}</td>
                        <td>
                            <button class="btn btn-danger btn-sm remove-item" data-index="${index}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                cartTableBody.insertAdjacentHTML('beforeend', row);
            });
            document.getElementById('cart-total').innerText = total.toLocaleString('id-ID');
            document.getElementById('cart-count').innerText = cart.length;
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        // Update tampilan wishlist
        function updateWishlist() {
            const wishlistTableBody = document.querySelector('#wishlist-table tbody');
            wishlistTableBody.innerHTML = '';
            wishlist.forEach((item, index) => {
                const row = `
                    <tr>
                        <td>
                            <img src="${item.image}" alt="${item.name}" width="50" class="me-2">
                            ${item.name}
                        </td>
                        <td>Rp ${item.price.toLocaleString('id-ID')}</td>
                        <td>
                            <button class="btn btn-danger btn-sm remove-wishlist-item" data-index="${index}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                wishlistTableBody.insertAdjacentHTML('beforeend', row);
            });
            document.getElementById('wishlist-count').innerText = wishlist.length;
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
        }

        // Tambah item ke keranjang
        function addToCart(id, name, price, image) {
            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id,
                    name,
                    price,
                    image,
                    quantity: 1
                });
            }
            updateCart();
            showToast(`${name} telah ditambahkan ke keranjang!`);
        }

        // Tambah item ke wishlist
        function addToWishlist(id, name, image) {
            const existingItem = wishlist.find(item => item.id === id);
            if (!existingItem) {
                wishlist.push({
                    id,
                    name,
                    image
                });
                updateWishlist();
                showToast(`${name} telah ditambahkan ke wishlist!`);
            } else {
                showToast(`${name} sudah ada di wishlist.`);
            }
        }

        // Hapus item dari keranjang
        function removeFromCart(index) {
            cart.splice(index, 1);
            updateCart();
        }

        // Hapus item dari wishlist
        function removeFromWishlist(index) {
            wishlist.splice(index, 1);
            updateWishlist();
        }

        // Event Listeners untuk Keranjang dan Wishlist
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const price = parseInt(button.getAttribute('data-price'));
                const image = button.getAttribute('data-image');
                addToCart(id, name, price, image);
            });
        });

        document.querySelectorAll('.add-to-wishlist').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const image = button.getAttribute('data-image');
                addToWishlist(id, name, image);
            });
        });

        // Event Listener untuk Update Jumlah di Keranjang
        document.querySelector('#cart-table tbody')?.addEventListener('change', (e) => {
            if (e.target.classList.contains('quantity')) {
                const index = e.target.getAttribute('data-index');
                const newQuantity = parseInt(e.target.value);
                if (newQuantity < 1) {
                    removeFromCart(index);
                } else {
                    cart[index].quantity = newQuantity;
                    updateCart();
                }
            }
        });


        // Event Listener untuk Hapus Item dari Keranjang
        document.querySelector('#cart-table tbody')?.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-item') || e.target.parentElement.classList.contains('remove-item')) {
                const index = e.target.getAttribute('data-index') || e.target.parentElement.getAttribute('data-index');
                removeFromCart(index);
            }
        });


        // Event Listener untuk Hapus Item dari Wishlist
        document.querySelector('#wishlist-table tbody')?.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-wishlist-item') || e.target.parentElement.classList.contains('remove-wishlist-item')) {
                const index = e.target.getAttribute('data-index') || e.target.parentElement.getAttribute('data-index');
                removeFromWishlist(index);
            }
        });

        // Tampilkan keranjang dan wishlist saat modal dibuka
        const cartModal = document.getElementById('cartModal');
        const wishlistModal = document.getElementById('wishlistModal');

        cartModal.addEventListener('shown.bs.modal', updateCart);
        wishlistModal.addEventListener('shown.bs.modal', updateWishlist);

        // Inisialisasi tampilan keranjang dan wishlist saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            updateCart();
            updateWishlist();
        });

        // Tambah ke keranjang dari quick view
        document.querySelector('.add-to-cart-quick')?.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const price = parseInt(this.getAttribute('data-price'));
            const image = this.getAttribute('data-image');
            addToCart(id, name, price, image);
            quickViewModal.hide();
        });

        // Toast Notification
        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'toast align-items-center text-bg-primary border-0 position-fixed top-0 end-0 m-3';
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Tutup"></button>
                </div>
            `;
            document.body.appendChild(toast);
            const bsToast = new bootstrap.Toast(toast, {
                delay: 3000
            });
            bsToast.show();
            toast.addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }
        // Fetch next page products via AJAX
        const params = new URLSearchParams(window.location.search);
        params.set('page', page);

        fetch(`<?= base_url('/user/product-list'); ?>?${params.toString()}`)
            .then(response => response.text())
            .then(data => {
                // Parse the received HTML and extract the product cards
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');
                const newProducts = doc.querySelectorAll('#product-list .col-lg-3');

                if (newProducts.length > 0) {
                    newProducts.forEach(product => {
                        productList.appendChild(product);
                    });
                    loading = false;
                    loader.style.display = 'none';
                    // Re-attach event listeners for new buttons
                    attachEventListeners();
                } else {
                    // No more products to load
                    loader.innerHTML = '<p>No more products to load.</p>';
                }
            })
            .catch(error => {
                console.error('Error loading more products:', error);
                loading = false;
                loader.style.display = 'none';
            });

        function attachEventListeners() {
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const price = parseInt(button.getAttribute('data-price'));
                    const image = button.getAttribute('data-image');
                    addToCart(id, name, price, image);
                });
            });

            document.querySelectorAll('.add-to-wishlist').forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const image = button.getAttribute('data-image');
                    addToWishlist(id, name, image);
                });
            });

            document.querySelectorAll('.card-img-top, .btn-primary').forEach(element => {
                element.addEventListener('click', () => {
                    const card = element.closest('.card');
                    const imgSrc = card.querySelector('.card-img-top').src;
                    const name = card.querySelector('.card-title').innerText;
                    const price = card.querySelector('.card-text').innerText;
                    const description = card.querySelectorAll('.card-text')[1].innerText;

                    document.getElementById('quick-view-img').src = imgSrc;
                    document.getElementById('quick-view-name').innerText = name;
                    document.getElementById('quick-view-price').innerText = price;
                    document.getElementById('quick-view-description').innerText = description;

                    // Set data attributes for add to cart from quick view
                    document.querySelector('.add-to-cart-quick').setAttribute('data-id', card.querySelector('.add-to-cart').getAttribute('data-id'));
                    document.querySelector('.add-to-cart-quick').setAttribute('data-name', card.querySelector('.add-to-cart').getAttribute('data-name'));
                    document.querySelector('.add-to-cart-quick').setAttribute('data-price', card.querySelector('.add-to-cart').getAttribute('data-price'));
                    document.querySelector('.add-to-cart-quick').setAttribute('data-image', card.querySelector('.add-to-cart').getAttribute('data-image'));

                    quickViewModal.show();
                });
            });
        }
        // Attach event listeners on initial load
        attachEventListeners();
    </script>
</body>

</html>