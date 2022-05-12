-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2021 at 05:05 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `getplaced`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_tbl`
--

CREATE TABLE `application_tbl` (
  `app_id` int(11) NOT NULL,
  `seeker_uname` varchar(20) NOT NULL,
  `company_name` varchar(128) NOT NULL,
  `college_name` varchar(128) NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `platform` varchar(128) NOT NULL,
  `link` text DEFAULT NULL,
  `is_placed` tinyint(1) NOT NULL DEFAULT 0,
  `app_package` varchar(20) DEFAULT NULL,
  `app_date` text DEFAULT NULL,
  `app_time` varchar(30) DEFAULT NULL,
  `comment` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application_tbl`
--

INSERT INTO `application_tbl` (`app_id`, `seeker_uname`, `company_name`, `college_name`, `is_approved`, `platform`, `link`, `is_placed`, `app_package`, `app_date`, `app_time`, `comment`) VALUES
(8, 'absh', 'Google ', 'Vishwakarma Government Engineering College', 1, 'Google Meet', 'https://meet.google.com/ytu-ubak-wxb', 1, '8 LPA', '2021-07-31', '13.00 Hrs', 'You are lacking the Perfect Score needed by our company.'),
(10, 'mihir0712', 'Google ', 'Vishwakarma Government Engineering College', 1, 'Google Meet', NULL, 1, '8 LPA', NULL, NULL, 'I have disapproved your profile.'),
(11, 'mihir0712', 'Microsoft', 'Vishwakarma Government Engineering College', 0, 'Google Meet', NULL, 1, '50 LPA', NULL, NULL, NULL),
(12, 'ravij00', 'Google ', 'Vishwakarma Government Engineering College', 1, 'Google Meet', 'meet.google.com', 1, '12 LPA', '2021-08-02', '12:02', 'YOu have been selected.');

-- --------------------------------------------------------

--
-- Table structure for table `approved_drive`
--

CREATE TABLE `approved_drive` (
  `drive_id` int(11) NOT NULL,
  `company_name` varchar(128) NOT NULL,
  `college_name` varchar(128) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `req_emp` int(11) NOT NULL,
  `package` varchar(20) NOT NULL,
  `offer_file` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `approved_drive`
--

INSERT INTO `approved_drive` (`drive_id`, `company_name`, `college_name`, `start_date`, `end_date`, `time`, `platform`, `req_emp`, `package`, `offer_file`) VALUES
(30, 'Google ', 'Vishwakarma Government Engineering College', '2021-08-01', '2021-08-04', '12.00 - 15.00 Hrs', 'Google Meet', 30, '4.00 to 8.00 LPA', './uploads/drives/1626408167_iQuest_Payment.pdf'),
(34, 'Microsoft', 'Vishwakarma Government Engineering College', '2021-08-28', '2021-08-29', '12.00 - 17.00 Hrs', 'Google Meet', 20, '4.00 to 8.00 LPA', './uploads/drives/1626444570_PPT.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `college_tbl`
--

CREATE TABLE `college_tbl` (
  `college_id` int(11) NOT NULL,
  `college_uname` varchar(10) NOT NULL,
  `college_pass` varchar(20) NOT NULL,
  `college_name` varchar(128) NOT NULL,
  `college_contact` varchar(20) NOT NULL,
  `college_web` varchar(128) NOT NULL,
  `college_mail` varchar(128) NOT NULL,
  `college_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `college_tbl`
--

INSERT INTO `college_tbl` (`college_id`, `college_uname`, `college_pass`, `college_name`, `college_contact`, `college_web`, `college_mail`, `college_address`) VALUES
(1, 'vgec', '382424', 'Vishwakarma Government Engineering College', '07923293866', 'vgecg.ac.in', 'mail@vgecg.ac.in', 'Ahmedabad, India'),
(12, 'ldce', '382424', 'L.D. College of Engineering', '9876543210', 'ldce.ac.in', 'mail@ldce.ac.in', 'Ahmedabad, India.'),
(13, 'gecg', '382424', 'Government Engineering College, Gandhinagar', '9876543210', 'gecg.ac.in', 'mail@gecg.ac.in', 'Gandhinagar, India.');

-- --------------------------------------------------------

--
-- Table structure for table `company_tbl`
--

CREATE TABLE `company_tbl` (
  `company_id` int(11) NOT NULL,
  `company_uname` varchar(10) NOT NULL,
  `company_pass` varchar(20) NOT NULL,
  `company_name` varchar(128) NOT NULL,
  `company_contact` varchar(20) NOT NULL,
  `company_web` varchar(128) NOT NULL,
  `company_mail` varchar(40) NOT NULL,
  `company_about` text NOT NULL,
  `company_location` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_tbl`
--

INSERT INTO `company_tbl` (`company_id`, `company_uname`, `company_pass`, `company_name`, `company_contact`, `company_web`, `company_mail`, `company_about`, `company_location`) VALUES
(1, 'google', '0000', 'Google ', '9876543210', 'google.com', 'mail@google.com', '\"Do the right thing!\"', 'Bangalore, India.'),
(2, 'ms', '0000', 'Microsoft', '9876543210', 'microsoft.com', 'ms@microsoft.com', 'Hey there.\r\nWe are Microsoft.', 'Bangalore, India.'),
(3, 'amazon', '0000', 'Amazon', '9876543210', 'amazon.com', 'mail@amazon.com', 'We are Amazon.com\r\nA -> Z', 'Bangalore, India.'),
(4, 'flip', '0000', 'Flipkart', '9876543210', 'flipkart.com', 'mail@flipkart.com', 'Flipkart', 'Bangalore, India.'),
(5, 'tcs', '0000', 'TCS', '9876543210', 'tcs.in', 'mail@tcs.in', 'A Tata Company.', 'Gandhinagar, India.'),
(6, 'techm', '0000', 'Tech Mahindra', '9876543210', 'techmahindra.in', 'mail@techmahindra.in', 'Tech Mahindra.', 'Ahmedabad, India.'),
(7, 'infosys', '0000', 'Infosys', '9876543210', 'infosys.in', 'mail@infosys.in', 'Infosys.', 'Ahmedabad, India.'),
(8, 'wipro', '0000', 'Wipro', '9876543210', 'wipro.com', 'mail@wipro.com', 'Wipro.', 'Ahmedabad, India.'),
(9, 'tatva', '0000', 'TatvaSoft', '9876543210', 'tatvasoft.com', 'mail@tatvasoft.in', 'TatvaSoft.', 'Ahmedabad, India.'),
(10, 'bactech', '0000', 'Bacancy Tech', '9876543210', 'bacancy.in', 'mail@bacancy.in', 'Bacancy Technologies', 'Ahmedabad, India.');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_drive`
--

CREATE TABLE `schedule_drive` (
  `sd_id` int(11) NOT NULL,
  `college_name` varchar(128) NOT NULL,
  `company_name` varchar(128) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `time` varchar(20) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `req_emp` int(11) NOT NULL,
  `package` varchar(20) NOT NULL,
  `offer_file` varchar(128) NOT NULL,
  `is_app_college` tinyint(1) NOT NULL DEFAULT 0,
  `is_app_company` tinyint(1) NOT NULL DEFAULT 1,
  `comment_com` varchar(128) DEFAULT NULL,
  `comment_col` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule_drive`
--

INSERT INTO `schedule_drive` (`sd_id`, `college_name`, `company_name`, `start_date`, `end_date`, `time`, `platform`, `req_emp`, `package`, `offer_file`, `is_app_college`, `is_app_company`, `comment_com`, `comment_col`) VALUES
(4, 'Vishwakarma Government Engineering College', 'Google ', '2021-08-01', '2021-08-04', '12.00 - 15.00 Hrs', 'Google Meet', 30, '4.00 to 8.00 LPA', './uploads/drives/1626408167_iQuest_Payment.pdf', 1, 1, 'Why is this here', 'This is the final one.'),
(6, 'Vishwakarma Government Engineering College', 'Microsoft', '2021-08-28', '2021-08-29', '12.00 - 17.00 Hrs', 'Google Meet', 20, '4.00 to 8.00 LPA', './uploads/drives/1626444570_PPT.pdf', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seeker_project`
--

CREATE TABLE `seeker_project` (
  `seeker_id` int(11) NOT NULL,
  `seeker_project1` text DEFAULT NULL,
  `seeker_project2` text DEFAULT NULL,
  `seeker_project3` text DEFAULT NULL,
  `seeker_project4` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `seeker_skills`
--

CREATE TABLE `seeker_skills` (
  `seeker_uname` varchar(20) NOT NULL,
  `seeker_html_css` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_js` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_php` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_c` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_cpp` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_java` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_python` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_node` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_mern` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_mean` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_sql` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_photo` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_illustrator` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_ai` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_ml` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_kotlin` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_swift` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_c#` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_flutter` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_aspnet` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_graphic` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_aws` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_design` tinyint(4) NOT NULL DEFAULT 0,
  `seeker_azure` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seeker_skills`
--

INSERT INTO `seeker_skills` (`seeker_uname`, `seeker_html_css`, `seeker_js`, `seeker_php`, `seeker_c`, `seeker_cpp`, `seeker_java`, `seeker_python`, `seeker_node`, `seeker_mern`, `seeker_mean`, `seeker_sql`, `seeker_photo`, `seeker_illustrator`, `seeker_ai`, `seeker_ml`, `seeker_kotlin`, `seeker_swift`, `seeker_c#`, `seeker_flutter`, `seeker_aspnet`, `seeker_graphic`, `seeker_aws`, `seeker_design`, `seeker_azure`) VALUES
('absh', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('dhshah', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('mihir0712', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('om022', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('ravij00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('shivam02', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('shubh03', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('vraj00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `seeker_tbl`
--

CREATE TABLE `seeker_tbl` (
  `seeker_id` int(11) NOT NULL,
  `seeker_fname` varchar(30) NOT NULL,
  `seeker_lname` varchar(30) NOT NULL,
  `seeker_uname` varchar(10) NOT NULL,
  `seeker_pass` varchar(20) NOT NULL,
  `seeker_bdate` date NOT NULL,
  `seeker_contact` varchar(20) NOT NULL,
  `seeker_mail` varchar(50) NOT NULL,
  `seeker_web` varchar(256) NOT NULL,
  `seeker_add` text NOT NULL,
  `seeker_college` varchar(256) DEFAULT NULL,
  `seeker_branch` varchar(60) DEFAULT NULL,
  `seeker_enroll` varchar(18) DEFAULT NULL,
  `seeker_year` int(11) NOT NULL,
  `seeker_about` text NOT NULL,
  `seeker_profile` text NOT NULL,
  `seeker_cv` text NOT NULL,
  `seeker_achievement` text DEFAULT NULL,
  `seeker_approve` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seeker_tbl`
--

INSERT INTO `seeker_tbl` (`seeker_id`, `seeker_fname`, `seeker_lname`, `seeker_uname`, `seeker_pass`, `seeker_bdate`, `seeker_contact`, `seeker_mail`, `seeker_web`, `seeker_add`, `seeker_college`, `seeker_branch`, `seeker_enroll`, `seeker_year`, `seeker_about`, `seeker_profile`, `seeker_cv`, `seeker_achievement`, `seeker_approve`) VALUES
(19, 'Abhi', 'Shah', 'absh', '2002', '0000-00-00', '7041308465', 'abhishah3102@gmail.com', 'http://absh31.byethost7.com/', 'Ahmedabad, India.', 'Vishwakarma Government Engineering College', 'Information Technology', '190170116062', 2023, 'Hey, I am Abhi Shah.', '1626407761_VGEC.jpeg', '1626407761_2031994321.pdf', ',./uploads/achieves/1626407761_Coursera Z9UHHZMY4Z56_page-0001.jpg,./uploads/achieves/1626407761_Coursera YSZCWNASWWAU_page-0001.jpg,./uploads/achieves/1626407761_Coursera YYLDWHRW7J53_page-0001.jpg', 1),
(20, 'Dharmit', 'Shah', 'dhshah', '1111', '0000-00-00', '7228967551', 'dharmit@gmail.com', '-', 'Ahmedabad', 'Vishwakarma Government Engineering College', 'Information Technology', '190170116063', 2021, 'Nothing in the About', '1626450587_profile-img.jpg', '1626450587_Coursera 39LZ5KAFPCZJ.pdf', ',./uploads/achieves/1626450587_portfolio-details-3.jpg', 1),
(21, 'Mihir', 'Someshwara', 'mihir0712', '2222', '0000-00-00', '1234567890', 'mihir@gmail.com', '-', 'Ahmedabad', 'Vishwakarma Government Engineering College', 'Information Technology', '190170116068', 2023, 'I am Mihir Someshwara', '1626450696_portfolio-details-1.jpg', '1626450696_PPT.pdf', ',./uploads/achieves/1626450696_hero-bg.jpg', 1),
(22, 'Shubh', 'Vaghela', 'shubh03', '3333', '0000-00-00', '9876543210', 'shubh@yahoo.com', '-', 'Ahmedabad', 'L.D. College of Engineering', 'Computer Engineering', '190170116073', 2022, 'My Name is Shubh Vaghela', '1626450839_VGEC.png', '1626450839_PPT.pdf', ',./uploads/achieves/1626450839_VGEC.png', 0),
(23, 'Vraj', 'Patel', 'vraj00', '4444', '0000-00-00', '7894561230', 'vraj@hotmail.com', 'www.vraj_main.in', 'Vadodara', 'Government Engineering College, Gandhinagar', 'Electrical Engineering', '190170116053', 2022, 'Hi I am Vraj Patel', '1626450928_VGEC.png', '1626450928_PPT.pdf', ',./uploads/achieves/1626450928_VGEC.png', 0),
(25, 'Shivam', 'Prajapati', 'shivam02', '5555', '0000-00-00', '4567891230', 'shivam@outlook.com', 'www.shivam.net', 'Surat', 'L.D. College of Engineering', 'Electrical Engineering', '190170655101', 2020, 'Hi I am Shivam Prajapati and I live in Surat.', '1626451047_VGEC.png', '1626451047_PPT.pdf', ',./uploads/achieves/1626451047_VGEC.png', 0),
(26, 'Om', 'Patel', 'om022', '6666', '0000-00-00', '8646504644', 'om@gmail.com', '-', 'Gandhinagar', 'Government Engineering College, Gandhinagar', 'Mechanical Engineering', '190115665066', 2023, '', '1626451134_VGEC.png', '1626451134_PPT.pdf', ',./uploads/achieves/1626451134_VGEC.png', 0),
(27, 'Ravij', 'Parikh', 'ravij00', '7777', '0000-00-00', '9876543210', 'ravij@hotmail.com', '-', 'Ahmedabad', 'Vishwakarma Government Engineering College', 'Mechanical Engineering', '123456789012', 2023, 'This is About Section.', '1626451219_VGEC.png', '1626451219_PPT.pdf', ',./uploads/achieves/1626451219_VGEC.png', 1),
(28, 'James', 'Anderson', 'james00', '8888', '2002-07-19', '9876543210', 'james@gmail.com', 'www.james.com', 'Ahmedabad', 'Vishwakarma Government Engineering College', 'Electrical Engineering', '123456789013', 2023, 'This is About Section.', '1626451219_VGEC.png', '1626451219_PPT.pdf', ',./uploads/achieves/1626451219_VGEC.png', 0),
(29, 'Devarsh', 'Vyas', 'dev01', '9999', '2001-08-22', '9876543210', 'dev@gmail.com', 'www.devarsh.com', 'Ahmedabad', 'Vishwakarma Government Engineering College', 'Information Technology', '123456789013', 2023, 'This is About Section.', '1626451219_VGEC.png', '1626451219_PPT.pdf', ',./uploads/achieves/1626451219_VGEC.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_tbl`
--
ALTER TABLE `application_tbl`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `approved_drive`
--
ALTER TABLE `approved_drive`
  ADD PRIMARY KEY (`drive_id`);

--
-- Indexes for table `college_tbl`
--
ALTER TABLE `college_tbl`
  ADD PRIMARY KEY (`college_id`),
  ADD UNIQUE KEY `college_uname` (`college_uname`);

--
-- Indexes for table `company_tbl`
--
ALTER TABLE `company_tbl`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `company_uname` (`company_uname`);

--
-- Indexes for table `schedule_drive`
--
ALTER TABLE `schedule_drive`
  ADD PRIMARY KEY (`sd_id`);

--
-- Indexes for table `seeker_project`
--
ALTER TABLE `seeker_project`
  ADD KEY `seeker_id` (`seeker_id`);

--
-- Indexes for table `seeker_skills`
--
ALTER TABLE `seeker_skills`
  ADD PRIMARY KEY (`seeker_uname`);

--
-- Indexes for table `seeker_tbl`
--
ALTER TABLE `seeker_tbl`
  ADD PRIMARY KEY (`seeker_id`),
  ADD UNIQUE KEY `seeker_uname` (`seeker_uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_tbl`
--
ALTER TABLE `application_tbl`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `approved_drive`
--
ALTER TABLE `approved_drive`
  MODIFY `drive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `college_tbl`
--
ALTER TABLE `college_tbl`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `company_tbl`
--
ALTER TABLE `company_tbl`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `schedule_drive`
--
ALTER TABLE `schedule_drive`
  MODIFY `sd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `seeker_tbl`
--
ALTER TABLE `seeker_tbl`
  MODIFY `seeker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `seeker_project`
--
ALTER TABLE `seeker_project`
  ADD CONSTRAINT `seeker_id` FOREIGN KEY (`seeker_id`) REFERENCES `seeker_tbl` (`seeker_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
