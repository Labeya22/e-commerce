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

-- Listage des données de la table ventes_vehicules.banques : ~2 rows (environ)
INSERT INTO `banques` (`banque_id`, `solde`, `numberAccount`, `update_at`, `utilisateurid`) VALUES
	('3CvZyS5sZQIgtWtkAuUP1CTqad8Zm0ARGeYw5zSGNXdwhgFzSUNCnKZaPDGm', 960000, '9c3GiSmz', '2023-01-21 15:13:59', 'IUsKOlmzCE5ks0aweM8gd73eETsYGqr8pL93d9ee8WlT37xDnLjpuiuwDZgi'),
	('3mx9sKzQJTNu641uVXDYsFuM2YWtMUdqERotDubU3k0oy4KxDCuFXaO184U0', 79550000, 'VNtCz9fH', '2023-01-29 12:03:59', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V'),
	('f8TKngmBczLA6gS0mAUYWVW2r71OW0AcQU6i61icBSsEA4fSasTciiuCHjRD', 804000, 'isdNxLKA', '2023-01-21 14:39:29', '4xN33zp9onxfzVPU47Ox7NRNA3tpOxJSOJjO0Xu5kNEOKLOfzpCAqfNYNH86');

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
	('UnDP8J', '196000', '[{"prix": 14000, "marque": "Toyota", "quantite": 14, "vehicule": "mark-x", "vehicule_id": "ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x"}]', '2023-01-21 14:39:29', '4xN33zp9onxfzVPU47Ox7NRNA3tpOxJSOJjO0Xu5kNEOKLOfzpCAqfNYNH86'),
	('2X0QFv', '40000', '[{"prix": 4000, "marque": "Honda", "quantite": 10, "vehicule": "papa", "vehicule_id": "IDlFX3El41DSNYf7qvM5ve40fhuNMkvsAmuW7M5vq1zHoMoIlciO8ZIDyt8b"}]', '2023-01-21 15:13:59', 'IUsKOlmzCE5ks0aweM8gd73eETsYGqr8pL93d9ee8WlT37xDnLjpuiuwDZgi'),
	('yfBlrz', '1000000', '[{"prix": 500000, "marque": "Toyota", "quantite": 2, "vehicule": "mark-xd", "vehicule_id": "nhD56g6vHScb2Z26x6N5acKZzcwbr0CM62GHUuieeNpV3gykjhYwa2IIuspN"}]', '2023-01-21 17:01:00', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V'),
	('juyFV5', '10572000', '[{"prix": 4000, "marque": "Honda", "quantite": 10, "vehicule": "papa", "vehicule_id": "IDlFX3El41DSNYf7qvM5ve40fhuNMkvsAmuW7M5vq1zHoMoIlciO8ZIDyt8b"}, {"prix": 14000, "marque": "Toyota", "quantite": 658, "vehicule": "mark-x", "vehicule_id": "ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x"}, {"prix": 60000, "marque": "Honda", "quantite": 22, "vehicule": "patak", "vehicule_id": "u2UVj6a9ih5JQRpZAGu6KqjRLZdwWUkMclb5EEzjRCSiVD1fjRI8BD5S5Nsp"}]', '2023-01-21 20:01:24', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V'),
	('FQaPxT', '392000', '[{"prix": 14000, "marque": "Toyota", "quantite": 28, "vehicule": "mark-x", "vehicule_id": "ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x"}]', '2023-01-21 20:02:14', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V'),
	('zwgdJ3', '4000', '[{"prix": 4000, "marque": "Honda", "quantite": 1, "vehicule": "papa", "vehicule_id": "IDlFX3El41DSNYf7qvM5ve40fhuNMkvsAmuW7M5vq1zHoMoIlciO8ZIDyt8b"}]', '2023-01-24 14:30:46', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V'),
	('spHw90', '14000', '[{"prix": 14000, "marque": "Toyota", "quantite": 1, "vehicule": "mark-x", "vehicule_id": "ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x"}]', '2023-01-24 14:31:24', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V'),
	('ehAKlP', '40000', '[{"prix": 4000, "marque": "Honda", "quantite": 10, "vehicule": "papa", "vehicule_id": "IDlFX3El41DSNYf7qvM5ve40fhuNMkvsAmuW7M5vq1zHoMoIlciO8ZIDyt8b"}]', '2023-01-29 12:03:59', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V');

-- Listage de la structure de table ventes_vehicules. marques
CREATE TABLE IF NOT EXISTS `marques` (
  `marque_id` varchar(100) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`marque_id`),
  UNIQUE KEY `marque` (`marque`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ventes_vehicules.marques : ~4 rows (environ)
INSERT INTO `marques` (`marque_id`, `marque`, `create_at`) VALUES
	('eWuGYX3jGmVxWUyEOI1WC5dWfEC19rE8tXdiwssk8RI8JlMz5STCb9SVTa1i', 'Mercedes', '2023-01-22 07:42:25'),
	('hLAm0BjZH8QUssDdbpDXEIfwpISzWM8kzrcH1yK7DSvMhf3NTUdzVWLY9tNw', 'Toyota', '2023-01-21 14:33:35'),
	('iCDYLLav7NRupfv7EqadLU2d34H0Zi5zy6XOhThf65IiE4KiwQWB5gA4R2y9', 'Honda', '2023-01-21 14:33:47');

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
	('7RCdEXn3cFYqsr4olU8Pf2ht4yUPRFHwPHyqQIEBrqcJJmVGrQL2vv7mT8I5', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V', 'compte banquaire', 'il vous reste que 0$ dans votre compte.', 1, '2023-01-21 17:02:07'),
	('ewBfJaDRodDVvtyTSafLTu9Po8stdv34B3GSfXIyGMz3F76Ifnf24zgafoyO', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V', 'compte banquaire', 'paiement effectuer, 14000$ a été retirer dans votre compte.', 0, '2023-01-24 14:31:24'),
	('FaS1DorExKiYmUgfDw4UPTvLsMq8Xh7bfOMyJzs63Tq5eYjSII1KdNMUQuSM', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V', 'compte banquaire', 'paiement effectuer, 1000000$ a été retirer dans votre compte.', 1, '2023-01-21 17:01:00'),
	('kbve8tAmlERmF8pGMaWwVlSem3C8ZTFtjZzSfv11s1Yq6srn7JzWzMvm3dw5', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V', 'compte banquaire', 'paiement effectuer, 10572000$ a été retirer dans votre compte.', 1, '2023-01-21 20:01:24'),
	('PoAcnhGUfHrItY7VOr1sR0i73xFnwtzgpv3KN8V6t7oTAciFzEhE8KW2i9qX', '4xN33zp9onxfzVPU47Ox7NRNA3tpOxJSOJjO0Xu5kNEOKLOfzpCAqfNYNH86', 'compte banquaire', 'paiement effectuer, 196000$ a été retirer dans votre compte.', 0, '2023-01-21 14:39:29'),
	('sB0nmYXAQdaCwhGasEcj7D0ndNhuw0ApPWaRLDHiMhAwsP3PwTGVpU8VZRfd', 'IUsKOlmzCE5ks0aweM8gd73eETsYGqr8pL93d9ee8WlT37xDnLjpuiuwDZgi', 'compte banquaire', 'paiement effectuer, 40000$ a été retirer dans votre compte.', 1, '2023-01-21 15:13:59'),
	('uO9Rd6GslT8w1vdmKkaEMPJmFCogHbl1xZswhaGB3M6R7PE7RieBfH2E7vdr', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V', 'compte banquaire', 'il vous reste que 0$ dans votre compte.', 1, '2023-01-21 17:02:15'),
	('yCW7wbUJgI3cyKEsLwGsVdvrDUwRL1RYvdBu32MkiEQQ6i74mj7n5ewE2dKU', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V', 'compte banquaire', 'paiement effectuer, 4000$ a été retirer dans votre compte.', 0, '2023-01-24 14:30:46'),
	('ZBGFiCqaecV6Unlx5PHG8JKBmMl4w6LHyUsNifWvnfgRSMdrmGpgSwPDRPN9', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V', 'compte banquaire', 'paiement effectuer, 40000$ a été retirer dans votre compte.', 1, '2023-01-29 12:03:59');

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

-- Listage des données de la table ventes_vehicules.paniers : ~1 rows (environ)
INSERT INTO `paniers` (`panier_id`, `vehiculeid`, `utilisateurid`, `quantite`, `create_at`) VALUES
	('fiTeJ2FF0tSjeVYvgEhVB01CP4sEcXdr06j3bpXT9SRKY9QYM7Em1dFdE8jK', 'ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V', 1, '2023-01-31 08:26:04'),
	('OaetcnHbJgWXXPOXIIyASeUGp99pQzZXxHq2xWGSIU4sV93g3SZrTNDvuQBk', 'IDlFX3El41DSNYf7qvM5ve40fhuNMkvsAmuW7M5vq1zHoMoIlciO8ZIDyt8b', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V', 1, '2023-01-31 09:33:16');

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

-- Listage des données de la table ventes_vehicules.parametres : ~4 rows (environ)
INSERT INTO `parametres` (`param_id`, `carburant`, `kilometrage`, `auto`, `vehiculeid`) VALUES
	('KNkQ8k9gGT1MJ53II3TpFQTSzVwGw4vVMufnFGl9cJbnWfV0mCRLO86n1O4V', 'diesel', '0km', 'automatique', 'IDlFX3El41DSNYf7qvM5ve40fhuNMkvsAmuW7M5vq1zHoMoIlciO8ZIDyt8b'),
	('MvAKcXPXVMX37doXHFnTDB6kIKxGYSy4U6SxnapLfKIycgfRj6gtrZ3guFjj', 'électrique', '0km', 'automatique', 'ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x'),
	('rd7KuiuZmPXYriekK7z9FoEURGYqMmAvavCQqFFKvc81IunF3qammJpptRbr', 'diesel', '0km', 'manuel', 'u2UVj6a9ih5JQRpZAGu6KqjRLZdwWUkMclb5EEzjRCSiVD1fjRI8BD5S5Nsp'),
	('ynYZFYqTE4im1s95nwiCh66UgkN4W3VuwrOcwKSDi34tO4qmxnuhmhtya8q2', 'essences', '0km', 'manuel', 'nhD56g6vHScb2Z26x6N5acKZzcwbr0CM62GHUuieeNpV3gykjhYwa2IIuspN');

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

-- Listage des données de la table ventes_vehicules.stats : ~7 rows (environ)
INSERT INTO `stats` (`stat_id`, `stat`, `vehiculeid`, `createat`) VALUES
	('7UENm9zh0eBiMvV3d6NidxM2OYpLGgI73xuDioDVFofKJRq4ylzxD66Ip1Sr', 1, 'ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x', '2023-01-24 14:31:24'),
	('BnVPYdILF3hmTqyUv07lMkwMXASk5cfa8hrr0SAarpWesniTrliS9pVuXt0e', 1, 'u2UVj6a9ih5JQRpZAGu6KqjRLZdwWUkMclb5EEzjRCSiVD1fjRI8BD5S5Nsp', '2023-01-21 20:01:24'),
	('Jw0d9Z6gfzaugYdDwVrEPeB2hKNy8ldsMiwaQeQ95fJRazLqG06XSNCorn5p', 1, 'IDlFX3El41DSNYf7qvM5ve40fhuNMkvsAmuW7M5vq1zHoMoIlciO8ZIDyt8b', '2023-01-29 12:03:59'),
	('KVnwwRYJNlyHkhTQyankMy9OA9YrEXqUR2UnbhYuzfZCs35aUUltP0XN1yz7', 1, 'ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x', '2023-01-21 20:02:14'),
	('LG4Fxgb7V4ZBjDzcfo2yLBJRPAXdg6E0pwJZ3rpHDTVehFl4rjs8XYBVe2BV', 1, 'ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x', '2023-01-21 14:39:29'),
	('rwG31uY7LpNBLedQAibHNCdIPiPNr5MaWvj3Ly43a8v2WUlONhPM6fD01INL', 1, 'IDlFX3El41DSNYf7qvM5ve40fhuNMkvsAmuW7M5vq1zHoMoIlciO8ZIDyt8b', '2023-01-21 15:13:59'),
	('WcHcBOo5aJoFZNEoaOW7UYOmJJaOMivSJ0YYEYnpkjPmf6vyzI0k1h6lwTrP', 1, 'nhD56g6vHScb2Z26x6N5acKZzcwbr0CM62GHUuieeNpV3gykjhYwa2IIuspN', '2023-01-21 17:01:00'),
	('yO83LDYyHy1RVVXsWik8ny7kiC3T2pxyQzvlmMe1KNlSSahEXQWpiZE7PHGU', 1, 'IDlFX3El41DSNYf7qvM5ve40fhuNMkvsAmuW7M5vq1zHoMoIlciO8ZIDyt8b', '2023-01-24 14:30:46');

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

-- Listage des données de la table ventes_vehicules.stocks : ~4 rows (environ)
INSERT INTO `stocks` (`stock_id`, `stock`, `vehiculeid`, `create_at`) VALUES
	('9ATo9SyEBQrR3dhk6Us2pEop6C2pP7FvDPn1Dn7KZOcSM77XuiF8b5vKgCCz', 0, 'IDlFX3El41DSNYf7qvM5ve40fhuNMkvsAmuW7M5vq1zHoMoIlciO8ZIDyt8b', '2023-01-21 14:41:47'),
	('hGmmrWHkryS7ByQ4ybPQBFvHED0WUKEUvdEmZk4AVtFBaAQwmwcgMh5Kw5xp', 4, 'nhD56g6vHScb2Z26x6N5acKZzcwbr0CM62GHUuieeNpV3gykjhYwa2IIuspN', '2023-01-21 14:42:59'),
	('Ti0MkivViLRUB524FXI0j9AvqQqJpyF8YtJVzsCFnzW6slqsPrk9fvkLdeO0', 0, 'u2UVj6a9ih5JQRpZAGu6KqjRLZdwWUkMclb5EEzjRCSiVD1fjRI8BD5S5Nsp', '2023-01-21 14:52:23'),
	('ZolXVH97kwi8CbZ7fRufhuy4NcpXmY2OnmACasWmELKrNiA8k745lG4saAcP', 200000, 'ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x', '2023-01-21 14:36:24');

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

-- Listage des données de la table ventes_vehicules.types : ~2 rows (environ)
INSERT INTO `types` (`type_id`, `type`, `create_at`) VALUES
	('8NHCtOmlR20sOGUjLdaOBlaNaxBZP2ETQHJZLNAhfFoIxXho8f2Km2L7hU6B', 'sport', '2023-01-29 12:04:52'),
	('n0HZkXFGzfcndWA7Qd443JmWqGGdqU8ozug3jEd7d8ZoPtxHSEbIV2zTLRem', 'normale', '2023-01-21 14:34:30');

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

-- Listage des données de la table ventes_vehicules.utilisateurs : ~2 rows (environ)
INSERT INTO `utilisateurs` (`utilisateur_id`, `role`, `nom`, `utilisateur`, `prenom`, `email`, `token`, `code`, `password`, `isconfirm`, `create_at`, `update_at`, `confirm_at`, `expirate`) VALUES
	('4xN33zp9onxfzVPU47Ox7NRNA3tpOxJSOJjO0Xu5kNEOKLOfzpCAqfNYNH86', 'senior', 'jordinho', 'jorjodinho', 'jojo', 'jojo@gmail.com', NULL, NULL, '$2y$10$RbudiiInDBq5CkxX6P7MbOXUg8ibVR026zU4qac1wvlc6RuKhMXXS', 1, '2023-01-21 14:38:15', '2023-01-21 19:49:47', '2023-01-21 14:38:48', NULL),
	('IUsKOlmzCE5ks0aweM8gd73eETsYGqr8pL93d9ee8WlT37xDnLjpuiuwDZgi', 'senior', 'mwana', 'labeya', 'laurent', 'labeya@gmail.com', NULL, NULL, '$2y$10$x.VuaN0y50VGndlG.GANTeXYpvj68BwZG6QUdw8sswvSO7DF16ZCK', 1, '2023-01-21 15:10:49', NULL, '2023-01-21 15:11:52', NULL),
	('tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V', 'admin', 'admin', 'admin', 'admin', 'admin@admin.com', NULL, NULL, '$2y$10$ac3znVh.0zo2B9WJEzRsYuatzBvWYdDNomEeBBzlSZbBJ8G0oq4Ky', 1, '2023-01-21 14:30:21', '2023-01-21 16:58:17', NULL, NULL);

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

-- Listage des données de la table ventes_vehicules.vehicules : ~4 rows (environ)
INSERT INTO `vehicules` (`vehicule_id`, `vehicule`, `image`, `prix`, `promo`, `star`, `typeid`, `marqueid`, `description`, `create_at`) VALUES
	('ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x', 'mark-x', '4urTRSOPEjqdyc9P4NjiMnDcPPs8bE.jpg', 14000, 'yes', 3, '8NHCtOmlR20sOGUjLdaOBlaNaxBZP2ETQHJZLNAhfFoIxXho8f2Km2L7hU6B', 'hLAm0BjZH8QUssDdbpDXEIfwpISzWM8kzrcH1yK7DSvMhf3NTUdzVWLY9tNw', 'fufu lipa dindon', '2023-01-21 14:36:24'),
	('IDlFX3El41DSNYf7qvM5ve40fhuNMkvsAmuW7M5vq1zHoMoIlciO8ZIDyt8b', 'papa', 'DlWEOiOgYEJLRXuZlSVwmYSE19NytZ.jpg', 4000, 'yes', 4, '8NHCtOmlR20sOGUjLdaOBlaNaxBZP2ETQHJZLNAhfFoIxXho8f2Km2L7hU6B', 'iCDYLLav7NRupfv7EqadLU2d34H0Zi5zy6XOhThf65IiE4KiwQWB5gA4R2y9', 'ytdkydy', '2023-01-21 14:41:47'),
	('nhD56g6vHScb2Z26x6N5acKZzcwbr0CM62GHUuieeNpV3gykjhYwa2IIuspN', 'mark-xd', 'XMwC2mYY5QTprIgm8q7cUbvESd3boC.jpg', 500000, 'yes', 5, '8NHCtOmlR20sOGUjLdaOBlaNaxBZP2ETQHJZLNAhfFoIxXho8f2Km2L7hU6B', 'hLAm0BjZH8QUssDdbpDXEIfwpISzWM8kzrcH1yK7DSvMhf3NTUdzVWLY9tNw', 'uyurmff', '2023-01-21 14:42:59'),
	('u2UVj6a9ih5JQRpZAGu6KqjRLZdwWUkMclb5EEzjRCSiVD1fjRI8BD5S5Nsp', 'patak', 'bSOW0PmCtkwuLFeuGA0gltFsj2pq3W.jpg', 60000, 'yes', 3, 'n0HZkXFGzfcndWA7Qd443JmWqGGdqU8ozug3jEd7d8ZoPtxHSEbIV2zTLRem', 'iCDYLLav7NRupfv7EqadLU2d34H0Zi5zy6XOhThf65IiE4KiwQWB5gA4R2y9', 'fupp_tpti', '2023-01-21 14:52:23');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
