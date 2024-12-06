/blog-management-system
│
├── /assets            # CSS, JavaScript, images
├── /controllers       # Handles the business logic
├── /models            # Handles database operations
├── /views             # Contains HTML templates
├── /config            # Configuration files (e.g., database connection)
├── /admin             # Admin panel files
├── /public            # Public accessible files (e.g., index.php)
└── /uploads           # Uploaded files (images, etc.)


CREATE DATABASE blog_management;

USE blog_management;

-- Table for users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin', 'user') DEFAULT 'user',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for blog posts
CREATE TABLE blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    image VARCHAR(255),
    category VARCHAR(50),
    publish_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table for comments
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    blog_post_id INT NOT NULL,
    user_name VARCHAR(100) NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    approved BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (blog_post_id) REFERENCES blog_posts(id) ON DELETE CASCADE
);

-- Sample data
INSERT INTO users (username, password, email, role) VALUES 
('admin', '$2y$10$adminhashedpassword', 'admin@example.com', 'admin');



CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- Add foreign key to blog_posts table
ALTER TABLE blog_posts ADD COLUMN category_id INT;
ALTER TABLE blog_posts ADD FOREIGN KEY (category_id) REFERENCES categories(id);


CREATE TABLE activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES users(id)
);

