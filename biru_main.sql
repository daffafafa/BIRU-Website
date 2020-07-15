-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2020 at 07:12 AM
-- Server version: 5.6.36-82.1-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biru_ins`
--

-- --------------------------------------------------------

--
-- Table structure for table `a_id_territory`
--

CREATE TABLE `a_id_territory` (
  `KODE_WILAYAH` varchar(8) NOT NULL,
  `MST_KODE_WILAYAH` varchar(8) NOT NULL,
  `NAMA` varchar(255) NOT NULL,
  `LEVEL` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `daerah`
--

CREATE TABLE `daerah` (
  `no` int(5) NOT NULL,
  `kecamatan` varchar(70) NOT NULL,
  `kab` varchar(70) NOT NULL,
  `prop` varchar(70) NOT NULL,
  `pos` varchar(20) NOT NULL,
  `zonasi` int(1) NOT NULL,
  `kode_wilayah` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daerah`
--

INSERT INTO `daerah` (`no`, `kecamatan`, `kab`, `prop`, `pos`, `zonasi`, `kode_wilayah`) VALUES
(92, 'Cakung', 'Jakarta Timur', 'DKI Jakarta', '13910 - 13960', 2, '31.75.06'),
(93, 'Cempaka Putih', 'Jakarta Pusat', 'DKI Jakarta', '10510 - 10570', 3, '31.71.05'),
(94, 'Cengkareng', 'Jakarta Barat', 'DKI Jakarta', '11710 - 11750', 2, '31.73.01'),
(95, 'Cilandak', 'Jakarta Selatan', 'DKI Jakarta', '12410 - 12450', 1, '31.74.06'),
(96, 'Cilincing', 'Jakarta Utara', 'DKI Jakarta', '14110 - 14150', 5, '31.72.04'),
(97, 'Cipayung', 'Jakarta Timur', 'DKI Jakarta', '13840 - 13890', 2, '32.76.07'),
(98, 'Ciracas', 'Jakarta Timur', 'DKI Jakarta', '13720 - 13830', 2, '31.75.09'),
(99, 'Duren Sawit', 'Jakarta Timur', 'DKI Jakarta', '13430 - 13470', 2, '31.75.07'),
(100, 'Gambir', 'Jakarta Pusat', 'DKI Jakarta', '10110 - 10160', 3, '31.71.01'),
(101, 'Grogol Petamburan', 'Jakarta Barat', 'DKI Jakarta', '11440 - 11470', 2, '31.73.02'),
(102, 'Jagakarsa', 'Jakarta Selatan', 'DKI Jakarta', '12530 - 12640', 1, '31.74.09'),
(103, 'Jatinegara', 'Jakarta Timur', 'DKI Jakarta', '13310 - 13420', 2, '31.75.03'),
(104, 'Johar Baru', 'Jakarta Pusat', 'DKI Jakarta', '10530 - 10560', 3, '31.71.08'),
(105, 'Kalideres', 'Jakarta Barat', 'DKI Jakarta', '11810 - 11850', 2, '31.73.06'),
(106, 'Kebayoran Baru', 'Jakarta Selatan', 'DKI Jakarta', '12110 - 12190', 1, '31.74.07'),
(107, 'Kebayoran Lama', 'Jakarta Selatan', 'DKI Jakarta', '12210 - 12310', 1, '31.74.05'),
(108, 'Kebon Jeruk', 'Jakarta Barat', 'DKI Jakarta', '11510 - 11560', 2, '31.73.05'),
(109, 'Kelapa Gading', 'Jakarta Utara', 'DKI Jakarta', '14240 - 14250', 5, '31.72.06'),
(110, 'Kemayoran', 'Jakarta Pusat', 'DKI Jakarta', '10610 - 10650', 3, '31.71.03'),
(111, 'Kembangan', 'Jakarta Barat', 'DKI Jakarta', '11610 - 11650', 2, '31.73.08'),
(112, 'Kepulauan Seribu Selatan', 'Kepulauan Seribu', 'DKI Jakarta', '14510 - 14520', 4, '31.01.02'),
(113, 'Kepulauan Seribu Utara', 'Kepulauan Seribu', 'DKI Jakarta', '14530 - 14540', 4, '31.01.01'),
(114, 'Koja', 'Jakarta Utara', 'DKI Jakarta', '14210 - 14270', 5, '31.72.03'),
(115, 'Kramatjati (Kramat Jati)', 'Jakarta Timur', 'DKI Jakarta', '13510 - 13640', 2, '31.75.04'),
(116, 'Makasar', 'Jakarta Timur', 'DKI Jakarta', '13560 - 13650', 2, '31.75.08'),
(117, 'Mampang Prapatan', 'Jakarta Selatan', 'DKI Jakarta', '12710 - 12790', 1, '31.74.03'),
(118, 'Matraman', 'Jakarta Timur', 'DKI Jakarta', '13110 - 13150', 2, '31.75.01'),
(119, 'Menteng', 'Jakarta Pusat', 'DKI Jakarta', '10310 - 10350', 3, '31.71.06'),
(120, 'Pademangan', 'Jakarta Utara', 'DKI Jakarta', '14410 - 14430', 5, '31.72.05'),
(121, 'Pal Merah (Palmerah)', 'Jakarta Barat', 'DKI Jakarta', '11410 - 11480', 2, '31.73.07'),
(122, 'Pancoran', 'Jakarta Selatan', 'DKI Jakarta', '12740 - 12780', 1, '31.74.08'),
(123, 'Pasar Minggu', 'Jakarta Selatan', 'DKI Jakarta', '12510 - 12560', 1, '31.74.04'),
(124, 'Pasar Rebo', 'Jakarta Timur', 'DKI Jakarta', '13710 - 13790', 2, '31.75.05'),
(125, 'Penjaringan', 'Jakarta Utara', 'DKI Jakarta', '14440 - 14470', 5, '31.72.01'),
(126, 'Pesanggrahan', 'Jakarta Selatan', 'DKI Jakarta', '12250 - 12330', 1, '31.74.10'),
(127, 'Pulogadung (Pulo Gadung)', 'Jakarta Timur', 'DKI Jakarta', '13210 - 13260', 2, '31.75.02'),
(128, 'Sawah Besar', 'Jakarta Pusat', 'DKI Jakarta', '10710 - 10750', 3, '31.71.02'),
(129, 'Senen', 'Jakarta Pusat', 'DKI Jakarta', '10410 - 10460', 3, '31.71.04'),
(130, 'Setiabudi (Setia Budi)', 'Jakarta Selatan', 'DKI Jakarta', '12910 - 12980', 1, '31.74.02'),
(131, 'Taman Sari', 'Jakarta Barat', 'DKI Jakarta', '11110 - 11180', 2, '31.73.03'),
(132, 'Tambora', 'Jakarta Barat', 'DKI Jakarta', '11210 - 11330', 2, '31.73.04'),
(133, 'Tanah Abang', 'Jakarta Pusat', 'DKI Jakarta', '10210 - 10270', 3, '31.71.07'),
(134, 'Tanjung Priok', 'Jakarta Utara', 'DKI Jakarta', '14360 - 14370', 5, '31.72.02'),
(135, 'Tebet', 'Jakarta Selatan', 'DKI Jakarta', '12810 - 12870', 1, '31.74.01'),
(137, 'Agrabinta', 'Cianjur', 'Jawa Barat', '43276', 2, '32.03.22'),
(138, 'Andir', 'Bandung', 'Jawa Barat', '40181 - 40184', 3, '32.73.05'),
(139, 'Anjatan', 'Indramayu', 'Jawa Barat', '45256', 2, '32.12.23'),
(140, 'Antapani (Cicadas)', 'Bandung', 'Jawa Barat', '40291', 3, '32.73.20'),
(141, 'Arahan', 'Indramayu', 'Jawa Barat', '45267', 2, '32.12.19'),
(142, 'Arcamanik', 'Bandung', 'Jawa Barat', '40293 - 40294', 3, '32.73.24'),
(143, 'Argapura', 'Majalengka', 'Jawa Barat', '45462', 2, '32.10.05'),
(144, 'Arjasari', 'Bandung', 'Jawa Barat', '40379', 3, '32.04.16'),
(145, 'Arjawinangun', 'Cirebon', 'Jawa Barat', '45162', 2, '32.09.24'),
(146, 'Astana Anyar', 'Bandung', 'Jawa Barat', '40241 - 40243', 3, '32.73.10'),
(147, 'Astanajapura', 'Cirebon', 'Jawa Barat', '45181', 2, '32.09.10'),
(148, 'Babakan', 'Cirebon', 'Jawa Barat', '45191', 2, '32.09.05'),
(149, 'Babakan Ciparay', 'Bandung', 'Jawa Barat', '40221 - 40227', 3, '32.73.03'),
(150, 'Babakan Madang', 'Bogor', 'Jawa Barat', '16810', 2, '32.01.05'),
(151, 'Babakancikao', 'Purwakarta', 'Jawa Barat', '41151', 2, '32.14.12'),
(152, 'Babelan', 'Bekasi', 'Jawa Barat', '17610', 2, '32.16.02'),
(153, 'Baleendah', 'Bandung', 'Jawa Barat', '40258 - 40375', 3, '32.04.32'),
(154, 'Balongan', 'Indramayu', 'Jawa Barat', '45217 - 45285', 2, '32.12.14'),
(155, 'Bandung Kidul', 'Bandung', 'Jawa Barat', '40256 - 40287', 3, '32.73.21'),
(156, 'Bandung Kulon', 'Bandung', 'Jawa Barat', '40211 - 40215', 3, '32.73.15'),
(157, 'Bandung Wetan', 'Bandung', 'Jawa Barat', '40114 - 40116', 3, '32.73.09'),
(158, 'Bangodua', 'Indramayu', 'Jawa Barat', '45272', 2, '32.12.06'),
(159, 'Banjar', 'Banjar', 'Jawa Barat', '46311 - 46321', 2, '32.79.01'),
(160, 'Banjaran', 'Bandung', 'Jawa Barat', '40377', 3, '32.10.22'),
(161, 'Banjaran', 'Majalengka', 'Jawa Barat', '45468', 2, '32.10.22'),
(162, 'Banjaranyar', 'Ciamis', 'Jawa Barat', '46384', 5, '32.07.37'),
(163, 'Banjarsari', 'Ciamis', 'Jawa Barat', '46383', 5, '32.07.18'),
(164, 'Banjarwangi', 'Garut', 'Jawa Barat', '44172', 4, '32.05.23'),
(165, 'Bantargadung', 'Sukabumi', 'Jawa Barat', '43363', 2, '32.02.04'),
(166, 'Bantargebang (Bantar Gebang)', 'Bekasi', 'Jawa Barat', '17151 - 17154', 2, '32.75.07'),
(167, 'Bantarkalong', 'Tasikmalaya', 'Jawa Barat', '46168 - 46188', 2, '32.06.08'),
(168, 'Bantarujeg', 'Majalengka', 'Jawa Barat', '45464', 2, '32.10.02'),
(169, 'Banyuresmi', 'Garut', 'Jawa Barat', '44191', 4, '32.05.06'),
(170, 'Banyusari', 'Karawang', 'Jawa Barat', '41374', 2, '32.15.24'),
(171, 'Baregbeg', 'Ciamis', 'Jawa Barat', '46274', 5, '32.07.32'),
(172, 'Baros', 'Sukabumi', 'Jawa Barat', '43161 - 43166', 2, '32.72.05'),
(173, 'Batujajar', 'Bandung Barat', 'Jawa Barat', '40561', 2, '32.17.09'),
(174, 'Batujaya', 'Karawang', 'Jawa Barat', '41354', 2, '32.15.08'),
(175, 'Batununggal', 'Bandung', 'Jawa Barat', '40271 - 40275', 3, '32.73.12'),
(176, 'Bayongbong', 'Garut', 'Jawa Barat', '44162', 4, '32.05.17'),
(177, 'Beber', 'Cirebon', 'Jawa Barat', '45172', 2, '32.09.13'),
(178, 'Beji', 'Depok', 'Jawa Barat', '16421 - 16426', 1, '32.76.06'),
(179, 'Bekasi Barat', 'Bekasi', 'Jawa Barat', '17133 - 17145', 2, '32.75.02'),
(180, 'Bekasi Selatan', 'Bekasi', 'Jawa Barat', '17141 - 17148', 2, '32.75.04'),
(181, 'Bekasi Timur', 'Bekasi', 'Jawa Barat', '17111 - 17113', 2, '32.75.01'),
(182, 'Bekasi Utara', 'Bekasi', 'Jawa Barat', '17121 - 17142', 2, '32.75.03'),
(183, 'Binong', 'Subang', 'Jawa Barat', '41253', 2, '32.13.08'),
(184, 'Blanakan', 'Subang', 'Jawa Barat', '41259', 2, '32.13.13'),
(185, 'Blubur Limbangan', 'Garut', 'Jawa Barat', '44186', 4, '32.05.38'),
(186, 'Bogor Barat', 'Bogor', 'Jawa Barat', '16111 - 16119', 2, '32.71.04'),
(187, 'Bogor Selatan', 'Bogor', 'Jawa Barat', '16131 - 16139', 2, '32.71.01'),
(188, 'Bogor Tengah', 'Bogor', 'Jawa Barat', '16121 - 16129', 2, '32.71.03'),
(189, 'Bogor Timur', 'Bogor', 'Jawa Barat', '16141 - 16146', 2, '32.71.02'),
(190, 'Bogor Utara', 'Bogor', 'Jawa Barat', '16151 - 16158', 2, '32.71.05'),
(191, 'Bojong', 'Purwakarta', 'Jawa Barat', '41164', 2, '32.14.11'),
(192, 'Bojong Gede (Bojonggede)', 'Bogor', 'Jawa Barat', '16920 - 16923', 2, '32.01.13'),
(193, 'Bojongasih', 'Tasikmalaya', 'Jawa Barat', '46475', 2, '32.06.09'),
(194, 'Bojonggambir', 'Tasikmalaya', 'Jawa Barat', '46476', 2, '32.06.11'),
(195, 'Bojonggenteng (Bojong Genteng)', 'Sukabumi', 'Jawa Barat', '43353', 2, '32.02.14'),
(196, 'Bojongloa Kaler', 'Bandung', 'Jawa Barat', '40231 - 40233', 3, '32.73.04'),
(197, 'Bojongloa Kidul', 'Bandung', 'Jawa Barat', '40234 - 40239', 3, '32.73.17'),
(198, 'Bojongmangu', 'Bekasi', 'Jawa Barat', '17350 - 17356', 2, '32.16.23'),
(199, 'Bojongpicung', 'Cianjur', 'Jawa Barat', '43283', 2, '32.03.06'),
(200, 'Bojongsari', 'Depok', 'Jawa Barat', '16516 - 16518', 1, '32.76.11'),
(201, 'Bojongsoang', 'Bandung', 'Jawa Barat', '40287 - 40288', 3, '32.04.08'),
(202, 'Bongas', 'Indramayu', 'Jawa Barat', '45255', 2, '32.12.22'),
(203, 'Buahbatu (Margacinta)', 'Bandung', 'Jawa Barat', '40286 - 40287', 3, '32.73.22'),
(204, 'Buahdua', 'Sumedang', 'Jawa Barat', '45392', 2, '32.11.10'),
(205, 'Bungbulang', 'Garut', 'Jawa Barat', '44165', 4, '32.05.31'),
(206, 'Bungursari', 'Purwakarta', 'Jawa Barat', '41181', 2, '32.78.09'),
(207, 'Bungursari', 'Tasikmalaya', 'Jawa Barat', '46151', 2, '32.78.09'),
(208, 'Cabangbungin', 'Bekasi', 'Jawa Barat', '17720', 2, '32.16.16'),
(209, 'Campaka', 'Cianjur', 'Jawa Barat', '43263', 2, '32.14.02'),
(210, 'Campaka', 'Purwakarta', 'Jawa Barat', '41180', 2, '32.14.02'),
(211, 'Campakamulya (Campaka Mulya)', 'Cianjur', 'Jawa Barat', '43269', 2, '32.03.25'),
(212, 'Cangkuang', 'Bandung', 'Jawa Barat', '40238', 3, '32.04.44'),
(213, 'Cantigi', 'Indramayu', 'Jawa Barat', '45253 - 45258', 2, '32.12.17'),
(214, 'Caringin', 'Bogor', 'Jawa Barat', '16730', 2, '32.02.31'),
(215, 'Caringin', 'Garut', 'Jawa Barat', '44166', 4, '32.02.31'),
(216, 'Caringin', 'Sukabumi', 'Jawa Barat', '43154', 2, '32.02.31'),
(217, 'Cariu', 'Bogor', 'Jawa Barat', '16840', 2, '32.01.08'),
(218, 'Ciambar', 'Sukabumi', 'Jawa Barat', '43356', 2, '32.02.47'),
(219, 'Ciamis', 'Ciamis', 'Jawa Barat', '46211 - 46219', 5, '32.07.01'),
(220, 'Ciampea', 'Bogor', 'Jawa Barat', '16620', 2, '32.01.15'),
(221, 'Ciampel', 'Karawang', 'Jawa Barat', '41363', 2, '32.15.04'),
(222, 'Cianjur', 'Cianjur', 'Jawa Barat', '43215 - 43216', 2, '32.03.01'),
(223, 'Ciasem', 'Subang', 'Jawa Barat', '41256', 2, '32.13.09'),
(224, 'Ciater', 'Subang', 'Jawa Barat', '41280', 2, '32.13.29'),
(225, 'Ciawi', 'Bogor', 'Jawa Barat', '16720', 2, '32.06.36'),
(226, 'Ciawi', 'Tasikmalaya', 'Jawa Barat', '46156', 2, '32.06.36'),
(227, 'Ciawigebang', 'Kuningan', 'Jawa Barat', '45591 - 45593', 2, '32.08.10'),
(228, 'Cibadak', 'Sukabumi', 'Jawa Barat', '43351', 2, '32.02.11'),
(229, 'Cibalong', 'Garut', 'Jawa Barat', '44176', 4, '32.06.06'),
(230, 'Cibalong', 'Tasikmalaya', 'Jawa Barat', '46185', 2, '32.06.06'),
(231, 'Cibarusah', 'Bekasi', 'Jawa Barat', '17340', 2, '32.16.22'),
(232, 'Cibatu', 'Garut', 'Jawa Barat', '44185', 4, '32.14.14'),
(233, 'Cibatu', 'Purwakarta', 'Jawa Barat', '41182', 2, '32.14.14'),
(234, 'Cibeber', 'Cianjur', 'Jawa Barat', '43262', 2, '32.03.03'),
(235, 'Cibeunying Kaler', 'Bandung', 'Jawa Barat', '40122 - 40191', 3, '32.73.18'),
(236, 'Cibeunying Kidul', 'Bandung', 'Jawa Barat', '40121 - 40192', 3, '32.73.14'),
(237, 'Cibeureum', 'Kuningan', 'Jawa Barat', '45588', 2, '32.78.06'),
(238, 'Cibeureum', 'Sukabumi', 'Jawa Barat', '43142 - 43165', 2, '32.78.06'),
(239, 'Cibeureum', 'Tasikmalaya', 'Jawa Barat', '46196 - 46416', 2, '32.78.06'),
(240, 'Cibingbin', 'Kuningan', 'Jawa Barat', '45587', 2, '32.08.05'),
(241, 'Cibinong', 'Bogor', 'Jawa Barat', '16911 - 16918', 2, '32.03.20'),
(242, 'Cibinong', 'Cianjur', 'Jawa Barat', '43271', 2, '32.03.20'),
(243, 'Cibiru', 'Bandung', 'Jawa Barat', '40614 - 40615', 3, '32.73.25'),
(244, 'Cibitung', 'Bekasi', 'Jawa Barat', '17520', 2, '32.02.25'),
(245, 'Cibitung', 'Sukabumi', 'Jawa Barat', '43172', 2, '32.02.25'),
(246, 'Cibiuk', 'Garut', 'Jawa Barat', '44193', 4, '32.05.40'),
(247, 'Cibogo', 'Subang', 'Jawa Barat', '41285', 2, '32.13.17'),
(248, 'Cibuaya', 'Karawang', 'Jawa Barat', '41356', 2, '32.15.11'),
(249, 'Cibugel', 'Sumedang', 'Jawa Barat', '45375', 2, '32.11.04'),
(250, 'Cibungbulang', 'Bogor', 'Jawa Barat', '16630', 2, '32.01.16'),
(251, 'Cicalengka', 'Bandung', 'Jawa Barat', '40395', 3, '32.04.25'),
(252, 'Cicantayan', 'Sukabumi', 'Jawa Barat', '43155', 2, '32.02.28'),
(253, 'Cicendo', 'Bandung', 'Jawa Barat', '40171 - 40175', 3, '32.73.06'),
(254, 'Cicurug', 'Sukabumi', 'Jawa Barat', '43359', 2, '32.02.16'),
(255, 'Cidadap', 'Bandung', 'Jawa Barat', '40141 - 40143', 3, '32.02.44'),
(256, 'Cidadap', 'Sukabumi', 'Jawa Barat', '43183', 2, '32.02.44'),
(257, 'Cidahu', 'Kuningan', 'Jawa Barat', '45595', 2, '32.02.17'),
(258, 'Cidahu', 'Sukabumi', 'Jawa Barat', '43358', 2, '32.02.17'),
(259, 'Cidaun', 'Cianjur', 'Jawa Barat', '43275', 2, '32.03.23'),
(260, 'Cidolog', 'Ciamis', 'Jawa Barat', '46352', 5, '32.02.43'),
(261, 'Cidolog', 'Sukabumi', 'Jawa Barat', '43184', 2, '32.02.43'),
(262, 'Ciemas', 'Sukabumi', 'Jawa Barat', '43177', 2, '32.02.22'),
(263, 'Cigalontang', 'Tasikmalaya', 'Jawa Barat', '46463', 2, '32.06.27'),
(264, 'Cigandamekar', 'Kuningan', 'Jawa Barat', '45556', 2, '32.08.32'),
(265, 'Cigasong', 'Majalengka', 'Jawa Barat', '45476', 2, '32.10.20'),
(266, 'Cigedug', 'Garut', 'Jawa Barat', '44116', 4, '32.05.18'),
(267, 'Cigombong', 'Bogor', 'Jawa Barat', '16110', 2, '32.01.38'),
(268, 'Cigudeg', 'Bogor', 'Jawa Barat', '16660', 2, '32.01.22'),
(269, 'Cigugur', 'Pangandaran', 'Jawa Barat', '46392', 2, '32.08.18'),
(270, 'Cigugur', 'Kuningan', 'Jawa Barat', '45552', 2, '32.08.18'),
(271, 'Cihampelas', 'Bandung Barat', 'Jawa Barat', '40562', 2, '32.17.10'),
(272, 'Cihaurbeuti', 'Ciamis', 'Jawa Barat', '46262', 5, '32.07.06'),
(273, 'Cihideung', 'Tasikmalaya', 'Jawa Barat', '46121 - 46126', 2, '32.78.01'),
(274, 'Cihurip', 'Garut', 'Jawa Barat', '44173', 4, '32.05.25'),
(275, 'Cijambe', 'Subang', 'Jawa Barat', '41286', 2, '32.13.19'),
(276, 'Cijati', 'Cianjur', 'Jawa Barat', '43284', 2, '32.03.29'),
(277, 'Cijeruk', 'Bogor', 'Jawa Barat', '16740', 2, '32.01.28'),
(278, 'Cijeungjing', 'Ciamis', 'Jawa Barat', '46271', 5, '32.07.03'),
(279, 'Cijulang', 'Pangandaran', 'Jawa Barat', '46394', 2, '32.18.02'),
(280, 'Cikadu', 'Cianjur', 'Jawa Barat', '43286', 2, '32.03.26'),
(281, 'Cikajang', 'Garut', 'Jawa Barat', '44171', 4, '32.05.22'),
(282, 'Cikakak', 'Sukabumi', 'Jawa Barat', '43365', 2, '32.02.03'),
(283, 'Cikalong', 'Tasikmalaya', 'Jawa Barat', '46195', 2, '32.06.03'),
(284, 'Cikalongkulon', 'Cianjur', 'Jawa Barat', '43291', 2, '32.03.12'),
(285, 'Cikalongwetan (Cikalong Wetan)', 'Bandung Barat', 'Jawa Barat', '40556', 2, '32.17.04'),
(286, 'Cikampek', 'Karawang', 'Jawa Barat', '41373', 2, '32.15.13'),
(287, 'Cikancung', 'Bandung', 'Jawa Barat', '40396', 3, '32.04.27'),
(288, 'Cikarang Barat', 'Bekasi', 'Jawa Barat', '17530', 2, '32.16.08'),
(289, 'Cikarang Pusat', 'Bekasi', 'Jawa Barat', '17531', 2, '32.16.20'),
(290, 'Cikarang Selatan', 'Bekasi', 'Jawa Barat', '17532', 2, '32.16.19'),
(291, 'Cikarang Timur', 'Bekasi', 'Jawa Barat', '17533', 2, '32.16.11'),
(292, 'Cikarang Utara', 'Bekasi', 'Jawa Barat', '17534', 2, '32.16.09'),
(293, 'Cikatomas', 'Tasikmalaya', 'Jawa Barat', '46193', 2, '32.06.05'),
(294, 'Cikaum', 'Subang', 'Jawa Barat', '41266', 2, '32.13.22'),
(295, 'Cikedung', 'Indramayu', 'Jawa Barat', '45262', 2, '32.12.04'),
(296, 'Cikelet', 'Garut', 'Jawa Barat', '44177', 4, '32.05.30'),
(297, 'Cikembar', 'Sukabumi', 'Jawa Barat', '43157', 2, '32.02.10'),
(298, 'Cikidang', 'Sukabumi', 'Jawa Barat', '43367', 2, '32.02.06'),
(299, 'Cikijing', 'Majalengka', 'Jawa Barat', '45466', 2, '32.10.03'),
(300, 'Cikole', 'Sukabumi', 'Jawa Barat', '43111 - 43116', 2, '32.72.02'),
(301, 'Cikoneng', 'Ciamis', 'Jawa Barat', '46261', 5, '32.07.02'),
(302, 'Cilaku', 'Cianjur', 'Jawa Barat', '43285', 2, '32.03.04'),
(303, 'Cilamaya Kulon', 'Karawang', 'Jawa Barat', '41384', 2, '32.15.23'),
(304, 'Cilamaya Wetan', 'Karawang', 'Jawa Barat', '41386', 2, '32.15.15'),
(305, 'Cilawu', 'Garut', 'Jawa Barat', '44181', 4, '32.05.19'),
(306, 'Cilebak', 'Kuningan', 'Jawa Barat', '45585', 2, '32.08.25'),
(307, 'Cilebar', 'Karawang', 'Jawa Barat', '41350', 2, '32.15.30'),
(308, 'Ciledug', 'Cirebon', 'Jawa Barat', '45188', 2, '32.09.02'),
(309, 'Cilengkrang', 'Bandung', 'Jawa Barat', '40615 - 40619', 3, '32.04.07'),
(310, 'Cileungsi', 'Bogor', 'Jawa Barat', '16820', 2, '32.01.07'),
(311, 'Cileunyi', 'Bandung', 'Jawa Barat', '40621 - 40626', 3, '32.04.05'),
(312, 'Cililin', 'Bandung Barat', 'Jawa Barat', '40567', 2, '32.17.11'),
(313, 'Cilimus', 'Kuningan', 'Jawa Barat', '45551', 2, '32.08.13'),
(314, 'Cilodong', 'Depok', 'Jawa Barat', '16413 - 16415', 1, '32.76.08'),
(315, 'Cimahi', 'Kuningan', 'Jawa Barat', '45582', 2, '32.08.24'),
(316, 'Cimahi Selatan', 'Cimahi', 'Jawa Barat', '40531 - 40535', 2, '32.77.01'),
(317, 'Cimahi Tengah', 'Cimahi', 'Jawa Barat', '40521 - 40526', 2, '32.77.02'),
(318, 'Cimahi Utara', 'Cimahi', 'Jawa Barat', '40511 - 40514', 2, '32.77.03'),
(319, 'Cimalaka', 'Sumedang', 'Jawa Barat', '45353', 2, '32.11.22'),
(320, 'Cimanggis', 'Depok', 'Jawa Barat', '16451 - 16454', 1, '32.76.02'),
(321, 'Cimanggu', 'Sukabumi', 'Jawa Barat', '43178', 2, '32.02.46'),
(322, 'Cimanggung', 'Sumedang', 'Jawa Barat', '45364', 2, '32.11.14'),
(323, 'Cimaragas', 'Ciamis', 'Jawa Barat', '46381', 5, '32.07.29'),
(324, 'Cimaung', 'Bandung', 'Jawa Barat', '40374 - 40375', 3, '32.04.17'),
(325, 'Cimenyan (Cimeunyan)', 'Bandung', 'Jawa Barat', '40191 - 40198', 3, '32.04.06'),
(326, 'Cimerak', 'Pangandaran', 'Jawa Barat', '46395', 2, '32.18.03'),
(327, 'Cinambo', 'Bandung', 'Jawa Barat', '40296', 3, '32.73.29'),
(328, 'Cineam', 'Tasikmalaya', 'Jawa Barat', '46198', 2, '32.06.20'),
(329, 'Cinere', 'Depok', 'Jawa Barat', '16512 - 16514', 1, '32.76.09'),
(330, 'Cingambul', 'Majalengka', 'Jawa Barat', '45467', 2, '32.10.23'),
(331, 'Ciniru', 'Kuningan', 'Jawa Barat', '45565', 2, '32.08.02'),
(332, 'Ciomas', 'Bogor', 'Jawa Barat', '16610', 2, '32.01.29'),
(333, 'Cipaku', 'Ciamis', 'Jawa Barat', '46252', 5, '32.07.11'),
(334, 'Cipanas', 'Cianjur', 'Jawa Barat', '43253', 2, '32.03.28'),
(335, 'Ciparay', 'Bandung', 'Jawa Barat', '40381', 3, '32.04.29'),
(336, 'Cipatat', 'Bandung Barat', 'Jawa Barat', '40554', 2, '32.17.07'),
(337, 'Cipatujah', 'Tasikmalaya', 'Jawa Barat', '46187', 2, '32.06.01'),
(338, 'Cipayung', 'Depok', 'Jawa Barat', '16436 - 16439', 1, '32.76.07'),
(339, 'Cipedes', 'Tasikmalaya', 'Jawa Barat', '46131 - 46134', 2, '32.78.02'),
(340, 'Cipeundeuy', 'Bandung Barat', 'Jawa Barat', '40558', 2, '32.13.20'),
(341, 'Cipeundeuy', 'Subang', 'Jawa Barat', '41272', 2, '32.13.20'),
(342, 'Cipicung', 'Kuningan', 'Jawa Barat', '45576 - 45592', 2, '32.08.21'),
(343, 'Cipongkor', 'Bandung Barat', 'Jawa Barat', '40564', 2, '32.17.12'),
(344, 'Cipunagara', 'Subang', 'Jawa Barat', '41257', 2, '32.13.18'),
(345, 'Ciracap', 'Sukabumi', 'Jawa Barat', '43176', 2, '32.02.26'),
(346, 'Ciranjang', 'Cianjur', 'Jawa Barat', '43282', 2, '32.03.05'),
(347, 'Cireunghas', 'Sukabumi', 'Jawa Barat', '43193', 2, '32.02.35'),
(348, 'Cisaat', 'Sukabumi', 'Jawa Barat', '43132 - 43152', 2, '32.02.29'),
(349, 'Cisaga', 'Ciamis', 'Jawa Barat', '46386', 5, '32.07.30'),
(350, 'Cisalak', 'Subang', 'Jawa Barat', '41283', 2, '32.13.02'),
(351, 'Cisarua', 'Bandung Barat', 'Jawa Barat', '40551', 2, '32.11.23'),
(352, 'Cisarua', 'Bogor', 'Jawa Barat', '16750', 2, '32.11.23'),
(353, 'Cisarua', 'Sumedang', 'Jawa Barat', '45355', 2, '32.11.23'),
(354, 'Cisayong', 'Tasikmalaya', 'Jawa Barat', '46153', 2, '32.06.32'),
(355, 'Ciseeng', 'Bogor', 'Jawa Barat', '16120', 2, '32.01.33'),
(356, 'Cisewu', 'Garut', 'Jawa Barat', '44169', 4, '32.05.35'),
(357, 'Cisitu', 'Sumedang', 'Jawa Barat', '45363', 2, '32.11.05'),
(358, 'Cisolok', 'Sukabumi', 'Jawa Barat', '43366', 2, '32.02.05'),
(359, 'Cisompet', 'Garut', 'Jawa Barat', '44174', 4, '32.05.28'),
(360, 'Cisurupan', 'Garut', 'Jawa Barat', '44163', 4, '32.05.20'),
(361, 'Citamiang', 'Sukabumi', 'Jawa Barat', '43141 - 43145', 2, '32.72.03'),
(362, 'Citeureup', 'Bogor', 'Jawa Barat', '16811', 2, '32.01.03'),
(363, 'Ciwaringin', 'Cirebon', 'Jawa Barat', '45167', 2, '32.09.26'),
(364, 'Ciwaru', 'Kuningan', 'Jawa Barat', '45583', 2, '32.08.04'),
(365, 'Ciwidey', 'Bandung', 'Jawa Barat', '40973', 3, '32.04.39'),
(366, 'Coblong', 'Bandung', 'Jawa Barat', '40131 - 40135', 3, '32.73.02'),
(367, 'Compreng', 'Subang', 'Jawa Barat', '41258', 2, '32.13.15'),
(368, 'Conggeang', 'Sumedang', 'Jawa Barat', '45391', 2, '32.11.07'),
(369, 'Cugenang', 'Cianjur', 'Jawa Barat', '43252', 2, '32.03.11'),
(370, 'Culamega', 'Tasikmalaya', 'Jawa Barat', '46188', 2, '32.06.10'),
(371, 'Curugkembar', 'Sukabumi', 'Jawa Barat', '43182', 2, '32.02.42'),
(372, 'Darangdan', 'Purwakarta', 'Jawa Barat', '41163', 2, '32.14.06'),
(373, 'Darma', 'Kuningan', 'Jawa Barat', '45562', 2, '32.08.17'),
(374, 'Darmaraja', 'Sumedang', 'Jawa Barat', '45372', 2, '32.11.03'),
(375, 'Dawuan', 'Majalengka', 'Jawa Barat', '45453', 2, '32.13.27'),
(376, 'Dawuan', 'Subang', 'Jawa Barat', '41270', 2, '32.13.27'),
(377, 'Dayeuhkolot', 'Bandung', 'Jawa Barat', '40238 - 40267', 3, '32.04.12'),
(378, 'Depok', 'Cirebon', 'Jawa Barat', '45155', 2, '32.09.31'),
(379, 'Dramaga', 'Bogor', 'Jawa Barat', '16680', 2, '32.01.30'),
(380, 'Dukupuntang', 'Cirebon', 'Jawa Barat', '45652', 2, '32.09.16'),
(381, 'Gabuswetan', 'Indramayu', 'Jawa Barat', '45263', 2, '32.12.03'),
(382, 'Ganeas', 'Sumedang', 'Jawa Barat', '45356', 2, '32.11.19'),
(383, 'Gantar', 'Indramayu', 'Jawa Barat', '45264', 2, '32.12.25'),
(384, 'Garawangi', 'Kuningan', 'Jawa Barat', '45571 - 45572', 2, '32.08.08'),
(385, 'Garut Kota', 'Garut', 'Jawa Barat', '44111 - 44119', 4, '32.05.01'),
(386, 'Gebang', 'Cirebon', 'Jawa Barat', '45190', 2, '32.09.30'),
(387, 'Gedebage', 'Bandung', 'Jawa Barat', '40294', 3, '32.73.27'),
(388, 'Gegerbitung (Geger Bitung)', 'Sukabumi', 'Jawa Barat', '43154 - 43197', 2, '32.02.40'),
(389, 'Gegesik', 'Cirebon', 'Jawa Barat', '45164', 2, '32.09.28'),
(390, 'Gekbrong', 'Cianjur', 'Jawa Barat', '43261', 2, '32.03.27'),
(391, 'Gempol', 'Cirebon', 'Jawa Barat', '45161', 2, '32.09.37'),
(392, 'Greged (Greget)', 'Cirebon', 'Jawa Barat', '45170', 2, '32.09.38'),
(393, 'Gunung Jati (Cirebon Utara)', 'Cirebon', 'Jawa Barat', '45151', 2, '32.09.21'),
(394, 'Gunung Putri', 'Bogor', 'Jawa Barat', '16960 - 16969', 2, '32.01.02'),
(395, 'Gunung Sindur', 'Bogor', 'Jawa Barat', '16340', 2, '32.01.11'),
(396, 'Gunung Tanjung', 'Tasikmalaya', 'Jawa Barat', '46418', 2, '32.06.23'),
(397, 'Gunungguruh', 'Sukabumi', 'Jawa Barat', '43156', 2, '32.02.27'),
(398, 'Gununghalu', 'Bandung Barat', 'Jawa Barat', '40565', 2, '32.17.15'),
(399, 'Gunungpuyuh (Gunung Puyuh)', 'Sukabumi', 'Jawa Barat', '43121 - 43123', 2, '32.72.01'),
(400, 'Hantara', 'Kuningan', 'Jawa Barat', '45564', 2, '32.08.26'),
(401, 'Harjamukti', 'Cirebon', 'Jawa Barat', '45141 - 45145', 2, '32.74.03'),
(402, 'Haurgeulis', 'Indramayu', 'Jawa Barat', '45266', 2, '32.12.01'),
(403, 'Haurwangi', 'Cianjur', 'Jawa Barat', '43280', 2, '32.03.31'),
(404, 'Ibun', 'Bandung', 'Jawa Barat', '40384', 3, '32.04.36'),
(405, 'Indihiang', 'Tasikmalaya', 'Jawa Barat', '46151 - 46411', 2, '32.78.04'),
(406, 'Indramayu', 'Indramayu', 'Jawa Barat', '45211 - 45219', 2, '32.12.15'),
(407, 'Jalaksana', 'Kuningan', 'Jawa Barat', '45553 - 45554', 2, '32.08.12'),
(408, 'Jalancagak', 'Subang', 'Jawa Barat', '41281', 2, '32.13.12'),
(409, 'Jamanis', 'Tasikmalaya', 'Jawa Barat', '46175', 2, '32.06.35'),
(410, 'Jamblang', 'Cirebon', 'Jawa Barat', '45156', 2, '32.09.40'),
(411, 'Jampangkulon (Jampang Kulon)', 'Sukabumi', 'Jawa Barat', '43170', 2, '32.02.21'),
(412, 'Jampangtengah (Jampang Tengah)', 'Sukabumi', 'Jawa Barat', '43171', 2, '32.02.08'),
(413, 'Japara', 'Kuningan', 'Jawa Barat', '45555', 2, '32.08.23'),
(414, 'Jasinga', 'Bogor', 'Jawa Barat', '16670', 2, '32.01.19'),
(415, 'Jatiasih', 'Bekasi', 'Jawa Barat', '17421 - 17426', 2, '32.75.09'),
(416, 'Jatibarang', 'Indramayu', 'Jawa Barat', '45273', 2, '32.12.13'),
(417, 'Jatigede', 'Sumedang', 'Jawa Barat', '45377', 2, '32.11.26'),
(418, 'Jatiluhur', 'Purwakarta', 'Jawa Barat', '41152 - 41161', 2, '32.14.03'),
(419, 'Jatinagara', 'Ciamis', 'Jawa Barat', '46273', 5, '32.07.12'),
(420, 'Jatinangor', 'Sumedang', 'Jawa Barat', '45360', 2, '32.11.15'),
(421, 'Jatinunggal', 'Sumedang', 'Jawa Barat', '45376', 2, '32.11.02'),
(422, 'Jatisampurna (Jati Sampurna)', 'Bekasi', 'Jawa Barat', '17432 - 17435', 2, '32.75.10'),
(423, 'Jatisari', 'Karawang', 'Jawa Barat', '41375', 2, '32.15.14'),
(424, 'Jatitujuh', 'Majalengka', 'Jawa Barat', '45458', 2, '32.10.15'),
(425, 'Jatiwangi', 'Majalengka', 'Jawa Barat', '45454', 2, '32.10.11'),
(426, 'Jatiwaras', 'Tasikmalaya', 'Jawa Barat', '46180', 2, '32.06.19'),
(427, 'Jayakerta', 'Karawang', 'Jawa Barat', '41351', 2, '32.15.22'),
(428, 'Jonggol', 'Bogor', 'Jawa Barat', '16830', 2, '32.01.06'),
(429, 'Juntinyuat', 'Indramayu', 'Jawa Barat', '45282', 2, '32.12.11'),
(430, 'Kabandungan', 'Sukabumi', 'Jawa Barat', '43368', 2, '32.02.19'),
(431, 'Kadipaten', 'Majalengka', 'Jawa Barat', '45452', 2, '32.06.37'),
(432, 'Kadipaten', 'Tasikmalaya', 'Jawa Barat', '46157', 2, '32.06.37'),
(433, 'Kadudampit', 'Sukabumi', 'Jawa Barat', '43153', 2, '32.02.30'),
(434, 'Kadugede', 'Kuningan', 'Jawa Barat', '45561', 2, '32.08.01'),
(435, 'Kadungora', 'Garut', 'Jawa Barat', '44153', 4, '32.05.10'),
(436, 'Kadupandak', 'Cianjur', 'Jawa Barat', '43268', 2, '32.03.17'),
(437, 'Kalapanunggal (Kalapa Nunggal)', 'Sukabumi', 'Jawa Barat', '43354', 2, '32.02.18'),
(438, 'Kalibunder', 'Sukabumi', 'Jawa Barat', '43185', 2, '32.02.23'),
(439, 'Kalijati', 'Subang', 'Jawa Barat', '41271', 2, '32.13.04'),
(440, 'Kalimanggis', 'Kuningan', 'Jawa Barat', '45594', 2, '32.08.27'),
(441, 'Kalipucang', 'Pangandaran', 'Jawa Barat', '46397', 2, '32.18.08'),
(442, 'Kaliwedi', 'Cirebon', 'Jawa Barat', '45165', 2, '32.09.29'),
(443, 'Kandanghaur', 'Indramayu', 'Jawa Barat', '45213 - 45254', 2, '32.12.21'),
(444, 'Kapetakan', 'Cirebon', 'Jawa Barat', '45152', 2, '32.09.22'),
(445, 'Karang Bahagia (Karangbahagia)', 'Bekasi', 'Jawa Barat', '17535', 2, '32.16.10'),
(446, 'Karang Jaya', 'Tasikmalaya', 'Jawa Barat', '46199', 2, '32.06.21'),
(447, 'Karang Kancana (Karangkancana)', 'Kuningan', 'Jawa Barat', '45584', 2, '32.08.29'),
(448, 'Karangampel', 'Indramayu', 'Jawa Barat', '45283', 2, '32.12.10'),
(449, 'Karangnunggal', 'Tasikmalaya', 'Jawa Barat', '46186', 2, '32.06.02'),
(450, 'Karangpawitan', 'Garut', 'Jawa Barat', '44182', 4, '32.05.02'),
(451, 'Karangsembung', 'Cirebon', 'Jawa Barat', '45186', 2, '32.09.06'),
(452, 'Karangtengah', 'Cianjur', 'Jawa Barat', '43281', 2, '32.05.16'),
(453, 'Karangtengah', 'Garut', 'Jawa Barat', '44184', 4, '32.05.16'),
(454, 'Karangwareng', 'Cirebon', 'Jawa Barat', '45184', 2, '32.09.34'),
(455, 'Karawang Barat', 'Karawang', 'Jawa Barat', '41311 - 41316', 2, '32.15.01'),
(456, 'Karawang Timur', 'Karawang', 'Jawa Barat', '41313 - 41314', 2, '32.15.26'),
(457, 'Kasokandel', 'Majalengka', 'Jawa Barat', '45451', 2, '32.10.24'),
(458, 'Kasomalang', 'Subang', 'Jawa Barat', '41287', 2, '32.13.26'),
(459, 'Katapang', 'Bandung', 'Jawa Barat', '40921', 3, '32.04.11'),
(460, 'Kawali', 'Ciamis', 'Jawa Barat', '46253', 5, '32.07.09'),
(461, 'Kawalu', 'Tasikmalaya', 'Jawa Barat', '46182', 2, '32.78.05'),
(462, 'Kebonpedes', 'Sukabumi', 'Jawa Barat', '43194', 2, '32.02.34'),
(463, 'Kedawung', 'Cirebon', 'Jawa Barat', '45153', 2, '32.09.20'),
(464, 'Kedokan Bunder', 'Indramayu', 'Jawa Barat', '45280', 2, '32.12.28'),
(465, 'Kedung Waringin', 'Bekasi', 'Jawa Barat', '17540', 2, '32.16.12'),
(466, 'Kejaksan', 'Cirebon', 'Jawa Barat', '45121 - 45123', 2, '32.74.01'),
(467, 'Kemang', 'Bogor', 'Jawa Barat', '16310', 2, '32.01.12'),
(468, 'Kersamanah', 'Garut', 'Jawa Barat', '44189', 4, '32.05.13'),
(469, 'Kertajati', 'Majalengka', 'Jawa Barat', '45457', 2, '32.10.14'),
(470, 'Kertasari', 'Bandung', 'Jawa Barat', '40386', 3, '32.04.31'),
(471, 'Kertasemaya', 'Indramayu', 'Jawa Barat', '45274', 2, '32.12.08'),
(472, 'Kesambi', 'Cirebon', 'Jawa Barat', '45131 - 45134', 2, '32.74.05'),
(473, 'Kiaracondong', 'Bandung', 'Jawa Barat', '40281 - 40285', 3, '32.73.16'),
(474, 'Kiarapedes', 'Purwakarta', 'Jawa Barat', '41175', 2, '32.14.17'),
(475, 'Klangenan', 'Cirebon', 'Jawa Barat', '45157', 2, '32.09.23'),
(476, 'Klapanunggal', 'Bogor', 'Jawa Barat', '16710', 2, '32.01.32'),
(477, 'Klari', 'Karawang', 'Jawa Barat', '41371', 2, '32.15.05'),
(478, 'Kota Baru (Kotabaru)', 'Karawang', 'Jawa Barat', '41376', 2, '32.15.25'),
(479, 'Kramatmulya (Kramat Mulya)', 'Kuningan', 'Jawa Barat', '45553', 2, '32.08.16'),
(480, 'Krangkeng', 'Indramayu', 'Jawa Barat', '45284', 2, '32.12.09'),
(481, 'Kroya', 'Indramayu', 'Jawa Barat', '45265', 2, '32.12.02'),
(482, 'Kuningan', 'Kuningan', 'Jawa Barat', '45511 - 45553', 2, '32.08.09'),
(483, 'Kutawaluya', 'Karawang', 'Jawa Barat', '41358', 2, '32.15.07'),
(484, 'Kutawaringin', 'Bandung', 'Jawa Barat', '40911', 3, '32.04.46'),
(485, 'Lakbok', 'Ciamis', 'Jawa Barat', '46385', 5, '32.07.17'),
(486, 'Langensari', 'Banjar', 'Jawa Barat', '46324 - 46344', 2, '32.79.04'),
(487, 'Langkaplancar', 'Pangandaran', 'Jawa Barat', '46391', 2, '32.18.05'),
(488, 'Lebakwangi', 'Kuningan', 'Jawa Barat', '45574', 2, '32.08.07'),
(489, 'Legonkulon', 'Subang', 'Jawa Barat', '41254', 2, '32.13.21'),
(490, 'Lelea', 'Indramayu', 'Jawa Barat', '45261', 2, '32.12.05'),
(491, 'Leles', 'Cianjur', 'Jawa Barat', '43273', 2, '32.05.09'),
(492, 'Leles', 'Garut', 'Jawa Barat', '44119 - 44152', 4, '32.05.09'),
(493, 'Lemah Wungkuk (Lemahwungkuk)', 'Cirebon', 'Jawa Barat', '45111 - 45114', 2, '32.74.02'),
(494, 'Lemahabang', 'Cirebon', 'Jawa Barat', '45183', 2, '32.15.19'),
(495, 'Lemahabang', 'Karawang', 'Jawa Barat', '41383', 2, '32.15.19'),
(496, 'Lemahsugih', 'Majalengka', 'Jawa Barat', '45465', 2, '32.10.01'),
(497, 'Lembang', 'Bandung Barat', 'Jawa Barat', '40391', 2, '32.17.01'),
(498, 'Lembursitu', 'Sukabumi', 'Jawa Barat', '43134 - 43169', 2, '32.72.06'),
(499, 'Lengkong', 'Bandung', 'Jawa Barat', '40261 - 40265', 3, '32.02.07'),
(500, 'Lengkong', 'Sukabumi', 'Jawa Barat', '43174', 2, '32.02.07'),
(501, 'Leuwigoong', 'Garut', 'Jawa Barat', '44192', 4, '32.05.11'),
(502, 'Leuwiliang', 'Bogor', 'Jawa Barat', '16640', 2, '32.01.14'),
(503, 'Leuwimunding', 'Majalengka', 'Jawa Barat', '45473', 2, '32.10.10'),
(504, 'Leuwisadeng', 'Bogor', 'Jawa Barat', '16641', 2, '32.01.39'),
(505, 'Leuwisari', 'Tasikmalaya', 'Jawa Barat', '46464', 2, '32.06.28'),
(506, 'Ligung', 'Majalengka', 'Jawa Barat', '45456', 2, '32.10.16'),
(507, 'Limo', 'Depok', 'Jawa Barat', '16512 - 16515', 1, '32.76.04'),
(508, 'Lohbener', 'Indramayu', 'Jawa Barat', '45252', 2, '32.12.18'),
(509, 'Losarang', 'Indramayu', 'Jawa Barat', '45253', 2, '32.12.20'),
(510, 'Losari', 'Cirebon', 'Jawa Barat', '45192', 2, '32.09.03'),
(511, 'Lumbung', 'Ciamis', 'Jawa Barat', '46258', 5, '32.07.34'),
(512, 'Luragung', 'Kuningan', 'Jawa Barat', '45581 - 45582', 2, '32.08.06'),
(513, 'Maja', 'Majalengka', 'Jawa Barat', '45461', 2, '32.10.06'),
(514, 'Majalaya', 'Bandung', 'Jawa Barat', '40382', 3, '32.15.21'),
(515, 'Majalaya', 'Karawang', 'Jawa Barat', '41370', 2, '32.15.21'),
(516, 'Majalengka', 'Majalengka', 'Jawa Barat', '45411 - 45419', 2, '32.10.07'),
(517, 'Malangbong', 'Garut', 'Jawa Barat', '44188', 4, '32.05.14'),
(518, 'Malausma', 'Majalengka', 'Jawa Barat', '45460', 2, '32.10.26'),
(519, 'Maleber', 'Kuningan', 'Jawa Barat', '45574 - 45575', 2, '32.08.30'),
(520, 'Mandalajati', 'Bandung', 'Jawa Barat', '40195', 3, '32.73.30'),
(521, 'Mande', 'Cianjur', 'Jawa Barat', '43292', 2, '32.03.08'),
(522, 'Mandirancan', 'Kuningan', 'Jawa Barat', '45558', 2, '32.08.14'),
(523, 'Mangkubumi', 'Tasikmalaya', 'Jawa Barat', '46181', 2, '32.78.08'),
(524, 'Mangunjaya', 'Pangandaran', 'Jawa Barat', '46371', 2, '32.18.06'),
(525, 'Mangunreja', 'Tasikmalaya', 'Jawa Barat', '46462', 2, '32.06.25'),
(526, 'Maniis', 'Purwakarta', 'Jawa Barat', '41166', 2, '32.14.07'),
(527, 'Manonjaya', 'Tasikmalaya', 'Jawa Barat', '46197', 2, '32.06.22'),
(528, 'Margaasih', 'Bandung', 'Jawa Barat', '40214 - 40218', 3, '32.04.10'),
(529, 'Margahayu', 'Bandung', 'Jawa Barat', '40225 - 40229', 3, '32.04.09'),
(530, 'Medansatria (Medan Satria)', 'Bekasi', 'Jawa Barat', '17131 - 17143', 2, '32.75.06'),
(531, 'Megamendung', 'Bogor', 'Jawa Barat', '16770', 2, '32.01.26'),
(532, 'Mekarmukti', 'Garut', 'Jawa Barat', '44155', 4, '32.05.32'),
(533, 'Muaragembong (Muara Gembong)', 'Bekasi', 'Jawa Barat', '17730', 2, '32.16.17'),
(534, 'Mundu', 'Cirebon', 'Jawa Barat', '45173', 2, '32.09.12'),
(535, 'Mustikajaya (Mustika Jaya)', 'Bekasi', 'Jawa Barat', '17155 - 17158', 2, '32.75.11'),
(536, 'Nagrak', 'Sukabumi', 'Jawa Barat', '43352', 2, '32.02.12'),
(537, 'Nagreg', 'Bandung', 'Jawa Barat', '40215', 3, '32.04.26'),
(538, 'Nanggung', 'Bogor', 'Jawa Barat', '16650', 2, '32.01.21'),
(539, 'Naringgul', 'Cianjur', 'Jawa Barat', '43274', 2, '32.03.24'),
(540, 'Ngamprah', 'Bandung Barat', 'Jawa Barat', '40552', 2, '32.17.06'),
(541, 'Nusaherang', 'Kuningan', 'Jawa Barat', '45563', 2, '32.08.20'),
(542, 'Nyalindung', 'Sukabumi', 'Jawa Barat', '43196', 2, '32.02.39'),
(543, 'Pabedilan', 'Cirebon', 'Jawa Barat', '45193', 2, '32.09.04'),
(544, 'Pabuaran', 'Cirebon', 'Jawa Barat', '45194', 2, '32.02.37'),
(545, 'Pabuaran', 'Subang', 'Jawa Barat', '41262', 2, '32.02.37'),
(546, 'Pabuaran', 'Sukabumi', 'Jawa Barat', '43173', 2, '32.02.37'),
(547, 'Pacet', 'Bandung', 'Jawa Barat', '40385', 3, '32.03.10'),
(548, 'Pacet', 'Cianjur', 'Jawa Barat', '43253 - 43281', 2, '32.03.10'),
(549, 'Padaherang', 'Pangandaran', 'Jawa Barat', '46267 - 46384', 2, '32.18.07'),
(550, 'Padakembang', 'Tasikmalaya', 'Jawa Barat', '46466', 2, '32.06.29'),
(551, 'Padalarang', 'Bandung Barat', 'Jawa Barat', '40553', 2, '32.17.08'),
(552, 'Pagaden', 'Subang', 'Jawa Barat', '41251', 2, '32.13.07'),
(553, 'Pagaden Barat', 'Subang', 'Jawa Barat', '41252', 2, '32.13.28'),
(554, 'Pagelaran', 'Cianjur', 'Jawa Barat', '43266', 2, '32.03.18'),
(555, 'Pagerageung', 'Tasikmalaya', 'Jawa Barat', '46158 - 46413', 2, '32.06.38'),
(556, 'Pakenjeng', 'Garut', 'Jawa Barat', '44164', 4, '32.05.33'),
(557, 'Pakisjaya', 'Karawang', 'Jawa Barat', '41355', 2, '32.15.12'),
(558, 'Palabuhanratu (Pelabuhanratu)', 'Sukabumi', 'Jawa Barat', '43364', 2, '32.02.01'),
(559, 'Palasah', 'Majalengka', 'Jawa Barat', '45475', 2, '32.10.19'),
(560, 'Palimanan', 'Cirebon', 'Jawa Barat', '45160', 2, '32.09.17'),
(561, 'Pamanukan', 'Subang', 'Jawa Barat', '41264', 2, '32.13.11'),
(562, 'Pamarican', 'Ciamis', 'Jawa Barat', '46361 - 46382', 5, '32.07.19'),
(563, 'Pameungpeuk', 'Bandung', 'Jawa Barat', '40376', 3, '32.05.27'),
(564, 'Pameungpeuk', 'Garut', 'Jawa Barat', '44175', 4, '32.05.27'),
(565, 'Pamijahan', 'Bogor', 'Jawa Barat', '16812', 2, '32.01.17'),
(566, 'Pamulihan', 'Garut', 'Jawa Barat', '44168', 4, '32.11.13'),
(567, 'Pamulihan', 'Sumedang', 'Jawa Barat', '45365', 2, '32.11.13'),
(568, 'Panawangan', 'Ciamis', 'Jawa Barat', '46255', 5, '32.07.10'),
(569, 'Pancalang', 'Kuningan', 'Jawa Barat', '45557', 2, '32.08.22'),
(570, 'Pancatengah', 'Tasikmalaya', 'Jawa Barat', '46194', 2, '32.06.04'),
(571, 'Pancoran Mas', 'Depok', 'Jawa Barat', '16431 - 16436', 1, '32.76.01'),
(572, 'Pangalengan', 'Bandung', 'Jawa Barat', '40378', 3, '32.04.15'),
(573, 'Pangandaran', 'Pangandaran', 'Jawa Barat', '46396', 2, '32.18.09'),
(574, 'Pangatikan', 'Garut', 'Jawa Barat', '44183', 4, '32.05.41'),
(575, 'Pangenan', 'Cirebon', 'Jawa Barat', '45182', 2, '32.09.11'),
(576, 'Pangkalan', 'Karawang', 'Jawa Barat', '41362', 2, '32.15.02'),
(577, 'Panguragan', 'Cirebon', 'Jawa Barat', '45163', 2, '32.09.25'),
(578, 'Panjalu', 'Ciamis', 'Jawa Barat', '46264', 5, '32.07.08'),
(579, 'Panumbangan', 'Ciamis', 'Jawa Barat', '46263', 5, '32.07.07'),
(580, 'Panyileukan', 'Bandung', 'Jawa Barat', '40614', 3, '32.73.28'),
(581, 'Panyingkiran', 'Majalengka', 'Jawa Barat', '45459', 2, '32.10.18'),
(582, 'Parakansalak (Parakan Salak)', 'Sukabumi', 'Jawa Barat', '43355', 2, '32.02.15'),
(583, 'Parigi', 'Pangandaran', 'Jawa Barat', '46393', 2, '32.18.01'),
(584, 'Parongpong', 'Bandung Barat', 'Jawa Barat', '40559', 2, '32.17.02'),
(585, 'Parung', 'Bogor', 'Jawa Barat', '16330', 2, '32.01.10'),
(586, 'Parung Panjang', 'Bogor', 'Jawa Barat', '16360', 2, '32.01.20'),
(587, 'Parungkuda (Parung Kuda)', 'Sukabumi', 'Jawa Barat', '43357', 2, '32.02.13'),
(588, 'Parungponteng', 'Tasikmalaya', 'Jawa Barat', '46189', 2, '32.06.07'),
(589, 'Pasaleman', 'Cirebon', 'Jawa Barat', '45187', 2, '32.09.32'),
(590, 'Pasawahan', 'Kuningan', 'Jawa Barat', '45559', 2, '32.14.10'),
(591, 'Pasawahan', 'Purwakarta', 'Jawa Barat', '41171 - 41172', 2, '32.14.10'),
(592, 'Paseh', 'Bandung', 'Jawa Barat', '40383', 3, '32.11.08'),
(593, 'Paseh', 'Sumedang', 'Jawa Barat', '45381', 2, '32.11.08'),
(594, 'Pasekan', 'Indramayu', 'Jawa Barat', '45213 - 45229', 2, '32.12.29'),
(595, 'Pasirjambu', 'Bandung', 'Jawa Barat', '40972', 3, '32.04.38'),
(596, 'Pasirkuda', 'Cianjur', 'Jawa Barat', '43266 - 43267', 2, '32.03.32'),
(597, 'Pasirwangi', 'Garut', 'Jawa Barat', '44161', 4, '32.05.08'),
(598, 'Pataruman', 'Banjar', 'Jawa Barat', '46316 - 46335', 2, '32.79.02'),
(599, 'Patokbeusi', 'Subang', 'Jawa Barat', '41263', 2, '32.13.16'),
(600, 'Patrol', 'Indramayu', 'Jawa Barat', '45257', 2, '32.12.31'),
(601, 'Pebayuran', 'Bekasi', 'Jawa Barat', '17710', 2, '32.16.13'),
(602, 'Pedes', 'Karawang', 'Jawa Barat', '41353', 2, '32.15.10'),
(603, 'Pekalipan', 'Cirebon', 'Jawa Barat', '45115 - 45118', 2, '32.74.04'),
(604, 'Peundeuy', 'Garut', 'Jawa Barat', '44178', 4, '32.05.26'),
(605, 'Plered', 'Cirebon', 'Jawa Barat', '45154', 2, '32.14.04'),
(606, 'Plered', 'Purwakarta', 'Jawa Barat', '41162', 2, '32.14.04'),
(607, 'Plumbon', 'Cirebon', 'Jawa Barat', '45158', 2, '32.09.18'),
(608, 'Pondokgede (Pondok Gede)', 'Bekasi', 'Jawa Barat', '17411 - 17413', 2, '32.75.08'),
(609, 'Pondokmelati (Pondok Melati)', 'Bekasi', 'Jawa Barat', '17414 - 17431', 2, '32.75.12'),
(610, 'Pondoksalam', 'Purwakarta', 'Jawa Barat', '41115', 2, '32.14.16'),
(611, 'Purabaya', 'Sukabumi', 'Jawa Barat', '43187', 2, '32.02.38'),
(612, 'Purbaratu', 'Tasikmalaya', 'Jawa Barat', '46190', 2, '32.78.10'),
(613, 'Purwadadi', 'Ciamis', 'Jawa Barat', '46380', 5, '32.13.06'),
(614, 'Purwadadi', 'Subang', 'Jawa Barat', '41261', 2, '32.13.06'),
(615, 'Purwaharja', 'Banjar', 'Jawa Barat', '46331 - 46334', 2, '32.79.03'),
(616, 'Purwakarta', 'Purwakarta', 'Jawa Barat', '41111 - 41119', 2, '32.14.01'),
(617, 'Purwasari', 'Karawang', 'Jawa Barat', '41377', 2, '32.15.29'),
(618, 'Pusakajaya', 'Subang', 'Jawa Barat', '41255', 2, '32.13.30'),
(619, 'Pusakanagara', 'Subang', 'Jawa Barat', '41265', 2, '32.13.10'),
(620, 'Puspahiang', 'Tasikmalaya', 'Jawa Barat', '46471', 2, '32.06.15'),
(621, 'Rajadesa', 'Ciamis', 'Jawa Barat', '46254', 5, '32.07.13'),
(622, 'Rajagaluh', 'Majalengka', 'Jawa Barat', '45472', 2, '32.10.09'),
(623, 'Rajapolah', 'Tasikmalaya', 'Jawa Barat', '46155 - 46183', 2, '32.06.34'),
(624, 'Ranca Bungur', 'Bogor', 'Jawa Barat', '16311', 2, '32.01.34'),
(625, 'Rancabali (Ranca Bali)', 'Bandung', 'Jawa Barat', '40974', 3, '32.04.40'),
(626, 'Rancaekek', 'Bandung', 'Jawa Barat', '40394', 3, '32.04.28'),
(627, 'Rancah', 'Ciamis', 'Jawa Barat', '46387', 5, '32.07.15'),
(628, 'Rancakalong', 'Sumedang', 'Jawa Barat', '45361', 2, '32.11.16'),
(629, 'Rancasari', 'Bandung', 'Jawa Barat', '40292 - 40295', 3, '32.73.23'),
(630, 'Rawalumbu', 'Bekasi', 'Jawa Barat', '17114 - 17117', 2, '32.75.05'),
(631, 'Rawamerta', 'Karawang', 'Jawa Barat', '41382', 2, '32.15.18'),
(632, 'Regol', 'Bandung', 'Jawa Barat', '40251 - 40255', 3, '32.73.11'),
(633, 'Rengasdengklok', 'Karawang', 'Jawa Barat', '41352', 2, '32.15.06'),
(634, 'Rongga', 'Bandung Barat', 'Jawa Barat', '40566', 2, '32.17.13'),
(635, 'Rumpin', 'Bogor', 'Jawa Barat', '16350', 2, '32.01.18'),
(636, 'Sadananya', 'Ciamis', 'Jawa Barat', '46256', 5, '32.07.04'),
(637, 'Sagalaherang', 'Subang', 'Jawa Barat', '41282', 2, '32.13.01'),
(638, 'Sagaranten', 'Sukabumi', 'Jawa Barat', '43181', 2, '32.02.41'),
(639, 'Saguling', 'Bandung Barat', 'Jawa Barat', '40560', 2, '32.17.16'),
(640, 'Salawu', 'Tasikmalaya', 'Jawa Barat', '46472', 2, '32.06.14'),
(641, 'Salopa', 'Tasikmalaya', 'Jawa Barat', '46192', 2, '32.06.18'),
(642, 'Samarang', 'Garut', 'Jawa Barat', '44160', 4, '32.05.07'),
(643, 'Sariwangi', 'Tasikmalaya', 'Jawa Barat', '46465', 2, '32.06.30'),
(644, 'Sawangan', 'Depok', 'Jawa Barat', '16511 - 16519', 1, '32.76.03'),
(645, 'Sedong', 'Cirebon', 'Jawa Barat', '45189', 2, '32.09.09'),
(646, 'Selaawi', 'Garut', 'Jawa Barat', '44187', 4, '32.05.39'),
(647, 'Selajambe', 'Kuningan', 'Jawa Barat', '45566', 2, '32.08.15'),
(648, 'Serang Baru', 'Bekasi', 'Jawa Barat', '17330', 2, '32.16.21'),
(649, 'Serangpanjang', 'Subang', 'Jawa Barat', '41288', 2, '32.13.23'),
(650, 'Setu', 'Bekasi', 'Jawa Barat', '17320', 2, '32.16.18'),
(651, 'Sidamulih', 'Pangandaran', 'Jawa Barat', '46365', 2, '32.18.10'),
(652, 'Simpenan', 'Sukabumi', 'Jawa Barat', '43361', 2, '32.02.02'),
(653, 'Sindang', 'Indramayu', 'Jawa Barat', '45221 - 45227', 2, '32.10.25'),
(654, 'Sindang', 'Majalengka', 'Jawa Barat', '45471', 2, '32.10.25'),
(655, 'Sindang Agung (Sindangagung)', 'Kuningan', 'Jawa Barat', '45573', 2, '32.08.31'),
(656, 'Sindangbarang', 'Cianjur', 'Jawa Barat', '43272', 2, '32.03.21'),
(657, 'Sindangkasih', 'Ciamis', 'Jawa Barat', '46268', 5, '32.07.31'),
(658, 'Sindangkerta', 'Bandung Barat', 'Jawa Barat', '40563', 2, '32.17.14'),
(659, 'Sindangwangi', 'Majalengka', 'Jawa Barat', '45474', 2, '32.10.21'),
(660, 'Singajaya', 'Garut', 'Jawa Barat', '44170', 4, '32.05.24'),
(661, 'Singaparna', 'Tasikmalaya', 'Jawa Barat', '46411 - 46418', 2, '32.06.24'),
(662, 'Situraja', 'Sumedang', 'Jawa Barat', '45371', 2, '32.11.06'),
(663, 'Sliyeg', 'Indramayu', 'Jawa Barat', '45281', 2, '32.12.12'),
(664, 'Sodonghilir', 'Tasikmalaya', 'Jawa Barat', '46473', 2, '32.06.12'),
(665, 'Solokanjeruk (Solokan Jeruk)', 'Bandung', 'Jawa Barat', '40375', 3, '32.04.34'),
(666, 'Soreang', 'Bandung', 'Jawa Barat', '40911 - 40915', 3, '32.04.37'),
(667, 'Subang', 'Kuningan', 'Jawa Barat', '45586', 2, '32.13.03'),
(668, 'Subang', 'Subang', 'Jawa Barat', '41211 - 41215', 2, '32.13.03'),
(669, 'Sucinaraja', 'Garut', 'Jawa Barat', '44115', 4, '32.05.42'),
(670, 'Sukabumi', 'Sukabumi', 'Jawa Barat', '43151', 2, '32.02.32'),
(671, 'Sukadana', 'Ciamis', 'Jawa Barat', '46272', 5, '32.07.14'),
(672, 'Sukagumiwang', 'Indramayu', 'Jawa Barat', '45275', 2, '32.12.27'),
(673, 'Sukahaji', 'Majalengka', 'Jawa Barat', '45470', 2, '32.10.08'),
(674, 'Sukahening', 'Tasikmalaya', 'Jawa Barat', '46155', 2, '32.06.33'),
(675, 'Sukajadi', 'Bandung', 'Jawa Barat', '40161 - 40164', 3, '32.73.07'),
(676, 'Sukajaya', 'Bogor', 'Jawa Barat', '16661', 2, '32.01.35'),
(677, 'Sukakarya', 'Bekasi', 'Jawa Barat', '17630', 2, '32.16.14'),
(678, 'Sukalarang', 'Sukabumi', 'Jawa Barat', '43191', 2, '32.02.36'),
(679, 'Sukaluyu', 'Cianjur', 'Jawa Barat', '43287', 2, '32.03.09'),
(680, 'Sukamakmur', 'Bogor', 'Jawa Barat', '16831', 2, '32.01.09'),
(681, 'Sukamantri', 'Ciamis', 'Jawa Barat', '46265', 5, '32.07.33'),
(682, 'Sukanagara', 'Cianjur', 'Jawa Barat', '43264', 2, '32.03.14'),
(683, 'Sukaraja', 'Bogor', 'Jawa Barat', '16711', 2, '32.06.17'),
(684, 'Sukaraja', 'Sukabumi', 'Jawa Barat', '43192', 2, '32.06.17'),
(685, 'Sukaraja', 'Tasikmalaya', 'Jawa Barat', '46183', 2, '32.06.17'),
(686, 'Sukarame', 'Tasikmalaya', 'Jawa Barat', '46461', 2, '32.06.26'),
(687, 'Sukaratu', 'Tasikmalaya', 'Jawa Barat', '46415', 2, '32.06.31'),
(688, 'Sukaresik', 'Tasikmalaya', 'Jawa Barat', '46419', 2, '32.06.39'),
(689, 'Sukaresmi', 'Cianjur', 'Jawa Barat', '43254', 2, '32.05.21'),
(690, 'Sukaresmi', 'Garut', 'Jawa Barat', '44154', 4, '32.05.21'),
(691, 'Sukasari', 'Bandung', 'Jawa Barat', '40151 - 40154', 3, '32.11.12'),
(692, 'Sukasari', 'Purwakarta', 'Jawa Barat', '41116', 2, '32.11.12'),
(693, 'Sukasari', 'Subang', 'Jawa Barat', '41250', 2, '32.11.12'),
(694, 'Sukasari', 'Sumedang', 'Jawa Barat', '45366', 2, '32.11.12'),
(695, 'Sukatani', 'Bekasi', 'Jawa Barat', '17631', 2, '32.14.05'),
(696, 'Sukatani', 'Purwakarta', 'Jawa Barat', '41167', 2, '32.14.05'),
(697, 'Sukawangi', 'Bekasi', 'Jawa Barat', '17620', 2, '32.16.03'),
(698, 'Sukawening', 'Garut', 'Jawa Barat', '44179', 4, '32.05.15'),
(699, 'Sukmajaya', 'Depok', 'Jawa Barat', '16411 - 16418', 1, '32.76.05'),
(700, 'Sukra', 'Indramayu', 'Jawa Barat', '45259', 2, '32.12.24'),
(701, 'Sumber', 'Cirebon', 'Jawa Barat', '45611 - 45613', 2, '32.09.15'),
(702, 'Sumberjaya', 'Majalengka', 'Jawa Barat', '45455 - 45468', 2, '32.10.17'),
(703, 'Sumedang Selatan', 'Sumedang', 'Jawa Barat', '45311 - 45315', 2, '32.11.17'),
(704, 'Sumedang Utara', 'Sumedang', 'Jawa Barat', '45321 - 45323', 2, '32.11.18'),
(705, 'Sumur Bandung', 'Bandung', 'Jawa Barat', '40111 - 40117', 3, '32.73.19'),
(706, 'Surade', 'Sukabumi', 'Jawa Barat', '43179', 2, '32.02.24'),
(707, 'Suranenggala', 'Cirebon', 'Jawa Barat', '45150', 2, '32.09.39'),
(708, 'Surian', 'Sumedang', 'Jawa Barat', '45393', 2, '32.11.09'),
(709, 'Susukan', 'Cirebon', 'Jawa Barat', '45166', 2, '32.09.27'),
(710, 'Susukan Lebak', 'Cirebon', 'Jawa Barat', '45185', 2, '32.09.08'),
(711, 'Tajurhalang', 'Bogor', 'Jawa Barat', '16320', 2, '32.01.37'),
(712, 'Takokak', 'Cianjur', 'Jawa Barat', '43265', 2, '32.03.16'),
(713, 'Talaga', 'Majalengka', 'Jawa Barat', '45463', 2, '32.10.04'),
(714, 'Talegong', 'Garut', 'Jawa Barat', '44167', 4, '32.05.37'),
(715, 'Talun (Cirebon Selatan)', 'Cirebon', 'Jawa Barat', '45171', 2, '32.09.14'),
(716, 'Tamansari', 'Bogor', 'Jawa Barat', '16611', 2, '32.78.07'),
(717, 'Tamansari', 'Tasikmalaya', 'Jawa Barat', '46191', 2, '32.78.07'),
(718, 'Tambakdahan', 'Subang', 'Jawa Barat', '41267', 2, '32.13.25'),
(719, 'Tambaksari', 'Ciamis', 'Jawa Barat', '46388', 5, '32.07.16'),
(720, 'Tambelang', 'Bekasi', 'Jawa Barat', '17621', 2, '32.16.04'),
(721, 'Tambun Selatan', 'Bekasi', 'Jawa Barat', '17510', 2, '32.16.06'),
(722, 'Tambun Utara', 'Bekasi', 'Jawa Barat', '17511', 2, '32.16.05'),
(723, 'Tanah Sareal (Tanah Sereal)', 'Bogor', 'Jawa Barat', '16161 - 16169', 2, '32.71.06'),
(724, 'Tanggeung', 'Cianjur', 'Jawa Barat', '43267', 2, '32.03.19'),
(725, 'Tanjungjaya', 'Tasikmalaya', 'Jawa Barat', '46184', 2, '32.06.16'),
(726, 'Tanjungkerta', 'Sumedang', 'Jawa Barat', '45354', 2, '32.11.20'),
(727, 'Tanjungmedar', 'Sumedang', 'Jawa Barat', '45352', 2, '32.11.21'),
(728, 'Tanjungsari', 'Bogor', 'Jawa Barat', '16841', 2, '32.11.11'),
(729, 'Tanjungsari', 'Sumedang', 'Jawa Barat', '45362', 2, '32.11.11'),
(730, 'Tanjungsiang', 'Subang', 'Jawa Barat', '41284', 2, '32.13.14'),
(731, 'Tapos', 'Depok', 'Jawa Barat', '16451 - 16459', 1, '32.76.10'),
(732, 'Taraju', 'Tasikmalaya', 'Jawa Barat', '46474', 2, '32.06.13'),
(733, 'Tarogong Kaler', 'Garut', 'Jawa Barat', '44151', 4, '32.05.04'),
(734, 'Tarogong Kidul', 'Garut', 'Jawa Barat', '44150', 4, '32.05.05'),
(735, 'Tarumajaya', 'Bekasi', 'Jawa Barat', '17211 - 17218', 2, '32.16.01'),
(736, 'Tawang', 'Tasikmalaya', 'Jawa Barat', '46111 - 46115', 2, '32.78.03'),
(737, 'Tegalbuleud', 'Sukabumi', 'Jawa Barat', '43186', 2, '32.02.45'),
(738, 'Tegalwaru', 'Karawang', 'Jawa Barat', '41364', 2, '32.15.28'),
(739, 'Tegalwaru (Tegal Waru)', 'Purwakarta', 'Jawa Barat', '41165', 2, '32.14.08'),
(740, 'Telagasari (Talagasari)', 'Karawang', 'Jawa Barat', '41381', 2, '32.15.17'),
(741, 'Telukjambe Barat', 'Karawang', 'Jawa Barat', '41361', 2, '32.15.27'),
(742, 'Telukjambe Timur', 'Karawang', 'Jawa Barat', '41360', 2, '32.15.03'),
(743, 'Tempuran', 'Karawang', 'Jawa Barat', '41385', 2, '32.15.20'),
(744, 'Tengah Tani', 'Cirebon', 'Jawa Barat', '45168', 2, '32.09.35'),
(745, 'Tenjo', 'Bogor', 'Jawa Barat', '16370', 2, '32.01.23'),
(746, 'Tenjolaya', 'Bogor', 'Jawa Barat', '16371', 2, '32.01.40'),
(747, 'Tirtajaya', 'Karawang', 'Jawa Barat', '41357', 2, '32.15.09'),
(748, 'Tirtamulya', 'Karawang', 'Jawa Barat', '41372', 2, '32.15.16'),
(749, 'Tomo', 'Sumedang', 'Jawa Barat', '45382', 2, '32.11.24'),
(750, 'Trisi/Terisi', 'Indramayu', 'Jawa Barat', '45260', 2, '32.12.26'),
(751, 'Tukdana', 'Indramayu', 'Jawa Barat', '45270', 2, '32.12.30'),
(752, 'Ujungberung (Ujung Berung)', 'Bandung', 'Jawa Barat', '40611 - 40619', 3, '32.73.26'),
(753, 'Ujungjaya', 'Sumedang', 'Jawa Barat', '45383', 2, '32.11.25'),
(754, 'Wado', 'Sumedang', 'Jawa Barat', '45373', 2, '32.11.01'),
(755, 'Waled', 'Cirebon', 'Jawa Barat', '45180', 2, '32.09.01'),
(756, 'Waluran', 'Sukabumi', 'Jawa Barat', '43175', 2, '32.02.20'),
(757, 'Wanaraja', 'Garut', 'Jawa Barat', '44180', 4, '32.05.03'),
(758, 'Wanayasa', 'Purwakarta', 'Jawa Barat', '41174', 2, '32.14.09'),
(759, 'Warudoyong', 'Sukabumi', 'Jawa Barat', '43131 - 43135', 2, '32.72.04'),
(760, 'Warungkiara', 'Sukabumi', 'Jawa Barat', '43362', 2, '32.02.09'),
(761, 'Warungkondang', 'Cianjur', 'Jawa Barat', '43260', 2, '32.03.02'),
(762, 'Weru', 'Cirebon', 'Jawa Barat', '45159', 2, '32.09.19'),
(763, 'Widasari', 'Indramayu', 'Jawa Barat', '45271', 2, '32.12.07');

-- --------------------------------------------------------

--
-- Table structure for table `daerah3`
--

CREATE TABLE `daerah3` (
  `no` int(5) NOT NULL,
  `nama` varchar(70) NOT NULL,
  `level` int(11) NOT NULL,
  `pos` varchar(20) DEFAULT NULL,
  `zonasi` int(1) DEFAULT NULL,
  `kode_wilayah` varchar(20) DEFAULT NULL,
  `mst_kode_wilayah_bps` varchar(10) DEFAULT NULL,
  `kode_wilayah_bps` varchar(10) NOT NULL,
  `lat` varchar(20) DEFAULT NULL,
  `lng` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dca001`
--

CREATE TABLE `dca001` (
  `ID_KEY` int(11) NOT NULL COMMENT 'Tabel Santunan Gempa',
  `SUB_PROD_ID` varchar(20) NOT NULL,
  `JARAK_TERDEKAT` double DEFAULT NULL COMMENT 'km',
  `JARAK_TERJAUH` double DEFAULT NULL COMMENT 'km',
  `PERSEN_SANTUNAN` double NOT NULL COMMENT '%',
  `SKALA_MINIMAL` double DEFAULT NULL,
  `SKALA_MAKSIMAL` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dca001`
--

INSERT INTO `dca001` (`ID_KEY`, `SUB_PROD_ID`, `JARAK_TERDEKAT`, `JARAK_TERJAUH`, `PERSEN_SANTUNAN`, `SKALA_MINIMAL`, `SKALA_MAKSIMAL`) VALUES
(1, 'PR124', 0, 5, 100, 7, 7),
(2, 'PR124', 5.0001, 10, 75, 7, 7),
(3, 'PR124', 10.0001, 15, 50, 7, 7),
(4, 'PR124', 15.0001, 20, 25, 7, 7),
(28, 'PR112', 0, 25, 100, 9.0001, 12),
(29, 'PR112', 0, 25, 75, 8.0001, 9),
(30, 'PR112', 0, 25, 50, 7.0001, 8),
(31, 'PR112', 0, 25, 40, 6.0001, 7),
(32, 'PR112', 0, 25, 30, 5.5001, 6),
(33, 'PR112', 25.0001, 75, 80, 9.0001, 12),
(34, 'PR112', 25.0001, 75, 60, 8.0001, 9),
(35, 'PR112', 25.0001, 75, 40, 7.0001, 8),
(36, 'PR112', 25.0001, 75, 32, 6.0001, 7),
(37, 'PR112', 25.0001, 75, 24, 5.5001, 6),
(38, 'PR112', 75.0001, 150, 60, 9.0001, 12),
(39, 'PR112', 75.0001, 150, 45, 8.0001, 9),
(40, 'PR112', 75.0001, 150, 30, 7.0001, 8),
(41, 'PR112', 75.0001, 150, 24, 6.0001, 7),
(42, 'PR112', 75.0001, 150, 18, 5.5001, 6),
(43, 'PR112', 150.0001, 250, 40, 9.0001, 12),
(44, 'PR112', 150.0001, 250, 30, 8.0001, 9),
(45, 'PR112', 150.0001, 250, 20, 7.0001, 8),
(46, 'PR112', 150.0001, 250, 16, 6.0001, 7),
(47, 'PR112', 150.0001, 250, 12, 5.5001, 6);

-- --------------------------------------------------------

--
-- Table structure for table `gempa`
--

CREATE TABLE `gempa` (
  `no` int(3) NOT NULL,
  `kekuatan` varchar(10) NOT NULL,
  `dalam` varchar(10) NOT NULL,
  `jarak` varchar(10) NOT NULL,
  `nkekuatan` varchar(10) NOT NULL,
  `ndalam` varchar(10) NOT NULL,
  `njarak` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gempa`
--

INSERT INTO `gempa` (`no`, `kekuatan`, `dalam`, `jarak`, `nkekuatan`, `ndalam`, `njarak`) VALUES
(2, '1', '1', '1', '1', '10', '10'),
(3, '2', '2', '2', '2', '9', '9'),
(4, '3', '3', '3', '3', '8', '8'),
(5, '4', '4', '4', '4', '7', '7'),
(6, '5', '5', '5', '5', '6', '6'),
(7, '6', '6', '6', '6', '5', '5'),
(8, '7', '7', '7', '7', '4', '4'),
(9, '8', '8', '8', '8', '3', '3'),
(10, '9', '9', '9', '9', '2', '2'),
(11, '10', '10', '10', '10', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `gempa2`
--

CREATE TABLE `gempa2` (
  `no` int(5) NOT NULL,
  `koor1` varchar(15) NOT NULL,
  `koor2` varchar(15) NOT NULL,
  `eks` int(1) NOT NULL,
  `skala` varchar(20) NOT NULL,
  `eksekusi` int(1) NOT NULL,
  `kedalaman` varchar(15) NOT NULL,
  `wilayah` text NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gempa2`
--

INSERT INTO `gempa2` (`no`, `koor1`, `koor2`, `eks`, `skala`, `eksekusi`, `kedalaman`, `wilayah`, `waktu`) VALUES
(5, '-6.1494757', '106.548376', 0, '6.4 SR', 0, '13 Km', '24 km BaratDaya SINABANG-ACEH', '2020-01-07 13:05:18'),
(6, '5.06', '125.4', 0, '5.0 SR', 0, '10 Km', '161 km BaratLaut TAHUNA-KEP.SANGIHE-SULUT', '2020-01-08 11:11:44'),
(7, '2.4', '127.51', 0, '5.3 SR', 0, '23 Km', '91 km BaratLaut TOBELO-MALUT', '2020-01-10 07:13:11'),
(8, '-10.53', '124.11', 0, '5.9 SR', 0, '10 Km', '64 km Tenggara KAB-KUPANG-NTT', '2020-01-15 14:55:30'),
(9, '-1.7', '138.9', 0, '5.1 SR', 0, '10 Km', '23 km TimurLaut SARMI-PAPUA', '2020-01-15 15:25:51'),
(10, '-9.27', '123.79', 0, '5.0 SR', 0, '96 Km', '80 km BaratLaut KAB-KUPANG-NTT', '2020-01-15 23:22:13'),
(11, '-6.64', '132.04', 0, '5.3 SR', 0, '82 Km', '132 km BaratDaya MALUKUTENGGARA', '2020-01-18 08:31:15'),
(12, '-2.71', '139.64', 0, '6.3 SR', 0, '56 Km', '39 km BaratLaut KAB-JAYAPURA-PAPUA', '2020-01-18 23:38:13'),
(13, '-2.67', '139.62', 0, '5.2 SR', 0, '63 Km', '43 km BaratLaut KAB-JAYAPURA-PAPUA', '2020-01-19 07:14:40'),
(14, '-0.2', '123.89', 0, '6.6 SR', 0, '95 Km', '64 km BaratDaya BOLAANGUKI-BOLSEL-SULUT', '2020-01-19 23:58:20'),
(15, '-10.11', '116.97', 0, '5.1 SR', 0, '10 Km', '151 km Tenggara SUMBAWABARAT-NTB', '2020-01-24 07:50:41'),
(16, '0.69', '126.33', 0, '5.8 SR', 0, '10 Km', '115 km BaratDaya TERNATE-MALUT', '2020-01-30 06:46:55'),
(17, '-1.96', '99.94', 0, '5.0 SR', 0, '10 Km', '39 km TimurLaut TUAPEJAT-SUMBAR', '2020-01-31 04:53:05'),
(18, '-6.52', '129.17', 0, '5.3 SR', 0, '253 Km', '237 km TimurLaut MALUKUBRTDAYA', '2020-02-01 05:10:55'),
(19, '-1.39', '134.02', 0, '5.3 SR', 0, '10 Km', '52 km Tenggara MANOKWARISEL-PAPUABRT', '2020-02-02 14:19:10'),
(20, '-4.97', '134.16', 0, '5.0 SR', 0, '10 Km', '88 km BaratLaut KEP.ARU-MALUKU', '2020-02-03 18:18:06'),
(21, '-0.23', '125.21', 0, '5.2 SR', 0, '10 Km', '128 km Tenggara TUTUYAN-BOLTIM-SULUT', '2020-02-03 19:12:39'),
(22, '-2.81', '140.84', 0, '5.0 SR', 0, '17 Km', '30 km Tenggara JAYAPURA-PAPUA', '2020-02-04 17:40:58'),
(23, '-6.43', '113.05', 0, '6.3 SR', 0, '636 Km', '69 km TimurLaut BANGKALAN-JATIM', '2020-02-06 01:12:34'),
(24, '-2.58', '139.36', 0, '5.1 SR', 0, '13 Km', '71 km BaratLaut KAB-JAYAPURA-PAPUA', '2020-02-06 14:10:53'),
(25, '5.44', '126.57', 0, '6.1 SR', 0, '10 Km', '160 km BaratLaut MELONGUANE-SULUT', '2020-02-06 20:40:07'),
(26, '-10.05', '117.71', 0, '5.0 SR', 0, '10 Km', '150 km BaratDaya KODI-SUMBABARATDAYA-NTT', '2020-02-07 04:06:31'),
(27, '-2.85', '129.91', 0, '5.0 SR', 0, '11 Km', '70 km BaratLaut SERAMBAGIANTIMUR-MALUKU', '2020-02-08 13:51:42'),
(28, '-1.27', '139.01', 0, '5.1 SR', 0, '10 Km', '70 km TimurLaut SARMI-PAPUA', '2020-02-10 04:23:58'),
(29, '-1.91', '122.49', 0, '5.0 SR', 0, '10 Km', '90 km BaratDaya BANGGAIKEP-SULTENG', '2020-02-12 17:04:26'),
(30, '-11.39', '113.27', 0, '5.0 SR', 0, '10 Km', '357 km BaratDaya JEMBER-JATIM', '2020-02-13 22:17:28'),
(31, '-6.66', '130.67', 0, '5.1 SR', 0, '125 Km', '161 km BaratLaut MALUKUTENGGARABRT', '2020-02-14 01:17:31'),
(32, '1.56', '126.46', 0, '5.4 SR', 0, '10 Km', '124 km BaratLaut JAILOLO-MALUT', '2020-02-15 22:36:44'),
(33, '-3.34', '131.52', 0, '5.8 SR', 0, '28 Km', '117 km Tenggara SERAMBAGIANTIMUR-MALUKU', '2020-02-16 06:00:30'),
(34, '2.14', '127.90', 0, '5.0 SR', 0, '10 Km', '44 km BaratLaut DARUBA-MALUT', '2020-02-18 13:22:01'),
(35, '5.58', '125.80', 0, '5.6 SR', 0, '196 Km', '200 km BaratLaut MELONGUANE-SULUT', '2020-02-20 16:54:07'),
(36, '-6.85', '129.69', 0, '5.5 SR', 0, '145 Km', '218 km BaratLaut MALUKUTENGGARABRT', '2020-02-21 03:24:29'),
(37, '5.43', '126.15', 0, '5.4 SR', 0, '10 Km', '169 km BaratLaut MELONGUANE-SULUT', '2020-02-22 22:34:47'),
(38, '-0.23', '125.24', 0, '5.3 SR', 0, '10 Km', '130 km Tenggara TUTUYAN-BOLTIM-SULUT', '2020-02-23 09:08:04'),
(39, '-0.27', '125.27', 0, '5.2 SR', 0, '10 Km', '135 km Tenggara TUTUYAN-BOLTIM-SULUT', '2020-02-23 10:39:54'),
(41, '6.1494757', '106.548376', 0, '5.99', 0, '4', 'tanjung lesung', '2020-02-25 00:00:00'),
(42, '-0.27', '125.27', 0, '5.2 SR', 0, '10 Km', '135 km Tenggara TUTUYAN-BOLTIM-SULUT', '2020-02-23 10:39:54'),
(43, '-1.90', '99.92', 0, '5.1 SR', 0, '10 Km', '39 km TimurLaut TUAPEJAT-SUMBAR', '2020-02-25 03:59:23'),
(44, '-7.50', '131.11', 0, '6.7 SR', 0, '28 Km', '56 km BaratLaut MALUKUTENGGARABRT', '2020-02-26 14:33:12'),
(45, '3.73', '125.98', 0, '5.7 SR', 0, '108 Km', '55 km TimurLaut TAHUNA-KEP.SANGIHE-SULUT', '2020-02-28 02:13:04'),
(46, '-4.30', '102.83', 0, '5.3 SR', 0, '122 Km', '19 km BaratLaut BENGKULUSELATAN', '2020-02-28 21:02:53'),
(47, '3.15', '128.11', 0, '5.5 SR', 0, '141 Km', '124 km BaratLaut DARUBA-MALUT', '2020-02-29 16:28:26'),
(48, '-3.58', '99.44', 0, '5.2 SR', 0, '12 Km', '173 km BaratDaya TUAPEJAT-SUMBAR', '2020-03-04 20:36:43'),
(49, '-4.16', '139.55', 0, '5.2 SR', 0, '10 Km', '37 km TimurLaut YAHUKIMO-PAPUA', '2020-03-07 11:37:51'),
(50, '-7.49', '128.76', 0, '5.2 SR', 0, '154 Km', '130 km TimurLaut MALUKUBRTDAYA', '2020-03-07 18:35:26'),
(51, '-6.89', '106.62', 0, '5.0 SR', 0, '10 Km', '13 km TimurLaut KAB-SUKABUMI-JABAR', '2020-03-10 17:18:05'),
(52, '-5.89', '102.85', 0, '5.8 SR', 0, '48 Km', '88 km Tenggara ENGGANO-BENGKULU', '2020-03-10 21:06:28'),
(53, '3.72', '97.09', 0, '5.3 SR', 0, '114 Km', '19 km Tenggara BLANGPIDIE-ACEHBARATDAYA', '2020-03-11 06:08:34'),
(54, '-8.99', '110.60', 0, '5.0 SR', 0, '15 Km', '106 km BaratDaya PACITAN-JATIM', '2020-03-12 15:03:17'),
(55, '-3.01', '138.98', 0, '5.0 SR', 0, '24 Km', '76 km TimurLaut TOLIKARA-PAPUA', '2020-03-13 05:17:00'),
(56, '2.92', '128.14', 0, '5.2 SR', 0, '10 Km', '98 km BaratLaut DARUBA-MALUT', '2020-03-14 17:42:37'),
(57, '-10.72', '118.28', 0, '5.4 SR', 0, '10 Km', '147 km BaratDaya KODI-SUMBABARATDAYA-NTT', '2020-03-16 04:05:32'),
(58, '-1.16', '126.47', 0, '5.0 SR', 0, '10 Km', '109 km TimurLaut SANANA-MALUT', '2020-03-16 17:59:11'),
(59, '3.03', '127.91', 0, '5.5 SR', 0, '76 Km', '117 km BaratLaut DARUBA-MALUT', '2020-03-18 10:13:30'),
(60, '-11.25', '115.09', 0, '6.6 SR', 0, '10 Km', '273 km BaratDaya KUTASELATAN-BALI', '2020-03-19 00:45:37'),
(61, '3.41', '126.48', 0, '5.0 SR', 0, '10 Km', '69 km BaratDaya MELONGUANE-SULUT', '2020-03-20 12:02:06'),
(62, '-2.76', '129.76', 0, '5.1 SR', 0, '14 Km', '89 km BaratLaut SERAMBAGIANTIMUR-MALUKU', '2020-03-20 13:12:40'),
(63, '-5.34', '141.41', 0, '5.2 SR', 0, '91 Km', '126 km TimurLaut BOVENDIGOEL-PAPUA', '2020-03-22 04:19:40'),
(64, '1.46', '122.00', 0, '5.1 SR', 0, '10 Km', '92 km TimurLaut BUOL-SULTENG', '2020-03-22 10:34:55'),
(65, '-2.88', '135.63', 0, '5.2 SR', 0, '15 Km', '71 km BaratLaut NABIRE-PAPUA', '2020-03-22 12:51:47'),
(66, '-10.96', '115.16', 0, '5.2 SR', 0, '10 Km', '240 km BaratDaya KUTASELATAN-BALI', '2020-03-22 13:48:46'),
(67, '-6.12', '130.83', 0, '5.1 SR', 0, '99 Km', '212 km BaratLaut MALUKUTENGGARABRT', '2020-03-23 18:04:34'),
(68, '2.96', '128.12', 0, '5.3 SR', 0, '97 Km', '103 km BaratLaut DARUBA-MALUT', '2020-03-25 09:20:06'),
(69, '-2.73', '139.24', 0, '5.2 SR', 0, '10 Km', '74 km BaratLaut KAB-JAYAPURA-PAPUA', '2020-03-26 13:49:17'),
(70, '5.58', '125.16', 0, '6.3 SR', 0, '10 Km', '221 km BaratLaut TAHUNA-KEP.SANGIHE-SULUT', '2020-03-26 22:38:03'),
(71, '-2.72', '139.26', 0, '5.9 SR', 0, '11 Km', '72 km BaratLaut KAB-JAYAPURA-PAPUA', '2020-03-27 04:36:40'),
(72, '0.28', '133.53', 0, '5.5 SR', 0, '10 Km', '139 km BaratLaut MANOKWARI-PAPUABRT', '2020-03-27 21:32:48'),
(73, '-1.72', '120.14', 0, '5.8 SR', 0, '10 Km', '46 km Tenggara SIGI-SULTENG', '2020-03-28 22:43:17'),
(74, '-7.39', '124.19', 0, '5.2 SR', 0, '631 Km', '108 km BaratLaut ALOR-NTT', '2020-03-29 06:10:35'),
(75, '-7.93', '125.62', 0, '5.5 SR', 0, '10 Km', '125 km TimurLaut ALOR-NTT', '2020-04-02 09:13:13'),
(76, '1.52', '126.46', 0, '6.1 SR', 0, '10 Km', '122 km BaratLaut JAILOLO-MALUT', '2020-04-06 01:37:10'),
(77, '-5.26', '102.40', 0, '5.0 SR', 0, '10 Km', '17 km TimurLaut ENGGANO-BENGKULU', '2020-04-06 05:42:51'),
(78, '-9.48', '112.32', 0, '5.2 SR', 0, '10 Km', '150 km Tenggara KAB-BLITAR-JATIM', '2020-04-07 15:02:59'),
(79, '-1.40', '119.93', 0, '5.1 SR', 0, '10 Km', '5 km Tenggara SIGI-SULTENG', '2020-04-08 10:32:03'),
(80, '2.04', '93.78', 0, '5.0 SR', 0, '10 Km', '291 km BaratDaya SINABANG-ACEH', '2020-04-09 06:15:52'),
(81, '5.46', '126.54', 0, '5.5 SR', 0, '26 Km', '163 km BaratLaut MELONGUANE-SULUT', '2020-04-11 01:45:52'),
(82, '2.39', '127.18', 0, '5.0 SR', 0, '86 Km', '116 km BaratLaut TOBELO-MALUT', '2020-04-12 03:23:48'),
(83, '0.29', '126.82', 0, '5.1 SR', 0, '13 Km', '81 km BaratDaya TERNATE-MALUT', '2020-04-13 21:59:34'),
(84, '3.56', '96.01', 0, '5.0 SR', 0, '11 Km', '66 km BaratDaya MEULABOH-ACEHBARAT', '2020-04-15 02:36:16'),
(85, '1.14', '126.71', 0, '5.8 SR', 0, '13 Km', '83 km BaratLaut TERNATE-MALUT', '2020-04-16 04:03:37'),
(86, '0.38', '125.57', 0, '5.1 SR', 0, '10 Km', '113 km Tenggara RATAHAN-MITRA-SULUT', '2020-04-19 00:45:37'),
(87, '3.90', '126.20', 0, '5.5 SR', 0, '10 Km', '54 km BaratDaya MELONGUANE-SULUT', '2020-04-19 20:09:32'),
(88, '4.51', '126.99', 0, '5.0 SR', 0, '21 Km', '66 km TimurLaut MELONGUANE-SULUT', '2020-04-30 00:47:08'),
(89, '-7.39', '106.71', 0, '5.0 SR', 0, '24 Km', '48 km Tenggara KAB-SUKABUMI-JABAR', '2020-04-30 15:22:00'),
(90, '-2.45', '138.76', 0, '5.0 SR', 0, '54 Km', '49 km Tenggara MAMBERAMOTENGAH-PAPUA', '2020-05-01 04:23:24'),
(91, '4.49', '127.02', 0, '5.2 SR', 0, '48 Km', '66 km TimurLaut MELONGUANE-SULUT', '2020-05-01 20:48:41'),
(92, '1.92', '93.49', 0, '5.0 SR', 0, '10 Km', '325 km BaratDaya SINABANG-ACEH', '2020-05-02 00:10:28'),
(93, '-6.36', '104.67', 0, '5.3 SR', 0, '10 Km', '97 km BaratDaya TANGGAMUS-LAMPUNG', '2020-05-03 14:06:44'),
(94, '-6.95', '130.04', 0, '7.3 SR', 0, '133 Km', '180 km BaratLaut MALUKUTENGGARABRT', '2020-05-06 20:53:57'),
(95, '-7.23', '129.62', 0, '5.1 SR', 0, '184 Km', '204 km BaratLaut MALUKUTENGGARABRT', '2020-05-09 12:49:12'),
(96, '-5.95', '129.85', 0, '5.7 SR', 0, '10 Km', '276 km BaratLaut MALUKUTENGGARABRT', '2020-05-11 08:06:19'),
(97, '4.71', '127.68', 0, '5.0 SR', 0, '43 Km', '136 km TimurLaut MELONGUANE-SULUT', '2020-05-18 11:01:19'),
(98, '-8.14', '107.89', 0, '5.2 SR', 0, '10 Km', '82 km BaratDaya KAB-PANGANDARAN-JABAR', '2020-05-19 17:00:17'),
(99, '5.19', '126.33', 0, '5.3 SR', 0, '70 Km', '137 km BaratLaut MELONGUANE-SULUT', '2020-05-20 19:45:08'),
(100, '-2.39', '99.58', 0, '5.3 SR', 0, '28 Km', '40 km BaratDaya TUAPEJAT-SUMBAR', '2020-05-23 05:36:56'),
(101, '-7.33', '129.26', 0, '5.5 SR', 0, '163 Km', '186 km TimurLaut MALUKUBRTDAYA', '2020-05-23 07:13:39'),
(102, '-8.21', '107.86', 0, '5.1 SR', 0, '13 Km', '90 km BaratDaya KAB-PANGANDARAN-JABAR', '2020-05-24 14:11:40'),
(103, '4.77', '125.54', 0, '5.1 SR', 0, '175 Km', '129 km TimurLaut TAHUNA-KEP.SANGIHE-SULUT', '2020-05-27 14:46:56'),
(104, '-6.22', '130.69', 0, '5.0 SR', 0, '125 Km', '206 km BaratLaut MALUKUTENGGARABRT', '2020-05-28 02:35:54'),
(105, '3.94', '126.71', 0, '5.7 SR', 0, '10 Km', '7 km Tenggara MELONGUANE-SULUT', '2020-05-30 20:06:25'),
(106, '-7.22', '116.96', 0, '6.0 SR', 0, '664 Km', '132 km BaratLaut PULAUSARINGI-NTB', '2020-06-03 22:54:03'),
(107, '2.83', '128.11', 0, '7.1 SR', 0, '112 Km', '89 km BaratLaut DARUBA-MALUT', '2020-06-04 15:49:41'),
(108, '1.26', '126.38', 0, '5.0 SR', 0, '10 Km', '122 km BaratLaut JAILOLO-MALUT', '2020-06-04 20:12:33'),
(109, '1.58', '97.05', 0, '5.1 SR', 0, '27 Km', '38 km BaratLaut NIASUTARA-SUMUT', '2020-06-07 06:50:36'),
(110, '-0.52', '124.30', 0, '5.5 SR', 0, '29 Km', '105 km Tenggara BOLAANGUKI-BOLSEL-SULUT', '2020-06-08 09:34:34'),
(111, '-4.15', '126.39', 0, '6.0 SR', 0, '10 Km', '126 km BaratDaya BURU-MALUKU', '2020-06-09 11:56:11'),
(112, '-2.73', '100.91', 0, '5.7 SR', 0, '24 Km', '28 km BaratDaya MUKOMUKO-BENGKULU', '2020-06-10 11:35:18'),
(113, '-0.81', '122.39', 0, '5.1 SR', 0, '10 Km', '90 km BaratLaut BANGGAIKEP-SULTENG', '2020-06-11 03:01:02'),
(114, '-9.01', '117.91', 0, '5.4 SR', 0, '10 Km', '79 km Tenggara SUMBAWA-NTB', '2020-06-13 16:15:49'),
(115, '-1.81', '137.46', 0, '5.1 SR', 0, '10 Km', '87 km BaratLaut MAMBERAMORAYA-PAPUA', '2020-06-13 23:19:20'),
(116, '-9.15', '124.10', 0, '5.1 SR', 0, '51 Km', '64 km BaratLaut TIMORTENGAHUT-NTT', '2020-06-14 10:35:22'),
(117, '2.67', '128.11', 0, '5.3 SR', 0, '111 Km', '72 km BaratLaut DARUBA-MALUT', '2020-06-14 20:25:26'),
(118, '1.37', '128.04', 0, '5.7 SR', 0, '97 Km', '22 km Tenggara HALMAHERAUTARA-MALUT', '2020-06-15 11:15:44'),
(119, '-2.80', '122.15', 0, '5.0 SR', 0, '10 Km', '29 km Tenggara MOROWALI-SULTENG', '2020-06-16 06:36:32'),
(122, '-2.76', '122.13', 0, '5.0 SR', 0, '10 Km', '26 km Tenggara MOROWALI-SULTENG', '2020-06-17 18:10:22'),
(123, '-9.11', '110.85', 0, '5.0 SR', 0, '63 Km', '107 km BaratDaya PACITAN-JATIM', '2020-06-22 02:33:08'),
(124, '0.03', '123.82', 0, '6.3 SR', 0, '94 Km', '42 km BaratDaya BOLAANGUKI-BOLSEL-SULUT', '2020-06-23 14:43:29'),
(125, '-5.40', '140.93', 0, '5.2 SR', 0, '10 Km', '74 km TimurLaut BOVENDIGOEL-PAPUA', '2020-07-01 08:06:43'),
(126, '-9.29', '112.31', 0, '5.3 SR', 0, '79 Km', '129 km Tenggara KAB-BLITAR-JATIM', '2020-07-05 02:09:22'),
(127, '2.68', '128.21', 0, '5.0 SR', 0, '27 Km', '70 km BaratLaut DARUBA-MALUT', '2020-07-05 12:34:04'),
(128, '-6.12', '110.55', 0, '6.1 SR', 0, '578 Km', '53 km BaratLaut JEPARA-JATENG', '2020-07-07 05:54:44'),
(129, '-6.69', '106.14', 0, '5.4 SR', 0, '82 Km', '18 km BaratDaya RANGKASBITUNG-BANTEN', '2020-07-07 11:44:14'),
(130, '-9.42', '107.27', 0, '5.0 SR', 0, '10 Km', '234 km BaratDaya KAB-PANGANDARAN-JABAR', '2020-07-07 12:17:52'),
(131, '-7.47', '103.02', 0, '5.2 SR', 0, '10 Km', '250 km Tenggara ENGGANO-BENGKULU', '2020-07-07 13:16:22'),
(132, '-5.913848786940', '106.61956787109', 1, '7', 0, '6 KM', '-', '2020-07-07 03:58:54'),
(133, '-7.47', '103.02', 0, '5.2 SR', 0, '10 Km', '250 km Tenggara ENGGANO-BENGKULU', '2020-07-07 13:16:22'),
(134, '1.27', '96.97', 0, '5.0 SR', 0, '14 Km', '47 km BaratDaya NIASUTARA-SUMUT', '2020-07-08 11:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `klim`
--

CREATE TABLE `klim` (
  `no` int(3) NOT NULL,
  `skala` varchar(10) NOT NULL,
  `25m` varchar(10) NOT NULL,
  `75m` varchar(10) NOT NULL,
  `150m` varchar(10) NOT NULL,
  `250m` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klim`
--

INSERT INTO `klim` (`no`, `skala`, `25m`, `75m`, `150m`, `250m`) VALUES
(1, '9', '75', '60', '45', '30'),
(2, '8', '75', '60', '45', '30'),
(3, '7', '50', '40', '30', '20'),
(4, '6', '40', '32', '24', '16'),
(5, '5.5', '30', '24', '18', '12'),
(6, '5.5', '30', '24', '18', '12');

-- --------------------------------------------------------

--
-- Table structure for table `libur_insurance_prod_hari`
--

CREATE TABLE `libur_insurance_prod_hari` (
  `HARI` enum('SENIN','SELASA','RABU','KAMIS','JUMAT','SABTU','MINGGU') NOT NULL,
  `ENTITY_ID` varchar(5) NOT NULL,
  `PROD_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `libur_insurance_prod_tgl`
--

CREATE TABLE `libur_insurance_prod_tgl` (
  `TANGGAL` date NOT NULL,
  `ENTITY_ID` varchar(5) NOT NULL,
  `PROD_ID` varchar(20) NOT NULL,
  `KETERANGAN` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `libur_sistem_hari`
--

CREATE TABLE `libur_sistem_hari` (
  `HARI` enum('SENIN','SELASA','RABU','KAMIS','JUMAT','SABTU','MINGGU') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `libur_sistem_hari`
--

INSERT INTO `libur_sistem_hari` (`HARI`) VALUES
('SABTU'),
('MINGGU');

-- --------------------------------------------------------

--
-- Table structure for table `libur_sistem_tgl`
--

CREATE TABLE `libur_sistem_tgl` (
  `TANGGAL` date NOT NULL,
  `KETERANGAN` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `ID_KEY` int(11) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `ID_KEY_mmt` int(4) DEFAULT NULL,
  `ID_KEY_ma1001` int(11) DEFAULT NULL,
  `ID_KEY_ma1002` int(11) DEFAULT NULL,
  `HTTP_USER_AGENT` varchar(200) NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`ID_KEY`, `EMAIL`, `ID_KEY_mmt`, `ID_KEY_ma1001`, `ID_KEY_ma1002`, `HTTP_USER_AGENT`, `TIMESTAMP`) VALUES
(1, 'hamkafauzan@hotmail.com', NULL, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-10 21:08:25'),
(2, 'designer@biru.io', NULL, NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', '2020-01-11 03:01:29'),
(3, 'hamkafauzan@hotmail.com', NULL, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-13 19:33:34'),
(4, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-15 06:08:31'),
(5, '', NULL, 1, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-15 06:14:36'),
(6, '', NULL, 1, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-15 06:17:55'),
(7, '', NULL, 1, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-15 06:18:56'),
(8, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-15 06:19:05'),
(9, '', 12, NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-16 02:29:35'),
(10, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-16 02:56:18'),
(11, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-17 04:13:14'),
(12, '', NULL, 1, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-17 04:16:40'),
(13, '', 5, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-17 04:21:04'),
(14, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-17 07:43:08'),
(15, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-17 08:06:43'),
(16, '', 5, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-17 08:10:56'),
(17, '', NULL, 1, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-17 08:16:51'),
(18, '', 5, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-20 09:22:56'),
(19, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-22 12:18:26'),
(20, '', NULL, 1, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-22 14:30:24'),
(21, '', 33, NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-22 14:31:42'),
(22, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-22 23:53:11'),
(23, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-22 23:53:12'),
(24, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-22 23:53:12'),
(25, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-22 23:53:20'),
(26, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-23 00:05:37'),
(27, '', NULL, 1, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-23 00:05:41'),
(28, '', NULL, 1, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-23 05:49:46'),
(29, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-23 05:49:54'),
(30, '', 5, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-23 06:20:51'),
(31, '', 5, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-23 06:36:29'),
(32, '', NULL, 1, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', '2020-01-25 05:30:47'),
(33, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-01-26 05:31:44'),
(34, '', NULL, 1, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-01-29 02:54:09'),
(35, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-01-29 02:54:23'),
(36, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-01-29 02:54:28'),
(37, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-01-29 02:55:42'),
(38, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-01-29 03:02:20'),
(39, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-01-29 03:06:14'),
(40, '', 45, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-01-29 14:28:54'),
(41, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-01-29 23:23:37'),
(42, '', 5, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-01-29 23:24:56'),
(43, '', 45, NULL, NULL, 'Mozilla/5.0 (Linux; Android 10; Pixel XL) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.136 Mobile Safari/537.36', '2020-01-30 13:38:20'),
(44, '', 45, NULL, NULL, 'Mozilla/5.0 (Linux; Android 10; Pixel XL) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.136 Mobile Safari/537.36', '2020-01-30 13:55:10'),
(45, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-01 10:58:12'),
(46, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-04 04:13:44'),
(47, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-05 14:12:23'),
(48, '', 12, NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-05 14:14:53'),
(49, '', NULL, 2, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-05 14:17:40'),
(50, '', 12, NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-05 14:18:08'),
(51, '', 12, NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-05 14:18:22'),
(52, '', NULL, 2, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-05 14:32:30'),
(53, '', 12, NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-05 14:33:39'),
(54, '', NULL, 2, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-05 14:34:59'),
(55, '', 12, NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-05 14:35:25'),
(56, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-05 14:38:17'),
(57, '', NULL, 4, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-05 14:42:03'),
(58, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-07 06:54:47'),
(59, '', NULL, 2, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', '2020-02-10 04:10:09'),
(60, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', '2020-02-10 04:10:34'),
(61, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', '2020-02-10 05:51:43'),
(62, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', '2020-02-10 05:52:08'),
(63, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', '2020-02-10 08:48:36'),
(64, '', 42, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', '2020-02-10 13:27:46'),
(65, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-14 14:16:32'),
(66, '', 5, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-14 14:21:53'),
(67, '', NULL, 2, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-14 14:35:55'),
(68, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-14 14:49:41'),
(69, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', '2020-02-14 22:48:56'),
(70, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', '2020-02-14 22:49:06'),
(71, '', NULL, 2, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', '2020-02-15 00:44:42'),
(72, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', '2020-02-15 00:44:58'),
(73, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', '2020-02-15 00:47:57'),
(74, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', '2020-02-15 00:48:11'),
(75, '', NULL, 2, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', '2020-02-15 00:51:13'),
(76, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', '2020-02-15 00:51:24'),
(77, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36', '2020-02-15 03:44:14'),
(78, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36', '2020-02-15 04:00:38'),
(79, '', NULL, 2, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-15 04:03:40'),
(80, '', NULL, 2, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-17 06:59:34'),
(81, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36', '2020-02-17 07:03:49'),
(82, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36', '2020-02-17 07:05:28'),
(83, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-17 07:10:47'),
(84, '', 52, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36', '2020-02-18 03:09:34'),
(85, '', 53, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-19 03:33:28'),
(86, '', 5, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-20 02:40:02'),
(87, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-20 03:15:53'),
(88, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-20 03:19:51'),
(89, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-20 03:23:11'),
(90, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-20 03:25:30'),
(91, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-22 00:14:29'),
(92, '', NULL, 2, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-23 01:11:19'),
(93, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-23 01:11:27'),
(94, '', 33, NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-23 13:20:39'),
(95, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-23 13:35:09'),
(96, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-24 01:23:43'),
(97, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-24 06:21:14'),
(98, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-24 10:47:00'),
(99, '', 5, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-24 10:51:13'),
(100, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-24 15:29:56'),
(101, '', 5, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-24 15:31:51'),
(102, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-24 16:05:19'),
(103, '', NULL, 2, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-25 01:25:01'),
(104, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-25 02:39:34'),
(105, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-25 02:43:36'),
(106, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-25 02:44:58'),
(107, '', NULL, 2, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-25 02:45:05'),
(108, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-25 06:10:20'),
(109, '', 55, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-25 07:00:34'),
(110, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-25 08:44:40'),
(111, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-25 08:59:11'),
(112, '', 58, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', '2020-02-25 09:08:03'),
(113, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36', '2020-02-26 04:15:22'),
(114, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36', '2020-02-26 04:22:18'),
(115, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-26 04:25:12'),
(116, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36', '2020-02-26 04:36:53'),
(117, '', NULL, 4, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-26 04:59:42'),
(118, '', 12, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', '2020-02-26 05:02:13');

-- --------------------------------------------------------

--
-- Table structure for table `ma0001`
--

CREATE TABLE `ma0001` (
  `CLI_SYSTEM_ID` int(11) NOT NULL,
  `CLI_USER_ID` varchar(30) NOT NULL,
  `CLI_GROUP` varchar(12) NOT NULL COMMENT 'entity id',
  `CABANG_KEY` int(11) DEFAULT NULL,
  `CLI_PHONE` varchar(15) NOT NULL,
  `CLI_EMAIL` varchar(50) NOT NULL,
  `CLI_PASSWORD` varchar(50) NOT NULL,
  `CLI_ERROR` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ma0001`
--

INSERT INTO `ma0001` (`CLI_SYSTEM_ID`, `CLI_USER_ID`, `CLI_GROUP`, `CABANG_KEY`, `CLI_PHONE`, `CLI_EMAIL`, `CLI_PASSWORD`, `CLI_ERROR`) VALUES
(1, 'biru', 'EN000', NULL, '', '', '12345', 0),
(2, 'perusahaan2', 'EN123', NULL, '', 'perusahaan2@perusahaan.com', '12345', 0),
(3, 'perusahaan', 'EN011', NULL, '', 'perusahaan@perusahaan.com', '12345', 0),
(4, 'perusahaan3', 'EN012', NULL, '', 'perusahaan3@perusahaan.com', '12345', 0),
(5, 'perusahaan4', 'EN222', NULL, '', 'perusahaan4@perusahaan.com', '12345', 0),
(6, 'perusahaan5', 'PR333', NULL, '', 'perusahaan5@perusahaan.com', '12345', 0),
(70, 'adira', 'adira', NULL, '08128888899', 'admin@adira.com', '12345', 0),
(71, 'Askrida', 'Askrida', NULL, '08128174689', 'admin@insurance.com', '12345', 0),
(72, 'ahmadi', 'ahmadi', NULL, '', 'ahmad1@gmail.com', '123', 0),
(73, 'ahmad', 'ahmad', NULL, '', 'ahmad@gmail.com', '12345', 0),
(74, 'boim', 'boim', NULL, '', 'boim@gmail.com', '12345', 0),
(75, 'baskara8', 'baskara8', NULL, '', 'brockbask@gmail.com', 'Ganteng8', 0),
(76, 'budi', 'budi', NULL, '', 'budi@biru.io', '12345', 0),
(77, 'candra', 'candra', NULL, '', 'candrarobiansyah@gmail.com', 'sukemianto3', 0),
(78, 'Delil Khairat', 'Delil Khaira', NULL, '', 'delil.khairat@gmail.com', 'Idawati1', 0),
(79, 'delil', 'delil', NULL, '', 'delil.khoirot@gmail.com', '12345', 0),
(80, 'designer', 'designer', NULL, '', 'designer@biru.io', '12345', 0),
(81, 'UserTest', 'UserTest', NULL, '', 'dirwan2009@google.com', 'Ini2009aja3', 0),
(82, 'gemblunk', 'gemblunk', NULL, '', 'gemblunk@gmail.com', '12345', 0),
(83, 'pribadi', 'pribadi', NULL, '', 'hamka@indonesiasoftware.com', '12345', 0),
(84, 'joko', 'joko', NULL, '', 'hamkafauzan2@hotmail.com', '123456', 0),
(85, 'hamka', 'hamka', NULL, '08128174689', 'hamkafauzan@hotmail.com', '12345', 0),
(86, 'makruf', 'makruf', NULL, '08128174689', 'hamkafz@gmail.com', '12345', 0),
(87, 'bento', 'bento', NULL, '', 'hamkafzn@gmail.com', '12345', 0),
(88, 'aa gym', 'aa gym', NULL, '', 'ibet12@geraidinar.com', '1234', 0),
(89, 'jojon', 'jojon', NULL, '', 'jojon@biru.io', '12345', 0),
(90, 'jokowi', 'jokowi', NULL, '', 'jokowi@gmail.com', '12345', 0),
(91, 'jamil', 'jamil', NULL, '', 'muhamad.jamil@birurisk.com', 'Biru123', 0),
(92, 'prasetyo', 'prasetyo', NULL, '', 'prasetyo@yahoo.com', 'H3NMRfgZV3tE9LT', 0),
(93, 'Nur ardi', 'Nur ardi', NULL, '', 'ptiikub@gmail.com', 'sukemianto3', 0),
(94, 'ramayurindra', 'ramayurindra', NULL, '', 'ramayurindra.hj@gmail.com', 'Kemalasari73', 0),
(119, 'cabang1', 'EN222', 6, '', 'cabang1@perusahaan.com', '12345', 0),
(120, 'cabang2', 'EN222', 4, '', 'cabang2@perusahaan.com', '12345', 0),
(123, 'dummy', 'EN222', 4, '', 'dummy@', 'dummy', 0),
(124, 'dummy2', 'dummy2', NULL, '', 'dummy2@dummy.com', 'dummy', 0),
(125, 'mdf85', 'mdf85', NULL, '', 'daffa.zaki@gmail.com', 'narutora85!?', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ma0002`
--

CREATE TABLE `ma0002` (
  `ID_KEY` int(11) NOT NULL,
  `CLI_SYSTEM_ID` int(11) NOT NULL,
  `CLI_BANK_VC` varchar(100) NOT NULL,
  `BAL_TYPE` char(3) NOT NULL DEFAULT '00' COMMENT '00 : Saldo, 01 : Utang',
  `BAL_OS_DATE` datetime DEFAULT NULL COMMENT 'Mandatory jika BAL_TYPE=01',
  `BAL_OS_DUE` date DEFAULT NULL COMMENT 'BAL_OS_DUE',
  `BAL_CURR_ID` char(3) NOT NULL COMMENT 'Satuan (BRU/IDR/USD)',
  `BAL_CURRENT` double NOT NULL COMMENT 'Saldo/Utang',
  `utang` double NOT NULL DEFAULT '0',
  `piutang` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ma0002`
--

INSERT INTO `ma0002` (`ID_KEY`, `CLI_SYSTEM_ID`, `CLI_BANK_VC`, `BAL_TYPE`, `BAL_OS_DATE`, `BAL_OS_DUE`, `BAL_CURR_ID`, `BAL_CURRENT`, `utang`, `piutang`) VALUES
(1, 0, '00', '00', NULL, NULL, 'IDR', 60000, 0, 0),
(2, 1, '00', '00', NULL, NULL, 'IDR', 61820.29090909091, 0, 0),
(3, 2, '00', '00', NULL, NULL, 'IDR', 70954.4727272727, 0, 0),
(4, 4, '00', '01', '2020-02-25 09:42:26', NULL, 'IDR', 104622, 72000, 0),
(5, 6, '00', '00', NULL, NULL, 'IDR', 60203.23636363636, 0, 0),
(6, 4, '00', '00', NULL, NULL, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ma0003`
--

CREATE TABLE `ma0003` (
  `CLI_SYSTEM_ID` varchar(12) NOT NULL,
  `CLI_NAME` varchar(100) DEFAULT NULL,
  `CLI_KTP_NO` varchar(100) DEFAULT NULL,
  `CLI_ADDRESS` varchar(200) DEFAULT NULL,
  `CLI_KODE_POS` varchar(15) DEFAULT NULL,
  `KELURAHAN_ID` varchar(15) DEFAULT NULL,
  `CLI_NPWP` varchar(100) DEFAULT NULL,
  `CLI_BIRTH_PLACE` varchar(100) DEFAULT NULL,
  `CLI_BIRTH_DATE` date DEFAULT NULL,
  `CLI_SUMBER_DANA` varchar(100) DEFAULT NULL,
  `CLI_STATUS` int(11) NOT NULL DEFAULT '0' COMMENT '0 : New, 1: Aktif, 2: Suspend, 3: Blocked',
  `CLI_VALIDASI_AKUN` varchar(100) NOT NULL,
  `CLI_REKENING_BANK` varchar(20) DEFAULT NULL,
  `CLI_REKENING_NO` varchar(50) DEFAULT NULL,
  `CLI_REKENING_NAMA` varchar(50) DEFAULT NULL,
  `CLI_BANK_VC` varchar(100) DEFAULT NULL,
  `CLI_BLOCK_ADDR` varchar(100) DEFAULT NULL,
  `CLI_BLOCK_PKEY` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ma0003`
--

INSERT INTO `ma0003` (`CLI_SYSTEM_ID`, `CLI_NAME`, `CLI_KTP_NO`, `CLI_ADDRESS`, `CLI_KODE_POS`, `KELURAHAN_ID`, `CLI_NPWP`, `CLI_BIRTH_PLACE`, `CLI_BIRTH_DATE`, `CLI_SUMBER_DANA`, `CLI_STATUS`, `CLI_VALIDASI_AKUN`, `CLI_REKENING_BANK`, `CLI_REKENING_NO`, `CLI_REKENING_NAMA`, `CLI_BANK_VC`, `CLI_BLOCK_ADDR`, `CLI_BLOCK_PKEY`) VALUES
('124', 'dummy', '22222222222222', 'Alamat', '32424234', '3276040010', '', 'NGANJUK', '1968-03-04', 'Gaji', 1, '', 'BNI', '32432423432', 'dummy', '', '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0x35eac9c4d53bb7dd885c4d2b4f30cbe8cc0586eccff1ede27af3722bf26c8999'),
('125', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '-', NULL, NULL, NULL, NULL, 'undefined', 'undefined'),
('70', 'adira', '0', 'jl Sudirman 43 Jakarta', NULL, '0', '434345353', '', '0000-00-00', '', 1, '', '00', '', '', '', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xeff47b83519b4fa1778c6ce95249cea1b540d3885e6c1c29f300edda6976bc96'),
('71', 'Askrida', '0', 'Jl Juanda 43 Depok', NULL, '0', '00090989878', '', '0000-00-00', '', 1, '', '00', '', '', '', '0xeFe9952aA6Ae5bbFda77afd9Cd2fc1Bd138D5712', '0x36f4f6cda7e697f15f3e4c5753d070bc3476d2264d9a2b2d'),
('72', 'ahmadi', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0xd0e9735A65D7b2873BE913A7299f448Bcb518C5b', '0x30a897915f51dcade7dcbe39d237eb85549e2f9da11985e0'),
('73', 'ahmad', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0x457d133F6754dcbAd79C1C16C62C5348b07D235c', '0x77323786aca6315df96397352bd3ca0393c76c7eb8452b95'),
('74', 'boim', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0x3De636240c062d230a0d57667965758021E3C3A4', '0xc0b9aa9988afe2f2a48ef3b7bdb96f83770df0ab17140875a9d5bea586ea7ab8'),
('75', 'baskara8', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0x5220C092a867371b788aEa5e0c1BFDC895f5C93B', '0x985a23d4ca63f3e379ec3bdd7b0bf60e7ea029e0037cda3ad48063bff4871eb2'),
('76', 'budi', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0xA7B07aBE0E1b95D830c01C8F4725722A62676451', '0x745aff640a7c4ef129ff0527e060089b94a95c9697058d4dcaa42f33b8162038'),
('77', 'candra', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0xb7a6bCbC894D208A054125Ae5890c242D4188c70', '0xcef72dbb5a7542cb51594bea245c3aab11dd6f5c25de42b6d16c4e6d0eb0e1aa'),
('78', 'Delil Khairat', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0x60D97Ea636A9ADa61914E30f88d86514217660BA', '0x0a7faf0bc3b0de408198be9ba0e35e6c1de2724060de9f646e1e1fb9a4ee22c8'),
('79', 'delil', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0x0bbAAa2eA4eE0dAf322C57Faa33A2AB8C702dECF', '0xeb99f3d1abe79a27ee4b8f899e51a18fb3a0da90110f3a0de71b708e9c38a19c'),
('80', 'designer', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0x1920C29e2ecD6Daa8541f1487389D280dC432644', '0x0c1ce2c257f481c25297a3070436916c50f7dff2283de1707ce431d8e157985d'),
('81', 'UserTest', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0xaEBd0e7b48f312850Ee9034Aa4D7143D87D2726D', '0x359a999b919d854f2a16a0d58525761affa8a2d2c40b0b484cdda92394f5477e'),
('82', 'gemblunk', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0xaFf2eb6DC4Ee6C89E26Eff3Ee34E579EC6eEd787', '0x6d962943353aedd06e5e56971c314f178275a63b47c19684e0236af150db45d3'),
('83', 'pribadi', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0x8EE6CE8940D9F2dE82865f015803BBB1073061A7', '0x9ebab6cd2924e1ceb978421e8eb9030b5cee6851abcd5e26'),
('84', 'joko', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0xE29fA19Dc14d213f01DE1466bA3EE6fE56645c3e', '0x8273c6b880b2e2e20605ba1c520eac8f1d8da48fbff9d58f'),
('85', 'HAMKA', '3201021212690015', 'TUGU INDAH', '32424234', '3276040012', '', 'NGANJUK', '1968-03-04', 'Gaji', 1, '', 'BNI', '32432423432', 'HAMKA', '', '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0x35eac9c4d53bb7dd885c4d2b4f30cbe8cc0586eccff1ede27af3722bf26c8999'),
('86', 'makruf', '0', 'Jl gatot subroto 23', NULL, '0', '11122223333', '', '0000-00-00', '', 1, '', '00', '', '', '', '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', '0x438baa7a067d3062dd784938140846a2b13fafe2357645f7'),
('87', 'bento', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0x948362bFA34144571e37272C6084FB9136a502Da', '0x84930122f1a4d23036e6371cd8bdea99987a5bd2ea36cab6'),
('88', 'aa gym', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0xDE622992b4bbc64EB3a2e9F192038974619D9D6f', '0x2a757e3ccc1bc0a830f08fe78ff65ad50750ecec171ae135'),
('89', 'jojon', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0xE6C420c6d8725931dFb68BadeF23dd04576aa5BF', '0x6c0acfed85ee627e54cfe070418acad31d461dae640b1577ff85ace1cf1735d3'),
('90', 'jokowi', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0x32b0c28d4FC3066dd6659c88c0a949B2dDbb06fB', '0x9506f8daf1c7d14ce4fcf088dacd7da49af53598e1848a535400f30b651b8935'),
('91', 'jamil', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0x7F7d04C6D0901bA28f29CA9Ea55f22A410f6AeE9', '0xb4f40f56f1102e356424d65acc1cfeaf277c075ead1d9672ec4d34dff7593b80'),
('92', 'prasetyo', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0x570bfB7D7A4F1aa0de7D5DFe2f11872291769d81', '0xb4ae54fc1fc22dbc443a5d0c96d870d728216d0f168abce5547afb5335bd1215'),
('93', 'Nur ardi', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0x58E5A645831a7917DB8669D24d8E3bBB727719b9', '0x62cc7d7b5fb4bf1a37cabc7f6d715cb13e159f23ec5aac31952f5c328a95bbb3'),
('94', 'ramayurindra', '0', '', NULL, '0', '', '', '0000-00-00', '', 1, '', '00', '', '', '', '0xc5F4ed54e97bEE72e0551236B231DE1866288061', '0xd20f051220560fe5c3a7be8e9b70b130b9ae39be6d8f0031eff5d8d1459936be');

-- --------------------------------------------------------

--
-- Table structure for table `ma0004`
--

CREATE TABLE `ma0004` (
  `OBJEK_SYSTEM_ID` int(11) NOT NULL,
  `CLI_SYSTEM_ID` int(11) NOT NULL,
  `OBJEK_NOP` varchar(18) NOT NULL,
  `OBJEK_KELURAHAN_ID` varchar(15) NOT NULL,
  `OBJEK_KELURAHAN_LAT` varchar(20) NOT NULL,
  `OBJEK_KELURAHAN_LNG` varchar(20) NOT NULL,
  `OBJEK_ALAMAT` text NOT NULL,
  `OBJEK_NAMA_WAJIB_PAJAK` varchar(100) NOT NULL,
  `OBJEK_ALAMAT_WAJIB_PAJAK` text NOT NULL,
  `OBJEK_SCAN_SPPT` text NOT NULL,
  `OBJEK_STATUS` int(11) NOT NULL DEFAULT '0' COMMENT '0:aktif belum bayar, 1: aktif transaksi, 2: non aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ma0004`
--

INSERT INTO `ma0004` (`OBJEK_SYSTEM_ID`, `CLI_SYSTEM_ID`, `OBJEK_NOP`, `OBJEK_KELURAHAN_ID`, `OBJEK_KELURAHAN_LAT`, `OBJEK_KELURAHAN_LNG`, `OBJEK_ALAMAT`, `OBJEK_NAMA_WAJIB_PAJAK`, `OBJEK_ALAMAT_WAJIB_PAJAK`, `OBJEK_SCAN_SPPT`, `OBJEK_STATUS`) VALUES
(1, 85, '310101000322222222', '3101010003', '-5.9775015', '106.7072474', 'a', 'a', 'a', '../unggah/b2c/85/SCAN_PBB_accumulating1.jpg', 0),
(2, 85, '310101000222233333', '3101010002', '-5.9074328', '106.5863989', 'Eaque eius accusanti', 'Voluptatem sit aliqu', 'Ex ea minus quisquam', '../unggah/b2c/85/SCAN_PBB_36542.jpg', 0),
(3, 85, '327604001223422444', '3276040012', '-6.3621916', '106.8502879', 'tugu indah', 'hamka 2', 'tugu indah', '../unggah/b2c/85/SCAN_PBB_ARBANGIN.jpg', 0),
(4, 85, '327604001222222444', '3276040012', '-6.3621916', '106.8502879', 'test', 'coba prod', 'test', '../unggah/b2c/85/SCAN_PBB_coba.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ma1001`
--

CREATE TABLE `ma1001` (
  `ID_KEY` bigint(20) NOT NULL COMMENT 'Primary. Autoincreament',
  `ENTITY_ID` varchar(5) NOT NULL COMMENT 'Unik. Kode Entiti',
  `ENTITY_NAMA` varchar(100) NOT NULL COMMENT 'NamaPerusahaan',
  `ENTITY_ALAMAT` varchar(200) NOT NULL COMMENT 'Alamat',
  `ENTITY_PIC` varchar(100) NOT NULL COMMENT 'Nama PIC',
  `ENTITY_PIC_PHONE` varchar(50) NOT NULL COMMENT 'Telp PIC',
  `ENTITY_EMAIL` varchar(50) NOT NULL COMMENT 'Email PIC',
  `ENTITY_JOINT` date NOT NULL COMMENT 'Tanggal bergabung',
  `ENTITY_EXPIRY` date NOT NULL COMMENT 'Tanggal Kadaluarsa',
  `ENTITY_STATUS` int(2) NOT NULL COMMENT '0 : Active, 1: Test, 2: Discontinue. (default 0)',
  `ENTITY_VC` varchar(100) NOT NULL,
  `ENTITY_MOU` varchar(50) NOT NULL COMMENT 'MOU Perjanjian dengan BIRU',
  `ENTITY_NPWP` varchar(20) NOT NULL COMMENT 'NPWP',
  `ENTITY_BLOCK_ADDR` varchar(100) NOT NULL,
  `ENTITY_BLOCK_PKEY` varchar(100) NOT NULL,
  `ENTITY_BANK_NO` varchar(50) NOT NULL,
  `ENTITY_BANK` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ma1001`
--

INSERT INTO `ma1001` (`ID_KEY`, `ENTITY_ID`, `ENTITY_NAMA`, `ENTITY_ALAMAT`, `ENTITY_PIC`, `ENTITY_PIC_PHONE`, `ENTITY_EMAIL`, `ENTITY_JOINT`, `ENTITY_EXPIRY`, `ENTITY_STATUS`, `ENTITY_VC`, `ENTITY_MOU`, `ENTITY_NPWP`, `ENTITY_BLOCK_ADDR`, `ENTITY_BLOCK_PKEY`, `ENTITY_BANK_NO`, `ENTITY_BANK`) VALUES
(1, 'EN000', 'BIRU', '-', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', '', '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0x35eac9c4d53bb7dd885c4d2b4f30cbe8cc0586eccff1ede27af3722bf26c8999', '', ''),
(2, 'EN123', 'Broker ABC', 'Jl. hh', 'ABCD', '1111', 'perusahaan2@perusahaan.com', '2019-12-29', '2019-12-29', 0, '', '112223/23/2018', '1234', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xeff47b83519b4fa1778c6ce95249cea1b540d3885e6c1c29f300edda6976bc96', '', ''),
(3, 'EN011', 'Reasuransi TRD', 'Jl. ABCD', 'ABCDE', '08012345', 'perusahaan@perusahaan.com', '2019-12-20', '2019-12-31', 0, '', '112223/23/2018', '12412321', '0xeFe9952aA6Ae5bbFda77afd9Cd2fc1Bd138D5712', '0x36f4f6cda7e697f15f3e4c5753d070bc3476d2264d9a2b2d', '', ''),
(4, 'EN012', 'Asuransi RDF', 'TEst', 'ABCD', '081123123123', 'perusahaan3@perusahaan.com', '2020-01-31', '2020-02-02', 0, '', '112223/23/2018', '1234', '0x2e3FD56617E214A8576AfC6208D25494719ad4f7', '0x94137e5218b545e087f0075f0c606469dd8c9113b1ba9dadbc4d40269fb882a3', '', ''),
(5, 'EN222', 'PT. Askrindo syariah', '-', 'ABCD', '085789814068', 'perusahaan4@perusahaan.com', '2020-02-23', '2020-02-29', 0, '', '112223/23/2018', '123456', '0x17221E6440fe74Cd653e42F51a48297c17ED397a', '0x00c6dca91b0903e05f4172e63d9ca5857e6be34a40ae758af1586c1fcb3902c0', '', ''),
(6, 'PR333', 'Asuransi SHU', '-', 'ABCD', '080808080808', 'perusahaan5@perusahaan.com', '2020-02-23', '2020-02-29', 0, '', '112223/23/2018', '1234', '0xc75d3779254112C454Ed045378Cc95F5bABda2DF', '0xd430cd9687c305177b56846d7897cc1a5e5a2dcbb005e8974e7138b40f00c695', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ma1002`
--

CREATE TABLE `ma1002` (
  `ID_KEY` int(11) NOT NULL COMMENT 'Tabel Karyawan Entity',
  `ENTITY_ID` varchar(5) NOT NULL COMMENT 'Dari Perusahaan',
  `KARYAWAN_ID` varchar(12) NOT NULL,
  `KARYAWAN_EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ma1003`
--

CREATE TABLE `ma1003` (
  `ID_KEY` bigint(20) NOT NULL COMMENT 'Tabel Product (Child, Cabang dan Zona)',
  `ENTITY_ID` varchar(5) NOT NULL COMMENT 'Perusahaan pemilik produk',
  `PROD_ID` varchar(20) NOT NULL,
  `LOKASI_ID` varchar(12) NOT NULL COMMENT 'Kode Cabang',
  `LOKASI_PROVINSI` varchar(100) NOT NULL,
  `LOKASI_KABUPATEN` varchar(100) NOT NULL,
  `LOKASI_KECAMATAN` varchar(100) NOT NULL,
  `LOKASI_KELURAHAN` varchar(100) NOT NULL,
  `LOKASI_NAMA` varchar(100) NOT NULL COMMENT 'Nama Cabang',
  `LOKASI_STATUS` int(2) NOT NULL DEFAULT '0' COMMENT '0 : Active, 1: Suspended, 2: Closed (default 0)',
  `lat` varchar(20) NOT NULL,
  `lng` varchar(20) NOT NULL,
  `BANK_REKENING` varchar(20) NOT NULL,
  `NO_REKENING` varchar(50) NOT NULL,
  `NAMA_REKENING` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ma1003`
--

INSERT INTO `ma1003` (`ID_KEY`, `ENTITY_ID`, `PROD_ID`, `LOKASI_ID`, `LOKASI_PROVINSI`, `LOKASI_KABUPATEN`, `LOKASI_KECAMATAN`, `LOKASI_KELURAHAN`, `LOKASI_NAMA`, `LOKASI_STATUS`, `lat`, `lng`, `BANK_REKENING`, `NO_REKENING`, `NAMA_REKENING`) VALUES
(4, 'EN222', 'PR002', 'C1', '31', '3101', '3101010', '3101010003', 'Pulau Untung Jawa (I)', 0, '-5.979027899348837', '106.70675575733186', 'BNI', '1119999', 'Pulau Untung Jawa (I)'),
(6, 'EN222', 'PR002', 'C2', '31', '3101', '3101010', '3101010001', 'Pulau Tidung (I)', 0, '-5.8032053', '106.5237907', 'BNI', '2228888', 'Pulau Tidung (I)');

-- --------------------------------------------------------

--
-- Table structure for table `ma2001`
--

CREATE TABLE `ma2001` (
  `ID_KEY` bigint(20) NOT NULL COMMENT 'Tabel Product (Parent)',
  `PROD_ID` varchar(20) NOT NULL COMMENT 'Kode Produk',
  `PROD_NAMA` varchar(50) NOT NULL COMMENT 'Nama Produk',
  `PROD_LEGAL` varchar(50) NOT NULL COMMENT 'Dasar hukum Produk//PKS/MOU',
  `PROD_STATUS` int(2) NOT NULL DEFAULT '0' COMMENT '0 : Active, 1: Suspended, 2: Closed (default 0)',
  `PROD_LEVEL` int(1) NOT NULL DEFAULT '0' COMMENT '0 : Main (M), 1: Sub (S)',
  `PROD_CURR` varchar(3) NOT NULL COMMENT 'M',
  `DANA_IN_VA_NAMA` varchar(100) DEFAULT NULL COMMENT 'M',
  `DANA_IN_VA_NO` varchar(50) DEFAULT NULL COMMENT 'M',
  `DANA_IN_VA_BANK` varchar(20) DEFAULT NULL COMMENT 'M',
  `DANA_OUT_VA_NAMA` varchar(100) DEFAULT NULL COMMENT 'M',
  `DANA_OUT_VA_NO` varchar(50) DEFAULT NULL COMMENT 'M',
  `DANA_OUT_VA_BANK` varchar(20) DEFAULT NULL COMMENT 'M',
  `PROD_B2C` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'M | is this b2c?',
  `PROD_MIN_TSI` double DEFAULT NULL COMMENT 'M | if b2c, Nilai minimal pertanggungan',
  `PROD_MAX_TSI` double DEFAULT NULL COMMENT 'M | if b2c, Nilai maksimal pertanggungan',
  `PROD_STEP_TSI` double DEFAULT NULL COMMENT 'M | if b2c, Nilai kelipatan pertanggungan',
  `PROD_ID_PARENT` varchar(20) DEFAULT NULL COMMENT 'S',
  `PROD_TYPE` enum('dca eq','kematian','normal') DEFAULT NULL COMMENT 'S',
  `CLAIM_TYPE` int(11) DEFAULT NULL COMMENT '0: Terikat, 1: Bebas(Menjadikan Sub Produk lain tidak bisa diklaim)	',
  `PROD_PREMI` double NOT NULL DEFAULT '0' COMMENT 'S',
  `PROD_AUTOP` int(2) NOT NULL COMMENT '0: Auto Payment, 1: Manual Payment'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ma2001`
--

INSERT INTO `ma2001` (`ID_KEY`, `PROD_ID`, `PROD_NAMA`, `PROD_LEGAL`, `PROD_STATUS`, `PROD_LEVEL`, `PROD_CURR`, `DANA_IN_VA_NAMA`, `DANA_IN_VA_NO`, `DANA_IN_VA_BANK`, `DANA_OUT_VA_NAMA`, `DANA_OUT_VA_NO`, `DANA_OUT_VA_BANK`, `PROD_B2C`, `PROD_MIN_TSI`, `PROD_MAX_TSI`, `PROD_STEP_TSI`, `PROD_ID_PARENT`, `PROD_TYPE`, `CLAIM_TYPE`, `PROD_PREMI`, `PROD_AUTOP`) VALUES
(1, 'PR123', 'DCA', '112223/23/2018', 0, 0, 'IDR', 'PT. AAD, PT. RS', '3434', 'BNI', NULL, NULL, NULL, 1, 40, 90, 5, NULL, NULL, NULL, 0, 1),
(3, 'PR124', 'DCA', '112223/23/2018', 0, 1, 'IDR', NULL, NULL, NULL, NULL, '9853', 'BNI', 0, NULL, NULL, NULL, 'PR0022', 'dca eq', 0, 0.18, 1),
(15, 'PR003', 'GEMPA', '112223/23/2018', 0, 1, 'IDR', NULL, NULL, NULL, NULL, '3434', 'BNI', 0, NULL, NULL, NULL, 'PR123', 'dca eq', 0, 0.18, 1),
(17, 'PR005', 'PROD 003', '112223/23/2018', 0, 1, 'IDR', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 'kematian', 1, 2, 1),
(26, 'PR0022', 'testing', '112223/23/2018', 0, 0, 'IDR', 'Broker ABC', '86', 'BNI', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1),
(37, 'SU001', 'INS01', '112223/23/2018', 0, 1, 'IDR', NULL, NULL, NULL, NULL, '111', 'BNI', 0, NULL, NULL, NULL, NULL, 'kematian', 1, 0.28, 1),
(39, 'PR009', 'AJK', '112223/23/2018', 0, 1, 'IDR', NULL, NULL, NULL, NULL, '3434', 'BNI', 0, NULL, NULL, NULL, 'PR0022', 'kematian', 1, 0.28, 1),
(40, 'PR002', 'Mekaar', '112223/23/2018', 0, 0, 'IDR', 'Broker ABC', '4343', 'BNI', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1),
(41, 'PR112', 'DCA', '112223/23/2018', 0, 1, 'IDR', NULL, NULL, NULL, NULL, '888888', 'BNI', 0, NULL, NULL, NULL, 'PR002', 'dca eq', 0, 1, 1),
(42, 'PR113', 'AJK', '112223/23/2018', 0, 1, 'IDR', NULL, NULL, NULL, NULL, '3434', 'BNI', 0, NULL, NULL, NULL, 'PR002', 'normal', 1, 1.25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma2002`
--

CREATE TABLE `ma2002` (
  `ID_KEY` bigint(20) NOT NULL COMMENT 'Tabel Product (Child, detail produk)',
  `PROD_ID` varchar(20) NOT NULL COMMENT 'Kode Produk',
  `SHA_RISK` double NOT NULL COMMENT 'Nilai pembagian',
  `SHA_NUM` double NOT NULL DEFAULT '0',
  `SHA_NUM_BACKER` varchar(5) DEFAULT NULL,
  `SHA_TAX` varchar(1) NOT NULL COMMENT 'Hitung PPN, default ''y''',
  `SHA_WITH` varchar(1) NOT NULL COMMENT 'Hitung witholding, default ''Y''',
  `SHA_STATUS` int(2) NOT NULL COMMENT '0 : Active, 1: Suspended',
  `SHA_ENTITY` varchar(5) NOT NULL COMMENT 'Pihak yang terlibat dalam bisnis',
  `SHA_ENTITY_LEVEL` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ma2002`
--

INSERT INTO `ma2002` (`ID_KEY`, `PROD_ID`, `SHA_RISK`, `SHA_NUM`, `SHA_NUM_BACKER`, `SHA_TAX`, `SHA_WITH`, `SHA_STATUS`, `SHA_ENTITY`, `SHA_ENTITY_LEVEL`) VALUES
(9, 'PR124', 65, 0, NULL, 'y', 'y', 0, 'EN123', NULL),
(11, 'PR124', 35, 0, NULL, 'y', 'n', 0, 'EN011', 0),
(27, 'PR124', 0, 5, 'EN011', 'y', 'y', 0, 'EN000', NULL),
(35, 'PR124', 0, 0, NULL, 'y', 'y', 0, 'EN222', NULL),
(37, 'PR003', 20, 0, NULL, 'y', 'y', 0, 'EN123', 0),
(38, 'PR003', 20, 0, NULL, 'n', 'n', 0, 'EN011', NULL),
(39, 'PR003', 12, 0, NULL, 'n', 'n', 0, 'EN222', NULL),
(40, 'PR003', 48, 0, NULL, 'n', 'n', 0, 'EN012', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ma2003`
--

CREATE TABLE `ma2003` (
  `SHA_SYSTEM_ID` int(11) NOT NULL COMMENT 'Tabel Rules (Parent) | if b2c',
  `PROD_ID` varchar(20) NOT NULL COMMENT 'Kode Produk',
  `SHA_ENTITY` varchar(5) NOT NULL COMMENT 'Pihak yang terlibat dalam bisnis',
  `SHA_RISK` double UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Nilai porsi resiko yang diterima',
  `SHA_STATUS` int(2) NOT NULL COMMENT '0 : Active, 1: Suspended',
  `SHA_ENTITY_LEVEL` int(2) DEFAULT NULL COMMENT '0 : Lead',
  `BANK_REKENING` varchar(20) DEFAULT NULL,
  `NO_REKENING` varchar(50) DEFAULT NULL,
  `NAMA_REKENING` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ma2003`
--

INSERT INTO `ma2003` (`SHA_SYSTEM_ID`, `PROD_ID`, `SHA_ENTITY`, `SHA_RISK`, `SHA_STATUS`, `SHA_ENTITY_LEVEL`, `BANK_REKENING`, `NO_REKENING`, `NAMA_REKENING`) VALUES
(1, 'PR124', 'EN123', 65, 0, NULL, 'BNI', '111', ''),
(11, 'PR124', 'EN011', 35, 0, NULL, 'BNI', '222', ''),
(35, 'PR124', 'EN222', 0, 0, NULL, 'BNI', '333', ''),
(38, 'PR003', 'EN011', 20, 0, NULL, 'BNI', '444', ''),
(39, 'PR003', 'EN222', 12, 0, NULL, 'BNI', '555', ''),
(40, 'PR003', 'EN012', 48, 0, NULL, 'BNI', '666', ''),
(49, 'PR124', 'EN000', 0, 0, NULL, 'BNI', '777', ''),
(65, 'PR003', 'EN123', 20, 0, NULL, 'BNI', '888', ''),
(66, 'PR124', 'EN012', 0, 0, NULL, 'BNI', '999', ''),
(73, 'SU001', 'EN011', 25, 0, NULL, 'BNI', '121', ''),
(74, 'SU001', 'EN222', 75, 0, NULL, 'BNI', '232', ''),
(75, 'SU001', 'EN000', 0, 0, NULL, 'BNI', '343', ''),
(80, 'PR003', 'EN000', 0, 0, NULL, 'BNI', '454', ''),
(81, 'PR003', 'PR333', 0, 0, NULL, 'BNI', '565', ''),
(82, 'PR212', 'EN000', 100, 0, NULL, 'BNI', '676', ''),
(84, 'PR009', 'EN123', 100, 0, NULL, 'BNI', '787', ''),
(85, 'PR112', 'EN123', 0, 0, NULL, 'BNI', '898', ''),
(86, 'PR112', 'EN011', 10, 0, 1, 'BNI', '909', 'Reasuransi'),
(87, 'PR112', 'EN000', 0, 0, NULL, 'BNI', '00005', ''),
(89, 'PR113', 'EN123', 0, 0, NULL, 'BNI', '234', ''),
(90, 'PR113', 'EN011', 30, 0, 1, 'BNI', '345', ''),
(91, 'PR113', 'EN000', 0, 0, NULL, 'BNI', '456', ''),
(95, 'PR009', 'EN012', 0, 0, NULL, '', '', ''),
(96, 'PR009', 'PR333', 0, 0, NULL, '', '', ''),
(97, 'PR009', 'EN011', 0, 0, NULL, '', '', ''),
(98, 'PR112', 'EN222', 90, 0, 0, 'BNI', '789', 'PT. Askrindo Syariah'),
(99, 'PR113', 'EN222', 70, 0, 0, 'BNI', '123', '');

-- --------------------------------------------------------

--
-- Table structure for table `ma2004`
--

CREATE TABLE `ma2004` (
  `KOMISI_SYTEM_ID` int(11) NOT NULL COMMENT 'Tabel Rules (Child, Komisi)',
  `SHA_SYSTEM_ID_TAKE` int(11) NOT NULL COMMENT 'penerima komisi',
  `SHA_SYSTEM_ID_GIVE` int(11) NOT NULL COMMENT 'pemberi komisi',
  `KOMISI_NUM` double UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Nilai porsi komisi yang diterima',
  `KOMISI_TAX` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'is using pph23?',
  `KOMISI_WITH` enum('y','n') NOT NULL DEFAULT 'y' COMMENT 'is using "witholding" (PPN)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ma2004`
--

INSERT INTO `ma2004` (`KOMISI_SYTEM_ID`, `SHA_SYSTEM_ID_TAKE`, `SHA_SYSTEM_ID_GIVE`, `KOMISI_NUM`, `KOMISI_TAX`, `KOMISI_WITH`) VALUES
(63, 80, 65, 5, 'y', 'y'),
(64, 81, 65, 5, 'n', 'n'),
(65, 65, 38, 5, 'n', 'y'),
(66, 65, 40, 5, 'y', 'n'),
(67, 80, 65, 5, 'y', 'y'),
(68, 81, 65, 5, 'n', 'n'),
(69, 65, 40, 5, 'y', 'n'),
(70, 73, 74, 2, 'y', 'y'),
(72, 73, 74, 2, 'y', 'y'),
(73, 75, 73, 5, 'y', 'y'),
(85, 49, 1, 5, 'y', 'y'),
(96, 91, 89, 2.5, 'y', 'y'),
(105, 97, 84, 5, 'y', 'y'),
(106, 89, 90, 10, 'y', 'y'),
(108, 87, 85, 2.75, 'y', 'y'),
(109, 85, 98, 5, 'y', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `ma9001`
--

CREATE TABLE `ma9001` (
  `ID_KEY` bigint(20) NOT NULL COMMENT 'Tabel Parameter',
  `ENTITY_ID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ma9002`
--

CREATE TABLE `ma9002` (
  `ID_KEY` bigint(20) NOT NULL COMMENT 'Tabel Sektor Usaha',
  `PROD_ID` varchar(20) NOT NULL,
  `SUSA_ID` varchar(5) NOT NULL COMMENT 'Kode Sektor Usaha',
  `ENTITY_ID` varchar(5) NOT NULL COMMENT 'Entity ID',
  `SUSA_NAMA` varchar(100) NOT NULL COMMENT 'Sektor Usaha (nama)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ma9002`
--

INSERT INTO `ma9002` (`ID_KEY`, `PROD_ID`, `SUSA_ID`, `ENTITY_ID`, `SUSA_NAMA`) VALUES
(2, 'PR002', 'SU001', 'EN222', 'Bengkel Motor'),
(3, 'PR002', 'SU002', 'EN222', 'Bengkel Mobil'),
(6, 'PR002', 'SU003', 'EN222', 'Bengkel Alat'),
(7, 'PR002', 'SU123', 'EN222', 'Pedagang Asongan');

-- --------------------------------------------------------

--
-- Table structure for table `ma9003`
--

CREATE TABLE `ma9003` (
  `ID_KEY` bigint(20) NOT NULL COMMENT 'Tabel Kurs Mata uang',
  `KURS_DATE` date NOT NULL COMMENT 'tanggal kurs',
  `CURR_ID` varchar(3) NOT NULL COMMENT 'Kode Mata uang',
  `CURR_RATE` double NOT NULL COMMENT 'Nilai kurs terhadap IDR'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mmt`
--

CREATE TABLE `mmt` (
  `no` int(4) NOT NULL,
  `CLI_GROUP` varchar(5) DEFAULT NULL,
  `address` varchar(50) NOT NULL,
  `privatkey` varchar(100) NOT NULL,
  `operator` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pasword` varchar(20) NOT NULL,
  `password2` varchar(20) NOT NULL,
  `aktiv` int(1) NOT NULL DEFAULT '1',
  `tx` int(1) NOT NULL,
  `txhs` varchar(70) NOT NULL,
  `noid` varchar(20) NOT NULL,
  `gb` varchar(30) NOT NULL,
  `gbktp` varchar(30) NOT NULL,
  `npwp` varchar(20) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `propinsi` varchar(30) NOT NULL,
  `kabupaten` varchar(30) NOT NULL,
  `kecamatan` varchar(30) NOT NULL,
  `desa` varchar(30) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `member` varchar(5) NOT NULL,
  `profil1` varchar(20) NOT NULL DEFAULT 'profil1.png',
  `profil2` varchar(20) NOT NULL DEFAULT 'profil2.png',
  `is_biru` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mmt`
--

INSERT INTO `mmt` (`no`, `CLI_GROUP`, `address`, `privatkey`, `operator`, `name`, `email`, `pasword`, `password2`, `aktiv`, `tx`, `txhs`, `noid`, `gb`, `gbktp`, `npwp`, `alamat`, `propinsi`, `kabupaten`, `kecamatan`, `desa`, `kodepos`, `telp`, `member`, `profil1`, `profil2`, `is_biru`) VALUES
(4, NULL, '0xE29fA19Dc14d213f01DE1466bA3EE6fE56645c3e', '0x8273c6b880b2e2e20605ba1c520eac8f1d8da48fbff9d58f', 'Baiz', 'joko', 'hamkafauzan2@hotmail.com', '123456', '123456', 0, 1, '', '', '', '0', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(5, NULL, '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', '0x438baa7a067d3062dd784938140846a2b13fafe2357645f7', 'dompet dafa', 'makruf', 'hamkafz@gmail.com', '12345', '12345', 1, 1, '[object Object]', '11111111', '', '0', '11122223333', 'Jl gatot subroto 23', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '-', '03948437', '08128174689', '23', 'profil1.png', 'profil2.jpg', NULL),
(6, NULL, '0xDE622992b4bbc64EB3a2e9F192038974619D9D6f', '0x2a757e3ccc1bc0a830f08fe78ff65ad50750ecec171ae135', 'republika', 'aa gym', 'ibet12@geraidinar.com', '1234', '1234', 0, 1, '', '', '', '0', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(7, NULL, '0xeFe9952aA6Ae5bbFda77afd9Cd2fc1Bd138D5712', '0x36f4f6cda7e697f15f3e4c5753d070bc3476d2264d9a2b2d', 'Askrida', 'Askrida', 'admin@insurance.com', '12345', '12345', 1, 1, '0xae9b9b05107e86a2d13939acd76598904d463ab8b48f56344b121b2f2ee9c626', '', '', '0', '00090989878', 'Jl Juanda 43 Depok', 'DKI Jakarta', 'Jakarta Barat', '0', '0', '14952', '08128174689', '2000', 'profil1.png', 'profil2.png', NULL),
(8, NULL, '0x8EE6CE8940D9F2dE82865f015803BBB1073061A7', '0x9ebab6cd2924e1ceb978421e8eb9030b5cee6851abcd5e26', 'Muhamad Pribadi', 'pribadi', 'hamka@indonesiasoftware.com', '12345', '12345', 1, 3, '0x405e6e10ad1c81c3a903537c9436217c54a1c315a10fcabfc85ec5c6c2e27dd7', '', '', '0', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(9, NULL, '0x948362bFA34144571e37272C6084FB9136a502Da', '0x84930122f1a4d23036e6371cd8bdea99987a5bd2ea36cab6', 'bento', 'bento', 'hamkafzn@gmail.com', '12345', '12345', 1, 4, '0xb10d769b857784de9e4a9e49c5ae5d781497a5557850c6d83827f6106dcbf275', '', '', '0', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(10, NULL, '0x457d133F6754dcbAd79C1C16C62C5348b07D235c', '0x77323786aca6315df96397352bd3ca0393c76c7eb8452b95', '', 'ahmad', 'ahmad@gmail.com', '12345', '12345', 0, 3, '', '', '', '0', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(11, NULL, '0xd0e9735A65D7b2873BE913A7299f448Bcb518C5b', '0x30a897915f51dcade7dcbe39d237eb85549e2f9da11985e0', 'Lembaga Waqaf', 'ahmadi', 'ahmad1@gmail.com', '123', '123', 0, 3, '', '', '', '0', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(12, NULL, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0x35eac9c4d53bb7dd885c4d2b4f30cbe8cc0586eccff1ede27af3722bf26c8999', 'startup', 'dummy', 'dummy@dummy.com', 'dummy', 'dummy', 1, 0, '', '999999', '', '0', '0894654748994482', 'Tugu Indah B 49 Depok', '', '', '', '', '16492', '0812817468922', '', 'ABUJANDA.png', 'profil2.jpg', 1),
(13, NULL, '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xeff47b83519b4fa1778c6ce95249cea1b540d3885e6c1c29f300edda6976bc96', 'adira ins', 'adira', 'admin@adira.com', '12345', '12345', 1, 1, '0x92bf2a1c7ecd905cd20af6ceab707d1cc1932f2fa89450e8aa9e9e3f58dd645b', '', '', '0', '434345353', 'jl Sudirman 43 Jakarta', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', 'Cilincing', '343243434', '08128888899', '400', 'profil1.png', 'profil2.png', NULL),
(18, NULL, '0x3De636240c062d230a0d57667965758021E3C3A4', '0xc0b9aa9988afe2f2a48ef3b7bdb96f83770df0ab17140875a9d5bea586ea7ab8', 'boim', 'boim', 'boim@gmail.com', '12345', '12345', 1, 3, '', '', '', '0', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(20, NULL, '0x32b0c28d4FC3066dd6659c88c0a949B2dDbb06fB', '0x9506f8daf1c7d14ce4fcf088dacd7da49af53598e1848a535400f30b651b8935', 'jokowu', 'jokowi', 'jokowi@gmail.com', '12345', '12345', 0, 3, '', '', '', '0', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(22, NULL, '0xaEBd0e7b48f312850Ee9034Aa4D7143D87D2726D', '0x359a999b919d854f2a16a0d58525761affa8a2d2c40b0b484cdda92394f5477e', 'User Test', 'UserTest', 'dirwan2009@google.com', 'Ini2009aja3', 'Ini2009aja3', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', 1),
(24, NULL, '0x60D97Ea636A9ADa61914E30f88d86514217660BA', '0x0a7faf0bc3b0de408198be9ba0e35e6c1de2724060de9f646e1e1fb9a4ee22c8', '', 'Delil Khairat', 'delil.khairat@gmail.com', 'Idawati1', 'Idawati1', 0, 3, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', 1),
(30, NULL, '0xaFf2eb6DC4Ee6C89E26Eff3Ee34E579EC6eEd787', '0x6d962943353aedd06e5e56971c314f178275a63b47c19684e0236af150db45d3', 'gemblunk', 'gemblunk', 'gemblunk@gmail.com', '12345', '12345', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(31, NULL, '0xA7B07aBE0E1b95D830c01C8F4725722A62676451', '0x745aff640a7c4ef129ff0527e060089b94a95c9697058d4dcaa42f33b8162038', 'budi', 'budi', 'budi@biru.io', '12345', '12345', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(32, NULL, '0x0bbAAa2eA4eE0dAf322C57Faa33A2AB8C702dECF', '0xeb99f3d1abe79a27ee4b8f899e51a18fb3a0da90110f3a0de71b708e9c38a19c', 'delil', 'delil', 'delil.khoirot@gmail.com', '12345', '12345', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', 1),
(33, NULL, '0x1920C29e2ecD6Daa8541f1487389D280dC432644', '0x0c1ce2c257f481c25297a3070436916c50f7dff2283de1707ce431d8e157985d', 'designer', 'designer', 'designer@biru.io', '12345', '12345', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(41, NULL, '0xE6C420c6d8725931dFb68BadeF23dd04576aa5BF', '0x6c0acfed85ee627e54cfe070418acad31d461dae640b1577ff85ace1cf1735d3', 'institution', 'jojon', 'jojon@biru.io', '12345', '12345', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(42, NULL, '0x1908F068BcAe85E92FD9d95e613F7b6CAc9Bd4eF', '0x3cf74874f4867695f59108e1f1f5cc6417818d449b94b8957fec51da34c0fc32', 'institution', 'dkhairat', 'delil.khairat@gmail.com', 'Biruku', 'Biruku', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '20180220_081624.jpg', '20170212_120700.jpg', 1),
(43, NULL, '0x7F7d04C6D0901bA28f29CA9Ea55f22A410f6AeE9', '0xb4f40f56f1102e356424d65acc1cfeaf277c075ead1d9672ec4d34dff7593b80', 'institution', 'jamil', 'muhamad.jamil@birurisk.com', 'Biru123', 'Biru123', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', 1),
(44, NULL, '0xc5F4ed54e97bEE72e0551236B231DE1866288061', '0xd20f051220560fe5c3a7be8e9b70b130b9ae39be6d8f0031eff5d8d1459936be', 'institution', 'ramayurindra', 'ramayurindra.hj@gmail.com', 'Kemalasari73', 'Kemalasari73', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(45, NULL, '0x570bfB7D7A4F1aa0de7D5DFe2f11872291769d81', '0xb4ae54fc1fc22dbc443a5d0c96d870d728216d0f168abce5547afb5335bd1215', 'institution', 'prasetyo', 'prasetyo@yahoo.com', 'khusus', 'khusus', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(46, NULL, '0x58E5A645831a7917DB8669D24d8E3bBB727719b9', '0x62cc7d7b5fb4bf1a37cabc7f6d715cb13e159f23ec5aac31952f5c328a95bbb3', 'institution', 'Nur ardi', 'ptiikub@gmail.com', 'sukemianto3', 'sukemianto3', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(47, NULL, '0xb7a6bCbC894D208A054125Ae5890c242D4188c70', '0xcef72dbb5a7542cb51594bea245c3aab11dd6f5c25de42b6d16c4e6d0eb0e1aa', 'institution', 'candra', 'candrarobiansyah@gmail.com', 'sukemianto3', 'sukemianto3', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(48, NULL, '0x5220C092a867371b788aEa5e0c1BFDC895f5C93B', '0x985a23d4ca63f3e379ec3bdd7b0bf60e7ea029e0037cda3ad48063bff4871eb2', 'institution', 'baskara8', 'brockbask@gmail.com', 'Ganteng8', 'Ganteng8', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(49, NULL, '0xC54ee29FFA0E6A033db8C4ABf8966f010cB050E2', '0x10b86469067c9cd0a52056fe9573b83430561876e4b943c0fa8842d1ea6df728', 'institution', 'Asrofi', 'asrofiopay@gmail.com', 'jejaklangkah', 'jejaklangkah', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(50, NULL, '0xDf9f45C7D543F5805A35D2E8Dc7D9a2310C755FB', '0xb2c147a7b11b54ec12c966cf1f969714b2856a7b7b61d4053dd01f1f80f04bdc', 'institution', 'Nur Rizal Nadif Fikri', 'fikri@birurisk.com', '12345', '12345', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', 1),
(51, NULL, '0x26BdB7F820896688C602a53547fa3ec129bC66Bf', '0xe7b2110b733003ebd7307659b71d1c37d0928f7c67b6ca3d6b2b097e875daa08', 'institution', 'Sabarkah Maulana', 'sabarkah.maulana@ymail.com', 'Tristan/51206', 'Tristan/51206', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(52, NULL, '0x5DDD9C2F4267654aa1163FD8AB4e2F9D31b20acC', '0xfead1245cd02d5b6bb8a7e87fbe424b219f9da3e0ba834d697421e9f2b79c4a2', 'institution', 'nina', 'zhiira_wind@ymail.com', '1234567890', '1234567890', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(53, NULL, '0x98C87a952D8Ed6bA6C45577D36dDD4f7a80D72e4', '0xb681438865c6e1cb7c7c9680147c1f3a8e5da66c61f56711029c2e11aff7e09b', 'institution', 'Achmad Husna', 'ahmadhusna06@gmail.com', 'Ah2806', 'Ah2806', 1, 0, '', '3271050605730003', '', '', '48.621.227.7-404.000', 'Bukit Cimanggu City Blok W8, N', '', '', '', '', '16168', '081310602940', '', 'Foto utk AAMAI.jpg', 'KTP-01.jpg', NULL),
(54, NULL, '0x06eAab6DEf6ecA2F579d19607e46e0AF12D8fDde', '0x496595c06889fba31601bce9c94f52294a3b490eaac49a852df9fde98c3073dd', 'institution', 'widyo', 'widyo.ujang@ojk.go.id', 'WIDYOOJK2020', 'WIDYOOJK2020', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(55, NULL, '0xD0139D2ECdabFeFc4F7DE462FEB566abA73Ba654', '0xe37b7c479de0d74545ce38c8d0b48308f242cd7cfb4dd76028289444d2ab9450', 'institution', 'Widyo', 'widyo.ujang@gmail.com', 'WIDYOOJK2020', 'WIDYOOJK2020', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(56, NULL, '0x216BB9D41D36F790E65d388Cf8e37A57f2E24685', '0x17e42318c2d396fa02ebacb91009e90d5a1075e4ea1788659951bb9343a59ad1', 'institution', 'joko', 'contoh@gmail.com', '12345', '12345', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(57, NULL, '0x6A44f3b32D9638d29b5000316277b5bd921Cd44D', '0xae8aa86eb25cafe18aa986e53d03dd126536dc38a665f3fb80b49667d691f098', 'institution', 'test1', 'test@test.com', '1234567890', '1234567890', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(58, NULL, '0x5679188fe66A501E48a2E8988C0562fC318DA8dE', '0x41a25926ac16e1829d035c341b9ba5e2d4fb999cb14fadf56b9e15ef49103700', 'institution', 'birusatu', 'birusatu@test.com', '12345', '12345', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 'profil1.png', 'profil2.png', NULL),
(122, NULL, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0x35eac9c4d53bb7dd885c4d2b4f30cbe8cc0586eccff1ede27af3722bf26c8999', 'startup', 'hamka', 'hamkafauzan@hotmail.com', '12345', '12345', 1, 0, '', '999999', '', '0', '089465474899448', 'Tugu Indah B 49 Depok', '', '', '', '', '16492', '08128174689', '', 'ABUJANDA.png', 'profil2.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mt_suv`
--

CREATE TABLE `mt_suv` (
  `nom` int(3) NOT NULL,
  `projek` varchar(50) NOT NULL,
  `id` int(3) NOT NULL,
  `address` varchar(70) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `surveyor` varchar(70) NOT NULL,
  `jumlah` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_suv`
--

INSERT INTO `mt_suv` (`nom`, `projek`, `id`, `address`, `status`, `surveyor`, `jumlah`) VALUES
(1, 'madinah tower', 0, '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', 0, '0xeFe9952aA6Ae5bbFda77afd9Cd2fc1Bd138D5712', 30000),
(4, 'makah village', 0, '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', 0, '0xeFe9952aA6Ae5bbFda77afd9Cd2fc1Bd138D5712', 100);

-- --------------------------------------------------------

--
-- Table structure for table `mt_tranopt`
--

CREATE TABLE `mt_tranopt` (
  `no` int(5) NOT NULL,
  `dari` varchar(70) NOT NULL,
  `address` varchar(50) NOT NULL,
  `txhash` varchar(70) NOT NULL,
  `jum` varchar(20) NOT NULL,
  `policy` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_tranopt`
--

INSERT INTO `mt_tranopt` (`no`, `dari`, `address`, `txhash`, `jum`, `policy`, `created_at`) VALUES
(5, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xDE622992b4bbc64EB3a2e9F192038974619D9D6f', '0x4065b8c1a8d4f9b28d075aee0b9167498f9cda9158de5d0e4b11d4409a61ca74', '0.01', '', '2020-01-23 10:09:27'),
(6, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', '0xa66c6eabc8dc4efc2f153b6a6381551207d21b7b49c56c2fb31f0bc22de43545', '0.02', '', '2020-01-23 10:09:27'),
(7, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', '0x3f6e16d5c7a862ebfa5cac8a80bc9ff7cbeb243e0798afb830ef7eb5f053a5fb', '0.001', '', '2020-01-23 10:09:27'),
(8, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xeFe9952aA6Ae5bbFda77afd9Cd2fc1Bd138D5712', '0x77ebec90a0ed45286003cbca3c187e08934a8f60b3ce736d440671a032e4c667', '0.001', '', '2020-01-23 10:09:27'),
(9, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0x8EE6CE8940D9F2dE82865f015803BBB1073061A7', '0xed0194a09c7dbe2f53893a9b66ee5feaa148b045937774016f7f7afd9e574626', '0.0001', '', '2020-01-23 10:09:27'),
(10, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0x948362bFA34144571e37272C6084FB9136a502Da', '0xf3804ae68f18daa682d52431fbfc410efaafe0268a92e5d6aa50bb0223165df0', '0.001', '', '2020-01-23 10:09:27'),
(11, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xeFe9952aA6Ae5bbFda77afd9Cd2fc1Bd138D5712', '0xfa1d2f4d64e68cd23ea8e97795bb56799bd181592f57ab2c6fb9c2f0b218c629', '0.001', '', '2020-01-23 10:09:27'),
(12, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xE29fA19Dc14d213f01DE1466bA3EE6fE56645c3e', '0x591f080c5fd989185dad33845b9d59307edc7f6560141c236722f57f6f1af038', '0.001', '', '2020-01-23 10:09:27'),
(13, '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', '0x8EE6CE8940D9F2dE82865f015803BBB1073061A7', '0x178e9742378b44f0f9f14d70ab3a2ee3a02d426e644171d7d8e5d3720bf57686', '0.003', '', '2020-01-23 10:09:27'),
(53, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', '0xf332e9d92831e854585ce3ada15a537ebb8f27700d0fa0b98e6ee0f52a956f46', '0.000013', '', '2020-01-23 10:09:27'),
(54, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', '0x74921abf00d4132b824f6f5c626a505068f9ef6a992fbb3f41e6402c9678c89f', '0.000011', '', '2020-01-23 10:09:27'),
(57, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', '0xae304f89daabcd364cc205493dd9cf8e356a021f3cc18386c30142fbcf7ba2aa', '0.0000001', '', '2020-01-23 10:09:27'),
(64, '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', '0xd0e9735A65D7b2873BE913A7299f448Bcb518C5b', '0xf97b0cabfb789d0165c5d84d7889a7061ca79571b3f67a305d2f15e2fcfea339', '0.0000001', '', '2020-01-23 10:09:27'),
(65, '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', '0xd0e9735A65D7b2873BE913A7299f448Bcb518C5b', '0x2330b082293ad532c82e0053eb4fdfe25ed7a2fef9fb7c90b1ee93f3a6159fbd', '0.0000001', '', '2020-01-23 10:09:27'),
(66, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xf9d760da6b10362ceaa48aa2d3fdfabf78b551f222764a6f6ef792bb2af0960a', '0.1', '', '2020-01-23 10:09:27'),
(69, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x38c4641250703d3515cd71670451b1c4620349e8c510ab1a7301edf270482f9c', '10', '', '2020-01-23 10:09:27'),
(74, '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xd0e9735A65D7b2873BE913A7299f448Bcb518C5b', '0xba3cba9d99b0fd290df2b5f0523b4ca176326afc477dca1bf09401070737c448', '1', '', '2020-01-23 10:09:27'),
(92, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0x8EE6CE8940D9F2dE82865f015803BBB1073061A7', '0x17ca3f8e850d34efcb7f2f2407fad623a19b509235da5f8bd7c3f543aacba1b8', '0.001', '', '2020-01-23 10:09:27'),
(93, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xd0e9735A65D7b2873BE913A7299f448Bcb518C5b', '0x4f40d8cb5fb06db1297759b848e88e52d19cc7a8b99dc573c7ee1b32ddf16105', '0.00000001', '', '2020-01-23 10:09:27'),
(94, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xac3cab5cf4a4b4c919a6b229a41f67ae17d2766a97a68df5dece53ea3a5433ad', '0.00001', '', '2020-01-23 10:09:27'),
(95, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xd0e9735A65D7b2873BE913A7299f448Bcb518C5b', '0x467a1037bd628629f9a3bbd43317f8ede2699ad2dc9afbf5b0fb4daab464a872', '0.000001', '', '2020-01-23 10:09:27'),
(96, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0x8EE6CE8940D9F2dE82865f015803BBB1073061A7', '0x1d84b5c431c2baaddf9ceccff287258d023d18d3c1c94e6f5370414ef86744ea', '0.000001', '', '2020-01-23 10:09:27'),
(97, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x2089705a4fd69783d0d6fde112a7109500f1e4d90baffe38d612da9e7bfd4fcd', '1', '', '2020-01-23 10:09:27'),
(100, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x901831bdbb79207aa034ee25955d7895d0f42ebf9815e7811dc42e057f935892', '10', '', '2020-01-23 10:09:27'),
(101, '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x8EE6CE8940D9F2dE82865f015803BBB1073061A7', '0xfe47c113012fbbc1c14d807094dd518c39a88d0291f520b168dbfcdb1a12188c', '0.0001', '', '2020-01-23 10:09:27'),
(108, '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x8EE6CE8940D9F2dE82865f015803BBB1073061A7', '0x139a14bd238b518a21d3fdcd06504239f2049bd877697895edd4f2fecfce2aff', '0.00001', '', '2020-01-23 10:09:27'),
(109, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xE29fA19Dc14d213f01DE1466bA3EE6fE56645c3e', '0xa18889de13c7a833dac195823ca6a5e0b98d4a39477af1937e309ddb55ffbdb7', '0.0000001', '', '2020-01-23 10:09:27'),
(110, '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xd0e9735A65D7b2873BE913A7299f448Bcb518C5b', '0x9ab6ab3a010efc466543b89b9c997c5359823be7b5fbd6a4b1f4d4280b50f865', '0.0000001', '', '2020-01-23 10:09:27'),
(111, '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xd0e9735A65D7b2873BE913A7299f448Bcb518C5b', '[object Object]', '0.0000012', '', '2020-01-23 10:09:27'),
(112, '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xd0e9735A65D7b2873BE913A7299f448Bcb518C5b', '0xabadc1ea5234af4b200ddcaebfd4e9a4ca45421c375c1efa580bb3597d0278c6', '0.00000011', '', '2020-01-23 10:09:27'),
(113, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', '0xe74c588197cdedbefc0e83dda2e422c02b2b5aa6ca84539a6ecf5cd1e8003a76', '0.0000001', '', '2020-01-23 10:09:27'),
(114, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xDE622992b4bbc64EB3a2e9F192038974619D9D6f', '0xa776a7fb9c3e2fd11aaa218a487058ea2d708f05e98ba06836ca7d91e939b582', '0.0000001', '', '2020-01-23 10:09:27'),
(115, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', '0x18de66c269bf0c4c98f6733d7d21f470dafc1fe4043ea81d89672a9e074a600e', '0.0000000000001', '', '2020-01-23 10:09:27'),
(122, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', '0x2d25387b0334ad0de22a0622aed5c3e598ecdc60e518a540d525fe03dad8136a', '0.0000001', '', '2020-01-23 10:09:27'),
(123, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x6c2ee543d03e0b56da508f1594140a361cfc4c33309778f18fd0842312847a7e', '0.0000001', '', '2020-01-23 10:09:27'),
(124, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', '0x6c6b045c1c0b53ecfcf7d44ed1723fbd8c5c4ae081acd0e1111ed6a4078f9142', '0.000001', '', '2020-01-23 10:09:27'),
(125, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x4a12c1f246a54965f2ff093400febddf83d68693fa10b574d00c70c082464b6d', '0.000001', '', '2020-01-23 10:09:27'),
(126, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xE29fA19Dc14d213f01DE1466bA3EE6fE56645c3e', '0x174fa5eadc851572da77803e49f1bda9bca2b32053d3db642b12387fcafb270c', '0.000001', '', '2020-01-23 10:09:27'),
(127, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x16f41ea39d62c09580efae8ca026f3b8d58ff073d92be6c4c47ccc17b33725dc', '0.0000001', '', '2020-01-23 10:09:27'),
(128, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x9f91fc7ab322b3c8555317a3d45433c09e42e65d6afd8ba5187030610da9dffe', '0.000001', '', '2020-01-23 10:09:27'),
(129, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x8ad85e62ca0b1baef4bcf8de667619265200d63caf10426afa78a56ae8b0fde8', '0.00000011', '', '2020-01-23 10:09:27'),
(130, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x12a8c134ab0fc355812ad82a7c8ba34350855bb591953ea402dac485c1985306', '0.000001', '', '2020-01-23 10:09:27'),
(131, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xeFe9952aA6Ae5bbFda77afd9Cd2fc1Bd138D5712', '0x9705e33ba1d2cebd8c71232004aebf0ff2c0894e0cc076029950baf210f24590', '0.0000001', '', '2020-01-23 10:09:27'),
(132, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0x948362bFA34144571e37272C6084FB9136a502Da', '0x4efb30d7060906bca223a42965a97e3f4ca7c19a8b5ae1269532b2de8750a99f', '0.000001', '', '2020-01-23 10:09:27'),
(133, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xDE622992b4bbc64EB3a2e9F192038974619D9D6f', '0xe20015ffb6ca3b17c31e4d98d811c27dd2ddbf08a1bf5e4515cce8ff35a41f93', '0.0001', '', '2020-01-23 10:09:27'),
(134, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xE29fA19Dc14d213f01DE1466bA3EE6fE56645c3e', '0x1fb01457d5d748b5a8913c748afc20b7171a05094e22cbeafea2b939c9b8d178', '1', '', '2020-01-23 10:09:27'),
(135, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '', '0x87d6dd07fb9411bcd104154d9f4b9eb4ff407e12bd3c6351d54fb32a3060b8cc', '', '', '2020-01-23 10:09:27'),
(136, '', '0x8EE6CE8940D9F2dE82865f015803BBB1073061A7', '0x83f3e0b94c15611663354188c0c95dc7a9aa8f4e211dd5665603abbfe15ff918', '1', '', '2020-01-23 10:09:27'),
(137, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xeFe9952aA6Ae5bbFda77afd9Cd2fc1Bd138D5712', '0x9dd5b47b1abb68e9c1a7d525b43c08e97a10ac33461f813b594ea5f1c163feca', '0.000099', '', '2020-01-23 10:09:27'),
(138, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xeFe9952aA6Ae5bbFda77afd9Cd2fc1Bd138D5712', '0x1b33c31bc5394022c93bfd9b5d413bfd5a8ee96e41fb6033bd2d527c00b77805', '0.375', '', '2020-01-23 10:09:27'),
(150, '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xb4a20bb9a2225cc963da38753d8cf70f6a9d171dc1541fb30406d069efa25c50', '24', '1925257', '2020-01-23 10:09:27'),
(151, '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xdf632d72e294afe020bb902c918f45d18f1220ba47cd50d13904f5fc10346eea', '27.6', '89898989', '2020-01-23 10:09:27'),
(165, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x8106c4f37a6e15de7ff85afb73c6e4fd070ad999222ceb504281e123d7721157', '0.068', '1490300', '2020-01-23 10:09:27'),
(166, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xfa1d0a3bf65bb423de2f75f78ef2b495d4ca7461d1c51c8408aec1710b61a034', '0.068', '1993486', '2020-01-23 10:09:27'),
(167, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xe08e38a74dad1d384874f983e8896fde6f3c0aaf51b8ae51dfd516ed3653fe9b', '0.032', '1191631', '2020-01-23 10:09:27'),
(168, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xce6e20ddeb0320e1f1d6d1d6fb338a80eba7430ba25108bb1356e4e3bdfdeaf8', '0.032', '1697406', '2020-01-23 10:09:27'),
(169, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x29a497a1e298c1b06c040edf4053042d2f78be3cdf92a50498a94e07d4b5deae', '0.044', '1613838', '2020-01-23 10:09:27'),
(170, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xdb012ff9d08acd351b098ab31acdb9d6c2111fd490690a43af30a0340e75c5fc', '0.044', '1661677', '2020-01-23 10:09:27'),
(171, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x183af031062df18bc7928e28a1f2f72333ed1c380efb3a0c139875be2f68c3f2', '0.044', '1869399', '2020-01-23 10:09:27'),
(172, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x130c958ce96a76f1ee3991173111aad30dfef6aa972a586de5b070231dafe770', '0.044', '1925257', '2020-01-23 10:09:27'),
(173, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xde26c7390693d8cf269795fad7a582c7eed281257334e75b420650405a758b1f', '0.044', '1709906', '2020-01-23 10:09:27'),
(174, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x182c9f46383156d27b07996f9652b7cf6043f2bcf2dbb7d7ed77f6b98f97630b', '0.032', '1241950', '2020-01-23 10:09:27'),
(175, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x76b41f61d42b2cfdbdbacdacb42ccfc7b4220a9ee043c81f9e5a52fe15bc2700', '0.034', '1391862', '2020-01-23 10:09:27'),
(176, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x708265af1383aa7edfbca6b545b4b30f30799b9104d4ffd235aaa1bcca1442b8', '0.044', '1412721', '2020-01-23 10:09:27'),
(177, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x3f67709cadb39ef45a368152742e20cc2062e70bbae7e49ec55c6589db8085aa', '0.044', '1891591', '2020-01-23 10:09:27'),
(178, '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xaFf2eb6DC4Ee6C89E26Eff3Ee34E579EC6eEd787', '0x8eb870d891f52c921a73043e47c40525688ec0e8395001c11efe6b1ef17f83eb', '16', '1869399', '2020-01-23 10:09:27'),
(179, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xc6148100e81d69d696a6332c0bab2454a27be2daa70167f9ee73b11ed5ead563', '0.044', '1689121', '2020-01-23 10:09:27'),
(180, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x8849773479106fda3ee600dceee3ab4c59bc5b7c17b21afbae8931291259460b', '0.034', '1577574', '2020-02-24 10:32:16'),
(181, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0xdacd84e6b4640172d52e12555b6cdcf36d43dbd5f5e00a71c1894f6f1718c4a6', '0.068', '1864595', '2020-02-24 15:31:15'),
(182, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', '0x07565371a54c775bfb8c79dc5a5fb2c80724d9e62b46349e4b64ab2446bf5738', '0.068', '1572478', '2020-02-24 16:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `obyek`
--

CREATE TABLE `obyek` (
  `no` int(5) NOT NULL,
  `pendaftar` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `prof` varchar(50) NOT NULL,
  `kab` varchar(50) NOT NULL,
  `kec` varchar(50) NOT NULL,
  `desa` varchar(50) NOT NULL,
  `kor1` varchar(50) NOT NULL,
  `kor2` varchar(50) NOT NULL,
  `nopololicy` varchar(20) NOT NULL,
  `bru` varchar(15) NOT NULL,
  `brumax` varchar(10) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `claim` varchar(20) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `gbpbb` varchar(20) NOT NULL,
  `bukti` varchar(20) NOT NULL,
  `desa2` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obyek`
--

INSERT INTO `obyek` (`no`, `pendaftar`, `nama`, `prof`, `kab`, `kec`, `desa`, `kor1`, `kor2`, `nopololicy`, `bru`, `brumax`, `tanggal`, `claim`, `status`, `gbpbb`, `bukti`, `desa2`) VALUES
(96, '30', 'joko TOK', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '323324', '-6.1713426', '106.82373740000003', '1869399', '0.044', '40', '', '40', 0, 'a.png', 'a.png', ''),
(97, '12', 'hamka fauzan', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '12323', '-6.1713426', '106.82373740000003', '1925257', '0.044', '40', '', '24', 1, 'a.png', '', ''),
(99, '12', 'jhoni', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '244324234', '1.492659', '103.74135909999995', '1709906', '0.044', '40', '', '0', 0, 'beniso.jpg', '', ''),
(100, '12', 'taufik', 'DKI Jakarta', 'Jakarta Selatan', 'Jagakarsa', '1232221', '-6.334917', '106.82373740000003', '1241950', '0.032', '40', '', '0', 0, 'biru.jpg', '', ''),
(101, '32', 'delil', 'Jawa Barat', 'Bekasi', 'Bekasi Timur', '17111', '-6.2362538', '107.02441709999994', '1391862', '0.034', '40', '', '0', 0, 'biru.png', 'banner1a.jpg', ''),
(104, '12', 'joko', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '1333323', '-6.1713426', '106.82373740000003', '1587996', '0.044', '40', '', '0', 0, 'beniso.jpg', '', ''),
(105, '12', 'joko', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '3243242', '-6.1713426', '106.82373740000003', '1638271', '0.044', '40', '', '0', 0, 'biru.jpg', '', ''),
(106, '12', 'arya', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '12345', '1.492659', '103.74135909999995', '1979032', '0.044', '40', '', '0', 0, '0', '', ''),
(107, '12', 'xxxxx', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '3333', '-6.1713426', '106.82373740000003', '1412721', '0.044', '40', '', '0', 0, 'armando.png', '', ''),
(108, '12', 'bento', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '233', '-6.1713426', '106.82373740000003', '1053896', '0.044', '40', '', '0', 0, 'babilonia.png', '', ''),
(109, '12', 'bento', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '123131', '-6.1713426', '106.82373740000003', '1891591', '0.044', '40', '', '0', 0, 'apki.png', '', ''),
(110, '12', 'bento', 'Jawa Barat', 'Jakarta Pusat', 'Johar Baru', '232334', '1.492659', '103.74135909999995', '1018995', '0.044', '40', '', '0', 0, 'apki.png', '', ''),
(111, '12', 'bentoxx', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '222', '1.492659', '103.74135909999995', '1443227', '0.044', '40', '', '0', 0, 'bambu.png', '', ''),
(112, '12', 'bento', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '767776', '-6.1713426', '106.82373740000003', '1598066', '0.044', '40', '', '0', 0, 'ban1.png', '', ''),
(113, '12', 'bento', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '1234', '-6.1713426', '106.82373740000003', '1524391', '0.044', '40', '', '0', 0, 'antioksidan.jpg', '', ''),
(114, '43', 'Jamil', 'Jawa Barat', 'Garut', 'Garut Kota', '', '-7.251215999999999', '107.92355629999997', '1909109', '0.105', '75', '', '0', 0, '0', '', ''),
(115, '12', 'test', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '', '-6.1713426', '106.82373740000003', '1477047', '0.044', '40', '', '0', 0, 'antioksidan.jpg', '', 'Kampung  Jampang'),
(116, '12', 'Sadam', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '', '-6.1713426', '106.82373740000003', '1201483', '0.044', '40', '', '0', 0, 'birubesar.png', '', 'cimanggis'),
(117, '33', 'test', 'Jawa Barat', 'Bogor', 'Bogor Barat', '', '-6.572861899999999', '106.7647475', '1066712', '0.06375', '75', '', '0', 0, '0', '', ''),
(118, '33', 'dirwanto', 'Jawa Barat', 'Depok', 'Bojongsari', '', '-6.3991308', '106.74115589999997', '1701894', '0.032', '40', '', '0', 0, '02-Ikhtisar ', '', '656'),
(119, '42', 'Delil Khairat', 'Jawa Barat', 'Bekasi', 'Bekasi Timur', '', '-6.2362538', '107.02441709999994', '1431077', '0.1275', '150', '', '0', 0, '0', '', 'Duren Jaya'),
(120, '', '', '', '', '', '', '', '', '', '0', '', '', '0', 0, '', '', ''),
(121, '42', 'Delil Khairat juga', 'Jawa Barat', 'Bekasi', 'Bekasi Timur', '', '-6.2362538', '107.02441709999994', '1166379', '0.034', '40', '', '0', 0, '20170312_133120.jpg', '', 'Duren Jaya'),
(122, '5', '', 'DKI Jakarta', 'Jakarta Timur', 'Duren Sawit', '', '-6.2321915', '106.9152021', '1328993', '0.06375', '75', '', '0', 0, 'alquran.png', '', ''),
(123, '5', 'ruri', 'DKI Jakarta', 'Jakarta Timur', 'Duren Sawit', '', '-6.2321915', '106.9152021', '1286380', '0.06375', '75', '', '0', 0, 'alquran.png', '', ''),
(124, '5', 'fsdf', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Lama', '', '-6.2443916', '106.7765443', '1124912', '0.032', '40', '', '0', 0, 'bamboo.png', '', '34244'),
(125, '5', 'fsdf', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Lama', '', '-6.2443916', '106.7765443', '1365256', '0.032', '40', '', '0', 0, 'bamboo.png', '', '34244'),
(126, '5', 'ruri', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '', '-6.1713426', '106.8237374', '1895822', '0.044', '40', '', '0', 0, 'alhaya2.png', '', '2323232'),
(127, '5', 'ruri', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '', '-6.1713426', '106.8237374', '1345073', '0.044', '40', '', '0', 0, 'alhaya2.png', '', '2323232'),
(128, '5', 'ruri', 'DKI Jakarta', 'Jakarta Pusat', 'Kemayoran', '', '-6.1603721', '106.8473377', '1292079', '0.044', '40', '', '0', 0, 'alhaya2.png', '', '2323232'),
(129, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '', '1.492659', '103.7413591', '1080297', '0.044', '40', '', '0', 0, 'dca-feat.jpg', '', '69316'),
(130, '5', 'ruri', 'DKI Jakarta', 'Jakarta Pusat', 'Kemayoran', '', '-6.1603721', '106.8473377', '1513369', '0.044', '40', '', '0', 0, 'alhaya2.png', '', '2323232'),
(131, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '', '1.492659', '103.7413591', '1289389', '0.044', '40', '', '0', 0, 'dca-feat.jpg', '', '69316'),
(132, '5', '3434', 'Jawa Barat', 'Purwakarta', 'Sukasari', '', '-6.8646647', '107.5889804', '1626429', '0.034', '40', '', '0', 0, 'ban1.png', '', ''),
(133, '5', '3434', 'Jawa Barat', 'Purwakarta', 'Sukasari', '', '-6.8646647', '107.5889804', '1430350', '0.034', '40', '', '0', 0, 'ban1.png', '', ''),
(134, '5', '3434', 'Jawa Barat', 'Purwakarta', 'Sukasari', '', '-6.8646647', '107.5889804', '1748655', '0.034', '40', '', '0', 0, 'ban1.png', '', ''),
(135, '5', '3434', 'Jawa Barat', 'Purwakarta', 'Sukasari', '', '-6.8646647', '107.5889804', '1958927', '0.034', '40', '', '0', 0, 'ban1.png', '', ''),
(136, '5', 'were', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '', '-6.1713426', '106.8237374', '1340918', '0.0825', '75', '', '0', 0, 'alquran.png', '', '2332424'),
(137, '5', 'were', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '', '-6.1713426', '106.8237374', '1451206', '0.0825', '75', '', '0', 0, 'alquran.png', '', '2332424'),
(138, '5', 'were', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '', '-6.1713426', '106.8237374', '1464790', '0.0825', '75', '', '0', 0, 'alquran.png', '', '2332424'),
(139, '5', 'were', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '', '-6.1713426', '106.8237374', '1732702', '0.0825', '75', '', '0', 0, 'alquran.png', '', '2332424'),
(140, '5', 'were', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '', '-6.1713426', '106.8237374', '1343693', '0.0825', '75', '', '0', 0, 'alquran.png', '', '2332424'),
(141, '5', 'were', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '', '-6.1713426', '106.8237374', '1199389', '0.0825', '75', '', '0', 0, 'alquran.png', '', '2332424'),
(142, '12', 'kadoku', 'Jawa Barat', 'Sukabumi', 'Cikakak', '', '-7.4717299', '109.0512643', '1531835', '0', '0', '', '0', 0, 'dca-feat.jpg', '', '22222'),
(143, '5', 'ruri', 'DKI Jakarta', 'Jakarta Selatan', 'Pancoran', '', '-6.2523005', '106.8473377', '1915804', '0.032', '40', '', '0', 0, 'apki.png', '', '2332424'),
(144, '12', 'hamka', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '', '1.492659', '103.7413591', '1689121', '0.044', '40', '', '0', 0, 'antioksidan.jpg', '', '234234'),
(145, '5', 'ruri', 'DKI Jakarta', 'Jakarta Timur', 'Cempaka Putih', '', '-6.182670799999999', '106.8679899', '1383854', '0.06375', '75', '', '0', 0, 'armando.png', '', '2332424'),
(146, '12', 'kadoku', 'Jawa Barat', 'Sukabumi', 'Cikole', '', '-6.788236', '107.6392892', '1139027', '0.034', '40', '', '0', 0, '2.jpg', '', '222'),
(147, '5', 'Ruri Rizal', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', '', '-6.2436219', '106.8001396', '1771410', '0.032', '40', '', '0', 0, '36541.jpg', '', '777'),
(148, '5', 'Ruri Rizal', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', '', '-6.2436219', '106.8001396', '1145370', '0.032', '40', '', '0', 0, '36541.jpg', '', '777'),
(149, '5', 'Ruri Rizal', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', '', '-6.2436219', '106.8001396', '1851387', '0.032', '40', '', '0', 0, '36541.jpg', '', '777'),
(150, '5', 'Ruri Rizal', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', '', '-6.2436219', '106.8001396', '1030864', '0.032', '40', '', '0', 0, '36541.jpg', '', '777'),
(151, '5', 'Ruri Rizal', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', '', '-6.2436219', '106.8001396', '1000037', '0.032', '40', '', '0', 0, '36541.jpg', '', '777'),
(152, '5', 'Ruri Rizal', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', '', '-6.2436219', '106.8001396', '1817797', '0.032', '40', '', '0', 0, '36541.jpg', '', '777'),
(153, '5', 'Ruri Rizal', 'DKI Jakarta', 'Jakarta Selatan', 'Jagakarsa', '', '-6.334917', '106.8237374', '1130410', '0.032', '40', '', '0', 0, '36541.jpg', '', '555'),
(154, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Selatan', 'Jagakarsa', '', '-6.334917', '106.8237374', '1131333', '0.032', '40', '', '0', 0, '36541.jpg', '', '8'),
(155, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Selatan', 'Jagakarsa', '', '-6.334917', '106.8237374', '1686301', '0.032', '40', '', '0', 0, '36541.jpg', '', '8'),
(156, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Selatan', 'Jagakarsa', '', '-6.334917', '106.8237374', '1508955', '0.032', '40', '', '0', 0, '36541.jpg', '', '8'),
(157, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Selatan', 'Jagakarsa', '', '-6.334917', '106.8237374', '1842720', '0.032', '40', '', '0', 0, '36541.jpg', '', '8'),
(158, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Selatan', 'Jagakarsa', '', '-6.334917', '106.8237374', '1247658', '0.032', '40', '', '0', 0, '36541.jpg', '', '8'),
(159, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Selatan', 'Jagakarsa', '', '-6.334917', '106.8237374', '1514686', '0.032', '40', '', '0', 0, '36541.jpg', '', '8'),
(160, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Selatan', 'Jagakarsa', '', '-6.334917', '106.8237374', '1103838', '0.032', '40', '', '0', 0, '36541.jpg', '', '8'),
(161, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Selatan', 'Jagakarsa', '', '-6.334917', '106.8237374', '1009784', '0.032', '40', '', '0', 0, '36541.jpg', '', '8'),
(162, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Selatan', 'Jagakarsa', '', '-6.334917', '106.8237374', '1756237', '0.032', '40', '', '0', 0, '36541.jpg', '', '8'),
(163, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Selatan', 'Jagakarsa', '', '-6.334917', '106.8237374', '1525307', '0.032', '40', '', '0', 0, '36541.jpg', '', '8'),
(164, '5', 'kadoku', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', '', '-6.2436219', '106.8001396', '1614790', '0.032', '40', '', '0', 0, '36541.jpg', '', '3'),
(165, '5', 'kadoku', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Lama', '', '-6.2443916', '106.7765443', '1281003', '0.032', '40', '', '0', 0, '36542.jpg', '', '69316'),
(166, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Pusat', 'Menteng', '', '-6.194031', '106.8325872', '1038695', '0.044', '40', '', '0', 0, '36541.jpg', '', '69316'),
(167, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '', '-6.170340200000001', '106.8148046', '1433191', '0.044', '40', '', '0', 0, '36541.jpg', '', '8'),
(168, '5', 'kadoku', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '', '-6.170340200000001', '106.8148046', '1033514', '0.044', '40', '', '0', 0, '36541.jpg', '', '69316'),
(169, '12', 'kadoku', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', '', '-6.2436219', '106.8001396', '1245697', '0.032', '40', '', '0', 0, '36541.jpg', '', '99'),
(170, '5', 'test', 'DKI Jakarta', 'Jakarta Selatan', 'Jagakarsa', '', '-6.334917', '106.8237374', '1601427', '40', '40', '', '0', 0, 'pbb.png', '', '2332424'),
(171, '5', 'test', 'DKI Jakarta', 'Jakarta Selatan', 'Jagakarsa', '', '-6.334917', '106.8237374', '1883500', '40', '40', '', '0', 0, 'pbb.png', '', '2332424'),
(172, '33', 'PT ABC', 'Jawa Barat', 'Bogor', 'Bojong Gede (Bojonggede)', '', '-6.4870087', '106.79719', '1981602', '0', '0', '', '0', 0, '0', '', '2343'),
(173, '12', 'Ahmadi', 'DKI Jakarta', 'Jakarta Timur', 'Ciracas', '', '-6.3231156', '106.8709404', '1659386', '42', '40', '', '0', 0, '36542.jpg', '', '22222'),
(174, '12', 'Ahmadi', 'DKI Jakarta', 'Jakarta Timur', 'Ciracas', '', '-6.3231156', '106.8709404', '1147234', '157.5', '150', '', '0', 0, '36542.jpg', '', '22222'),
(175, '12', 'Ahmadi', 'DKI Jakarta', 'Jakarta Timur', 'Ciracas', '', '-6.3231156', '106.8709404', '1366370', '42', '40', '', '0', 0, '36542.jpg', '', '22222'),
(176, '12', 'Ahmadi', 'DKI Jakarta', 'Jakarta Timur', 'Ciracas', '', '-6.3231156', '106.8709404', '1137138', '42', '40', '', '0', 0, '36542.jpg', '', '22222'),
(177, '12', 'Ruri Rizal', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', '', '-6.2436219', '106.8001396', '1512315', '40', '40', '', '0', 0, '36541.jpg', '', '6666'),
(178, '12', 'TEST', 'DKI Jakarta', 'Jakarta Pusat', 'Cempaka Putih', '', '-6.182670799999999', '106.8679899', '1973166', '40', '40', '', '0', 0, '36541.jpg', '', '222'),
(179, '12', 'TEST', 'DKI Jakarta', 'Jakarta Pusat', 'Cempaka Putih', '', '-6.182670799999999', '106.8679899', '1297495', '150', '150', '', '0', 0, '36541.jpg', '', '222'),
(180, '12', 'PT. CLIENT', 'DKI Jakarta', 'Jakarta Pusat', 'Menteng', '', '-6.194031', '106.8325872', '1137906', '44', '40', '', '0', 0, '36542.jpg', '', '222'),
(181, '12', 'Ruri Rizal', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', '', '-6.2436219', '106.8001396', '1501328', '0', '40', '', '0', 0, '36541.jpg', '', '6666'),
(182, '12', 'Ruri Rizal', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', '', '-6.2436219', '106.8001396', '1164658', '0', '40', '', '0', 0, '36541.jpg', '', '6666'),
(183, '12', 'Ruri Rizal', 'DKI Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', '', '-6.2436219', '106.8001396', '1587483', '0', '150', '', '0', 0, '36541.jpg', '', '6666'),
(184, '12', 'PT. CLIENT', 'DKI Jakarta', 'Jakarta Pusat', 'Menteng', '', '-6.194031', '106.8325872', '1074591', '0', '150', '', '0', 0, '36541.jpg', '', '69316'),
(185, '12', 'PT. CLIENT', 'DKI Jakarta', 'Jakarta Pusat', 'Menteng', '', '-6.194031', '106.8325872', '1609649', '0', '150', '', '0', 0, '36541.jpg', '', '69316'),
(186, '12', 'PT. CLIENT', 'DKI Jakarta', 'Jakarta Pusat', 'Menteng', '', '-6.194031', '106.8325872', '1596096', '0', '40', '', '0', 0, '36542.jpg', '', '222'),
(187, '12', 'PT. CLIENT', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '', '1.492659', '103.7413591', '1560382', '0', '150', '', '0', 0, '36541.jpg', '', '69316'),
(188, '12', 'PT. CLIENT', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '', '1.492659', '103.7413591', '1607975', '0', '150', '', '0', 0, '36541.jpg', '', '69316'),
(189, '12', 'PT. CLIENT', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '', '1.492659', '103.7413591', '1762174', '0', '150', '', '0', 0, '36541.jpg', '', '69316'),
(190, '12', 'PT. CLIENT', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '', '1.492659', '103.7413591', '1085585', '0', '150', '', '0', 0, '36541.jpg', '', '69316'),
(191, '12', 'PT. CLIENT', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '', '1.492659', '103.7413591', '1105802', '0.165', '150', '', '0', 0, '36541.jpg', '', '69316'),
(192, '12', 'PT. CLIENT', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '', '1.492659', '103.7413591', '1741626', '0.044', '40', '', '0', 0, '36541.jpg', '', '69316'),
(193, '12', 'PT. CLIENT', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '', '1.492659', '103.7413591', '1739612', '0.0825', '75', '', '0', 0, '36541.jpg', '', '69316'),
(194, '12', 'PT. CLIENT', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '', '1.492659', '103.7413591', '1452897', '0.165', '150', '', '0', 0, '36541.jpg', '', '69316'),
(195, '12', 'PT. CLIENT', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '', '1.492659', '103.7413591', '1764521', '0.165', '150', '', '0', 0, '36541.jpg', '', '69316'),
(212, '55', 'xx', 'DKI Jakarta', 'Jakarta Pusat', 'Johar Baru', '', '1.492659', '103.7413591', '1655036', '0.0825', '75', '', '0', 0, '0', '', '88900'),
(213, '55', 'oi', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '', '-6.170340200000001', '106.8148046', '1096537', '0.0825', '75', '', '0', 0, '0', '', '000000'),
(214, '55', 'oi', 'DKI Jakarta', 'Jakarta Pusat', 'Gambir', '', '-6.170340200000001', '106.8148046', '1326010', '0.165', '150', '', '0', 0, '0', '', '00000'),
(215, '58', 'contoh satu', 'DKI Jakarta', 'Jakarta Utara', 'Tanjung Priok', '', '-6.1320555', '106.8714848', '1750768', '0.068', '40', '', '0', 0, '36137.png', '', '3433434');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `tb` varchar(1) NOT NULL,
  `email` varchar(250) NOT NULL,
  `key` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_reset_temp`
--

INSERT INTO `password_reset_temp` (`tb`, `email`, `key`, `expDate`) VALUES
('', 'muhamad.jamil@birurisk.com', '3d418ab1c0c240b7d0e35ee9562d39667c0d04b5f7', '2020-06-23 16:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `dinamis` tinyint(4) NOT NULL DEFAULT '1',
  `menu_pengaturan` tinyint(4) DEFAULT NULL,
  `menu_produk_mekaar` tinyint(4) DEFAULT NULL,
  `deskripsi` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `dinamis`, `menu_pengaturan`, `menu_produk_mekaar`, `deskripsi`) VALUES
(1, 'access_perusahaan', 0, 1, NULL, ''),
(2, 'create_perusahaan', 0, 1, NULL, ''),
(3, 'update_perusahaan', 0, 1, NULL, ''),
(4, 'delete_perusahaan', 0, 1, NULL, ''),
(5, 'access_holiday_system', 0, 1, NULL, ''),
(6, 'modifikasi_holiday_system', 0, 1, NULL, ''),
(7, 'access_user_semua', 0, 1, NULL, 'mengakses user perusahaan maupun cabang'),
(8, 'access_user_perusahaan', 0, 1, NULL, 'hanya mengakses user perusahaan'),
(9, 'create_user_perusahaan', 0, 1, NULL, ''),
(10, 'update_user_perusahaan', 0, 1, NULL, ''),
(11, 'delete_user_perusahaan', 0, 1, NULL, ''),
(12, 'access_right_management_user_perusahaan', 0, NULL, NULL, ''),
(13, 'update_right_management_user_perusahaan', 0, NULL, NULL, ''),
(14, 'access_right_management_user_b2c', 0, NULL, NULL, ''),
(15, 'update_right_management_user_b2c', 0, NULL, NULL, ''),
(16, 'access_right_management_user_cabang', 0, NULL, NULL, ''),
(17, 'create_right_management_user_cabang', 0, NULL, NULL, ''),
(18, 'update_right_management_user_cabang', 0, NULL, NULL, ''),
(19, 'delete_right_management_user_cabang', 0, NULL, NULL, ''),
(20, 'access_zonasi', 0, 1, NULL, ''),
(21, 'create_zonasi', 0, 1, NULL, ''),
(22, 'update_zonasi', 0, 1, NULL, ''),
(23, 'access_main_produk', 0, 1, NULL, ''),
(24, 'create_main_produk', 0, 1, NULL, ''),
(25, 'update_main_produk', 0, 1, NULL, ''),
(26, 'delete_main_produk', 0, 1, NULL, ''),
(27, 'access_sub_produk', 0, 1, NULL, ''),
(28, 'create_sub_produk', 0, 1, NULL, ''),
(29, 'update_sub_produk', 0, 1, NULL, ''),
(30, 'delete_sub_produk', 0, 1, NULL, ''),
(31, 'access_holiday_produk', 0, 1, NULL, ''),
(32, 'modifikasi_holiday_produk', 0, 1, NULL, ''),
(33, 'access_gempa', 0, 1, NULL, ''),
(34, 'create_gempa', 0, 1, NULL, ''),
(35, 'calculate_gempa', 0, 1, NULL, ''),
(50, 'access_produk_mekaar', 0, 1, 1, 'akses menu produk mekaar (PR002)'),
(51, 'access_cabang_mekaar', 0, 1, 1, ''),
(52, 'create_cabang_mekaar', 0, 1, 1, 'auto insert 5 permission crud dinamis u/ id_cabang \r\ninput_data_cabang_mekaar_?\r\nupload_data_cabang_mekaar_?\r\ndelete_input_data_cabang_mekaar_?\r\ndelete_upload_data_cabang_mekaar_?\r\npaid_data_cabang_mekaar_?'),
(53, 'update_cabang_mekaar', 0, 1, 1, ''),
(54, 'delete_cabang_mekaar', 0, 1, 1, 'hanya mengakses user cabang perusahaan'),
(55, 'create_user_cabang_mekaar', 0, 1, 1, 'auto add 5 permission crud id_cabang kepada user \r\ninput_data_cabang_mekaar_? \r\nupload_data_cabang_mekaar_? \r\ndelete_input_data_cabang_mekaar_? \r\ndelete_upload_data_cabang_mekaar_?\r\npaid_data_cabang_mekaar_?'),
(56, 'access_bussiness_rules_mekaar', 0, NULL, 1, ''),
(57, 'access_data_baru_mekaar', 0, NULL, 1, ''),
(58, 'access_data_aktif_mekaar', 0, NULL, 1, ''),
(100, 'input_data_cabang_mekaar_4', 1, NULL, NULL, ''),
(101, 'upload_data_cabang_mekaar_4', 1, NULL, NULL, ''),
(102, 'delete_input_data_cabang_mekaar_4', 1, NULL, NULL, ''),
(103, 'delete_upload_data_cabang_mekaar_4', 1, NULL, NULL, ''),
(104, 'paid_data_cabang_mekaar_4', 1, NULL, NULL, ''),
(105, 'upload_data_cabang_mekaar_6', 1, NULL, NULL, ''),
(106, 'delete_input_data_cabang_mekaar_6', 1, NULL, NULL, ''),
(107, 'delete_upload_data_cabang_mekaar_6', 1, NULL, NULL, ''),
(108, 'paid_data_cabang_mekaar_6', 1, NULL, NULL, ''),
(109, 'input_data_cabang_mekaar_6', 1, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `premi`
--

CREATE TABLE `premi` (
  `no` int(5) NOT NULL,
  `zona` int(1) DEFAULT NULL,
  `SUB_PROD_ID` varchar(20) DEFAULT NULL,
  `rate` varchar(15) NOT NULL,
  `usia_awal` int(11) DEFAULT NULL,
  `usia_akhir` int(11) DEFAULT NULL,
  `max150` varchar(10) NOT NULL,
  `max115` varchar(10) NOT NULL,
  `max75` varchar(10) NOT NULL,
  `max40` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `premi`
--

INSERT INTO `premi` (`no`, `zona`, `SUB_PROD_ID`, `rate`, `usia_awal`, `usia_akhir`, `max150`, `max115`, `max75`, `max40`) VALUES
(1, 1, NULL, '0.08', NULL, NULL, '0.12', '0.092', '0.06', '0.032'),
(2, 2, NULL, '0.085', NULL, NULL, '0.1275', '0.0974', '0.0638', '0.0340'),
(3, 3, NULL, '0.11', NULL, NULL, '0.1650', '0.1265', '0.0825', '0.044'),
(4, 4, NULL, '0.14', NULL, NULL, '0.21', '0.161', '0.105', '0.056'),
(5, 5, NULL, '0.17', NULL, NULL, '0.255', '0.1955', '0.1275', '0.068'),
(181, NULL, 'SU001', '100', 17, 30, '', '', '', ''),
(182, NULL, 'SU001', '125', 31, 50, '', '', '', ''),
(183, NULL, 'SU001', '150', 51, 65, '', '', '', ''),
(189, 1, 'PR003', '100', NULL, NULL, '', '', '', ''),
(190, 2, 'PR003', '105', NULL, NULL, '', '', '', ''),
(191, 3, 'PR003', '110', NULL, NULL, '', '', '', ''),
(192, 4, 'PR003', '115', NULL, NULL, '', '', '', ''),
(193, 5, 'PR003', '120', NULL, NULL, '', '', '', ''),
(205, 1, 'PR124', '100', NULL, NULL, '', '', '', ''),
(206, 2, 'PR124', '105', NULL, NULL, '', '', '', ''),
(207, 3, 'PR124', '110', NULL, NULL, '', '', '', ''),
(208, 4, 'PR124', '115', NULL, NULL, '', '', '', ''),
(209, 5, 'PR124', '120', NULL, NULL, '', '', '', ''),
(210, NULL, 'PR009', '100.00000', 17, 30, '', '', '', ''),
(211, NULL, 'PR009', '125.00000', 31, 50, '', '', '', ''),
(212, NULL, 'PR009', '150.00000', 51, 65, '', '', '', ''),
(213, 1, 'PR112', '100.00000', NULL, NULL, '', '', '', ''),
(214, 2, 'PR112', '105.00000', NULL, NULL, '', '', '', ''),
(215, 3, 'PR112', '110.00000', NULL, NULL, '', '', '', ''),
(216, 4, 'PR112', '115.00000', NULL, NULL, '', '', '', ''),
(217, 5, 'PR112', '120.00000', NULL, NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `py0001_b2c`
--

CREATE TABLE `py0001_b2c` (
  `ID_KEY` int(11) NOT NULL,
  `PAYMENT_SYSTEM_ID` varchar(50) NOT NULL COMMENT 'Tabel Pembayaran |P',
  `RECEIVED_SYSTEM_ID` varchar(50) DEFAULT NULL,
  `PAYMENT_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CLI_GROUP` varchar(12) NOT NULL,
  `PAYMENT_AMOUNT` double NOT NULL,
  `VA_BANK` varchar(50) NOT NULL,
  `VA_NO` varchar(50) NOT NULL,
  `VA_NAMA` varchar(100) DEFAULT NULL,
  `STATUS` int(11) NOT NULL COMMENT '0 :Belum disalurkan, 1: Sudah disalurkan, 2: Dikembalikan',
  `PAYMENT_TYPE` int(11) NOT NULL COMMENT '0:premi, 1:claim'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `py0001_b2c`
--

INSERT INTO `py0001_b2c` (`ID_KEY`, `PAYMENT_SYSTEM_ID`, `RECEIVED_SYSTEM_ID`, `PAYMENT_DATE`, `CLI_GROUP`, `PAYMENT_AMOUNT`, `VA_BANK`, `VA_NO`, `VA_NAMA`, `STATUS`, `PAYMENT_TYPE`) VALUES
(2, 'd135638c-caaa-4402-9346-73ec25307dfd', NULL, '2020-06-29 15:55:17', 'EN222', 120000, 'BNI', '4343', '', 1, 0),
(3, '39be73b9-8011-452d-a472-7df95fbb75ef', NULL, '2020-06-29 16:15:07', 'EN222', 4800000, 'BNI', '4343', '', 1, 0),
(4, 'e0fbdfed-49a9-47a3-866a-33246529da08', NULL, '2020-07-01 22:59:16', 'EN222', 96000, 'BNI', '4343', '', 1, 0),
(5, '837fde50-fe9e-4cff-8bc3-7a657af05af9', NULL, '2020-07-01 23:00:29', 'EN222', 96000, 'BNI', '4343', '', 1, 0),
(6, '30cedd6a-3b37-440d-a755-d0477b766f75', NULL, '2020-07-02 10:22:36', 'EN222', 96000, 'BNI', '4343', '', 1, 0),
(7, '304c17f7-de7a-4161-a2bf-3c2b22cad795', NULL, '2020-07-07 15:58:19', 'EN222', 528000, 'BNI', '4343', '', 1, 0),
(8, '8425deb9-3810-4b37-82e1-7d22b123bd6b', NULL, '2020-07-08 17:44:29', 'EN222', 480000, 'BNI', '4343', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `py0002_b2c`
--

CREATE TABLE `py0002_b2c` (
  `ID_KEY` int(11) NOT NULL,
  `RECEIVED_SYSTEM_ID` varchar(50) NOT NULL COMMENT 'Tabel Received |C',
  `PAYMENT_SYSTEM_ID` varchar(50) DEFAULT NULL,
  `RECEIVED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CLI_GROUP` varchar(12) NOT NULL,
  `RECEIVED_AMOUNT` double NOT NULL,
  `REKENING_BANK` varchar(50) NOT NULL,
  `REKENING_NO` varchar(50) NOT NULL,
  `REKENING_NAMA` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `py0002_b2c`
--

INSERT INTO `py0002_b2c` (`ID_KEY`, `RECEIVED_SYSTEM_ID`, `PAYMENT_SYSTEM_ID`, `RECEIVED_DATE`, `CLI_GROUP`, `RECEIVED_AMOUNT`, `REKENING_BANK`, `REKENING_NO`, `REKENING_NAMA`) VALUES
(9, 'ff4e7a6d-bef7-4ba4-b017-945008198ed3', 'd135638c-caaa-4402-9346-73ec25307dfd', '2020-06-29 08:55:17', 'EN000', 1552.5, '', '', ''),
(10, 'bbc20fbd-dd7e-4f5b-8b3e-1ad9d52b29cc', 'd135638c-caaa-4402-9346-73ec25307dfd', '2020-06-29 08:55:17', 'EN000', 1534.0909090909, 'BNI', '123', ''),
(11, '53e373a9-8a65-4532-9a14-074ef5c3c4fa', 'd135638c-caaa-4402-9346-73ec25307dfd', '2020-06-29 08:55:17', 'EN011', -2718.1818181818, 'BNI', '123', ''),
(12, '98b0401b-24ae-4b7e-927e-5ff95fb3acfe', 'd135638c-caaa-4402-9346-73ec25307dfd', '2020-06-29 08:55:17', 'EN011', 12613.636363636, 'BNI', '4343', ''),
(13, 'e6564da2-b93e-48e3-9937-072901ba8b8e', 'd135638c-caaa-4402-9346-73ec25307dfd', '2020-06-29 08:55:17', 'EN012', 51750, 'BNI', '4343', ''),
(14, '932a4e32-31e8-42d9-91fc-c8f3c0f771d2', 'd135638c-caaa-4402-9346-73ec25307dfd', '2020-06-29 08:55:17', 'EN012', 43750, 'BNI', '767', ''),
(15, '743c3e50-edad-4f5f-b5b1-399518263c17', 'd135638c-caaa-4402-9346-73ec25307dfd', '2020-06-29 08:55:17', 'EN123', 6915.6818181818, 'BNI', '3434', ''),
(16, 'f65be919-4d15-42f8-a28e-876872c94e5a', 'd135638c-caaa-4402-9346-73ec25307dfd', '2020-06-29 08:55:17', 'EN123', 4602.2727272727, 'BNI', '12312', ''),
(17, '41bc87d7-bde9-47d7-a0a3-3d44d720a65f', '39be73b9-8011-452d-a472-7df95fbb75ef', '2020-06-29 09:15:07', 'EN000', 62100, '', '', ''),
(18, '15b0d5f5-a73a-4a22-a711-a324967e524e', '39be73b9-8011-452d-a472-7df95fbb75ef', '2020-06-29 09:15:07', 'EN000', 61363.636363636, 'BNI', '123', ''),
(19, 'ba5f56e3-6675-4720-90e5-bb8660eaff4f', '39be73b9-8011-452d-a472-7df95fbb75ef', '2020-06-29 09:15:07', 'EN011', -108727.27272727, 'BNI', '123', ''),
(20, '0a88659e-6982-4701-9f82-ae017ed478f2', '39be73b9-8011-452d-a472-7df95fbb75ef', '2020-06-29 09:15:07', 'EN011', 504545.45454545, 'BNI', '4343', ''),
(21, '423dbee3-5963-4ec8-af86-a9e644c07f10', '39be73b9-8011-452d-a472-7df95fbb75ef', '2020-06-29 09:15:07', 'EN012', 2070000, 'BNI', '4343', ''),
(22, 'adfcdce6-3780-4977-b3b4-25d0a7162cc4', '39be73b9-8011-452d-a472-7df95fbb75ef', '2020-06-29 09:15:07', 'EN012', 1750000, 'BNI', '767', ''),
(23, '46b914b0-a8a0-4a78-96c3-9587c7a63860', '39be73b9-8011-452d-a472-7df95fbb75ef', '2020-06-29 09:15:07', 'EN123', 276627.27272727, 'BNI', '3434', ''),
(24, '87f23a66-6be4-47dd-b798-9cb3739d96d2', '39be73b9-8011-452d-a472-7df95fbb75ef', '2020-06-29 09:15:07', 'EN123', 184090.90909091, 'BNI', '12312', ''),
(25, 'd8129fdd-6866-41f4-8a61-747e006b5772', 'e0fbdfed-49a9-47a3-866a-33246529da08', '2020-07-01 15:59:16', 'EN000', 1242, '', '', ''),
(26, 'dde4d5df-effb-4714-a394-e573615e91b1', 'e0fbdfed-49a9-47a3-866a-33246529da08', '2020-07-01 15:59:16', 'EN000', 1227.2727272727, 'BNI', '123', ''),
(27, '5562e051-517e-4053-a92d-70644192ee62', 'e0fbdfed-49a9-47a3-866a-33246529da08', '2020-07-01 15:59:16', 'EN011', -2174.5454545455, 'BNI', '123', ''),
(28, '2e5756e4-3d2b-40c8-9162-3324202ac83f', 'e0fbdfed-49a9-47a3-866a-33246529da08', '2020-07-01 15:59:16', 'EN011', 10090.909090909, 'BNI', '4343', ''),
(29, '5ad8c95e-2ade-4fdc-9fd8-449ab25c3280', 'e0fbdfed-49a9-47a3-866a-33246529da08', '2020-07-01 15:59:16', 'EN012', 41400, 'BNI', '4343', ''),
(30, '72f1773a-15d4-49c8-9467-99ab4ebe85df', 'e0fbdfed-49a9-47a3-866a-33246529da08', '2020-07-01 15:59:16', 'EN012', 35000, 'BNI', '767', ''),
(31, '4037b4e3-4d65-4084-83cd-8158efccca48', 'e0fbdfed-49a9-47a3-866a-33246529da08', '2020-07-01 15:59:16', 'EN123', 5532.5454545455, 'BNI', '3434', ''),
(32, '02eace40-0ba6-4eb2-b0f0-62f928ebd24b', 'e0fbdfed-49a9-47a3-866a-33246529da08', '2020-07-01 15:59:16', 'EN123', 3681.8181818182, 'BNI', '12312', ''),
(33, '7c0323e3-9f95-45ae-ba2d-96cb50cbcc24', '837fde50-fe9e-4cff-8bc3-7a657af05af9', '2020-07-01 16:00:29', 'EN000', 1242, '', '', ''),
(34, 'b8d60bbf-44f0-4d4d-ad66-c06f76fbc44a', '837fde50-fe9e-4cff-8bc3-7a657af05af9', '2020-07-01 16:00:29', 'EN000', 1227.2727272727, 'BNI', '123', ''),
(35, '8583c71a-65db-4c3b-a4f3-29edfbad5da4', '837fde50-fe9e-4cff-8bc3-7a657af05af9', '2020-07-01 16:00:29', 'EN011', -2174.5454545455, 'BNI', '123', ''),
(36, '05ff8dae-73dc-4dee-927d-557cc652f85b', '837fde50-fe9e-4cff-8bc3-7a657af05af9', '2020-07-01 16:00:29', 'EN011', 10090.909090909, 'BNI', '4343', ''),
(37, 'a090fec7-431f-4553-8ba4-df8132eb2136', '837fde50-fe9e-4cff-8bc3-7a657af05af9', '2020-07-01 16:00:29', 'EN012', 41400, 'BNI', '4343', ''),
(38, '1aecc154-2f29-4ef6-bec2-9ab887a8d308', '837fde50-fe9e-4cff-8bc3-7a657af05af9', '2020-07-01 16:00:29', 'EN012', 35000, 'BNI', '767', ''),
(39, 'f7884a5b-88de-470a-baf9-0bc00702860b', '837fde50-fe9e-4cff-8bc3-7a657af05af9', '2020-07-01 16:00:29', 'EN123', 5532.5454545455, 'BNI', '3434', ''),
(40, '5e32b818-7837-4f50-8fb2-b898ad2be5ac', '837fde50-fe9e-4cff-8bc3-7a657af05af9', '2020-07-01 16:00:29', 'EN123', 3681.8181818182, 'BNI', '12312', ''),
(41, 'bc88eb7a-8f45-4ecd-a5fa-16860eff904f', '30cedd6a-3b37-440d-a755-d0477b766f75', '2020-07-02 03:22:36', 'EN000', 1242, '', '', ''),
(42, 'bad4b222-1c2b-4ab6-bb63-83bc65694221', '30cedd6a-3b37-440d-a755-d0477b766f75', '2020-07-02 03:22:36', 'EN000', 1227.2727272727, 'BNI', '123', ''),
(43, '150dcfdc-a6a1-4c99-a55c-d33eb17a4329', '30cedd6a-3b37-440d-a755-d0477b766f75', '2020-07-02 03:22:36', 'EN011', -2174.5454545455, 'BNI', '123', ''),
(44, '6026a04f-6f05-4926-97a4-5027a4754833', '30cedd6a-3b37-440d-a755-d0477b766f75', '2020-07-02 03:22:36', 'EN011', 10090.909090909, 'BNI', '4343', ''),
(45, '6ae11d81-882d-4266-9b4f-d44eaeee341a', '30cedd6a-3b37-440d-a755-d0477b766f75', '2020-07-02 03:22:36', 'EN012', 41400, 'BNI', '4343', ''),
(46, '9a0758c0-5611-4ff4-9072-ae8c3d0e0de2', '30cedd6a-3b37-440d-a755-d0477b766f75', '2020-07-02 03:22:36', 'EN012', 35000, 'BNI', '767', ''),
(47, 'e29f878a-2d8d-4011-9f56-a4188c59e3aa', '30cedd6a-3b37-440d-a755-d0477b766f75', '2020-07-02 03:22:36', 'EN123', 5532.5454545455, 'BNI', '3434', ''),
(48, '49b517f4-794f-4dbe-b6ed-56acb51de4b7', '30cedd6a-3b37-440d-a755-d0477b766f75', '2020-07-02 03:22:36', 'EN123', 3681.8181818182, 'BNI', '12312', ''),
(49, '88d2e55d-750c-4f95-8427-0d8074b987a8', '304c17f7-de7a-4161-a2bf-3c2b22cad795', '2020-07-07 08:58:19', 'EN000', 6831, '', '', ''),
(50, 'd2241483-f9eb-4078-b571-94e9ce82ecca', '304c17f7-de7a-4161-a2bf-3c2b22cad795', '2020-07-07 08:58:19', 'EN000', 6749.9999999999, 'BNI', '123', ''),
(51, '195977ec-9205-4cb2-ac48-a75de2f3d06f', '304c17f7-de7a-4161-a2bf-3c2b22cad795', '2020-07-07 08:58:19', 'EN011', -11960, 'BNI', '123', ''),
(52, 'a83b2482-8c19-4e3b-92d4-55cdc23ab922', '304c17f7-de7a-4161-a2bf-3c2b22cad795', '2020-07-07 08:58:19', 'EN011', 55500, 'BNI', '4343', ''),
(53, 'b4989ff4-8092-4cbe-aaa0-144e47b517fc', '304c17f7-de7a-4161-a2bf-3c2b22cad795', '2020-07-07 08:58:19', 'EN012', 227700, 'BNI', '4343', ''),
(54, '2e54992a-03cb-4627-aeb9-2c44c9270a6f', '304c17f7-de7a-4161-a2bf-3c2b22cad795', '2020-07-07 08:58:19', 'EN012', 192500, 'BNI', '767', ''),
(55, '55868ab5-f3c2-43f3-b45b-5c081d646693', '304c17f7-de7a-4161-a2bf-3c2b22cad795', '2020-07-07 08:58:19', 'EN123', 30429, 'BNI', '3434', ''),
(56, '2afa9b07-baf6-4b13-bf95-66bb2f8371f8', '304c17f7-de7a-4161-a2bf-3c2b22cad795', '2020-07-07 08:58:19', 'EN123', 20250, 'BNI', '12312', ''),
(57, 'f2ac8c15-70af-4f23-811d-f2434825e00d', '8425deb9-3810-4b37-82e1-7d22b123bd6b', '2020-07-08 10:44:29', 'EN000', 12346.363636364, '', '', ''),
(58, 'a6960da6-aaab-46a9-a2c6-d1e2c29d2810', '8425deb9-3810-4b37-82e1-7d22b123bd6b', '2020-07-08 10:44:29', 'EN011', 39581.818181817, '', '', ''),
(59, '33e508c5-a3d0-4257-baad-a8fadf4de75f', '8425deb9-3810-4b37-82e1-7d22b123bd6b', '2020-07-08 10:44:29', 'EN012', 382000, '', '', ''),
(60, '558ea6db-3289-49c1-aed9-3fb01a15a08e', '8425deb9-3810-4b37-82e1-7d22b123bd6b', '2020-07-08 10:44:29', 'EN123', 46071.818181818, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `reques`
--

CREATE TABLE `reques` (
  `no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `status` int(1) NOT NULL,
  `rupiah` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reques`
--

INSERT INTO `reques` (`no`, `address`, `nama`, `jumlah`, `status`, `rupiah`) VALUES
(25, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', 'hamka', '2', 0, '1287445.78'),
(28, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', 'hamka', '4', 0, '2574841.8'),
(29, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', 'hamka', '1', 0, '643667.85'),
(30, '0xeFe9952aA6Ae5bbFda77afd9Cd2fc1Bd138D5712', 'Askrida', '10', 0, '6569334'),
(31, '0xeFe9952aA6Ae5bbFda77afd9Cd2fc1Bd138D5712', 'Askrida', '100', 0, '66805011'),
(32, '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', 'adira', '100', 0, '68340554'),
(33, '0xaCE515d62cA2f4ADAbAA4aD783015C5bC428a0e4', 'adira', '4', 0, '2770278.48'),
(34, '0x4994dc78d0b31afc5c3ecf08e2b2d864d2fcbf45', 'hamka', '3', 0, '2051598.5699999998'),
(35, '0x1908F068BcAe85E92FD9d95e613F7b6CAc9Bd4eF', 'dkhairat', '', 0, ''),
(36, '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', 'makruf', '10', 0, '7513324.300000001'),
(37, '0xCfdf045Acb9C5884d31D25907122FdB4f2dE5936', 'makruf', '3', 0, '2253985.2'),
(38, '0xD0139D2ECdabFeFc4F7DE462FEB566abA73Ba654', 'Widyo', '1', 0, '731921.76'),
(39, '0xD0139D2ECdabFeFc4F7DE462FEB566abA73Ba654', 'Widyo', '2', 0, '1463843.52'),
(40, '0x5679188fe66A501E48a2E8988C0562fC318DA8dE', 'birusatu', '1', 0, '739269.07');

-- --------------------------------------------------------

--
-- Table structure for table `tr0001`
--

CREATE TABLE `tr0001` (
  `ID_KEY` bigint(20) NOT NULL COMMENT 'Tabel transaksi (main)',
  `TRX_UUID` varchar(50) NOT NULL,
  `ENTITY_ID` varchar(5) NOT NULL COMMENT 'Property User ID',
  `PROD_ID` varchar(5) NOT NULL COMMENT 'Product',
  `TRX_KTP_ID` varchar(20) NOT NULL COMMENT 'No KTP',
  `TRX_NAMA` varchar(100) NOT NULL COMMENT 'Nama',
  `TRX_TGL_LAHIR` date NOT NULL COMMENT 'Tanggal Lahir',
  `TRX_ALAMAT` varchar(200) NOT NULL COMMENT 'Alamat',
  `SUSA_ID` varchar(5) NOT NULL COMMENT 'Sektor Usaha',
  `CABANG_ID` varchar(5) NOT NULL COMMENT 'Kantor Cabang',
  `CURR_ID` varchar(3) NOT NULL COMMENT 'Mata Uang',
  `TRX_PLAFOND` double NOT NULL COMMENT 'Plafond',
  `TRX_PENCAIRAN` varchar(50) NOT NULL COMMENT 'Pencairan ID',
  `TRX_TGL_CAIR` date NOT NULL COMMENT 'Tanggal Pencairan',
  `TRX_JML_MINGG` int(3) NOT NULL DEFAULT '0' COMMENT 'Jumlah Minggu',
  `TRX_START_PRO` date NOT NULL COMMENT 'Periode Awal',
  `TRX_END_PRO` date NOT NULL COMMENT 'Periode Akhir',
  `TRX_NILAI_UK` double NOT NULL COMMENT 'Nilai UK',
  `TRX_PREMI` double NOT NULL COMMENT 'Premi',
  `CREATED_ON` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Tanggal insert data',
  `CREATED_BY` varchar(30) NOT NULL COMMENT 'User ID',
  `TRX_CURR_RATE` double NOT NULL COMMENT 'Nilai Kurs Mata Uang',
  `TRX_NMFILE` varchar(50) NOT NULL COMMENT 'Nama file unggah (jika upload data)',
  `BANK_REKENING` varchar(20) NOT NULL,
  `NO_REKENING` varchar(50) NOT NULL,
  `NAMA_REKENING` varchar(100) NOT NULL,
  `TRX_STATUS` int(2) NOT NULL COMMENT 'Status Data. 0 : New, 1: Waiting for Approval, 2 : Paid, 3: Rejected, 4:Canceled',
  `PAYMENT_SYSTEM_ID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr0001`
--

INSERT INTO `tr0001` (`ID_KEY`, `TRX_UUID`, `ENTITY_ID`, `PROD_ID`, `TRX_KTP_ID`, `TRX_NAMA`, `TRX_TGL_LAHIR`, `TRX_ALAMAT`, `SUSA_ID`, `CABANG_ID`, `CURR_ID`, `TRX_PLAFOND`, `TRX_PENCAIRAN`, `TRX_TGL_CAIR`, `TRX_JML_MINGG`, `TRX_START_PRO`, `TRX_END_PRO`, `TRX_NILAI_UK`, `TRX_PREMI`, `CREATED_ON`, `CREATED_BY`, `TRX_CURR_RATE`, `TRX_NMFILE`, `BANK_REKENING`, `NO_REKENING`, `NAMA_REKENING`, `TRX_STATUS`, `PAYMENT_SYSTEM_ID`) VALUES
(1, 'a420af1b-b574-41db-b587-937af3464ba2', 'EN222', 'PR002', '11111111130', 'YPNU', '1996-12-31', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1996-12-31', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 1, '8425deb9-3810-4b37-82e1-7d22b123bd6b'),
(2, '830665b8-d997-4f5b-902e-eb424584319e', 'EN222', 'PR002', '11111111131', 'XJLL', '1997-01-01', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-01', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 1, '8425deb9-3810-4b37-82e1-7d22b123bd6b'),
(3, 'a97a85c0-b74e-422b-9f10-c0cbb3186e61', 'EN222', 'PR002', '11111111132', 'LKQA', '1997-01-02', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-02', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 1, '8425deb9-3810-4b37-82e1-7d22b123bd6b'),
(4, 'ead42a95-a2b3-4820-826e-78ff1c2f9f01', 'EN222', 'PR002', '11111111133', 'LSTM', '1997-01-03', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-03', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 1, '8425deb9-3810-4b37-82e1-7d22b123bd6b'),
(5, '429b387f-c61c-41e7-b408-517a0d8102a9', 'EN222', 'PR002', '11111111134', 'ONRS', '1997-01-04', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-04', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 1, '8425deb9-3810-4b37-82e1-7d22b123bd6b'),
(6, '100f2539-0628-48fb-80b8-d71956330d68', 'EN222', 'PR002', '11111111135', 'CLUY', '1997-01-05', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-05', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(7, '067bd7c6-312b-4dd4-ad6b-5a85e5f20b9b', 'EN222', 'PR002', '11111111136', 'KFID', '1997-01-06', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-06', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(8, '1ff65af1-8082-4660-a922-82490f88da8a', 'EN222', 'PR002', '11111111137', 'GRLV', '1997-01-07', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-07', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(9, 'b4899501-828e-4bd0-b6a4-76bffde1e8b3', 'EN222', 'PR002', '11111111138', 'QQSP', '1997-01-08', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-08', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(10, '1452d422-120c-48f8-a0d0-711de334f8e4', 'EN222', 'PR002', '11111111139', 'AKJZ', '1997-01-09', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-09', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(11, '7b1807c6-a826-40cb-8c11-2909f7d3c7cf', 'EN222', 'PR002', '11111111140', 'RKZO', '1997-01-10', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-10', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(12, '62abd6ae-471a-4d75-b08c-66329479326e', 'EN222', 'PR002', '11111111141', 'PEGY', '1997-01-11', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-11', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(13, '80557d22-06fb-47be-a9cc-658296e86c39', 'EN222', 'PR002', '11111111142', 'TYBB', '1997-01-12', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-12', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(14, 'c7b2061a-ae24-4ba7-b266-619544d5796a', 'EN222', 'PR002', '11111111143', 'ZTNQ', '1997-01-13', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-13', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(15, 'd71a1af9-c60b-4df7-864c-453c7d3ab240', 'EN222', 'PR002', '11111111144', 'THLN', '1997-01-14', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-14', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(16, '4b601366-f069-42a9-b8fa-f2cb1aa5deed', 'EN222', 'PR002', '11111111145', 'QNNW', '1997-01-15', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-15', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(17, '08416a21-dd8f-4aa3-bee6-7292cab37172', 'EN222', 'PR002', '11111111146', 'KGYK', '1997-01-16', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-16', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(18, 'b7932fb3-60e1-40d5-82ef-6d77c1c2bc29', 'EN222', 'PR002', '11111111147', 'IANI', '1997-01-17', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-17', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(19, 'bf02e060-5967-4fa3-b86b-ed997efb00c6', 'EN222', 'PR002', '11111111148', 'YYVS', '1997-01-18', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-18', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(20, '6f7bb74f-423d-4c0b-b990-b7b656f80c46', 'EN222', 'PR002', '11111111149', 'IXWV', '1997-01-19', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-19', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(21, 'e3cee86d-e627-4479-aff6-22f87ad76228', 'EN222', 'PR002', '11111111150', 'JNGK', '1997-01-20', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-20', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(22, 'e2c552c4-d035-443e-bbf4-069d70caee29', 'EN222', 'PR002', '11111111151', 'CBPJ', '1997-01-21', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-21', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(23, '4b939f8a-c66f-4eda-a1e9-eea2a3fc8241', 'EN222', 'PR002', '11111111152', 'NAGJ', '1997-01-22', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-22', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(24, 'b51823b1-cde0-48ca-b59e-f2f48b10d07e', 'EN222', 'PR002', '11111111153', 'COOA', '1997-01-23', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-23', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(25, '5969f0d9-2d73-498e-b582-b63227e405f0', 'EN222', 'PR002', '11111111154', 'YGXM', '1997-01-24', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-24', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(26, '7c7365ef-70c7-444c-b297-9373dcd4592e', 'EN222', 'PR002', '11111111155', 'EASD', '1997-01-25', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-25', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(27, '433e16ba-5a33-47de-ad3f-5d1a802cc79a', 'EN222', 'PR002', '11111111156', 'JEEK', '1997-01-26', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-26', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(28, '2ff76d32-7496-4935-8e07-5c0d39c07b10', 'EN222', 'PR002', '11111111157', 'GVDH', '1997-01-27', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-27', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(29, '0c06f36e-9388-4750-b552-521ac71ca2d5', 'EN222', 'PR002', '11111111158', 'ZYDC', '1997-01-28', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-28', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(30, 'ab3a3168-f5ef-4e66-a7e5-5c0e1a74d9d1', 'EN222', 'PR002', '11111111159', 'PZPS', '1997-01-29', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-29', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL),
(31, '04fa55ea-b0ed-4375-bd0d-e67102f88e6f', 'EN222', 'PR002', '11111111160', 'NBXL', '1997-01-30', '', 'SU003', 'C2', 'IDR', 4000000, '111', '1997-01-30', 1, '2001-12-12', '2001-12-14', 3000000, 96000, '2020-07-08 10:44:02', '119', 0, 'templateUpload.xlsx', 'BNI', '2228888', 'Pulau Tidung (I)', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tr0001_b2c`
--

CREATE TABLE `tr0001_b2c` (
  `ID_KEY` int(11) NOT NULL,
  `TRX_SYSTEM_ID` varchar(50) NOT NULL COMMENT 'Tabel Transaksi |P',
  `CLI_SYSTEM_ID` int(11) NOT NULL,
  `PROD_ID` varchar(5) NOT NULL,
  `TRX_DATE` datetime NOT NULL,
  `TRX_CURR` varchar(3) NOT NULL,
  `TRX_CURR_RATE_IDR` double UNSIGNED NOT NULL,
  `TRX_DANA` double UNSIGNED NOT NULL,
  `TRX_PREMI` double UNSIGNED NOT NULL,
  `OBJEK_SYSTEM_ID` int(11) NOT NULL,
  `TRX_STATUS` int(2) NOT NULL COMMENT '0: New, 1: Paid, 2: All Claimed, 3:Overdue, 4: Pembayaran dikembalikan',
  `TRX_DUE` datetime NOT NULL,
  `PAYMENT_SYSTEM_ID` varchar(50) DEFAULT NULL,
  `TXHASH` varchar(100) DEFAULT NULL,
  `TRX_NO_POLICY` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr0001_b2c`
--

INSERT INTO `tr0001_b2c` (`ID_KEY`, `TRX_SYSTEM_ID`, `CLI_SYSTEM_ID`, `PROD_ID`, `TRX_DATE`, `TRX_CURR`, `TRX_CURR_RATE_IDR`, `TRX_DANA`, `TRX_PREMI`, `OBJEK_SYSTEM_ID`, `TRX_STATUS`, `TRX_DUE`, `PAYMENT_SYSTEM_ID`, `TXHASH`, `TRX_NO_POLICY`) VALUES
(1, 'da38ca86-f14d-4ab4-9cef-e7e3b81758c7', 85, 'PR123', '2020-06-25 10:41:36', 'IDR', 1, 10000000, 18000, 3, 0, '2020-06-25 10:41:36', NULL, NULL, NULL),
(2, 'edd269a3-5db3-487a-82d2-6d9f977c2b15', 85, 'PR123', '2020-07-09 10:18:52', 'IDR', 1, 100000000, 180000, 4, 0, '2020-07-09 10:18:52', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tr0002_b2c`
--

CREATE TABLE `tr0002_b2c` (
  `ID_KEY` int(11) NOT NULL,
  `TRX_DETAIL_SYSTEM_ID` varchar(50) NOT NULL COMMENT 'Tabel Detail Transaksi |C',
  `TRX_PARENT` varchar(20) NOT NULL COMMENT 'reference parent tabel',
  `TRX_SYSTEM_ID` varchar(50) NOT NULL,
  `SUB_PROD_ID` varchar(20) NOT NULL,
  `SUB_PREMI` double UNSIGNED NOT NULL,
  `TRX_CURR` varchar(3) NOT NULL,
  `TRX_CURR_RATE_IDR` double UNSIGNED NOT NULL,
  `CLAIM_TYPE` int(11) NOT NULL COMMENT '0: Terikat, 1: Bebas(Menjadikan Sub Produk lain tidak bisa diklaim)',
  `CLAIM_STATUS` int(11) DEFAULT NULL COMMENT '0: Request Claim, 1: Claim Approved, 2: Claim Paid, 3:Claim Inactive',
  `CLAIM_DUE` datetime DEFAULT NULL,
  `CLAIM_NILAI` double DEFAULT NULL,
  `RECEIVED_SYSTEM_ID` varchar(50) DEFAULT NULL,
  `KOOR_LAT` double DEFAULT NULL COMMENT 'diisi jika sub produk=gempa',
  `KOOR_LANG` double DEFAULT NULL COMMENT 'diisi jika sub produk=gempa',
  `EQ_SYSTEM_ID` int(11) DEFAULT NULL,
  `EQ_RESIKO` double DEFAULT NULL,
  `EQ_JARAK` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr0002_b2c`
--

INSERT INTO `tr0002_b2c` (`ID_KEY`, `TRX_DETAIL_SYSTEM_ID`, `TRX_PARENT`, `TRX_SYSTEM_ID`, `SUB_PROD_ID`, `SUB_PREMI`, `TRX_CURR`, `TRX_CURR_RATE_IDR`, `CLAIM_TYPE`, `CLAIM_STATUS`, `CLAIM_DUE`, `CLAIM_NILAI`, `RECEIVED_SYSTEM_ID`, `KOOR_LAT`, `KOOR_LANG`, `EQ_SYSTEM_ID`, `EQ_RESIKO`, `EQ_JARAK`) VALUES
(1, 'f4b930c9-f1f6-4aad-bc7d-c625a98d20f6', 'tr0001_b2c', 'da38ca86-f14d-4ab4-9cef-e7e3b81758c7', 'PR003', 18000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'cf348cf5-bff1-4489-81dc-dbed18869843', 'tr0001_b2c', 'edd269a3-5db3-487a-82d2-6d9f977c2b15', 'PR003', 180000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '7aba837b-4568-408f-951d-e7fc81f5f61e', 'tr0001', 'a420af1b-b574-41db-b587-937af3464ba2', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(4, '45f2d5f4-dbd3-463c-ab2d-7ff9bde16131', 'tr0001', 'a420af1b-b574-41db-b587-937af3464ba2', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '98bfa86a-8ac6-4ad0-b6ad-fc23958341fe', 'tr0001', '830665b8-d997-4f5b-902e-eb424584319e', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(6, '26bbb459-582c-48d6-acb8-eecacd3c0050', 'tr0001', '830665b8-d997-4f5b-902e-eb424584319e', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'a7459892-3758-4001-af85-b5358c0406c1', 'tr0001', 'a97a85c0-b74e-422b-9f10-c0cbb3186e61', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(8, '51a16ba1-5bbd-4abe-bc20-99251b25e6b4', 'tr0001', 'a97a85c0-b74e-422b-9f10-c0cbb3186e61', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '81675014-3f73-4e38-9326-bd0f9febf8be', 'tr0001', 'ead42a95-a2b3-4820-826e-78ff1c2f9f01', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(10, 'cce9757b-5022-4f26-865d-e6b7bc375c4c', 'tr0001', 'ead42a95-a2b3-4820-826e-78ff1c2f9f01', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'f083888e-ce2c-4f6d-8285-8fefed66c733', 'tr0001', '429b387f-c61c-41e7-b408-517a0d8102a9', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(12, 'ef83d9b2-d511-4843-8230-324b2eb8610a', 'tr0001', '429b387f-c61c-41e7-b408-517a0d8102a9', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '56051e17-fc9f-4ba3-b344-fa4b8709807e', 'tr0001', '100f2539-0628-48fb-80b8-d71956330d68', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(14, '19f20389-e09d-49a9-a02e-2dc45d637082', 'tr0001', '100f2539-0628-48fb-80b8-d71956330d68', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'b4d44447-391d-4572-ad21-f28915e767fc', 'tr0001', '067bd7c6-312b-4dd4-ad6b-5a85e5f20b9b', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(16, '06d60bbf-956a-45a3-a239-7a7afe9f5018', 'tr0001', '067bd7c6-312b-4dd4-ad6b-5a85e5f20b9b', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'b0d71ebe-31e7-46b3-8178-da0dd589bdbf', 'tr0001', '1ff65af1-8082-4660-a922-82490f88da8a', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(18, 'b1b64b29-44ac-4f9a-809b-bd585e49c711', 'tr0001', '1ff65af1-8082-4660-a922-82490f88da8a', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'a07ac4c4-12f0-44f1-853e-f0aba7dba377', 'tr0001', 'b4899501-828e-4bd0-b6a4-76bffde1e8b3', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(20, 'fcb60c2f-6c58-4106-9a69-0875020f81e7', 'tr0001', 'b4899501-828e-4bd0-b6a4-76bffde1e8b3', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'a59026e3-808a-494a-8221-3ae8c1658dd9', 'tr0001', '1452d422-120c-48f8-a0d0-711de334f8e4', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(22, '07dc34a1-f710-4d68-ac0d-0b1b67ad38e2', 'tr0001', '1452d422-120c-48f8-a0d0-711de334f8e4', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '7dc2d9c0-0eb9-46df-bafb-01991da7d26a', 'tr0001', '7b1807c6-a826-40cb-8c11-2909f7d3c7cf', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(24, '52c30db6-43ae-46ea-93db-361f171b2959', 'tr0001', '7b1807c6-a826-40cb-8c11-2909f7d3c7cf', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '59b91b08-7371-4ad9-9ee3-fff8b1122d5a', 'tr0001', '62abd6ae-471a-4d75-b08c-66329479326e', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(26, '003eb83f-9624-4706-a74b-4bbc3c395998', 'tr0001', '62abd6ae-471a-4d75-b08c-66329479326e', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'ca9fd351-9444-477b-9e74-46d9a32eea85', 'tr0001', '80557d22-06fb-47be-a9cc-658296e86c39', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(28, '996dd9f5-1ff4-4278-a0dd-d753121ed8ce', 'tr0001', '80557d22-06fb-47be-a9cc-658296e86c39', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'ff9caeab-2a65-4052-bc8f-539ab85e0c6b', 'tr0001', 'c7b2061a-ae24-4ba7-b266-619544d5796a', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(30, '89d2cdac-9c65-406e-a078-75647a5e7669', 'tr0001', 'c7b2061a-ae24-4ba7-b266-619544d5796a', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, '3f278289-722d-4c25-8330-02516ec924d6', 'tr0001', 'd71a1af9-c60b-4df7-864c-453c7d3ab240', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(32, 'aba784ac-0230-47e6-a77b-a2f0a3789d35', 'tr0001', 'd71a1af9-c60b-4df7-864c-453c7d3ab240', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'e8182958-8f23-46f9-b7df-f9785d818703', 'tr0001', '4b601366-f069-42a9-b8fa-f2cb1aa5deed', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(34, 'b00794dd-adac-4e82-b760-e3240a54a8cc', 'tr0001', '4b601366-f069-42a9-b8fa-f2cb1aa5deed', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, '2121bca7-df18-47e4-b2b6-da5b6bd1a522', 'tr0001', '08416a21-dd8f-4aa3-bee6-7292cab37172', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(36, 'e81ab7a4-e7ea-4228-a7d7-4d3eda6276e8', 'tr0001', '08416a21-dd8f-4aa3-bee6-7292cab37172', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, '38c6ad9b-27a3-4b77-a7c1-73d58c4ebb98', 'tr0001', 'b7932fb3-60e1-40d5-82ef-6d77c1c2bc29', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(38, '3e45bf4d-6fe5-4c5a-afba-30017db69943', 'tr0001', 'b7932fb3-60e1-40d5-82ef-6d77c1c2bc29', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, '27419493-ed7b-4f9e-bceb-070daab55f98', 'tr0001', 'bf02e060-5967-4fa3-b86b-ed997efb00c6', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(40, '19de52a1-b255-467c-b8af-f8cc462fbdd2', 'tr0001', 'bf02e060-5967-4fa3-b86b-ed997efb00c6', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'cbd18adf-71a5-40ba-b13d-5ee530071d6a', 'tr0001', '6f7bb74f-423d-4c0b-b990-b7b656f80c46', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(42, 'd4d223a0-e249-4bb3-b53b-450bd9345546', 'tr0001', '6f7bb74f-423d-4c0b-b990-b7b656f80c46', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, '25ce18d0-e005-4546-9857-49ecc6ea45b9', 'tr0001', 'e3cee86d-e627-4479-aff6-22f87ad76228', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(44, '51dfa8b8-4f89-410c-815f-93013d1475a8', 'tr0001', 'e3cee86d-e627-4479-aff6-22f87ad76228', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'dd4eb849-84c2-4c8c-8ff3-6769465a9604', 'tr0001', 'e2c552c4-d035-443e-bbf4-069d70caee29', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(46, 'c9bc75f9-55af-4108-8b30-fd94cd955743', 'tr0001', 'e2c552c4-d035-443e-bbf4-069d70caee29', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, '294d8b78-d950-4df8-89a3-c7222233ba42', 'tr0001', '4b939f8a-c66f-4eda-a1e9-eea2a3fc8241', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(48, '718e8bf4-645a-403a-bcbb-e915e34c63b2', 'tr0001', '4b939f8a-c66f-4eda-a1e9-eea2a3fc8241', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, '6beb7002-52eb-48c6-8a74-fd2dc9a2ff78', 'tr0001', 'b51823b1-cde0-48ca-b59e-f2f48b10d07e', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(50, 'fc069b03-7bd2-4f05-8c3e-03256797d191', 'tr0001', 'b51823b1-cde0-48ca-b59e-f2f48b10d07e', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, '52935f8a-2d4f-4285-9d12-e70f2c4768a0', 'tr0001', '5969f0d9-2d73-498e-b582-b63227e405f0', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(52, '8431e450-cfd5-4f3a-91a2-2d4b2941284a', 'tr0001', '5969f0d9-2d73-498e-b582-b63227e405f0', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, '18e46da9-3053-4826-a17b-37426321480f', 'tr0001', '7c7365ef-70c7-444c-b297-9373dcd4592e', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(54, '446967bd-9fb5-44e7-8d29-7019bf7954d1', 'tr0001', '7c7365ef-70c7-444c-b297-9373dcd4592e', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, '5d86ac8e-4b8d-424f-a195-c3838b0ff0b4', 'tr0001', '433e16ba-5a33-47de-ad3f-5d1a802cc79a', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(56, '8d8bd14f-c5b5-4f82-b400-ac53155d58a2', 'tr0001', '433e16ba-5a33-47de-ad3f-5d1a802cc79a', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'e6e3c6dc-f2e4-4b38-91a6-91f75a40fbd1', 'tr0001', '2ff76d32-7496-4935-8e07-5c0d39c07b10', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(58, '1feb243b-4f2f-4a70-95c8-c33866f6c7c2', 'tr0001', '2ff76d32-7496-4935-8e07-5c0d39c07b10', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, '8a5fac2c-d1aa-4223-bdd7-12563e052a1a', 'tr0001', '0c06f36e-9388-4750-b552-521ac71ca2d5', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(60, '493c8836-c633-493a-8f3c-a9c06f88f43b', 'tr0001', '0c06f36e-9388-4750-b552-521ac71ca2d5', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, '90e433fb-e33f-4e86-b4a0-74dc7bfeb171', 'tr0001', 'ab3a3168-f5ef-4e66-a7e5-5c0e1a74d9d1', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(62, 'd76e7b8c-9df4-4cfd-a5cc-6d14bf774fee', 'tr0001', 'ab3a3168-f5ef-4e66-a7e5-5c0e1a74d9d1', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, '8fe897a4-bc27-4a90-bb2e-a6419e444b2d', 'tr0001', '04fa55ea-b0ed-4375-bd0d-e67102f88e6f', 'PR112', 46000, 'IDR', 1, 0, NULL, NULL, NULL, NULL, -5.8032053, 106.5237907, NULL, NULL, NULL),
(64, 'cceed42c-f73b-4bbd-8922-ba04694c7eea', 'tr0001', '04fa55ea-b0ed-4375-bd0d-e67102f88e6f', 'PR113', 50000, 'IDR', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tr0003_b2c`
--

CREATE TABLE `tr0003_b2c` (
  `PEMBAGIAN_SYSTEM_ID` int(11) NOT NULL COMMENT 'Tabel Pembagian Premi |CC',
  `TRX_DETAIL_SYSTEM_ID` varchar(50) NOT NULL,
  `ENTITY_ID` varchar(5) NOT NULL,
  `NILAI` double NOT NULL COMMENT 'nilai pembagian premi tiap sub prod&entity',
  `VA_IN_BANK` varchar(20) NOT NULL,
  `VA_IN_NO` varchar(25) NOT NULL,
  `RECEIVED_SYSTEM_ID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr0003_b2c`
--

INSERT INTO `tr0003_b2c` (`PEMBAGIAN_SYSTEM_ID`, `TRX_DETAIL_SYSTEM_ID`, `ENTITY_ID`, `NILAI`, `VA_IN_BANK`, `VA_IN_NO`, `RECEIVED_SYSTEM_ID`) VALUES
(33, 'f4b930c9-f1f6-4aad-bc7d-c625a98d20f6', 'EN011', 2798.1818181818, 'BNI', '3434', NULL),
(34, 'f4b930c9-f1f6-4aad-bc7d-c625a98d20f6', 'EN222', 2160, 'BNI', '123', NULL),
(35, 'f4b930c9-f1f6-4aad-bc7d-c625a98d20f6', 'EN012', 7740, 'BNI', '4343', NULL),
(36, 'f4b930c9-f1f6-4aad-bc7d-c625a98d20f6', 'EN123', 3600, 'BNI', '123', NULL),
(37, 'f4b930c9-f1f6-4aad-bc7d-c625a98d20f6', 'EN000', 883.63636363636, 'BNI', '3434', NULL),
(38, 'f4b930c9-f1f6-4aad-bc7d-c625a98d20f6', 'PR333', 818.18181818182, 'BNI', '3434', NULL),
(327, 'cf348cf5-bff1-4489-81dc-dbed18869843', 'EN011', 27981.818181818, 'BNI', '3434', NULL),
(328, 'cf348cf5-bff1-4489-81dc-dbed18869843', 'EN222', 21600, 'BNI', '123', NULL),
(329, 'cf348cf5-bff1-4489-81dc-dbed18869843', 'EN012', 77400, 'BNI', '4343', NULL),
(330, 'cf348cf5-bff1-4489-81dc-dbed18869843', 'EN123', 36000, 'BNI', '123', NULL),
(331, 'cf348cf5-bff1-4489-81dc-dbed18869843', 'EN000', 8836.3636363636, 'BNI', '3434', NULL),
(332, 'cf348cf5-bff1-4489-81dc-dbed18869843', 'PR333', 8181.8181818182, 'BNI', '3434', NULL),
(333, '7aba837b-4568-408f-951d-e7fc81f5f61e', 'EN123', 5532.5454545455, '', '', '558ea6db-3289-49c1-aed9-3fb01a15a08e'),
(334, '7aba837b-4568-408f-951d-e7fc81f5f61e', 'EN011', -2174.5454545455, '', '', 'a6960da6-aaab-46a9-a2c6-d1e2c29d2810'),
(335, '7aba837b-4568-408f-951d-e7fc81f5f61e', 'EN000', 1242, '', '', 'f2ac8c15-70af-4f23-811d-f2434825e00d'),
(336, '7aba837b-4568-408f-951d-e7fc81f5f61e', 'EN012', 41400, '', '', '33e508c5-a3d0-4257-baad-a8fadf4de75f'),
(337, '45f2d5f4-dbd3-463c-ab2d-7ff9bde16131', 'EN123', 3681.8181818182, '', '', '558ea6db-3289-49c1-aed9-3fb01a15a08e'),
(338, '45f2d5f4-dbd3-463c-ab2d-7ff9bde16131', 'EN011', 10090.909090909, '', '', 'a6960da6-aaab-46a9-a2c6-d1e2c29d2810'),
(339, '45f2d5f4-dbd3-463c-ab2d-7ff9bde16131', 'EN000', 1227.2727272727, '', '', 'f2ac8c15-70af-4f23-811d-f2434825e00d'),
(340, '45f2d5f4-dbd3-463c-ab2d-7ff9bde16131', 'EN012', 35000, '', '', '33e508c5-a3d0-4257-baad-a8fadf4de75f'),
(341, '98bfa86a-8ac6-4ad0-b6ad-fc23958341fe', 'EN123', 5532.5454545455, '', '', '558ea6db-3289-49c1-aed9-3fb01a15a08e'),
(342, '98bfa86a-8ac6-4ad0-b6ad-fc23958341fe', 'EN011', -2174.5454545455, '', '', 'a6960da6-aaab-46a9-a2c6-d1e2c29d2810'),
(343, '98bfa86a-8ac6-4ad0-b6ad-fc23958341fe', 'EN000', 1242, '', '', 'f2ac8c15-70af-4f23-811d-f2434825e00d'),
(344, '98bfa86a-8ac6-4ad0-b6ad-fc23958341fe', 'EN012', 41400, '', '', '33e508c5-a3d0-4257-baad-a8fadf4de75f'),
(345, '26bbb459-582c-48d6-acb8-eecacd3c0050', 'EN123', 3681.8181818182, '', '', '558ea6db-3289-49c1-aed9-3fb01a15a08e'),
(346, '26bbb459-582c-48d6-acb8-eecacd3c0050', 'EN011', 10090.909090909, '', '', 'a6960da6-aaab-46a9-a2c6-d1e2c29d2810'),
(347, '26bbb459-582c-48d6-acb8-eecacd3c0050', 'EN000', 1227.2727272727, '', '', 'f2ac8c15-70af-4f23-811d-f2434825e00d'),
(348, '26bbb459-582c-48d6-acb8-eecacd3c0050', 'EN012', 35000, '', '', '33e508c5-a3d0-4257-baad-a8fadf4de75f'),
(349, 'a7459892-3758-4001-af85-b5358c0406c1', 'EN123', 5532.5454545455, '', '', '558ea6db-3289-49c1-aed9-3fb01a15a08e'),
(350, 'a7459892-3758-4001-af85-b5358c0406c1', 'EN011', -2174.5454545455, '', '', 'a6960da6-aaab-46a9-a2c6-d1e2c29d2810'),
(351, 'a7459892-3758-4001-af85-b5358c0406c1', 'EN000', 1242, '', '', 'f2ac8c15-70af-4f23-811d-f2434825e00d'),
(352, 'a7459892-3758-4001-af85-b5358c0406c1', 'EN012', 41400, '', '', '33e508c5-a3d0-4257-baad-a8fadf4de75f'),
(353, '51a16ba1-5bbd-4abe-bc20-99251b25e6b4', 'EN123', 3681.8181818182, '', '', '558ea6db-3289-49c1-aed9-3fb01a15a08e'),
(354, '51a16ba1-5bbd-4abe-bc20-99251b25e6b4', 'EN011', 10090.909090909, '', '', 'a6960da6-aaab-46a9-a2c6-d1e2c29d2810'),
(355, '51a16ba1-5bbd-4abe-bc20-99251b25e6b4', 'EN000', 1227.2727272727, '', '', 'f2ac8c15-70af-4f23-811d-f2434825e00d'),
(356, '51a16ba1-5bbd-4abe-bc20-99251b25e6b4', 'EN012', 35000, '', '', '33e508c5-a3d0-4257-baad-a8fadf4de75f'),
(357, '81675014-3f73-4e38-9326-bd0f9febf8be', 'EN123', 5532.5454545455, '', '', '558ea6db-3289-49c1-aed9-3fb01a15a08e'),
(358, '81675014-3f73-4e38-9326-bd0f9febf8be', 'EN011', -2174.5454545455, '', '', 'a6960da6-aaab-46a9-a2c6-d1e2c29d2810'),
(359, '81675014-3f73-4e38-9326-bd0f9febf8be', 'EN000', 1242, '', '', 'f2ac8c15-70af-4f23-811d-f2434825e00d'),
(360, '81675014-3f73-4e38-9326-bd0f9febf8be', 'EN012', 41400, '', '', '33e508c5-a3d0-4257-baad-a8fadf4de75f'),
(361, 'cce9757b-5022-4f26-865d-e6b7bc375c4c', 'EN123', 3681.8181818182, '', '', '558ea6db-3289-49c1-aed9-3fb01a15a08e'),
(362, 'cce9757b-5022-4f26-865d-e6b7bc375c4c', 'EN011', 10090.909090909, '', '', 'a6960da6-aaab-46a9-a2c6-d1e2c29d2810'),
(363, 'cce9757b-5022-4f26-865d-e6b7bc375c4c', 'EN000', 1227.2727272727, '', '', 'f2ac8c15-70af-4f23-811d-f2434825e00d'),
(364, 'cce9757b-5022-4f26-865d-e6b7bc375c4c', 'EN012', 35000, '', '', '33e508c5-a3d0-4257-baad-a8fadf4de75f'),
(365, 'f083888e-ce2c-4f6d-8285-8fefed66c733', 'EN123', 5532.5454545455, '', '', '558ea6db-3289-49c1-aed9-3fb01a15a08e'),
(366, 'f083888e-ce2c-4f6d-8285-8fefed66c733', 'EN011', -2174.5454545455, '', '', 'a6960da6-aaab-46a9-a2c6-d1e2c29d2810'),
(367, 'f083888e-ce2c-4f6d-8285-8fefed66c733', 'EN000', 1242, '', '', 'f2ac8c15-70af-4f23-811d-f2434825e00d'),
(368, 'f083888e-ce2c-4f6d-8285-8fefed66c733', 'EN012', 41400, '', '', '33e508c5-a3d0-4257-baad-a8fadf4de75f'),
(369, 'ef83d9b2-d511-4843-8230-324b2eb8610a', 'EN123', 3681.8181818182, '', '', '558ea6db-3289-49c1-aed9-3fb01a15a08e'),
(370, 'ef83d9b2-d511-4843-8230-324b2eb8610a', 'EN011', 10090.909090909, '', '', 'a6960da6-aaab-46a9-a2c6-d1e2c29d2810'),
(371, 'ef83d9b2-d511-4843-8230-324b2eb8610a', 'EN000', 1227.2727272727, '', '', 'f2ac8c15-70af-4f23-811d-f2434825e00d'),
(372, 'ef83d9b2-d511-4843-8230-324b2eb8610a', 'EN012', 35000, '', '', '33e508c5-a3d0-4257-baad-a8fadf4de75f'),
(373, '56051e17-fc9f-4ba3-b344-fa4b8709807e', 'EN123', 5532.5454545455, '', '', NULL),
(374, '56051e17-fc9f-4ba3-b344-fa4b8709807e', 'EN011', -2174.5454545455, '', '', NULL),
(375, '56051e17-fc9f-4ba3-b344-fa4b8709807e', 'EN000', 1242, '', '', NULL),
(376, '56051e17-fc9f-4ba3-b344-fa4b8709807e', 'EN012', 41400, '', '', NULL),
(377, '19f20389-e09d-49a9-a02e-2dc45d637082', 'EN123', 3681.8181818182, '', '', NULL),
(378, '19f20389-e09d-49a9-a02e-2dc45d637082', 'EN011', 10090.909090909, '', '', NULL),
(379, '19f20389-e09d-49a9-a02e-2dc45d637082', 'EN000', 1227.2727272727, '', '', NULL),
(380, '19f20389-e09d-49a9-a02e-2dc45d637082', 'EN012', 35000, '', '', NULL),
(381, 'b4d44447-391d-4572-ad21-f28915e767fc', 'EN123', 5532.5454545455, '', '', NULL),
(382, 'b4d44447-391d-4572-ad21-f28915e767fc', 'EN011', -2174.5454545455, '', '', NULL),
(383, 'b4d44447-391d-4572-ad21-f28915e767fc', 'EN000', 1242, '', '', NULL),
(384, 'b4d44447-391d-4572-ad21-f28915e767fc', 'EN012', 41400, '', '', NULL),
(385, '06d60bbf-956a-45a3-a239-7a7afe9f5018', 'EN123', 3681.8181818182, '', '', NULL),
(386, '06d60bbf-956a-45a3-a239-7a7afe9f5018', 'EN011', 10090.909090909, '', '', NULL),
(387, '06d60bbf-956a-45a3-a239-7a7afe9f5018', 'EN000', 1227.2727272727, '', '', NULL),
(388, '06d60bbf-956a-45a3-a239-7a7afe9f5018', 'EN012', 35000, '', '', NULL),
(389, 'b0d71ebe-31e7-46b3-8178-da0dd589bdbf', 'EN123', 5532.5454545455, '', '', NULL),
(390, 'b0d71ebe-31e7-46b3-8178-da0dd589bdbf', 'EN011', -2174.5454545455, '', '', NULL),
(391, 'b0d71ebe-31e7-46b3-8178-da0dd589bdbf', 'EN000', 1242, '', '', NULL),
(392, 'b0d71ebe-31e7-46b3-8178-da0dd589bdbf', 'EN012', 41400, '', '', NULL),
(393, 'b1b64b29-44ac-4f9a-809b-bd585e49c711', 'EN123', 3681.8181818182, '', '', NULL),
(394, 'b1b64b29-44ac-4f9a-809b-bd585e49c711', 'EN011', 10090.909090909, '', '', NULL),
(395, 'b1b64b29-44ac-4f9a-809b-bd585e49c711', 'EN000', 1227.2727272727, '', '', NULL),
(396, 'b1b64b29-44ac-4f9a-809b-bd585e49c711', 'EN012', 35000, '', '', NULL),
(397, 'a07ac4c4-12f0-44f1-853e-f0aba7dba377', 'EN123', 5532.5454545455, '', '', NULL),
(398, 'a07ac4c4-12f0-44f1-853e-f0aba7dba377', 'EN011', -2174.5454545455, '', '', NULL),
(399, 'a07ac4c4-12f0-44f1-853e-f0aba7dba377', 'EN000', 1242, '', '', NULL),
(400, 'a07ac4c4-12f0-44f1-853e-f0aba7dba377', 'EN012', 41400, '', '', NULL),
(401, 'fcb60c2f-6c58-4106-9a69-0875020f81e7', 'EN123', 3681.8181818182, '', '', NULL),
(402, 'fcb60c2f-6c58-4106-9a69-0875020f81e7', 'EN011', 10090.909090909, '', '', NULL),
(403, 'fcb60c2f-6c58-4106-9a69-0875020f81e7', 'EN000', 1227.2727272727, '', '', NULL),
(404, 'fcb60c2f-6c58-4106-9a69-0875020f81e7', 'EN012', 35000, '', '', NULL),
(405, 'a59026e3-808a-494a-8221-3ae8c1658dd9', 'EN123', 5532.5454545455, '', '', NULL),
(406, 'a59026e3-808a-494a-8221-3ae8c1658dd9', 'EN011', -2174.5454545455, '', '', NULL),
(407, 'a59026e3-808a-494a-8221-3ae8c1658dd9', 'EN000', 1242, '', '', NULL),
(408, 'a59026e3-808a-494a-8221-3ae8c1658dd9', 'EN012', 41400, '', '', NULL),
(409, '07dc34a1-f710-4d68-ac0d-0b1b67ad38e2', 'EN123', 3681.8181818182, '', '', NULL),
(410, '07dc34a1-f710-4d68-ac0d-0b1b67ad38e2', 'EN011', 10090.909090909, '', '', NULL),
(411, '07dc34a1-f710-4d68-ac0d-0b1b67ad38e2', 'EN000', 1227.2727272727, '', '', NULL),
(412, '07dc34a1-f710-4d68-ac0d-0b1b67ad38e2', 'EN012', 35000, '', '', NULL),
(413, '7dc2d9c0-0eb9-46df-bafb-01991da7d26a', 'EN123', 5532.5454545455, '', '', NULL),
(414, '7dc2d9c0-0eb9-46df-bafb-01991da7d26a', 'EN011', -2174.5454545455, '', '', NULL),
(415, '7dc2d9c0-0eb9-46df-bafb-01991da7d26a', 'EN000', 1242, '', '', NULL),
(416, '7dc2d9c0-0eb9-46df-bafb-01991da7d26a', 'EN012', 41400, '', '', NULL),
(417, '52c30db6-43ae-46ea-93db-361f171b2959', 'EN123', 3681.8181818182, '', '', NULL),
(418, '52c30db6-43ae-46ea-93db-361f171b2959', 'EN011', 10090.909090909, '', '', NULL),
(419, '52c30db6-43ae-46ea-93db-361f171b2959', 'EN000', 1227.2727272727, '', '', NULL),
(420, '52c30db6-43ae-46ea-93db-361f171b2959', 'EN012', 35000, '', '', NULL),
(421, '59b91b08-7371-4ad9-9ee3-fff8b1122d5a', 'EN123', 5532.5454545455, '', '', NULL),
(422, '59b91b08-7371-4ad9-9ee3-fff8b1122d5a', 'EN011', -2174.5454545455, '', '', NULL),
(423, '59b91b08-7371-4ad9-9ee3-fff8b1122d5a', 'EN000', 1242, '', '', NULL),
(424, '59b91b08-7371-4ad9-9ee3-fff8b1122d5a', 'EN012', 41400, '', '', NULL),
(425, '003eb83f-9624-4706-a74b-4bbc3c395998', 'EN123', 3681.8181818182, '', '', NULL),
(426, '003eb83f-9624-4706-a74b-4bbc3c395998', 'EN011', 10090.909090909, '', '', NULL),
(427, '003eb83f-9624-4706-a74b-4bbc3c395998', 'EN000', 1227.2727272727, '', '', NULL),
(428, '003eb83f-9624-4706-a74b-4bbc3c395998', 'EN012', 35000, '', '', NULL),
(429, 'ca9fd351-9444-477b-9e74-46d9a32eea85', 'EN123', 5532.5454545455, '', '', NULL),
(430, 'ca9fd351-9444-477b-9e74-46d9a32eea85', 'EN011', -2174.5454545455, '', '', NULL),
(431, 'ca9fd351-9444-477b-9e74-46d9a32eea85', 'EN000', 1242, '', '', NULL),
(432, 'ca9fd351-9444-477b-9e74-46d9a32eea85', 'EN012', 41400, '', '', NULL),
(433, '996dd9f5-1ff4-4278-a0dd-d753121ed8ce', 'EN123', 3681.8181818182, '', '', NULL),
(434, '996dd9f5-1ff4-4278-a0dd-d753121ed8ce', 'EN011', 10090.909090909, '', '', NULL),
(435, '996dd9f5-1ff4-4278-a0dd-d753121ed8ce', 'EN000', 1227.2727272727, '', '', NULL),
(436, '996dd9f5-1ff4-4278-a0dd-d753121ed8ce', 'EN012', 35000, '', '', NULL),
(437, 'ff9caeab-2a65-4052-bc8f-539ab85e0c6b', 'EN123', 5532.5454545455, '', '', NULL),
(438, 'ff9caeab-2a65-4052-bc8f-539ab85e0c6b', 'EN011', -2174.5454545455, '', '', NULL),
(439, 'ff9caeab-2a65-4052-bc8f-539ab85e0c6b', 'EN000', 1242, '', '', NULL),
(440, 'ff9caeab-2a65-4052-bc8f-539ab85e0c6b', 'EN012', 41400, '', '', NULL),
(441, '89d2cdac-9c65-406e-a078-75647a5e7669', 'EN123', 3681.8181818182, '', '', NULL),
(442, '89d2cdac-9c65-406e-a078-75647a5e7669', 'EN011', 10090.909090909, '', '', NULL),
(443, '89d2cdac-9c65-406e-a078-75647a5e7669', 'EN000', 1227.2727272727, '', '', NULL),
(444, '89d2cdac-9c65-406e-a078-75647a5e7669', 'EN012', 35000, '', '', NULL),
(445, '3f278289-722d-4c25-8330-02516ec924d6', 'EN123', 5532.5454545455, '', '', NULL),
(446, '3f278289-722d-4c25-8330-02516ec924d6', 'EN011', -2174.5454545455, '', '', NULL),
(447, '3f278289-722d-4c25-8330-02516ec924d6', 'EN000', 1242, '', '', NULL),
(448, '3f278289-722d-4c25-8330-02516ec924d6', 'EN012', 41400, '', '', NULL),
(449, 'aba784ac-0230-47e6-a77b-a2f0a3789d35', 'EN123', 3681.8181818182, '', '', NULL),
(450, 'aba784ac-0230-47e6-a77b-a2f0a3789d35', 'EN011', 10090.909090909, '', '', NULL),
(451, 'aba784ac-0230-47e6-a77b-a2f0a3789d35', 'EN000', 1227.2727272727, '', '', NULL),
(452, 'aba784ac-0230-47e6-a77b-a2f0a3789d35', 'EN012', 35000, '', '', NULL),
(453, 'e8182958-8f23-46f9-b7df-f9785d818703', 'EN123', 5532.5454545455, '', '', NULL),
(454, 'e8182958-8f23-46f9-b7df-f9785d818703', 'EN011', -2174.5454545455, '', '', NULL),
(455, 'e8182958-8f23-46f9-b7df-f9785d818703', 'EN000', 1242, '', '', NULL),
(456, 'e8182958-8f23-46f9-b7df-f9785d818703', 'EN012', 41400, '', '', NULL),
(457, 'b00794dd-adac-4e82-b760-e3240a54a8cc', 'EN123', 3681.8181818182, '', '', NULL),
(458, 'b00794dd-adac-4e82-b760-e3240a54a8cc', 'EN011', 10090.909090909, '', '', NULL),
(459, 'b00794dd-adac-4e82-b760-e3240a54a8cc', 'EN000', 1227.2727272727, '', '', NULL),
(460, 'b00794dd-adac-4e82-b760-e3240a54a8cc', 'EN012', 35000, '', '', NULL),
(461, '2121bca7-df18-47e4-b2b6-da5b6bd1a522', 'EN123', 5532.5454545455, '', '', NULL),
(462, '2121bca7-df18-47e4-b2b6-da5b6bd1a522', 'EN011', -2174.5454545455, '', '', NULL),
(463, '2121bca7-df18-47e4-b2b6-da5b6bd1a522', 'EN000', 1242, '', '', NULL),
(464, '2121bca7-df18-47e4-b2b6-da5b6bd1a522', 'EN012', 41400, '', '', NULL),
(465, 'e81ab7a4-e7ea-4228-a7d7-4d3eda6276e8', 'EN123', 3681.8181818182, '', '', NULL),
(466, 'e81ab7a4-e7ea-4228-a7d7-4d3eda6276e8', 'EN011', 10090.909090909, '', '', NULL),
(467, 'e81ab7a4-e7ea-4228-a7d7-4d3eda6276e8', 'EN000', 1227.2727272727, '', '', NULL),
(468, 'e81ab7a4-e7ea-4228-a7d7-4d3eda6276e8', 'EN012', 35000, '', '', NULL),
(469, '38c6ad9b-27a3-4b77-a7c1-73d58c4ebb98', 'EN123', 5532.5454545455, '', '', NULL),
(470, '38c6ad9b-27a3-4b77-a7c1-73d58c4ebb98', 'EN011', -2174.5454545455, '', '', NULL),
(471, '38c6ad9b-27a3-4b77-a7c1-73d58c4ebb98', 'EN000', 1242, '', '', NULL),
(472, '38c6ad9b-27a3-4b77-a7c1-73d58c4ebb98', 'EN012', 41400, '', '', NULL),
(473, '3e45bf4d-6fe5-4c5a-afba-30017db69943', 'EN123', 3681.8181818182, '', '', NULL),
(474, '3e45bf4d-6fe5-4c5a-afba-30017db69943', 'EN011', 10090.909090909, '', '', NULL),
(475, '3e45bf4d-6fe5-4c5a-afba-30017db69943', 'EN000', 1227.2727272727, '', '', NULL),
(476, '3e45bf4d-6fe5-4c5a-afba-30017db69943', 'EN012', 35000, '', '', NULL),
(477, '27419493-ed7b-4f9e-bceb-070daab55f98', 'EN123', 5532.5454545455, '', '', NULL),
(478, '27419493-ed7b-4f9e-bceb-070daab55f98', 'EN011', -2174.5454545455, '', '', NULL),
(479, '27419493-ed7b-4f9e-bceb-070daab55f98', 'EN000', 1242, '', '', NULL),
(480, '27419493-ed7b-4f9e-bceb-070daab55f98', 'EN012', 41400, '', '', NULL),
(481, '19de52a1-b255-467c-b8af-f8cc462fbdd2', 'EN123', 3681.8181818182, '', '', NULL),
(482, '19de52a1-b255-467c-b8af-f8cc462fbdd2', 'EN011', 10090.909090909, '', '', NULL),
(483, '19de52a1-b255-467c-b8af-f8cc462fbdd2', 'EN000', 1227.2727272727, '', '', NULL),
(484, '19de52a1-b255-467c-b8af-f8cc462fbdd2', 'EN012', 35000, '', '', NULL),
(485, 'cbd18adf-71a5-40ba-b13d-5ee530071d6a', 'EN123', 5532.5454545455, '', '', NULL),
(486, 'cbd18adf-71a5-40ba-b13d-5ee530071d6a', 'EN011', -2174.5454545455, '', '', NULL),
(487, 'cbd18adf-71a5-40ba-b13d-5ee530071d6a', 'EN000', 1242, '', '', NULL),
(488, 'cbd18adf-71a5-40ba-b13d-5ee530071d6a', 'EN012', 41400, '', '', NULL),
(489, 'd4d223a0-e249-4bb3-b53b-450bd9345546', 'EN123', 3681.8181818182, '', '', NULL),
(490, 'd4d223a0-e249-4bb3-b53b-450bd9345546', 'EN011', 10090.909090909, '', '', NULL),
(491, 'd4d223a0-e249-4bb3-b53b-450bd9345546', 'EN000', 1227.2727272727, '', '', NULL),
(492, 'd4d223a0-e249-4bb3-b53b-450bd9345546', 'EN012', 35000, '', '', NULL),
(493, '25ce18d0-e005-4546-9857-49ecc6ea45b9', 'EN123', 5532.5454545455, '', '', NULL),
(494, '25ce18d0-e005-4546-9857-49ecc6ea45b9', 'EN011', -2174.5454545455, '', '', NULL),
(495, '25ce18d0-e005-4546-9857-49ecc6ea45b9', 'EN000', 1242, '', '', NULL),
(496, '25ce18d0-e005-4546-9857-49ecc6ea45b9', 'EN012', 41400, '', '', NULL),
(497, '51dfa8b8-4f89-410c-815f-93013d1475a8', 'EN123', 3681.8181818182, '', '', NULL),
(498, '51dfa8b8-4f89-410c-815f-93013d1475a8', 'EN011', 10090.909090909, '', '', NULL),
(499, '51dfa8b8-4f89-410c-815f-93013d1475a8', 'EN000', 1227.2727272727, '', '', NULL),
(500, '51dfa8b8-4f89-410c-815f-93013d1475a8', 'EN012', 35000, '', '', NULL),
(501, 'dd4eb849-84c2-4c8c-8ff3-6769465a9604', 'EN123', 5532.5454545455, '', '', NULL),
(502, 'dd4eb849-84c2-4c8c-8ff3-6769465a9604', 'EN011', -2174.5454545455, '', '', NULL),
(503, 'dd4eb849-84c2-4c8c-8ff3-6769465a9604', 'EN000', 1242, '', '', NULL),
(504, 'dd4eb849-84c2-4c8c-8ff3-6769465a9604', 'EN012', 41400, '', '', NULL),
(505, 'c9bc75f9-55af-4108-8b30-fd94cd955743', 'EN123', 3681.8181818182, '', '', NULL),
(506, 'c9bc75f9-55af-4108-8b30-fd94cd955743', 'EN011', 10090.909090909, '', '', NULL),
(507, 'c9bc75f9-55af-4108-8b30-fd94cd955743', 'EN000', 1227.2727272727, '', '', NULL),
(508, 'c9bc75f9-55af-4108-8b30-fd94cd955743', 'EN012', 35000, '', '', NULL),
(509, '294d8b78-d950-4df8-89a3-c7222233ba42', 'EN123', 5532.5454545455, '', '', NULL),
(510, '294d8b78-d950-4df8-89a3-c7222233ba42', 'EN011', -2174.5454545455, '', '', NULL),
(511, '294d8b78-d950-4df8-89a3-c7222233ba42', 'EN000', 1242, '', '', NULL),
(512, '294d8b78-d950-4df8-89a3-c7222233ba42', 'EN012', 41400, '', '', NULL),
(513, '718e8bf4-645a-403a-bcbb-e915e34c63b2', 'EN123', 3681.8181818182, '', '', NULL),
(514, '718e8bf4-645a-403a-bcbb-e915e34c63b2', 'EN011', 10090.909090909, '', '', NULL),
(515, '718e8bf4-645a-403a-bcbb-e915e34c63b2', 'EN000', 1227.2727272727, '', '', NULL),
(516, '718e8bf4-645a-403a-bcbb-e915e34c63b2', 'EN012', 35000, '', '', NULL),
(517, '6beb7002-52eb-48c6-8a74-fd2dc9a2ff78', 'EN123', 5532.5454545455, '', '', NULL),
(518, '6beb7002-52eb-48c6-8a74-fd2dc9a2ff78', 'EN011', -2174.5454545455, '', '', NULL),
(519, '6beb7002-52eb-48c6-8a74-fd2dc9a2ff78', 'EN000', 1242, '', '', NULL),
(520, '6beb7002-52eb-48c6-8a74-fd2dc9a2ff78', 'EN012', 41400, '', '', NULL),
(521, 'fc069b03-7bd2-4f05-8c3e-03256797d191', 'EN123', 3681.8181818182, '', '', NULL),
(522, 'fc069b03-7bd2-4f05-8c3e-03256797d191', 'EN011', 10090.909090909, '', '', NULL),
(523, 'fc069b03-7bd2-4f05-8c3e-03256797d191', 'EN000', 1227.2727272727, '', '', NULL),
(524, 'fc069b03-7bd2-4f05-8c3e-03256797d191', 'EN012', 35000, '', '', NULL),
(525, '52935f8a-2d4f-4285-9d12-e70f2c4768a0', 'EN123', 5532.5454545455, '', '', NULL),
(526, '52935f8a-2d4f-4285-9d12-e70f2c4768a0', 'EN011', -2174.5454545455, '', '', NULL),
(527, '52935f8a-2d4f-4285-9d12-e70f2c4768a0', 'EN000', 1242, '', '', NULL),
(528, '52935f8a-2d4f-4285-9d12-e70f2c4768a0', 'EN012', 41400, '', '', NULL),
(529, '8431e450-cfd5-4f3a-91a2-2d4b2941284a', 'EN123', 3681.8181818182, '', '', NULL),
(530, '8431e450-cfd5-4f3a-91a2-2d4b2941284a', 'EN011', 10090.909090909, '', '', NULL),
(531, '8431e450-cfd5-4f3a-91a2-2d4b2941284a', 'EN000', 1227.2727272727, '', '', NULL),
(532, '8431e450-cfd5-4f3a-91a2-2d4b2941284a', 'EN012', 35000, '', '', NULL),
(533, '18e46da9-3053-4826-a17b-37426321480f', 'EN123', 5532.5454545455, '', '', NULL),
(534, '18e46da9-3053-4826-a17b-37426321480f', 'EN011', -2174.5454545455, '', '', NULL),
(535, '18e46da9-3053-4826-a17b-37426321480f', 'EN000', 1242, '', '', NULL),
(536, '18e46da9-3053-4826-a17b-37426321480f', 'EN012', 41400, '', '', NULL),
(537, '446967bd-9fb5-44e7-8d29-7019bf7954d1', 'EN123', 3681.8181818182, '', '', NULL),
(538, '446967bd-9fb5-44e7-8d29-7019bf7954d1', 'EN011', 10090.909090909, '', '', NULL),
(539, '446967bd-9fb5-44e7-8d29-7019bf7954d1', 'EN000', 1227.2727272727, '', '', NULL),
(540, '446967bd-9fb5-44e7-8d29-7019bf7954d1', 'EN012', 35000, '', '', NULL),
(541, '5d86ac8e-4b8d-424f-a195-c3838b0ff0b4', 'EN123', 5532.5454545455, '', '', NULL),
(542, '5d86ac8e-4b8d-424f-a195-c3838b0ff0b4', 'EN011', -2174.5454545455, '', '', NULL),
(543, '5d86ac8e-4b8d-424f-a195-c3838b0ff0b4', 'EN000', 1242, '', '', NULL),
(544, '5d86ac8e-4b8d-424f-a195-c3838b0ff0b4', 'EN012', 41400, '', '', NULL),
(545, '8d8bd14f-c5b5-4f82-b400-ac53155d58a2', 'EN123', 3681.8181818182, '', '', NULL),
(546, '8d8bd14f-c5b5-4f82-b400-ac53155d58a2', 'EN011', 10090.909090909, '', '', NULL),
(547, '8d8bd14f-c5b5-4f82-b400-ac53155d58a2', 'EN000', 1227.2727272727, '', '', NULL),
(548, '8d8bd14f-c5b5-4f82-b400-ac53155d58a2', 'EN012', 35000, '', '', NULL),
(549, 'e6e3c6dc-f2e4-4b38-91a6-91f75a40fbd1', 'EN123', 5532.5454545455, '', '', NULL),
(550, 'e6e3c6dc-f2e4-4b38-91a6-91f75a40fbd1', 'EN011', -2174.5454545455, '', '', NULL),
(551, 'e6e3c6dc-f2e4-4b38-91a6-91f75a40fbd1', 'EN000', 1242, '', '', NULL),
(552, 'e6e3c6dc-f2e4-4b38-91a6-91f75a40fbd1', 'EN012', 41400, '', '', NULL),
(553, '1feb243b-4f2f-4a70-95c8-c33866f6c7c2', 'EN123', 3681.8181818182, '', '', NULL),
(554, '1feb243b-4f2f-4a70-95c8-c33866f6c7c2', 'EN011', 10090.909090909, '', '', NULL),
(555, '1feb243b-4f2f-4a70-95c8-c33866f6c7c2', 'EN000', 1227.2727272727, '', '', NULL),
(556, '1feb243b-4f2f-4a70-95c8-c33866f6c7c2', 'EN012', 35000, '', '', NULL),
(557, '8a5fac2c-d1aa-4223-bdd7-12563e052a1a', 'EN123', 5532.5454545455, '', '', NULL),
(558, '8a5fac2c-d1aa-4223-bdd7-12563e052a1a', 'EN011', -2174.5454545455, '', '', NULL),
(559, '8a5fac2c-d1aa-4223-bdd7-12563e052a1a', 'EN000', 1242, '', '', NULL),
(560, '8a5fac2c-d1aa-4223-bdd7-12563e052a1a', 'EN012', 41400, '', '', NULL),
(561, '493c8836-c633-493a-8f3c-a9c06f88f43b', 'EN123', 3681.8181818182, '', '', NULL),
(562, '493c8836-c633-493a-8f3c-a9c06f88f43b', 'EN011', 10090.909090909, '', '', NULL),
(563, '493c8836-c633-493a-8f3c-a9c06f88f43b', 'EN000', 1227.2727272727, '', '', NULL),
(564, '493c8836-c633-493a-8f3c-a9c06f88f43b', 'EN012', 35000, '', '', NULL),
(565, '90e433fb-e33f-4e86-b4a0-74dc7bfeb171', 'EN123', 5532.5454545455, '', '', NULL),
(566, '90e433fb-e33f-4e86-b4a0-74dc7bfeb171', 'EN011', -2174.5454545455, '', '', NULL),
(567, '90e433fb-e33f-4e86-b4a0-74dc7bfeb171', 'EN000', 1242, '', '', NULL),
(568, '90e433fb-e33f-4e86-b4a0-74dc7bfeb171', 'EN012', 41400, '', '', NULL),
(569, 'd76e7b8c-9df4-4cfd-a5cc-6d14bf774fee', 'EN123', 3681.8181818182, '', '', NULL),
(570, 'd76e7b8c-9df4-4cfd-a5cc-6d14bf774fee', 'EN011', 10090.909090909, '', '', NULL),
(571, 'd76e7b8c-9df4-4cfd-a5cc-6d14bf774fee', 'EN000', 1227.2727272727, '', '', NULL),
(572, 'd76e7b8c-9df4-4cfd-a5cc-6d14bf774fee', 'EN012', 35000, '', '', NULL),
(573, '8fe897a4-bc27-4a90-bb2e-a6419e444b2d', 'EN123', 5532.5454545455, '', '', NULL),
(574, '8fe897a4-bc27-4a90-bb2e-a6419e444b2d', 'EN011', -2174.5454545455, '', '', NULL),
(575, '8fe897a4-bc27-4a90-bb2e-a6419e444b2d', 'EN000', 1242, '', '', NULL),
(576, '8fe897a4-bc27-4a90-bb2e-a6419e444b2d', 'EN012', 41400, '', '', NULL),
(577, 'cceed42c-f73b-4bbd-8922-ba04694c7eea', 'EN123', 3681.8181818182, '', '', NULL),
(578, 'cceed42c-f73b-4bbd-8922-ba04694c7eea', 'EN011', 10090.909090909, '', '', NULL),
(579, 'cceed42c-f73b-4bbd-8922-ba04694c7eea', 'EN000', 1227.2727272727, '', '', NULL),
(580, 'cceed42c-f73b-4bbd-8922-ba04694c7eea', 'EN012', 35000, '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tr0004_b2c`
--

CREATE TABLE `tr0004_b2c` (
  `KEWAJIBAN_SYSTEM_ID` int(11) NOT NULL COMMENT 'Tabel Kewajiban Claim |CC',
  `TRX_DETAIL_SYSTEM_ID` varchar(50) NOT NULL,
  `ENTITY_ID` varchar(5) NOT NULL,
  `NILAI` double NOT NULL COMMENT 'nilai pembagian kewajiban tiap sub prod&entity',
  `BANK_REKENING` varchar(20) NOT NULL DEFAULT '',
  `NO_REKENING` varchar(50) NOT NULL DEFAULT '',
  `NAMA_REKENING` varchar(100) NOT NULL DEFAULT '',
  `KEWAJIBAN_STATUS` int(11) NOT NULL COMMENT '0: New, 1: Paid',
  `KEWAJIBAN_SYSTEM_ID_REASURANSI` int(11) DEFAULT NULL,
  `is_reas` tinyint(4) NOT NULL DEFAULT '0',
  `is_from_reas` tinyint(4) NOT NULL DEFAULT '0',
  `PAYMENT_SYSTEM_ID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr0004_b2c`
--

INSERT INTO `tr0004_b2c` (`KEWAJIBAN_SYSTEM_ID`, `TRX_DETAIL_SYSTEM_ID`, `ENTITY_ID`, `NILAI`, `BANK_REKENING`, `NO_REKENING`, `NAMA_REKENING`, `KEWAJIBAN_STATUS`, `KEWAJIBAN_SYSTEM_ID_REASURANSI`, `is_reas`, `is_from_reas`, `PAYMENT_SYSTEM_ID`) VALUES
(1, 'f6a5849f-8818-4352-95a9-3a303c4c75b9', 'EN011', 8000000, '', '', '', 0, NULL, 0, 0, NULL),
(2, 'f6a5849f-8818-4352-95a9-3a303c4c75b9', 'EN012', 72000000, '', '', '', 0, NULL, 0, 0, NULL),
(3, '9f73cb7e-14fe-495a-a9a9-2f844833e9e5', 'EN011', 200000, '', '', '', 0, NULL, 0, 0, NULL),
(4, '9f73cb7e-14fe-495a-a9a9-2f844833e9e5', 'EN012', 1800000, '', '', '', 0, NULL, 0, 0, NULL),
(5, 'e7fc9613-452d-4f65-80ba-153f90883257', 'EN011', 160000, '', '', '', 0, NULL, 0, 0, NULL),
(6, 'e7fc9613-452d-4f65-80ba-153f90883257', 'EN012', 1440000, '', '', '', 0, NULL, 0, 0, NULL),
(7, '33080807-f411-492b-8b4f-1a957cfc4519', 'EN011', 160000, '', '', '', 0, NULL, 0, 0, NULL),
(8, '33080807-f411-492b-8b4f-1a957cfc4519', 'EN012', 1440000, '', '', '', 0, NULL, 0, 0, NULL),
(9, 'f6a5849f-8818-4352-95a9-3a303c4c75b9', 'EN011', 8000000, '', '', '', 0, NULL, 0, 0, NULL),
(10, 'f6a5849f-8818-4352-95a9-3a303c4c75b9', 'EN012', 72000000, '', '', '', 0, NULL, 0, 0, NULL),
(11, '9f73cb7e-14fe-495a-a9a9-2f844833e9e5', 'EN011', 200000, '', '', '', 0, NULL, 0, 0, NULL),
(12, '9f73cb7e-14fe-495a-a9a9-2f844833e9e5', 'EN012', 1800000, '', '', '', 0, NULL, 0, 0, NULL),
(13, '87d15d2c-62c0-45e0-b091-80265d94eeab', 'EN011', 240000, '', '', '', 0, NULL, 0, 0, NULL),
(14, '87d15d2c-62c0-45e0-b091-80265d94eeab', 'EN012', 2160000, '', '', '', 0, NULL, 0, 0, NULL),
(15, 'f743dcf8-2324-47f1-a6a7-72ee568b389f', 'EN011', 160000, '', '', '', 0, NULL, 0, 0, NULL),
(16, 'f743dcf8-2324-47f1-a6a7-72ee568b389f', 'EN012', 1440000, '', '', '', 0, NULL, 0, 0, NULL),
(17, 'f5325120-8062-4454-9d24-d3c27183b676', 'EN011', 160000, '', '', '', 0, NULL, 0, 0, NULL),
(18, 'f5325120-8062-4454-9d24-d3c27183b676', 'EN012', 1440000, '', '', '', 0, NULL, 0, 0, NULL),
(19, 'fb217c46-5f4a-40dd-a3cb-8991ea12d207', 'EN011', 160000, '', '', '', 0, NULL, 0, 0, NULL),
(20, 'fb217c46-5f4a-40dd-a3cb-8991ea12d207', 'EN012', 1440000, '', '', '', 0, NULL, 0, 0, NULL),
(21, 'e7fc9613-452d-4f65-80ba-153f90883257', 'EN011', 160000, '', '', '', 0, NULL, 0, 0, NULL),
(22, 'e7fc9613-452d-4f65-80ba-153f90883257', 'EN012', 1440000, '', '', '', 0, NULL, 0, 0, NULL),
(23, '33080807-f411-492b-8b4f-1a957cfc4519', 'EN011', 160000, '', '', '', 0, NULL, 0, 0, NULL),
(24, '33080807-f411-492b-8b4f-1a957cfc4519', 'EN012', 1440000, '', '', '', 0, NULL, 0, 0, NULL),
(25, 'd4149c8f-4bcc-4d9d-90e3-4430a2163e39', 'EN011', 160000, '', '', '', 0, NULL, 0, 0, NULL),
(26, 'd4149c8f-4bcc-4d9d-90e3-4430a2163e39', 'EN012', 1440000, '', '', '', 0, NULL, 0, 0, NULL),
(27, '00084898-5bdc-4e0c-9b9c-a4ad43f5ee75', 'EN011', 160000, '', '', '', 0, NULL, 0, 0, NULL),
(28, '00084898-5bdc-4e0c-9b9c-a4ad43f5ee75', 'EN012', 1440000, '', '', '', 0, NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tr1001`
--

CREATE TABLE `tr1001` (
  `ID_KEY` int(11) NOT NULL COMMENT 'Tabel Tagihan Santunan',
  `ID_KEY_TRX_DETAIL` int(11) DEFAULT NULL,
  `SUB_PROD_ID` varchar(20) NOT NULL,
  `CURR_ID` varchar(3) NOT NULL,
  `ENTITY_ID` varchar(5) NOT NULL,
  `RESIKO` double NOT NULL,
  `KEWAJIBAN` double NOT NULL,
  `STATUS` int(2) NOT NULL COMMENT '0 NEW, 1 PAID',
  `TRX_PAYMENT_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `up001`
--

CREATE TABLE `up001` (
  `ID_KEY` int(11) NOT NULL,
  `CREATED_BY` varchar(12) NOT NULL,
  `TRX_NMFILE` varchar(50) NOT NULL,
  `TANGGAL` date NOT NULL,
  `DATA_TOTAL` int(11) NOT NULL,
  `DATA_DELETED` int(11) NOT NULL,
  `DATA_SUCCESS` int(11) NOT NULL,
  `DATA_REJECTED` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `up001`
--

INSERT INTO `up001` (`ID_KEY`, `CREATED_BY`, `TRX_NMFILE`, `TANGGAL`, `DATA_TOTAL`, `DATA_DELETED`, `DATA_SUCCESS`, `DATA_REJECTED`) VALUES
(3, '119', 'templateUpload.xlsx', '2020-07-08', 50, 0, 31, 19);

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `ID_KEY` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_permissions`
--

INSERT INTO `users_permissions` (`ID_KEY`, `user_id`, `permission_id`) VALUES
(54, 119, 105),
(55, 119, 106),
(56, 119, 107),
(57, 119, 108),
(58, 119, 109),
(59, 119, 57),
(60, 119, 58),
(61, 120, 57),
(62, 120, 58),
(63, 120, 100),
(64, 120, 101),
(65, 120, 102),
(66, 120, 103),
(67, 120, 104),
(68, 119, 50),
(69, 120, 50),
(70, 6, 50),
(71, 6, 56),
(72, 6, 58),
(73, 2, 50),
(74, 2, 56),
(75, 2, 58),
(76, 4, 50),
(77, 4, 56),
(78, 4, 58),
(79, 3, 50),
(80, 3, 56),
(81, 3, 58),
(82, 1, 1),
(83, 1, 2),
(84, 1, 3),
(85, 1, 4),
(86, 1, 5),
(87, 1, 6),
(88, 1, 7),
(89, 1, 8),
(90, 1, 9),
(91, 1, 10),
(92, 1, 11),
(93, 1, 12),
(94, 1, 13),
(95, 1, 14),
(96, 1, 20),
(97, 1, 21),
(98, 1, 22),
(99, 1, 23),
(100, 1, 24),
(101, 1, 25),
(102, 1, 26),
(103, 1, 27),
(104, 1, 28),
(105, 1, 29),
(106, 1, 30),
(107, 1, 31),
(108, 1, 32),
(109, 1, 33),
(110, 1, 34),
(111, 1, 35),
(112, 1, 50),
(113, 1, 56),
(114, 1, 57),
(115, 1, 58),
(116, 5, 50),
(117, 5, 51),
(118, 5, 52),
(119, 5, 55),
(120, 5, 56),
(121, 5, 57),
(122, 5, 58),
(123, 123, 57),
(124, 123, 58),
(125, 123, 100),
(126, 123, 101),
(127, 123, 102),
(128, 123, 103),
(129, 123, 104),
(130, 123, 50),
(131, 123, 56),
(132, 123, 33),
(133, 123, 7),
(134, 123, 12),
(135, 119, 56);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a_id_territory`
--
ALTER TABLE `a_id_territory`
  ADD PRIMARY KEY (`KODE_WILAYAH`),
  ADD UNIQUE KEY `UNIQUE` (`MST_KODE_WILAYAH`,`KODE_WILAYAH`);

--
-- Indexes for table `daerah`
--
ALTER TABLE `daerah`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `daerah3`
--
ALTER TABLE `daerah3`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `mst_kode_wilayah_bps` (`mst_kode_wilayah_bps`,`kode_wilayah_bps`);

--
-- Indexes for table `dca001`
--
ALTER TABLE `dca001`
  ADD PRIMARY KEY (`ID_KEY`),
  ADD KEY `PROD_ID` (`SUB_PROD_ID`);

--
-- Indexes for table `gempa`
--
ALTER TABLE `gempa`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `gempa2`
--
ALTER TABLE `gempa2`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `klim`
--
ALTER TABLE `klim`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `libur_insurance_prod_hari`
--
ALTER TABLE `libur_insurance_prod_hari`
  ADD PRIMARY KEY (`HARI`);

--
-- Indexes for table `libur_insurance_prod_tgl`
--
ALTER TABLE `libur_insurance_prod_tgl`
  ADD PRIMARY KEY (`TANGGAL`);

--
-- Indexes for table `libur_sistem_hari`
--
ALTER TABLE `libur_sistem_hari`
  ADD PRIMARY KEY (`HARI`);

--
-- Indexes for table `libur_sistem_tgl`
--
ALTER TABLE `libur_sistem_tgl`
  ADD PRIMARY KEY (`TANGGAL`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`ID_KEY`);

--
-- Indexes for table `ma0001`
--
ALTER TABLE `ma0001`
  ADD PRIMARY KEY (`CLI_SYSTEM_ID`),
  ADD UNIQUE KEY `CLI_USER_ID` (`CLI_USER_ID`),
  ADD UNIQUE KEY `CLI_EMAIL` (`CLI_EMAIL`),
  ADD KEY `CABANG_KEY` (`CABANG_KEY`);

--
-- Indexes for table `ma0002`
--
ALTER TABLE `ma0002`
  ADD PRIMARY KEY (`ID_KEY`),
  ADD UNIQUE KEY `CLI_SYSTEM_ID` (`CLI_SYSTEM_ID`,`CLI_BANK_VC`,`BAL_CURR_ID`) USING BTREE;

--
-- Indexes for table `ma0003`
--
ALTER TABLE `ma0003`
  ADD UNIQUE KEY `CLI_SYSTEM_ID_2` (`CLI_SYSTEM_ID`),
  ADD KEY `CLI_SYSTEM_ID` (`CLI_SYSTEM_ID`);

--
-- Indexes for table `ma0004`
--
ALTER TABLE `ma0004`
  ADD PRIMARY KEY (`OBJEK_SYSTEM_ID`),
  ADD KEY `CLI_SYSTEM_ID` (`CLI_SYSTEM_ID`,`OBJEK_NOP`);

--
-- Indexes for table `ma1001`
--
ALTER TABLE `ma1001`
  ADD PRIMARY KEY (`ID_KEY`),
  ADD UNIQUE KEY `ENTITY_ID` (`ENTITY_ID`);

--
-- Indexes for table `ma1002`
--
ALTER TABLE `ma1002`
  ADD PRIMARY KEY (`ID_KEY`);

--
-- Indexes for table `ma1003`
--
ALTER TABLE `ma1003`
  ADD PRIMARY KEY (`ID_KEY`),
  ADD UNIQUE KEY `ENTITY_ID` (`ENTITY_ID`,`PROD_ID`,`LOKASI_ID`) USING BTREE;

--
-- Indexes for table `ma2001`
--
ALTER TABLE `ma2001`
  ADD PRIMARY KEY (`ID_KEY`),
  ADD KEY `PROD_ID` (`PROD_ID`),
  ADD KEY `PROD_ID_PARENT` (`PROD_ID_PARENT`);

--
-- Indexes for table `ma2002`
--
ALTER TABLE `ma2002`
  ADD PRIMARY KEY (`ID_KEY`),
  ADD KEY `PROD_ID` (`PROD_ID`),
  ADD KEY `SHA_ENTITY` (`SHA_ENTITY`),
  ADD KEY `SHA_NUM_BACKER` (`SHA_NUM_BACKER`);

--
-- Indexes for table `ma2003`
--
ALTER TABLE `ma2003`
  ADD PRIMARY KEY (`SHA_SYSTEM_ID`),
  ADD KEY `SHA_ENTITY` (`SHA_ENTITY`);

--
-- Indexes for table `ma2004`
--
ALTER TABLE `ma2004`
  ADD PRIMARY KEY (`KOMISI_SYTEM_ID`),
  ADD KEY `SHA_ENTITY` (`SHA_SYSTEM_ID_GIVE`),
  ADD KEY `SHA_SYSTEM_ID` (`SHA_SYSTEM_ID_TAKE`);

--
-- Indexes for table `ma9001`
--
ALTER TABLE `ma9001`
  ADD PRIMARY KEY (`ID_KEY`),
  ADD KEY `ENTITY_ID` (`ENTITY_ID`);

--
-- Indexes for table `ma9002`
--
ALTER TABLE `ma9002`
  ADD PRIMARY KEY (`ID_KEY`),
  ADD KEY `ENTITY_ID` (`ENTITY_ID`),
  ADD KEY `SUSA_ID` (`SUSA_ID`),
  ADD KEY `PROD_ID` (`PROD_ID`);

--
-- Indexes for table `ma9003`
--
ALTER TABLE `ma9003`
  ADD PRIMARY KEY (`ID_KEY`);

--
-- Indexes for table `mmt`
--
ALTER TABLE `mmt`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `mt_suv`
--
ALTER TABLE `mt_suv`
  ADD PRIMARY KEY (`nom`);

--
-- Indexes for table `mt_tranopt`
--
ALTER TABLE `mt_tranopt`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `obyek`
--
ALTER TABLE `obyek`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `premi`
--
ALTER TABLE `premi`
  ADD PRIMARY KEY (`no`),
  ADD KEY `PROD_ID` (`SUB_PROD_ID`);

--
-- Indexes for table `py0001_b2c`
--
ALTER TABLE `py0001_b2c`
  ADD PRIMARY KEY (`ID_KEY`),
  ADD UNIQUE KEY `PAYMENT_SYSTEM_ID` (`PAYMENT_SYSTEM_ID`),
  ADD KEY `RECEIVED_SYSTEM_ID` (`RECEIVED_SYSTEM_ID`);

--
-- Indexes for table `py0002_b2c`
--
ALTER TABLE `py0002_b2c`
  ADD PRIMARY KEY (`ID_KEY`),
  ADD UNIQUE KEY `RECEIVED_SYSTEM_ID` (`RECEIVED_SYSTEM_ID`),
  ADD KEY `PAYMENT_SYSTEM_ID` (`PAYMENT_SYSTEM_ID`);

--
-- Indexes for table `reques`
--
ALTER TABLE `reques`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tr0001`
--
ALTER TABLE `tr0001`
  ADD PRIMARY KEY (`ID_KEY`) USING BTREE,
  ADD UNIQUE KEY `ENTITY_ID` (`ENTITY_ID`,`TRX_UUID`) USING BTREE,
  ADD KEY `PROD_ID` (`PROD_ID`),
  ADD KEY `SUSA_ID` (`SUSA_ID`),
  ADD KEY `CABANG_ID` (`CABANG_ID`),
  ADD KEY `TRX_PAYMENT_ID` (`PAYMENT_SYSTEM_ID`),
  ADD KEY `CREATED_BY` (`CREATED_BY`);

--
-- Indexes for table `tr0001_b2c`
--
ALTER TABLE `tr0001_b2c`
  ADD PRIMARY KEY (`ID_KEY`),
  ADD UNIQUE KEY `TRX_SYSTEM_ID` (`TRX_SYSTEM_ID`) USING BTREE,
  ADD UNIQUE KEY `PAYMENT_SYSTEM_ID` (`PAYMENT_SYSTEM_ID`),
  ADD KEY `PROD_ID` (`PROD_ID`),
  ADD KEY `CLI_SYSTEM_ID` (`CLI_SYSTEM_ID`),
  ADD KEY `OBJEK_SYSTEM_ID` (`OBJEK_SYSTEM_ID`);

--
-- Indexes for table `tr0002_b2c`
--
ALTER TABLE `tr0002_b2c`
  ADD PRIMARY KEY (`ID_KEY`),
  ADD UNIQUE KEY `TRX_DETAIL_SYSTEM_ID` (`TRX_DETAIL_SYSTEM_ID`) USING BTREE,
  ADD KEY `TRX_SYSTEM_ID` (`TRX_PARENT`,`TRX_SYSTEM_ID`,`SUB_PROD_ID`) USING BTREE,
  ADD KEY `CLAIM_STATUS` (`CLAIM_STATUS`,`CLAIM_NILAI`,`RECEIVED_SYSTEM_ID`,`EQ_SYSTEM_ID`);

--
-- Indexes for table `tr0003_b2c`
--
ALTER TABLE `tr0003_b2c`
  ADD PRIMARY KEY (`PEMBAGIAN_SYSTEM_ID`),
  ADD KEY `TRX_DETAIL_SYSTEM_ID` (`TRX_DETAIL_SYSTEM_ID`,`ENTITY_ID`),
  ADD KEY `RECEIVED_SYSTEM_ID` (`RECEIVED_SYSTEM_ID`);

--
-- Indexes for table `tr0004_b2c`
--
ALTER TABLE `tr0004_b2c`
  ADD PRIMARY KEY (`KEWAJIBAN_SYSTEM_ID`),
  ADD KEY `TRX_DETAIL_SYSTEM_ID` (`TRX_DETAIL_SYSTEM_ID`,`ENTITY_ID`),
  ADD KEY `RECEIVED_SYSTEM_ID` (`PAYMENT_SYSTEM_ID`),
  ADD KEY `KEWAJIBAN_SYSTEM_ID_REASURANSI` (`KEWAJIBAN_SYSTEM_ID_REASURANSI`);

--
-- Indexes for table `tr1001`
--
ALTER TABLE `tr1001`
  ADD PRIMARY KEY (`ID_KEY`),
  ADD KEY `ID_PROD` (`SUB_PROD_ID`),
  ADD KEY `ENTITY_ID` (`ENTITY_ID`),
  ADD KEY `TRX_PAYMENT_ID` (`TRX_PAYMENT_ID`),
  ADD KEY `ID_KEY_TRX_DETAIL` (`ID_KEY_TRX_DETAIL`);

--
-- Indexes for table `up001`
--
ALTER TABLE `up001`
  ADD PRIMARY KEY (`ID_KEY`);

--
-- Indexes for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD PRIMARY KEY (`ID_KEY`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daerah`
--
ALTER TABLE `daerah`
  MODIFY `no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=764;
--
-- AUTO_INCREMENT for table `daerah3`
--
ALTER TABLE `daerah3`
  MODIFY `no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91766;
--
-- AUTO_INCREMENT for table `dca001`
--
ALTER TABLE `dca001`
  MODIFY `ID_KEY` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Tabel Santunan Gempa', AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `gempa`
--
ALTER TABLE `gempa`
  MODIFY `no` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `gempa2`
--
ALTER TABLE `gempa2`
  MODIFY `no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT for table `klim`
--
ALTER TABLE `klim`
  MODIFY `no` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `ID_KEY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `ma0001`
--
ALTER TABLE `ma0001`
  MODIFY `CLI_SYSTEM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT for table `ma0002`
--
ALTER TABLE `ma0002`
  MODIFY `ID_KEY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ma0004`
--
ALTER TABLE `ma0004`
  MODIFY `OBJEK_SYSTEM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ma1001`
--
ALTER TABLE `ma1001`
  MODIFY `ID_KEY` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Primary. Autoincreament', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ma1002`
--
ALTER TABLE `ma1002`
  MODIFY `ID_KEY` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Tabel Karyawan Entity';
--
-- AUTO_INCREMENT for table `ma1003`
--
ALTER TABLE `ma1003`
  MODIFY `ID_KEY` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Tabel Product (Child, Cabang dan Zona)', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ma2001`
--
ALTER TABLE `ma2001`
  MODIFY `ID_KEY` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Tabel Product (Parent)', AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `ma2002`
--
ALTER TABLE `ma2002`
  MODIFY `ID_KEY` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Tabel Product (Child, detail produk)', AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `ma2003`
--
ALTER TABLE `ma2003`
  MODIFY `SHA_SYSTEM_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Tabel Rules (Parent) | if b2c', AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `ma2004`
--
ALTER TABLE `ma2004`
  MODIFY `KOMISI_SYTEM_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Tabel Rules (Child, Komisi)', AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `ma9001`
--
ALTER TABLE `ma9001`
  MODIFY `ID_KEY` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Tabel Parameter';
--
-- AUTO_INCREMENT for table `ma9002`
--
ALTER TABLE `ma9002`
  MODIFY `ID_KEY` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Tabel Sektor Usaha', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ma9003`
--
ALTER TABLE `ma9003`
  MODIFY `ID_KEY` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Tabel Kurs Mata uang';
--
-- AUTO_INCREMENT for table `mmt`
--
ALTER TABLE `mmt`
  MODIFY `no` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT for table `mt_suv`
--
ALTER TABLE `mt_suv`
  MODIFY `nom` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mt_tranopt`
--
ALTER TABLE `mt_tranopt`
  MODIFY `no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;
--
-- AUTO_INCREMENT for table `obyek`
--
ALTER TABLE `obyek`
  MODIFY `no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `premi`
--
ALTER TABLE `premi`
  MODIFY `no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;
--
-- AUTO_INCREMENT for table `py0001_b2c`
--
ALTER TABLE `py0001_b2c`
  MODIFY `ID_KEY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `py0002_b2c`
--
ALTER TABLE `py0002_b2c`
  MODIFY `ID_KEY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `reques`
--
ALTER TABLE `reques`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `tr0001`
--
ALTER TABLE `tr0001`
  MODIFY `ID_KEY` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Tabel transaksi (main)', AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `tr0001_b2c`
--
ALTER TABLE `tr0001_b2c`
  MODIFY `ID_KEY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tr0002_b2c`
--
ALTER TABLE `tr0002_b2c`
  MODIFY `ID_KEY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `tr0003_b2c`
--
ALTER TABLE `tr0003_b2c`
  MODIFY `PEMBAGIAN_SYSTEM_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Tabel Pembagian Premi |CC', AUTO_INCREMENT=581;
--
-- AUTO_INCREMENT for table `tr0004_b2c`
--
ALTER TABLE `tr0004_b2c`
  MODIFY `KEWAJIBAN_SYSTEM_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Tabel Kewajiban Claim |CC', AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tr1001`
--
ALTER TABLE `tr1001`
  MODIFY `ID_KEY` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Tabel Tagihan Santunan';
--
-- AUTO_INCREMENT for table `up001`
--
ALTER TABLE `up001`
  MODIFY `ID_KEY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_permissions`
--
ALTER TABLE `users_permissions`
  MODIFY `ID_KEY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tr0003_b2c`
--
ALTER TABLE `tr0003_b2c`
  ADD CONSTRAINT `tr0003_b2c_ibfk_1` FOREIGN KEY (`TRX_DETAIL_SYSTEM_ID`) REFERENCES `tr0002_b2c` (`TRX_DETAIL_SYSTEM_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD CONSTRAINT `users_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_permissions_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `ma0001` (`CLI_SYSTEM_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
