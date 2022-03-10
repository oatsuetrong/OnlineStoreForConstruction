-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2022 at 10:04 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osc`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categorieId` int(12) NOT NULL,
  `categorieName` varchar(255) NOT NULL,
  `categorieDesc` text NOT NULL,
  `categorieCreateDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categorieId`, `categorieName`, `categorieDesc`, `categorieCreateDate`) VALUES
(1, 'FLOOR', 'A delight for veggie lovers! Choose from our wide range of delicious vegetarian pizzas, it\'s softer and tastier', '2021-03-17 18:16:28'),
(2, 'PVC', 'Choose your favourite non-veg pizzas from the Domino\'s Pizza menu. Get fresh non-veg pizza with your choice of crusts & toppings', '2021-03-17 18:17:14'),
(3, 'IRON', 'Indulge into mouth-watering taste of Pizza mania range, perfect answer to all your food cravings', '2021-03-17 18:17:43'),
(4, 'PAINT', 'Complement your pizza with wide range of sides available at Domino\'s Pizza India', '2021-03-17 18:19:10'),
(5, 'HARDWARE', 'Complement your pizza with wide range of beverages available at Domino\'s Pizza India', '2021-03-17 21:58:58'),
(6, 'ELECTRIC EQUIPMENT', 'Fresh Pan Pizza Tastiest Pan Pizza. ... Domino\'s freshly made pan-baked pizza; deliciously soft ,buttery,extra cheesy and delightfully crunchy.', '2021-03-18 07:55:28'),
(7, 'WOOD', 'Domino\'s Pizza Introducing all new Burger Pizza with the tag line looks like a burger, tastes like a pizza. Burger Pizza is burger sized but comes in a small pizza box. It is come with pizza toppings such as herbs, vegetables, tomato sauce and mozzarella,', '2021-03-18 08:06:30'),
(8, 'OTHERS', 'CHOICE OF TOPPINGS', '2021-03-18 08:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contactId` int(21) NOT NULL,
  `userId` int(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phoneNo` varchar(10) NOT NULL,
  `orderId` int(21) NOT NULL,
  `message` text NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contactreply`
--

CREATE TABLE `contactreply` (
  `id` int(21) NOT NULL,
  `contactId` int(21) NOT NULL,
  `userId` int(23) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deliverydetails`
--

CREATE TABLE `deliverydetails` (
  `id` int(21) NOT NULL,
  `orderId` int(21) NOT NULL,
  `deliveryBoyName` varchar(35) NOT NULL,
  `deliveryBoyPhoneNo` varchar(10) NOT NULL,
  `deliveryTime` int(200) NOT NULL COMMENT 'Time in minutes',
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `favoriteId` int(11) NOT NULL,
  `shopId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `addedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notificationId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `deliveryId` int(11) DEFAULT NULL,
  `isDone` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1=Done',
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `onsitecart`
--

CREATE TABLE `onsitecart` (
  `cartitemId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productCode` int(11) NOT NULL,
  `itemQuantity` int(100) NOT NULL,
  `shopId` int(11) NOT NULL,
  `shopuserId` int(11) NOT NULL,
  `addedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(21) NOT NULL,
  `orderId` int(21) NOT NULL,
  `productId` int(21) NOT NULL,
  `itemQuantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(21) NOT NULL,
  `userId` int(21) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipCode` int(21) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `phoneNo` varchar(10) NOT NULL,
  `amount` int(200) NOT NULL,
  `paymentMode` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=cash on delivery, \r\n1=online ',
  `deliveryMethod` enum('0','1') NOT NULL COMMENT '0=Shop, 1=System',
  `orderStatus` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0' COMMENT '0=Order Placed.\r\n1=Order Confirmed.\r\n2=Preparing your Order.\r\n3=Your order is on the way!\r\n4=Order Delivered.\r\n5=Order Denied.\r\n6=Order Cancelled.',
  `orderDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(12) NOT NULL,
  `productCode` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productPrice` int(12) NOT NULL,
  `productDesc` text NOT NULL,
  `productCategorieId` int(12) NOT NULL,
  `shopId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `productPubDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productCode`, `productName`, `productPrice`, `productDesc`, `productCategorieId`, `shopId`, `quantity`, `productPubDate`) VALUES
(1, 1, 'ปูนซีเมนต์', 99, '', 1, 1, 2, '2021-03-17 21:03:26'),
(2, 2, 'กระเบื้อง', 199, '', 1, 2, 7, '2021-03-17 21:20:58'),
(3, 3, 'อิฐบล็อก', 149, '', 1, 3, 0, '2021-03-17 21:22:07'),
(4, 4, 'กาวยาแนว', 249, '', 1, 4, 9, '2021-03-17 21:23:05'),
(5, 5, 'ยางมะตอย', 149, '', 1, 5, 1, '2021-03-17 21:23:48'),
(13, 13, 'ท่อ PVC', 199, '', 2, 1, 0, '2021-03-17 21:34:37'),
(14, 14, 'ข้อต่อ', 249, '', 2, 2, 4, '2021-03-17 21:35:31'),
(15, 15, 'ก๊อก', 249, '', 2, 3, 0, '2021-03-17 21:36:36'),
(16, 16, 'เทปพันเกลียว', 399, '', 2, 4, 8, '2021-03-17 21:37:21'),
(17, 17, 'น้ำยาประสานท่อ', 319, '', 2, 1, 0, '2021-03-17 21:38:13'),
(21, 21, 'เหล็กข้ออ้อย', 99, '', 3, 3, 0, '2021-03-17 21:44:44'),
(22, 22, 'เหล็กกล่อง', 149, '', 3, 2, 3, '2021-03-17 21:45:34'),
(23, 23, 'เหล็กกลม', 99, '', 3, 1, 0, '2021-03-17 21:46:21'),
(24, 24, 'เหล็กฉาก', 99, '', 3, 4, 8, '2021-03-17 21:47:07'),
(25, 25, 'เหล็กปลอก', 99, '', 3, 1, 0, '2021-03-17 21:47:51'),
(29, 29, 'สีน้ำ', 99, '', 4, 1, 0, '2021-03-17 22:01:33'),
(30, 30, 'สีน้ำมัน', 99, '', 4, 5, 5, '2021-03-17 22:02:50'),
(31, 31, 'แปรงทาสี', 99, '', 4, 1, 0, '2021-03-17 22:03:44'),
(32, 32, 'สีรองพื้น', 99, '', 4, 4, 9, '2021-03-17 22:05:08'),
(33, 33, 'ลูกกลิ้ง', 35, '', 4, 3, 0, '2021-03-17 22:06:06'),
(38, 38, 'ไขควง', 35, '', 5, 2, 0, '2021-03-17 22:13:38'),
(42, 42, 'สว่าน', 249, '', 6, 3, 8, '2021-03-18 07:57:27'),
(43, 43, 'ตู้เชื่อม', 249, '', 6, 1, 0, '2021-03-18 07:59:52'),
(47, 47, 'ไม้อัด', 129, '', 7, 1, 0, '2021-03-18 08:09:17'),
(50, 50, 'หลังคา', 35, '', 8, 2, 3, '2021-03-18 08:14:52'),
(53, 53, 'ค้อน', 20, '', 5, 1, 0, '2021-03-18 08:20:40'),
(69, 1, 'ปูนซีเมนต์', 999, '\r\n\r\n', 1, 2, 8, '2021-03-17 21:03:26'),
(70, 1, 'ปูนซีเมนต์', 9999, '\r\n\r\n', 1, 3, 9, '2021-03-17 21:03:26'),
(71, 1, 'ปูนซีเมนต์', 999, '\r\n\r\n', 1, 4, 9, '2021-03-17 21:03:26'),
(72, 1, 'ปูนซีเมนต์', 99, '\r\n\r\n', 1, 5, 0, '2021-03-17 21:03:26'),
(73, 99, 'ปูนบัวแดง', 105, ' ', 1, 6, 494, '2022-01-14 12:28:38'),
(76, 119, 'ปูนบัวเขียว', 110, '', 1, 6, 100, '2022-01-14 19:30:57'),
(77, 123, 'ปูนบัวส้ม', 120, '', 1, 6, 1321, '2022-02-21 20:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `shopId` int(11) NOT NULL,
  `shopName` varchar(255) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shopId`, `shopName`, `contact`, `address`, `latitude`, `longitude`, `dateTime`) VALUES
(1, 'Oat Shop', '1234512345', 'Everywhere', 18.786839283360795, 99.00233987232289, '2021-09-12 16:16:49'),
(2, 'Moo Shop', '5432154321', 'Anywhere', NULL, NULL, '2021-09-12 16:17:19'),
(3, 'Poom Shop', '1234567890', 'Somewhere', NULL, NULL, '2021-09-19 18:37:19'),
(4, 'Mild Shop', '0987654321', 'Nowhere', NULL, NULL, '2021-09-19 18:37:55'),
(5, 'oatShop', '0992691615', 'Thailand', NULL, NULL, '2021-12-14 00:28:53'),
(6, 'Moo_shop1', '0846221111', '130/24', 18.7895625, 98.9562907, '2022-01-10 23:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `shopuser`
--

CREATE TABLE `shopuser` (
  `shopuserId` int(11) NOT NULL,
  `shopId` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `userType` enum('1','2') NOT NULL COMMENT '1=owner, \r\n2=employee',
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=pending, 1=approved',
  `email` varchar(255) NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopuser`
--

INSERT INTO `shopuser` (`shopuserId`, `shopId`, `firstname`, `lastname`, `username`, `password`, `userType`, `status`, `email`, `dateTime`) VALUES
(1, 5, 'oat', 'oat', 'oatShop', '$2y$10$3iIEchAS3wBHL4o1qg6QHu.420EiugiflJArbxW9NfoRJb2AwzhSC', '1', '1', 'oatshop@gmail.com', '2021-12-14 00:28:53'),
(37, 5, 'oat', 'oat', 'oatEmp', '$2y$10$KjcmqWabstJXu9mEus7vcOeFMLCPN8Jziog0.hlZ8GU5so1hyH5aW', '2', '1', 'emp@gmail.com', '2021-12-27 22:23:14'),
(38, 6, 'moo1', 'naja', 'MooZ', '$2y$10$ZVuwcvm1fu7qwH42/jO2hOgla1.zP8eHQRuWv.opFiOgIHtkrm/im', '1', '1', 'moo@gmail.com', '2022-01-10 23:51:44'),
(44, 6, 'moo', 'em', 'moo_em', '$2y$10$Rhxt6AZuaF9iPxl5saAIgODC.JIgSg/etAMbzL2.lTiT/Nhy65sZy', '2', '1', 'mooem@gmail.com', '2022-02-21 20:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `sitedetail`
--

CREATE TABLE `sitedetail` (
  `tempId` int(11) NOT NULL,
  `systemName` varchar(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `contact1` bigint(21) NOT NULL,
  `contact2` bigint(21) DEFAULT NULL COMMENT 'Optional',
  `address` text NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sitedetail`
--

INSERT INTO `sitedetail` (`tempId`, `systemName`, `email`, `contact1`, `contact2`, `address`, `dateTime`) VALUES
(1, 'N & N', 'systemname@system.com', 1111111111, 2222222222, 'Chiang Mai, Thailand', '2021-12-15 20:10:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(21) NOT NULL,
  `username` varchar(21) NOT NULL,
  `firstName` varchar(21) NOT NULL,
  `lastName` varchar(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `userType` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=user\r\n1=admin\r\n2=driver',
  `password` varchar(255) NOT NULL,
  `joinDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `phone`, `userType`, `password`, `joinDate`) VALUES
(1, 'admin', 'Admin', 'Admin', 'admin@gmail.com', '1111111111', '1', '$2y$10$AAfxRFOYbl7FdN17rN3fgeiPu/xQrx6MnvRGzqjVHlGqHAM4d9T1i', '2021-04-11 11:40:58'),
(2, 'Oat', 'Nopparuj', 'Suetrong', 'nopparuj_s@cmu.ac.th', '0992691615', '0', '$2y$10$11orNSqGI00pEDnox.rDB.gsd/I7hXCjIw/lwwGDUdRyMjb3n0zqq', '2021-09-05 17:00:58'),
(3, 'Moo', 'Noppawat', 'Kengradomkit', 'noppawat_k@cmu.ac.th', '0846221111', '0', '$2y$10$4oD1uWcAqWk3.olWBVqFVewk8Art2BREaW8Svbu8oPXlkh2yJ5.a.', '2021-09-06 09:22:01'),
(4, 'Poom', 'Poom', 'Somwong', 'poom_somwong@cmu.ac.th', '0907574208', '0', '$2y$10$OXJ5Bs/BNnj6KiSn9m.PF.aozca.NaylYOYNALEEwCKXu59xMO4VC', '2021-09-12 15:55:29'),
(5, 'Cheng', 'Santi', 'Kaeudom', 'santi_k@cmu.ac.th', '0947591934', '0', '$2y$10$UhpY6Y0f0W/iWM1o2QKSoONNw4WSrqeYyaIthXUloJhmm7VOme0Y.', '2021-11-11 11:00:16'),
(7, 'Driver', 'Driver', 'Driver', 'driver@gmail.com', '1111111111', '2', '$2y$10$C4ry6/JEuizT6tiQ6LsJcuvxhBVrAsmDIF8Kym5cEpbQ0yJjhnrAa', '2021-11-25 10:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `viewcart`
--

CREATE TABLE `viewcart` (
  `cartItemId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productCode` int(11) NOT NULL,
  `itemQuantity` int(100) NOT NULL,
  `shopId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `addedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categorieId`);
ALTER TABLE `categories` ADD FULLTEXT KEY `categorieName` (`categorieName`,`categorieDesc`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactId`);

--
-- Indexes for table `contactreply`
--
ALTER TABLE `contactreply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliverydetails`
--
ALTER TABLE `deliverydetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orderId` (`orderId`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`favoriteId`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notificationId`);

--
-- Indexes for table `onsitecart`
--
ALTER TABLE `onsitecart`
  ADD PRIMARY KEY (`cartitemId`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`),
  ADD UNIQUE KEY `productCode` (`productCode`,`shopId`) USING BTREE;
ALTER TABLE `products` ADD FULLTEXT KEY `productName` (`productName`,`productDesc`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shopId`);

--
-- Indexes for table `shopuser`
--
ALTER TABLE `shopuser`
  ADD PRIMARY KEY (`shopuserId`);

--
-- Indexes for table `sitedetail`
--
ALTER TABLE `sitedetail`
  ADD PRIMARY KEY (`tempId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `viewcart`
--
ALTER TABLE `viewcart`
  ADD PRIMARY KEY (`cartItemId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categorieId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contactId` int(21) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactreply`
--
ALTER TABLE `contactreply`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliverydetails`
--
ALTER TABLE `deliverydetails`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `favoriteId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notificationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onsitecart`
--
ALTER TABLE `onsitecart`
  MODIFY `cartitemId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(21) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `shopId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shopuser`
--
ALTER TABLE `shopuser`
  MODIFY `shopuserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `sitedetail`
--
ALTER TABLE `sitedetail`
  MODIFY `tempId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `viewcart`
--
ALTER TABLE `viewcart`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
