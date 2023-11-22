-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 22 nov. 2023 à 09:10
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
  `type_conger` varchar(64) CHARACTER SET latin1 NOT NULL,
  `exceptionnel` varchar(64) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `duree_conger` float DEFAULT NULL,
  `date_demande` date DEFAULT NULL,
  `reason` varchar(255) NOT NULL,
  `img_reason` varchar(1024) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status_conger` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `demande_conger_ibfk_4` (`type_conger`),
  KEY `code_em` (`code_em`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `demande_conger`
--

INSERT INTO `demande_conger` (`id`, `code_em`, `type_conger`, `exceptionnel`, `date_debut`, `date_fin`, `duree_conger`, `date_demande`, `reason`, `img_reason`, `status_conger`) VALUES
(1, 'T0002', 'Sans solde', '', '2023-11-14', '0000-00-00', 1, '2023-11-13', 'Vacance', 'undefined', 'Accepter'),
(2, 'T0002', 'Maladie', '', '2023-11-21', '2023-11-24', 3, '2023-11-20', 'Mot de tête ', '367641285_1383726332564276_6712885282223857350_n.jpg', 'Rejeter'),
(3, 'T0002', 'Sans solde', '', '2023-11-21', '0000-00-00', 1, '2023-11-20', '', 'undefined', 'Rejeter');

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
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id_notif` int NOT NULL AUTO_INCREMENT,
  `id_conger` int NOT NULL,
  `code_em` varchar(100) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `status_conger` varchar(25) NOT NULL,
  `duree_conger` float NOT NULL,
  `date_notification` date NOT NULL,
  `date_debut` date NOT NULL,
  `etat` varchar(10) NOT NULL,
  PRIMARY KEY (`id_notif`),
  KEY `id_conger` (`id_conger`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id_notif`, `id_conger`, `code_em`, `nom`, `prenom`, `status_conger`, `duree_conger`, `date_notification`, `date_debut`, `etat`) VALUES
(1, 1, 'T0002', 'test', 'test', 'Accepter', 1, '2023-11-13', '2023-11-14', 'non lu'),
(2, 2, 'T0002', 'test', 'test', 'Rejeter', 3, '2023-11-20', '2023-11-21', 'non lu'),
(3, 3, 'T0002', 'test', 'test', 'Rejeter', 1, '2023-11-20', '2023-11-21', 'non lu');

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
  `CIN` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `contact` int NOT NULL,
  `contact_proche` int DEFAULT NULL,
  `sexe` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `departement` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `post` varchar(100) NOT NULL,
  `contrats` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  `date_creation` date NOT NULL,
  `status` enum('actif','inactif') NOT NULL,
  `profil` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code_em`),
  KEY `departement` (`departement`),
  KEY `post` (`post`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id`, `code_em`, `nom`, `prenom`, `email`, `password`, `adresse`, `date_nais`, `CIN`, `contact`, `contact_proche`, `sexe`, `departement`, `post`, `contrats`, `role`, `date_creation`, `status`, `profil`) VALUES
(2, 'T0002', 'test', 'test', 'admin@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'Mahamasina', '2023-11-03', '20423526485', 384777400, 345481064, 'homme', 'Finance', 'Directeur Administratif et Financier', 'CDI', 'Employer', '2023-11-04', 'actif', NULL),
(4, 'T0003', 'ERIC', 'Liza', 'liza@gmail.com', '24f6e3dc1bbc5a5dfb1e5c6481b94eb7', 'Mahamasina', '1994-12-02', '205019157054', 342205019, 345484687, 'homme', 'Finance', 'Chefs de projet', 'CDD', 'Admin', '2023-11-03', 'actif', NULL),
(5, 'T0001', 'Mahenina', 'Philippe', 'razakatiambolaphillipe@gmail.com', 'e6258a92190d674138112e7df30bbc8f', 'Fianarantsoa 301', '2004-05-29', '205011157032', 342205018, 345481064, 'homme', 'Informatique', 'Stagiaire', 'CDD', 'Admin', '2023-11-06', 'actif', NULL),
(6, 'T0004', 'Danielson', 'Sitrakiniaina', 'admin@telesourcia.com', '0192023a7bbd73250516f069df18b500', 'Fianarantsoa', '2003-11-10', '205011145789', 342205025, 331524878, 'homme', 'Informatique', 'Stagiaire', 'CDI', 'Super_Admin', '2023-11-09', 'actif', 'undefined'),
(7, 'T0005', 'Mahefa ', 'Bienvenu', 'admin@test2.com', '0192023a7bbd73250516f069df18b500', 'Fianarantsoa', '2003-07-14', '205015246856', 343314582, 342578596, 'homme', 'Informatique', 'Responsable IT', 'CDI', 'Admin', '2023-11-09', 'actif', 'undefined'),
(8, 'T0006', 'patrick', 'Finance', 'n+1@telesourcia.com', 'e10adc3949ba59abbe56e057f20f883e', 'Mahamasina', '2000-05-11', '202546976214', 342205017, 345879654, 'homme', 'Finance', 'Responsable logistique', 'CDD', 'n+1', '2023-11-13', 'actif', 'undefined');

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
  `code_em` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nbr_jrs` float NOT NULL,
  `date_dernier_mise_jrs` date NOT NULL,
  `solde_exeptionnel` float NOT NULL,
  PRIMARY KEY (`id_solde`),
  KEY `em_id` (`code_em`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `solde_conger`
--

INSERT INTO `solde_conger` (`id_solde`, `code_em`, `nbr_jrs`, `date_dernier_mise_jrs`, `solde_exeptionnel`) VALUES
(1, 'T0002', 1.5, '2023-11-09', 10),
(2, 'T0003', 2.5, '2023-11-03', 10),
(3, 'T0001', 2.5, '2023-11-09', 5),
(4, 'T0004', 2.5, '2023-11-09', 10),
(5, 'T0005', 2.5, '2023-11-09', 10),
(6, 'T0006', 2.5, '2023-11-13', 10);

-- --------------------------------------------------------

--
-- Structure de la table `type_conger`
--

DROP TABLE IF EXISTS `type_conger`;
CREATE TABLE IF NOT EXISTS `type_conger` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` enum('Ouvert','Indisposé') CHARACTER SET latin1 NOT NULL DEFAULT 'Ouvert',
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_conger`) REFERENCES `demande_conger` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `solde_conger_ibfk_1` FOREIGN KEY (`code_em`) REFERENCES `personnel` (`code_em`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
