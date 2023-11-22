-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 26 oct. 2023 à 05:49
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hrmanage`
--

-- --------------------------------------------------------

--
-- Structure de la table `conger_gagner`
--

DROP TABLE IF EXISTS `conger_gagner`;
CREATE TABLE IF NOT EXISTS `conger_gagner` (
  `id` int NOT NULL,
  `em_id` varchar(64) DEFAULT NULL,
  `present_date` varchar(64) DEFAULT NULL,
  `hour` varchar(64) DEFAULT NULL,
  `status` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `conger_gagner`
--

INSERT INTO `conger_gagner` (`id`, `em_id`, `present_date`, `hour`, `status`) VALUES
(26, 'Mir1685', '0', '0', '1'),
(27, 'Rah1682', '0', '0', '1'),
(28, 'edr1432', '0', '0', '1');

-- --------------------------------------------------------

--
-- Structure de la table `demande_conger`
--

DROP TABLE IF EXISTS `demande_conger`;
CREATE TABLE IF NOT EXISTS `demande_conger` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code_em` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type_conger` varchar(64) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `duree_conger` float DEFAULT NULL,
  `date_demande` date DEFAULT NULL,
  `img_reason` varchar(1024) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status_conger` enum('En attente','Accepter','Rejeter') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'En attente',
  PRIMARY KEY (`id`),
  KEY `demande_conger_ibfk_4` (`type_conger`),
  KEY `code_em` (`code_em`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `demande_conger`
--

INSERT INTO `demande_conger` (`id`, `code_em`, `type_conger`, `date_debut`, `date_fin`, `duree_conger`, `date_demande`, `img_reason`, `status_conger`) VALUES
(1, 'T003', 'Maladie', '2023-10-28', '0000-00-00', 0.5, '2023-10-26', 'images1.jpeg', 'En attente'),
(2, 'T002', 'Avec solde', '2023-10-30', '0000-00-00', 1, '2023-10-26', NULL, 'En attente'),
(3, 'T003', 'Avec solde', '2023-10-28', '0000-00-00', 1, '2023-10-26', 'IMG_0638.JPG', 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `id_dep` int NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_dep`),
  UNIQUE KEY `dep_name` (`dep_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id_dep`, `dep_name`) VALUES
(1, 'Direction'),
(2, 'Finance'),
(3, 'Informatique'),
(7, 'Logistique'),
(4, 'Marketing'),
(5, 'Production'),
(6, 'RH');

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `password_again` varchar(150) NOT NULL,
  `role` varchar(20) NOT NULL,
  `creer_le` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `password_again`, `role`, `creer_le`) VALUES
(1, 'admin@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', '2023-10-09 16:37:03'),
(2, 'admin@test2.com', '0192023a7bbd73250516f069df18b500', '0192023a7bbd73250516f069df18b500', 'Admin', '2023-10-09 15:36:28'),
(3, 'admin@telesourcia.com', '4607e782c4d86fd5364d7e4508bb10d9', '4607e782c4d86fd5364d7e4508bb10d9', 'Super_Admin', '2023-10-09 15:39:38'),
(4, 'mahenina@gmail.com', '63a9f0ea7bb98050796b649e85481845', '63a9f0ea7bb98050796b649e85481845', 'Employer', '2023-10-09 15:45:23'),
(5, 'mahenina@gmail.com', '63a9f0ea7bb98050796b649e85481845', '63a9f0ea7bb98050796b649e85481845', 'Employer', '2023-10-09 15:45:29'),
(6, 'Philippe@gmail.com', '7e31452f98a4c3935c54ee6a8913a632', '7e31452f98a4c3935c54ee6a8913a632', 'Super_Admin', '2023-10-10 02:47:02'),
(7, 'razakatiambolaphillipe@gmail.com', '2bf1f1e5cace10173e6d219ec177b1b5', '2bf1f1e5cace10173e6d219ec177b1b5', 'Super_Admin', '2023-10-10 05:37:13'),
(8, 'test@gmail.com', 'e40f01afbb1b9ae3dd6747ced5bca532', 'e40f01afbb1b9ae3dd6747ced5bca532', 'Super_Admin', '2023-10-10 09:54:04'),
(9, 'test2@gmail.com', '9ae2be73b58b565bce3e47493a56e26a', '9ae2be73b58b565bce3e47493a56e26a', 'Admin', '2023-10-10 10:00:09'),
(10, 'Anjary@gmail.com', 'cb37d40f686d922033e4379f579fa0d9', 'cb37d40f686d922033e4379f579fa0d9', 'Super_Admin', '2023-10-12 02:42:00');

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code_em` varchar(100) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `prenom` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `date_nais` date NOT NULL,
  `contact` int NOT NULL,
  `sexe` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `departement` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `post` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `date_creation` datetime NOT NULL,
  `status` enum('actif','inactif') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code_em`),
  KEY `personnel_ibfk_1` (`departement`),
  KEY `personnel_ibfk_2` (`post`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id`, `code_em`, `nom`, `prenom`, `email`, `password`, `adresse`, `date_nais`, `contact`, `sexe`, `departement`, `post`, `role`, `date_creation`, `status`) VALUES
(10, 'T001', 'RAZAKATIAMBOLA', 'Mahenina', 'razakatiambolaphillipe@gmail.com', 'philux', 'Mahamasina 101', '2004-05-29', 342205018, 'homme', 'Informatique', 'Developpeur', 'Admin', '2023-10-24 10:23:00', 'actif'),
(11, 'T002', 'RAZAKAMIHARIMBOLA', 'Mahafaly', 'razakamiharimbolaphillipe@gmail.com', 'mahafaly', 'Fianarantsoa 301', '1997-01-14', 347443255, 'homme', 'Production', 'Directeur des Operations', 'Admin', '2023-10-24 10:26:00', 'actif'),
(14, 'T003', 'Niaina', 'Razafindrabe', 'admin@telesourcia.com', 'admin123', 'Mahamasina', '2000-04-12', 342205018, 'homme', 'Direction', 'Developpeur', 'Super_Admin', '2023-10-24 10:53:00', 'actif'),
(15, 'T004', 'test', 'Philippe', 'admin@test.com', '123456', 'Mahamasina', '1999-04-23', 342205018, 'homme', 'Finance', 'Developpeur', 'Super_Admin', '2023-10-25 11:56:00', 'actif');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `design` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_post`),
  UNIQUE KEY `design` (`design`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `design`) VALUES
(9, 'Administrateur système et reseau'),
(17, 'Agents'),
(18, 'ARH'),
(6, 'Assistant administratif et financier'),
(11, 'Assistant commercial'),
(7, 'Assistante Administrative et Comptable'),
(20, 'Assistante de Direction'),
(13, 'Chefs de projet'),
(14, 'Developpeur'),
(5, 'Directeur Administratif et Financier'),
(3, 'Directeur de Ressources Humaines'),
(12, 'Directeur des Operations'),
(2, 'Directeur géneral'),
(4, 'Directeur Marketing et Commercial'),
(1, 'Opérateur Anglophone'),
(16, 'QC'),
(8, 'Responsable IT'),
(21, 'Responsable logistique'),
(22, 'Stagiaire'),
(10, 'Technicien Develloppeur'),
(15, 'TL'),
(19, 'WFM');

-- --------------------------------------------------------

--
-- Structure de la table `solde_conger`
--

DROP TABLE IF EXISTS `solde_conger`;
CREATE TABLE IF NOT EXISTS `solde_conger` (
  `id_solde` int NOT NULL AUTO_INCREMENT,
  `em_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nbr_jrs` float NOT NULL,
  `date_dernier_mise_jrs` datetime NOT NULL,
  `solde_actuel` float NOT NULL,
  PRIMARY KEY (`id_solde`),
  KEY `solde_conger_ibfk_1` (`em_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `solde_conger`
--

INSERT INTO `solde_conger` (`id_solde`, `em_id`, `nbr_jrs`, `date_dernier_mise_jrs`, `solde_actuel`) VALUES
(1, 'T001', 2.5, '2023-10-24 10:23:00', 2.5),
(2, 'T002', 2.5, '2023-10-24 10:26:00', 2.5),
(5, 'T003', 2.5, '2023-10-24 10:53:00', 2.5),
(6, 'T004', 2.5, '2023-10-25 11:56:00', 2.5);

-- --------------------------------------------------------

--
-- Structure de la table `type_conger`
--

DROP TABLE IF EXISTS `type_conger`;
CREATE TABLE IF NOT EXISTS `type_conger` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` enum('Ouvert','Indisposé') NOT NULL DEFAULT 'Ouvert',
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_conger`
--

INSERT INTO `type_conger` (`type_id`, `nom`, `status`) VALUES
(1, 'Avec solde', 'Ouvert'),
(2, 'Sans solde', 'Ouvert'),
(3, 'Maladie', 'Ouvert'),
(4, 'Exceptionnel', 'Ouvert');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `demande_conger`
--
ALTER TABLE `demande_conger`
  ADD CONSTRAINT `demande_conger_ibfk_4` FOREIGN KEY (`type_conger`) REFERENCES `type_conger` (`nom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `demande_conger_ibfk_5` FOREIGN KEY (`code_em`) REFERENCES `personnel` (`code_em`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `personnel_ibfk_1` FOREIGN KEY (`departement`) REFERENCES `departement` (`dep_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personnel_ibfk_2` FOREIGN KEY (`post`) REFERENCES `post` (`design`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `solde_conger`
--
ALTER TABLE `solde_conger`
  ADD CONSTRAINT `solde_conger_ibfk_1` FOREIGN KEY (`em_id`) REFERENCES `personnel` (`code_em`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
