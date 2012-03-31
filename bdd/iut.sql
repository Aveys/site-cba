-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Sam 31 Mars 2012 à 13:30
-- Version du serveur: 5.1.30
-- Version de PHP: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `iut`
--

-- --------------------------------------------------------

--
-- Structure de la table `blagues`
--

CREATE TABLE IF NOT EXISTS `blagues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `id_pseudo` int(11) NOT NULL,
  `cat` varchar(40) NOT NULL,
  `date` date NOT NULL,
  `nbJaime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `blagues`
--

INSERT INTO `blagues` (`id`, `texte`, `id_pseudo`, `cat`, `date`, `nbJaime`) VALUES
(18, 'Ceci est une blague pas drôle alors accrochez vous ça va faire mal! \r\nAie', 0, 'Nonsens', '2012-03-31', 1);

-- --------------------------------------------------------

--
-- Structure de la table `com`
--

CREATE TABLE IF NOT EXISTS `com` (
  `id_log` varchar(40) NOT NULL,
  `id_blague` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_log` (`id_log`,`id_blague`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `com`
--

INSERT INTO `com` (`id_log`, `id_blague`, `id`, `commentaire`) VALUES
('toto74', 18, 7, 'booooooooooouuuuuuuuuuuuuhhhhhh');

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `login` varchar(40) NOT NULL,
  `mdp` varchar(40) NOT NULL,
  `admin` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `log`
--

INSERT INTO `log` (`login`, `mdp`, `admin`, `mail`, `date_naissance`) VALUES
('toto74', 'toto74', 0, 'thomas.rovayaz@hotmail.fr', '1993-09-08');

-- --------------------------------------------------------

--
-- Structure de la table `synchro_jaime_log`
--

CREATE TABLE IF NOT EXISTS `synchro_jaime_log` (
  `id_log` varchar(40) NOT NULL,
  `id_blague` int(11) NOT NULL,
  `jaime` int(11) NOT NULL,
  PRIMARY KEY (`id_log`,`id_blague`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

--
-- Contenu de la table `synchro_jaime_log`
--

INSERT INTO `synchro_jaime_log` (`id_log`, `id_blague`, `jaime`) VALUES
('toto74', 18, 1);
