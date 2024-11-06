-- Membuat database
CREATE
DATABASE isfor;

-- Menggunakan database
USE
isfor;

-- Membuat tabel role
CREATE TABLE role
(
    role_id   INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50)
);

INSERT INTO role (role_name) VALUES ('admin');
INSERT INTO role (role_name) VALUES ('user');

-- Membuat tabel users
CREATE TABLE users
(
    user_id  INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255),
    email    VARCHAR(100),
    role_id  INT DEFAULT 2,
    FOREIGN KEY (role_id) REFERENCES role (role_id)
);

-- Membuat tabel researchers
CREATE TABLE researchers
(
    researcher_id   INT AUTO_INCREMENT PRIMARY KEY,
    user_id         INT,
    bio             TEXT,
    profile_picture VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users (user_id)
);

-- Membuat tabel interests
CREATE TABLE interests
(
    interest_id   INT AUTO_INCREMENT PRIMARY KEY,
    interest_name VARCHAR(100)
);

-- Membuat tabel untuk menghubungkan researchers dengan interests
CREATE TABLE researcher_interests
(
    researcher_id INT,
    interest_id   INT,
    PRIMARY KEY (researcher_id, interest_id),
    FOREIGN KEY (researcher_id) REFERENCES researchers (researcher_id),
    FOREIGN KEY (interest_id) REFERENCES interests (interest_id)
);

-- Membuat tabel education
CREATE TABLE education
(
    education_id   INT AUTO_INCREMENT PRIMARY KEY,
    education_name VARCHAR(100)
);

-- Membuat tabel untuk menghubungkan researchers dengan education
CREATE TABLE researcher_education
(
    researcher_id INT,
    education_id  INT,
    PRIMARY KEY (researcher_id, education_id),
    FOREIGN KEY (researcher_id) REFERENCES researchers (researcher_id),
    FOREIGN KEY (education_id) REFERENCES education (education_id)
);

-- Membuat tabel archives
CREATE TABLE archives
(
    archive_id  INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT,
    title       VARCHAR(100),
    description TEXT,
    location    VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users (user_id)
);

-- Membuat tabel papers
CREATE TABLE papers
(
    paper_id      INT AUTO_INCREMENT PRIMARY KEY,
    researcher_id INT,
    archive_id    INT,
    title         VARCHAR(100),
    file_url      VARCHAR(255),
    comment       TEXT,
    FOREIGN KEY (researcher_id) REFERENCES researchers (researcher_id),
    FOREIGN KEY (archive_id) REFERENCES archives (archive_id)
);

-- Membuat tabel galleries
CREATE TABLE galleries
(
    image_id      INT AUTO_INCREMENT PRIMARY KEY,
    researcher_id INT,
    image_url     VARCHAR(255),
    caption       TEXT,
    uploaded_at   DATETIME,
    paper_id      INT,
    FOREIGN KEY (researcher_id) REFERENCES researchers (researcher_id),
    FOREIGN KEY (paper_id) REFERENCES papers (paper_id)
);

-- Membuat tabel agenda_status
CREATE TABLE agenda_status
(
    agenda_status_id   INT AUTO_INCREMENT PRIMARY KEY,
    agenda_status_name VARCHAR(50)
);

-- Membuat tabel agenda
CREATE TABLE agenda
(
    agenda_id        INT AUTO_INCREMENT PRIMARY KEY,
    title            VARCHAR(100),
    description      TEXT,
    location         VARCHAR(255),
    date             DATE,
    agenda_status_id INT,
    researcher_id    INT,
    FOREIGN KEY (agenda_status_id) REFERENCES agenda_status (agenda_status_id),
    FOREIGN KEY (researcher_id) REFERENCES researchers (researcher_id)
);
