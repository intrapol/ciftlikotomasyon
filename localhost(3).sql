-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `siparis` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_turkish_ci */;
USE `siparis`;

DROP TABLE IF EXISTS `anliksiparis`;
CREATE TABLE `anliksiparis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masaid` int(11) NOT NULL,
  `garsonid` int(11) NOT NULL,
  `urunid` int(11) NOT NULL,
  `urunad` varchar(222) NOT NULL,
  `urunfiyat` float NOT NULL,
  `adet` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `anliksiparis` (`id`, `masaid`, `garsonid`, `urunid`, `urunad`, `urunfiyat`, `adet`) VALUES
(185,	1417,	0,	1,	'Kolay',	5,	3);

DROP TABLE IF EXISTS `doluluk`;
CREATE TABLE `doluluk` (
  `id` int(11) NOT NULL DEFAULT 1,
  `bos` int(11) NOT NULL DEFAULT 0,
  `dolu` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `doluluk` (`id`, `bos`, `dolu`) VALUES
(1,	17,	0);

DROP TABLE IF EXISTS `garson`;
CREATE TABLE `garson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` int(11) NOT NULL,
  `durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `garson` (`id`, `ad`, `sifre`, `durum`) VALUES
(1,	'serdar',	11,	0),
(2,	'ahmet',	123,	0),
(3,	'veli',	123,	0),
(6,	'anagarson',	123,	1);

DROP TABLE IF EXISTS `gecicigarson`;
CREATE TABLE `gecicigarson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `garsonid` int(11) NOT NULL,
  `garsonad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `adet` int(11) NOT NULL,
  `hasilat` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


DROP TABLE IF EXISTS `gecicimasa`;
CREATE TABLE `gecicimasa` (
  `id` int(11) NOT NULL,
  `masaid` int(11) NOT NULL,
  `masaad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `hasilat` float NOT NULL,
  `adet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `gecicimasa` (`id`, `masaid`, `masaad`, `hasilat`, `adet`) VALUES
(0,	8,	'MS-8',	310,	11),
(0,	3,	'MS-4',	75,	11),
(0,	2,	'MS-2',	447,	17),
(0,	10,	'MS-10',	97,	13),
(0,	9,	'MS-9',	1300310,	23),
(0,	1,	'MS-1',	335,	44),
(0,	5,	'MS-5',	15,	3);

DROP TABLE IF EXISTS `geciciurun`;
CREATE TABLE `geciciurun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urunid` int(11) NOT NULL,
  `urunad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `hasilat` float NOT NULL,
  `adet` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `geciciurun` (`id`, `urunid`, `urunad`, `hasilat`, `adet`) VALUES
(1,	2,	'Çay',	14,	7),
(2,	4,	'Kahve',	119,	17),
(3,	3,	'Hamburger',	297,	29),
(4,	5,	'Künefe',	168,	21),
(5,	1,	'Kolay',	80,	16),
(6,	13,	'zor ',	1300100,	14),
(7,	11,	'kebabi',	16,	8),
(8,	7,	'sigara',	492,	4),
(9,	8,	'elma',	246,	2),
(10,	12,	'Limonata',	4,	2),
(11,	6,	'lahmacun',	44,	2);

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `kategori` (`id`, `ad`) VALUES
(1,	'Sıcak İçecekler'),
(2,	'Soğuk İçecekler'),
(3,	'Tatlılar'),
(4,	'Pizzalar'),
(6,	'Nargile');

DROP TABLE IF EXISTS `masalar`;
CREATE TABLE `masalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `masalar` (`id`, `ad`) VALUES
(1,	'MS-1'),
(2,	'MS-2'),
(3,	'MS-4'),
(4,	'MS-3'),
(5,	'MS-5'),
(6,	'MS-6'),
(7,	'MS-7'),
(8,	'MS-8'),
(9,	'MS-9'),
(10,	'MS-10'),
(11,	'MS-11'),
(12,	'MS-12'),
(13,	'MS-13'),
(1415,	'MS-14'),
(1419,	'MS-15'),
(1418,	'MS-15'),
(1420,	'MS-15');

DROP TABLE IF EXISTS `rapor`;
CREATE TABLE `rapor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masaid` int(11) NOT NULL,
  `garsonid` int(11) NOT NULL,
  `urunid` int(11) NOT NULL,
  `urunad` varchar(222) NOT NULL,
  `urunfiyat` float NOT NULL,
  `adet` int(11) NOT NULL,
  `tarih` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `rapor` (`id`, `masaid`, `garsonid`, `urunid`, `urunad`, `urunfiyat`, `adet`, `tarih`) VALUES
(13,	8,	0,	2,	'Çay',	2,	1,	'2020-05-31'),
(12,	8,	0,	4,	'Kahve',	7,	2,	'2020-05-31'),
(11,	3,	0,	3,	'Hamburger',	10,	3,	'2020-05-31'),
(10,	3,	0,	5,	'Künefe',	8,	3,	'2020-05-31'),
(9,	3,	0,	2,	'Çay',	2,	1,	'2020-05-31'),
(8,	3,	0,	4,	'Kahve',	7,	1,	'2020-05-31'),
(14,	8,	0,	1,	'Kolay',	5,	3,	'2020-05-31'),
(15,	2,	0,	1,	'Kolay',	5,	4,	'2020-05-31'),
(16,	2,	0,	5,	'Künefe',	8,	4,	'2020-05-31'),
(17,	3,	0,	5,	'Künefe',	8,	1,	'2020-05-31'),
(18,	10,	0,	4,	'Kahve',	7,	1,	'2020-06-06'),
(19,	10,	0,	1,	'Kolay',	5,	6,	'2020-06-06'),
(20,	10,	0,	3,	'Hamburger',	10,	6,	'2020-06-06'),
(21,	9,	0,	13,	'zor ',	100000,	13,	'2020-06-06'),
(22,	9,	0,	11,	'kebabi',	2,	3,	'2020-06-06'),
(23,	9,	0,	7,	'sigara',	123,	2,	'2020-06-06'),
(24,	2,	1,	8,	'elma',	123,	2,	'2020-06-09'),
(25,	2,	2,	13,	'zor ',	101,	1,	'2020-06-10'),
(26,	2,	2,	11,	'kebabi',	2,	2,	'2020-06-10'),
(27,	2,	2,	3,	'Hamburger',	11,	4,	'2020-06-10'),
(28,	3,	0,	12,	'Limonata',	2,	2,	'2020-06-10'),
(29,	1,	0,	5,	'Künefe',	8,	13,	'2020-06-10'),
(30,	1,	0,	4,	'Kahve',	7,	13,	'2020-06-10'),
(31,	1,	0,	3,	'Hamburger',	10,	13,	'2020-06-10'),
(32,	1,	0,	2,	'Çay',	2,	5,	'2020-06-10'),
(33,	8,	3,	3,	'Hamburger',	11,	3,	'2020-06-10'),
(34,	8,	3,	7,	'sigara',	123,	2,	'2020-06-10'),
(35,	5,	0,	1,	'Kolay',	5,	3,	'2020-06-10'),
(36,	9,	6,	6,	'lahmacun',	22,	2,	'2020-06-10'),
(37,	9,	6,	11,	'kebabi',	2,	3,	'2020-06-10');

DROP TABLE IF EXISTS `urunler`;
CREATE TABLE `urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `katid` int(11) NOT NULL,
  `ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `fiyat` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `urunler` (`id`, `katid`, `ad`, `fiyat`) VALUES
(1,	2,	'Kola',	5),
(2,	4,	'Çay',	13),
(3,	4,	'Hamburger',	11),
(6,	2,	'lahmacun',	22),
(7,	3,	'sigara',	123),
(8,	1,	'elma',	123),
(9,	1,	'karpuz',	2),
(10,	2,	'cugara',	111),
(11,	3,	'kebabi',	2),
(12,	2,	'Limonata',	2),
(13,	1,	'zor ',	101),
(16,	7,	'Tereyağlı Balık',	23);

DROP TABLE IF EXISTS `yonetim`;
CREATE TABLE `yonetim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kulad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `yonetim` (`id`, `kulad`, `sifre`) VALUES
(1,	'serdar',	'96de4eceb9a0c2b9b52c0b618819821b');

-- 2020-06-12 06:55:47
