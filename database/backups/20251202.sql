/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 8.0.44-0ubuntu0.24.04.1 : Database - fam_condiminio
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`fam_condiminio` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

/*Table structure for table `addresses` */

DROP TABLE IF EXISTS `addresses`;

CREATE TABLE `addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `addressable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addressable_id` bigint NOT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `neighborhood` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Brasil',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `addresses_addressable_type_addressable_id_unique` (`addressable_type`,`addressable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `addresses` */

/*Table structure for table `apartments` */

DROP TABLE IF EXISTS `apartments`;

CREATE TABLE `apartments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `condominium_id` bigint unsigned NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fraction` decimal(5,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apartments_identifier_unique` (`identifier`),
  KEY `apartments_condominium_id_foreign` (`condominium_id`),
  CONSTRAINT `apartments_condominium_id_foreign` FOREIGN KEY (`condominium_id`) REFERENCES `condominiums` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `apartments` */

insert  into `apartments`(`id`,`condominium_id`,`identifier`,`fraction`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'APTO 02',0.00,'2025-10-15 15:41:47','2025-10-17 20:43:40',NULL),
(2,1,'APTO 101',0.00,'2025-10-15 15:42:00','2025-10-15 15:42:00',NULL),
(3,1,'APTO 102',0.00,'2025-10-15 15:42:05','2025-10-15 15:42:05',NULL),
(4,1,'APTO 201',0.00,'2025-10-15 15:42:11','2025-10-15 15:42:11',NULL),
(5,1,'APTO 202',0.00,'2025-10-15 15:42:17','2025-10-15 15:42:17',NULL),
(6,1,'APTO 301',0.00,'2025-10-15 15:42:23','2025-10-15 15:42:23',NULL),
(7,1,'APTO 302',0.00,'2025-10-15 15:42:29','2025-10-15 15:42:29',NULL);

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

insert  into `cache`(`key`,`value`,`expiration`) values 
('laravel_cache_livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6','i:1;',1764699487),
('laravel_cache_livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6:timer','i:1764699487;',1764699487),
('laravel_cache_spatie.permission.cache','a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:126:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"ViewAny:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:9:\"View:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"Create:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"Update:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"Delete:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:12:\"Restore:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:16:\"ForceDelete:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:19:\"ForceDeleteAny:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"RestoreAny:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:14:\"Replicate:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:12:\"Reorder:Role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:17:\"ViewAny:Apartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:14:\"View:Apartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:16:\"Create:Apartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:16:\"Update:Apartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:16:\"Delete:Apartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:17:\"Restore:Apartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:21:\"ForceDelete:Apartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:24:\"ForceDeleteAny:Apartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:20:\"RestoreAny:Apartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:19:\"Replicate:Apartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:17:\"Reorder:Apartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:19:\"ViewAny:Condominium\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:16:\"View:Condominium\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:18:\"Create:Condominium\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:18:\"Update:Condominium\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:18:\"Delete:Condominium\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:19:\"Restore:Condominium\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:23:\"ForceDelete:Condominium\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:26:\"ForceDeleteAny:Condominium\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:22:\"RestoreAny:Condominium\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:21:\"Replicate:Condominium\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:19:\"Reorder:Condominium\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:25:\"ViewAny:ConsumptionCharge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:22:\"View:ConsumptionCharge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:24:\"Create:ConsumptionCharge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:24:\"Update:ConsumptionCharge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:24:\"Delete:ConsumptionCharge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:25:\"Restore:ConsumptionCharge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:29:\"ForceDelete:ConsumptionCharge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:32:\"ForceDeleteAny:ConsumptionCharge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:28:\"RestoreAny:ConsumptionCharge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:27:\"Replicate:ConsumptionCharge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:25:\"Reorder:ConsumptionCharge\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:15:\"ViewAny:Expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:12:\"View:Expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:14:\"Create:Expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:14:\"Update:Expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:14:\"Delete:Expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:15:\"Restore:Expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:19:\"ForceDelete:Expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:22:\"ForceDeleteAny:Expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:18:\"RestoreAny:Expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:17:\"Replicate:Expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:15:\"Reorder:Expense\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:31:\"ViewAny:MonthlyClosingApartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:28:\"View:MonthlyClosingApartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:30:\"Create:MonthlyClosingApartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:30:\"Update:MonthlyClosingApartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:30:\"Delete:MonthlyClosingApartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:31:\"Restore:MonthlyClosingApartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:35:\"ForceDelete:MonthlyClosingApartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:38:\"ForceDeleteAny:MonthlyClosingApartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:34:\"RestoreAny:MonthlyClosingApartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:33:\"Replicate:MonthlyClosingApartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:31:\"Reorder:MonthlyClosingApartment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:22:\"ViewAny:MonthlyClosing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:19:\"View:MonthlyClosing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:21:\"Create:MonthlyClosing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:21:\"Update:MonthlyClosing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:21:\"Delete:MonthlyClosing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:22:\"Restore:MonthlyClosing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:72;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:26:\"ForceDelete:MonthlyClosing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:73;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:29:\"ForceDeleteAny:MonthlyClosing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:74;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:25:\"RestoreAny:MonthlyClosing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:75;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:24:\"Replicate:MonthlyClosing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:76;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:22:\"Reorder:MonthlyClosing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:77;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:16:\"ViewAny:Resident\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:78;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:13:\"View:Resident\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:79;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:15:\"Create:Resident\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:80;a:4:{s:1:\"a\";i:81;s:1:\"b\";s:15:\"Update:Resident\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:81;a:4:{s:1:\"a\";i:82;s:1:\"b\";s:15:\"Delete:Resident\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:82;a:4:{s:1:\"a\";i:83;s:1:\"b\";s:16:\"Restore:Resident\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:83;a:4:{s:1:\"a\";i:84;s:1:\"b\";s:20:\"ForceDelete:Resident\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:84;a:4:{s:1:\"a\";i:85;s:1:\"b\";s:23:\"ForceDeleteAny:Resident\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:85;a:4:{s:1:\"a\";i:86;s:1:\"b\";s:19:\"RestoreAny:Resident\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:86;a:4:{s:1:\"a\";i:87;s:1:\"b\";s:18:\"Replicate:Resident\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:87;a:4:{s:1:\"a\";i:88;s:1:\"b\";s:16:\"Reorder:Resident\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:88;a:4:{s:1:\"a\";i:89;s:1:\"b\";s:12:\"ViewAny:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:89;a:4:{s:1:\"a\";i:90;s:1:\"b\";s:9:\"View:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:90;a:4:{s:1:\"a\";i:91;s:1:\"b\";s:11:\"Create:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:91;a:4:{s:1:\"a\";i:92;s:1:\"b\";s:11:\"Update:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:92;a:4:{s:1:\"a\";i:93;s:1:\"b\";s:11:\"Delete:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:93;a:4:{s:1:\"a\";i:94;s:1:\"b\";s:12:\"Restore:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:94;a:4:{s:1:\"a\";i:95;s:1:\"b\";s:16:\"ForceDelete:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:95;a:4:{s:1:\"a\";i:96;s:1:\"b\";s:19:\"ForceDeleteAny:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:96;a:4:{s:1:\"a\";i:97;s:1:\"b\";s:15:\"RestoreAny:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:97;a:4:{s:1:\"a\";i:98;s:1:\"b\";s:14:\"Replicate:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:98;a:4:{s:1:\"a\";i:99;s:1:\"b\";s:12:\"Reorder:User\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:99;a:4:{s:1:\"a\";i:100;s:1:\"b\";s:28:\"View:MonthlyClosingsOverview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:100;a:4:{s:1:\"a\";i:101;s:1:\"b\";s:25:\"View:MonthlyClosingsChart\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:101;a:4:{s:1:\"a\";i:102;s:1:\"b\";s:19:\"View:PieChartWidget\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:102;a:4:{s:1:\"a\";i:103;s:1:\"b\";s:21:\"View:ExpensesOverview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:103;a:4:{s:1:\"a\";i:104;s:1:\"b\";s:23:\"View:ApartmentsOverview\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:104;a:4:{s:1:\"a\";i:105;s:1:\"b\";s:29:\"ViewAny:CommunicationTemplate\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:105;a:4:{s:1:\"a\";i:106;s:1:\"b\";s:26:\"View:CommunicationTemplate\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:106;a:4:{s:1:\"a\";i:107;s:1:\"b\";s:28:\"Create:CommunicationTemplate\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:107;a:4:{s:1:\"a\";i:108;s:1:\"b\";s:28:\"Update:CommunicationTemplate\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:108;a:4:{s:1:\"a\";i:109;s:1:\"b\";s:28:\"Delete:CommunicationTemplate\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:109;a:4:{s:1:\"a\";i:110;s:1:\"b\";s:29:\"Restore:CommunicationTemplate\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:110;a:4:{s:1:\"a\";i:111;s:1:\"b\";s:33:\"ForceDelete:CommunicationTemplate\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:111;a:4:{s:1:\"a\";i:112;s:1:\"b\";s:36:\"ForceDeleteAny:CommunicationTemplate\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:112;a:4:{s:1:\"a\";i:113;s:1:\"b\";s:32:\"RestoreAny:CommunicationTemplate\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:113;a:4:{s:1:\"a\";i:114;s:1:\"b\";s:31:\"Replicate:CommunicationTemplate\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:114;a:4:{s:1:\"a\";i:115;s:1:\"b\";s:29:\"Reorder:CommunicationTemplate\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:115;a:4:{s:1:\"a\";i:116;s:1:\"b\";s:30:\"ViewAny:MonthlyClosingDiscount\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:116;a:4:{s:1:\"a\";i:117;s:1:\"b\";s:27:\"View:MonthlyClosingDiscount\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:117;a:4:{s:1:\"a\";i:118;s:1:\"b\";s:29:\"Create:MonthlyClosingDiscount\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:118;a:4:{s:1:\"a\";i:119;s:1:\"b\";s:29:\"Update:MonthlyClosingDiscount\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:119;a:4:{s:1:\"a\";i:120;s:1:\"b\";s:29:\"Delete:MonthlyClosingDiscount\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:120;a:4:{s:1:\"a\";i:121;s:1:\"b\";s:30:\"Restore:MonthlyClosingDiscount\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:121;a:4:{s:1:\"a\";i:122;s:1:\"b\";s:34:\"ForceDelete:MonthlyClosingDiscount\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:122;a:4:{s:1:\"a\";i:123;s:1:\"b\";s:37:\"ForceDeleteAny:MonthlyClosingDiscount\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:123;a:4:{s:1:\"a\";i:124;s:1:\"b\";s:33:\"RestoreAny:MonthlyClosingDiscount\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:124;a:4:{s:1:\"a\";i:125;s:1:\"b\";s:32:\"Replicate:MonthlyClosingDiscount\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:125;a:4:{s:1:\"a\";i:126;s:1:\"b\";s:30:\"Reorder:MonthlyClosingDiscount\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:1:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super_admin\";s:1:\"c\";s:3:\"web\";}}}',1764785828);

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `communication_templates` */

DROP TABLE IF EXISTS `communication_templates`;

CREATE TABLE `communication_templates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `communication_templates_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `communication_templates` */

insert  into `communication_templates`(`id`,`name`,`slug`,`content`,`created_at`,`updated_at`) values 
(1,'Modelo para consumo/medição (ex: gás, água, energia, fundo de reserva, etc.)','consumo','<p>? Prezados(as), bom dia.</p><p>Segue a medição de <strong>consumo de gás</strong> com o valor de rateio por apartamento.</p><p>Este valor será adicionado no boleto do condomínio de <strong>11/2025</strong>.</p>','2025-10-16 11:23:08','2025-10-16 13:52:16'),
(2,'Modelo para envio do rateio mensal','rateio-mensal','<p>? Prezados(as), bom dia.</p><p>Segue o rateio do condomínio referente a <strong>11/2025</strong>.</p><p>Os boletos digitais, com vencimento em <strong>14/11/2025</strong>, serão enviados individualmente.</p>','2025-10-16 11:23:08','2025-10-16 13:52:29'),
(3,'Modelo para envio de boleto','envio-boleto','<p>?️ Olá, boa tarde.</p><p>Segue o boleto do condomínio com vencimento em <strong>14/11/2025</strong>.</p><p>Favor confirmar o recebimento.</p>','2025-10-16 11:23:08','2025-10-16 13:52:39'),
(4,'Modelo para lembrete de vencimento (dia anterior)','lembrete-vencimento','<p>⏰ Prezados(as), bom dia.</p><p>Lembramos que o vencimento do condomínio <strong>é amanhã, dia 14/11/2025</strong>.</p>','2025-10-16 11:23:08','2025-10-16 13:54:28'),
(5,'Modelo para lembrete de vencimento (no dia)','vencimento-hoje','<p>? Importante!</p><p>Lembramos que o vencimento do condomínio <strong>é hoje, dia 14/11/2025</strong>.</p>','2025-10-16 11:23:08','2025-10-16 13:54:15'),
(6,'Modelo para confirmação de recebimento/pagamento','confirmacao-pagamento','<p>✅  Prezados(as), bom dia.</p><p>Todos os boletos referentes ao <strong>condomínio de 11/2025</strong> foram confirmados.</p><p>Segue anexo para conferência. <strong>Período: 15/10/2025 a 16/11/2025</strong></p><p>Atenciosamente,</p><p>Filipe Augusto Magalhães</p><p>Síndico - Ed. Angela</p>','2025-10-16 11:23:08','2025-10-16 13:54:05');

/*Table structure for table `condominiums` */

DROP TABLE IF EXISTS `condominiums`;

CREATE TABLE `condominiums` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `condominiums` */

insert  into `condominiums`(`id`,`name`,`document`,`logo`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'ED. ANGELA','341.723.780/0019-4',NULL,'2025-10-15 15:41:22','2025-10-15 15:42:51',NULL);

/*Table structure for table `consumption_charges` */

DROP TABLE IF EXISTS `consumption_charges`;

CREATE TABLE `consumption_charges` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `apartment_id` bigint unsigned NOT NULL,
  `expense_id` bigint unsigned NOT NULL,
  `service_class` enum('water','light','cooking_gas','not_apply') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_apply',
  `previous_reading` int NOT NULL DEFAULT '0',
  `current_reading` int NOT NULL DEFAULT '0',
  `consumption` int NOT NULL DEFAULT '0',
  `unit_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `consumption_charges_apartment_id_foreign` (`apartment_id`),
  KEY `consumption_charges_expense_id_foreign` (`expense_id`),
  CONSTRAINT `consumption_charges_apartment_id_foreign` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `consumption_charges_expense_id_foreign` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `consumption_charges` */

insert  into `consumption_charges`(`id`,`apartment_id`,`expense_id`,`service_class`,`previous_reading`,`current_reading`,`consumption`,`unit_cost`,`total_amount`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,9,'cooking_gas',146974,148748,1774,0.04,72.47,'2025-10-15 15:56:41','2025-10-15 16:30:34',NULL),
(2,2,9,'cooking_gas',254860,257204,2344,0.04,95.76,'2025-10-15 15:57:06','2025-10-15 16:30:34',NULL),
(3,3,9,'cooking_gas',129863,129863,0,0.04,0.00,'2025-10-15 15:57:31','2025-10-17 21:26:02',NULL),
(4,4,9,'cooking_gas',16695,17034,339,0.04,13.85,'2025-10-15 15:57:53','2025-10-15 16:30:34',NULL),
(5,5,9,'cooking_gas',126142,127825,1683,0.04,68.76,'2025-10-15 15:58:10','2025-10-15 16:30:34',NULL),
(6,6,9,'cooking_gas',111343,112450,1107,0.04,45.23,'2025-10-15 15:58:30','2025-10-15 16:30:34',NULL),
(7,7,9,'cooking_gas',440664,445492,4828,0.04,197.24,'2025-10-15 15:58:49','2025-10-15 16:30:34',NULL),
(8,2,10,'not_apply',0,0,0,0.00,150.00,'2025-10-15 16:14:57','2025-10-17 21:26:02',NULL),
(19,1,132,'cooking_gas',148748,150541,1793,0.03,54.56,'2025-11-15 13:14:33','2025-11-15 13:17:54',NULL),
(20,2,132,'cooking_gas',257204,260912,3708,0.03,112.84,'2025-11-15 13:14:55','2025-11-15 13:17:54',NULL),
(21,3,132,'cooking_gas',129863,129863,0,0.03,0.00,'2025-11-15 13:15:15','2025-11-15 14:02:38',NULL),
(22,4,132,'cooking_gas',17034,17712,678,0.03,20.63,'2025-11-15 13:15:30','2025-11-15 13:17:54',NULL),
(23,5,132,'cooking_gas',127825,130198,2373,0.03,72.21,'2025-11-15 13:15:45','2025-11-15 13:17:54',NULL),
(24,6,132,'cooking_gas',112450,114083,1633,0.03,49.69,'2025-11-15 13:15:59','2025-11-15 13:17:54',NULL),
(25,7,132,'cooking_gas',445492,451715,6223,0.03,189.37,'2025-11-15 13:16:21','2025-11-15 13:17:54',NULL),
(26,1,143,'cooking_gas',150541,151970,1429,0.04,57.60,'2025-12-02 18:24:10','2025-12-02 18:28:37',NULL),
(27,2,143,'cooking_gas',260912,264366,3454,0.04,139.23,'2025-12-02 18:24:23','2025-12-02 18:28:37',NULL),
(28,3,143,'cooking_gas',129863,129863,0,0.04,0.00,'2025-12-02 18:24:34','2025-12-02 18:28:37',NULL),
(29,4,143,'cooking_gas',17712,18096,384,0.04,15.48,'2025-12-02 18:24:50','2025-12-02 18:28:37',NULL),
(30,5,143,'cooking_gas',130198,132001,1803,0.04,72.68,'2025-12-02 18:25:02','2025-12-02 18:28:37',NULL),
(31,6,143,'cooking_gas',114083,115498,1415,0.04,57.04,'2025-12-02 18:25:14','2025-12-02 18:28:37',NULL),
(32,7,143,'cooking_gas',451715,455617,3902,0.04,157.29,'2025-12-02 18:25:25','2025-12-02 18:28:37',NULL);

/*Table structure for table `expenses` */

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `condominium_id` bigint unsigned NOT NULL,
  `type` enum('fixed','variable','reserve','emergency') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `service_class` enum('water','light','cooking_gas','not_apply') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_apply',
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `included_in_closing` tinyint(1) NOT NULL DEFAULT '0',
  `monthly_closing_id` bigint unsigned DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `paid_at` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_condominium_id_foreign` (`condominium_id`),
  KEY `expenses_monthly_closing_id_foreign` (`monthly_closing_id`),
  CONSTRAINT `expenses_condominium_id_foreign` FOREIGN KEY (`condominium_id`) REFERENCES `condominiums` (`id`) ON DELETE CASCADE,
  CONSTRAINT `expenses_monthly_closing_id_foreign` FOREIGN KEY (`monthly_closing_id`) REFERENCES `monthly_closings` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `expenses` */

insert  into `expenses`(`id`,`condominium_id`,`type`,`service_class`,`label`,`amount`,`due_date`,`included_in_closing`,`monthly_closing_id`,`is_paid`,`paid_at`,`payment_method`,`receipt_path`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'fixed','water','COPASA',55.85,'2025-10-10',1,29,1,'2025-10-17 22:13:23',NULL,NULL,'2025-10-15 15:44:26','2025-10-17 22:13:23',NULL),
(2,1,'fixed','light','CEMIG',226.14,'2025-10-10',1,29,1,'2025-10-17 22:13:25',NULL,NULL,'2025-10-15 15:50:33','2025-10-17 22:13:25',NULL),
(3,1,'fixed','not_apply','CONSERVAÇÃO E LIMPEZA',1351.00,'2025-10-10',1,29,1,'2025-10-17 22:13:27',NULL,NULL,'2025-10-15 15:50:55','2025-10-17 22:13:27',NULL),
(4,1,'fixed','not_apply','CONTABILIDADE',151.80,'2025-10-10',1,29,1,'2025-10-17 22:13:29',NULL,NULL,'2025-10-15 15:51:25','2025-10-17 22:13:29',NULL),
(5,1,'fixed','not_apply','CONTRATO MANUTENÇÃO ELEVADOR OTIS',436.34,'2025-10-10',1,29,1,'2025-10-17 22:13:31',NULL,NULL,'2025-10-15 15:51:43','2025-10-17 22:13:31',NULL),
(6,1,'reserve','not_apply','FUNDO DE RESERVA (R$ 50,00 POR APTO)',350.00,'2025-10-10',1,29,1,'2025-10-17 22:13:33',NULL,NULL,'2025-10-15 15:52:09','2025-10-17 22:13:33',NULL),
(7,1,'fixed','not_apply','DARF - MENSAL 25',20.50,'2025-10-10',1,29,1,'2025-10-17 22:13:36',NULL,NULL,'2025-10-15 15:52:34','2025-10-17 22:13:36',NULL),
(8,1,'fixed','not_apply','MATERIAL DE LIMPEZA',10.90,'2025-10-10',1,29,1,'2025-10-17 22:13:38',NULL,NULL,'2025-10-15 15:52:56','2025-10-17 22:13:38',NULL),
(9,1,'variable','cooking_gas','CONSUMO DE GÁS',493.31,'2025-10-10',1,29,1,'2025-10-17 22:13:41',NULL,NULL,'2025-10-15 15:54:02','2025-10-17 22:13:41',NULL),
(10,1,'variable','not_apply','ACORDO APTO 101',150.00,'2025-10-10',1,29,1,'2025-10-17 22:13:43',NULL,NULL,'2025-10-15 16:14:43','2025-10-17 22:13:43',NULL),
(123,1,'fixed','water','COPASA',57.45,'2025-11-15',1,35,1,'2025-11-15 13:06:00',NULL,NULL,'2025-11-15 13:06:08','2025-11-15 14:02:38',NULL),
(124,1,'fixed','light','CEMIG',226.21,'2025-11-15',1,35,1,'2025-11-15 13:41:17',NULL,NULL,'2025-11-15 13:06:36','2025-11-15 14:02:38',NULL),
(125,1,'fixed','not_apply','CONSERVAÇÃO E LIMPEZA',1351.00,'2025-11-15',1,35,1,'2025-11-15 13:41:19',NULL,NULL,'2025-11-15 13:07:21','2025-11-15 14:02:38',NULL),
(126,1,'fixed','not_apply','CONTABILIDADE',151.80,'2025-11-15',1,35,1,'2025-11-15 13:41:21',NULL,NULL,'2025-11-15 13:07:44','2025-11-15 14:02:38',NULL),
(127,1,'fixed','not_apply','MANUTENÇÃO DO ELEVADOR',436.34,'2025-11-15',1,35,1,'2025-11-15 13:41:23',NULL,NULL,'2025-11-15 13:08:12','2025-11-15 14:02:38',NULL),
(128,1,'reserve','not_apply','FUNDO DE RESERVA',350.00,'2025-11-15',1,35,1,'2025-11-15 13:41:25',NULL,NULL,'2025-11-15 13:08:35','2025-11-15 14:02:38',NULL),
(129,1,'fixed','not_apply','DARF MENSAL',20.50,'2025-11-15',1,35,1,'2025-11-15 13:41:27',NULL,NULL,'2025-11-15 13:08:54','2025-11-15 14:02:38',NULL),
(130,1,'fixed','not_apply','MATERIAL DE LIMPEZA',16.90,'2025-11-15',1,35,1,'2025-11-15 13:41:29',NULL,NULL,'2025-11-15 13:09:11','2025-11-15 14:02:38',NULL),
(131,1,'fixed','not_apply','SEGURO PREDIAL ANUAL - PARC. 01-06',276.15,'2025-11-15',1,35,1,'2025-11-15 13:41:31',NULL,NULL,'2025-11-15 13:09:49','2025-11-15 14:02:38',NULL),
(132,1,'variable','cooking_gas','CONSUMO DE GÁS',499.31,'2025-11-15',1,35,1,'2025-11-15 13:41:33',NULL,NULL,'2025-11-15 13:13:47','2025-11-15 14:02:38',NULL),
(133,1,'fixed','water','COPASA',47.45,'2025-12-15',1,36,0,NULL,NULL,NULL,'2025-12-02 18:18:00','2025-12-02 18:28:37',NULL),
(134,1,'fixed','light','CEMIG',194.21,'2025-12-15',1,36,0,NULL,NULL,NULL,'2025-12-02 18:18:00','2025-12-02 18:28:37',NULL),
(135,1,'fixed','not_apply','CONSERVAÇÃO E LIMPEZA',1351.00,'2025-12-15',1,36,0,NULL,NULL,NULL,'2025-12-02 18:18:00','2025-12-02 18:28:37',NULL),
(136,1,'fixed','not_apply','CONTABILIDADE',151.80,'2025-12-15',1,36,0,NULL,NULL,NULL,'2025-12-02 18:18:00','2025-12-02 18:28:37',NULL),
(137,1,'fixed','not_apply','MANUTENÇÃO DO ELEVADOR',436.34,'2025-12-15',1,36,0,NULL,NULL,NULL,'2025-12-02 18:18:00','2025-12-02 18:28:37',NULL),
(138,1,'reserve','not_apply','FUNDO DE RESERVA',350.00,'2025-12-15',1,36,0,NULL,NULL,NULL,'2025-12-02 18:18:00','2025-12-02 18:28:37',NULL),
(139,1,'fixed','not_apply','DARF MENSAL',20.50,'2025-12-15',1,36,0,NULL,NULL,NULL,'2025-12-02 18:18:00','2025-12-02 18:28:37',NULL),
(140,1,'fixed','not_apply','MATERIAL DE LIMPEZA',21.88,'2025-12-15',1,36,0,NULL,NULL,NULL,'2025-12-02 18:18:00','2025-12-02 18:28:37',NULL),
(141,1,'fixed','not_apply','SEGURO PREDIAL ANUAL - PARC. 02-06',276.15,'2025-12-15',1,36,0,NULL,NULL,NULL,'2025-12-02 18:18:00','2025-12-02 18:53:14',NULL),
(142,1,'fixed','not_apply','TROCA DE BATERIAS ELEVADOR OTIS - PARC. 01-05',361.35,'2025-12-15',1,36,0,NULL,NULL,NULL,'2025-12-02 18:20:29','2025-12-02 18:28:37',NULL),
(143,1,'variable','cooking_gas','CONSUMO DE GÁS',499.31,'2025-12-15',1,36,0,NULL,NULL,NULL,'2025-12-02 18:22:34','2025-12-02 18:28:37',NULL);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2025_01_01_000000_create_condominiums_table',1),
(5,'2025_01_01_000001_create_apartments_table',1),
(6,'2025_01_01_000002_create_monthly_closings_table',1),
(7,'2025_01_01_000003_create_expenses_table',1),
(8,'2025_01_01_000004_create_consumption_charges_table',1),
(9,'2025_01_01_000005_create_residents_table',1),
(10,'2025_01_01_000006_add_condominium_id_in_users_table',1),
(12,'2025_06_28_135714_create_addresses_table',1),
(14,'2025_06_28_144536_create_permission_tables',2),
(15,'2025_01_01_000008_create_monthly_closing_discounts_table',3),
(16,'2025_10_16_133532_create_communication_template_table',4),
(17,'2025_10_17_161303_add_payment_fields_to_expenses_table',5),
(18,'2025_01_01_000007_create_monthly_closing_apartments_table',6);

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values 
(1,'App\\Models\\User',1);

/*Table structure for table `monthly_closing_apartments` */

DROP TABLE IF EXISTS `monthly_closing_apartments`;

CREATE TABLE `monthly_closing_apartments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `monthly_closing_id` bigint unsigned NOT NULL,
  `apartment_id` bigint unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `amount_final` decimal(10,2) GENERATED ALWAYS AS ((`amount` - coalesce(`discount`,0))) STORED,
  `is_billet_generated` tinyint(1) NOT NULL DEFAULT '0',
  `billet_generated_at` timestamp NULL DEFAULT NULL,
  `billet_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billet_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `monthly_closing_apartments_unique` (`monthly_closing_id`,`apartment_id`),
  KEY `monthly_closing_apartments_apartment_id_foreign` (`apartment_id`),
  CONSTRAINT `monthly_closing_apartments_apartment_id_foreign` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `monthly_closing_apartments_monthly_closing_id_foreign` FOREIGN KEY (`monthly_closing_id`) REFERENCES `monthly_closings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `monthly_closing_apartments` */

insert  into `monthly_closing_apartments`(`id`,`monthly_closing_id`,`apartment_id`,`amount`,`discount`,`is_billet_generated`,`billet_generated_at`,`billet_number`,`billet_url`,`is_paid`,`paid_at`,`created_at`,`updated_at`) values 
(1,29,1,444.26,0.00,0,NULL,NULL,NULL,1,'2025-11-15 14:31:42','2025-10-17 21:26:02','2025-11-15 14:31:42'),
(2,29,2,617.55,0.00,0,NULL,NULL,NULL,1,'2025-11-15 13:05:11','2025-10-17 21:26:02','2025-11-15 13:05:11'),
(3,29,3,371.79,0.00,0,NULL,NULL,NULL,1,'2025-11-15 13:05:13','2025-10-17 21:26:02','2025-11-15 13:05:13'),
(4,29,4,385.64,0.00,0,NULL,NULL,NULL,1,'2025-11-15 13:05:15','2025-10-17 21:26:02','2025-11-15 13:05:15'),
(5,29,5,440.55,0.00,0,NULL,NULL,NULL,1,'2025-11-15 13:05:18','2025-10-17 21:26:02','2025-11-15 13:05:18'),
(6,29,6,417.02,0.00,0,NULL,NULL,NULL,1,'2025-11-15 13:05:20','2025-10-17 21:26:02','2025-11-15 13:05:20'),
(7,29,7,569.03,0.00,0,NULL,NULL,NULL,1,'2025-11-15 13:05:22','2025-10-17 21:26:02','2025-11-15 13:05:22'),
(32,35,1,466.90,0.00,0,NULL,NULL,NULL,1,'2025-12-02 18:17:25','2025-11-15 14:02:38','2025-12-02 18:17:25'),
(33,35,2,525.18,10.90,0,NULL,NULL,NULL,1,'2025-11-15 14:12:39','2025-11-15 14:02:38','2025-11-15 14:12:39'),
(34,35,3,412.34,0.00,0,NULL,NULL,NULL,1,'2025-11-15 14:12:37','2025-11-15 14:02:38','2025-11-15 14:12:37'),
(35,35,4,432.97,0.00,0,NULL,NULL,NULL,1,'2025-11-15 14:12:35','2025-11-15 14:02:38','2025-11-15 14:12:35'),
(36,35,5,484.55,39.45,0,NULL,NULL,NULL,1,'2025-11-15 14:12:34','2025-11-15 14:02:38','2025-11-15 14:12:34'),
(37,35,6,462.03,0.00,0,NULL,NULL,NULL,1,'2025-11-15 14:12:32','2025-11-15 14:02:38','2025-11-15 14:12:32'),
(38,35,7,601.71,0.00,0,NULL,NULL,NULL,1,'2025-11-15 14:12:30','2025-11-15 14:02:38','2025-11-15 14:12:30'),
(39,36,1,516.27,0.00,0,NULL,NULL,NULL,0,NULL,'2025-12-02 18:28:37','2025-12-02 18:28:37'),
(40,36,2,597.90,0.00,0,NULL,NULL,NULL,0,NULL,'2025-12-02 18:28:37','2025-12-02 18:28:37'),
(41,36,3,458.67,0.00,0,NULL,NULL,NULL,0,NULL,'2025-12-02 18:28:37','2025-12-02 18:28:37'),
(42,36,4,474.15,0.00,0,NULL,NULL,NULL,0,NULL,'2025-12-02 18:28:37','2025-12-02 18:28:37'),
(43,36,5,531.35,39.45,0,NULL,NULL,NULL,0,NULL,'2025-12-02 18:28:37','2025-12-02 18:28:37'),
(44,36,6,515.71,0.00,0,NULL,NULL,NULL,0,NULL,'2025-12-02 18:28:37','2025-12-02 18:28:37'),
(45,36,7,615.96,0.00,0,NULL,NULL,NULL,0,NULL,'2025-12-02 18:28:37','2025-12-02 18:28:37');

/*Table structure for table `monthly_closing_discounts` */

DROP TABLE IF EXISTS `monthly_closing_discounts`;

CREATE TABLE `monthly_closing_discounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `monthly_closing_id` bigint unsigned DEFAULT NULL,
  `apartment_id` bigint unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applied` tinyint(1) NOT NULL DEFAULT '0',
  `applied_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `monthly_closing_discounts_monthly_closing_id_foreign` (`monthly_closing_id`),
  KEY `monthly_closing_discounts_apartment_id_foreign` (`apartment_id`),
  KEY `monthly_closing_discounts_created_by_foreign` (`created_by`),
  CONSTRAINT `monthly_closing_discounts_apartment_id_foreign` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `monthly_closing_discounts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `monthly_closing_discounts_monthly_closing_id_foreign` FOREIGN KEY (`monthly_closing_id`) REFERENCES `monthly_closings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `monthly_closing_discounts` */

insert  into `monthly_closing_discounts`(`id`,`monthly_closing_id`,`apartment_id`,`amount`,`reason`,`applied`,`applied_at`,`created_by`,`created_at`,`updated_at`) values 
(1,35,5,39.45,'SEGURO PREDIAL ANUAL - PARC. 01-06',1,'2025-11-15 14:02:38',NULL,'2025-11-15 13:12:26','2025-11-15 14:08:44'),
(2,35,2,10.90,'MANUTENÇÃO DA TORNEIRA BANHEIRO DE SERVIÇO',1,'2025-11-15 14:02:38',NULL,'2025-11-15 13:13:03','2025-11-15 14:08:35'),
(3,36,5,39.45,'(2) DESCONTOS: 202 - SEGURO PREDIAL',1,'2025-12-02 18:28:37',NULL,'2025-12-02 18:21:09','2025-12-02 18:28:37');

/*Table structure for table `monthly_closings` */

DROP TABLE IF EXISTS `monthly_closings`;

CREATE TABLE `monthly_closings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `condominium_id` bigint unsigned NOT NULL,
  `reference` date NOT NULL,
  `total_fixed` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_variable` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_reserve` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_emergency` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `monthly_closings_condominium_id_foreign` (`condominium_id`),
  CONSTRAINT `monthly_closings_condominium_id_foreign` FOREIGN KEY (`condominium_id`) REFERENCES `condominiums` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `monthly_closings` */

insert  into `monthly_closings`(`id`,`condominium_id`,`reference`,`total_fixed`,`total_variable`,`total_reserve`,`total_emergency`,`total_amount`,`created_at`,`updated_at`,`deleted_at`) values 
(29,1,'2025-10-31',2252.53,643.31,350.00,0.00,3245.84,'2025-10-17 21:26:02','2025-10-17 21:26:02',NULL),
(30,1,'2025-11-30',2536.35,499.31,350.00,0.00,3385.66,'2025-11-15 13:17:54','2025-11-15 13:27:04','2025-11-15 13:27:04'),
(31,1,'2025-11-30',2536.35,499.31,350.00,0.00,3385.66,'2025-11-15 13:27:04','2025-11-15 13:39:11','2025-11-15 13:39:11'),
(34,1,'2025-11-30',2536.35,499.31,350.00,0.00,3385.66,'2025-11-15 13:39:11','2025-11-15 14:02:38','2025-11-15 14:02:38'),
(35,1,'2025-11-30',2536.35,499.31,350.00,0.00,3385.66,'2025-11-15 14:02:38','2025-11-15 14:02:38',NULL),
(36,1,'2025-12-31',2860.68,499.31,350.00,0.00,3709.99,'2025-12-02 18:28:37','2025-12-02 18:28:37',NULL);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
(1,'ViewAny:Role','web','2025-10-15 15:40:31','2025-10-15 15:40:31'),
(2,'View:Role','web','2025-10-15 15:40:31','2025-10-15 15:40:31'),
(3,'Create:Role','web','2025-10-15 15:40:31','2025-10-15 15:40:31'),
(4,'Update:Role','web','2025-10-15 15:40:31','2025-10-15 15:40:31'),
(5,'Delete:Role','web','2025-10-15 15:40:31','2025-10-15 15:40:31'),
(6,'Restore:Role','web','2025-10-15 15:40:31','2025-10-15 15:40:31'),
(7,'ForceDelete:Role','web','2025-10-15 15:40:31','2025-10-15 15:40:31'),
(8,'ForceDeleteAny:Role','web','2025-10-15 15:40:31','2025-10-15 15:40:31'),
(9,'RestoreAny:Role','web','2025-10-15 15:40:31','2025-10-15 15:40:31'),
(10,'Replicate:Role','web','2025-10-15 15:40:31','2025-10-15 15:40:31'),
(11,'Reorder:Role','web','2025-10-15 15:40:31','2025-10-15 15:40:31'),
(12,'ViewAny:Apartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(13,'View:Apartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(14,'Create:Apartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(15,'Update:Apartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(16,'Delete:Apartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(17,'Restore:Apartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(18,'ForceDelete:Apartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(19,'ForceDeleteAny:Apartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(20,'RestoreAny:Apartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(21,'Replicate:Apartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(22,'Reorder:Apartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(23,'ViewAny:Condominium','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(24,'View:Condominium','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(25,'Create:Condominium','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(26,'Update:Condominium','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(27,'Delete:Condominium','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(28,'Restore:Condominium','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(29,'ForceDelete:Condominium','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(30,'ForceDeleteAny:Condominium','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(31,'RestoreAny:Condominium','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(32,'Replicate:Condominium','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(33,'Reorder:Condominium','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(34,'ViewAny:ConsumptionCharge','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(35,'View:ConsumptionCharge','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(36,'Create:ConsumptionCharge','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(37,'Update:ConsumptionCharge','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(38,'Delete:ConsumptionCharge','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(39,'Restore:ConsumptionCharge','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(40,'ForceDelete:ConsumptionCharge','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(41,'ForceDeleteAny:ConsumptionCharge','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(42,'RestoreAny:ConsumptionCharge','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(43,'Replicate:ConsumptionCharge','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(44,'Reorder:ConsumptionCharge','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(45,'ViewAny:Expense','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(46,'View:Expense','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(47,'Create:Expense','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(48,'Update:Expense','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(49,'Delete:Expense','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(50,'Restore:Expense','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(51,'ForceDelete:Expense','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(52,'ForceDeleteAny:Expense','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(53,'RestoreAny:Expense','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(54,'Replicate:Expense','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(55,'Reorder:Expense','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(56,'ViewAny:MonthlyClosingApartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(57,'View:MonthlyClosingApartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(58,'Create:MonthlyClosingApartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(59,'Update:MonthlyClosingApartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(60,'Delete:MonthlyClosingApartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(61,'Restore:MonthlyClosingApartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(62,'ForceDelete:MonthlyClosingApartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(63,'ForceDeleteAny:MonthlyClosingApartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(64,'RestoreAny:MonthlyClosingApartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(65,'Replicate:MonthlyClosingApartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(66,'Reorder:MonthlyClosingApartment','web','2025-10-15 15:40:38','2025-10-15 15:40:38'),
(67,'ViewAny:MonthlyClosing','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(68,'View:MonthlyClosing','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(69,'Create:MonthlyClosing','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(70,'Update:MonthlyClosing','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(71,'Delete:MonthlyClosing','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(72,'Restore:MonthlyClosing','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(73,'ForceDelete:MonthlyClosing','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(74,'ForceDeleteAny:MonthlyClosing','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(75,'RestoreAny:MonthlyClosing','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(76,'Replicate:MonthlyClosing','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(77,'Reorder:MonthlyClosing','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(78,'ViewAny:Resident','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(79,'View:Resident','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(80,'Create:Resident','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(81,'Update:Resident','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(82,'Delete:Resident','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(83,'Restore:Resident','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(84,'ForceDelete:Resident','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(85,'ForceDeleteAny:Resident','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(86,'RestoreAny:Resident','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(87,'Replicate:Resident','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(88,'Reorder:Resident','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(89,'ViewAny:User','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(90,'View:User','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(91,'Create:User','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(92,'Update:User','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(93,'Delete:User','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(94,'Restore:User','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(95,'ForceDelete:User','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(96,'ForceDeleteAny:User','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(97,'RestoreAny:User','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(98,'Replicate:User','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(99,'Reorder:User','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(100,'View:MonthlyClosingsOverview','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(101,'View:MonthlyClosingsChart','web','2025-10-15 15:40:39','2025-10-15 15:40:39'),
(102,'View:PieChartWidget','web','2025-10-15 15:40:40','2025-10-15 15:40:40'),
(103,'View:ExpensesOverview','web','2025-10-15 15:40:40','2025-10-15 15:40:40'),
(104,'View:ApartmentsOverview','web','2025-10-15 15:40:40','2025-10-15 15:40:40'),
(105,'ViewAny:CommunicationTemplate','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(106,'View:CommunicationTemplate','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(107,'Create:CommunicationTemplate','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(108,'Update:CommunicationTemplate','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(109,'Delete:CommunicationTemplate','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(110,'Restore:CommunicationTemplate','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(111,'ForceDelete:CommunicationTemplate','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(112,'ForceDeleteAny:CommunicationTemplate','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(113,'RestoreAny:CommunicationTemplate','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(114,'Replicate:CommunicationTemplate','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(115,'Reorder:CommunicationTemplate','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(116,'ViewAny:MonthlyClosingDiscount','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(117,'View:MonthlyClosingDiscount','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(118,'Create:MonthlyClosingDiscount','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(119,'Update:MonthlyClosingDiscount','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(120,'Delete:MonthlyClosingDiscount','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(121,'Restore:MonthlyClosingDiscount','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(122,'ForceDelete:MonthlyClosingDiscount','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(123,'ForceDeleteAny:MonthlyClosingDiscount','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(124,'RestoreAny:MonthlyClosingDiscount','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(125,'Replicate:MonthlyClosingDiscount','web','2025-10-16 15:24:39','2025-10-16 15:24:39'),
(126,'Reorder:MonthlyClosingDiscount','web','2025-10-16 15:24:39','2025-10-16 15:24:39');

/*Table structure for table `residents` */

DROP TABLE IF EXISTS `residents`;

CREATE TABLE `residents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `apartment_id` bigint unsigned NOT NULL,
  `is_responsible` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `residents_user_id_apartment_id_unique` (`user_id`,`apartment_id`),
  KEY `residents_apartment_id_foreign` (`apartment_id`),
  CONSTRAINT `residents_apartment_id_foreign` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `residents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `residents` */

insert  into `residents`(`id`,`user_id`,`apartment_id`,`is_responsible`,`created_at`,`updated_at`) values 
(1,2,1,1,'2025-10-15 15:47:27','2025-10-17 20:43:55'),
(2,3,2,1,'2025-10-15 15:47:41','2025-10-15 15:47:41'),
(3,4,3,1,'2025-10-15 15:47:56','2025-10-15 15:48:17'),
(4,5,4,1,'2025-10-15 15:49:14','2025-10-15 15:49:14'),
(5,8,5,1,'2025-10-15 15:49:20','2025-10-15 15:49:20'),
(6,6,6,1,'2025-10-15 15:49:26','2025-10-15 15:49:26'),
(7,7,7,1,'2025-10-15 15:49:33','2025-10-15 15:49:33');

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`) values 
(1,1),
(2,1),
(3,1),
(4,1),
(5,1),
(6,1),
(7,1),
(8,1),
(9,1),
(10,1),
(11,1),
(12,1),
(13,1),
(14,1),
(15,1),
(16,1),
(17,1),
(18,1),
(19,1),
(20,1),
(21,1),
(22,1),
(23,1),
(24,1),
(25,1),
(26,1),
(27,1),
(28,1),
(29,1),
(30,1),
(31,1),
(32,1),
(33,1),
(34,1),
(35,1),
(36,1),
(37,1),
(38,1),
(39,1),
(40,1),
(41,1),
(42,1),
(43,1),
(44,1),
(45,1),
(46,1),
(47,1),
(48,1),
(49,1),
(50,1),
(51,1),
(52,1),
(53,1),
(54,1),
(55,1),
(56,1),
(57,1),
(58,1),
(59,1),
(60,1),
(61,1),
(62,1),
(63,1),
(64,1),
(65,1),
(66,1),
(67,1),
(68,1),
(69,1),
(70,1),
(71,1),
(72,1),
(73,1),
(74,1),
(75,1),
(76,1),
(77,1),
(78,1),
(79,1),
(80,1),
(81,1),
(82,1),
(83,1),
(84,1),
(85,1),
(86,1),
(87,1),
(88,1),
(89,1),
(90,1),
(91,1),
(92,1),
(93,1),
(94,1),
(95,1),
(96,1),
(97,1),
(98,1),
(99,1),
(100,1),
(101,1),
(102,1),
(103,1),
(104,1),
(105,1),
(106,1),
(107,1),
(108,1),
(109,1),
(110,1),
(111,1),
(112,1),
(113,1),
(114,1),
(115,1),
(116,1),
(117,1),
(118,1),
(119,1),
(120,1),
(121,1),
(122,1),
(123,1),
(124,1),
(125,1),
(126,1);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
(1,'super_admin','web','2025-10-15 15:40:31','2025-10-15 15:40:31');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('RWxW19UdT8xj5l4CPqyHD9iatStZW8vYW74dNJNr',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo4OntzOjY6Il90b2tlbiI7czo0MDoiWlROUktFTjc5MUxTaEdaclRCZGprOVBEOTJ4QzB0cWk5emN0clpMSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9hZG1pbi9tb250aGx5LWNsb3NpbmctYXBhcnRtZW50cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkeEtHLk5ZcFRFR2N0VjUwa0lHRU1NZWs5dEEvRkJSMm1MVDcyVGRVV0d0c0JWQVNtWFdDLmkiO3M6NjoidGFibGVzIjthOjk6e3M6NDA6ImYyM2M2YTY4Njk3OGY4ZTBiYzM0YjdlM2JjYTdlYjU3X2NvbHVtbnMiO2E6NDp7aTowO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjI0OiJtb250aGx5Q2xvc2luZy5yZWZlcmVuY2UiO3M6NToibGFiZWwiO3M6MTE6IlJlZmVyw6puY2lhIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoyMDoiYXBhcnRtZW50LmlkZW50aWZpZXIiO3M6NToibGFiZWwiO3M6NDoiQXB0byI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjI7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MjM6ImFwYXJ0bWVudC5yZXNpZGVudF9uYW1lIjtzOjU6ImxhYmVsIjtzOjc6Ik1vcmFkb3IiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjY6ImFtb3VudCI7czo1OiJsYWJlbCI7czoxMDoiVmFsb3IgKFIkKSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO319czo0MDoiNGI1MTQwOWM2ZTlkMmNiMjNlNjZkYWY3ZGViY2Y5NzhfY29sdW1ucyI7YTo0OntpOjA7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NToibGFiZWwiO3M6NToibGFiZWwiO3M6MTE6IkRlc2NyacOnw6NvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo2OiJzdGF0dXMiO3M6NToibGFiZWwiO3M6NjoiU3RhdHVzIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo4OiJkdWVfZGF0ZSI7czo1OiJsYWJlbCI7czoxMDoiVmVuY2ltZW50byI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjM7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NjoiYW1vdW50IjtzOjU6ImxhYmVsIjtzOjEwOiJWYWxvciAoUiQpIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fX1zOjQwOiI1YzBhNjkxOTIzNGMwZDk0YzNhMzczOGQxNWNkZjk2Ml9jb2x1bW5zIjthOjEwOntpOjA7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6OToicmVmZXJlbmNlIjtzOjU6ImxhYmVsIjtzOjExOiJSZWZlcsOqbmNpYSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTE6InRvdGFsX2ZpeGVkIjtzOjU6ImxhYmVsIjtzOjEwOiJUb3RhbCBGaXhvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxNDoidG90YWxfdmFyaWFibGUiO3M6NToibGFiZWwiO3M6MTU6IlRvdGFsIFZhcmnDoXZlbCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjM7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTM6InRvdGFsX3Jlc2VydmUiO3M6NToibGFiZWwiO3M6NzoiUmVzZXJ2YSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTU6InRvdGFsX2VtZXJnZW5jeSI7czo1OiJsYWJlbCI7czoxMToiRW1lcmfDqm5jaWEiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo1O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEyOiJ0b3RhbF9hbW91bnQiO3M6NToibGFiZWwiO3M6MTE6IlRvdGFsIEdlcmFsIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoiY3JlYXRlZF9hdCI7czo1OiJsYWJlbCI7czo5OiJDcmlhZG8gZW0iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO31pOjc7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTA6IkNyZWF0ZWQgYXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO31pOjg7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6InVwZGF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTA6IlVwZGF0ZWQgYXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO31pOjk7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6ImRlbGV0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTA6IkRlbGV0ZWQgYXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO319czo0MDoiM2FmODNkZDcwMThjNzU5YTVkMzBlMmQ5MGU0NjNjZjdfY29sdW1ucyI7YTo4OntpOjA7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MjQ6Im1vbnRobHlDbG9zaW5nLnJlZmVyZW5jZSI7czo1OiJsYWJlbCI7czoxOToiTcOqcyBkZSByZWZlcsOqbmNpYSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MjA6ImFwYXJ0bWVudC5pZGVudGlmaWVyIjtzOjU6ImxhYmVsIjtzOjExOiJBcGFydGFtZW50byI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjI7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NjoiYW1vdW50IjtzOjU6ImxhYmVsIjtzOjU6IlRvdGFsIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo4OiJkaXNjb3VudCI7czo1OiJsYWJlbCI7czo4OiJEZXNjb250byI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTI6ImFtb3VudF9maW5hbCI7czo1OiJsYWJlbCI7czoxMToiVmFsb3IgRmluYWwiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo1O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjc6ImlzX3BhaWQiO3M6NToibGFiZWwiO3M6NToiUGFnbz8iO3M6ODoiaXNIaWRkZW4iO2I6MTtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo2O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjU6ImxhYmVsIjtzOjk6IkNyaWFkbyBlbSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fWk6NzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoidXBkYXRlZF9hdCI7czo1OiJsYWJlbCI7czoxMzoiQXR1YWxpemFkbyBlbSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fX1zOjQwOiJjM2ZmNDY3ZDczNTgyYzVkZWE5ZDQ4N2VjMjk4MTU0OF9jb2x1bW5zIjthOjEyOntpOjA7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTY6ImNvbmRvbWluaXVtLm5hbWUiO3M6NToibGFiZWwiO3M6MTE6IkNvbmRvbcOtbmlvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo0OiJ0eXBlIjtzOjU6ImxhYmVsIjtzOjQ6IlRpcG8iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToyO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEzOiJzZXJ2aWNlX2NsYXNzIjtzOjU6ImxhYmVsIjtzOjY6IkNsYXNzZSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjM7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NToibGFiZWwiO3M6NToibGFiZWwiO3M6NDoiTm9tZSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NjoiYW1vdW50IjtzOjU6ImxhYmVsIjtzOjU6IlZhbG9yIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo4OiJkdWVfZGF0ZSI7czo1OiJsYWJlbCI7czoxNDoiRHQuIHZlbmNpbWVudG8iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo2O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjY6InN0YXR1cyI7czo1OiJsYWJlbCI7czo2OiJTdGF0dXMiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo3O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjE5OiJpbmNsdWRlZF9pbl9jbG9zaW5nIjtzOjU6ImxhYmVsIjtzOjc6IkZlY2hhZG8iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO31pOjg7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MjQ6Im1vbnRobHlDbG9zaW5nLnJlZmVyZW5jZSI7czo1OiJsYWJlbCI7czoxMToicmVmZXLDqm5jaWEiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO31pOjk7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTA6IkNyZWF0ZWQgYXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO31pOjEwO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjU6ImxhYmVsIjtzOjEwOiJVcGRhdGVkIGF0IjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MDtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MTtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO2I6MTt9aToxMTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoiZGVsZXRlZF9hdCI7czo1OiJsYWJlbCI7czoxMDoiRGVsZXRlZCBhdCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fX1zOjQwOiI1ZGMwNjk1MjI2MWYyMGU4NzZkMTczZjU2ODdhOWJjMl9jb2x1bW5zIjthOjk6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoyNDoibW9udGhseUNsb3NpbmcucmVmZXJlbmNlIjtzOjU6ImxhYmVsIjtzOjExOiJSZWZlcsOqbmNpYSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MjA6ImFwYXJ0bWVudC5pZGVudGlmaWVyIjtzOjU6ImxhYmVsIjtzOjExOiJBcGFydGFtZW50byI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjI7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NjoiYW1vdW50IjtzOjU6ImxhYmVsIjtzOjU6IlZhbG9yIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo2OiJyZWFzb24iO3M6NToibGFiZWwiO3M6NjoiTW90aXZvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo3OiJhcHBsaWVkIjtzOjU6ImxhYmVsIjtzOjg6IkFwbGljYWRvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoiYXBwbGllZF9hdCI7czo1OiJsYWJlbCI7czoxMToiQXBsaWNhZG8gZW0iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo2O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJjcmVhdGVkX2J5IjtzOjU6ImxhYmVsIjtzOjEwOiJDcmVhZG8gcG9yIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MDtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MTtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO2I6MTt9aTo3O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjU6ImxhYmVsIjtzOjk6IkNyZWFkbyBlbSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fWk6ODthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoidXBkYXRlZF9hdCI7czo1OiJsYWJlbCI7czoxMzoiQXR1YWxpemFkbyBlbSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fX1zOjQwOiIxNGQ0N2RkN2VlNGUwNGE3ZThmMmVmMWM4NGE5ZDI4Nl9jb2x1bW5zIjthOjExOntpOjA7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MjA6ImFwYXJ0bWVudC5pZGVudGlmaWVyIjtzOjU6ImxhYmVsIjtzOjExOiJBcGFydGFtZW50byI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTM6ImV4cGVuc2UubGFiZWwiO3M6NToibGFiZWwiO3M6MTc6IkRlc3Blc2EgdmFyacOhdmVsIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMzoic2VydmljZV9jbGFzcyI7czo1OiJsYWJlbCI7czoxODoiQ2xhc3NlIGRlIHNlcnZpw6dvIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MzthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxNjoicHJldmlvdXNfcmVhZGluZyI7czo1OiJsYWJlbCI7czoxNjoiTGVpdHVyYSBhbnRlcmlvciI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTU6ImN1cnJlbnRfcmVhZGluZyI7czo1OiJsYWJlbCI7czoxMzoiTGVpdHVyYSBhdHVhbCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjU7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTE6ImNvbnN1bXB0aW9uIjtzOjU6ImxhYmVsIjtzOjc6IkNvbnN1bW8iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo2O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjk6InVuaXRfY29zdCI7czo1OiJsYWJlbCI7czo1OiJDdXN0byI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjc7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTI6InRvdGFsX2Ftb3VudCI7czo1OiJsYWJlbCI7czoxMjoiVG90YWwgYW1vdW50IjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6ODthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoiY3JlYXRlZF9hdCI7czo1OiJsYWJlbCI7czo5OiJDcmlhZG8gZW0iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO31pOjk7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6InVwZGF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTM6IkF0dWFsaXphZG8gZW0iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjowO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjoxO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7YjoxO31pOjEwO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJkZWxldGVkX2F0IjtzOjU6ImxhYmVsIjtzOjExOiJEZWxldGFkbyBlbSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjA7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjE7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtiOjE7fX1zOjQxOiIzYWY4M2RkNzAxOGM3NTlhNWQzMGUyZDkwZTQ2M2NmN19wZXJfcGFnZSI7czoyOiIyNSI7czo0MToiMTRkNDdkZDdlZTRlMDRhN2U4ZjJlZjFjODRhOWQyODZfcGVyX3BhZ2UiO3M6MjoiMjUiO31zOjg6ImZpbGFtZW50IjthOjA6e319',1764701684);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `condominium_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `document` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_condominium_id_foreign` (`condominium_id`),
  CONSTRAINT `users_condominium_id_foreign` FOREIGN KEY (`condominium_id`) REFERENCES `condominiums` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`condominium_id`,`name`,`email`,`email_verified_at`,`document`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,NULL,'Filipe Augusto','filipeaugustomagalhaes@gmail.com',NULL,'99988877766','$2y$12$xKG.NYpTEGctV50kIGEMMek9tA/FBR2mLT72TdUWGtsBVASmXWC.i',NULL,'2025-10-15 15:37:12','2025-10-15 15:37:12'),
(2,1,'DANIELLE MARQUES GUALBERTO','apto02@gmail.com',NULL,'99988877766','$2y$12$LBKfj.WU.DDmzwvkpaifqOMRN5NGXdYk.33.zp9yd90GvGhPvjGEC',NULL,'2025-10-15 15:45:17','2025-10-15 15:45:17'),
(3,1,'ÁRLISON DE OLIVEIRA NEVES','apto101@gmail.com',NULL,'99988877766','$2y$12$P2g29o316tNa3KxYSafxZ.//weftxMOD.52SDcaA2w6OxZbHWkPJ6',NULL,'2025-10-15 15:45:36','2025-10-15 15:45:36'),
(4,1,'DENISE DOS REIS','apto102@gmail.com',NULL,'99988877766','$2y$12$3ftVDa7GpKDZKRvpxar37.CRDibsMPbr75OG3.uBsoRWq4GKeT8mW',NULL,'2025-10-15 15:46:00','2025-10-15 15:46:00'),
(5,1,'LUIZA MARIA CARNEIRO','apto201@gmail.com',NULL,'99988877766','$2y$12$DkuzqEB1jYbJ60rZjOp8oOFRMrpLafVcv7h6lPmVysY7lflFB65Di',NULL,'2025-10-15 15:46:20','2025-10-15 15:46:20'),
(6,1,'ALEXANDRE DE CASTRO D MATOS','apto301@gmail.com',NULL,'99988877766','$2y$12$hfGmmKl45RMsXFhoSlDYfeFOM8Wo0uVkc2PwmLUBgr4IukWik6t2y',NULL,'2025-10-15 15:46:41','2025-10-15 15:46:41'),
(7,1,'CLEDSON GUILHERME VIEIRA','apto302@gmail.com',NULL,'99988877766','$2y$12$kXoz76WLBn7W0.dVLTXFZ.Koy.07ewJEHLaYD3aqdmz/diG74dZo2',NULL,'2025-10-15 15:46:58','2025-10-15 15:46:58'),
(8,1,'BIANCA MORI','apto202@gmail.com',NULL,'99988877766','$2y$12$PQG41JiKDK3GPPCsJ46ufOGMfxhY1/Xu/iSSU2qDspPRoVe1m9k8m',NULL,'2025-10-15 15:49:04','2025-10-15 15:49:04');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
