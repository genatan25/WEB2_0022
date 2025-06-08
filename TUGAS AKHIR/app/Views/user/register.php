<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genatan Kaos - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f3f4f6;
            font-family: 'Arial', sans-serif;
        }
        .auth-container {
            max-width: 400px;
            margin: 60px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .auth-header {
            text-align: center;
            margin-bottom: 25px;
        }
        .auth-header img {
            max-width: 100px;
        }
        .auth-header h1 {
            font-size: 22px;
            color: #333;
            margin-top: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-label {
            font-size: 14px;
            color: #555;
        }
        .form-control {
            font-size: 14px;
        }
        .text-center a {
            text-decoration: none;
            color: #007bff;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
        .alert {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
        <img src="<?= base_url('uploads/logo.webp'); ?>" alt="Genatan Kaos" style="border-radius: 50%; width: 100px; height: 100px;">
            <h1>Register to Genatan Kaos</h1>
        </div>

        <!-- Menampilkan pesan error -->
        <?php if(session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach(session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif ?>

        <form method="post" action="/user/auth/registerProcess">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="username" 
                    name="username" 
                    placeholder="Enter your username" 
                    value="<?= old('username') ?>" 
                    required
                >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="email" 
                    name="email" 
                    placeholder="Enter your email" 
                    value="<?= old('email') ?>" 
                    required
                >
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password" 
                    name="password" 
                    placeholder="Enter your password" 
                    required
                >
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
            <p class="text-center mt-3">Already have an account? <a href="/user/auth/login">Login here</a></p>
        </form>
    </div>
</body>
</html>
