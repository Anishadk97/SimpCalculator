/*
TroSQL Free 2.0
Host - 5.5.5-10.1.38-MariaDB : Database - Calculator
**********************************************************************/

CREATE DATABASE IF NOT EXISTS `Calculator`;

USE `Calculator`;

SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

/*Table structure for table `calculator` */

DROP TABLE IF EXISTS `calculator`;

CREATE TABLE `calculator` (
  `calculator_id` int(11) NOT NULL AUTO_INCREMENT,
  `calculator_first_number` float DEFAULT NULL,
  `calculator_second_number` float DEFAULT NULL,
  `calculator_operation` varchar(30) DEFAULT NULL,
  `calculator_result` float DEFAULT NULL,
  `calculator_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`calculator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `calculator` */

insert  into `calculator`(`calculator_id`,`calculator_first_number`,`calculator_second_number`,`calculator_operation`,`calculator_result`,`calculator_date`) values (1,12,34,'Addition',46,'2020-09-08 22:57:54'),(2,43,76,'Multiplication',3268,'2020-09-08 22:58:03'),(3,24,12,'Subtraction',12,'2020-09-08 22:58:12'),(4,45,4,'Division',11,'2020-09-08 22:58:25'),(5,12.3,1.6,'Addition',13.9,'2020-09-08 22:59:38');

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
