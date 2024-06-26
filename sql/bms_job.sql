-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 01:08 PM
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
(1, 'admin@gmail.com', 'admin', '2024-05-14 15:28:31'),
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
(116, 147, 'Mirshath', 'mirshath.mmm@gmail.com', '0254904455', 'CV.pdf', 101, '2024-06-26 10:13:09', 'Pending'),
(122, 194, 'Mohamed', 'info@hazz.lk', '0254904455', 'CV2.pdf', 92, '2024-06-26 10:52:51', 'Pending');

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
(18, 'Bussiness', '2024-06-23 09:40:56'),
(19, 'Acc', '2024-06-23 09:41:01');

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
  `categoryId` int(10) DEFAULT NULL,
  `categoryName` varchar(25) DEFAULT NULL,
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
  `admin_status` varchar(255) DEFAULT NULL,
  `application_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_title`, `company_name`, `company_logo`, `job_category`, `categoryId`, `categoryName`, `job_description`, `employment_type`, `location`, `salary_range`, `skills_required`, `education_level`, `experience_level`, `application_deadline`, `contact_info`, `additional_info`, `created_at`, `recuiter_id`, `postedBy`, `admin_status`, `application_status`) VALUES
(92, 'Network Interns', 'ESOFT', 'job2.jpg', '', NULL, NULL, 'Network Intern', 'Part-time', 'Kandy', '2500', 'c++, react, js', 'HighSchool', 'Entry_Level', '2024-06-27', '0254904455', 'Network Intern', '2024-06-09 17:37:20', 140, ' Admin', 'Approved', 'active'),
(93, 'Graphics Q', 'BMS', 'job 1.jpg', '', NULL, NULL, 'qqqq', 'Part-time', 'Colobo', '5445', 'multimedia, pptx', 'PhD', 'Mid_Level', '2024-06-26', '025490455', 'sad', '2024-06-09 18:52:31', 11, ' Admin', 'Pending', 'closed'),
(95, 'PHP-Interns', 'BMS', 'php intern.jpg', 'it', NULL, NULL, 'sdassasasas', 'Internship', 'Anuradhapura', '6500', 'QQQ', 'HighSchool', 'Entry_Level', '2024-06-26', '0254904455', 'fdasf', '2024-06-10 05:23:16', 11, 'BMS', 'Approved', 'closed'),
(101, 'Communications', 'ESOFT', 'download.png', 'It', NULL, NULL, 'asAS', 'Full-time', 'hf', '22222222', 'Sas', 'HighSchool', 'Entry_Level', '2024-06-29', '22222', 'sAS', '2024-06-22 07:09:38', 140, ' Admin', 'Approved', 'active'),
(103, 'Supervisor', 'CGS Company', 'php intern.jpg', 'It', NULL, NULL, 'sasa', 'Full-time', 'Colombo', '2500', 'c++, Java', 'HighSchool', 'Entry_Level', '2024-06-28', '025490455', 'Additional', '2024-06-26 10:40:50', 193, 'CGS Company', 'Approved', 'active');

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
(99, 147, 11),
(100, 147, 140);

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
  `firstname` varchar(50) DEFAULT NULL,
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
(140, 'rec', 'rec', 'rec@gmail.com', '$2y$10$GZNv5WhzlwGL89jt7/v3QudRuWgKJZbEKaF/TotzWixlpF9HhZNEq', '2024-05-29 15:40:50', 'recruiter', 254904455, 'rec.ac.lk', 'images (1).png', 'ESOFT', NULL, NULL),
(147, 'Mirshath', 'Mohamed', 'mirshath.mmm@gmail.com', '$2y$10$KguObmKDNGGjeC0Jme.q6uHu35tmI8kK.V2MZIPlmNQ9JJBfc1pPm', '2024-06-03 10:42:16', 'jobSeeker', 254904455, '', '667a90d65e40f.jpg', '', '', 'Anuradha Pura'),
(190, 'Hasni', 'Nihar', 'webmaster@bms.ac.lk', '$2y$10$aGk4On2nlPrNLwOGqao3N.eWliwNIRwM2SqhcG3WvvdapOFAnFO.K', '2024-06-26 15:23:13', 'jobSeeker', NULL, NULL, NULL, NULL, NULL, NULL),
(191, 'Jawfar', 'Sadiq', 'hrm@bms.ac.lk', '$2y$10$aN6Lyj91BTh4ofvFvTT2ve9GrO0H7SDS1rjhq0GI8fbmqA7isZ0b.', '2024-06-26 15:26:29', 'jobSeeker', NULL, NULL, NULL, NULL, NULL, NULL),
(192, 'Mirshath', 'Mohamed', 'mirshath.m@cgs.lk', '$2y$10$9g7no7Vehc1Gr7yUOxMn/OY91E8uUaVfLAZzOItIZd9amAWQdBCFO', '2024-06-26 15:28:19', 'jobSeeker', NULL, NULL, NULL, NULL, NULL, NULL),
(193, NULL, NULL, 'mirmirsha123@gmail.com', '$2y$10$BVa9gcq1JzYIrIBtOdqoDeTPyTXS6n9sa2c7sH/Ugg3ZTlVvIfS5S', '2024-06-26 16:08:26', 'recruiter', 254904455, 'www@sss.com', 'bms-logo-RAW-1-1024x724.png', 'CGS Company', NULL, NULL),
(194, 'Mohamed', 'Hasni', 'info@hazz.lk', '$2y$10$6.b.VKZAZgc.G/5V/GOjBO9/dcPJafVG2h4hVwmuqvthKcTNoNdna', '2024-06-26 16:19:33', 'jobSeeker', NULL, NULL, '667bf26ca8f7d.jpg', NULL, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `jobseeker_company_subscriptions`
--
ALTER TABLE `jobseeker_company_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `userregister`
--
ALTER TABLE `userregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

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
