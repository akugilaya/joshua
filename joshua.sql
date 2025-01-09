-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2024 at 04:33 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `joshua`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `activity` text NOT NULL,
  `logged_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `customer_id`, `activity`, `logged_at`) VALUES
(1, 1, 'Pembeli nathan melakukan checkout.', '2024-12-14 16:52:12'),
(2, 2, 'Pembeli afif melakukan checkout.', '2024-12-14 16:54:56'),
(3, 3, 'Pembeli afif melakukan checkout.', '2024-12-14 16:56:22'),
(4, 4, 'Pembeli Tegar melakukan checkout.', '2024-12-15 04:41:49'),
(5, 5, 'Pembeli adit melakukan checkout.', '2024-12-15 08:26:19'),
(6, 6, 'Pembeli adit melakukan checkout.', '2024-12-15 08:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `created_at`) VALUES
(1, 'nathan', 'jalan rahrdja indah jaten', '2024-12-14 16:52:12'),
(2, 'afif', 'klaten', '2024-12-14 16:54:56'),
(3, 'afif', 'klaten', '2024-12-14 16:56:22'),
(4, 'Tegar', 'Sukoharjo', '2024-12-15 04:41:49'),
(5, 'adit', 'jalan palur', '2024-12-15 08:26:19'),
(6, 'adit', 'palur', '2024-12-15 08:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `username`, `status`, `timestamp`) VALUES
(35, 'root', 'Login sukses', '2024-11-15 13:21:27'),
(36, 'root', 'Login sukses', '2024-11-15 13:46:18'),
(37, 'root', 'Password salah', '2024-11-15 13:47:27'),
(38, 'root', 'Username tidak ditemukan', '2024-11-15 13:47:54'),
(39, 'root', 'Login sukses', '2024-11-23 20:45:11'),
(40, 'root', 'Login sukses', '2024-12-11 10:09:15'),
(41, 'root', 'Login sukses', '2024-12-11 12:12:41'),
(42, 'root', 'Login sukses', '2024-12-11 13:20:44'),
(43, 'root', 'Login sukses', '2024-12-12 09:26:32'),
(44, 'root', 'Login sukses', '2024-12-12 10:06:22'),
(45, 'root', 'Login sukses', '2024-12-12 10:32:13'),
(46, 'root', 'Login sukses', '2024-12-12 11:03:54'),
(47, 'root', 'Login sukses', '2024-12-12 11:06:09'),
(48, 'root', 'Login sukses', '2024-12-12 11:07:11'),
(49, 'root', 'Login sukses', '2024-12-12 11:08:12'),
(50, 'root', 'Login sukses', '2024-12-12 12:01:00'),
(51, 'root', 'Login sukses', '2024-12-13 16:17:52'),
(52, 'root', 'Login sukses', '2024-12-13 16:21:18'),
(53, 'root', 'Login sukses', '2024-12-14 12:31:46'),
(54, 'root', 'Login sukses', '2024-12-14 12:37:33'),
(55, 'root', 'Login sukses', '2024-12-15 11:37:04'),
(56, 'root', 'Login sukses', '2024-12-15 16:51:25'),
(57, 'root', 'Login sukses', '2024-12-15 16:54:11'),
(58, 'root', 'Login sukses', '2024-12-15 17:00:54'),
(59, 'root', 'Captcha tidak valid', '2024-12-15 18:12:56'),
(60, 'root', 'Captcha tidak valid', '2024-12-15 19:33:18'),
(61, 'root', 'Captcha tidak valid', '2024-12-15 19:36:25'),
(62, 'root', 'Captcha tidak valid', '2024-12-15 19:36:54'),
(63, 'root', 'Captcha tidak valid', '2024-12-15 19:37:00'),
(64, 'root', 'Captcha tidak valid', '2024-12-15 19:39:44'),
(65, 'root', 'Login sukses', '2024-12-15 19:46:33'),
(66, 'root', 'Login sukses', '2024-12-15 19:46:42'),
(67, 'root', 'Username tidak ditemukan', '2024-12-15 20:00:32'),
(68, 'root', 'Login sukses', '2024-12-15 20:00:39'),
(69, 'root', 'Login sukses', '2024-12-15 20:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` int(11) NOT NULL,
  `waktu` datetime DEFAULT current_timestamp(),
  `aktivitas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id`, `waktu`, `aktivitas`) VALUES
(1, '2024-12-14 13:34:01', 'Checkout berhasil: Transaksi ID 0 dengan total 1 produk'),
(2, '2024-12-14 13:34:03', 'Checkout berhasil: Transaksi ID 0 dengan total 1 produk'),
(3, '2024-12-14 13:34:05', 'Checkout berhasil: Transaksi ID 0 dengan total 1 produk'),
(4, '2024-12-14 13:34:17', 'Checkout berhasil: Transaksi ID 0 dengan total 2 produk'),
(5, '2024-12-14 13:36:58', 'Checkout berhasil: Transaksi ID 0 dengan total 3 produk'),
(6, '2024-12-14 17:05:16', 'Checkout berhasil: Transaksi ID 0 dengan total 1 produk'),
(7, '2024-12-14 17:14:33', 'Checkout berhasil: Transaksi ID 0 dengan total 1 produk'),
(8, '2024-12-14 17:16:13', 'Checkout berhasil: Transaksi ID 0 dengan total 1 produk'),
(9, '2024-12-14 17:24:43', 'Checkout berhasil: Transaksi ID 0 dengan total 1 produk'),
(10, '2024-12-14 17:24:44', 'Checkout berhasil: Transaksi ID 0 dengan total 1 produk');

-- --------------------------------------------------------

--
-- Table structure for table `masukan`
--

CREATE TABLE `masukan` (
  `nama` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `masukan` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prem`
--

CREATE TABLE `prem` (
  `id` int(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_premium` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `product_name`, `category`, `price`, `description`, `image`, `created_at`, `quantity`) VALUES
(26, 'Bolpoin', 'atk', 5000, 'alat tulis kantor bolpoin snowman', 'atk.jpg', '2024-12-13 08:29:29', 1),
(27, 'Gantungan Kunci bali', 'aksesoris', 20000, 'Gantungan Kunci cocok untuk semuanya', 'gantungan.jpg', '2024-12-13 08:36:32', 1),
(28, 'bakpia pathok', 'makanan', 20000, 'bakpia pathok asli jogja', 'bakpia.jpg', '2024-12-14 05:41:15', 1),
(29, 'Baju RedBull', 'pakaian', 100000, 'Baju full print redbull', 'redbull.jpg', '2024-12-15 04:39:34', 1),
(30, 'dompet', 'aksesoris', 30000, 'dompet kulit', 'WhatsApp Image 2024-12-07 at 6.24.30 PM.jpeg', '2024-12-15 09:52:15', 1),
(31, 'tipek', 'atk', 5000, 'ini tipek', 'tipekk.jpg', '2024-12-15 10:01:53', 1),
(32, 'chatime', 'minuman', 60000, 'Titip chatime di solo', 'chatime.jpg', '2024-12-15 13:21:49', 1),
(33, 'Docmart', 'sepatu', 500000, 'Titip Docmart lagi promo disini', 'dc.jpg', '2024-12-15 13:22:49', 1),
(34, 'Hampers', 'kado/hadiah', 350000, 'Titip Hampers buat hadiah disini juga', 'hampers.jpg', '2024-12-15 13:23:27', 1),
(36, 'GladtoGlow', 'kosmetik', 40000, 'Lagi Promo buruan titip', 'gng.jpg', '2024-12-15 13:29:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reg`
--

CREATE TABLE `reg` (
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photoName` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reg`
--

INSERT INTO `reg` (`nama`, `password`, `phone`, `email`, `photoName`, `date`) VALUES
('Yonathan Tanjung', '$2y$10$Q4DYy9qqlJnPIUxuEErpGOSySeZMyqHp7MU.Dy28tSSl3Xx.lN4NG', '08936473456', 'nthn.srkrtns@gmail.com', 'erd.jpg', '2024-11-05'),
('Yonathan Tanjung', '$2y$10$R0x1OzJtB.4fopZhKXGEFeBFWGupgJzV2qlgQKgcK9ndb7Gy9LVPW', '08936473456', 'nthn.srkrtns@gmail.com', 'erd.jpg', '2024-11-05'),
('Yonathan Tanjung', '$2y$10$4S103ycxiw3Q.Eanp2YVWOpIDVhqKmPx3Ooc0bZnII8Sda9.gfY76', '08936473456', 'nthn.srkrtns@gmail.com', 'erd.jpg', '2024-11-05'),
('Yonathan Tanjung', '$2y$10$VY2hmcwwCpJ1XbWN.ASad.VSpWyRqZgHB.1Rudb5WMfRTW.uPUWZS', '08936473456', 'nthn.srkrtns@gmail.com', 'erd.jpg', '2024-11-05'),
('Yonathan Tanjung', '$2y$10$n3xbcy6vU7sonHRvJSjACOpOCfmLpmJAXvx07SeGlgNSeI6bMk95y', '08936473456', 'nthn.srkrtns@gmail.com', 'erd.jpg', '2024-11-05'),
('Yonathan Tanjung', '$2y$10$2/xhu/Gq8DNjozwBpkTKLeJT/d4jH5GSl9./wl4lSUtJRCG4mJnxe', '08936473456', 'nthn.srkrtns@gmail.com', 'erd.jpg', '2024-11-05'),
('afifudin', '$2y$10$HHZMnDhtaJxth4jUapkGzuTe2ckd6pdXhE9qhSdVoVs3.OBod2mYu', '0895363465261', 'afif@gmaiil.com', '1.png', '2024-11-05'),
('Tegar', '$2y$10$TzkzYFk9woZQBH5azgdQ3./8HB1sO9H5AX/lol1QdhYSwr.eZ1hde', '0895247138', 'tegarj@gmail.com', '2024-10-31 21_39_42-Window.png', '2024-11-05'),
('afifudin', '$2y$10$QCVdHitZ8qf4thjCdPtK1OcKMAKsmeMjBNgPnzyyy0X/GurcIR1n.', '0781234567', 'afif@gmaiil.com', 'RedblackPatch.webp', '2024-11-12'),
('tua', '$2y$10$XjGSY1rwqRLGbNOQMKpqLOd49HkX6gndkiPdTbheSRGEmk13ZV7X2', '01243567889', 'tuabangka@gmail.com', 'cropped-LOGO-USH-NEW-150x150.png', '2024-11-12'),
('NATHAN', '$2y$10$kzBHVc.g72Mx2t9DmxTVP.gxpv1vWzEPvamxWh0bMytsbe6ONa1pO', '0895343475757', 'ordeca.vanstranda@gmail.com', '1.png', '2024-11-13'),
('TuaBangka', '$2y$10$nFxvURO9DV2897iOwvyVe.VFqrWYJtJqDzYOVHabrrNLn836w1vj2', '089356342635', 'Tuabangka123@gmail.com', 'cropped-LOGO-USH-NEW-150x150.png', '2024-11-15'),
('joshua', '$2y$10$v8/pndzYPLps/K.SKHEWquIL2bGPGGZiU93.EWPU4lHWMsTQg1sra', '0832776190', 'joshua@gmail.com', 'RedblackPatch.webp', '2024-11-15');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `cart` varchar(255) NOT NULL,
  `total` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`name`, `address`, `payment_method`, `cart`, `total`) VALUES
('nathan', 'jaten', 'DANA', '[{\"product_name\":\"Baju RedBull\",\"price\":\"100000\",\"quantity\":2}]', 200000),
('Tegar', 'sukoharjo', 'TF BANK', '[{\"product_name\":\"Baju RedBull\",\"price\":\"100000\",\"quantity\":1}]', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `total_price`, `transaction_date`, `payment_method`, `status`) VALUES
(1, '40000.00', '2024-12-14 13:17:34', NULL, NULL),
(2, '20000.00', '2024-12-14 13:18:09', NULL, NULL),
(3, '20000.00', '2024-12-14 13:18:57', NULL, NULL),
(4, '20000.00', '0000-00-00 00:00:00', 'credit_card', 'pending'),
(5, '20000.00', '0000-00-00 00:00:00', 'credit_card', 'pending'),
(6, '20000.00', '0000-00-00 00:00:00', 'credit_card', 'pending'),
(7, '20000.00', '0000-00-00 00:00:00', 'credit_card', 'pending'),
(8, '20000.00', '0000-00-00 00:00:00', 'credit_card', 'pending'),
(9, '20000.00', '0000-00-00 00:00:00', 'credit_card', 'pending'),
(10, '20000.00', '0000-00-00 00:00:00', 'credit_card', 'pending'),
(11, '20000.00', '0000-00-00 00:00:00', 'credit_card', 'pending'),
(12, '60000.00', '0000-00-00 00:00:00', 'credit_card', 'pending'),
(13, '60000.00', '0000-00-00 00:00:00', 'credit_card', 'pending'),
(14, '60000.00', '0000-00-00 00:00:00', 'credit_card', 'pending'),
(15, '80000.00', '0000-00-00 00:00:00', 'credit_card', 'pending'),
(16, '120000.00', '0000-00-00 00:00:00', 'credit_card', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('admin', 'ngadimin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prem`
--
ALTER TABLE `prem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `prem`
--
ALTER TABLE `prem`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
