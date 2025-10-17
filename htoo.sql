-- MySQL dump 10.13  Distrib 9.0.1, for macos14 (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	9.0.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('sum','sub') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sum',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'ဝင်ငွေ','sum',NULL,'2025-10-16 20:39:31','2025-10-16 20:39:31'),(2,'ပစ္စည်းဝယ်','sub',NULL,'2025-10-16 20:39:31','2025-10-16 20:39:31'),(3,'ကယ်ရီခ','sub',NULL,'2025-10-16 20:39:31','2025-10-16 20:39:31'),(4,'လုပ်အားခ','sub',NULL,'2025-10-16 20:39:31','2025-10-16 20:39:31'),(5,'သုံးငွေ','sub',NULL,'2025-10-16 20:39:31','2025-10-16 20:39:31'),(6,'မိန်းမအပ်ငွေ','sub',NULL,'2025-10-16 20:39:31','2025-10-16 20:39:31'),(7,'ဆီဖိုး','sub',NULL,'2025-10-16 20:39:31','2025-10-16 20:39:31');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ch_favorites`
--

DROP TABLE IF EXISTS `ch_favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ch_favorites` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `favorite_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ch_favorites`
--

LOCK TABLES `ch_favorites` WRITE;
/*!40000 ALTER TABLE `ch_favorites` DISABLE KEYS */;
/*!40000 ALTER TABLE `ch_favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ch_messages`
--

DROP TABLE IF EXISTS `ch_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ch_messages` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint NOT NULL,
  `to_id` bigint NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ch_messages`
--

LOCK TABLES `ch_messages` WRITE;
/*!40000 ALTER TABLE `ch_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `ch_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_05_20_074339_create_vouchers_table',1),(5,'2025_05_20_074929_create_sales_table',1),(6,'2025_06_25_150808_create_categories_table',1),(7,'2025_06_26_085238_create_records_table',1),(8,'2025_09_28_140226_create_cars_table',1),(9,'2025_10_16_999999_add_active_status_to_users',1),(10,'2025_10_16_999999_add_avatar_to_users',1),(11,'2025_10_16_999999_add_dark_mode_to_users',1),(12,'2025_10_16_999999_add_messenger_color_to_users',1),(13,'2025_10_16_999999_create_chatify_favorites_table',1),(14,'2025_10_16_999999_create_chatify_messages_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `records`
--

DROP TABLE IF EXISTS `records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `records` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `sub_total` int NOT NULL,
  `discount` int NOT NULL DEFAULT '0',
  `grand_total` int NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=435 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `records`
--

LOCK TABLES `records` WRITE;
/*!40000 ALTER TABLE `records` DISABLE KEYS */;
INSERT INTO `records` VALUES (1,'2024-12-01','City Mart စျေးဝယ် (ကိုရဲသွေး ကလေးမွေး)',5,95000,0,95000,'မရှိ',NULL,NULL),(2,'2024-12-02','အငယ်ကောင်',4,10000,0,10000,'၅၀၀၀ဖြတ်',NULL,NULL),(3,'2024-12-02','တရုတ်ကြီးကား Mark II',1,720000,0,720000,'မရှိ',NULL,NULL),(4,'2024-12-03','Denko SPT',7,50000,0,50000,'မရှိ',NULL,NULL),(5,'2024-12-03','တရုတ်ကြီး Mark II',2,493500,0,493500,'မရှိ',NULL,NULL),(6,'2024-12-03','အငယ်ကောင်',4,10000,0,10000,'၅၀၀၀ဖြတ်',NULL,NULL),(7,'2024-12-04','အငယ်ကောင်',4,10000,0,10000,'၅၀၀၀ဖြတ်',NULL,NULL),(8,'2024-12-04','UMH',1,10000,0,10000,'မရှိ',NULL,NULL),(9,'2024-12-04','ဖုန်းပြင်',5,120000,0,120000,'မရှိ',NULL,NULL),(10,'2024-12-05','အငယ်ကောင်',4,10000,0,10000,'၅၀၀၀ဖြတ်',NULL,NULL),(11,'2024-12-06','အငယ်ကောင်',4,10000,0,10000,'၅၀၀၀ဖြတ်',NULL,NULL),(12,'2024-12-07','3J 6979',2,125000,0,125000,'မရှိ',NULL,NULL),(13,'2024-12-07','0E+00',2,54000,0,54000,'မရှိ',NULL,NULL),(14,'2024-12-07','3J 6979',1,146000,0,146000,'မရှိ',NULL,NULL),(15,'2024-12-07','8E 2765',1,94000,0,94000,'မရှိ',NULL,NULL),(16,'2024-12-07','ကလေးဆေးခန်းပြ',5,43750,0,43750,'မရှိ',NULL,NULL),(17,'2024-12-08','အငယ်ကောင်',4,10000,0,10000,'၅၀၀၀ဖြတ်',NULL,NULL),(18,'2024-12-08','လေစက် head ပြင်',5,90000,0,90000,'မရှိ',NULL,NULL),(19,'2024-12-09','2P 3817',2,1600000,0,1600000,'4p10',NULL,NULL),(20,'2024-12-09','အငယ်ကောင်',4,10000,0,10000,'၅၀၀၀ဖြတ်',NULL,NULL),(21,'2024-12-09','2P 3817',1,2400000,0,2400000,'4p10',NULL,NULL),(22,'2024-12-09','3G 3535',1,10000,0,10000,'Sorento ကိုဘုန်း ခေါ်လာ',NULL,NULL),(23,'2024-12-10','Denko SPT',7,50000,0,50000,'မရှိ',NULL,NULL),(24,'2024-12-10','3G 3535',2,20000,0,20000,'မရှိ',NULL,NULL),(25,'2024-12-10','အငယ်ကောင်',4,10000,0,10000,'5000 ဖြတ်',NULL,NULL),(26,'2024-12-10','3G 3535',1,55000,0,55000,'မရှိ',NULL,NULL),(27,'2024-12-11','အငယ်ကောင်',4,10000,0,10000,'5000 ဖြတ် ၃',NULL,NULL),(28,'2024-12-11','3H-8862',1,30000,0,30000,'မရှိ',NULL,NULL),(29,'2024-12-11','အင်ဂျင်ဝိုင်လဲ',1,5000,0,5000,'မရှိ',NULL,NULL),(30,'2024-12-11','Diaper',5,53000,0,53000,'မရှိ',NULL,NULL),(31,'2024-12-12','အငယ်ကောင်',4,10000,0,10000,'5000ဖြတ် ၄',NULL,NULL),(32,'2024-12-12','7R 3098',1,15000,0,15000,'မရှိ',NULL,NULL),(33,'2024-12-13','အငယ်ကောင်',4,10000,0,10000,'5000ဖြတ် 5',NULL,NULL),(34,'2024-12-14','92 Denko spt',7,81000,0,81000,'မရှိ',NULL,NULL),(35,'2024-12-14','Honda acty air on ပြင်',5,247000,0,247000,'မရှိ',NULL,NULL),(36,'2024-12-14','အမွှေးချိတ်, lighter ခေါင်း',5,36000,0,36000,'မရှိ',NULL,NULL),(37,'2024-12-15','SB Baby',5,56100,0,56100,'မရှိ',NULL,NULL),(38,'2024-12-16','အငယ်ကောင်',4,10000,0,10000,'5000 ဖြတ် ၆',NULL,NULL),(39,'2024-12-16','ကိုကျော်ဝေစက်ရုံ  outdoor',1,20000,0,20000,'မရှိ',NULL,NULL),(40,'2024-12-16','3R 7412',1,15000,0,15000,'မရှိ',NULL,NULL),(41,'2024-12-16','6E 5996',1,50000,0,50000,'မရှိ',NULL,NULL),(42,'2024-12-17','ကယ်ရီ',3,15000,0,15000,'မရှိ',NULL,NULL),(43,'2024-12-17','92 max Padua chaung',7,48000,0,48000,'106 km မောင်းပြီး ( 15.79L ဝင် )',NULL,NULL),(44,'2024-12-17','7E 7647',2,510000,0,510000,'မရှိ',NULL,NULL),(45,'2024-12-17','မိန်းမကိုအပ်',6,100000,0,100000,'မရှိ',NULL,NULL),(46,'2024-12-17','အငယ်ကောင်',4,10000,0,10000,'၅၀၀၀ ဖြတ် ၇',NULL,NULL),(47,'2024-12-17','7E 7467',1,725000,0,725000,'မရှိ',NULL,NULL),(48,'2024-12-18','အငယ်ကောင်',4,10000,0,10000,'5000ဖြတ် ၈',NULL,NULL),(49,'2024-12-18','2K 4593',1,5000,0,5000,'မရှိ',NULL,NULL),(50,'2024-12-18','FF 2239',1,20000,0,20000,'မရှိ',NULL,NULL),(51,'2024-12-19','အငယ်ကောင်',4,10000,0,10000,'5000ဖြတ် ၉',NULL,NULL),(52,'2024-12-19','6R 6770',1,135000,0,135000,'Chevy sparky plugs 3လုံး',NULL,NULL),(53,'2024-12-19','6R 6770',1,72000,0,72000,'မရှိ',NULL,NULL),(54,'2024-12-20','4J 6804',2,30800,0,30800,'မရှိ',NULL,NULL),(55,'2024-12-20','အငယ်ကောင်',4,15000,0,15000,'မရှိ',NULL,NULL),(56,'2024-12-20','4J 6804',1,69000,0,69000,'မရှိ',NULL,NULL),(57,'2024-12-20','Junction square',5,37400,0,37400,'မရှိ',NULL,NULL),(58,'2024-12-21','ကိုကျော်ဝေ  Nissan atlas',2,62000,0,62000,'မရှိ',NULL,NULL),(59,'2024-12-21','အငယ်ကောင်',4,15000,0,15000,'မရှိ',NULL,NULL),(60,'2024-12-21','3R 7412',1,35000,0,35000,'မရှိ',NULL,NULL),(61,'2024-12-21','ကိုကျော်ဝေ Nissan atlas',5,90000,0,90000,'မရှိ',NULL,NULL),(62,'2024-12-22','92 spt denko',7,67000,0,67000,'226.4km မောင်းပြီး ( 21.54L )',NULL,NULL),(63,'2024-12-22','UMH 9M',2,398000,0,398000,'မရှိ',NULL,NULL),(64,'2024-12-22','UMH 5G',2,221000,0,221000,'မရှိ',NULL,NULL),(65,'2024-12-22','UMH 3P',2,181000,0,181000,'မရှိ',NULL,NULL),(66,'2024-12-22','အငယ်ကောင်',4,15000,0,15000,'မရှိ',NULL,NULL),(67,'2024-12-22','UMH 9M',1,804000,0,804000,'မရှိ',NULL,NULL),(68,'2024-12-22','UMH 5G',1,240000,0,240000,'မရှိ',NULL,NULL),(69,'2024-12-22','UMH 3P',1,251000,0,251000,'မရှိ',NULL,NULL),(70,'2024-12-23','အငယ်ကောင်',4,15000,0,15000,'မရှိ',NULL,NULL),(71,'2024-12-24','ထက်လင်းမြင့် insight',2,628000,0,628000,'မရှိ',NULL,NULL),(72,'2024-12-24','အငယ်ျကာင်',4,15000,0,15000,'မရှိ',NULL,NULL),(73,'2024-12-24','ထက်လင်းမြင့် Insight',1,800000,0,800000,'မရှိ',NULL,NULL),(74,'2024-12-25','အငယ်ကောင်',4,15000,0,15000,'မရှိ',NULL,NULL),(75,'2024-12-26','အငယ်ကောင်',4,15000,0,15000,'မရှိ',NULL,NULL),(76,'2024-12-26','ဦးကျော်ဝင်း dyna',1,390000,0,390000,'မရှိ',NULL,NULL),(77,'2024-12-27','27 မှ 29 အထိ daily',4,45000,0,45000,'3ရက်စာ ပေါင်း',NULL,NULL),(78,'2024-12-30','UMH 9M, 7I, 2R',1,265000,0,265000,'မရှိ',NULL,NULL),(79,'2024-12-31','အငယ်ကောင်',4,15000,0,15000,'မရှိ',NULL,NULL),(80,'2024-12-31','မဟာဝိဟာရ 7J 5429',1,20000,0,20000,'မရှိ',NULL,NULL),(81,'2025-01-01','မဟာဝိဟာရ Supercustom',2,3584000,0,3584000,'မရှိ',NULL,NULL),(82,'2025-01-01','အပ်ငွေ',6,1200000,0,1200000,'မရှိ',NULL,NULL),(83,'2025-01-01','၁၂ လပိုင်း ကျော်နိုင် လစာ+ bonus',4,750000,0,750000,'မရှိ',NULL,NULL),(84,'2025-01-01','၁၂ လပိုင်း ဖက်တီး လစာ+ bonus',4,180000,0,180000,'မရှိ',NULL,NULL),(85,'2025-01-01','၁၂ လပိုင်း အငယ်ကောင် bonus',4,40000,0,40000,'မရှိ',NULL,NULL),(86,'2025-01-01','အငယ်ကောင်',4,15000,0,15000,'မရှိ',NULL,NULL),(87,'2025-01-01','မဟာဝိဟာရ  Super custom',1,4020000,0,4020000,'မရှိ',NULL,NULL),(88,'2025-01-02','အငယ်ကောင်',4,15000,0,15000,'မရှိ',NULL,NULL),(89,'2025-01-02','1G 6709',1,13000,0,13000,'မရှိ',NULL,NULL),(90,'2025-01-03','7H 9880',2,305000,0,305000,'မရှိ',NULL,NULL),(91,'2025-01-03','7H 9880',1,445000,0,445000,'မရှိ',NULL,NULL),(92,'2025-01-03','FF 9005',1,13000,0,13000,'မရှိ',NULL,NULL),(93,'2025-01-05','5ရက်နေ့မှ ၇ရက်နေ့အထိ daily 3ရက်',4,45000,0,45000,'မရှိ',NULL,NULL),(94,'2025-01-09','၂ရက်စာ',4,30000,0,30000,'မရှိ',NULL,NULL),(95,'2025-01-10','Chevrolet spark',1,25000,0,25000,'ဆီတိုင်ကီဆေး',NULL,NULL),(96,'2025-01-11','၂ရက်စာ',1,30000,0,30000,'မရှိ',NULL,NULL),(97,'2025-01-12','7J-5429',1,358000,0,358000,'မရှိ',NULL,NULL),(98,'2025-01-13','10 11 12 13.  Daily',4,60000,0,60000,'မရှိ',NULL,NULL),(99,'2025-01-13','2P-8959',1,15000,0,15000,'မရှိ',NULL,NULL),(100,'2025-01-13','1L-6976',1,15000,0,15000,'မရှိ',NULL,NULL),(101,'2025-01-14','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(102,'2025-01-15','7L-6290',2,239000,0,239000,'မရှိ',NULL,NULL),(103,'2025-01-15','Daiiy',4,15000,0,15000,'မရှိ',NULL,NULL),(104,'2025-01-15','7L-6290',1,370000,0,370000,'မရှိ',NULL,NULL),(105,'2025-01-16','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(106,'2025-01-16','3R-7412',1,25000,0,25000,'မရှိ',NULL,NULL),(107,'2025-01-21','17 18 20 21 daily',4,60000,0,60000,'မရှိ',NULL,NULL),(108,'2025-01-22','6P-6321',2,3245000,0,3245000,'မရှိ',NULL,NULL),(109,'2025-01-22','7C-4391',2,131000,0,131000,'မရှိ',NULL,NULL),(110,'2025-01-22','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(111,'2025-01-22','6P-6321',1,5400000,0,5400000,'Chinese company bongo3 engine rebuild( warranty 3months)',NULL,NULL),(112,'2025-01-22','7C-4391',1,204000,0,204000,'မရှိ',NULL,NULL),(113,'2025-01-23','2L-8350',2,103500,0,103500,'မရှိ',NULL,NULL),(114,'2025-01-23','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(115,'2025-01-23','2L-8350',1,131500,0,131500,'မရှိ',NULL,NULL),(116,'2025-01-24','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(117,'2025-01-25','4p10 company VANGUARD',2,853000,0,853000,'မရှိ',NULL,NULL),(118,'2025-01-25','5M-1852',2,174500,0,174500,'မရှိ',NULL,NULL),(119,'2025-01-25','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(120,'2025-01-25','4p10company VANGUARD',1,1450000,0,1450000,'မရှိ',NULL,NULL),(121,'2025-01-25','4R-2718',1,10000,0,10000,'မရှိ',NULL,NULL),(122,'2025-01-25','5M-1852',1,219500,0,219500,'မရှိ',NULL,NULL),(123,'2025-01-27','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(124,'2025-01-28','6I-6506',1,5000,0,5000,'မရှိ',NULL,NULL),(125,'2025-01-31','28 29 30 31 daily',4,60000,0,60000,'မရှိ',NULL,NULL),(126,'2025-02-01','1D-6379',2,236500,0,236500,'မရှိ',NULL,NULL),(127,'2025-02-01','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(128,'2025-02-01','1D-6379',1,286500,0,286500,'မရှိ',NULL,NULL),(129,'2025-02-01','Bo Kyaw Nissan murano',1,18000,0,18000,'မရှိ',NULL,NULL),(130,'2025-02-03','1F-4191',2,199000,0,199000,'မရှိ',NULL,NULL),(131,'2025-02-03','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(132,'2025-02-03','1F-4191',1,1700000,0,1700000,'KIA Optima Engine Rebuild',NULL,NULL),(133,'2025-02-05','4 5 daily',4,30000,0,30000,'မရှိ',NULL,NULL),(134,'2025-02-05','1H-1097',1,10000,0,10000,'မရှိ',NULL,NULL),(135,'2025-02-06','Ko YE Thway',2,314000,0,314000,'မရှိ',NULL,NULL),(136,'2025-02-06','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(137,'2025-02-06','Ko YE Thway',1,530000,0,530000,'မရှိ',NULL,NULL),(138,'2025-02-07','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(139,'2025-02-08','3S-1825',1,25000,0,25000,'မရှိ',NULL,NULL),(140,'2025-02-08','6R-5265',1,50000,0,50000,'မရှိ',NULL,NULL),(141,'2025-02-10','8 9 10 daily',4,45000,0,45000,'မရှိ',NULL,NULL),(142,'2025-02-11','6P-6321',2,137000,0,137000,'မရှိ',NULL,NULL),(143,'2025-02-11','6P-6321',1,180000,0,180000,'မရှိ',NULL,NULL),(144,'2025-02-17','11 13 14 15 16 17 daily6',4,90000,0,90000,'မရှိ',NULL,NULL),(145,'2025-02-18','92 ( spt den Ko )',7,20000,0,20000,'မရှိ',NULL,NULL),(146,'2025-02-18','Daly',4,15000,0,15000,'မရှိ',NULL,NULL),(147,'2025-02-18','2L-8350',1,5000,0,5000,'မရှိ',NULL,NULL),(148,'2025-02-19','4D-3760',1,10000,0,10000,'မရှိ',NULL,NULL),(149,'2025-02-20','92 (SML max)',7,50000,0,50000,'မရှိ',NULL,NULL),(150,'2025-02-22','19202122 daily4',4,60000,0,60000,'မရှိ',NULL,NULL),(151,'2025-02-23','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(152,'2025-02-23','FF-9005',1,35000,0,35000,'မရှိ',NULL,NULL),(153,'2025-02-24','9K-9702',2,441000,0,441000,'မရှိ',NULL,NULL),(154,'2025-02-24','1G-6709',2,188000,0,188000,'မရှိ',NULL,NULL),(155,'2025-02-24','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(156,'2025-02-24','9K-9702',1,650000,0,650000,'မရှိ',NULL,NULL),(157,'2025-02-24','1G-6709',1,300000,0,300000,'မရှိ',NULL,NULL),(158,'2025-02-25','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(159,'2025-02-25','5M-1852',1,8000,0,8000,'မရှိ',NULL,NULL),(160,'2025-02-25','8G-3996',1,80000,0,80000,'မရှိ',NULL,NULL),(161,'2025-02-26','3H-8862',1,87000,0,87000,'မရှိ',NULL,NULL),(162,'2025-02-28','Honda ACTY',2,727500,0,727500,'engine rebuild',NULL,NULL),(163,'2025-02-28','26 27 28 daily 3',4,45000,0,45000,'မရှိ',NULL,NULL),(164,'2025-03-02','2ရက်စာ',4,30000,0,30000,'မရှိ',NULL,NULL),(165,'2025-03-03','1 ,3 daily 2',4,30000,0,30000,'မရှိ',NULL,NULL),(166,'2025-03-04','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(167,'2025-03-04','3H-8862',1,20000,0,20000,'မရှိ',NULL,NULL),(168,'2025-03-04','Crane truck',1,450000,0,450000,'မရှိ',NULL,NULL),(169,'2025-03-05','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(170,'2025-03-06','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(171,'2025-03-06','9L-2567',1,15000,0,15000,'မရှိ',NULL,NULL),(172,'2025-03-07','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(173,'2025-03-07','2P-8252',1,15000,0,15000,'မရှိ',NULL,NULL),(174,'2025-03-08','9R-4210',2,110000,0,110000,'မရှိ',NULL,NULL),(175,'2025-03-08','9R-4210',1,500000,0,500000,'မရှိ',NULL,NULL),(176,'2025-03-09','MaxSML',7,20000,0,20000,'မရှိ',NULL,NULL),(177,'2025-03-10','DENKO spt',7,50000,0,50000,'မရှိ',NULL,NULL),(178,'2025-03-10','2R-2015',2,196300,0,196300,'မရှိ',NULL,NULL),(179,'2025-03-10','2R-2015',1,360200,0,360200,'မရှိ',NULL,NULL),(180,'2025-03-11','4N-8736',2,101000,0,101000,'မရှိ',NULL,NULL),(181,'2025-03-11','9 10 daily',4,30000,0,30000,'မရှိ',NULL,NULL),(182,'2025-03-11','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(183,'2025-03-11','4N8736',1,230000,0,230000,'မရှိ',NULL,NULL),(184,'2025-03-12','Max SML',7,63207,0,63207,'မရှိ',NULL,NULL),(185,'2025-03-12','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(186,'2025-03-12','0E+00',1,15000,0,15000,'မရှိ',NULL,NULL),(187,'2025-03-13','အဖေများနေ့ မုန့်ဝယ်',5,34000,0,34000,'CityMart သမိုင်း',NULL,NULL),(188,'2025-03-14','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(189,'2025-03-14','1D-6379',1,20000,0,20000,'မရှိ',NULL,NULL),(190,'2025-03-14','2S-5766',1,50000,0,50000,'မရှိ',NULL,NULL),(191,'2025-03-15','8G-3996',1,20000,0,20000,'ရှေ့ရှး၊ နောက်ရှူးလဲ',NULL,NULL),(192,'2025-03-16','92 Denko ဖော့ကန်',7,45000,0,45000,'Full-160km ထိမောင်းပြီး 14.610L ဖြည့် ( ၁လီတာ=၁၁ကီလိုမီတာ )',NULL,NULL),(193,'2025-03-17','Daily',4,30000,0,30000,'၂ရက်စာ',NULL,NULL),(194,'2025-03-18','Outdoor',3,25000,0,25000,'ရွှေပြည်ကြသာမှကြည့်မြင်တိုင်အိမ် တက္ကစီ',NULL,NULL),(195,'2025-03-19','Daily',4,30000,0,30000,'18 19 ၂ရက်စာ',NULL,NULL),(196,'2025-03-21','20 21 ၂ရက်စာ',4,30000,0,30000,'မရှိ',NULL,NULL),(197,'2025-03-22','92 MAX ( SML)',7,30000,0,30000,'မရှိ',NULL,NULL),(198,'2025-03-23','ကယ်ရဣ',3,12000,0,12000,'မရှိ',NULL,NULL),(199,'2025-03-23','Honda insight',1,90000,0,90000,'မာစတာပန့်လဲ၊ ရှေ့ရှူးလဲ၊ နောက်ရှူး တင်',NULL,NULL),(200,'2025-03-24','၂၂ ၂၃ ၂၄ ၃ရက်စာ',4,45000,0,45000,'မရှိ',NULL,NULL),(201,'2025-03-24','ဦးကျော်ကျော်စိုး',1,10000,0,10000,'Engine oil လဲ ၊ အောက်ပိုင်းစစ်',NULL,NULL),(202,'2025-03-25','6C-8909',2,478000,0,478000,'မရှိ',NULL,NULL),(203,'2025-03-25','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(204,'2025-03-25','6C-8909',1,580000,0,580000,'FR L Balljoint,rackend,brakepad,S.bush,Link,EO,plug',NULL,NULL),(205,'2025-03-26','92 Max SML',7,50000,0,50000,'မရှိ',NULL,NULL),(206,'2025-03-26','ကွန်ပျူတာစစ်',1,10000,0,10000,'မရှိ',NULL,NULL),(207,'2025-03-26','Toyota pixis',1,10000,0,10000,'သဲကာလဲ အင်ဂျင်ဝိုင်လဲ',NULL,NULL),(208,'2025-03-27','0E+00',3,20000,0,20000,'Byn↔SPT',NULL,NULL),(209,'2025-03-27','0E+00',1,1290000,0,1290000,'1G ဂီယာဘောက်ပြင်',NULL,NULL),(210,'2025-03-28','0E+00',2,940000,0,940000,'ဂီယာဘောက်ပြင်၊ ATF ၂ပုံး',NULL,NULL),(211,'2025-03-28','Daily 2ရက်စာ',4,30000,0,30000,'မရှိ',NULL,NULL),(212,'2025-03-29','92 Max SML',7,40000,0,40000,'မရှိ',NULL,NULL),(213,'2025-03-31','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(214,'2025-03-31','ကျော်နိုင်',4,700000,0,700000,'မရှိ',NULL,NULL),(215,'2025-03-31','ဖက်တီး',4,150000,0,150000,'မရှိ',NULL,NULL),(216,'2025-04-03','7P-1169 ပစ္စည့်းဝယ်',2,130000,0,130000,'မရှိ',NULL,NULL),(217,'2025-04-03','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(218,'2025-04-03','2Q-4817',1,25000,0,25000,'ရှေ့ရှူးလဲ နောက်ရှူး adjust',NULL,NULL),(219,'2025-04-04','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(220,'2025-04-04','2Q-4817',1,10000,0,10000,'မရှိ',NULL,NULL),(221,'2025-04-05','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(222,'2025-04-05','1D-1488',1,48000,0,48000,'ရှူးလဲ ဆုံခု ဘရိတ်ခု ပလပ်ဆေး နောက်ရော့လဲ လက်ခ',NULL,NULL),(223,'2025-04-08','4D-9904',2,266000,0,266000,'မရှိ',NULL,NULL),(224,'2025-04-08','Daily 2ရက်',4,30000,0,30000,'မရှိ',NULL,NULL),(225,'2025-04-08','4D-9904',1,387000,0,387000,'Honda green; plugs 8',NULL,NULL),(226,'2025-04-09','2K-8105',2,259000,0,259000,'မရှိ',NULL,NULL),(227,'2025-04-09','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(228,'2025-04-09','2K-8105',1,330000,0,330000,'EO tie rod. Front brake pad tappet seal',NULL,NULL),(229,'2025-04-10','1K-4258',2,149000,0,149000,'မရှိ',NULL,NULL),(230,'2025-04-10','0E+00',2,345000,0,345000,'မရှိ',NULL,NULL),(231,'2025-04-10','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(232,'2025-04-10','1K-4258',1,282000,0,282000,'Plug၊pump၊ pump filter၊ tappet seal',NULL,NULL),(233,'2025-04-10','0E+00',1,425000,0,425000,'Ipu fan',NULL,NULL),(234,'2025-04-11','မဟာဝိဟာရ Townace',2,208000,0,208000,'မရှိ',NULL,NULL),(235,'2025-04-11','မဟာဝိဟာရ Townace',1,370000,0,370000,'F brake pad/plug/fuel filter/o2',NULL,NULL),(236,'2025-04-11','EO အဟောင်းရောင်း',1,280000,0,280000,'သံတိုသံစရောင်းရငွေ',NULL,NULL),(237,'2025-04-11','သံတိုသံစ',1,200000,0,200000,'သံတိုသံစရောင်းရငွေ',NULL,NULL),(238,'2025-04-11','သင်္ကြန်မုန့်ဖိုး',5,170000,0,170000,'မရှိ',NULL,NULL),(239,'2025-04-20','4I-9366',2,165000,0,165000,'မရှိ',NULL,NULL),(240,'2025-04-20','4I-9336',1,240000,0,240000,'Wiper/ window ရေကာ ဂတစ်ဖြည့်',NULL,NULL),(241,'2025-04-23','20212223',4,60000,0,60000,'မရှိ',NULL,NULL),(242,'2025-04-23','6I-6506',1,85000,0,85000,'ပလပ်ကြိုး ဆီပန့်',NULL,NULL),(243,'2025-04-24','4N-8736',1,5000,0,5000,'မရှိ',NULL,NULL),(244,'2025-04-27','24252627 daily',4,60000,0,60000,'မရှိ',NULL,NULL),(245,'2025-04-27','1R-8362',1,25000,0,25000,'မရှိ',NULL,NULL),(246,'2025-04-28','2C-3388',2,167000,0,167000,'မရှိ',NULL,NULL),(247,'2025-04-28','Daily',4,15000,0,15000,'မရှိ',NULL,NULL),(248,'2025-04-28','2C-3388',1,235000,0,235000,'Eo tappet seal plug atf case clean',NULL,NULL),(249,'2025-04-30','ဆီ',7,150000,0,150000,'မရှိ',NULL,NULL),(250,'2025-04-30','7M-4355',2,310000,0,310000,'မရှိ',NULL,NULL),(251,'2025-04-30','မိန်းမကိုအပ်',6,700000,0,700000,'မရှိ',NULL,NULL),(252,'2025-04-30','282930 daily',4,45000,0,45000,'မရှိ',NULL,NULL),(253,'2025-04-30','ကျော်နိုင် ဖက်တီး လစာ',4,850000,0,850000,'မရှိ',NULL,NULL),(254,'2025-04-30','Bonus',4,140000,0,140000,'5;5;4',NULL,NULL),(255,'2025-04-30','7M-4355',1,2350000,0,2350000,'VNguard',NULL,NULL),(256,'2025-05-03','1G-6709',2,85000,0,85000,'မရှိ',NULL,NULL),(257,'2025-05-03','1G-6709',1,107000,0,107000,'မရှိ',NULL,NULL),(258,'2025-05-07','234567 daily',4,90000,0,90000,'မရှိ',NULL,NULL),(259,'2025-05-08','ဆီ',7,50000,0,50000,'မရှိ',NULL,NULL),(260,'2025-05-08','7M-4355',2,1175000,0,1175000,'မရှိ',NULL,NULL),(261,'2025-05-08','7M-4355',1,1400000,0,1400000,'Vg transmission',NULL,NULL),(262,'2025-05-09','မိန်းမကိုအပ်',6,100000,0,100000,'မရှိ',NULL,NULL),(263,'2025-05-10','Oil change',1,5000,0,5000,'မရှိ',NULL,NULL),(264,'2025-05-11','မိန်းမ cosmetic',5,15000,0,15000,'မရှိ',NULL,NULL),(265,'2025-05-11','Msub 6လစာဝယ်',5,15000,0,15000,'မရှိ',NULL,NULL),(266,'2025-05-12','92 max sml',7,50000,0,50000,'မရှိ',NULL,NULL),(267,'2025-05-17','Daily12 13 14 15 16 17',4,80000,0,80000,'မရှိ',NULL,NULL),(268,'2025-05-18','DAily',4,16000,0,16000,'မရှိ',NULL,NULL),(269,'2025-05-18','5F-9854',1,10000,0,10000,'မရှိ',NULL,NULL),(270,'2025-05-19','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(271,'2025-05-19','0E+00',1,50000,0,50000,'ဦးစိုးကြီး ဂီယာဘောက်ချ',NULL,NULL),(272,'2025-05-19','2K-4593',1,30000,0,30000,'မရှိ',NULL,NULL),(273,'2025-05-21','Daily 20 21',4,32000,0,32000,'မရှိ',NULL,NULL),(274,'2025-05-21','7R-5705',1,15000,0,15000,'မရှိ',NULL,NULL),(275,'2025-05-22','9N-8967',1,750000,0,750000,'မရှိ',NULL,NULL),(276,'2025-05-23','9N-8967',2,572000,0,572000,'မရှိ',NULL,NULL),(277,'2025-05-24','23 24 daily',4,32000,0,32000,'မရှိ',NULL,NULL),(278,'2025-05-25','Super custom N/DGN',1,100000,0,100000,'မရှိ',NULL,NULL),(279,'2025-05-27','5H-4242',2,230000,0,230000,'မရှိ',NULL,NULL),(280,'2025-05-27','26 27',4,32000,0,32000,'မရှိ',NULL,NULL),(281,'2025-05-27','5H-4242',1,570000,0,570000,'မရှိ',NULL,NULL),(282,'2025-05-29','4D-3585',2,91000,0,91000,'မရှိ',NULL,NULL),(283,'2025-05-29','28 29',4,32000,0,32000,'မရှိ',NULL,NULL),(284,'2025-05-29','4D-3585',1,110000,0,110000,'မရှိ',NULL,NULL),(285,'2025-05-31','12 ရက် နေ့ မှ လကုန် အထိ ဆီဖိုး',7,120000,0,120000,'မရှိ',NULL,NULL),(286,'2025-05-31','29 30 31',4,48000,0,48000,'မရှိ',NULL,NULL),(287,'2025-05-31','လစာ',4,850000,0,850000,'မရှိ',NULL,NULL),(288,'2025-05-31','Bonus ပေး',4,370000,0,370000,'မရှိ',NULL,NULL),(289,'2025-05-31','1Q-3006',1,10000,0,10000,'မရှိ',NULL,NULL),(290,'2025-05-31','Super Custom ပွဲခ',1,2000000,0,2000000,'မရှိ',NULL,NULL),(291,'2025-06-01','4I-9336',2,48000,0,48000,'မရှိ',NULL,NULL),(292,'2025-06-01','4I-9336',1,83000,0,83000,'မရှိ',NULL,NULL),(293,'2025-06-04','1234 ၄ရက်စာ',4,64000,0,64000,'မရှိ',NULL,NULL),(294,'2025-06-05','4C-6908',2,1442000,0,1442000,'မရှိ',NULL,NULL),(295,'2025-06-05','4S-2976',2,218000,0,218000,'မရှိ',NULL,NULL),(296,'2025-06-05','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(297,'2025-06-05','4C-6908',1,2150000,0,2150000,'မရှိ',NULL,NULL),(298,'2025-06-05','4S-2976',1,328000,0,328000,'မရှိ',NULL,NULL),(299,'2025-06-06','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(300,'2025-06-06','3F-4494',1,17000,0,17000,'မရှိ',NULL,NULL),(301,'2025-06-07','0E+00',1,15000,0,15000,'မရှိ',NULL,NULL),(302,'2025-06-07','4D-3585',1,120000,0,120000,'မရှိ',NULL,NULL),(303,'2025-06-09','7 9 ၂ရက်စာ',4,32000,0,32000,'မရှိ',NULL,NULL),(304,'2025-06-10','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(305,'2025-06-10','4B-8721',1,30000,0,30000,'မရှိ',NULL,NULL),(306,'2025-06-11','4H-9545',2,257000,0,257000,'မရှိ',NULL,NULL),(307,'2025-06-11','4H-9545',1,284000,0,284000,'မရှိ',NULL,NULL),(308,'2025-06-12','11 12 daily',4,32000,0,32000,'မရှိ',NULL,NULL),(309,'2025-06-13','Daily',1,5000,0,5000,'မရှိ',NULL,NULL),(310,'2025-06-19','13 ~ 19',4,96000,0,96000,'မရှိ',NULL,NULL),(311,'2025-06-20','1G-7929',2,950000,0,950000,'မရှိ',NULL,NULL),(312,'2025-06-20','7K-7906',2,280000,0,280000,'မရှိ',NULL,NULL),(313,'2025-06-20','1G-7929',1,3000000,0,3000000,'မရှိ',NULL,NULL),(314,'2025-06-20','7K-7906',1,405000,0,405000,'မရှိ',NULL,NULL),(315,'2025-06-21','Daily 20 21',4,32000,0,32000,'မရှိ',NULL,NULL),(316,'2025-06-22','9B-5310',2,322000,0,322000,'မရှိ',NULL,NULL),(317,'2025-06-22','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(318,'2025-06-22','9B-5310',1,1600000,0,1600000,'မရှိ',NULL,NULL),(319,'2025-06-23','8F-2765',2,56000,0,56000,'မရှိ',NULL,NULL),(320,'2025-06-23','1H-2469',2,226000,0,226000,'မရှိ',NULL,NULL),(321,'2025-06-23','8F-2765',1,75000,0,75000,'မရှိ',NULL,NULL),(322,'2025-06-23','1H-2469',1,270000,0,270000,'မရှိ',NULL,NULL),(323,'2025-06-24','2324 daily',4,32000,0,32000,'မရှိ',NULL,NULL),(324,'2025-06-25','4G-5932',1,15000,0,15000,'မရှိ',NULL,NULL),(325,'2025-06-26','2526 daily',4,32000,0,32000,'မရှိ',NULL,NULL),(326,'2025-06-27','1H-2469',2,234000,0,234000,'မရှိ',NULL,NULL),(327,'2025-06-27','1H-2469',1,329000,0,329000,'မရှိ',NULL,NULL),(328,'2025-06-28','2728 daily',4,32000,0,32000,'မရှိ',NULL,NULL),(329,'2025-06-29','0E+00',2,473000,0,473000,'မရှိ',NULL,NULL),(330,'2025-06-29','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(331,'2025-06-29','0E+00',1,590000,0,590000,'မရှိ',NULL,NULL),(332,'2025-06-30','June လ ဆီဖြည့်',7,250000,0,250000,'မရှိ',NULL,NULL),(333,'2025-06-30','0E+00',2,1180000,0,1180000,'မရှိ',NULL,NULL),(334,'2025-06-30','4D-3585',2,90000,0,90000,'မရှိ',NULL,NULL),(335,'2025-06-30','လစာ',4,850000,0,850000,'မရှိ',NULL,NULL),(336,'2025-06-30','Bonus',4,370000,0,370000,'မရှိ',NULL,NULL),(337,'2025-06-30','0E+00',1,2300000,0,2300000,'မရှိ',NULL,NULL),(338,'2025-06-30','4D-3585',1,120000,0,120000,'မရှိ',NULL,NULL),(339,'2025-07-03','6K-7813',2,1035000,0,1035000,'မရှိ',NULL,NULL),(340,'2025-07-03','123 daily',4,48000,0,48000,'မရှိ',NULL,NULL),(341,'2025-07-03','6K-7813',1,1450000,0,1450000,'မရှိ',NULL,NULL),(342,'2025-07-04','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(343,'2025-07-04','4N-6861',1,30000,0,30000,'မရှိ',NULL,NULL),(344,'2025-07-05','ဆီ',7,50000,0,50000,'မရှိ',NULL,NULL),(345,'2025-07-05','BB-1928',1,70000,0,70000,'မရှိ',NULL,NULL),(346,'2025-07-11','5ရက် daily',4,80000,0,80000,'မရှိ',NULL,NULL),(347,'2025-07-12','0E+00',2,70000,0,70000,'မရှိ',NULL,NULL),(348,'2025-07-12','1G-6709',2,83000,0,83000,'မရှိ',NULL,NULL),(349,'2025-07-12','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(350,'2025-07-12','0E+00',1,100000,0,100000,'မရှိ',NULL,NULL),(351,'2025-07-12','1G-6709',1,93000,0,93000,'မရှိ',NULL,NULL),(352,'2025-07-13','7K-7906',2,290000,0,290000,'မရှိ',NULL,NULL),(353,'2025-07-13','FF-9005',2,250000,0,250000,'မရှိ',NULL,NULL),(354,'2025-07-13','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(355,'2025-07-13','7K-7906',1,300000,0,300000,'မရှိ',NULL,NULL),(356,'2025-07-13','FF-9005',1,340000,0,340000,'မရှိ',NULL,NULL),(357,'2025-07-14','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(358,'2025-07-14','7R-7682',1,7000,0,7000,'မရှိ',NULL,NULL),(359,'2025-07-15','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(360,'2025-07-15','6K-7813',1,80000,0,80000,'မရှိ',NULL,NULL),(361,'2025-07-16','0E+00',2,241000,0,241000,'မရှိ',NULL,NULL),(362,'2025-07-16','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(363,'2025-07-16','0E+00',1,350000,0,350000,'မရှိ',NULL,NULL),(364,'2025-07-17','FF-9005',1,79000,0,79000,'မရှိ',NULL,NULL),(365,'2025-07-17','4G-6155',1,15000,0,15000,'မရှိ',NULL,NULL),(366,'2025-07-18','ဆီ',7,50000,0,50000,'မရှိ',NULL,NULL),(367,'2025-07-19','171819',4,48000,0,48000,'မရှိ',NULL,NULL),(368,'2025-07-20','7K-7906',2,368000,0,368000,'မရှိ',NULL,NULL),(369,'2025-07-20','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(370,'2025-07-20','7K-7906',1,600000,0,600000,'မရှိ',NULL,NULL),(371,'2025-07-21','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(372,'2025-07-22','92 Max (SML)',7,60000,0,60000,'မရှိ',NULL,NULL),(373,'2025-07-22','6K-7813',2,146000,0,146000,'ဆောင့်တုံး၂၊ ဂျွိုင့်ခရော့ ( ဂျွိုင့်၊ စတီယာရင်)၊ဂီယာဘောက်oil seal၊ ATF 2L',NULL,NULL),(374,'2025-07-22','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(375,'2025-07-23','2D-5030',2,93000,0,93000,'D4 pump/ ဆီ ၁ဘူး',NULL,NULL),(376,'2025-07-23','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(377,'2025-07-23','2D-5030',1,265000,0,265000,'D4 pump လဲ၊ filter ဆေး၊ လေတံခါးဆေး',NULL,NULL),(378,'2025-07-24','ကိုဟိန်းကား ဒူးဇစ်သဲကာလဲ',2,23200,0,23200,'မရှိ',NULL,NULL),(379,'2025-07-24','Daily',4,16000,0,16000,'မရှိ',NULL,NULL),(380,'2025-09-02','7L- sanden',2,5652000,0,5652000,'',NULL,NULL),(381,'2025-09-02','5 4 3 2 ၄ရက်စာ',4,64000,0,64000,'',NULL,NULL),(382,'2025-09-02','1G-6709',1,20000,0,20000,'',NULL,NULL),(383,'2025-09-02','2H-7345',1,30000,0,30000,'',NULL,NULL),(384,'2025-09-02','7L- sanden vanette',1,7113000,0,7113000,'',NULL,NULL),(385,'2025-09-04','7P-1948',2,2624500,0,2624500,'',NULL,NULL),(386,'2025-09-04','7P-1948',1,4682000,0,4682000,'ကိကျောဝေ atlas',NULL,NULL),(387,'2025-09-05','4D-3585',2,192000,0,192000,'',NULL,NULL),(388,'2025-09-05','4D-3585',1,250000,0,250000,'Eco 10 w40, plug, brake pad',NULL,NULL),(389,'2025-09-06','Daily',4,16000,0,16000,'',NULL,NULL),(390,'2025-09-06','4D-3585',1,20000,0,20000,'',NULL,NULL),(391,'2025-09-15','6N-9886',1,20000,0,20000,'',NULL,NULL),(392,'2025-09-16','3I-4041',2,60000,0,60000,'',NULL,NULL),(393,'2025-09-16','Daily',4,16000,0,16000,'',NULL,NULL),(394,'2025-09-16','5Q-1879',1,100000,0,100000,'Plug coil 1 plug 1',NULL,NULL),(395,'2025-09-16','3I-4041',1,100000,0,100000,'ပိုင်ထူးကား ဘတ်မှန် ပင်နီယံ ; ရှော့ဘားအပေါ်ထိုင်',NULL,NULL),(396,'2025-09-17','Daily',4,16000,0,16000,'',NULL,NULL),(397,'2025-09-17','ကိုဟိန်းကား',5,141000,0,141000,'အင်ဂျင်ဝိုင်လဲ ပန့်လဲ တိုက်ပစ်ဆီးလ် လဲ',NULL,NULL),(398,'2025-09-18','2K-8105',2,316000,0,316000,'Shockber ရှေ့ ဘယ်ညာ လဲ',NULL,NULL),(399,'2025-09-18','2D-5037',2,225000,0,225000,'Frank oil 6L+stanley atf',NULL,NULL),(400,'2025-09-18','Daily',4,16000,0,16000,'',NULL,NULL),(401,'2025-09-18','2K-8105',1,480000,0,480000,'',NULL,NULL),(402,'2025-09-18','2D-5036',1,267000,0,267000,'',NULL,NULL),(403,'2025-09-19','Eco cruise ရှင်း',2,300000,0,300000,'',NULL,NULL),(404,'2025-09-19','Daily',4,16000,0,16000,'',NULL,NULL),(405,'2025-09-20','92 spt denko',7,65000,0,65000,'',NULL,NULL),(406,'2025-09-20','Daily',4,16000,0,16000,'',NULL,NULL),(407,'2025-09-20','သဘက်ဝယ်',5,26000,0,26000,'',NULL,NULL),(408,'2025-09-20','ကိုဟိန်းကား ရေတိုင်ကီဆေး coolant လဲ',5,30000,0,30000,'',NULL,NULL),(409,'2025-09-21','Sanden Super custom horn',2,34000,0,34000,'',NULL,NULL),(410,'2025-09-21','ကားရေဆေး, ရေမတင်ဆေးဝယ်',5,23000,0,23000,'',NULL,NULL),(411,'2025-09-24','21 22 23 24 daily',4,64000,0,64000,'',NULL,NULL),(412,'2025-09-25','9I-8088',1,15000,0,15000,'',NULL,NULL),(413,'2025-09-30','252627282930',4,96000,0,96000,'',NULL,NULL),(414,'2025-09-30','3M-1556',1,20000,0,20000,'R brake adjust',NULL,NULL),(415,'2025-10-01','7N-8012',2,568000,0,568000,'',NULL,NULL),(416,'2025-10-01','Daily',4,16000,0,16000,'',NULL,NULL),(417,'2025-10-01','9လပိုင်း လစာရှင်း',4,850000,0,850000,'',NULL,NULL),(418,'2025-10-01','7N-8012',1,890000,0,890000,'Ucsy ipsum head',NULL,NULL),(419,'2025-10-02','အောင်ဖုန်းဆင့် Mark II',2,245000,0,245000,'',NULL,NULL),(420,'2025-10-02','Daily',4,16000,0,16000,'',NULL,NULL),(421,'2025-10-02','အောင်ဖုန်းဆင့် Mark II',1,500000,0,500000,'',NULL,NULL),(422,'2025-10-03','2C-3388',2,840000,0,840000,'',NULL,NULL),(423,'2025-10-03','Daily',4,16000,0,16000,'',NULL,NULL),(424,'2025-10-03','သီတင်းကျွတ် မုန့်ဖိုး ၃ယောက်',4,150000,0,150000,'',NULL,NULL),(425,'2025-10-03','2C-3388',1,1400000,0,1400000,'ကိုသိန်းကို transmission',NULL,NULL),(426,'2025-10-04','7A-1479',1,10000,0,10000,'',NULL,NULL),(427,'2025-10-08','Daily 78',4,32000,0,32000,'',NULL,NULL),(428,'2025-10-09','92 SML MAX',7,30000,0,30000,'',NULL,NULL),(429,'2025-10-09','KFC',5,25000,0,25000,'',NULL,NULL),(430,'2025-10-10','Daily 9 10',4,32000,0,32000,'',NULL,NULL),(431,'2025-10-11','92 Max TDK အပြည့်',7,68500,0,68500,'',NULL,NULL),(432,'2025-10-11','Lenovo tab m10',5,250000,0,250000,'',NULL,NULL),(433,'2025-10-12','Daily',4,16000,0,16000,'',NULL,NULL),(434,'2025-10-12','Honda civic mcm',1,10000,0,10000,'',NULL,NULL);
/*!40000 ALTER TABLE `records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` int NOT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('R9PIPjKtcxSiFvKSPAPejVkc4XTNNRrroQ2vGf7x',1,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:144.0) Gecko/20100101 Firefox/144.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVVZPU2lteEZ0MUFlWjVZeGRncTZtZVVIU0dmWlhJZnlMZXNLTEdsOCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvY2hhdGlmeSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1760671105);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `messenger_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Thiri Win','admin@gmail.com','2025-10-16 20:39:30','$2y$12$Sci2e8GTZKqp4EBO6FqWQu2kop08pAKCVPssJjduUULM1wLhbF.22','zDjjhYAJ19','2025-10-16 20:39:31','2025-10-16 20:39:31',0,'avatar.png',0,NULL),(2,'Aung Ko Hein','akh@gmail.com','2025-10-16 20:39:31','$2y$12$Jpurc9KeWHPWfEe1KBYjmO62pd27x592SdkI7dLe3HcG5JJaXEIry','q3uE15Qusq','2025-10-16 20:39:31','2025-10-16 20:39:31',0,'avatar.png',0,NULL),(3,'Jonny','user@gmail.com','2025-10-16 20:39:31','$2y$12$iW8/9YYPGf6Azsju.CIhK.3enyaxLYpOiGUsOgwRfoarEqSJg1fpe','4CUFARgOqs','2025-10-16 20:39:31','2025-10-16 20:39:31',0,'avatar.png',0,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vouchers`
--

DROP TABLE IF EXISTS `vouchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vouchers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int NOT NULL,
  `total` int NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `category_id` int NOT NULL DEFAULT '6',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vouchers`
--

LOCK TABLES `vouchers` WRITE;
/*!40000 ALTER TABLE `vouchers` DISABLE KEYS */;
/*!40000 ALTER TABLE `vouchers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-17 19:43:44
