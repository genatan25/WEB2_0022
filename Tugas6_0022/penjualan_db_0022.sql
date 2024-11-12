-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Nov 2024 pada 06.55
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
-- Database: `penjualan_db_0022`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan_0022`
--

CREATE TABLE `pelanggan_0022` (
  `id_pelanggan` varchar(10) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan_0022`
--

INSERT INTO `pelanggan_0022` (`id_pelanggan`, `nama_pelanggan`, `alamat`) VALUES
('p001', 'John Doe', 'A. Contoh No. 123, Jakarta'),
('p002', 'Jane Smith', 'B. Sample St. 456, Bandung'),
('p003', 'Ali Kurniawan', 'C. Test No. 789, Surabaya'),
('p004', 'genatan', 'pekalongan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_0022`
--

CREATE TABLE `produk_0022` (
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk_0022`
--

INSERT INTO `produk_0022` (`kode_barang`, `nama_barang`, `harga`, `stok`) VALUES
('a001', 'Contoh Barang A', 150000.00, 100),
('a002', 'Contoh Barang B', 250000.00, 50),
('a003', 'Contoh Barang C', 100000.00, 200),
('a004', 'buku', 5000.00, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_0022`
--

CREATE TABLE `transaksi_0022` (
  `id_transaksi` int(11) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `id_pelanggan` varchar(10) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_0022`
--

INSERT INTO `transaksi_0022` (`id_transaksi`, `kode_barang`, `id_pelanggan`, `jumlah`, `total_harga`, `tanggal`) VALUES
(1, 'a001', 'p001', 2, 300000.00, '2024-10-29 10:32:44'),
(2, 'a002', 'p002', 5, 1250000.00, '2024-10-30 14:12:00'),
(3, 'a003', 'p003', 3, 300000.00, '2024-10-31 16:40:20'),
(8, 'a004', 'p004', 3, 15000.00, '2024-11-02 12:54:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pelanggan_0022`
--
ALTER TABLE `pelanggan_0022`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `produk_0022`
--
ALTER TABLE `produk_0022`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indeks untuk tabel `transaksi_0022`
--
ALTER TABLE `transaksi_0022`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `transaksi_0022`
--
ALTER TABLE `transaksi_0022`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi_0022`
--
ALTER TABLE `transaksi_0022`
  ADD CONSTRAINT `transaksi_0022_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `produk_0022` (`kode_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_0022_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan_0022` (`id_pelanggan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
