-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Mar 2025 pada 03.48
-- Versi server: 8.0.30
-- Versi PHP: 8.3.15

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
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddLetter` (IN `p_title` VARCHAR(255), IN `p_date` DATE, IN `p_file_url` TEXT, IN `p_status` INT, IN `p_user_id` INT)   BEGIN
    INSERT INTO letters (title, `date`, file_url, status, user_id)
    VALUES (p_title, p_date, p_file_url, p_status, p_user_id);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CountPendingStatus` (IN `p_user_id` INT)   BEGIN
    SELECT COUNT(status) AS total
    FROM letters
    WHERE status = 1 AND user_id = p_user_id;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAllLetters` ()   BEGIN
    SELECT * FROM letters;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAllLettersPaginate` (IN `p_offset` INT, IN `p_limit` INT)   BEGIN
    SELECT *
    FROM letters
    ORDER BY `date` DESC
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetPendingLettersWithPagination` (IN `p_offset` INT, IN `p_limit` INT)   BEGIN
    SELECT letter_id, title, file_url, status, user_id, `date`
    FROM letters
    WHERE status = 1
    ORDER BY `date` DESC
    LIMIT p_offset, p_limit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetTotalPendingLetters` ()   BEGIN
    SELECT COUNT(*) AS total
    FROM letters
    WHERE status = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_SearchLettersUser` (IN `p_Keyword` VARCHAR(255), IN `p_UserId` INT, IN `p_Limit` INT, IN `p_Offset` INT)   BEGIN
    SELECT *
    FROM letters
    WHERE (title LIKE CONCAT('%', p_Keyword, '%') OR `date` LIKE CONCAT('%', p_Keyword, '%'))
      AND user_id = p_UserId
    ORDER BY `date` DESC
    LIMIT p_Offset, p_Limit;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `agenda_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galleries`
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
-- Struktur dari tabel `letters`
--

CREATE TABLE `letters` (
  `letter_id` int NOT NULL,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `user_id` int NOT NULL,
  `date` date DEFAULT NULL,
  `comment` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `research_outputs`
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
-- Struktur dari tabel `roadmaps`
--

CREATE TABLE `roadmaps` (
  `roadmap_id` int NOT NULL,
  `year_start` int DEFAULT NULL,
  `year_end` int DEFAULT NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `topic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roadmaps`
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
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `role_id` int NOT NULL,
  `role_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `email`, `profile_picture`, `password`, `role_id`) VALUES
(1, 'admin', 'admin', 'admin@example.com', NULL, '$2y$10$EuZrLQWpmtPHoknQ8WoelOxNNeZJI1Amqu3JRQ2Uihz5R4bmUGhvi', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`agenda_id`);

--
-- Indeks untuk tabel `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `fk_user` (`uploaded_by`);

--
-- Indeks untuk tabel `letters`
--
ALTER TABLE `letters`
  ADD PRIMARY KEY (`letter_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indeks untuk tabel `research_outputs`
--
ALTER TABLE `research_outputs`
  ADD PRIMARY KEY (`research_output_id`),
  ADD KEY `uploaded_by` (`uploaded_by`),
  ADD KEY `research_outputs_ibkf_2` (`status`);

--
-- Indeks untuk tabel `roadmaps`
--
ALTER TABLE `roadmaps`
  ADD PRIMARY KEY (`roadmap_id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `agenda_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `galleries`
--
ALTER TABLE `galleries`
  MODIFY `gallery_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `letters`
--
ALTER TABLE `letters`
  MODIFY `letter_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `research_outputs`
--
ALTER TABLE `research_outputs`
  MODIFY `research_output_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roadmaps`
--
ALTER TABLE `roadmaps`
  MODIFY `roadmap_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `letters`
--
ALTER TABLE `letters`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `research_outputs`
--
ALTER TABLE `research_outputs`
  ADD CONSTRAINT `research_outputs_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `research_outputs_ibkf_2` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
