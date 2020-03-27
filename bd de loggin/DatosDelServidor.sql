/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.11-MariaDB : Database - covid19
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `covid19`;

/*Table structure for table `afectados` */

DROP TABLE IF EXISTS `afectados`;

CREATE TABLE `afectados` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `idInforme` INT(11) DEFAULT NULL,
  `fallecidos` INT(11) DEFAULT 0,
  `falledias` INT(11) DEFAULT 0,
  `recuperados` INT(11) DEFAULT 0,
  `recuperadia` INT(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idInforme` (`idInforme`),
  CONSTRAINT `afectados_ibfk_2` FOREIGN KEY (`idInforme`) REFERENCES `informegeneral` (`idInforme`)
) ENGINE=INNODB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

/*Data for the table `afectados` */

INSERT  INTO `afectados`(`id`,`idInforme`,`fallecidos`,`falledias`,`recuperados`,`recuperadia`) VALUES (4,79,0,0,0,0),(5,80,0,0,0,0),(6,81,0,0,0,0),(7,82,0,0,0,0),(8,83,0,0,0,0),(9,84,0,0,0,0),(10,85,0,0,0,0),(19,99,0,0,0,0),(20,100,0,0,0,0),(21,101,0,0,0,0),(22,102,0,0,0,0),(23,103,0,0,0,0),(24,104,1,1,0,0),(25,105,0,0,0,0),(26,106,0,0,0,0),(27,107,2,1,0,0),(28,108,3,1,0,0);

/*Table structure for table `informegeneral` */

DROP TABLE IF EXISTS `informegeneral`;

CREATE TABLE `informegeneral` (
  `idInforme` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `infectados` int(11) DEFAULT NULL,
  `totalDia` int(11) DEFAULT NULL,
  `factor` float DEFAULT NULL,
  `promedioFactor` float DEFAULT NULL,
  PRIMARY KEY (`idInforme`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4;

/*Data for the table `informegeneral` */

insert  into `informegeneral`(`idInforme`,`fecha`,`infectados`,`totalDia`,`factor`,`promedioFactor`) values (79,'2020-03-08',1,1,0,0),(80,'2020-03-09',0,1,1,1),(81,'2020-03-10',4,5,5,3),(82,'2020-03-11',0,5,1,2.33333),(83,'2020-03-12',1,6,1.2,1.75),(84,'2020-03-13',1,7,1.16667,1.56),(85,'2020-03-14',0,7,1.1667,1.56111),(99,'2020-03-15',1,8,1.1429,1.45953),(100,'2020-03-16',1,9,1.125,1.42236),(101,'2020-03-17',2,11,1.2222,1.40235),(102,'2020-03-18',0,11,1,1.36577),(103,'2020-03-19',2,13,1.1818,1.35044),(104,'2020-03-20',5,18,1.3846,1.35307),(105,'2020-03-21',4,22,1.2222,1.34372),(106,'2020-03-22',0,22,1,1.3208),(107,'2020-03-23',5,27,1.2273,1.31496),(108,'2020-03-24',10,37,1.3704,1.31822);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
