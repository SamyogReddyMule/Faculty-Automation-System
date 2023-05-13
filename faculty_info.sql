-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2022 at 02:57 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faculty_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `auid` text NOT NULL,
  `apwd` text NOT NULL,
  `dep` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`auid`, `apwd`, `dep`) VALUES
('CRR', 'CRR', 'CLG'),
('CRRCSE', 'CRRCSE', 'CSE'),
('CRRIT', 'CRRIT', 'IT'),
('CRRECE', 'CRRECE', 'ECE'),
('CRREEE', 'CRREEE', 'EEE'),
('CRRMECH', 'CRRMECH', 'MECH'),
('CRRCIVIL', 'CRRCIVIL', 'CIVIL'),
('CRRFED', 'CRRFED', 'FED'),
('CRRMBA', 'CRRMBA', 'MBA');

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `cuid` text NOT NULL,
  `cname` text NOT NULL,
  `caward` text NOT NULL,
  `ccontribution` text NOT NULL,
  `cyear` text NOT NULL,
  `cfile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`cuid`, `cname`, `caward`, `ccontribution`, `cyear`, `cfile`) VALUES
('CRRIT01', 'HTML', 'A', 'asd', '2022-23', 'CRRIT01-InfosysCertificationExaminationGuidelines.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `cuid` text NOT NULL,
  `cname` text NOT NULL,
  `ctype` text NOT NULL,
  `cyear` text NOT NULL,
  `cstart` text NOT NULL,
  `cend` text NOT NULL,
  `cdur` text NOT NULL,
  `cfile` text NOT NULL,
  `cjournal` text NOT NULL,
  `cvol` text NOT NULL,
  `cindex` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`cuid`, `cname`, `ctype`, `cyear`, `cstart`, `cend`, `cdur`, `cfile`, `cjournal`, `cvol`, `cindex`) VALUES
('CRRCSE01', 'ABC', 'Workshop', '2021', '2021-10-21', '2021-10-25', '0 Year 0 Months 5 Days', 'CRRCSE01-IPR.pdf', '', '', ''),
('CRRCSE01', 'angular js', 'Workshop', '2021-22', '2021-08-21', '2021-08-25', '0 Year 0 Months 5 Days', 'CRRIT01-ABSTRACT.pdf', '', '', ''),
('CRRCSE01', 'C++', 'Course', '2021-22', '2021-09-16', '2021-09-19', '0 Year 0 Months 4 Days', 'CRRIT01-ALUMNI PORTAL INFORMATION1.pdf', '', '', ''),
('CRRCSE02', 'DEF', 'Workshop', '2021', '2021-09-25', '2021-09-30', '0 Year 0 Months 6 Days', 'CRRIT02-algorithms.pdf', '', '', ''),
('CRRCSE02', 'PQR', 'Workshop', '2022', '2022-07-21', '2022-07-26', '0 Year 0 Months 6 Days', 'CRRIT02-ds unit-4.pdf', '', '', ''),
('CRRIT01', 'MNO', 'Workshop', '2021', '2021-07-25', '2021-08-02', '0 Year 0 Months 9 Days', 'CRRIT03-ds unit-5.pdf', '', '', ''),
('CRRIT01', 'C++', 'Workshop', '2021', '2021-10-30', '2021-11-05', '0 Year 0 Months 7 Days', 'CRRIT03-internship user manual.pdf', '', '', ''),
('CRRIT02', 'PYTHON', 'Workshop', '2022', '2022-10-10', '2022-10-15', '0 Year 0 Months 6 Days', 'CRRIT04-TCS Registration Process 2023 Batch.pdf', '', '', ''),
('CRRIT02', 'JAVA', 'Workshop', '2021', '2021-11-10', '2021-11-15', '0 Year 0 Months 6 Days', 'CRRIT04-JAVA R19 - UNIT-1.pdf', '', '', ''),
('CRRCSE01', 'C', 'Course', '2021', '2021-02-10', '2021-02-15', '0 Year 0 Months 6 Days', 'CRRIT01-JAVA R19 - UNIT-2.pdf', '', '', ''),
('CRRCSE02', 'HTML', 'Course', '2021', '2021-11-12', '2021-11-15', '0 Year 0 Months 4 Days', 'CRRIT02-threads.pdf', '', '', ''),
('CRRCSE02', 'SQL', 'Course', '2020', '2020-10-12', '2020-10-15', '0 Year 0 Months 4 Days', 'CRRIT02-Strings.pdf', '', '', ''),
('CRRIT01', 'R', 'Course', '2021', '2021-11-15', '2021-11-19', '0 Year 0 Months 5 Days', 'CRRIT03-database connection.pdf', '', '', ''),
('CRRIT01', 'PHP', 'Course', '2021', '2021-12-14', '2021-12-18', '0 Year 0 Months 5 Days', 'CRRIT03-UNIT 1 CONTROL STATEMENTS.pdf', '', '', ''),
('CRRIT02', 'PERL', 'Course', '2021', '2021-01-11', '2021-01-19', '0 Year 0 Months 9 Days', 'CRRIT04-UNIT 1 DATA TYPES _ OPERATORS.pdf', '', '', ''),
('CRRIT02', 'DBMS', 'Course', '2022', '2022-06-14', '2022-06-19', '0 Year 0 Months 6 Days', 'CRRIT04-UNIT 1- OOPS.pdf', '', '', ''),
('CRRCSE01', 'C++', 'Seminar', '2021', '2021-10-21', '2021-10-26', '0 Year 0 Months 6 Days', 'CRRIT01-UNIT 1 PROGRAM STRUCTURE.pdf', '', '', ''),
('CRRCSE01', 'HTML', 'Seminar', '2021', '2021-10-15', '2021-10-20', '0 Year 0 Months 6 Days', 'CRRIT01-UNIT 2 CLASSES AND OBJECTS.pdf', '', '', ''),
('CRRCSE02', 'PYTHON', 'Seminar', '2020', '2020-11-20', '2020-12-01', '0 Year 0 Months 12 Days', 'CRRIT02-UNIT 2 METHODS.pdf', '', '', ''),
('CRRCSE02', 'SQL', 'Seminar', '2021', '2021-11-12', '2021-11-16', '0 Year 0 Months 5 Days', 'CRRIT02-Arrays.pdf', '', '', ''),
('CRRIT01', 'C++', 'Seminar', '2020', '2020-02-01', '2020-02-10', '0 Year 0 Months 10 Days', 'CRRIT03-Inheritance.pdf', '', '', ''),
('CRRIT01', 'PYTHON', 'Seminar', '2020', '2020-01-01', '2020-01-06', '0 Year 0 Months 6 Days', 'CRRIT03-exception handling_1.pdf', '', '', ''),
('CRRIT02', 'DBMS', 'Seminar', '2022', '2022-05-10', '2022-05-15', '0 Year 0 Months 6 Days', 'CRRIT04-pakages2.pdf', '', '', ''),
('CRRIT02', 'PYTHON', 'Seminar', '2020', '2020-11-15', '2020-11-19', '0 Year 0 Months 5 Days', 'CRRIT04-JAVA R19 MATERIAL @ VGN.pdf', '', '', ''),
('CRRCSE01', 'PYTHON', 'Conference', '2021', '', '', '', 'CRRIT01-CN UNIT-1(R19).pdf', 'python', '1', '2'),
('CRRCSE02', 'CRR', 'Conference', '2021', '', '', '', 'CRRIT02-CN(R19) UNIT-5.pdf', 'python', '1', '2'),
('CRRIT01', 'Ada', 'Conference', '2021', '', '', '', 'CRRIT03-CN(R19)-Unit 2.pdf', 'python', '1', '2'),
('CRRIT02', 'CRR', 'Conference', '2021', '', '', '', 'CRRIT04-CN(R19)-Unit 3.pdf', 'python', '1', '2'),
('CRRCSE01', 'CRR', 'Paper Publication', '2019', '', '', '', 'CRRIT01-CN(R19)Unit-4.pdf', 'IT', '1', '2'),
('CRRCSE02', 'Ada', 'Paper Publication', '2020', '', '', '', 'CRRIT02-DW-DM R19 Unit-1.pdf', 'python', '1', '2'),
('CRRIT01', 'Ada', 'Paper Publication', '2018', '', '', '', 'CRRIT03-DW-DM R19 Unit-2.pdf', 'IT', '1', '2'),
('CRRIT02', 'PYTHON', 'Paper Publication', '2019', '', '', '', 'CRRIT04-DW-DM R19 Unit-3.pdf', 'IT', '1', '2'),
('CRRIT01', 'HTML', 'Books', '2022-23', '', '', '', 'CRRIT01-bus fees 3-1.pdf', 'HTML', '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `edname` text NOT NULL,
  `edboard` text NOT NULL,
  `edprogram` text NOT NULL,
  `edbranch` text NOT NULL,
  `edpyear` text NOT NULL,
  `edpcntg` text NOT NULL,
  `euid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`edname`, `edboard`, `edprogram`, `edbranch`, `edpyear`, `edpcntg`, `euid`) VALUES
('CRR', 'JNTUK', 'BTECH', 'CSE', '2021', '85', 'CRRCSE01'),
('narayana junior college', 'BOI', 'inter', 'mpc', '2018', '86', 'CRRCSE01'),
('CRR', 'JNTUK', 'BTECH', 'IT', '2020', '76', 'CRRCSE02'),
('narayana junior college', 'BOI', 'INTER', 'MPC', '2016', '82', 'CRRCSE02'),
('JNTUK', 'JNTUK', 'BTECH', 'CSE', '2019', '70', 'CRRIT01'),
('CRR', 'JNTUK', 'BTECH', 'IT', '2021', '80', 'CRRIT02'),
('narayana junior college', 'BOI', 'INTER', 'MPC', '2016', '80', 'CRRIT01'),
('narayana junior college', 'BOI', 'INTER', 'MPC', '2016', '90', 'CRRIT02');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `ename` text NOT NULL,
  `edes` text NOT NULL,
  `ejyear` text NOT NULL,
  `eeyear` text NOT NULL,
  `expid` text NOT NULL,
  `etime` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`ename`, `edes`, `ejyear`, `eeyear`, `expid`, `etime`) VALUES
('Sir C R Reddy College of Engineering', 'Assistant Professor', '2022', '2022', 'CRRCSE01', '0'),
('Sir C R Reddy College of Engineering', 'Professor', '2022', '2022', 'CRRCSE02', '0'),
('Sir C R Reddy College of Engineering', 'Associate Professor', '2021', '2022', 'CRRIT01', '1'),
('Sir C R Reddy College of Engineering', 'Associate Professor', '2021', '2022', 'CRRIT02', '1');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_details`
--

CREATE TABLE `faculty_details` (
  `fuid` text NOT NULL,
  `fname` text NOT NULL,
  `fdob` text NOT NULL,
  `fgen` text NOT NULL,
  `fdes` text NOT NULL,
  `fdep` text NOT NULL,
  `fphn` text NOT NULL,
  `femail` text NOT NULL,
  `fpwd` text NOT NULL,
  `fage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_details`
--

INSERT INTO `faculty_details` (`fuid`, `fname`, `fdob`, `fgen`, `fdes`, `fdep`, `fphn`, `femail`, `fpwd`, `fage`) VALUES
('CRRCSE01', 'Samyog', '2000-08-04', 'Male', 'Assistant Professor', 'CSE', '9440065209', 'karumanchi.poornasai50@gmail.com', 'CRRCSE01', '22 Years'),
('CRRCSE02', 'Prasad', '2000-10-02', 'Female', 'Professor', 'CSE', '9848621256', 'ndeviharshitha@gmail.com', 'CRRCSE02', '22 Years'),
('CRRIT01', 'Uma', '2002-11-06', 'Female', 'Associate Professor', 'IT', '9182530642', 'skthanuz@gmail.com', 'CRRIT01', '20 Years'),
('CRRIT02', 'Ganesh', '2000-05-16', 'Male', 'Assistant Professor', 'IT', '6918654795', 'ssaisatyanarayana@gmail.com', 'CRRIT02', '22 Years');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `luid` text NOT NULL,
  `ltime` text NOT NULL,
  `lstart` text NOT NULL,
  `lend` text NOT NULL,
  `lremain` text NOT NULL,
  `lrason` text NOT NULL,
  `lyear` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `suid` text NOT NULL,
  `sname` text NOT NULL,
  `sclass` text NOT NULL,
  `ssem` text NOT NULL,
  `ssec` text NOT NULL,
  `syear` text NOT NULL,
  `sstrength` text NOT NULL,
  `spass` text NOT NULL,
  `spassp` text NOT NULL,
  `sfeed` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`suid`, `sname`, `sclass`, `ssem`, `ssec`, `syear`, `sstrength`, `spass`, `spassp`, `sfeed`) VALUES
('CRRCSE01', 'C++', '2', '2-1', 'A', '2021-22', '70', '62', '89', '8'),
('CRRIT02', 'python', '3', '1', 'b', '2022-23', '70', '58', '83', '15');

-- --------------------------------------------------------

--
-- Table structure for table `workload`
--

CREATE TABLE `workload` (
  `wuid` text NOT NULL,
  `wyear` text NOT NULL,
  `wsem` text NOT NULL,
  `wsub` text NOT NULL,
  `wtheory` text NOT NULL,
  `wlab` text NOT NULL,
  `wtotal` text NOT NULL,
  `wfrac` text NOT NULL,
  `wfile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
