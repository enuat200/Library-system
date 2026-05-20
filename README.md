  Group members 
1.	Dessie Mengahun	 ETS0413/16
2.	Enas Atham          ETS0473/16
3.	Ephratah Girma    ETS0480/16
4.	Estifanos Alemu   ETS0496/16
5.	Kalkidan Fikadu   ETS0777/16


  	 Library Management System
  	
This is a simple web-based Library Management System built using PHP, MySQL, HTML, CSS, and JavaScript. It allows administrators and users to efficiently manage books, borrowing activities, and return processes within a library environment
 
 Features
 
User Authentication: Secure login and registration system for users and administrators.

Add Books: Allows administrators to add new books with details such as:

•	Book Title
•	Author Name
•	Category
•	ISBN Number
•	Quantity Available

View Available Books: Displays all books currently available in the library with their details.

Borrow Books: Enables users to borrow books from the library. Borrowed books are automatically tracked in the system.

Return Books: Allows users to return borrowed books and updates the available quantity automatically.

My Borrowed Books: Users can view all books they have currently borrowed.

Edit and Delete Books: Administrators can update book information or remove books from the system.

Modern User Interface: The system includes:

•	Responsive pages
•	Dashboard layout
•	Styled tables
•	Background images
•	Navigation bar

 Prerequisites: Before running the project, make sure you have:
 
•	XAMPP / WAMP / Laragon
•	PHP 7+
•	MySQL Server
•	Modern web browser

 Setup and Installation
 
1️ Install XAMPP

Download and install XAMPP: https://www.apachefriends.org/

2️ Clone the Repository

git clone https://github.com/your-username/library-management-system.git

Or download the ZIP file and extract it.

3️ Move Project Folder

Move the project folder into:

C:/xampp/htdocs/

4️ Start Apache and MySQL

Open the XAMPP Control Panel and start:

•	Apache
•	MySQL

5️ Create Database

Open phpMyAdmin:

http://localhost:8080/phpmyadmin

Create a database named:

library_db

6️ Import SQL File

Import the provided SQL file located in:

/database/library_db.sql

7️ Configure Database Connection

Open:
config/db.php

Update the database credentials:

$host = "localhost:8080";
$user = "root";
$password = "";
$database = "library_db";

 Running the Application
 
After setup, open your browser and run:
http://localhost/library-system/

 
 Default User Accounts
 
Admin Account
Email:enasatham579@gmail.com

Password: @9Alhamdulillah9

User Account
Email: saraabdi@gmail.com

Password: 123456789

 Database Structure
 
The system uses the following main tables in the library_db database:

users
Stores user authentication information.
Column	Type
id	INT AUTO_INCREMENT PRIMARY KEY
name	VARCHAR(100)
email	VARCHAR(100)
password	VARCHAR(255)
role	ENUM('admin','user')

books
Stores all library books.
Column	Type
id	INT AUTO_INCREMENT PRIMARY KEY
title	VARCHAR(255)
author	VARCHAR(255)
category	VARCHAR(100)
quantity	INT

borrowed_books
Tracks borrowed books.
Column	Type
id	INT AUTO_INCREMENT PRIMARY KEY
user_id	INT
book_id	INT
borrow_date	DATE
return_date	DATE
status	ENUM('Borrowed','Returned')

Access Control

Role-based access control is implemented for:
•	Admins
•	Users

 Future Enhancements
 
•	Book Search and Filtering
•	Email Notifications
•	Fully Responsive Mobile Design
•	Reports and Analytics
•	Fine Calculation for Late Returns
•	Dark Mode
•	Book Cover Uploads
•	Borrowing Notifications


