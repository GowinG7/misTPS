-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 04:42 PM
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
-- Database: `mis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl1`
--

CREATE TABLE `tbl1` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `Gender` enum('M','F') NOT NULL,
  `DOB` date NOT NULL,
  `depart` enum('IT','Finance','inven','prod') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl1`
--

INSERT INTO `tbl1` (`id`, `name`, `address`, `Gender`, `DOB`, `depart`, `created_at`) VALUES
(1, 'Gobinda Ghimirooooe', 'Bharatpur-6, Indrapuri', 'M', '2003-07-27', 'IT', '2025-03-17 03:27:36'),
(2, 'GG', 'Bharatpur-6', 'M', '2006-12-28', 'Finance', '2025-03-17 03:31:58'),
(5, 'Priya', 'Sharma', 'F', '2000-01-02', 'Finance', '2025-03-25 15:22:04'),
(6, 'Hello', 'k', 'F', '2000-02-02', 'Finance', '2025-03-25 15:35:26'),
(7, 'ff1', 'ff1', 'F', '2006-12-31', 'prod', '2025-03-25 15:38:10'),
(12, 'Go', 'ssa', 'M', '2000-10-10', 'IT', '2025-04-16 14:16:25'),
(13, 'Go', 'ssa', 'M', '2000-10-10', 'IT', '2025-04-16 14:16:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl1`
--
ALTER TABLE `tbl1`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl1`
--
ALTER TABLE `tbl1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
