-- Active: 1670697101741@@127.0.0.1@3306@ventes_vehicules
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

-- Listage de la structure de table ventes_vehicules. admin
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

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. factures
CREATE TABLE IF NOT EXISTS `factures` (
  `facture_id` int NOT NULL AUTO_INCREMENT,
  `sommes` float NOT NULL,
  `panierid` int NOT NULL,
  `utilisateurid` int NOT NULL,
  PRIMARY KEY (`facture_id`),
  KEY `panierid` (`panierid`),
  KEY `utilisateurid` (`utilisateurid`),
  CONSTRAINT `factures_ibfk_1` FOREIGN KEY (`panierid`) REFERENCES `paniers` (`panier_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `factures_ibfk_2` FOREIGN KEY (`utilisateurid`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. marques
CREATE TABLE IF NOT EXISTS `marques` (
  `marque_id` int NOT NULL AUTO_INCREMENT,
  `marque` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`marque_id`),
  UNIQUE KEY `marque` (`marque`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. medias
CREATE TABLE IF NOT EXISTS `medias` (
  `media_id` int NOT NULL AUTO_INCREMENT,
  `vehiculeid` int DEFAULT NULL,
  `media` varchar(255) NOT NULL,
  PRIMARY KEY (`media_id`),
  KEY `vehiculeid` (`vehiculeid`),
  CONSTRAINT `medias_ibfk_1` FOREIGN KEY (`vehiculeid`) REFERENCES `vehicules` (`vehicule_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. paniers
CREATE TABLE IF NOT EXISTS `paniers` (
  `panier_id` int NOT NULL AUTO_INCREMENT,
  `vehiculeid` int NOT NULL,
  `utilisateurid` int NOT NULL,
  `quantite` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`panier_id`),
  KEY `vehiculeid` (`vehiculeid`),
  KEY `utilisateurid` (`utilisateurid`),
  CONSTRAINT `paniers_ibfk_1` FOREIGN KEY (`vehiculeid`) REFERENCES `vehicules` (`vehicule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paniers_ibfk_2` FOREIGN KEY (`utilisateurid`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. parametres
CREATE TABLE IF NOT EXISTS `parametres` (
  `param_id` int NOT NULL AUTO_INCREMENT,
  `carburant` varchar(50) NOT NULL DEFAULT 'essence',
  `kilometrage` varchar(50) NOT NULL DEFAULT '0kh',
  `auto` tinyint(1) NOT NULL DEFAULT '1',
  `vehiculeid` int NOT NULL,
  PRIMARY KEY (`param_id`),
  UNIQUE KEY `vehiculeid` (`vehiculeid`),
  CONSTRAINT `parametres_ibfk_1` FOREIGN KEY (`vehiculeid`) REFERENCES `vehicules` (`vehicule_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. stocks
CREATE TABLE IF NOT EXISTS `stocks` (
  `stock_id` int NOT NULL AUTO_INCREMENT,
  `stock` int NOT NULL,
  `vehiculeid` int NOT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `vehiculeid` (`vehiculeid`),
  CONSTRAINT `stock` FOREIGN KEY (`vehiculeid`) REFERENCES `vehicules` (`vehicule_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. types
CREATE TABLE IF NOT EXISTS `types` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. utilisateurs
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `utilisateur_id` int NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table ventes_vehicules. vehicules
CREATE TABLE IF NOT EXISTS `vehicules` (
  `vehicule_id` int NOT NULL AUTO_INCREMENT,
  `vehicule` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `promo` tinyint NOT NULL DEFAULT '1',
  `star` int NOT NULL DEFAULT '3',
  `typeid` int DEFAULT NULL,
  `marqueid` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`vehicule_id`),
  KEY `marqueid` (`marqueid`),
  KEY `typeid` (`typeid`),
  CONSTRAINT `vehicules_ibfk_1` FOREIGN KEY (`marqueid`) REFERENCES `marques` (`marque_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vehicules_ibfk_2` FOREIGN KEY (`typeid`) REFERENCES `types` (`type_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
