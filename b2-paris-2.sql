-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : sam. 24 fév. 2024 à 11:33
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
  `date_commentaire` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `intervenant_intervention`
--

CREATE TABLE `intervenant_intervention` (
  `intervenant_id` int NOT NULL,
  `intervention_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `interventions`
--

CREATE TABLE `interventions` (
  `id` int NOT NULL,
  `client_id` int DEFAULT NULL,
  `standardiste_id` int DEFAULT NULL,
  `date_intervention` date DEFAULT NULL,
  `status_suivi` enum('En attente','En cours','Clôturée','Annulée') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'En attente',
  `degre_urgence` enum('Faible','Moyen','Élevé') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Moyen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `name`, `surname`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(5, 'Maissa', 'Kerchaoui', 'maissa@maissa', '$2y$10$xA.DrrqCE3Ry2/4XfflaB.fndN6mLpdCyuzhr/7NfHZv4t5komGx2', 'client', '2024-02-02 10:26:58', '2024-02-02 10:26:58'),
(6, 'Maissa', 'Kerchaoui', 'maissa.kerchaoui@gmail.com', '$2y$10$9K1vyYU1cb2b5MuF.HVg8.APVLkToqVB2lhH5KsND07H7f4ZSNIyK', 'client', '2024-02-12 10:37:27', '2024-02-12 10:37:27');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `interventions`
--
ALTER TABLE `interventions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
