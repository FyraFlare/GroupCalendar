-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: groupCalendar
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

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
-- Current Database: `groupCalendar`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `groupcalendar` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `groupCalendar`;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `creator` varchar(20) NOT NULL,
  `event` varchar(350) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `lasts` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES ('&lt;%= Session[&quot','new',2016,11,1,12,'All Day'),('undefined','test user',2016,10,31,12,'All Day'),('Sean-Added-By-Functi','back to hard coded creator',2016,11,1,12,'All Day'),('function (a){return ','new',2016,10,31,12,'All Day'),('','not hard-coded',2016,10,31,12,'All Day'),('\nNotice:  Undefined ','new',2016,11,1,12,'All Day'),('&lt;%= Session[&quot','Enter Title Here',2016,11,1,12,'All Day'),('Sean','new',2016,11,8,12,'All Day');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `new_events`
--

DROP TABLE IF EXISTS `new_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `new_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(350) NOT NULL DEFAULT '',
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `url` varchar(255) NOT NULL,
  `allDay` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `new_events`
--

LOCK TABLES `new_events` WRITE;
/*!40000 ALTER TABLE `new_events` DISABLE KEYS */;
INSERT INTO `new_events` VALUES (1,'new','2016-11-01 00:00:00','2016-11-02 00:00:00','null',''),(2,'another','2016-11-10 00:00:00','2016-11-11 00:00:00','null',''),(3,'Another Event','2016-11-03 00:00:00','2016-11-04 00:00:00','www.google.com','');
/*!40000 ALTER TABLE `new_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL DEFAULT '',
  `password` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'sean','$2y$10$aJrpLEMLlCYcsIh9bGbivuf96bBl7NNN2t8n473CVdcHWe8mP2ZiS'),(2,'sean2','$2y$10$z4SSlpuHMn1uLATTztXdqOcGf.ucyk0xm8PHeuXfzm7EaMF5NiS2W'),(3,'sean3','$2y$10$0LES1wIYSgOn4euG2TLTXepfj7ztqA7O9GZu6NqHsIA4uJQkeuNLa'),(4,'sean7','$2y$10$h8VxlHOs2RW8NgFDf.VSPOZfK6e5lYJ359CFlOseHbI7Bc5hmUclS');
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

-- Dump completed on 2016-11-29  3:47:23
