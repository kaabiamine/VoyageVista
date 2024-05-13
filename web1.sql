-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 13 mai 2024 à 13:53
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `web1`
--

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `subject`, `message`, `is_read`, `created_at`) VALUES
(13, 'Nouvelle réclamation', 'Une nouvelle réclamation a été ajoutée  13', 0, '2024-05-13 09:10:00'),
(14, 'Nouvelle réclamation', 'Une nouvelle réclamation a été ajoutée  13', 0, '2024-05-13 09:19:48'),
(15, 'Nouvelle réclamation', 'Une nouvelle réclamation a été ajoutée  13', 0, '2024-05-13 09:22:40'),
(16, 'Nouvelle réclamation', 'Une nouvelle réclamation a été ajoutée  14', 0, '2024-05-13 09:39:45'),
(17, 'Nouvelle réclamation', 'Une nouvelle réclamation a été ajoutée  16', 0, '2024-05-13 10:44:06'),
(18, 'Nouvelle réclamation', 'Une nouvelle réclamation a été ajoutée  16', 0, '2024-05-13 11:02:28'),
(19, 'Nouvelle réclamation', 'Une nouvelle réclamation a été ajoutée  16', 0, '2024-05-13 11:03:54'),
(20, 'Nouvelle réclamation', 'Une nouvelle réclamation a été ajoutée  16', 0, '2024-05-13 11:05:16'),
(21, 'Nouvelle réclamation', 'Une nouvelle réclamation a été ajoutée  16', 0, '2024-05-13 11:12:43'),
(22, 'Nouvelle réclamation', 'Une nouvelle réclamation a été ajoutée  16', 0, '2024-05-13 11:13:48'),
(23, 'Nouvelle réclamation', 'Une nouvelle réclamation a été ajoutée  16', 0, '2024-05-13 11:15:22'),
(24, 'Nouvelle réclamation', 'Une nouvelle réclamation a été ajoutée  16', 0, '2024-05-13 11:18:52'),
(25, 'Nouvelle réclamation', 'Une nouvelle réclamation a été ajoutée  14', 0, '2024-05-13 11:23:30'),
(26, 'Nouvelle réclamation', 'Une nouvelle réclamation a été ajoutée  14', 0, '2024-05-13 11:52:13');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `expiration` datetime NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `user_id`, `token`, `expiration`, `email`) VALUES
(1, NULL, 'fa435046897fc8d6b0cfe43d26e115e568f87b70ea3b4d03ba8972db9fa2c67b', '0000-00-00 00:00:00', 'guetat.oussama@esprit.tn'),
(22, 13, '8060e4e7485d4faae9049649abd5abd586a5c15823ea24d363dab89fb1cafa0f', '0000-00-00 00:00:00', ''),
(24, 13, '3983e3b05cbc780a7317abb293617e4292efeaf3b0dc13bf034082d472d5187d', '0000-00-00 00:00:00', ''),
(25, 15, 'db7ae98a472982245127bf3569b1d4f1cae19c04ce90bfe7f9541997438369d8', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `idReclamation` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`idReclamation`, `description`, `sujet`, `status`, `date`, `idUser`) VALUES
(1, 'test', 'test', 'Traité', '2024-04-24', 6),
(14, 'des', 'test', 'En cours', '2024-05-13', 13),
(15, 'rec', 'reclamtion', 'En cours', '2024-05-13', 13),
(16, 'sss', 'reclamtion', 'En cours', '2024-05-13', 13),
(17, 'testUser', 'testUser', 'En cours', '2024-05-13', 14),
(18, 'testMail', 'rec', 'Traité', '2024-05-13', 16),
(19, 'uuuu', 'testuuu', 'Traité', '2024-05-13', 16),
(21, 'email', 'email', 'Traité', '2024-05-13', 16),
(26, 'ddd', 'ddd', 'Traité', '2024-05-13', 16),
(27, 'nnnd', 'bbb', 'En cours', '2024-05-13', 14),
(28, 'ss', 'ss', 'En cours', '2024-05-13', 14);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `idReponse` int(11) NOT NULL,
  `idReclamation` int(11) NOT NULL,
  `dateReponse` date NOT NULL,
  `texteReponse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`idReponse`, `idReclamation`, `dateReponse`, `texteReponse`) VALUES
(2, 1, '2024-05-12', 'nn'),
(4, 1, '2024-05-12', 'gggggll'),
(6, 1, '2024-05-13', 'wwnnooo'),
(11, 15, '2024-05-13', 'testt'),
(17, 21, '2024-05-13', 'eeee'),
(23, 26, '2024-05-13', 'bbbbgg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ficher` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `prenom`, `nom`, `email`, `adresse`, `tel`, `role`, `password`, `ficher`) VALUES
(6, 'oussama', 'guetat', 'guetat.oussama@esprit.tn', 'iben khouldoun', '50393270', 1, 'oussama1234', ''),
(13, 'guetat', 'oussama', 'guetat.oussama99@gmail.com', 'sdf', '991', 2, 'oussama123', ''),
(14, 'jendoubi ', 'assim', 'assim22@gmail.com', 'tunis', '8888888', 2, 'Wess123+', ''),
(15, 'jendoubi ', 'folan', 'assim.jendoubi@esprit.tn', 'tunis', '52011447', 2, 'Ali123@Â§', ''),
(16, 'roua', 'bougattaya', 'rouabougattaya03@gmail.com', 'tunis', '22222222', 2, 'roua123', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`idReclamation`),
  ADD KEY `fk_user_idUser` (`idUser`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`idReponse`),
  ADD KEY `fk_user_idReponse` (`idReclamation`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `idReclamation` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `idReponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD CONSTRAINT `password_reset_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `fk_user_idUser` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `fk_user_idReponse` FOREIGN KEY (`idReclamation`) REFERENCES `reclamation` (`idReclamation`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
