<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genatan Kaos - Custom T-Shirt Printing</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1000;
        }

        .logo {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .auth-buttons .shop-button {
            background: white;
            color: #4285f4;
            padding: 8px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            border: 2px solid #4285f4;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }

        .register {
            background: #2196F3;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .hero-section {
        position: relative;
        width: 90%; 
        height: 65vh;
        overflow: hidden;
        background-image: url('/uploads/GAMBAR KAOS 2.jpg');
        background-size: cover;
        background-position: center;
        border-radius: 15px; 
        margin: 0 auto; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }

        .text-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 100%;
            padding: 20px;
        }

        .main-heading {
            color: #2196F3;
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .sub-heading {
            color: #333;
            font-size: 1.5rem;
            font-weight: bold;
            max-width: 600px;
            margin: 0 auto;
            text-shadow: 1px 1px 2px rgba(255,255,255,0.9);
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .main-heading {
                font-size: 2rem;
            }

            .sub-heading {
                font-size: 1.2rem;
            }
        }
    </style>
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
       
        <span>👤</span> Login
            <button class="shop-button">Mulai Belanja</button>
        </div>
    </nav>

    <div class="hero-section">
        <div class="text-overlay">
            <h1 class="main-heading">BIKIN KAOS GAK HARUS BANYAK!!!</h1>
            <p class="sub-heading">Genatan Kaos melayani buat kamu yang pengen order kaos custom dengan jumlah berapapun yang kamu mau</p>
        </div>
    </div>
</body>
</html>
