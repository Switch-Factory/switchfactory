-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2023 at 03:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `switchfactory`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `quantity`, `product_id`) VALUES
(31, 5, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Linear switch'),
(2, 'Tactile switch'),
(3, 'Clicky switch'),
(4, 'Keyboard KIT'),
(5, 'Lube Tools');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230221152732', '2023-02-21 16:27:39', 80),
('DoctrineMigrations\\Version20230221153021', '2023-02-21 16:30:28', 136),
('DoctrineMigrations\\Version20230222010838', '2023-02-22 02:08:47', 85),
('DoctrineMigrations\\Version20230222022948', '2023-02-22 03:29:53', 71),
('DoctrineMigrations\\Version20230222080232', '2023-02-22 09:02:40', 982),
('DoctrineMigrations\\Version20230222081527', '2023-02-22 09:31:17', 138),
('DoctrineMigrations\\Version20230222083338', '2023-02-22 09:33:41', 250),
('DoctrineMigrations\\Version20230223064933', '2023-02-23 08:11:18', 70),
('DoctrineMigrations\\Version20230223071107', '2023-02-23 08:12:11', 20),
('DoctrineMigrations\\Version20230223072325', '2023-02-23 08:23:38', 47),
('DoctrineMigrations\\Version20230223073357', '2023-02-23 08:34:37', 304),
('DoctrineMigrations\\Version20230223144107', '2023-02-23 15:41:22', 525),
('DoctrineMigrations\\Version20230223144853', '2023-02-23 15:49:01', 86),
('DoctrineMigrations\\Version20230223191021', '2023-02-23 20:10:27', 85),
('DoctrineMigrations\\Version20230224091633', '2023-02-24 10:16:40', 56),
('DoctrineMigrations\\Version20230224101542', '2023-02-24 11:15:49', 178),
('DoctrineMigrations\\Version20230224101707', '2023-02-24 11:17:14', 59),
('DoctrineMigrations\\Version20230224164456', '2023-02-24 17:45:02', 439),
('DoctrineMigrations\\Version20230224203646', '2023-02-24 21:36:53', 57),
('DoctrineMigrations\\Version20230225145104', '2023-02-25 15:51:12', 441);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `total`, `date`) VALUES
(26, 3, 3250000, '2023-02-25'),
(30, 3, 684499, '2023-02-26'),
(31, 3, 1300000, '2023-02-26'),
(89, 3, 0, '2023-02-26'),
(90, 3, 0, '2023-02-26'),
(91, 3, 0, '2023-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `id` int(11) NOT NULL,
  `ord_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`id`, `ord_id`, `product_id`, `quantity`) VALUES
(5, 26, 7, 5),
(6, 30, 7, 1),
(7, 30, 76, 1),
(8, 30, 6, 1),
(9, 31, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `cid_id` int(11) DEFAULT NULL,
  `sup_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `created` date NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `cid_id`, `sup_id`, `name`, `price`, `created`, `image`) VALUES
(2, 1, 4, 'Boba Gum Silent', 11999, '2021-02-11', 'gum-silent-63f8eb369f777.jpg'),
(3, 2, 2, 'Ice Jade', 5999, '2021-02-24', 'ice-jade-63f8eb79bd2de.jpg'),
(5, 3, 6, 'Box Jade', 8999, '2022-05-24', 'box-jade-63f8ec005ea8e.jpg'),
(6, 5, 10, 'Stem Picker', 29999, '2021-02-25', 'lubetools-63f8edc1ebdda.jpg'),
(7, 4, 9, 'MG75', 650000, '2022-07-25', 'mg75-63f8ed314d869.jpg'),
(76, 3, 6, 'Box White', 4500, '2023-02-10', 'box-white-63fa69da8cd08.jpg'),
(77, 3, 6, 'Box Navy', 4500, '2023-02-15', 'box-navy-63fa68fcdf091.jpg'),
(78, 3, 6, 'Box Pink', 4500, '2023-02-09', 'box-pink-63fa696c492ca.jpg'),
(79, 2, 7, 'Juggle', 5600, '2023-02-16', 'leobog-juggle-63fa6ac859f5f.jpg'),
(80, 1, 7, 'Kayking', 6966, '2023-02-16', 'leobog-kayking-63fa6ae8e63ff.jpg'),
(81, 2, 7, 'Ink Crystal', 6999, '2023-02-10', 'ink-crystal-63fa6c865d9f8.jpg'),
(82, 1, 7, 'Nimbus', 6899, '2023-02-17', 'leobog-nimbus-63fa6cb31dde6.jpg'),
(83, 1, 2, 'Bridge Prism', 6800, '2023-02-10', 'JwickBridgePrism-63fa6f7e4b0f4.jpg'),
(84, 1, 2, 'Ginger Milk', 4566, '2023-02-08', 'GingegrMilk-63fa70c280461.jpg'),
(85, 1, 2, 'Pink Jade', 8500, '2023-02-25', 'PinkJade-63fa71514c13e.jpg'),
(86, 1, 1, 'Phalaenopsis', 6999, '2023-02-13', 'Phalaenopsis-63fa71cce2934.jpg'),
(87, 1, 1, 'Lightning', 9666, '2023-02-08', 'Lightning-63fa7240be8fb.jpg'),
(88, 1, 1, 'Matcha', 6900, '2023-02-25', 'Matcha-63fa728ba6d59.jpg'),
(89, 3, 5, 'Jerry', 8900, '2023-02-25', 'otemu-jerry-63fa7381c7ddd.jpg'),
(90, 2, 5, 'Tom', 8500, '2023-02-17', 'otemu-tom-63fa73b9c53fb.jpg'),
(91, 1, 5, 'Emerald', 8900, '2023-02-10', 'outemu-emerald-63fa73fd8ec36.jpg'),
(92, 1, 5, 'Prynne', 4599, '2023-01-31', 'otemu-prynne-63fa74841cf45.jpg'),
(93, 1, 3, 'Rabbit RGB', 14500, '2023-02-28', 'rabbit-rgb-63fa753110aa2.jpg'),
(94, 1, 3, 'TIGER', 42500, '2023-02-25', 'tiger-63fa764481cbe.jpg'),
(95, 1, 3, 'Tiger RGB', 19800, '2023-02-09', 'Tiger-regb-63fa766e75174.jpg'),
(96, 1, 3, 'Titan', 24000, '2023-02-24', 'titan-hearth-63fa76818a47f.jpg'),
(97, 2, 4, 'Boba U4 RGB Silient', 8500, '2023-02-17', 'Rgb-Silent-63fa77265038e.jpg'),
(98, 2, 4, 'U4 Black Silent', 9600, '2023-02-08', 'U4BlackSilent-63fa780b333cf.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`) VALUES
(1, 'KTT'),
(2, 'Jwick'),
(3, 'TTC'),
(4, 'Gazzew'),
(5, 'Otemu'),
(6, 'Kailh'),
(7, 'LeoBog'),
(8, 'James Donkey'),
(9, 'Monsgeek'),
(10, 'VCK');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `address` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `birthday`, `phone`, `address`) VALUES
(3, 'vothuc2k3@gmail.com', '[\"ROLE_USER\"]', '$2y$13$uX.V5tzWxMU1hlY/BkaUhegFo27qDEtmr/RiRpd6snEi7NfFhA.CK', 'PT', '2023-01-29', '0919801159', 'Tan An Ward, Can Tho City'),
(4, 'thucvpgcc210167@fpt.edu.vn', '[\"ROLE_ADMIN\"]', '$2y$13$B2BmAAUhAVyoWpcISggbIe3w.B5SXrlNvJeMib0Qr2qXkZ//LB3TK', 'Phương Thức', '2003-10-15', '0919597615', 'An Khanh Ward'),
(5, 'a@a.a', '[\"ROLE_USER\"]', '$2y$13$CL5oLrbn7v/OmS3Jn/F2x.4JOETAf67sFk92UMVtfzhXtuBnuhc2q', 'atter2', '2023-02-16', '123456789', 'Tra Vinh'),
(6, 'aa@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$NEAy7F.bEM7gX14jv8bIG.E6OU0sEottEV4uZIcHHaYOZTyjb/Vc.', 'aa', '2023-02-13', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BA388B7A76ED395` (`user_id`),
  ADD KEY `IDX_BA388B74584665A` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F5299398A76ED395` (`user_id`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_27A0E7F2E636D3F5` (`ord_id`),
  ADD KEY `IDX_27A0E7F24584665A` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD86C4B51D` (`cid_id`),
  ADD KEY `IDX_D34A04ADFF790DCD` (`sup_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B74584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_BA388B7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `FK_27A0E7F24584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_27A0E7F2E636D3F5` FOREIGN KEY (`ord_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD86C4B51D` FOREIGN KEY (`cid_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_D34A04ADFF790DCD` FOREIGN KEY (`sup_id`) REFERENCES `supplier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
