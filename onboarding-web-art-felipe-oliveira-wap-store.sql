-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.23-0ubuntu0.20.04.1 - (Ubuntu)
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para onboarding
CREATE DATABASE IF NOT EXISTS `onboarding` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `onboarding`;

-- Copiando estrutura para tabela onboarding.wappers
CREATE TABLE IF NOT EXISTS `wappers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `birth` date NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela onboarding.wappers: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `wappers` DISABLE KEYS */;
INSERT INTO `wappers` (`id`, `photo`, `name`, `birth`, `city`, `state`, `profession`, `email`, `phone`, `created_at`, `updated_at`) VALUES
	(17, 'upload-12-03-2021-08h50m02s-timestamp-1615549802.png', 'Andressa Silva', '1996-02-19', 'São Paulo', 'São Paulo', 'Designer', 'andressa.silva@gmail.com', '5563214587', '2021-03-12 08:50:02', NULL),
	(18, 'upload-12-03-2021-08h51m22s-timestamp-1615549882.jpg', 'Carlos Andrade', '1992-06-12', 'Salvador', 'Bahia', 'Técnico em Mecânica Automotiva', 'carlos71@gmail.com', '3658745896', '2021-03-12 08:51:22', NULL),
	(19, 'upload-12-03-2021-08h52m12s-timestamp-1615549932.jpg', 'Anna Coutinho', '2000-04-12', 'Macapá', 'Amapá', 'Estudante', 'anna.coutinho@live.com', '96958741256', '2021-03-12 08:52:12', NULL);
/*!40000 ALTER TABLE `wappers` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
