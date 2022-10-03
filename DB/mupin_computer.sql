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
-- Table structure for table `computer`
--

DROP TABLE IF EXISTS `computer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `computer` (
  `ID_CATALOGO` char(20) NOT NULL,
  `MODELLO` varchar(255) NOT NULL,
  `ANNO` int NOT NULL,
  `CPU` varchar(255) NOT NULL,
  `VELOCITA_CPU` float NOT NULL,
  `MEMORIA_RAM` int NOT NULL,
  `DIMENSIONE_HARD_DISK` int DEFAULT NULL,
  `SISTEMA_OPERATIVO` varchar(255) DEFAULT NULL,
  `NOTE` text,
  `URL` varchar(255) DEFAULT NULL,
  `TAG` text,
  PRIMARY KEY (`ID_CATALOGO`),
  UNIQUE KEY `id_catalogo` (`ID_CATALOGO`),
  KEY `fk_os` (`SISTEMA_OPERATIVO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computer`
--

LOCK TABLES `computer` WRITE;
/*!40000 ALTER TABLE `computer` DISABLE KEYS */;
INSERT INTO `computer` VALUES ('1ACOMPUTERASUS','ASUS - Zenbook Duo',2022,'Intel Core i7',3,16,512,'Windows 11 Pro',NULL,NULL,NULL),('1BCOMPUTERHUAWEI','HUAWEI - Matebook D14',2021,'AMD Rizen 5',2.5,16,512,'Almalinux','Questa è una nota di prova',NULL,NULL),('1CCOMPUTERHP','HP - New HP',2011,'Intel Core i7',2.5,8,256,'Linux Ubuntu','Questa è una nota di prova','https://www.youtube.com/watch?v=KvNCDyoHYmQ',NULL),('1DCOMPUTERHUAWEI','Microsoft - Surface Pro 7',2021,'Intel Core 15',2.5,8,256,'Windows XP','Questa è una nota di prova','https://www.microsoft.com/it-it/d/surface-pro-7/92wrlrcvz4pr?activetab=pivot:informazionigeneralitab','#Microsoft #Surface #Pro'),('1ECOMPUTERHP','HP - Pavillon',2019,'AMD Rizen 5',2.1,8,512,'Windows 10',NULL,NULL,NULL),('1HCOMPUTERAPPLE','APPLE - MacBook Air',2020,'Apple M',2.5,8,256,'macOS Big Sur',NULL,NULL,NULL),('2ACOMPUTER-ASUS','ASUS - BlackNote',2017,'Intel i7',2.8,16,NULL,NULL,NULL,NULL,NULL),('2BCOMPUTER-ASUS','ASUS - BackNote2 Modificato',2017,'Intel i7',2.8,16,512,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `computer` ENABLE KEYS */;
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
