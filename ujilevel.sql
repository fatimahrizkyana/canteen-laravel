-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 02 Okt 2020 pada 04.13
-- Versi server: 5.7.24
-- Versi PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujilevel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `canteen_menus`
--

CREATE TABLE `canteen_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `canteen_menus`
--

INSERT INTO `canteen_menus` (`id`, `name`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nasi goreng', 10000, 'available', '2020-09-20 10:38:44', '2020-09-20 10:38:44'),
(2, 'Air mineral', 4000, 'available', '2020-09-20 11:32:03', '2020-09-23 23:56:11'),
(3, 'Mie ayam', 10000, 'available', '2020-09-21 12:07:16', '2020-09-21 12:07:16'),
(4, 'Teh manis', 4000, 'available', '2020-09-23 23:52:51', '2020-09-23 23:52:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_09_14_094646_create_users_table', 1),
(2, '2020_09_14_095608_create_transactions_table', 1),
(3, '2020_09_14_100230_create_orders_table', 1),
(4, '2020_09_14_100452_create_canteen_menus_table', 1),
(5, '2020_09_14_100547_create_tables_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `canteen_menu_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `transaction_id`, `user_id`, `canteen_menu_id`, `quantity`, `total`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, 10000, '-', 'selesai', '2020-09-21 11:24:33', '2020-09-23 10:41:24'),
(4, 1, 2, 3, 1, 10000, '-', 'selesai', '2020-09-21 12:07:30', '2020-09-23 10:41:24'),
(5, 1, 2, 2, 1, 4000, '-', 'selesai', '2020-09-21 12:10:47', '2020-09-23 10:41:24'),
(6, 2, 2, 2, 2, 8000, '-', 'selesai', '2020-09-22 01:09:42', '2020-09-23 10:46:28'),
(8, 2, 2, 3, 2, 20000, '-', 'selesai', '2020-09-22 01:41:59', '2020-09-23 10:46:28'),
(9, 3, 2, 1, 1, 10000, '-', 'selesai', '2020-09-23 10:49:26', '2020-09-23 10:54:40'),
(11, 3, 2, 2, 3, 12000, '-', 'selesai', '2020-09-23 10:49:50', '2020-09-23 10:54:40'),
(12, 3, 2, 3, 2, 20000, '-', 'selesai', '2020-09-23 10:49:55', '2020-09-23 10:54:40'),
(13, 4, 2, 3, 4, 40000, '-', 'selesai', '2020-09-23 10:55:31', '2020-09-23 23:57:28'),
(14, 4, 2, 4, 3, 12000, '-', 'selesai', '2020-09-23 23:53:20', '2020-09-23 23:57:28'),
(15, 4, 2, 2, 1, 4000, '-', 'selesai', '2020-09-23 23:53:27', '2020-09-23 23:57:28'),
(16, 5, 2, 2, 3, 12000, '-', 'selesai', '2020-09-24 00:06:07', '2020-09-24 00:08:10'),
(17, 5, 2, 1, 2, 20000, '-', 'selesai', '2020-09-24 00:06:13', '2020-09-24 00:08:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tables`
--

CREATE TABLE `tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tables`
--

INSERT INTO `tables` (`id`, `number`, `created_at`, `updated_at`) VALUES
(1, '1', '2020-09-20 11:49:17', '2020-09-20 11:49:17'),
(2, '2', '2020-09-20 11:52:17', '2020-09-20 11:57:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `table_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total` int(11) DEFAULT NULL,
  `cash` int(11) DEFAULT NULL,
  `change` int(11) DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `table_id`, `date`, `total`, `cash`, `change`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2020-09-21', 24000, 25000, 1000, 'paid', '2020-09-21 11:24:32', '2020-09-23 10:41:24'),
(2, 2, 2, '2020-09-22', 28000, 30000, 2000, 'paid', '2020-09-22 01:09:41', '2020-09-23 10:46:28'),
(3, 2, 1, '2020-09-23', 42000, 42000, 0, 'paid', '2020-09-23 10:49:26', '2020-09-23 10:54:40'),
(4, 2, 2, '2020-09-23', 40000, 40000, 0, 'paid', '2020-09-23 10:55:30', '2020-09-23 23:57:28'),
(5, 2, 2, '2020-09-24', 32000, 35000, 3000, 'paid', '2020-09-24 00:06:07', '2020-09-24 00:08:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `level`, `created_at`, `updated_at`) VALUES
(2, 'Farizna', 'Fatimah', '$2y$10$Ww02gbaSEWmcayElWRZoN.gRB1aEymHuKg4.tQP16mR6ilMOvGAEy', 'pemilik', '2020-09-15 20:20:12', '2020-09-15 21:22:51'),
(4, 'Rafi Zadanly', 'rafiz', '$2y$10$9DVl0FgHvmcB3NdRaCSEjeiPhH/uV64lcjEDKelf6ssdcu6n7Xx..', 'pelayan', '2020-09-19 01:30:58', '2020-09-19 01:30:58');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `canteen_menus`
--
ALTER TABLE `canteen_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `canteen_menus`
--
ALTER TABLE `canteen_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
