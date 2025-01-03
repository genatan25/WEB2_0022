<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genatan Kaos - Custom T-Shirt Printing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="<?php echo base_url('template/css/tambahan.css'); ?>" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="logo">GENATAN KAOS</div>
        <div class="nav-links">
            <a href="#">Beranda</a>
            <a href="#">Produk Kami</a>
            <a href="#">Tentang Kami</a>
        </div>
        <div class="auth-buttons">
            <button class="shop-button">
                <i class="fas fa-shopping-cart"></i>
                Mulai Belanja
            </button>
            <div class="profile-container">
                <?php if (isset($is_logged_in) && $is_logged_in): ?>
                    <div 
                        class="profile-circle" 
                        style="background-color: <?= !empty($user_data['profile_color']) ? htmlspecialchars($user_data['profile_color'], ENT_QUOTES, 'UTF-8') : '#4285f4'; ?>"
                    >
                        <?= substr($user_data['nama_lengkap'], 0, 1) ?>
                    </div>
                <?php else: ?>
                    <div class="profile-circle guest-circle">
                        <i class="fas fa-user"></i>
                    </div>
                <?php endif; ?>

                <div class="profile-dropdown">
                    <?php if (isset($is_logged_in) && $is_logged_in): ?>
                        <div class="dropdown-item">
                            <i class="fas fa-user"></i>
                            <span><?= htmlspecialchars($user_data['nama_lengkap'], ENT_QUOTES, 'UTF-8') ?></span>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-item" id="settings-trigger">
                            <i class="fas fa-cog"></i>
                            <span>Pengaturan</span>
                            <i class="fas fa-chevron-right" style="margin-left: auto;"></i>
                            <div class="settings-submenu">
                                <div class="theme-toggle">
                                    <span>Tema Gelap</span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" id="themeToggle">
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <a href="<?= base_url('home/logout') ?>" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Keluar</span>
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('auth/login') ?>" class="dropdown-item">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Masuk</span>
                        </a>
                        <a href="<?= base_url('auth/register') ?>" class="dropdown-item">
                            <i class="fas fa-user-plus"></i>
                            <span>Daftar</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="hero-section">
        <div class="text-overlay">
            <h1 class="main-heading">BIKIN KAOS GAK HARUS BANYAK!!!</h1>
            <p class="sub-heading">Genatan Kaos melayani buat kamu yang pengen order kaos custom dengan jumlah berapapun yang kamu mau</p>
        </div>
    </div>
    <script src="<?php echo base_url('/template/js/tambahan.js'); ?>"></script>
</body>
</html>
