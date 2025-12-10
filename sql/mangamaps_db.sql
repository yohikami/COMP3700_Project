-- DATABASE CREATION
CREATE DATABASE IF NOT EXISTS mangamaps_db;
USE mangamaps_db;

-- TABLE: TOURS
CREATE TABLE tours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    duration VARCHAR(50) NOT NULL,
    image_url VARCHAR(255) DEFAULT 'assets/images/default.jpg'
);

-- Inserting 5 records into TOURS
INSERT INTO tours (name, price, duration, image_url) VALUES 
('Tokyo City Lights', 99.00, '3 days', 'assets/images/Tokyo (2).jpg'),
('Osaka Food Adventure', 50.00, '3 days', 'assets/images/osaka (1).jpg'),
('Kyoto Heritage Escape', 89.00, '3 days', 'assets/images/kyoto.jpg'),
-- ('Hokkaido Snow Tour', 150.00, '4 days', 'assets/images/Fuji.jpg'),
-- ('Okinawa Beach Relax', 120.00, '5 days', 'assets/images/fish.jpg'); # Removed because only 3 images provided for the first 3 tours




-- TABLE: BOOKINGS
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    destination VARCHAR(50) NOT NULL,
    travelers INT NOT NULL,
    travel_date DATE NOT NULL,
    special_requests TEXT,
    submission_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Inserting 5 records into BOOKINGS
INSERT INTO bookings (full_name, email, destination, travelers, travel_date, special_requests) VALUES 
('Alice Smith', 'alice@test.com', 'Tokyo', 2, '2025-05-01', 'Vegetarian meals'),
('Bob Jones', 'bob@test.com', 'Osaka', 4, '2025-06-15', 'None'),
('Charlie Day', 'charlie@test.com', 'Kyoto', 1, '2025-07-20', 'Wheelchair access'),
('Diana Prince', 'diana@test.com', 'Tokyo', 2, '2025-08-10', 'Honeymoon trip'),
('Evan Wright', 'evan@test.com', 'Hokkaido', 3, '2025-12-01', 'Ski gear needed');


-- TABLE: REVIEWS
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reviewer_name VARCHAR(100) NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    comment TEXT NOT NULL,
    submission_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Inserting 5 records into REVIEWS
INSERT INTO reviews (reviewer_name, rating, comment) VALUES 
('Sarah Johnson', 5, 'An absolutely amazing experience!'),
('Michael Chen', 5, 'The Osaka Food Adventure was a culinary delight!'),
('Emma Williams', 4, 'Kyoto Heritage Escape was peaceful and beautiful.'),
('David Brown', 5, 'MangaMaps made our first trip to Japan very easy.'),
('James Wilson', 3, 'Good tour, but the weather was bad.');