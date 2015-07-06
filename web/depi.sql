CREATE DATABASE  IF NOT EXISTS `posgrado` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `posgrado`;
-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: posgrado
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.12.04.1

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
-- Table structure for table `CuerpoAcademico`
--

DROP TABLE IF EXISTS `CuerpoAcademico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CuerpoAcademico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CuerpoAcademico`
--

LOCK TABLES `CuerpoAcademico` WRITE;
/*!40000 ALTER TABLE `CuerpoAcademico` DISABLE KEYS */;
INSERT INTO `CuerpoAcademico` VALUES (1,'Cuerpo Académico Informática Industrial(CAII)','http://caii.itmexicali.edu.mx/');
/*!40000 ALTER TABLE `CuerpoAcademico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Docente`
--

DROP TABLE IF EXISTS `Docente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Docente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `apellidoP` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidoM` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `areaInteres` longtext COLLATE utf8_unicode_ci,
  `enlacePagina` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Docente`
--

LOCK TABLES `Docente` WRITE;
/*!40000 ALTER TABLE `Docente` DISABLE KEYS */;
INSERT INTO `Docente` VALUES (1,'Arnoldo','Díaz-Ramírez',NULL,'adiaz@itmexicali.edu.mx','Dr. en Ciencias de la Computación','Sistemas de tiempo real, sistemas ciber-físicos, redes de sensores inalámbricas, computación ubicua y sistemas eHealth','http://faculty.itmexicali.edu.mx/adiaz','Arnoldo.jpg'),(2,'Pedro','Mayorga','Ortiz','pmogauss@gmail.com','Dr. en Señales Imágenes Voz y Telecomunicaciones','Procesamiento Digital de Señales y Reconocimiento de Patrones, particularmente Voz y Bioacústica',NULL,'mayorga.jpg'),(3,'Fidel','Díaz','Muñoz','fdiaz701@hotmail.com','Dr. Ingeneria Electrica','Instrumentación y control',NULL,NULL),(4,'Verónica','Quintero','Rosas','veroquintero@yandex.ru','MC. de la Ingeniería, MI. Electrónica','Computación Ubicua',NULL,'vero.jpg'),(5,'Juan Francisco','Ibáñez','Salas','pacois20@gmail.com','Lic. en Informática, MC. en enseñanza de las ciencias','Sistemas distribuidos y Computación ubicua',NULL,'pacois.png'),(6,'Heber Samuel','Hernández','Tabares','heberhdz@hotmail.com','MC. en Tecnologías de Redes','Computación ubicua',NULL,NULL);
/*!40000 ALTER TABLE `Docente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Alumno`
--

DROP TABLE IF EXISTS `Alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `apellidoP` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidoM` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `generacion` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `areaInteres` longtext COLLATE utf8_unicode_ci,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Alumno`
--

LOCK TABLES `Alumno` WRITE;
/*!40000 ALTER TABLE `Alumno` DISABLE KEYS */;
INSERT INTO `Alumno` VALUES (1,'Daniela','Ibarra','González','danifler@hotmail.com','Ingeniera en Electrónica','2008-2012','Procesamiento Digital de Señales','daniela.jpg'),(2,'Julio Alejandro','Valdez','González','julito_valdez@hotmail.com','Ingeniero en electrónica','2009-2013','Procesamiento Digital de Señales','julio.jpg'),(3,'Edgar Alberto','Dominguez','Araiza',NULL,'Ingeniero en electrónica',NULL,'Computación ubicua y redes de sensores inalámbricas','edgar.jpg');
/*!40000 ALTER TABLE `Alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Convocatoria`
--

DROP TABLE IF EXISTS `Convocatoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Convocatoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Convocatoria`
--

LOCK TABLES `Convocatoria` WRITE;
/*!40000 ALTER TABLE `Convocatoria` DISABLE KEYS */;
INSERT INTO `Convocatoria` VALUES (1,'Convocatoria Ingreso MIE 2015','Convocatoria_Ingreso_MIE_2015.pdf');
/*!40000 ALTER TABLE `Convocatoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
INSERT INTO `Usuario` VALUES (1,'admin','sJdA+AG+dj2G89/0TiXg/horaU07uneD5mwdm89AFa+XafxrgpjULG31eotzw6vcgDkq2d8AeRciFqlRsw3mjQ==','48a3eca68fd451cd8628c000abe4f0e6'),(2,'administrador','819EIvN8vkrTn1xHTpeZ/3TtQOPrElyttx7HLXM8mbtRux94cUzPEgUmPMsuWhow1Vq2cO/iqLHQHx/NjtPC8Q==','f08f300173318d0cea8da3ac8950cbb4');
/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-05 14:38:53
