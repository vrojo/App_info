-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 09 Janvier 2016 à 02:31
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `numerorue`, `rue`, `ville`, `codepostal`, `pays`) VALUES
(1, 12, 'rue de la paix', 'Paris', 75000, 'FRANCE'),
(2, 12, 'Rue de latour', 'Paris', 75, 'FRance');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `commente`
--

INSERT INTO `commente` (`date_co`, `texte_co`, `id_commentaire`, `Event_id`, `id_utilisateur`) VALUES
('2015-12-22 17:59:42', 'Yop ?! &lt;strong&gt; JES SUIS MECHANT &lt;/script&gt;', 12, 1, 7),
('2015-12-22 18:00:13', '&lt;strong&gt;je me suis plantÃ© dans les balises au dessus &lt;/strong&gt;', 13, 1, 7),
('2015-12-22 21:39:55', 'nice', 15, 1, 7),
('2015-12-24 15:10:42', 'test CharactÃ¨res spÃ©ciaux azertyuiop^$*Ã¹mlkjhgfdsqqwxcvbn,;:!=)Ã Ã§_Ã¨-(''&quot;Ã©&amp;1234567890Â°]@^\\`|[{#', 17, 1, 7),
('2015-12-24 16:44:48', 'Hello', 19, 1, 1),
('2016-01-06 12:31:30', 'kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 27, 1, 7),
('2016-01-08 16:20:30', 'kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 29, 1, 7),
('2016-01-08 16:40:14', 'kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 30, 1, 7),
('2016-01-08 20:19:31', 'https://www.youtube.com/watch?v=Qc9c12q3mrc', 31, 1, 7),
('2016-01-09 02:14:49', 'Cool\r\n', 32, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`Event_id`, `description_e`, `Nom_e`, `date_e`, `prix`, `privacy`, `id_utilisateur`, `heuredebut`, `heurefin`, `nb_max_participant`, `id_adresse`, `date_f`) VALUES
(1, 'Rock en Seine est un événement de Rock qui se produit tous les ans dans le parc de saint Cloud près de Paris. De nombreux artistes reconnus viennent y jouer mais d''autres moins populaires sont aussi présents.', 'Rock en Seine', '2015-12-09', 12, 1, 7, '00:00:00', '00:00:00', 2000, 1, '2016-01-08');

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
  PRIMARY KEY (`id_message`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `messagerie`
--

INSERT INTO `messagerie` (`id_message`, `sujet`, `texte`, `id_destinataire`, `id_expediteur`, `nom_destinataire`, `nom_expediteur`) VALUES
(1, 'YO', 'lkkndzkjnd', 1, 0, 'Antoine', 'Olivier'),
(2, 'WOLOLO', 'WOLOLO', 7, 1, 'Olivier', 'Antoine'),
(3, 'RE :WOLOLO', 'Nice', 1, 0, 'Antoine', 'Olivier'),
(4, 'RE :WOLOLO', 'Wolololo', 1, 0, 'Antoine', 'Olivier'),
(5, 'RE :RE :WOLOLO', 'PD', 7, 1, 'Olivier', 'Antoine'),
(6, 'RE :RE :RE :WOLOLO', 'PD', 1, 7, 'Antoine', 'Olivier');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `multimedia`
--

INSERT INTO `multimedia` (`id_multimediaevent`, `principale`, `Event_id`, `urlvid_event`, `urlsite_event`, `urlimg_event`) VALUES
(1, 1, 1, NULL, NULL, 'http://www.rockenseine.com/wp-content/uploads/2015/09/VP2_7163RES-1024x683.jpg');

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

--
-- Contenu de la table `participation`
--

INSERT INTO `participation` (`id_participant`, `Event_id`, `Note`) VALUES
(1, 1, 4),
(7, 1, 3),
(8, 1, 3);

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
-- Structure de la table `relation_amicale`
--

CREATE TABLE IF NOT EXISTS `relation_amicale` (
  `id_utilisateur` int(11) NOT NULL,
  `id_ami` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_ami`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `relation_amicale`
--

INSERT INTO `relation_amicale` (`id_utilisateur`, `id_ami`) VALUES
(1, 7),
(7, 1);

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

--
-- Contenu de la table `typeevent`
--

INSERT INTO `typeevent` (`Event_id`, `id_categ`) VALUES
(1, 33);

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
  `photo_u` varchar(255) DEFAULT '../reste/bvert.png',
  `mail` varchar(255) NOT NULL,
  `telephone` int(15) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `sexe` int(2) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `id_adresse` int(11) NOT NULL,
  `confirmation_inscription` int(2) NOT NULL,
  `conf_mod_prof` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_u`, `prenom_u`, `date_de_naissance`, `description`, `photo_u`, `mail`, `telephone`, `mot_de_passe`, `sexe`, `admin`, `id_adresse`, `confirmation_inscription`, `conf_mod_prof`) VALUES
(1, 'Latour', 'Antoine', '1222-12-12', 'Je suis antoine latour', '../reste/bvert.png', 'antoine.latour@free.fr', 1, 'testdeco', 1, 0, 2, 1, 1),
(2, 'Client', 'Compte', '2015-12-25', 'Wallah mon frère je suis un compte client', NULL, 'compte.client@Simplevent.fr', 0, 'compteclient', NULL, 0, 0, 1, 0),
(7, 'Batier', 'Olivier', '1995-07-31', 'WOLOLO', 'https://scontent-cdg2-1.xx.fbcdn.net/hphotos-frc3/v/t1.0-9/933950_496057963811856_554254439_n.jpg?oh=ccfeffaa9edbdc12d85d73df9755fe0e&oe=57204D3A', 'olivierbatier@gmail.com', 12345678, 'douze', 1, 1, 7, 1, 1),
(8, '', '', '0000-00-00', '', NULL, 'ntnlatour@gmail.com', 0, 'mdp', NULL, 0, 0, 1, 0),
(11, '', '', '0000-00-00', '', NULL, 'wololo@wololo.com', 0, 'wololo', NULL, NULL, 0, 0, 0),
(12, '', '', '0000-00-00', '', NULL, 'wololo@wololo.com', 0, 'wololo', NULL, NULL, 0, 0, 0),
(13, '', '', '0000-00-00', '', NULL, 'Allah@gmail.com', 0, 'Jesus', NULL, NULL, 0, 0, 0),
(14, '', '', '0000-00-00', '', '../reste/bvert.png', 'vin.rojo@gmail.com', 0, 'rojo', NULL, NULL, 0, 0, 0);

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
  ADD CONSTRAINT `participant` FOREIGN KEY (`id_participant`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
