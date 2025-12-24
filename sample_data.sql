-- Smart City Portal - Sample Data
-- Run this in phpMyAdmin after creating the database

-- Sample Users
INSERT INTO users (name, email, password) VALUES 
('Rahul Sharma', 'rahul@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Priya Patel', 'priya@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Amit Kumar', 'amit@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Sneha Desai', 'sneha@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Vikram Singh', 'vikram@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Sample Reports (with different categories, statuses, and dates)
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
