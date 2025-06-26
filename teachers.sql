-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2016 at 01:18 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teachers`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `staff_id` varchar(55) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `user_name`, `staff_id`, `user_pass`) VALUES
(4, 'Kofi Kum', '121233', '$2y$10$7JCcW52VxeEHH5c8iHbk2uFsyVQtbZsIrh4wRyQgsdyboh2YKwzJi'),
(3, 'Henry Safori', '232323', '$2y$10$Yyif05l1OrfJ6lqe4OibAugzKtNSxilCsvcQas8IWZoSPvKnTowH6');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `tr_id` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `comp_date` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `tr_id`, `type`, `description`, `comp_date`) VALUES
(2, 'B0234', 'Salary', 'my Salary has not been validated for the moths of April', '2016-08-16 16:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `user_pass` varchar(60) NOT NULL,
  `user_department` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`user_id`, `user_name`, `staff_id`, `user_pass`, `user_department`) VALUES
(1, 'Jacob Kuma', '434411', '$2y$10$4ByKjQSuHTM4tWvN7BGk8uCFv3M7K6rFuUT5nuJdjDE4aa4.CuUxK', 'HR'),
(2, 'den busa', '23434', '$2y$10$d.R3MGjTpeCv4TZ1TQ2f8.vkjJHOKvUV1Nj532ulPtBxOiwZfksm.', 'HR'),
(6, 'James Larm', 'C234411', '$2y$10$/1.iuvXBLzC/q3KXuqszv.QxvGhxDQneZfPSGg/xHypNq7eUnrYGW', 'IPPD');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `tr_id` varchar(11) NOT NULL,
  `firstAppoint` varchar(25) NOT NULL,
  `applicLetter` varchar(25) NOT NULL,
  `last_promo` varchar(25) NOT NULL,
  `last_log_date` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id`, `tr_id`, `firstAppoint`, `applicLetter`, `last_promo`, `last_log_date`) VALUES
(2, 'B0234', '7.jpg', '9.jpg', '11.jpg', '2016-08-17 04:52:40');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(25) NOT NULL,
  `rtitle` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `deadline` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `rtitle`, `description`, `deadline`) VALUES
(4, 'Promotion', 'All Teachers Who are due for promotion are to submit their documents for processing. thank you', '12th September, 2016'),
(3, 'Promotion', 'All Teachers Who are due for promotion are to submit their documents for processing. thank you', '12th September, 2016');

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `id` int(25) NOT NULL,
  `tr_id_comp` varchar(25) NOT NULL,
  `response` text NOT NULL,
  `resp_time` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `response`
--

INSERT INTO `response` (`id`, `tr_id_comp`, `response`, `resp_time`) VALUES
(6, 'B0234', 'Kindly submit your documents for validation.', '2016-08-17 06:10:22');

-- --------------------------------------------------------

--
-- Table structure for table `teach_tb`
--

CREATE TABLE `teach_tb` (
  `id` int(11) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `staf_id` varchar(11) NOT NULL,
  `password` varchar(60) NOT NULL,
  `reg_number` varchar(10) NOT NULL,
  `ssf_number` varchar(25) NOT NULL,
  `current_rank` varchar(25) NOT NULL,
  `current_school` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teach_tb`
--

INSERT INTO `teach_tb` (`id`, `fname`, `lname`, `staf_id`, `password`, `reg_number`, `ssf_number`, `current_rank`, `current_school`) VALUES
(8, 'Sam', 'Kofi', 'C4567', '$2y$10$bKNZQPRt0dcEYXTkORsmCeGQ6HY7BaVEkR0D4gpRtXKN5S6WVMUGW', '1298/10', 'B123456', 'Sup I', 'Oyibi Primary'),
(7, 'Simon', 'Jones', 'B0234', '$2y$10$z5ANun6V5nRqjl/FcO7QH.7KxNQvFZQyDicWovANM5fV2OdVlr7bu', '43456/10', 'D3445622343', 'Sup I', 'Ave D/A Primary');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id` int(11) NOT NULL,
  `tr_id` varchar(11) NOT NULL,
  `firstAppoint` varchar(25) NOT NULL,
  `transferApp` varchar(25) NOT NULL,
  `upload_date` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`id`, `tr_id`, `firstAppoint`, `transferApp`, `upload_date`) VALUES
(2, 'B0234', '7.jpg', '13.jpg', '2016-08-17 04:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `upgrading_tb`
--

CREATE TABLE `upgrading_tb` (
  `id` int(11) NOT NULL,
  `tr_id` varchar(11) NOT NULL,
  `app_letter` varchar(25) NOT NULL,
  `certificate` varchar(25) NOT NULL,
  `pay_slip` varchar(25) NOT NULL,
  `last_log_date` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upgrading_tb`
--

INSERT INTO `upgrading_tb` (`id`, `tr_id`, `app_letter`, `certificate`, `pay_slip`, `last_log_date`) VALUES
(1, 'B0234', '13.jpg', '11.jpg', '14.jpg', '2016-08-17 04:57:50');

-- --------------------------------------------------------

--
-- Table structure for table `validation`
--

CREATE TABLE `validation` (
  `id` int(11) NOT NULL,
  `tr_id` varchar(11) NOT NULL,
  `appletter` varchar(25) NOT NULL,
  `cert1` varchar(25) NOT NULL,
  `cert2` varchar(25) NOT NULL,
  `cert3` varchar(25) NOT NULL,
  `upload_date` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `validation`
--

INSERT INTO `validation` (`id`, `tr_id`, `appletter`, `cert1`, `cert2`, `cert3`, `upload_date`) VALUES
(26, 'B0234', '7.jpg', '9.jpg', '10.jpg', '13.jpg', '2016-08-17 04:47:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`staff_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tr_id` (`tr_id`),
  ADD KEY `staf_id` (`tr_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `request` ADD FULLTEXT KEY `description` (`description`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teach_tb`
--
ALTER TABLE `teach_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staf_id` (`staf_id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tr_id` (`tr_id`),
  ADD KEY `staf_id` (`tr_id`);

--
-- Indexes for table `upgrading_tb`
--
ALTER TABLE `upgrading_tb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tr_id` (`tr_id`),
  ADD KEY `staf_id` (`tr_id`);

--
-- Indexes for table `validation`
--
ALTER TABLE `validation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staf_id` (`tr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `teach_tb`
--
ALTER TABLE `teach_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `upgrading_tb`
--
ALTER TABLE `upgrading_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `validation`
--
ALTER TABLE `validation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
