<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genatan Kaos - Tentang Kami</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .logo {
            font-weight: bold;
            font-size: 20px;
            color: #007bff;
        }
        nav {
            display: flex;
            gap: 20px;
        }
        nav a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        nav a:hover {
            color: #007bff;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .actions a {
            text-decoration: none;
            font-weight: bold;
            padding: 8px 12px;
            border: 1px solid #007bff;
            border-radius: 5px;
            color: #007bff;
            transition: all 0.3s ease;
        }
        .actions a:hover {
            background-color: #007bff;
            color: #fff;
        }
        .hero {
            position: relative;
            background-image: url('gambar-hero.jpg'); 
            background-size: cover;
            background-position: center;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
        }
        .hero::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .hero h1 {
            position: relative;
            font-size: 36px;
            font-weight: 700;
            z-index: 1;
        }
        .container {
            padding: 20px;
        }
        .features {
            display: flex;
            gap: 20px;
            justify-content: space-between;
            text-align: center;
        }
        .feature {
            flex: 1;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .feature h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #007bff;
        }
        .feature p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">GENATAN KAOS</div>
        <nav>
            <a href="#">Beranda</a>
            <a href="#">Produk Kami</a>
            <a href="#">Tentang Kami</a>
        </nav>
        <div class="actions">
            <a href="#">Login</a>
            <a href="#">Mulai Belanja</a>
        </div>
    </header>

    <div class="hero">
        <h1>Tentang Genatan Kaos Yang Perlu Kamu Tahu</h1>
    </div>

    <div class="container">
        <div class="features">
            <div class="feature">
                <h3>Harga</h3>
                <p>Di Genatan Kaos, harga relatif terjangkau terutama buat anak muda. Mau dikit atau banyak, ayoin aja.</p>
            </div>
            <div class="feature">
                <h3>Kualitas</h3>
                <p>Kualitas yang kami berikan dapat dibandingkan dengan produk lain. Selain menjamin kualitas bahan, kami juga menjamin kualitas sablonannya.</p>
            </div>
            <div class="feature">
                <h3>Kecepatan</h3>
                <p>Dalam pengerjaan setiap pesanan kamu, kami prioritaskan yang terbaik. Sehingga pesanan kamu ga terlalu lama nunggunya.</p>
            </div>
        </div>
    </div>
</body>
</html>
