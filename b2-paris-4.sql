-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : mer. 20 mars 2024 à 18:00
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `b2-paris`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int NOT NULL,
  `intervention_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `commentaire` text COLLATE utf8mb4_general_ci,
  `date_commentaire` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `intervention_id`, `user_id`, `commentaire`, `date_commentaire`) VALUES
(1, 1, 2, 'Outils a rapporté par les intervenants', '2024-03-20 11:55:41'),
(2, 2, 10, 'Si possible apporter des cours/livres', '2024-03-20 12:08:36');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `standardiste_id` int NOT NULL,
  `verified` tinyint(1) DEFAULT '0',
  `start_date` datetime NOT NULL,
  `infos` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `degre_urgence` enum('Faible','Moyen','Élevé') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id`, `client_id`, `standardiste_id`, `verified`, `start_date`, `infos`, `degre_urgence`) VALUES
(1, 4, 6, 0, '2024-03-21 00:00:00', 'Intervention de plomberie ', 'Élevé'),
(2, 9, 6, 0, '2024-03-24 00:00:00', 'Peinture de deux chambre', 'Faible'),
(3, 4, 2, 0, '2024-03-22 00:00:00', 'Remplacement des fenêtres ', 'Élevé');

-- --------------------------------------------------------

--
-- Structure de la table `intervenant_intervention`
--

CREATE TABLE `intervenant_intervention` (
  `intervenant_id` int NOT NULL,
  `intervention_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `intervenant_intervention`
--

INSERT INTO `intervenant_intervention` (`intervenant_id`, `intervention_id`) VALUES
(2, 1),
(3, 1),
(5, 1),
(6, 2),
(8, 2),
(3, 3),
(5, 3),
(7, 3),
(8, 3);

-- --------------------------------------------------------

--
-- Structure de la table `interventions`
--

CREATE TABLE `interventions` (
  `id` int NOT NULL,
  `client_id` int DEFAULT NULL,
  `standardiste_id` int DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `status_suivi` enum('En attente','En cours','Clôturée','Annulée') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'En attente',
  `degre_urgence` enum('Faible','Moyen','Élevé') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Moyen',
  `infos` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `interventions`
--

INSERT INTO `interventions` (`id`, `client_id`, `standardiste_id`, `start_date`, `status_suivi`, `degre_urgence`, `infos`) VALUES
(1, 9, 2, '2024-03-28', 'En attente', 'Moyen', 'Intervention d\'électricité  sur de l\'électroménager '),
(2, 10, 6, '2024-03-31', 'En attente', 'Faible', 'Cours particulier de mathematiques niveau bac'),
(3, 4, 7, '2024-03-22', 'En attente', 'Élevé', 'Montage de meuble de cuisine');

--
-- Déclencheurs `interventions`
--
DELIMITER $$
CREATE TRIGGER `add_intervenant_intervention` AFTER INSERT ON `interventions` FOR EACH ROW BEGIN
    INSERT INTO intervenant_intervention (intervenant_id, intervention_id)
    VALUES (NEW.standardiste_id, NEW.id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('client','intervenant','standardiste','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'client',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verified` tinyint(1) DEFAULT '0',
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '/img/profile_default.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `name`, `surname`, `email`, `password`, `role`, `created_at`, `updated_at`, `verified`, `photo`) VALUES
(1, 'Maïssa', 'Kerchaoui', 'admin@admin.fr', '$2y$10$SGeX5Ra0AGf/AnkReSlZoO6ba08Qll4YAKnFTze/2KNuhMWmrLzQO', 'admin', '2024-03-19 14:01:02', '2024-03-19 14:01:02', 1, '/img/profile_photo_65f99bf4da268_wallpaperbetter.jpeg'),
(2, 'Amine', 'Assous', 'standardiste@standardiste.fr', '$2y$10$9JlirLbFwynDPvhnj/arMefGIEPj.TEJY6J3Yk6eDHrlEha6.FvoG', 'standardiste', '2024-03-19 14:12:23', '2024-03-19 14:12:23', 1, '/img/profile_default.jpeg'),
(3, 'Kamil', 'Ghannam', 'intervenant@intervenant.fr', '$2y$10$IYCLjxD/zCqUpBR/786UZ.ZoVGOZ4wzF/0dJpCkpBh3V9n.xZ6FLa', 'intervenant', '2024-03-19 14:19:35', '2024-03-19 14:19:35', 1, '/img/profile_default.jpeg'),
(4, 'Eros', 'Wallabregue', 'client@client.fr', '$2y$10$MSwRoDyikOdg7xRpitW8tuVIv2yPk4YDhMViFII6l5Zq.WkHyFKyC', 'client', '2024-03-19 14:20:49', '2024-03-19 14:20:49', 1, '/img/profile_photo_65fb209e1b6a3_wallpaperbetter.jpeg'),
(5, 'Monia', 'Azlouk', 'intervenant2@intervenant.fr', '$2y$10$iTXwEOi.QTvMSbdO5MZGX.lEef07A1r8X6JE.V/MuL29d8kKJHgxG', 'intervenant', '2024-03-19 14:25:33', '2024-03-19 14:25:33', 1, '/img/profile_default.jpeg'),
(6, 'Elisa', 'Calvaro', 'standardiste2@standardiste.fr', '$2y$10$Kpk1lBHUH0hh7MNPZUNbB.sh5mZdp/mHepCEsma9yjhwUfbTgeLpm', 'standardiste', '2024-03-19 14:26:13', '2024-03-19 14:26:13', 1, '/img/profile_default.jpeg'),
(7, 'Noemie', 'Nunes', 'standardiste3@standardiste.fr', '$2y$10$elscJ2P0F6XQ26Y4l6hs9eZX2I1nv7bhKpAQxiN92cAW9DJuaeX8O', 'standardiste', '2024-03-19 14:27:04', '2024-03-19 14:27:04', 1, '/img/profile_default.jpeg'),
(8, 'Lila', 'Amezian', 'intervenant3@intervenant.fr', '$2y$10$/VdOQq2nIU6sPFLayUEPr.7CFm/qXpJrW1Vq8oMRbCWxcoFZGL/Qy', 'intervenant', '2024-03-19 14:28:20', '2024-03-19 14:28:20', 1, '/img/profile_default.jpeg'),
(9, 'Mazen', 'Kerchaoui', 'client2@client.fr', '$2y$10$xwS6stHSDPA6Vi.grVxvVuaZHfnpAhPuagZYTVLsbr9YC1VYdr/.e', 'client', '2024-03-19 14:28:51', '2024-03-19 14:28:51', 1, '/img/profile_default.jpeg'),
(10, 'Montassar', 'Kerchaoui', 'client3@client.fr', '$2y$10$PEgSlR4KxVjwns3h4mxJBOJPVeEQwlQwKr2rj/tFnMENos0dxBqyO', 'client', '2024-03-19 14:29:19', '2024-03-19 14:29:19', 1, '/img/profile_default.jpeg'),
(11, 'Anaghim', 'Azlouk', 'client4@client.fr', '$2y$10$Pg3XgSCbMM94SqiC5Gd1/uX6IXLngj2OtUP22cwek43bg8M4/rFge', 'client', '2024-03-20 13:13:22', '2024-03-20 13:13:22', 0, '/img/profile_default.jpeg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intervention_id` (`intervention_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `intervenant_intervention`
--
ALTER TABLE `intervenant_intervention`
  ADD PRIMARY KEY (`intervenant_id`,`intervention_id`),
  ADD KEY `intervention_id` (`intervention_id`);

--
-- Index pour la table `interventions`
--
ALTER TABLE `interventions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `standardiste_id` (`standardiste_id`),
  ADD KEY `client_id` (`client_id`) USING BTREE;

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `interventions`
--
ALTER TABLE `interventions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`intervention_id`) REFERENCES `interventions` (`id`),
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `intervenant_intervention`
--
ALTER TABLE `intervenant_intervention`
  ADD CONSTRAINT `intervenant_intervention_ibfk_1` FOREIGN KEY (`intervenant_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `intervenant_intervention_ibfk_2` FOREIGN KEY (`intervention_id`) REFERENCES `interventions` (`id`);

--
-- Contraintes pour la table `interventions`
--
ALTER TABLE `interventions`
  ADD CONSTRAINT `interventions_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `interventions_ibfk_2` FOREIGN KEY (`standardiste_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
