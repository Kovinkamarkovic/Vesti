-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 17, 2019 at 10:56 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sindjina_deca`
--

-- --------------------------------------------------------

--
-- Table structure for table `galerije`
--

DROP TABLE IF EXISTS `galerije`;
CREATE TABLE IF NOT EXISTS `galerije` (
  `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nazivGalerije` varchar(50) NOT NULL,
  `komentar` text NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `autor` varchar(20) NOT NULL,
  `obrisan` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `galerije`
--

INSERT INTO `galerije` (`id`, `nazivGalerije`, `komentar`, `vreme`, `autor`, `obrisan`) VALUES
(5, 'vesti', '', '2018-07-21 16:19:03', '1', 0),
(4, 'stars', '', '2018-07-21 16:18:23', '1', 0),
(8, 'stare slike', '', '2018-07-22 16:01:28', '1', 0),
(7, 'nove slike', '', '2018-07-22 15:53:23', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `galerijeslike`
--

DROP TABLE IF EXISTS `galerijeslike`;
CREATE TABLE IF NOT EXISTS `galerijeslike` (
  `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idgalerije` int(2) NOT NULL,
  `slika` varchar(100) NOT NULL,
  `komentar` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `galerijeslike`
--

INSERT INTO `galerijeslike` (`id`, `idgalerije`, `slika`, `komentar`) VALUES
(55, 8, 'zivotinje-pozadine-za-desktop-0285-papagaj.jpg', ''),
(54, 8, 'uskrs3.jpg', ''),
(53, 8, 'zivotinje-pozadine-za-desktop-0295-macka.jpg', ''),
(52, 8, 'преузимање (1).jpeg', ''),
(51, 7, 'images.jpeg', ''),
(50, 7, 'images (1).jpeg', ''),
(49, 7, 'beautiful-nature-desktop-clipart-free-download-7.jpg', ''),
(48, 7, 'Best-Nature-Scene-HD-desktop-wallpaper.jpg', ''),
(47, 7, 'images (1).jpeg', ''),
(46, 7, 'images (2).jpeg', ''),
(45, 6, 'images (3).jpeg', ''),
(44, 6, 'images (4).jpeg', ''),
(43, 6, 'images.jpeg', ''),
(42, 6, 'p.JPG', ''),
(41, 6, 'p1.jpg', ''),
(40, 5, 'pozadina.jpg', ''),
(39, 5, 'priroda-pozadine-za-desktop-0047.jpg', ''),
(38, 5, 'преузимање (1).jpeg', ''),
(37, 5, 'priroda-pozadine-za-desktop-0064-Grand_Canyon_zalazak-sunca.jpg', ''),
(36, 5, 'преузимање (2).jpeg', ''),
(35, 4, 'преузимање.jpeg', ''),
(34, 4, 'images.jpeg', ''),
(33, 4, 'tehnologija-pozadine-za-desktop-0105-Apple_Desk.jpg', ''),
(32, 4, 'praznici-pozadine-za-desktop-0233-Bozic-slike.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

DROP TABLE IF EXISTS `kategorija`;
CREATE TABLE IF NOT EXISTS `kategorija` (
  `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) NOT NULL,
  `obrisan` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`id`, `naziv`, `obrisan`) VALUES
(1, 'Hronika', 0),
(2, 'Svet', 0),
(3, 'Region', 0),
(4, 'Stars', 0),
(5, 'Najnovije vesti', 0);

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

DROP TABLE IF EXISTS `komentari`;
CREATE TABLE IF NOT EXISTS `komentari` (
  `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idvesti` int(3) NOT NULL,
  `autor` varchar(20) NOT NULL,
  `tekst` text NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dozvoljen` int(1) NOT NULL,
  `volime` int(3) NOT NULL,
  `nevolime` int(3) NOT NULL,
  `obrisan` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE IF NOT EXISTS `korisnici` (
  `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime` varchar(20) NOT NULL,
  `prezime` varchar(30) NOT NULL,
  `lozinka` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `komentar` text,
  `status` enum('Administrator','Urednik','Korisnici') NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slika` varchar(50) DEFAULT NULL,
  `obrisan` int(1) NOT NULL DEFAULT '0',
  `validan` int(15) NOT NULL DEFAULT '0',
  `grad` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `ime`, `prezime`, `lozinka`, `email`, `komentar`, `status`, `vreme`, `slika`, `obrisan`, `validan`, `grad`) VALUES
(1, 'Kovinka', 'Markovic', 'aaaa', 'kovinka.markovic@gmail.com', '', 'Administrator', '2018-06-13 18:55:27', 'images.jpg', 0, 0, ''),
(2, 'Kristina', 'Pantelic', 'bbbb', 'kristinapantelic009@gmail.com', '', 'Urednik', '2018-06-13 18:55:27', 'images3.jpg', 0, 0, ''),
(4, 'Jovan', 'Pantelic', 'cccc', 'joca.pantelic@gmail.com', '', 'Korisnici', '2018-06-29 16:46:34', 'images2.jpg', 0, 0, ''),
(9, 'a', 'a', 'aaaa', 'kovica86markovic@gmail.com', NULL, 'Urednik', '2018-07-21 15:42:45', '', 0, 0, ''),
(8, 'Vesna', 'Miric', '123', 'vesna.miric@gmail.com', NULL, 'Urednik', '2018-07-20 12:57:27', '', 0, 0, ''),
(10, 'a', 'a', 'aaaa', 'kovica86markovic@gmail.com', NULL, 'Korisnici', '2018-07-21 15:51:01', '', 0, 0, ''),
(11, 'a', 'a', 'aaaa', 'kovica86markovic@gmail.com', NULL, 'Urednik', '2018-07-21 16:07:16', '', 0, 0, ''),
(12, 'aqaa', 'aaa', 'aaa', 'a@gmail.com', NULL, 'Urednik', '2018-07-21 18:10:25', '', 0, 0, ''),
(13, 'a', 'a', 'aaaa', 'dada@gmail.com', NULL, 'Urednik', '2018-07-22 19:11:57', '', 0, 0, ''),
(14, 'a', 'Miric', 'bbbb', 'aasd@gmail.com', NULL, 'Korisnici', '2018-07-22 20:18:38', NULL, 0, 1532290718, 'bbb'),
(15, 'a', 'Miric', 'bbbb', 'aasd@gmail.com', NULL, 'Korisnici', '2018-07-22 20:18:38', NULL, 0, 1532290718, 'bbb'),
(16, 'a', 'Miric', 'bbbb', 'aasd@gmail.com', NULL, 'Korisnici', '2018-07-22 20:18:38', NULL, 0, 1532290718, 'bbb'),
(17, 'a', 'Miric', 'bbbb', 'aasd@gmail.com', NULL, 'Korisnici', '2018-07-22 20:18:39', NULL, 0, 1, 'bbb'),
(18, 'a', 'Miric', 'bbbb', 'aasd@gmail.com', NULL, 'Korisnici', '2018-07-22 20:18:39', NULL, 0, 1, 'bbb'),
(19, 'Vesna', 'markovic', 'aaaa', 'koko@gmail.com', NULL, 'Korisnici', '2018-07-22 20:20:56', NULL, 0, 1, 'cccc');

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

DROP TABLE IF EXISTS `slike`;
CREATE TABLE IF NOT EXISTS `slike` (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idVesti` int(3) NOT NULL,
  `imeSlike` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vesti`
--

DROP TABLE IF EXISTS `vesti`;
CREATE TABLE IF NOT EXISTS `vesti` (
  `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `naslov` varchar(70) NOT NULL,
  `sadrzaj` text NOT NULL,
  `autor` varchar(50) NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kategorija` varchar(30) NOT NULL,
  `obrisan` int(1) NOT NULL DEFAULT '0',
  `slikavesti` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vesti`
--

INSERT INTO `vesti` (`id`, `naslov`, `sadrzaj`, `autor`, `vreme`, `kategorija`, `obrisan`, `slikavesti`) VALUES
(1, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2', '2018-06-16 16:04:01', '5', 0, 'a1.jpg'),
(2, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2', '2018-06-16 16:04:01', '3', 0, 'a2.jpg'),
(3, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kristina pantelic', '2018-06-16 16:04:19', '1', 0, 'a3.jpg'),
(4, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kristina pantelic', '2018-06-16 16:04:19', '4', 0, 'a4.jpg'),
(5, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n', 'kristina pantelic', '2018-06-17 10:34:34', '3', 0, 'a6.jpg'),
(6, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kristina pantelic', '2018-06-17 10:52:04', '2', 0, 's6.jpg'),
(7, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kristina pantelic', '2018-06-17 11:04:39', '2', 0, 'a8.jpg'),
(8, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kristina pantelic', '2018-06-17 11:08:35', '4', 0, 'a9.jpg'),
(9, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kristina pantelic', '2018-06-17 11:16:07', '2', 0, 's8.jpg'),
(10, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kovinka markovic', '2018-06-17 11:16:07', '2', 0, 'c11.jpg'),
(11, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kristina pantelic', '2018-06-17 11:20:17', '2', 0, 'c17.jpg'),
(12, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kristina pantelic', '2018-06-17 11:21:47', '1', 0, 'b5.jpg'),
(13, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kristina pantelic', '2018-06-17 11:30:32', '2', 0, 'b6.jpg'),
(14, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kristina pantelic', '2018-06-17 11:30:32', '1', 0, 'b7.jpg'),
(15, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kristina pantelic', '2018-06-17 11:30:32', '4', 0, 'b8.jpg'),
(16, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kristina pantelic', '2018-06-17 11:30:32', '2', 0, 'c1.jpg'),
(17, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kovinka markovic', '2018-06-19 05:49:13', '1', 0, 'c3.jpg'),
(18, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'kovinka markovic', '2018-06-20 11:58:12', '1', 0, 'c4.jpg'),
(19, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '1', '2018-06-22 09:41:55', '1', 1, 'c10.jpg'),
(20, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '1', '2018-06-22 09:44:52', '1', 0, 'c16.jpg'),
(21, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '1', '2018-07-09 11:21:32', '2', 0, 'c17.jpg'),
(22, 'What is Lorem Ipsum?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '1', '2018-07-22 19:19:08', '1', 0, 'c16.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `viewvesti`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `viewvesti`;
CREATE TABLE IF NOT EXISTS `viewvesti` (
`id` int(4) unsigned
,`naslov` varchar(70)
,`sadrzaj` text
,`autor` varchar(50)
,`vreme` timestamp
,`kategorija` varchar(30)
,`obrisan` int(1)
,`slikavesti` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `viewvesti`
--
DROP TABLE IF EXISTS `viewvesti`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewvesti`  AS  select `vesti`.`id` AS `id`,`vesti`.`naslov` AS `naslov`,`vesti`.`sadrzaj` AS `sadrzaj`,`vesti`.`autor` AS `autor`,`vesti`.`vreme` AS `vreme`,`vesti`.`kategorija` AS `kategorija`,`vesti`.`obrisan` AS `obrisan`,`vesti`.`slikavesti` AS `slikavesti` from `vesti` ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
