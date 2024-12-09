USE [master]
GO
/****** Object:  Database [isfor_database]    Script Date: 03/12/2024 16:52:35 ******/
CREATE DATABASE [isfor_database]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'isfor_database', FILENAME = N'C:\Valid\Path\isfor_database.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'isfor_database_log', FILENAME = N'C:\Valid\Path\isfor_database_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
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
/****** Object:  Table [dbo].[agenda]    Script Date: 03/12/2024 16:52:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[agenda](
	[agenda_id] [int] IDENTITY(1,1) NOT NULL,
	[title] [nvarchar](255) NOT NULL,
	[roadmap_id] [int] NOT NULL,
	[created_by] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[agenda_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[archives]    Script Date: 03/12/2024 16:52:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[archives](
	[archive_id] [int] IDENTITY(1,1) NOT NULL,
	[title] [nvarchar](255) NOT NULL,
	[description] [nvarchar](max) NOT NULL,
	[file_url] [nvarchar](255) NOT NULL,
	[roadmap_id] [int] NULL,
	[uploaded_by] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[archive_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[galleries]    Script Date: 03/12/2024 16:52:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[galleries](
	[gallery_id] [int] IDENTITY(1,1) NOT NULL,
	[image] [nvarchar](255) NULL,
	[category] [nvarchar](100) NOT NULL,
	[title] [nvarchar](255) NOT NULL,
	[status] [int] NOT NULL,
	[uploaded_by] [int] NOT NULL,
	[created_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[gallery_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[letters]    Script Date: 03/12/2024 16:52:36 ******/
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
PRIMARY KEY CLUSTERED 
(
	[letter_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[research_outputs]    Script Date: 03/12/2024 16:52:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[research_outputs](
	[research_output_id] [int] IDENTITY(1,1) NOT NULL,
	[file_url] [nvarchar](255) NOT NULL,
	[uploaded_by] [int] NOT NULL,
	[uploaded_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[research_output_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[roadmaps]    Script Date: 03/12/2024 16:52:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[roadmaps](
	[roadmap_id] [int] IDENTITY(1,1) NOT NULL,
	[year_start] [int] NOT NULL,
	[year_end] [int] NOT NULL,
	[category] [nvarchar](100) NOT NULL,
	[agenda] [nvarchar](255) NOT NULL,
	[created_by] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[roadmap_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[role]    Script Date: 03/12/2024 16:52:36 ******/
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
/****** Object:  Table [dbo].[status]    Script Date: 03/12/2024 16:52:36 ******/
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
/****** Object:  Table [dbo].[users]    Script Date: 03/12/2024 16:52:36 ******/
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
ALTER TABLE [dbo].[agenda]  WITH CHECK ADD  CONSTRAINT [FK_agenda_roadmaps] FOREIGN KEY([roadmap_id])
REFERENCES [dbo].[roadmaps] ([roadmap_id])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[agenda] CHECK CONSTRAINT [FK_agenda_roadmaps]
GO
ALTER TABLE [dbo].[agenda]  WITH CHECK ADD  CONSTRAINT [FK_agenda_users] FOREIGN KEY([created_by])
REFERENCES [dbo].[users] ([user_id])
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[agenda] CHECK CONSTRAINT [FK_agenda_users]
GO
ALTER TABLE [dbo].[archives]  WITH CHECK ADD  CONSTRAINT [FK_archives_roadmaps] FOREIGN KEY([roadmap_id])
REFERENCES [dbo].[roadmaps] ([roadmap_id])
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[archives] CHECK CONSTRAINT [FK_archives_roadmaps]
GO
ALTER TABLE [dbo].[archives]  WITH CHECK ADD  CONSTRAINT [FK_archives_users] FOREIGN KEY([uploaded_by])
REFERENCES [dbo].[users] ([user_id])
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[archives] CHECK CONSTRAINT [FK_archives_users]
GO
ALTER TABLE [dbo].[galleries]  WITH CHECK ADD  CONSTRAINT [FK_galleries_status] FOREIGN KEY([status])
REFERENCES [dbo].[status] ([id])
GO
ALTER TABLE [dbo].[galleries] CHECK CONSTRAINT [FK_galleries_status]
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
ALTER TABLE [dbo].[research_outputs]  WITH CHECK ADD  CONSTRAINT [FK_research_outputs_users] FOREIGN KEY([uploaded_by])
REFERENCES [dbo].[users] ([user_id])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[research_outputs] CHECK CONSTRAINT [FK_research_outputs_users]
GO
ALTER TABLE [dbo].[roadmaps]  WITH CHECK ADD  CONSTRAINT [FK_roadmaps_users] FOREIGN KEY([created_by])
REFERENCES [dbo].[users] ([user_id])
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[roadmaps] CHECK CONSTRAINT [FK_roadmaps_users]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD  CONSTRAINT [FK_users_role] FOREIGN KEY([role_id])
REFERENCES [dbo].[role] ([role_id])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[users] CHECK CONSTRAINT [FK_users_role]
GO
USE [master]
GO
ALTER DATABASE [isfor_database] SET  READ_WRITE 
GO
