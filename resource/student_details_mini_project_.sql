-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2022 at 11:47 AM
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
-- Database: `student details(mini project)`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `ID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(3000) NOT NULL,
  `Subject Code` varchar(11) NOT NULL,
  `Posted By` varchar(50) NOT NULL,
  `Posted On` varchar(20) NOT NULL,
  `Posted time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`ID`, `Title`, `Description`, `Subject Code`, `Posted By`, `Posted On`, `Posted time`) VALUES
(1, 'Internal Assessment - 2', 'IA3 has been scheduled on June 3rd. All the Students must prepare well to get good marks', '52KAN', 'Kanaka V', '26 May, 2022 11:24pm', '1653587698');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `ID` int(11) NOT NULL,
  `Student ID` varchar(11) DEFAULT NULL,
  `Total Class` int(3) DEFAULT NULL,
  `Attended Class` int(3) DEFAULT NULL,
  `Percentage` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`ID`, `Student ID`, `Total Class`, `Attended Class`, `Percentage`) VALUES
(15, '2022_CSE_01', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_marks`
--

CREATE TABLE `exam_marks` (
  `ID` int(11) NOT NULL,
  `Student ID` varchar(11) DEFAULT NULL,
  `Subject Code` varchar(11) DEFAULT NULL,
  `External Marks` int(11) DEFAULT NULL,
  `Internals Total` int(11) DEFAULT NULL,
  `Total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_marks`
--

INSERT INTO `exam_marks` (`ID`, `Student ID`, `Subject Code`, `External Marks`, `Internals Total`, `Total`) VALUES
(80, '2022_CSE_01', NULL, NULL, NULL, NULL),
(81, '2022_CSE_01', '51ENG', NULL, NULL, NULL),
(82, '2022_CSE_01', '52KAN', NULL, NULL, NULL),
(83, '2022_CSE_01', '53HIN', NULL, NULL, NULL),
(84, '2022_CSE_01', '54MAT', NULL, NULL, NULL),
(85, '2022_CSE_01', '55SCI', NULL, NULL, NULL),
(86, '2022_CSE_01', '56SOC', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `internals_marks`
--

CREATE TABLE `internals_marks` (
  `ID` int(11) NOT NULL,
  `Student ID` varchar(11) DEFAULT NULL,
  `Subject Code` varchar(11) DEFAULT NULL,
  `IA1` int(3) DEFAULT NULL,
  `IA2` int(3) DEFAULT NULL,
  `IA3` int(3) DEFAULT NULL,
  `Average` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `internals_marks`
--

INSERT INTO `internals_marks` (`ID`, `Student ID`, `Subject Code`, `IA1`, `IA2`, `IA3`, `Average`) VALUES
(80, '2022_CSE_01', NULL, NULL, NULL, NULL, NULL),
(81, '2022_CSE_01', '51ENG', NULL, NULL, NULL, NULL),
(82, '2022_CSE_01', '52KAN', NULL, NULL, NULL, NULL),
(83, '2022_CSE_01', '53HIN', NULL, NULL, NULL, NULL),
(84, '2022_CSE_01', '54MAT', NULL, NULL, NULL, NULL),
(85, '2022_CSE_01', '55SCI', NULL, NULL, NULL, NULL),
(86, '2022_CSE_01', '56SOC', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `Student ID` varchar(11) NOT NULL,
  `USN` varchar(10) DEFAULT NULL,
  `Name` varchar(50) NOT NULL,
  `College ID` varchar(10) NOT NULL,
  `DOB` varchar(15) NOT NULL,
  `Religion` varchar(15) NOT NULL,
  `Admission Year` int(4) NOT NULL,
  `Admission Nature` varchar(10) NOT NULL,
  `Hostel DayScholar` varchar(6) NOT NULL,
  `Degree_Branch` varchar(50) NOT NULL,
  `Passport` varchar(15) DEFAULT NULL,
  `Driving License` varchar(15) DEFAULT NULL,
  `Languages` varchar(50) DEFAULT NULL,
  `Blood Group` varchar(4) NOT NULL,
  `Height_Weight` varchar(15) DEFAULT NULL,
  `Mobile Number` varchar(15) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Bank 1` varchar(50) NOT NULL,
  `Account No 1` varchar(15) NOT NULL,
  `Bank 2` varchar(30) DEFAULT NULL,
  `Account No 2` varchar(15) DEFAULT NULL,
  `Father Name` varchar(50) NOT NULL,
  `Father Occupation` varchar(30) NOT NULL,
  `Father Number` varchar(15) NOT NULL,
  `Father Email` varchar(50) NOT NULL,
  `Father Photo` varchar(50) NOT NULL,
  `Father Office Address` varchar(255) NOT NULL,
  `Mother Name` varchar(50) NOT NULL,
  `Mother Occupation` varchar(30) NOT NULL,
  `Mother Number` varchar(15) NOT NULL,
  `Mother Email` varchar(50) NOT NULL,
  `Mother Photo` varchar(50) NOT NULL,
  `Mother Office Address` varchar(255) DEFAULT NULL,
  `Guardian Name` varchar(50) DEFAULT NULL,
  `Guardian Occupation` varchar(30) DEFAULT NULL,
  `Guardian Number` varchar(15) DEFAULT NULL,
  `Guardian Email` varchar(50) DEFAULT NULL,
  `Guardian Photo` varchar(50) DEFAULT NULL,
  `Guardian Office Address` varchar(255) DEFAULT NULL,
  `Address of Communication` varchar(50) NOT NULL,
  `Permanent Address` varchar(255) NOT NULL,
  `Permanent Address PIN` varchar(10) NOT NULL,
  `Permanent Address Phone` varchar(15) NOT NULL,
  `Communication Address` varchar(255) NOT NULL,
  `Communication Address PIN` varchar(10) NOT NULL,
  `Communication Address Phone` varchar(15) NOT NULL,
  `10th School Name` varchar(50) NOT NULL,
  `10th School Place` varchar(50) NOT NULL,
  `10th Year` int(4) NOT NULL,
  `10th Marks` varchar(10) NOT NULL,
  `10th Medium` varchar(15) NOT NULL,
  `12th School Name` varchar(50) NOT NULL,
  `12th School Place` varchar(50) NOT NULL,
  `12th School Address` varchar(255) NOT NULL,
  `12th Board` varchar(15) NOT NULL,
  `12th Year` int(4) NOT NULL,
  `12th Marks` varchar(10) NOT NULL,
  `12th Medium` varchar(15) NOT NULL,
  `12th Marks Percentage` varchar(5) NOT NULL,
  `12th Marks Maths` varchar(10) NOT NULL,
  `12th Marks Physics` varchar(10) NOT NULL,
  `12th Marks Chemistry` varchar(10) NOT NULL,
  `Diploma School Name` varchar(50) DEFAULT NULL,
  `Diploma School Place` varchar(50) DEFAULT NULL,
  `Diploma year` int(4) DEFAULT NULL,
  `Diploma Marks` varchar(10) DEFAULT NULL,
  `Diploma Medium` varchar(25) DEFAULT NULL,
  `Diploma Marks Percent` varchar(5) DEFAULT NULL,
  `Diploma Marks Sem I` varchar(10) DEFAULT NULL,
  `Diploma Marks Sem II` varchar(10) DEFAULT NULL,
  `Diploma Marks Sem III` varchar(10) DEFAULT NULL,
  `Diploma Marks Sem IV` varchar(10) DEFAULT NULL,
  `Diploma Marks Sem V` varchar(10) DEFAULT NULL,
  `Diploma Marks Sem VI` varchar(10) DEFAULT NULL,
  `Exam Preparation Method` varchar(10) NOT NULL,
  `Communicate well in English` varchar(3) NOT NULL,
  `Prepare English` varchar(50) DEFAULT NULL,
  `Elder Brothers Count` varchar(2) DEFAULT NULL,
  `Elder Brothers Qualification` varchar(100) DEFAULT NULL,
  `Younger Brothers Count` varchar(2) DEFAULT NULL,
  `Younger Brothers Qualification` varchar(100) NOT NULL,
  `Elder Sisters Count` varchar(2) NOT NULL,
  `Elder Sisters Qualification` varchar(100) NOT NULL,
  `Younger Sisters Count` varchar(2) NOT NULL,
  `Younger Sisters Qualification` varchar(100) NOT NULL,
  `Move Together` varchar(255) NOT NULL,
  `Personal Problems` varchar(255) NOT NULL,
  `Health Condition` varchar(255) NOT NULL,
  `Any Medications` varchar(255) NOT NULL,
  `Other Interests` varchar(255) NOT NULL,
  `Hobbies` varchar(255) NOT NULL,
  `Sports Interest` varchar(255) NOT NULL,
  `Prize Details` varchar(255) NOT NULL,
  `Specific talents` varchar(255) NOT NULL,
  `Ambition` varchar(255) NOT NULL,
  `Branch Reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`Student ID`, `USN`, `Name`, `College ID`, `DOB`, `Religion`, `Admission Year`, `Admission Nature`, `Hostel DayScholar`, `Degree_Branch`, `Passport`, `Driving License`, `Languages`, `Blood Group`, `Height_Weight`, `Mobile Number`, `Email`, `Bank 1`, `Account No 1`, `Bank 2`, `Account No 2`, `Father Name`, `Father Occupation`, `Father Number`, `Father Email`, `Father Photo`, `Father Office Address`, `Mother Name`, `Mother Occupation`, `Mother Number`, `Mother Email`, `Mother Photo`, `Mother Office Address`, `Guardian Name`, `Guardian Occupation`, `Guardian Number`, `Guardian Email`, `Guardian Photo`, `Guardian Office Address`, `Address of Communication`, `Permanent Address`, `Permanent Address PIN`, `Permanent Address Phone`, `Communication Address`, `Communication Address PIN`, `Communication Address Phone`, `10th School Name`, `10th School Place`, `10th Year`, `10th Marks`, `10th Medium`, `12th School Name`, `12th School Place`, `12th School Address`, `12th Board`, `12th Year`, `12th Marks`, `12th Medium`, `12th Marks Percentage`, `12th Marks Maths`, `12th Marks Physics`, `12th Marks Chemistry`, `Diploma School Name`, `Diploma School Place`, `Diploma year`, `Diploma Marks`, `Diploma Medium`, `Diploma Marks Percent`, `Diploma Marks Sem I`, `Diploma Marks Sem II`, `Diploma Marks Sem III`, `Diploma Marks Sem IV`, `Diploma Marks Sem V`, `Diploma Marks Sem VI`, `Exam Preparation Method`, `Communicate well in English`, `Prepare English`, `Elder Brothers Count`, `Elder Brothers Qualification`, `Younger Brothers Count`, `Younger Brothers Qualification`, `Elder Sisters Count`, `Elder Sisters Qualification`, `Younger Sisters Count`, `Younger Sisters Qualification`, `Move Together`, `Personal Problems`, `Health Condition`, `Any Medications`, `Other Interests`, `Hobbies`, `Sports Interest`, `Prize Details`, `Specific talents`, `Ambition`, `Branch Reason`) VALUES
('2022_CSE_01', '1KS18CS109', 'Shankar KS', '1234', '14 Jun, 2022', 'Muslim', 2022, 'CET', 'I Year', 'BE, CSE', 'N 00144521', 'UP1420080079043', 'English, Telugu', 'A-', '6, 50', '+91 9456137851', 'shankar@gmail.com', 'Indian Bank', '123456789123', NULL, NULL, 'Venkatesh', 'Network Engineer', '+91 9638527415', 'venkatesh@gmail.com', '', 'Wipro’s Campus, Cafeteria Hall EC-3, Ground Floor, Opp. Tower 8, No. 72, Keonics, Electronic\nCity, Hosur Road, Bangalore', 'Sumalatha', 'House-Wife', '+91 9638527415', 'suma@gmail.com', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Banashankari', '#411 TCH College road, Harinagar, Anjanapura(P)', '560085', '62354158', '#411 TCH College road, Harinagar, Anjanapura(P)', '560085', '62354158', 'Silicon High School', 'Harinagar', 2020, '566/625', 'English', 'Kumarans PU College', 'Banashankari', 'Banashankari Bangalore', 'State Board', 2022, '555/600', 'English', '92.5', '98', '98', '90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Self Study', 'Yes', NULL, '1', 'Software engineer', NULL, '', '', '', '', '', 'Yes', 'No', 'Excellent', 'No', 'Sports', 'Drawing, Dancing', 'Yes (Football, Cricket)', 'N/A', 'Quick-learner', 'Entrepreneur', 'Understand more about Trending Technology');

--
-- Triggers `student_details`
--
DELIMITER $$
CREATE TRIGGER `Add Student ID into Stud_users Table` AFTER INSERT ON `student_details` FOR EACH ROW INSERT INTO `stud_users`
(`Unique_ID`) VALUES (new.`Student ID`)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Add Student ID into attendance Table` AFTER INSERT ON `student_details` FOR EACH ROW INSERT INTO `attendence`
(`Student ID`) VALUES (new.`Student ID`)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Add Student ID into exam_marks Table` AFTER INSERT ON `student_details` FOR EACH ROW INSERT INTO `exam_marks`
(`Student ID`) VALUES (new.`Student ID`)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Add Student ID into internals_marks Table` AFTER INSERT ON `student_details` FOR EACH ROW INSERT INTO `internals_marks`
(`Student ID`) VALUES (new.`Student ID`)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stud_users`
--

CREATE TABLE `stud_users` (
  `ID` int(11) NOT NULL,
  `Unique_ID` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stud_users`
--

INSERT INTO `stud_users` (`ID`, `Unique_ID`, `password`) VALUES
(15, '2022_CSE_01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject_details`
--

CREATE TABLE `subject_details` (
  `Subject Code` varchar(11) NOT NULL,
  `Subject Name` varchar(255) NOT NULL,
  `Instructor Name` varchar(255) NOT NULL,
  `Instructor Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_details`
--

INSERT INTO `subject_details` (`Subject Code`, `Subject Name`, `Instructor Name`, `Instructor Email`) VALUES
('51ENG', 'English', 'Anuradha', 'anuradha@gmail.com'),
('52KAN', 'Kannada', 'Kanaka V', 'kanaka@gmail.com'),
('53HIN', 'Hindi', 'Mamatha', 'mamatha@gmail.com'),
('54MAT', 'Mathematics', 'Venkat Ramana', 'venkat@gmail.com'),
('55SCI', 'Science', 'Chethan N', 'chethan@gmail.com'),
('56SOC', 'Social_Science', 'Esther', 'esther@gmail.com');

--
-- Triggers `subject_details`
--
DELIMITER $$
CREATE TRIGGER `Add Subject Code into exam_marks Table` AFTER INSERT ON `subject_details` FOR EACH ROW INSERT INTO `exam_marks`
(`Subject Code`) VALUES (new.`Subject Code`)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Add Subject Code into internals_marks Table` AFTER INSERT ON `subject_details` FOR EACH ROW INSERT INTO `internals_marks`
(`Subject Code`) VALUES (new.`Subject Code`)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_user`
--

CREATE TABLE `teacher_user` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_user`
--

INSERT INTO `teacher_user` (`ID`, `USERNAME`, `PASSWORD`) VALUES
(2, 'thirumalai', '$2y$10$lCS9ubGzsxqVbBaeuphNQOkRF1Y3b7keuoBWvifRhaCGul481o2TO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Subject Code` (`Subject Code`);

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Student ID` (`Student ID`);

--
-- Indexes for table `exam_marks`
--
ALTER TABLE `exam_marks`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Student ID` (`Student ID`),
  ADD KEY `Subject Code` (`Subject Code`);

--
-- Indexes for table `internals_marks`
--
ALTER TABLE `internals_marks`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Student ID` (`Student ID`),
  ADD KEY `Subject Code` (`Subject Code`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`Student ID`);

--
-- Indexes for table `stud_users`
--
ALTER TABLE `stud_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Unique_ID` (`Unique_ID`);

--
-- Indexes for table `subject_details`
--
ALTER TABLE `subject_details`
  ADD PRIMARY KEY (`Subject Code`);

--
-- Indexes for table `teacher_user`
--
ALTER TABLE `teacher_user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `exam_marks`
--
ALTER TABLE `exam_marks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `internals_marks`
--
ALTER TABLE `internals_marks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `stud_users`
--
ALTER TABLE `stud_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `teacher_user`
--
ALTER TABLE `teacher_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_ibfk_1` FOREIGN KEY (`Subject Code`) REFERENCES `subject_details` (`Subject Code`) ON UPDATE CASCADE;

--
-- Constraints for table `attendence`
--
ALTER TABLE `attendence`
  ADD CONSTRAINT `attendence_ibfk_1` FOREIGN KEY (`Student ID`) REFERENCES `student_details` (`Student ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_marks`
--
ALTER TABLE `exam_marks`
  ADD CONSTRAINT `exam_marks_ibfk_1` FOREIGN KEY (`Student ID`) REFERENCES `student_details` (`Student ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_marks_ibfk_2` FOREIGN KEY (`Subject Code`) REFERENCES `subject_details` (`Subject Code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `internals_marks`
--
ALTER TABLE `internals_marks`
  ADD CONSTRAINT `internals_marks_ibfk_1` FOREIGN KEY (`Student ID`) REFERENCES `student_details` (`Student ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `internals_marks_ibfk_2` FOREIGN KEY (`Subject Code`) REFERENCES `subject_details` (`Subject Code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stud_users`
--
ALTER TABLE `stud_users`
  ADD CONSTRAINT `stud_users_ibfk_1` FOREIGN KEY (`Unique_ID`) REFERENCES `student_details` (`Student ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
