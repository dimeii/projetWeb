-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 23 mars 2019 à 00:23
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `picsuru`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `idComm` int(255) NOT NULL AUTO_INCREMENT,
  `commentaire` text NOT NULL,
  `idImg` int(255) NOT NULL,
  `idUser` int(255) NOT NULL,
  PRIMARY KEY (`idComm`),
  KEY `comm_idImg` (`idImg`),
  KEY `comm_idUser` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`idComm`, `commentaire`, `idImg`, `idUser`) VALUES
(3, 'Nice flag :) ', 15, 3),
(4, 'azerty', 15, 3),
(5, 'c\'est vrai :)', 15, 3),
(6, 'Merci beaucoup :)', 15, 7),
(7, 'Ele augmentera surement après l\'arc à Wano ;)', 16, 7),
(8, 'Puis-je avoir des renseignements ?', 14, 7),
(9, 'Je vous relance ', 14, 7),
(10, 'Je vous relance, c\'est pour mon bateau...', 14, 7);

-- --------------------------------------------------------

--
-- Structure de la table `img`
--

DROP TABLE IF EXISTS `img`;
CREATE TABLE IF NOT EXISTS `img` (
  `idImage` int(255) NOT NULL AUTO_INCREMENT,
  `titre` varchar(1024) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `nbLike` int(11) NOT NULL,
  `date` date NOT NULL,
  `path` varchar(2048) NOT NULL,
  `idUser` int(255) NOT NULL,
  PRIMARY KEY (`idImage`),
  KEY `IMG_idUser_TO_User_idUser` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `img`
--

INSERT INTO `img` (`idImage`, `titre`, `description`, `nbLike`, `date`, `path`, `idUser`) VALUES
(9, 'testIsuru', 'izuku', 4, '2019-03-21', '../_images/deku.png', 1),
(10, 'all might', 'All might qui va casser du mÃ©chant', 2, '2019-03-21', '../_images/all might.png', 1),
(14, 'destockAuto', 'destock auto', 1, '2019-03-22', '../_images/background_destock3.png', 6),
(15, 'me and my flag', 'Avec le drapeau du roi des pirates', 2, '2019-03-22', '../_images/luffy+flag.jpg', 7),
(16, 'Ma nouvelle pime', 'Voici ma nouvelle prime ^^', 1, '2019-03-22', '../_images/primeLuffy.jpg', 7),
(18, 'Galaxy cat', 'Une chat-laxy', 0, '2019-03-22', '../_images/cat.jpg', 3),
(24, 'Mon ami deadpool', 'Une photo badass de mon ami deadpool', 0, '2019-03-22', '../_images/deadpool.jpg', 3),
(29, 'cellphone', 'Telephone', 0, '2019-03-23', '../_images/contact-bg.jpg', 7),
(30, 'book of the week', 'This is the book i am reading this week', 0, '2019-03-23', '../_images/home-bg.jpg', 7),
(31, 'book of the week', 'This is the book i am reading this week', 0, '2019-03-23', '../_images/home-bg.jpg', 7);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `idUser` int(255) NOT NULL,
  `idImg` int(255) NOT NULL,
  KEY `contraintesUsers` (`idUser`),
  KEY `contrainteImg` (`idImg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`idUser`, `idImg`) VALUES
(7, 16),
(7, 14),
(3, 15),
(7, 10),
(7, 15);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `idTag` int(255) NOT NULL AUTO_INCREMENT,
  `tag` text NOT NULL,
  PRIMARY KEY (`idTag`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`idTag`, `tag`) VALUES
(1, '#cat'),
(2, '#cut'),
(3, '#badass'),
(4, '#blade'),
(9, '#picOfTheDay'),
(10, '#book'),
(11, '#redaing');

-- --------------------------------------------------------

--
-- Structure de la table `tagimg`
--

DROP TABLE IF EXISTS `tagimg`;
CREATE TABLE IF NOT EXISTS `tagimg` (
  `idTag` int(11) NOT NULL,
  `idImg` int(11) NOT NULL,
  KEY `idtag_idtag` (`idTag`),
  KEY `idImg_idImg` (`idImg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tagimg`
--

INSERT INTO `tagimg` (`idTag`, `idImg`) VALUES
(3, 24),
(4, 24),
(9, 29),
(10, 30),
(11, 30),
(10, 31),
(11, 31);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(255) NOT NULL AUTO_INCREMENT,
  `nomArtist` varchar(20) NOT NULL,
  `mdp` varchar(1024) NOT NULL,
  `mail` varchar(500) NOT NULL,
  `bio` text,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `nomArtist`, `mdp`, `mail`, `bio`) VALUES
(1, 'dimeii', 'mdp3', 'mail2@gmail.com', 'test bio2'),
(2, 'artist2', 'test', 'test@tes.com', NULL),
(3, 'artist1', 'test', 'test@tes.com', NULL),
(4, 'artist2', 'test', 'test@tes.com', NULL),
(5, 'artist3', 'test', 'artist3@gmail.com', 'je suis l\'artist 3'),
(6, 'artist4', 'test', 'ceci est ma biographie', 'ceci est ma biographie'),
(7, 'luffy', 'onepiece', 'je serai le roi des pirates !!', 'je serai le roi des pirates !!'),
(8, 'profAIR1', 'air1', 'aaa', 'aaa'),
(9, 'zorro', 'katana', 'Je suis l\'épeiste de l\'équipage au chapeau de paille', 'Je suis l\'épeiste de l\'équipage au chapeau de paille');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `comm_idImg` FOREIGN KEY (`idImg`) REFERENCES `img` (`idImage`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comm_idUser` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `img`
--
ALTER TABLE `img`
  ADD CONSTRAINT `IMG_idUser_TO_User_idUser` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `contrainteImg` FOREIGN KEY (`idImg`) REFERENCES `img` (`idImage`),
  ADD CONSTRAINT `contraintesUsers` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tagimg`
--
ALTER TABLE `tagimg`
  ADD CONSTRAINT `idImg_idImg` FOREIGN KEY (`idImg`) REFERENCES `img` (`idImage`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idtag_idtag` FOREIGN KEY (`idTag`) REFERENCES `tag` (`idTag`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
