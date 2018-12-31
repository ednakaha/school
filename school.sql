-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: דצמבר 31, 2018 בזמן 07:29 PM
-- גרסת שרת: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `administrator`
--

CREATE TABLE `administrator` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `admin_role` int(11) NOT NULL,
  `admin_phone` varchar(15) COLLATE utf8_bin NOT NULL,
  `admin_email` varchar(254) COLLATE utf8_bin NOT NULL,
  `admin_password` varchar(200) COLLATE utf8_bin NOT NULL,
  `admin_image` varchar(150) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- הוצאת מידע עבור טבלה `administrator`
--

INSERT INTO `administrator` (`admin_id`, `admin_name`, `admin_role`, `admin_phone`, `admin_email`, `admin_password`, `admin_image`) VALUES
(12, 'ednaOwner', 2, '0527649230', 'ednakaha@gmail.com', '', 'Images/4BCF0CF2-53DA-4988-A9A0-AA80E7351D10.png'),
(16, 'AdminManager2', 2, '025400233', 'ednatest@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Images/B22413C9-C4B4-4545-B95C-AE7AF840EA0A.jpg'),
(17, 'ednaManager3', 2, '025400233', 'ednatest@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Images/8D13EA34-04B5-45F7-B7C8-7BFD7166BC3C.jpg'),
(18, 'test', 2, '0527659779', 'ednakaha@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Images/660CDDAE-BF28-44F2-AF1C-5D90D11AB7CE.jpg'),
(19, 'edna2', 3, '0527649230', 'ednakaha@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Images/11F6E6F5-6325-4EFF-A6D9-3EC1C16F9515.png'),
(22, 'ednaOwner22', 3, '0527649230', 'ednatest@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
(23, 'owner', 1, '0527649230', 'ednatest@gmail.com', '0433e3038e208089eb74b7d9c8f5725f', NULL),
(24, 'man', 2, '0527649230', 'ednakaha@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `course_description` varchar(500) COLLATE utf8_bin NOT NULL,
  `course_image` varchar(150) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- הוצאת מידע עבור טבלה `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_description`, `course_image`) VALUES
(34, 'new course 4444', 'new course', 'Images/1FC937F8-EFD3-4973-9AD2-CF931A4A2466.png'),
(35, 'new', '!!Course', 'Images/810BC61C-C134-4F4D-A200-9599DF808CB3.jpg'),
(36, 'new course', '!Course', 'Images/47273716-848C-4FA7-B8E2-0FA2043BE135.png'),
(37, 'PHP new', '!!Course', 'Images/052DBFA0-5F2D-4EED-8CD8-26E77D716F32.png'),
(38, 'PHP ytutu', '!!Course 212343412564', 'Images/8D6F4276-FB55-47A6-A166-884C30D8240B.jpg'),
(39, 'C# nhjhj', '!!Course', 'Images/C1F42911-3274-4D3A-9641-391F77045560.png'),
(40, 'PHP', '!!Course', 'Images/F2314B5C-C3A3-4C49-9F3A-22D89A3D5DBB.png'),
(41, 'Delphi', 'new', 'Images/117E40C5-EFC2-4042-A0A1-7BBA65F5475E.png'),
(43, 'Delphi', '!!Course', 'Images/C1DF84F3-30FB-4E89-96F7-425A52DCC77D.png');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- הוצאת מידע עבור טבלה `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'owner'),
(2, 'manager'),
(3, 'sales');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `student_phone` varchar(15) COLLATE utf8_bin NOT NULL,
  `student_email` varchar(254) COLLATE utf8_bin NOT NULL,
  `student_image` varchar(150) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- הוצאת מידע עבור טבלה `student`
--

INSERT INTO `student` (`student_id`, `student_name`, `student_phone`, `student_email`, `student_image`) VALUES
(1, 'Edna Kssssssssssssssssssssssssssssssssssahanowitz', '052764923052', 'ednakah@gmail.com', 'Images/A7C26915-53F1-4048-825A-D4696E732A9C.png'),
(12, ' !! new student !!', '0526464646', 'ednakaha@gmail.com', 'Images/0134383F-018B-428B-9356-B326F998284F.jpg'),
(14, 'new   12345', '234567890', '1234567890@gmail.com', 'Images/44104A85-B693-420D-A2CA-F679F4DF8E09.png'),
(15, ' test', '0527649230', 'ednakaha@gmail.com', 'Images/BD9E1F0A-2920-46E5-B097-FBFB78B82A41.png'),
(16, '        mm new test', '234567890', '1234567890@gmail.com', 'Images/B7428CAE-D4D3-442A-A8B8-2BC01C06EB3D.png'),
(17, 'new12345', '234567890', '1234567890@gmail.com', 'Images/BDF0C560-C8D3-4D66-B850-5AEB2D6CCE1B.png');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `students_courses`
--

CREATE TABLE `students_courses` (
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- הוצאת מידע עבור טבלה `students_courses`
--

INSERT INTO `students_courses` (`course_id`, `student_id`) VALUES
(34, 2),
(34, 3),
(34, 5),
(34, 14),
(34, 15),
(35, 2),
(35, 3),
(35, 5),
(35, 12),
(35, 14),
(35, 15),
(35, 17),
(36, 5),
(36, 12),
(36, 15),
(36, 16),
(37, 5),
(37, 12),
(37, 16),
(38, 5),
(38, 16),
(39, 1),
(39, 16),
(39, 17),
(40, 5),
(43, 17);

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `fk_role_admin` (`admin_role`);

--
-- אינדקסים לטבלה `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- אינדקסים לטבלה `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- אינדקסים לטבלה `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- אינדקסים לטבלה `students_courses`
--
ALTER TABLE `students_courses`
  ADD PRIMARY KEY (`course_id`,`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- הגבלות לטבלאות שהוצאו
--

--
-- הגבלות לטבלה `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `fk_role_admin` FOREIGN KEY (`admin_role`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
