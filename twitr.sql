-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 01 Avril 2015 à 11:09
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `twitr`
--
CREATE DATABASE IF NOT EXISTS `twitr` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `twitr`;

-- --------------------------------------------------------

--
-- Structure de la table `favori`
--

CREATE TABLE IF NOT EXISTS `favori` (
  `idTwit` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idTwit`,`idUser`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `favori`
--

INSERT INTO `favori` (`idTwit`, `idUser`) VALUES
(30, 1),
(30, 2),
(34, 1),
(54, 1),
(54, 2);

-- --------------------------------------------------------

--
-- Structure de la table `reltwitusers`
--

CREATE TABLE IF NOT EXISTS `reltwitusers` (
  `idUser` int(11) NOT NULL,
  `idTwit` int(11) NOT NULL,
  `dateTwit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `retwit` tinyint(1) NOT NULL,
  `favori` tinyint(1) NOT NULL,
  `origin` int(11) NOT NULL,
  PRIMARY KEY (`idUser`,`idTwit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reltwitusers`
--

INSERT INTO `reltwitusers` (`idUser`, `idTwit`, `dateTwit`, `retwit`, `favori`, `origin`) VALUES
(2, 1, '2015-03-16 11:55:37', 0, 0, 0),
(1, 2, '2015-03-16 11:55:37', 0, 0, 0),
(2, 3, '2015-03-16 11:55:55', 0, 0, 0),
(2, 7, '2015-03-16 11:56:55', 0, 0, 0),
(1, 4, '2015-03-16 11:56:05', 0, 0, 0),
(1, 6, '2015-03-16 11:56:35', 0, 0, 0),
(2, 5, '2015-03-16 11:56:22', 0, 0, 0),
(2, 8, '2015-03-16 14:44:05', 0, 0, 0),
(2, 9, '2015-03-16 14:44:05', 0, 0, 0),
(2, 10, '2015-03-16 14:44:05', 0, 0, 0),
(2, 11, '2015-03-16 14:44:05', 0, 0, 0),
(2, 12, '2015-03-16 14:44:05', 0, 0, 0),
(2, 13, '2015-03-16 14:44:05', 0, 0, 0),
(2, 14, '2015-03-16 14:44:05', 0, 0, 0),
(2, 15, '2015-03-16 14:44:05', 0, 0, 0),
(2, 16, '2015-03-16 14:44:05', 0, 0, 0),
(2, 17, '2015-03-16 14:44:05', 0, 0, 0),
(2, 18, '2015-03-16 14:44:06', 0, 0, 0),
(2, 19, '2015-03-16 14:44:06', 0, 0, 0),
(2, 20, '2015-03-16 14:44:06', 0, 0, 0),
(2, 21, '2015-03-16 14:44:06', 0, 0, 0),
(2, 22, '2015-03-16 14:44:06', 0, 0, 0),
(2, 23, '2015-03-16 14:44:06', 0, 0, 0),
(2, 24, '2015-03-16 14:44:06', 0, 0, 0),
(1, 25, '2015-03-16 14:44:06', 0, 0, 0),
(1, 26, '2015-03-16 14:44:06', 0, 0, 0),
(1, 27, '2015-03-16 14:44:06', 0, 0, 0),
(1, 28, '2015-03-16 14:44:06', 0, 0, 0),
(1, 29, '2015-03-16 14:44:06', 0, 0, 0),
(1, 30, '2015-03-27 10:38:42', 1, 0, 2),
(1, 31, '2015-03-16 14:44:06', 0, 0, 0),
(1, 32, '2015-03-16 14:44:06', 0, 0, 0),
(1, 33, '2015-03-16 14:44:06', 0, 0, 0),
(1, 34, '2015-03-16 14:44:06', 0, 0, 0),
(1, 35, '2015-03-16 14:44:06', 0, 0, 0),
(1, 36, '2015-03-16 14:44:06', 0, 0, 0),
(1, 37, '2015-03-16 14:44:06', 0, 0, 0),
(2, 39, '2015-03-16 14:53:20', 0, 0, 0),
(2, 40, '2015-03-16 14:53:20', 0, 0, 0),
(2, 41, '2015-03-16 14:53:20', 0, 0, 0),
(2, 42, '2015-03-16 14:53:20', 0, 0, 0),
(2, 43, '2015-03-16 14:53:20', 0, 0, 0),
(2, 44, '2015-03-16 14:53:20', 0, 0, 0),
(2, 45, '2015-03-16 14:53:20', 0, 0, 0),
(2, 46, '2015-03-16 14:53:20', 0, 0, 0),
(2, 47, '2015-03-16 14:53:20', 0, 0, 0),
(2, 48, '2015-03-16 14:53:20', 0, 0, 0),
(2, 49, '2015-03-16 14:54:39', 0, 0, 0),
(2, 50, '2015-03-16 14:54:39', 0, 0, 0),
(2, 51, '2015-03-16 14:54:39', 0, 0, 0),
(2, 52, '2015-03-16 14:54:39', 0, 0, 0),
(2, 53, '2015-03-16 14:54:39', 0, 0, 0),
(2, 54, '2015-03-16 14:54:39', 0, 0, 0),
(2, 55, '2015-03-16 14:54:39', 0, 0, 0),
(2, 56, '2015-03-16 14:54:39', 0, 0, 0),
(2, 57, '2015-03-16 14:54:39', 0, 0, 0),
(2, 58, '2015-03-16 14:54:39', 0, 0, 0),
(2, 38, '2015-03-16 14:52:49', 0, 0, 0),
(1, 49, '2015-03-20 16:45:29', 1, 0, 2),
(1, 56, '2015-03-20 16:45:46', 1, 0, 2),
(1, 55, '2015-03-20 16:46:55', 1, 0, 2),
(1, 54, '2015-03-20 16:52:55', 1, 0, 2),
(2, 30, '2015-03-20 17:08:35', 1, 0, 1),
(2, 34, '2015-03-27 11:06:35', 1, 0, 1),
(1, 58, '2015-03-27 10:37:21', 1, 0, 2),
(1, 53, '2015-03-27 12:27:58', 1, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `twit`
--

CREATE TABLE IF NOT EXISTS `twit` (
  `idTwit` int(11) NOT NULL AUTO_INCREMENT,
  `messageTwit` varchar(255) NOT NULL,
  PRIMARY KEY (`idTwit`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Contenu de la table `twit`
--

INSERT INTO `twit` (`idTwit`, `messageTwit`) VALUES
(1, 'On s''en fout'),
(2, 'Bla bla bla'),
(3, 'Graaouuuuuh'),
(4, 'Fuck this text'),
(5, 'Qu''est-ce que j''écris ?'),
(6, 'La base de donnée'),
(7, '42'),
(8, 'Twit automatique pour remplir la BDD'),
(9, 'Twit automatique pour remplir la BDD'),
(10, 'Twit automatique pour remplir la BDD'),
(11, 'Twit automatique pour remplir la BDD'),
(12, 'Twit automatique pour remplir la BDD'),
(13, 'Twit automatique pour remplir la BDD'),
(14, 'Twit automatique pour remplir la BDD'),
(15, 'Twit automatique pour remplir la BDD'),
(16, 'Twit automatique pour remplir la BDD'),
(17, 'Twit automatique pour remplir la BDD'),
(18, 'Twit automatique pour remplir la BDD'),
(19, 'Twit automatique pour remplir la BDD'),
(20, 'Twit automatique pour remplir la BDD'),
(21, 'Twit automatique pour remplir la BDD'),
(22, 'Twit automatique pour remplir la BDD'),
(23, 'Twit automatique pour remplir la BDD'),
(24, 'Twit automatique pour remplir la BDD'),
(25, 'Twit automatique pour remplir la BDD'),
(26, 'Twit automatique pour remplir la BDD'),
(27, 'Twit automatique pour remplir la BDD'),
(28, 'Twit automatique pour remplir la BDD'),
(29, 'Twit automatique pour remplir la BDD'),
(30, 'Twit automatique pour remplir la BDD'),
(31, 'Twit automatique pour remplir la BDD'),
(32, 'Twit automatique pour remplir la BDD'),
(33, 'Twit automatique pour remplir la BDD'),
(34, 'Twit automatique pour remplir la BDD'),
(35, 'Twit automatique pour remplir la BDD'),
(36, 'Twit automatique pour remplir la BDD'),
(37, 'Twit automatique pour remplir la BDD'),
(38, 'Twit automatique pour remplir la BDD0'),
(39, 'Twit automatique pour remplir la BDD0'),
(40, 'Twit automatique pour remplir la BDD1'),
(41, 'Twit automatique pour remplir la BDD2'),
(42, 'Twit automatique pour remplir la BDD3'),
(43, 'Twit automatique pour remplir la BDD4'),
(44, 'Twit automatique pour remplir la BDD5'),
(45, 'Twit automatique pour remplir la BDD6'),
(46, 'Twit automatique pour remplir la BDD7'),
(47, 'Twit automatique pour remplir la BDD8'),
(48, 'Twit automatique pour remplir la BDD9'),
(49, 'Twit automatique pour remplir la BDD0'),
(50, 'Twit automatique pour remplir la BDD1'),
(51, 'Twit automatique pour remplir la BDD2'),
(52, 'Twit automatique pour remplir la BDD3'),
(53, 'Twit automatique pour remplir la BDD4'),
(54, 'Twit automatique pour remplir la BDD5'),
(55, 'Twit automatique pour remplir la BDD6'),
(56, 'Twit automatique pour remplir la BDD7'),
(57, 'Twit automatique pour remplir la BDD8'),
(58, 'Twit automatique pour remplir la BDD9');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `loginUser` varchar(255) NOT NULL,
  `nomUser` varchar(255) NOT NULL,
  `prenomUser` varchar(255) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`idUser`, `loginUser`, `nomUser`, `prenomUser`) VALUES
(1, 'a.pecriaux', 'Anthony', 'Pecriaux'),
(2, 't.turlututu', 'Toto', 'turlututu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
