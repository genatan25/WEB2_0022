<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Genatan Kaos</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Swiper CSS for Carousel -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- AOS CSS for Animations -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #ff6347;
            --secondary-color: #343a40;
            --light-bg: #f8f9fa;
            --dark-bg: #212529;
            --text-color: #333333;
            --muted-text: #555555;
        }

        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            scroll-behavior: smooth;
        }

        /* Navbar Customization */
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            transition: color 0.3s;
        }

        .navbar-brand:hover {
            color: darken(var(--primary-color), 10%);
        }

        .nav-link.active {
            color: var(--primary-color) !important;
            font-weight: 600;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 80vh;
            margin-top: 56px;
            /* Adjust for fixed navbar height */
        }

        .swiper-container {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            position: relative;
            color: white;
            text-align: center;
        }

        .swiper-slide img {
            width: 100%;
            height: 80vh;
            object-fit: cover;
            filter: brightness(70%);
            transition: transform 0.5s;
        }

        .swiper-slide img:hover {
            transform: scale(1.05);
        }

        .slide-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            animation: fadeInUp 1s ease-out;
        }

        .slide-content h1 {
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        .slide-content p {
            font-size: 1.2rem;
            margin-bottom: 20px;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
        }

        .slide-content .btn {
            padding: 10px 30px;
            font-size: 1rem;
            border-radius: 50px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .slide-content .btn:hover {
            background-color: darken(var(--primary-color), 10%);
            transform: scale(1.05);
        }

        .swiper-pagination-bullet-active {
            background: var(--primary-color);
        }

        /* Product Section */
        .product-section {
            padding: 60px 0;
            background-color: #ffffff;
        }

        .product-section h2 {
            font-weight: 700;
            margin-bottom: 40px;
            text-align: center;
            position: relative;
            display: inline-block;
        }

        .product-section h2::after {
            content: '';
            width: 60px;
            height: 3px;
            background: var(--primary-color);
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-15px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 300px;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .card:hover .card-img-top {
            transform: scale(1.1);
        }

        .card-title {
            font-weight: 600;
            color: var(--text-color);
        }

        .card-text {
            color: var(--primary-color);
            font-weight: 700;
        }

        .badge-new,
        .badge-sale {
            position: absolute;
            top: 15px;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-new {
            left: 15px;
            background-color: #28a745;
        }

        .badge-sale {
            right: 15px;
            background-color: #dc3545;
        }

        /* Testimonial Section */
        .testimonial-section {
            padding: 60px 0;
            background-color: #f1f1f1;
        }

        .testimonial-section h2 {
            font-weight: 700;
            margin-bottom: 40px;
            text-align: center;
            position: relative;
            display: inline-block;
        }

        .testimonial-section h2::after {
            content: '';
            width: 60px;
            height: 3px;
            background: var(--primary-color);
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .testimonial-card {
            border: none;
            background: none;
            text-align: center;
            padding: 20px;
        }

        .testimonial-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 3px solid var(--primary-color);
        }

        .testimonial-card p {
            font-style: italic;
            color: var(--muted-text);
            margin-bottom: 15px;
        }

        .testimonial-card h5 {
            color: var(--text-color);
            font-weight: 600;
        }

        /* Footer */
        footer {
            background-color: var(--secondary-color);
            color: #ffffff;
            padding: 40px 0;
        }

        footer a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: #ffffff;
            text-decoration: none;
        }

        .social-icons a {
            color: #ffffff;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s, transform 0.3s;
        }

        .social-icons a:hover {
            color: var(--primary-color);
            transform: scale(1.2);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 20px;
            margin-top: 20px;
            text-align: center;
            font-size: 0.9rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .slide-content h1 {
                font-size: 2rem;
            }

            .slide-content p {
                font-size: 1rem;
            }

            .card-img-top {
                height: 200px;
            }

            .social-icons a {
                font-size: 1.3rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top" data-aos="fade-down">
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
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= uri_string() == 'user' ? 'active' : ''; ?>" href="<?= base_url('/user'); ?>">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos(uri_string(), 'product-list') !== false ? 'active' : ''; ?>" href="<?= base_url('/user/product-list'); ?>">
                            Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= uri_string() == 'user/tentang-kami' ? 'active' : ''; ?>" href="<?= base_url('/user/tentang-kami'); ?>">Tentang Kami</a>
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
                    <img src="<?= base_url('uploads/testimonials/p2.webp'); ?>" alt="Promo 1">
                    <div class="slide-content" data-aos="fade-up">
                        <h1>Diskon hingga 50%</h1>
                        <p>Temukan Kaos Favoritmu Sekarang!</p>
                        <a href="<?= base_url('/user/product-list'); ?>" class="btn btn-primary">Lihat Produk</a>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <img src="<?= base_url('uploads/testimonials/5.webp'); ?>" alt="Promo 2">
                    <div class="slide-content" data-aos="fade-up" data-aos-delay="200">
                        <h1>Produk Terbaru</h1>
                        <p>Koleksi Hoodie Musim Dingin</p>
                        <a href="<?= base_url('/user/product-list'); ?>" class="btn btn-primary">Lihat Produk</a>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <img src="<?= base_url('uploads/testimonials/6.webp'); ?>" alt="Promo 3">
                    <div class="slide-content" data-aos="fade-up" data-aos-delay="400">
                        <h1>Aksesori Keren</h1>
                        <p>Lengkapi Gayamu dengan Aksesori Kami</p>
                        <a href="<?= base_url('/user/product-list'); ?>" class="btn btn-primary">Lihat Produk</a>
                    </div>
                </div>
            </div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Navigation Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!-- Produk Terbaru -->
    <section class="product-section" data-aos="fade-up">
        <div class="container">
            <h2>Produk Terbaru</h2>
            <div class="row">
                <?php if (!empty($latestProducts)): ?>
                    <?php foreach ($latestProducts as $product): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-aos="zoom-in" data-aos-delay="100">
                            <div class="card h-100">
                                <?php
                                $imagePath = !empty($product['gambar']) && file_exists(FCPATH . $product['gambar'])
                                    ? base_url($product['gambar'])
                                    : base_url('uploads/products/default.png');
                                ?>
                                <img src="<?= esc($imagePath); ?>" class="card-img-top" alt="<?= esc($product['nama_produk']); ?>">

                                <?php if (isset($product['is_new']) && $product['is_new']): ?>
                                    <span class="badge-new">Baru</span>
                                <?php endif; ?>

                                <?php if (isset($product['diskon']) && $product['diskon'] > 0): ?>
                                    <span class="badge-sale">-<?= esc($product['diskon']); ?>%</span>
                                <?php endif; ?>

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?= esc($product['nama_produk']); ?></h5>
                                    <?php if (isset($product['diskon']) && $product['diskon'] > 0): ?>
                                        <p class="card-text text-muted text-decoration-line-through">Rp <?= number_format($product['harga'], 0, ',', '.'); ?></p>
                                        <p class="card-text">Rp <?= number_format($product['harga'] - ($product['harga'] * $product['diskon'] / 100), 0, ',', '.'); ?></p>
                                    <?php else: ?>
                                        <p class="card-text">Rp <?= number_format($product['harga'], 0, ',', '.'); ?></p>
                                    <?php endif; ?>
                                    <a href="<?= base_url('/user/product-detail/' . esc($product['id_produk'])); ?>" class="btn btn-primary mt-auto">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Belum ada produk terbaru.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="testimonial-section" data-aos="fade-up">
        <div class="container">
            <h2>Apa Kata Mereka</h2>
            <div class="swiper-container testimonial-swiper">
                <div class="swiper-wrapper">
                    <!-- Testimonial 1 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <img src="<?= base_url('uploads/testimonials/1.webp'); ?>" alt="User 1">
                            <p>"Kaos dari Genatan Kaos sangat nyaman dan kualitasnya luar biasa! Sangat direkomendasikan."</p>
                            <h5>- Andi</h5>
                        </div>
                    </div>
                    <!-- Testimonial 2 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <img src="<?= base_url('uploads/testimonials/2.webp'); ?>" alt="User 2">
                            <p>"Desainnya keren dan variatif. Saya selalu puas dengan setiap pembelian di sini."</p>
                            <h5>- Bella</h5>
                        </div>
                    </div>
                    <!-- Testimonial 3 -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <img src="<?= base_url('uploads/testimonials/3.webp'); ?>" alt="User 3">
                            <p>"Pelayanan pelanggan yang responsif dan pengiriman cepat. Terima kasih Genatan Kaos!"</p>
                            <h5>- Chandra</h5>
                        </div>
                    </div>
                    <!-- Tambahkan lebih banyak testimonial sesuai kebutuhan -->
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Navigation Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer data-aos="fade-up">
        <div class="container">
            <div class="row">
                <!-- Informasi -->
                <div class="col-md-4 mb-4">
                    <h5>Genatan Kaos</h5>
                    <p>Kami menyediakan berbagai macam kaos berkualitas dengan desain terkini untuk memenuhi kebutuhan fashion Anda.</p>
                </div>
                <!-- Link Cepat -->
                <div class="col-md-4 mb-4">
                    <h5>Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url('/user'); ?>">Beranda</a></li>
                        <li><a href="<?= base_url('/user/product-list'); ?>">Produk</a></li>
                        <li><a href="<?= base_url('/user/tentang-kami'); ?>">Tentang Kami</a></li>
                        <li><a href="#">Kontak</a></li>
                    </ul>
                </div>
                <!-- Media Sosial -->
                <div class="col-md-4 mb-4">
                    <h5>Ikuti Kami</h5>
                    <div class="social-icons">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                © <?= date('Y'); ?> Genatan Kaos. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS for Carousel -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- AOS JS for Animations -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Custom JS -->
    <script>
        // Initialize Swiper for Hero Carousel
        var swiper = new Swiper('.hero .swiper-container', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            speed: 1000,
            pagination: {
                el: '.hero .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.hero .swiper-button-next',
                prevEl: '.hero .swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            }
        });

        // Initialize Swiper for Testimonial Carousel
        var testimonialSwiper = new Swiper('.testimonial-swiper', {
            loop: true,
            autoplay: {
                delay: 7000,
                disableOnInteraction: false,
            },
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.testimonial-swiper .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.testimonial-swiper .swiper-button-next',
                prevEl: '.testimonial-swiper .swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
            effect: 'coverflow',
            coverflowEffect: {
                rotate: 30,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            }
        });

        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    </script>
</body>

</html>