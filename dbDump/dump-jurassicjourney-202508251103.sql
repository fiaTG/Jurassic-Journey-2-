-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: jurassicjourney
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `dinokontinent`
--

DROP TABLE IF EXISTS `dinokontinent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dinokontinent` (
  `DinoId` int(11) NOT NULL,
  `KontinentId` int(11) NOT NULL,
  PRIMARY KEY (`DinoId`,`KontinentId`),
  KEY `KontinentId` (`KontinentId`),
  CONSTRAINT `dinokontinent_ibfk_1` FOREIGN KEY (`DinoId`) REFERENCES `dinosaurier` (`DinoId`) ON DELETE CASCADE,
  CONSTRAINT `dinokontinent_ibfk_2` FOREIGN KEY (`KontinentId`) REFERENCES `kontinent` (`KontinentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dinokontinent`
--

LOCK TABLES `dinokontinent` WRITE;
/*!40000 ALTER TABLE `dinokontinent` DISABLE KEYS */;
INSERT INTO `dinokontinent` VALUES (6,1);
/*!40000 ALTER TABLE `dinokontinent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dinoperiode`
--

DROP TABLE IF EXISTS `dinoperiode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dinoperiode` (
  `DinoId` int(11) NOT NULL,
  `PeriodenId` int(11) NOT NULL,
  PRIMARY KEY (`DinoId`,`PeriodenId`),
  KEY `PeriodenId` (`PeriodenId`),
  CONSTRAINT `dinoperiode_ibfk_1` FOREIGN KEY (`DinoId`) REFERENCES `dinosaurier` (`DinoId`) ON DELETE CASCADE,
  CONSTRAINT `dinoperiode_ibfk_2` FOREIGN KEY (`PeriodenId`) REFERENCES `periode` (`PeriodenId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dinoperiode`
--

LOCK TABLES `dinoperiode` WRITE;
/*!40000 ALTER TABLE `dinoperiode` DISABLE KEYS */;
INSERT INTO `dinoperiode` VALUES (6,1);
/*!40000 ALTER TABLE `dinoperiode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dinosaurier`
--

DROP TABLE IF EXISTS `dinosaurier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dinosaurier` (
  `DinoId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Körpergröße` decimal(5,2) DEFAULT NULL,
  `GattungsId` int(11) DEFAULT NULL,
  `ErnährungsId` int(11) DEFAULT NULL,
  `Beschreibung` text DEFAULT NULL,
  PRIMARY KEY (`DinoId`),
  KEY `GattungsId` (`GattungsId`),
  KEY `ErnährungsId` (`ErnährungsId`),
  CONSTRAINT `dinosaurier_ibfk_1` FOREIGN KEY (`GattungsId`) REFERENCES `gattung` (`GattungsId`),
  CONSTRAINT `dinosaurier_ibfk_2` FOREIGN KEY (`ErnährungsId`) REFERENCES `ernährung` (`ErnährungsId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dinosaurier`
--

LOCK TABLES `dinosaurier` WRITE;
/*!40000 ALTER TABLE `dinosaurier` DISABLE KEYS */;
INSERT INTO `dinosaurier` VALUES (6,'defaultModel',9.99,1,1,'TestModel');
/*!40000 ALTER TABLE `dinosaurier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dreidmodell`
--

DROP TABLE IF EXISTS `dreidmodell`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dreidmodell` (
  `ModellId` int(11) NOT NULL AUTO_INCREMENT,
  `DinoId` int(11) DEFAULT NULL,
  `ModellPfad` varchar(255) DEFAULT NULL,
  `Beschreibung` text DEFAULT NULL,
  `Erstellungsdatum` date DEFAULT NULL,
  PRIMARY KEY (`ModellId`),
  KEY `DinoId` (`DinoId`),
  CONSTRAINT `dreidmodell_ibfk_1` FOREIGN KEY (`DinoId`) REFERENCES `dinosaurier` (`DinoId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dreidmodell`
--

LOCK TABLES `dreidmodell` WRITE;
/*!40000 ALTER TABLE `dreidmodell` DISABLE KEYS */;
INSERT INTO `dreidmodell` VALUES (6,6,'uploads/Trex1.glb',NULL,'2025-08-25');
/*!40000 ALTER TABLE `dreidmodell` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ernährung`
--

DROP TABLE IF EXISTS `ernährung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ernährung` (
  `ErnährungsId` int(11) NOT NULL AUTO_INCREMENT,
  `Ernährungsbezeichnung` varchar(100) NOT NULL,
  PRIMARY KEY (`ErnährungsId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ernährung`
--

LOCK TABLES `ernährung` WRITE;
/*!40000 ALTER TABLE `ernährung` DISABLE KEYS */;
INSERT INTO `ernährung` VALUES (1,'Karnivor'),(2,'Herbivor'),(3,'Omnivor');
/*!40000 ALTER TABLE `ernährung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gattung`
--

DROP TABLE IF EXISTS `gattung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gattung` (
  `GattungsId` int(11) NOT NULL AUTO_INCREMENT,
  `Gattungsbezeichnung` varchar(100) NOT NULL,
  PRIMARY KEY (`GattungsId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gattung`
--

LOCK TABLES `gattung` WRITE;
/*!40000 ALTER TABLE `gattung` DISABLE KEYS */;
INSERT INTO `gattung` VALUES (1,'Theropoda'),(2,'Sauropoda'),(3,'Ornithopoda'),(4,'Stegosauria'),(5,'Ankylosauria'),(6,'Ceratopsia');
/*!40000 ALTER TABLE `gattung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kontinent`
--

DROP TABLE IF EXISTS `kontinent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kontinent` (
  `KontinentId` int(11) NOT NULL AUTO_INCREMENT,
  `Kontinentbezeichnung` varchar(100) NOT NULL,
  PRIMARY KEY (`KontinentId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kontinent`
--

LOCK TABLES `kontinent` WRITE;
/*!40000 ALTER TABLE `kontinent` DISABLE KEYS */;
INSERT INTO `kontinent` VALUES (1,'Afrika'),(2,'Asien'),(3,'Europa'),(4,'Nordamerika'),(5,'Südamerika'),(6,'Australien'),(7,'Antarktis');
/*!40000 ALTER TABLE `kontinent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periode`
--

DROP TABLE IF EXISTS `periode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periode` (
  `PeriodenId` int(11) NOT NULL AUTO_INCREMENT,
  `Periodenname` varchar(100) NOT NULL,
  `ZeitraumStart` int(11) DEFAULT NULL,
  `ZeitraumEnde` int(11) DEFAULT NULL,
  PRIMARY KEY (`PeriodenId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periode`
--

LOCK TABLES `periode` WRITE;
/*!40000 ALTER TABLE `periode` DISABLE KEYS */;
INSERT INTO `periode` VALUES (1,'Trias',252,201),(2,'Jura',201,145),(3,'Kreide',145,66);
/*!40000 ALTER TABLE `periode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'jurassicjourney'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-25 11:03:25
