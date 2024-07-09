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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color_scheme`
--

LOCK TABLES `color_scheme` WRITE;
/*!40000 ALTER TABLE `color_scheme` DISABLE KEYS */;
INSERT INTO `color_scheme` VALUES (1,1,'#bd8989','#5bfb46','#e65656','#f88282','#000000','LM');
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
  `code_ec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_tp` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8DE8BDFF62E883B1` (`ue_id`),
  CONSTRAINT `FK_8DE8BDFF62E883B1` FOREIGN KEY (`ue_id`) REFERENCES `ue` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ec`
--

LOCK TABLES `ec` WRITE;
/*!40000 ALTER TABLE `ec` DISABLE KEYS */;
INSERT INTO `ec` VALUES (4,4,'ISN4121','Gamification, psychologie et sociologie du Gamer',NULL,'3',1),(5,NULL,'ISN4411','Gamification, psychologie et sociologie du Gamer',NULL,'2.5',0),(6,5,'SNA4122','limites',NULL,'2',0);
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
  `school_id` int DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_5BF54558C32A47EE` (`school_id`),
  CONSTRAINT `FK_5BF54558C32A47EE` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field`
--

LOCK TABLES `field` WRITE;
/*!40000 ALTER TABLE `field` DISABLE KEYS */;
INSERT INTO `field` VALUES (1,1,'CDN','Création et Design Numérique','LNJH'),(2,2,'INS','Igenierie Numerique Sociotechnique','L\'Ingénierie Numérique Sociotechnique est un domaine interdisciplinaire qui combine des compétences en informatique, en ingénierie et en sciences sociales pour concevoir, développer et gérer des systèmes technologiques complexes en tenant compte des implications sociales et éthiques. Les étudiants de cette filière apprennent à intégrer des solutions technologiques innovantes tout en prenant en considération les besoins et les comportements des utilisateurs, ainsi que l\'impact sociétal des technologies numériques. Cela inclut la gestion de projets numériques, la conception de systèmes interactifs, et l\'analyse des interactions entre les technologies et les sociétés.'),(3,1,'CDN','Création et Design Numérique','dfbdf'),(4,2,'CDN','Création et Design Numérique','Création et Design Numérique\r\n\r\nLa filière de Création et Design Numérique est centrée sur l\'utilisation des outils numériques pour concevoir et réaliser des projets créatifs. Elle combine des éléments de design graphique, d\'animation, de modélisation 3D, de développement web et d\'interaction utilisateur. Les étudiants apprennent à maîtriser des logiciels de création tels qu\'Adobe Creative Suite, Blender, et d\'autres outils de design interactif. Ils développent des compétences en conception visuelle, en gestion de projet et en communication visuelle, leur permettant de travailler dans des domaines variés comme la publicité, le jeu vidéo, le cinéma, et les médias numériques. Cette formation prépare les étudiants à des carrières de designer numérique, graphiste, directeur artistique, ou développeur de contenu interactif.'),(5,2,'ISN','Igenierie des Systemes Numeriques','La filière \"Ingénierie des Systèmes Numériques\" se concentre sur la conception, le développement et la gestion de systèmes informatiques complexes et de technologies numériques. Les étudiants apprennent à maîtriser les principes de l\'informatique, de l\'électronique et des réseaux, ainsi que les compétences nécessaires pour concevoir des logiciels, des applications et des systèmes embarqués. Cette filière couvre également des sujets tels que la cybersécurité, l\'intelligence artificielle, l\'Internet des objets (IoT) et l\'analyse de données, préparant les diplômés à une variété de carrières dans le secteur technologique et numérique.'),(6,7,'CDN','Création et Design Numérique','sdq');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level`
--

LOCK TABLES `level` WRITE;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` VALUES (1,NULL,'D2'),(2,NULL,'P1'),(3,NULL,'L1'),(4,NULL,'L2'),(5,NULL,'L3'),(6,NULL,'M1'),(7,NULL,'M2'),(8,NULL,'L1'),(9,NULL,'L2');
/*!40000 ALTER TABLE `level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level_fields`
--

DROP TABLE IF EXISTS `level_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `level_fields` (
  `level_id` int NOT NULL,
  `field_id` int NOT NULL,
  PRIMARY KEY (`level_id`,`field_id`),
  KEY `IDX_75382295FB14BA7` (`level_id`),
  KEY `IDX_7538229443707B0` (`field_id`),
  CONSTRAINT `FK_7538229443707B0` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_75382295FB14BA7` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level_fields`
--

LOCK TABLES `level_fields` WRITE;
/*!40000 ALTER TABLE `level_fields` DISABLE KEYS */;
INSERT INTO `level_fields` VALUES (1,1),(2,1),(3,1),(3,2),(3,3),(3,4),(3,5),(4,1),(4,2),(4,3),(4,5),(5,1),(5,2),(5,3),(5,5),(6,1),(6,2),(6,3),(6,4),(6,5),(7,1),(7,2),(7,3),(7,4),(7,5),(8,6),(9,6);
/*!40000 ALTER TABLE `level_fields` ENABLE KEYS */;
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
  `cc` double DEFAULT NULL,
  `tp` double DEFAULT NULL,
  `has_tp` tinyint(1) DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `createb_by_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2885A5F9E32B239F` (`e_c_id`),
  KEY `IDX_2885A5F9D3EAB6BC` (`createb_by_id`),
  KEY `IDX_2885A5F9CB944F1A` (`student_id`),
  CONSTRAINT `FK_2885A5F9CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  CONSTRAINT `FK_2885A5F9D3EAB6BC` FOREIGN KEY (`createb_by_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_2885A5F9E32B239F` FOREIGN KEY (`e_c_id`) REFERENCES `ec` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note_cc_tp`
--

LOCK TABLES `note_cc_tp` WRITE;
/*!40000 ALTER TABLE `note_cc_tp` DISABLE KEYS */;
INSERT INTO `note_cc_tp` VALUES (1,4,15,18,1,2,13,'2024-07-08 13:37:52'),(2,4,13,19,1,3,13,'2024-07-08 13:37:52'),(3,4,16,4,1,4,13,'2024-07-08 13:37:52'),(5,6,15,NULL,0,2,13,'2024-07-08 14:20:00'),(6,6,16,NULL,0,3,13,'2024-07-08 14:20:00'),(7,6,17,NULL,0,4,13,'2024-07-08 14:20:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privilege`
--

LOCK TABLES `privilege` WRITE;
/*!40000 ALTER TABLE `privilege` DISABLE KEYS */;
INSERT INTO `privilege` VALUES (3,'Add user'),(4,'Add Field'),(5,'Add Profile'),(6,'Add Mark'),(7,'Add UE'),(8,'Add EC'),(9,'Add Level'),(10,'Generate PV '),(11,'Generate Transcript of notes'),(12,'Validate Student'),(13,'Add Student'),(14,'View statistics'),(15,'List Students'),(16,'List Fields'),(17,'List Profile'),(18,'Add School'),(19,'Detail Student'),(20,'List EC'),(21,'List UE'),(22,'View Marks');
/*!40000 ALTER TABLE `privilege` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsable`
--

LOCK TABLES `responsable` WRITE;
/*!40000 ALTER TABLE `responsable` DISABLE KEYS */;
INSERT INTO `responsable` VALUES (1,NULL,'davyemane2@gmail.com','697379517','Emane Bile Félicien Davy',NULL),(2,NULL,'davyemane2@gmail.com','697379517','Emane Bile Félicien Davy',NULL),(3,NULL,'davyemane@gmail.com','676469014','Emane bile félicien davy',NULL),(4,NULL,'amougou@gmail.com','676469014','Emane bile félicien davy',NULL),(6,NULL,'amougou@gmail.com','676469014','Emane bile félicien davy',NULL),(7,NULL,'amougou@gmail.com','676469014','Emane bile félicien davy',NULL),(8,NULL,'amougou@gmail.com','676469014','Emane bile félicien davy',NULL),(9,NULL,'davyemane2@gmail.com','697379517','Emane Bile Félicien Davy',NULL),(10,NULL,'davyemane2@gmail.com','676469014','Emane bile félicien davy',NULL),(11,NULL,'mendo@gmail.com','697379517','Emane Bile Félicien Davy',NULL),(12,NULL,'agnesgrey@gmail.com','697379517','Ango Brinda',NULL),(13,NULL,'davyemane2@gmail.com','676469014','Emane bile félicien davy',NULL),(14,NULL,'desire@gmail.com','699437103','Mavaïwa desire desire',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (10,2,NULL,'RES','2024-07-06 09:50:46','2024-07-06 09:50:46'),(11,2,NULL,'SA','2024-07-06 09:52:10','2024-07-06 16:24:31'),(12,2,NULL,'Student','2024-07-06 09:52:36','2024-07-06 09:52:36'),(13,7,NULL,'Directeur','2024-07-08 08:42:37','2024-07-08 08:42:37');
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
INSERT INTO `role_privilege` VALUES (10,3),(10,5),(10,12),(10,13),(10,14),(10,15),(10,16),(10,19),(11,3),(11,4),(11,5),(11,6),(11,7),(11,8),(11,9),(11,10),(11,11),(11,12),(11,13),(11,14),(11,15),(11,16),(11,17),(11,18),(11,19),(11,20),(11,21),(11,22),(13,3),(13,4),(13,5),(13,6),(13,7),(13,8),(13,9),(13,10),(13,11),(13,12),(13,13),(13,14),(13,15),(13,16),(13,17),(13,18),(13,19),(13,20),(13,21),(13,22);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school`
--

LOCK TABLES `school` WRITE;
/*!40000 ALTER TABLE `school` DISABLE KEYS */;
INSERT INTO `school` VALUES (1,'Langues Maternelles','Langue-Maternelle-6686a805548db.png','12, sang, sud, cmr','676469014','lm-afrique@gmail.com'),(2,'ESIGN','ESIGN-6687cecbdf88f.png','12, sang, sud, cmr','676469014','lm-afrique@gmail.com'),(3,'lybi','lybi-66880141ebbc9.png','12, sang, sud, cmr','676469014','lm-afrique@gmail.com'),(4,'bad','bad-66880cc9cfb62.png','12, sang, sud, cmr','676469014','lm-afrique@gmail.com'),(5,'colim',NULL,'12, sang, sud, cmr','676469014','lm-afrique@gmail.com'),(6,'ESIGN','ESIGN-668911d9cd425.jpg','12, sang, sud, cmr','676469014','lm-afrique@gmail.com'),(7,'UBW','UBW-668ba615bcbbb.png','12, sang, sud, cmr','676469014','lm-afrique@gmail.com');
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
  CONSTRAINT `FK_B723AF335FB14BA7` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,3,5,NULL,'Tapiba Brandon ','tapiba@gmail.com','681020655','2001-02-15','bamenda',NULL,NULL,'MASCULIN',NULL,'Cameroun'),(2,5,3,NULL,'bile',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,5,3,NULL,'Emane bile','davyemane1@gmail.com','676469014',NULL,NULL,NULL,NULL,'M',NULL,'Cameroun'),(4,5,4,NULL,'davy',NULL,'davy',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
  `grade` double DEFAULT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2E490A9B5FB14BA7` (`level_id`),
  CONSTRAINT `FK_2E490A9B5FB14BA7` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ue`
--

LOCK TABLES `ue` WRITE;
/*!40000 ALTER TABLE `ue` DISABLE KEYS */;
INSERT INTO `ue` VALUES (4,3,'SNA411','Systèmes Numériques Avancées I',5,'vfvfg','8',NULL,NULL),(5,5,'IGN411','Réseaux et Systèmes Multimédias II',5,'vfvfg','8',NULL,NULL);
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
INSERT INTO `ue_field` VALUES (4,2),(4,4),(4,5),(5,2),(5,4),(5,5);
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
  `responsable_id` int DEFAULT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_USERNAME` (`username`),
  UNIQUE KEY `UNIQ_8D93D649CB944F1A` (`student_id`),
  UNIQUE KEY `UNIQ_8D93D64953C59D72` (`responsable_id`),
  CONSTRAINT `FK_8D93D64953C59D72` FOREIGN KEY (`responsable_id`) REFERENCES `responsable` (`id`),
  CONSTRAINT `FK_8D93D649CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (13,NULL,13,'emane','[]','$2y$13$KQjKbzXKynp4wu.yIyssCeItZVEBIbvS0Wz9XyX6FaA0405LPNMX.','davyemane2@gmail.com','IMG-20231121-WA0043-6689156fb17b7.jpg'),(14,2,NULL,'','[]','$2y$13$JKhSbPDPQJluEb84LnY0deLlB7v2XunxT7TJ37bQTkbrslNrHjifu',NULL,NULL),(15,1,NULL,'681020655','[]','$2y$13$K7L3OKXoYRydgGBW/77GBuzB9./WwW.6q5OsN3vWguCCJVt1clkwK','tapiba@gmail.com',NULL),(16,3,NULL,'676469014','[]','$2y$13$NbfJgxgETg615vSnS0J.HOAxu9ZPaOPlXDqbGk9jaOZP17mOD.M.m','davyemane1@gmail.com',NULL),(17,4,NULL,'davy','[]','$2y$13$vR7htgQnFIj3/6XjxnDlG.B2iW4dBNwHIx9cYLQxxkITsw/Qx6CD2',NULL,NULL),(18,NULL,14,'Mavaïwa','[]','$2y$13$fiyEFO34lKrKhzZOUVPqq.Vbm35AqB722CIwkbAdMIjK4P3HHWscu','desire@gmail.com','7dd184ec9e98470db6d9f24f1afd6a85-668ba717cc941.jpg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_role` (
  `user_id` int NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_2DE8C6A3A76ED395` (`user_id`),
  KEY `IDX_2DE8C6A3D60322AC` (`role_id`),
  CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (13,10),(13,11),(14,12),(15,12),(16,12),(17,12),(18,13);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-09  9:56:55
