-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2025 at 04:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `recently_borrowed_books`
--

CREATE TABLE `recently_borrowed_books` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `aiub_id` varchar(10) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date NOT NULL,
  `fees` decimal(10,2) NOT NULL,
  `token_number` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recently_borrowed_books`
--

INSERT INTO `recently_borrowed_books` (`id`, `full_name`, `aiub_id`, `book_title`, `borrow_date`, `return_date`, `fees`, `token_number`, `created_at`) VALUES
(2, 'John Doe', '21-56789-1', 'Clean Code', '2025-01-10', '2025-01-15', 3.50, NULL, '2025-01-24 21:29:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recently_borrowed_books`
--
ALTER TABLE `recently_borrowed_books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recently_borrowed_books`
--
ALTER TABLE `recently_borrowed_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
