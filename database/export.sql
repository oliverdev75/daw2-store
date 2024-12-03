/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.18-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: restaurant
-- ------------------------------------------------------
-- Server version	9.0.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,'Flour',1.5,'2024-12-03 16:24:13'),(2,'Salt',0.5,'2024-12-03 16:24:13'),(3,'Pepper',0.75,'2024-12-03 16:24:13'),(4,'Milk',1.25,'2024-12-03 16:24:13'),(5,'Butter',1.75,'2024-12-03 16:24:13'),(6,'Eggs',2.5,'2024-12-03 16:24:13'),(7,'Tomatoes',1,'2024-12-03 16:24:13'),(8,'Onions',0.8,'2024-12-03 16:24:13'),(9,'Garlic',0.6,'2024-12-03 16:24:13'),(10,'Carrots',0.9,'2024-12-03 16:24:13'),(11,'Rice',1.1,'2024-12-03 16:24:13'),(12,'Oil',1.2,'2024-12-03 16:24:13');
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offers` (
  `id` int NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `discount` float NOT NULL,
  `beggining_date` date NOT NULL,
  `ending_date` date NOT NULL,
  PRIMARY KEY (`id`)
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
-- Table structure for table `order_line`
--

DROP TABLE IF EXISTS `order_line`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_line` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `ingredient_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_price` float NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`,`ingredient_id`),
  KEY `fk_order_line_products` (`product_id`),
  KEY `fk_order_line_ingredient` (`ingredient_id`),
  CONSTRAINT `fk_order_line_ingredient` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_order_line_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_order_line_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_line`
--

LOCK TABLES `order_line` WRITE;
/*!40000 ALTER TABLE `order_line` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_line` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_users` (`user_id`),
  CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `offer_id` int DEFAULT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_offers` (`offer_id`),
  CONSTRAINT `fk_products_offers` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Grilled Salmon',2,'2024-12-03 16:24:33'),(2,'Fried Cod',1,'2024-12-03 16:24:33'),(3,'Crispy Catfish',NULL,'2024-12-03 16:24:33'),(4,'Pan-Seared Tuna',3,'2024-12-03 16:24:33'),(5,'Beer-Battered Haddock',NULL,'2024-12-03 16:24:33'),(6,'Bouillabaisse',4,'2024-12-03 16:24:33'),(7,'Seafood Chowder',5,'2024-12-03 16:24:33'),(8,'Cioppino',NULL,'2024-12-03 16:24:33'),(9,'Fish Head Soup',6,'2024-12-03 16:24:33'),(10,'Salmon Bisque',7,'2024-12-03 16:24:33');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_ingredients`
--

DROP TABLE IF EXISTS `products_ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
INSERT INTO `products_ingredients` VALUES (1,1,2),(1,4,1),(1,7,1),(1,12,1),(2,1,3),(2,6,2),(2,8,1),(2,12,1),(3,1,2),(3,3,1),(3,8,2),(3,12,1),(4,3,1),(4,5,1),(4,8,1),(4,12,2),(5,1,3),(5,4,1),(5,6,2),(5,12,1),(6,7,2),(6,8,1),(6,9,1),(6,10,1),(7,4,2),(7,5,1),(7,8,1),(7,11,1),(8,3,1),(8,7,3),(8,8,1),(8,9,1),(9,7,1),(9,8,2),(9,10,1),(9,12,1),(10,4,2),(10,7,1),(10,8,1),(10,11,1);
/*!40000 ALTER TABLE `products_ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `surnames` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John','Doe','johndoe','passwordhash1','admin','2024-12-03 15:21:01'),(2,'Jane','Smith','janesmith','passwordhash2','user','2024-12-03 15:21:01'),(3,'Alice','Johnson','alicej','passwordhash3','user','2024-12-03 15:21:01'),(4,'Bob','Brown','bobbrown','passwordhash4','user','2024-12-03 15:21:01'),(5,'Charlie','Davis','charlied','passwordhash5','admin','2024-12-03 15:21:01'),(6,'David','Clark','davidc','passwordhash6','user','2024-12-03 15:21:01'),(7,'Eve','Miller','evem','passwordhash7','user','2024-12-03 15:21:01'),(8,'Frank','White','frankw','passwordhash8','user','2024-12-03 15:21:01'),(9,'Grace','Harris','graceh','passwordhash9','user','2024-12-03 15:21:01'),(10,'Hank','King','hankk','passwordhash10','admin','2024-12-03 15:21:01'),(11,'Ivy','Lee','ivyl','passwordhash11','user','2024-12-03 15:21:01'),(12,'Jack','Hall','jackh','passwordhash12','user','2024-12-03 15:21:01'),(13,'Karen','Moore','karenm','passwordhash13','user','2024-12-03 15:21:01'),(14,'Leo','Young','leoy','passwordhash14','admin','2024-12-03 15:21:01'),(15,'Megan','Allen','megana','passwordhash15','user','2024-12-03 15:21:01'),(16,'Nick','Scott','nicks','passwordhash16','user','2024-12-03 15:21:01'),(17,'Olivia','Adams','oliviaa','passwordhash17','user','2024-12-03 15:21:01'),(18,'Paul','Campbell','paulc','passwordhash18','user','2024-12-03 15:21:01'),(19,'Quinn','Reed','quinnr','passwordhash19','admin','2024-12-03 15:21:01'),(20,'Rachel','Walker','rachelw','passwordhash20','user','2024-12-03 15:21:01');
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

-- Dump completed on 2024-12-03 20:46:56
