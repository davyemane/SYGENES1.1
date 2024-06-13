-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: SYGENES1
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.20.04.1

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
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20240612082311','2024-06-12 08:23:17',39153);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ec`
--

DROP TABLE IF EXISTS `ec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ec` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ue_id` int DEFAULT NULL,
  `code_ec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8DE8BDFF62E883B1` (`ue_id`),
  CONSTRAINT `FK_8DE8BDFF62E883B1` FOREIGN KEY (`ue_id`) REFERENCES `ue` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ec`
--

LOCK TABLES `ec` WRITE;
/*!40000 ALTER TABLE `ec` DISABLE KEYS */;
INSERT INTO `ec` VALUES (1,1,'sna1254','info',NULL,3),(2,2,'alg2345','math',NULL,3);
/*!40000 ALTER TABLE `ec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `field`
--

DROP TABLE IF EXISTS `field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `field` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field`
--

LOCK TABLES `field` WRITE;
/*!40000 ALTER TABLE `field` DISABLE KEYS */;
INSERT INTO `field` VALUES (1,'ISN','Ingenierie des Systèmes Numerique','filiere'),(2,'INS','Ingenierie Numerique Sociotechnique',NULL),(3,'CDN','Creation et Disign Numerique',NULL);
/*!40000 ALTER TABLE `field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `field_ue`
--

DROP TABLE IF EXISTS `field_ue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `field_ue` (
  `field_id` int NOT NULL,
  `ue_id` int NOT NULL,
  PRIMARY KEY (`field_id`,`ue_id`),
  KEY `IDX_D5476A7B443707B0` (`field_id`),
  KEY `IDX_D5476A7B62E883B1` (`ue_id`),
  CONSTRAINT `FK_D5476A7B443707B0` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D5476A7B62E883B1` FOREIGN KEY (`ue_id`) REFERENCES `ue` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field_ue`
--

LOCK TABLES `field_ue` WRITE;
/*!40000 ALTER TABLE `field_ue` DISABLE KEYS */;
/*!40000 ALTER TABLE `field_ue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level`
--

DROP TABLE IF EXISTS `level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `level` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level`
--

LOCK TABLES `level` WRITE;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` VALUES (1,'L1'),(2,'L2'),(3,'L3'),(4,'M1'),(5,'M2');
/*!40000 ALTER TABLE `level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `note` (
  `id` int NOT NULL AUTO_INCREMENT,
  `createb_by_id` int DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `ec_id` int DEFAULT NULL,
  `cc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rattrapage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CFBDFA14D3EAB6BC` (`createb_by_id`),
  KEY `IDX_CFBDFA14CB944F1A` (`student_id`),
  KEY `IDX_CFBDFA1427634BEF` (`ec_id`),
  CONSTRAINT `FK_CFBDFA1427634BEF` FOREIGN KEY (`ec_id`) REFERENCES `ec` (`id`),
  CONSTRAINT `FK_CFBDFA14CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  CONSTRAINT `FK_CFBDFA14D3EAB6BC` FOREIGN KEY (`createb_by_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note`
--

LOCK TABLES `note` WRITE;
/*!40000 ALTER TABLE `note` DISABLE KEYS */;
INSERT INTO `note` VALUES (1,13,1,2,'12','10','48',NULL,'12-06-24','1');
/*!40000 ALTER TABLE `note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responsable`
--

DROP TABLE IF EXISTS `responsable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `responsable` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_by_id` int DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_52520D07B03A8386` (`created_by_id`),
  CONSTRAINT `FK_52520D07B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsable`
--

LOCK TABLES `responsable` WRITE;
/*!40000 ALTER TABLE `responsable` DISABLE KEYS */;
/*!40000 ALTER TABLE `responsable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `id` int NOT NULL AUTO_INCREMENT,
  `field_id` int DEFAULT NULL,
  `level_id` int DEFAULT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` longtext COLLATE utf8mb4_unicode_ci,
  `birth_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admission_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B723AF33443707B0` (`field_id`),
  KEY `IDX_B723AF335FB14BA7` (`level_id`),
  CONSTRAINT `FK_B723AF33443707B0` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`),
  CONSTRAINT `FK_B723AF335FB14BA7` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,1,1,NULL,'Tapiba ','tapiba@gmail.com','666666666',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `take_ue`
--

DROP TABLE IF EXISTS `take_ue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `take_ue` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int DEFAULT NULL,
  `grade` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `ue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AC89C73DCB944F1A` (`student_id`),
  CONSTRAINT `FK_AC89C73DCB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `take_ue`
--

LOCK TABLES `take_ue` WRITE;
/*!40000 ALTER TABLE `take_ue` DISABLE KEYS */;
/*!40000 ALTER TABLE `take_ue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ue`
--

DROP TABLE IF EXISTS `ue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ue` (
  `id` int NOT NULL AUTO_INCREMENT,
  `level_id` int DEFAULT NULL,
  `code_ue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit` int DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2E490A9B5FB14BA7` (`level_id`),
  CONSTRAINT `FK_2E490A9B5FB14BA7` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ue`
--

LOCK TABLES `ue` WRITE;
/*!40000 ALTER TABLE `ue` DISABLE KEYS */;
INSERT INTO `ue` VALUES (1,1,'sna124','Algo1',5,NULL,'1'),(2,5,'Math134','Algoritmique',6,NULL,'2');
/*!40000 ALTER TABLE `ue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` int DEFAULT NULL,
  `responsable_id` int DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_USERNAME` (`username`),
  UNIQUE KEY `UNIQ_8D93D649CB944F1A` (`student_id`),
  UNIQUE KEY `UNIQ_8D93D64953C59D72` (`responsable_id`),
  CONSTRAINT `FK_8D93D64953C59D72` FOREIGN KEY (`responsable_id`) REFERENCES `responsable` (`id`),
  CONSTRAINT `FK_8D93D649CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (13,'davyEmane','[\"ROLE_ADMIN\"]','$2y$13$oMWFueqB4Vz4STn34Abb6uYgyVMZ2OcrsarOZjo5isQhoB3z8WPU2',NULL,NULL,NULL,NULL),(14,'Emane','[\"ROLE_ADMIN\"]','$2y$13$e9.7ocoSG/hsdXjdXk0uDef2UvWLTE1mUgVrw7ca5HE1PXGKEWS3q',NULL,NULL,NULL,NULL),(15,'bile0','[]','$2y$13$94bvm/YO.pAsgrIfAJybau669yUXtsWi0lFUhXYf4pAsnO6KN/2Bq',NULL,NULL,NULL,NULL),(16,'bile1','[]','$2y$13$jhLYWTaFXlnjS7wXeGphiudluicMu91mNSF/fi3gnpFgrISd7Lzyy',NULL,NULL,NULL,NULL),(17,'bile2','[]','$2y$13$2flcrkdtKWhXAnGVNLUR2eWQUR3IeuqGXnORke6el6pMIbcTRl.Pq',NULL,NULL,NULL,NULL),(18,'bile3','[]','$2y$13$6jM7.gVYZp1QxjiALesgz.xJ.BKgcY4LPJrpV0X9tP9zs6Q8iNT6a',NULL,NULL,NULL,NULL),(19,'bile4','[]','$2y$13$8PtFEuMXuhn9JRqy0mVbhOQ5eUz42YjHKD0JVEIkLxRt3XHeng782',NULL,NULL,NULL,NULL),(20,'bile5','[]','$2y$13$cXDSBP7/YJBzofQAEG4IJun.BJ4JRowxH3D6YD2oyMUO3RnRRaPEO',NULL,NULL,NULL,NULL),(21,'tapiba','[]','$2y$13$xX300.D2ihXMx9On4VrAT.YzNffG.bsMAEwLkBJGRitViclTaueFm',1,NULL,'tapiba@gmail.com','6cea65d9ede546fcb8ca8616e86203ff-6669cf41ee76f.jpg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-13  9:44:35
