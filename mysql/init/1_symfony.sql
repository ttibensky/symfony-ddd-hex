-- MySQL dump 10.13  Distrib 8.1.0, for Linux (x86_64)
--
-- Host: localhost    Database: symfony
-- ------------------------------------------------------
-- Server version	8.1.0

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
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `content` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author_id` int NOT NULL,
  `parent_id` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FEC530A9F675F31B` (`author_id`),
  KEY `IDX_FEC530A9727ACA70` (`parent_id`),
  CONSTRAINT `FK_FEC530A9727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `content` (`id`),
  CONSTRAINT `FK_FEC530A9F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user_profile` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
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
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20231007130535','2023-10-07 13:05:36',712);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D95AB405E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
INSERT INTO `user_profile` VALUES (1,'Johnson Bailey II','ellie.metz@yahoo.com','2023-10-07 13:07:42'),(2,'Hank Ritchie Jr.','brant91@robel.info','2023-10-07 13:07:42'),(3,'Nathen Hermann','jacquelyn.howell@haag.com','2023-10-07 13:07:42'),(4,'Nicolette Mann','erin.fadel@hotmail.com','2023-10-07 13:07:42'),(5,'Ms. Jaclyn Bartell PhD','aileen73@keeling.info','2023-10-07 13:07:42'),(6,'Maryam Kunze','xking@hotmail.com','2023-10-07 13:07:42'),(7,'Raphael Kiehn','hermann.ken@romaguera.biz','2023-10-07 13:07:42'),(8,'Adaline Pfeffer','ondricka.amparo@gmail.com','2023-10-07 13:07:42'),(9,'Yvette Casper','crona.laurianne@hodkiewicz.net','2023-10-07 13:07:42'),(10,'Joesph Schiller','arlene.mckenzie@bogan.net','2023-10-07 13:07:42'),(11,'Dr. Meaghan Stehr V','orville66@gmail.com','2023-10-07 13:07:42'),(12,'Brook Brown','labadie.donavon@gmail.com','2023-10-07 13:07:42'),(13,'Duncan O\'Connell','fisher.marie@hotmail.com','2023-10-07 13:07:42'),(14,'Dr. Alfonso Schumm III','pboehm@shanahan.info','2023-10-07 13:07:42'),(15,'Ms. Donna Rath Jr.','dietrich.lucile@gmail.com','2023-10-07 13:07:42'),(16,'Grayson Kutch Jr.','emmy21@hotmail.com','2023-10-07 13:07:42'),(17,'Asha Dibbert Sr.','gwisozk@yahoo.com','2023-10-07 13:07:42'),(18,'Charley Windler','tgutmann@yahoo.com','2023-10-07 13:07:42'),(19,'Theodore Durgan','kwilkinson@gmail.com','2023-10-07 13:07:42'),(20,'Veda Eichmann','konopelski.norberto@hotmail.com','2023-10-07 13:07:42'),(21,'Don Nicolas','kenyon.wolf@nienow.biz','2023-10-07 13:07:42'),(22,'Prof. Breanna Wolff DVM','lavina92@cartwright.com','2023-10-07 13:07:42'),(23,'Will Bayer I','alayna83@hotmail.com','2023-10-07 13:07:42'),(24,'Luisa Kutch','eturner@grimes.com','2023-10-07 13:07:42'),(25,'Travon Murray IV','major75@gmail.com','2023-10-07 13:07:42'),(26,'Vickie Terry','abbigail58@simonis.com','2023-10-07 13:07:42'),(27,'Ayla Herzog','ignatius37@conn.com','2023-10-07 13:07:42'),(28,'Sigmund Christiansen','htrantow@yahoo.com','2023-10-07 13:07:42'),(29,'Dr. Reina Pacocha PhD','andrew39@hotmail.com','2023-10-07 13:07:42'),(30,'Dr. Mack Hessel V','hudson.alexandria@hotmail.com','2023-10-07 13:07:42'),(31,'Elna Schuppe','gerald91@hotmail.com','2023-10-07 13:07:42'),(32,'Macie Franecki','hlueilwitz@yahoo.com','2023-10-07 13:07:42'),(33,'Leann Herman','bbeier@gmail.com','2023-10-07 13:07:42'),(34,'Dr. Darron Hilpert','bosco.enos@okuneva.net','2023-10-07 13:07:42'),(35,'Emelie Heathcote','ehowe@marquardt.com','2023-10-07 13:07:42'),(36,'Orville Anderson','hayes.tomasa@larkin.biz','2023-10-07 13:07:42'),(37,'Prof. Sydnie Olson Sr.','fheaney@yahoo.com','2023-10-07 13:07:42'),(38,'Mr. Mark Borer','glynch@satterfield.net','2023-10-07 13:07:42'),(39,'Katelin Gorczany PhD','fchamplin@swaniawski.info','2023-10-07 13:07:42'),(40,'Mia Effertz','zakary29@kunde.org','2023-10-07 13:07:42'),(41,'Emilio Runolfsdottir','mclaughlin.martine@gmail.com','2023-10-07 13:07:42'),(42,'Mose Jenkins','wilfred38@yahoo.com','2023-10-07 13:07:42'),(43,'Dr. Tressie Koch II','glang@yahoo.com','2023-10-07 13:07:42'),(44,'Mr. Bertha Larson IV','theresia.ritchie@yahoo.com','2023-10-07 13:07:42'),(45,'Garrison Moore','von.valerie@hotmail.com','2023-10-07 13:07:42'),(46,'Mr. Reagan Funk MD','bhomenick@yahoo.com','2023-10-07 13:07:42'),(47,'Emie Watsica Sr.','jorge23@gmail.com','2023-10-07 13:07:42'),(48,'Miss Ella Lemke MD','crawford08@gmail.com','2023-10-07 13:07:42'),(49,'Maxime Rath','nkrajcik@hotmail.com','2023-10-07 13:07:42'),(50,'Prof. Kayley Goodwin DDS','bogan.daren@hotmail.com','2023-10-07 13:07:42'),(51,'Mr. Price Botsford Sr.','lois.klocko@hotmail.com','2023-10-07 13:07:42'),(52,'Maria Dickens','osbaldo.goodwin@hotmail.com','2023-10-07 13:07:42'),(53,'Kara Treutel','kling.kamille@gmail.com','2023-10-07 13:07:42'),(54,'Hosea Bechtelar','boberbrunner@gmail.com','2023-10-07 13:07:42'),(55,'Dr. Lavonne Becker III','schneider.evalyn@yahoo.com','2023-10-07 13:07:42'),(56,'Leo Lynch','katrine26@yahoo.com','2023-10-07 13:07:42'),(57,'Floy O\'Conner','brandt.schinner@gmail.com','2023-10-07 13:07:42'),(58,'Whitney Gerlach Jr.','taurean.hilpert@bosco.net','2023-10-07 13:07:42'),(59,'Sherwood Howell','deshaun.crona@waters.info','2023-10-07 13:07:42'),(60,'Ms. Lisa Terry','wullrich@rutherford.org','2023-10-07 13:07:42'),(61,'Aliyah Beahan PhD','ratke.maurine@gmail.com','2023-10-07 13:07:42'),(62,'Miss Sadie Prohaska III','yasmeen70@hotmail.com','2023-10-07 13:07:42'),(63,'Mr. Murray Kuphal IV','parisian.marietta@gmail.com','2023-10-07 13:07:42'),(64,'Dahlia Effertz','tyrese.luettgen@rippin.com','2023-10-07 13:07:42'),(65,'Vincenza Weber','kmurazik@hotmail.com','2023-10-07 13:07:42'),(66,'Dr. Branson Weissnat','maurine20@lesch.com','2023-10-07 13:07:42'),(67,'Elfrieda Thompson Sr.','beatrice.schroeder@spencer.com','2023-10-07 13:07:42'),(68,'Ana Larkin','thaddeus20@gmail.com','2023-10-07 13:07:42'),(69,'Filiberto Kuhlman','wintheiser.rosario@ratke.com','2023-10-07 13:07:42'),(70,'Alessia Rempel','hand.amara@mraz.com','2023-10-07 13:07:42'),(71,'Kenneth Barton','letitia12@hotmail.com','2023-10-07 13:07:42'),(72,'Makayla Herman','gibson.darrick@yahoo.com','2023-10-07 13:07:42'),(73,'Florencio Langosh','okeefe.justice@hyatt.com','2023-10-07 13:07:42'),(74,'Fred Von Jr.','dach.brooke@gmail.com','2023-10-07 13:07:42'),(75,'Daphnee Cassin DVM','orval.luettgen@gmail.com','2023-10-07 13:07:42'),(76,'Vella Walter','ilebsack@durgan.com','2023-10-07 13:07:42'),(77,'Elijah Weber','zboncak.ada@gulgowski.com','2023-10-07 13:07:42'),(78,'Brandy Wolf','calista.veum@yahoo.com','2023-10-07 13:07:42'),(79,'Don Dickens Jr.','dach.myra@gmail.com','2023-10-07 13:07:42'),(80,'Gonzalo Reilly','dickinson.madeline@lubowitz.com','2023-10-07 13:07:42'),(81,'Ena Ward','klocko.lucius@yahoo.com','2023-10-07 13:07:42'),(82,'Larue Kiehn','brain14@yahoo.com','2023-10-07 13:07:42'),(83,'Berry Kemmer DDS','rbartoletti@gmail.com','2023-10-07 13:07:42'),(84,'Jabari Howe','mhartmann@senger.org','2023-10-07 13:07:42'),(85,'Mr. Nicola Cole II','rjenkins@hotmail.com','2023-10-07 13:07:42'),(86,'Walton Abernathy','vonrueden.wilbert@rice.com','2023-10-07 13:07:42'),(87,'Hosea Okuneva','hailee.spencer@prosacco.com','2023-10-07 13:07:42'),(88,'Forest Satterfield','hhaley@hotmail.com','2023-10-07 13:07:42'),(89,'Prof. Carlie Altenwerth Sr.','kdonnelly@bauch.org','2023-10-07 13:07:42'),(90,'Mr. Ellis Lynch','vernie68@gibson.com','2023-10-07 13:07:42'),(91,'Dr. Javonte Koss PhD','vernon.king@yahoo.com','2023-10-07 13:07:42'),(92,'Joseph Lowe','maximillia36@brakus.com','2023-10-07 13:07:42'),(93,'Guadalupe Monahan I','iabernathy@ryan.net','2023-10-07 13:07:42'),(94,'Antwon Stanton','lora87@hotmail.com','2023-10-07 13:07:42'),(95,'Lorenzo Renner III','shaina22@ernser.com','2023-10-07 13:07:42'),(96,'Jules Weber','emarks@yahoo.com','2023-10-07 13:07:42'),(97,'Cleora Weber','heaven43@rempel.com','2023-10-07 13:07:42'),(98,'Mr. Lamont Schneider DDS','sfritsch@hotmail.com','2023-10-07 13:07:42'),(99,'Dr. Felton Bayer','shaylee.schaden@jerde.com','2023-10-07 13:07:42'),(100,'Oliver Wisoky','lane.halvorson@bradtke.com','2023-10-07 13:07:42');
/*!40000 ALTER TABLE `user_profile` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-07 13:08:12
