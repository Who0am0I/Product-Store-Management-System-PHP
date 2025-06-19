-- Product Store Database Schema

-- Create database
CREATE DATABASE IF NOT EXISTS product_store;
USE product_store;

-- Create categories table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Insert sample categories
INSERT INTO categories (name, description) VALUES
('Electronics', 'Electronic devices and gadgets'),
('Clothing', 'Fashion and apparel items'),
('Books', 'Books and publications'),
('Home & Garden', 'Home improvement and garden supplies'),
('Sports', 'Sports equipment and accessories'),
('Toys', 'Toys and games for all ages');

-- Insert sample products
INSERT INTO products (name, price, description, category_id) VALUES
('iPhone 15 Pro', 999.99, 'Latest iPhone with advanced camera system and A17 Pro chip', 1),
('Samsung Galaxy S24', 899.99, 'Premium Android smartphone with AI features', 1),
('MacBook Air M2', 1199.99, 'Lightweight laptop with powerful M2 chip', 1),
('Nike Air Max 270', 129.99, 'Comfortable running shoes with Air Max technology', 2),
('Adidas Ultraboost 22', 179.99, 'High-performance running shoes with Boost midsole', 2),
('The Great Gatsby', 12.99, 'Classic American novel by F. Scott Fitzgerald', 3),
('To Kill a Mockingbird', 14.99, 'Harper Lee\'s masterpiece about justice and racism', 3),
('Garden Hose 50ft', 29.99, 'Heavy-duty garden hose for all your watering needs', 4),
('LED Plant Grow Light', 45.99, 'Full spectrum LED light for indoor plant growth', 4),
('Basketball', 24.99, 'Official size basketball for indoor and outdoor use', 5),
('Yoga Mat', 19.99, 'Non-slip yoga mat for home and studio practice', 5),
('LEGO Star Wars Set', 79.99, 'Build your own Star Wars spaceship with this LEGO set', 6),
('Board Game Collection', 34.99, 'Family board game collection with multiple games', 6); 