-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 01:22 PM
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
  `company_email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `resume_file` varchar(255) DEFAULT NULL,
  `applied_job_id` int(11) DEFAULT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_image`, `created_at`) VALUES
(9, 'It', 'cat tech.jpg', '2024-05-26 03:34:48'),
(36, 'Teaching', 'cat tech.jpg', '2024-06-27 18:19:29');

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
(114, 'Robotics', 'BMS', 'robo.jpg', 'It', NULL, NULL, '<h3>Workshop Description:</h3>\r\n\r\n<p>&quot;Dive into the world of robotics with our engaging workshops at Robotics Revolution! Designed for all skill levels, our hands-on sessions will cover everything from basic concepts to advanced applications. Led by industry experts, participants will gain practical insights and skills essential for the future of automation. Explore, experiment, and elevate your understanding of robotics in these dynamic learning environments.&quot;</p>\r\n\r\n<h3>Competition Description:</h3>\r\n\r\n<p>&quot;Gear up for excitement and challenge at the Robotics Revolution Competition! Whether you&#39;re a seasoned competitor or new to robotics, this event invites teams to showcase their innovation and problem-solving skills. From autonomous challenges to creative design tasks, participants will tackle real-world scenarios and vie for top honors. Join us for a thrilling display of talent and technology that pushes the boundaries of robotics.&quot;</p>\r\n', 'Full-time', 'Colombo', '25000', 'C#', 'HighSchool', 'Entry_Level', '2024-07-18', '0254904455', '<h3>Workshop Description:</h3>\r\n\r\n<p>&quot;Dive into the world of robotics with our engaging workshops at Robotics Revolution! Designed for all skill levels, our hands-on sessions will cover</p>\r\n', '2024-07-01 09:44:36', 11, ' Admin', 'Approved', 'active'),
(115, 'DCN', 'ESOFT', 'network intern.jpg', 'It', NULL, NULL, '<h3><strong>Workshop Description:</strong></h3>\r\n\r\n<p>&quot;Dive into the world of robotics with our engaging workshops at Robotics Revolution! Designed for all skill levels, our hands-on sessions will cover everything from basic concepts to advanced applications. Led by industry experts, participants will gain practical insights and skills essential for the future of automation. Explore, experiment, and elevate your understanding of robotics in these dynamic learning environments.&quot;</p>\r\n\r\n<h3><strong>Competition Description:</strong></h3>\r\n\r\n<p>&quot;Gear up for excitement and challenge at the Robotics Revolution Competition! Whether you&#39;re a seasoned competitor or new to robotics, this event invites teams to showcase their innovation and problem-solving skills. From autonomous challenges to creative design tasks, participants will tackle real-world scenarios and vie for top honors. Join us for a thrilling display of talent and technology that pushes the boundaries of robotics.&quot;</p>\r\n', 'Internship', 'Colombo', '28000', 'IP, C++ , C#', 'PhD', 'Entry_Level', '2024-07-19', '0254907755', '<h3>Ompetition Description:</h3>\r\n\r\n<p>&quot;Gear up for excitement and challenge at the Robotics Revolution Competition! Whether you&#39;re a seasoned competitor or new to r</p>\r\n', '2024-07-01 09:50:55', 140, ' Admin', 'Approved', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_company_subscriptions`
--

CREATE TABLE `jobseeker_company_subscriptions` (
  `id` int(11) NOT NULL,
  `jobseeker_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `user_active` tinyint(4) NOT NULL DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `usertype` varchar(255) DEFAULT NULL,
  `phone_no` int(11) DEFAULT NULL,
  `websites` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `studentCV` varchar(255) DEFAULT NULL,
  `St_address` varchar(255) DEFAULT NULL,
  `education_qualification` varchar(255) DEFAULT NULL,
  `interested_field` varchar(255) DEFAULT NULL,
  `professional_qualification` varchar(255) DEFAULT NULL,
  `studied_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userregister`
--

INSERT INTO `userregister` (`id`, `firstname`, `lastname`, `email`, `password`, `user_active`, `token`, `created_at`, `usertype`, `phone_no`, `websites`, `profile`, `company_name`, `studentCV`, `St_address`, `education_qualification`, `interested_field`, `professional_qualification`, `studied_at`) VALUES
(11, 'BMS', 'BMS', 'bms@gmail.com', '$2y$10$FITQAH8/tOxb7d4Ww2YrG.STA5c3xi9sORYZQxdWIeGfBk4I.EJSK', 0, NULL, '2024-05-16 16:14:11', 'recruiter', 2549044, 'bms.ac.lk', 'BMS.png', 'BMS', NULL, NULL, NULL, NULL, NULL, NULL),
(140, 'ESOFT', 'ESOFT', 'esoft@gmail.com', '$2y$10$GZNv5WhzlwGL89jt7/v3QudRuWgKJZbEKaF/TotzWixlpF9HhZNEq', 0, NULL, '2024-05-29 15:40:50', 'recruiter', 254904455, 'rec.ac.lk', 'esoft.jpeg', 'ESOFT', NULL, NULL, NULL, NULL, NULL, NULL),
(248, 'Mirshath', 'mirshath', 'mirmirsha123@gmail.com', '$2y$10$i.kEusmKWCyTZ2RVl674zey2U9TVfGC7llefSpQWsy16VrwRvXPOW', 1, '', '2024-07-01 11:31:47', 'jobSeeker', 2147483647, NULL, 'proImgageRed.jpg', NULL, 'CV.pdf', 'Colombo', 'High_School', 'It', 'Diploma', 'BMS'),
(249, 'Mirshath', 'Mohamed', 'mirshath.mmm@gmail.com', '$2y$10$zwbdcdWhrWlkMurMqEp9suHErH0iLTiKN6tINtfZrYNK94dZPj6ny', 1, '', '2024-07-01 15:40:23', 'jobSeeker', 2147483647, '', 'pro1.png', NULL, 'CV.pdf', 'MAradana', 'Bachelor\'s_Degree', 'It', 'Bachelor\'s_Degree', 'BMS');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `jobseeker_company_subscriptions`
--
ALTER TABLE `jobseeker_company_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `userregister`
--
ALTER TABLE `userregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

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
