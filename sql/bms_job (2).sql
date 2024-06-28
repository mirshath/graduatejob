-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 04:19 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_image`, `created_at`) VALUES
(9, 'It', NULL, '2024-05-26 03:34:48'),
(35, 'Accounts', 'dc2ec5a571974417a5551420a4fb0587.jpg', '2024-06-27 11:06:57'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_title`, `company_name`, `company_logo`, `job_category`, `categoryId`, `categoryName`, `job_description`, `employment_type`, `location`, `salary_range`, `skills_required`, `education_level`, `experience_level`, `application_deadline`, `contact_info`, `additional_info`, `created_at`, `recuiter_id`, `postedBy`, `admin_status`, `application_status`) VALUES
(107, 'Networn Intern', 'BMS', 'network intern.jpg', 'It', NULL, NULL, '<h2><strong>Job Description</strong></h2>\r\n\r\n<p>We are seeking a motivated and talented Network Intern to join our IT team. The Network Intern will assist in the maintenance, troubleshooting, and improvement of our network systems. This internship offers hands-on experience in network administration and support, providing an excellent opportunity to learn from experienced professionals.</p>\r\n\r\n<p><strong>Key Responsibilities:</strong></p>\r\n\r\n<ul>\r\n	<li>Assist in the setup, configuration, and maintenance of network infrastructure, including routers, switches, firewalls, and wireless access points.</li>\r\n	<li>Monitor network performance and troubleshoot network issues to ensure optimal performance and security.</li>\r\n	<li>Support network documentation and create network diagrams.</li>\r\n	<li>Assist in implementing network security measures, including firewalls, intrusion detection systems, and VPNs.</li>\r\n	<li>Help manage and resolve network-related support tickets and technical issues.</li>\r\n	<li>Collaborate with the IT team to implement new network solutions and upgrades.</li>\r\n	<li>Perform regular network health checks and maintenance tasks.</li>\r\n	<li>Participate in network-related projects and provide input on network design and architecture.</li>\r\n</ul>\r\n\r\n<p><strong>Qualifications:</strong></p>\r\n\r\n<ul>\r\n	<li>Currently pursuing or recently completed a degree in Computer Science, Information Technology, or a related field.</li>\r\n	<li>Basic understanding of networking concepts and protocols (e.g., TCP/IP, DNS, DHCP, VLANs).</li>\r\n	<li>Familiarity with network hardware such as routers, switches, and firewalls.</li>\r\n	<li>Basic knowledge of network security principles.</li>\r\n	<li>Strong problem-solving and analytical skills.</li>\r\n	<li>Excellent communication and teamwork skills.</li>\r\n	<li>Ability to learn quickly and adapt to new technologies and environments.</li>\r\n	<li>Relevant certifications (e.g., Cisco CCNA, CompTIA Network+) are a plus but not required.</li>\r\n</ul>\r\n\r\n<p><strong>Benefits:</strong></p>\r\n\r\n<ul>\r\n	<li>Hands-on experience with network administration and support.</li>\r\n	<li>Mentorship from experienced IT professionals.</li>\r\n	<li>Opportunity to work on real-world network projects.</li>\r\n	<li>Potential for future full-time employment based on performance.</li>\r\n	<li>[Any additional benefits, such as stipends, flexible hours, etc.]</li>\r\n</ul>\r\n', 'Internship', 'Colombo', '50000', 'C++, Java, C#', 'HighSchool', 'Entry_Level', '2024-07-05', '0254904455', '<p>Interested candidates are invited to submit their resume and a cover letter outlining their interest and qualifications to [application email or portal]. Please include &quot;Network Intern Application&quot; in the subject line.</p>\r\n', '2024-06-27 18:02:16', 11, ' Admin', 'Approved', 'active'),
(108, 'Robotic Intern', 'ESOFT', 'in.jpg', 'It', NULL, NULL, '<h2>Job Description:</h2>\r\n\r\n<p>We are seeking a passionate and talented Robotics Intern to join our team. The Robotics Intern will work on the development, testing, and implementation of robotic systems and applications. This internship offers hands-on experience with advanced robotics technologies and the opportunity to contribute to exciting projects.</p>\r\n\r\n<p><strong>Key Responsibilities:</strong></p>\r\n\r\n<ul>\r\n	<li>Assist in the design, development, and testing of robotic systems and components.</li>\r\n	<li>Support the integration of sensors, actuators, and control systems into robotic platforms.</li>\r\n	<li>Collaborate with engineers and developers to implement and optimize robotic algorithms.</li>\r\n	<li>Participate in the troubleshooting and debugging of robotic systems.</li>\r\n	<li>Help create and maintain technical documentation, including schematics, diagrams, and code.</li>\r\n	<li>Conduct research on emerging robotics technologies and contribute to innovative solutions.</li>\r\n	<li>Assist in the assembly, calibration, and testing of prototypes and production units.</li>\r\n	<li>Participate in field tests and real-world deployments of robotic systems.</li>\r\n</ul>\r\n\r\n<p><strong>Qualifications:</strong></p>\r\n\r\n<ul>\r\n	<li>Currently pursuing or recently completed a degree in Robotics, Mechanical Engineering, Electrical Engineering, Computer Science, or a related field.</li>\r\n	<li>Basic understanding of robotics principles, including kinematics, dynamics, and control systems.</li>\r\n	<li>Familiarity with programming languages such as Python, C++, or ROS (Robot Operating System).</li>\r\n	<li>Experience with CAD software (e.g., SolidWorks, AutoCAD) and hardware prototyping is a plus.</li>\r\n	<li>Strong problem-solving and analytical skills.</li>\r\n	<li>Excellent communication and teamwork skills.</li>\r\n	<li>Ability to learn quickly and adapt to new technologies and environments.</li>\r\n	<li>Previous project or coursework in robotics is highly desirable.</li>\r\n</ul>\r\n\r\n<p><strong>Benefits:</strong></p>\r\n\r\n<ul>\r\n	<li>Hands-on experience with cutting-edge robotics technologies.</li>\r\n	<li>Mentorship from experienced robotics engineers and professionals.</li>\r\n	<li>Opportunity to work on real-world robotics projects and applications.</li>\r\n	<li>Potential for future full-time employment based on performance.</li>\r\n	<li>[Any additional benefits, such as stipends, flexible hours, etc.]</li>\r\n</ul>\r\n', 'Part-time', 'Colombo', '40000', 'python, C++', 'HighSchool', 'Entry_Level', '2024-07-06', '0254904455', '<p>Interested candidates are invited to submit their resume and a cover letter outlining their interest and qualifications to [application email or portal]. Please include &quot;Robotics Intern Application&quot; in the subject line.</p>\r\n', '2024-06-27 18:16:55', 140, ' Admin', 'Approved', 'active'),
(109, 'Teaching Intern', 'BMS', 'robo.jpg', 'Teaching', NULL, NULL, '<p>We are seeking an enthusiastic and dedicated Teaching Intern to join our educational team. The Teaching Intern will assist in the planning, implementation, and evaluation of instructional activities. This internship offers hands-on experience in a classroom setting and the opportunity to work closely with experienced educators.</p>\r\n\r\n<p><strong>Key Responsibilities:</strong></p>\r\n\r\n<ul>\r\n	<li>Assist lead teachers in creating and implementing lesson plans and instructional materials.</li>\r\n	<li>Support classroom management and help maintain a positive learning environment.</li>\r\n	<li>Work one-on-one or in small groups with students to provide additional instructional support.</li>\r\n	<li>Participate in the assessment of student progress and provide feedback to lead teachers.</li>\r\n	<li>Help prepare and organize classroom materials and resources.</li>\r\n	<li>Assist in the development and implementation of educational activities and projects.</li>\r\n	<li>Participate in parent-teacher conferences and other school events as needed.</li>\r\n	<li>Perform administrative tasks related to classroom management and student records.</li>\r\n</ul>\r\n\r\n<p><strong>Qualifications:</strong></p>\r\n\r\n<ul>\r\n	<li>Currently pursuing or recently completed a degree in Education or a related field.</li>\r\n	<li>Passion for teaching and working with children or young adults.</li>\r\n	<li>Basic understanding of educational principles and classroom management techniques.</li>\r\n	<li>Strong communication and interpersonal skills.</li>\r\n	<li>Ability to work collaboratively with teachers, students, and parents.</li>\r\n	<li>Patience, creativity, and a positive attitude.</li>\r\n	<li>Prior experience working with children (e.g., tutoring, coaching, volunteering) is a plus.</li>\r\n</ul>\r\n', 'Full-time', 'Kandy', '50000', 'Team Leader, speaking skills, Presentation skills', 'HighSchool', 'Mid_Level', '2024-06-30', '22222', '<p>Interested candidates are invited to submit their resume and a cover letter outlining their interest and qualifications to [application email or portal]. Please include &quot;Teaching Intern Application&quot; in the subject line.</p>\r\n', '2024-06-27 18:23:01', 11, ' Admin', 'Approved', 'active'),
(110, 'English Teacher', 'BMS', 'school.jpeg', 'Teaching', NULL, NULL, '<p>We are seeking an enthusiastic and dedicated Teaching Intern to join our educational team. The Teaching Intern will assist in the planning, implementation, and evaluation of instructional activities. This internship offers hands-on experience in a classroom setting and the opportunity to work closely with experienced educators.</p>\r\n\r\n<p><strong>Key Responsibilities:</strong></p>\r\n\r\n<ul>\r\n	<li>Assist lead teachers in creating and implementing lesson plans and instructional materials.</li>\r\n	<li>Support classroom management and help maintain a positive learning environment.</li>\r\n	<li>Work one-on-one or in small groups with students to provide additional instructional support.</li>\r\n	<li>Participate in the assessment of student progress and provide feedback to lead teachers.</li>\r\n	<li>Help prepare and organize classroom materials and resources.</li>\r\n	<li>Assist in the development and implementation of educational activities and projects.</li>\r\n	<li>Participate in parent-teacher conferences and other school events as needed.</li>\r\n	<li>Perform administrative tasks related to classroom management and student records.</li>\r\n</ul>\r\n\r\n<p><strong>Qualifications:</strong></p>\r\n\r\n<ul>\r\n	<li>Currently pursuing or recently completed a degree in Education or a related field.</li>\r\n	<li>Passion for teaching and working with children or young adults.</li>\r\n	<li>Basic understanding of educational principles and classroom management techniques.</li>\r\n	<li>Strong communication and interpersonal skills.</li>\r\n	<li>Ability to work collaboratively with teachers, students, and parents.</li>\r\n	<li>Patience, creativity, and a positive attitude.</li>\r\n	<li>Prior experience working with children (e.g., tutoring, coaching, volunteering) is a plus.</li>\r\n</ul>\r\n', 'Part-time', 'Anuradhapura', '45000', 'teaching skills, presentation skills, speaking skills, gteam leading', 'HighSchool', 'Mid_Level', '2024-07-06', '0254904455', '<p>Benefits:</p>\r\n\r\n<ul>\r\n	<li>Hands-on experience in a classroom setting.</li>\r\n	<li>Mentorship from experienced educators.</li>\r\n	<li>Opportunity to develop and refine teaching skills.</li>\r\n</ul>\r\n', '2024-06-27 18:26:41', 11, ' Admin', 'Approved', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_company_subscriptions`
--

CREATE TABLE `jobseeker_company_subscriptions` (
  `id` int(11) NOT NULL,
  `jobseeker_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `St_address` varchar(255) DEFAULT NULL,
  `education_qualification` varchar(255) DEFAULT NULL,
  `interested_field` varchar(255) DEFAULT NULL,
  `professional_qualification` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userregister`
--

INSERT INTO `userregister` (`id`, `firstname`, `lastname`, `email`, `password`, `created_at`, `usertype`, `phone_no`, `websites`, `profile`, `company_name`, `studentCV`, `St_address`, `education_qualification`, `interested_field`, `professional_qualification`) VALUES
(11, 'Mirshath ', 'Mohamed', 'mmm@gmail.com', '$2y$10$FITQAH8/tOxb7d4Ww2YrG.STA5c3xi9sORYZQxdWIeGfBk4I.EJSK', '2024-05-16 16:14:11', 'recruiter', 2549044, 'bms.ac.lk', 'BMS.png', 'BMS', NULL, NULL, NULL, NULL, NULL),
(140, 'rec', 'rec', 'rec@gmail.com', '$2y$10$GZNv5WhzlwGL89jt7/v3QudRuWgKJZbEKaF/TotzWixlpF9HhZNEq', '2024-05-29 15:40:50', 'recruiter', 254904455, 'rec.ac.lk', 'esoft.jpeg', 'ESOFT', NULL, NULL, NULL, NULL, NULL),
(147, 'Mirshath', 'Mohamed', 'mirshath.mmm@gmail.com', '$2y$10$KguObmKDNGGjeC0Jme.q6uHu35tmI8kK.V2MZIPlmNQ9JJBfc1pPm', '2024-06-03 10:42:16', 'jobSeeker', 254904455, '', '667a90d65e40f.jpg', '', '', 'Anuradha Pura', NULL, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

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
