# Simple PHP CRUD Application

Hey there! 👋 Welcome to my PHP CRUD application. I built this project to practice and showcase full-stack development using raw PHP and MySQL. 

It's essentially a management system split into two main parts: a public-facing website where visitors can read news articles that have been marked as "Active" by an administrator, and a secure admin dashboard where an administrator can log in to manage students, news articles, and their own profile.

## Features at a Glance

### 1. The Admin Dashboard (Secure Area)
* **Authentication**: A custom login and registration system. Passwords are encrypted before hitting the database, and you can only access the dashboard if you have an active session.
* **Dashboard Overview**: A quick look at the stats - total students, total news items, and how many news items are currently marked as active/inactive.
* **Student Management (CRUD)**:
  * Add new students (Name, Email, Phone, Course, Image, Date of Birth).
  * Upload profile pictures for each student (handles file validation and saving to the `img/` folder).
  * Edit and update student information.
  * Delete students.
* **News Management (CRUD)**:
  * Create news articles with titles, descriptions, and cover images.
  * Toggle news visibility (Active/Inactive). Only "Active" news shows up on the public homepage.
  * Edit and delete news articles.
* **Profile Management**: Admins can update their username, email, and password directly from the dashboard.
* **Universities API Integration**: A dedicated API page featuring a dynamic data table (built using jQuery DataTables). It uses PHP cURL to fetch data from a public API (`http://universities.hipolabs.com/`) to display a list of global universities.

### 2. The Public Homepage
* **News Feed**: Dynamically pulls all "Active" news items from the database and displays them in modern Bootstrap cards.

## Tech Stack Used

* **Backend**: PHP 8+ (raw PHP, no frameworks)
* **Database**: MySQL (using the `mysqli` extension)
* **Frontend**: HTML5, CSS3, JavaScript
* **UI Framework**: Bootstrap 5.3 + Bootstrap Icons
* **Libraries**: jQuery & DataTables (for the university table)

## Built With XAMPP & How to Run It

I specifically developed this project using **XAMPP** on Windows, so that's the easiest way to get it running locally on your end too. Here is exactly how to do it:

1. **Install XAMPP**: If you don't have it, download and install XAMPP.
2. **Start the Servers**: Open the XAMPP Control Panel and start both **Apache** and **MySQL**.
3. **Get the Code**: 
   * Clone or download this repository as a ZIP.
   * Place the entire `PHP-Crud` folder inside your XAMPP's `htdocs` directory (usually located at `C:\xampp\htdocs\`).
4. **Set up the Database**:
   * Open your browser and go to `http://localhost/phpmyadmin`.
   * Click "New" on the left sidebar and create a database named `crud1`.
   * Click on your newly created `crud1` database, then go to the "Import" tab at the top.
   * Upload the `crud1.sql` file (found in this project's root folder) to automatically create all the necessary tables (`users`, `students`, `news`) and sample data.
5. **Run the App**:
   * Open your browser and navigate to `http://localhost/PHP-Crud/` to see the public homepage.
   * To access the admin area, go to `http://localhost/PHP-Crud/admin/login.php`.
   * **Default Admin Login**: Since you imported `crud1.sql`, an admin user is already created for you:
     * **Username**: `admin`
     * **Password**: `password123`

*(Note: If you need to change database credentials later on, you can find them in `admin/dbcon.php` - by default XAMPP uses user `root` with no password.)*

## What I Learned From Building This

This project was a great hands-on experience in building a full-stack web app from scratch. I learned to manage image uploads, write clean SQL queries, sanitize inputs against SQL injection (`mysqli_real_escape_string`), and handle user sessions in PHP.

