-- Smart City Portal - InfinityFree Database Setup
-- Run this FIRST in phpMyAdmin

-- Create tables
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reports (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  category VARCHAR(100),
  description TEXT,
  image VARCHAR(200),
  status VARCHAR(50) DEFAULT 'Pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE feedback (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  name VARCHAR(100),
  email VARCHAR(100),
  message TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample Users (password is 'password' for all)
INSERT INTO users (name, email, password) VALUES 
('Rahul Sharma', 'rahul@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Priya Patel', 'priya@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Amit Kumar', 'amit@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Sneha Desai', 'sneha@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Vikram Singh', 'vikram@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Sample Reports
INSERT INTO reports (user_id, category, description, image, status, created_at) VALUES 
(1, 'Pothole', 'Large pothole on MG Road near bus stop.', '', 'Pending', DATE_SUB(NOW(), INTERVAL 1 DAY)),
(1, 'Streetlight', 'Streetlight not working on 5th Cross Road.', '', 'In Progress', DATE_SUB(NOW(), INTERVAL 2 DAY)),
(2, 'Garbage', 'Garbage pile near Shivaji Park entrance.', '', 'Resolved', DATE_SUB(NOW(), INTERVAL 3 DAY)),
(2, 'Pothole', 'Multiple potholes on Station Road.', '', 'Pending', DATE_SUB(NOW(), INTERVAL 1 DAY)),
(3, 'Water Leak', 'Water pipeline leak on Gandhi Nagar.', '', 'In Progress', DATE_SUB(NOW(), INTERVAL 4 DAY)),
(3, 'Garbage', 'Overflowing dustbin near market area.', '', 'Pending', DATE_SUB(NOW(), INTERVAL 2 DAY)),
(4, 'Streetlight', 'Three streetlights not working on Ring Road.', '', 'Resolved', DATE_SUB(NOW(), INTERVAL 5 DAY)),
(4, 'Pothole', 'Deep pothole near City Hospital.', '', 'In Progress', DATE_SUB(NOW(), INTERVAL 3 DAY)),
(5, 'Other', 'Broken bench at Central Park.', '', 'Pending', DATE_SUB(NOW(), INTERVAL 1 DAY)),
(5, 'Garbage', 'Illegal dumping on vacant plot.', '', 'Pending', NOW());

-- Sample Feedback
INSERT INTO feedback (name, email, message, created_at) VALUES 
('Rahul Sharma', 'rahul@example.com', 'Great platform! My complaint was resolved quickly.', DATE_SUB(NOW(), INTERVAL 2 DAY)),
('Priya Patel', 'priya@example.com', 'Very useful app. Would love a mobile version.', DATE_SUB(NOW(), INTERVAL 3 DAY)),
('Amit Kumar', 'amit@example.com', 'Response time has improved. Keep it up!', DATE_SUB(NOW(), INTERVAL 1 DAY));
