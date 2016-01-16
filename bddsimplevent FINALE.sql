-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 16 Janvier 2016 à 21:27
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
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `id_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `numerorue` int(11) NOT NULL,
  `rue` text NOT NULL,
  `ville` text NOT NULL,
  `codepostal` int(5) NOT NULL,
  `pays` text NOT NULL,
  PRIMARY KEY (`id_adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categ` int(11) NOT NULL AUTO_INCREMENT,
  `nomCat` varchar(45) NOT NULL,
  PRIMARY KEY (`id_categ`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id_categ`, `nomCat`) VALUES
(23, 'Gratuit'),
(24, 'Payant'),
(25, 'Costumé'),
(33, 'Son'),
(35, 'Habillé'),
(36, '-18'),
(37, 'Gastronomie');

-- --------------------------------------------------------

--
-- Structure de la table `commente`
--

CREATE TABLE IF NOT EXISTS `commente` (
  `date_co` datetime NOT NULL,
  `texte_co` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `Event_id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_commentaire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `confirmation_inscription`
--

CREATE TABLE IF NOT EXISTS `confirmation_inscription` (
  `id_conf` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_conf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `Event_id` int(11) NOT NULL AUTO_INCREMENT,
  `description_e` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Nom_e` varchar(45) NOT NULL,
  `date_e` date DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `privacy` int(11) DEFAULT NULL,
  `id_utilisateur` int(10) unsigned DEFAULT NULL,
  `heuredebut` time DEFAULT NULL,
  `heurefin` time DEFAULT NULL,
  `nb_max_participant` int(11) DEFAULT NULL,
  `id_adresse` int(11) NOT NULL,
  `date_f` date DEFAULT NULL,
  PRIMARY KEY (`Event_id`),
  KEY `id_utilisateur_idx` (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE IF NOT EXISTS `messagerie` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `sujet` text NOT NULL,
  `texte` text NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  `nom_destinataire` varchar(61) NOT NULL,
  `nom_expediteur` varchar(61) NOT NULL,
  `Vue` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_message`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `multimedia`
--

CREATE TABLE IF NOT EXISTS `multimedia` (
  `id_multimediaevent` int(11) NOT NULL AUTO_INCREMENT,
  `principale` tinyint(1) NOT NULL DEFAULT '0',
  `Event_id` int(11) NOT NULL,
  `urlvid_event` text,
  `urlsite_event` text,
  `urlimg_event` text,
  PRIMARY KEY (`id_multimediaevent`),
  KEY `Event_id_idx` (`Event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE IF NOT EXISTS `participation` (
  `id_participant` int(10) unsigned NOT NULL,
  `Event_id` int(11) NOT NULL,
  `Note` int(11) DEFAULT NULL,
  PRIMARY KEY (`Event_id`,`id_participant`),
  KEY `id_utilisateur_idx` (`id_participant`),
  KEY `Event_id_idx` (`Event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `preference`
--

CREATE TABLE IF NOT EXISTS `preference` (
  `id_utilisateur` int(10) unsigned NOT NULL,
  `id_categ` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_categ`),
  KEY `id_categ_idx` (`id_categ`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `relation_amicale`
--

CREATE TABLE IF NOT EXISTS `relation_amicale` (
  `id_utilisateur` int(11) NOT NULL,
  `id_ami` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_ami`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rep_topic`
--

CREATE TABLE IF NOT EXISTS `rep_topic` (
  `id_msgforum` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire_r` text NOT NULL,
  `date` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL,
  PRIMARY KEY (`id_msgforum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `signaler`
--

CREATE TABLE IF NOT EXISTS `signaler` (
  `id_report` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) DEFAULT NULL,
  `Event_id` int(11) DEFAULT NULL,
  `id_commentaire` int(11) DEFAULT NULL,
  `sujet` varchar(45) DEFAULT NULL,
  `commentaire_r` varchar(767) DEFAULT NULL,
  `id_balance` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_report`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sponsor`
--

CREATE TABLE IF NOT EXISTS `sponsor` (
  `idSponsor` int(11) NOT NULL AUTO_INCREMENT,
  `NomSponsor` varchar(45) NOT NULL,
  `img_sponsor` varchar(255) NOT NULL,
  PRIMARY KEY (`idSponsor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `sponsorise`
--

CREATE TABLE IF NOT EXISTS `sponsorise` (
  `Event_id` int(11) NOT NULL,
  `idSponsor` int(11) NOT NULL,
  PRIMARY KEY (`Event_id`,`idSponsor`),
  KEY `idSponsor_idx` (`idSponsor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE IF NOT EXISTS `sujet` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `sujet` text NOT NULL,
  `text_s` text NOT NULL,
  `date_s` datetime NOT NULL,
  PRIMARY KEY (`id_topic`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `typeevent`
--

CREATE TABLE IF NOT EXISTS `typeevent` (
  `Event_id` int(11) NOT NULL,
  `id_categ` int(11) NOT NULL,
  PRIMARY KEY (`Event_id`,`id_categ`),
  KEY `id_categ_idx` (`id_categ`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_u` varchar(30) NOT NULL,
  `prenom_u` varchar(30) NOT NULL,
  `date_de_naissance` date NOT NULL,
  `description` text NOT NULL,
  `photo_u` varchar(255) DEFAULT '../reste/photo_profil/bvert.png',
  `mail` varchar(255) NOT NULL,
  `telephone` int(15) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `sexe` int(2) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `id_adresse` int(11) NOT NULL,
  `confirmation_inscription` int(2) NOT NULL,
  `conf_mod_prof` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `createur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `evenement_selectionne` FOREIGN KEY (`Event_id`) REFERENCES `event` (`Event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `evenement` FOREIGN KEY (`Event_id`) REFERENCES `event` (`Event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `participant` FOREIGN KEY (`id_participant`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `preference`
--
ALTER TABLE `preference`
  ADD CONSTRAINT `choix_pref` FOREIGN KEY (`id_categ`) REFERENCES `categorie` (`id_categ`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `choix_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `sponsorise`
--
ALTER TABLE `sponsorise`
  ADD CONSTRAINT `evenement_sponsorise` FOREIGN KEY (`Event_id`) REFERENCES `event` (`Event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sponsor` FOREIGN KEY (`idSponsor`) REFERENCES `sponsor` (`idSponsor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `typeevent`
--
ALTER TABLE `typeevent`
  ADD CONSTRAINT `choix_categ` FOREIGN KEY (`id_categ`) REFERENCES `categorie` (`id_categ`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `choix_evenement` FOREIGN KEY (`Event_id`) REFERENCES `event` (`Event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
