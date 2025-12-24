-- Smart City Database for InfinityFree
-- Import this file into phpMyAdmin

-- Users Table
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Reports Table
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('pending','in_progress','resolved') DEFAULT 'pending',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Feedback Table
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample Users (password is 'password' hashed)
INSERT INTO `users` (`name`, `email`, `password`) VALUES
('Rahul Sharma', 'rahul@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Priya Patel', 'priya@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Amit Kumar', 'amit@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Sample Reports
INSERT INTO `reports` (`user_id`, `category`, `description`, `location`, `status`) VALUES
(1, 'Roads', 'Large pothole near main market', 'MG Road, Near City Mall', 'pending'),
(1, 'Street Lights', 'Street light not working for 3 days', 'Sector 15, Near Park', 'in_progress'),
(2, 'Garbage', 'Garbage not collected since Monday', 'Housing Colony Block B', 'resolved'),
(2, 'Drainage', 'Blocked drain causing waterlogging', 'Station Road', 'pending'),
(3, 'Water Supply', 'Low water pressure in morning', 'Green Valley Apartments', 'in_progress');

-- Sample Feedback
INSERT INTO `feedback` (`user_id`, `name`, `email`, `message`) VALUES
(1, 'Rahul Sharma', 'rahul@example.com', 'Great platform for reporting issues!'),
(2, 'Priya Patel', 'priya@example.com', 'Quick response on my garbage complaint.');
