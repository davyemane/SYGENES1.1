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
  KEY `IDX_FC64F1E32B239F` (`e_c_id`),
  KEY `IDX_FC64F1CB944F1A` (`student_id`),
  CONSTRAINT `FK_FC64F1CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  CONSTRAINT `FK_FC64F1E32B239F` FOREIGN KEY (`e_c_id`) REFERENCES `ec` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=731 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anonymat`
--

LOCK TABLES `anonymat` WRITE;
/*!40000 ALTER TABLE `anonymat` DISABLE KEYS */;
INSERT INTO `anonymat` VALUES (224,1178,8,'0001'),(225,1179,8,'0002'),(226,1180,8,'0003'),(227,1181,8,'0004'),(228,1182,8,'0005'),(229,1183,8,'0006'),(230,1184,8,'0007'),(231,1185,8,'0008'),(232,1186,8,'0009'),(233,1187,8,'0010'),(234,1188,8,'0011'),(235,1189,8,'0012'),(236,1190,8,'0013'),(237,1191,8,'0014'),(238,1192,8,'0015'),(239,1193,8,'0016'),(240,1194,8,'0017'),(241,1195,8,'0018'),(242,1196,8,'0019'),(243,1197,8,'0020'),(244,1198,8,'0021'),(245,1199,8,'0034'),(246,1200,8,'0035'),(247,1201,8,'0036'),(248,1202,8,'0037'),(249,1203,8,'0038'),(250,1204,8,'0039'),(251,1205,8,'0040'),(252,1206,8,'0041'),(253,1207,8,'0042'),(254,1208,8,'0043'),(255,1209,8,'0044'),(256,1210,8,'0045'),(257,1211,8,'0046'),(258,1212,8,'0047'),(259,1213,8,'0048'),(260,1214,8,'0049'),(261,1215,8,'0050'),(262,1216,8,'0051'),(263,1217,8,'0052'),(264,1218,8,'0053'),(265,1219,8,'0054'),(266,1220,8,'0055'),(267,1221,8,'0056'),(268,1222,8,'0057'),(269,1223,8,NULL),(270,1224,8,NULL),(271,1225,8,NULL),(272,1226,8,NULL),(273,1227,8,NULL),(274,1228,8,NULL),(275,1229,8,NULL),(276,1230,8,NULL),(277,1231,8,NULL),(278,1232,8,NULL),(279,1233,8,NULL),(280,1234,8,NULL),(281,1235,8,NULL),(282,1236,8,NULL),(283,1237,8,NULL),(284,1238,8,NULL),(285,1239,8,NULL),(286,1240,8,NULL),(287,1241,8,NULL),(288,1242,8,NULL),(289,1243,8,NULL),(290,1244,8,NULL),(291,1245,8,NULL),(292,1246,8,NULL),(293,1247,8,NULL),(294,1248,8,NULL),(295,1249,8,NULL),(296,1250,8,NULL),(297,1251,8,NULL),(298,1252,8,NULL),(299,1253,8,NULL),(300,1254,8,NULL),(301,1255,8,NULL),(302,1256,8,NULL),(303,1257,8,NULL),(304,1258,8,NULL),(305,1259,8,NULL),(306,1260,8,NULL),(307,1261,8,NULL),(308,1262,8,NULL),(309,1263,8,NULL),(310,1264,8,NULL),(311,1265,8,NULL),(312,1266,8,NULL),(313,1267,8,NULL),(314,1268,8,NULL),(315,1269,8,NULL),(316,1270,8,NULL),(317,1271,8,NULL),(318,1272,8,NULL),(319,1273,8,NULL),(320,1274,8,NULL),(321,1275,8,NULL),(322,1276,8,NULL),(323,1277,8,NULL),(324,1278,8,NULL),(325,1279,8,NULL),(326,1280,8,NULL),(327,1281,8,NULL),(328,1282,8,NULL),(329,1283,8,NULL),(330,1284,8,NULL),(331,1285,8,NULL),(332,1286,8,NULL),(333,1287,8,NULL),(334,1288,8,NULL),(335,1289,8,NULL),(336,1290,8,NULL),(337,1291,8,NULL),(338,1292,8,NULL),(339,1293,8,NULL),(340,1294,8,NULL),(341,1295,8,NULL),(342,1296,8,NULL),(343,1297,8,NULL),(344,1298,8,NULL),(345,1299,8,NULL),(346,1300,8,NULL),(347,1301,8,NULL),(348,1302,8,NULL),(349,1303,8,NULL),(350,1304,8,NULL),(351,1305,8,NULL),(352,1306,8,NULL),(353,1307,8,NULL),(354,1308,8,NULL),(355,1309,8,NULL),(356,1310,8,NULL),(357,1311,8,NULL),(358,1312,8,NULL),(359,1313,8,NULL),(360,1314,8,NULL),(361,1315,8,NULL),(362,1316,8,NULL),(363,1317,8,NULL),(364,1318,8,NULL),(365,1319,8,NULL),(366,1320,8,NULL),(367,1321,8,NULL),(368,1322,8,NULL),(369,1323,8,NULL),(370,1324,8,NULL),(371,1325,8,NULL),(372,1326,8,NULL),(373,1327,8,NULL),(374,1328,8,NULL),(375,1329,8,NULL),(376,1330,8,NULL),(377,1331,8,NULL),(378,1332,8,NULL),(379,1333,8,NULL),(380,1334,8,NULL),(381,1335,8,NULL),(382,1336,8,NULL),(383,1337,8,NULL),(384,1338,8,NULL),(385,1339,8,NULL),(386,1340,8,NULL),(387,1341,8,NULL),(388,1342,8,NULL),(389,1343,8,NULL),(390,1344,8,NULL),(391,1345,8,NULL),(392,1346,8,NULL),(393,1178,7,'0001'),(394,1179,7,'0002'),(395,1180,7,'0003'),(396,1181,7,'0004'),(397,1182,7,'0005'),(398,1183,7,'0006'),(399,1184,7,'0007'),(400,1185,7,'0008'),(401,1186,7,'0009'),(402,1187,7,'0010'),(403,1188,7,'0011'),(404,1189,7,'0012'),(405,1190,7,'0013'),(406,1191,7,'0014'),(407,1192,7,'0015'),(408,1193,7,'0016'),(409,1194,7,'0017'),(410,1195,7,'0018'),(411,1196,7,'0019'),(412,1197,7,'0020'),(413,1198,7,'0021'),(414,1199,7,'0022'),(415,1200,7,'0023'),(416,1201,7,'0024'),(417,1202,7,'0025'),(418,1203,7,'0026'),(419,1204,7,'0027'),(420,1205,7,'0028'),(421,1206,7,'0029'),(422,1207,7,'0030'),(423,1208,7,'0031'),(424,1209,7,'0032'),(425,1210,7,'0033'),(426,1211,7,'0034'),(427,1212,7,'0035'),(428,1213,7,'0036'),(429,1214,7,'0037'),(430,1215,7,'0038'),(431,1216,7,'0039'),(432,1217,7,'0040'),(433,1218,7,'0041'),(434,1219,7,'0042'),(435,1220,7,'0045'),(436,1221,7,'0046'),(437,1222,7,'0047'),(438,1223,7,'0048'),(439,1224,7,'0049'),(440,1225,7,'0050'),(441,1226,7,'0051'),(442,1227,7,'0052'),(443,1228,7,'0053'),(444,1229,7,'0054'),(445,1230,7,'0055'),(446,1231,7,'0056'),(447,1232,7,'0057'),(448,1233,7,'0058'),(449,1234,7,'0059'),(450,1235,7,'0060'),(451,1236,7,'0061'),(452,1237,7,'0062'),(453,1238,7,'0063'),(454,1239,7,'0064'),(455,1240,7,'0065'),(456,1241,7,'0066'),(457,1242,7,'0067'),(458,1243,7,'0068'),(459,1244,7,'0069'),(460,1245,7,'0070'),(461,1246,7,'0071'),(462,1247,7,'0072'),(463,1248,7,'0073'),(464,1249,7,'0074'),(465,1250,7,'0075'),(466,1251,7,'0076'),(467,1252,7,'0077'),(468,1253,7,'0078'),(469,1254,7,'0079'),(470,1255,7,'0080'),(471,1256,7,'0081'),(472,1257,7,'0082'),(473,1258,7,'0083'),(474,1259,7,'0084'),(475,1260,7,'0085'),(476,1261,7,'0086'),(477,1262,7,'0087'),(478,1263,7,'0088'),(479,1264,7,'0089'),(480,1265,7,'0090'),(481,1266,7,'0091'),(482,1267,7,'0092'),(483,1268,7,'0093'),(484,1269,7,'0094'),(485,1270,7,'0095'),(486,1271,7,'0096'),(487,1272,7,'0097'),(488,1273,7,'0098'),(489,1274,7,'0099'),(490,1275,7,'0100'),(491,1276,7,'1101'),(492,1277,7,'0102'),(493,1278,7,'0103'),(494,1279,7,'0104'),(495,1280,7,'0105'),(496,1281,7,'0106'),(497,1282,7,'0107'),(498,1283,7,'0108'),(499,1284,7,'0109'),(500,1285,7,'0110'),(501,1286,7,'0111'),(502,1287,7,'0112'),(503,1288,7,'0113'),(504,1289,7,'0114'),(505,1290,7,'0115'),(506,1291,7,'0116'),(507,1292,7,'0117'),(508,1293,7,'0118'),(509,1294,7,'0119'),(510,1295,7,'0120'),(511,1296,7,'0121'),(512,1297,7,'0122'),(513,1298,7,'0123'),(514,1299,7,NULL),(515,1300,7,NULL),(516,1301,7,NULL),(517,1302,7,NULL),(518,1303,7,NULL),(519,1304,7,NULL),(520,1305,7,NULL),(521,1306,7,NULL),(522,1307,7,NULL),(523,1308,7,NULL),(524,1309,7,NULL),(525,1310,7,NULL),(526,1311,7,NULL),(527,1312,7,NULL),(528,1313,7,NULL),(529,1314,7,NULL),(530,1315,7,NULL),(531,1316,7,NULL),(532,1317,7,NULL),(533,1318,7,NULL),(534,1319,7,NULL),(535,1320,7,NULL),(536,1321,7,NULL),(537,1322,7,NULL),(538,1323,7,NULL),(539,1324,7,NULL),(540,1325,7,NULL),(541,1326,7,NULL),(542,1327,7,NULL),(543,1328,7,NULL),(544,1329,7,NULL),(545,1330,7,NULL),(546,1331,7,NULL),(547,1332,7,NULL),(548,1333,7,NULL),(549,1334,7,NULL),(550,1335,7,NULL),(551,1336,7,NULL),(552,1337,7,NULL),(553,1338,7,NULL),(554,1339,7,NULL),(555,1340,7,NULL),(556,1341,7,NULL),(557,1342,7,NULL),(558,1343,7,NULL),(559,1344,7,NULL),(560,1345,7,NULL),(561,1346,7,NULL),(562,1178,9,'0001'),(563,1179,9,'0002'),(564,1180,9,'0003'),(565,1181,9,'0004'),(566,1182,9,'0005'),(567,1183,9,'0006'),(568,1184,9,'0007'),(569,1185,9,'0008'),(570,1186,9,'0009'),(571,1187,9,'0010'),(572,1188,9,'0011'),(573,1189,9,'0012'),(574,1190,9,'0013'),(575,1191,9,'0014'),(576,1192,9,'0015'),(577,1193,9,'0016'),(578,1194,9,'0017'),(579,1195,9,'0018'),(580,1196,9,'0019'),(581,1197,9,'0020'),(582,1198,9,'0021'),(583,1199,9,'0022'),(584,1200,9,'0023'),(585,1201,9,'0024'),(586,1202,9,'0025'),(587,1203,9,'0026'),(588,1204,9,'0027'),(589,1205,9,'0028'),(590,1206,9,'0029'),(591,1207,9,'0030'),(592,1208,9,'0031'),(593,1209,9,'0032'),(594,1210,9,'0033'),(595,1211,9,'0034'),(596,1212,9,'0035'),(597,1213,9,'0036'),(598,1214,9,'0037'),(599,1215,9,'0038'),(600,1216,9,'0039'),(601,1217,9,'0040'),(602,1218,9,'0041'),(603,1219,9,'0042'),(604,1220,9,'0045'),(605,1221,9,'0046'),(606,1222,9,'0047'),(607,1223,9,'0048'),(608,1224,9,'0049'),(609,1225,9,NULL),(610,1226,9,'0051'),(611,1227,9,'0052'),(612,1228,9,'0053'),(613,1229,9,'0054'),(614,1230,9,'0055'),(615,1231,9,'0056'),(616,1232,9,'0057'),(617,1233,9,'0058'),(618,1234,9,'0059'),(619,1235,9,'0060'),(620,1236,9,'0061'),(621,1237,9,'0062'),(622,1238,9,'0063'),(623,1239,9,'0064'),(624,1240,9,'0065'),(625,1241,9,'0066'),(626,1242,9,'0067'),(627,1243,9,'0068'),(628,1244,9,'0069'),(629,1245,9,'0070'),(630,1246,9,'0071'),(631,1247,9,'0072'),(632,1248,9,'0073'),(633,1249,9,'0074'),(634,1250,9,'0075'),(635,1251,9,'0076'),(636,1252,9,'0077'),(637,1253,9,'0078'),(638,1254,9,'0079'),(639,1255,9,'0080'),(640,1256,9,'0081'),(641,1257,9,'0082'),(642,1258,9,'0083'),(643,1259,9,'0084'),(644,1260,9,'0085'),(645,1261,9,'0086'),(646,1262,9,'0087'),(647,1263,9,'0088'),(648,1264,9,'0089'),(649,1265,9,'0090'),(650,1266,9,'0091'),(651,1267,9,'0092'),(652,1268,9,'0093'),(653,1269,9,'0094'),(654,1270,9,'0095'),(655,1271,9,'0096'),(656,1272,9,'0097'),(657,1273,9,'0098'),(658,1274,9,'0099'),(659,1275,9,'0100'),(660,1276,9,'1101'),(661,1277,9,'0102'),(662,1278,9,'0103'),(663,1279,9,'0104'),(664,1280,9,'0105'),(665,1281,9,'0106'),(666,1282,9,'0107'),(667,1283,9,'0108'),(668,1284,9,'0109'),(669,1285,9,'0110'),(670,1286,9,'0111'),(671,1287,9,'0112'),(672,1288,9,'0113'),(673,1289,9,'0114'),(674,1290,9,'0115'),(675,1291,9,'0116'),(676,1292,9,'0117'),(677,1293,9,'0118'),(678,1294,9,'0119'),(679,1295,9,'0120'),(680,1296,9,'0121'),(681,1297,9,'0122'),(682,1298,9,'0123'),(683,1299,9,NULL),(684,1300,9,NULL),(685,1301,9,NULL),(686,1302,9,NULL),(687,1303,9,NULL),(688,1304,9,NULL),(689,1305,9,NULL),(690,1306,9,NULL),(691,1307,9,NULL),(692,1308,9,NULL),(693,1309,9,NULL),(694,1310,9,NULL),(695,1311,9,NULL),(696,1312,9,NULL),(697,1313,9,NULL),(698,1314,9,NULL),(699,1315,9,NULL),(700,1316,9,NULL),(701,1317,9,NULL),(702,1318,9,NULL),(703,1319,9,NULL),(704,1320,9,NULL),(705,1321,9,NULL),(706,1322,9,NULL),(707,1323,9,NULL),(708,1324,9,NULL),(709,1325,9,NULL),(710,1326,9,NULL),(711,1327,9,NULL),(712,1328,9,NULL),(713,1329,9,NULL),(714,1330,9,NULL),(715,1331,9,NULL),(716,1332,9,NULL),(717,1333,9,NULL),(718,1334,9,NULL),(719,1335,9,NULL),(720,1336,9,NULL),(721,1337,9,NULL),(722,1338,9,NULL),(723,1339,9,NULL),(724,1340,9,NULL),(725,1341,9,NULL),(726,1342,9,NULL),(727,1343,9,NULL),(728,1344,9,NULL),(729,1345,9,NULL),(730,1346,9,NULL);
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
-- Table structure for table `assistant_respue`
--

DROP TABLE IF EXISTS `assistant_respue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assistant_respue` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_by_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `respue_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6C24CB36A76ED395` (`user_id`),
  KEY `IDX_6C24CB36B03A8386` (`created_by_id`),
  KEY `IDX_6C24CB36D23FE2F9` (`respue_id`),
  CONSTRAINT `FK_6C24CB36A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_6C24CB36B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_6C24CB36D23FE2F9` FOREIGN KEY (`respue_id`) REFERENCES `resp_ue` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assistant_respue`
--

LOCK TABLES `assistant_respue` WRITE;
/*!40000 ALTER TABLE `assistant_respue` DISABLE KEYS */;
/*!40000 ALTER TABLE `assistant_respue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assistant_teacher`
--

DROP TABLE IF EXISTS `assistant_teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assistant_teacher` (
  `id` int NOT NULL AUTO_INCREMENT,
  `teacher_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8C7D7745A76ED395` (`user_id`),
  KEY `IDX_8C7D774541807E1D` (`teacher_id`),
  CONSTRAINT `FK_8C7D774541807E1D` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`),
  CONSTRAINT `FK_8C7D7745A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assistant_teacher`
--

LOCK TABLES `assistant_teacher` WRITE;
/*!40000 ALTER TABLE `assistant_teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `assistant_teacher` ENABLE KEYS */;
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
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20240724121906','2024-07-24 12:19:49',1835),('DoctrineMigrations\\Version20240729144819','2024-07-29 14:49:53',4087),('DoctrineMigrations\\Version20240729151416','2024-07-29 15:14:23',4891),('DoctrineMigrations\\Version20240730122317','2024-07-30 12:23:26',10222),('DoctrineMigrations\\Version20240802120103','2024-08-02 12:01:15',1748);
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
  `teacher_id` int DEFAULT NULL,
  `code_ec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_tp` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8DE8BDFF62E883B1` (`ue_id`),
  KEY `IDX_8DE8BDFF41807E1D` (`teacher_id`),
  CONSTRAINT `FK_8DE8BDFF41807E1D` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_8DE8BDFF62E883B1` FOREIGN KEY (`ue_id`) REFERENCES `ue` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ec`
--

LOCK TABLES `ec` WRITE;
/*!40000 ALTER TABLE `ec` DISABLE KEYS */;
INSERT INTO `ec` VALUES (7,14,20,'ISN4411','Gamification, psychologie et sociologie du Gamer','asdfghjkl','3',1),(8,14,20,'ISN4121','Création graphique','asdfghjkl','3',1),(9,14,20,'IGN4111','Normes, et labélisation en entreprises numériques','asdfghjkl','2.5',1),(10,14,20,'IGN4111','Management de la qualité et Analyse des risques','asdfghjkl','2.5',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field`
--

LOCK TABLES `field` WRITE;
/*!40000 ALTER TABLE `field` DISABLE KEYS */;
INSERT INTO `field` VALUES (1,1,'CDN','Création et Design Numérique','Création et Design Numérique'),(2,1,'INS','Igenierie Numerique Sociotechnique','Igenierie Numerique Sociotechnique'),(125,1,'ISN','Ingenierie des Systemes Numeriques','sdgsdhjfj');
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
) ENGINE=InnoDB AUTO_INCREMENT=418 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level`
--

LOCK TABLES `level` WRITE;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` VALUES (379,1,'L1'),(380,1,'L2'),(381,1,'L3'),(382,1,'M1'),(383,1,'M2'),(384,125,'L1'),(385,125,'L2'),(386,125,'L3'),(387,125,'M1'),(388,125,'M2'),(389,2,'L1'),(390,2,'L2'),(391,2,'L3'),(392,2,'M1'),(393,2,'M2');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resp_field`
--

LOCK TABLES `resp_field` WRITE;
/*!40000 ALTER TABLE `resp_field` DISABLE KEYS */;
INSERT INTO `resp_field` VALUES (8,1,40,'Ondombo','100147852','697379517','ondombo@gmail.com','2024-08-02 10:16:07'),(9,2,40,'Mignam Missi','100123456','676469014','mignam@gmail.com','2024-08-02 10:17:11'),(10,125,40,'Amougou Ngoumou','100235689','697379517','amougou@gmail.com','2024-08-02 10:17:36');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resp_level`
--

LOCK TABLES `resp_level` WRITE;
/*!40000 ALTER TABLE `resp_level` DISABLE KEYS */;
INSERT INTO `resp_level` VALUES (8,41,379,'Aba\'a Aba\'a','100123654','676469014','abaa@gmail.com','2024-08-02 10:59:44'),(9,41,380,'Ango Brinda','100236547','697379517','agnesgrey@gmail.com','2024-08-02 11:01:02'),(10,41,381,'Djeninga','100147852','676469014','djeninga@gmail.com','2024-08-02 11:01:58'),(11,43,384,'Eyenga Tatiana','100235689','676469014','eyenga@gmail.com','2024-08-02 11:04:25'),(12,43,385,'Emane Bile Félicien Davy','100235689','697379517','davyemane2@gmail.com','2024-08-02 11:05:14'),(13,43,386,'Tapiba Brandon','100214587','697379517','tapiba@gmail.com','2024-08-02 11:05:48'),(14,42,389,'Eloundou Telesphore','2001456987','676469014','bile@gmail.com','2024-08-02 11:09:53'),(15,42,390,'Emane davy','2001456984','676469014','bile@gmail.com','2024-08-02 11:10:26'),(16,42,391,'félicien davy','2101456987','676469014','bile@gmail.com','2024-08-02 11:11:57');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resp_school`
--

LOCK TABLES `resp_school` WRITE;
/*!40000 ALTER TABLE `resp_school` DISABLE KEYS */;
INSERT INTO `resp_school` VALUES (4,1,4,'Fouda Ndjotto','1002356889','676469014','fouda@gmail.com','2024-08-02 10:13:53');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resp_ue`
--

LOCK TABLES `resp_ue` WRITE;
/*!40000 ALTER TABLE `resp_ue` DISABLE KEYS */;
INSERT INTO `resp_ue` VALUES (12,14,52,'felicien1','3002154789','Felicien@gmail.com','697379517','2024-08-02 11:35:54'),(13,15,52,'Felicien Bile','12003456789','Felicien@gmail.com','676469014','2024-08-02 11:36:39'),(14,16,52,'felicien3','3002154789','Felicien@gmail.com','697379517','2024-08-02 11:37:35'),(15,17,52,'Felicien Bile davy','500123654','Felicien@gmail.com','676469014','2024-08-02 11:38:31');
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
) ENGINE=InnoDB AUTO_INCREMENT=1392 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1057,125,386,NULL,'ABOLO EMMANUEL ROMARIC ',NULL,'658386150',NULL,'KONGO-SANGMELIMA ',NULL,NULL,'MASCULIN','100112487','CAMEROUN'),(1058,125,386,NULL,'AKONO JORDAN KEVIN DESIRE',NULL,'691548568',NULL,'SANGMELIMA',NULL,NULL,'MASCULIN','1169885165','CAMEROUN'),(1059,125,386,NULL,'ALI OUMAR GUINDO',NULL,'698243468',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','250665','CAMEROUN'),(1060,125,386,NULL,'ALIMA LOUIS GEORGES RUSSEL',NULL,'696281943',NULL,'ABANG-MINDI',NULL,NULL,'MASCULIN','101358970','CAMEROUN'),(1061,125,386,NULL,'ANGO ABONDO LOIC GAETAN',NULL,'695222456',NULL,'MBALMAYO',NULL,NULL,'MASCULIN','100756098','CAMEROUN'),(1062,125,386,NULL,'ANGO BRINDA',NULL,'655387746',NULL,'MEYOMESSALA',NULL,NULL,'FEMININ','118406917','CAMEROUN'),(1063,125,386,NULL,'ANGONI EDJO YVON-ROSSI',NULL,'657075980',NULL,'AMBAM',NULL,NULL,'MASCULIN','100836691','CAMEROUN'),(1064,125,386,NULL,'APEMBET-ALECK VIRGILE YANN',NULL,'653348310',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0371914','CONGO'),(1065,125,386,NULL,'ATEBA MEZUI MANUEL BRAYANE',NULL,'699003338',NULL,'NOMAYOS',NULL,NULL,'MASCULIN','100849524','CAMEROUN'),(1066,125,386,NULL,'AZEUFACK NDOMO AURELLE',NULL,'697465529',NULL,'CSI DE FONGO-TONGO',NULL,NULL,'FEMININ','101000107','CAMEROUN'),(1067,125,386,NULL,'BAKEHE WILLIAM STEVE',NULL,'656704510',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','CE11051I5IT2WI20D9X3','CAMEROUN'),(1068,125,386,NULL,'BASSANG\'NA BELIAS ESDRA DONALD',NULL,'694067382',NULL,'BAFIA',NULL,NULL,'MASCULIN','100715266','CAMEROUN'),(1069,125,386,NULL,'BEY NICAISE NICKSON',NULL,'653174157',NULL,'DJAMBALA',NULL,NULL,'MASCULIN','OA0209799','CONGO'),(1070,125,386,NULL,'BIDIAS AMBASSA MIKE DANIEL',NULL,'695506495',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','100161952','CAMEROUN'),(1071,125,386,NULL,'BILOA ABENG ARISTIDE PAULIN ',NULL,'694891138',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','116991072','CAMEROUN'),(1072,125,386,NULL,'BISNAMOU ANORSA DONCHRIST JODAS',NULL,'654013872',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0403546','CONGO'),(1073,125,386,NULL,'BOPETO GRACE',NULL,'653342116',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0373596','CONGO'),(1074,125,386,NULL,'BOUMBA GILBERTRON-BRUNET',NULL,'654484542',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0403099','CONGO'),(1075,125,386,NULL,'BOUMBOU KIMBATSA VERLY ',NULL,'653343959',NULL,'DOLISIE',NULL,NULL,'MASCULIN','OA0397844','CONGO'),(1076,125,386,NULL,'DE BELKO RUBIS URIEL ',NULL,'655468822',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0237425','CONGO'),(1077,125,386,NULL,'DIAYIKA BITELO UJYSSI DUGECE',NULL,'656282491',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0401902','CONGO'),(1078,125,386,NULL,'DOBGIMA DARRYL WOBA',NULL,'653585007',NULL,'PROVINCIAL HOSPITAL BAMENDA',NULL,NULL,'MASCULIN','100644269','CAMEROUN'),(1079,125,386,NULL,'DZANGA ESDRAS NEHEMIE ',NULL,'653216094',NULL,'NKAYI',NULL,NULL,'MASCULIN','OA0403072','CONGO'),(1080,125,386,NULL,'DZIENGUE DE MOUCAUT VHAN',NULL,'653343227',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0394476','CONGO'),(1081,125,386,NULL,'EBOMB-SIMBA AU-GIRAL-AMED',NULL,'653216004',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','5,1199E+11','CONGO'),(1082,125,386,NULL,'EFOUA ZAME RENE ROMUALD',NULL,'656893683',NULL,'ATONG-ESSE',NULL,NULL,'MASCULIN','SU02397I5ITOLTMEJ5X6','CAMEROUN'),(1083,125,386,NULL,'EKOH FIFEN EPOH GILLIAM',NULL,'682850637',NULL,'LA MATERNITE DE BANGANGTE',NULL,NULL,'MASCULIN','100562067','CAMEROUN'),(1084,125,386,NULL,'ELANGA PHILIPPE LAURAINE',NULL,'699534152',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','371447','CAMEROUN'),(1085,125,386,NULL,'ELENGA GOMEZ RUDEN NAGGAI',NULL,'658067802',NULL,'GAMBOMA',NULL,NULL,'MASCULIN','OA0386744','CONGO'),(1086,125,386,NULL,'ELLA KRIS DAVID STEEVE',NULL,'693647116',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','100662785','CAMEROUN'),(1087,125,386,NULL,'EMANE BILE FELICIEN DAVY ',NULL,'693137615',NULL,'NDJOM-YEKOMBO',NULL,NULL,'MASCULIN','100618557','CAMEROUN'),(1088,125,386,NULL,'ENGBWANG NGO\'O ERIC HANS',NULL,'695382052',NULL,'BENGBIS',NULL,NULL,'MASCULIN','116449186','CAMEROUN'),(1089,125,386,NULL,'ENGUENE AKONO ANDY DALYL KARYM',NULL,'654817080',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','632605','CAMEROUN'),(1090,125,386,NULL,'ENGUENE MBALA MARK WILIAM',NULL,'695686085',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','100037220','CAMEROUN'),(1091,125,386,NULL,'EPOI DIDI DANIEL MAELLE',NULL,'652157788',NULL,'BATOURI',NULL,NULL,'MASCULIN','100986503','CAMEROUN'),(1092,125,386,NULL,'ESSANGA DAVE MICHEL',NULL,'691681982',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0371953','CONGO'),(1093,125,386,NULL,'EYENGA ONDOUA PELZA ARLIE',NULL,'656102008',NULL,'YAOUNDE',NULL,NULL,'FEMININ','CE73241I5ISZ7BF943H0','CAMEROUN'),(1094,125,386,NULL,'FEUWO BIBIANG EPHREIM',NULL,'690946161',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','CE70031I5IT09VJACSG2','CAMEROUN'),(1095,125,386,NULL,'GAMBOU GODECHA CYBELLE BORNA',NULL,'654339652',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0403133','CONGO'),(1096,125,386,NULL,'GOMA FALLA LULIC MICHEL',NULL,'653327850',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0405187','CONGO'),(1097,125,386,NULL,'HOUADINA TSONI JUVELDY DIANCEL',NULL,'695738098',NULL,'YAYA',NULL,NULL,'MASCULIN','OA0403124','CONGO'),(1098,125,386,NULL,'IBOUANGA NZIENGUI ALVIN CHARLEME',NULL,'691614623',NULL,'DOLISIE',NULL,NULL,'MASCULIN','OA0388826','CONGO'),(1099,125,386,NULL,'KAGHO GHOGUE ADRIEN ',NULL,'698047545',NULL,'BALEVENG',NULL,NULL,'MASCULIN','494987','CAMEROUN'),(1100,125,386,NULL,'KAMGA KAMGUE YVAN RICHENEL ',NULL,'696527034',NULL,'BALENG',NULL,NULL,'MASCULIN','101050756','CAMEROUN'),(1101,125,386,NULL,'KHAM-MBONGO BELLAND BEAUDET',NULL,'654025770',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0399947','CONGO'),(1102,125,386,NULL,'KIBANDA ANTOINE ELVIS',NULL,'671145766',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0402220','CONGO'),(1103,125,386,NULL,'KITSOUKOU NGOUMA PAUL DESTINE',NULL,'695476445',NULL,'MONT BELO',NULL,NULL,'MASCULIN','OA0403058','CONGO'),(1104,125,386,NULL,'LAMBOU FOLA RAPHAELLA ROSE',NULL,'651579089',NULL,'PENKA-MICHEL',NULL,NULL,'FEMININ','100707363','CAMEROUN'),(1105,125,386,NULL,'LEBONI BAKLA LIONEL',NULL,'678954775',NULL,'MAYO-DARLE',NULL,NULL,'MASCULIN','101035064','CAMEROUN'),(1106,125,386,NULL,'LENDIT DIHAMOUGNONGOU TRAIDH BENISSAN',NULL,'653665611',NULL,'KIBANGOU',NULL,NULL,'MASCULIN','OA0400417','CONGO'),(1107,125,386,NULL,'LIEUMO NJOPNU MARCELLE ALIDA',NULL,'691471048',NULL,'BANGOUA',NULL,NULL,'FEMININ','100960500','CAMEROUN'),(1108,125,386,NULL,'MABIALA BERGIN',NULL,'691432067',NULL,'MAMBA NAYILOU',NULL,NULL,'MASCULIN','OA0400838','CONGO'),(1109,125,386,NULL,'MABIALA MAHOUNGOU JOURDAIN LE PRINCE',NULL,'654346362',NULL,'SIBITI',NULL,NULL,'MASCULIN','OA0387371','CONGO'),(1110,125,386,NULL,'MADZOU JUSTIN ARTHUR ',NULL,'653215403',NULL,'NKAYI',NULL,NULL,'MASCULIN','OA0392610','CONGO'),(1111,125,386,NULL,'MARALO MADI JEAN ',NULL,'695868185',NULL,'YAGOUA',NULL,NULL,'MASCULIN','101349474','CAMEROUN'),(1112,125,386,NULL,'MATAKON NGAROUA MODESTE',NULL,'693739871',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','100732458','CAMEROUN'),(1113,125,386,NULL,'MAVAIWA DESIRE DESIRE',NULL,'699437103',NULL,'MOKOLO',NULL,NULL,'MASCULIN','100454825','CAMEROUN'),(1114,125,386,NULL,'MAVOUNGOU BAYONNE FREDERIC DIEU-MERCI',NULL,'654484524',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0401887','CONGO'),(1115,125,386,NULL,'MBEGA MVOGO BASILE WILLIAM YANNIS',NULL,'697248930',NULL,'ENONGAL',NULL,NULL,'MASCULIN','100728720','CAMEROUN'),(1116,125,386,NULL,'MBENGUE EBOUGNAKA CHARDELAND JOCLAISSE',NULL,'653353873',NULL,'MOSSAKA',NULL,NULL,'MASCULIN','OA0403737','CONGO'),(1117,125,386,NULL,'MEDJO ASSAM PIERRE DANY',NULL,'658400299',NULL,'ENONGAL',NULL,NULL,'MASCULIN','SE02397I5IT2TR5XDF12','CAMEROUN'),(1118,125,386,NULL,'MENDO OLAME LEO',NULL,'691607942',NULL,'BENGBIS',NULL,NULL,'MASCULIN','CE54353I5IT2WYX6U3BO','CAMEROUN'),(1119,125,386,NULL,'MENYE PEGGUY FLORA',NULL,'655147258',NULL,'YAOUNDE',NULL,NULL,'FEMININ','694316','CAMEROUN'),(1120,125,386,NULL,'MESSOA YENE STEPHANE ERWAN',NULL,'691127912',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','100630823','CAMEROUN'),(1121,125,386,NULL,'MEZANGA M\'ENGOLO ROMARIC JUNIOR',NULL,'696021911',NULL,'MVOUA',NULL,NULL,'MASCULIN','665494','CAMEROUN'),(1122,125,386,NULL,'MIERE NGAMI HERMICHE ANIREL',NULL,'653214782',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0402662','CONGO'),(1123,125,386,NULL,'MISSILOU BIANTOUARI RODNEY GODNI',NULL,'676551138',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0403361','CONGO'),(1124,125,386,NULL,'MOKOMBA CLAUDE LAUREAT SAGESSE',NULL,'653216132',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0425835','CONGO'),(1125,125,386,NULL,'MOMBOULI ELION BERITH BIENVENU',NULL,'650116031',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0403456','CONGO'),(1126,125,386,NULL,'MONGOUO ELYSE FLAV-LEGRAND',NULL,'653344059',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0284281','CONGO'),(1127,125,386,NULL,'MOUISSOU-LOUNGOUEDI DESTINEE TENDRESS',NULL,'653363389',NULL,'POINTE-NOIRE',NULL,NULL,'FEMININ','OA0402666','CONGO'),(1128,125,386,NULL,'MOUKOKO AHOUTA EXAUCE DIEU VEILLE',NULL,'651464222',NULL,'BILALA',NULL,NULL,'FEMININ','OA0396960','CONGO'),(1129,125,386,NULL,'MOUKOLAUD NIMI ROLLSY EDVY',NULL,'653642055',NULL,'MOUINDI ',NULL,NULL,'MASCULIN','OA0403010','CONGO'),(1130,125,386,NULL,'MOUNZEO CHANTY LIONNEL',NULL,'653327438',NULL,'POINTE NOIRE',NULL,NULL,'MASCULIN','OA0403013','CONGO'),(1131,125,386,NULL,'MOUSSAVOU MANFOUMBI ABDON RICARDO',NULL,'653326592',NULL,'BIHONGO',NULL,NULL,'MASCULIN','OA0401990','CONGO'),(1132,125,386,NULL,'MOUYARI NTSIBA BREME RIVINA',NULL,'658552660',NULL,'SIBITI',NULL,NULL,'MASCULIN','OA0403547','CONGO'),(1133,125,386,NULL,'MVE ENGUENE JOSUE JOEL',NULL,'695257976',NULL,'AYOS',NULL,NULL,'MASCULIN','101261452','CAMEROUN'),(1134,125,386,NULL,'NALINGUI JUDICAELE VICTOIRE ARIANE ',NULL,'697689913',NULL,'SANGMELIMA',NULL,NULL,'FEMININ','684362','CAMEROUN'),(1135,125,386,NULL,'NCHINDA SONKOUAT JOEL',NULL,'677870525',NULL,'MBOUDA',NULL,NULL,'MASCULIN','100966071','CAMEROUN'),(1136,125,386,NULL,'NDINGOSSOKA RAPHAEL DILAN',NULL,'671430247',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0373051','CONGO'),(1137,125,386,NULL,'NDJESSE LETERE EMMANUEL ANDY',NULL,'699527389',NULL,'YAOUNDE 1ER',NULL,NULL,'MASCULIN','100504939','CAMEROUN'),(1138,125,386,NULL,'NDONG MEDJO DANIEL PHANUEL',NULL,'655484371',NULL,'SANGMELIMA ',NULL,NULL,'MASCULIN','101180262','CAMEROUN'),(1139,125,386,NULL,'NDONGA ISEPT DANNIELLE',NULL,'696479727',NULL,'YAOUNDE',NULL,NULL,'FEMININ','100443877','CAMEROUN'),(1140,125,386,NULL,'NDOUDI GLAIDE JUD-STANY',NULL,'653353552',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0403141','CONGO'),(1141,125,386,NULL,'N\'DOUM MEUKOUBIAT DON-SANCTIFIE',NULL,'653328479',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0403139','CONGO'),(1142,125,386,NULL,'NGAMOUE MATONDO PATIENCE JOSCARVY',NULL,'658121929',NULL,'KINGOUE',NULL,NULL,'MASCULIN','OA0312299','CONGO'),(1143,125,386,NULL,'NGAZANG ONDOUA JUSTINE FLEUR REINE',NULL,'693340476',NULL,'NANGA-EBOKO',NULL,NULL,'FEMININ','CE05027I5IT4TS7Q0P63','CAMEROUN'),(1144,125,386,NULL,'NGOMA OLIVIER GIRESSE LADRY',NULL,'671399403',NULL,'LOUBOTO',NULL,NULL,'MASCULIN','OA0359372','CONGO'),(1145,125,386,NULL,'NGOMA SPAAK JOBRIGH',NULL,'671761403',NULL,'SIBITI',NULL,NULL,'MASCULIN','OA0403127','CONGO'),(1146,125,386,NULL,'NGOUALA BAKALA GHIRES FRANCK',NULL,'678627724',NULL,'DOLISIE',NULL,NULL,'MASCULIN','OA0403100','CONGO'),(1147,125,386,NULL,'NGOUANGA NGUEBANZOLA JURD',NULL,'2428981626',NULL,'DOLISIE',NULL,NULL,'MASCULIN','OA0401984','CONGO'),(1148,125,386,NULL,'NISSO KANE RAPHAEL ROSE DEMABIAH',NULL,'696900289',NULL,'YAOUNDE',NULL,NULL,'FEMININ','100713677','CAMEROUN'),(1149,125,386,NULL,'NKOLO BOMBA MARC LUDOVIC',NULL,'690280553',NULL,'EKOMBITE',NULL,NULL,'MASCULIN','518396','CAMEROUN'),(1150,125,386,NULL,'NKOTO STEVE BRANDON PARFAIT-JUNIOR',NULL,'656929316',NULL,'AMBAM',NULL,NULL,'MASCULIN','100200040','CAMEROUN'),(1151,125,386,NULL,'NKOTTO FRANCK DYLAN',NULL,'656380118',NULL,'DOUALA',NULL,NULL,'MASCULIN','101164642','CAMEROUN'),(1152,125,386,NULL,'NKOU MAICK DANE',NULL,'654034915',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0400221','CONGO'),(1153,125,386,NULL,'NKOUKA HERMAN CHRIJIVEL',NULL,'654034856',NULL,'MANTSOUMBA',NULL,NULL,'MASCULIN','OA0403130','CONGO'),(1154,125,386,NULL,'NNA BANGA BRICE JACQUARD',NULL,'656 95 97 05',NULL,'MATERNITE DE MVOMEKA\'A',NULL,NULL,'MASCULIN','101200017','CAMEROUN'),(1155,125,386,NULL,'NOUMA LUDOVIC',NULL,'693693868',NULL,'EBOLOWA',NULL,NULL,'MASCULIN','100630220','CAMEROUN'),(1156,125,386,NULL,'NOUMBISSI KUITCHE STAEL ERVANE',NULL,'695789896',NULL,'BALENG',NULL,NULL,'MASCULIN','100503685','CAMEROUN'),(1157,125,386,NULL,'NOUNGA NJAPOM MARTIAL DIMITRI',NULL,'691790529',NULL,'BAFOUSSAM',NULL,NULL,'MASCULIN','100650736','CAMEROUN'),(1158,125,386,NULL,'NZENGUI ALVY GUYCHEL',NULL,'698763726',NULL,'DOLISIE',NULL,NULL,'MASCULIN','OA0397529','CONGO'),(1159,125,386,NULL,'OFFOUILLA BEAZAMBE RAHAB PREDESTINEE',NULL,'653215707',NULL,'GAMBOMA',NULL,NULL,'FEMININ','OA0392901','CONGO'),(1160,125,386,NULL,'OHOUNGA CHARNELI ',NULL,'654034384',NULL,'OWANDO',NULL,NULL,'MASCULIN','OA0400246','CONGO'),(1161,125,386,NULL,'OHOUNGA CHRICHNEL',NULL,'658797842',NULL,'OWANDO',NULL,NULL,'MASCULIN','OA0400322','CONGO'),(1162,125,386,NULL,'OMBI MOÏNELH PARDON',NULL,'653640324',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0405363','CONGO'),(1163,125,386,NULL,'ONANA MBA MICHEL',NULL,'695930714',NULL,'MFOU',NULL,NULL,'MASCULIN','100486965','CAMEROUN'),(1164,125,386,NULL,'OUSMANE MERIGA',NULL,'655515035',NULL,'GAROUA',NULL,NULL,'MASCULIN','100490326','CAMEROUN'),(1165,125,386,NULL,'PRINCE MVENG LOUIS DIEUDONNE',NULL,'698050730',NULL,'EBOLOWA',NULL,NULL,'MASCULIN','100091116','CAMEROUN'),(1166,125,386,NULL,'SAMARAHA',NULL,'695464478',NULL,'TOKOMBERE',NULL,NULL,'MASCULIN','LT08080I5ISSY73ATXY5','CAMEROUN'),(1167,125,386,NULL,'SANDJIO NGUEGNANG PATRICK',NULL,'682289523',NULL,'BANGWA',NULL,NULL,'MASCULIN','101076291','CAMEROUN'),(1168,125,386,NULL,'SAS-HOLL VERONIQUE PATIENCE',NULL,'696132506',NULL,'DOUALA',NULL,NULL,'FEMININ','100281279','CAMEROUN'),(1169,125,386,NULL,'SENDZI SAMUEL JUDE',NULL,'651475363',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0386182','CONGO'),(1170,125,386,NULL,'TAPIBA BRANDON TAPIBA',NULL,'676291190',NULL,'NKWEN BAMENDA',NULL,NULL,'MASCULIN','1003338850','CAMEROUN'),(1171,125,386,NULL,'VINDOU LYOD PRELUDE',NULL,'653215929',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0403544','CONGO'),(1172,125,386,NULL,'VOUNDI ABESSOLO PAUL YVAN KHERAN',NULL,'691062384',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','7644781','CAMEROUN'),(1173,125,386,NULL,'VOUNDI BISSILA ETIENNE DIEUDONNE ROUSSEL',NULL,'695912009',NULL,'EMANA-YAOUNDE I',NULL,NULL,'MASCULIN','101208192','CAMEROUN'),(1174,125,386,NULL,'YEPMENI KOUAMEGNE MANUELLA OLIVIA',NULL,'693887032',NULL,'BONABERI-DOUALA',NULL,NULL,'FEMININ','118006006','CAMEROUN'),(1175,125,386,NULL,'ZE MINLA\'A MEXIN ROBERTSON ',NULL,'697470146',NULL,'DJOUM',NULL,NULL,'MASCULIN','101208168','CAMEROUN'),(1176,125,386,NULL,'ZEH ZE ARNAULD DANIEL',NULL,'656195342',NULL,'EBEZOM',NULL,NULL,'MASCULIN','CE14162I5IT2TQZQPR16','CAMEROUN'),(1177,125,386,NULL,'ZO\'ONYABA ASSE JORDAN',NULL,'656693676',NULL,'YAOUNDE ',NULL,NULL,'MASCULIN','118347775','CAMEROUN'),(1178,2,391,NULL,'ABEME ATOUBA SAMUEL NOEL',NULL,'694875159',NULL,'KONDEMEYOS',NULL,NULL,'MASCULIN','624417','CAMEROUN'),(1179,2,391,NULL,'ABESSOLO ETONG NEIL ARTHUR',NULL,'696004029',NULL,'LA MATERNITE DE METET',NULL,NULL,'MASCULIN','101193266','CAMEROUN'),(1180,2,391,NULL,'ABESSOLO JEAN FERRY',NULL,'698602962',NULL,'WOABETE',NULL,NULL,'MASCULIN','100744390','CAMEROUN'),(1181,2,391,NULL,'ABOURI DAM CHRICE',NULL,'657421021',NULL,'OWANDO',NULL,NULL,'MASCULIN','OA0402665','CONGO'),(1182,2,391,NULL,'AFANE OYONO RANDY STEPHANE',NULL,'655519271',NULL,'SANGMELIMA',NULL,NULL,'MASCULIN','101073317','CAMEROUN'),(1183,2,391,NULL,'AISSATOU ATINE',NULL,'695067113',NULL,'YAOUNDE',NULL,NULL,'FEMININ','100367673','CAMEROUN'),(1184,2,391,NULL,'AMANI HAMAN MERVEILLES ',NULL,'698364487',NULL,'YAOUNDE II',NULL,NULL,'FEMININ','N0E7124I5IT1K9NVWP72','CAMEROUN'),(1185,2,391,NULL,'AMBETO SAGE PATRICK',NULL,'2,4206E+11',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','1,1197E+11','CONGO'),(1186,2,391,NULL,'AMOR ELISABETH YVANA',NULL,'693293280',NULL,'METET',NULL,NULL,'FEMININ','101265547','CAMEROUN'),(1187,2,391,NULL,'ATSABOUSSA PAULE ANGELICA ',NULL,'653215659',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0406083','CONGO'),(1188,2,391,NULL,'AWANI LANKISSA ELLA',NULL,'698746981',NULL,'GAROUA',NULL,NULL,'FEMININ','100001333','CAMEROUN'),(1189,2,391,NULL,'AYINA BENG DURELLE ARMELLE',NULL,'677761374',NULL,'EFOK',NULL,NULL,'FEMININ',' ','CAMEROUN'),(1190,2,391,NULL,'BADZOUE JOSTY RONECH',NULL,'657145677',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0399318','CONGO'),(1191,2,391,NULL,'BADZOUE MAÏGA CHESTINA',NULL,'690736217',NULL,'BRAZAVILLE',NULL,NULL,'FEMININ','OA0400725','CONGO'),(1192,2,391,NULL,'BAKALA DIVIN JOSUE',NULL,'653326535',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0399344','CONGO'),(1193,2,391,NULL,'BANTSIMBA MERVEILLE ESTER',NULL,'671708671',NULL,'POINTE-NOIRE',NULL,NULL,'FEMININ','OA0402400','CONGO'),(1194,2,391,NULL,'BENAZO LOTY ADELIA MARYMEDH ',NULL,'655052375',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA03004101','CONGO'),(1195,2,391,NULL,'BENDIE ATANGANA CHARLES',NULL,'655750178',NULL,'BIPINDI',NULL,NULL,'MASCULIN','838280','CAMEROUN'),(1196,2,391,NULL,'BENE MENDOMO MARTIAL BORIS',NULL,'693 28 69 55',NULL,'EKOMBITE',NULL,NULL,'MASCULIN','SU0123DI5IT2TBBDPA8Y2','CAMEROUN'),(1197,2,391,NULL,'BILACK DONGO ROSE MAEVA',NULL,'691274495',NULL,'YAOUNDE',NULL,NULL,'FEMININ','101127071','CAMEROUN'),(1198,2,391,NULL,'BIYONG BWAME CHARLOTTE AUDREY',NULL,'693343035',NULL,'YAOUNDE',NULL,NULL,'FEMININ','101096674','CAMEROUN'),(1199,2,391,NULL,'BOLEBANTOU EXAUCE MERCI RAMAH',NULL,'653214759',NULL,'KINKEMBO',NULL,NULL,'MASCULIN','OA0403138','CONGO'),(1200,2,391,NULL,'BONGO ANDY DUFRENNE GHIDOVIE ',NULL,'656367860',NULL,'POINTE-NOIRE',NULL,NULL,'FEMININ','OA0403075','CONGO'),(1201,2,391,NULL,'BOUANGA CHELDRIV',NULL,'654484970',NULL,'MOUINDI',NULL,NULL,'MASCULIN','OA0403007','CONGO'),(1202,2,391,NULL,'BOUKEYI AUGUSTA EXAUCE',NULL,'654020713',NULL,'BILINGA',NULL,NULL,'MASCULIN','OA0403023','CONGO'),(1203,2,391,NULL,'BOUYE BOUYE FRANKLIN LUDOVIC',NULL,'690310900',NULL,'ABONG-MBANG',NULL,NULL,'MASCULIN','101307605','CAMEROUN'),(1204,2,391,NULL,'DIAFOUKA FREDSUN GLOIRE DE PRINCE RICHE',NULL,'653326612',NULL,'POINTE NOIRE',NULL,NULL,'MASCULIN','OA0398974','CONGO'),(1205,2,391,NULL,'DURU FIDELE',NULL,'699471716',NULL,'NDENGUE EBOLOWA',NULL,NULL,'MASCULIN','100014859','CAMEROUN'),(1206,2,391,NULL,'DZINGA RAYMONY JOFRIN',NULL,'654319998',NULL,'MADINGOU',NULL,NULL,'MASCULIN','OA0403143','CONGO'),(1207,2,391,NULL,'DZIO RUTH DORCAS',NULL,'653341322',NULL,'DJAMBALA',NULL,NULL,'FEMININ','OA0403068','CONGO'),(1208,2,391,NULL,'EBODE BINDZI EMMANUEL TITUS ',NULL,'656200810',NULL,'EMANA YAOUNDE 1',NULL,NULL,'MASCULIN','101195375','CAMEROUN'),(1209,2,391,NULL,'EDIA ANGONI JOSIANE',NULL,'695353033',NULL,'NKOLEWODO',NULL,NULL,'FEMININ',' ','CAMEROUN'),(1210,2,391,NULL,'EKO\'O ONDJA\'A RAISSA',NULL,'691054795',NULL,'YEM-YEMFEK',NULL,NULL,'FEMININ','100664068','CAMEROUN'),(1211,2,391,NULL,'ELOALI NGWOYOU NDOWE CHEDRAC',NULL,'653197968',NULL,'NGO',NULL,NULL,'MASCULIN','OA0403016','CONGO'),(1212,2,391,NULL,'ELOUNDOU TSANGA IVAN BENOIT',NULL,'656793601',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','675408','CAMEROUN'),(1213,2,391,NULL,'EMA BELLA EMMANUEL JOSUE ',NULL,'695274882',NULL,'MBAYENGUE 1',NULL,NULL,'MASCULIN','101059857','CAMEROUN'),(1214,2,391,NULL,'EMATA NSOULI ALBAN PACOME',NULL,'657718542',NULL,'NDOKOU',NULL,NULL,'MASCULIN','100565821','CAMEROUN'),(1215,2,391,NULL,'EPOUPA MVELLE VERONIQUE JANICE',NULL,'693677541',NULL,'HOPITAL CENTRAL DE YAOUNDE 2',NULL,NULL,'FEMININ','CE23149I5IV42SO6HPR3','CAMEROUN'),(1216,2,391,NULL,'ESSO BERNICE TONIA',NULL,'695820953',NULL,'SANGMELIMA',NULL,NULL,'FEMININ',' ','CAMEROUN'),(1217,2,391,NULL,'ESSONO ETIENNE JOEL',NULL,'691957479',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','1161464353','CAMEROUN'),(1218,2,391,NULL,'ETOKA-IBEAHO FRANCKLIN SYLVER',NULL,'693329239',NULL,'OWANDO',NULL,NULL,'MASCULIN','OA0403063','CONGO'),(1219,2,391,NULL,'ETOUNDI CELESTIN',NULL,'691193398',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','100724183','CAMEROUN'),(1220,2,391,NULL,'EVINA FRANCKY',NULL,'699182376',NULL,'BENGBIS',NULL,NULL,'MASCULIN','100686349','CAMEROUN'),(1221,2,391,NULL,'EWANGOYI HUGOR BECKER',NULL,'653216099',NULL,'OYO',NULL,NULL,'MASCULIN','OA0403437','CONGO'),(1222,2,391,NULL,'FRED PARKER NDINDA MVEMBE ',NULL,'690151457',NULL,'BELABO',NULL,NULL,'MASCULIN','100826329','CAMEROUN'),(1223,2,391,NULL,'GAYABA MALELAS TONY CHRIST JOCEL',NULL,'653217464',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0402942','CONGO'),(1224,2,391,NULL,'GOBE ANTOUK CHRIS ROCHEL',NULL,'693886602',NULL,'BERTOUA',NULL,NULL,'MASCULIN',' ','CAMEROUN'),(1225,2,391,NULL,'GOMA NDOMBASSI SEVY JURES',NULL,'655923907',NULL,'LOUVAKOU',NULL,NULL,'MASCULIN','OA0402997','CONGO'),(1226,2,391,NULL,'HUNDWIMPUNDU-UWUZUYINEMA MARIE CLAIRE',NULL,'2,4205E+11',NULL,'GAMBOMA',NULL,NULL,'FEMININ','BZ0413KMV6HA8','CONGO'),(1227,2,391,NULL,'IBARA HARMONIE BLANCHE ',NULL,'653215697',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0402669','CONGO'),(1228,2,391,NULL,'IGNOUMBA-NGOMA ROMEO CREPIN',NULL,'653328341',NULL,'DOLISIE',NULL,NULL,'MASCULIN','OA0403097','CONGO'),(1229,2,391,NULL,'IKAMA METHODE MERLIN YOWAN',NULL,'653340848',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0397063','CONGO'),(1230,2,391,NULL,'INONGO NGADE CHRIS WILFRIED',NULL,'693647024',NULL,'MATERNITE DE KRIBI-VILLE',NULL,NULL,'MASCULIN','118344475','CAMEROUN'),(1231,2,391,NULL,'ISSANGOU MARLAND NICEME',NULL,'678368399',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0402657','CONGO'),(1232,2,391,NULL,'KANDA XAVIER ANDERSON',NULL,'671150097',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','1,11197E+12','CONGO'),(1233,2,391,NULL,'KAYA KIMBASSA BERTRAND MICHEL',NULL,'620001973',NULL,'DOLISIE',NULL,NULL,'MASCULIN','OA0402969','CONGO'),(1234,2,391,NULL,'KETE MOUAGASSA LUCILE GRACE',NULL,'653639254',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0380931','CONGO'),(1235,2,391,NULL,'KEYANTIO MANFOUO ULRICH LOIC',NULL,'696405916',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','611619','CAMEROUN'),(1236,2,391,NULL,'KIANGA MARDOCHE',NULL,'657631400',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','1,11197E+12','CONGO'),(1237,2,391,NULL,'KIBILA GAELLE STEVIE ',NULL,'658657117',NULL,'BOKO-SONGHO',NULL,NULL,'FEMININ','OA0402664','CONGO'),(1238,2,391,NULL,'KITEMO JOSS HARVEY',NULL,'653199977',NULL,'KOMONO',NULL,NULL,'MASCULIN','OA0403077','CONGO'),(1239,2,391,NULL,'KIYALOULOU GAD CHRETIEN ',NULL,'671713314',NULL,'BRAZAVILLE',NULL,NULL,'MASCULIN','1,11197E+12','CONGO'),(1240,2,391,NULL,'KOLOLO MAMBOUENITE VERMELONE MERCIA',NULL,'653344283',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0382662','CONGO'),(1241,2,391,NULL,'KOLYANG DINA TAIWE',NULL,'698477132',NULL,'NGAOUNDERE',NULL,NULL,'MASCULIN','478199','CAMEROUN'),(1242,2,391,NULL,'KPWANG KPWANG FRANCINE LEANDRINE',NULL,'691077215',NULL,'SANGMELIMA',NULL,NULL,'FEMININ','101221597','CAMEROUN'),(1243,2,391,NULL,'LEKEAKA NJINKENG',NULL,'673167313',NULL,'LEWOH-FOTABONG',NULL,NULL,'MASCULIN','575611','CAMEROUN'),(1244,2,391,NULL,'LOWEYA BOUITY VICTORIEN DAVICH',NULL,'693209678',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0403064','CONGO'),(1245,2,391,NULL,'MABIALA CELESTE-EMERA',NULL,'653215599',NULL,'POINTE-NOIRE',NULL,NULL,'FEMININ','OA0375708','CONGO'),(1246,2,391,NULL,'MABIALA KIBITI WEN BONHEUR',NULL,'653779559',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','1,31101E+12','CONGO'),(1247,2,391,NULL,'MABIALA-FILIPPI VICTOIRE IMMACULEE',NULL,'653618201',NULL,'POINTE-NOIRE',NULL,NULL,'FEMININ','OA0375707','CONGO'),(1248,2,391,NULL,'MABIKA RICHEY GLENN FAREL ',NULL,'653631349',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0372684','CONGO'),(1249,2,391,NULL,'MADOLA EMMA CYRIELLE SULAMITH',NULL,'695531996',NULL,'KRIBI',NULL,NULL,'FEMININ','100096259','CAMEROUN'),(1250,2,391,NULL,'MAKITA CHABREY TIPHERET ',NULL,'696993175',NULL,'NKAYI',NULL,NULL,'MASCULIN','OA0384301','CONGO'),(1251,2,391,NULL,'MALONGA JULIA RUTH',NULL,'653343690',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0397288','CONGO'),(1252,2,391,NULL,'MAMBO LARISSA FRU',NULL,'691774027',NULL,'BALI',NULL,NULL,'FEMININ','100202935','CAMEROUN'),(1253,2,391,NULL,'MANGA MVONDO HUBERT JUNIOR ',NULL,'690107650',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','SU0734615IT42S646RD2','CAMEROUN'),(1254,2,391,NULL,'MARTIN ARNAULD ZEH NKOU BA NKOUMOU',NULL,'655836673',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','101285399','CAMEROUN'),(1255,2,391,NULL,'MBAMA NGAPORO NAOMI PATRICIA',NULL,'656294510',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0387787','CONGO'),(1256,2,391,NULL,'MBEBI SOUMELONG ALAIN JUNIOR',NULL,'675821310',NULL,'MOUANGUEL',NULL,NULL,'MASCULIN','100578394','CAMEROUN'),(1257,2,391,NULL,'MBEYO\'O NNA WILFRIED',NULL,'698462766',NULL,'DJOUM',NULL,NULL,'MASCULIN','100664531','CAMEROUN'),(1258,2,391,NULL,'MBIA JACQUES FAUSTIN JUNIOR',NULL,'691289230',NULL,'HOPITAL ST LUC DE MBALMAYO',NULL,NULL,'MASCULIN','CE20206I5IT33V4IPLC1','CAMEROUN'),(1259,2,391,NULL,'MBITSI MAYEMBO GEORGELIN BELCOME',NULL,'657238579',NULL,'KIMBONGA LOUAMBA',NULL,NULL,'MASCULIN','OA0405953','CONGO'),(1260,2,391,NULL,'MBON IKITO ESTHER DAÏVA',NULL,'655971868',NULL,'YAOUNDE',NULL,NULL,'FEMININ','100903422','CAMEROUN'),(1261,2,391,NULL,'MBOUROUBOUNA-NGOULOU VALDY',NULL,'693216017',NULL,'SIBITI',NULL,NULL,'MASCULIN','OA0385489','CONGO'),(1262,2,391,NULL,'MENDO CHARLES AIME',NULL,'681306118',NULL,'EKALI 2',NULL,NULL,'MASCULIN',' ','CAMEROUN'),(1263,2,391,NULL,'MICHEL ANYOUZO\'O ANYOUZO\'O',NULL,'696267332',NULL,'MATERNITE DE DJOUM',NULL,NULL,'MASCULIN','100523479','CAMEROUN'),(1264,2,391,NULL,'MIHINDOU-MI MOUNDANGA DALLY GLOIRE BELMARD',NULL,'696230159',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0403062','CONGO'),(1265,2,391,NULL,'MINKOULOU ALPHONSE YANNICK',NULL,'690352930',NULL,'EKOUDENDI',NULL,NULL,'MASCULIN','101203647','CAMEROUN'),(1266,2,391,NULL,'MINSA MI NGBWA WILFRED LIN',NULL,'655111749',NULL,'LA MATERNITE DE SANGMELIMA',NULL,NULL,'MASCULIN','117428059','CAMEROUN'),(1267,2,391,NULL,'MINTYA MFOU\'OU INESSE ANDREA',NULL,'656390350',NULL,'NKOTENG',NULL,NULL,'FEMININ','101135787','CAMEROUN'),(1268,2,391,NULL,'MINTYA OBIANG DEUMENY KEVY',NULL,'656311254',NULL,'AMBAM',NULL,NULL,'MASCULIN',' ','CAMEROUN'),(1269,2,391,NULL,'MOKOUNGOU BENY FRANCK MASLOVE',NULL,'657484265',NULL,'MOSSAKA',NULL,NULL,'MASCULIN','OA0400845','CONGO'),(1270,2,391,NULL,'MONG NGO\'O MARC-AURELE',NULL,'696501083',NULL,'ABONG-MBANG',NULL,NULL,'MASCULIN','101100310','CAMEROUN'),(1271,2,391,NULL,'MOTO-EVINA ALINE CORINNE',NULL,'691770237',NULL,'MOLOUNDOU',NULL,NULL,'FEMININ','101170032','CAMEROUN'),(1272,2,391,NULL,'MOUABO OYONO DANIELLE JACQUY',NULL,'690440020',NULL,'MFOULADJA',NULL,NULL,'FEMININ','101170030','CAMEROUN'),(1273,2,391,NULL,'MOUANDA DIVIN GODFFROY',NULL,'696835525',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0402656','CONGO'),(1274,2,391,NULL,'MOUANDA MAVOUNGOU VALERE JIRESSE',NULL,'653619388',NULL,'DOLISIE',NULL,NULL,'MASCULIN','OA0304331','CONGO'),(1275,2,391,NULL,'MOUDIO ASSIENE ULRICH MAXIME',NULL,'695552422',NULL,'NDOP',NULL,NULL,'MASCULIN','SU02148I5IWDGGPNJ6','CAMEROUN'),(1276,2,391,NULL,'MOUILA IBALA CLIVER RABBI',NULL,'698386470',NULL,'DOLISIE',NULL,NULL,'MASCULIN','OA0403140','CONGO'),(1277,2,391,NULL,'MOUKOKO MABELE GUY HERGA',NULL,'655844999',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0243485','CONGO'),(1278,2,391,NULL,'MOULOUNDA-BIZENGA THESSIA ',NULL,'653619350',NULL,'MAYAMA',NULL,NULL,'FEMININ','OA0391067','CONGO'),(1279,2,391,NULL,'MOUNTAPMBEME ULRICH DARYL',NULL,'697330092',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','100463945','CAMEROUN'),(1280,2,391,NULL,'MOUNZIEHO MOMBO NICKEL DELVY',NULL,'693324797',NULL,'DOLISIE',NULL,NULL,'MASCULIN','OA0406084','CONGO'),(1281,2,391,NULL,'MOUYELE MBOU OVERNA DORIAN ',NULL,'657468630',NULL,'KIMALOU II',NULL,NULL,'MASCULIN','OA0386469','CONGO'),(1282,2,391,NULL,'MPAKA-LOMPOUNDA RELL-LAUREATE',NULL,'653344711',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0397536','CONGO'),(1283,2,391,NULL,'MPASSI ZEPHY EXAUCE ',NULL,'653348460',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0406884','CONGO'),(1284,2,391,NULL,'MPELE NTSOKO JONESLYE PRIDELCIA',NULL,'696018350',NULL,'POINTE-NOIRE',NULL,NULL,'FEMININ','OA0401986','CONGO'),(1285,2,391,NULL,'MPOLOGOSSO ODIVA IRENEE',NULL,'653210914',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0408896','CONGO'),(1286,2,391,NULL,'MVOGO EYENE AUSTIN',NULL,'682502863',NULL,'BIKOKA',NULL,NULL,'MASCULIN','CE05151I5IVFC6B82XN4','CAMEROUN'),(1287,2,391,NULL,'MVOMO EMANE HARRIS BERTRAND ',NULL,'696686462',NULL,'BENGBIS ',NULL,NULL,'MASCULIN','100371595','CAMEROUN'),(1288,2,391,NULL,'MVOUAMA AMOUR NADREL',NULL,'697820179',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0408249','CONGO'),(1289,2,391,NULL,'NDENDAME JEAN IRENE',NULL,'656684142',NULL,'NKOLETOTO',NULL,NULL,'MASCULIN','623010','CAMEROUN'),(1290,2,391,NULL,'NDOH MARYLIN BETUEL JULIA SHEILA',NULL,'653276093',NULL,'SANGMELIMA',NULL,NULL,'FEMININ','101314246','CAMEROUN'),(1291,2,391,NULL,'NDONGO IV STEPHANE',NULL,'695950852',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','624458','CAMEROUN'),(1292,2,391,NULL,'NDOUDI BASSOUMBA PRINCY GRACE',NULL,'654078992',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0403142','CONGO'),(1293,2,391,NULL,'NDOUMBE BANEN  REBECCA VIGNONNE',NULL,'697241016',NULL,'YAOUNDE',NULL,NULL,'FEMININ','101216337','CAMEROUN'),(1294,2,391,NULL,'NGALEKOUA MURIELLE ELVINA',NULL,'653327230',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0402218','CONGO'),(1295,2,391,NULL,'NGALOUO-NDO DANIELLE SEPHORA',NULL,'653215288',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0402393','CONGO'),(1296,2,391,NULL,'NGAMBAKA GAEL STEVEN OSTROD',NULL,'653359886',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0403071','CONGO'),(1297,2,391,NULL,'NGAMBAKA MPELE ARVEYE GEOLIVER',NULL,'658776892',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0403066','CONGO'),(1298,2,391,NULL,'NGAMI TACHINI VERDI ',NULL,'696817857',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0401989','CONGO'),(1299,2,391,NULL,'NGOLO GALEFOUROU NAHODY',NULL,'653217838',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0399343','CONGO'),(1300,2,391,NULL,'NGOMBE ONDZE GEDEON',NULL,'653199127',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0352166','CONGO'),(1301,2,391,NULL,'NGONO BELIBI MARIE LAURENCE',NULL,'673812598',NULL,'EKOUDENDI',NULL,NULL,'FEMININ','CE12280I5IT33UYX6Z11','CAMEROUN'),(1302,2,391,NULL,'NGONO KADA RACHELLE',NULL,'695904643',NULL,'MBALMAYO',NULL,NULL,'FEMININ','101300239','CAMEROUN'),(1303,2,391,NULL,'NGOUABE VIRTAVE-RUDES',NULL,'654421854',NULL,'EDIKANGOUE',NULL,NULL,'MASCULIN','OA0385257','CONGO'),(1304,2,391,NULL,'NGUIAMBA BEMIYILI HELENE ROLANDE',NULL,'691083805',NULL,'EBOME-KRIBI ',NULL,NULL,'FEMININ','CE09329I5ISSWSPQH686','CAMEROUN'),(1305,2,391,NULL,'NJOKE JACQUES SAMUEL LOIC',NULL,'658415440',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','100639607','CAMEROUN'),(1306,2,391,NULL,'NKAYA MABOUNOU BELDY FRANCELIA',NULL,'653218552',NULL,'DOLISIE',NULL,NULL,'FEMININ','OA0402663','CONGO'),(1307,2,391,NULL,'NKOUKA-OKOURY REGIS CHARLEMAGNE',NULL,'654325958',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0406164','CONGO'),(1308,2,391,NULL,'NKOUMOU GERMAINE LA FLEURETTE',NULL,'698579102',NULL,'NDEN',NULL,NULL,'FEMININ','513738','CAMEROUN'),(1309,2,391,NULL,'NLATE AWOUNDI YVAN RYAN',NULL,'696151323',NULL,'YAOUNDE 5',NULL,NULL,'MASCULIN','CE02011I5IWNNHZHZAU6','CAMEROUN'),(1310,2,391,NULL,'NNA MEKINA ANAIS KARELLE',NULL,'698575061',NULL,'EKOWONG',NULL,NULL,'FEMININ','34923','CAMEROUN'),(1311,2,391,NULL,'NOA JENNIFER MANUELA',NULL,'695954675',NULL,'YAOUNDE II',NULL,NULL,'FEMININ','197093','CAMEROUN'),(1312,2,391,NULL,'NOUTAT NYATCHOU RICK MAVELON',NULL,'695586944',NULL,'DOUALA',NULL,NULL,'MASCULIN','101024379','CAMEROUN'),(1313,2,391,NULL,'NSA\'A MBALLA GUSTAVE MIGUEL ',NULL,'690513544',NULL,'EBOLOWA',NULL,NULL,'MASCULIN','100274104','CAMEROUN'),(1314,2,391,NULL,'NTOGUE AUGUSTA RICHONA NATHANAELLE',NULL,'697303422',NULL,'YAOUNDE II',NULL,NULL,'FEMININ','100704546','CAMEROUN'),(1315,2,391,NULL,'NTOLANY NZOUMBA GLADE JULSCA',NULL,'698188422',NULL,'KIMBONGA LOUAMBA',NULL,NULL,'FEMININ','OA0403005','CONGO'),(1316,2,391,NULL,'NTSAH ZOBO VICKY MANUELA',NULL,'694960045',NULL,'DOUALA',NULL,NULL,'FEMININ','101086691','CAMEROUN'),(1317,2,391,NULL,'OBIEGNI BISSEMOU SAMUEL DUPONT ',NULL,'695971854',NULL,'DOUALA',NULL,NULL,'MASCULIN','CE54154I5ISWL4I3X1Y1','CAMEROUN'),(1318,2,391,NULL,'OBINIAMA OEN JEVIS NEWMAN',NULL,'64563466',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0402655','CONGO'),(1319,2,391,NULL,'OKANA YVES RAMICESSE',NULL,'656553558',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0403054','CONGO'),(1320,2,391,NULL,'OKEMBA PRINCE HARDY PICHET',NULL,'653215791',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0408290','CONGO'),(1321,2,391,NULL,'OKPWAE MBA RIDJE',NULL,'699163569',NULL,'OKONG',NULL,NULL,'MASCULIN','116976173','CAMEROUN'),(1322,2,391,NULL,'ONDONGO BENI MOISE',NULL,'650113398',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0380914','CONGO'),(1323,2,391,NULL,'ONDZE NGOUELENGA MICHELLE BELLE GUPHENE',NULL,'690334655',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0402667','CONGO'),(1324,2,391,NULL,'OSSE MBOZO\'O JEAN-PIERRE JUNIOR ',NULL,'694635226',NULL,'NDJANTOM ',NULL,NULL,'MASCULIN','CE2105815IT2U86MWPJ0','CAMEROUN'),(1325,2,391,NULL,'OTSALI NKOA BERNADETTE ELIANNE',NULL,'655272294',NULL,'YAOUNDE',NULL,NULL,'FEMININ','101219554','CAMEROUN'),(1326,2,391,NULL,'OYANE MVOMO JOSUE MICHEL',NULL,'698135907',NULL,'DJOUM',NULL,NULL,'MASCULIN','228976','CAMEROUN'),(1327,2,391,NULL,'PAKA BIYO PRINCE JADI ',NULL,'695437613',NULL,'MPIKA SONGHO 2',NULL,NULL,'MASCULIN','OA0399676','CONGO'),(1328,2,391,NULL,'PASSI GLORIA JEREMIE',NULL,'653217967',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0402658','CONGO'),(1329,2,391,NULL,'POMOT MAMPOMO STEAVES JORDAN',NULL,'693091685',NULL,'SOMALOMO',NULL,NULL,'MASCULIN','434335','CAMEROUN'),(1330,2,391,NULL,'SALOMON WILLIAM MINTYENE BAMA',NULL,'656209215',NULL,'TCHANGUE',NULL,NULL,'MASCULIN','517087','CAMEROUN'),(1331,2,391,NULL,'SAMBA MIKEMBI SEPHORA LAURNA MARYSE',NULL,'653341357',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0401987','CONGO'),(1332,2,391,NULL,'SAMBA TIMOTHEE GLOIRE VERLEY DIEUVEIL',NULL,'656466668',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA04031453','CONGO'),(1333,2,391,NULL,'SASSA ITOUA NERCIA ROFEL',NULL,'693707574',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA362352','CONGO'),(1334,2,391,NULL,'SIMO BLONDELLE',NULL,'696781771',NULL,'EBOLOWA',NULL,NULL,'FEMININ','100629817','CAMEROUN'),(1335,2,391,NULL,'TALOM KAMGA HAROLD ARTHUR',NULL,'655586299',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','100853744','CAMEROUN'),(1336,2,391,NULL,'TCHOFFO TALACFO HAROLD EMMANUEL',NULL,'652915532',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','100101654','CAMEROUN'),(1337,2,391,NULL,'TCHUENKOM TAGNE ELISÉE JETHRO',NULL,'690814731',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','118410399','CAMEROUN'),(1338,2,391,NULL,'TERIMINA BADIKA BLAISE PASTORE',NULL,'698190272',NULL,'MOUTELA',NULL,NULL,'MASCULIN','OA0402020','CONGO'),(1339,2,391,NULL,'TIKI EBELLE CIDOINE ENEE',NULL,'695744108',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','100326846','CAMEROUN'),(1340,2,391,NULL,'TODOU FELIX',NULL,'693931724',NULL,'NGONG',NULL,NULL,'MASCULIN','664094','CAMEROUN'),(1341,2,391,NULL,'TSATY IVERNEL DIEUVEILLE',NULL,'694957722',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0386835','CONGO'),(1342,2,391,NULL,'TSOUMOU MOUKASSA JOHN O\'BRIEN DE PAUL',NULL,'650112729',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0402011','CONGO'),(1343,2,391,NULL,'WENDA BENDERA ORNELLA MARTHE',NULL,'695503521',NULL,'YAOUNDE',NULL,NULL,'FEMININ','100570156','CAMEROUN'),(1344,2,391,NULL,'YOUNGUILA EDNA RAMELLIANE ',NULL,'653343442',NULL,'POINTE-NOIRE',NULL,NULL,'FEMININ','OA040895','CONGO'),(1345,2,391,NULL,'ZEH MVELE PIERRE-PAUL',NULL,'695612281',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','118367428','CAMEROUN'),(1346,2,391,NULL,'ZO\'ONDE MBATA GEOVANY',NULL,'690636993',NULL,'NKOLBANG',NULL,NULL,'MASCULIN','101182508','CAMEROUN'),(1347,1,381,NULL,'ABOLO OLAMA DAVID',NULL,'690632650',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','CE1223IT30N899A13','CAMEROUN'),(1348,1,381,NULL,'AMBOGUE MARMY IMELDA',NULL,'696825961',NULL,'YAOUNDE',NULL,NULL,'FEMININ','101190591','CAMEROUN'),(1349,1,381,NULL,'AVOMO ELIE LUDOVIC',NULL,'656875752',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','545564','CAMEROUN'),(1350,1,381,NULL,'AVOTTO CHARLES GULLIT',NULL,'659065045',NULL,'NYE ELE',NULL,NULL,'MASCULIN','101353532','CAMEROUN'),(1351,1,381,NULL,'AYE\'E MARTIN EMMANUEL',NULL,'691051577',NULL,'YAOUNDÉ',NULL,NULL,'MASCULIN','114964964','CAMEROUN'),(1352,1,381,NULL,'BALEPOUA KIBA ISSIE',NULL,'653215347',NULL,'ABALA',NULL,NULL,'MASCULIN','OA010403055','CONGO'),(1353,1,381,NULL,'BELINGA ANNE CYRIELLE CYNTIA',NULL,'693788177',NULL,'NGOULEMAKONG',NULL,NULL,'FEMININ','117254023','CAMEROUN'),(1354,1,381,NULL,'BIANG MARTHE SERMENDE',NULL,'656981955',NULL,'MATERNITE DE KAELE',NULL,NULL,'FEMININ','117515228','CAMEROUN'),(1355,1,381,NULL,'BIANG SAMUEL YVAN',NULL,'655565680',NULL,'MATERNITE DE KAELE',NULL,NULL,'MASCULIN','117117708','CAMEROUN'),(1356,1,381,NULL,'BOUNGOU MABELE MOISE',NULL,'657008483',NULL,'POINTE - NOIRE',NULL,NULL,'MASCULIN','OA0403144','CONGO'),(1357,1,381,NULL,'EFA JOSEPHINE TENDRESSE',NULL,'658793599',NULL,'YAOUNDE',NULL,NULL,'FEMININ','100565423','CAMEROUN'),(1358,1,381,NULL,'EKOA AMOUGOU JOSEPH DAVY',NULL,'698906791',NULL,'NYEP-BANE',NULL,NULL,'MASCULIN','SUD01232I5IWC6T61L6H6','CAMEROUN'),(1359,1,381,NULL,'ENGBWANG BEKALE HENRI FRED',NULL,'655104162',NULL,'DJOUM',NULL,NULL,'MASCULIN','790642','CAMEROUN'),(1360,1,381,NULL,'ESSONO BOBY STYVE',NULL,'657326234',NULL,'SANGMELIMA',NULL,NULL,'MASCULIN','CE3107I5IT321BKV745','CAMEROUN'),(1361,1,381,NULL,'FOUMANE FOUMANE MARIETTA LORENA',NULL,'697644335',NULL,'YAOUNDE',NULL,NULL,'FEMININ','100240084','CAMEROUN'),(1362,1,381,NULL,'GAIMATAKON FERDINAND',NULL,'690275172',NULL,'GAROUA',NULL,NULL,'MASCULIN','101295845','CAMEROUN'),(1363,1,381,NULL,'GARBA IDI SIMON JUNIOR ',NULL,'691235529',NULL,'BAFIA',NULL,NULL,'MASCULIN','100891310','CAMEROUN'),(1364,1,381,NULL,'JANIS LESLIE ONDOUA ABENG II',NULL,'656828349',NULL,'YAOUNDE 5',NULL,NULL,'FEMININ','100198813','CAMEROUN'),(1365,1,381,NULL,'KOLOKO JANE ALEXIA',NULL,'696105363',NULL,'DOUALA',NULL,NULL,'FEMININ','100130662','CAMEROUN'),(1366,1,381,NULL,'LOUFOUMA OHOLANGA NDEYA VICTOIRE',NULL,'653215386',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0413292','CONGO'),(1367,1,381,NULL,'LOUKOKOBI EXAUCEE BELGINA LOUISLENE',NULL,'653215379',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0403084','CONGO'),(1368,1,381,NULL,'MAFOULA MOLOU MARIE FAUSTINE ',NULL,'653619184',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0405418','CONGO'),(1369,1,381,NULL,'MANKONO DJANG MELISSA',NULL,'695568009',NULL,'NDJIBOT',NULL,NULL,'FEMININ','101117461','CAMEROUN'),(1370,1,381,NULL,'MASSANGA KASTANE JEAN DENIS',NULL,'653216314',NULL,'POINTE-NOIRE',NULL,NULL,'MASCULIN','OA0403061','CONGO'),(1371,1,381,NULL,'MASSONG ANOCK PRADELLE',NULL,'658118883',NULL,'BAFIA',NULL,NULL,'FEMININ',' ','CAMEROUN'),(1372,1,381,NULL,'MBANG MBAH JOSEPH RODRIGUE',NULL,'671602585',NULL,'NKONDJOCK',NULL,NULL,'MASCULIN','101269271','CAMEROUN'),(1373,1,381,NULL,'MEKA MEKA JOSIANE VANESSA',NULL,'658 669 808',NULL,'BENGBIS',NULL,NULL,'FEMININ','SU02397I5IT2TR9SVAA3','CAMEROUN'),(1374,1,381,NULL,'MENDOGO ONGBWA MICHELLE GAELLE',NULL,'657911465',NULL,'MATERNITE DE NDEN',NULL,NULL,'FEMININ','SU05126I5IT1OVRB8351','CAMEROUN'),(1375,1,381,NULL,'MENDOMO NKOULOU FRANCK',NULL,'698687704',NULL,'AKOOLOUI',NULL,NULL,'MASCULIN','117348094','CAMEROUN'),(1376,1,381,NULL,'MENOGA NGOLO PIERRETTE',NULL,'695133562',NULL,'YAOUNDE',NULL,NULL,'FEMININ','11881366','CAMEROUN'),(1377,1,381,NULL,'MESSANGA YOUNESS',NULL,'659048082',NULL,'SANGMELIMA',NULL,NULL,'MASCULIN','101208377','CAMEROUN'),(1378,1,381,NULL,'MILANDOU OLIVIER NATHANAEL CHRIST VIT',NULL,'653217651',NULL,'LINZOLO',NULL,NULL,'MASCULIN','OA0329092','CONGO'),(1379,1,381,NULL,'MOUKELA ANGE VELICK',NULL,'653214026',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN',' ','CONGO'),(1380,1,381,NULL,'NAKAVOUA MOUANGA GLADE RICHELA',NULL,'654021497',NULL,'POINTE-NOIRE',NULL,NULL,'FEMININ','1421000000000000','CONGO'),(1381,1,381,NULL,'NEZA TCHOFOR VIANIE MANUELA',NULL,'693849809',NULL,'MBOUDA',NULL,NULL,'FEMININ','407343','CAMEROUN'),(1382,1,381,NULL,'NGALLE NGOH ANNETTE GERTRUDE LA PATIENCE',NULL,'694997568',NULL,'L\'HOPITAL DE DISTRICT DE NGOUMOU',NULL,NULL,'FEMININ',' ','CAMEROUN'),(1383,1,381,NULL,'NGAMESSI NKO\'O WILLY KEVIN NINO',NULL,'690474921',NULL,'YAOUNDE',NULL,NULL,'MASCULIN',' ','CAMEROUN'),(1384,1,381,NULL,'NGUIE DANN ARCADIUS',NULL,'695972089',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0402659','CONGO'),(1385,1,381,NULL,'NKOA BODO VINCENT EMMANUEL',NULL,'675273624',NULL,'YAOUNDE',NULL,NULL,'MASCULIN','SU02143I5IWMLOAZ6L75','CAMEROUN'),(1386,1,381,NULL,'NTSONDE MASSENGO JUSTE BIENVENU',NULL,'654341172',NULL,'BRAZZAVILLE',NULL,NULL,'MASCULIN','OA0359705','CONGO'),(1387,1,381,NULL,'OBAMBI EMILE',NULL,'658310104',NULL,'OYO',NULL,NULL,'MASCULIN','OA0397527','CONGO'),(1388,1,381,NULL,'OBINDZA NGALA JEANSINA DORCAS',NULL,'655692610',NULL,'BRAZZAVILLE',NULL,NULL,'FEMININ','OA0254174','CONGO'),(1389,1,381,NULL,'YAO AMENA SINDY GABRIELLA',NULL,'655322397',NULL,'YAOUNDE',NULL,NULL,'FEMININ','CE14135I5IT1NA90YF4','CAMEROUN'),(1390,1,381,NULL,'ZIBI EBENGUE FERNAND',NULL,'695086136',NULL,'ENONGAL',NULL,NULL,'MASCULIN','801243','CAMEROUN'),(1391,1,381,NULL,'ZOMO NNANGA MAX PRIVAT',NULL,'697834753',NULL,'ZOULABOT',NULL,NULL,'MASCULIN','CE12280I5IT1FPQGWN5','CAMEROUN');
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
  KEY `IDX_B0F6A6D5B03A8386` (`created_by_id`),
  CONSTRAINT `FK_B0F6A6D5B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
INSERT INTO `teacher` VALUES (20,53,'toto davy','100236547','676469014','toto@gmail.com','2024-08-02 11:46:05');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ue`
--

LOCK TABLES `ue` WRITE;
/*!40000 ALTER TABLE `ue` DISABLE KEYS */;
INSERT INTO `ue` VALUES (14,391,'SNA411','Systèmes Numériques Avancées I',5,'vfvfg','1',NULL,NULL),(15,391,'IGN411','Projets éducatifs des étudiants',8,'vfvfg','1',NULL,NULL),(16,391,'SNA412','Systèmes Numériques Avancées II',5,'vfvfg','1',NULL,NULL),(17,391,'ISN441','Réseaux et Systèmes Multimédias II',6,'Architecture des applications et Optimisation des Bases de Données','1',NULL,NULL);
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
INSERT INTO `ue_field` VALUES (14,2),(15,2),(16,2),(17,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (4,NULL,NULL,NULL,NULL,NULL,NULL,'superAdmin237','[\"ROLE_SUPER_ADMIN\"]','$2y$13$t2UfYCY8NEDpBRZgvg9kquzCiu051GYf6kZYO5SG4EcCjQmQdMs2.','davyemane2@gmail.com','LogoLM-6694fc4e5cdc5.png'),(40,NULL,NULL,4,NULL,NULL,NULL,'fouda','[\"ROLE_ADMIN\"]','$2y$13$Sl9eWfODkSHBdCRKK8W.N.wTgPGdY.7XF3B1h4yEbqRDg2Ns5sxja','fouda@gmail.com','argent-66acb16125d78.jpg'),(41,NULL,8,NULL,NULL,NULL,NULL,'ondombo','[\"ROLE_RESPFIELD\"]','$2y$13$tsupoBUNfWIUe2hVM3ZPz.oyXGLJXcmkkHVd.bU1rDm8kp2rbehgW','ondombo@gmail.com',NULL),(42,NULL,9,NULL,NULL,NULL,NULL,'mignam','[\"ROLE_RESPFIELD\"]','$2y$13$eZn4EETxBUpQ2Xz5k2HFHuk.is20hTQuUQFGITC7rVPlghjgwXQeS','mignam@gmail.com',NULL),(43,NULL,10,NULL,NULL,NULL,NULL,'amougou','[\"ROLE_RESPFIELD\"]','$2y$13$E2lrsL4xAhObE1rI9oiKmuWxHt6XZ5QSbL24r1wHj.tw5EJk8tGz6','amougou@gmail.com',NULL),(44,NULL,NULL,NULL,8,NULL,NULL,'aba\'a','[\"ROLE_RESPLEVEL\"]','$2y$13$EEmo8zD1fiLuRdGb1kp3ceIcNXxtGyP35BMnnVnjTyYkieQ2ugWuG','abaa@gmail.com',NULL),(45,NULL,NULL,NULL,9,NULL,NULL,'Ango','[\"ROLE_RESPLEVEL\"]','$2y$13$4soGIV0Ri2w4D5z5oslAaeIQlxmRZeXixdl0iN8aATKuI8OEQYiiq','agnesgrey@gmail.com',NULL),(46,NULL,NULL,NULL,10,NULL,NULL,'djeninga','[\"ROLE_RESPLEVEL\"]','$2y$13$rvg60OfZcSDiC3oA9viMiOLIiqW5iOvqHqsl6tpN6qZkYW1CWvsF.','djeninga@gmail.com',NULL),(47,NULL,NULL,NULL,11,NULL,NULL,'eyenga','[\"ROLE_RESPLEVEL\"]','$2y$13$NIKsmmOyEaPGQr.JYYR6L.ZNItqjTVR8ksSyl/HouYqL5Jr1ynUTK','eyenga@gmail.com',NULL),(48,NULL,NULL,NULL,12,NULL,NULL,'emane','[\"ROLE_RESPLEVEL\"]','$2y$13$aLStRU1j6uEgznJqsdRszOD7gNq3Gvt53fqcdzJnLIgApe3KlEk42','davyemane2@gmail.com',NULL),(49,NULL,NULL,NULL,13,NULL,NULL,'tapiba','[\"ROLE_RESPLEVEL\"]','$2y$13$XWI05ZxVSacZ6VGPGHToKunLImg1R5jsPWEo0lQyPxDr0ZeF/P2yy','tapiba@gmail.com',NULL),(50,NULL,NULL,NULL,14,NULL,NULL,'bile1','[\"ROLE_RESPLEVEL\"]','$2y$13$f9nuWSh8OGcZFRqNecrbqOSzlauGZY22rIdqiqweQxj2xTX9CkBEu','bile@gmail.com',NULL),(51,NULL,NULL,NULL,15,NULL,NULL,'bile2','[\"ROLE_RESPLEVEL\"]','$2y$13$RSthBoiWonwFGM2SDx8u4us0fQFEuD2OaHGMYdzhDp489aQbWx47i','bile@gmail.com',NULL),(52,NULL,NULL,NULL,16,NULL,NULL,'bile3','[\"ROLE_RESPLEVEL\"]','$2y$13$ON1fVBPDcO6weCrngb5hzep7X3oiw1WIt4hTmDdlCcCOGL0psdaCC','bile@gmail.com',NULL),(53,NULL,NULL,NULL,NULL,12,NULL,'felicien1','[\"ROLE_RESPUE\"]','$2y$13$Ozwd2xs8FXekSpQWZ1muOu0fuFo.PAJMm/wmIjtbUbF26SOM87cX6','Felicien@gmail.com',NULL),(54,NULL,NULL,NULL,NULL,13,NULL,'felicien2','[\"ROLE_RESPUE\"]','$2y$13$K/irbIquouFgIgjzTvQDZOJCCR2A68tDl1R0eGQR/pIqT0iR23YFK','Felicien@gmail.com',NULL),(55,NULL,NULL,NULL,NULL,14,NULL,'felicien3','[\"ROLE_RESPUE\"]','$2y$13$g0YRrdPNDhjTTJr.58HEOu6fgmKBrn.NbXAizsK5QIGWq4etccLNy','Felicien@gmail.com',NULL),(56,NULL,NULL,NULL,NULL,15,NULL,'felicien4','[\"ROLE_RESPUE\"]','$2y$13$Pm0nml9lDxNrOp9Vs2iDw.GM9KA6SxmQaRKM3JfNHHzp2NcY7Fq5a','Felicien@gmail.com',NULL),(57,NULL,NULL,NULL,NULL,NULL,20,'toto1','[\"ROLE_TEACHER\"]','$2y$13$xzdDW43sOVg.VGQqwuqp9ey45833INXalDfssdV5fYmV2Eu5MwcZa','toto@gmail.com',NULL);
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

-- Dump completed on 2024-08-02 13:13:48
