-- Active: 1733144391775@@localhost@1433@master
-- Script untuk SQL Server
CREATE
DATABASE master;
GO

USE master;
GO

-- Table: agenda
CREATE TABLE agenda
(
    agenda_id INT PRIMARY KEY IDENTITY(1,1),
    title NVARCHAR(255) NOT NULL,
    roadmap_id INT NOT NULL,
    created_by INT NULL
);
GO

-- Table: archives
CREATE TABLE archives
(
    archive_id INT PRIMARY KEY IDENTITY(1,1),
    title NVARCHAR(255) NOT NULL,
    description NVARCHAR(MAX) NOT NULL,
    file_url NVARCHAR(255) NOT NULL,
    roadmap_id INT NULL,
    uploaded_by INT NULL
);
GO

-- Table: galleries
CREATE TABLE galleries
(
    gallery_id INT PRIMARY KEY IDENTITY(1,1),
    image NVARCHAR(255) NULL,
    category NVARCHAR(100) NOT NULL,
    title NVARCHAR(255) NOT NULL,
    status INT NOT NULL,
    uploaded_by INT NOT NULL
);
GO

-- Table: letters
CREATE TABLE letters
(
    letter_id INT PRIMARY KEY IDENTITY(1,1),
    title NVARCHAR(50) NULL,
    file_url NVARCHAR(255) NOT NULL,
    status INT NOT NULL,
    user_id INT NOT NULL
);
GO

-- Table: research_outputs
CREATE TABLE research_outputs
(
    research_output_id INT PRIMARY KEY IDENTITY(1,1),
    file_url NVARCHAR(255) NOT NULL,
    uploaded_by INT NOT NULL,
    uploaded_at DATETIME DEFAULT GETDATE()
);
GO

-- Table: roadmaps
CREATE TABLE roadmaps
(
    roadmap_id INT PRIMARY KEY IDENTITY(1,1),
    year_start INT NOT NULL,
    year_end INT NOT NULL,
    category NVARCHAR(100) NOT NULL,
    agenda NVARCHAR(255) NOT NULL,
    created_by INT NULL
);
GO

-- Table: role
CREATE TABLE role
(
    role_id INT PRIMARY KEY IDENTITY(1,1),
    role_name NVARCHAR(50) NOT NULL
);
GO

-- Insert data into role
INSERT INTO role
    (role_name)
VALUES
    ('admin'),
    ('user');
GO

-- Table: status
CREATE TABLE status
(
    id INT PRIMARY KEY IDENTITY(1,1),
    status NVARCHAR(50) NOT NULL
);
GO

-- Insert data into status
INSERT INTO status
    (status)
VALUES
    ('pending'),
    ('veriffied'),
    ('rejected');
GO

-- Table: users
CREATE TABLE users
(
    user_id INT PRIMARY KEY IDENTITY(1,1),
    name NVARCHAR(100) NOT NULL,
    username NVARCHAR(50) UNIQUE NOT NULL,
    email NVARCHAR(100) UNIQUE NOT NULL,
    profile_picture NVARCHAR(255) NULL,
    password NVARCHAR(255) NOT NULL,
    role_id INT NOT NULL
);
GO

-- Add foreign key constraints
ALTER TABLE agenda
    ADD CONSTRAINT FK_agenda_roadmaps FOREIGN KEY (roadmap_id) REFERENCES roadmaps (roadmap_id) ON DELETE CASCADE,
    CONSTRAINT FK_agenda_users FOREIGN KEY (created_by) REFERENCES users (user_id) ON
DELETE
SET NULL;
GO

ALTER TABLE archives
    ADD CONSTRAINT FK_archives_roadmaps FOREIGN KEY (roadmap_id) REFERENCES roadmaps (roadmap_id) ON DELETE SET NULL,
    CONSTRAINT FK_archives_users FOREIGN KEY (uploaded_by) REFERENCES users (user_id) ON
DELETE
SET NULL;
GO

ALTER TABLE galleries
    ADD CONSTRAINT FK_galleries_users FOREIGN KEY (uploaded_by) REFERENCES users (user_id) ON DELETE CASCADE,
    CONSTRAINT FK_galleries_status FOREIGN KEY (status) REFERENCES status (id);
GO

ALTER TABLE letters
    ADD CONSTRAINT FK_letters_users FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE,
    CONSTRAINT FK_letters_status FOREIGN KEY (status) REFERENCES status (id);
GO

ALTER TABLE research_outputs
    ADD CONSTRAINT FK_research_outputs_users FOREIGN KEY (uploaded_by) REFERENCES users (user_id) ON DELETE CASCADE;
GO

ALTER TABLE roadmaps
    ADD CONSTRAINT FK_roadmaps_users FOREIGN KEY (created_by) REFERENCES users (user_id) ON DELETE SET NULL;
GO

ALTER TABLE users
    ADD CONSTRAINT FK_users_role FOREIGN KEY (role_id) REFERENCES role (role_id) ON DELETE CASCADE;
GO

INSERT INTO users (user_id, username, password, email, profile_picture, role_id) VALUES
(19, 'admin', '$2y$10$Mrb1qdEaOsSaoTqDcWZn.OdT/ktjUpYG8acsflhE4bevNw18CeE8y', 'admin@example.com', '6739fbe52d88e.jpg', 1),
(20, 'admin2', '$2y$10$BikPz8zcrW5G9MZPTcFgz.o08FVT/gEa/9hK9MGYqxMKhwg4wocGq', 'ayam@gmail.com', '673c159204ac3.jpg', 1);