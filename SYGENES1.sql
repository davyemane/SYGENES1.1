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
-- Table structure for table `anonymat`
--

DROP TABLE IF EXISTS `anonymat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anonymat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int DEFAULT NULL,
  `e_c_id` int DEFAULT NULL,
  `anonymat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FC64F1CB944F1A` (`student_id`),
  KEY `IDX_FC64F1E32B239F` (`e_c_id`),
  CONSTRAINT `FK_FC64F1CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  CONSTRAINT `FK_FC64F1E32B239F` FOREIGN KEY (`e_c_id`) REFERENCES `ec` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anonymat`
--

LOCK TABLES `anonymat` WRITE;
/*!40000 ALTER TABLE `anonymat` DISABLE KEYS */;
/*!40000 ALTER TABLE `anonymat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anonymat_rattrapage`
--

DROP TABLE IF EXISTS `anonymat_rattrapage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anonymat_rattrapage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int DEFAULT NULL,
  `e_c_id` int DEFAULT NULL,
  `code_anonymat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3E2D843DCB944F1A` (`student_id`),
  KEY `IDX_3E2D843DE32B239F` (`e_c_id`),
  CONSTRAINT `FK_3E2D843DCB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  CONSTRAINT `FK_3E2D843DE32B239F` FOREIGN KEY (`e_c_id`) REFERENCES `ec` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anonymat_rattrapage`
--

LOCK TABLES `anonymat_rattrapage` WRITE;
/*!40000 ALTER TABLE `anonymat_rattrapage` DISABLE KEYS */;
/*!40000 ALTER TABLE `anonymat_rattrapage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color_scheme`
--

DROP TABLE IF EXISTS `color_scheme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `color_scheme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `school_id` int DEFAULT NULL,
  `primary_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accent_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bacground_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9AFD9BB9C32A47EE` (`school_id`),
  CONSTRAINT `FK_9AFD9BB9C32A47EE` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color_scheme`
--

LOCK TABLES `color_scheme` WRITE;
/*!40000 ALTER TABLE `color_scheme` DISABLE KEYS */;
/*!40000 ALTER TABLE `color_scheme` ENABLE KEYS */;
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
  `teacher_id` int DEFAULT NULL,
  `code_ec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_tp` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8DE8BDFF62E883B1` (`ue_id`),
  KEY `IDX_8DE8BDFF41807E1D` (`teacher_id`),
  CONSTRAINT `FK_8DE8BDFF41807E1D` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`),
  CONSTRAINT `FK_8DE8BDFF62E883B1` FOREIGN KEY (`ue_id`) REFERENCES `ue` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ec`
--

LOCK TABLES `ec` WRITE;
/*!40000 ALTER TABLE `ec` DISABLE KEYS */;
/*!40000 ALTER TABLE `ec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ee`
--

DROP TABLE IF EXISTS `ee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_by_id` int DEFAULT NULL,
  `anonymat_id` int DEFAULT NULL,
  `mark` double DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_648B18CA67DDCC43` (`anonymat_id`),
  KEY `IDX_648B18CAB03A8386` (`created_by_id`),
  CONSTRAINT `FK_648B18CA67DDCC43` FOREIGN KEY (`anonymat_id`) REFERENCES `anonymat` (`id`),
  CONSTRAINT `FK_648B18CAB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ee`
--

LOCK TABLES `ee` WRITE;
/*!40000 ALTER TABLE `ee` DISABLE KEYS */;
/*!40000 ALTER TABLE `ee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `field`
--

DROP TABLE IF EXISTS `field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `field` (
  `id` int NOT NULL AUTO_INCREMENT,
  `school_id` int DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_5BF54558C32A47EE` (`school_id`),
  CONSTRAINT `FK_5BF54558C32A47EE` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field`
--

LOCK TABLES `field` WRITE;
/*!40000 ALTER TABLE `field` DISABLE KEYS */;
INSERT INTO `field` VALUES (1,1,'CDN','Création et Design Numérique','Création et Design Numérique'),(2,1,'INS','Igenierie Numerique Sociotechnique','Igenierie Numerique Sociotechnique');
/*!40000 ALTER TABLE `field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level`
--

DROP TABLE IF EXISTS `level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `level` (
  `id` int NOT NULL AUTO_INCREMENT,
  `field_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9AEACC13443707B0` (`field_id`),
  CONSTRAINT `FK_9AEACC13443707B0` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level`
--

LOCK TABLES `level` WRITE;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` VALUES (7,2,'L1'),(9,1,'L1'),(10,1,'L2'),(11,1,'L3');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note`
--

LOCK TABLES `note` WRITE;
/*!40000 ALTER TABLE `note` DISABLE KEYS */;
/*!40000 ALTER TABLE `note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note_cc_tp`
--

DROP TABLE IF EXISTS `note_cc_tp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `note_cc_tp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `e_c_id` int DEFAULT NULL,
  `createb_by_id` int DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `cc` double DEFAULT NULL,
  `tp` double DEFAULT NULL,
  `has_tp` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2885A5F9E32B239F` (`e_c_id`),
  KEY `IDX_2885A5F9D3EAB6BC` (`createb_by_id`),
  KEY `IDX_2885A5F9CB944F1A` (`student_id`),
  CONSTRAINT `FK_2885A5F9CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  CONSTRAINT `FK_2885A5F9D3EAB6BC` FOREIGN KEY (`createb_by_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_2885A5F9E32B239F` FOREIGN KEY (`e_c_id`) REFERENCES `ec` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note_cc_tp`
--

LOCK TABLES `note_cc_tp` WRITE;
/*!40000 ALTER TABLE `note_cc_tp` DISABLE KEYS */;
/*!40000 ALTER TABLE `note_cc_tp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privilege`
--

DROP TABLE IF EXISTS `privilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `privilege` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privilege`
--

LOCK TABLES `privilege` WRITE;
/*!40000 ALTER TABLE `privilege` DISABLE KEYS */;
/*!40000 ALTER TABLE `privilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rattrapage`
--

DROP TABLE IF EXISTS `rattrapage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rattrapage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_by_id` int DEFAULT NULL,
  `anonymat_rattrapage_id` int DEFAULT NULL,
  `mark` double DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_BDE5586D50C2B2F7` (`anonymat_rattrapage_id`),
  KEY `IDX_BDE5586DB03A8386` (`created_by_id`),
  CONSTRAINT `FK_BDE5586D50C2B2F7` FOREIGN KEY (`anonymat_rattrapage_id`) REFERENCES `anonymat_rattrapage` (`id`),
  CONSTRAINT `FK_BDE5586DB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rattrapage`
--

LOCK TABLES `rattrapage` WRITE;
/*!40000 ALTER TABLE `rattrapage` DISABLE KEYS */;
/*!40000 ALTER TABLE `rattrapage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resp_field`
--

DROP TABLE IF EXISTS `resp_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resp_field` (
  `id` int NOT NULL AUTO_INCREMENT,
  `field_id` int DEFAULT NULL,
  `created_by_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A97AB707443707B0` (`field_id`),
  KEY `IDX_A97AB707B03A8386` (`created_by_id`),
  CONSTRAINT `FK_A97AB707443707B0` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`),
  CONSTRAINT `FK_A97AB707B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resp_field`
--

LOCK TABLES `resp_field` WRITE;
/*!40000 ALTER TABLE `resp_field` DISABLE KEYS */;
INSERT INTO `resp_field` VALUES (3,1,3,'Amougou Ngoumou','100258963','697379517','amougou@gmail.com','2024-07-16 10:22:32'),(4,2,3,'Emane Bile Félicien Davy','123456789','697379517','davyemane2@gmail.com','2024-07-16 13:54:59');
/*!40000 ALTER TABLE `resp_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resp_level`
--

DROP TABLE IF EXISTS `resp_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resp_level` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_by_id` int DEFAULT NULL,
  `level_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_68653E4C5FB14BA7` (`level_id`),
  KEY `IDX_68653E4CB03A8386` (`created_by_id`),
  CONSTRAINT `FK_68653E4C5FB14BA7` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`),
  CONSTRAINT `FK_68653E4CB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resp_level`
--

LOCK TABLES `resp_level` WRITE;
/*!40000 ALTER TABLE `resp_level` DISABLE KEYS */;
INSERT INTO `resp_level` VALUES (1,3,1,'Eloundou Telesphore','100258963','697379517','mendo@gmail.com','2024-07-16 12:31:06'),(2,7,NULL,'Emane bile félicien davy','100258963','676469014','desire@gmail.com','2024-07-16 15:45:44'),(4,7,7,'Tapiba Brandon','100258963','697379517','tapiba@gmail.com','2024-07-20 15:21:37'),(5,7,11,'Bile Brandon','100258963','676469014','mendo@gmail.com','2024-07-22 09:34:56');
/*!40000 ALTER TABLE `resp_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resp_school`
--

DROP TABLE IF EXISTS `resp_school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resp_school` (
  `id` int NOT NULL AUTO_INCREMENT,
  `school_id` int DEFAULT NULL,
  `created_by_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2B8192CC32A47EE` (`school_id`),
  KEY `IDX_2B8192CB03A8386` (`created_by_id`),
  CONSTRAINT `FK_2B8192CB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_2B8192CC32A47EE` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resp_school`
--

LOCK TABLES `resp_school` WRITE;
/*!40000 ALTER TABLE `resp_school` DISABLE KEYS */;
INSERT INTO `resp_school` VALUES (3,1,2,'Emane Bile Félicien Davy','1002356889','697379517','davyemane2@gmail.com','2024-07-12 14:29:48');
/*!40000 ALTER TABLE `resp_school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resp_ue`
--

DROP TABLE IF EXISTS `resp_ue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resp_ue` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ue_id` int DEFAULT NULL,
  `created_by_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_639FCBFF62E883B1` (`ue_id`),
  KEY `IDX_639FCBFFB03A8386` (`created_by_id`),
  CONSTRAINT `FK_639FCBFF62E883B1` FOREIGN KEY (`ue_id`) REFERENCES `ue` (`id`),
  CONSTRAINT `FK_639FCBFFB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resp_ue`
--

LOCK TABLES `resp_ue` WRITE;
/*!40000 ALTER TABLE `resp_ue` DISABLE KEYS */;
/*!40000 ALTER TABLE `resp_ue` ENABLE KEYS */;
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
  `school_id` int DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_57698A6AC32A47EE` (`school_id`),
  CONSTRAINT `FK_57698A6AC32A47EE` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`)
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
-- Table structure for table `role_privilege`
--

DROP TABLE IF EXISTS `role_privilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_privilege` (
  `role_id` int NOT NULL,
  `privilege_id` int NOT NULL,
  PRIMARY KEY (`role_id`,`privilege_id`),
  KEY `IDX_D6D4495BD60322AC` (`role_id`),
  KEY `IDX_D6D4495B32FB8AEA` (`privilege_id`),
  CONSTRAINT `FK_D6D4495B32FB8AEA` FOREIGN KEY (`privilege_id`) REFERENCES `privilege` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D6D4495BD60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_privilege`
--

LOCK TABLES `role_privilege` WRITE;
/*!40000 ALTER TABLE `role_privilege` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_privilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `school` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school`
--

LOCK TABLES `school` WRITE;
/*!40000 ALTER TABLE `school` DISABLE KEYS */;
INSERT INTO `school` VALUES (1,'ESIGN','ESIGN-66912fef85530.jpg','Cameroun, sud, Sangmelima','697379517','lm-afrique@gmail.com'),(5,'FASA','FASA-6695043ca7a6e.png','Cameroun, sud, Sangmelima','697379517','lm-afrique@gmail.com'),(6,'FMSB','FMSB-66950455dc8db.png','Cameroun, sud, Sangmelima','697379517','lm-afrique@gmail.com'),(7,'IDES','IDES-6695047038b21.png','Cameroun, sud, Sangmelima','697379517','uieccesign@gmail.com'),(8,'IRIC',NULL,'12, sang, sud, cmr','676469014','lm-afrique@gmail.com');
/*!40000 ALTER TABLE `school` ENABLE KEYS */;
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
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B723AF33443707B0` (`field_id`),
  KEY `IDX_B723AF335FB14BA7` (`level_id`),
  CONSTRAINT `FK_B723AF33443707B0` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`),
  CONSTRAINT `FK_B723AF335FB14BA7` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
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
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teacher` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_by_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B0F6A6D5B03A8386` (`created_by_id`),
  CONSTRAINT `FK_B0F6A6D5B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
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
  `grade` double DEFAULT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2E490A9B5FB14BA7` (`level_id`),
  CONSTRAINT `FK_2E490A9B5FB14BA7` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ue`
--

LOCK TABLES `ue` WRITE;
/*!40000 ALTER TABLE `ue` DISABLE KEYS */;
INSERT INTO `ue` VALUES (1,7,'SNA411','Systèmes Numériques Avancées I',5,'Réseaux et Systèmes Multimédias I','1',NULL,NULL),(2,7,'m124','Systèmes Numériques Avancées II',6,'Outils de Management de la Qualité','1',NULL,NULL);
/*!40000 ALTER TABLE `ue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ue_field`
--

DROP TABLE IF EXISTS `ue_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ue_field` (
  `ue_id` int NOT NULL,
  `field_id` int NOT NULL,
  PRIMARY KEY (`ue_id`,`field_id`),
  KEY `IDX_38132BB862E883B1` (`ue_id`),
  KEY `IDX_38132BB8443707B0` (`field_id`),
  CONSTRAINT `FK_38132BB8443707B0` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_38132BB862E883B1` FOREIGN KEY (`ue_id`) REFERENCES `ue` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ue_field`
--

LOCK TABLES `ue_field` WRITE;
/*!40000 ALTER TABLE `ue_field` DISABLE KEYS */;
/*!40000 ALTER TABLE `ue_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int DEFAULT NULL,
  `respfield_id` int DEFAULT NULL,
  `respschool_id` int DEFAULT NULL,
  `resplevel_id` int DEFAULT NULL,
  `respue_id` int DEFAULT NULL,
  `teacher_id` int DEFAULT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_USERNAME` (`username`),
  UNIQUE KEY `UNIQ_8D93D649CB944F1A` (`student_id`),
  UNIQUE KEY `UNIQ_8D93D6495EEFC6E9` (`respfield_id`),
  UNIQUE KEY `UNIQ_8D93D649D187767F` (`respschool_id`),
  UNIQUE KEY `UNIQ_8D93D64945698AFE` (`resplevel_id`),
  UNIQUE KEY `UNIQ_8D93D649D23FE2F9` (`respue_id`),
  UNIQUE KEY `UNIQ_8D93D64941807E1D` (`teacher_id`),
  CONSTRAINT `FK_8D93D64941807E1D` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`),
  CONSTRAINT `FK_8D93D64945698AFE` FOREIGN KEY (`resplevel_id`) REFERENCES `resp_level` (`id`),
  CONSTRAINT `FK_8D93D6495EEFC6E9` FOREIGN KEY (`respfield_id`) REFERENCES `resp_field` (`id`),
  CONSTRAINT `FK_8D93D649CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  CONSTRAINT `FK_8D93D649D187767F` FOREIGN KEY (`respschool_id`) REFERENCES `resp_school` (`id`),
  CONSTRAINT `FK_8D93D649D23FE2F9` FOREIGN KEY (`respue_id`) REFERENCES `resp_ue` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,NULL,NULL,NULL,NULL,NULL,NULL,'Mavaïwa','[\"ROLE_ADMIN\"]','$2y$13$J5q.OreU06FllJw69afR7.66tXrqvivtbvT3x1Cy0.sh.z2/rkVqC','davyemane2@gmail.com',NULL),(3,NULL,NULL,3,NULL,NULL,NULL,'emane','[\"ROLE_ADMIN\"]','$2y$13$NAncgkaeYrbSm3l0WVCGzuSTWsWBpefOnoaK7AbKkNqjipNR.OW/O','davyemane2@gmail.com',NULL),(4,NULL,NULL,NULL,NULL,NULL,NULL,'superAdmin237','[\"ROLE_SUPER_ADMIN\"]','$2y$13$t2UfYCY8NEDpBRZgvg9kquzCiu051GYf6kZYO5SG4EcCjQmQdMs2.','davyemane2@gmail.com','LogoLM-6694fc4e5cdc5.png'),(7,NULL,3,NULL,NULL,NULL,NULL,'amougou','[\"ROLE_RESPFIELD\"]','$2y$13$6uCqfSVWj030Wln.qDxEeeEK0y7fQoRlNsSvo8mBBxzfYoIT7T8RW','amougou@gmail.com','google1-669649e8ad5d9.png'),(8,NULL,NULL,NULL,1,NULL,NULL,'Eloundou','[\"ROLE_RESPLEVEL\"]','$2y$13$O9COjI2Bjpovam6PFk.U6OHlyYgnAVWg7VjGthNZ8uogkBaV8PLpu','mendo@gmail.com','2-6696680a1ae86.jpg'),(9,NULL,4,NULL,NULL,NULL,NULL,'eyenga','[\"ROLE_RESPFIELD\"]','$2y$13$E.kbnlwCrEP3Ww2vzREgc.uC0JYm6a69pFF2c8m//yFBRD.lKTNAa','davyemane2@gmail.com','2-66967bb3bdf9e.jpg'),(10,NULL,NULL,NULL,2,NULL,NULL,'desire','[\"ROLE_RESPLEVEL\"]','$2y$13$0KXHKXzmm4Pw/m9CeYVbX.84t5q1larIYvFQubQqjoPjG0jWIR7vG','desire@gmail.com','7454d6ad22384ffa839548d7c7fb8238-669695a85b66f.jpg'),(11,NULL,NULL,NULL,NULL,NULL,NULL,'amougou2','[\"ROLE_RESPLEVEL\"]','$2y$13$hiM4svXtYohh6RgNzQ5ouOT1dnWUAeECgdLH6Qycbccv54Gp2QNyC','amougou@gmail.com','apiRest-669695cace858.png'),(12,NULL,NULL,NULL,4,NULL,NULL,'tapiba','[\"ROLE_RESPLEVEL\"]','$2y$13$Oi90gINw8e7AwGCA6JKZCOR2bnuLx6K2i6RbZtDFqrt4Lyi8O5FZ2','tapiba@gmail.com','3-669bd601d08f4.jpg'),(13,NULL,NULL,NULL,NULL,NULL,NULL,'zanga','[\"ROLE_RESPUE\"]','$2y$13$vdHGxsw3wHUO4TpvpnQYWuMKjOmfAAaw7/0XuWrWN/ZVxjtQ1ieNe','zanga@gmail.com',NULL),(15,NULL,NULL,NULL,NULL,NULL,NULL,'zanga2','[\"ROLE_RESPUE\"]','$2y$13$xYm4glNc1T.GVA.0G9T9d.NTkSavClpySj.x/kAesQNSkMzWi4X7u','zanga@gmail.com',NULL),(16,NULL,NULL,NULL,5,NULL,NULL,'bile','[\"ROLE_RESPLEVEL\"]','$2y$13$5UbnLzs0TBaiuoveVe1HbuWgrSeHE5G7j9C8w5obYsKEVZWC0bvDu','mendo@gmail.com','3273a7fd0d02404086fa0640d52c9a83-669e27c0eecd6.jpg');
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

-- Dump completed on 2024-07-22 10:35:38
