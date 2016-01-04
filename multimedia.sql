-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 04 Janvier 2016 à 14:08
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bddsimplevent`
--

-- --------------------------------------------------------

--
-- Structure de la table `multimedia`
--

CREATE TABLE IF NOT EXISTS `multimedia` (
  `id_multimediaevent` int(11) NOT NULL AUTO_INCREMENT,
  `principale` tinyint(1) NOT NULL,
  `Event_id` int(11) NOT NULL,
  `urlvid_event` text,
  `urlsite_event` text,
  `urlimg_event` text,
  PRIMARY KEY (`id_multimediaevent`),
  KEY `Event_id_idx` (`Event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `evenement_selectionne` FOREIGN KEY (`Event_id`) REFERENCES `event` (`Event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
