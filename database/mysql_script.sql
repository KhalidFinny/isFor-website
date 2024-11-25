CREATE DATABASE IF NOT EXISTS isfor;
USE isfor;


-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2024 at 01:08 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isfor`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
                          `agenda_id` int NOT NULL,
                          `title` varchar(100) DEFAULT NULL,
                          `description` text,
                          `location` varchar(255) DEFAULT NULL,
                          `date` date DEFAULT NULL,
                          `agenda_status_id` int DEFAULT NULL,
                          `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agenda_status`
--

CREATE TABLE `agenda_status` (
                                 `agenda_status_id` int NOT NULL,
                                 `agenda_status_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
                            `archive_id` int NOT NULL,
                            `user_id` int DEFAULT NULL,
                            `title` varchar(100) DEFAULT NULL,
                            `description` text,
                            `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
                             `education_id` int NOT NULL,
                             `education_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
                             `image_id` int NOT NULL,
                             `user_id` int DEFAULT NULL,
                             `image_url` varchar(255) DEFAULT NULL,
                             `caption` text,
                             `uploaded_at` datetime DEFAULT NULL,
                             `paper_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
                             `interest_id` int NOT NULL,
                             `interest_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE `papers` (
                          `paper_id` int NOT NULL,
                          `user_id` int DEFAULT NULL,
                          `archive_id` int DEFAULT NULL,
                          `title` varchar(100) DEFAULT NULL,
                          `file_url` varchar(255) DEFAULT NULL,
                          `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `researchers`
--

CREATE TABLE `researchers` (
                               `researcher_id` int NOT NULL,
                               `user_id` int DEFAULT NULL,
                               `bio` text,
                               `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `researchers`
--

INSERT INTO `researchers` (`researcher_id`, `user_id`, `bio`, `profile_picture`) VALUES
                                                                                     (24, 10, 'hjkass aksjsk akja saas', '6735519bd18c2.jpg'),
                                                                                     (25, 10, 'cncncncncnc cncncncncncncnc cncncncncn', '673551df22bdd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `researcher_education`
--

CREATE TABLE `researcher_education` (
                                        `researcher_id` int NOT NULL,
                                        `education_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `researcher_interests`
--

CREATE TABLE `researcher_interests` (
                                        `researcher_id` int NOT NULL,
                                        `interest_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
                        `role_id` int NOT NULL,
                        `role_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
                                                (1, 'admin'),
                                                (2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `user_id` int NOT NULL,
                         `username` varchar(50) DEFAULT NULL,
                         `password` varchar(255) DEFAULT NULL,
                         `email` varchar(100) DEFAULT NULL,
                         `profile_picture` varchar(255) DEFAULT NULL,
                         `role_id` int DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `profile_picture`, `role_id`) VALUES
                                                                                                   (19, 'admin', '$2y$10$Mrb1qdEaOsSaoTqDcWZn.OdT/ktjUpYG8acsflhE4bevNw18CeE8y', 'admin@example.com', '6739fbe52d88e.jpg', 1),
                                                                                                   (20, 'admin2', '$2y$10$BikPz8zcrW5G9MZPTcFgz.o08FVT/gEa/9hK9MGYqxMKhwg4wocGq', 'ayam@gmail.com', '673c159204ac3.jpg', 1),
                                                                                                   (21, 'tora kw', '$2y$10$qKDESx2Vqz1hMteFB7GP/uZYZ03VHHhTVEXc/TsV3kDGq78.6bbBe', 'paryani@gmail.com', '673c15d3468f7.jpg', 1),
                                                                                                   (29, 'tora', '$2y$10$696b0BS6PFVfMLFMjbNoT.R.o0YKx40.tZwH.upaAHv7QSYydyJTi', 'ayam@gmail.com', '673c125726487.jpg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
    ADD PRIMARY KEY (`agenda_id`),
  ADD KEY `agenda_status_id` (`agenda_status_id`),
  ADD KEY `agenda_ibfk_2` (`user_id`);

--
-- Indexes for table `agenda_status`
--
ALTER TABLE `agenda_status`
    ADD PRIMARY KEY (`agenda_status_id`);

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
    ADD PRIMARY KEY (`archive_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
    ADD PRIMARY KEY (`education_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
    ADD PRIMARY KEY (`image_id`),
  ADD KEY `paper_id` (`paper_id`),
  ADD KEY `galleries_ibfk_1` (`user_id`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
    ADD PRIMARY KEY (`interest_id`);

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
    ADD PRIMARY KEY (`paper_id`),
  ADD KEY `archive_id` (`archive_id`),
  ADD KEY `papers_ibfk_1` (`user_id`);

--
-- Indexes for table `researchers`
--
ALTER TABLE `researchers`
    ADD PRIMARY KEY (`researcher_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `researcher_education`
--
ALTER TABLE `researcher_education`
    ADD PRIMARY KEY (`researcher_id`,`education_id`),
  ADD KEY `education_id` (`education_id`);

--
-- Indexes for table `researcher_interests`
--
ALTER TABLE `researcher_interests`
    ADD PRIMARY KEY (`researcher_id`,`interest_id`),
  ADD KEY `interest_id` (`interest_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
    ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
    MODIFY `agenda_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agenda_status`
--
ALTER TABLE `agenda_status`
    MODIFY `agenda_status_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
    MODIFY `archive_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
    MODIFY `education_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
    MODIFY `image_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
    MODIFY `interest_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
    MODIFY `paper_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `researchers`
--
ALTER TABLE `researchers`
    MODIFY `researcher_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
    MODIFY `role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agenda`
--
ALTER TABLE `agenda`
    ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`agenda_status_id`) REFERENCES `agenda_status` (`agenda_status_id`),
  ADD CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `archives`
--
ALTER TABLE `archives`
    ADD CONSTRAINT `archives_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
    ADD CONSTRAINT `galleries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `galleries_ibfk_2` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`paper_id`);

--
-- Constraints for table `papers`
--
ALTER TABLE `papers`
    ADD CONSTRAINT `papers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `papers_ibfk_2` FOREIGN KEY (`archive_id`) REFERENCES `archives` (`archive_id`);

--
-- Constraints for table `researcher_education`
--
ALTER TABLE `researcher_education`
    ADD CONSTRAINT `researcher_education_ibfk_1` FOREIGN KEY (`researcher_id`) REFERENCES `researchers` (`researcher_id`),
  ADD CONSTRAINT `researcher_education_ibfk_2` FOREIGN KEY (`education_id`) REFERENCES `education` (`education_id`);

--
-- Constraints for table `researcher_interests`
--
ALTER TABLE `researcher_interests`
    ADD CONSTRAINT `researcher_interests_ibfk_1` FOREIGN KEY (`researcher_id`) REFERENCES `researchers` (`researcher_id`),
  ADD CONSTRAINT `researcher_interests_ibfk_2` FOREIGN KEY (`interest_id`) REFERENCES `interests` (`interest_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
    ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
ALTER TABLE users MODIFY COLUMN user_id INT AUTO_INCREMENT PRIMARY KEY;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
