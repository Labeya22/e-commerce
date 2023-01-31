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

-- Listage des données de la table ventes_vehicules.banques : ~1 rows (environ)
INSERT INTO `banques` (`banque_id`, `solde`, `numberAccount`, `update_at`, `utilisateurid`) VALUES
	('3mx9sKzQJTNu641uVXDYsFuM2YWtMUdqERotDubU3k0oy4KxDCuFXaO184U0', 1000000, 'VNtCz9fH', '2023-01-21 14:32:49', 'tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V'),
	('f8TKngmBczLA6gS0mAUYWVW2r71OW0AcQU6i61icBSsEA4fSasTciiuCHjRD', 804000, 'isdNxLKA', '2023-01-21 14:39:29', '4xN33zp9onxfzVPU47Ox7NRNA3tpOxJSOJjO0Xu5kNEOKLOfzpCAqfNYNH86');

-- Listage des données de la table ventes_vehicules.factures : ~0 rows (environ)
INSERT INTO `factures` (`facture_id`, `total`, `cart`, `create_at`, `utilisateurid`) VALUES
	('UnDP8J', '196000', '[{"prix": 14000, "marque": "Toyota", "quantite": 14, "vehicule": "mark-x", "vehicule_id": "ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x"}]', '2023-01-21 14:39:29', '4xN33zp9onxfzVPU47Ox7NRNA3tpOxJSOJjO0Xu5kNEOKLOfzpCAqfNYNH86');

-- Listage des données de la table ventes_vehicules.marques : ~0 rows (environ)
INSERT INTO `marques` (`marque_id`, `marque`, `create_at`) VALUES
	('eWuGYX3jGmVxWUyEOI1WC5dWfEC19rE8tXdiwssk8RI8JlMz5STCb9SVTa1i', 'dede', '2023-01-21 14:33:56'),
	('hLAm0BjZH8QUssDdbpDXEIfwpISzWM8kzrcH1yK7DSvMhf3NTUdzVWLY9tNw', 'Toyota', '2023-01-21 14:33:35'),
	('iCDYLLav7NRupfv7EqadLU2d34H0Zi5zy6XOhThf65IiE4KiwQWB5gA4R2y9', 'Honda', '2023-01-21 14:33:47');

-- Listage des données de la table ventes_vehicules.notifications : ~0 rows (environ)
INSERT INTO `notifications` (`notif_id`, `utilisateurid`, `title`, `content`, `eye`, `create_at`) VALUES
	('PoAcnhGUfHrItY7VOr1sR0i73xFnwtzgpv3KN8V6t7oTAciFzEhE8KW2i9qX', '4xN33zp9onxfzVPU47Ox7NRNA3tpOxJSOJjO0Xu5kNEOKLOfzpCAqfNYNH86', 'compte banquaire', 'paiement effectuer, 196000$ a été retirer dans votre compte.', 0, '2023-01-21 14:39:29');

-- Listage des données de la table ventes_vehicules.paniers : ~0 rows (environ)

-- Listage des données de la table ventes_vehicules.parametres : ~0 rows (environ)
INSERT INTO `parametres` (`param_id`, `carburant`, `kilometrage`, `auto`, `vehiculeid`) VALUES
	('KNkQ8k9gGT1MJ53II3TpFQTSzVwGw4vVMufnFGl9cJbnWfV0mCRLO86n1O4V', 'diesel', '0km', 'automatique', 'IDlFX3El41DSNYf7qvM5ve40fhuNMkvsAmuW7M5vq1zHoMoIlciO8ZIDyt8b'),
	('MvAKcXPXVMX37doXHFnTDB6kIKxGYSy4U6SxnapLfKIycgfRj6gtrZ3guFjj', 'électrique', '0km', 'automatique', 'ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x'),
	('rd7KuiuZmPXYriekK7z9FoEURGYqMmAvavCQqFFKvc81IunF3qammJpptRbr', 'diesel', '0km', 'manuel', 'u2UVj6a9ih5JQRpZAGu6KqjRLZdwWUkMclb5EEzjRCSiVD1fjRI8BD5S5Nsp'),
	('ynYZFYqTE4im1s95nwiCh66UgkN4W3VuwrOcwKSDi34tO4qmxnuhmhtya8q2', 'essences', '0km', 'manuel', 'nhD56g6vHScb2Z26x6N5acKZzcwbr0CM62GHUuieeNpV3gykjhYwa2IIuspN');

-- Listage des données de la table ventes_vehicules.stats : ~0 rows (environ)
INSERT INTO `stats` (`stat_id`, `stat`, `vehiculeid`, `createat`) VALUES
	('LG4Fxgb7V4ZBjDzcfo2yLBJRPAXdg6E0pwJZ3rpHDTVehFl4rjs8XYBVe2BV', 1, 'ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x', '2023-01-21 14:39:29');

-- Listage des données de la table ventes_vehicules.stocks : ~0 rows (environ)
INSERT INTO `stocks` (`stock_id`, `stock`, `vehiculeid`, `create_at`) VALUES
	('9ATo9SyEBQrR3dhk6Us2pEop6C2pP7FvDPn1Dn7KZOcSM77XuiF8b5vKgCCz', 20, 'IDlFX3El41DSNYf7qvM5ve40fhuNMkvsAmuW7M5vq1zHoMoIlciO8ZIDyt8b', '2023-01-21 14:41:47'),
	('hGmmrWHkryS7ByQ4ybPQBFvHED0WUKEUvdEmZk4AVtFBaAQwmwcgMh5Kw5xp', 6, 'nhD56g6vHScb2Z26x6N5acKZzcwbr0CM62GHUuieeNpV3gykjhYwa2IIuspN', '2023-01-21 14:42:59'),
	('Ti0MkivViLRUB524FXI0j9AvqQqJpyF8YtJVzsCFnzW6slqsPrk9fvkLdeO0', 22, 'u2UVj6a9ih5JQRpZAGu6KqjRLZdwWUkMclb5EEzjRCSiVD1fjRI8BD5S5Nsp', '2023-01-21 14:52:23'),
	('ZolXVH97kwi8CbZ7fRufhuy4NcpXmY2OnmACasWmELKrNiA8k745lG4saAcP', 686, 'ggvkVRYGbhxS22tnlCofjQ5iV3K5DjK8jtIJuLPmM3ulS8kH0UoIJKwNTa7x', '2023-01-21 14:36:24');

-- Listage des données de la table ventes_vehicules.taux : ~1 rows (environ)
INSERT INTO `taux` (`taux_id`, `franc`, `dollard`) VALUES
	('1', '2150', 1);

-- Listage des données de la table ventes_vehicules.types : ~0 rows (environ)
INSERT INTO `types` (`type_id`, `type`, `create_at`) VALUES
	('8NHCtOmlR20sOGUjLdaOBlaNaxBZP2ETQHJZLNAhfFoIxXho8f2Km2L7hU6B', 'sport', '2023-01-21 14:34:21'),
	('n0HZkXFGzfcndWA7Qd443JmWqGGdqU8ozug3jEd7d8ZoPtxHSEbIV2zTLRem', 'normale', '2023-01-21 14:34:30');

-- Listage des données de la table ventes_vehicules.utilisateurs : ~1 rows (environ)
INSERT INTO `utilisateurs` (`utilisateur_id`, `role`, `nom`, `utilisateur`, `prenom`, `email`, `token`, `code`, `password`, `isconfirm`, `create_at`, `update_at`, `confirm_at`, `expirate`) VALUES
	('4xN33zp9onxfzVPU47Ox7NRNA3tpOxJSOJjO0Xu5kNEOKLOfzpCAqfNYNH86', 'senior', 'jordinho', 'jorjodinho', 'jojo', 'jojo@gmail.com', NULL, NULL, '$2y$10$RbudiiInDBq5CkxX6P7MbOXUg8ibVR026zU4qac1wvlc6RuKhMXXS', 1, '2023-01-21 14:38:15', NULL, '2023-01-21 14:38:48', NULL),
	('tSJK0cYwzcwhNg39sZP8MICeKlCKnihOOyYF9eLOj1AVtcbBsREzTXCiaq2V', 'admin', 'admin', 'admin', 'admin', 'admin@admin.com', NULL, NULL, '$2y$10$ac3znVh.0zo2B9WJEzRsYuatzBvWYdDNomEeBBzlSZbBJ8G0oq4Ky', 1, '2023-01-21 14:30:21', NULL, NULL, NULL);

-- Listage des données de la table ventes_vehicules.vehicules : ~0 rows (environ)
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
