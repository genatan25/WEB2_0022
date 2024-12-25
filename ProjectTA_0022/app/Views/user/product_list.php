<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genatan - Produk Kami</title>
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
            display: flex;
            background: linear-gradient(135deg, #ffdd00, #fbb034);
            height: 250px;
            align-items: center;
            padding-left: 20px;
            color: #fff;
        }
        .hero h1 {
            margin: 0;
            font-size: 36px;
            font-weight: 700;
        }
        .container {
            padding: 20px;
        }
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .product {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }
        .product img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product h3 {
            margin: 10px;
            font-size: 18px;
            font-weight: 600;
            text-align: center;
            color: #007bff;
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
        <h1>Produk Kami</h1>
    </div>

    <div class="container">
        <div class="products">
            <div class="product">
                <img src="gambar1.jpg" alt="Kaos">
                <h3>Kaos</h3>
            </div>
            <div class="product">
                <img src="gambar2.jpg" alt="Topi">
                <h3>Topi</h3>
            </div>
            <div class="product">
                <img src="gambar3.jpg" alt="Produk Lainnya">
                <h3>Produk Lainnya</h3>
            </div>
        </div>
    </div>
</body>
</html>
