-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 01 mai 2024 à 13:29
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `source_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `meilleurscore`
--

CREATE TABLE `meilleurscore` (
  `id` int(11) NOT NULL,
  `score` int(10) NOT NULL,
  `temps` timestamp NOT NULL DEFAULT current_timestamp(),
  `emetteur` varchar(15) NOT NULL,
  `jeu` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `meilleurscore`
--

INSERT INTO `meilleurscore` (`id`, `score`, `temps`, `emetteur`, `jeu`) VALUES
(1, 45, '2024-04-16 08:41:01', 'pierre', 'line'),
(2, 40, '2024-04-18 16:53:17', 'pierre', 'line');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `pseudo` varchar(15) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `genre` char(1) NOT NULL,
  `ddn` date NOT NULL,
  `avatar` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`pseudo`, `mdp`, `genre`, `ddn`, `avatar`) VALUES
('cedric', '$2y$10$2L7KpeXmMlYc.awCd5aXlOaBy2EQOJk.BIAwCAHbl9oqrCuUCGKbG', 'M', '1979-03-30', ''),
('pierre', '$2y$10$QK3.2jK0NMi5U9VhD6TIm.ljWSe1CC1lELolS86BkGQSf.xmsHrV2', 'S', '1979-04-15', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `meilleurscore`
--
ALTER TABLE `meilleurscore`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emetteur` (`emetteur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `meilleurscore`
--
ALTER TABLE `meilleurscore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `meilleurscore`
--
ALTER TABLE `meilleurscore`
  ADD CONSTRAINT `meilleurscore_ibfk_1` FOREIGN KEY (`emetteur`) REFERENCES `utilisateur` (`pseudo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
