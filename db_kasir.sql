-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Feb 2025 pada 03.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `HapusPenjualan` (IN `p_PenjualanID` BIGINT)   BEGIN
    -- Hapus semua detail penjualan terlebih dahulu
    DELETE FROM detailpenjualan WHERE PenjualanID = p_PenjualanID;

    -- Hapus penjualan
    DELETE FROM penjualan WHERE PenjualanID = p_PenjualanID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `TambahPenjualan` (IN `p_TanggalPenjualan` DATE, IN `p_PelangganID` BIGINT)   BEGIN
    INSERT INTO penjualan (TanggalPenjualan, PelangganID, TotalHarga, created_at, updated_at)
    VALUES (p_TanggalPenjualan, p_PelangganID, 0, NOW(), NOW());
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailpenjualan`
--

CREATE TABLE `detailpenjualan` (
  `DetailID` bigint(20) UNSIGNED NOT NULL,
  `PenjualanID` bigint(20) UNSIGNED NOT NULL,
  `ProdukID` bigint(20) UNSIGNED NOT NULL,
  `JumlahProduk` int(11) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detailpenjualan`
--

INSERT INTO `detailpenjualan` (`DetailID`, `PenjualanID`, `ProdukID`, `JumlahProduk`, `Subtotal`, `created_at`, `updated_at`) VALUES
(9, 7, 10, 1, 30000.00, '2025-02-11 18:53:15', '2025-02-11 18:53:15'),
(12, 4, 13, 3, 135000.00, '2025-02-11 18:54:03', '2025-02-11 18:54:03'),
(14, 8, 5, 1, 60000.00, '2025-02-11 18:54:40', '2025-02-11 18:54:40'),
(15, 8, 1, 40, 80000.00, '2025-02-11 19:56:28', '2025-02-11 19:56:28'),
(16, 5, 8, 5, 175000.00, '2025-02-11 19:56:41', '2025-02-11 19:56:41'),
(22, 16, 7, 5, 75000.00, '2025-02-12 19:50:23', '2025-02-12 19:50:23'),
(23, 10, 13, 1, 45000.00, '2025-02-12 19:51:09', '2025-02-12 19:51:09');

--
-- Trigger `detailpenjualan`
--
DELIMITER $$
CREATE TRIGGER `adjust_stock_after_update` AFTER UPDATE ON `detailpenjualan` FOR EACH ROW BEGIN
    UPDATE produk
    SET Stok = Stok + OLD.JumlahProduk - NEW.JumlahProduk
    WHERE ProdukID = NEW.ProdukID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `reduce_stock_after_insert` AFTER INSERT ON `detailpenjualan` FOR EACH ROW BEGIN
    UPDATE produk
    SET Stok = Stok - NEW.JumlahProduk
    WHERE ProdukID = NEW.ProdukID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `restore_stock_after_delete` AFTER DELETE ON `detailpenjualan` FOR EACH ROW BEGIN
    UPDATE produk
    SET Stok = Stok + OLD.JumlahProduk
    WHERE ProdukID = OLD.ProdukID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_total_harga_after_update` AFTER UPDATE ON `detailpenjualan` FOR EACH ROW BEGIN
    UPDATE penjualan
    SET TotalHarga = (
        SELECT COALESCE(SUM(Subtotal), 0)
        FROM detailpenjualan
        WHERE PenjualanID = NEW.PenjualanID
    )
    WHERE PenjualanID = NEW.PenjualanID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_02_10_062447_create_pelanggans_table', 1),
(6, '2025_02_10_075447_create_penjualans_table', 1),
(7, '2025_02_11_011711_create_produks_table', 1),
(8, '2025_02_11_021504_create_detail_penjualans_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `PelangganID` bigint(20) UNSIGNED NOT NULL,
  `NamaPelanggan` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `NomorTelepon` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`PelangganID`, `NamaPelanggan`, `Alamat`, `NomorTelepon`, `created_at`, `updated_at`) VALUES
(1, 'Aleser Omar Tarikh', 'Jl. Trikora Kijang Kota', '082122222222', '2025-02-10 21:32:18', '2025-02-10 21:32:18'),
(2, 'Zahrima', 'Perum. Telaga Bintan Korindo', '085622222222', '2025-02-10 21:33:44', '2025-02-11 18:39:01'),
(4, 'Indri', 'Perum. SanDona Baloi Batam Kota', '082133333333', '2025-02-11 18:36:00', '2025-02-11 18:36:00'),
(5, 'Dewi', 'Perum. SanDona Baloi Batam Kota', '082144444444', '2025-02-11 18:36:29', '2025-02-11 18:39:09'),
(6, 'Gabriel', 'Perum. SanDona Baloi Batam Kota', '082155555555', '2025-02-11 18:36:45', '2025-02-11 18:36:45'),
(7, 'Rio', 'Batu 8  Tanjung Pinang', '082177777777', '2025-02-11 18:37:33', '2025-02-11 18:37:33'),
(8, 'Ruby', 'Perum. SanDona Baloi Batam Kota', '082166666666', '2025-02-11 18:38:19', '2025-02-11 18:39:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `PenjualanID` bigint(20) UNSIGNED NOT NULL,
  `TanggalPenjualan` date NOT NULL,
  `PelangganID` bigint(20) UNSIGNED NOT NULL,
  `TotalHarga` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Automatically calculated from detailpenjualan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`PenjualanID`, `TanggalPenjualan`, `PelangganID`, `TotalHarga`, `created_at`, `updated_at`) VALUES
(4, '2025-02-12', 4, 0.00, '2025-02-11 18:42:14', '2025-02-11 18:42:14'),
(5, '2025-02-12', 8, 0.00, '2025-02-11 18:42:22', '2025-02-11 18:42:22'),
(7, '2025-02-12', 2, 0.00, '2025-02-11 18:42:39', '2025-02-11 18:42:39'),
(8, '2025-02-12', 5, 0.00, '2025-02-11 18:42:49', '2025-02-11 18:42:49'),
(10, '2025-02-12', 7, 0.00, '2025-02-11 18:43:24', '2025-02-11 18:43:24'),
(16, '2025-02-13', 6, 0.00, '2025-02-13 02:49:49', '2025-02-13 02:49:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `ProdukID` bigint(20) UNSIGNED NOT NULL,
  `NamaProduk` varchar(255) NOT NULL,
  `Harga` decimal(10,2) NOT NULL,
  `Stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`ProdukID`, `NamaProduk`, `Harga`, `Stok`, `created_at`, `updated_at`) VALUES
(1, 'Indomie Goreng', 2000.00, 80, '2025-02-10 21:32:42', '2025-02-11 00:18:25'),
(2, 'Indomie Kuah', 2000.00, 200, '2025-02-11 00:30:11', '2025-02-11 00:30:11'),
(4, 'CrunchyBite Peanut Butter', 75000.00, 20, '2025-02-11 18:47:01', '2025-02-11 18:47:01'),
(5, 'FrostyMoo Chocolate Ice Cream', 60000.00, 49, '2025-02-11 18:47:18', '2025-02-11 18:47:18'),
(6, 'FreshBrew Classic Black Coffee (250g)', 90000.00, 30, '2025-02-11 18:47:36', '2025-02-11 18:47:36'),
(7, 'CrispyWave Seaweed Chips', 15000.00, 25, '2025-02-11 18:47:59', '2025-02-11 18:47:59'),
(8, 'FreshGuard Antibacterial Hand Soap', 35000.00, 19, '2025-02-11 18:48:24', '2025-02-11 18:48:24'),
(9, 'CleanBreeze Laundry Detergent (2L)', 75000.00, 30, '2025-02-11 18:48:44', '2025-02-11 18:48:44'),
(10, 'EverFresh Scented Trash Bags (Roll of 30)', 30000.00, 34, '2025-02-11 18:50:30', '2025-02-11 18:50:30'),
(11, 'AquaShield Hydrating Body Lotion (250ml)', 95000.00, 25, '2025-02-11 18:51:13', '2025-02-11 18:51:13'),
(12, 'NutriFuel Protein Granola Bars', 16000.00, 25, '2025-02-11 18:51:55', '2025-02-11 18:51:55'),
(13, 'BellaPasta Whole Wheat Spaghetti', 45000.00, 61, '2025-02-11 18:52:23', '2025-02-11 18:52:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'aleser tarikh omar', 'kasir1@gmail.com', NULL, '$2y$10$waFqj4MgXkUADRE3yMKRsufDRRDmH8OgAL0qthwjmp6XVfZo3PjeO', NULL, '2025-02-10 22:23:52', '2025-02-10 22:23:52'),
(2, 'Zahrima', 'kasir2@gmail.com', NULL, '$2y$10$71JMyh.EwG2okfhjtnM.E.ChVvQzJs5RQLKSGHoQkoCjA0DztebKK', NULL, '2025-02-11 18:28:00', '2025-02-11 18:28:00'),
(3, 'aleima', 'kasir3@gmail.com', NULL, '$2y$10$9so.zGHpEeS.mTW03IVhQerT07QiFv20HH/cjaj7L4KAzgZZwQYla', NULL, '2025-02-12 23:57:54', '2025-02-12 23:57:54');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD PRIMARY KEY (`DetailID`),
  ADD KEY `detailpenjualan_penjualanid_foreign` (`PenjualanID`),
  ADD KEY `detailpenjualan_produkid_foreign` (`ProdukID`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`PelangganID`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`PenjualanID`),
  ADD KEY `penjualan_pelangganid_foreign` (`PelangganID`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`ProdukID`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  MODIFY `DetailID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `PelangganID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `PenjualanID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `ProdukID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD CONSTRAINT `detailpenjualan_penjualanid_foreign` FOREIGN KEY (`PenjualanID`) REFERENCES `penjualan` (`PenjualanID`) ON DELETE CASCADE,
  ADD CONSTRAINT `detailpenjualan_produkid_foreign` FOREIGN KEY (`ProdukID`) REFERENCES `produk` (`ProdukID`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_pelangganid_foreign` FOREIGN KEY (`PelangganID`) REFERENCES `pelanggan` (`PelangganID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
