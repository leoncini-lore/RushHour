
DROP DATABASE if exists RushHour;
CREATE DATABASE  RushHour;
USE  RushHour;
-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: RushHour
-- ------------------------------------------------------
-- Server version	5.7.33-0ubuntu0.16.04.1

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
-- Table structure for table `Games`
--

DROP TABLE IF EXISTS `Games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` smallint(2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Games`
--

LOCK TABLES `Games` WRITE;
/*!40000 ALTER TABLE `Games` DISABLE KEYS */;
INSERT INTO `Games` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,2),(7,2),(8,2),(9,2),(10,2),(11,3),(12,3),(13,3),(14,3),(15,3),(16,4),(17,4),(18,4),(19,4),(20,4);
/*!40000 ALTER TABLE `Games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Levels`
--

DROP TABLE IF EXISTS `Levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Levels` (
  `user` int(11) NOT NULL,
  `game` int(11) NOT NULL,
  `moves` smallint(3) unsigned NOT NULL,
  KEY `users_fk2` (`user`),
  KEY `games_fk2` (`game`),
  CONSTRAINT `games_fk2` FOREIGN KEY (`game`) REFERENCES `Games` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `users_fk2` FOREIGN KEY (`user`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Levels`
--

LOCK TABLES `Levels` WRITE;
/*!40000 ALTER TABLE `Levels` DISABLE KEYS */;
/*!40000 ALTER TABLE `Levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Logs`
--

DROP TABLE IF EXISTS `Logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Logs` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL,
  KEY `Logs_ibfk_1` (`user_id`),
  CONSTRAINT `Logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Pieces`
--

DROP TABLE IF EXISTS `Pieces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pieces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `length` tinyint(1) unsigned NOT NULL,
  `orientation` enum('H','V') NOT NULL,
  `position` tinyint(2) unsigned NOT NULL,
  `color` enum('red','darkblue','green','grey','black','yellow','purple','orange','lightblue','lightgreen','lightpink','darkblue','blue','brown','violet','olive','aqua','gold') NOT NULL,
  `game` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `games_fk1` (`game`),
  CONSTRAINT `games_fk1` FOREIGN KEY (`game`) REFERENCES `Games` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pieces`
--

LOCK TABLES `Pieces` WRITE;
/*!40000 ALTER TABLE `Pieces` DISABLE KEYS */;
INSERT INTO `Pieces` VALUES (1,2,'H',13,'red',1),(2,2,'V',24,'orange',1),(3,3,'V',6,'violet',1),(4,2,'H',0,'lightgreen',1),(5,3,'V',9,'darkblue',1),(6,2,'H',28,'blue',1),(7,3,'H',32,'green',1),(8,3,'V',5,'gold',1),(9,2,'V',0,'lightgreen',2),(10,2,'H',12,'red',2),(11,3,'H',18,'darkblue',2),(12,2,'H',30,'green',2),(13,2,'V',26,'lightpink',2),(14,2,'H',33,'black',2),(15,2,'H',28,'purple',2),(16,3,'V',11,'violet',2),(17,3,'H',3,'gold',2),(18,2,'V',9,'orange',2),(19,2,'V',16,'blue',2),(20,3,'V',0,'gold',4),(21,2,'H',13,'red',4),(22,2,'V',20,'lightgreen',4),(23,3,'H',32,'aqua',4),(24,2,'V',29,'orange',4),(25,3,'H',21,'darkblue',4),(26,3,'V',3,'violet',4),(27,2,'H',13,'red',3),(28,2,'H',19,'lightgreen',3),(29,2,'V',25,'orange',3),(30,2,'H',32,'blue',3),(31,3,'V',15,'gold',3),(32,3,'V',23,'violet',3),(33,2,'H',0,'lightgreen',5),(34,3,'V',3,'gold',5),(35,2,'V',5,'orange',5),(36,3,'V',6,'violet',5),(37,3,'V',10,'darkblue',5),(38,2,'H',13,'red',5),(39,2,'V',17,'black',5),(40,3,'H',19,'aqua',5),(41,2,'V',24,'lightpink',5),(42,2,'H',28,'purple',5),(43,2,'H',34,'green',5),(44,3,'V',0,'gold',6),(45,2,'H',1,'lightgreen',6),(46,3,'V',3,'violet',6),(47,2,'H',13,'red',6),(48,2,'V',20,'orange',6),(49,3,'H',21,'darkblue',6),(50,2,'V',29,'purple',6),(51,3,'H',32,'aqua',6),(52,2,'V',0,'lightgreen',7),(53,2,'H',1,'orange',7),(54,3,'V',5,'gold',7),(55,2,'H',12,'red',7),(56,3,'V',8,'violet',7),(57,3,'H',21,'darkblue',7),(58,3,'H',30,'aqua',7),(59,2,'V',28,'blue',7),(60,2,'H',0,'lightgreen',8),(61,2,'H',2,'orange',8),(62,2,'V',4,'blue',8),(63,2,'V',8,'lightpink',8),(64,3,'V',11,'gold',8),(65,2,'V',13,'purple',8),(66,2,'H',15,'red',8),(67,3,'V',18,'violet',8),(68,2,'H',21,'green',8),(69,2,'V',27,'black',8),(70,2,'H',28,'grey',8),(71,2,'H',31,'yellow',8),(72,2,'H',34,'olive',8),(73,2,'H',0,'lightgreen',9),(74,2,'V',2,'orange',9),(75,2,'H',10,'blue',9),(76,2,'V',12,'lightpink',9),(77,2,'V',13,'purple',9),(78,2,'H',14,'red',9),(79,2,'V',16,'green',9),(80,2,'V',17,'black',9),(81,2,'H',20,'grey',9),(82,2,'V',26,'yellow',9),(83,2,'H',28,'brown',9),(84,2,'H',30,'olive',9),(85,2,'H',1,'lightgreen',10),(86,2,'H',3,'orange',10),(87,2,'H',6,'blue',10),(88,2,'H',8,'lightpink',10),(89,3,'V',10,'gold',10),(90,3,'V',11,'violet',10),(91,3,'V',12,'darkblue',10),(92,3,'V',13,'aqua',10),(93,2,'H',14,'red',10),(94,2,'V',20,'purple',10),(95,2,'V',21,'green',10),(96,2,'H',28,'black',10),(97,2,'H',31,'grey',10),(98,2,'H',33,'yellow',10),(99,2,'H',0,'lightgreen',11),(100,2,'V',2,'orange',11),(101,3,'V',3,'yellow',11),(102,3,'V',6,'violet',11),(103,2,'H',13,'red',11),(104,3,'H',19,'darkblue',11),(105,3,'H',33,'aqua',11),(106,2,'V',2,'lightgreen',12),(107,3,'H',3,'gold',12),(108,2,'V',6,'orange',12),(109,3,'V',9,'violet',12),(110,2,'H',10,'blue',12),(111,2,'H',13,'red',12),(112,2,'V',19,'lightpink',12),(113,2,'H',22,'purple',12),(114,2,'V',24,'green',12),(115,2,'H',26,'black',12),(116,2,'V',29,'grey',12),(117,3,'H',31,'darkblue',12),(118,3,'H',2,'gold',13),(119,3,'V',5,'violet',13),(120,2,'V',8,'lightgreen',13),(121,2,'H',9,'orange',13),(122,2,'H',15,'red',13),(123,2,'V',20,'blue',13),(124,2,'V',21,'lightpink',13),(125,2,'H',22,'purple',13),(126,2,'H',28,'green',13),(127,3,'H',32,'darkblue',13),(128,2,'V',2,'lightgreen',14),(129,2,'H',3,'orange',14),(130,2,'V',7,'blue',14),(131,2,'V',12,'lightpink',14),(132,2,'H',14,'red',14),(133,2,'V',16,'purple',14),(134,2,'H',19,'green',14),(135,3,'H',24,'gold',14),(136,2,'V',28,'black',14),(137,2,'H',24,'grey',14),(138,2,'H',0,'lightgreen',15),(139,2,'V',2,'orange',15),(140,2,'H',4,'blue',15),(141,2,'H',6,'lightpink',15),(142,3,'V',11,'gold',15),(143,3,'V',12,'violet',15),(144,2,'H',13,'red',15),(145,2,'V',16,'purple',15),(146,3,'H',19,'darkblue',15),(147,2,'V',25,'green',15),(148,2,'V',27,'black',15),(149,2,'H',28,'grey',15),(150,2,'H',34,'yellow',15),(151,2,'H',0,'lightgreen',16),(152,3,'H',3,'gold',16),(153,2,'V',9,'orange',16),(154,2,'H',10,'blue',16),(155,2,'V',12,'lightpink',16),(156,2,'H',13,'red',16),(157,3,'V',17,'violet',16),(158,3,'V',20,'darkblue',16),(159,2,'H',21,'purple',16),(160,2,'H',24,'green',16),(161,3,'H',33,'aqua',16),(162,2,'H',0,'lightgreen',17),(163,3,'V',2,'gold',17),(164,2,'V',3,'orange',17),(165,2,'H',4,'blue',17),(166,2,'H',12,'red',17),(167,2,'V',18,'lightpink',17),(168,2,'H',19,'purple',17),(169,2,'H',21,'green',17),(170,3,'V',23,'violet',17),(171,2,'V',27,'black',17),(172,2,'H',30,'grey',17),(173,2,'V',1,'lightgreen',18),(174,3,'V',2,'aqua',18),(175,2,'H',4,'orange',18),(176,2,'H',12,'red',18),(177,2,'V',18,'yellow',18),(178,2,'H',19,'lightpink',18),(179,2,'H',21,'purple',18),(180,3,'V',23,'violet',18),(181,2,'H',25,'green',18),(182,2,'V',27,'black',18),(183,2,'V',28,'grey',18),(184,3,'H',30,'darkblue',18),(185,2,'V',0,'lightgreen',19),(186,3,'H',3,'aqua',19),(187,2,'V',9,'orange',19),(188,3,'V',11,'violet',19),(189,2,'H',12,'red',19),(190,2,'V',16,'blue',19),(191,3,'H',18,'darkblue',19),(192,2,'V',21,'lightpink',19),(193,2,'V',26,'purple',19),(194,2,'H',28,'green',19),(195,2,'H',30,'yellow',19),(196,2,'H',33,'grey',19),(197,3,'V',2,'gold',20),(198,2,'H',3,'lightgreen',20),(199,3,'V',5,'violet',20),(200,2,'H',12,'red',20),(201,2,'V',9,'orange',20),(202,2,'V',18,'olive',20),(203,3,'H',19,'darkblue',20),(204,2,'H',25,'lightpink',20),(205,2,'V',27,'purple',20),(206,2,'V',28,'green',20),(207,2,'H',30,'black',20);
/*!40000 ALTER TABLE `Pieces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` char(128) NOT NULL,
  `privileges` enum('admin','creator','player') NOT NULL DEFAULT 'player',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'lorenzo','leoncinilorenzo03@gmail.com','$2y$12$eKZy8X8TJ9ZGvOLQ8Tuzc.u5XQIA1TVL9uZCGYrbrZh1Lm8VyJl9O','admin');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-07 10:26:48