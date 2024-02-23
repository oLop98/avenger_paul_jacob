-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 21 fév. 2024 à 06:23
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `avenger_paul`
--

-- --------------------------------------------------------

--
-- Structure de la table `caillou`
--

DROP TABLE IF EXISTS `caillou`;
CREATE TABLE IF NOT EXISTS `caillou` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `caillou`
--

INSERT INTO `caillou` (`id`, `nom_categorie`, `photo_url`) VALUES
(1, 'Faune', NULL),
(2, 'Flore', NULL),
(4, 'Animaux', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240219000916', '2024-02-19 00:09:37', 466),
('DoctrineMigrations\\Version20240221024055', '2024-02-21 02:41:14', 76),
('DoctrineMigrations\\Version20240221031229', '2024-02-21 03:12:47', 104),
('DoctrineMigrations\\Version20240221035714', '2024-02-21 03:58:05', 122),
('DoctrineMigrations\\Version20240221044923', '2024-02-21 04:49:42', 148);

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

DROP TABLE IF EXISTS `livres`;
CREATE TABLE IF NOT EXISTS `livres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id`, `titre`, `auteur`) VALUES
(1, 'Dance avec le mal', 'Marc Zuckerberg'),
(2, 'Dance avec le mal', 'Marc Zuckerberg'),
(3, 'Dance avec le mal', 'Marc Zuckerberg');

-- --------------------------------------------------------

--
-- Structure de la table `marque_page`
--

DROP TABLE IF EXISTS `marque_page`;
CREATE TABLE IF NOT EXISTS `marque_page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_de_creation` date NOT NULL,
  `commentaire` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `marque_page`
--

INSERT INTO `marque_page` (`id`, `url`, `date_de_creation`, `commentaire`) VALUES
(1, 'https://example.com', '2024-02-19', 'Un commentaire'),
(2, 'https://example.com', '2024-02-19', 'Un commentaire'),
(3, 'https://example.com', '2024-02-19', 'Un commentaire'),
(4, 'https://example.com', '2024-02-19', 'Un commentaire'),
(5, 'https://example.com', '2024-02-19', 'Un commentaire'),
(6, 'https://example.com', '2024-02-19', 'Un commentaire'),
(7, 'https://example.com', '2024-02-19', 'Un commentaire'),
(8, 'https://example.com', '2024-02-19', 'Un commentaire'),
(9, 'https://example.com', '2024-02-20', 'Un commentaire'),
(10, 'https://example.com', '2024-02-20', 'Un commentaire'),
(11, 'https://example.com', '2024-02-21', 'Un commentaire');

-- --------------------------------------------------------

--
-- Structure de la table `marque_page_mots_cles`
--

DROP TABLE IF EXISTS `marque_page_mots_cles`;
CREATE TABLE IF NOT EXISTS `marque_page_mots_cles` (
  `marque_page_id` int NOT NULL,
  `mots_cles_id` int NOT NULL,
  PRIMARY KEY (`marque_page_id`,`mots_cles_id`),
  KEY `IDX_DD7D38C7D59CC0F1` (`marque_page_id`),
  KEY `IDX_DD7D38C7C0BE80DB` (`mots_cles_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `marque_page_mots_cles`
--

INSERT INTO `marque_page_mots_cles` (`marque_page_id`, `mots_cles_id`) VALUES
(5, 1),
(6, 2),
(7, 3),
(8, 4),
(8, 5),
(8, 6),
(9, 7),
(9, 8),
(9, 9),
(10, 10),
(10, 11),
(10, 12),
(11, 13),
(11, 14),
(11, 15);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mots_cles`
--

DROP TABLE IF EXISTS `mots_cles`;
CREATE TABLE IF NOT EXISTS `mots_cles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mots` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mots_cles`
--

INSERT INTO `mots_cles` (`id`, `mots`) VALUES
(1, 'OJEML'),
(2, 'OJEML'),
(3, 'ZZZZ'),
(4, 'ZZZZ'),
(5, 'AAAA'),
(6, 'BBBB'),
(7, 'ZZZZ'),
(8, 'AAAA'),
(9, 'BBBB'),
(10, 'ZZZZ'),
(11, 'AAAA'),
(12, 'BBBB'),
(13, 'ZZZZ'),
(14, 'AAAA'),
(15, 'BBBB');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `categorie`, `photo_url`) VALUES
(3, '1', '/img/image1.png');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `marque_page_mots_cles`
--
ALTER TABLE `marque_page_mots_cles`
  ADD CONSTRAINT `FK_DD7D38C7C0BE80DB` FOREIGN KEY (`mots_cles_id`) REFERENCES `mots_cles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DD7D38C7D59CC0F1` FOREIGN KEY (`marque_page_id`) REFERENCES `marque_page` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
