-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2017 at 09:22 AM
-- Server version: 10.0.26-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vccc_sql`
--

-- --------------------------------------------------------

--
-- Table structure for table `cogiaota`
--

CREATE TABLE IF NOT EXISTS `cogiaota` (
  `id` int(11) NOT NULL,
  `cauhoi` text NOT NULL,
  `dapan` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cogiaota`
--

INSERT INTO `cogiaota` (`id`, `cauhoi`, `dapan`) VALUES
(1, 'Vui Vẻ', 'happy'),
(2, 'Ghét', 'hate'),
(3, 'Con Nai', 'deer'),
(4, 'Cái Bàn', 'table'),
(5, 'Xe Máy', 'motorbike'),
(6, 'Con Ruồi', 'fly'),
(7, 'Cái Nhà', 'house'),
(8, 'Con Trâu Nước', 'hippopotamus'),
(9, 'Con Heo', 'pig'),
(10, 'Con Tắc Kè', 'gecko'),
(11, 'Khu Rừng', 'forest'),
(12, 'Tàu Lửa', 'train'),
(13, 'Anh Hùng', 'hero'),
(14, 'Bê Đê', 'gay'),
(15, 'Xe Cần Cẩu', 'cranes'),
(16, 'Bơm Nước', 'water pump'),
(17, 'Con Lật Đật', 'tumbler'),
(18, 'Con Búp Bê', 'doll'),
(19, 'Siêu Nhân', 'superman'),
(20, 'Sếp Lớn', 'big boss'),
(21, 'Xinh Đẹp', 'beautiful'),
(22, 'Xấu Trai', 'ugly'),
(23, 'Chân Dài', 'leggy'),
(24, 'Con Thỏ', 'rabbit'),
(25, 'Khoai To', 'big potatoes'),
(26, 'Con Ngựa', 'horse'),
(27, 'Thương Gia', 'trader'),
(28, 'Hôn Gió', 'knot winds'),
(29, 'Bà Già', 'old woman'),
(30, 'Đàn Bà', 'women'),
(31, 'Máy Bay', 'planes'),
(32, 'Chia Tay', 'farewell'),
(33, 'Hôn', 'kiss'),
(34, 'Cái Mũ', 'hat'),
(35, 'Cái Kính', 'glasses'),
(36, 'Khẩu Trang', 'gauze mask'),
(37, 'Đi Bộ', 'walk'),
(38, 'Chạy Đua', 'race'),
(39, 'Bay Lên', 'fly up'),
(40, 'Trường Tồn', 'long live'),
(41, 'Quản Trị Viên', 'administrators'),
(42, 'Con Điếm', 'whore'),
(43, 'Buôn Bán', 'trade'),
(44, 'Mua Chuộc', 'bribe'),
(45, 'Câu Cá', 'fishing'),
(46, 'Đi Tắm', 'take a shower'),
(47, 'Đại Ca', 'boss'),
(48, 'Xã Hội Đen', 'mafia'),
(49, 'Lừa Tình', 'trick');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cogiaota`
--
ALTER TABLE `cogiaota`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cogiaota`
--
ALTER TABLE `cogiaota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
