-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 03:09 AM
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
-- Database: `acasta_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `income_db`
--

CREATE TABLE `income_db` (
  `ic_id` int(255) NOT NULL,
  `ic_date` date DEFAULT NULL,
  `ic_talent` varchar(55) NOT NULL,
  `ic_staff` varchar(35) NOT NULL,
  `ic_trakteer` int(100) NOT NULL,
  `ic_saweria` int(100) NOT NULL,
  `ic_socialbuzz` int(100) NOT NULL,
  `ic_yt` int(100) NOT NULL,
  `ic_tiktok` int(100) NOT NULL,
  `ic_total` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income_db`
--

INSERT INTO `income_db` (`ic_id`, `ic_date`, `ic_talent`, `ic_staff`, `ic_trakteer`, `ic_saweria`, `ic_socialbuzz`, `ic_yt`, `ic_tiktok`, `ic_total`) VALUES
(4, '2024-05-04', 'Raisa Diningrat', 'Bayu', 300000, 1239200, 293000, 502100, 304400, 2638700),
(5, '2024-05-07', 'Raisa Diningrat', 'Ashley', 290000, 829000, 270000, 381000, 712000, 2482000),
(6, '2024-04-10', 'Raisa Diningrat', 'Bayu', 2203000, 1239200, 270000, 400000, 504400, 4616600),
(7, '2024-06-07', 'Raisa Diningrat', 'Ahmad', 300000, 829000, 320000, 400000, 304400, 2153400);

--
-- Triggers `income_db`
--
DELIMITER $$
CREATE TRIGGER `update_ic_total` BEFORE INSERT ON `income_db` FOR EACH ROW BEGIN
    SET NEW.ic_total = NEW.ic_trakteer + NEW.ic_saweria + NEW.ic_socialbuzz + NEW.ic_yt + NEW.ic_tiktok;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_ic_total_before_update` BEFORE UPDATE ON `income_db` FOR EACH ROW BEGIN
    SET NEW.ic_total = NEW.ic_trakteer + NEW.ic_saweria + NEW.ic_socialbuzz + NEW.ic_yt + NEW.ic_tiktok;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_db`
--

CREATE TABLE `staff_db` (
  `kode_staff` varchar(15) NOT NULL,
  `nama_staff` varchar(40) NOT NULL,
  `jabatan_staff` varchar(35) NOT NULL,
  `email_staff` varchar(45) NOT NULL,
  `telepon_staff` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_db`
--

INSERT INTO `staff_db` (`kode_staff`, `nama_staff`, `jabatan_staff`, `email_staff`, `telepon_staff`) VALUES
('ACT001', 'Ashley', 'Founder', 'opopop@opopo.com', 89789789),
('ACT002', 'Selene', 'CO-Founder', '(email2)', 2147483647),
('ACT003', 'Joko', 'Manager', '(email3)', 3),
('ACT004', 'Ahmad', 'Manager', '(email4)', 4),
('ACT005', 'Bayu', 'Staff', '(email5)', 5),
('ACT120', 'Puan', 'DPR', 'puan@acasta.co.id', 23123123),
('ACT99', 'Tukul', 'Manager', 'tukul123@gmail.com', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `talent_db`
--

CREATE TABLE `talent_db` (
  `tl_kode` varchar(50) NOT NULL,
  `tl_nama` varchar(50) NOT NULL,
  `tl_alias` varchar(55) NOT NULL,
  `tl_manager` varchar(50) NOT NULL,
  `tl_email` varchar(50) NOT NULL,
  `tl_emailtalent` varchar(55) NOT NULL,
  `tl_telepon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `talent_db`
--

INSERT INTO `talent_db` (`tl_kode`, `tl_nama`, `tl_alias`, `tl_manager`, `tl_email`, `tl_emailtalent`, `tl_telepon`) VALUES
('ACTTL092', 'Raisa Diningrat', 'Miyazaki GenaR', 'Joko', 'raisa@acasta.co.id', 'a123123', '081233992283');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id`, `user_id`, `session_id`) VALUES
(34, 1, 'mgvrr5mkon9ih9l3baire8vg91');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', NULL),
(2, 'staff', 'staff', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `income_db`
--
ALTER TABLE `income_db`
  ADD PRIMARY KEY (`ic_id`);

--
-- Indexes for table `staff_db`
--
ALTER TABLE `staff_db`
  ADD PRIMARY KEY (`kode_staff`);

--
-- Indexes for table `talent_db`
--
ALTER TABLE `talent_db`
  ADD PRIMARY KEY (`tl_kode`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `income_db`
--
ALTER TABLE `income_db`
  MODIFY `ic_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD CONSTRAINT `userlogin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
