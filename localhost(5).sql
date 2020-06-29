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
(374,	5,	1,	30,	'Ka?arl? Mantar',	25,	1),
(373,	5,	1,	24,	'Tereya?l? Alabal?k',	25,	2),
(372,	4,	1,	34,	'Kola',	5,	3),
(371,	4,	1,	42,	'Ayran',	3,	2),
(370,	4,	1,	27,	'Izgara Köfte',	25,	3);

DROP TABLE IF EXISTS `doluluk`;
CREATE TABLE `doluluk` (
  `id` int(11) NOT NULL DEFAULT 1,
  `bos` int(11) NOT NULL DEFAULT 0,
  `dolu` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `doluluk` (`id`, `bos`, `dolu`) VALUES
(1,	14,	2);

DROP TABLE IF EXISTS `garson`;
CREATE TABLE `garson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` int(11) NOT NULL,
  `durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `garson` (`id`, `ad`, `sifre`, `durum`) VALUES
(1,	'serdar',	11,	1),
(2,	'ahmet',	123,	0),
(3,	'veli',	123,	0),
(6,	'anagarson',	123,	0);

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
(0,	3,	'MS-4',	70,	4);

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
(1,	32,	'Künefe',	20,	2),
(2,	24,	'Tereya?l? Alabal?k',	50,	2);

DROP TABLE IF EXISTS `gider`;
CREATE TABLE `gider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `fiyat` float NOT NULL,
  `tarih` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;


DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `kategori` (`id`, `ad`) VALUES
(21,	'Tatlılar'),
(20,	'Mantar'),
(19,	'Soğuk İçecekler'),
(18,	'Yemekler');

DROP TABLE IF EXISTS `masalar`;
CREATE TABLE `masalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `masalar` (`id`, `ad`, `durum`) VALUES
(1,	'MS-1',	0),
(2,	'MS-2',	0),
(3,	'MS-4',	0),
(4,	'MS-3',	1),
(5,	'MS-5',	1),
(6,	'MS-6',	0),
(7,	'MS-7',	0),
(8,	'MS-8',	0),
(9,	'MS-9',	0),
(10,	'MS-10',	0),
(11,	'MS-11',	0),
(12,	'MS-12',	0),
(13,	'MS-13',	0),
(1415,	'MS-14',	0),
(1419,	'MS-15',	1),
(1421,	'MS-16',	0),
(0,	'KG-Balık',	0);

DROP TABLE IF EXISTS `mutfak`;
CREATE TABLE `mutfak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masaid` int(11) NOT NULL,
  `urunid` int(11) NOT NULL,
  `urunad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `adet` int(11) NOT NULL,
  `saat` int(11) NOT NULL,
  `dakika` int(11) NOT NULL,
  `durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `mutfak` (`id`, `masaid`, `urunid`, `urunad`, `adet`, `saat`, `dakika`, `durum`) VALUES
(89,	2,	29,	'Saç Kavurma',	3,	12,	49,	0),
(90,	2,	34,	'Kola',	3,	12,	52,	1),
(91,	7,	24,	'Tereyağlı Alabalık',	2,	13,	0,	1),
(92,	7,	30,	'Kaşarlı Mantar',	1,	13,	0,	1),
(93,	7,	34,	'Kola',	2,	13,	0,	1),
(94,	3,	24,	'Tereyağlı Alabalık',	2,	13,	17,	1),
(95,	3,	32,	'Künefe',	2,	13,	18,	1),
(96,	1,	32,	'Künefe',	4,	13,	41,	0),
(97,	2,	24,	'Tereyağlı Alabalık',	1,	13,	51,	1),
(98,	2,	31,	'Sade Mantar',	2,	13,	58,	1),
(99,	2,	36,	'Gazoz',	3,	13,	58,	0),
(100,	2,	24,	'Tereyağlı Alabalık',	4,	13,	58,	1),
(101,	2,	48,	'Fırıntava Alabalık',	4,	13,	58,	0),
(102,	2,	32,	'Künefe',	2,	14,	17,	0),
(103,	2,	29,	'Saç Kavurma',	1,	14,	22,	0),
(104,	2,	46,	'Şeftali Soğuk Çay',	1,	14,	23,	0),
(105,	2,	33,	'Tahin Helva',	1,	14,	24,	0),
(106,	2,	32,	'Künefe',	4,	14,	24,	0),
(107,	5,	30,	'Kaşarlı Mantar',	1,	14,	26,	0),
(108,	2,	31,	'Sade Mantar',	6,	14,	34,	1),
(109,	2,	47,	'Limonlu Soğuk Çay',	9,	14,	34,	0),
(110,	2,	29,	'Saç Kavurma',	3,	14,	35,	0),
(111,	2,	32,	'Künefe',	3,	14,	35,	0),
(112,	2,	24,	'Tereyağlı Alabalık',	3,	14,	36,	0),
(113,	2,	48,	'Fırıntava Alabalık',	5,	14,	36,	0),
(114,	4,	27,	'Izgara Köfte',	3,	14,	41,	1),
(115,	4,	42,	'Ayran',	2,	14,	42,	1),
(116,	4,	34,	'Kola',	3,	14,	42,	1),
(117,	5,	24,	'Tereyağlı Alabalık',	2,	14,	43,	1),
(118,	5,	30,	'Kaşarlı Mantar',	1,	14,	43,	1);

DROP TABLE IF EXISTS `rapor`;
CREATE TABLE `rapor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masaid` int(11) NOT NULL,
  `garsonid` int(11) NOT NULL,
  `urunid` int(11) NOT NULL,
  `urunad` varchar(222) COLLATE utf8_turkish_ci NOT NULL,
  `urunfiyat` float NOT NULL,
  `adet` int(11) NOT NULL,
  `tarih` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `rapor` (`id`, `masaid`, `garsonid`, `urunid`, `urunad`, `urunfiyat`, `adet`, `tarih`) VALUES
(132,	0,	0,	0,	'KG Balık',	50,	1,	'2020-06-29'),
(131,	0,	0,	0,	'KG Balık',	50,	1,	'2020-06-29'),
(130,	0,	0,	0,	'KG Balık',	40,	1,	'2020-06-29'),
(129,	7,	1,	34,	'Kola',	5,	2,	'2020-06-29'),
(128,	7,	1,	30,	'Ka?arl? Mantar',	25,	1,	'2020-06-29'),
(127,	7,	1,	24,	'Tereya?l? Alabal?k',	25,	2,	'2020-06-29'),
(126,	2,	1,	29,	'Saç Kavurma',	30,	3,	'2020-06-29'),
(125,	2,	1,	34,	'Kola',	5,	3,	'2020-06-29'),
(124,	3,	1,	32,	'Künefe',	10,	2,	'2020-06-29'),
(123,	3,	1,	24,	'Tereya?l? Alabal?k',	25,	2,	'2020-06-29');

DROP TABLE IF EXISTS `urunler`;
CREATE TABLE `urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `katid` int(11) NOT NULL,
  `ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `fiyat` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `urunler` (`id`, `katid`, `ad`, `fiyat`) VALUES
(35,	19,	'Fanta',	5),
(34,	19,	'Kola',	5),
(33,	21,	'Tahin Helva',	20),
(32,	21,	'Künefe',	10),
(30,	20,	'Kaşarlı Mantar',	25),
(29,	18,	'Saç Kavurma',	30),
(27,	18,	'Izgara Köfte',	25),
(26,	18,	'Kasarlı Alabalik',	28),
(31,	20,	'Sade Mantar',	25),
(28,	18,	'Firinda Köfte',	25),
(25,	18,	'Sebzeli Alabalik',	28),
(24,	18,	'Tereyağlı Alabalık',	25),
(36,	19,	'Gazoz',	5),
(37,	19,	'Karışık Meyve Suyu',	5),
(38,	19,	'Visneli Meyve Suyu',	5),
(39,	19,	'Kaysı Meyve Suyu',	5),
(40,	19,	'Acılı Şalgam Suyu',	5),
(41,	19,	'Acısız Şalgam Suyu',	5),
(42,	19,	'Ayran',	3),
(43,	19,	'Soda',	3),
(44,	19,	'Meyveli Soda',	3),
(45,	19,	'Mango Soğuk Çay',	5),
(46,	19,	'Şeftali Soğuk Çay',	5),
(47,	19,	'Limonlu Soğuk Çay',	5),
(48,	18,	'Fırıntava Alabalık',	25),
(49,	19,	'Karpuz Soğuk Çay',	5),
(50,	19,	'Portakal Meyve Suyu',	5);

DROP TABLE IF EXISTS `yonetim`;
CREATE TABLE `yonetim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kulad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `yonetim` (`id`, `kulad`, `sifre`) VALUES
(1,	'serdar',	'96de4eceb9a0c2b9b52c0b618819821b');

-- 2020-06-29 12:50:13
