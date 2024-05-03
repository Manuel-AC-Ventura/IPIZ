-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: IPIZ
-- ------------------------------------------------------
-- Server version	10.11.6-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alunos`
--

DROP TABLE IF EXISTS `alunos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alunos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `numBI` varchar(100) NOT NULL,
  `naturalidade` varchar(100) NOT NULL,
  `nomePai` varchar(100) NOT NULL,
  `nomeMae` varchar(100) NOT NULL,
  `morada` varchar(100) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `outroContacto` varchar(100) DEFAULT NULL,
  `dataNascimento` date NOT NULL,
  `genero` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alunos`
--

/*!40000 ALTER TABLE `alunos` DISABLE KEYS */;
INSERT INTO `alunos` VALUES
(1,'João','Silva','12345678','Porto','Manuel Silva','Ana Silva','Rua Principal, 123','912345678',NULL,'2005-05-15','Masculino'),
(2,'Ana','Sousa','87654321','Lisboa','José Sousa','Maria Sousa','Avenida Central, 456','923456789',NULL,'2006-08-20','Feminino'),
(3,'Carlos','Oliveira','56789012','Faro','António Oliveira','Isabel Oliveira','Travessa da Paz, 789','934567890',NULL,'2004-12-10','Masculino'),
(4,'Marta','Fernandes','90123456','Braga','Rui Fernandes','Sofia Fernandes','Rua da Esperança, 1011','945678901',NULL,'2003-10-25','Feminino'),
(5,'Pedro','Ribeiro','34567890','Coimbra','Luís Ribeiro','Carla Ribeiro','Avenida da Liberdade, 1213','956789012',NULL,'2007-03-18','Masculino');
/*!40000 ALTER TABLE `alunos` ENABLE KEYS */;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `numBI` varchar(100) NOT NULL,
  `naturalidade` varchar(100) NOT NULL,
  `morada` varchar(100) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `especialidade` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(500) NOT NULL DEFAULT '12345678',
  `ativo` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES
(1,'Ana','Ferreira','23456789','Braga','Rua das Flores, 234','912345678','Diretor','Administração Escolar','ana@ipiz.pt','12345678',1),
(2,'Miguel','Santos','45678901','Porto','Avenida Central, 345','923456789','Professor','Matemática','miguel@ipiz.pt','12345678',1),
(3,'Sofia','Costa','67890123','Lisboa','Rua dos Alunos, 456','934567890','Secretaria','Atendimento ao Público','sofia@ipiz.pt','12345678',1),
(4,'Rui','Silva','89012345','Faro','Praça da República, 678','945678901','Professor','Português','rui@ipiz.pt','12345678',1),
(5,'Manuel','Martins','01234567','Coimbra','Avenida dos Estudantes, 890','956789012','Professor','Ciências','manuel@ipiz.pt','12345678',1);
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;

--
-- Table structure for table `matriculas`
--

DROP TABLE IF EXISTS `matriculas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matriculas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idAluno` int(11) NOT NULL,
  `anoEscolar` varchar(100) NOT NULL,
  `curso` varchar(100) NOT NULL,
  `turno` varchar(100) NOT NULL,
  `dataMatricula` date DEFAULT curdate(),
  PRIMARY KEY (`id`),
  KEY `idAluno` (`idAluno`),
  CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`idAluno`) REFERENCES `alunos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matriculas`
--

/*!40000 ALTER TABLE `matriculas` DISABLE KEYS */;
INSERT INTO `matriculas` VALUES
(1,1,'2023/2024','Ciências','Manhã','2023-09-01'),
(2,2,'2023/2024','Artes','Tarde','2023-09-02'),
(3,3,'2023/2024','Desporto','Manhã','2023-09-03'),
(4,4,'2023/2024','Letras','Tarde','2023-09-04'),
(5,5,'2023/2024','Ciências','Manhã','2023-09-05');
/*!40000 ALTER TABLE `matriculas` ENABLE KEYS */;

--
-- Table structure for table `papeis`
--

DROP TABLE IF EXISTS `papeis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `papeis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `papeis`
--

/*!40000 ALTER TABLE `papeis` DISABLE KEYS */;
/*!40000 ALTER TABLE `papeis` ENABLE KEYS */;

--
-- Table structure for table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_funcionario` int(11) NOT NULL,
  `id_papel` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_funcionario` (`id_funcionario`),
  KEY `id_papel` (`id_papel`),
  CONSTRAINT `permissoes_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionarios` (`id`),
  CONSTRAINT `permissoes_ibfk_2` FOREIGN KEY (`id_papel`) REFERENCES `papeis` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoes`
--

/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;

--
-- Dumping routines for database 'IPIZ'
--
