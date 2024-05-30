-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.23 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for basvuruformu
CREATE DATABASE IF NOT EXISTS `basvuruformu` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `basvuruformu`;

-- Dumping structure for table basvuruformu.basvuru
CREATE TABLE IF NOT EXISTS `basvuru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adSoyad` varchar(50) DEFAULT NULL,
  `DogumYeri` varchar(50) DEFAULT NULL,
  `DogumTarihi` varchar(50) DEFAULT NULL,
  `mail` varchar(500) DEFAULT NULL,
  `CTelefon` varchar(50) DEFAULT NULL,
  `ETelefon` varchar(50) DEFAULT NULL,
  `Adres` varchar(500) DEFAULT NULL,
  `Cinsiyet` varchar(500) DEFAULT NULL,
  `MedeniHal` varchar(500) DEFAULT NULL,
  `Ehliyet` varchar(500) DEFAULT NULL,
  `Askerlik` varchar(500) DEFAULT NULL,
  `BasvuruTarihi` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;

-- Dumping data for table basvuruformu.basvuru: ~4 rows (approximately)
/*!40000 ALTER TABLE `basvuru` DISABLE KEYS */;
INSERT INTO `basvuru` (`id`, `adSoyad`, `DogumYeri`, `DogumTarihi`, `mail`, `CTelefon`, `ETelefon`, `Adres`, `Cinsiyet`, `MedeniHal`, `Ehliyet`, `Askerlik`, `BasvuruTarihi`) VALUES
	(127, 'Fırat YILDIZ', 'Muğla', '1998', 'firatyildiz@yandex.com', '(599)788-7878', '(212)665-6587', 'Zeytinburnu/İstanbul', 'Erkek', 'Bekar', 'YOK', 'Yapılmadı', '2018-12-16 00:16:50'),
	(128, 'Mehmet Seçkin', 'Manisa', '1995', 'mehmetseckin@yandex.com', '(562)747-8985', '(212)978-7887', 'Kadıköy/İstanbul', 'Erkek', 'Bekar', 'YOK', 'Yapıldı', '2018-12-16 01:19:23'),
	(129, 'Ece Yıldırım', 'Artvin', '1993', 'eceyldrm@gmail.com', '(578)452-1212', '(212)695-7412', 'Beşiktaş/İstanbul', 'Kadın', 'Evli', 'YOK', 'Muaf', '2018-12-16 01:21:16'),
	(131, 'Burhancan yılmaz', 'Sivas', '1998', 'burhancnylmaz@gmail.com', '(587)878-7878', '(212)645-8787', 'Kağıthane/İstanbul', 'Erkek', 'Evli', 'VAR', 'Yapıldı', '2018-12-16 01:25:02');
/*!40000 ALTER TABLE `basvuru` ENABLE KEYS */;



-- Dumping structure for table basvuruformu.egitim
CREATE TABLE IF NOT EXISTS `egitim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `okulAd` varchar(500) NOT NULL DEFAULT '0',
  `MezunYil` varchar(500) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- Dumping data for table basvuruformu.egitim: ~10 rows (approximately)
/*!40000 ALTER TABLE `egitim` DISABLE KEYS */;
INSERT INTO `egitim` (`id`, `okulAd`, `MezunYil`) VALUES
	(71, 'Muğla Ortaokulu', '2010'),
	(72, 'Muğla Fen Lisesi', '2014'),
	(73, 'İstanbul Teknik Üniversitesi', '2018'),
	(74, 'Manisa Ortaokulu', '2002'),
	(75, 'Manisa Lisesi', '2006'),
	(76, 'Artivin Ortaokulu', '2006'),
	(77, 'Artin Lisesi', '2010'),
	(78, 'Marmara Üniversitesi', '2014'),
	(81, 'Sivas Anadolu Lisesi', '2014'),
	(82, 'Sivas Ortaokulu', '2010');
/*!40000 ALTER TABLE `egitim` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

-- Dumping structure for table basvuruformu.basvuruegitim
CREATE TABLE IF NOT EXISTS `basvuruegitim` (
  `basvuruid` int(11) NOT NULL,
  `egitimid` int(11) NOT NULL,
  PRIMARY KEY (`basvuruid`,`egitimid`),
  KEY `basvuruid` (`basvuruid`),
  KEY `egitimid` (`egitimid`),
  CONSTRAINT `FK__basvuru` FOREIGN KEY (`basvuruid`) REFERENCES `basvuru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__egitim` FOREIGN KEY (`egitimid`) REFERENCES `egitim` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table basvuruformu.basvuruegitim: ~10 rows (approximately)
/*!40000 ALTER TABLE `basvuruegitim` DISABLE KEYS */;
INSERT INTO `basvuruegitim` (`basvuruid`, `egitimid`) VALUES
	(127, 71),
	(127, 72),
	(127, 73),
	(128, 74),
	(128, 75),
	(129, 76),
	(129, 77),
	(129, 78),
	(131, 81),
	(131, 82);
/*!40000 ALTER TABLE `basvuruegitim` ENABLE KEYS */;