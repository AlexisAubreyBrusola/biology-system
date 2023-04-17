-- BEFORE RUNNING THIS SQL DUMP, A DATABASE SHOULD BE CREATED FIRST


-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 06:20 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `email`, `password`, `date_created`) VALUES
(1, 'Admin1', 'Lastname', 'admin@gmail.com', '$2y$10$jUeZKPpbIRtgTW326MkUP.snrERlCg.XissqJR33Q71eqrHEB7Ab.', '2023-03-30 10:42:52'),
(2, 'Alexis Aubrey', 'Brusola', 'alexisaubreybonon.brusola@bicol-u.edu.ph', '$2y$10$VgylxSa8UK66LLwfNdpQ3.Z49xPwWI9GoPgQoktIiy//mbME3Y3ym', '2023-03-30 10:42:52'),
(3, 'Admin', 'Two', 'admin2@gmail.com', '$2y$10$Fi.7cCfaWerAUC/aTLdFj.9MtxHILACsJHGtcPwzQ7ViHFz9aCioi', '2023-04-11 10:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `basket_id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_acquired` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `basket_inventory`
--

CREATE TABLE `basket_inventory` (
  `basket_inventory_id` int(11) NOT NULL,
  `total_quantity` int(11) NOT NULL DEFAULT 0,
  `available_quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `borrower_id` int(11) NOT NULL,
  `borrower_type_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact_no` varchar(12) DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrower_type`
--

CREATE TABLE `borrower_type` (
  `borrower_type_id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrower_type`
--

INSERT INTO `borrower_type` (`borrower_type_id`, `type_name`) VALUES
(2, 'faculty'),
(3, 'research staff'),
(1, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `chemical`
--

CREATE TABLE `chemical` (
  `chemical_id` int(11) NOT NULL,
  `container` int(11) NOT NULL,
  `chemical_name` varchar(255) NOT NULL,
  `chemical_formula` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `expiration_date` datetime NOT NULL,
  `date_acquired` datetime DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `times_borrowed` int(11) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chemical_inventory`
--

CREATE TABLE `chemical_inventory` (
  `chemical_inventory_id` int(11) NOT NULL,
  `chemical_id` int(11) NOT NULL,
  `container` int(11) NOT NULL,
  `total_quantity` int(11) NOT NULL DEFAULT 0,
  `available_quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL,
  `equipment_code` varchar(50) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `times_borrowed` int(11) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_category`
--

CREATE TABLE `equipment_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_inventory`
--

CREATE TABLE `equipment_inventory` (
  `equipment_inventory_id` int(11) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `total_quantity` int(11) NOT NULL DEFAULT 0,
  `available_quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` varchar(50) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `borrower_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prepared_reservation`
--

CREATE TABLE `prepared_reservation` (
  `reservation_id` int(11) NOT NULL,
  `basket_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `date_prepared` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `released_reservation`
--

CREATE TABLE `released_reservation` (
  `reservation_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `released_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `research_staff`
--

CREATE TABLE `research_staff` (
  `research_staff_id` varchar(50) NOT NULL,
  `borrower_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `reference_no` varchar(50) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `faculty_id` varchar(50) DEFAULT NULL,
  `admin_id` int(11) NOT NULL,
  `lab_experiment_title` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `return_date` datetime NOT NULL,
  `semester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_chemical`
--

CREATE TABLE `reservation_chemical` (
  `reservation_id` int(11) NOT NULL,
  `chemical_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_returned` tinyint(1) DEFAULT 0,
  `date_returned` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_equipment`
--

CREATE TABLE `reservation_equipment` (
  `reservation_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `is_returned` tinyint(1) NOT NULL DEFAULT 0,
  `date_returned` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `semester_name` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_table`
--

CREATE TABLE `status_table` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` varchar(50) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_block` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `firstname` (`firstname`),
  ADD UNIQUE KEY `lastname` (`lastname`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`basket_id`);

--
-- Indexes for table `basket_inventory`
--
ALTER TABLE `basket_inventory`
  ADD PRIMARY KEY (`basket_inventory_id`);

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`borrower_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `borrower_type_id` (`borrower_type_id`);

--
-- Indexes for table `borrower_type`
--
ALTER TABLE `borrower_type`
  ADD PRIMARY KEY (`borrower_type_id`),
  ADD UNIQUE KEY `type_name` (`type_name`);

--
-- Indexes for table `chemical`
--
ALTER TABLE `chemical`
  ADD PRIMARY KEY (`chemical_id`,`container`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `chemical_inventory`
--
ALTER TABLE `chemical_inventory`
  ADD PRIMARY KEY (`chemical_inventory_id`),
  ADD KEY `chemical_id` (`chemical_id`,`container`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`),
  ADD UNIQUE KEY `equipment_code` (`equipment_code`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `equipment_category`
--
ALTER TABLE `equipment_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `equipment_inventory`
--
ALTER TABLE `equipment_inventory`
  ADD PRIMARY KEY (`equipment_inventory_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`),
  ADD KEY `borrower_id` (`borrower_id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`borrower_id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `prepared_reservation`
--
ALTER TABLE `prepared_reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `basket_id` (`basket_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `released_reservation`
--
ALTER TABLE `released_reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `research_staff`
--
ALTER TABLE `research_staff`
  ADD PRIMARY KEY (`research_staff_id`),
  ADD KEY `borrower_id` (`borrower_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD UNIQUE KEY `reference_no` (`reference_no`),
  ADD KEY `borrower_id` (`borrower_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `reservation_chemical`
--
ALTER TABLE `reservation_chemical`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `chemical_id` (`chemical_id`);

--
-- Indexes for table `reservation_equipment`
--
ALTER TABLE `reservation_equipment`
  ADD PRIMARY KEY (`reservation_id`),
  ADD UNIQUE KEY `equipment_id` (`equipment_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`),
  ADD UNIQUE KEY `semester_name` (`semester_name`);

--
-- Indexes for table `status_table`
--
ALTER TABLE `status_table`
  ADD PRIMARY KEY (`status_id`),
  ADD UNIQUE KEY `status_name` (`status_name`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `borrower_id` (`borrower_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `basket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `basket_inventory`
--
ALTER TABLE `basket_inventory`
  MODIFY `basket_inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `borrower_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `borrower_type`
--
ALTER TABLE `borrower_type`
  MODIFY `borrower_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chemical`
--
ALTER TABLE `chemical`
  MODIFY `chemical_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chemical_inventory`
--
ALTER TABLE `chemical_inventory`
  MODIFY `chemical_inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment_category`
--
ALTER TABLE `equipment_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment_inventory`
--
ALTER TABLE `equipment_inventory`
  MODIFY `equipment_inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_table`
--
ALTER TABLE `status_table`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD CONSTRAINT `borrowers_ibfk_1` FOREIGN KEY (`borrower_type_id`) REFERENCES `borrower_type` (`borrower_type_id`);

--
-- Constraints for table `chemical`
--
ALTER TABLE `chemical`
  ADD CONSTRAINT `chemical_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status_table` (`status_id`);

--
-- Constraints for table `chemical_inventory`
--
ALTER TABLE `chemical_inventory`
  ADD CONSTRAINT `chemical_inventory_ibfk_1` FOREIGN KEY (`chemical_id`,`container`) REFERENCES `chemical` (`chemical_id`, `container`);

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status_table` (`status_id`);

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`borrower_id`);

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`borrower_id`),
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`);

--
-- Constraints for table `prepared_reservation`
--
ALTER TABLE `prepared_reservation`
  ADD CONSTRAINT `prepared_reservation_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`),
  ADD CONSTRAINT `prepared_reservation_ibfk_2` FOREIGN KEY (`basket_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `prepared_reservation_ibfk_3` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `released_reservation`
--
ALTER TABLE `released_reservation`
  ADD CONSTRAINT `released_reservation_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`),
  ADD CONSTRAINT `released_reservation_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `research_staff`
--
ALTER TABLE `research_staff`
  ADD CONSTRAINT `research_staff_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`borrower_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`borrower_id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `reservation_ibfk_4` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`);

--
-- Constraints for table `reservation_chemical`
--
ALTER TABLE `reservation_chemical`
  ADD CONSTRAINT `reservation_chemical_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`),
  ADD CONSTRAINT `reservation_chemical_ibfk_2` FOREIGN KEY (`chemical_id`) REFERENCES `chemical` (`chemical_id`);

--
-- Constraints for table `reservation_equipment`
--
ALTER TABLE `reservation_equipment`
  ADD CONSTRAINT `reservation_equipment_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`),
  ADD CONSTRAINT `reservation_equipment_ibfk_2` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `borrowers` (`borrower_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
