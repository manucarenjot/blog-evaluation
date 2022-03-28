-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : lun. 28 mars 2022 à 13:29
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fpm03_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `fpm03_admin`
--

DROP TABLE IF EXISTS `fpm03_admin`;
CREATE TABLE IF NOT EXISTS `fpm03_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail_UNIQUE` (`mail`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fpm03_admin`
--

INSERT INTO `fpm03_admin` (`id`, `mail`) VALUES
(1, 'admin@admin.org');

-- --------------------------------------------------------

--
-- Structure de la table `fpm03_articles`
--

DROP TABLE IF EXISTS `fpm03_articles`;
CREATE TABLE IF NOT EXISTS `fpm03_articles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `fpm03_banned`
--

DROP TABLE IF EXISTS `fpm03_banned`;
CREATE TABLE IF NOT EXISTS `fpm03_banned` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `mail` varchar(255) COLLATE utf8_bin NOT NULL,
  `date-de-ban` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `fpm03_banned`
--

INSERT INTO `fpm03_banned` (`id`, `username`, `mail`, `date-de-ban`) VALUES
(23, 'manu', 'manu@gmail.com', '2022-03-28 12:36:11');

-- --------------------------------------------------------

--
-- Structure de la table `fpm03_comment`
--

DROP TABLE IF EXISTS `fpm03_comment`;
CREATE TABLE IF NOT EXISTS `fpm03_comment` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `article_fk` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_article` (`article_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `fpm03_modo`
--

DROP TABLE IF EXISTS `fpm03_modo`;
CREATE TABLE IF NOT EXISTS `fpm03_modo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail_UNIQUE` (`mail`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fpm03_modo`
--

INSERT INTO `fpm03_modo` (`id`, `username`, `mail`, `date`) VALUES
(7, 'bydie', 'admin@admin.org', '2022-03-28 12:25:35');

-- --------------------------------------------------------

--
-- Structure de la table `fpm03_user`
--

DROP TABLE IF EXISTS `fpm03_user`;
CREATE TABLE IF NOT EXISTS `fpm03_user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail_UNIQUE` (`mail`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fpm03_user`
--

INSERT INTO `fpm03_user` (`id`, `username`, `mail`, `password`, `date`) VALUES
(1, 'bydie', 'admin@admin.org', '$2y$10$k2js00bbq/NadgpBkYSMWevHLuSHzbozrqbCxs7J.ftPm6ChRYWmq', '2022-03-25 13:01:52'),
(2, 'manu', 'manu@gmail.com', '$2y$10$JhxGMgbt2x2vRfLqJ6HIwOIpqkuWoD5vjEZUWHC5Qr26rzWcRpnbu', '2022-03-25 14:46:44');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fpm03_comment`
--
ALTER TABLE `fpm03_comment`
  ADD CONSTRAINT `comment_article` FOREIGN KEY (`article_fk`) REFERENCES `fpm03_articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
