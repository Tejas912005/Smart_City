-- =============================================
-- Smart City Portal - Complete Database Setup
-- =============================================
-- How to use:
-- 1. Open phpMyAdmin (http://localhost/phpmyadmin)
-- 2. Click "New" to create a database named "smart_city"
-- 3. Select the "smart_city" database
-- 4. Go to "Import" tab → Choose this file → Click "Go"
-- =============================================


-- =============================================
-- TABLE 1: Users
-- =============================================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- TABLE 2: Reports
-- =============================================
CREATE TABLE IF NOT EXISTS reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    category VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    status VARCHAR(50) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- TABLE 3: Feedback
-- =============================================
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT DEFAULT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- TABLE 4: Admins (for secure admin login)
-- =============================================
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =============================================
-- PERFORMANCE INDEXES
-- =============================================
CREATE INDEX idx_reports_status ON reports(status);
CREATE INDEX idx_reports_category ON reports(category);
CREATE INDEX idx_reports_user_id ON reports(user_id);
CREATE INDEX idx_reports_created_at ON reports(created_at);
CREATE INDEX idx_reports_status_category ON reports(status, category);
CREATE INDEX idx_feedback_user_id ON feedback(user_id);
CREATE INDEX idx_users_email ON users(email);

-- =============================================
-- DEFAULT ADMIN (password: tejas123)
-- =============================================
INSERT INTO admins (username, password, name) VALUES 
('tejas', '$2y$10$YWVhNzVmNjE1ZGI1ZDljNOGZhNmFlNGNkYmY5NjE0NmI0NTk3MGVk', 'Tejas')
ON DUPLICATE KEY UPDATE username = username;

-- =============================================
-- SAMPLE DATA (optional - remove if not needed)
-- =============================================

-- Sample Users (password is "password" for all)
INSERT INTO users (name, email, password) VALUES 
('Rahul Sharma', 'rahul@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Priya Patel', 'priya@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Amit Kumar', 'amit@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Sneha Desai', 'sneha@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Vikram Singh', 'vikram@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Sample Reports
INSERT INTO reports (user_id, category, description, image, status, created_at) VALUES 
(1, 'Pothole', 'Large pothole on MG Road near bus stop. Causing accidents.', '', 'Pending', DATE_SUB(NOW(), INTERVAL 1 DAY)),
(1, 'Streetlight', 'Streetlight not working on 5th Cross Road for 2 weeks.', '', 'In Progress', DATE_SUB(NOW(), INTERVAL 2 DAY)),
(2, 'Garbage', 'Garbage pile near Shivaji Park entrance. Very smelly.', '', 'Resolved', DATE_SUB(NOW(), INTERVAL 3 DAY)),
(2, 'Pothole', 'Multiple potholes on Station Road causing traffic jams.', '', 'Pending', DATE_SUB(NOW(), INTERVAL 1 DAY)),
(3, 'Water Leak', 'Water pipeline leak on Gandhi Nagar main road.', '', 'In Progress', DATE_SUB(NOW(), INTERVAL 4 DAY)),
(3, 'Garbage', 'Overflowing dustbin near market area. Health hazard.', '', 'Pending', DATE_SUB(NOW(), INTERVAL 2 DAY)),
(4, 'Streetlight', 'Three streetlights not working on Ring Road.', '', 'Resolved', DATE_SUB(NOW(), INTERVAL 5 DAY)),
(4, 'Pothole', 'Deep pothole near City Hospital. Urgent fix needed.', '', 'In Progress', DATE_SUB(NOW(), INTERVAL 3 DAY)),
(5, 'Other', 'Broken bench at Central Park. Safety concern for elderly.', '', 'Pending', DATE_SUB(NOW(), INTERVAL 1 DAY)),
(5, 'Garbage', 'Illegal dumping of construction waste on vacant plot.', '', 'Pending', NOW()),
(1, 'Water Leak', 'Sewage overflow on Nehru Street. Health emergency.', '', 'In Progress', DATE_SUB(NOW(), INTERVAL 6 DAY)),
(2, 'Streetlight', 'Dim streetlight near school. Safety concern for children.', '', 'Resolved', DATE_SUB(NOW(), INTERVAL 7 DAY)),
(3, 'Pothole', 'Road damage after recent rain near college area.', '', 'Pending', NOW()),
(4, 'Garbage', 'No garbage collection in our area for 3 days.', '', 'Resolved', DATE_SUB(NOW(), INTERVAL 4 DAY)),
(5, 'Other', 'Damaged road sign at major junction. Confusing drivers.', '', 'In Progress', DATE_SUB(NOW(), INTERVAL 2 DAY));

-- Sample Feedback
INSERT INTO feedback (name, email, message, created_at) VALUES 
('Rahul Sharma', 'rahul@example.com', 'Great platform! My pothole complaint was resolved within 3 days.', DATE_SUB(NOW(), INTERVAL 2 DAY)),
('Priya Patel', 'priya@example.com', 'Very useful app. Would love to see a mobile version.', DATE_SUB(NOW(), INTERVAL 3 DAY)),
('Anonymous Citizen', 'citizen@example.com', 'Please add more categories like noise pollution and encroachment.', DATE_SUB(NOW(), INTERVAL 5 DAY)),
('Amit Kumar', 'amit@example.com', 'The response time has improved a lot. Keep it up!', DATE_SUB(NOW(), INTERVAL 1 DAY)),
('Sneha Desai', 'sneha@example.com', 'Can we track which department is handling our complaint?', NOW());
