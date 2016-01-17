-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 17 Janvier 2016 à 22:13
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `numerorue`, `rue`, `ville`, `codepostal`, `pays`) VALUES
(1, 18, 'av pierre grenier', 'Viroflay', 78, 'France'),
(2, 0, 'hotel de ville', 'Paris', 75, 'France'),
(3, 0, 'hippodrome de longchamps', 'Paris', 75, 'France'),
(4, 0, 'domaine de saint cloud', 'saint-cloud', 75, 'France'),
(5, 104, 'rue charles laffitte', 'Neuilly', 92, 'France'),
(6, 12, 'rue de latour', 'Paris', 75, 'france'),
(7, 0, 'Champ de mars', 'Paris', 75, 'FRANCE'),
(8, 8, 'Boulevard de bercy', 'Paris', 75, 'France'),
(9, 12, 'rue de lavande', 'Antibes', 6600, 'France'),
(10, 104, 'rue charles laffitte', 'Neuilly', 92, 'France'),
(11, 2, 'rue notre dame des champs', 'Paris', 75, 'France'),
(12, 10, 'rue de vanves', 'Issy les moulineaux', 92, 'France');

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
(25, 'Costumes'),
(33, 'Concert'),
(35, 'Spectacle'),
(36, '-18'),
(37, 'Gastronomie');

-- --------------------------------------------------------

--
-- Structure de la table `cgu`
--

CREATE TABLE IF NOT EXISTS `cgu` (
  `id_paragraphe` int(11) NOT NULL,
  `titre_cgu` varchar(50) NOT NULL,
  `paragraphe_cgu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `commente`
--

INSERT INTO `commente` (`date_co`, `texte_co`, `id_commentaire`, `Event_id`, `id_utilisateur`) VALUES
('2016-01-17 18:19:19', 'Venez à cet événement, il a l''air génial !', 1, 24, 20),
('2016-01-17 21:39:51', 'J''ai hâte !!', 2, 27, 21);

-- --------------------------------------------------------

--
-- Structure de la table `confirmation_inscription`
--

CREATE TABLE IF NOT EXISTS `confirmation_inscription` (
  `id_conf` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_conf`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=733856202 ;

--
-- Contenu de la table `confirmation_inscription`
--

INSERT INTO `confirmation_inscription` (`id_conf`, `id_utilisateur`) VALUES
(7690430, 22),
(710357666, 21),
(733856201, 20);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`Event_id`, `description_e`, `Nom_e`, `date_e`, `prix`, `privacy`, `id_utilisateur`, `heuredebut`, `heurefin`, `nb_max_participant`, `id_adresse`, `date_f`) VALUES
(24, 'The Color Run™ est la course de 5 kilomètres la plus colorée du monde.<br />\r\nIl ne s''agit pas d''être le plus rapide ou de franchir la ligne d''arrivée en premier. Les mots d''ordre sont couleurs, amusement et plaisir !<br />\r\nEntouré de nombreux autres coureurs, tu vas vivre une journée exceptionnelle que tu n''es pas prêt d''oublier.', 'Color run Paris', '2016-05-27', 0, 0, 20, '09:30:00', '14:00:00', 0, 2, '0000-00-00'),
(25, 'Chaque année, les recettes du festival permettent d’accompagner et de soutenir les malades et leurs familles dans plus de 20 pays. Précarité, pauvreté grandissante, absence critique de structures de santé, manque de soins et de traitements : les malades du sida ont besoin d’aide. Continuons à les soutenir !<br />\r\n', 'solidays', '2016-06-26', 15, 0, 20, '16:00:00', '04:30:00', 2000, 3, '2016-06-29'),
(26, 'Créé en 2003, Visuel de la cartographie de Rock en Seine 2015Rock en Seine a lieu chaque dernier week-end d’août et s’impose aujourd’hui comme l’un des plus grands rendez-vous rock de l’été en France et compte au nombre des festivals incontournables d’Europe ! Il se déroule le dernier week-end d’août dans le Domaine national de Saint-Cloud, aux portes de Paris.<br />\r\n<br />\r\nLe festival réunit chaque année le meilleur de la scène pop &amp; rock internationale, des têtes d’affiches emblématiques aux découvertes le plus excitantes du moment. 5 scènes, installées au cœur d’un jardin à la française, accueillent les festivaliers dans un cadre champêtre, propice aux découvertes. Rock, pop, électro… toutes les branches du rock sont à Rock en Seine !', 'Rock en Seine', '2016-08-26', 115, 0, 20, '16:00:00', '04:30:00', 2000, 4, '2016-08-28'),
(27, 'Venez tous à l''anniversaire de vincent rojo', 'Anniversaire de Vincent', '2016-02-21', 0, 1, 20, '18:00:00', '06:00:00', 0, 5, '0000-00-00'),
(28, 'Venez tous prendre un pique-nique au champ de mars afin de profiter du beau temps ! <br />\r\n<br />\r\nUn moment à ne pas rater', 'Pique nique au champs de mars', '2016-06-06', 0, 0, 21, '11:00:00', '14:00:00', 0, 7, '0000-00-00'),
(29, 'Maître Gims, de son vrai nom Gandhi Djuna, est né le 6 mai 1986 à Kinshasa (RDC), est un rappeur, chanteur et compositeur congolais1.<br />\r\n<br />\r\nIl est issu d''une famille de musiciens, son père était un chanteur du groupe Viva La Musica de Papa Wemba et il a des frères rappeurs. Membre du groupe Sexion d''Assaut, il sort son premier album solo Subliminal en 2013. L''album connaît un succès commercial avec plus de 1 000 000 d''exemplaires vendus', 'Concert de maitre gims', '2016-03-18', 62, 0, 21, '20:00:00', '23:00:00', 25000, 8, '0000-00-00'),
(30, 'Venez tous chez Roger ! C''est une barbecue party ouverte à tous amenez juste une saucisse et une bière et vous serez le bienvenue ! ', 'Barbecue chez Roger', '2016-04-27', 0, 0, 21, '10:00:00', '15:00:00', 0, 9, '0000-00-00'),
(31, 'Venez participer au cours de hip hop avec comme professeur, VINCENT ROJO !! <br />\r\n<br />\r\nIl vous apprendra ses meilleurs moves tirés des meilleures séries de danse espagnoles.', 'Cours de hip hop', '2016-01-20', 0, 0, 22, '16:00:00', '18:30:00', 30, 11, '0000-00-00'),
(32, 'Soutenance d''APP du groupe G1B. Nous présenterons notre site internet SimplEvent. Un site de création et de partage d''événements à vocation internationale.<br />\r\n<br />\r\nSimplEvent est un site facile d''utilisation, il s''agit de l''outil le plus simple permettant de partager des événements. ', 'Soutenance APP', '2016-01-18', 0, 0, 22, '14:30:00', '16:00:00', 6, 12, '0000-00-00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `multimedia`
--

INSERT INTO `multimedia` (`id_multimediaevent`, `principale`, `Event_id`, `urlvid_event`, `urlsite_event`, `urlimg_event`) VALUES
(1, 0, 24, NULL, 'http://thecolorrun.fr/', NULL),
(2, 1, 24, NULL, NULL, '../reste/photo_event/e4e1c-zoom-galerie3-4.jpg'),
(3, 0, 24, NULL, NULL, '../reste/photo_event/09638-20150531_MOREL_MG_6294_HD_TheColorRunNancy.jpg'),
(4, 0, 24, NULL, NULL, '../reste/photo_event/cdfe6-zoom-galerie3-1.jpg'),
(5, 0, 25, NULL, 'http://www.solidays.org', NULL),
(6, 1, 25, NULL, NULL, '../reste/photo_event/ASF2600Â©Anne_Sophie_Fremy.jpg'),
(7, 0, 25, NULL, NULL, '../reste/photo_event/Solidays2015-1953-Â©AmelieLaurin.jpg'),
(8, 0, 25, NULL, NULL, '../reste/photo_event/ASF1165Â©Anne_Sophie_Fremy.jpg'),
(9, 0, 26, NULL, 'http://www.rockenseine.com/billetterie/', NULL),
(10, 1, 26, NULL, NULL, '../reste/photo_event/VP2_7163RES-1024x683.jpg'),
(11, 0, 26, NULL, NULL, '../reste/photo_event/VP2_5828RES.jpg'),
(12, 0, 26, NULL, NULL, '../reste/photo_event/Kasabian-cOlivier-Hoffschir-111-1024x681.jpg'),
(13, 1, 27, NULL, NULL, '../reste/photo_event/10600452_10204501765731612_4770971883296226552_n.jpg'),
(14, 1, 28, NULL, NULL, '../reste/photo_event/pic-nic-paris-2.jpg'),
(15, 0, 29, NULL, 'http://www.maitre-gims.fr/2302-tournee-concerts-warano-tour-2015', NULL),
(16, 1, 29, NULL, NULL, '../reste/photo_event/tournee-maitre-gims.jpg'),
(17, 0, 29, NULL, NULL, '../reste/photo_event/photo.jpg'),
(18, 1, 30, NULL, NULL, '../reste/photo_event/folding-grill-rack1.jpg'),
(19, 1, 31, NULL, NULL, '../reste/photo_event/hip-hop.png'),
(20, 1, 32, NULL, NULL, '../reste/photo_event/Logomini.png');

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
(20, 24, 4),
(21, 27, NULL),
(21, 29, NULL),
(22, 31, 5),
(22, 32, 5);

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

--
-- Contenu de la table `preference`
--

INSERT INTO `preference` (`id_utilisateur`, `id_categ`) VALUES
(21, 33),
(20, 35),
(22, 35),
(21, 36);

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
  `id_topic` int(11) DEFAULT NULL,
  `id_msgforum` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `sponsor`
--

INSERT INTO `sponsor` (`idSponsor`, `NomSponsor`, `img_sponsor`) VALUES
(2, '', 'http://thecolorrun.fr/uploads/logos/480x260_57bcf-partner-2.png'),
(3, '', 'http://thecolorrun.fr/uploads/logos/480x260_00000-partner-1.png'),
(4, '', 'http://www.solidays.org/wp-content/uploads/2013/02/idf.jpg'),
(5, '', 'http://www.solidays.org/wp-content/uploads/2013/02/banque_postale1.jpg'),
(6, '', 'http://www.solidays.org/wp-content/uploads/2015/05/Europcar.jpg'),
(7, '', 'http://www.rockenseine.com/wp-content/uploads/2013/04/logo_ratp.png'),
(8, '', 'http://www.rockenseine.com/wp-content/uploads/2013/04/logo_saintcloud.png'),
(9, '', 'http://www.rockenseine.com/wp-content/uploads/2013/04/logo_spotify.png'),
(10, '', 'http://assets.nrj.fr/nrj/latest/img/nrj.svg'),
(11, '', 'https://upload.wikimedia.org/wikipedia/fr/4/47/Isep-Logo.png');

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

--
-- Contenu de la table `sponsorise`
--

INSERT INTO `sponsorise` (`Event_id`, `idSponsor`) VALUES
(24, 2),
(24, 3),
(25, 4),
(25, 5),
(25, 6),
(26, 7),
(26, 8),
(26, 9),
(29, 10),
(32, 11);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `sujet`
--

INSERT INTO `sujet` (`id_topic`, `id_utilisateur`, `sujet`, `text_s`, `date_s`) VALUES
(1, 20, 'Premier topic', 'Bonjour, bienvenu sur le forum !', '2016-01-17 18:45:26');

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
(26, 33),
(29, 33),
(25, 35),
(26, 35),
(32, 35),
(27, 36),
(28, 37),
(30, 37);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_u`, `prenom_u`, `date_de_naissance`, `description`, `photo_u`, `mail`, `telephone`, `mot_de_passe`, `sexe`, `admin`, `id_adresse`, `confirmation_inscription`, `conf_mod_prof`) VALUES
(17, 'inactif', 'Compte', '0000-00-00', 'Cet utilisateur n''existe plus.', '../reste/photo_profil/bvert.png', 'sitesimplevent@gmail.com', 0, '', NULL, NULL, 0, 0, 0),
(20, 'Batier', 'Olivier', '1995-07-31', 'Bonjour, je m''appelle Olivier, j''aime beaucoup le cinéma et les sorties entre amis. <br />\r\n', '../reste/photo_profil/photo.jpg', 'olivierbatier@gmail.com', 650852765, 'douze', 1, 1, 1, 1, 1),
(21, 'Latour', 'Antoine', '2000-02-22', 'SAlut moi c''est antoine latour envoie moi un message si tu veux chatter !', '../reste/photo_profil/12063310_1037537786277911_8204774670410633359_n.jpg', 'ntnlatour@gmail.com', 123456789, 'testdeco', 1, NULL, 6, 1, 1),
(22, 'Rojo', 'Vincent', '1994-02-21', 'YOYOYOYO ROJO DANS LA PLACE !! <br />\r\n', '../reste/photo_profil/10600452_10204501765731612_4770971883296226552_n.jpg', 'vin.rojo@gmail.com', 234687987, 'Rojo', 1, NULL, 5, 1, 1);

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
