-- -------------------------------------------------------------
-- TablePlus 4.0.2(374)
--
-- https://tableplus.com/
--
-- Database: pesautomation
-- Generation Time: 2021-08-18 17:29:58.5060
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `admin_guid` char(36) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_guid` char(36) DEFAULT NULL,
  `name_tr` varchar(255) DEFAULT NULL,
  `queue` int DEFAULT '0',
  `related_to` char(36) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contact_guid` char(36) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `industries`;
CREATE TABLE `industries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `industry_guid` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `product_file_categories`;
CREATE TABLE `product_file_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `products_files_category_guid` char(36) DEFAULT NULL,
  `product_guid` char(36) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `product_files`;
CREATE TABLE `product_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_file_guid` char(36) DEFAULT NULL,
  `products_files_category_guid` char(36) DEFAULT NULL,
  `product_guid` char(36) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `product_sliders`;
CREATE TABLE `product_sliders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `products_slider_guid` char(36) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `product_guid` char(36) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_guid` char(36) DEFAULT NULL,
  `category_guid` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `general_detail` longtext,
  `accessories` longtext,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `products_industries`;
CREATE TABLE `products_industries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_industry_guid` char(36) DEFAULT NULL,
  `product_guid` char(36) DEFAULT NULL,
  `industry_guid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `references`;
CREATE TABLE `references` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference_guid` char(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `social_media`;
CREATE TABLE `social_media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `queue` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `themes`;
CREATE TABLE `themes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dark1` varchar(255) NOT NULL,
  `dark2` varchar(255) NOT NULL,
  `dark3` varchar(255) NOT NULL,
  `dark4` varchar(255) NOT NULL,
  `dark5` varchar(255) NOT NULL,
  `light1` varchar(255) NOT NULL,
  `light2` varchar(255) NOT NULL,
  `light3` varchar(255) NOT NULL,
  `light4` varchar(255) NOT NULL,
  `light5` varchar(255) NOT NULL,
  `status` smallint NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

INSERT INTO `admins` (`id`, `admin_guid`, `fullname`, `email`, `password`, `remember_token`, `created_at`) VALUES
(1, '02cdf10e-f057-11eb-9a03-0242ac130003', 'Okay BEYDANOL', 'okay@appricot.com.tr', '$2y$12$OUiDVhJmCQTYeNmUCxz.rOwondFif8/uhr2D9BizvDmvjEC6T4zbi', 'mdT8GW1vkDQxJVJgChD3QbwjNZd5prfvK2zR1apZCI4ILclJDhYgdUeRO5kc', '2021-07-29 10:28:46');

INSERT INTO `categories` (`id`, `category_guid`, `name_tr`, `queue`, `related_to`, `created_at`, `updated_at`, `deleted_at`) VALUES
(59, 'f3f85281-b464-4ddd-be45-c51e018a32eb', 'deneme 2', 2, NULL, '2021-08-18 13:35:15', '2021-08-18 13:35:23', NULL),
(60, '93ae12ed-4020-475c-8be5-1a225895fe38', 'deneme 3', 1, 'f3f85281-b464-4ddd-be45-c51e018a32eb', '2021-08-18 13:35:19', '2021-08-18 13:35:23', NULL);

INSERT INTO `industries` (`id`, `industry_guid`, `name`, `slug`, `title`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, '0d823d5d-eb24-4d36-8f99-a82c0e983bbf', 'Cam', NULL, 'ges, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.ges, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.ges, and more recently with deskt', 'ges, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.ges, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.ges, and more recently with deskt', '2021-08-18 11:00:50', '2021-08-18 11:02:49', NULL);

INSERT INTO `product_file_categories` (`id`, `products_files_category_guid`, `product_guid`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(25, '8cdfab72-d49a-4554-ac1d-ee3bd3592581', 'f3f85281-b464-4aaa-be45-c51e018a32eb', 'deneme 1', '2021-08-18 10:57:23', '2021-08-18 10:57:23', NULL),
(26, '0bfd7b95-e698-4689-b96a-38ee9e190f38', 'f3f85281-b464-4aaa-be45-c51e018a32eb', 'deneme 2', '2021-08-18 10:57:28', '2021-08-18 10:57:28', NULL);

INSERT INTO `product_files` (`id`, `product_file_guid`, `products_files_category_guid`, `product_guid`, `title`, `file`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20, '73333a76-5f86-4d6e-8e91-ecb2dea422e5', '8cdfab72-d49a-4554-ac1d-ee3bd3592581', 'f3f85281-b464-4aaa-be45-c51e018a32eb', 'imza dosyası', 'backend/assets/files/73333a76-5f86-4d6e-8e91-ecb2dea422e5imza-dosyasi.png', 'imza-dosyasi', '2021-08-18 10:58:01', '2021-08-18 10:58:01', NULL),
(21, 'dbfd800a-09e1-4af7-8275-819ed578ab6a', '0bfd7b95-e698-4689-b96a-38ee9e190f38', 'f3f85281-b464-4aaa-be45-c51e018a32eb', 'Okay Bey', 'backend/assets/files/dbfd800a-09e1-4af7-8275-819ed578ab6aokay-bey.jpeg', 'okay-bey', '2021-08-18 10:58:27', '2021-08-18 10:58:27', NULL);

INSERT INTO `product_sliders` (`id`, `products_slider_guid`, `product_guid`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'd1955b16-0101-435a-9d50-4725aa441fa3', 'f3f85281-b464-4aaa-be45-c51e018a32eb', 'backend/assets/slider/d1955b16-0101-435a-9d50-4725aa441fa3.jpeg', '2021-08-18 10:58:37', '2021-08-18 10:58:37', NULL),
(10, 'a6a395e3-543d-43c6-9c17-1c39be983228', 'f3f85281-b464-4aaa-be45-c51e018a32eb', 'backend/assets/slider/a6a395e3-543d-43c6-9c17-1c39be983228.jpeg', '2021-08-18 10:58:37', '2021-08-18 10:58:37', NULL);

INSERT INTO `products` (`id`, `product_guid`, `category_guid`, `name`, `slug`, `general_detail`, `accessories`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'f3f85281-b464-4aaa-be45-c51e018a32eb', 'f3f85281-b464-4ddd-be45-c51e018a32eb', 'A ürünü', 'a-urunu', '<p>asdsadasd\r\n\r\n                    </p>', 'asdasdas', '2021-08-18 13:51:35', '2021-08-18 10:56:02', NULL);

INSERT INTO `products_industries` (`id`, `product_industry_guid`, `product_guid`, `industry_guid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(119, 'f93df836-d460-4443-920d-d7ca2578f122', '094acab2-e591-455c-9000-5f3be094de2s', '094acab2-e591-dss3-9000-5f3be094def4', '2021-08-18 05:56:24', '2021-08-18 05:56:24', NULL),
(120, '9fab5b1a-6152-4573-8407-fee7c2eeedb4', '094acab2-e591-455c-9000-5f3be094de2s', '094acab2-e591-455c-9000-5f3be094def4', '2021-08-18 05:56:24', '2021-08-18 05:56:24', NULL),
(127, '7d80e16a-7f28-47d9-b680-3704b3b0b57f', '094acab2-e591-455d-9000-5f3be094de2s', '094acab2-e591-dss3-9000-5f3be094def4', '2021-08-18 07:28:01', '2021-08-18 07:28:01', NULL),
(128, 'd077ed6c-01b6-4f1b-aa97-9b81b7257106', '094acab2-e591-455d-9000-5f3be094de2s', '094acab2-e591-455c-9000-5f3be094def4', '2021-08-18 07:28:01', '2021-08-18 07:28:01', NULL);

INSERT INTO `references` (`id`, `reference_guid`, `title`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'e41906a3-d71c-4a89-ad00-b175e33b6f3e', 'Piyatek', 'backend/assets/media/brands/e41906a3-d71c-4a89-ad00-b175e33b6f3epiyatek.png', '2021-08-18 11:03:42', '2021-08-18 11:03:48', NULL);

INSERT INTO `settings` (`id`, `title`, `description`, `url`, `keywords`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Site Title', 'Website description and some little information about it', 'https://pesautomation.com', 'key, words, website, web', '2021-08-16 11:48:56', '2021-08-17 05:15:25', NULL);

INSERT INTO `social_media` (`id`, `name`, `link`, `status`, `icon`, `queue`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Facebook', 'https://facebook.com/example', '0', NULL, 1, NULL, '2021-08-18 11:04:00', NULL),
(2, 'Instagram', 'https://instagram.com/example', '1', NULL, 2, NULL, '2021-08-17 13:25:46', NULL),
(3, 'Linkedin', 'https://linkedin.com/example', '1', NULL, 3, NULL, '2021-08-17 13:25:47', NULL),
(4, 'Youtube', 'https://youtube.com/example', '1', NULL, 4, NULL, '2021-08-17 13:23:17', NULL),
(5, 'Twitter', 'https://twitter.com/example', '0', NULL, 5, NULL, '2021-08-17 13:28:16', NULL);

INSERT INTO `themes` (`id`, `dark1`, `dark2`, `dark3`, `dark4`, `dark5`, `light1`, `light2`, `light3`, `light4`, `light5`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'backend/assets/css/themes/layout/header/base/dark.css', 'backend/assets/css/themes/layout/header/menu/dark.css', 'backend/assets/css/themes/layout/brand/dark.css', 'backend/assets/css/themes/layout/aside/dark.css', 'backend/assets/media/logos/logo-dark.png', 'backend/assets/css/themes/layout/header/base/light.css', 'backend/assets/css/themes/layout/header/menu/light.css', 'backend/assets/css/themes/layout/brand/light.css', 'backend/assets/css/themes/layout/aside/light.css', 'backend/assets/media/logos/logo-light.png', 1, '2021-08-14 19:34:23', '2021-08-17 14:23:08', NULL);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;