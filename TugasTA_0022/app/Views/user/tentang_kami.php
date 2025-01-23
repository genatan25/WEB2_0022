<!-- app/Views/user/tentang_kami.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Genatan Kaos</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- AOS Library for Animations -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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

        /* Hero Section */
        .hero-section {
            position: relative;
            background: url('<?= base_url('uploads/products/hero-about.jpg'); ?>') no-repeat center center/cover;
            height: 45vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            text-align: center;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .hero-content .btn {
            padding: 10px 30px;
            font-size: 1rem;
            border-radius: 50px;
        }

        /* About Section */
        .about-section {
            padding: 60px 0;
            background-color: #ffffff;
        }

        .about-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .about-section p {
            font-size: 1.1rem;
            margin-bottom: 20px;
            text-align: justify;
        }

        .about-section .mission,
        .about-section .vision {
            margin-bottom: 40px;
        }

        .about-section .mission h4,
        .about-section .vision h4 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #ff6347;
        }

        /* Our Team Section */
        .team-section {
            padding: 60px 0;
            background-color: #f1f1f1;
        }

        .team-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .team-member {
            text-align: center;
            margin-bottom: 30px;
        }

        .team-member img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .team-member img:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .team-member h5 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .team-member p {
            font-size: 1rem;
            color: #666666;
        }

        /* Values Section */
        .values-section {
            padding: 60px 0;
            background-color: #ffffff;
        }

        .values-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .value-item {
            text-align: center;
            padding: 20px;
        }

        .value-item i {
            font-size: 3rem;
            color: #ff6347;
            margin-bottom: 15px;
        }

        .value-item h5 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .value-item p {
            font-size: 1rem;
            color: #666666;
        }

        /* Footer */
        footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 20px 0;
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

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .about-section h2,
            .team-section h2,
            .values-section h2 {
                font-size: 2rem;
            }

            .team-member img {
                width: 150px;
                height: 150px;
            }
        }
    </style>
</head>

<body>
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
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= uri_string() == 'user' ? 'active' : ''; ?>" href="<?= base_url('/user'); ?>">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= uri_string() == 'user/product-list' ? 'active' : ''; ?>" href="<?= base_url('/user/product-list'); ?>">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url('/user/tentang-kami'); ?>">Tentang Kami</a>
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
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" data-aos="fade-in">
        <div class="hero-content">
            <h1>Tentang Kami</h1>
            <p>Mengenal Lebih Dekat Genatan Kaos</p>
            <!-- Optional: Tambahkan tombol call-to-action jika diperlukan -->
            <!-- <a href="#our-story" class="btn btn-primary">Pelajari Lebih Lanjut</a> -->
        </div>
    </section>

    <!-- About Section -->
    <div class="container about-section" data-aos="fade-up">
        <h2>Genatan Kaos</h2>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p>
                    Selamat datang di <strong>Genatan Kaos</strong>! Kami adalah toko online yang berdedikasi untuk menyediakan berbagai macam kaos dengan desain terbaru dan kualitas terbaik. Visi kami adalah menjadi pilihan utama pelanggan dalam memenuhi kebutuhan fashion mereka dengan produk yang nyaman, trendi, dan terjangkau.
                </p>
                <div class="mission">
                    <h4><i class="fas fa-bullseye"></i> Visi</h4>
                    <p>
                        Menjadi toko kaos terkemuka yang dikenal akan inovasi desain, kualitas produk, dan pelayanan pelanggan yang luar biasa.
                    </p>
                </div>
                <div class="vision">
                    <h4><i class="fas fa-lightbulb"></i> Misi</h4>
                    <p>
                        1. Menyediakan berbagai pilihan kaos dengan desain unik dan up-to-date.<br>
                        2. Mengutamakan kualitas bahan dan proses produksi yang ramah lingkungan.<br>
                        3. Memberikan pengalaman belanja online yang mudah, cepat, dan terpercaya.<br>
                        4. Menjalin hubungan jangka panjang dengan pelanggan melalui pelayanan yang responsif dan ramah.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Gambar Tentang Kami -->
                <img src="<?= base_url('uploads/testimonials/GAMBAR KAOS 2.jpg'); ?>" alt="Tentang Kami" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>

    <!-- Our Team Section -->
    <div class="container team-section" data-aos="fade-up">
        <h2>Tim Kami</h2>
        <hr>
        <div class="row">
            <!-- Tim Member 1 -->
            <div class="col-md-4 team-member" data-aos="zoom-in" data-aos-delay="100">
                <img src="<?= base_url('uploads/testimonials/1.jpeg'); ?>" alt="Nama Anggota 1" class="img-fluid">
                <h5>Genatan</h5>
                <p>CEO & Founder</p>
            </div>
            <!-- Tim Member 2 -->
            <div class="col-md-4 team-member" data-aos="zoom-in" data-aos-delay="200">
                <img src="<?= base_url('uploads/testimonials/2.jpeg'); ?>" alt="Nama Anggota 2" class="img-fluid">
                <h5>Dwi</h5>
                <p>Desainer Grafis</p>
            </div>
            <!-- Tim Member 3 -->
            <div class="col-md-4 team-member" data-aos="zoom-in" data-aos-delay="300">
                <img src="<?= base_url('uploads/testimonials/3.jpeg'); ?>" alt="Nama Anggota 3" class="img-fluid">
                <h5>Winarta</h5>
                <p>Manajer Pemasaran</p>
            </div>
        </div>
    </div>

    <!-- Our Values Section -->
    <div class="container values-section" data-aos="fade-up">
        <h2>Nilai Kami</h2>
        <hr>
        <div class="row">
            <!-- Value Item 1 -->
            <div class="col-md-4 value-item">
                <i class="fas fa-leaf"></i>
                <h5>Ramah Lingkungan</h5>
                <p>
                    Kami berkomitmen untuk menggunakan bahan yang ramah lingkungan dan proses produksi yang bertanggung jawab terhadap alam.
                </p>
            </div>
            <!-- Value Item 2 -->
            <div class="col-md-4 value-item">
                <i class="fas fa-heart"></i>
                <h5>Pelayanan Pelanggan</h5>
                <p>
                    Pelanggan adalah prioritas utama kami. Kami selalu siap membantu dan memberikan pelayanan terbaik.
                </p>
            </div>
            <!-- Value Item 3 -->
            <div class="col-md-4 value-item">
                <i class="fas fa-lightbulb"></i>
                <h5>Inovasi</h5>
                <p>
                    Kami terus berinovasi dalam desain dan produk untuk memenuhi kebutuhan dan tren pasar yang terus berubah.
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            © <?= date('Y'); ?> Genatan Kaos. All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Library for Animations -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <!-- Custom JS -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>

</html>