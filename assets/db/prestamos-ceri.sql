-- MySQL dump 10.16  Distrib 10.1.13-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: prestamos_ceri
-- ------------------------------------------------------
-- Server version	10.1.13-MariaDB

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
-- Current Database: `prestamos_ceri`
--

/*!40000 DROP DATABASE IF EXISTS `prestamos_ceri`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `prestamos_ceri` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `prestamos_ceri`;

--
-- Table structure for table `categoria_equipo`
--

DROP TABLE IF EXISTS `categoria_equipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categoria_servicio`
--

DROP TABLE IF EXISTS `categoria_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categoria_usuario`
--

DROP TABLE IF EXISTS `categoria_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `equipos`
--

DROP TABLE IF EXISTS `equipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_equipo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_categoria_equipo` int(11) DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `equipos_categoria_equipo_id_fk` (`id_categoria_equipo`),
  CONSTRAINT `equipos_categoria_equipo_id_fk` FOREIGN KEY (`id_categoria_equipo`) REFERENCES `categoria_equipo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `espacios`
--

DROP TABLE IF EXISTS `espacios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `espacios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_espacio` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `otro_espacio` tinyint(1) DEFAULT '0',
  `habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria_servicio` int(11) DEFAULT NULL,
  `nombre_servicio` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `servicios_categoria_servicio_id_fk` (`id_categoria_servicio`),
  CONSTRAINT `servicios_categoria_servicio_id_fk` FOREIGN KEY (`id_categoria_servicio`) REFERENCES `categoria_servicio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `solicitudes`
--

DROP TABLE IF EXISTS `solicitudes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_reservado` int(11) DEFAULT NULL,
  `id_recibido` int(11) DEFAULT NULL,
  `fecha_solicitud` date DEFAULT NULL,
  `fecha_uso` date DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL,
  `hora_devolucion` time DEFAULT NULL,
  `observaciones` text COLLATE utf8_spanish_ci,
  `id_solicitante` int(11) DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `solicitudes_usuarios_id_reservado_fk` (`id_reservado`),
  KEY `solicitudes_usuarios_id_recibido_fk` (`id_recibido`),
  KEY `solicitudes_usuarios_id_solicitado_fk` (`id_solicitante`),
  CONSTRAINT `solicitudes_usuarios_id_recibido_fk` FOREIGN KEY (`id_recibido`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `solicitudes_usuarios_id_reservado_fk` FOREIGN KEY (`id_reservado`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `solicitudes_usuarios_id_solicitado_fk` FOREIGN KEY (`id_solicitante`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `solicitudes_equipos`
--

DROP TABLE IF EXISTS `solicitudes_equipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitudes_equipos` (
  `id_solicitud` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  PRIMARY KEY (`id_solicitud`,`id_equipo`),
  KEY `solicitudes_equipos_equipos_id_fk` (`id_equipo`),
  CONSTRAINT `solicitudes_equipos_equipos_id_fk` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`),
  CONSTRAINT `solicitudes_equipos_solicitudes_id_fk` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitudes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `solicitudes_espacios_usos`
--

DROP TABLE IF EXISTS `solicitudes_espacios_usos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitudes_espacios_usos` (
  `id_solicitud` int(11) NOT NULL,
  `id_espacio` int(11) NOT NULL,
  `id_uso` int(11) NOT NULL,
  PRIMARY KEY (`id_solicitud`,`id_espacio`,`id_uso`),
  KEY `solicitudes_espacios_usos_espacios_id_fk` (`id_espacio`),
  KEY `solicitudes_espacios_usos_usos_id_fk` (`id_uso`),
  CONSTRAINT `solicitudes_espacios_usos_espacios_id_fk` FOREIGN KEY (`id_espacio`) REFERENCES `espacios` (`id`),
  CONSTRAINT `solicitudes_espacios_usos_solicitudes_id_fk` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitudes` (`id`),
  CONSTRAINT `solicitudes_espacios_usos_usos_id_fk` FOREIGN KEY (`id_uso`) REFERENCES `usos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `solicitudes_servicios`
--

DROP TABLE IF EXISTS `solicitudes_servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitudes_servicios` (
  `id_solicitud` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  PRIMARY KEY (`id_solicitud`,`id_servicio`),
  KEY `solicitudes_servicios_servicios_id_fk` (`id_servicio`),
  CONSTRAINT `solicitudes_servicios_servicios_id_fk` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id`),
  CONSTRAINT `solicitudes_servicios_solicitudes_id_fk` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitudes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usos`
--

DROP TABLE IF EXISTS `usos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uso` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `otro_uso` tinyint(1) DEFAULT '0',
  `habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `primer_nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `segundo_nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `primer_apellido` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `segundo_apellido` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cedula` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hashed_password` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_categoria_usuario` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo_institucional` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `administrador` tinyint(1) DEFAULT '0',
  `twitter` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `forgot_password_token` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_cedula_uindex` (`cedula`),
  UNIQUE KEY `usuarios_email_uindex` (`email`),
  UNIQUE KEY `usuarios_correo_institucional_uindex` (`correo_institucional`),
  UNIQUE KEY `usuarios_forgot_password_token_uindex` (`forgot_password_token`),
  KEY `usuarios_categoria_usuario_id_fk` (`id_categoria_usuario`),
  CONSTRAINT `usuarios_categoria_usuario_id_fk` FOREIGN KEY (`id_categoria_usuario`) REFERENCES `categoria_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-21 16:25:13
