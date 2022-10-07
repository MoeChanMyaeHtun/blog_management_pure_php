-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (8,'Phone','2022-09-29 08:50:58','2022-09-29 08:50:58'),(9,'Laptop','2022-09-29 08:51:04','2022-09-29 08:51:04'),(10,'Tablet','2022-09-29 08:51:08','2022-09-29 08:51:08');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int NOT NULL,
  `uid` int NOT NULL,
  `body` varchar(225) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,42,2,'Hello','2022-10-04 09:50:41','2022-10-04 09:50:41'),(2,42,2,'hii','2022-10-04 10:13:22','2022-10-04 10:13:22'),(3,50,2,'laptop','2022-10-04 10:13:49','2022-10-04 10:13:49'),(4,50,2,'hiii','2022-10-04 10:17:01','2022-10-04 10:17:01'),(5,49,2,'hii','2022-10-04 10:34:19','2022-10-04 10:34:19'),(6,55,2,'hii','2022-10-04 08:45:07','2022-10-04 08:45:07'),(8,65,1,'Hello','2022-10-05 01:12:41','2022-10-05 01:12:41'),(10,68,2,'hello','2022-10-05 04:46:30','2022-10-05 04:46:30'),(11,69,2,'hello','2022-10-05 05:11:38','2022-10-05 05:11:38'),(13,76,13,'hello iam ','2022-10-06 10:36:47','2022-10-06 10:36:47'),(19,83,16,'hii','2022-10-06 08:47:56','2022-10-06 08:47:56'),(20,84,17,'hello','2022-10-07 08:29:26','2022-10-07 08:29:26'),(21,83,17,'hello 2 ','2022-10-07 08:29:51','2022-10-07 08:29:51'),(22,85,17,'ffffff','2022-10-07 08:30:57','2022-10-07 08:30:57'),(23,85,16,'hiii','2022-10-07 08:55:01','2022-10-07 08:55:01'),(24,85,16,'hii','2022-10-07 09:02:29','2022-10-07 09:02:29'),(25,85,16,'hii','2022-10-07 09:22:18','2022-10-07 09:22:18'),(26,84,16,'hii','2022-10-07 09:52:51','2022-10-07 09:52:51'),(27,81,16,'hii','2022-10-07 09:56:23','2022-10-07 09:56:23'),(28,85,6,'Edit','2022-10-07 09:57:25','2022-10-07 09:57:25');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(225) DEFAULT NULL,
  `title` varchar(225) NOT NULL,
  `description` varchar(225) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `image_UNIQUE` (`image`),
  KEY `user_id_idx` (`user_id`,`id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (73,'../img/posts/1167423504633e5088a909a4.14798406.jpg','Samsung','Samsung','2022-10-06 10:19:07','2022-10-06 10:19:07',12),(74,'../img/posts/618559370633e50a214c402.93775200.jpg','Samsung','Samsung Galaxy','2022-10-06 10:20:58','2022-10-06 10:20:58',12),(75,'../img/posts/954432626633e5119533053.47851708.jpg','Samsung Tablet','Samsung S8','2022-10-06 10:22:57','2022-10-06 10:22:57',6),(76,'../img/posts/1877336347633e513062f6d3.18804402.jpg','Samsung Tablet','Samsung Tap S6','2022-10-06 10:23:20','2022-10-06 10:23:20',6),(77,'../img/posts/1835383861633e5419f0ecb7.75563589.jpg','kmt title','kmt description','2022-10-06 10:35:45','2022-10-06 10:35:45',13),(79,'../img/posts/24296026633e54fc039818.39197934.jpg','kmt samsung ','kmt description','2022-10-06 10:38:41','2022-10-06 10:38:41',13),(81,'../img/posts/61285711633e68ccd01479.83710320.jpg','aaaa','aaaaa','2022-10-06 11:58:59','2022-10-06 11:58:59',14),(83,'../img/posts/890083206633ea412dc96f0.54604987.jpg','BBBBBBBB','aaa','2022-10-06 04:16:58','2022-10-06 04:16:58',16),(84,'../img/posts/119195024633f87459a13e2.21063035.jpg','phone','phone','2022-10-07 08:26:21','2022-10-07 08:26:21',16),(85,'../img/posts/31509191633f88351616a0.99375569.jpg','title ','se edit','2022-10-07 08:30:21','2022-10-07 08:30:21',17);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_category`
--

DROP TABLE IF EXISTS `post_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_category` (
  `post_id` int DEFAULT NULL,
  `cat_id` int DEFAULT NULL,
  KEY `post_id_idx` (`post_id`),
  KEY `cat_id_idx` (`cat_id`),
  CONSTRAINT `cat_id` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_id` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_category`
--

LOCK TABLES `post_category` WRITE;
/*!40000 ALTER TABLE `post_category` DISABLE KEYS */;
INSERT INTO `post_category` VALUES (73,8),(74,8),(76,10),(75,10),(77,8),(77,9),(81,8),(79,8),(83,8),(84,8),(85,8),(85,9);
/*!40000 ALTER TABLE `post_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (6,'pyaesone','pyaesone@gmail.com','$2y$10$N8Dd6xkKy9INt3VmhOdDB.XAC4Y3eXdr3Va70flGisNgt6MWBRfWC','2022-09-27 04:20:05','2022-09-27 04:20:05'),(7,'Eaint Thet','eaint@gmail.com','$2y$10$Nsvy60aCeHhGUE2yWWtslegbUsDcbd6NFN3IUBYKtI.WQ42zQOER2','2022-10-06 09:21:50','2022-10-06 09:21:50'),(8,'Mochi','mochi55@gmail.com','$2y$10$SbSI99hcphYKAtle0WHcNu5BdlHVDpRhekV7GUq4pPO0Ec7w7m6hO','2022-10-06 10:00:06','2022-10-06 10:00:06'),(12,'shoon','shoon5@gmail.com','$2y$10$glRnysn/z3q1rsEkRmacFeuBVUEorR4B4szVqvvYFF65QxyttwV62','2022-10-06 10:14:36','2022-10-06 10:14:36'),(13,'kaung test 1 ','kaung@gmail.com','$2y$10$JSY/8tpgQJIl7aTqH336S.5OjuNZHKxWMl2NlPm/Gqh/y.0XezQ42','2022-10-06 10:33:24','2022-10-06 10:33:24'),(14,'kaung 2','kaung2@gmail.com','$2y$10$D6184MdeYFLNMB54gThdX.5LSg5Slwbayzlkpsqag4o02U3edZM6i','2022-10-06 10:41:10','2022-10-06 10:41:10'),(15,'moe','moe@gmail','$2y$10$FOQeEPOUJfbgwytX2PFZNu1vnOU1UTN8yUnLI8pA7UYuhCme7Z04S','2022-10-06 12:57:12','2022-10-06 12:57:12'),(16,'moechan','moechan@gmail.com','$2y$10$k.mLaJBD.BfzU3y6mKaskO7bnawDl3eMps7KPj3tFNEQWXF.RlJ2W','2022-10-06 04:11:57','2022-10-06 04:11:57'),(17,'kaung myat thway','kaungtest@gmail.com','$2y$10$17ChG3.IErLGcFrwzOFOqOxyINq02rXyw0WR1ha1Nz57ntJpGiBIu','2022-10-07 08:28:39','2022-10-07 08:28:39'),(18,'aaa','aaa@gmail.com','$2y$10$6coMeR5h3/IIX2.Fv0ZDaecZrDuuDiZ4t5XjKpDP6nipG/zOKUOZm','2022-10-07 08:35:38','2022-10-07 08:35:38');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-07 10:29:30
