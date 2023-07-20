-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2023 at 04:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluation_form`
--

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `firstname`, `lastname`, `username`, `password`, `role`) VALUES
(1, 'Jasper', 'Macaraeg', 'mjasper30', '$2y$10$2B8uUoBBuDc7UMBmoTcPHuoDo12bXSJgmbyveN2Yureofw61urrlW', 'admin'),
(3, 'Jasper', 'Macaraeg', 'jasper', '$2y$10$2B8uUoBBuDc7UMBmoTcPHuoDo12bXSJgmbyveN2Yureofw61urrlW', 'employer'),
(4, 'test', 'test', 'test', '$2y$10$c5WOhyXpnLuO.cRSekVcVe4EyWrmGhF64uOj1OysRIiUXBdvYqvca', 'employer'),
(5, 'Patrick', 'Cabfit', 'pat', '$2y$10$DnM8VemnNf.hHzRacy2ksOO8PCP7Hfq21FrfxxL7Ou65lMeOBw4Na', 'employer'),
(6, 'testing', 'testing', 'testing', '$2y$10$nyk32wR8HEYXH4AFCqxcW.9owUvyWC5MA0HY0wXfwTX1al8nqjgZu', 'employer');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `choice_a` varchar(255) NOT NULL,
  `choice_b` varchar(255) NOT NULL,
  `choice_c` varchar(255) NOT NULL,
  `choice_d` varchar(255) NOT NULL,
  `correct_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `correct_answer`) VALUES
(1, 'Who is the father of C language?', 'Steve Jobs', 'James Gosling', 'Dennis Ritchie', 'Rasmus Lerdorf', 'c'),
(2, 'Which of the following is not a valid C variable name?', 'int number', 'float rate', 'int variable_count', 'int $main', 'd'),
(3, 'All keywords in C are in ____________', 'LowerCase letters', 'UpperCase letters', 'CamelCase letters', 'CamelCase letters', 'a'),
(4, '_______ is the process of finding errors and fixing them within a program.', 'Compiling', 'Executing', 'Debugging', 'Scanning', 'c'),
(5, 'Which command will stop an infinite loop?', 'Alt - C', 'Shift - C', 'Esc', 'Ctrl - C', 'd'),
(6, 'How much is the standard Placement Fee?', '1 month basic salary', '1 month basic salary + 300 food allowance', '1 month basic salary + value added tax', 'c. 1 month basic salary + insurance', 'a'),
(7, 'What is the email to be disseminated to the workers?', 'phrwe@gmail.com', 'apply@gmail.com', 'apply@phrwe.com', 'applywe@phrwe.com', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `score_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `time_finished` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`score_id`, `username`, `score`, `time_finished`) VALUES
(1, 'pat', 7, '2023-07-19 05:11:33'),
(2, 'test', 6, '2023-07-19 07:04:35');

-- --------------------------------------------------------

--
-- Table structure for table `textbox`
--

CREATE TABLE `textbox` (
  `textbox_id` int(11) NOT NULL,
  `textbox` longtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`score_id`);

--
-- Indexes for table `textbox`
--
ALTER TABLE `textbox`
  ADD PRIMARY KEY (`textbox_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `textbox`
--
ALTER TABLE `textbox`
  MODIFY `textbox_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
