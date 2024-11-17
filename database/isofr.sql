-- Create the database
CREATE DATABASE IF NOT EXISTS isfordb;

-- Use the database
USE isfordb;

-- Create the roles table
CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL
);

-- Insert initial roles
INSERT INTO roles (role_name) VALUES ('admin'), ('user');

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role_id INT,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Insert a test user
INSERT INTO users (username, password, email, role_id) 
VALUES ('admin', '123', 'admin@example.com', 1), ('user', '123', 'user@example.com', 2);