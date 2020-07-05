SET NAMES utf8;DROP TABLE IF EXISTS anliksiparis;

CREATE TABLE `anliksiparis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `masaid` int(11) NOT NULL,
  `garsonid` int(11) NOT NULL,
  `urunid` int(11) NOT NULL,
  `urunad` varchar(222) COLLATE utf8_turkish_ci NOT NULL,
  `urunfiyat` float NOT NULL,
  `adet` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO anliksiparis VALUES("5","0","1","14","Kg-Bal?k","25","2");
INSERT INTO anliksiparis VALUES("6","0","1","14","Kg-Bal?k","25","2");
INSERT INTO anliksiparis VALUES("7","0","1","14","Kg-Bal?k","25","1");
INSERT INTO anliksiparis VALUES("8","0","1","14","Kg-Bal?k","25","1");
INSERT INTO anliksiparis VALUES("9","0","1","14","Kg-Bal?k","25","1");
INSERT INTO anliksiparis VALUES("10","0","1","14","Kg-Bal?k","25","2");



DROP TABLE IF EXISTS doluluk;

CREATE TABLE `doluluk` (
  `id` int(11) NOT NULL DEFAULT 1,
  `bos` int(11) NOT NULL DEFAULT 0,
  `dolu` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO doluluk VALUES("1","0","1");



DROP TABLE IF EXISTS garson;

CREATE TABLE `garson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` int(11) NOT NULL,
  `durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO garson VALUES("1","serdar","11","1");
INSERT INTO garson VALUES("2","ahmet","123","0");
INSERT INTO garson VALUES("3","veli","123","0");
INSERT INTO garson VALUES("6","anagarson","123","0");



DROP TABLE IF EXISTS gecicigarson;

CREATE TABLE `gecicigarson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `garsonid` int(11) NOT NULL,
  `garsonad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `adet` int(11) NOT NULL,
  `hasilat` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;




DROP TABLE IF EXISTS gecicimasa;

CREATE TABLE `gecicimasa` (
  `id` int(11) NOT NULL,
  `masaid` int(11) NOT NULL,
  `masaad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `hasilat` float NOT NULL,
  `adet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO gecicimasa VALUES("0","1","DDFSF","6187","343");



DROP TABLE IF EXISTS geciciurun;

CREATE TABLE `geciciurun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urunid` int(11) NOT NULL,
  `urunad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `hasilat` float NOT NULL,
  `adet` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO geciciurun VALUES("1","10","yy","60","5");
INSERT INTO geciciurun VALUES("2","11","qq","36","3");
INSERT INTO geciciurun VALUES("3","1","FDSF","657","7");
INSERT INTO geciciurun VALUES("4","14","Kg-Bal?k","1000","40");
INSERT INTO geciciurun VALUES("5","15","Pi?irme","2680","268");
INSERT INTO geciciurun VALUES("6","6","2-sandelye","246","2");
INSERT INTO geciciurun VALUES("7","5","2-uçak","984","8");
INSERT INTO geciciurun VALUES("8","8","bb","492","4");
INSERT INTO geciciurun VALUES("9","3","elma","8","4");
INSERT INTO geciciurun VALUES("10","12","3-dsfadsf","24","2");



DROP TABLE IF EXISTS gider;

CREATE TABLE `gider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `fiyat` float NOT NULL,
  `tarih` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;




DROP TABLE IF EXISTS kategori;

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO kategori VALUES("1","balıklar");
INSERT INTO kategori VALUES("2","icecek");
INSERT INTO kategori VALUES("1000","KG-Balık");



DROP TABLE IF EXISTS masalar;

CREATE TABLE `masalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO masalar VALUES("0","KG-Balık","0");
INSERT INTO masalar VALUES("-1","Pisirme-Ucreti","0");
INSERT INTO masalar VALUES("1","DDFSF","0");



DROP TABLE IF EXISTS mutfak;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO mutfak VALUES("11","1","5","2-uçak","3","14","14","1");
INSERT INTO mutfak VALUES("12","1","6","2-sandelye","1","21","40","1");
INSERT INTO mutfak VALUES("13","1","12","3-dsfadsf","1","21","40","1");
INSERT INTO mutfak VALUES("14","1","3","elma","1","21","40","1");
INSERT INTO mutfak VALUES("15","1","5","2-uçak","3","21","40","1");
INSERT INTO mutfak VALUES("16","1","4","1-karğux","2","21","41","1");



DROP TABLE IF EXISTS rapor;

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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO rapor VALUES("1","1","1","10","yy","12","5","2020-06-30");
INSERT INTO rapor VALUES("2","1","1","11","qq","12","3","2020-07-01");
INSERT INTO rapor VALUES("3","1","1","1","FDSF","21","2","2020-07-01");
INSERT INTO rapor VALUES("4","1","1","14","Kg-Bal?k","25","2","2020-07-01");
INSERT INTO rapor VALUES("5","1","1","15","Pi?irme","10","23","2020-07-01");
INSERT INTO rapor VALUES("6","1","1","14","Kg-Bal?k","25","23","2020-07-01");
INSERT INTO rapor VALUES("7","1","1","15","Pi?irme","10","234","2020-07-01");
INSERT INTO rapor VALUES("8","1","1","6","2-sandelye","123","1","2020-07-02");
INSERT INTO rapor VALUES("9","1","1","5","2-uçak","123","5","2020-07-02");
INSERT INTO rapor VALUES("10","1","1","1","5-Tereyağlı Balık","123","5","2020-07-02");
INSERT INTO rapor VALUES("11","1","1","8","bb","123","4","2020-07-02");
INSERT INTO rapor VALUES("12","1","1","3","elma","2","4","2020-07-02");
INSERT INTO rapor VALUES("13","1","1","12","3-dsfadsf","12","2","2020-07-02");
INSERT INTO rapor VALUES("14","1","1","15","Pişirme","10","11","2020-07-02");
INSERT INTO rapor VALUES("15","1","1","14","Kg-Balık","25","11","2020-07-02");
INSERT INTO rapor VALUES("16","1","1","5","2-uçak","123","3","2020-07-02");
INSERT INTO rapor VALUES("17","1","1","6","2-sandelye","123","1","2020-07-02");
INSERT INTO rapor VALUES("18","1","1","14","Kg-Balık","25","2","2020-07-02");
INSERT INTO rapor VALUES("19","1","1","14","Kg-Balık","25","2","2020-07-02");
INSERT INTO rapor VALUES("20","1","1","14","Kg-Balık","25","0","2020-07-04");
INSERT INTO rapor VALUES("21","1","1","15","Pişirme","10","8","2020-07-04");
INSERT INTO rapor VALUES("22","1","1","14","Kg-Balık","25","3","2020-07-04");
INSERT INTO rapor VALUES("23","1","1","4","1-karğux","2323","2","2020-07-04");
INSERT INTO rapor VALUES("24","1","1","5","2-uçak","123","3","2020-07-04");
INSERT INTO rapor VALUES("25","1","1","3","elma","2","1","2020-07-04");
INSERT INTO rapor VALUES("26","1","1","12","3-dsfadsf","12","1","2020-07-04");
INSERT INTO rapor VALUES("27","1","1","6","2-sandelye","123","1","2020-07-04");



DROP TABLE IF EXISTS urunler;

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `katid` int(11) NOT NULL,
  `ad` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `fiyat` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO urunler VALUES("1","1","5-Tereyağlı Balık","123");
INSERT INTO urunler VALUES("2","2","meyva","21");
INSERT INTO urunler VALUES("3","1","elma","2");
INSERT INTO urunler VALUES("4","1","1-karğux","2323");
INSERT INTO urunler VALUES("5","1","2-uçak","123");
INSERT INTO urunler VALUES("6","1","2-sandelye","123");
INSERT INTO urunler VALUES("7","1","aa","123");
INSERT INTO urunler VALUES("8","1","bb","123");
INSERT INTO urunler VALUES("9","1","dssd","12");
INSERT INTO urunler VALUES("10","2","yy","12");
INSERT INTO urunler VALUES("11","2","qq","12");
INSERT INTO urunler VALUES("12","1","3-dsfadsf","12");
INSERT INTO urunler VALUES("13","1","4-jsdkflsdf","123213");
INSERT INTO urunler VALUES("14","-1","Kg-Balık","25");
INSERT INTO urunler VALUES("15","-1","Pişirme","10");



DROP TABLE IF EXISTS yonetim;

CREATE TABLE `yonetim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kulad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO yonetim VALUES("1","serdar","96de4eceb9a0c2b9b52c0b618819821b");



