-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 05:35 AM
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
-- Database: `bms_job`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `date`) VALUES
(1, 'admin', 'admin', '2024-05-14 15:28:31'),
(2, 'ad', 'ad', '2024-06-05 11:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `jobseeker_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `resume_file` varchar(255) DEFAULT NULL,
  `applied_job_id` int(11) DEFAULT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `jobseeker_id`, `name`, `email`, `phone`, `resume_file`, `applied_job_id`, `applied_at`, `status`) VALUES
(84, 147, 'Amaan', 'mirshath.mmm@gmail.com', '0766158014', 'CV.pdf', 64, '2024-06-05 05:27:55', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `created_at`) VALUES
(9, 'It', '2024-05-26 03:34:48'),
(10, 'Studio', '2024-05-26 03:34:48'),
(12, 'Graphics', '2024-05-26 03:35:14'),
(13, 'Accounting', '2024-05-29 03:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `job_category` varchar(100) NOT NULL,
  `job_description` text NOT NULL,
  `employment_type` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `salary_range` varchar(100) NOT NULL,
  `skills_required` text NOT NULL,
  `education_level` varchar(50) NOT NULL,
  `experience_level` varchar(50) NOT NULL,
  `application_deadline` date NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `additional_info` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `recuiter_id` int(11) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `admin_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_title`, `company_name`, `company_logo`, `job_category`, `job_description`, `employment_type`, `location`, `salary_range`, `skills_required`, `education_level`, `experience_level`, `application_deadline`, `contact_info`, `additional_info`, `created_at`, `recuiter_id`, `postedBy`, `admin_status`) VALUES
(53, 'SE-Intern', 'BMS', 'miProfileChecking.png', '', 'bbbbb', 'Part-time', 'Colombo', '25000', 'c++, Java, react, javascript', 'PhD', 'Entry_Level', '2024-05-28', '02548546', 'need a 5 years experience s', '2024-05-28 09:45:45', 11, ' Admin', 'Approved'),
(64, 'mmm', 'BMS', 'sign-page-abstract-concept-illustration_335657-3875.jpg', 'It', 'dfgdfg', 'Full-time', 'gdfgd', '22222222', 'gdfgd', 'HighSchool', 'Entry_Level', '2024-06-12', '22222', 'gddgf', '2024-05-31 06:08:29', 11, ' Admin', 'Approved'),
(65, 'sss', 'BMS', 'download.png', 'It', 'afaf', 'Full-time', 'Colombo', '22222222', 'fafa', 'HighSchool', 'Entry_Level', '2024-06-14', '22222', 'fasfa', '2024-06-06 08:41:06', 11, 'BMS', 'Approved'),
(66, 'mmmmmm', 'REC', 'images.jfif', 'It', 'sadasd', 'Part-time', 'hf', '22222222', 'asdas', 'HighSchool', 'Entry_Level', '2024-06-12', '22222', 'asdasd', '2024-06-06 10:28:24', 140, ' Admin', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_company_subscriptions`
--

CREATE TABLE `jobseeker_company_subscriptions` (
  `id` int(11) NOT NULL,
  `jobseeker_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobseeker_company_subscriptions`
--

INSERT INTO `jobseeker_company_subscriptions` (`id`, `jobseeker_id`, `company_id`) VALUES
(39, 147, 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userregister`
--

CREATE TABLE `userregister` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `usertype` varchar(255) DEFAULT NULL,
  `phone_no` int(11) DEFAULT NULL,
  `websites` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `studentCV` varchar(255) DEFAULT NULL,
  `St_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userregister`
--

INSERT INTO `userregister` (`id`, `firstname`, `lastname`, `email`, `password`, `created_at`, `usertype`, `phone_no`, `websites`, `profile`, `company_name`, `studentCV`, `St_address`) VALUES
(11, 'Mirshath ', 'Mohamed', 'mmm@gmail.com', '$2y$10$FITQAH8/tOxb7d4Ww2YrG.STA5c3xi9sORYZQxdWIeGfBk4I.EJSK', '2024-05-16 16:14:11', 'recruiter', 2549044, 'bms.ac.lk', 'images.png', 'BMS', NULL, NULL),
(135, 'Mirshath', 'Mohammed', 'mirshath@gmail.com', '$2y$10$F/36U22ZK52rZXRfDvgEheB/792bXT9pe8btzi9X/jefFS.0C9CHi', '2024-05-28 16:51:06', 'jobSeeker', 766158014, '', 'yellow.jfif', '', '', 'Colombo'),
(140, 'rec', 'rec', 'rec@gmail.com', '$2y$10$GZNv5WhzlwGL89jt7/v3QudRuWgKJZbEKaF/TotzWixlpF9HhZNEq', '2024-05-29 15:40:50', 'recruiter', 254904455, 'rec.ac.lk', 'yellow.jfif', 'REC', NULL, NULL),
(147, 'Amaan', 'Mohammed', 'mirshath.mmm@gmail.com', '$2y$10$CNaGNScznO9BxY4.cW6lQepSfhVKYRldZgzyXcsbO.TAGWRcCKYtW', '2024-06-03 10:42:16', 'jobSeeker', 254904455, NULL, 'profile.jpg', '', '', 'Wellampitiya'),
(148, 'Hasni', 'Nihar', 'hasninihar@gmail.com', '$2y$10$8pCXwdfbAgPWEvLp.skgnejogl7cA4N5yKSs5SHM3eEUAzHPAJdtK', '2024-06-03 11:50:44', 'jobSeeker', 254904455, '', 'dc2ec5a571974417a5551420a4fb0587.jpg', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobseeker_id` (`jobseeker_id`),
  ADD KEY `applied_job_id` (`applied_job_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobseeker_company_subscriptions`
--
ALTER TABLE `jobseeker_company_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobseeker_id` (`jobseeker_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `userregister`
--
ALTER TABLE `userregister`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `jobseeker_company_subscriptions`
--
ALTER TABLE `jobseeker_company_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `userregister`
--
ALTER TABLE `userregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `applicants_ibfk_1` FOREIGN KEY (`jobseeker_id`) REFERENCES `userregister` (`id`),
  ADD CONSTRAINT `applicants_ibfk_2` FOREIGN KEY (`applied_job_id`) REFERENCES `jobs` (`id`);

--
-- Constraints for table `jobseeker_company_subscriptions`
--
ALTER TABLE `jobseeker_company_subscriptions`
  ADD CONSTRAINT `jobseeker_company_subscriptions_ibfk_1` FOREIGN KEY (`jobseeker_id`) REFERENCES `userregister` (`id`),
  ADD CONSTRAINT `jobseeker_company_subscriptions_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `userregister` (`id`);

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userregister` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
