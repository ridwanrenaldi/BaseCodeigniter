-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 14 Bulan Mei 2020 pada 09.37
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `base_codeigniter`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(20) NOT NULL,
  `account_username` varchar(12) NOT NULL,
  `account_password` varchar(250) NOT NULL,
  `account_lastpassword` varchar(250) NOT NULL,
  `account_isactive` enum('true','false') NOT NULL,
  `account_createat` timestamp NULL DEFAULT NULL,
  `account_modifyat` timestamp NULL DEFAULT NULL,
  `account_level` enum('root','admin','user','') NOT NULL,
  `account_image` varchar(250) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`account_id`, `account_name`, `account_username`, `account_password`, `account_lastpassword`, `account_isactive`, `account_createat`, `account_modifyat`, `account_level`, `account_image`) VALUES
(1, 'Super User', 'root', '$2y$08$kRQEMVMk9B1jp25Q9HUCs.k3wpO95IVOiHXsezjPMJYy3O0QCkm/i', '$2y$08$plSNCSRiwH.ZjLvPWexqQ.ZsGo896W7kox7v/eFzN8pUo.mfkfaMu', 'true', '2020-05-15 08:00:00', '2020-05-15 08:00:00', 'root', 'default.png'),
(2, 'Admin', 'admin', '$2y$08$qkWbNrRZhQTpF1mq0wpmEOtKKVdb/ElU6B.kLneoHoJqMxIrn1.1O', '$2y$08$imtrmNQYKRmee67/9k5quehniKdNB9DRvtDESVixxcnkGsBj7XS2y', 'true', '2020-05-15 08:00:00', '2020-05-15 08:00:00', 'admin', 'default.png'),
(3, 'User', 'user', '$2y$08$HVoMt5jaJNtqbuTyz0R63.3JBSmyypnpGJFoQmj2a5j/zulUwqNeK', '$2y$08$mepQyFyHK.W9AaUqxnnareyvF7SlHCozU5Q09VploXDPDkBWWIszC', 'true', '2020-05-15 08:00:00', '2020-05-15 08:00:00', 'user', 'default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `commodity`
--

DROP TABLE IF EXISTS `commodity`;
CREATE TABLE IF NOT EXISTS `commodity` (
  `commodity_id` int(11) NOT NULL AUTO_INCREMENT,
  `commodity_name` varchar(50) NOT NULL,
  `commodity_type` varchar(50) NOT NULL,
  `commodity_price` bigint(20) NOT NULL,
  PRIMARY KEY (`commodity_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `commodity`
--

INSERT INTO `commodity` (`commodity_id`, `commodity_name`, `commodity_type`, `commodity_price`) VALUES
(1, 'Major Pharmaceuticals', 'Agricultural', 976029),
(2, 'Automotive Aftermarket', 'Metals', 1779194),
(3, 'Major Banks', 'Energy', 7527323),
(4, 'Building operators', 'Metals', 2942597),
(5, 'Oil & Gas Production', 'Agricultural', 7032724),
(6, 'Aerospace', 'Agricultural', 4268245),
(7, 'Power Generation', 'Agricultural', 3883281),
(8, 'Trucking Freight/Courier Services', 'Metals', 6656801),
(9, 'Real Estate Investment Trusts', 'Agricultural', 3055439),
(10, 'Major Pharmaceuticals', 'Agricultural', 4004279),
(11, 'n/a', 'Agricultural', 1192862),
(12, 'Major Banks', 'Agricultural', 1847284),
(13, 'Natural Gas Distribution', 'Metals', 5076171),
(14, 'Natural Gas Distribution', 'Agricultural', 360726),
(15, 'Telecommunications Equipment', 'Metals', 9560611),
(16, 'Fluid Controls', 'Energy', 4015332),
(17, 'n/a', 'Agricultural', 5849366),
(18, 'n/a', 'Agricultural', 5326895),
(19, 'Major Pharmaceuticals', 'Metals', 8494094),
(20, 'Farming/Seeds/Milling', 'Agricultural', 4601766),
(21, 'Semiconductors', 'Agricultural', 6059008),
(22, 'Electronic Components', 'Energy', 3765790),
(23, 'Industrial Machinery/Components', 'Metals', 9527735),
(24, 'Services-Misc. Amusement & Recreation', 'Agricultural', 6987822),
(25, 'Commercial Banks', 'Agricultural', 735019),
(26, 'Marine Transportation', 'Agricultural', 2037950),
(27, 'Business Services', 'Agricultural', 3965177),
(28, 'n/a', 'Metals', 8631863),
(29, 'Metal Fabrications', 'Energy', 3920327),
(30, 'Oil & Gas Production', 'Energy', 1125947);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
