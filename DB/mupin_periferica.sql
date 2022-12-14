-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: mupin
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
-- Table structure for table `periferica`
--

DROP TABLE IF EXISTS `periferica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periferica` (
  `ID_CATALOGO` char(20) NOT NULL,
  `MODELLO` varchar(255) NOT NULL,
  `TIPOLOGIA` varchar(255) NOT NULL,
  `NOTE` text,
  `URL` varchar(255) DEFAULT NULL,
  `TAG` text,
  PRIMARY KEY (`ID_CATALOGO`),
  UNIQUE KEY `id_catalogo` (`ID_CATALOGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periferica`
--

LOCK TABLES `periferica` WRITE;
/*!40000 ALTER TABLE `periferica` DISABLE KEYS */;
INSERT INTO `periferica` VALUES ('1APER-MOUSE','Mouse Topolino','Mouse','Questo è un mouse',NULL,NULL),('1BPER','HP Mouse','Mouse',NULL,NULL,NULL),('1CPER','HP Keyboard','Tastiera','Questa è una nota di prova',NULL,NULL),('1DPER','HUAWEI Altoparlanti','Altoparlanti',NULL,NULL,NULL),('2APER-MOUSE','Mouse Pippo','Mouse','Questo è un altro mouse',NULL,NULL);
/*!40000 ALTER TABLE `periferica` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-27 22:39:52
