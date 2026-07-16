CREATE DATABASE IF NOT EXISTS library_db;
USE library_db;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','user') NOT NULL DEFAULT 'user'
);

CREATE TABLE IF NOT EXISTS books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(255) NOT NULL,
  category VARCHAR(100) NOT NULL,
  quantity INT NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS borrowed_books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  book_id INT NOT NULL,
  borrow_date DATE NOT NULL,
  return_date DATE NULL,
  status ENUM('Borrowed','Returned') NOT NULL DEFAULT 'Borrowed'
);

INSERT INTO users (name, email, password, role) VALUES
('Admin', 'enasatham579@gmail.com', '$2y$10$6k9S5oS2VnTtppqg1S3D0u8U4lQ0N0R4A4kQz8vH8xP2hO7XBQ5K2', 'admin'),
('Sara', 'saraabdi@gmail.com', '$2y$10$A0c1F2wR3Qe4T5y6U7i8O9p0Q1r2S3t4U5v6W7x8Y9z0A1b2C3d4', 'user');
