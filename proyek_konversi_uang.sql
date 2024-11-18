-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 18, 2024 at 05:51 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek_konversi_uang`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `matauang_asal` varchar(20) NOT NULL,
  `jumlah` int NOT NULL,
  `total` int NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `status_pembayaran` varchar(50) NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `matauang_asal`, `jumlah`, `total`, `created_at`, `status_pembayaran`, `id_user`) VALUES
(88, 'AED', 2, 8648, '2024-11-16 06:46:20', 'Berhasil', 10),
(89, 'ARS', 123, 1949427, '2024-11-16 07:27:26', 'Berhasil', 10),
(90, 'AUD', 123, 1262472, '2024-11-16 08:48:07', 'Berhasil', 12),
(91, 'BBD', 15, 119100, '2024-11-16 08:53:17', 'Berhasil', 12),
(93, 'NZD', 12, 111744, '2024-11-16 10:42:20', 'Berhasil', 10),
(94, 'AED', 1, 4327, '2024-11-17 12:47:40', 'Belum Lunas', 10),
(95, 'BDT', 1, 133, '2024-11-17 12:47:51', 'Belum Lunas', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `user_role`) VALUES
(1, 'mluqmaan22@gmail.com', '$2y$10$dQIP2SSpkp0SUF6YveiCM.HGvgin3KYUwxzske59jD5X5BVoKtYFS', 'Admin'),
(7, 'mluqmaan23@gmail.com', '$2y$10$FsNG4kGM5tcZVAKZCaBKuOkqjeREmtsm6UImoSgvocQ3ZS1RDGDS.', 'User'),
(9, 'maman', '$2y$10$DCNJpsTMru24R3noIA3T/.pTHRKHiYpoxP7k4FOxuYcXowSyXBZ8O', 'Admin'),
(10, 'Maan', '$2y$10$1IC/ArG7TuL.ZDLhraS9ruvmRyUMst3cKRQbWWn243WJM48hyU8ra', 'User'),
(11, 'Maan1', '$2y$10$nrBk5kwY.7tjtM.vObKl5eSp.3bCaOVKpAdzDz./A5JXAd0MtSCDS', 'Admin'),
(12, 'Luq', '$2y$10$bgvvRgs9s9BMBW87hh/D1uGqiA733V5z8RzjtXwskorOn5qK1xadC', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
