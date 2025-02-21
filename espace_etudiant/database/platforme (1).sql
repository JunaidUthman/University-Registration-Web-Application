-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 12:05 AM
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
-- Database: `platforme`
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
  `note_s1` double NOT NULL,
  `note_s2` double NOT NULL,
  `note_s3` double NOT NULL,
  `note_s4` double NOT NULL,
  `note_s5` double DEFAULT NULL,
  `note_s6` double DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `fichier` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`id`, `email`, `password`, `verified`, `code_verification`, `fullname`, `CIN`, `CNE`, `date_de_naissance`, `ville_de_naissance`, `bac`, `mention_bac`, `bac_2`, `bac_3`, `note_s1`, `note_s2`, `note_s3`, `note_s4`, `note_s5`, `note_s6`, `image`, `fichier`) VALUES
(57, 'junaiduthman123@gmail.com', '$2y$10$/CMHf1Xpgx4oBXXVvJZ9GOnwJw6hiaN2UtAdIsyxlsQ6bz9wdargK', 1, 1949, 'JUNAID UTHMAN', '1111111', '11111111', '1111-11-11', '111', 'Sciences Mathematiques A (SMA)', 11, 'DEUST (Diplome detudes Universitaires Scientifiques et Techniques) : Sciences Physiques Appliquees.', 'Ingenierie de Developpement dApplications Informatiques', 11, 11, 11, 11, 11, 11, 'my pic.jpg', 'bacaloreat.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `inscription_cycle`
--

CREATE TABLE `inscription_cycle` (
  `id_ins_cycle` int(11) NOT NULL,
  `filiere` varchar(255) NOT NULL,
  `id_etd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inscription_licence`
--

CREATE TABLE `inscription_licence` (
  `id_ins_licence` int(11) NOT NULL,
  `filiere` varchar(255) NOT NULL,
  `id_etd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inscription_master`
--

CREATE TABLE `inscription_master` (
  `id_ins_master` int(11) NOT NULL,
  `filiere` varchar(255) NOT NULL,
  `id_etd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 'Biotechnologies (Options : animale et vegetale)'),
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bac`
--
ALTER TABLE `bac`
  ADD PRIMARY KEY (`id_bac`);

--
-- Indexes for table `cycles`
--
ALTER TABLE `cycles`
  ADD PRIMARY KEY (`id_cycle`);

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
-- Indexes for table `inscription_cycle`
--
ALTER TABLE `inscription_cycle`
  ADD PRIMARY KEY (`id_ins_cycle`),
  ADD KEY `id_etd` (`id_etd`);

--
-- Indexes for table `inscription_licence`
--
ALTER TABLE `inscription_licence`
  ADD PRIMARY KEY (`id_ins_licence`),
  ADD KEY `inscription_licence_ibfk_1` (`id_etd`);

--
-- Indexes for table `inscription_master`
--
ALTER TABLE `inscription_master`
  ADD PRIMARY KEY (`id_ins_master`),
  ADD KEY `inscription_master_ibfk_1` (`id_etd`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bac`
--
ALTER TABLE `bac`
  MODIFY `id_bac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `inscription_cycle`
--
ALTER TABLE `inscription_cycle`
  MODIFY `id_ins_cycle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inscription_licence`
--
ALTER TABLE `inscription_licence`
  MODIFY `id_ins_licence` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inscription_master`
--
ALTER TABLE `inscription_master`
  MODIFY `id_ins_master` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for dumped tables
--

--
-- Constraints for table `inscription_cycle`
--
ALTER TABLE `inscription_cycle`
  ADD CONSTRAINT `inscription_cycle_ibfk_1` FOREIGN KEY (`id_etd`) REFERENCES `etudiant` (`id`);

--
-- Constraints for table `inscription_licence`
--
ALTER TABLE `inscription_licence`
  ADD CONSTRAINT `inscription_licence_ibfk_1` FOREIGN KEY (`id_etd`) REFERENCES `etudiant` (`id`);

--
-- Constraints for table `inscription_master`
--
ALTER TABLE `inscription_master`
  ADD CONSTRAINT `inscription_master_ibfk_1` FOREIGN KEY (`id_etd`) REFERENCES `etudiant` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
