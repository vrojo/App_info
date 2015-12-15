-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 15 Décembre 2015 à 09:08
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
  `texte_co` text NOT NULL,
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `Event_id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_commentaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `commente`
--

INSERT INTO `commente` (`date_co`, `texte_co`, `id_commentaire`, `Event_id`, `id_utilisateur`) VALUES
('0000-00-00 00:00:00', 'heello', 1, 1, 7),
('0000-00-00 00:00:00', 'La musique Ã©tait top ! Je like !', 2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `Event_id` int(11) NOT NULL AUTO_INCREMENT,
  `description_e` text NOT NULL,
  `Nom_e` varchar(45) NOT NULL,
  `date_e` date NOT NULL,
  `prix` float DEFAULT NULL,
  `privacy` int(11) DEFAULT NULL,
  `id_utilisateur` int(10) unsigned DEFAULT NULL,
  `heuredebut` time NOT NULL,
  `heurefin` time DEFAULT NULL,
  `nb_max_participant` int(11) DEFAULT NULL,
  `id_adresse` int(11) NOT NULL,
  PRIMARY KEY (`Event_id`),
  KEY `id_utilisateur_idx` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `expedie`
--

CREATE TABLE IF NOT EXISTS `expedie` (
  `idmessage` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) NOT NULL,
  `text` text NOT NULL,
  `destinataire` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idmessage`),
  KEY `id_utilisateur_idx` (`destinataire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `multimedia`
--

CREATE TABLE IF NOT EXISTS `multimedia` (
  `id_multimediaevent` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_utilisateur` int(10) unsigned NOT NULL,
  `Event_id` int(11) NOT NULL,
  `Commentaire` text,
  `Note` int(11) DEFAULT NULL,
  PRIMARY KEY (`Event_id`,`id_utilisateur`),
  KEY `id_utilisateur_idx` (`id_utilisateur`),
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
-- Structure de la table `recoit`
--

CREATE TABLE IF NOT EXISTS `recoit` (
  `idmessage` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) NOT NULL,
  `text` text NOT NULL,
  `expediteur` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idmessage`),
  KEY `id_utilisateur_idx` (`expediteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `commentaire_r` varchar(255) NOT NULL,
  `id_utilisateur` int(10) unsigned NOT NULL,
  `sujet` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`commentaire_r`),
  KEY `id_utilisateur_idx` (`id_utilisateur`),
  KEY `sujet_idx` (`sujet`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sponsor`
--

CREATE TABLE IF NOT EXISTS `sponsor` (
  `idSponsor` int(11) NOT NULL AUTO_INCREMENT,
  `NomSponsor` varchar(45) NOT NULL,
  PRIMARY KEY (`idSponsor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `text_s` text NOT NULL,
  `sujet` varchar(45) NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`sujet`),
  KEY `id_utilisateur_idx` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `photo_u` varchar(255) DEFAULT NULL,
  `mail` varchar(255) NOT NULL,
  `telephone` int(15) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `sexe` int(2) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `id_adresse` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_u`, `prenom_u`, `date_de_naissance`, `description`, `photo_u`, `mail`, `telephone`, `mot_de_passe`, `sexe`, `admin`, `id_adresse`) VALUES
(1, 'Latour', 'Antoine', '1996-01-19', 'élève ISEP', NULL, 'antoine.latour@free.fr', 642969558, 'testdeco', 1, 1, 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `createur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `expedie`
--
ALTER TABLE `expedie`
  ADD CONSTRAINT `expediteur0` FOREIGN KEY (`destinataire`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `participant` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `preference`
--
ALTER TABLE `preference`
  ADD CONSTRAINT `choix_pref` FOREIGN KEY (`id_categ`) REFERENCES `categorie` (`id_categ`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `choix_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `recoit`
--
ALTER TABLE `recoit`
  ADD CONSTRAINT `expediteur` FOREIGN KEY (`expediteur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `repondant` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `titre_sujet` FOREIGN KEY (`sujet`) REFERENCES `sujet` (`sujet`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `sponsorise`
--
ALTER TABLE `sponsorise`
  ADD CONSTRAINT `evenement_sponsorise` FOREIGN KEY (`Event_id`) REFERENCES `event` (`Event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sponsor` FOREIGN KEY (`idSponsor`) REFERENCES `sponsor` (`idSponsor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD CONSTRAINT `createur_sujet` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `typeevent`
--
ALTER TABLE `typeevent`
  ADD CONSTRAINT `choix_categ` FOREIGN KEY (`id_categ`) REFERENCES `categorie` (`id_categ`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `choix_evenement` FOREIGN KEY (`Event_id`) REFERENCES `event` (`Event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
