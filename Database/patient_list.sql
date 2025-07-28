-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 07:21 AM
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
-- Database: `patient_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `cahs_list`
--

CREATE TABLE `cahs_list` (
  `ID` int(11) NOT NULL,
  `patient_number` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `hospital` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cahs_list`
--

INSERT INTO `cahs_list` (`ID`, `patient_number`, `last_name`, `first_name`, `hospital`, `gender`, `age`, `department`) VALUES
(1, 202311255, ' Mendoza', 'Aleczander Gabriel', 'James L. Gordon Memorial Hospital', 'Male', 19, 'CAHS'),
(5, 202310564, 'Laurenaria', 'Jan Raven', 'James L. Gordon Memorial Hospital', 'Male', 19, 'CAHS');

-- --------------------------------------------------------

--
-- Table structure for table `cba_list`
--

CREATE TABLE `cba_list` (
  `ID` int(11) NOT NULL,
  `patient_number` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `hospital` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cba_list`
--

INSERT INTO `cba_list` (`ID`, `patient_number`, `last_name`, `first_name`, `hospital`, `gender`, `age`, `department`) VALUES
(1, 202311308, ' Vencilao', 'Johara Karylle', 'James L. Gordon Memorial Hospital', 'Female', 19, 'CBA');

-- --------------------------------------------------------

--
-- Table structure for table `ceas_list`
--

CREATE TABLE `ceas_list` (
  `ID` int(11) NOT NULL,
  `patient_number` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `hospital` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ceas_list`
--

INSERT INTO `ceas_list` (`ID`, `patient_number`, `last_name`, `first_name`, `hospital`, `gender`, `age`, `department`) VALUES
(1, 202312251, 'Diwa', 'Lawrence Andrew', 'James L. Gordon Memorial Hospital', 'Male', 19, 'CEAS');

-- --------------------------------------------------------

--
-- Table structure for table `chtm_list`
--

CREATE TABLE `chtm_list` (
  `ID` int(11) NOT NULL,
  `patient_number` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `hospital` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chtm_list`
--

INSERT INTO `chtm_list` (`ID`, `patient_number`, `last_name`, `first_name`, `hospital`, `gender`, `age`, `department`) VALUES
(1, 202310319, 'Tamondong', 'Seann Patrick', 'James L. Gordon Memorial Hospital', 'Male', 19, 'CHTM');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `ID` int(11) NOT NULL,
  `patient_number` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `hospital` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`ID`, `patient_number`, `last_name`, `first_name`, `hospital`, `gender`, `age`, `department`) VALUES
(1, 202310376, 'Rumeral', 'Lebron James', 'James L. Gordon Memorial Hospital', 'Male', 19, 'CCS'),
(13, 202310293, 'Garcia', 'Rosary Jane', 'James L. Gordon Memorial Hospital', 'Female', 20, 'CCS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cahs_list`
--
ALTER TABLE `cahs_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cba_list`
--
ALTER TABLE `cba_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ceas_list`
--
ALTER TABLE `ceas_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `chtm_list`
--
ALTER TABLE `chtm_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cahs_list`
--
ALTER TABLE `cahs_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cba_list`
--
ALTER TABLE `cba_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ceas_list`
--
ALTER TABLE `ceas_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chtm_list`
--
ALTER TABLE `chtm_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
