-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 10:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amine`
--

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `id` int(11) NOT NULL,
  `sponsor_name` varchar(255) NOT NULL,
  `sponsor_logo` varchar(255) NOT NULL,
  `sponsor_description` longtext NOT NULL,
  `sponsor_email` varchar(255) NOT NULL,
  `sponsor_phone` varchar(255) NOT NULL,
  `sponsor_address` varchar(255) NOT NULL,
  `sponsor_website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`id`, `sponsor_name`, `sponsor_logo`, `sponsor_description`, `sponsor_email`, `sponsor_phone`, `sponsor_address`, `sponsor_website`) VALUES
(1, 'hellosponsor', 'aa', 'aeaeaeaea', 'eaaa@ieee.org', '+21654303898', 'Tunis', 'website'),
(22, 'hellosponsor', 'logo.png', 'aaaaaaaaaaaaa', 'kaabi@esprit.tn', '54303898', 'Tunis', 'https://github.com'),
(27, 'hellosponsor', 'nodejs-icon-2048x2048-rueyo8fw.png', 'AZAZAZAZA', 'farouk.chalghoumi031@gmail.com', '54303898', 'Tunis', 'https://github.com/settings/emails'),
(28, 'hellosponsor', 'nodejs-icon-2048x2048-rueyo8fw.png', 'AZAZAZAZA', 'farouk.chalghoumi031@gmail.com', '54303898', 'Tunis', 'https://github.com/settings/emails'),
(29, 'hellosponsor', 'nodejs-icon-2048x2048-rueyo8fw.png', 'AZAZAZAZA', 'farouk.chalghoumi031@gmail.com', '54303898', 'Tunis', 'https://github.com/settings/emails'),
(30, 'hellosponsor', 'nodejs-icon-2048x2048-rueyo8fw.png', 'AZAZAZAZA', 'farouk.chalghoumi031@gmail.com', '54303898', 'Tunis', 'https://github.com/settings/emails'),
(31, 'hellosponsor', 'userIcon.png', 'zazaaazazza', 'farouk.chalghoumi031@gmail.com', '54303898', 'Tunis', 'https://github.com/settings/emails'),
(32, 'hellosponsor', 'gmail.png', 'aazazaza', 'farouk.chalghoumi031@gmail.com', '54303898', 'Tunis', 'https://github.com/settings/emails'),
(33, 'Actia', 'gmail.png', 'Description actia', 'actia@gmail.com', '54303898', 'Tunis', 'https://github.com/settings/emails'),
(34, 'Actia', 'mongodb_original_logo_icon_146424.png', 'azazaza', 'kaabi@esprit.tn', '54303898', 'Tunis', 'https://github.com/settings/emails');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor_contract`
--

CREATE TABLE `sponsor_contract` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `payement_method` varchar(255) NOT NULL,
  `contract_status` tinyint(1) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `sponsor_id` int(11) DEFAULT NULL,
  `sponsor_pack_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsor_contract`
--

INSERT INTO `sponsor_contract` (`id`, `start_date`, `end_date`, `payement_method`, `contract_status`, `created_at`, `updated_at`, `sponsor_id`, `sponsor_pack_id`) VALUES
(1, '2024-04-25', '2024-04-25', 'Credit Card', 1, '2024-04-25', '2024-04-25', 1, 1),
(2, '2024-04-25', '2024-04-25', 'Credit Card', 1, '2024-04-25', '2024-04-25', 1, 1),
(4, '2024-04-06', '2024-04-11', 'Bank Transfer', 1, '2024-04-25', '2024-04-25', 31, NULL),
(5, '2024-04-11', '2024-04-05', 'Credit Card', 1, '2024-04-25', '2024-04-25', 32, 6),
(6, '2024-04-17', '2024-04-16', 'Bank Transfer', 1, '2024-04-25', '2024-04-25', 33, 19),
(7, '2024-04-26', '2024-04-19', 'Credit Card', 1, '2024-04-25', '2024-04-25', 34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sponsor_pack`
--

CREATE TABLE `sponsor_pack` (
  `id` int(11) NOT NULL,
  `pack_name` varchar(255) NOT NULL,
  `pack_description` varchar(255) NOT NULL,
  `pack_price` double NOT NULL,
  `pack_status` tinyint(1) NOT NULL,
  `create_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `image_pack` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsor_pack`
--

INSERT INTO `sponsor_pack` (`id`, `pack_name`, `pack_description`, `pack_price`, `pack_status`, `create_at`, `updated_at`, `image_pack`) VALUES
(1, 'Bronze', 'Description of Pack 1 Bronze', 500, 1, '2024-04-25', '2024-04-25', '1714028224_6629fec06f610Bronze-Icon-1-400x403.jpg'),
(6, 'Pack Silver', 'This is description of Silver Pack2', 1500, 0, '2024-04-25', '2024-04-25', '1714028255_6629fedfc61c6pngimg.com - silver_PNG17190.png'),
(19, 'Gold Pack', 'description GOLD pack', 1550, 1, '2024-04-25', '2024-04-27', '1714031322_662a0adadc5ed11881962.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`) VALUES
(1, 'Amine'),
(2, 'Sarra'),
(3, 'arfaoui');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsor_contract`
--
ALTER TABLE `sponsor_contract`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_711766EB12F7FB51` (`sponsor_id`),
  ADD KEY `IDX_711766EB5377BC55` (`sponsor_pack_id`);

--
-- Indexes for table `sponsor_pack`
--
ALTER TABLE `sponsor_pack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sponsor_contract`
--
ALTER TABLE `sponsor_contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sponsor_pack`
--
ALTER TABLE `sponsor_pack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sponsor_contract`
--
ALTER TABLE `sponsor_contract`
  ADD CONSTRAINT `FK_711766EB12F7FB51` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsor` (`id`),
  ADD CONSTRAINT `FK_711766EB5377BC55` FOREIGN KEY (`sponsor_pack_id`) REFERENCES `sponsor_pack` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
