-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: flats
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.16.04.1

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
-- Table structure for table `flats`
--

DROP TABLE IF EXISTS `flats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flats` (
  `id` varchar(36) NOT NULL,
  `price` int(4) unsigned DEFAULT NULL,
  `Column 3` int(4) unsigned DEFAULT NULL,
  `bedrooms` int(2) unsigned DEFAULT NULL,
  `bathrooms` int(2) unsigned DEFAULT NULL,
  `parking` int(2) unsigned DEFAULT NULL,
  `heroText` varchar(100) DEFAULT NULL,
  `agent` varchar(100) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateAvailable` date NOT NULL,
  `dateRemoved` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pets` int(1) unsigned DEFAULT '0',
  `address` varchar(150) DEFAULT NULL,
  `latitude` float(11,3) DEFAULT NULL,
  `longtitude` float(11,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flats`
--

LOCK TABLES `flats` WRITE;
/*!40000 ALTER TABLE `flats` DISABLE KEYS */;
/*!40000 ALTER TABLE `flats` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-18  2:02:03
