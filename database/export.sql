-- MySQL dump 10.13  Distrib 9.1.0, for Win64 (x86_64)
--
-- Host: localhost    Database: restaurant
-- ------------------------------------------------------
-- Server version	9.1.0

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
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,'Flour',1.5,'2024-12-03 16:24:13','flour'),(2,'Salt',0.5,'2024-12-03 16:24:13','salt'),(3,'Pepper',0.75,'2024-12-03 16:24:13','pepper'),(4,'Milk',1.25,'2024-12-03 16:24:13','milk'),(5,'Butter',1.75,'2024-12-03 16:24:13','butter'),(6,'Eggs',2.5,'2024-12-03 16:24:13','eggs'),(7,'Tomatoes',1,'2024-12-03 16:24:13','tomatoes'),(8,'Onions',0.8,'2024-12-03 16:24:13','onions'),(9,'Garlic',0.6,'2024-12-03 16:24:13','garlic'),(10,'Carrots',0.9,'2024-12-03 16:24:13','carrots'),(11,'Rice',1.1,'2024-12-03 16:24:13','rice'),(12,'Oil',1.2,'2024-12-03 16:24:13','oil');
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `ingredient_id` int DEFAULT NULL,
  `action` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `order_id` int DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `fk_logs_orders` (`order_id`),
  KEY `fk_logs_products` (`product_id`),
  KEY `fk_logs_ingredients` (`ingredient_id`),
  CONSTRAINT `fk_logs_ingredients` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  CONSTRAINT `fk_logs_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `fk_logs_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `fk_logs_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (4,9,NULL,NULL,'Order stored',5,'2025-01-07 21:50:47');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mix_line`
--

DROP TABLE IF EXISTS `mix_line`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mix_line` (
  `mix_id` int NOT NULL,
  `product_id` int NOT NULL,
  `ingredient_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`mix_id`,`product_id`,`ingredient_id`),
  KEY `fk_order_line_products` (`product_id`),
  KEY `fk_order_line_ingredient` (`ingredient_id`),
  CONSTRAINT `fk_order_line_ingredient` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_order_line_orders` FOREIGN KEY (`mix_id`) REFERENCES `mixes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_order_line_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mix_line`
--

LOCK TABLES `mix_line` WRITE;
/*!40000 ALTER TABLE `mix_line` DISABLE KEYS */;
INSERT INTO `mix_line` VALUES (41,1,1,2,3),(41,1,4,1,1.25),(41,1,7,1,1),(41,1,12,1,1.2),(42,5,1,3,4.5),(42,5,4,1,1.25),(42,5,6,2,5),(42,5,12,1,1.2),(44,1,1,2,3),(44,1,4,1,1.25),(44,1,7,1,1),(44,1,12,1,1.2),(45,3,1,2,3),(45,3,3,1,0.75),(45,3,8,2,1.6),(45,3,12,1,1.2),(46,3,1,2,3),(46,3,3,1,0.75),(46,3,8,2,1.6),(46,3,12,1,1.2),(47,4,3,1,0.75),(47,4,5,10,17.5),(47,4,8,1,0.8),(47,4,12,2,2.4),(48,3,1,2,3),(48,3,3,1,0.75),(48,3,8,2,1.6),(48,3,12,1,1.2),(51,6,7,2,2),(51,6,8,1,0.8),(51,6,9,1,0.6),(51,6,10,3,2.7),(52,2,1,3,4.5),(52,2,6,2,5),(52,2,8,1,0.8),(52,2,12,1,1.2),(53,2,1,3,4.5),(53,2,6,2,5),(53,2,8,1,0.8),(53,2,12,1,1.2),(54,2,1,3,4.5),(54,2,6,2,5),(54,2,8,1,0.8),(54,2,12,1,1.2),(55,2,1,3,4.5),(55,2,6,2,5),(55,2,8,4,3.2),(55,2,12,1,1.2),(56,2,1,3,4.5),(56,2,6,5,12.5),(56,2,8,1,0.8),(56,2,12,1,1.2),(57,4,3,1,0.75),(57,4,5,1,1.75),(57,4,8,1,0.8),(57,4,12,2,2.4),(58,6,7,2,2),(58,6,8,1,0.8),(58,6,9,2,1.2),(58,6,10,1,0.9),(59,2,1,3,4.5),(59,2,6,2,5),(59,2,8,1,0.8),(59,2,12,1,1.2),(60,5,1,3,4.5),(60,5,4,3,3.75),(60,5,6,2,5),(60,5,12,1,1.2),(61,2,1,3,4.5),(61,2,6,2,5),(61,2,8,1,0.8),(61,2,12,1,1.2),(62,3,1,2,3),(62,3,3,1,0.75),(62,3,8,2,1.6),(62,3,12,1,1.2),(63,6,7,2,2),(63,6,8,1,0.8),(63,6,9,1,0.6),(63,6,10,1,0.9),(64,1,1,2,3),(64,1,4,1,1.25),(64,1,7,1,1),(64,1,12,1,1.2),(65,4,3,1,0.75),(65,4,5,1,1.75),(65,4,8,1,0.8),(65,4,12,2,2.4),(66,5,1,3,4.5),(66,5,4,1,1.25),(66,5,6,2,5),(66,5,12,1,1.2),(67,3,1,2,3),(67,3,3,1,0.75),(67,3,8,2,1.6),(67,3,12,1,1.2),(68,4,3,1,0.75),(68,4,5,1,1.75),(68,4,8,1,0.8),(68,4,12,2,2.4),(69,3,1,2,3),(69,3,3,1,0.75),(69,3,8,2,1.6),(69,3,12,1,1.2);
/*!40000 ALTER TABLE `mix_line` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mixes`
--

DROP TABLE IF EXISTS `mixes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mixes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mixes`
--

LOCK TABLES `mixes` WRITE;
/*!40000 ALTER TABLE `mixes` DISABLE KEYS */;
INSERT INTO `mixes` VALUES (34,'2024-12-20 22:47:13'),(35,'2024-12-20 22:47:13'),(36,'2024-12-21 00:00:21'),(37,'2024-12-21 00:00:21'),(38,'2024-12-21 17:19:14'),(39,'2024-12-21 17:19:15'),(40,'2024-12-21 19:14:17'),(41,'2024-12-24 16:07:20'),(42,'2024-12-24 16:07:20'),(43,'2024-12-25 16:19:37'),(44,'2024-12-25 16:19:54'),(45,'2024-12-25 16:19:54'),(46,'2024-12-25 16:26:38'),(47,'2024-12-25 16:26:38'),(48,'2024-12-25 16:28:28'),(49,'2024-12-25 16:28:28'),(50,'2024-12-25 16:28:28'),(51,'2024-12-25 16:28:28'),(52,'2024-12-26 19:18:28'),(53,'2024-12-26 19:32:03'),(54,'2024-12-26 20:01:18'),(55,'2024-12-26 20:43:24'),(56,'2024-12-29 16:20:51'),(57,'2024-12-29 16:23:46'),(58,'2024-12-29 16:23:46'),(59,'2025-01-01 01:36:27'),(60,'2025-01-07 09:56:19'),(61,'2025-01-07 18:03:57'),(62,'2025-01-07 18:03:57'),(63,'2025-01-07 18:03:57'),(64,'2025-01-07 18:03:58'),(65,'2025-01-07 18:03:58'),(66,'2025-01-07 18:03:58'),(67,'2025-01-07 18:05:30'),(68,'2025-01-07 18:05:50'),(69,'2025-01-07 18:09:39');
/*!40000 ALTER TABLE `mixes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offers` (
  `id` int NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `discount` float NOT NULL,
  `beggining_date` date NOT NULL,
  `ending_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offers`
--

LOCK TABLES `offers` WRITE;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
INSERT INTO `offers` VALUES (1,'Summer Sale','percentage',10,'2024-01-01','2024-02-01'),(2,'Winter Bonanza','fixed',5,'2024-03-01','2024-04-01'),(3,'Spring Surprise','percentage',20,'2024-05-01','2024-06-01'),(4,'Holiday Discount','percentage',15,'2024-06-01','2024-07-01'),(5,'Flash Sale','fixed',10,'2024-07-01','2024-08-01'),(6,'Back to School','percentage',5,'2024-08-01','2024-09-01'),(7,'Halloween Special','fixed',7,'2024-09-01','2024-10-01'),(8,'Black Friday','percentage',50,'2024-10-01','2024-11-01'),(9,'Cyber Monday','percentage',30,'2024-11-01','2024-12-01'),(10,'Christmas Deal','fixed',25,'2024-12-01','2024-12-31'),(11,'New Year Sale','percentage',15,'2025-01-01','2025-01-31'),(12,'Valentine’s Discount','percentage',20,'2025-02-01','2025-02-15'),(13,'Easter Discount','fixed',12,'2025-03-01','2025-03-30'),(14,'Summer Blowout','percentage',25,'2025-04-01','2025-05-01'),(15,'Labor Day Sale','fixed',10,'2025-05-01','2025-05-31'),(16,'Independence Offer','percentage',17,'2025-06-01','2025-06-30'),(17,'Back to Work','fixed',8,'2025-07-01','2025-07-31'),(18,'Fall Festival','percentage',20,'2025-08-01','2025-08-31'),(19,'Weekend Flash Sale','fixed',15,'2025-09-01','2025-09-15'),(20,'Final Countdown','percentage',30,'2025-09-16','2025-09-30');
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subtotal` float DEFAULT NULL,
  `iva` float DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_users` (`user_id`),
  CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (5,21,60.75,12.7575,73.5075,'2024-12-25 16:26:38'),(6,21,92.8,19.488,112.288,'2024-12-25 16:28:28'),(7,21,11.5,2.415,13.915,'2024-12-26 19:18:28'),(8,21,11.5,2.415,13.915,'2024-12-26 19:32:03'),(9,21,57.5,12.075,69.575,'2024-12-26 20:01:18'),(10,21,69.5,14.595,84.095,'2024-12-26 20:43:24'),(12,21,38,7.98,45.98,'2024-12-29 16:20:51'),(13,21,20.4,4.284,24.684,'2024-12-29 16:23:46'),(14,22,11.5,2.415,13.915,'2025-01-01 01:36:27'),(15,21,28.9,6.069,34.969,'2025-01-07 09:56:18'),(16,21,46.45,9.7545,56.2045,'2025-01-07 18:03:57'),(17,21,6.55,1.3755,7.9255,'2025-01-07 18:05:30'),(18,21,5.7,1.197,6.897,'2025-01-07 18:05:50'),(19,21,6.55,1.3755,7.9255,'2025-01-07 18:09:39');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_mixes`
--

DROP TABLE IF EXISTS `orders_mixes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders_mixes` (
  `order_id` int NOT NULL,
  `mix_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`order_id`,`mix_id`),
  KEY `fk_order_mixes_mixes` (`mix_id`),
  CONSTRAINT `fk_order_mixes_mixes` FOREIGN KEY (`mix_id`) REFERENCES `mixes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_order_mixes_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_mixes`
--

LOCK TABLES `orders_mixes` WRITE;
/*!40000 ALTER TABLE `orders_mixes` DISABLE KEYS */;
INSERT INTO `orders_mixes` VALUES (5,46,6,39.3),(5,47,1,21.45),(6,48,6,39.3),(6,49,4,24.6),(6,50,2,22.8),(6,51,1,6.1),(7,52,1,11.5),(8,53,1,11.5),(9,54,5,57.5),(10,55,5,69.5),(12,56,2,38),(13,57,1,5.7),(13,58,3,14.7),(14,59,1,11.5),(15,60,2,28.9),(16,61,1,11.5),(16,62,1,6.55),(16,63,1,4.3),(16,64,1,6.45),(16,65,1,5.7),(16,66,1,11.95),(17,67,1,6.55),(18,68,1,5.7),(19,69,1,6.55);
/*!40000 ALTER TABLE `orders_mixes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `offer_id` int DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `fk_products_offers` (`offer_id`),
  CONSTRAINT `fk_products_offers` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Grilled Salmon',2,'2024-12-03 16:24:33','Principles','grilled_salmon'),(2,'Fried Cod',1,'2024-12-03 16:24:33','Principles','fried_cod'),(3,'Crispy Catfish',NULL,'2024-12-03 16:24:33','Principles','crispy_catfish'),(4,'Pan-Seared Tuna',3,'2024-12-03 16:24:33','Principles','pan-seared_tuna'),(5,'Beer-Battered Haddock',NULL,'2024-12-03 16:24:33','Principles','beer-battered_haddock'),(6,'Bouillabaisse',4,'2024-12-03 16:24:33','Principles','bouillabaisse'),(7,'Seaweed Salad',NULL,'2025-01-07 21:02:36','Snacks','seaweed_salad'),(11,'Tuna tartare',NULL,'2025-01-07 21:08:32','Snacks','tuna_tartare'),(12,'Oysters',NULL,'2025-01-07 21:08:32','Snacks','oysters'),(13,'Crispy Cat Fish Tacos',NULL,'2025-01-07 21:08:33','Snacks','crispy_catfish_tacos'),(14,'Grilled Octopus',NULL,'2025-01-07 21:08:34','Snacks','grilled_octopus'),(15,'Smoked Salmon',NULL,'2025-01-07 21:08:35','Snacks','smoked_salmon');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_ingredients`
--

DROP TABLE IF EXISTS `products_ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_ingredients` (
  `product_id` int NOT NULL,
  `ingredient_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`product_id`,`ingredient_id`),
  KEY `fk_products_ingredients_ingredients` (`ingredient_id`),
  CONSTRAINT `fk_products_ingredients_ingredients` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_products_ingredients_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_ingredients`
--

LOCK TABLES `products_ingredients` WRITE;
/*!40000 ALTER TABLE `products_ingredients` DISABLE KEYS */;
INSERT INTO `products_ingredients` VALUES (1,1,2),(1,4,1),(1,7,1),(1,12,1),(2,1,3),(2,6,2),(2,8,1),(2,12,1),(3,1,2),(3,3,1),(3,8,2),(3,12,1),(4,3,1),(4,5,1),(4,8,1),(4,12,2),(5,1,3),(5,4,1),(5,6,2),(5,12,1),(6,7,2),(6,8,1),(6,9,1),(6,10,1);
/*!40000 ALTER TABLE `products_ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `surnames` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (9,'Grace','Danford','graceh@mail.com','$2y$10$4u22ElpOjpe4vvQDcHP40eplJ6grFaYSg2q5tNUF8mRy9L32mrHEe','user','2024-12-03 15:21:01'),(10,'Xavi','Anguera','hankkock','$2y$10$nGUvG0FD70OGdezu/TWcWuXk/foIBBpfDOp5Yzuzsbjt88L4v5YFi','admin','2024-12-03 15:21:01'),(12,'Harry','James Potter','hpotter@hogwarts.com','$2y$10$D5HvRSkzCkAfbF/CY5tlHOBAzPHq4B4almrCMLxQ1iDSVHj5Rqwka','client','2024-12-03 15:21:01'),(13,'Karen','Moore','karenm','passwordhash13','user','2024-12-03 15:21:01'),(17,'Olivia','Adams','oliviaa','passwordhash17','user','2024-12-03 15:21:01'),(18,'Paul','Campbell','paulc','passwordhash18','user','2024-12-03 15:21:01'),(19,'Quinn','Reed','quinnr','passwordhash19','admin','2024-12-03 15:21:01'),(20,'Rachel','Bonham Carter','rachelw','$2y$10$fTGVaufGI.7QTOWLKF4waeSX0iIxMqaXqCTaCQjpRYrrsXcITjpoK','client','2024-12-03 15:21:01'),(21,'Test','App','test@app.com','$2y$10$c4eJ2pKgsfEtHF2CSxwTBeXCUBAhjyinefD6nD.8CvUk6le50u4km','admin','2024-12-11 15:12:46'),(22,'Arnau','Bestard','arnbest@gmail.com','$2y$10$2eucxNEcfyXHOgmwXJTSJOPGh.JkzO9kQRqehPoQ6mUSuybLfGidq','client','2025-01-01 01:28:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-08 16:20:42
