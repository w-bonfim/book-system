-- MySQL dump 10.13  Distrib 8.0.13, for Win64 (x86_64)
--
-- Host: localhost    Database: sectotech_challenge
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `playlist_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `url` varchar(255) NOT NULL,
  `author` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `playlist_id` (`playlist_id`),
  CONSTRAINT `contents_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents`
--

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
INSERT INTO `contents` VALUES (1,1,'Como serão os Empregos','https://www.youtube.com/watch?v=L_w6K4MXH1E','Altabooks','2022-09-12 11:44:20','2022-09-12 11:44:20'),(2,2,'Resumo do livro O Poder dos Quietos ','https://lucasconchetto.com/o-poder-dos-quietos-susan-cain/','Lucas conchetto','2022-09-12 11:46:58','2022-09-12 11:46:58'),(3,3,'Quatro coisas que você vai aprender com o livro \"Use a cabeça - PHP & MySQL\"','https://www.youtube.com/watch?v=Gk9OX7GCE3M','Edigleysson Silva','2022-09-12 11:50:23','2022-09-12 11:50:23'),(4,4,'Gestores em risco?','https://www.jmais.com.br/quarta-revolucao-industrial-gestores-em-risco/','Edenir Rocha','2022-09-12 11:51:43','2022-09-12 11:51:43'),(5,5,'O você precisa saber sobre os cursos','https://blog.wyden.com.br/conteudo-gratuito/bate-papo-sobre-t-i-o-voce-precisa-saber-sobre-os-cursos/','Wyden','2022-09-12 11:54:39','2022-09-12 11:54:39'),(6,6,'ENGENHARIA DE SOFTWARE RECEBE NOTA MÁXIMA DO MEC','https://www.puc-campinas.edu.br/engenharia-de-software-recebe-nota-maxima-do-mec/','Carlos Giacomeli','2022-09-12 11:56:29','2022-09-12 11:56:56'),(7,7,'6 livros de gestão de TI OBRIGATÓRIOS para um bom gestor','https://encontreumnerd.com.br/blog/livros-gestao-ti','DANIEL TUTIDA','2022-09-12 11:59:08','2022-09-12 11:59:08'),(8,8,'O que é liderança?','https://www.youtube.com/watch?v=g86UXmyp9yc','Gilberto de Souza','2022-09-12 12:04:07','2022-09-12 12:04:07'),(9,9,'O que é Big Data?','https://www.oracle.com/br/big-data/what-is-big-data/','Equipe oracle','2022-09-12 12:07:40','2022-09-12 12:07:57'),(10,10,'O que é guerra cibernética?','https://www.techtudo.com.br/noticias/2022/03/o-que-e-guerra-cibernetica-entenda-como-funcionam-os-ataques-virtuais.ghtml','Filipe Garrett','2022-09-12 12:08:57','2022-09-12 12:08:57'),(11,11,'Saiba mais sobre verdadeiro valor de TI','https://www.mbooks.com.br/cgi-bin/e-commerce/busca_e-commerce.cgi?lvcfg=mbooks&action=saibamais&codigo=801047','RICHARD HUNTER','2022-09-12 12:12:06','2022-09-12 12:12:06'),(12,12,'Resumo do poder das multidões','https://www.thiengo.com.br/o-poder-das-multidoes','Vinícius Thiengo','2022-09-12 12:13:47','2022-09-12 12:13:47');
/*!40000 ALTER TABLE `contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlists`
--

DROP TABLE IF EXISTS `playlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `playlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `author` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlists`
--

LOCK TABLES `playlists` WRITE;
/*!40000 ALTER TABLE `playlists` DISABLE KEYS */;
INSERT INTO `playlists` VALUES (1,'A Segunda Era das Máquinas','Neste livro seus autores defendem que estamos vivendo uma grande virada onde várias tecnologias diferentes estão sendo aprimoradas de forma exponencial e se tornando realidade rapidamente.','Erik Brynjolfsson e Andrew Mcafee.','2022-09-12 11:25:31','2022-09-12 12:15:29'),(2,'O Poder dos Quietos','Este é um best-seller mundial que já vendeu mais de 3 milhões de exemplares em todo o mundo e passou quatro anos na lista dos mais vendidos do The New York Times.','Susan Cain','2022-09-12 11:26:36','2022-09-12 11:27:42'),(3,'Use a cabeça! Programação','Este livro que faz parte da série literária: Use a Cabeça! é uma introdução aos conceitos básicos da programação. ','Paul Barry e David Griffiths','2022-09-12 11:28:39','2022-09-12 11:28:39'),(4,'A Quarta Revolução Industrial','Neste livro o professor alemão Klaus Schwab, fundador do Fórum Econômico Mundial, fala sobre a chamada Indústria 4.0. ','Klaus Schwab','2022-09-12 11:29:19','2022-09-12 11:29:19'),(5,'Um Bate-papo sobre T.I.','Neste livro Ernesto Mario Haberkorn, um dos maiores especialistas em ERP (Enterprise Resource Planning) do Brasil, procura responder para novatos na área de TI','Ernesto Mario Haberkorn','2022-09-12 11:30:38','2022-09-12 11:30:38'),(6,'Engenharia de Software','Roger Pressman é uma lenda viva quando o assunto é Engenharia de Software.','Roger S. Pressman','2022-09-12 11:32:19','2022-09-12 11:32:19'),(7,'O Verdadeiro Valor de TI','Baseado em um estudo realizado pelo Massachusetts Institute of Technology (MIT) e pelo instituto Gartner, o livro “O Verdadeiro Valor de TI” é uma obra que possui a difícil missão de transformar.','Richard Hunter e George Westerman','2022-09-12 11:32:56','2022-09-12 11:34:01'),(8,'Os 11 Segredos de Líderes de TI Altamente Influentes','Essa obra ainda traz aqueles que são considerados os 11 segredos dos maiores e mais influentes líderes de TI da atualidade. ','Marc J. Schiller','2022-09-12 11:35:38','2022-09-12 11:35:38'),(9,'Big Data','Imenso volume de dados, essa é a definição geral de Big Data, tema do livro.','Viktor Mayer-Schönberger e Kenneth Cukier','2022-09-12 11:37:07','2022-09-12 11:37:07'),(10,'Guerra Cibernética','O livro Guerra Cibernética traz uma análise contemporânea sobre como as armas cibernéticas podem afetar a segurança nacional. ','Richard A. Clarke e Robert K. Knake','2022-09-12 11:38:34','2022-09-12 11:38:34'),(11,'O verdadeiro valor de TI','Quem almeja cargos de liderança, deve ver esse título como leitura obrigatória.','Richard Hunter do Gartner e George Westerman','2022-09-12 11:39:13','2022-09-12 11:39:13'),(12,'O poder das multidões','Você já ouviu falar em “Crowdsourcing”? Identificado pelo jornalista e autor do livro, Jeff Howe, o termo descreve como funções, antes limitadas à especialistas.','Jeff Howe','2022-09-12 11:41:11','2022-09-12 11:41:11');
/*!40000 ALTER TABLE `playlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-12  9:30:20
