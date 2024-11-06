-- Membuat database
CREATE
DATABASE isfor;
GO

-- Menggunakan database
USE isfor;
GO

-- Membuat tabel role
CREATE TABLE role
(
    role_id   INT PRIMARY KEY IDENTITY(1,1),
    role_name VARCHAR(50)
);


-- Menambahkan role 'admin' dan 'user' ke tabel role
INSERT INTO role (role_name)
VALUES ('admin');
INSERT INTO role (role_name)
VALUES ('user');

-- Membuat tabel users
CREATE TABLE users
(
    user_id  INT PRIMARY KEY IDENTITY(1,1),
    username VARCHAR(50),
    password VARCHAR(255),
    email    VARCHAR(100),
    role_id  INT DEFAULT 2,
    CONSTRAINT fk_role FOREIGN KEY (role_id) REFERENCES role (role_id)
);

-- Membuat tabel researchers
CREATE TABLE researchers
(
    researcher_id   INT PRIMARY KEY IDENTITY(1,1),
    user_id         INT,
    bio             TEXT,
    profile_picture VARCHAR(255),
    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users (user_id)
);

-- Membuat tabel interests
CREATE TABLE interests
(
    interest_id   INT PRIMARY KEY IDENTITY(1,1),
    interest_name VARCHAR(100)
);

-- Membuat tabel untuk menghubungkan researchers dengan interests
CREATE TABLE researcher_interests
(
    researcher_id INT,
    interest_id   INT,
    PRIMARY KEY (researcher_id, interest_id),
    CONSTRAINT fk_researcher_interest FOREIGN KEY (researcher_id) REFERENCES researchers (researcher_id),
    CONSTRAINT fk_interest FOREIGN KEY (interest_id) REFERENCES interests (interest_id)
);

-- Membuat tabel education
CREATE TABLE education
(
    education_id   INT PRIMARY KEY IDENTITY(1,1),
    education_name VARCHAR(100)
);

-- Membuat tabel untuk menghubungkan researchers dengan education
CREATE TABLE researcher_education
(
    researcher_id INT,
    education_id  INT,
    PRIMARY KEY (researcher_id, education_id),
    CONSTRAINT fk_researcher_education FOREIGN KEY (researcher_id) REFERENCES researchers (researcher_id),
    CONSTRAINT fk_education FOREIGN KEY (education_id) REFERENCES education (education_id)
);

-- Membuat tabel archives
CREATE TABLE archives
(
    archive_id  INT PRIMARY KEY IDENTITY(1,1),
    user_id     INT,
    title       VARCHAR(100),
    description TEXT,
    location    VARCHAR(255),
    CONSTRAINT fk_user_archive FOREIGN KEY (user_id) REFERENCES users (user_id)
);

-- Membuat tabel papers
CREATE TABLE papers
(
    paper_id      INT PRIMARY KEY IDENTITY(1,1),
    researcher_id INT,
    archive_id    INT,
    title         VARCHAR(100),
    file_url      VARCHAR(255),
    comment       TEXT,
    CONSTRAINT fk_researcher_paper FOREIGN KEY (researcher_id) REFERENCES researchers (researcher_id),
    CONSTRAINT fk_archive_paper FOREIGN KEY (archive_id) REFERENCES archives (archive_id)
);

-- Membuat tabel galleries
CREATE TABLE galleries
(
    image_id      INT PRIMARY KEY IDENTITY(1,1),
    researcher_id INT,
    image_url     VARCHAR(255),
    caption       TEXT,
    uploaded_at   DATETIME,
    paper_id      INT,                                                              -- Kolom baru untuk menghubungkan galleries ke papers
    CONSTRAINT fk_researcher_gallery FOREIGN KEY (researcher_id) REFERENCES researchers (researcher_id),
    CONSTRAINT fk_paper_gallery FOREIGN KEY (paper_id) REFERENCES papers (paper_id) -- Foreign key ke tabel papers
);

-- Membuat tabel agenda_status
CREATE TABLE agenda_status
(
    agenda_status_id   INT PRIMARY KEY IDENTITY(1,1),
    agenda_status_name VARCHAR(50)
);

-- Membuat tabel agenda
CREATE TABLE agenda
(
    agenda_id        INT PRIMARY KEY IDENTITY(1,1),
    title            VARCHAR(100),
    description      TEXT,
    location         VARCHAR(255),
    date             DATE,
    agenda_status_id INT,
    researcher_id    INT, -- Menghubungkan agenda dengan researcher
    CONSTRAINT fk_agenda_status FOREIGN KEY (agenda_status_id) REFERENCES agenda_status (agenda_status_id),
    CONSTRAINT fk_researcher_agenda FOREIGN KEY (researcher_id) REFERENCES researchers (researcher_id)
);
