-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: נובמבר 26, 2018 בזמן 01:10 PM
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
  `admin_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `admin_role` int(11) NOT NULL,
  `admin_phone` varchar(15) COLLATE utf8_bin NOT NULL,
  `admin_email` varchar(254) COLLATE utf8_bin NOT NULL,
  `admin_password` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- הוצאת מידע עבור טבלה `administrator`
--

INSERT INTO `administrator` (`admin_id`, `admin_name`, `admin_role`, `admin_phone`, `admin_email`, `admin_password`) VALUES
(12, 'edna', 1, '0527649230', 'ednakaha@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `course_description` varchar(500) COLLATE utf8_bin NOT NULL,
  `course_image` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- הוצאת מידע עבור טבלה `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_description`, `course_image`) VALUES
(1, 'PHP', 'new php course', '');

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
  `student_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `student_phone` varchar(15) COLLATE utf8_bin NOT NULL,
  `student_email` varchar(254) COLLATE utf8_bin NOT NULL,
  `student_image` varchar(150) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- הוצאת מידע עבור טבלה `student`
--

INSERT INTO `student` (`student_id`, `student_name`, `student_phone`, `student_email`, `student_image`) VALUES
(1, 'Edna Kahanowitz', '052-7649230', 'ednakaha@gmail.com', '');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
