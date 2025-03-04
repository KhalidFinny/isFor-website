USE [master]
GO
/****** Object:  Database [isfor_database]    Script Date: 30/01/2025 14:27:19 ******/
CREATE DATABASE [isfor_database]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'isfor_database', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\isfor_database.mdf' , SIZE = 73728KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'isfor_database_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\isfor_database_log.ldf' , SIZE = 139264KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT, LEDGER = OFF
GO
ALTER DATABASE [isfor_database] SET COMPATIBILITY_LEVEL = 160
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [isfor_database].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [isfor_database] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [isfor_database] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [isfor_database] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [isfor_database] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [isfor_database] SET ARITHABORT OFF 
GO
ALTER DATABASE [isfor_database] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [isfor_database] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [isfor_database] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [isfor_database] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [isfor_database] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [isfor_database] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [isfor_database] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [isfor_database] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [isfor_database] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [isfor_database] SET  ENABLE_BROKER 
GO
ALTER DATABASE [isfor_database] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [isfor_database] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [isfor_database] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [isfor_database] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [isfor_database] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [isfor_database] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [isfor_database] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [isfor_database] SET RECOVERY FULL 
GO
ALTER DATABASE [isfor_database] SET  MULTI_USER 
GO
ALTER DATABASE [isfor_database] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [isfor_database] SET DB_CHAINING OFF 
GO
ALTER DATABASE [isfor_database] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [isfor_database] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [isfor_database] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [isfor_database] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'isfor_database', N'ON'
GO
ALTER DATABASE [isfor_database] SET QUERY_STORE = ON
GO
ALTER DATABASE [isfor_database] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
USE [isfor_database]
GO
/****** Object:  Table [dbo].[agenda]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[agenda](
	[agenda_id] [int] IDENTITY(1,1) NOT NULL,
	[title] [nvarchar](255) NOT NULL,
	[description] [varchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[agenda_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[category]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[category](
	[category_id] [int] IDENTITY(1,1) NOT NULL,
	[category_name] [varchar](50) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[category_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[galleries]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[galleries](
	[gallery_id] [int] IDENTITY(1,1) NOT NULL,
	[image] [nvarchar](255) NULL,
	[category] [nvarchar](100) NOT NULL,
	[title] [nvarchar](255) NOT NULL,
	[uploaded_by] [int] NOT NULL,
	[created_at] [datetime] NULL,
	[description] [nvarchar](500) NULL,
PRIMARY KEY CLUSTERED 
(
	[gallery_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[letters]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[letters](
	[letter_id] [int] IDENTITY(1,1) NOT NULL,
	[title] [nvarchar](50) NULL,
	[file_url] [nvarchar](255) NOT NULL,
	[status] [int] NOT NULL,
	[user_id] [int] NOT NULL,
	[date] [date] NULL,
	[comment] [varchar](max) NULL,
PRIMARY KEY CLUSTERED 
(
	[letter_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[research_outputs]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[research_outputs](
	[research_output_id] [int] IDENTITY(1,1) NOT NULL,
	[file_url] [nvarchar](255) NOT NULL,
	[uploaded_by] [int] NOT NULL,
	[uploaded_at] [datetime] NULL,
	[title] [nvarchar](255) NOT NULL,
	[category] [nvarchar](100) NOT NULL,
	[status] [int] NOT NULL,
	[description] [nvarchar](max) NOT NULL,
	[comment] [varchar](max) NULL,
PRIMARY KEY CLUSTERED 
(
	[research_output_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[roadmaps]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[roadmaps](
	[roadmap_id] [int] IDENTITY(1,1) NOT NULL,
	[year_start] [int] NOT NULL,
	[year_end] [int] NOT NULL,
	[category] [nvarchar](100) NOT NULL,
	[topic] [nvarchar](255) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[roadmap_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[role]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[role](
	[role_id] [int] IDENTITY(1,1) NOT NULL,
	[role_name] [nvarchar](50) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[role_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[status]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[status](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[status] [nvarchar](50) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[users]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[users](
	[user_id] [int] IDENTITY(1,1) NOT NULL,
	[name] [nvarchar](100) NOT NULL,
	[username] [nvarchar](50) NOT NULL,
	[email] [nvarchar](100) NOT NULL,
	[profile_picture] [nvarchar](255) NULL,
	[password] [nvarchar](255) NOT NULL,
	[role_id] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[user_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY],
UNIQUE NONCLUSTERED 
(
	[email] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY],
UNIQUE NONCLUSTERED 
(
	[username] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[galleries] ADD  DEFAULT (getdate()) FOR [created_at]
GO
ALTER TABLE [dbo].[research_outputs] ADD  DEFAULT (getdate()) FOR [uploaded_at]
GO
ALTER TABLE [dbo].[research_outputs] ADD  DEFAULT ('') FOR [description]
GO
ALTER TABLE [dbo].[galleries]  WITH CHECK ADD  CONSTRAINT [FK_galleries_users] FOREIGN KEY([uploaded_by])
REFERENCES [dbo].[users] ([user_id])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[galleries] CHECK CONSTRAINT [FK_galleries_users]
GO
ALTER TABLE [dbo].[letters]  WITH CHECK ADD  CONSTRAINT [FK_letters_status] FOREIGN KEY([status])
REFERENCES [dbo].[status] ([id])
GO
ALTER TABLE [dbo].[letters] CHECK CONSTRAINT [FK_letters_status]
GO
ALTER TABLE [dbo].[letters]  WITH CHECK ADD  CONSTRAINT [FK_letters_users] FOREIGN KEY([user_id])
REFERENCES [dbo].[users] ([user_id])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[letters] CHECK CONSTRAINT [FK_letters_users]
GO
ALTER TABLE [dbo].[research_outputs]  WITH CHECK ADD  CONSTRAINT [FK_research_outputs_status] FOREIGN KEY([status])
REFERENCES [dbo].[status] ([id])
GO
ALTER TABLE [dbo].[research_outputs] CHECK CONSTRAINT [FK_research_outputs_status]
GO
ALTER TABLE [dbo].[research_outputs]  WITH CHECK ADD  CONSTRAINT [FK_research_outputs_users] FOREIGN KEY([uploaded_by])
REFERENCES [dbo].[users] ([user_id])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[research_outputs] CHECK CONSTRAINT [FK_research_outputs_users]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD  CONSTRAINT [FK_users_role] FOREIGN KEY([role_id])
REFERENCES [dbo].[role] ([role_id])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[users] CHECK CONSTRAINT [FK_users_role]
GO
/****** Object:  StoredProcedure [dbo].[AddUser]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[AddUser]
    @name NVARCHAR(100),
    @username NVARCHAR(100),
    @password NVARCHAR(255),
    @profile_picture NVARCHAR(255),
    @role_id INT,
    @user_email NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO users (name, username, password, email, profile_picture, role_id)
    VALUES (@name, @username, @password, @user_email, @profile_picture, @role_id);
END;
GO
/****** Object:  StoredProcedure [dbo].[GetPendingLettersWithPagination]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[GetPendingLettersWithPagination] 
    @Limit INT,
    @Offset INT
AS
BEGIN
    SELECT letter_id, title, file_url, status, user_id, [date] 
    FROM isfor_database.dbo.letters
    WHERE status = 1 -- Status 1 berarti pending
    ORDER BY [date] DESC
    OFFSET @Offset ROWS FETCH NEXT @Limit ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[GetTotalPendingLetters]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[GetTotalPendingLetters] 
AS
BEGIN
    SELECT COUNT(1) AS total 
    FROM isfor_database.dbo.letters
    WHERE status = 1; -- Status 1 berarti pending
END;
GO
/****** Object:  StoredProcedure [dbo].[GetTotalUsers]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[GetTotalUsers]
AS
BEGIN
    SELECT COUNT(1) AS Total FROM isfor_database.dbo.users;
END;
GO
/****** Object:  StoredProcedure [dbo].[GetUsersWithPagination]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[GetUsersWithPagination]
    @Limit INT,
    @Offset INT
AS
BEGIN
    SELECT user_id, name, username, email, profile_picture, role_id
    FROM isfor_database.dbo.users
    ORDER BY user_id ASC
    OFFSET @Offset ROWS FETCH NEXT @Limit ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_AddAgenda]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- Stored Procedure untuk menambahkan agenda
CREATE PROCEDURE [dbo].[sp_AddAgenda]
    @title NVARCHAR(255),
    @description NVARCHAR(MAX)
AS
BEGIN
    INSERT INTO agenda (title, description) VALUES (@title, @description);
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_AddDefaultUser]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_AddDefaultUser]
    @name NVARCHAR(255),
    @username NVARCHAR(255),
    @email NVARCHAR(255),
    @profile_picture NVARCHAR(MAX),
    @password NVARCHAR(MAX),
    @role_id INT
AS
BEGIN
    INSERT INTO users (name, username, email, profile_picture, password, role_id)
    VALUES (@name, @username, @email, @profile_picture, @password, @role_id);
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_AddLetter]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_AddLetter]
    @title NVARCHAR(255),
    @date DATE,
    @file_url NVARCHAR(MAX),
    @status INT,
    @user_id INT
AS
BEGIN
    INSERT INTO letters (title, date, file_url, status, user_id)
    VALUES (@title, @date, @file_url, @status, @user_id);
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_AddRoadmap]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_AddRoadmap]
    @year_start INT,
    @year_end INT,
    @category NVARCHAR(255),
    @topic NVARCHAR(255)
AS
BEGIN
    INSERT INTO roadmaps (year_start, year_end, category, topic)
    VALUES (@year_start, @year_end, @category, @topic);
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_CheckUserExists]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_CheckUserExists]
AS
BEGIN
    SELECT COUNT(*) AS user_count FROM users;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_countAllFiles]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_countAllFiles]
AS
BEGIN
    SELECT COUNT(*) AS total FROM research_outputs;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_countAllFilesByStatus]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_countAllFilesByStatus]
    @status INT
AS
BEGIN
    SELECT COUNT(*) AS total 
    FROM research_outputs 
    WHERE status = @status;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_countAllLetters]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_countAllLetters]
AS
BEGIN
    SELECT COUNT(*) AS total FROM letters;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_CountAllLettersByUserId]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_CountAllLettersByUserId]
    @user_id INT
AS
BEGIN
    SELECT COUNT(file_url) AS total FROM letters WHERE user_id = @user_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_CountImagesByUser]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_CountImagesByUser]
    @uploaded_by INT
AS
BEGIN
    SELECT COUNT(*) AS total FROM galleries WHERE uploaded_by = @uploaded_by;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_CountPending]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_CountPending]
AS
BEGIN
    SELECT COUNT(status) AS total FROM letters WHERE status = 1;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_countPendingFiles]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_countPendingFiles]
AS
BEGIN
    SELECT COUNT(*) AS total 
    FROM research_outputs 
    WHERE status = 1;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_CountPendingStat]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_CountPendingStat]
    @user_id INT
AS
BEGIN
    SELECT COUNT(status) AS total FROM letters WHERE status = 1 AND user_id = @user_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_countRejectedFiles]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_countRejectedFiles]
AS
BEGIN
    SELECT COUNT(*) AS total 
    FROM research_outputs 
    WHERE status = 3;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_countRejectedLetters]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_countRejectedLetters]
AS
BEGIN
    SELECT COUNT(*) AS total 
    FROM letters 
    WHERE status = 3;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_CountRejectStat]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_CountRejectStat]
    @user_id INT
AS
BEGIN
    SELECT COUNT(status) AS total FROM letters WHERE status = 3 AND user_id = @user_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_CountResearchOutputsByUser]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_CountResearchOutputsByUser]
    @uploaded_by INT
AS
BEGIN
    SELECT COUNT(*) AS total FROM research_outputs WHERE uploaded_by = @uploaded_by;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_countSearchFiles]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_countSearchFiles]
    @Keyword NVARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;

    SELECT COUNT(*) AS total
    FROM research_outputs
    WHERE title LIKE '%' + @Keyword + '%'
       OR category LIKE '%' + @Keyword + '%'
       OR description LIKE '%' + @Keyword + '%';
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_countSearchFilesUser]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_countSearchFilesUser]
    @Keyword NVARCHAR(255),
    @UserId INT
AS
BEGIN
    SET NOCOUNT ON;

    SELECT COUNT(*) AS total
    FROM research_outputs
    WHERE (uploaded_by = @UserId)
      AND (title LIKE '%' + @Keyword + '%'
           OR category LIKE '%' + @Keyword + '%'
           OR description LIKE '%' + @Keyword + '%');
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_countSearchLettersUser]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[sp_countSearchLettersUser]
    @Keyword NVARCHAR(255),
    @UserId INT
AS
BEGIN
    SET NOCOUNT ON;

    SELECT COUNT(*) AS total
    FROM letters l 
    WHERE (user_id = @UserId)
      AND (title LIKE '%' + @Keyword + '%'
           OR l.[date] LIKE '%' + @Keyword + '%'
           OR file_url LIKE '%' + @Keyword + '%');
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_CountVerify]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_CountVerify]
AS
BEGIN
    SELECT COUNT(status) AS total FROM letters WHERE status = 2;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_CountVerifyStat]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_CountVerifyStat]
    @user_id INT
AS
BEGIN
    SELECT COUNT(status) AS total FROM letters WHERE status = 2 AND user_id = @user_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_CreateGallery]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_CreateGallery]
    @image NVARCHAR(MAX),
    @category NVARCHAR(255),
    @title NVARCHAR(255),
    @uploaded_by INT,
    @description NVARCHAR(MAX)
AS
BEGIN
    INSERT INTO galleries (image, category, title, uploaded_by, description, created_at)
    VALUES (@image, @category, @title, @uploaded_by, @description, GETDATE());
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_CreateResearchOutput]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_CreateResearchOutput]
    @file_url NVARCHAR(MAX),
    @uploaded_by INT,
    @title NVARCHAR(255),
    @category NVARCHAR(100),
    @description NVARCHAR(MAX),
    @status INT = 1
AS
BEGIN
    INSERT INTO research_outputs (file_url, uploaded_by, title, category, description, status, uploaded_at)
    VALUES (@file_url, @uploaded_by, @title, @category, @description, @status, GETDATE());
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_DeleteAgenda]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_DeleteAgenda]
    @id INT
AS
BEGIN
    DELETE FROM agenda WHERE agenda_id = @id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_DeleteGallery]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_DeleteGallery]
    @id INT
AS
BEGIN
    DELETE FROM galleries WHERE gallery_id = @id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_DeleteResearchOutput]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_DeleteResearchOutput]
    @id INT
AS
BEGIN
    DELETE FROM research_outputs WHERE research_output_id = @id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_DeleteRoadmap]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_DeleteRoadmap]
    @year_start INT,
    @year_end INT
AS
BEGIN
    DELETE FROM roadmaps
    WHERE year_start = @year_start AND year_end = @year_end;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_DeleteRoadmapById]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_DeleteRoadmapById]
    @roadmap_id INT
AS
BEGIN
    SET NOCOUNT ON;

    DELETE FROM roadmaps
    WHERE roadmap_id = @roadmap_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_DeleteUser]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_DeleteUser]
    @user_id INT
AS
BEGIN
    DELETE FROM users WHERE user_id = @user_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_EditAgenda]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_EditAgenda]
    @id INT,
    @title NVARCHAR(255),
    @description NVARCHAR(MAX)
AS
BEGIN
    UPDATE agenda
    SET title = @title,
        description = @description
    WHERE agenda_id = @id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_EditUser]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_EditUser]
    @user_id INT,
    @name NVARCHAR(255),
    @username NVARCHAR(255),
    @email NVARCHAR(255),
    @profile_picture NVARCHAR(MAX),
    @password NVARCHAR(MAX),
    @role_id INT
AS
BEGIN
    UPDATE users
    SET name = ISNULL(@name, name), -- Tidak mengubah jika NULL
        username = @username,
        email = @email,
        profile_picture = @profile_picture,
        password = @password,
        role_id = ISNULL(@role_id, role_id) -- Tidak mengubah jika NULL
    WHERE user_id = @user_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetAgendaById]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetAgendaById]
    @id INT
AS
BEGIN
    SELECT * FROM agenda WHERE agenda_id = @id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetAllAgenda]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetAllAgenda]
AS
BEGIN
    SELECT *, ROW_NUMBER() OVER (ORDER BY agenda_id) AS number FROM agenda;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetAllGalleries]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetAllGalleries]
AS
BEGIN
    SELECT * FROM galleries ORDER BY created_at DESC;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetAllLetters]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetAllLetters]
AS
BEGIN
    SELECT * FROM letters;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_getAllLettersPaginate]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_getAllLettersPaginate]
    @offset INT,
    @limit INT
AS
BEGIN
    SELECT * 
    FROM letters
    ORDER BY [date] DESC
    OFFSET @offset ROWS 
    FETCH NEXT @limit ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_getAllPaginatedFiles]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_getAllPaginatedFiles]
    @itemsPerPage INT,
    @offset INT
AS
BEGIN
    SELECT * 
    FROM research_outputs
    ORDER BY uploaded_at DESC
    OFFSET @offset ROWS 
    FETCH NEXT @itemsPerPage ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_getAllPaginatedFilesByStatus]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_getAllPaginatedFilesByStatus]
    @status INT,
    @itemsPerPage INT,
    @offset INT
AS
BEGIN
    SELECT * 
    FROM research_outputs 
    WHERE status = @status
    ORDER BY uploaded_at DESC 
    OFFSET @offset ROWS 
    FETCH NEXT @itemsPerPage ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetAllPaginateGallery]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetAllPaginateGallery]
    @Page INT,
    @Limit INT
AS
BEGIN
    SET NOCOUNT ON; -- Mencegah konflik pesan "x rows affected"

    DECLARE @Offset INT;
    SET @Offset = (@Page - 1) * @Limit;

    -- Query untuk data paginasi
    SELECT * 
    FROM galleries
    ORDER BY created_at DESC
    OFFSET @Offset ROWS
    FETCH NEXT @Limit ROWS ONLY;

    -- Query untuk total record
    SELECT COUNT(*) AS Total
    FROM galleries;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetAllResearchOutputs]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetAllResearchOutputs]
AS
BEGIN
    SELECT * FROM research_outputs;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetAllVerifyResearchOutputs]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetAllVerifyResearchOutputs]
    @limit INT,
    @offset INT
AS
BEGIN
    SELECT *
    FROM research_outputs
    WHERE status = 2
    ORDER BY uploaded_at DESC -- Pastikan kolom untuk pengurutan relevan
    OFFSET @offset ROWS
    FETCH NEXT @limit ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetDistinctYears]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetDistinctYears]
AS
BEGIN
    SELECT DISTINCT year_start, year_end FROM roadmaps;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetGalleriesWithPagination]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetGalleriesWithPagination]
    @Limit INT,
    @Offset INT
AS
BEGIN
    SELECT gallery_id, [image], category, title, uploaded_by, created_at, description
    FROM isfor_database.dbo.galleries
    ORDER BY created_at DESC
    OFFSET @Offset ROWS FETCH NEXT @Limit ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetGalleryById]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetGalleryById]
    @id INT
AS
BEGIN
    SELECT * FROM galleries WHERE gallery_id = @id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetImagesByUser]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetImagesByUser]
    @uploaded_by INT
AS
BEGIN
    SELECT * FROM galleries WHERE uploaded_by = @uploaded_by ORDER BY created_at DESC;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetLetterById]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetLetterById]
    @id INT
AS
BEGIN
    SELECT file_url FROM letters WHERE letter_id = @id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetLetterByUserId]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetLetterByUserId]
    @user_id INT
AS
BEGIN
    SELECT * FROM letters WHERE user_id = @user_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetLetterByUserIdLimit]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetLetterByUserIdLimit]
    @id INT
AS
BEGIN
    SELECT TOP 5 * FROM letters WHERE user_id = @id ORDER BY date DESC;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetLetterByUserIdPaginate]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetLetterByUserIdPaginate]
    @id INT,
    @awalData INT,
    @jumlahDataPerhalaman INT
AS
BEGIN
    SELECT * 
    FROM letters 
    WHERE user_id = @id 
    ORDER BY date DESC 
    OFFSET @awalData ROWS 
    FETCH NEXT @jumlahDataPerhalaman ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetLetterByUserIdPending]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetLetterByUserIdPending]
    @user_id INT
AS
BEGIN
    SELECT * FROM letters WHERE status = 1 AND user_id = @user_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetLetterByUserIdReject]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetLetterByUserIdReject]
    @user_id INT
AS
BEGIN
    SELECT * FROM letters WHERE status = 3 AND user_id = @user_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetLetterByUserIdVerify]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetLetterByUserIdVerify]
    @user_id INT
AS
BEGIN
    SELECT * FROM letters WHERE status = 2 AND user_id = @user_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetPaginatedFilesByUser]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetPaginatedFilesByUser]
    @UserId INT,
    @Limit INT,
    @Offset INT
AS
BEGIN
    SELECT *
    FROM research_outputs
    WHERE uploaded_by = @UserId
    ORDER BY uploaded_at DESC
    OFFSET @Offset ROWS FETCH NEXT @Limit ROWS ONLY;
END;

GO
/****** Object:  StoredProcedure [dbo].[sp_GetPaginatedFilesByUserAndStatus]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetPaginatedFilesByUserAndStatus]
    @UserId INT,
    @Status INT,
    @Limit INT,
    @Offset INT
AS
BEGIN
    SELECT *
    FROM research_outputs
    WHERE uploaded_by = @UserId AND status = @Status
    ORDER BY uploaded_at DESC
    OFFSET @Offset ROWS FETCH NEXT @Limit ROWS ONLY;
END;

GO
/****** Object:  StoredProcedure [dbo].[sp_GetPendingFilesWithPagination]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetPendingFilesWithPagination]
    @Limit INT,
    @Offset INT
AS
BEGIN
    SELECT *
    FROM research_outputs
    WHERE status = 1
    ORDER BY uploaded_at DESC
    OFFSET @Offset ROWS FETCH NEXT @Limit ROWS ONLY;
END;

GO
/****** Object:  StoredProcedure [dbo].[sp_GetProfilePicture]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetProfilePicture]
    @user_id INT
AS
BEGIN
    SELECT profile_picture FROM users WHERE user_id = @user_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_getResearchDIPAPNBP]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_getResearchDIPAPNBP]
AS
BEGIN
    SELECT * FROM research_outputs WHERE category LIKE 'DIPA PNBP';
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_getResearchDIPASWA]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_getResearchDIPASWA]
AS
BEGIN
    SELECT * FROM research_outputs WHERE category LIKE 'DIPA SWADANA';
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetResearchOutputById]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetResearchOutputById]
    @id INT
AS
BEGIN
    SELECT * FROM research_outputs WHERE research_output_id = @id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetResearchOutputsByStatus]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetResearchOutputsByStatus]
    @status INT
AS
BEGIN
    SELECT * FROM research_outputs WHERE status = @status ORDER BY uploaded_at DESC;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetResearchOutputsByUser]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetResearchOutputsByUser]
    @uploaded_by INT
AS
BEGIN
    SELECT * FROM research_outputs WHERE uploaded_by = @uploaded_by ORDER BY uploaded_at DESC;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetResearchOutputsByUserAndStatus]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetResearchOutputsByUserAndStatus]
    @uploaded_by INT,
    @status INT
AS
BEGIN
    SELECT * 
    FROM research_outputs
    WHERE uploaded_by = @uploaded_by AND status = @status
    ORDER BY uploaded_at DESC;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_getResearchTesis]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_getResearchTesis]
AS
BEGIN
    SELECT * FROM research_outputs WHERE category LIKE 'Tesis Magister';
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_getRoadmapByPeriode]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_getRoadmapByPeriode]
    @year_start INT,
    @year_end INT
AS
BEGIN
    SELECT * 
    FROM roadmaps 
    WHERE year_start = @year_start 
      AND year_end = @year_end;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetRoadmapsByYears]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetRoadmapsByYears]
    @year_start INT,
    @year_end INT
AS
BEGIN
    SELECT * 
    FROM roadmaps
    WHERE year_start = @year_start AND year_end = @year_end
    ORDER BY year_start ASC;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetTotalGalleries]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetTotalGalleries]
AS
BEGIN
    SELECT COUNT(1) AS total
    FROM isfor_database.dbo.galleries;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetTotalPendingFiles]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetTotalPendingFiles]
AS
BEGIN
    SELECT COUNT(1) AS total
    FROM research_outputs
    WHERE status = 1;
END;

GO
/****** Object:  StoredProcedure [dbo].[sp_GetTotalVerifiedResearchOutputs]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetTotalVerifiedResearchOutputs]
AS
BEGIN
    SELECT COUNT(1) AS total
    FROM isfor_database.dbo.research_outputs
    WHERE status = 2;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetUserById]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetUserById]
    @user_id INT
AS
BEGIN
    SELECT * FROM users WHERE user_id = @user_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetUserByUsername]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetUserByUsername]
    @username NVARCHAR(50)
AS
BEGIN
    SELECT * FROM users WHERE username = @username;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetUsers]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetUsers]
AS
BEGIN
    SELECT * FROM users;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetUsersByRole]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetUsersByRole]
    @role_id INT
AS
BEGIN
    SELECT * FROM users WHERE role_id = @role_id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_GetVerifiedResearchOutputs]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetVerifiedResearchOutputs]
    @Limit INT,
    @Offset INT
AS
BEGIN
    SELECT research_output_id, file_url, uploaded_by, uploaded_at, title, category, status, description
    FROM isfor_database.dbo.research_outputs
    WHERE status = 2
    ORDER BY uploaded_at DESC
    OFFSET @Offset ROWS FETCH NEXT @Limit ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_getVerifyResearchDIPAPNBP]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_getVerifyResearchDIPAPNBP]
    @limit INT,
    @offset INT
AS
BEGIN
    SELECT *
    FROM research_outputs
    WHERE category LIKE 'DIPA PNBP'
      AND status = 2
    ORDER BY uploaded_at DESC -- Pastikan kolom untuk pengurutan relevan
    OFFSET @offset ROWS
    FETCH NEXT @limit ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_getVerifyResearchDIPASWA]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_getVerifyResearchDIPASWA]
    @limit INT,
    @offset INT
AS
BEGIN
    SELECT *
    FROM research_outputs
    WHERE category LIKE 'DIPA SWADANA'
      AND status = 2
    ORDER BY uploaded_at DESC -- Pastikan kolom untuk pengurutan relevan
    OFFSET @offset ROWS
    FETCH NEXT @limit ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_getVerifyResearchTesis]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_getVerifyResearchTesis]
    @limit INT,
    @offset INT
AS
BEGIN
    SELECT *
    FROM research_outputs
    WHERE category LIKE 'Tesis Magister'
      AND status = 2
    ORDER BY uploaded_at DESC -- Pastikan kolom untuk pengurutan relevan
    OFFSET @offset ROWS
    FETCH NEXT @limit ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_searchFiles]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_searchFiles]
    @Keyword NVARCHAR(255),
    @Limit INT,
    @Offset INT
AS
BEGIN
    SET NOCOUNT ON;

    SELECT research_output_id, title, category, status, file_url, uploaded_at
    FROM research_outputs
    WHERE title LIKE '%' + @Keyword + '%'
       OR category LIKE '%' + @Keyword + '%'
       OR description LIKE '%' + @Keyword + '%'
    ORDER BY uploaded_at DESC
    OFFSET @Offset ROWS FETCH NEXT @Limit ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_searchFilesUser]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_searchFilesUser]
    @Keyword NVARCHAR(255),
    @UserId INT,
    @Limit INT,
    @Offset INT
AS
BEGIN
    SET NOCOUNT ON;

    SELECT research_output_id, title, category, status, file_url, uploaded_at
    FROM research_outputs
    WHERE (uploaded_by = @UserId)
      AND (title LIKE '%' + @Keyword + '%'
           OR category LIKE '%' + @Keyword + '%'
           OR description LIKE '%' + @Keyword + '%')
    ORDER BY uploaded_at DESC
    OFFSET @Offset ROWS FETCH NEXT @Limit ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_searchLetters]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_searchLetters]
    @Keyword NVARCHAR(255),
    @Offset INT,
    @Limit INT
AS
BEGIN
    SET NOCOUNT ON;

    SELECT letter_id, title, file_url, [date], status
    FROM letters
    WHERE title LIKE '%' + @Keyword + '%'
    ORDER BY [date] DESC
    OFFSET @Offset ROWS FETCH NEXT @Limit ROWS ONLY;

    -- Optional: Count total records for pagination
    SELECT COUNT(*) AS TotalRecords
    FROM letters
    WHERE title LIKE '%' + @Keyword + '%';
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_searchLettersUser]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_searchLettersUser]
    @Keyword NVARCHAR(255),
    @UserId INT,
    @Limit INT,
    @Offset INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Query untuk mencari file berdasarkan keyword, user_id, dan paginasi
    SELECT * 
    FROM letters
    WHERE (title LIKE '%' + @Keyword + '%' 
           OR file_url LIKE '%' + @Keyword + '%' 
           OR CAST([date] AS VARCHAR) LIKE '%' + @Keyword + '%')
      AND user_id = @UserId
    ORDER BY [date] DESC
    OFFSET @Offset ROWS 
    FETCH NEXT @Limit ROWS ONLY;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_searchUsers]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_searchUsers]
    @Keyword NVARCHAR(255),
    @PageNumber INT,
    @PageSize INT
AS
BEGIN
    SET NOCOUNT ON;

    WITH PaginatedResults AS (
        SELECT *,
               ROW_NUMBER() OVER (ORDER BY user_id) AS RowNum,
               COUNT(*) OVER() AS TotalCount -- Total Count di setiap baris
        FROM users
        WHERE name LIKE '%' + @Keyword + '%'
           OR username LIKE '%' + @Keyword + '%'
           OR email LIKE '%' + @Keyword + '%'
    )
    SELECT *
    FROM PaginatedResults
    WHERE RowNum BETWEEN ((@PageNumber - 1) * @PageSize + 1) AND (@PageNumber * @PageSize);
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_UpdateGallery]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_UpdateGallery]
    @id INT,
    @image NVARCHAR(MAX),
    @category NVARCHAR(255),
    @title NVARCHAR(255)
AS
BEGIN
    UPDATE galleries
    SET image = @image, category = @category, title = @title
    WHERE gallery_id = @id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_UpdateResearchOutput]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_UpdateResearchOutput]
    @id INT,
    @file_url NVARCHAR(MAX),
    @title NVARCHAR(255),
    @category NVARCHAR(100),
    @status INT
AS
BEGIN
    UPDATE research_outputs
    SET file_url = @file_url, title = @title, category = @category, status = @status
    WHERE research_output_id = @id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_UpdateResearchOutputStatus]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_UpdateResearchOutputStatus]
    @id INT,
    @status INT
AS
BEGIN
    UPDATE research_outputs
    SET status = @status
    WHERE research_output_id = @id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_updateStatus]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_updateStatus]
    @id INT,
    @status INT
AS
BEGIN
    UPDATE research_outputs
    SET status = @status
    WHERE research_output_id = @id;
END;
GO
/****** Object:  StoredProcedure [dbo].[sp_UpdateStatusLetter]    Script Date: 30/01/2025 14:27:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_UpdateStatusLetter]
    @id INT,
    @status INT
AS
BEGIN
    UPDATE letters 
    SET status = @status 
    WHERE letter_id = @id;
END;
GO
USE [master]
GO
ALTER DATABASE [isfor_database] SET  READ_WRITE 
GO
