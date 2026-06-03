-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 03, 2026 at 02:22 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `customers_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `dob` date NOT NULL,
  `join_date` date NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `gender`, `dob`, `join_date`, `phone`, `email`, `address`, `created_at`) VALUES
(1, 'John dongku', 'Smith', 'Male', '1995-05-10', '2024-01-15', '012345678', 'john.smith@gmail.com', 'Phnom Penh', '2026-06-03 14:11:49'),
(2, 'Mary', 'Johnson', 'Female', '1998-08-20', '2024-02-01', '098765432', 'mary.johnson@gmail.com', 'Siem Reap', '2026-06-03 14:11:49'),
(3, 'David', 'Brown', 'Male', '1992-03-12', '2024-02-10', '011223344', 'david.brown@gmail.com', 'Battambang', '2026-06-03 14:11:49'),
(4, 'Linda', 'Davis', 'Female', '1997-11-05', '2024-03-01', '015667788', 'linda.davis@gmail.com', 'Kampot', '2026-06-03 14:11:49'),
(5, 'Michael', 'Wilson', 'Male', '1990-07-25', '2024-03-15', '017889900', 'michael.wilson@gmail.com', 'Takeo', '2026-06-03 14:11:49'),
(6, 'Sarah', 'Taylor', 'Female', '1996-04-18', '2024-04-01', '010112233', 'sarah.taylor@gmail.com', 'Kandal', '2026-06-03 14:11:49'),
(7, 'James', 'Anderson', 'Male', '1993-09-30', '2024-04-20', '016445566', 'james.anderson@gmail.com', 'Kampong Cham', '2026-06-03 14:11:49'),
(8, 'Emma', 'Thomas', 'Female', '1999-01-22', '2024-05-05', '018778899', 'emma.thomas@gmail.com', 'Prey Veng', '2026-06-03 14:11:49'),
(9, 'Robert', 'Moore', 'Male', '1991-12-14', '2024-05-25', '013334455', 'robert.moore@gmail.com', 'Pursat', '2026-06-03 14:11:49'),
(10, 'Sophia', 'Martin', 'Female', '2000-06-08', '2024-06-10', '014556677', 'sophia.martin@gmail.com', 'Sihanoukville', '2026-06-03 14:11:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
