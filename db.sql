-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour ecommercevehicules


DROP DATABASE IF EXISTS `ventes_vehicules`;


CREATE DATABASE IF NOT EXISTS `ventes_vehicules` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ventes_vehicules`;

-- Listage de la structure de table ecommercevehicules. admin
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `createAt` datetime NOT NULL,
  `updateAt` datetime DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ecommercevehicules.admin : ~0 rows (environ)

-- Listage de la structure de table ecommercevehicules. banques
CREATE TABLE IF NOT EXISTS `banques` (
  `banque_id` VARCHAR(100) NOT NULL,
  `solde` double NOT NULL DEFAULT '1000000',
  `numberAccount` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `utilisateurid` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`banque_id`),
  UNIQUE KEY `banque_id` (`banque_id`),
  UNIQUE KEY `numberAccount` (`numberAccount`),
  KEY `utilisateurid` (`utilisateurid`),
  CONSTRAINT `FK_banques_utilisateurs` FOREIGN KEY (`utilisateurid`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ecommercevehicules.banques : ~3 rows (environ)

-- Listage de la structure de table ecommercevehicules. marques
CREATE TABLE IF NOT EXISTS `marques` (
  `marque_id` VARCHAR(100) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`marque_id`),
  UNIQUE KEY `marque` (`marque`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- Listage de la structure de table ecommercevehicules. notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `notif_id` VARCHAR(100) NOT NULL ,
  `utilisateurid` VARCHAR(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `eye` tinyint NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`notif_id`) USING BTREE,
  KEY `utilisateurid` (`utilisateurid`),
  CONSTRAINT `FK_notifications_utilisateurs` FOREIGN KEY (`utilisateurid`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ecommercevehicules.notifications : ~0 rows (environ)

-- Listage de la structure de table ecommercevehicules. paniers
CREATE TABLE IF NOT EXISTS `paniers` (
  `panier_id` VARCHAR(100) NOT NULL,
  `vehiculeid` VARCHAR(100) NOT NULL,
  `utilisateurid` VARCHAR(100) NOT NULL,
  `quantite` int NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`panier_id`),
  KEY `vehiculeid` (`vehiculeid`),
  KEY `utilisateurid` (`utilisateurid`),
  CONSTRAINT `paniers_ibfk_1` FOREIGN KEY (`vehiculeid`) REFERENCES `vehicules` (`vehicule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paniers_ibfk_2` FOREIGN KEY (`utilisateurid`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ecommercevehicules.paniers : ~0 rows (environ)

-- Listage de la structure de table ecommercevehicules. parametres
CREATE TABLE IF NOT EXISTS `parametres` (
  `param_id` VARCHAR(100)  NOT NULL,
  `carburant` varchar(50) NOT NULL DEFAULT 'essence',
  `kilometrage` varchar(50) NOT NULL DEFAULT '0kh',
  `auto` tinyint(1) NOT NULL DEFAULT '1',
  `vehiculeid` VARCHAR(100)  NOT NULL,
  PRIMARY KEY (`param_id`),
  UNIQUE KEY `vehiculeid` (`vehiculeid`),
  CONSTRAINT `parametres_ibfk_1` FOREIGN KEY (`vehiculeid`) REFERENCES `vehicules` (`vehicule_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ecommercevehicules.parametres : ~0 rows (environ)

-- Listage de la structure de table ecommercevehicules. stocks
CREATE TABLE IF NOT EXISTS `stocks` (
  `stock_id` VARCHAR(100)  NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `vehiculeid` VARCHAR(100)  NOT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `vehiculeid` (`vehiculeid`),
  CONSTRAINT `stock` FOREIGN KEY (`vehiculeid`) REFERENCES `vehicules` (`vehicule_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ecommercevehicules.stocks : ~0 rows (environ)

-- Listage de la structure de table ecommercevehicules. taux
CREATE TABLE IF NOT EXISTS `taux` (
  `taux_id` VARCHAR(100)  NOT NULL,
  `franc` varchar(255) NOT NULL,
  `dollard` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`taux_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ecommercevehicules.taux : ~1 rows (environ)
INSERT INTO `taux` (`taux_id`, `franc`, `dollard`) VALUES
	(1, '2150', 1);

-- Listage de la structure de table ecommercevehicules. types
CREATE TABLE IF NOT EXISTS `types` (
  `type_id` VARCHAR(100)  NOT NULL,
  `type` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ecommercevehicules.types : ~6 rows (environ)
INSERT INTO `types` (`type_id`, `type`, `create_at`) VALUES
	(12, 'sport', '2023-01-17 22:38:46'),
	(13, 'luxe', '2023-01-17 22:38:54'),
	(14, 'course', '2023-01-17 22:39:02'),
	(15, 'mariage', '2023-01-17 22:39:12'),
	(16, 'loisirs', '2023-01-17 22:39:21'),
	(17, 'présidentielles', '2023-01-17 22:39:35');

-- Listage de la structure de table ecommercevehicules. utilisateurs
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `utilisateur_id` VARCHAR(100)  NOT NULL,
  `nom` varchar(255) NOT NULL,
  `utilisateur` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `isconfirm` tinyint NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `confirm_at` datetime DEFAULT NULL,
  `expirate` datetime DEFAULT NULL,
  PRIMARY KEY (`utilisateur_id`),
  UNIQUE KEY `utilisateur` (`utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ecommercevehicules.utilisateurs : ~3 rows (environ)
INSERT INTO `utilisateurs` (`utilisateur_id`, `nom`, `utilisateur`, `prenom`, `email`, `token`, `code`, `password`, `isconfirm`, `create_at`, `update_at`, `confirm_at`, `expirate`) VALUES
	(20, 'labeyade', 'labeyadev', 'laurent', 'labeyadev@gmail.com', NULL, NULL, '$2y$10$MLaYWC4ieLvdbyGxsOjDE.Fd7LmeQxXc7M6q.AP7voEcHIl8QfwOS', 1, '2023-01-16 17:28:29', '2023-01-17 16:42:49', '2023-01-16 17:28:50', NULL),
	(21, 'masikoti', 'jeremia', 'labeya', 'jeremia@j.com', NULL, NULL, '$2y$10$AHp7iy7BH.0Z5VXYjNGwE.WG7Pd5Osa5Rrq0yKZNYd3zVoCGG00l.', 1, '2023-01-16 19:18:29', '2023-01-18 14:54:39', '2023-01-16 19:18:37', NULL),
	(22, 'labeya', 'labeya', 'labeya', 'jeremia@j.comlabeya', NULL, NULL, '$2y$10$1kSf5ytckEIh00yISlSWkuqJ9tL1MQbZg2x7ziqAf5ijasAozZdle', 1, '2023-01-18 15:23:07', NULL, '2023-01-18 15:23:28', NULL);

-- Listage de la structure de table ecommercevehicules. vehicules
CREATE TABLE IF NOT EXISTS `vehicules` (
  `vehicule_id` VARCHAR(100)  NOT NULL,
  `vehicule` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `promo` tinyint NOT NULL DEFAULT '1',
  `star` int NOT NULL DEFAULT '3',
  `typeid` VARCHAR(100) DEFAULT NULL,
  `marqueid` VARCHAR(100) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`vehicule_id`),
  UNIQUE KEY `vehicule` (`vehicule`),
  KEY `marqueid` (`marqueid`),
  KEY `typeid` (`typeid`),
  CONSTRAINT `vehicules_ibfk_1` FOREIGN KEY (`marqueid`) REFERENCES `marques` (`marque_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vehicules_ibfk_2` FOREIGN KEY (`typeid`) REFERENCES `types` (`type_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ecommercevehicules.vehicules : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
