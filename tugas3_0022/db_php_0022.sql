-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Okt 2024 pada 06.15
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_php_0022`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users_0022`
--

CREATE TABLE `tb_users_0022` (
  `id` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nohp` char(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jeniskelamin` enum('laki-laki','perempuan') NOT NULL,
  `foto` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_users_0022`
--

INSERT INTO `tb_users_0022` (`id`, `nama`, `alamat`, `nohp`, `email`, `jeniskelamin`, `foto`) VALUES
(1, 'Ari Putra', 'Menjangan Bojong', '085742014272', 'ariputra@gmail.com', 'laki-laki', 0x67616d626172332e6a706567),
(2, 'Maharani', 'Binagriya Pekalongan', '085742117500', 'maharani@gmail.com', 'perempuan', 0x67616d626172312e6a706567),
(3, 'Megantera Wati', 'Wiradesa', '081322456678', 'meganterawati@gmail.com', 'perempuan', 0x67616d626172372e6a706567),
(4, 'Panji Setya', 'Podosugih Pekalongan', '081322659901', 'panjisetya@gmail.com', 'laki-laki', 0x67616d626172352e6a706567),
(5, 'Sulistyawati', 'Kajen Pekalongan', '088211883444', 'sulistyawati@gmail.com', 'perempuan', 0x67616d626172322e6a706567),
(7, 'GENATAN', 'pekalongan', '08623767723', 'genatan@gmail.com', 'laki-laki', 0x67616d626172362e6a706567);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_users_0022`
--
ALTER TABLE `tb_users_0022`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_users_0022`
--
ALTER TABLE `tb_users_0022`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
