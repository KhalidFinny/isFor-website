-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2025 at 03:07 PM
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
-- Database: `isfor_database`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddAgenda` (IN `p_title` VARCHAR(255), IN `p_description` TEXT)   BEGIN
    INSERT INTO agenda (title, description) VALUES (p_title, p_description);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddLetter` (IN `p_title` VARCHAR(255), IN `p_date` DATE, IN `p_file_url` TEXT, IN `p_status` INT, IN `p_user_id` INT)   BEGIN
    INSERT INTO letters (title, `date`, file_url, status, user_id)
    VALUES (p_title, p_date, p_file_url, p_status, p_user_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddRoadmap` (IN `p_year_start` INT, IN `p_year_end` INT, IN `p_category` VARCHAR(255), IN `p_topic` VARCHAR(255))   BEGIN
    INSERT INTO roadmaps (year_start, year_end, category, topic)
    VALUES (p_year_start, p_year_end, p_category, p_topic);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountAllFiles` ()   BEGIN
    SELECT COUNT(*) AS total
    FROM research_outputs;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountAllFilesByStatus` (IN `p_status` INT)   BEGIN
    SELECT COUNT(*) AS total
    FROM research_outputs
    WHERE status = p_status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountAllLetters` ()   BEGIN
    SELECT COUNT(*) AS total
    FROM letters;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountAllLettersByUserId` (IN `p_user_id` INT)   BEGIN
    SELECT COUNT(file_url) AS total 
    FROM letters 
    WHERE user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountPending` ()   BEGIN
    SELECT COUNT(status) AS total
    FROM letters
    WHERE status = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountPendingFiles` ()   BEGIN
    SELECT COUNT(*) AS total
    FROM research_outputs
    WHERE status = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountPendingStatus` (IN `p_user_id` INT)   BEGIN
    SELECT COUNT(status) AS total
    FROM letters
    WHERE status = 1 AND user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountRejectedFiles` ()   BEGIN
    SELECT COUNT(*) AS total
    FROM research_outputs
    WHERE status = 3;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountRejectedLetters` ()   BEGIN
    SELECT COUNT(*) AS total
    FROM letters
    WHERE status = 3;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountRejectStat` (IN `p_user_id` INT)   BEGIN
    SELECT COUNT(status) AS total
    FROM letters
    WHERE status = 3 AND user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountResearchOutputsByUser` (IN `p_uploaded_by` INT)   BEGIN
    SELECT COUNT(*) AS total
    FROM research_outputs
    WHERE uploaded_by = p_uploaded_by;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountSearchFiles` (IN `p_Keyword` VARCHAR(255))   BEGIN
    SELECT COUNT(*) AS total
    FROM research_outputs
    WHERE title LIKE CONCAT('%', p_Keyword, '%')
       OR category LIKE CONCAT('%', p_Keyword, '%')
       OR description LIKE CONCAT('%', p_Keyword, '%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountSearchFilesUser` (IN `p_Keyword` VARCHAR(255), IN `p_UserId` INT)   BEGIN
    SELECT COUNT(*) AS total
    FROM research_outputs
    WHERE uploaded_by = p_UserId
      AND (title LIKE CONCAT('%', p_Keyword, '%')
           OR category LIKE CONCAT('%', p_Keyword, '%')
           OR description LIKE CONCAT('%', p_Keyword, '%'));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountSearchLettersUser` (IN `p_Keyword` VARCHAR(255), IN `p_UserId` INT)   BEGIN
    SELECT COUNT(*) AS total
    FROM letters
    WHERE (title LIKE CONCAT('%', p_Keyword, '%') OR `date` LIKE CONCAT('%', p_Keyword, '%'))
      AND user_id = p_UserId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountVerify` ()   BEGIN
    SELECT COUNT(status) AS total
    FROM letters
    WHERE status = 2;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountVerifyStatus` (IN `p_user_id` INT)   BEGIN
    SELECT COUNT(status) AS total
    FROM letters
    WHERE status = 2 AND user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CreateResearchOutput` (IN `p_file_url` VARCHAR(255), IN `p_uploaded_by` INT, IN `p_title` VARCHAR(255), IN `p_category` VARCHAR(255), IN `p_description` TEXT, IN `p_status` INT)   BEGIN
    INSERT INTO research_outputs (file_url, uploaded_by, title, category, description, status)
    VALUES (p_file_url, p_uploaded_by, p_title, p_category, p_description, p_status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteAgenda` (IN `p_id` INT)   BEGIN
    DELETE FROM agenda WHERE agenda_id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteRoadmap` (IN `p_year_start` INT, IN `p_year_end` INT)   BEGIN
    DELETE FROM roadmaps
    WHERE year_start = p_year_start AND year_end = p_year_end;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteRoadmapById` (IN `p_roadmap_id` INT)   BEGIN
    DELETE FROM roadmaps
    WHERE roadmap_id = p_roadmap_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EditAgenda` (IN `p_id` INT, IN `p_title` VARCHAR(255), IN `p_description` TEXT)   BEGIN
    UPDATE agenda 
    SET title = p_title, 
        description = p_description 
    WHERE agenda_id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAgendaById` (IN `p_id` INT)   BEGIN
    SELECT * FROM agenda WHERE agenda_id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAllAgenda` ()   BEGIN
    SELECT *, ROW_NUMBER() OVER (ORDER BY agenda_id) AS number FROM agenda;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAllLetters` ()   BEGIN
    SELECT * FROM letters;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAllLettersPaginate` (IN `p_offset` INT, IN `p_limit` INT)   BEGIN
    SELECT *
    FROM letters
    ORDER BY `date` DESC
    LIMIT p_offset, p_limit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAllPaginatedFiles` (IN `p_itemsPerPage` INT, IN `p_offset` INT)   BEGIN
    SELECT *
    FROM research_outputs
    ORDER BY uploaded_at DESC
    LIMIT p_offset, p_itemsPerPage;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAllPaginatedFilesByStatus` (IN `p_status` INT, IN `p_itemsPerPage` INT, IN `p_offset` INT)   BEGIN
    SELECT *
    FROM research_outputs
    WHERE status = p_status
    ORDER BY uploaded_at DESC
    LIMIT p_offset, p_itemsPerPage;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAllResearchOutputs` ()   BEGIN
    SELECT * FROM research_outputs;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAllVerifyResearchOutputs` (IN `p_limit` INT, IN `p_offset` INT)   BEGIN
    SELECT *
    FROM research_outputs
    WHERE status = 2
    ORDER BY uploaded_at DESC
    LIMIT p_offset, p_limit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetLetterById` (IN `p_id` INT)   BEGIN
    SELECT file_url FROM letters WHERE letter_id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetLetterByUserId` (IN `p_user_id` INT)   BEGIN
    SELECT * FROM letters WHERE user_id = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetLetterByUserIdLimit` (IN `p_id` INT)   BEGIN
    SELECT * FROM letters 
    WHERE user_id = p_id 
    ORDER BY `date` DESC
    LIMIT 5;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetLetterByUserIdPaginate` (IN `p_id` INT, IN `p_awalData` INT, IN `p_jumlahDataPerhalaman` INT)   BEGIN
    SELECT * 
    FROM letters 
    WHERE user_id = p_id 
    ORDER BY `date` DESC 
    LIMIT p_awalData, p_jumlahDataPerhalaman;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetPaginatedFilesByUser` (IN `p_UserId` INT, IN `p_Limit` INT, IN `p_Offset` INT)   BEGIN
    SELECT *
    FROM research_outputs
    WHERE uploaded_by = p_UserId
    ORDER BY uploaded_at DESC
    LIMIT p_Offset, p_Limit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetPaginatedFilesByUserAndStatus` (IN `p_UserId` INT, IN `p_Status` INT, IN `p_Limit` INT, IN `p_Offset` INT)   BEGIN
    SELECT *
    FROM research_outputs
    WHERE uploaded_by = p_UserId AND status = p_Status
    ORDER BY uploaded_at DESC
    LIMIT p_Offset, p_Limit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetPendingFilesWithPagination` (IN `p_Limit` INT, IN `p_Offset` INT)   BEGIN
    SELECT *
    FROM research_outputs
    WHERE status = 1
    ORDER BY uploaded_at DESC
    LIMIT p_Offset, p_Limit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetPendingLettersWithPagination` (IN `p_offset` INT, IN `p_limit` INT)   BEGIN
    SELECT letter_id, title, file_url, status, user_id, `date`
    FROM letters
    WHERE status = 1
    ORDER BY `date` DESC
    LIMIT p_offset, p_limit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetResearchDIPAPNBP` ()   BEGIN
    SELECT *
    FROM research_outputs
    WHERE category LIKE 'DIPA PNBP';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetResearchDIPASWA` ()   BEGIN
    SELECT *
    FROM research_outputs
    WHERE category LIKE 'DIPA SWADANA';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetResearchOutputById` (IN `p_id` INT)   BEGIN
    SELECT * FROM research_outputs
    WHERE research_output_id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetResearchOutputsByStatus` (IN `p_status` INT)   BEGIN
    SELECT * FROM research_outputs
    WHERE status = p_status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetResearchOutputsByUser` (IN `p_uploaded_by` INT)   BEGIN
    SELECT *
    FROM research_outputs
    WHERE uploaded_by = p_uploaded_by
    ORDER BY uploaded_at DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetResearchOutputsByUserAndStatus` (IN `p_uploaded_by` INT, IN `p_status` INT, IN `p_awalData` INT, IN `p_jumlahDataPerhalaman` INT)   BEGIN
    SELECT *
    FROM research_outputs
    WHERE uploaded_by = p_uploaded_by AND status = p_status
    ORDER BY uploaded_at DESC
    LIMIT p_awalData, p_jumlahDataPerhalaman;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetResearchTesis` ()   BEGIN
    SELECT *
    FROM research_outputs
    WHERE category LIKE 'Tesis Magister';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetRoadmapByPeriode` (IN `p_year_start` INT, IN `p_year_end` INT)   BEGIN
    SELECT *
    FROM roadmaps
    WHERE year_start = p_year_start AND year_end = p_year_end;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetRoadmaps` (IN `p_year_start` INT, IN `p_year_end` INT)   BEGIN
    SELECT *
    FROM roadmaps
    WHERE year_start = p_year_start AND year_end = p_year_end
    ORDER BY year_start ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetTotalPendingFiles` ()   BEGIN
    SELECT COUNT(1) AS total
    FROM research_outputs
    WHERE status = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetTotalPendingLetters` ()   BEGIN
    SELECT COUNT(*) AS total
    FROM letters
    WHERE status = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetTotalVerifiedResearchOutputs` ()   BEGIN
    SELECT COUNT(1) AS total
    FROM research_outputs
    WHERE status = 2;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetVerifiedResearchOutputs` (IN `p_Limit` INT, IN `p_Offset` INT)   BEGIN
    SELECT research_output_id, file_url, uploaded_by, uploaded_at, title, category, status, description
    FROM research_outputs
    WHERE status = 2
    ORDER BY uploaded_at DESC
    LIMIT p_Offset, p_Limit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetVerifyResearchDIPAPNBP` (IN `p_Limit` INT, IN `p_Offset` INT)   BEGIN
    SELECT *
    FROM research_outputs
    WHERE category LIKE 'DIPA PNBP'
      AND status = 2
    ORDER BY uploaded_at DESC
    LIMIT p_Offset, p_Limit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetVerifyResearchDIPASWA` (IN `p_Limit` INT, IN `p_Offset` INT)   BEGIN
    SELECT *
    FROM research_outputs
    WHERE category LIKE 'DIPA SWADANA'
      AND status = 2
    ORDER BY uploaded_at DESC
    LIMIT p_Offset, p_Limit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetVerifyResearchTesis` (IN `p_Limit` INT, IN `p_Offset` INT)   BEGIN
    SELECT *
    FROM research_outputs
    WHERE category LIKE 'Tesis Magister'
      AND status = 2
    ORDER BY uploaded_at DESC
    LIMIT p_Offset, p_Limit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetYears` ()   BEGIN
    SELECT DISTINCT year_start, year_end FROM roadmaps;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_SearchFiles` (IN `p_Keyword` VARCHAR(255), IN `p_Limit` INT, IN `p_Offset` INT)   BEGIN
    SELECT research_output_id, title, category, status, file_url, uploaded_at
    FROM research_outputs
    WHERE title LIKE CONCAT('%', p_Keyword, '%')
       OR category LIKE CONCAT('%', p_Keyword, '%')
       OR description LIKE CONCAT('%', p_Keyword, '%')
    ORDER BY uploaded_at DESC
    LIMIT p_Offset, p_Limit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_SearchFilesUser` (IN `p_Keyword` VARCHAR(255), IN `p_UserId` INT, IN `p_Limit` INT, IN `p_Offset` INT)   BEGIN
    SELECT research_output_id, title, category, status, file_url, uploaded_at
    FROM research_outputs
    WHERE uploaded_by = p_UserId
      AND (title LIKE CONCAT('%', p_Keyword, '%')
           OR category LIKE CONCAT('%', p_Keyword, '%')
           OR description LIKE CONCAT('%', p_Keyword, '%'))
    ORDER BY uploaded_at DESC
    LIMIT p_Offset, p_Limit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_SearchLettersUser` (IN `p_Keyword` VARCHAR(255), IN `p_UserId` INT, IN `p_Limit` INT, IN `p_Offset` INT)   BEGIN
    SELECT *
    FROM letters
    WHERE (title LIKE CONCAT('%', p_Keyword, '%') OR `date` LIKE CONCAT('%', p_Keyword, '%'))
      AND user_id = p_UserId
    ORDER BY `date` DESC
    LIMIT p_Offset, p_Limit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UpdateResearchOutput` (IN `p_id` INT, IN `p_file_url` VARCHAR(255), IN `p_title` VARCHAR(255), IN `p_category` VARCHAR(255), IN `p_status` INT)   BEGIN
    UPDATE research_outputs
    SET file_url = p_file_url,
        title = p_title,
        category = p_category,
        status = p_status
    WHERE research_output_id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UpdateRoadmap` (IN `p_roadmap_id` INT, IN `p_year_start` INT, IN `p_year_end` INT, IN `p_category` VARCHAR(255), IN `p_topic` VARCHAR(255))   BEGIN
    UPDATE roadmaps
    SET year_start = p_year_start,
        year_end = p_year_end,
        category = p_category,
        topic = p_topic
    WHERE roadmap_id = p_roadmap_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `agenda_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`agenda_id`, `title`, `description`) VALUES
(23, 'testing', 'TESTING1'),
(25, 'Sint est est conse', 'Anim repudiandae ut '),
(26, 'Et odit ea id tempor', 'A sint culpa veritat');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `gallery_id` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `uploaded_by` int NOT NULL,
  `created_at` date DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `letters`
--

CREATE TABLE `letters` (
  `letter_id` int NOT NULL,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` int NOT NULL,
  `user_id` int NOT NULL,
  `date` date DEFAULT NULL,
  `comment` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `research_outputs`
--

CREATE TABLE `research_outputs` (
  `research_output_id` int NOT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `uploaded_by` int NOT NULL,
  `uploaded_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `comment` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roadmaps`
--

CREATE TABLE `roadmaps` (
  `roadmap_id` int NOT NULL,
  `year_start` int DEFAULT NULL,
  `year_end` int DEFAULT NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `topic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roadmaps`
--

INSERT INTO `roadmaps` (`roadmap_id`, `year_start`, `year_end`, `category`, `topic`) VALUES
(201, 2022, 2025, 'Smart ICT', 'LORA Systems'),
(202, 2022, 2025, 'Smart ICT', 'LORA Mesh for IT Systems'),
(203, 2022, 2025, 'Smart ICT', 'LORA for Smart Systems'),
(204, 2022, 2025, 'IoT Applications', 'IoT for Urban Farming'),
(205, 2022, 2025, 'IoT Applications', 'IoT for Freshwater Fish'),
(206, 2022, 2025, 'IoT Applications', 'Smart Home'),
(207, 2022, 2025, 'IoT Applications', 'IoT for Power Electric Distribution'),
(208, 2022, 2025, 'Data Science & Analytics', 'Big Data Analysis'),
(209, 2022, 2025, 'Data Science & Analytics', 'Natural Language Processing'),
(210, 2022, 2025, 'Data Science & Analytics', 'Image Processing'),
(211, 2022, 2025, 'Business Management', 'Governance Fiscal Independency'),
(212, 2022, 2025, 'Business Management', 'Commercial Port Management System'),
(213, 2022, 2025, 'Business Management', 'Document Archiving Management'),
(214, 2026, 2028, 'Smart ICT', 'ICT for Industrial Automation'),
(215, 2026, 2028, 'Smart ICT', 'Integrated Data Transaction'),
(216, 2026, 2028, 'IoT Applications', 'Smart City'),
(217, 2026, 2028, 'IoT Applications', 'Smart Ecosystem'),
(218, 2026, 2028, 'IoT Applications', 'Smart Monitoring Systems'),
(219, 2026, 2028, 'Data Science & Analytics', 'Voice Command Technology'),
(220, 2026, 2028, 'Data Science & Analytics', 'Land & Building Mapping'),
(221, 2026, 2028, 'Data Science & Analytics', 'Intelligence System'),
(222, 2026, 2028, 'Data Science & Analytics', 'Integrated Information System: Trends & Prediction'),
(223, 2026, 2028, 'Business Management', 'Customer Relation Management System'),
(224, 2026, 2028, 'Business Management', 'Supply Chain Management'),
(225, 2026, 2028, 'Business Management', 'Analytic of Documents Archiving'),
(226, 2018, 2022, 'Smart ICT', 'Network Management System'),
(227, 2018, 2022, 'Smart ICT', 'Network Topology'),
(228, 2018, 2022, 'Smart ICT', 'Concept Electronics and IT Embedded System'),
(229, 2018, 2022, 'IoT Applications', 'IoT System'),
(230, 2018, 2022, 'IoT Applications', 'Sensors for IoT Systems'),
(231, 2018, 2022, 'Data Science & Analytics', 'Decision Support System'),
(232, 2018, 2022, 'Data Science & Analytics', 'Classification System'),
(233, 2018, 2022, 'Data Science & Analytics', 'Prediction System'),
(234, 2018, 2022, 'Data Science & Analytics', 'Cluster Analysis'),
(235, 2018, 2022, 'Business Management', 'Digital Marketing'),
(236, 2018, 2022, 'Business Management', 'Micro Commerce Management'),
(237, 2018, 2022, 'Business Management', 'Digital Tax management');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int NOT NULL,
  `role_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'tertunda'),
(2, 'disetujui'),
(3, 'ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `profile_picture`, `password`, `role_id`) VALUES
(1, 'Dr.Rakhmat Arianto, S.ST., M.Kom', 'admin', 'arianto@polinema.ac.id', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 1),
(2, 'Vipkas Al Hadid Firdaus, ST., MT', 'dsn1', 'dsn1@example.com', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 2),
(3, 'Ade Ismail, S.Kom., M.TI', 'dsn2', 'dsn2@example.com', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 2),
(4, 'Habibie Ed Dien, S.Kom., MT', 'ds3', 'dsn3@example.com', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 2),
(5, 'Septian Enggar Sukmana, S.Pd., MT', 'dsn4', 'dsn4@example.com', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 2),
(6, 'Vivi Nur Wijayaningrum, S.Kom., M.Kom', 'dsn5', 'dsn5@example.com', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 2),
(7, 'Rokhimatul Wakhidah, S.Pd., M.T.', 'dsn6', 'dsn6@example.com', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 2),
(8, 'Noprianto, S.Kom., M.Eng.', 'dsn7', 'dsn7@example.com', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 2),
(9, 'Anugrah Nur Rahmanto', 'dsn8', 'dsn8@example.com', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 2),
(10, 'Maskur, S.Kom., M.Kom', 'dsn9', 'dsn9@example.com', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 2),
(11, 'Nurul Hidayatinnisa\', SE., MM', 'dsn10', 'dsn10@example.com', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 2),
(12, 'Sapto Wibowo, S.T., M.Sc., Ph.D.', 'dsn11', 'dsn11@example.com', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 2),
(13, 'Ir. Nugroho Suharto, M.T', 'dsn12', 'dsn12@example.com', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 2),
(14, 'Galih Putra Riatma, S.ST., M.T.', 'dsn13', 'dsn13@example.com', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`agenda_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `fk_user` (`uploaded_by`);

--
-- Indexes for table `letters`
--
ALTER TABLE `letters`
  ADD PRIMARY KEY (`letter_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_status` (`status`);

--
-- Indexes for table `research_outputs`
--
ALTER TABLE `research_outputs`
  ADD PRIMARY KEY (`research_output_id`),
  ADD KEY `uploaded_by` (`uploaded_by`),
  ADD KEY `research_outputs_ibkf_2` (`status`);

--
-- Indexes for table `roadmaps`
--
ALTER TABLE `roadmaps`
  ADD PRIMARY KEY (`roadmap_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `agenda_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `gallery_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `letters`
--
ALTER TABLE `letters`
  MODIFY `letter_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `research_outputs`
--
ALTER TABLE `research_outputs`
  MODIFY `research_output_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roadmaps`
--
ALTER TABLE `roadmaps`
  MODIFY `roadmap_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `letters`
--
ALTER TABLE `letters`
  ADD CONSTRAINT `fk_status` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `research_outputs`
--
ALTER TABLE `research_outputs`
  ADD CONSTRAINT `research_outputs_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `research_outputs_ibkf_2` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
