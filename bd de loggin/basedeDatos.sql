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
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4;

/*Data for the table `informegeneral` */

insert  into `informegeneral`(`idInforme`,`fecha`,`infectados`,`totalDia`,`factor`,`promedioFactor`) values (79,'2020-03-08',1,1,0,0),(80,'2020-03-09',0,1,1,1),(81,'2020-03-10',4,5,5,3),(82,'2020-03-11',0,5,1,2.33333),(83,'2020-03-12',1,6,1.2,1.75),(84,'2020-03-13',1,7,1.16667,1.56),(85,'2020-03-14',0,7,1.1667,1.56111),(99,'2020-03-15',1,8,1.1429,1.45953),(100,'2020-03-16',1,9,1.125,1.42236),(101,'2020-03-17',2,11,1.2222,1.40235),(102,'2020-03-18',0,11,1,1.36577),(103,'2020-03-19',2,13,1.1818,1.35044),(104,'2020-03-20',5,18,1.3846,1.35307);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
