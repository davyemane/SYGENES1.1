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
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20240429015815','2024-04-29 02:59:52',49389),('DoctrineMigrations\\Version20240429023640','2024-04-29 03:37:00',3691),('DoctrineMigrations\\Version20240429034714','2024-04-29 04:51:16',10871),('DoctrineMigrations\\Version20240430102751','2024-04-30 10:29:42',6797),('DoctrineMigrations\\Version20240505193412','2024-05-05 19:35:19',46915),('DoctrineMigrations\\Version20240505204843','2024-05-05 20:50:58',2243),('DoctrineMigrations\\Version20240505205702','2024-05-05 20:57:06',2240),('DoctrineMigrations\\Version20240505205752','2024-05-05 20:57:56',941),('DoctrineMigrations\\Version20240505210748','2024-05-05 21:07:50',663),('DoctrineMigrations\\Version20240513172646','2024-05-13 17:27:56',1766),('DoctrineMigrations\\Version20240513183939','2024-05-13 18:39:50',387),('DoctrineMigrations\\Version20240513184108','2024-05-13 18:41:14',403),('DoctrineMigrations\\Version20240513225009','2024-05-13 22:50:49',8796),('DoctrineMigrations\\Version20240516234457','2024-05-16 23:45:18',2550),('DoctrineMigrations\\Version20240517000821','2024-05-17 00:08:45',720),('DoctrineMigrations\\Version20240517090132','2024-05-17 09:01:47',4116),('DoctrineMigrations\\Version20240519205658','2024-05-19 20:57:14',7896),('DoctrineMigrations\\Version20240519205818','2024-05-19 20:58:24',1067),('DoctrineMigrations\\Version20240519211229','2024-05-19 21:12:32',2685),('DoctrineMigrations\\Version20240519211350','2024-05-19 21:13:56',474),('DoctrineMigrations\\Version20240519211848','2024-05-19 21:18:53',3850),('DoctrineMigrations\\Version20240519212045','2024-05-19 21:20:48',528);
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_ec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8DE8BDFF62E883B1` (`ue_id`),
  CONSTRAINT `FK_8DE8BDFF62E883B1` FOREIGN KEY (`ue_id`) REFERENCES `ue` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ec`
--

LOCK TABLES `ec` WRITE;
/*!40000 ALTER TABLE `ec` DISABLE KEYS */;
INSERT INTO `ec` VALUES (1,3,'java','m1234',NULL,2);
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
INSERT INTO `field` VALUES (1,'ISN','Ingenierie des systemes numeriques',NULL),(2,'INS','Igenierie Numerique Sociotechnique',NULL),(3,'CDN','Creation et Design Numerique',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note`
--

LOCK TABLES `note` WRITE;
/*!40000 ALTER TABLE `note` DISABLE KEYS */;
INSERT INTO `note` VALUES (1,1,6,1,'12','10','15',NULL,'19-05-24','6'),(2,1,6,1,'12','10','15',NULL,'19-05-24','6');
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
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by_id` int DEFAULT NULL,
  `created_at` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_52520D07B03A8386` (`created_by_id`),
  CONSTRAINT `FK_52520D07B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsable`
--

LOCK TABLES `responsable` WRITE;
/*!40000 ALTER TABLE `responsable` DISABLE KEYS */;
INSERT INTO `responsable` VALUES (1,'amougou@gmail.com','666666666','amougou ngoumou',NULL,NULL),(2,'leso@gmail.com','697379517','Emane Bile Félicien Davy',NULL,NULL),(3,'leo@gmail.com','697379517','mendo desire',NULL,NULL),(4,'eyenga@gmail.com','676469014','Eyenga',1,'19-05-24');
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (6,2,3,NULL,'Emane Bile Félicien','davyemane2@gmail.com','697379517','2019-01-01','ndjom-yekombo',NULL,NULL),(7,1,1,NULL,'tapiba','tapiba2@gmail.com','676469014','2019-01-01','df',NULL,NULL),(8,1,1,NULL,'Emane Bile Félicien Davy','tapiba2@gmail.com','697379517','2019-01-01','fgwgw',NULL,NULL),(9,1,1,NULL,'Emane Bile Félicien Davy','tapiba2@gmail.com','697379517','2019-01-01','fgwgw',NULL,NULL),(10,1,3,NULL,'akono akono','tapiba2@gmail.com','697379517','2019-01-01','fgwgw',NULL,NULL),(11,1,1,NULL,'brinda','brinda@gmail.com','697379517','2023-04-06','dfg',NULL,NULL),(12,1,1,NULL,'b','tapiba2@gmail.com','676469014','2019-01-01',',ml',NULL,NULL),(13,1,1,NULL,'paulo','paulo2@gmail.com','676469014','2019-01-01','rfe',NULL,NULL),(14,1,1,NULL,'paulo','paulo2@gmail.com','676469014','2019-01-01','rfe',NULL,NULL),(15,1,4,NULL,'desire','desire2@gmail.com','697379517','2019-01-01','wwe',NULL,NULL),(16,1,5,NULL,'feuwo','feuwo@gmail.com','676469014','2020-01-01','3r','7d84485c6b054bae91fa2f4b665e86c7-6637f13e05514.jpg','8bb8f9f9f5fe4210a7709d40137a9c9a-6637f13e052a9.jpg'),(17,1,5,NULL,'Evina Franky','evina2@gmail.com','697379517','2019-01-01','yaoundé','3273a7fd0d02404086fa0640d52c9a83-6638bffd70ce7.jpg','7dd184ec9e98470db6d9f24f1afd6a85-6638bffd6d25b.jpg'),(18,2,3,NULL,'mavaïwa désiré désiré','desire2@gmail.com','697379517','2019-01-01','efe','57f6dc924c724f75a3e5b9743e235d9f-6638c0707ee79.jpg','IMG-20231025-WA0010-6638c0707eb37.jpg'),(19,2,4,NULL,'evina francky','tapiba3@gmail.com','697379517','2019-01-01','sfw','156897357-710991476266291-6386398823986896558-n-66432537a5973.jpg','380047086-1379603389435986-2948504245511140514-n-66432537a4b71.jpg');
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit` int DEFAULT NULL,
  `code_ue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2E490A9B5FB14BA7` (`level_id`),
  CONSTRAINT `FK_2E490A9B5FB14BA7` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ue`
--

LOCK TABLES `ue` WRITE;
/*!40000 ALTER TABLE `ue` DISABLE KEYS */;
INSERT INTO `ue` VALUES (1,2,'maths',5,NULL,NULL,NULL),(2,2,'maths',5,NULL,NULL,NULL),(3,5,'Algo',5,'m124','vfvfg','1');
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_USERNAME` (`username`),
  UNIQUE KEY `UNIQ_8D93D649CB944F1A` (`student_id`),
  UNIQUE KEY `UNIQ_8D93D64953C59D72` (`responsable_id`),
  CONSTRAINT `FK_8D93D64953C59D72` FOREIGN KEY (`responsable_id`) REFERENCES `responsable` (`id`),
  CONSTRAINT `FK_8D93D649CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'davyEmane','[\"ROLE_ADMIN\"]','$2y$13$v3sw/wzbYeRMRHh4rn5xCuV/wWGYMdO3HvgHLFRmZWSed/QU/G0JG',NULL,NULL,NULL),(2,'Emane','[\"ROLE_ADMIN\"]','$2y$13$c0PthKV5rA0BgidQtuknEO7K9FL/O5r5XJ.7A4RTKRD4n0Nb53iKu',NULL,NULL,NULL),(3,'bile0','[]','$2y$13$6y3OwWjue1Hckhk1dPiv8.Sq/ZI93Uer2LGsO6PZQ8LZs4soBmZWW',NULL,NULL,NULL),(4,'bile1','[]','$2y$13$jQaXkipO4SWkPq6cTcxCieNyt9b1G9ZDAN2FIxmn1it2GWf7eT7C6',NULL,NULL,NULL),(5,'bile2','[]','$2y$13$lbn7VQ75xiVmRnDrdJHpYulj/nt/GiS9Rf1eqfQF8xgfxrBK6X09q',NULL,NULL,NULL),(6,'bile3','[]','$2y$13$2sSVqrHtS84mKyroF/YzmOwqcWA/so.a9wNWwIizbqWxXjIiGo4ou',NULL,NULL,NULL),(7,'bile4','[]','$2y$13$uGQzdzkOCBwTwluyStQvlOo5/ryYeImm6pLDRqu0hksjZsYpVilPu',NULL,NULL,NULL),(8,'bile5','[]','$2y$13$/KM8Wj9PnPQPLy9b4OmGoe/z6Upb7HctkBJJ2U9xtSiUORQMxcIEm',NULL,NULL,NULL),(9,'davy emane bile','[]','$2y$13$dDIA/xAAlayVtD0cm3W.pudjws35//XOuzUJIxoR/IWBUgRw2EQE2',NULL,NULL,NULL),(10,'davy emane bile1','[]','$2y$13$sKhMTfPWBGGybnEpGC6/GeWGITnNB17QfKgRFWc/sOsvvbbnNQa.u',NULL,NULL,'davyemane2@gmail.com'),(11,'davy emane bile2','[]','$2y$13$lvEXwGaC1yohuSS0K6Nxauom/9A2iXWfTXPz.5nWfqWpguBACi8VK',NULL,NULL,NULL),(12,'davy emane bile5','[]','$2y$13$BloFA9lUHfptOTpdzy9Ga.qEoXPbM8DHbtKfWajIwCHxA1SIZCeeS',NULL,NULL,'davyemane2@gmail.com'),(13,'davy f0','[]','$2y$13$bQyR0j1obfKiCSEPz0eQpeF4lMAZ4xqdMMWUlh60gUl1omHZsr9F2',NULL,NULL,'davyemane1@gmail.com'),(27,'EYENGA','[\"ROLE_CEP\"]','$2y$13$dHFVULHjBn1c82/DZEadJeKy5lA.JMvDdSpn4lpAmA45HD8Ize.mi',NULL,4,'amougou@gmail.com');
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

-- Dump completed on 2024-05-25 22:35:39
