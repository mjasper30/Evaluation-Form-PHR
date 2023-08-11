-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2023 at 09:03 AM
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
  `category` varchar(255) NOT NULL,
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

INSERT INTO `questions` (`question_id`, `category`, `question`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `correct_answer`) VALUES
(1, 'Open Overtime', 'I have basis of telling workers that aside from there normal hours, there is a guarantee of having overtime work', 'Yes', 'No', 'This is not applicable to me', 'I don\'t know', 'a'),
(2, 'Placement Fee', 'How much is the standard Placement Fee?', '1 month basic salary', '1 month basic salary + 300 food allowance', '1 month basic salary + value added tax', 'c. 1 month basic salary + insurance', 'a'),
(3, 'Client Status', 'I am updated with the accreditation status of every employer under my account, whether the client\'s company is still valid or not.', 'Yes', 'No', 'This is not applicable to me', 'I don\'t know', 'a'),
(4, 'Job Order Status', 'I am updated with the accreditation status of job orders of employers under my account, whether the client\'s company is still valid or not.', 'Yes', 'No', 'This is not applicable to me', 'I don\'t know', 'a'),
(5, 'PHR official email address for workers', 'What is the email to be disseminated to the workers?', 'phrwe@gmail.com', 'apply@gmail.com', 'apply@phrwe.com', 'apply@phr.com', 'c'),
(6, 'Placement Fee', 'I am aware that details about the Placement Fee must be communicated well right from the start of hiring.', 'Yes', 'No', 'This is not applicable to me', 'I don\'t know', 'a'),
(7, 'Not set in the excel', 'My basis of informing applicants for guaranteed overtime on their work contract is based on -', 'is based own my own judgement', 'is based on the official information  given to me by authorized person', 'is based on my feelings', ' is based on other person', 'b'),
(8, 'not set and idk the answer', 'Before endorsing CVs to client, I shall verify that the worker has', 'has no hit in NBI', 'has no re-entry visa issue', 'has intact valid passport ', 'has valid ID', 'c'),
(9, 'PHR Information', 'What is the complete name of PHR agency?', 'Philippine Human Resource Worldwide Employment Inc.', 'Philippine Human Resource Worldwide Employment Co.', 'Philippine Human Resource', 'Philippine Human Resource Worldwide Employer Inc.', 'b'),
(10, 'PHR Information', 'What is the official email address of PHR for applicants?', 'apply@phrwe.com', 'applyphrwe@gmail.com', 'applyphr@gmail.com', 'applyphrwe@phr.com', 'a'),
(11, 'PHR Information', 'What is the official email address of PHR for prospective employers?', 'management@phrwe.com', 'management.phr@gmail.com', 'management.phrwe@gmail.com', 'management.phr@gmail.com', 'a'),
(12, 'PHR Information', 'What is the official address of the main office of PHR?', '004 De Perio St. Matain Subic Zamboanga', ' 004 De Perio St. Matain Subic Zambales', '005 De Perio St. Matain Subic Zambales', '005 De Perio St. Matain Subic Zamboanga', 'b'),
(13, 'PHR Information', 'What is the business address of PHR Manila Office?', '1813 Taft Avenue, Malate Manila, Philippines 1004', '1814 Taft Avenue, Malate Manila, Philippines 1004', '1817 Taft Avenue, Malate Manila, Philippines 1004', '1812 Taft Avenue, Malate Manila, Philippines 1004', 'd'),
(14, 'PHR Information', 'What is the official landline number of PHR?', '+63-2-8-5178448, +63955-581-3156', '+63-2-8-5188558, +63955-581-3156', '+63-2-4-5188448, +63955-581-3156', '+63-2-8-5188448, +63955-581-3156', 'd'),
(15, 'PHR Information', 'Where are the branches of PHR located?', 'NAVAL, SUBIC, PALAWAN, TACLOBAN, ILOILO, BATANGAS', 'NAVAL, SUBIC, PALAWAN, TACLOBAN, ILOILO, BACOLOD', 'NAVAL, SUBIC, PALAWAN, TACLOBAN, ILOCOS, BACOLOD', 'NAVAL, SUBIC, PALAWAN, TACLOBAN, ILOILO, BICOL', 'b'),
(16, 'PHR Information', 'How many are there in PHR if main office is included?', '6', '8', '7', '9', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `questions_responses`
--

CREATE TABLE `questions_responses` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Dumping data for table `textbox`
--

INSERT INTO `textbox` (`textbox_id`, `textbox`, `timestamp`) VALUES
(4, 'My basis of informing applicants for guaranteed overtime on their work contract is based on -', '2023-08-11 06:07:05'),
(5, 'How to access the job listing of PHR?', '2023-08-11 07:01:26'),
(6, 'How to access the online job application form of PHR?', '2023-08-11 07:01:38'),
(7, 'How to access the MIS System of PHR?', '2023-08-11 07:01:44'),
(8, 'How to access the online view of PHR Client ... to PHR line ups?', '2023-08-11 07:01:52'),
(9, 'What are your active clients assigned so far?', '2023-08-11 07:02:11'),
(10, 'What are the issues for end client?', '2023-08-11 07:02:16');

-- --------------------------------------------------------

--
-- Table structure for table `textbox_responses`
--

CREATE TABLE `textbox_responses` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `textbox_id` int(11) NOT NULL,
  `answer` longtext NOT NULL,
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
-- Indexes for table `questions_responses`
--
ALTER TABLE `questions_responses`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `textbox_responses`
--
ALTER TABLE `textbox_responses`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `questions_responses`
--
ALTER TABLE `questions_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `textbox`
--
ALTER TABLE `textbox`
  MODIFY `textbox_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `textbox_responses`
--
ALTER TABLE `textbox_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
