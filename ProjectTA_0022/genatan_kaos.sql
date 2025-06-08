-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2025 at 06:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `genatan_kaos`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `profile_color` varchar(7) NOT NULL DEFAULT '#FFFFFF',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `username`, `password`, `nama_lengkap`, `profile_color`, `created_at`, `updated_at`) VALUES
(1, 'admin_super', '$2y$10$HZRjMxeQKNGNU6e7NE8YyuFAu9CYJNPo2Y6TGhtvcgpMtdfyC/4ri', 'Super Administrator', '#4A90E2', '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(2, 'admin_content', '$2y$10$E/oYHIeuwNDreHZqv3aTFuX65hzVWIoOm41RnMahWlANuvkqw2BoS', 'Content Manager', '#50E3C2', '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(3, 'admin_product', '$2y$10$zIOFm0cI4Xei/ILxV3zPkes4BmcdA6pXiCKqy.dPSX.Q0eXflgyia', 'Product Manager', '#F5A623', '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(4, 'genatan123', '$2y$10$wreWd29h.SamzV9QmOYeqeSPwTuYzOxSGRQmNgHsIXQeEhiNy2wY.', 'genatan123', 'bg-succ', '2025-01-20 11:06:28', '2025-01-20 11:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_kategori` int(11) UNSIGNED NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Kaos Polos Premium', '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(2, 'Kaos Graphic Design', '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(3, 'Kaos Limited Edition', '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(4, 'Kaos Custom Design', '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(5, 'Kaos Couple', '2025-01-20 07:21:53', '2025-01-20 07:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaction`
--

CREATE TABLE `detail_transaction` (
  `id_detail_transaction` int(11) NOT NULL,
  `id_transaction` int(11) NOT NULL,
  `id_produk` int(10) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaction`
--

INSERT INTO `detail_transaction` (`id_detail_transaction`, `id_transaction`, `id_produk`, `jumlah`, `total_harga`) VALUES
(2, 2, 11, 2, 450000.00),
(3, 3, 10, 1, 225000.00),
(4, 3, 11, 1, 225000.00),
(5, 4, 11, 2, 450000.00),
(6, 4, 10, 2, 450000.00);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-12-21-063800', 'App\\Database\\Migrations\\CreateGenatanKaosTables', 'default', 'App', 1737357695, 1),
(2, '2025-01-16-032022', 'App\\Database\\Migrations\\CreateOrdersTable', 'default', 'App', 1737357695, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_produk` int(11) UNSIGNED NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(12,2) NOT NULL DEFAULT 0.00,
  `gambar` blob DEFAULT NULL,
  `id_kategori` int(11) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_produk`, `nama_produk`, `deskripsi`, `harga`, `gambar`, `id_kategori`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'Kaos Polos Premium Cotton Black', 'Kaos polos premium dengan bahan cotton combed 30s. Nyaman dipakai, tidak mudah kusut, dan tahan lama.', 89000.00, 0x706f6c6f735f626c61636b5f7072656d69756d2e6a7067, 1, 100, '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(2, 'Kaos Polos Premium Cotton White', 'Kaos polos premium dengan bahan cotton combed 30s. Warna putih bersih dan tidak mudah kusam.', 89000.00, 0x706f6c6f735f77686974655f7072656d69756d2e6a7067, 1, 100, '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(3, 'Kaos Polos Premium Cotton Navy', 'Kaos polos premium dengan bahan cotton combed 30s. Warna navy elegant dan klasik.', 89000.00, 0x706f6c6f735f6e6176795f7072656d69756d2e6a7067, 1, 75, '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(4, 'Kaos Graphic Urban Style', 'Kaos dengan desain grafis urban modern. Cocok untuk anak muda yang stylish.', 129000.00, 0x677261706869635f757262616e2e6a7067, 2, 50, '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(5, 'Kaos Graphic Nature', 'Kaos dengan desain grafis tema alam. Desain eksklusif dan detail tinggi.', 135000.00, 0x677261706869635f6e61747572652e6a7067, 2, 45, '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(6, 'Kaos Limited Art Series Vol.1', 'Kaos limited edition dengan artwork dari seniman lokal. Hanya tersedia 50 pcs.', 249000.00, 0x6c696d697465645f6172745f312e6a7067, 3, 50, '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(7, 'Kaos Limited Batik Modern', 'Kaos limited edition dengan motif batik modern. Limited stock 30 pcs.', 279000.00, 0x6c696d697465645f626174696b2e6a7067, 3, 30, '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(8, 'Custom Name Jersey Style', 'Kaos custom dengan desain ala jersey. Bisa request nama dan nomor.', 159000.00, 0x637573746f6d5f6a65727365792e6a7067, 4, 100, '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(9, 'Custom Full Print Design', 'Kaos custom dengan full print design sesuai keinginan. Area print luas.', 199000.00, 0x637573746f6d5f66756c6c7072696e742e6a7067, 4, 100, '2025-01-20 07:21:53', '2025-01-20 07:21:53'),
(10, 'Couple Shirt - Sweet Heart', 'Set kaos couple dengan desain romantic sweet heart. Tersedia ukuran pria dan wanita.', 225000.00, 0x75706c6f6164732f70726f64756374732f313733373435343730385f64353335376162636331636134636565346366392e77656270, 5, 40, '2025-01-20 07:21:53', '2025-01-21 10:18:28'),
(11, 'Couple Shirt - King & Queen', 'Set kaos couple dengan tema King & Queen. Perfect untuk pasangan.', 225000.00, 0x75706c6f6164732f70726f64756374732f313733373532343635395f30653063626636373466616633663339663130392e77656270, 5, 35, '2025-01-20 07:21:53', '2025-01-22 05:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id_detail` int(11) UNSIGNED NOT NULL,
  `id_produk` int(11) UNSIGNED NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id_detail`, `id_produk`, `key`, `value`) VALUES
(1, 1, 'Material', 'Cotton Combed 30s'),
(2, 2, 'Material', 'Polyester'),
(3, 3, 'Material', 'Rayon'),
(4, 4, 'Material', 'Denim'),
(5, 5, 'Material', 'Wool'),
(6, 6, 'Material', 'polimer'),
(7, 7, 'Material', 'Linen'),
(8, 8, 'Material', 'Silk'),
(9, 9, 'Material', 'Leather'),
(10, 10, 'Material', 'Satin'),
(11, 11, 'Material', 'Velvet');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(11) NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jml_produk` int(11) DEFAULT NULL,
  `grand_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id_transaction`, `id_user`, `tgl_transaksi`, `jml_produk`, `grand_total`) VALUES
(2, 3, '2025-01-21 12:38:40', 1, 450000.00),
(3, 3, '2025-01-21 12:38:40', 2, 450000.00),
(4, 4, '2025-01-22 05:46:47', 2, 900000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'user_one', 'userone@example.com', '$2y$10$ohvd2Dp14.lM0OyUS9Lnleki47fsSny4UVn8KcgfyvI8mT3pZpscO', '2025-01-20 07:27:28', '2025-01-20 07:27:28'),
(2, 'user_two', 'usertwo@example.com', '$2y$10$ujVlE1ix012X8fpDds1tgemzw7gV4dhOyhXH.E5e2vibJFEONC0hG', '2025-01-20 07:27:28', '2025-01-20 07:27:28'),
(3, 'genatan123', 'genatan123@gmail.com', '$2y$10$Asx42IyqoQc6kmCc9YDqXuKLRTi/5blKoUEi3hMBRw2q7T/A5XB62', '2025-01-20 11:07:52', '2025-01-20 11:07:52'),
(4, 'wildan', 'wildan@gmail.com', '$2y$10$KPxMRKuf5VqISqYhpo4f3uII.RetVWNE8oGFs/LqBOqgAg.5XnZZq', '2025-01-22 05:46:12', '2025-01-22 05:46:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  ADD PRIMARY KEY (`id_detail_transaction`),
  ADD KEY `id_transaction` (`id_transaction`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `products_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `product_details_id_produk_foreign` (`id_produk`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_kategori` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  MODIFY `id_detail_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_produk` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id_detail` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  ADD CONSTRAINT `detail_transaction_ibfk_1` FOREIGN KEY (`id_transaction`) REFERENCES `transaction` (`id_transaction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaction_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `products` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `categories` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `products` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
