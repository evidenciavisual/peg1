-- MySQL dump 10.13  Distrib 5.5.23, for Linux (x86_64)
--
-- Host: localhost    Database: totemmallplazapal
-- ------------------------------------------------------
-- Server version	5.5.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cambiadorpiso`
--

DROP TABLE IF EXISTS `cambiadorpiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cambiadorpiso` (
  `idcambiadorPiso` int(11) NOT NULL AUTO_INCREMENT,
  `idnodo` int(11) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `sube` tinyint(1) DEFAULT NULL,
  `baja` tinyint(1) DEFAULT NULL,
  `idnodoSubida` int(11) DEFAULT NULL,
  `idnodoBajada` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcambiadorPiso`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cambiadorpiso`
--

LOCK TABLES `cambiadorpiso` WRITE;
/*!40000 ALTER TABLE `cambiadorpiso` DISABLE KEYS */;
INSERT INTO `cambiadorpiso` VALUES (1,181,'2',0,1,0,205),(2,182,'2',1,1,189,206),(3,183,'2',1,1,190,207),(4,184,'2',1,1,191,208),(5,185,'2',1,1,192,209),(6,186,'2',0,1,0,210),(7,187,'2',1,1,193,211),(8,188,'2',1,1,194,212),(9,189,'2',1,1,195,182),(10,190,'2',1,1,196,183),(11,191,'2',1,1,197,184),(12,192,'2',1,1,198,185),(13,193,'2',1,1,199,187),(14,194,'2',1,1,200,188),(15,195,'2',1,1,201,189),(16,196,'2',1,1,202,190),(17,197,'2',0,1,0,191),(18,198,'2',0,1,0,192),(19,199,'2',1,1,203,193),(20,200,'2',1,1,204,194),(21,201,'2',0,1,0,195),(22,202,'2',0,1,0,196),(23,203,'2',0,1,0,199),(24,204,'2',0,1,0,200),(25,205,'2',1,0,181,0),(26,206,'2',1,1,182,213),(27,207,'2',1,1,183,214),(28,208,'2',1,0,184,0),(29,209,'2',1,0,185,0),(30,210,'2',1,0,186,0),(31,211,'2',1,0,187,0),(32,212,'2',1,0,188,0),(33,213,'2',1,1,206,215),(34,214,'2',1,1,207,216),(35,215,'2',1,1,213,217),(36,216,'2',1,1,214,218),(37,217,'2',1,0,215,0),(38,218,'2',1,0,216,0);
/*!40000 ALTER TABLE `cambiadorpiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCategoria` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallemarca`
--

DROP TABLE IF EXISTS `detallemarca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallemarca` (
  `iddetalleMarca` int(11) NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  `idtienda` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleMarca`),
  KEY `fk_dm_idproducto` (`idproducto`),
  KEY `fk_dm_idmarca` (`idmarca`),
  KEY `idtienda` (`idtienda`),
  CONSTRAINT `detallemarca_ibfk_1` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_dm_idmarca` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_dm_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=295 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallemarca`
--

LOCK TABLES `detallemarca` WRITE;
/*!40000 ALTER TABLE `detallemarca` DISABLE KEYS */;
INSERT INTO `detallemarca` VALUES (2,NULL,85,8),(3,NULL,69,8),(4,NULL,399,8),(5,NULL,166,8),(6,NULL,4,85),(7,NULL,294,85),(8,NULL,63,85),(9,NULL,348,85),(10,NULL,301,85),(11,NULL,440,42),(12,NULL,4,81),(13,NULL,424,77),(14,NULL,358,77),(15,NULL,484,77),(16,NULL,502,77),(17,NULL,624,77),(18,NULL,5,144),(19,NULL,5,144),(20,NULL,494,179),(21,NULL,447,48),(22,NULL,27,50),(23,NULL,122,50),(24,NULL,123,61),(25,NULL,47,61),(26,NULL,207,61),(27,NULL,326,61),(28,NULL,207,43),(29,NULL,62,43),(30,NULL,95,43),(31,NULL,26,43),(32,NULL,42,177),(33,NULL,29,116),(34,NULL,112,2),(35,NULL,31,4),(36,NULL,36,120),(37,NULL,37,19),(38,NULL,294,19),(39,NULL,344,19),(40,NULL,301,19),(41,NULL,339,19),(43,NULL,165,133),(44,NULL,294,12),(45,NULL,344,12),(46,NULL,4,12),(47,NULL,348,12),(48,NULL,48,118),(49,NULL,4,14),(50,NULL,418,14),(51,NULL,108,14),(52,NULL,344,14),(53,NULL,294,14),(54,NULL,495,152),(55,NULL,461,40),(56,NULL,58,56),(57,NULL,59,172),(58,NULL,60,64),(59,NULL,65,45),(60,NULL,66,44),(61,NULL,294,44),(62,NULL,375,44),(63,NULL,67,123),(64,NULL,68,97),(65,NULL,70,122),(66,NULL,73,25),(67,NULL,191,25),(68,NULL,288,25),(69,NULL,366,25),(70,NULL,57,25),(71,NULL,77,9),(72,NULL,295,9),(73,NULL,123,9),(74,NULL,78,27),(75,NULL,92,130),(76,NULL,93,134),(77,NULL,360,134),(78,NULL,97,106),(79,NULL,100,95),(80,NULL,496,95),(81,NULL,300,165),(82,NULL,362,165),(83,NULL,243,165),(84,NULL,203,165),(85,NULL,475,165),(86,NULL,300,165),(87,NULL,362,165),(88,NULL,243,165),(89,NULL,203,165),(90,NULL,103,129),(91,NULL,105,62),(92,NULL,497,113),(93,NULL,86,49),(94,NULL,106,49),(95,NULL,200,49),(96,NULL,265,49),(97,NULL,354,49),(98,NULL,130,170),(99,NULL,118,20),(100,NULL,123,63),(101,NULL,127,121),(102,NULL,127,171),(103,NULL,125,46),(104,NULL,129,119),(105,NULL,130,83),(106,NULL,15,6),(107,NULL,377,6),(108,NULL,313,6),(109,NULL,362,6),(110,NULL,15,33),(111,NULL,377,33),(112,NULL,313,33),(113,NULL,362,33),(114,NULL,15,67),(115,NULL,377,67),(116,NULL,313,67),(117,NULL,362,67),(118,NULL,236,3),(119,NULL,104,3),(120,NULL,211,3),(121,NULL,248,3),(122,NULL,234,3),(123,NULL,236,136),(124,NULL,104,136),(125,NULL,211,136),(126,NULL,248,136),(127,NULL,234,136),(128,NULL,392,151),(129,NULL,421,151),(130,NULL,102,151),(131,NULL,264,151),(132,NULL,51,151),(133,NULL,612,151),(134,NULL,488,151),(135,NULL,472,151),(136,NULL,618,151),(137,NULL,595,151),(138,NULL,237,17),(139,NULL,269,17),(140,NULL,13,17),(141,NULL,76,17),(142,NULL,419,17),(143,NULL,157,39),(144,NULL,164,135),(145,NULL,185,135),(146,NULL,167,52),(147,NULL,170,125),(148,NULL,514,103),(149,NULL,265,24),(150,NULL,106,24),(151,NULL,63,24),(152,NULL,86,24),(153,NULL,113,24),(154,NULL,215,24),(156,NULL,482,26),(157,NULL,483,26),(158,NULL,484,26),(159,NULL,518,148),(160,NULL,179,18),(161,NULL,183,54),(162,NULL,188,96),(163,NULL,190,78),(164,NULL,197,93),(165,NULL,202,127),(166,NULL,498,88),(167,NULL,208,178),(168,NULL,209,60),(169,NULL,216,29),(170,NULL,134,35),(171,NULL,428,35),(172,NULL,336,35),(173,NULL,362,35),(174,NULL,325,35),(175,NULL,134,69),(176,NULL,428,69),(177,NULL,336,69),(178,NULL,362,69),(179,NULL,325,69),(180,NULL,134,114),(181,NULL,428,114),(182,NULL,336,114),(183,NULL,362,114),(184,NULL,325,114),(185,NULL,219,38),(186,NULL,220,104),(187,NULL,222,13),(188,NULL,223,107),(189,NULL,226,132),(190,NULL,227,132),(191,NULL,229,132),(192,NULL,228,132),(193,NULL,225,132),(194,NULL,230,175),(195,NULL,538,150),(196,NULL,538,155),(197,NULL,499,147),(198,NULL,456,7),(199,NULL,313,7),(200,NULL,407,7),(201,NULL,15,7),(202,NULL,377,7),(203,NULL,362,7),(204,NULL,456,34),(205,NULL,313,34),(206,NULL,407,34),(207,NULL,15,34),(208,NULL,377,34),(209,NULL,362,34),(210,NULL,456,68),(211,NULL,313,68),(212,NULL,407,68),(213,NULL,15,68),(214,NULL,377,68),(215,NULL,362,68),(216,NULL,245,23),(217,NULL,224,159),(218,NULL,259,91),(219,NULL,263,180),(220,NULL,274,10),(221,NULL,275,41),(222,NULL,143,41),(223,NULL,6,41),(224,NULL,81,41),(225,NULL,314,41),(226,NULL,52,41),(227,NULL,337,41),(228,NULL,491,145),(229,NULL,177,47),(230,NULL,132,47),(231,NULL,345,47),(232,NULL,322,47),(233,NULL,406,47),(234,NULL,9,47),(235,NULL,356,158),(236,NULL,86,158),(237,NULL,89,158),(238,NULL,19,158),(239,NULL,184,158),(240,NULL,75,158),(241,NULL,307,174),(242,NULL,117,174),(243,NULL,276,174),(244,NULL,375,174),(245,NULL,319,79),(246,NULL,159,79),(247,NULL,344,79),(248,NULL,294,79),(249,NULL,4,79),(250,NULL,348,79),(251,NULL,320,82),(252,NULL,321,101),(253,NULL,327,28),(254,NULL,218,76),(255,NULL,294,76),(256,NULL,4,76),(257,NULL,290,76),(259,NULL,340,21),(260,NULL,344,80),(261,NULL,352,90),(262,NULL,255,5),(263,NULL,394,5),(264,NULL,350,5),(265,NULL,71,5),(266,NULL,40,5),(267,NULL,255,32),(268,NULL,394,32),(269,NULL,350,32),(270,NULL,71,32),(271,NULL,40,32),(272,NULL,255,66),(273,NULL,394,66),(274,NULL,350,66),(275,NULL,71,66),(276,NULL,40,66),(277,NULL,367,94),(278,NULL,367,124),(279,NULL,368,11),(280,NULL,432,11),(281,NULL,361,11),(282,NULL,94,11),(283,NULL,369,109),(284,NULL,373,140),(285,NULL,396,98),(286,NULL,400,146),(287,NULL,402,59),(288,NULL,401,16),(289,NULL,409,126),(290,NULL,492,102),(291,NULL,414,157),(292,NULL,416,89),(293,NULL,435,51),(294,NULL,435,117);
/*!40000 ALTER TABLE `detallemarca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalleoferta`
--

DROP TABLE IF EXISTS `detalleoferta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalleoferta` (
  `iddetalleOferta` int(11) NOT NULL AUTO_INCREMENT,
  `idoferta` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleOferta`),
  KEY `fk_do_idoferta` (`idoferta`),
  KEY `fk_do_idproducto` (`idproducto`),
  CONSTRAINT `fk_do_idoferta` FOREIGN KEY (`idoferta`) REFERENCES `oferta` (`idoferta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_do_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalleoferta`
--

LOCK TABLES `detalleoferta` WRITE;
/*!40000 ALTER TABLE `detalleoferta` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalleoferta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallepromocion`
--

DROP TABLE IF EXISTS `detallepromocion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallepromocion` (
  `iddetallePromocion` int(11) NOT NULL AUTO_INCREMENT,
  `idpromocion` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetallePromocion`),
  KEY `fk_dt_idpromocion` (`idpromocion`),
  KEY `fk_dt_idproducto` (`idproducto`),
  CONSTRAINT `fk_dt_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_dt_idpromocion` FOREIGN KEY (`idpromocion`) REFERENCES `promocion` (`idpromocion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallepromocion`
--

LOCK TABLES `detallepromocion` WRITE;
/*!40000 ALTER TABLE `detallepromocion` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallepromocion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallerubro`
--

DROP TABLE IF EXISTS `detallerubro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallerubro` (
  `iddetalleRubro` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) DEFAULT NULL,
  `idrubro` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleRubro`),
  KEY `fk_dr_idtienda` (`idtienda`),
  KEY `fk_dr_idrubro` (`idrubro`),
  CONSTRAINT `fk_dr_idrubro` FOREIGN KEY (`idrubro`) REFERENCES `rubro` (`idrubro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_dr_idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallerubro`
--

LOCK TABLES `detallerubro` WRITE;
/*!40000 ALTER TABLE `detallerubro` DISABLE KEYS */;
INSERT INTO `detallerubro` VALUES (2,8,7),(3,8,27),(4,85,3),(5,85,10),(6,85,12),(7,85,6),(8,85,27),(9,42,27),(10,42,10),(11,81,3),(12,81,6),(13,81,10),(14,81,12),(15,77,3),(16,77,6),(17,77,10),(18,77,12),(19,77,27),(20,144,19),(21,144,16),(22,179,26),(23,179,15),(24,48,10),(25,48,27),(26,50,10),(27,50,27),(28,61,8),(29,61,12),(30,61,27),(31,61,5),(32,43,8),(33,43,12),(34,43,27),(35,43,5),(36,177,16),(37,177,18),(38,116,16),(39,116,18),(40,2,16),(41,2,18),(42,4,16),(43,4,18),(44,120,9),(45,120,15),(46,19,6),(47,19,10),(48,19,12),(49,19,27),(51,133,1),(52,12,3),(53,12,10),(54,12,12),(55,12,6),(56,12,27),(57,118,4),(58,118,9),(59,14,12),(60,14,6),(61,14,27),(62,152,26),(63,152,15),(64,40,10),(65,40,27),(66,56,7),(67,56,27),(68,172,15),(70,64,15),(71,45,27),(72,45,14),(73,44,12),(74,44,27),(75,123,9),(76,123,15),(77,97,26),(78,122,26),(79,25,6),(80,25,10),(81,25,12),(82,25,27),(83,9,11),(84,9,27),(85,27,10),(86,27,27),(87,130,1),(88,134,1),(89,106,26),(90,95,4),(91,95,9),(92,165,2),(93,165,22),(94,165,20),(95,129,1),(96,129,16),(97,62,12),(98,62,27),(99,113,4),(100,113,9),(101,49,3),(102,49,6),(103,49,10),(104,49,27),(105,170,15),(106,20,10),(107,20,27),(108,63,12),(109,63,8),(110,63,27),(111,121,26),(112,171,26),(113,46,10),(114,46,27),(115,119,26),(116,83,15),(117,6,3),(118,6,10),(119,6,12),(120,6,6),(121,6,17),(122,33,3),(123,33,10),(124,33,12),(125,33,6),(126,33,17),(127,67,3),(128,67,10),(129,67,12),(130,67,6),(131,67,17),(132,3,13),(133,3,27),(134,3,23),(135,136,13),(136,136,27),(137,136,23),(138,151,13),(139,151,27),(140,151,23),(141,17,6),(142,17,27),(143,39,12),(144,39,27),(145,135,1),(146,52,10),(147,52,6),(148,52,27),(149,125,26),(150,103,26),(151,24,3),(152,24,10),(153,24,6),(154,24,27),(156,26,10),(157,26,27),(158,148,16),(159,18,27),(160,18,10),(161,54,6),(162,54,27),(163,96,4),(164,96,9),(165,78,6),(166,78,10),(167,78,12),(168,78,27),(169,93,2),(170,93,27),(171,127,1),(172,88,6),(173,88,10),(174,88,27),(175,178,23),(176,60,6),(177,60,10),(178,60,27),(179,29,6),(180,29,10),(181,29,27),(182,35,3),(183,35,10),(184,35,12),(185,35,6),(186,35,27),(187,69,3),(188,69,10),(189,69,12),(190,69,6),(191,69,27),(192,114,3),(193,114,10),(194,114,12),(195,114,6),(196,114,27),(197,38,7),(198,38,27),(199,104,26),(200,13,10),(201,13,12),(202,13,6),(203,13,27),(204,107,26),(205,132,1),(206,175,11),(207,175,27),(208,150,16),(209,150,27),(210,155,16),(211,155,27),(212,147,27),(213,7,17),(214,34,17),(215,68,17),(216,23,12),(217,23,27),(218,159,14),(219,91,6),(220,91,10),(221,91,12),(222,91,27),(223,180,15),(224,180,26),(225,10,6),(226,10,10),(227,10,12),(228,10,27),(229,41,13),(230,41,27),(231,145,22),(232,145,27),(233,47,13),(234,47,27),(235,158,13),(236,158,27),(237,174,13),(238,174,27),(239,79,3),(240,79,6),(241,79,10),(242,79,12),(243,79,27),(244,82,2),(245,82,27),(246,101,26),(247,28,12),(248,28,27),(249,76,6),(250,76,10),(251,76,27),(253,21,5),(254,21,14),(255,21,23),(256,21,27),(257,80,3),(258,80,6),(259,80,10),(260,80,27),(261,90,10),(262,90,6),(263,90,27),(264,5,17),(265,32,17),(266,66,17),(267,94,15),(268,94,27),(269,124,15),(270,124,27),(271,11,6),(272,11,10),(273,11,27),(274,109,9),(275,109,15),(276,140,16),(277,140,20),(278,140,27),(279,98,26),(280,146,16),(281,146,27),(282,59,27),(283,59,10),(284,16,6),(285,16,10),(286,16,27),(287,126,1),(288,102,15),(289,102,26),(290,157,25),(291,157,27),(292,89,3),(293,89,6),(294,89,10),(295,89,12),(296,89,27),(297,51,15),(298,51,27),(299,117,15),(300,117,27);
/*!40000 ALTER TABLE `detallerubro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalletienda`
--

DROP TABLE IF EXISTS `detalletienda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalletienda` (
  `iddetalleTienda` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleTienda`),
  KEY `fk_idtienda` (`idtienda`),
  KEY `fk_idproducto` (`idproducto`),
  CONSTRAINT `fk_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=486 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalletienda`
--

LOCK TABLES `detalletienda` WRITE;
/*!40000 ALTER TABLE `detalletienda` DISABLE KEYS */;
INSERT INTO `detalletienda` VALUES (2,8,347),(3,85,427),(4,85,63),(5,85,37),(6,85,49),(7,85,195),(8,42,2),(9,42,413),(10,81,427),(11,81,321),(12,81,2),(13,81,318),(14,77,444),(15,77,427),(16,77,195),(17,77,2),(18,144,445),(19,144,120),(20,179,43),(21,179,202),(22,179,221),(23,179,294),(24,48,77),(25,48,93),(26,50,77),(27,50,93),(28,50,2),(29,50,62),(30,61,147),(31,61,113),(32,61,370),(33,61,352),(34,43,113),(35,43,369),(36,43,354),(37,43,252),(38,177,141),(39,177,143),(40,177,142),(41,177,136),(42,177,363),(43,116,141),(44,116,143),(45,116,142),(46,116,136),(47,116,363),(48,2,143),(49,2,142),(50,2,136),(51,2,363),(52,4,141),(53,4,143),(54,4,142),(55,4,136),(56,4,363),(57,120,290),(58,120,402),(59,120,43),(60,19,427),(61,19,438),(62,19,200),(63,19,93),(64,19,63),(66,133,135),(67,12,37),(68,12,49),(69,12,57),(70,12,427),(71,12,319),(72,118,327),(73,118,144),(74,118,166),(75,118,157),(76,118,239),(77,118,241),(78,14,427),(79,14,45),(80,14,23),(81,14,63),(82,152,360),(83,152,43),(84,152,199),(85,40,77),(86,40,359),(88,56,22),(89,56,336),(90,56,115),(91,172,60),(92,172,221),(93,172,295),(94,172,360),(95,172,202),(96,172,316),(97,64,202),(98,45,247),(99,45,299),(100,44,431),(101,44,430),(102,44,429),(103,44,432),(104,123,290),(105,123,316),(106,123,168),(107,123,101),(108,123,387),(109,97,199),(110,97,18),(111,97,324),(112,97,43),(113,97,329),(114,122,199),(115,122,164),(116,122,43),(117,122,221),(118,122,287),(119,25,283),(120,25,63),(121,25,380),(122,25,86),(123,25,307),(124,9,317),(125,9,356),(126,9,398),(127,9,114),(128,27,77),(129,27,51),(130,130,411),(131,134,411),(132,106,90),(133,106,104),(134,106,28),(135,106,426),(136,95,297),(137,95,182),(138,95,1),(139,165,393),(140,165,98),(141,165,265),(142,165,393),(143,165,98),(144,165,265),(145,129,363),(146,62,77),(147,62,416),(148,62,2),(149,113,494),(150,113,171),(151,113,496),(152,49,417),(153,49,418),(154,49,421),(155,49,427),(156,49,436),(157,170,160),(158,170,60),(159,20,77),(160,63,264),(161,63,298),(162,63,347),(163,63,228),(164,121,118),(165,121,358),(166,121,287),(167,121,202),(168,121,164),(169,171,118),(170,171,358),(171,171,287),(172,171,202),(173,171,164),(174,46,93),(175,46,25),(176,46,22),(177,46,2),(178,119,360),(179,119,118),(180,119,222),(181,119,43),(182,119,316),(183,83,160),(184,83,60),(185,6,163),(186,6,262),(187,6,416),(188,6,154),(189,6,224),(190,33,163),(191,33,262),(192,33,416),(193,33,154),(194,33,224),(195,67,163),(196,67,262),(197,67,416),(198,67,154),(199,67,224),(200,3,137),(201,3,256),(202,3,423),(203,3,146),(204,3,284),(205,136,137),(206,136,256),(207,136,423),(208,136,146),(209,136,284),(210,151,233),(211,151,330),(212,151,256),(213,151,208),(214,151,284),(215,17,51),(216,17,52),(217,17,64),(218,17,70),(219,17,314),(220,39,275),(221,39,307),(222,39,63),(223,39,285),(224,39,57),(225,135,411),(226,135,33),(227,135,82),(228,52,215),(229,52,106),(230,52,83),(231,52,318),(232,52,176),(233,125,101),(234,125,108),(235,125,43),(236,103,222),(237,24,281),(238,24,433),(239,24,264),(241,26,380),(242,26,79),(243,26,343),(244,26,86),(245,26,279),(246,148,471),(247,18,51),(248,18,77),(249,18,52),(250,18,359),(251,54,70),(252,54,65),(253,54,76),(254,54,63),(255,54,112),(256,54,50),(257,54,130),(258,96,220),(259,96,178),(260,96,325),(261,96,43),(262,96,221),(263,96,347),(264,96,93),(265,96,77),(266,96,187),(267,78,245),(268,78,88),(269,78,49),(270,78,93),(271,78,264),(272,93,121),(273,93,206),(274,93,4),(275,93,272),(276,127,411),(277,88,372),(278,88,388),(279,88,404),(280,88,405),(281,178,366),(282,60,283),(283,60,63),(284,60,380),(285,60,86),(286,60,307),(287,60,54),(288,29,418),(289,29,421),(290,35,419),(291,35,240),(292,35,162),(293,69,419),(294,69,240),(295,69,162),(296,114,419),(297,114,240),(298,114,162),(299,38,300),(300,38,326),(301,38,347),(302,38,22),(303,38,336),(304,104,360),(305,104,287),(306,104,168),(307,104,221),(308,104,43),(309,13,307),(310,13,54),(311,13,379),(312,107,323),(313,107,287),(314,107,43),(315,107,360),(316,132,411),(317,175,80),(318,175,235),(319,175,249),(320,175,205),(321,150,136),(322,150,142),(323,155,136),(324,155,142),(325,147,448),(326,147,449),(327,147,450),(328,7,163),(329,7,262),(330,7,416),(331,7,154),(332,7,224),(333,34,163),(334,34,262),(335,34,416),(336,34,154),(337,34,224),(338,68,163),(339,68,262),(340,68,416),(341,68,154),(342,68,224),(343,23,378),(344,23,413),(345,23,425),(346,23,368),(347,23,318),(348,159,299),(349,91,405),(350,91,388),(351,91,106),(352,91,321),(353,91,318),(354,180,199),(355,180,287),(356,180,164),(357,180,43),(358,180,221),(359,10,307),(360,10,380),(361,10,79),(362,10,254),(363,10,63),(364,41,302),(365,41,137),(366,41,243),(367,145,394),(368,145,58),(369,145,395),(370,145,209),(371,145,211),(372,47,235),(373,47,237),(374,47,236),(375,158,235),(376,158,237),(377,158,236),(378,174,235),(379,174,237),(380,174,236),(381,79,427),(382,82,121),(383,82,206),(384,82,4),(385,82,272),(386,101,361),(387,101,43),(388,101,221),(389,28,77),(390,28,112),(391,28,280),(392,28,318),(393,28,103),(394,76,427),(395,76,318),(396,76,195),(397,76,321),(399,21,30),(400,21,137),(401,21,367),(402,21,497),(403,21,156),(404,80,427),(405,80,417),(406,80,409),(407,90,498),(408,90,264),(409,90,2),(410,5,163),(411,5,262),(412,5,416),(413,5,154),(414,5,224),(415,5,267),(416,32,163),(417,32,262),(418,32,416),(419,32,154),(420,32,224),(421,32,267),(422,66,163),(423,66,262),(424,66,416),(425,66,154),(426,66,224),(427,66,267),(428,94,201),(429,94,255),(430,94,43),(431,94,221),(432,94,38),(433,94,127),(434,124,201),(435,124,255),(436,124,43),(437,124,221),(438,124,38),(439,124,127),(440,11,245),(441,11,88),(442,11,49),(443,11,93),(444,11,264),(445,109,118),(446,109,316),(447,109,168),(448,109,101),(449,109,387),(450,140,276),(451,140,351),(452,140,277),(453,140,339),(454,98,312),(455,98,43),(456,98,56),(457,146,122),(458,146,43),(459,146,165),(460,146,374),(461,146,110),(462,59,286),(463,59,93),(464,59,25),(465,59,115),(466,59,310),(467,16,72),(468,16,70),(469,16,71),(470,16,69),(471,16,67),(472,126,411),(473,102,360),(474,102,361),(475,157,150),(476,157,148),(477,157,149),(478,157,151),(479,157,152),(480,89,37),(481,89,86),(482,89,197),(483,89,441),(484,51,202),(485,117,202);
/*!40000 ALTER TABLE `detalletienda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estacionamiento`
--

DROP TABLE IF EXISTS `estacionamiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estacionamiento` (
  `idestacionamiento` int(11) NOT NULL AUTO_INCREMENT,
  `idnodo` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idestacionamiento`),
  KEY `fk_estacionamiento_1` (`idnodo`),
  CONSTRAINT `fk_estacionamiento_1` FOREIGN KEY (`idnodo`) REFERENCES `nodos` (`idnodo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estacionamiento`
--

LOCK TABLES `estacionamiento` WRITE;
/*!40000 ALTER TABLE `estacionamiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `estacionamiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `idlogin` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idlogin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `idlogs` int(11) NOT NULL AUTO_INCREMENT,
  `logscol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idlogs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB AUTO_INCREMENT=625 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` VALUES (4,'Adidas'),(5,'Afex'),(6,'Afrodita'),(9,'Amchi'),(13,'Andrea Rosseti'),(15,'AOC'),(19,'Arnette'),(26,'Avent'),(27,'Azaleia'),(29,'Banco de Chile'),(31,'Banco Falabella'),(36,'Bariloche'),(37,'Bata'),(40,'BB2'),(42,'BCI'),(47,'BH'),(48,'Biblioteca Viva'),(51,'Biocure'),(52,'Black'),(57,'Borghi'),(58,'Boutique Mex'),(59,'Bravíssimo'),(60,'Bresler'),(62,'Britax'),(63,'Brooks'),(65,'Bruno Rossi'),(66,'Bubble Gummers'),(67,'Bufalo Beef'),(68,'Buffet Express'),(69,'Bulova'),(70,'Burger King'),(71,'Cacharel'),(73,'Caffarena'),(75,'Calvin Klein'),(76,'Cangaroos'),(77,'Cannon'),(78,'Capellini'),(81,'Carry'),(85,'Casio'),(86,'Cat'),(89,'Chanel'),(92,'Chery'),(93,'Chevrolet'),(94,'Chic'),(95,'Chicco'),(97,'Chinawok'),(100,'Cinemark'),(102,'Cluny'),(103,'CMR'),(104,'Colgate'),(105,'Colloky'),(106,'Columbia'),(108,'Converse'),(112,'Credichile'),(113,'Cushe'),(117,'Davison'),(118,'De Togni'),(122,'Disean'),(123,'Disney'),(125,'Do It'),(127,'Doggis'),(129,'Domino'),(130,'Dunkin Donut\'S'),(132,'DYG'),(134,'Ellus'),(143,'Europa'),(157,'Ficcus'),(159,'Fila'),(164,'Ford'),(165,'Forum'),(166,'Fossil'),(167,'Foster'),(170,'Fritz'),(177,'GMO'),(179,'Gotta'),(183,'Guante'),(184,'Gucci'),(185,'Hafei'),(188,'Happyland'),(190,'Head'),(191,'Hering'),(197,'HP'),(200,'Hush Puppies'),(202,'Hyundai'),(203,'IPhone'),(207,'Infanti'),(208,'Integramedica'),(209,'Intime'),(211,'Isdin'),(215,'Jansport'),(216,'JJO'),(218,'Jordan'),(219,'Joyas Barón'),(220,'Juan Maestro'),(222,'Kayser'),(223,'Kentucky Friend Chicken'),(224,'Kerastase'),(225,'Kia Carens'),(226,'Kia Morning'),(227,'Kia Rio 3'),(228,'Kia Rio 4'),(229,'Kia Rio 5'),(230,'Konica'),(234,'La Roche Posa'),(236,'Laboratorio Chile'),(237,'Lady Ventury'),(243,'Lg'),(245,'Limonada'),(248,'Loreal'),(255,'Marquis'),(259,'Maui & Sons'),(263,'Mc Donald\'S'),(264,'Medipharm'),(265,'Merrel'),(269,'Mininas'),(274,'Monarch'),(275,'Monix'),(276,'Montini'),(288,'Nero'),(290,'New Era'),(294,'Nike'),(295,'Ninbus'),(300,'Nokia'),(301,'North Star'),(307,'Opticas Schilling'),(313,'Panasonic'),(314,'Pandora'),(319,'Patuelli'),(320,'Pcfactory'),(321,'Pedro Juan & Diego'),(322,'Pepe Jeans'),(325,'Phillips'),(326,'Pigeon'),(327,'Pillin'),(336,'Pollini'),(337,'Poseidon'),(339,'Power'),(340,'Pre-Unic'),(344,'Puma'),(345,'Ralph'),(348,'Reebook'),(350,'Regatta'),(352,'Rip Curl'),(354,'Rockford'),(356,'Rotter & Krauss'),(358,'Rusty'),(360,'Salfa'),(361,'Samsonite'),(362,'Samsung'),(366,'Sara'),(367,'Savory'),(368,'Saxoline'),(369,'Schop Dog'),(373,'Sencillito'),(375,'Skechers'),(377,'Sony'),(392,'Tarjeta Salco'),(394,'Tatienne'),(396,'Telepizza'),(399,'Timer'),(400,'Tobacco Store'),(401,'Todo Piel'),(402,'Todomoda'),(406,'Toscani'),(407,'Toshiba'),(409,'Toyota'),(414,'Tronwell'),(416,'Umbro'),(418,'Vans'),(419,'Via Marte'),(421,'Vitamin Life'),(424,'Volcom'),(428,'Wados'),(432,'Xtrem'),(435,'Yogen Fruz'),(440,'Abismo'),(447,'Ansonia'),(456,'La Polar'),(461,'Bottero'),(472,'Chia'),(475,'Citroen'),(482,'Haby'),(483,'Fergie'),(484,'Crew'),(488,'Daily One Gold'),(491,'Nextel'),(492,'Troglodita'),(494,'Alegretto'),(495,'Bob\'s'),(496,'Cinemundo'),(497,'Corporación Cultural Estación Central'),(498,'Inside'),(499,'La Kabina'),(502,'Emerica'),(514,'Frutos'),(518,'Golden Chile'),(538,'La Araucana'),(595,'Secure'),(612,'Termofat'),(618,'Triline'),(624,'Vestal');
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensaje` (
  `idMensaje` int(11) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(100) DEFAULT NULL,
  `mailUsuario` varchar(100) DEFAULT NULL,
  `fonoContacto` varchar(100) DEFAULT NULL,
  `mensaje` text,
  `idSubMotivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMensaje`),
  KEY `fk_mensaje_subMotivo` (`idSubMotivo`),
  CONSTRAINT `fk_mensaje_subMotivo` FOREIGN KEY (`idSubMotivo`) REFERENCES `submotivo` (`idSubMotivo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensaje`
--

LOCK TABLES `mensaje` WRITE;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motivo`
--

DROP TABLE IF EXISTS `motivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `motivo` (
  `idMotivo` int(11) NOT NULL AUTO_INCREMENT,
  `nombreMotivo` varchar(100) DEFAULT NULL,
  `idSubCategoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMotivo`),
  KEY `fk_motivo_subCategoria` (`idSubCategoria`),
  CONSTRAINT `fk_motivo_subCategoria` FOREIGN KEY (`idSubCategoria`) REFERENCES `subcategoria` (`idSubCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motivo`
--

LOCK TABLES `motivo` WRITE;
/*!40000 ALTER TABLE `motivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `motivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nodos`
--

DROP TABLE IF EXISTS `nodos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodos` (
  `idnodo` int(11) NOT NULL AUTO_INCREMENT,
  `idcambiadorPiso` int(11) DEFAULT NULL,
  `ubicacionx` varchar(45) NOT NULL,
  `ubicaciony` varchar(45) NOT NULL,
  `piso` varchar(45) NOT NULL,
  `vecino1` int(11) DEFAULT NULL,
  `vecino2` int(11) DEFAULT NULL,
  `vecino3` int(11) DEFAULT NULL,
  `vecino4` int(11) DEFAULT NULL,
  `coordenadaReal` varchar(45) NOT NULL,
  PRIMARY KEY (`idnodo`),
  KEY `fk_nodos_1` (`idcambiadorPiso`),
  CONSTRAINT `fk_nodos_1` FOREIGN KEY (`idcambiadorPiso`) REFERENCES `cambiadorpiso` (`idcambiadorPiso`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nodos`
--

LOCK TABLES `nodos` WRITE;
/*!40000 ALTER TABLE `nodos` DISABLE KEYS */;
INSERT INTO `nodos` VALUES (1,NULL,'11','49','1',0,0,0,0,'11_49'),(2,NULL,'11','46','1',0,0,0,0,'11_46'),(3,NULL,'11','42','1',0,0,0,0,'11_42'),(4,NULL,'12','36','1',0,0,0,0,'12_36'),(5,NULL,'28','23','1',0,0,0,0,'28_23'),(6,NULL,'48','23','1',0,0,0,0,'48_23'),(7,NULL,'68','21','1',0,0,0,0,'68_21'),(8,NULL,'63','23','1',0,0,0,0,'63_23'),(9,NULL,'59','23','1',0,0,0,0,'59_23'),(10,NULL,'56','23','1',0,0,0,0,'56_23'),(11,NULL,'52','23','1',0,0,0,0,'52_23'),(12,NULL,'42','21','1',0,0,0,0,'42_21'),(13,NULL,'39','21','1',0,0,0,0,'39_21'),(14,NULL,'37','21','1',0,0,0,0,'37_21'),(15,NULL,'35','21','1',0,0,0,0,'35_21'),(16,NULL,'33','21','1',0,0,0,0,'33_21'),(17,NULL,'68','18','1',0,0,0,0,'68_18'),(18,NULL,'67','17','1',0,0,0,0,'67_17'),(19,NULL,'63','17','1',0,0,0,0,'63_17'),(20,NULL,'59','17','1',0,0,0,0,'59_17'),(21,NULL,'56','17','1',0,0,0,0,'56_17'),(22,NULL,'54','17','1',0,0,0,0,'54_17'),(23,NULL,'49','16','1',0,0,0,0,'49_16'),(24,NULL,'44','15','1',0,0,0,0,'44_15'),(25,NULL,'41','15','1',0,0,0,0,'41_15'),(26,NULL,'39','15','1',0,0,0,0,'39_15'),(27,NULL,'37','15','1',0,0,0,0,'37_15'),(28,NULL,'35','15','1',0,0,0,0,'35_15'),(29,NULL,'31','15','1',0,0,0,0,'31_15'),(30,NULL,'25','11','1',0,0,0,0,'25_11'),(31,NULL,'22','10','1',0,0,0,0,'22_10'),(32,NULL,'28','23','2',0,0,0,0,'28_23'),(33,NULL,'48','23','2',0,0,0,0,'48_23'),(34,NULL,'68','23','2',0,0,0,0,'68_23'),(35,NULL,'83','21','2',0,0,0,0,'83_21'),(36,NULL,'81','23','2',0,0,0,0,'81_23'),(37,NULL,'77','23','2',0,0,0,0,'77_23'),(38,NULL,'75','23','2',0,0,0,0,'75_23'),(39,NULL,'72','23','2',0,0,0,0,'72_23'),(40,NULL,'63','23','2',0,0,0,0,'63_23'),(41,NULL,'61','23','2',0,0,0,0,'61_23'),(42,NULL,'59','23','2',0,0,0,0,'59_23'),(43,NULL,'54','23','2',0,0,0,0,'54_23'),(44,NULL,'43','21','2',0,0,0,0,'43_21'),(45,NULL,'40','21','2',0,0,0,0,'40_21'),(46,NULL,'37','21','2',0,0,0,0,'37_21'),(47,NULL,'33','21','2',0,0,0,0,'33_21'),(48,NULL,'23','23','2',0,0,0,0,'23_23'),(49,NULL,'21','21','2',0,0,0,0,'21_21'),(50,NULL,'20','18','2',0,0,0,0,'20_18'),(51,NULL,'20','15','2',0,0,0,0,'20_15'),(52,NULL,'31','15','2',0,0,0,0,'31_15'),(53,NULL,'36','15','2',0,0,0,0,'36_15'),(54,NULL,'39','15','2',0,0,0,0,'39_15'),(55,NULL,'41','15','2',0,0,0,0,'41_15'),(56,NULL,'43','15','2',0,0,0,0,'43_15'),(57,NULL,'45','15','2',0,0,0,0,'45_15'),(58,NULL,'50','16','2',0,0,0,0,'50_16'),(59,NULL,'53','17','2',0,0,0,0,'53_17'),(60,NULL,'56','17','2',0,0,0,0,'56_17'),(61,NULL,'59','17','2',0,0,0,0,'59_17'),(62,NULL,'64','16','2',0,0,0,0,'64_16'),(63,NULL,'70','17','2',0,0,0,0,'70_17'),(64,NULL,'71','19','2',0,0,0,0,'71_19'),(65,NULL,'15','49','3',0,0,0,0,'15_49'),(66,NULL,'27','23','3',0,0,0,0,'27_23'),(67,NULL,'48','23','3',0,0,0,0,'48_23'),(68,NULL,'68','23','3',0,0,0,0,'68_23'),(69,NULL,'83','22','3',0,0,0,0,'83_22'),(70,NULL,'82','23','3',0,0,0,0,'82_23'),(71,NULL,'80','23','3',0,0,0,0,'80_23'),(72,NULL,'78','23','3',0,0,0,0,'78_23'),(73,NULL,'75','23','3',0,0,0,0,'75_23'),(74,NULL,'72','23','3',0,0,0,0,'72_23'),(75,NULL,'62','23','3',0,0,0,0,'62_23'),(76,NULL,'59','23','3',0,0,0,0,'59_23'),(77,NULL,'54','23','3',0,0,0,0,'54_23'),(78,NULL,'45','22','3',0,0,0,0,'45_22'),(79,NULL,'39','21','3',0,0,0,0,'39_21'),(80,NULL,'33','21','3',0,0,0,0,'33_21'),(81,NULL,'22','23','3',0,0,0,0,'22_23'),(82,NULL,'20','18','3',0,0,0,0,'20_18'),(83,NULL,'20','15','3',0,0,0,0,'20_15'),(84,NULL,'24','11','3',0,0,0,0,'24_11'),(85,NULL,'31','15','3',0,0,0,0,'31_15'),(86,NULL,'35','15','3',0,0,0,0,'35_15'),(87,NULL,'37','15','3',0,0,0,0,'37_15'),(88,NULL,'41','15','3',0,0,0,0,'41_15'),(89,NULL,'49','16','3',0,0,0,0,'49_16'),(90,NULL,'55','17','3',0,0,0,0,'55_17'),(91,NULL,'60','17','3',0,0,0,0,'60_17'),(92,NULL,'65','17','3',0,0,0,0,'65_17'),(93,NULL,'69','17','3',0,0,0,0,'69_17'),(94,NULL,'72','19','3',0,0,0,0,'72_19'),(95,NULL,'64','24','4',0,0,0,0,'64_24'),(96,NULL,'37','50','4',0,0,0,0,'37_50'),(97,NULL,'32','53','4',0,0,0,0,'32_53'),(98,NULL,'30','53','4',0,0,0,0,'30_53'),(99,NULL,'27','53','4',0,0,0,0,'27_53'),(100,NULL,'25','52','4',0,0,0,0,'25_52'),(101,NULL,'24','50','4',0,0,0,0,'24_50'),(102,NULL,'24','47','4',0,0,0,0,'24_47'),(103,NULL,'24','44','4',0,0,0,0,'24_44'),(104,NULL,'24','41','4',0,0,0,0,'24_41'),(105,NULL,'24','39','4',0,0,0,0,'24_39'),(106,NULL,'24','36','4',0,0,0,0,'24_36'),(107,NULL,'23','31','4',0,0,0,0,'23_31'),(108,NULL,'38','15','4',0,0,0,0,'38_15'),(109,NULL,'48','15','4',0,0,0,0,'48_15'),(110,NULL,'54','15','4',0,0,0,0,'54_15'),(111,NULL,'56','15','4',0,0,0,0,'56_15'),(112,NULL,'59','15','4',0,0,0,0,'59_15'),(113,NULL,'66','17','4',0,0,0,0,'66_17'),(114,NULL,'84','22','4',0,0,0,0,'84_22'),(115,NULL,'79','23','4',0,0,0,0,'79_23'),(116,NULL,'73','23','4',0,0,0,0,'73_23'),(117,NULL,'68','23','4',0,0,0,0,'68_23'),(118,NULL,'60','27','4',0,0,0,0,'60_27'),(119,NULL,'56','27','4',0,0,0,0,'56_27'),(120,NULL,'52','27','4',0,0,0,0,'52_27'),(121,NULL,'44','27','4',0,0,0,0,'44_27'),(122,NULL,'43','34','4',0,0,0,0,'43_34'),(123,NULL,'43','38','4',0,0,0,0,'43_38'),(124,NULL,'43','41','4',0,0,0,0,'43_41'),(125,NULL,'41','43','4',0,0,0,0,'41_43'),(126,NULL,'60','31','-1',0,0,0,0,'60_31'),(127,NULL,'73','23','-1',0,0,0,0,'73_23'),(128,NULL,'91','23','-1',0,0,0,0,'91_23'),(129,NULL,'103','29','-1',0,0,0,0,'103_29'),(130,NULL,'107','27','-1',0,0,0,0,'107_27'),(131,NULL,'108','22','-1',0,0,0,0,'108_22'),(132,NULL,'96','24','-1',0,0,0,0,'96_24'),(133,NULL,'103','20','-1',0,0,0,0,'103_20'),(134,NULL,'93','23','-1',0,0,0,0,'93_23'),(135,NULL,'75','22','-1',0,0,0,0,'75_22'),(136,NULL,'70','25','-1',0,0,0,0,'70_25'),(137,NULL,'60','26','-1',0,0,0,0,'60_26'),(138,NULL,'60','23','-1',0,0,0,0,'60_23'),(139,NULL,'57','21','-1',0,0,0,0,'57_21'),(140,NULL,'57','28','-1',0,0,0,0,'57_28'),(142,NULL,'52','28','-1',0,0,0,0,'52_28'),(144,NULL,'48','28','-1',0,0,0,0,'48_28'),(145,NULL,'45','28','-1',0,0,0,0,'45_28'),(146,NULL,'42','28','-1',0,0,0,0,'42_28'),(147,NULL,'40','28','-1',0,0,0,0,'40_28'),(148,NULL,'38','28','-1',0,0,0,0,'38_28'),(149,NULL,'36','28','-1',0,0,0,0,'36_28'),(150,NULL,'34','28','-1',0,0,0,0,'34_28'),(151,NULL,'29','28','-1',0,0,0,0,'29_28'),(152,NULL,'26','19','-1',0,0,0,0,'26_19'),(153,NULL,'30','19','-1',0,0,0,0,'30_19'),(154,NULL,'32','19','-1',0,0,0,0,'32_19'),(155,NULL,'34','19','-1',0,0,0,0,'34_19'),(157,NULL,'44','19','-1',0,0,0,0,'44_19'),(158,NULL,'54','21','-1',0,0,0,0,'54_21'),(159,NULL,'64','17','-1',0,0,0,0,'64_17'),(160,NULL,'58','17','-1',0,0,0,0,'58_17'),(161,NULL,'55','16','-1',0,0,0,0,'55_16'),(162,NULL,'53','16','-1',0,0,0,0,'53_16'),(163,NULL,'50','16','-1',0,0,0,0,'50_16'),(165,NULL,'40','16','-1',0,0,0,0,'40_16'),(169,NULL,'27','14','-1',0,0,0,0,'27_14'),(170,NULL,'23','12','-1',0,0,0,0,'23_12'),(171,NULL,'21','11','-1',0,0,0,0,'21_11'),(172,NULL,'17','10','-1',0,0,0,0,'17_10'),(174,NULL,'15','18','-1',0,0,0,0,'15_18'),(175,NULL,'15','20','-1',0,0,0,0,'15_20'),(176,NULL,'15','24','-1',0,0,0,0,'15_24'),(177,NULL,'12','29','1',0,0,0,0,'12_29'),(178,NULL,'10','54','1',0,0,0,0,'10_54'),(179,NULL,'64','24','4',0,0,0,0,'64_24'),(180,NULL,'28','30','4',0,0,0,0,'28_30'),(181,1,'19','20','1',0,0,0,0,'19_20'),(182,2,'25','8','1',0,0,0,0,'25_8'),(183,3,'27','7','1',0,0,0,0,'27_7'),(184,4,'29','16','1',0,0,0,0,'29_16'),(185,5,'29','18','1',0,0,0,0,'29_18'),(186,6,'33','17','1',0,0,0,0,'33_17'),(187,7,'66','19','1',0,0,0,0,'66_19'),(188,8,'66','21','1',0,0,0,0,'66_21'),(189,9,'25','8','2',0,0,0,0,'25_8'),(190,10,'27','7','2',0,0,0,0,'27_7'),(191,11,'29','16','2',0,0,0,0,'29_16'),(192,12,'29','18','2',0,0,0,0,'29_18'),(193,13,'66','19','2',0,0,0,0,'66_19'),(194,14,'66','21','2',0,0,0,0,'66_21'),(195,15,'25','8','3',0,0,0,0,'25_8'),(196,16,'27','7','3',0,0,0,0,'27_7'),(197,17,'29','16','3',0,0,0,0,'29_16'),(198,18,'29','18','3',0,0,0,0,'29_18'),(199,19,'66','19','3',0,0,0,0,'66_19'),(200,20,'66','21','3',0,0,0,0,'66_21'),(201,21,'25','8','4',0,0,0,0,'25_8'),(202,22,'27','7','4',0,0,0,0,'27_7'),(203,23,'66','19','4',0,0,0,0,'66_19'),(204,24,'66','21','4',0,0,0,0,'66_21'),(205,25,'19','20','-1',0,0,0,0,'19_20'),(206,26,'25','8','-1',0,0,0,0,'25_8'),(207,27,'27','7','-1',0,0,0,0,'27_7'),(208,28,'29','16','-1',0,0,0,0,'29_16'),(209,29,'29','18','-1',0,0,0,0,'29_18'),(210,30,'33','17','-1',0,0,0,0,'33_17'),(211,31,'66','19','-1',0,0,0,0,'66_19'),(212,32,'66','21','-1',0,0,0,0,'66_21'),(213,33,'25','8','-2',0,0,0,0,'25_8'),(214,34,'27','7','-2',0,0,0,0,'27_7'),(215,35,'25','8','-3',0,0,0,0,'25_8'),(216,36,'27','7','-3',0,0,0,0,'27_7'),(217,37,'25','8','-4',0,0,0,0,'25_8'),(218,38,'27','7','-4',0,0,0,0,'27_7'),(219,NULL,'52','20','1',0,0,0,0,'52_20');
/*!40000 ALTER TABLE `nodos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oferta`
--

DROP TABLE IF EXISTS `oferta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oferta` (
  `idoferta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `oferta` text,
  `stock` int(11) DEFAULT NULL,
  `idtienda` int(11) DEFAULT NULL,
  PRIMARY KEY (`idoferta`),
  KEY `fk_of_idtienda` (`idtienda`),
  CONSTRAINT `fk_of_idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oferta`
--

LOCK TABLES `oferta` WRITE;
/*!40000 ALTER TABLE `oferta` DISABLE KEYS */;
/*!40000 ALTER TABLE `oferta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfilusuario`
--

DROP TABLE IF EXISTS `perfilusuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfilusuario` (
  `idPerfilUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador',
  `id_usuario` int(11) NOT NULL COMMENT 'id del usuario para vincular registro',
  `modulo` varchar(30) NOT NULL COMMENT 'nombre de funcionalidad o modulo',
  `credencial` tinyint(4) NOT NULL COMMENT 'estado, denegado o autorizado',
  PRIMARY KEY (`idPerfilUsuario`),
  UNIQUE KEY `id_usuario` (`id_usuario`,`modulo`),
  KEY `fk_perfilUsuario_usuario1` (`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfilusuario`
--

LOCK TABLES `perfilusuario` WRITE;
/*!40000 ALTER TABLE `perfilusuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfilusuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `genero` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=499 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'3D','NULL','NULL'),(2,'Accesorios','NULL','NULL'),(4,'Accesorios Computación','NULL','NULL'),(18,'Almuerzo','NULL','NULL'),(22,'Anillos','NULL','NULL'),(23,'Anteojos','NULL','NULL'),(25,'Aros','NULL','NULL'),(28,'Arrollados','NULL','NULL'),(30,'Articulos Hogar','NULL','NULL'),(33,'Automóviles','NULL','NULL'),(37,'Balones','NULL','NULL'),(38,'Barquillos','NULL','NULL'),(43,'Bebidas','NULL','NULL'),(45,'Billeteras','NULL','NULL'),(49,'Bolsos','NULL','NULL'),(50,'Bolsos De Cuero','NULL','NULL'),(51,'Botas','NULL','NULL'),(52,'Botines','NULL','NULL'),(54,'Boxer','NULL','NULL'),(56,'Burritos','NULL','NULL'),(57,'Buzos','NULL','NULL'),(58,'Cable','NULL','NULL'),(60,'Café','NULL','NULL'),(62,'Calcetas','NULL','NULL'),(63,'Calcetines','NULL','NULL'),(64,'Calzado De Fiesta','NULL','NULL'),(65,'Calzado De Vestir','NULL','NULL'),(67,'Calzado Descanso','NULL','NULL'),(69,'Calzado Fiesta','NULL','NULL'),(70,'Calzado Formal','NULL','NULL'),(71,'Calzado Informal','NULL','NULL'),(72,'Calzado Mujer','NULL','NULL'),(76,'Calzado Tipo Zapatillas','NULL','NULL'),(77,'Calzados','NULL','NULL'),(79,'Calzones','NULL','NULL'),(80,'Camaras','NULL','NULL'),(82,'Camionetas','NULL','NULL'),(83,'Camisas','NULL','NULL'),(86,'Camisetas','NULL','NULL'),(88,'Candados','NULL','NULL'),(90,'Carne Mongoliana','NULL','NULL'),(93,'Carteras','NULL','NULL'),(98,'Celulares','NULL','NULL'),(101,'Cervezas','NULL','NULL'),(103,'Chalecos','NULL','NULL'),(104,'Chapsui De Pollo','NULL','NULL'),(106,'Chaquetas','NULL','NULL'),(108,'Churrascos','NULL','NULL'),(110,'Cigarrillos','NULL','NULL'),(112,'Cinturones','NULL','NULL'),(113,'Coches','NULL','NULL'),(114,'Cojines','NULL','NULL'),(115,'Collares','NULL','NULL'),(118,'Completos','NULL','NULL'),(120,'Compra Y Venta Moneda Internacional','NULL','NULL'),(121,'Computadores','NULL','NULL'),(122,'Confites','NULL','NULL'),(127,'Copas Helado','NULL','NULL'),(130,'Cordones','NULL','NULL'),(135,'Crédito Convencional','NULL','NULL'),(136,'Créditos','NULL','NULL'),(137,'Cremas','NULL','NULL'),(141,'Cuentas Corrientes','NULL','NULL'),(142,'Cuentas De Ahorro','NULL','NULL'),(143,'Cuentas Vista','NULL','NULL'),(144,'Cuentos','NULL','NULL'),(146,'Cuidado Personal','NULL','NULL'),(147,'Cunas','NULL','NULL'),(148,'Cursos De Aleman','NULL','NULL'),(149,'Cursos De Frances','NULL','NULL'),(150,'Cursos De Ingles','NULL','NULL'),(151,'Cursos De Italiano','NULL','NULL'),(152,'Cursos De Portugues','NULL','NULL'),(154,'Deporte','NULL','NULL'),(156,'Detergente','NULL','NULL'),(157,'Diccionarios','NULL','NULL'),(160,'Donuts And Late','NULL','NULL'),(162,'Electrodomesticos','NULL','NULL'),(163,'Electronica','NULL','NULL'),(164,'Empanadas','NULL','NULL'),(165,'Encendedores','NULL','NULL'),(166,'Enciclopedia','NULL','NULL'),(168,'Ensaladas','NULL','NULL'),(171,'Esculturas','NULL','NULL'),(176,'Faldas','NULL','NULL'),(178,'Fichas Juego','NULL','NULL'),(182,'Formatos Digitales','NULL','NULL'),(187,'Gafas','NULL','NULL'),(195,'Gorros','NULL','NULL'),(197,'Guantes','NULL','NULL'),(199,'Hamburguesas','NULL','NULL'),(200,'Hawaianas','NULL','NULL'),(201,'Heladeria','NULL','NULL'),(202,'Helados','NULL','NULL'),(205,'Impresiones Fotograficas','NULL','NULL'),(206,'Impresoras','NULL','NULL'),(208,'Insumos','NULL','NULL'),(209,'Internet','NULL','NULL'),(211,'Internet Portatil','NULL','NULL'),(215,'Jeans','NULL','NULL'),(220,'Juegos Infantiles','NULL','NULL'),(221,'Jugos','NULL','NULL'),(222,'Jugos Naturales','NULL','NULL'),(224,'Juguetes','NULL','NULL'),(228,'Lapiceria','NULL','NULL'),(233,'Leche','NULL','NULL'),(235,'Lentes','NULL','NULL'),(236,'Lentes De Sol','NULL','NULL'),(237,'Lentes Opticos','NULL','NULL'),(239,'Libros Entretenimiento','NULL','NULL'),(240,'Linea Blanca','NULL','NULL'),(241,'Literatura General','NULL','NULL'),(243,'Lociones','NULL','NULL'),(245,'Maletas','NULL','NULL'),(247,'Manicure','NULL','NULL'),(249,'Marcos','NULL','NULL'),(252,'Mecedoras','NULL','NULL'),(254,'Medias','NULL','NULL'),(255,'Medias Luna','NULL','NULL'),(256,'Medicamentos','NULL','NULL'),(262,'Menaje','NULL','NULL'),(264,'Mochilas','NULL','NULL'),(265,'Modem Internet','NULL','NULL'),(267,'Muebles','NULL','NULL'),(272,'Notebook','NULL','NULL'),(275,'Ositos','NULL','NULL'),(276,'Pago de Cuentas','NULL','NULL'),(277,'Pago Isp','NULL','NULL'),(279,'Pantaletas','NULL','NULL'),(280,'Pantalones','NULL','NULL'),(281,'Pantalones De Trekking','NULL','NULL'),(283,'Pantys','NULL','NULL'),(284,'Pañales','NULL','NULL'),(285,'Pañales De Tela','NULL','NULL'),(286,'Pañuelos','NULL','NULL'),(287,'Papas Fritas','NULL','NULL'),(290,'Parrilladas','NULL','NULL'),(294,'Pasteles','NULL','NULL'),(295,'Pastelería','NULL','NULL'),(297,'Peliculas 35 mm','NULL','NULL'),(298,'Peluches','NULL','NULL'),(299,'Peluquería','NULL','NULL'),(300,'Pendientes','NULL','NULL'),(302,'Perfumes','NULL','NULL'),(307,'Pijamas','NULL','NULL'),(310,'Pinches','NULL','NULL'),(312,'Pizzas','NULL','NULL'),(314,'Plantillas','NULL','NULL'),(316,'Platos Preparados','NULL','NULL'),(317,'Plumones','NULL','NULL'),(318,'Poleras','NULL','NULL'),(319,'Poleras Deportivas','NULL','NULL'),(321,'Polerones','NULL','NULL'),(323,'Pollo Frito','NULL','NULL'),(324,'Postres','NULL','NULL'),(325,'Premios','NULL','NULL'),(326,'Prendedores','NULL','NULL'),(327,'Prestamo De Libros E Internet','NULL','NULL'),(329,'Productos Ligth','NULL','NULL'),(330,'Productos Maternales','NULL','NULL'),(336,'Pulseras','NULL','NULL'),(339,'Recargas Celular','NULL','NULL'),(343,'Reductoras','NULL','NULL'),(347,'Relojes','NULL','NULL'),(351,'Retiro Y Cobro De Cheques','NULL','NULL'),(352,'Ropa Cama','NULL','NULL'),(354,'Ropa Infantil','NULL','NULL'),(356,'Sabanas','NULL','NULL'),(358,'Salchipapas','NULL','NULL'),(359,'Sandalias','NULL','NULL'),(360,'Sandwichs','NULL','NULL'),(361,'Sandwicheria','NULL','NULL'),(363,'Seguros','NULL','NULL'),(366,'Servicios de salud','NULL','NULL'),(367,'Shampoo','NULL','NULL'),(368,'Shorts','NULL','NULL'),(369,'Sillas De Comer','NULL','NULL'),(370,'Sillas Para Auto','NULL','NULL'),(372,'Skate','NULL','NULL'),(374,'Snack','NULL','NULL'),(378,'Sombrillas','NULL','NULL'),(379,'Sostenes Calzones','NULL','NULL'),(380,'Sostenes','NULL','NULL'),(387,'Tablas','NULL','NULL'),(388,'Tablas De Surf','NULL','NULL'),(393,'Telefonia','NULL','NULL'),(394,'Telefonìa Fija','NULL','NULL'),(395,'Telefonia Movil','NULL','NULL'),(398,'Toallas','NULL','NULL'),(402,'Tragos','NULL','NULL'),(404,'Trajes de baño','NULL','NULL'),(405,'Trajes De Surf','NULL','NULL'),(409,'Urbano','NULL','NULL'),(411,'Vehículos Nuevos','NULL','NULL'),(413,'Vestidos','NULL','NULL'),(416,'Vestuario','NULL','NULL'),(417,'Vestuario Deportivo','NULL','NULL'),(418,'Vestuario femenino','NULL','NULL'),(419,'Vestuario General','NULL','NULL'),(421,'Vestuario masculino','NULL','NULL'),(423,'Vitaminas','NULL','NULL'),(425,'Voleros','NULL','NULL'),(426,'Wantan','NULL','NULL'),(427,'Zapatillas','NULL','NULL'),(429,'Zapatillas Deportivas','NULL','NULL'),(430,'Zapatillas Niñas','NULL','NULL'),(431,'Zapatillas Niño','NULL','NULL'),(432,'Zapatillas Primeros Pasos','NULL','NULL'),(433,'Zapatillas Running','NULL','NULL'),(436,'Zapatos','NULL','NULL'),(438,'Calzados De Vestir','NULL','NULL'),(441,'Calzados Futbol','NULL','NULL'),(444,'Tablas Skate','NULL','NULL'),(445,'Transferencias','NULL','NULL'),(448,'Centro de Llamados','NULL','NULL'),(449,'Fotocopias','NULL','NULL'),(450,'Juegos de Azar','NULL','NULL'),(471,'Compra y Venta De Oro','NULL','NULL'),(494,'Pinturas','NULL','NULL'),(496,'Arte','NULL','NULL'),(497,'Esmalte','NULL','NULL'),(498,'Ropa De Nieve','NULL','NULL');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promocion`
--

DROP TABLE IF EXISTS `promocion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promocion` (
  `idpromocion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `detalle` text,
  `fechaInicio` timestamp NULL DEFAULT NULL,
  `fechaTermino` timestamp NULL DEFAULT NULL,
  `idtienda` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpromocion`),
  KEY `idtienda` (`idtienda`),
  CONSTRAINT `idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocion`
--

LOCK TABLES `promocion` WRITE;
/*!40000 ALTER TABLE `promocion` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propiedadestienda`
--

DROP TABLE IF EXISTS `propiedadestienda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propiedadestienda` (
  `idpropiedadesTienda` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) DEFAULT NULL,
  `idnodo` int(11) DEFAULT NULL,
  `modulo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpropiedadesTienda`),
  KEY `fk_propiedadesTienda_1` (`idtienda`),
  KEY `fk_propiedadesTienda_2` (`idnodo`),
  CONSTRAINT `fk_propiedadesTienda_1` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_propiedadesTienda_2` FOREIGN KEY (`idnodo`) REFERENCES `nodos` (`idnodo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedadestienda`
--

LOCK TABLES `propiedadestienda` WRITE;
/*!40000 ALTER TABLE `propiedadestienda` DISABLE KEYS */;
INSERT INTO `propiedadestienda` VALUES (1,1,1,'NULL'),(2,2,2,'NULL'),(3,3,3,'NULL'),(4,4,4,'NULL'),(5,5,5,'NULL'),(6,6,6,'NULL'),(7,7,7,'NULL'),(8,8,8,'NULL'),(9,9,9,'NULL'),(10,10,10,'NULL'),(11,11,11,'NULL'),(12,12,12,'NULL'),(13,13,13,'NULL'),(14,14,14,'NULL'),(15,15,15,'NULL'),(16,16,16,'NULL'),(17,17,17,'NULL'),(18,18,18,'NULL'),(19,19,19,'NULL'),(20,20,20,'NULL'),(21,21,21,'NULL'),(22,22,22,'NULL'),(23,23,23,'NULL'),(24,24,24,'NULL'),(25,25,25,'NULL'),(26,26,26,'NULL'),(27,27,27,'NULL'),(28,28,28,'NULL'),(29,29,29,'NULL'),(30,30,30,'NULL'),(31,31,31,'NULL'),(32,32,32,'NULL'),(33,33,33,'NULL'),(34,34,34,'NULL'),(35,35,35,'NULL'),(36,36,36,'NULL'),(37,37,37,'NULL'),(38,38,38,'NULL'),(39,39,39,'NULL'),(40,40,40,'NULL'),(41,41,41,'NULL'),(42,42,42,'NULL'),(43,43,43,'NULL'),(44,44,44,'NULL'),(45,45,45,'NULL'),(46,46,46,'NULL'),(47,47,47,'NULL'),(48,48,48,'NULL'),(49,49,49,'NULL'),(50,50,50,'NULL'),(51,51,51,'NULL'),(52,52,52,'NULL'),(53,53,53,'NULL'),(54,54,54,'NULL'),(55,55,55,'NULL'),(56,56,56,'NULL'),(57,57,57,'NULL'),(58,58,58,'NULL'),(59,59,59,'NULL'),(60,60,60,'NULL'),(61,61,61,'NULL'),(62,62,62,'NULL'),(63,63,63,'NULL'),(64,64,64,'NULL'),(65,65,65,'NULL'),(66,66,66,'NULL'),(67,67,67,'NULL'),(68,68,68,'NULL'),(69,69,69,'NULL'),(70,70,70,'NULL'),(71,71,71,'NULL'),(72,72,72,'NULL'),(73,73,73,'NULL'),(74,74,74,'NULL'),(75,75,75,'NULL'),(76,76,76,'NULL'),(77,77,77,'NULL'),(78,78,78,'NULL'),(79,79,79,'NULL'),(80,80,80,'NULL'),(81,81,81,'NULL'),(82,82,82,'NULL'),(83,83,83,'NULL'),(84,84,84,'NULL'),(85,85,85,'NULL'),(86,86,86,'NULL'),(87,87,87,'NULL'),(88,88,88,'NULL'),(89,89,89,'NULL'),(90,90,90,'NULL'),(91,91,91,'NULL'),(92,92,92,'NULL'),(93,93,93,'NULL'),(94,94,94,'NULL'),(95,95,95,'NULL'),(96,96,96,'NULL'),(97,97,97,'NULL'),(98,98,98,'NULL'),(99,99,99,'NULL'),(100,100,100,'NULL'),(101,101,101,'NULL'),(102,102,102,'NULL'),(103,103,103,'NULL'),(104,104,104,'NULL'),(105,105,105,'NULL'),(106,106,106,'NULL'),(107,107,107,'NULL'),(108,108,108,'NULL'),(109,109,109,'NULL'),(110,110,110,'NULL'),(111,111,111,'NULL'),(112,112,112,'NULL'),(113,113,113,'NULL'),(114,114,114,'NULL'),(115,115,115,'NULL'),(116,116,116,'NULL'),(117,117,117,'NULL'),(118,118,118,'NULL'),(119,119,119,'NULL'),(120,120,120,'NULL'),(121,121,121,'NULL'),(122,122,122,'NULL'),(123,123,123,'NULL'),(124,124,124,'NULL'),(125,125,125,'NULL'),(126,126,126,'NULL'),(127,127,127,'NULL'),(128,128,128,'NULL'),(129,129,129,'NULL'),(130,130,130,'NULL'),(131,131,131,'NULL'),(132,132,132,'NULL'),(133,133,133,'NULL'),(134,134,134,'NULL'),(135,135,135,'NULL'),(136,136,136,'NULL'),(137,137,137,'NULL'),(138,138,138,'NULL'),(139,139,139,'NULL'),(140,140,140,'NULL'),(141,142,142,'NULL'),(142,144,144,'NULL'),(143,145,145,'NULL'),(144,146,146,'NULL'),(145,147,147,'NULL'),(146,148,148,'NULL'),(147,149,149,'NULL'),(148,150,150,'NULL'),(149,151,151,'NULL'),(150,152,152,'NULL'),(151,153,153,'NULL'),(152,154,154,'NULL'),(153,155,155,'NULL'),(154,157,157,'NULL'),(155,158,158,'NULL'),(156,159,159,'NULL'),(157,160,160,'NULL'),(158,161,161,'NULL'),(159,162,162,'NULL'),(160,163,163,'NULL'),(161,165,165,'NULL'),(162,169,169,'NULL'),(163,170,170,'NULL'),(164,171,171,'NULL'),(165,172,172,'NULL'),(166,174,174,'NULL'),(167,175,175,'NULL'),(168,176,176,'NULL'),(169,177,177,'NULL'),(170,178,178,'NULL'),(171,179,179,'NULL'),(172,180,180,'NULL');
/*!40000 ALTER TABLE `propiedadestienda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reclamos`
--

DROP TABLE IF EXISTS `reclamos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reclamos` (
  `idreclamos` int(11) NOT NULL AUTO_INCREMENT,
  `rut` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidoPaterno` varchar(45) DEFAULT NULL,
  `apellidoMaterno` varchar(45) DEFAULT NULL,
  `empresa` varchar(45) DEFAULT NULL,
  `motivo` varchar(45) DEFAULT NULL,
  `detalle` text,
  PRIMARY KEY (`idreclamos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reclamos`
--

LOCK TABLES `reclamos` WRITE;
/*!40000 ALTER TABLE `reclamos` DISABLE KEYS */;
/*!40000 ALTER TABLE `reclamos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rubro`
--

DROP TABLE IF EXISTS `rubro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rubro` (
  `idrubro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrubro`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rubro`
--

LOCK TABLES `rubro` WRITE;
/*!40000 ALTER TABLE `rubro` DISABLE KEYS */;
INSERT INTO `rubro` VALUES (1,'Auto Plaza','autoplaza.jpg'),(2,'Computación y Electrónica','computacion.jpg'),(3,'Deporte','deporte.jpg'),(4,'Entretención y Cultura','entretencion.jpg'),(5,'Hogar y Regalos','hogar.jpg'),(6,'Hombre','hombre.jpg'),(7,'Joyería y Relojerías','joyeria.jpg'),(8,'Jugueterías','jugueteria.jpg'),(9,'Las Terrazas','terrazas.jpg'),(10,'Mujer','mujer.jpg'),(11,'Música, Fotografía y Librerías','musica.jpg'),(12,'Niños','ninos.jpg'),(13,'Ópticas, Perfumerías y Farmacias','optica.jpg'),(14,'Peluquería y Belleza','peluqueria.jpg'),(15,'Restauranes, Cafeterías y Heladerías','restauranes.jpg'),(16,'Servicios','servicios.jpg'),(17,'Tiendas Departamentales','departamentales.jpg'),(18,'Bancos','bancos.jpg'),(19,'Bancos y Casas de Cambio','bancos.jpg'),(20,'Pago de Cuentas','pago.jpg'),(21,'Servicios Públicos','serviciospublicos.jpg'),(22,'Servicios para el Hogar','servicioshogar.jpg'),(23,'Salud y Belleza','saludybelleza.jpg'),(24,'Pasajes, Giros y Encomiendas','pasajes.jpg'),(25,'Educación','educacion.jpg'),(26,'Patio de Comidas','food.jpg'),(27,'Tiendas Menores','tiendasmenores.jpg');
/*!40000 ALTER TABLE `rubro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategoria` (
  `idSubCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombreSubCategoria` varchar(100) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSubCategoria`),
  KEY `fk_subCategoria_categoria` (`idCategoria`),
  CONSTRAINT `fk_subCategoria_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategoria`
--

LOCK TABLES `subcategoria` WRITE;
/*!40000 ALTER TABLE `subcategoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submotivo`
--

DROP TABLE IF EXISTS `submotivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submotivo` (
  `idSubMotivo` int(11) NOT NULL AUTO_INCREMENT,
  `nombreSubMotivo` varchar(100) DEFAULT NULL,
  `idMotivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSubMotivo`),
  KEY `fk_subMotivo_motivo` (`idMotivo`),
  CONSTRAINT `fk_subMotivo_motivo` FOREIGN KEY (`idMotivo`) REFERENCES `motivo` (`idMotivo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submotivo`
--

LOCK TABLES `submotivo` WRITE;
/*!40000 ALTER TABLE `submotivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `submotivo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tienda`
--

DROP TABLE IF EXISTS `tienda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tienda` (
  `idtienda` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  `estBusqueda` int(11) DEFAULT '0' COMMENT 'Guarda cuantas veces se busco la tienda',
  PRIMARY KEY (`idtienda`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tienda`
--

LOCK TABLES `tienda` WRITE;
/*!40000 ALTER TABLE `tienda` DISABLE KEYS */;
INSERT INTO `tienda` VALUES (1,'LAN','lanchile.jpg',0),(2,'Banco Credichile','credichile.jpg',2),(3,'Farmacias Cruz Verde','cruzverde.jpg',0),(4,'Banco Falabella','bancofalabella.jpg',0),(5,'Ripley','ripley.jpg',0),(6,'Falabella','falabella.jpg',0),(7,'La Polar','lapolar.jpg',0),(8,'Doce Treinta y Cuatro','1234.jpg',0),(9,'Cannon','cannon.jpg',0),(10,'Monarch','monarch.jpg',0),(11,'Saxoline','saxoline.jpg',0),(12,'Belsport','belsport.jpg',0),(13,'Kayser','kayser.jpg',0),(14,'Block','block.jpg',0),(15,'Vacancy','null.jpg',0),(16,'Todo Piel','todopiel.jpg',0),(17,'Ferracini','ferracini.jpg',0),(18,'Gotta','gotta.jpg',0),(19,'Bata','bata.jpg',0),(20,'De Togni','detong.jpg',0),(21,'Pre-Unic','preunic.jpg',0),(22,'Vacancy','null.jpg',0),(23,'Limonada','limonada.jpg',0),(24,'Funsport','funsport.jpg',0),(25,'Caffarena','caffarena.jpg',0),(26,'Gema','gema.jpg',0),(27,'Capellini','capellini.jpg',0),(28,'Pillin','pillin.jpg',0),(29,'JJO','jjo.jpg',0),(30,'Vacancy','null.jpg',0),(31,'Vacancy','null.jpg',0),(32,'Ripley','ripley.jpg',0),(33,'Falabella','falabella.jpg',0),(34,'La Polar','lapolar.jpg',0),(35,'Johnson`s','johnson`s.jpg',0),(36,'Vacancy','null.jpg',0),(37,'Vacancy','null.jpg',0),(38,'Joyeria Baron','joyeriabaron.jpg',0),(39,'Ficcus','ficcus.jpg',0),(40,'Bottero','bottero.jpg',0),(41,'Monix','monix.jpg',2),(42,'Abismo','abismo.jpg',0),(43,'Baby Infanti','babyinfanti.jpg',2),(44,'Buble Gummers','bublegummers.jpg',0),(45,'Bruno Rossi','brunorossi.jpg',0),(46,'Doit','doit.jpg',0),(47,'Opticas GMO','gmo.jpg',0),(48,'Ansonia','ansonia.jpg',0),(49,'D- House','d-house.jpg',0),(50,'Azaleia','azaleia.jpg',0),(51,'Yogen Fruz','yogenfruz.jpg',0),(52,'Foster','foster.jpg',0),(53,'Vacancy','null.jpg',0),(54,'Guante','guante.jpg',0),(55,'Gacel','gacel.jpg',0),(56,'Boumex','boumex.jpg',0),(57,'Vacancy','null.jpg',0),(58,'Vacancy','null.jpg',0),(59,'Todo Moda','todomoda.jpg',0),(60,'Intime','intime.jpg',0),(61,'Baby Center','babycenter.jpg',0),(62,'Colloky','colloky.jpg',0),(63,'Disworld','disworld.jpg',0),(64,'Bresler','bresler.jpg',0),(65,'Vacancy','vacancy7.jpg',0),(66,'Ripley','ripley.jpg',0),(67,'Falabella','falabella.jpg',0),(68,'La Polar','lapolar.jpg',0),(69,'Johnson`s','johnson`s.jpg',0),(70,'Vacancy','vacancy8.jpg',0),(71,'Vacancy','vacancy9.jpg',0),(72,'Vacancy','vacancy10.jpg',0),(73,'Vacancy','vacancy11.jpg',0),(74,'Vacancy','vacancy12.jpg',0),(75,'Battery Street','batterystreet.jpg',0),(76,'Pimp`s','pimp`s.jpg',0),(77,'Adrenalin','adrenalin.jpg',0),(78,'Head','head.jpg',0),(79,'Patuelli','patuelli.jpg',0),(80,'Puma','puma.jpg',0),(81,'Adidas','adidas.jpg',0),(82,'Pc Factory','pcfactory.jpg',0),(83,'Dunkin Donuts','dunkindonuts.jpg',0),(84,'Vacancy','null.jpg',0),(85,'100% Futbol','100%futbol.jpg',4),(86,'Vacancy','null.jpg',0),(87,'Vacancy','null.jpg',0),(88,'Inside','inside.jpg',0),(89,'Umbro','umbro.jpg',0),(90,'Rip Curl','ripcurl.jpg',0),(91,'Maui & Sons','maui.jpg',0),(92,'Vacancy','null.jpg',0),(93,'HP','hp.jpg',0),(94,'Savory','savory.jpg',0),(95,'CineMundo','cines.jpg',0),(96,'Happyland','happyland.jpg',0),(97,'Buffet Express','buffet.jpg',0),(98,'Telepizza','telepizza.jpg',0),(99,'Tarragona','pollostarragona.jpg',0),(100,'Vacancy','null.jpg',0),(101,'Pedro Juan & Diego','pedrojuanydiego.jpg',0),(102,'Troglodita','troglodita.jpg',0),(103,'Fruto´s','frutos.jpg',0),(104,'Juan Maestro','juanmaestro.jpg',0),(105,'Vacancy','null.jpg',0),(106,'China Wok','chinawok.jpg',0),(107,'Kentucky Fried Chicken','kfc.jpg',0),(108,'Vacancy','null.jpg',0),(109,'Shop Dog','shopdog.jpg',0),(110,'Vacancy','null.jpg',0),(111,'Vacancy','null.jpg',0),(112,'Vacancy','null.jpg',0),(113,'Corporación Cultural Estación Central','universidaddesantiago.jpg',0),(114,'Johnson`s','johnson`s.jpg',0),(115,'Vacancy','null.jpg',0),(116,'Banco de Chile','bancochile.jpg',0),(117,'Yogen Fruz','yogenfruz.jpg',0),(118,'Biblioteca Viva','bibliotecaviva.jpg',0),(119,'Domino','domino.jpg',0),(120,'Bariloche','bariloche.jpg',0),(121,'Doggis','doggis.jpg',0),(122,'Burger King','burgerking.jpg',0),(123,'Buffalo Beef','buffalobeef.jpg',0),(124,'Savory','savory.jpg',0),(125,'Fritz','fritz.jpg',0),(126,'Toyota','toyota.jpg',0),(127,'Hyundai','hyundai.jpg',0),(128,'Vacancy','null.jpg',0),(129,'CMR Automotriz','cmr.jpg',0),(130,'Chery','chery.jpg',0),(131,'Vacancy','null.jpg',0),(132,'KIA','kia.jpg',0),(133,'BCI Autos','bci.jpg',0),(134,'Chevrolet','chevrolet.jpg',0),(135,'Ford Center','fordcenter.jpg',0),(136,'Farmacias Cruz Verde','cruzverde.jpg',0),(137,'Vacancy','null.jpg',0),(138,'Vacancy','null.jpg',0),(139,'Vacancy','null.jpg',0),(140,'Servipag','servipag.jpg',0),(142,'Vacancy','null.jpg',0),(144,'Afex','afex.jpg',0),(145,'Nextel','nextel.jpg',0),(146,'Tobacco Store','tobacco.jpg',0),(147,'La Kabina','lakabina.jpg',0),(148,'Golden Chile','goldenchile.jpg',0),(149,'Vacancy','null.jpg',0),(150,'Araucana','araucana.jpg',0),(151,'Farmacias Salcobrand','salcobrand.jpg',0),(152,'Bob`s','bob`s.jpg',0),(153,'Vacancy','null.jpg',0),(154,'Vacancy','null.jpg',0),(155,'La Araucana','araucana.jpg',0),(157,'Trowell','tronwell.jpg',0),(158,'Opticas Rotter & Krauss','rotter&krauss.jpg',0),(159,'Lisos & Rizos','lisos&rizos.jpg',0),(160,'Vacancy','null.jpg',0),(161,'Vacancy','null.jpg',0),(162,'Vacancy','null.jpg',0),(163,'Vacancy','null.jpg',0),(165,'Claro','claro.jpg',0),(169,'Vacancy','null.jpg',0),(170,'Dunkin Donut\'s','donnuts.jpg',0),(171,'Doggis','doggis.jpg',0),(172,'Bravissimo','bravissimo.jpg',0),(174,'Opticas Schilling','op.shilling.jpg',0),(175,'Konica','konica.jpg',0),(176,'Vacancy','null.jpg',0),(177,'Banco BCI','bci.jpg',19),(178,'Integramédica','integramedica.jpg',0),(179,'Alegretto','alegretto.jpg',0),(180,'Mc Donald\'s','mcdonalds.jpg',0);
/*!40000 ALTER TABLE `tienda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `totem`
--

DROP TABLE IF EXISTS `totem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `totem` (
  `idtotem` int(11) NOT NULL AUTO_INCREMENT,
  `idnodo` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `orientacion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtotem`),
  KEY `fk_totem_1` (`idnodo`),
  CONSTRAINT `fk_totem_1` FOREIGN KEY (`idnodo`) REFERENCES `nodos` (`idnodo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `totem`
--

LOCK TABLES `totem` WRITE;
/*!40000 ALTER TABLE `totem` DISABLE KEYS */;
INSERT INTO `totem` VALUES (1,219,'T1','N');
/*!40000 ALTER TABLE `totem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nomComUsuario` varchar(45) DEFAULT NULL,
  `nomUsuario` varchar(30) DEFAULT NULL,
  `mailUsuario` varchar(60) DEFAULT NULL,
  `passUsuario` varchar(100) DEFAULT NULL,
  `privilegioUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidoPaterno` varchar(45) DEFAULT NULL,
  `apellidoMaterno` varchar(45) DEFAULT NULL,
  `jerarquia` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-04 11:47:26
