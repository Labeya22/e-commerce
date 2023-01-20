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

-- Listage des données de la table ventes_vehicules.banques : ~0 rows (environ)
INSERT INTO `banques` (`banque_id`, `solde`, `numberAccount`, `update_at`, `utilisateurid`) VALUES
	('9du35UEQ3NRPiDYoHSe7R4MApP7FUzCxEZ1PIeNlyh6B9Kr3h6cHqOvONnNj', 4000, 'fSlV6qr4', '2023-01-19 16:43:43', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM'),
	('cmnXFYp4AHNPM4Lza7KHxGIyv7z89aDwNbLvH8eTVysLCsO9oORhDGktndYz', 997600, 'RcWMRQaq', '2023-01-20 12:55:25', 'lLPJ3sDbadMUVpcs4Wkjt8oHPClN1754C5LvFlrKl48z7lkGSUCKU2ifeBz4');

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

-- Listage des données de la table ventes_vehicules.factures : ~7 rows (environ)
INSERT INTO `factures` (`facture_id`, `total`, `cart`, `create_at`, `utilisateurid`) VALUES
	('Fo9V7Q', '50000', '[{"prix": 5000, "marque": "toyota", "quantite": 10, "vehicule": "mark-xs", "vehicule_id": "e7TyGxzg4yVg51Xda8R7oLwILRtOF0v4oUZdhmoSCFqBaDrC1NKcc9AgXzj9"}]', '2023-01-19 09:30:19', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM'),
	('cYPVno', '30000', '[{"prix": 3000, "marque": "toyotasss", "quantite": 10, "vehicule": "mark-x", "vehicule_id": "EY1w75hYyyS3F3cWSKXfFdmyoPFi5rIEoiAdbZRTbw4bCf0qKH8kU5rJdCra"}]', '2023-01-19 10:08:52', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM'),
	('67eQn4', '100000', '[{"prix": 3000, "marque": "toyotasss", "quantite": 10, "vehicule": "mark-x", "vehicule_id": "EY1w75hYyyS3F3cWSKXfFdmyoPFi5rIEoiAdbZRTbw4bCf0qKH8kU5rJdCra"}]', '2023-01-19 10:55:39', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM'),
	('WSg80r', '400000', '[{"prix": 40000, "marque": "Mercedes", "quantite": 10, "vehicule": "mark-x", "vehicule_id": "Fpwm5AOWRwNmeCdM49Wmnw4wi5Zj7phcN5d6ona7nvhkwab0AVfZ2uu6ZrFs"}]', '2023-01-19 12:36:15', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM'),
	('wVAoW1', '400000', '[{"prix": 40000, "marque": "Mercedes", "quantite": 10, "vehicule": "mark-x", "vehicule_id": "Fpwm5AOWRwNmeCdM49Wmnw4wi5Zj7phcN5d6ona7nvhkwab0AVfZ2uu6ZrFs"}]', '2023-01-19 12:51:07', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM'),
	('ANCFXO', '13000', '[{"prix": 3000, "marque": "Mercedes", "quantite": 2, "vehicule": "mark-x", "vehicule_id": "74HjZjQ0w0GP4A35IWEhtxWpMDHrr420NPURsaPd71gdt39GC7zOAbtwntMV"}, {"prix": 7000, "marque": "Mercedes", "quantite": 1, "vehicule": "benz 2011", "vehicule_id": "znGBX9WWagayXCsNHCZiXHn3bnJ0dO7MRzu1rHnXJ1JzG0IIEiOeTYyK2f54"}]', '2023-01-19 16:15:31', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM'),
	('Fjabqv', '3000', '[{"prix": 3000, "marque": "Mercedes", "quantite": 10, "vehicule": "mark-x", "vehicule_id": "74HjZjQ0w0GP4A35IWEhtxWpMDHrr420NPURsaPd71gdt39GC7zOAbtwntMV"}]', '2023-01-19 16:43:43', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM'),
	('cjGer1', '400', '[{"prix": 400, "marque": "Mercedes", "quantite": 1, "vehicule": "mark-xss", "vehicule_id": "Nhun8euFfUiOfGexKazwBNwUk77YkEBuAmn2rOnL3e34tbwh16cYBqS1vZMC"}]', '2023-01-20 06:51:18', 'lLPJ3sDbadMUVpcs4Wkjt8oHPClN1754C5LvFlrKl48z7lkGSUCKU2ifeBz4'),
	('LqOPZG', '2000', '[{"prix": 400, "marque": "Mercedes", "quantite": 5, "vehicule": "mark-xss", "vehicule_id": "Nhun8euFfUiOfGexKazwBNwUk77YkEBuAmn2rOnL3e34tbwh16cYBqS1vZMC"}]', '2023-01-20 12:55:25', 'lLPJ3sDbadMUVpcs4Wkjt8oHPClN1754C5LvFlrKl48z7lkGSUCKU2ifeBz4');

-- Listage de la structure de table ventes_vehicules. marques
CREATE TABLE IF NOT EXISTS `marques` (
  `marque_id` varchar(100) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`marque_id`),
  UNIQUE KEY `marque` (`marque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ventes_vehicules.marques : ~3 rows (environ)
INSERT INTO `marques` (`marque_id`, `marque`, `create_at`) VALUES
	('alHQlIHtO1wc3SLzRtk5sT7XBBgXOCjAfYVqfD5GYfl0t0aSUVu7TAPZjtRN', 'Toyota', '2023-01-20 09:06:21'),
	('tMbuz7FxfhFsXciTEZkelm6vBxnGhDcAaGwVSiEmunEUUElOhTbcGNX3VP55', 'Mercedes', '2023-01-19 11:06:33'),
	('UUSosySJGOrRpqlBDnXiwLw7xEDXPyK8NioWK5fDXj8ehcSKOWI4KUf27wS9', 'Honda', '2023-01-19 11:06:26');

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

-- Listage des données de la table ventes_vehicules.notifications : ~7 rows (environ)
INSERT INTO `notifications` (`notif_id`, `utilisateurid`, `title`, `content`, `eye`, `create_at`) VALUES
	('5iXjAtjMGS3v6d81cO7jFCHY56BUZ6MxCnF6K2h2hq0vQJQH1o0TZ0YP4NGl', 'lLPJ3sDbadMUVpcs4Wkjt8oHPClN1754C5LvFlrKl48z7lkGSUCKU2ifeBz4', 'compte banquaire', 'paiement effectuer, 2000$ a été retirer dans votre compte.', 1, '2023-01-20 12:55:25'),
	('gJrgXprHHlMT2P5q1pka4kaU5Jl4gHBETFvs2LCdXIRD0mMPX1MXGysWzQnO', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM', 'compte banquaire', 'il vous reste que 20000$ dans votre compte.', 1, '2023-01-19 16:14:39'),
	('guWelvCo5w8I3wSLhbVNPZuRQ7GQL5YrLsrFX0QZk1Ph5Frtnt486rXjAPQ4', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM', 'compte banquaire', 'il vous reste que 7000$ dans votre compte.', 1, '2023-01-19 16:43:37'),
	('LsqJTPyIgVu2qvIUzs3QEdU3f95LntG7WvFdM0tjTYbxiuO1knLhpSdgXIvb', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM', 'compte banquaire', 'paiement effectuer, 100000$ a été retirer dans votre compte.', 1, '2023-01-19 10:55:39'),
	('TeqBWOQTEgqGrBkOzQWiDiQs66uiZeyuWrGfNJku3lTUfUbnaDv670lQP5vU', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM', 'compte banquaire', 'paiement effectuer, 13000$ a été retirer dans votre compte.', 1, '2023-01-19 16:15:31'),
	('VBFowp3lsJQJvgb1i7FhMuNeUIqy76SgSPMwDnAE2nd7KxfedO7alkakI75E', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM', 'compte banquaire', 'paiement effectuer, 400000$ a été retirer dans votre compte.', 1, '2023-01-19 12:51:07'),
	('Wa6ECCO43r6qDkmhvVJzJp6gaRb9miNz41MSNGch8AYoXHlnNZtNcG7YV3oD', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM', 'compte banquaire', 'paiement effectuer, 3000$ a été retirer dans votre compte.', 1, '2023-01-19 16:43:43'),
	('XOtmrkXTmBuq3Vz4HrT5UFIlpV2DRTCTgMTB8vwZv1C7frpyWzL82xmyeOtG', 'toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM', 'compte banquaire', 'paiement effectuer, 400000$ a été retirer dans votre compte.', 1, '2023-01-19 12:36:15');

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

-- Listage des données de la table ventes_vehicules.paniers : ~0 rows (environ)

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

-- Listage des données de la table ventes_vehicules.parametres : ~0 rows (environ)

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

-- Listage des données de la table ventes_vehicules.stocks : ~0 rows (environ)

-- Listage de la structure de table ventes_vehicules. taux
CREATE TABLE IF NOT EXISTS `taux` (
  `taux_id` varchar(100) NOT NULL,
  `franc` varchar(255) NOT NULL,
  `dollard` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`taux_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ventes_vehicules.taux : ~0 rows (environ)
INSERT INTO `taux` (`taux_id`, `franc`, `dollard`) VALUES
	('1', '2150', 1);

-- Listage de la structure de table ventes_vehicules. types
CREATE TABLE IF NOT EXISTS `types` (
  `type_id` varchar(100) NOT NULL,
  `type` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ventes_vehicules.types : ~4 rows (environ)
INSERT INTO `types` (`type_id`, `type`, `create_at`) VALUES
	('IYWtOctP2wk8FGpzE1FOFcZfRHmwNB7u3crhi5WKOdTBism0WPkXvZnlEiao', 'SUV', '2023-01-20 13:22:17'),
	('qm0XoEIUS8dnubp76gJcgUUvkJxjtznTt6NWI9M919DPtjD5OSpTEp1nDdRP', 'courses', '2023-01-19 10:35:19');

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

-- Listage des données de la table ventes_vehicules.utilisateurs : ~3 rows (environ)
INSERT INTO `utilisateurs` (`utilisateur_id`, `role`, `nom`, `utilisateur`, `prenom`, `email`, `token`, `code`, `password`, `isconfirm`, `create_at`, `update_at`, `confirm_at`, `expirate`) VALUES
	('lLPJ3sDbadMUVpcs4Wkjt8oHPClN1754C5LvFlrKl48z7lkGSUCKU2ifeBz4', 'admin', 'admin-nom', 'admin_username', 'admin-prenom', 'admin@admin.com', NULL, NULL, '$2y$10$8EjJZhf7XsOR1RCwP9XVWudrkklFqRYbD8AC9kC1M17RbiaEUjWh.', 1, '2023-01-19 21:04:25', NULL, NULL, NULL),
	('OARTBonqyFFDaS9StdDbIpktS5cfUmRUtYjI6nQ2yVjPblUuxShqbtq1azPk', 'senior', 'jeremia', 'jeremie', 'jeremies', 'jeremia@j.comss', NULL, NULL, '$2y$10$lxpBT1WIso6hB8Fty5NQcO5/pVclhL.G8GCP/sD1F/6JnL4yqy0N.', 1, '2023-01-19 21:36:42', '2023-01-20 12:54:36', NULL, NULL),
	('toM4nO5BrberV1bwuFec9G17Vx1SkFf2JUe07AL7LUWnLZLL8CVrOvenERXM', 'senior', 'jeremia', 'labeya', 'labeya', 'jeremia@j.comlabeya', 'NpFj5TXPwdxBomPfjziZJZN3Krb6wRb3g5AOkLi4LIl9IIT0xoHj6AT8qjV4S6nOYX9UFlIvJNwQ5QWXSRN7ovRMWd1aeeu8Hxv9', NULL, '$2y$10$t0NHJZ6QrJc4sF3JbcF/UOj/ZH3f5aPPtD/O9DFGA9.w.WJD8OH96', 1, '2023-01-19 09:29:35', '2023-01-20 12:59:13', '2023-01-19 09:29:47', NULL);

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

-- Listage des données de la table ventes_vehicules.vehicules : ~1 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
