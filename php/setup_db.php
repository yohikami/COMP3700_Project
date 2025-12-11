<?php
$servername = "localhost";
$username = "root";
$password = "";

// Connect to MySQL Server 
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create Database
$sql = "CREATE DATABASE IF NOT EXISTS mangamaps_db";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the Database
$conn->select_db("mangamaps_db");

// Create Tables
$tables = [
    "tours" => "CREATE TABLE IF NOT EXISTS tours (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        duration VARCHAR(50) NOT NULL,
        image_url VARCHAR(255) DEFAULT 'assets/images/default.jpg'
    )",
    "bookings" => "CREATE TABLE IF NOT EXISTS bookings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        destination VARCHAR(50) NOT NULL,
        travelers INT NOT NULL,
        travel_date DATE NOT NULL,
        special_requests TEXT,
        submission_date DATETIME DEFAULT CURRENT_TIMESTAMP
    )",
    "reviews" => "CREATE TABLE IF NOT EXISTS reviews (
        id INT AUTO_INCREMENT PRIMARY KEY,
        reviewer_name VARCHAR(100) NOT NULL,
        rating INT CHECK (rating >= 1 AND rating <= 5),
        comment TEXT NOT NULL,
        submission_date DATETIME DEFAULT CURRENT_TIMESTAMP
    )"
];

foreach ($tables as $name => $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Table '$name' created successfully<br>";
    } else {
        echo "Error creating table '$name': " . $conn->error . "<br>";
    }
}

// Populate Tables
// We use INSERT IGNORE to prevent errors if the data already exists
$inserts = [
    "INSERT IGNORE INTO tours (id, name, price, duration, image_url) VALUES 
    (1, 'Tokyo City Lights', 99.00, '3 days', 'assets/images/Tokyo (2).jpg'),
    (2, 'Osaka Food Adventure', 50.00, '3 days', 'assets/images/osaka (1).jpg'),
    (3, 'Kyoto Heritage Escape', 89.00, '3 days', 'assets/images/kyoto.jpg')",

    "INSERT IGNORE INTO bookings (id, full_name, email, destination, travelers, travel_date, special_requests) VALUES 
    (1, 'Alice Smith', 'alice@test.com', 'Tokyo', 2, '2025-05-01', 'Vegetarian meals'),
    (2, 'Bob Jones', 'bob@test.com', 'Osaka', 4, '2025-06-15', 'None')",

    "INSERT IGNORE INTO reviews (id, reviewer_name, rating, comment) VALUES 
    (1, 'Sarah Johnson', 5, 'An absolutely amazing experience!'),
    (2, 'Michael Chen', 5, 'The Osaka Food Adventure was a culinary delight!')"
];

foreach ($inserts as $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully<br>";
    } else {
        echo "Error inserting data: " . $conn->error . "<br>";
    }
}

$conn->close();
