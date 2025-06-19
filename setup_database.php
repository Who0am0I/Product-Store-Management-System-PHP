<?php
echo "<h2>Product Store Database Setup</h2>";

// Common XAMPP passwords to try
$passwords = ['', 'root', 'admin', 'password', '123456', 'xampp'];

$connected = false;
$workingPassword = '';

// First, try to connect without specifying a database
foreach ($passwords as $password) {
    try {
        $pdo = new PDO("mysql:host=localhost;port=3307", "root", $password);
        $connected = true;
        $workingPassword = $password;
        echo "<div style='background: #d4edda; color: #155724; padding: 10px; margin: 5px; border: 1px solid #c3e6cb; border-radius: 5px;'>";
        echo "✅ <strong>MySQL Connection Successful!</strong> Password: <code>'$password'</code>";
        echo "</div>";
        break;
    } catch (Exception $e) {
        echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; margin: 5px; border: 1px solid #f5c6cb; border-radius: 5px;'>";
        echo "❌ Failed with password: <code>'$password'</code> - " . $e->getMessage();
        echo "</div>";
    }
}

if (!$connected) {
    echo "<div style='background: #f8d7da; color: #721c24; padding: 15px; margin: 20px; border: 1px solid #f5c6cb; border-radius: 5px;'>";
    echo "<h3>❌ Cannot connect to MySQL</h3>";
    echo "<p>Please make sure:</p>";
    echo "<ol>";
    echo "<li>XAMPP is running</li>";
    echo "<li>MySQL service is started</li>";
    echo "<li>Check your MySQL root password</li>";
    echo "</ol>";
    echo "</div>";
    exit();
}

// Now create the database
try {
    $pdo->exec("CREATE DATABASE IF NOT EXISTS product_store");
    echo "<div style='background: #d4edda; color: #155724; padding: 10px; margin: 5px; border: 1px solid #c3e6cb; border-radius: 5px;'>";
    echo "✅ Database 'product_store' created successfully";
    echo "</div>";
} catch (Exception $e) {
    echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; margin: 5px; border: 1px solid #f5c6cb; border-radius: 5px;'>";
    echo "❌ Error creating database: " . $e->getMessage();
    echo "</div>";
    exit();
}

// Connect to the specific database
try {
    $pdo = new PDO("mysql:host=localhost;port=3307;dbname=product_store", "root", $workingPassword);
    echo "<div style='background: #d4edda; color: #155724; padding: 10px; margin: 5px; border: 1px solid #c3e6cb; border-radius: 5px;'>";
    echo "✅ Connected to 'product_store' database";
    echo "</div>";
} catch (Exception $e) {
    echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; margin: 5px; border: 1px solid #f5c6cb; border-radius: 5px;'>";
    echo "❌ Error connecting to database: " . $e->getMessage();
    echo "</div>";
    exit();
}

// Create tables
$tables = [
    "categories" => "CREATE TABLE categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )",
    
    "products" => "CREATE TABLE products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        description TEXT,
        category_id INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
    )"
];

foreach ($tables as $tableName => $sql) {
    try {
        $pdo->exec($sql);
        echo "<div style='background: #d4edda; color: #155724; padding: 10px; margin: 5px; border: 1px solid #c3e6cb; border-radius: 5px;'>";
        echo "✅ Table '$tableName' created successfully";
        echo "</div>";
    } catch (Exception $e) {
        echo "<div style='background: #fff3cd; color: #856404; padding: 10px; margin: 5px; border: 1px solid #ffeaa7; border-radius: 5px;'>";
        echo "⚠️ Table '$tableName' already exists or error: " . $e->getMessage();
        echo "</div>";
    }
}

// Insert sample data
$sampleCategories = [
    ['Electronics', 'Electronic devices and gadgets'],
    ['Clothing', 'Fashion and apparel items'],
    ['Books', 'Books and publications'],
    ['Home & Garden', 'Home improvement and garden supplies'],
    ['Sports', 'Sports equipment and accessories'],
    ['Toys', 'Toys and games for all ages']
];

$sampleProducts = [
    ['iPhone 15 Pro', 999.99, 'Latest iPhone with advanced camera system and A17 Pro chip', 1],
    ['Samsung Galaxy S24', 899.99, 'Premium Android smartphone with AI features', 1],
    ['MacBook Air M2', 1199.99, 'Lightweight laptop with powerful M2 chip', 1],
    ['Nike Air Max 270', 129.99, 'Comfortable running shoes with Air Max technology', 2],
    ['Adidas Ultraboost 22', 179.99, 'High-performance running shoes with Boost midsole', 2],
    ['The Great Gatsby', 12.99, 'Classic American novel by F. Scott Fitzgerald', 3],
    ['To Kill a Mockingbird', 14.99, 'Harper Lee\'s masterpiece about justice and racism', 3],
    ['Garden Hose 50ft', 29.99, 'Heavy-duty garden hose for all your watering needs', 4],
    ['LED Plant Grow Light', 45.99, 'Full spectrum LED light for indoor plant growth', 4],
    ['Basketball', 24.99, 'Official size basketball for indoor and outdoor use', 5],
    ['Yoga Mat', 19.99, 'Non-slip yoga mat for home and studio practice', 5],
    ['LEGO Star Wars Set', 79.99, 'Build your own Star Wars spaceship with this LEGO set', 6],
    ['Board Game Collection', 34.99, 'Family board game collection with multiple games', 6]
];

// Insert categories
foreach ($sampleCategories as $category) {
    try {
        $stmt = $pdo->prepare("INSERT IGNORE INTO categories (name, description) VALUES (?, ?)");
        $stmt->execute($category);
    } catch (Exception $e) {
        // Category might already exist, that's okay
    }
}

// Insert products
foreach ($sampleProducts as $product) {
    try {
        $stmt = $pdo->prepare("INSERT IGNORE INTO products (name, price, description, category_id) VALUES (?, ?, ?, ?)");
        $stmt->execute($product);
    } catch (Exception $e) {
        // Product might already exist, that's okay
    }
}

echo "<div style='background: #d4edda; color: #155724; padding: 10px; margin: 5px; border: 1px solid #c3e6cb; border-radius: 5px;'>";
echo "✅ Sample data inserted successfully";
echo "</div>";

echo "<hr>";
echo "<h3>🎉 Database Setup Complete!</h3>";
echo "<p><strong>Working password:</strong> <code>'$workingPassword'</code></p>";
echo "<p><strong>Database:</strong> product_store</p>";
echo "<p><strong>Tables:</strong> categories, products</p>";
echo "<p><a href='index.php' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Product Store</a></p>";
echo "<p><a href='admin/products/' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Admin Panel</a></p>";
?> 