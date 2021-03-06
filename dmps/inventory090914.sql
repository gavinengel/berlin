-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: inventory
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `item_properties`
--

DROP TABLE IF EXISTS `item_properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_properties` (
  `description` varchar(199) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `fk_item_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`),
  KEY `fk_item_id` (`fk_item_id`,`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_properties`
--

LOCK TABLES `item_properties` WRITE;
/*!40000 ALTER TABLE `item_properties` DISABLE KEYS */;
INSERT INTO `item_properties` VALUES (NULL,10,0,18,1,'0000-00-00 00:00:00'),(NULL,10,0,18,2,'2014-08-03 11:06:23'),(NULL,700,76,21,3,'2014-08-03 11:20:36'),(NULL,900,5555,23,4,'2014-08-03 11:44:54'),(NULL,3,77,72,6,'2014-08-03 14:50:13'),(NULL,54,88,80,7,'2014-08-04 01:47:01'),(NULL,54,88,82,8,'2014-08-04 01:57:15'),(NULL,0,99,84,9,'2014-08-04 03:52:49'),(NULL,0,99,85,10,'2014-08-04 03:56:37'),(NULL,0,88,86,11,'2014-08-04 03:56:53'),(NULL,3,0,87,12,'2014-08-04 05:06:45'),(NULL,3,0,89,13,'2014-08-04 05:11:58'),(NULL,3,0,91,14,'2014-08-04 05:14:52'),(NULL,3,0,93,15,'2014-08-04 05:15:26'),(NULL,3,0,95,16,'2014-08-04 05:16:11'),(NULL,3,0,97,17,'2014-08-04 05:18:00'),(NULL,33,11,99,18,'2014-08-04 14:46:36'),(NULL,3,9999,138,19,'2014-08-04 17:22:05'),(NULL,77,200,143,20,'2014-08-04 17:30:40'),(NULL,88,0,144,21,'2014-08-04 17:34:09'),(NULL,33,75,145,22,'2014-08-04 17:37:29'),(NULL,800,1000,146,23,'2014-08-05 21:06:22'),(NULL,1,200,147,24,'2014-08-05 21:08:32'),(NULL,3,4,148,25,'2014-08-05 21:09:01'),(NULL,1,0,149,26,'2014-08-05 21:20:28'),(NULL,1,0,150,27,'2014-08-05 21:21:05'),(NULL,1,0,151,28,'2014-08-05 21:21:59'),(NULL,6,1,152,29,'2014-08-05 21:27:35'),(NULL,6,1,153,30,'2014-08-05 21:27:53'),(NULL,3,3,154,31,'2014-08-05 21:44:10'),(NULL,3,3,155,32,'2014-08-05 21:46:24'),(NULL,3,3,156,33,'2014-08-05 21:46:49'),(NULL,3,3,157,34,'2014-08-05 21:47:37'),(NULL,1,100000,158,35,'2014-08-05 21:57:49'),(NULL,1,100000,159,36,'2014-08-05 21:59:51'),(NULL,1,100000,160,37,'2014-08-05 22:01:35'),(NULL,2,6,161,38,'2014-08-05 22:08:52'),(NULL,8000,0,162,39,'2014-08-05 22:10:06'),(NULL,8000,0,163,40,'2014-08-05 22:10:13'),(NULL,1,3,164,41,'2014-08-05 22:20:31'),(NULL,1,3,165,42,'2014-08-05 22:21:10'),(NULL,1,0,166,43,'2014-08-05 22:22:44'),(NULL,1,0,167,44,'2014-08-05 22:22:57'),(NULL,1,0,168,45,'2014-08-05 22:23:21'),(NULL,2,100,169,46,'2014-08-05 22:24:16'),(NULL,33,33,170,47,'2014-08-05 22:28:05'),(NULL,33,33,171,48,'2014-08-05 22:28:45'),(NULL,33,33,172,49,'2014-08-05 22:31:35'),(NULL,33,33,173,50,'2014-08-05 22:32:04'),(NULL,7,3000,174,51,'2014-08-06 06:51:20'),(NULL,1,5,175,52,'2014-08-06 07:53:10'),(NULL,1,200,177,53,'2014-08-07 04:57:01'),(NULL,1,5,178,54,'2014-08-07 05:03:58'),(NULL,1,7,179,55,'2014-08-08 03:18:11'),(NULL,3,100,180,56,'2014-08-08 03:29:30'),(NULL,1,77,181,57,'2014-08-08 03:44:40'),(NULL,1,1,184,58,'2014-08-08 04:02:47'),(NULL,3,77,185,59,'2014-08-08 04:03:40'),(NULL,3,33,187,60,'2014-08-08 04:04:56'),(NULL,1,0,189,61,'2014-08-08 04:07:43'),(NULL,80,700,191,62,'2014-08-08 04:39:53'),(NULL,1,22,192,63,'2014-08-08 05:58:51'),(NULL,33,33,193,64,'2014-08-08 06:13:07'),(NULL,23,23,194,65,'2014-08-08 06:13:30'),(NULL,1,0,223,66,'2014-08-08 08:26:44'),(NULL,7,77,242,67,'2014-08-08 09:54:31'),(NULL,3,800,243,68,'2014-08-09 23:38:59'),(NULL,3,2,245,69,'2014-08-09 23:56:02'),(NULL,3,2,246,70,'2014-08-09 23:56:12'),(NULL,2,200,247,71,'2014-08-10 00:37:51');
/*!40000 ALTER TABLE `item_properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(199) NOT NULL,
  `item_desc` varchar(199) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (192,'hat','green','2014-08-08 05:58:51'),(193,'pen','green 33','2014-08-08 06:13:07'),(194,'ee','ee','2014-08-08 06:13:30'),(195,'ee','','2014-08-08 07:10:30'),(196,'ee','','2014-08-08 07:10:31'),(197,'ee','','2014-08-08 07:10:32'),(198,'ee','','2014-08-08 07:10:33'),(199,'ee','','2014-08-08 07:10:34'),(200,'ee','','2014-08-08 07:10:34'),(202,'ee','','2014-08-08 07:10:34'),(203,'ee','','2014-08-08 07:10:34'),(204,'ee','','2014-08-08 07:10:35'),(205,'ee','','2014-08-08 07:10:35'),(206,'ee','','2014-08-08 07:10:36'),(207,'ee','','2014-08-08 07:10:37'),(208,'ee','','2014-08-08 07:10:37'),(209,'ee','','2014-08-08 07:10:38'),(210,'ee','','2014-08-08 07:10:38'),(211,'ee','','2014-08-08 07:10:42'),(212,'ee','ee','2014-08-08 07:10:48'),(213,'ee','ee','2014-08-08 07:10:50'),(214,'ee','ee','2014-08-08 07:10:53'),(215,'ee','ee','2014-08-08 07:10:54'),(216,'ee','ee','2014-08-08 07:10:55'),(217,'ee','ee','2014-08-08 07:10:58'),(218,'ee','ee','2014-08-08 07:10:58'),(219,'ee','ee','2014-08-08 07:11:00'),(220,'ee','ee','2014-08-08 07:11:00'),(221,'ee','ee','2014-08-08 07:11:00'),(222,'ee','ee','2014-08-08 07:11:01'),(223,'rug','brown','2014-08-08 08:26:44'),(242,'guppy','fish','2014-08-08 09:54:31'),(243,'desk','brown','2014-08-09 23:38:59'),(244,'asdfa','sdfasdfas','2014-08-09 23:42:21'),(245,'Blue Pen','this is a blue pen','2014-08-09 23:56:02'),(247,'dog','white','2014-08-10 00:37:51');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(199) DEFAULT NULL,
  `last_name` varchar(199) DEFAULT NULL,
  `address_line1` varchar(199) DEFAULT NULL,
  `address_line2` varchar(199) DEFAULT NULL,
  `city` varchar(199) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `postal` varchar(20) DEFAULT NULL,
  `ts` timestamp NOT NULL,
  `buyer` varchar(199) DEFAULT NULL,
  `email` varchar(199) DEFAULT NULL,
  `quantity` varchar(20) DEFAULT NULL,
  `fk_item_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-08-09 21:57:53
