/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.24-MariaDB : Database - ci4_restapi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ci4_restapi` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ci4_restapi`;

/*Table structure for table `keys` */

DROP TABLE IF EXISTS `keys`;

CREATE TABLE `keys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(256) NOT NULL,
  `level` int(11) NOT NULL,
  `ignore_limits` int(11) NOT NULL,
  `is_private_key` int(11) NOT NULL,
  `ip_address` varchar(256) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `keys` */

insert  into `keys`(`id`,`user_id`,`key`,`level`,`ignore_limits`,`is_private_key`,`ip_address`,`created_at`,`updated_at`) values 
(1,1,'sae',1,0,0,NULL,'2023-03-09 04:12:01','2023-03-09 04:12:01'),
(2,1,'pul',1,0,0,NULL,'2023-03-09 04:12:01','2023-03-09 04:12:01');

/*Table structure for table `limits` */

DROP TABLE IF EXISTS `limits`;

CREATE TABLE `limits` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `controller` varchar(255) NOT NULL,
  `uri` varchar(256) NOT NULL,
  `count` int(11) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(256) NOT NULL,
  `first` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

/*Data for the table `limits` */

insert  into `limits`(`id`,`controller`,`uri`,`count`,`hour_started`,`api_key`,`first`,`created_at`,`updated_at`) values 
(42,'\\App\\Controllers\\Api\\Mahasiswa','uri:api/mahasiswa/4:get',1,1678414530,'pul',1,'2023-03-10 02:15:30','2023-03-10 02:15:30'),
(43,'\\App\\Controllers\\Api\\Mahasiswa','uri:api/mahasiswa/4:get',1,1678414546,'pul',0,'2023-03-10 02:15:46','2023-03-10 02:15:46'),
(44,'\\App\\Controllers\\Api\\Mahasiswa','uri:api/mahasiswa/4:get',1,1678414551,'pul',0,'2023-03-10 02:15:51','2023-03-10 02:15:51'),
(45,'\\App\\Controllers\\Api\\Mahasiswa','uri:api/mahasiswa/4:get',1,1678414552,'pul',1,'2023-03-10 02:15:52','2023-03-10 02:15:52'),
(46,'\\App\\Controllers\\Api\\Mahasiswa','uri:api/mahasiswa/4:get',1,1678414553,'pul',0,'2023-03-10 02:15:53','2023-03-10 02:15:53'),
(47,'\\App\\Controllers\\Api\\Mahasiswa','uri:api/mahasiswa/4:get',1,1678414554,'pul',0,'2023-03-10 02:15:54','2023-03-10 02:15:54'),
(48,'\\App\\Controllers\\Api\\Mahasiswa','uri:api/mahasiswa/4:get',1,1678414555,'pul',0,'2023-03-10 02:15:55','2023-03-10 02:15:55'),
(49,'\\App\\Controllers\\Api\\Mahasiswa','uri:api/mahasiswa/4:get',1,1678414556,'pul',0,'2023-03-10 02:15:56','2023-03-10 02:15:56'),
(50,'\\App\\Controllers\\Api\\Mahasiswa','uri:api/mahasiswa/4:get',1,1678414557,'pul',0,'2023-03-10 02:15:57','2023-03-10 02:15:57'),
(51,'\\App\\Controllers\\Api\\Mahasiswa','uri:api/mahasiswa/4:get',1,1678414558,'pul',0,'2023-03-10 02:15:58','2023-03-10 02:15:58');

/*Table structure for table `mahasiswa` */

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `npm` varchar(9) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `jurusan` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `mahasiswa` */

insert  into `mahasiswa`(`id`,`npm`,`nama`,`email`,`jurusan`,`created_at`,`updated_at`) values 
(1,'D1A200027','saepul hidayat','saepulhidayat302@gmail.com','sistem informasi','2023-03-08 10:04:17','2023-03-08 10:04:17'),
(4,'D1A190007','hamdanasdd','hamdan@gmail.com','SISTEM INFORMASI','2023-03-08 09:42:04','2023-03-08 09:42:04'),
(6,'D1A190007','hamdan ajah kali','hamdan@gmail.com','SISTEM INFORMASI','2023-03-09 01:34:45','2023-03-09 01:54:44'),
(7,'D1A190007','hamdanasdd','hamdan123@gmail.com','SISTEM INFORMASI','2023-03-09 02:21:47','2023-03-09 02:21:47'),
(12,'D1A190007','hamdanasdd','hamdan1234@gmail.com','SISTEM INFORMASI','2023-03-09 09:08:50','2023-03-09 09:08:50');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) values 
(1,'2023-03-08-065926','App\\Database\\Migrations\\Mahasiswa','default','App',1678263828,1),
(2,'2023-03-08-081526','App\\Database\\Migrations\\Keys','default','App',1678263829,1),
(3,'2023-03-08-081536','App\\Database\\Migrations\\Limits','default','App',1678263829,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
