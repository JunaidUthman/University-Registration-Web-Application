-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2025 at 12:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `platforme_version_adminv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bac`
--

CREATE TABLE `bac` (
  `id_bac` int(11) NOT NULL,
  `nom_bac` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bac`
--

INSERT INTO `bac` (`id_bac`, `nom_bac`) VALUES
(1, 'Sciences Mathematiques A (SMA)'),
(2, 'Sciences Mathematiques B (SMB)'),
(3, 'Sciences Physiques (SP)'),
(4, 'Sciences de la Vie et de la Terre (SVT)'),
(5, 'Sciences et Technologies Mecaniques (STM)'),
(6, 'Sciences et Technologies electriques (STE)'),
(7, 'Sciences Agronomiques (SA)'),
(8, 'Sciences economiques et Gestion (SEG)'),
(10, 'Sciences Appliquees (SAp)');

-- --------------------------------------------------------

--
-- Table structure for table `chef_filiere`
--

CREATE TABLE `chef_filiere` (
  `id_chef` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_filiere_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chef_filiere`
--

INSERT INTO `chef_filiere` (`id_chef`, `fullname`, `email`, `password`, `id_filiere_fk`) VALUES
(2, 'JUNAID UTHMAN', 'junaiduthman123@gmail.com', '$2y$10$fURBSzdy12GhGIdR1hJT9.c.CZ1oK1b4p3H2ho1k4g5sGRZrgCl/G', 37),
(6, 'salim dawsari', 'salimdawsari@gmail.com', '$2y$10$lfwL.6Ds8V40dieBU.wK6OZEABclWUr1AthVxshTUbDrpJiU8L.qa', 22),
(9, 'l3awni lmokhtrar', 'lmokhtar@hhh.com', '$2y$10$ggOAcyPXhzfCh6A2OHeF1e4cUYO.JgAv6jiTOtG.PulA/j0jFe592', 15),
(14, 'MONIR', 'monir@ggg.com', '$2y$10$4futzqgV9q3nM6r.ixwoQulECePHr1PPjZAqKk0.etO1QNw7VPpTO', 31),
(16, 'doae keyser', 'doaekeysar@gmail.com', '$2y$10$cNy.Ukmk.xNgDLUWYQ7yUOGbrNgOc5U6KFAaLT76NLS.96uF9WzWW', 36);

-- --------------------------------------------------------

--
-- Table structure for table `cycles`
--

CREATE TABLE `cycles` (
  `id_cycle` int(11) NOT NULL,
  `nom_cycle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cycles`
--

INSERT INTO `cycles` (`id_cycle`, `nom_cycle`) VALUES
(1, 'DI: Genie Electrique et Management Industriel'),
(2, 'DI: Genie Industriel'),
(3, 'DI: Geoinformation'),
(4, 'Logiciels et Systemes Intelligents');

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `nom_departement` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`nom_departement`) VALUES
('GENIE_CHIMIQUE'),
('GENIE_ELECTRIQUE'),
('GENIE_INFORMATIQUE'),
('GENIE_MECANIQUE'),
('MATHEMATIQUES'),
('SCIENCES_DE_LA_TERRE');

-- --------------------------------------------------------

--
-- Table structure for table `deust`
--

CREATE TABLE `deust` (
  `id_deust` int(11) NOT NULL,
  `nom_deust` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deust`
--

INSERT INTO `deust` (`id_deust`, `nom_deust`) VALUES
(1, 'DEUST (Diplome detudes Universitaires Scientifiques et Techniques) : Chimie Appliquee et ProcEdes.'),
(2, 'DEUST (DiplOme detudes Universitaires Scientifiques et Techniques) : Mathematiques et Applications.'),
(3, 'DEUST (Dipleme detudes Universitaires Scientifiques et Techniques) : Informatique et Reseaux.'),
(4, 'DEUST (Diplome detudes Universitaires Scientifiques et Techniques) : Sciences Physiques Appliquees.'),
(5, 'DEUG (Diplome detudes Universitaires Generales) : Sciences Mathematiques et Informatique.'),
(6, 'DEUG (Diplome detudes Universitaires Generales) : Sciences de la Matiere Physique.'),
(7, 'DEUG (Diplome detudes Universitaires Generales) : Sciences de la Matiere Chimique.'),
(8, 'DUT (Diplome Universitaire de Technologie) : Genie Physique.'),
(9, 'DUT (Diplome Universitaire de Technologie) : Genie Chimique et Procedes.'),
(10, 'DUT (Diplome Universitaire de Technologie) : Informatique et Mathematiques.');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `code_verification` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `CIN` varchar(11) NOT NULL,
  `CNE` varchar(11) NOT NULL,
  `date_de_naissance` date NOT NULL,
  `ville_de_naissance` varchar(100) NOT NULL,
  `bac` varchar(200) NOT NULL,
  `mention_bac` double NOT NULL,
  `bac_2` varchar(300) NOT NULL,
  `bac_3` varchar(300) NOT NULL,
  `note_s1` double(6,4) NOT NULL,
  `note_s2` double(6,4) NOT NULL,
  `note_s3` double(6,4) NOT NULL,
  `note_s4` double(6,4) NOT NULL,
  `note_s5` double(6,4) DEFAULT NULL,
  `note_s6` double(6,4) DEFAULT NULL,
  `moyenne_bac2_3` double(6,4) NOT NULL,
  `image` varchar(200) NOT NULL,
  `fichier` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`id`, `email`, `password`, `verified`, `code_verification`, `fullname`, `CIN`, `CNE`, `date_de_naissance`, `ville_de_naissance`, `bac`, `mention_bac`, `bac_2`, `bac_3`, `note_s1`, `note_s2`, `note_s3`, `note_s4`, `note_s5`, `note_s6`, `moyenne_bac2_3`, `image`, `fichier`) VALUES
(63, 'junaiduthman123@gmail.com', '$2y$10$fURBSzdy12GhGIdR1hJT9.c.CZ1oK1b4p3H2ho1k4g5sGRZrgCl/G', 1, 1570, 'JUNAID UTHMAN', '1111111', '11111111', '1111-11-11', '111', 'Sciences Physiques (SP)', 11, 'DEUST (Dipleme detudes Universitaires Scientifiques et Techniques) : Informatique et Reseaux.', '', 11.0000, 11.0000, 11.0000, 11.0000, 0.0000, 0.0000, 11.0000, 'my pic.jpg', 'carte etd.pdf'),
(64, 'uthmanjunaid400@gmail.com', '$2y$10$rpZ29tXQqKuk/wn6Ki7XqOIrsSgn3OP.EapM298XDuuP.l9.wvq8m', 1, 1173, 'uthman', '0000', '000', '0001-01-01', 'OOO', 'Sciences Mathematiques A (SMA)', 0, 'DEUST (Diplome detudes Universitaires Scientifiques et Techniques) : Chimie Appliquee et ProcEdes.', 'Genie Electrique Option: Genie Electrique & Systeme Industriel', 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 'photo.jpg', 'JUNAID UTHMAN , DOCUMENTS DE L\'INSCRIPTION FST TANGER.pdf'),
(74, 'uthmanjunaid370@gmail.com', '$2y$10$yqTQoN9Z6GL7lRdOOHSo0esI7x2tnW3lT4nggDL8fkEq695z6hUnu', 1, 1503, 'uthman', 'AE318078', 'J131096336', '2003-05-07', 'sale', 'Sciences et Technologies electriques (STE)', 20, 'DEUST (Dipleme detudes Universitaires Scientifiques et Techniques) : Informatique et Reseaux.', '', 11.3600, 11.7300, 15.5600, 12.8800, 0.0000, 0.0000, 12.8825, 'my pic.jpg', 'bacaloreat.pdf'),
(76, 'uthman.junaid@etu.uae.ac.ma', '$2y$10$.cTsUd4IT8Xh5rPVczTe.OILqES2yDhbF4a/pwf/uFFFhclVF3vuG', 1, 1653, 'ahmad loghi', 'AE318078', 'J131096336', '2024-12-21', 'sale', 'Sciences Mathematiques A (SMA)', 18, 'DEUG (Diplome detudes Universitaires Generales) : Sciences de la Matiere Physique.', 'Genie Informatique', 11.3600, 11.7300, 15.5600, 12.0000, 10.0000, 10.0000, 11.7750, 'my pic.jpg', 'CV UPDATE.pdf'),
(77, 'etudiant1@gmail.com', '$2y$10$srfnY/sU721qsfbXmfJO6e8Gfh2Iznj4.sfa40s8ag0OFMghZB5Wa', 1, 2222, 'etudiant1', 'AE457532', 'R35752267', '2024-12-10', 'sale', 'S.P', 20, 'deust', 'math appliqué', 13.0000, 13.0000, 13.0000, 13.0000, 13.0000, 13.0000, 13.0000, 'my pic.jpg', 'bacaloreat.pdf'),
(78, 'etudiant2@gmail.com', '$2y$10$EAmbptZsRcVSo0QpwFyGMeg535EpEKAJWU0lO5KOlodW3c3gttA0e', 1, 2222, 'whatever', 'AE457532', 'R35752267', '2024-12-11', 'marakech', 'mp', 0, 'deust', 'licence', 10.2000, 10.2000, 10.2000, 10.2000, 10.2000, 10.2000, 10.2000, 'my pic.jpg', 'CV UPDATE.pdf'),
(79, 'etudiant2@gmail.com', '$2y$10$EAmbptZsRcVSo0QpwFyGMeg535EpEKAJWU0lO5KOlodW3c3gttA0e', 1, 2222, 'whatever', 'AE457532', 'R35752267', '2024-12-11', 'marakech', 'mp', 16, 'deust', 'licence', 10.2000, 10.2000, 10.2000, 10.2000, 10.2000, 10.2000, 10.2000, 'my pic.jpg', 'CV UPDATE.pdf'),
(80, 'etudiant3@gmail.com', '$2y$10$EAmbptZsRcVSo0QpwFyGMeg535EpEKAJWU0lO5KOlodW3c3gttA0e', 1, 2467, 'ousama hosniwi', 'AE457532', 'R35752267', '2024-12-17', 'tanger', 'bac', 20, 'DUT', 'MATH APPLIQUE', 11.9000, 11.9000, 11.9000, 11.9000, 11.9000, 11.9000, 11.9000, 'photo.jpg', 'carte etd.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `id_filiere` int(11) NOT NULL,
  `nom_filiere` varchar(300) NOT NULL,
  `nom_departement` varchar(100) NOT NULL,
  `nom_orientation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`id_filiere`, `nom_filiere`, `nom_departement`, `nom_orientation`) VALUES
(1, 'Analytique_des_donnees', 'MATHEMATIQUES', 'licence'),
(3, 'Design_Industriel_et_Productique_DIP', 'GENIE_MECANIQUE', 'licence'),
(4, 'Energies_Renouvelables_EnR', 'GENIE_ELECTRIQUE', 'licence'),
(5, 'Genie_civil', 'GENIE_MECANIQUE', 'licence'),
(6, 'Genie_des_Procedes', 'GENIE_CHIMIQUE', 'licence'),
(7, 'Genie_Electrique_Option_Genie_Electrique_et_Systeme_Industriel', 'GENIE_ELECTRIQUE', 'licence'),
(8, 'Genie_Industriel', 'GENIE_MECANIQUE', 'licence'),
(9, 'Genie_Informatique', 'GENIE_INFORMATIQUE', 'licence'),
(10, 'Geosciences_Appliquees', 'SCIENCES_DE_LA_TERRE', 'licence'),
(11, 'Ingenierie_de_Developpement_dApplications_Informatiques', 'GENIE_INFORMATIQUE', 'licence'),
(12, 'Ingenierie_Statistique', 'MATHEMATIQUES', 'licence'),
(13, 'Mathematiques_et_Applications', 'MATHEMATIQUES', 'licence'),
(14, 'Mathematiques_et_Informatique_Decisionnelles', 'MATHEMATIQUES', 'licence'),
(15, 'Risques_et_Ressources_Naturels', 'SCIENCES_DE_LA_TERRE', 'licence'),
(16, 'Statistique_et_Science_des_Donnees', 'MATHEMATIQUES', 'licence'),
(17, 'Techniques_dAnalyses_Chimiques_TAC', 'GENIE_CHIMIQUE', 'licence'),
(18, 'MST_Analyse_Appliquee_et_Ingenierie_Statistique', 'MATHEMATIQUES', 'master'),
(21, 'MST_Georessources_Energetiques_et_Reservoirs', 'SCIENCES_DE_LA_TERRE', 'master'),
(22, 'MST_Genie_Civil', 'GENIE_MECANIQUE', 'master'),
(23, 'MST_Genie_des_Materiaux_pour_Plasturgie_et_Metallurgie', 'GENIE_CHIMIQUE', 'master'),
(24, 'MST_Genie_Energetique', 'GENIE_ELECTRIQUE', 'master'),
(26, 'MST_Intelligence_Artificielle_et_Sciences_de_Donnees', 'GENIE_INFORMATIQUE', 'master'),
(27, 'MST_Mobiquite_et_Big_Data', 'GENIE_INFORMATIQUE', 'master'),
(28, 'MST_Modelisation_Mathematique_et_Science_de_Donnees', 'MATHEMATIQUES', 'master'),
(31, 'MST_Sciences_du_Littoral_Approche_Pluridisciplinaire', 'SCIENCES_DE_LA_TERRE', 'master'),
(32, 'MST_Securite_IT_et_Big_Data', 'GENIE_INFORMATIQUE', 'master'),
(33, 'MST_Systemes_Informatiques_et_Mobiles', 'GENIE_INFORMATIQUE', 'master'),
(34, 'DI_Genie_Electrique_et_Management_Industriel', 'GENIE_ELECTRIQUE', 'cycle'),
(35, 'DI_Genie_Industriel', 'GENIE_MECANIQUE', 'cycle'),
(36, 'DI_Geoinformation', 'SCIENCES_DE_LA_TERRE', 'cycle'),
(37, 'Logiciels_et_Systemes_Intelligents', 'GENIE_INFORMATIQUE', 'cycle');

-- --------------------------------------------------------

--
-- Table structure for table `inscription`
--

CREATE TABLE `inscription` (
  `id_ins` int(11) NOT NULL,
  `filiere` varchar(300) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `id_etd` int(11) NOT NULL,
  `nom_orientation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inscription`
--

INSERT INTO `inscription` (`id_ins`, `filiere`, `id_filiere`, `id_etd`, `nom_orientation`) VALUES
(5, 'MST_Analyse_Appliquee_et_Ingenierie_Statistique', 18, 63, 'master'),
(6, 'MST_Georessources_Energetiques_et_Reservoirs', 21, 63, 'master'),
(8, 'Design_Industriel_et_Productique_DIP', 3, 63, 'licence'),
(11, 'MST_Intelligence_Artificielle_et_Sciences_de_Donnees', 26, 64, 'master'),
(13, 'Genie_civil', 5, 64, 'licence'),
(14, 'Genie_Informatique', 9, 64, 'licence'),
(15, 'Mathematiques_et_Informatique_Decisionnelles', 14, 64, 'licence'),
(18, 'MST_Intelligence_Artificielle_et_Sciences_de_Donnees', 26, 63, 'master'),
(32, 'Genie_Industriel', 8, 63, 'licence'),
(33, 'Analytique_des_donnees', 1, 63, 'licence'),
(34, 'Ingenierie_Statistique', 12, 63, 'licence'),
(35, 'Analytique_des_donnees', 1, 64, 'licence'),
(47, 'MST_Analyse_Appliquee_et_Ingenierie_Statistique', 18, 74, 'master'),
(48, 'MST_Georessources_Energetiques_et_Reservoirs', 21, 74, 'master'),
(49, 'MST_Genie_Civil', 22, 74, 'master'),
(50, 'MST_Genie_des_Materiaux_pour_Plasturgie_et_Metallurgie', 23, 74, 'master'),
(51, 'MST_Genie_Energetique', 24, 74, 'master'),
(52, 'MST_Intelligence_Artificielle_et_Sciences_de_Donnees', 26, 74, 'master'),
(53, 'MST_Mobiquite_et_Big_Data', 27, 74, 'master'),
(54, 'MST_Modelisation_Mathematique_et_Science_de_Donnees', 28, 74, 'master'),
(55, 'MST_Sciences_du_Littoral_Approche_Pluridisciplinaire', 31, 74, 'master'),
(56, 'MST_Securite_IT_et_Big_Data', 32, 74, 'master'),
(57, 'MST_Systemes_Informatiques_et_Mobiles', 33, 74, 'master'),
(58, 'DI_Genie_Electrique_et_Management_Industriel', 34, 74, 'cycle'),
(60, 'DI_Geoinformation', 36, 74, 'cycle'),
(61, 'Logiciels_et_Systemes_Intelligents', 37, 74, 'cycle'),
(63, 'Design_Industriel_et_Productique_DIP', 3, 74, 'licence'),
(64, 'Energies_Renouvelables_EnR', 4, 74, 'licence'),
(65, 'Genie_civil', 5, 74, 'licence'),
(66, 'Genie_des_Procedes', 6, 74, 'licence'),
(67, 'Genie_Electrique_Option_Genie_Electrique_et_Systeme_Industriel', 7, 74, 'licence'),
(68, 'Genie_Industriel', 8, 74, 'licence'),
(69, 'Genie_Informatique', 9, 74, 'licence'),
(70, 'Geosciences_Appliquees', 10, 74, 'licence'),
(71, 'Ingenierie_de_Developpement_dApplications_Informatiques', 11, 74, 'licence'),
(72, 'Ingenierie_Statistique', 12, 74, 'licence'),
(73, 'Risques_et_Ressources_Naturels', 15, 74, 'licence'),
(75, 'Techniques_dAnalyses_Chimiques_TAC', 17, 74, 'licence'),
(76, 'Statistique_et_Science_des_Donnees', 16, 63, 'licence'),
(85, 'MST_Analyse_Appliquee_et_Ingenierie_Statistique', 18, 76, 'master'),
(86, 'MST_Genie_Civil', 22, 76, 'master'),
(88, 'MST_Mobiquite_et_Big_Data', 27, 76, 'master'),
(89, 'MST_Sciences_du_Littoral_Approche_Pluridisciplinaire', 31, 76, 'master'),
(90, 'DI_Genie_Electrique_et_Management_Industriel', 34, 76, 'cycle'),
(91, 'DI_Genie_Industriel', 35, 76, 'cycle'),
(93, 'Logiciels_et_Systemes_Intelligents', 37, 76, 'cycle'),
(94, 'Analytique_des_donnees', 1, 76, 'licence'),
(95, 'Design_Industriel_et_Productique_DIP', 3, 76, 'licence'),
(96, 'Energies_Renouvelables_EnR', 4, 76, 'licence'),
(97, 'Genie_civil', 5, 76, 'licence'),
(98, 'Genie_des_Procedes', 6, 76, 'licence'),
(99, 'Genie_Electrique_Option_Genie_Electrique_et_Systeme_Industriel', 7, 76, 'licence'),
(100, 'Genie_Informatique', 9, 76, 'licence'),
(101, 'Ingenierie_de_Developpement_dApplications_Informatiques', 11, 76, 'licence'),
(102, 'Mathematiques_et_Applications', 13, 76, 'licence'),
(104, 'MST_Analyse_Appliquee_et_Ingenierie_Statistique', 18, 77, 'master'),
(105, 'MST_Georessources_Energetiques_et_Reservoirs', 21, 77, 'master'),
(106, 'MST_Genie_Civil', 22, 77, 'master'),
(107, 'MST_Genie_des_Materiaux_pour_Plasturgie_et_Metallurgie', 23, 77, 'master'),
(108, 'MST_Genie_Energetique', 24, 77, 'master'),
(109, 'MST_Modelisation_Mathematique_et_Science_de_Donnees', 28, 77, 'master'),
(110, 'MST_Sciences_du_Littoral_Approche_Pluridisciplinaire', 31, 77, 'master'),
(111, 'MST_Securite_IT_et_Big_Data', 32, 77, 'master'),
(113, 'DI_Genie_Industriel', 35, 77, 'cycle'),
(114, 'DI_Geoinformation', 36, 77, 'cycle'),
(115, 'Logiciels_et_Systemes_Intelligents', 37, 77, 'cycle'),
(116, 'Analytique_des_donnees', 1, 77, 'licence'),
(117, 'Energies_Renouvelables_EnR', 4, 77, 'licence'),
(118, 'Genie_civil', 5, 77, 'licence'),
(119, 'Genie_Electrique_Option_Genie_Electrique_et_Systeme_Industriel', 7, 77, 'licence'),
(120, 'Genie_Industriel', 8, 77, 'licence'),
(121, 'Geosciences_Appliquees', 10, 77, 'licence'),
(122, 'Ingenierie_de_Developpement_dApplications_Informatiques', 11, 77, 'licence'),
(123, 'Mathematiques_et_Applications', 13, 77, 'licence'),
(124, 'Mathematiques_et_Informatique_Decisionnelles', 14, 77, 'licence'),
(125, 'Risques_et_Ressources_Naturels', 15, 77, 'licence'),
(126, 'MST_Analyse_Appliquee_et_Ingenierie_Statistique', 18, 78, 'master'),
(127, 'MST_Genie_des_Materiaux_pour_Plasturgie_et_Metallurgie', 23, 78, 'master'),
(128, 'MST_Intelligence_Artificielle_et_Sciences_de_Donnees', 26, 78, 'master'),
(129, 'MST_Modelisation_Mathematique_et_Science_de_Donnees', 28, 78, 'master'),
(131, 'Logiciels_et_Systemes_Intelligents', 37, 78, 'cycle'),
(132, 'Design_Industriel_et_Productique_DIP', 3, 78, 'licence'),
(133, 'Genie_civil', 5, 78, 'licence'),
(134, 'Genie_Electrique_Option_Genie_Electrique_et_Systeme_Industriel', 7, 78, 'licence'),
(135, 'Ingenierie_de_Developpement_dApplications_Informatiques', 11, 78, 'licence'),
(136, 'Ingenierie_Statistique', 12, 78, 'licence'),
(137, 'Risques_et_Ressources_Naturels', 15, 78, 'licence'),
(138, 'MST_Analyse_Appliquee_et_Ingenierie_Statistique', 18, 80, 'master'),
(139, 'MST_Genie_Civil', 22, 80, 'master'),
(140, 'MST_Intelligence_Artificielle_et_Sciences_de_Donnees', 26, 80, 'master'),
(141, 'MST_Mobiquite_et_Big_Data', 27, 80, 'master'),
(142, 'MST_Sciences_du_Littoral_Approche_Pluridisciplinaire', 31, 80, 'master'),
(143, 'MST_Systemes_Informatiques_et_Mobiles', 33, 80, 'master'),
(144, 'DI_Genie_Electrique_et_Management_Industriel', 34, 80, 'cycle'),
(145, 'DI_Genie_Industriel', 35, 80, 'cycle'),
(146, 'Analytique_des_donnees', 1, 80, 'licence'),
(147, 'Genie_civil', 5, 80, 'licence'),
(148, 'Genie_Industriel', 8, 80, 'licence'),
(149, 'Geosciences_Appliquees', 10, 80, 'licence'),
(150, 'Mathematiques_et_Applications', 13, 80, 'licence'),
(151, 'Statistique_et_Science_des_Donnees', 16, 80, 'licence');

-- --------------------------------------------------------

--
-- Table structure for table `licence`
--

CREATE TABLE `licence` (
  `id_licence` int(11) NOT NULL,
  `nom_licence` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `licence`
--

INSERT INTO `licence` (`id_licence`, `nom_licence`) VALUES
(1, 'Analytique des donnees'),
(3, 'Design Industriel et Productique (DIP)'),
(4, 'Energies Renouvelables (EnR)'),
(5, 'Genie civil'),
(6, 'Genie des Procedes'),
(7, 'Genie Electrique Option: Genie Electrique & Systeme Industriel'),
(8, 'Genie Industriel'),
(9, 'Genie Informatique'),
(10, 'Geosciences Appliquees'),
(11, 'Ingenierie de Developpement dApplications Informatiques'),
(12, 'Ingenierie Statistique'),
(13, 'Mathematiques et Applications'),
(14, 'Mathematiques et Informatique Decisionnelles'),
(15, 'Risques et Ressources Naturels'),
(16, 'Statistique et Science des Donnees'),
(17, 'Techniques dAnalyses Chimiques (TAC)');

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE `master` (
  `id_master` int(11) NOT NULL,
  `nom_master` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master`
--

INSERT INTO `master` (`id_master`, `nom_master`) VALUES
(1, 'MST : Analyse Appliquee et Ingenierie Statistique'),
(2, 'MST : Bases Cellulaires et Moleculaires en Biotechnologie'),
(3, 'MST : Environnement, Aquaculture et Developpement Durable'),
(4, 'MST : Georesources Energetiques et Reservoirs'),
(5, 'MST : Genie Civil'),
(6, 'MST : Genie des Materiaux pour Plasturgie et Metallurgie'),
(7, 'MST : Genie Energetique'),
(8, 'MST : Ingenierie Environnementale, Changement Climatique et Developpement Durable'),
(9, 'MST : Intelligence Artificielle et Sciences de Donnees'),
(10, 'MST : Mobiquite et Big Data'),
(11, 'MST : Modelisation Mathematique et Science de Donnees'),
(12, 'MST : Sciences Agroalimentaires'),
(13, 'MST : Sciences de l\'Environnement'),
(14, 'MST : Sciences du Littoral: Approche Pluridisciplinaire'),
(15, 'MST : Securite IT et Big Data'),
(16, 'MST : Systemes Informatiques et Mobiles');

-- --------------------------------------------------------

--
-- Table structure for table `orientation`
--

CREATE TABLE `orientation` (
  `nom_orientation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orientation`
--

INSERT INTO `orientation` (`nom_orientation`) VALUES
('cycle'),
('licence'),
('master');

-- --------------------------------------------------------

--
-- Table structure for table `sudo`
--

CREATE TABLE `sudo` (
  `id_sudo` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sudo`
--

INSERT INTO `sudo` (`id_sudo`, `email`, `password`) VALUES
(1, 'junaiduthman123@gmail.com', '$2y$10$fURBSzdy12GhGIdR1hJT9.c.CZ1oK1b4p3H2ho1k4g5sGRZrgCl/G\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bac`
--
ALTER TABLE `bac`
  ADD PRIMARY KEY (`id_bac`);

--
-- Indexes for table `chef_filiere`
--
ALTER TABLE `chef_filiere`
  ADD PRIMARY KEY (`id_chef`),
  ADD KEY `id_filiere_fk` (`id_filiere_fk`);

--
-- Indexes for table `cycles`
--
ALTER TABLE `cycles`
  ADD PRIMARY KEY (`id_cycle`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`nom_departement`);

--
-- Indexes for table `deust`
--
ALTER TABLE `deust`
  ADD PRIMARY KEY (`id_deust`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id_filiere`),
  ADD KEY `nom_departement` (`nom_departement`),
  ADD KEY `nom_orientation` (`nom_orientation`);

--
-- Indexes for table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id_ins`),
  ADD KEY `id_etd` (`id_etd`),
  ADD KEY `id_filiere` (`id_filiere`),
  ADD KEY `nom_orientation` (`nom_orientation`);

--
-- Indexes for table `licence`
--
ALTER TABLE `licence`
  ADD PRIMARY KEY (`id_licence`);

--
-- Indexes for table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`id_master`);

--
-- Indexes for table `orientation`
--
ALTER TABLE `orientation`
  ADD PRIMARY KEY (`nom_orientation`);

--
-- Indexes for table `sudo`
--
ALTER TABLE `sudo`
  ADD PRIMARY KEY (`id_sudo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bac`
--
ALTER TABLE `bac`
  MODIFY `id_bac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chef_filiere`
--
ALTER TABLE `chef_filiere`
  MODIFY `id_chef` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cycles`
--
ALTER TABLE `cycles`
  MODIFY `id_cycle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deust`
--
ALTER TABLE `deust`
  MODIFY `id_deust` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id_filiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `id_ins` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `licence`
--
ALTER TABLE `licence`
  MODIFY `id_licence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `master`
--
ALTER TABLE `master`
  MODIFY `id_master` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sudo`
--
ALTER TABLE `sudo`
  MODIFY `id_sudo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chef_filiere`
--
ALTER TABLE `chef_filiere`
  ADD CONSTRAINT `chef_filiere_ibfk_1` FOREIGN KEY (`id_filiere_fk`) REFERENCES `filiere` (`id_filiere`);

--
-- Constraints for table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_1` FOREIGN KEY (`nom_departement`) REFERENCES `departement` (`nom_departement`),
  ADD CONSTRAINT `filiere_ibfk_2` FOREIGN KEY (`nom_orientation`) REFERENCES `orientation` (`nom_orientation`);

--
-- Constraints for table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`id_etd`) REFERENCES `etudiant` (`id`),
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`),
  ADD CONSTRAINT `inscription_ibfk_3` FOREIGN KEY (`nom_orientation`) REFERENCES `orientation` (`nom_orientation`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
