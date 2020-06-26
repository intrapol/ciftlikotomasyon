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
(328,	3,	1,	8,	'elma',	123,	2),
(329,	3,	1,	2,	'Çay',	1,	1),
(324,	2,	1,	8,	'elma',	123,	3),
(325,	2,	1,	6,	'lahmacun',	22,	2),
(326,	2,	1,	11,	'kebabi',	2,	2);

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
(0,	8,	'MS-8',	333,	14),
(0,	3,	'MS-4',	521,	21),
(0,	2,	'MS-2',	52310,	56),
(0,	10,	'MS-10',	97,	13),
(0,	9,	'MS-9',	1301400,	36),
(0,	1,	'MS-1',	1220,	71),
(0,	5,	'MS-5',	393,	15),
(0,	12,	'MS-12',	2088,	22),
(0,	4,	'MS-3',	10752,	19),
(0,	1421,	'MS-16',	69,	3),
(0,	13,	'MS-13',	1,	1),
(0,	11,	'MS-11',	313,	6),
(0,	7,	'MS-7',	1,	1),
(0,	0,	'KG-Balık',	24.5,	2);

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
(1,	2,	'Çay',	49,	42),
(2,	4,	'Kahve',	119,	17),
(3,	3,	'Hamburger',	319,	31),
(4,	5,	'Künefe',	168,	21),
(5,	1,	'Kolay',	125,	25),
(6,	13,	'zor ',	1301310,	26),
(7,	11,	'kebabi',	18,	9),
(8,	7,	'sigara',	1107,	9),
(9,	8,	'elma',	3813,	31),
(10,	12,	'Limonata',	6,	3),
(11,	6,	'lahmacun',	374,	17),
(12,	16,	'Tereya?l? Bal?k',	161,	7),
(13,	10,	'cugara',	1887,	17),
(14,	9,	'karpuz',	34,	17),
(15,	17,	'mehmeturun',	60000,	6),
(16,	0,	'KG Balık',	24.5,	2);

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
(6,	'Nargile'),
(11,	'Balık'),
(12,	'Uçaklar'),
(13,	'Arabalar'),
(14,	'Keller'),
(15,	'Sporlar'),
(16,	'Yumurtalar'),
(17,	'Küçükler');

DROP TABLE IF EXISTS `masalar`;
CREATE TABLE `masalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `masalar` (`id`, `ad`, `durum`) VALUES
(1,	'MS-1',	0),
(2,	'MS-2',	1),
(3,	'MS-4',	1),
(4,	'MS-3',	0),
(5,	'MS-5',	0),
(6,	'MS-6',	0),
(7,	'MS-7',	0),
(8,	'MS-8',	0),
(9,	'MS-9',	0),
(10,	'MS-10',	0),
(11,	'MS-11',	0),
(12,	'MS-12',	1),
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
(63,	2,	6,	'lahmacun',	2,	22,	1,	1),
(64,	2,	11,	'kebabi',	2,	22,	1,	1),
(66,	3,	8,	'elma',	2,	22,	17,	1),
(67,	3,	2,	'Çay',	1,	22,	19,	1);

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
(37,	9,	6,	11,	'kebabi',	2,	3,	'2020-06-10'),
(38,	3,	1,	16,	'Tereya?l? Bal?k',	23,	3,	'2020-06-15'),
(39,	2,	1,	1,	'Kola',	5,	3,	'2020-06-20'),
(40,	2,	1,	1,	'Kola',	5,	4,	'2020-06-22'),
(41,	2,	1,	6,	'lahmacun',	22,	1,	'2020-06-22'),
(42,	2,	1,	10,	'cugara',	111,	1,	'2020-06-22'),
(43,	2,	1,	11,	'kebabi',	2,	1,	'2020-06-22'),
(44,	2,	1,	7,	'sigara',	123,	3,	'2020-06-22'),
(45,	2,	1,	12,	'Limonata',	2,	1,	'2020-06-22'),
(46,	2,	1,	16,	'Tereya?l? Bal?k',	23,	1,	'2020-06-22'),
(47,	2,	1,	8,	'elma',	123,	2,	'2020-06-22'),
(48,	3,	1,	8,	'elma',	123,	3,	'2020-06-22'),
(49,	1,	1,	8,	'elma',	123,	1,	'2020-06-22'),
(50,	1,	1,	8,	'elma',	123,	3,	'2020-06-22'),
(51,	1,	1,	9,	'karpuz',	2,	4,	'2020-06-22'),
(52,	1,	1,	8,	'elma',	123,	3,	'2020-06-22'),
(53,	12,	1,	8,	'elma',	123,	2,	'2020-06-23'),
(54,	12,	1,	6,	'lahmacun',	22,	4,	'2020-06-23'),
(55,	12,	1,	13,	'zor ',	101,	7,	'2020-06-23'),
(56,	1,	1,	2,	'Çay',	1,	16,	'2020-06-24'),
(57,	4,	1,	9,	'karpuz',	2,	4,	'2020-06-25'),
(58,	3,	1,	9,	'karpuz',	2,	4,	'2020-06-25'),
(59,	5,	1,	2,	'Çay',	1,	6,	'2020-06-25'),
(60,	12,	1,	10,	'cugara',	111,	5,	'2020-06-25'),
(61,	12,	1,	8,	'elma',	123,	4,	'2020-06-25'),
(62,	8,	1,	3,	'Hamburger',	11,	2,	'2020-06-25'),
(63,	9,	1,	2,	'Çay',	1,	1,	'2020-06-25'),
(64,	1421,	1,	16,	'Tereya?l? Bal?k',	23,	3,	'2020-06-25'),
(65,	13,	1,	2,	'Çay',	1,	1,	'2020-06-26'),
(66,	11,	1,	2,	'Çay',	1,	1,	'2020-06-26'),
(67,	11,	1,	7,	'sigara',	123,	2,	'2020-06-26'),
(68,	11,	1,	6,	'lahmacun',	22,	3,	'2020-06-26'),
(69,	2,	1,	10,	'cugara',	111,	2,	'2020-06-26'),
(70,	2,	1,	6,	'lahmacun',	22,	2,	'2020-06-26'),
(71,	2,	1,	17,	'mehmeturun',	10000,	5,	'2020-06-26'),
(72,	2,	1,	1,	'Kola',	5,	1,	'2020-06-26'),
(73,	2,	1,	13,	'zor ',	101,	4,	'2020-06-26'),
(74,	2,	1,	9,	'karpuz',	2,	4,	'2020-06-26'),
(75,	2,	1,	8,	'elma',	123,	3,	'2020-06-26'),
(76,	2,	1,	2,	'Çay',	1,	1,	'2020-06-26'),
(77,	7,	1,	2,	'Çay',	1,	1,	'2020-06-26'),
(78,	8,	1,	2,	'Çay',	1,	1,	'2020-06-26'),
(79,	9,	1,	2,	'Çay',	1,	1,	'2020-06-26'),
(80,	9,	1,	8,	'elma',	123,	4,	'2020-06-26'),
(81,	9,	1,	10,	'cugara',	111,	5,	'2020-06-26'),
(82,	9,	1,	6,	'lahmacun',	22,	2,	'2020-06-26'),
(83,	4,	1,	10,	'cugara',	111,	4,	'2020-06-26'),
(84,	4,	1,	6,	'lahmacun',	22,	3,	'2020-06-26'),
(85,	4,	1,	1,	'Kola',	5,	1,	'2020-06-26'),
(86,	4,	1,	2,	'Çay',	1,	3,	'2020-06-26'),
(87,	4,	1,	8,	'elma',	123,	1,	'2020-06-26'),
(88,	4,	1,	9,	'karpuz',	2,	1,	'2020-06-26'),
(89,	4,	1,	13,	'zor ',	101,	1,	'2020-06-26'),
(90,	4,	1,	17,	'mehmeturun',	10000,	1,	'2020-06-26'),
(91,	5,	1,	2,	'Çay',	1,	3,	'2020-06-26'),
(92,	5,	1,	8,	'elma',	123,	3,	'2020-06-26'),
(97,	0,	0,	0,	'KG Balık',	12.5,	1,	'2020-06-27'),
(96,	0,	0,	0,	'KG Balık',	12,	1,	'2020-06-27');

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
(2,	1,	'Çay',	1),
(3,	4,	'Hamburger',	11),
(6,	2,	'lahmacun',	22),
(7,	3,	'sigara',	123),
(8,	1,	'elma',	123),
(9,	1,	'karpuz',	2),
(10,	2,	'cugara',	111),
(11,	3,	'kebabi',	2),
(12,	2,	'Limonata',	2),
(13,	1,	'zor ',	101),
(16,	11,	'Tereyağlı Balık',	23),
(17,	1,	'mehmeturun',	10000);

DROP TABLE IF EXISTS `yonetim`;
CREATE TABLE `yonetim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kulad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `yonetim` (`id`, `kulad`, `sifre`) VALUES
(1,	'serdar',	'96de4eceb9a0c2b9b52c0b618819821b');

-- 2020-06-26 22:30:46
