-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 06:39 PM
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
-- Database: `crmcsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_acronym` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `department_id`, `course_name`, `course_acronym`) VALUES
(6, 1, 'Bachelor of Science in Information Technology', 'BSIT'),
(8, 5, 'Bachelor of Science in Accounting Technology', 'BSAT'),
(10, 1, 'Bachelor of Science in Software Development', 'BSSD'),
(11, 1, 'Bachelor of Science in Website Development', 'BSWD');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `department_acronym` varchar(50) NOT NULL,
  `department_logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `department_acronym`, `department_logo`) VALUES
(1, 'College of Computer Studies', 'CCS', '../profile/CCS.jpg'),
(5, 'College of Commerce', 'COC', '../profile/COC.png'),
(6, 'College of Teacher Education', 'CTE', '../profile/CTE.jpg'),
(7, 'College of Criminal Justice Education', 'CCJE', '../profile/CCJE.jpg'),
(10, 'Psychology', 'PSYCH', '../profile/PSYCH.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `prelim` int(11) NOT NULL,
  `midterm` int(11) NOT NULL,
  `semi_finals` int(11) NOT NULL,
  `finals` int(11) NOT NULL,
  `final_grade` int(11) NOT NULL,
  `semester` varchar(122) NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `subject_id`, `teacher_id`, `student_id`, `prelim`, `midterm`, `semi_finals`, `finals`, `final_grade`, `semester`, `status`) VALUES
(6, 20, 8, 9, 87, 89, 97, 99, 93, 'First Semester', 'Printed'),
(7, 21, 6, 9, 98, 97, 89, 93, 94, 'First Semester', 'Printed'),
(8, 37, 6, 7, 89, 89, 94, 92, 91, 'First Semester', 'Printed'),
(9, 21, 6, 6, 67, 67, 87, 75, 74, 'First Semester', 'Printed');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `semester` varchar(122) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester`) VALUES
(1, 'First Semester'),
(2, 'Second Semester'),
(5, 'Summer');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `department_name` varchar(122) NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_name` varchar(122) NOT NULL,
  `yearlevel_id` int(11) NOT NULL,
  `year_level` varchar(122) NOT NULL,
  `student_name` varchar(122) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `student_password` varchar(255) NOT NULL,
  `usertype` varchar(122) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `department_id`, `department_name`, `course_id`, `course_name`, `yearlevel_id`, `year_level`, `student_name`, `student_email`, `student_password`, `usertype`) VALUES
(1, 1, 'College of Computer Studies', 6, 'Bachelor of Science in Information Technology', 3, '3rd Year', 'Ricky Monsales', 'monsalesricky@email.com', 'monsalesricky', ''),
(2, 5, 'College of Commerce', 8, 'Bachelor of Science in Accounting Technology', 4, '4th Year', 'Richard Monsales', 'monsalesrichard@email.com', 'monsalesrichard', ''),
(3, 1, 'College of Computer Studies', 6, 'Bachelor of Science in Information Technology', 4, '4th Year', 'Ruben Monsales', 'monsalesruben@email.com', 'monsalesruben', ''),
(5, 10, 'Psychology', 11, 'Bachelor of Science in Website Development', 1, '1st Year', 'Halu', 'asdada@email.com', 'sdadasdadasd', ''),
(6, 1, 'College of Computer Studies', 6, 'Bachelor of Science in Information Technology', 1, '1st Year', 'Skibidi Toilet', 'skibiditoilet@email.com', 'skibiditoilet', ''),
(7, 1, 'College of Computer Studies', 10, 'Bachelor of Science in Software Development', 1, '1st Year', 'Wheels on the Bus', 'buswheels@email.com', 'buswheels', ''),
(8, 1, 'College of Computer Studies', 6, 'Bachelor of Science in Information Technology', 1, '1st Year', 'Student Name', 'studentname@email.com', 'studentname', ''),
(9, 1, 'College of Computer Studies', 6, 'Bachelor of Science in Information Technology', 1, '1st Year', 'Ricky Monsales', 'rickymonsales@email.com', 'rickymonsales', ''),
(10, 0, '', 0, '', 0, '', 'Admin', 'admin@email.com', 'admin', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `yearlevel_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `descriptive_title` varchar(255) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `department_id`, `course_id`, `teacher_id`, `yearlevel_id`, `semester_id`, `subject_name`, `descriptive_title`, `teacher_name`, `semester`) VALUES
(20, 1, 6, 8, 1, 1, 'CC 100', 'Introduction to Computing', 'John Wick', 'First Semester'),
(21, 1, 6, 6, 1, 1, 'CC 101', 'Computer Programming 1', 'Windel Pelayo', 'First Semester'),
(22, 1, 6, 0, 1, 1, 'GE 5', 'Purposive Communication', '', 'First Semester'),
(23, 1, 6, 0, 1, 1, 'GE 7', 'Science, Technology, and Society', '', 'First Semester'),
(24, 1, 6, 0, 1, 1, 'IS 2', 'Advanced Grammar and Composition', '', 'First Semester'),
(25, 1, 6, 0, 1, 1, 'BC 1', 'Mathematical Translation and Transformation', '', 'First Semester'),
(26, 1, 6, 0, 1, 1, 'PE 1', 'Movement Enhancement', '', 'First Semester'),
(27, 1, 6, 0, 1, 1, 'NSTP 1', 'CWTS 1', '', 'First Semester'),
(28, 1, 6, 0, 1, 1, 'NSTP 1', 'ROTC 1', '', 'First Semester'),
(37, 1, 10, 6, 1, 1, 'Flutter', 'Software Development', 'Windel Pelayo', 'First Semester');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `teacher_email` varchar(255) NOT NULL,
  `teacher_password` varchar(255) NOT NULL,
  `teacher_profile` varchar(255) NOT NULL,
  `usertype` varchar(112) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `department_id`, `department_name`, `teacher_name`, `teacher_email`, `teacher_password`, `teacher_profile`, `usertype`) VALUES
(6, 1, 'College of Computer Studies', 'Windel Pelayo', 'windelpelayo@email.com', 'windelpelayo', '../profile/freelancerprofile.jpg', ''),
(7, 5, 'College of Commerce', 'Leonard Balabat', 'leonardbalabat@email.com', 'leonardbalabat', '../profile/clientprofile.jpg', ''),
(8, 1, 'College of Computer Studies', 'John Wick', 'johnwick@email.com', 'johnwick', '../profile/johnwick.webp', ''),
(9, 0, '', 'Admin', 'admin@email.com', 'admin', '../images/user.jpg', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `yearlevels`
--

CREATE TABLE `yearlevels` (
  `yearlevel_id` int(11) NOT NULL,
  `year_level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `yearlevels`
--

INSERT INTO `yearlevels` (`yearlevel_id`, `year_level`) VALUES
(1, '1st Year'),
(2, '2nd Year'),
(3, '3rd Year'),
(4, '4th Year');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `yearlevels`
--
ALTER TABLE `yearlevels`
  ADD PRIMARY KEY (`yearlevel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `yearlevels`
--
ALTER TABLE `yearlevels`
  MODIFY `yearlevel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
