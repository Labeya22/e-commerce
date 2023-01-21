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


-- Listage de la structure de la base pour ventes_vehicules
CREATE DATABASE IF NOT EXISTS `ventes_vehicules` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ventes_vehicules`;

-- Listage de la structure de table ventes_vehicules. banques
CREATE TABLE IF NOT EXISTS `banques` (
  `banque_id` varchar(100) NOT NULL,
  `solde` double NOT NULL DEFAULT '1000000',
  `numberAccount` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `utilisateurid` varchar(100) NOT NULL,
  PRIMARY KEY (`banque_id`),
  UNIQUE KEY `banque_id` (`banque_id`),
  UNIQUE KEY `numberAccount` (`numberAccount`),
  KEY `utilisateurid` (`utilisateurid`),
  CONSTRAINT `FK_banques_utilisateurs` FOREIGN KEY (`utilisateurid`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. factures
CREATE TABLE IF NOT EXISTS `factures` (
  `facture_id` varchar(100) NOT NULL,
  `total` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cart` json NOT NULL,
  `create_at` datetime NOT NULL,
  `utilisateurid` varchar(100) NOT NULL,
  KEY `utilisateurid` (`utilisateurid`),
  CONSTRAINT `FK_factures_utilisateurs` FOREIGN KEY (`utilisateurid`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. marques
CREATE TABLE IF NOT EXISTS `marques` (
  `marque_id` varchar(100) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`marque_id`),
  UNIQUE KEY `marque` (`marque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `notif_id` varchar(100) NOT NULL,
  `utilisateurid` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `eye` tinyint NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`notif_id`) USING BTREE,
  KEY `utilisateurid` (`utilisateurid`),
  CONSTRAINT `FK_notifications_utilisateurs` FOREIGN KEY (`utilisateurid`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. paniers
CREATE TABLE IF NOT EXISTS `paniers` (
  `panier_id` varchar(100) NOT NULL,
  `vehiculeid` varchar(100) NOT NULL,
  `utilisateurid` varchar(100) NOT NULL,
  `quantite` int NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`panier_id`),
  KEY `vehiculeid` (`vehiculeid`),
  KEY `utilisateurid` (`utilisateurid`),
  CONSTRAINT `paniers_ibfk_1` FOREIGN KEY (`vehiculeid`) REFERENCES `vehicules` (`vehicule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paniers_ibfk_2` FOREIGN KEY (`utilisateurid`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. parametres
CREATE TABLE IF NOT EXISTS `parametres` (
  `param_id` varchar(100) NOT NULL,
  `carburant` varchar(50) NOT NULL DEFAULT 'essence',
  `kilometrage` varchar(50) NOT NULL DEFAULT '0kh',
  `auto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `vehiculeid` varchar(100) NOT NULL,
  PRIMARY KEY (`param_id`),
  UNIQUE KEY `vehiculeid` (`vehiculeid`),
  CONSTRAINT `parametres_ibfk_1` FOREIGN KEY (`vehiculeid`) REFERENCES `vehicules` (`vehicule_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. stats
CREATE TABLE IF NOT EXISTS `stats` (
  `stat_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stat` int NOT NULL DEFAULT '1',
  `vehiculeid` varchar(100) NOT NULL,
  `createat` datetime NOT NULL,
  PRIMARY KEY (`stat_id`),
  KEY `vehiculeid` (`vehiculeid`),
  CONSTRAINT `FK_stats_vehicules` FOREIGN KEY (`vehiculeid`) REFERENCES `vehicules` (`vehicule_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. stocks
CREATE TABLE IF NOT EXISTS `stocks` (
  `stock_id` varchar(100) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `vehiculeid` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `vehiculeid` (`vehiculeid`),
  CONSTRAINT `stock` FOREIGN KEY (`vehiculeid`) REFERENCES `vehicules` (`vehicule_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. taux
CREATE TABLE IF NOT EXISTS `taux` (
  `taux_id` varchar(100) NOT NULL,
  `franc` varchar(255) NOT NULL,
  `dollard` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`taux_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. types
CREATE TABLE IF NOT EXISTS `types` (
  `type_id` varchar(100) NOT NULL,
  `type` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. utilisateurs
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `utilisateur_id` varchar(100) NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'senior',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. vehicules
CREATE TABLE IF NOT EXISTS `vehicules` (
  `vehicule_id` varchar(100) NOT NULL,
  `vehicule` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `promo` varchar(50) NOT NULL DEFAULT '1',
  `star` int NOT NULL DEFAULT '3',
  `typeid` varchar(100) DEFAULT NULL,
  `marqueid` varchar(100) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`vehicule_id`),
  UNIQUE KEY `vehicule` (`vehicule`),
  KEY `marqueid` (`marqueid`),
  KEY `typeid` (`typeid`),
  CONSTRAINT `vehicules_ibfk_1` FOREIGN KEY (`marqueid`) REFERENCES `marques` (`marque_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vehicules_ibfk_2` FOREIGN KEY (`typeid`) REFERENCES `types` (`type_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
