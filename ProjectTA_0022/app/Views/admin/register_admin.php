<!-- File: app/Views/admin/register_admin.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register Admin - Admin Panel</title>
    <link href="<?= base_url('template/css/styles.css') ?>" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Register Admin</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Flash Messages -->
                                    <?php if (session()->getFlashdata('error')) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= session()->getFlashdata('error') ?>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Registration Form -->
                                    <form action="<?= base_url('admin/register_admin') ?>" method="post">
                                        <?= csrf_field() ?>

                                        <!-- Username -->
                                        <div class="form-floating mb-3">
                                            <input class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>"
                                                   id="inputUsername"
                                                   type="text"
                                                   name="username"
                                                   placeholder="Username"
                                                   value="<?= old('username') ?>"
                                                   required />
                                            <label for="inputUsername">Username</label>
                                            <?php if (session('errors.username')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.username') ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Password -->
                                        <div class="form-floating mb-3">
                                            <input class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                                                   id="inputPassword"
                                                   type="password"
                                                   name="password"
                                                   placeholder="Password"
                                                   required />
                                            <label for="inputPassword">Password</label>
                                            <?php if (session('errors.password')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.password') ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="form-floating mb-3">
                                            <input class="form-control <?= session('errors.confirm_password') ? 'is-invalid' : '' ?>"
                                                   id="inputConfirmPassword"
                                                   type="password"
                                                   name="confirm_password"
                                                   placeholder="Confirm Password"
                                                   required />
                                            <label for="inputConfirmPassword">Confirm Password</label>
                                            <?php if (session('errors.confirm_password')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.confirm_password') ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Full Name -->
                                        <div class="form-floating mb-3">
                                            <input class="form-control <?= session('errors.nama_lengkap') ? 'is-invalid' : '' ?>"
                                                   id="inputFullName"
                                                   type="text"
                                                   name="nama_lengkap"
                                                   placeholder="Full Name"
                                                   value="<?= old('nama_lengkap') ?>"
                                                   required />
                                            <label for="inputFullName">Full Name</label>
                                            <?php if (session('errors.nama_lengkap')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.nama_lengkap') ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit">Register</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Login Link -->
                                <div class="card-footer text-center py-3">
                                    <div class="small">
                                        <a href="<?= base_url('admin/login') ?>">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Footer -->
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website <?= date('Y') ?></div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('template/js/scripts.js') ?>"></script>
</body>
</html>