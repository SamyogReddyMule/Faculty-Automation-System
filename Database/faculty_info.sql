-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 06:42 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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
  `apwd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`auid`, `apwd`) VALUES
('CRR', 'CRR');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`cuid`, `cname`, `caward`, `ccontribution`, `cyear`, `cfile`) VALUES
('CRRIT01', 'HTML', 'A', 'asd', '2022-23', 'CRRIT01-Cambridge Practice Tests for IELTS 4.pdf'),
('CRRCSE01', 'HOD', 'ADMIN', 'IT', '2021-22', 'CRRCSE01-Template@student Hackathon.pdf');

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
  `cvol` int(10) NOT NULL,
  `cindex` int(11) NOT NULL,
  `cttype` text NOT NULL,
  `chindex` int(10) NOT NULL,
  `ccite` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`cuid`, `cname`, `ctype`, `cyear`, `cstart`, `cend`, `cdur`, `cfile`, `cjournal`, `cvol`, `cindex`, `cttype`, `chindex`, `ccite`) VALUES
('CRRCSE01', 'ABC', 'Workshop', '2021-22', '2021-10-21', '2021-10-25', '0 Year 0 Months 5 Days', 'CRRCSE01-IPR.pdf', '', 0, 0, '', 0, ''),
('CRRCSE01', 'angular js', 'Workshop', '2021-22', '2021-08-21', '2021-08-25', '0 Year 0 Months 5 Days', 'CRRIT01-ABSTRACT.pdf', '', 0, 0, '', 0, ''),
('CRRCSE01', 'C++', 'Course', '2021-22', '2021-09-16', '2021-09-19', '0 Year 0 Months 4 Days', 'CRRIT01-ALUMNI PORTAL INFORMATION1.pdf', '', 0, 0, '', 0, ''),
('CRRCSE02', 'DEF', 'Workshop', '2021', '2021-09-25', '2021-09-30', '0 Year 0 Months 6 Days', 'CRRIT02-algorithms.pdf', '', 0, 0, '', 0, ''),
('CRRCSE02', 'PQR', 'Workshop', '2022', '2022-07-21', '2022-07-26', '0 Year 0 Months 6 Days', 'CRRIT02-ds unit-4.pdf', '', 0, 0, '', 0, ''),
('CRRIT01', 'MNO', 'Workshop', '2021-22', '2021-07-25', '2021-07-29', '0 Year 0 Months 5 Days', 'CRRIT03-ds unit-5.pdf', '', 0, 0, '', 0, ''),
('CRRIT01', 'C++', 'Workshop', '2021', '2021-10-30', '2021-11-05', '0 Year 0 Months 7 Days', 'CRRIT03-internship user manual.pdf', '', 0, 0, '', 0, ''),
('CRRIT02', 'PYTHON', 'Workshop', '2022', '2022-10-10', '2022-10-15', '0 Year 0 Months 6 Days', 'CRRIT04-TCS Registration Process 2023 Batch.pdf', '', 0, 0, '', 0, ''),
('CRRIT02', 'JAVA', 'Workshop', '2021', '2021-11-10', '2021-11-15', '0 Year 0 Months 6 Days', 'CRRIT04-JAVA R19 - UNIT-1.pdf', '', 0, 0, '', 0, ''),
('CRRCSE01', 'C', 'Course', '2021', '2021-02-10', '2021-02-15', '0 Year 0 Months 6 Days', 'CRRIT01-JAVA R19 - UNIT-2.pdf', '', 0, 0, '', 0, ''),
('CRRCSE02', 'HTML', 'Course', '2021', '2021-11-12', '2021-11-15', '0 Year 0 Months 4 Days', 'CRRIT02-threads.pdf', '', 0, 0, '', 0, ''),
('CRRCSE02', 'SQL', 'Course', '2020', '2020-10-12', '2020-10-15', '0 Year 0 Months 4 Days', 'CRRIT02-Strings.pdf', '', 0, 0, '', 0, ''),
('CRRIT01', 'R', 'Course', '2021', '2021-11-15', '2021-11-19', '0 Year 0 Months 5 Days', 'CRRIT03-database connection.pdf', '', 0, 0, '', 0, ''),
('CRRIT01', 'PHP', 'Course', '2021', '2021-12-14', '2021-12-18', '0 Year 0 Months 5 Days', 'CRRIT03-UNIT 1 CONTROL STATEMENTS.pdf', '', 0, 0, '', 0, ''),
('CRRIT02', 'PERL', 'Course', '2021', '2021-01-11', '2021-01-19', '0 Year 0 Months 9 Days', 'CRRIT04-UNIT 1 DATA TYPES _ OPERATORS.pdf', '', 0, 0, '', 0, ''),
('CRRIT02', 'DBMS', 'Course', '2022', '2022-06-14', '2022-06-19', '0 Year 0 Months 6 Days', 'CRRIT04-UNIT 1- OOPS.pdf', '', 0, 0, '', 0, ''),
('CRRCSE01', 'C++', 'Seminar', '2021', '2021-10-21', '2021-10-26', '0 Year 0 Months 6 Days', 'CRRIT01-UNIT 1 PROGRAM STRUCTURE.pdf', '', 0, 0, '', 0, ''),
('CRRCSE01', 'HTML', 'Seminar', '2021', '2021-10-15', '2021-10-20', '0 Year 0 Months 6 Days', 'CRRIT01-UNIT 2 CLASSES AND OBJECTS.pdf', '', 0, 0, '', 0, ''),
('CRRCSE02', 'PYTHON', 'Seminar', '2020', '2020-11-20', '2020-12-01', '0 Year 0 Months 12 Days', 'CRRIT02-UNIT 2 METHODS.pdf', '', 0, 0, '', 0, ''),
('CRRCSE02', 'SQL', 'Seminar', '2021', '2021-11-12', '2021-11-16', '0 Year 0 Months 5 Days', 'CRRIT02-Arrays.pdf', '', 0, 0, '', 0, ''),
('CRRIT01', 'C++', 'Seminar', '2020', '2020-02-01', '2020-02-04', '0 Year 0 Months 4 Days', 'CRRIT03-Inheritance.pdf', '', 0, 0, '', 0, ''),
('CRRIT01', 'PYTHON', 'Seminar', '2020', '2020-01-01', '2020-01-06', '0 Year 0 Months 6 Days', 'CRRIT03-exception handling_1.pdf', '', 0, 0, '', 0, ''),
('CRRIT02', 'DBMS', 'Seminar', '2022', '2022-05-10', '2022-05-15', '0 Year 0 Months 6 Days', 'CRRIT04-pakages2.pdf', '', 0, 0, '', 0, ''),
('CRRIT02', 'PYTHON', 'Seminar', '2020', '2020-11-15', '2020-11-19', '0 Year 0 Months 5 Days', 'CRRIT04-JAVA R19 MATERIAL @ VGN.pdf', '', 0, 0, '', 0, ''),
('CRRCSE01', 'PYTHON', 'Conference', '2021', '', '', '', 'CRRIT01-CN UNIT-1(R19).pdf', 'python', 1, 2, '', 0, ''),
('CRRCSE02', 'CRR', 'Conference', '2021', '', '', '', 'CRRIT02-CN(R19) UNIT-5.pdf', 'python', 1, 2, '', 0, ''),
('CRRIT01', 'Ada', 'Conference', '2021', '', '', '', 'CRRIT03-CN(R19)-Unit 2.pdf', 'DevOps', 1, 2, '', 0, ''),
('CRRIT02', 'CRR', 'Conference', '2021', '', '', '', 'CRRIT04-CN(R19)-Unit 3.pdf', 'python', 1, 2, '', 0, ''),
('CRRCSE01', 'CRR', 'Paper Publication', '2019', '', '', '', 'CRRIT01-CN(R19)Unit-4.pdf', 'HTML', 2, 5, 'Journal', 2, 'Nothing'),
('CRRCSE02', 'Ada', 'Paper Publication', '2020', '', '', '', 'CRRIT02-DW-DM R19 Unit-1.pdf', 'python', 1, 2, 'Journal', 2, 'ABC'),
('CRRIT01', 'Ada', 'Paper Publication', '2018', '', '', '', 'CRRIT03-DW-DM R19 Unit-2.pdf', 'IT', 1, 2, 'Conference', 0, 'ABC'),
('CRRIT02', 'PYTHON', 'Paper Publication', '2019', '', '', '', 'CRRIT04-DW-DM R19 Unit-3.pdf', 'IT', 1, 2, '', 0, ''),
('CRRCSE01', 'SQL', 'Books', '2022', '', '', '', 'CRRCSE01-AppliedBigDataAnalyticsGlossary.pdf', 'Oxford Publishers', 2, 3, '', 0, ''),
('CRRIT01', 'HTML', 'Books', '2022', '', '', '', 'CRRIT01-ACN Unit 3.pdf', 'Vikram Publishers', 2, 0, '', 0, ''),
('CRRIT02', 'SQL', 'Books', '2020', '', '', '', 'CRRIT02-ACN Unit 4.pdf', 'Wiley', 1, 0, '', 0, ''),
('CRRCSE02', 'CSS', 'Books', '2021', '', '', '', 'CRRCSE02-ACN Unit 5.pdf', 'Vamsi Publishers', 2, 0, '', 0, ''),
('CRRCSE01', 'PYTHON', 'Books', '2021-22', '', '', '', 'CRRCSE01-4th bus 1st.pdf', 'Python', 1, 2, '', 0, ''),
('CRRIT01', 'HTML', 'Workshop', '2022-23', '2022-12-02', '2022-12-06', '0 Year 0 Months 5 Days', 'CRRIT01-veltech hallticket.pdf', '', 0, 0, '', 0, ''),
('CRRIT01', 'PYTHON', 'Workshop', '2021-22', '2021-12-10', '2021-12-14', '0 Year 0 Months 5 Days', 'CRRIT01-CS.pdf', '', 0, 0, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `dep`
--

CREATE TABLE `dep` (
  `duid` text NOT NULL,
  `dpwd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dep`
--

INSERT INTO `dep` (`duid`, `dpwd`) VALUES
('CSE', 'CRRCSE'),
('ECE', 'CRRECE'),
('IT', 'CRRIT'),
('CIVIL', 'CRRCIVIL'),
('MECH', 'CRRMECH'),
('EEE', 'CRREEE'),
('FED', 'CRRFED'),
('MBA', 'CRRMBA');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `edname` text NOT NULL,
  `edboard` text NOT NULL,
  `edprogram` text NOT NULL,
  `edbranch` text NOT NULL,
  `edpyear` int(10) NOT NULL,
  `edpcntg` int(10) NOT NULL,
  `euid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`edname`, `edboard`, `edprogram`, `edbranch`, `edpyear`, `edpcntg`, `euid`) VALUES
('CRR', 'JNTUK', 'BTECH', 'CSE', 2021, 72, 'CRRCSE01'),
('narayana junior college', 'BOI', 'inter', 'mpc', 2018, 92, 'CRRCSE01'),
('CRR', 'JNTUK', 'BTECH', 'IT', 2020, 76, 'CRRCSE02'),
('narayana junior college', 'BOI', 'INTER', 'MPC', 2016, 82, 'CRRCSE02'),
('JNTUK', 'JNTUK', 'BTECH', 'CSE', 2019, 70, 'CRRIT01'),
('CRR', 'JNTUK', 'BTECH', 'IT', 2021, 80, 'CRRIT02'),
('narayana junior college', 'BOI', 'INTER', 'MPC', 2016, 80, 'CRRIT01'),
('narayana junior college', 'BOI', 'INTER', 'MPC', 2016, 90, 'CRRIT02');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`ename`, `edes`, `ejyear`, `eeyear`, `expid`, `etime`) VALUES
('Sir C R Reddy College of Engineering', 'Assistant Professor', '2021', '2023', 'CRRCSE01', '2'),
('Sir C R Reddy College of Engineering', 'Professor', '2022', '2023', 'CRRCSE02', '1'),
('Sir C R Reddy College of Engineering', 'Associate Professor', '2021', '2023', 'CRRIT01', '2'),
('Sir C R Reddy College of Engineering', 'Associate Professor', '2021', '2023', 'CRRIT02', '2'),
('Sir C R Reddy College of Engineering', 'Professor', '', '2023', 'CRRCIVIL01', '2023'),
('Sir C R Reddy College of Engineering', 'Professor', '', '2023', 'CRRMBA01', '2023'),
('Sir C R Reddy College of Engineering', 'Professor', '', '2023', 'CRRMECH01', '2023');

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
  `fage` text NOT NULL,
  `faddress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_details`
--

INSERT INTO `faculty_details` (`fuid`, `fname`, `fdob`, `fgen`, `fdes`, `fdep`, `fphn`, `femail`, `fpwd`, `fage`, `faddress`) VALUES
('CRRCSE01', 'Samyog', '2000-08-04', 'Male', 'Assistant Professor', 'CSE', '9440065209', 'samyog@gmail.com', 'CRRCSE01', '22 Years', 'Vijayawada'),
('CRRCSE02', 'Prasad', '2000-10-02', 'Female', 'Professor', 'ECE', '9848621256', 'prasad@gmail.com', 'CRRCSE02', '22 Years', 'Eluru'),
('CRRIT01', 'Uma', '2002-11-06', 'Female', 'Associate Professor', 'IT', '9182530642', 'skthanuz@gmail.com', 'CRRIT01', '20 Years', 'Guntur'),
('CRRIT02', 'Ganesh', '2000-05-16', 'Male', 'Assistant Professor', 'EEE', '6918654795', 'ganesh@gmail.com', 'CRRIT02', '22 Years', 'Remalle'),
('CRRCIVIL01', 'Yeshwanth', '2000-05-01', 'Male', 'Professor', 'CIVIL', '7441258963', 'yeshwanth@gmail.com', 'CRRCIVIL01', '22 Years', 'Vijayawada'),
('CRRMBA01', 'Sandeep', '2000-12-05', 'Male', 'Professor', 'MBA', '9876543210', 'sandeep@gmail.com', 'CRRMBA01', '22 Years', 'Vizag'),
('CRRMECH01', 'Dheeraj', '1999-09-22', 'Male', 'Professor', 'MECH', '7999572643', 'dheeraj@gmail.com', 'CRRMECH01', '23 Years', 'Nunna');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`luid`, `ltime`, `lstart`, `lend`, `lremain`, `lrason`, `lyear`) VALUES
('CRRIT01', '5', '2023-02-01', '2023-02-05', '9', 'Fever', '2022-23'),
('CRRIT01', '8', '2022-10-21', '2022-10-28', '6', 'Personal', '2021-22'),
('CRRCSE01', '5', '2022-01-21', '2022-01-25', '9', 'Medical Leave', '2022-23'),
('CRRCSE02', '4', '2022-03-01', '2022-03-04', '10', 'Personal Leave', '2021-22'),
('CRRIT02', '2', '2021-10-21', '2021-10-22', '12', 'Fever', '2021-22');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `cuid` text NOT NULL,
  `cname` text NOT NULL,
  `cnumber` int(10) NOT NULL,
  `ctype` text NOT NULL,
  `cfile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`cuid`, `cname`, `cnumber`, `ctype`, `cfile`) VALUES
('CRRIT01', 'CRR', 12, 'Life-time', 'CRRIT01-cambridge-ielts-3.pdf'),
('CRRCSE01', 'HOD', 2, 'College', 'CRRCSE01-The_Four_Vs_of_Big_Data-infographic_text.pdf'),
('CRRCSE01', 'Co-ordinator', 2, 'Life-time', 'CRRCSE01-ielts-online-guide-for-test-takers.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `patents`
--

CREATE TABLE `patents` (
  `cuid` text NOT NULL,
  `cname` text NOT NULL,
  `cauthor` text NOT NULL,
  `cnumber` int(10) NOT NULL,
  `cpos` int(10) NOT NULL,
  `cyear` text NOT NULL,
  `cstatus` text NOT NULL,
  `cfile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patents`
--

INSERT INTO `patents` (`cuid`, `cname`, `cauthor`, `cnumber`, `cpos`, `cyear`, `cstatus`, `cfile`) VALUES
('CRRIT01', 'PYTHON', 'suresh', 2, 3, '2022-23', 'Ongoing', 'CRRIT01-Cambridge IELTS 9.pdf'),
('CRRCSE01', 'HOD', 'vamsi, DHHFF', 123, 14, '2021-22', 'Completed', 'CRRCSE01-Data_analytics_cycle_overview-transcript.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `cuid` text NOT NULL,
  `cname` text NOT NULL,
  `ctype` text NOT NULL,
  `cperson` text NOT NULL,
  `camount` int(10) NOT NULL,
  `cperiod` text NOT NULL,
  `cstatus` text NOT NULL,
  `cfile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`cuid`, `cname`, `ctype`, `cperson`, `camount`, `cperiod`, `cstatus`, `cfile`) VALUES
('CRRIT01', 'CRR', 'Sponsored', 'python', 120250, '2018-2023', 'Ongoing', 'CRRIT01-Cambridge ielts 7 .pdf'),
('CRRIT01', 'PYTHON', 'Consultancy', 'Sam', 120000, '2016-2020', 'Completed', 'CRRIT01-cambridge_ielts-6.pdf'),
('CRRCSE01', 'ML', 'Sponsored', 'Oxford Publishers', 12050, '2017-2022', 'Completed', 'CRRCSE01-BCT ass-2.pdf'),
('CRRCSE01', 'DevOps', 'Consultancy', 'Vikram', 10000, '2019-23', 'Ongoing', 'CRRCSE01-BCT ASS-1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `responsibilities`
--

CREATE TABLE `responsibilities` (
  `cuid` text NOT NULL,
  `cdescription` text NOT NULL,
  `clevel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responsibilities`
--

INSERT INTO `responsibilities` (`cuid`, `cdescription`, `clevel`) VALUES
('CRRIT01', 'NBA Co-ordinator', 'Department'),
('CRRIT02', 'Coordinator', 'College'),
('CRRCSE01', 'HOD', 'Department'),
('CRRCSE01', 'Co-ordinator', 'College'),
('CRRCSE02', 'Fest Co-Ordinator', 'Department');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `cuid` text NOT NULL,
  `ctype` text NOT NULL,
  `cname` text NOT NULL,
  `cfile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`cuid`, `ctype`, `cname`, `cfile`) VALUES
('CRRCSE01', 'Technology', 'DATA SCIENCE', 'CRRCSE01-Cognitive Class DS0101EN Certificate _ Cognitive Class.pdf'),
('CRRCSE01', 'Programming Language', 'PYTHON', 'CRRCSE01-ACN Unit 1.pdf'),
('CRRCSE01', 'Programming Language', 'HTML', 'CRRCSE01-ACN Unit 2.pdf');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`suid`, `sname`, `sclass`, `ssem`, `ssec`, `syear`, `sstrength`, `spass`, `spassp`, `sfeed`) VALUES
('CRRCSE01', 'C++', '2', '2-1', 'A', '2021-22', '70', '62', '89', '14'),
('CRRIT02', 'python', '3', '1', 'b', '2022-23', '70', '58', '83', '15'),
('CRRIT01', 'HTML', 'III/IV', '6', 'B', '2021-22', '70', '62', '89', '50'),
('CRRCSE02', 'HTML', '4', '1', 'A', '2022-23', '63', '59', '94', '50');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workload`
--

INSERT INTO `workload` (`wuid`, `wyear`, `wsem`, `wsub`, `wtheory`, `wlab`, `wtotal`, `wfrac`, `wfile`) VALUES
('CRRIT02', '2022-23', '4', 'Html', '6', '2', '8', '0.50', 'CRRIT02-Cambridge IELTS 10.pdf'),
('CRRIT01', '2022-23', '7', 'Cloud Computing', '10', '0', '10', '0.83', 'CRRIT01-BCT ass-2.pdf'),
('CRRCSE01', '2022-23', '7', '2', '5', '1', '6', '0.38', 'CRRCSE01-UMA DOC.pdf'),
('CRRCSE02', '2021-22', '4', '1', '5', '0', '5', '0.63', 'CRRCSE02-PRASAD DOC.pdf');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
