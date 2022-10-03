DROP DATABASE IF EXISTS mupin;
CREATE DATABASE IF NOT EXISTS mupin;
CREATE USER IF NOT EXISTS 'mupin'@'localhost' IDENTIFIED BY 'mupin';
GRANT ALL ON mupin.* TO 'mupin'@'localhost';
USE mupin;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `libro` (
  `ID_CATALOGO` char(20) NOT NULL,
  `TITOLO` varchar(255) NOT NULL,
  `AUTORI` varchar(255) NOT NULL,
  `CASA_EDITRICE` varchar(255) NOT NULL,
  `ANNO` int NOT NULL,
  `NUMERO_PAGINE` int DEFAULT NULL,
  `ISBN` char(13) DEFAULT NULL,
  `NOTE` text,
  `URL` varchar(255) DEFAULT NULL,
  `TAG` text,
  PRIMARY KEY (`ID_CATALOGO`),
  UNIQUE KEY `id_catalogo` (`ID_CATALOGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES ('1ALIB','Il Signore degli Anelli','J.R.R. Tolkienn','Mondadori',1956,625,NULL,NULL,NULL,NULL),('1BLIB','HarryPotter e la camera delle polpette','JK Rowling','Miraflower',1901,512,'A245DFNKSN',NULL,NULL,NULL),('1CLIB','Le cronache di Narnia','Lewis','TuaMadre',1978,NULL,NULL,NULL,NULL,NULL),('1DLIB','La storia di Huawei','Jon Li Xu','CinCinXi',2018,544,'A245DFNKSNFJ',NULL,NULL,NULL);
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
-- Table structure for table `rivista`
--

DROP TABLE IF EXISTS `rivista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rivista` (
  `ID_CATALOGO` char(20) NOT NULL,
  `TITOLO` varchar(255) NOT NULL,
  `NUMERO_RIVISTA` int NOT NULL,
  `ANNO` int NOT NULL,
  `CASA_EDITRICE` varchar(255) NOT NULL,
  `NOTE` text,
  `URL` varchar(255) DEFAULT NULL,
  `TAG` text,
  PRIMARY KEY (`ID_CATALOGO`),
  UNIQUE KEY `id_catalogo` (`ID_CATALOGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rivista`
--

LOCK TABLES `rivista` WRITE;
/*!40000 ALTER TABLE `rivista` DISABLE KEYS */;
INSERT INTO `rivista` VALUES ('1ARIV','Windows dal 90 ad oggi',2,2018,'Mondadori',NULL,NULL,NULL),('1ARIV-AVV45','Le avventure di Mr M',0,1995,'Editori & Co',NULL,NULL,NULL),('1BRIV','Huawei dal 90 ad oggi',3,2017,'Mondadori',NULL,NULL,NULL),('1CRIV','HP dal 90 ad oggi',3,2022,'Feltrinelli',NULL,NULL,NULL),('1DRIV','Apple dal 90 ad oggi',1,2017,'La Casa Blu',NULL,NULL,NULL);
/*!40000 ALTER TABLE `rivista` ENABLE KEYS */;
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
-- Table structure for table `software`
--

DROP TABLE IF EXISTS `software`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `software` (
  `ID_CATALOGO` char(20) NOT NULL,
  `TITOLO` varchar(255) NOT NULL,
  `SISTEMA_OPERATIVO` varchar(255) NOT NULL,
  `TIPOLOGIA` varchar(255) NOT NULL,
  `SUPPORTO` varchar(255) NOT NULL,
  `NOTE` text,
  `URL` varchar(255) DEFAULT NULL,
  `TAG` text,
  PRIMARY KEY (`ID_CATALOGO`),
  UNIQUE KEY `id_catalogo` (`ID_CATALOGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `software`
--

LOCK TABLES `software` WRITE;
/*!40000 ALTER TABLE `software` DISABLE KEYS */;
INSERT INTO `software` VALUES ('1ASOFTWAREWIN','Docker','Linux','Container','Qualsiasi',NULL,NULL,NULL),('2A-SOFTWARE-1X34AP56','Microsoft App.piu.pper','Linux Redhat','Gestionale','PC',NULL,NULL,NULL);
/*!40000 ALTER TABLE `software` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-27 22:39:51

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
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES (1,'pippo@gmail.com','$2y$10$AENFepmFKcfkKe8RDWO62OYlkQytUXpj.S1yKc1iKDUio.zwAkVJC'),(2,'pluto@gmail.com','$2y$10$wwprvpQxOxNulFitB4qFUO8XUIa8TL8qUfAI/i1nqzSRP7Gt.M0Jq'),(4,'paperino@gmail.com','$2y$10$JXbOXdzLSB2y9Gn38DBMW.jccK.2QpadnrHUYw8.tlqaoSE87Gu2C'),(5,'topolino@gmail.com','$2y$10$qWAkWTxkEgVR42nBxndg.uYrrkepLCzlZ5rBEWI8Rj2IS90KMfMxW'),(6,'minnie@gmail.com','$2y$10$DjfUrclKoSuwrRKhaBym9OoHuDq5D9FNcawD.Ap5cRN9MM6Yi26AO'),(7,'gastone@gmail.com','$2y$10$sT8DfvJ7cMN36oJUT.d/auvSs1oNDUaM9Gqlg4L3BFkxb3vEmGyCi'),(8,'paperone@gmail.com','$2y$10$j8TyFVqO9btWvxvzR4GRa.CgttuFscGe81GA23pMWMC/sYyNroPNm'),(9,'topolina@gmail.com','$2y$10$N3fEjOXs7vt11N/lkbnrDeNYzpQ007Um25LYCx3xtSEwnoeMt8yuO'),(10,'qui@gmail.com','$2y$10$mOTVBVNc0FTnXdJBX5hw4epWlf9FjkbSp9qsuUJY.jDJ0zZIxweJi');
/*!40000 ALTER TABLE `utente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-27 22:39:51