/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.1.13-MariaDB : Database - slim
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`slim` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `slim`;

/*Table structure for table `class1` */

DROP TABLE IF EXISTS `class1`;

CREATE TABLE `class1` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `class1` */

insert  into `class1`(`userid`,`firstname`,`lastname`,`email`,`Phone`) values (1,'world','star 1','test1@gmail.com','+123456'),(2,'world','star 2','test2@gmail.com','+123456'),(3,'world','star 3','test3@gmail.com','+123456'),(4,'world','star 4','test4@gmail.com','+123456'),(5,'world','star 5','test5@gmail.com','+123456'),(6,'world','star 6','test6@gmail.com','+123456');

/*Table structure for table `class2` */

DROP TABLE IF EXISTS `class2`;

CREATE TABLE `class2` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `ordertotal` int(11) NOT NULL,
  `orderdate` date NOT NULL,
  `orderstatus` int(11) NOT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `class2` */

insert  into `class2`(`orderid`,`userid`,`ordertotal`,`orderdate`,`orderstatus`) values (1,1,3,'2016-06-23',1),(2,2,2,'2016-06-22',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
