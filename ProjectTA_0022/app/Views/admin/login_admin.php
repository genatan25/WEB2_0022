<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            width: 100%;
            height: 60px;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            border-bottom: 1px solid #eee;
        }

        .logo {
            font-weight: bold;
            font-size: 20px;
            color: #333;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
            margin: auto;
        }

        .nav-links a {
            text-decoration: none;
            color: #666;
            font-size: 14px;
        }

        .login-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .login-section a {
            text-decoration: none;
            color: #666;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .login-button {
            background: white;
            color: #4285f4;
            padding: 8px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            border: 2px solid #4285f4;
            box-sizing: border-box;
        }

        .banner {
            width: 100%;
            height: 260px;
            /* Ganti url() sesuai penempatan file gambar Anda */
            background-image: url('<?= base_url("uploads/GAMBAR KAOS HOME.jpg") ?>');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .login-form {
            margin-top: 40px;
            width: 100%;
            max-width: 320px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-size: 14px;
        }

        .input-container {
            position: relative;
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
        }

        .input-icon {
            padding: 10px;
            color: #666;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: none;
            background: transparent;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4285f4;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: #4285f4;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
        }

        .login-btn:hover {
            background: #3367d6;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        input::placeholder {
            color: #999;
        }

        @media (max-width: 768px) {
            .nav-links {
                flex-direction: column;
                gap: 10px;
            }

            .header {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo">GENATAN KAOS</div>
            <nav class="nav-links">
                <a href="#">Beranda</a>
                <a href="#">Produk kami</a>
                <a href="#">Tentang kami</a>
                <a href="#">Hubungi kami</a>
            </nav>
            <div class="login-section">
                <!-- Menuju form register admin -->
                <a href="<?= base_url('/admin/register_admin') ?>">
                    <span>👤</span> Register
                </a>
                <!-- Bisa diarahkan ke shop / laman utama toko -->
                <a href="#" class="login-button">Mulai Belanja</a>
            </div>
        </header>

        <!-- Banner / Gambar -->
        <div class="banner"></div>

        <!-- FORM LOGIN -->
        <!-- Pastikan action mengarah ke route POST /admin/login -->
        <form class="login-form" action="<?= base_url('/admin/login') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label class="form-label">Username</label>
                <div class="input-container">
                    <span class="input-icon">👤</span>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-container">
                    <span class="input-icon">🔒</span>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
            </div>
            <button type="submit" class="login-btn">Login</button>

            <!-- Tampilkan pesan error dari session, jika ada -->
            <?php if (session()->getFlashdata('error')): ?>
                <p class="error-message"><?= session()->getFlashdata('error') ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
