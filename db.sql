-- Active: 1670697101741@@127.0.0.1@3306@ecommercevehicule
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
CREATE DATABASE IF NOT EXISTS `ecommercevehicules` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ecommercevehicules`;

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

-- Listage des données de la table ventes_vehicules.admin : ~0 rows (environ)

-- Listage de la structure de table ventes_vehicules. banques
CREATE TABLE IF NOT EXISTS `banques` (
  `banque_id` varchar(50) NOT NULL,
  `solde` double NOT NULL DEFAULT '100000',
  `numberAccount` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `utilisateurid` int NOT NULL,
  UNIQUE KEY `banque_id` (`banque_id`),
  KEY `utilisateurid` (`utilisateurid`),
  CONSTRAINT `FK_banques_utilisateurs` FOREIGN KEY (`utilisateurid`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ventes_vehicules.banques : ~1 rows (environ)
INSERT INTO `banques` (`banque_id`, `solde`, `numberAccount`, `update_at`, `utilisateurid`) VALUES
	('1', 20999558000, '14141414', '2023-01-16 05:51:11', 18);

-- Listage de la structure de table ventes_vehicules. factures
CREATE TABLE IF NOT EXISTS `factures` (
  `facture_id` int NOT NULL AUTO_INCREMENT,
  `total` float NOT NULL,
  `cart` json NOT NULL,
  `utilisateurid` int NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`facture_id`),
  KEY `utilisateurid` (`utilisateurid`),
  CONSTRAINT `factures_ibfk_2` FOREIGN KEY (`utilisateurid`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ventes_vehicules.factures : ~2 rows (environ)
INSERT INTO `factures` (`facture_id`, `total`, `cart`, `utilisateurid`, `create_at`) VALUES
	(1, 9500, '[{"prix": 1500, "marque": "TOYOTA", "quantite": 10, "vehicule": "YARIS", "vehicule_id": 2}, {"prix": 3000, "marque": "BMV", "quantite": 2, "vehicule": "Louper", "vehicule_id": 3}, {"prix": 2000, "marque": "TOYOTA", "quantite": 1, "vehicule": "COROLLA", "vehicule_id": 1}]', 18, '2023-01-16 05:51:11');

-- Listage de la structure de table ventes_vehicules. marques
CREATE TABLE IF NOT EXISTS `marques` (
  `marque_id` int NOT NULL AUTO_INCREMENT,
  `marque` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`marque_id`),
  UNIQUE KEY `marque` (`marque`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ventes_vehicules.marques : ~4 rows (environ)
INSERT INTO `marques` (`marque_id`, `marque`, `create_at`) VALUES
	(1, 'TOYOTA', '2023-01-09 14:00:00'),
	(2, 'Honda', '2023-01-09 14:00:17'),
	(3, 'Nissan', '2023-01-09 14:00:17'),
	(4, 'BMV', '2023-01-09 14:00:17');

-- Listage de la structure de table ventes_vehicules. medias
CREATE TABLE IF NOT EXISTS `medias` (
  `media_id` int NOT NULL AUTO_INCREMENT,
  `vehiculeid` int DEFAULT NULL,
  `media` varchar(255) NOT NULL,
  PRIMARY KEY (`media_id`),
  KEY `vehiculeid` (`vehiculeid`),
  CONSTRAINT `medias_ibfk_1` FOREIGN KEY (`vehiculeid`) REFERENCES `vehicules` (`vehicule_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ventes_vehicules.medias : ~2 rows (environ)
INSERT INTO `medias` (`media_id`, `vehiculeid`, `media`) VALUES
	(1, 3, 'store-1.jpg'),
	(2, 3, 'store-2.jpg'),
	(3, 3, 'store-3.jpg');

-- Listage de la structure de table ventes_vehicules. paniers
CREATE TABLE IF NOT EXISTS `paniers` (
  `panier_id` int NOT NULL AUTO_INCREMENT,
  `vehiculeid` int NOT NULL,
  `utilisateurid` int NOT NULL,
  `quantite` int NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`panier_id`),
  KEY `vehiculeid` (`vehiculeid`),
  KEY `utilisateurid` (`utilisateurid`),
  CONSTRAINT `paniers_ibfk_1` FOREIGN KEY (`vehiculeid`) REFERENCES `vehicules` (`vehicule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paniers_ibfk_2` FOREIGN KEY (`utilisateurid`) REFERENCES `utilisateurs` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ventes_vehicules.paniers : ~3 rows (environ)

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

-- Listage des données de la table ventes_vehicules.parametres : ~2 rows (environ)
INSERT INTO `parametres` (`param_id`, `carburant`, `kilometrage`, `auto`, `vehiculeid`) VALUES
	(1, 'essence', '0kh', 1, 3),
	(2, 'essence', '0kh', 1, 2),
	(3, 'essence', '0kh', 1, 1);

-- Listage de la structure de table ventes_vehicules. stocks
CREATE TABLE IF NOT EXISTS `stocks` (
  `stock_id` int NOT NULL AUTO_INCREMENT,
  `stock` int NOT NULL DEFAULT '0',
  `vehiculeid` int NOT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `vehiculeid` (`vehiculeid`),
  CONSTRAINT `stock` FOREIGN KEY (`vehiculeid`) REFERENCES `vehicules` (`vehicule_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ventes_vehicules.stocks : ~3 rows (environ)
INSERT INTO `stocks` (`stock_id`, `stock`, `vehiculeid`) VALUES
	(1, 13, 1),
	(2, -9, 2),
	(3, 897, 3);

-- Listage de la structure de table ventes_vehicules. taux
CREATE TABLE IF NOT EXISTS `taux` (
  `taux_id` int NOT NULL AUTO_INCREMENT,
  `franc` varchar(255) NOT NULL,
  `dollard` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`taux_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ventes_vehicules.taux : ~0 rows (environ)
INSERT INTO `taux` (`taux_id`, `franc`, `dollard`) VALUES
	(1, '2150', 1);

-- Listage de la structure de table ventes_vehicules. types
CREATE TABLE IF NOT EXISTS `types` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ventes_vehicules.types : ~2 rows (environ)
INSERT INTO `types` (`type_id`, `type`, `create_at`) VALUES
	(1, 'sport', '2023-01-09 14:27:00'),
	(2, 'wagon', '2023-01-09 14:27:00'),
	(3, 'bus', '2023-01-09 14:27:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ventes_vehicules.utilisateurs : ~0 rows (environ)
INSERT INTO `utilisateurs` (`utilisateur_id`, `nom`, `utilisateur`, `prenom`, `email`, `token`, `code`, `password`, `isconfirm`, `create_at`, `update_at`, `confirm_at`, `expirate`) VALUES
	(18, 'jeres', 'jeres', 'jeremies', 'jeremiemasik@gmail.com', NULL, NULL, '$2y$10$8fx5mlxSr3SxpF6tl89v5uMSwRy95aYsxnRKOUOWJVyGJwM0nUW4m', 1, '2023-01-14 13:09:42', '2023-01-14 21:27:40', '2023-01-14 13:09:59', NULL);

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

-- Listage des données de la table ventes_vehicules.vehicules : ~3 rows (environ)
INSERT INTO `vehicules` (`vehicule_id`, `vehicule`, `image`, `prix`, `promo`, `star`, `typeid`, `marqueid`, `description`, `create_at`) VALUES
	(1, 'COROLLA', '4.jpg', 2000, 1, 3, 2, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci praesentium similique maiores. Facere laudantium at maiores eius id praesentium vero quam. Distinctio atque consequuntur soluta, dicta obcaecati voluptatem magnam recusandae.', '2023-01-09 14:38:38'),
	(2, 'YARIS', '5.jpg', 1500, 1, 3, 2, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci praesentium similique maiores. Facere laudantium at maiores eius id praesentium vero quam. Distinctio atque consequuntur soluta, dicta obcaecati voluptatem magnam recusandae.', '2023-01-09 14:38:38'),
	(3, 'Louper', '6.jpg', 3000, 0, 4, 3, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci praesentium similique maiores. Facere laudantium at maiores eius id praesentium vero quam. Distinctio atque consequuntur soluta, dicta obcaecati voluptatem magnam recusandae.', '2023-01-09 14:38:38');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
