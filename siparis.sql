-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `anliksiparis`;
CREATE TABLE `anliksiparis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masaid` int(11) NOT NULL,
  `urunid` int(11) NOT NULL,
  `urunad` varchar(222) NOT NULL,
  `urunfiyat` float NOT NULL,
  `adet` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `anliksiparis` (`id`, `masaid`, `urunid`, `urunad`, `urunfiyat`, `adet`) VALUES
(136,	9,	5,	'Künefe',	8,	3),
(131,	5,	1,	'Kolay',	5,	4),
(134,	2,	1,	'Kolay',	5,	2),
(141,	3,	5,	'Künefe',	8,	13),
(140,	3,	4,	'Kahve',	7,	7),
(125,	4,	4,	'Kahve',	7,	3),
(139,	3,	3,	'Hamburger',	10,	20),
(138,	3,	1,	'Kolay',	5,	3);

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
(4,	'Pizzalar');

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
(14,	'MS-14');

DROP TABLE IF EXISTS `urunler`;
CREATE TABLE `urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `katid` int(11) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `fiyat` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `urunler` (`id`, `katid`, `ad`, `fiyat`) VALUES
(1,	2,	'Kolay',	5),
(2,	1,	'Çay',	2),
(3,	4,	'Hamburger',	10),
(4,	1,	'Kahve',	7),
(5,	3,	'Künefe',	8);

-- 2020-05-28 15:14:36
