<?php
// app/Views/admin/manage_layout.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Layout</title>
    <!-- Styles -->
    <link href="<?= base_url('template/css/styles.css'); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <!-- Navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="<?= base_url('/admin/dashboard'); ?>">Hallo Admin</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Search Form (optional) -->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Cari..." aria-label="Cari">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Right Navbar -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" 
                   id="navbarDropdown" 
                   href="#" 
                   role="button" 
                   data-bs-toggle="dropdown" 
                   aria-expanded="false">
                   <?php if (!empty($profilePicture)): ?>
                       <img src="<?= base_url($profilePicture); ?>" alt="Profile" class="rounded-circle" width="30" height="30">
                   <?php else: ?>
                       <div class="rounded-circle text-white <?= esc($colorClass ?? 'bg-secondary'); ?> d-flex align-items-center justify-content-center" style="width:30px; height:30px;">
                           <?= esc($initials ?? 'A'); ?>
                       </div>
                   <?php endif; ?>
                   <span class="ms-2 d-none d-lg-inline text-white"><?= esc($adminName ?? 'Admin'); ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="<?= base_url('/admin/logout'); ?>">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Sidebar & Content -->
    <div id="layoutSidenav">
        <!-- Sidebar -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu Admin</div>
                        <a class="nav-link" href="<?= base_url('/admin/dashboard'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduk">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Produk
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProduk" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?= base_url('/admin/manageProducts'); ?>">Daftar Produk</a>
                                <a class="nav-link" href="<?= base_url('/admin/manageCategories'); ?>">Kategori Produk</a>
                            </nav>
                        </div>

                        <a class="nav-link" href="<?= base_url('/admin/manage_layout'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Tampilan Depan
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?= esc($adminName ?? 'Admin'); ?>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Manajemen Layout</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manajemen Layout</li>
                    </ol>

                    <!-- Flashdata sukses / error -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= esc(session()->getFlashdata('success')) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php
                                $errorData = session()->getFlashdata('error');
                                if (is_array($errorData)) {
                                    foreach ($errorData as $err) {
                                        echo "<div>- " . esc($err) . "</div>";
                                    }
                                } else {
                                    echo esc($errorData);
                                }
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Form Pengaturan Layout -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-edit me-1"></i>
                            Pengaturan Layout
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('/admin/manage_layout'); ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="mb-3">
                                    <label for="hero_heading" class="form-label">Hero Heading</label>
                                    <input type="text" class="form-control" id="hero_heading" name="hero_heading" value="<?= esc($settings['hero_heading'] ?? ''); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="hero_subheading" class="form-label">Hero Subheading</label>
                                    <input type="text" class="form-control" id="hero_subheading" name="hero_subheading" value="<?= esc($settings['hero_subheading'] ?? ''); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="background_image" class="form-label">Background Image</label>
                                    <input class="form-control" type="file" id="background_image" name="background_image" accept="image/*">
                                    <?php if (!empty($settings['background_image']) && file_exists($settings['background_image'])): ?>
                                        <img src="<?= base_url($settings['background_image']); ?>" alt="Background Image" class="img-thumbnail mt-2" width="200">
                                    <?php endif; ?>
                                </div>
                                <button type="submit" class="btn btn-primary">Perbarui Pengaturan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; Genatan Kaos <?= date('Y'); ?></div>
                        <div>
                            <a href="#">Privacy Policy</a> &middot; 
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('template/js/scripts.js'); ?>"></script>
</body>
</html>
