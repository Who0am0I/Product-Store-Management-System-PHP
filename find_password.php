<?php
echo "<h2>🔍 MySQL Password Finder</h2>";
echo "<p>Let's find your MySQL root password...</p>";

// Extended list of common passwords
$passwords = [
    '', 'root', 'admin', 'password', '123456', 'xampp',
    'mysql', '123', '1234', '12345', '1234567', '12345678',
    'qwerty', 'abc123', 'password123', 'admin123',
    'root123', 'xampp123', 'mysql123', 'test', 'demo',
    'user', 'default', 'blank', 'empty', 'none'
];

$connected = false;
$workingPassword = '';

echo "<h3>Testing MySQL Connection...</h3>";

// First, let's check if MySQL is running at all
try {
    $socket = @fsockopen('localhost', 3307, $errno, $errstr, 5);
    if ($socket) {
        echo "<div style='background: #d4edda; color: #155724; padding: 10px; margin: 5px; border: 1px solid #c3e6cb; border-radius: 5px;'>";
        echo "✅ MySQL is running on port 3307";
        echo "</div>";
        fclose($socket);
    } else {
        echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; margin: 5px; border: 1px solid #f5c6cb; border-radius: 5px;'>";
        echo "❌ MySQL is not running on port 3307";
        echo "</div>";
        echo "<p><strong>Solution:</strong> Start MySQL in XAMPP Control Panel</p>";
        exit();
    }
} catch (Exception $e) {
    echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; margin: 5px; border: 1px solid #f5c6cb; border-radius: 5px;'>";
    echo "❌ Cannot check MySQL status: " . $e->getMessage();
    echo "</div>";
}

echo "<h3>Trying Different Passwords...</h3>";

foreach ($passwords as $password) {
    $passwordDisplay = $password === '' ? '(empty)' : "'$password'";
    
    try {
        $pdo = new PDO("mysql:host=localhost;port=3307", "root", $password);
        $connected = true;
        $workingPassword = $password;
        echo "<div style='background: #d4edda; color: #155724; padding: 10px; margin: 5px; border: 1px solid #c3e6cb; border-radius: 5px;'>";
        echo "🎉 <strong>SUCCESS!</strong> Password found: <code>$passwordDisplay</code>";
        echo "</div>";
        break;
    } catch (Exception $e) {
        echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; margin: 5px; border: 1px solid #f5c6cb; border-radius: 5px;'>";
        echo "❌ Failed with password: <code>$passwordDisplay</code> - " . $e->getMessage();
        echo "</div>";
    }
}

if (!$connected) {
    echo "<hr>";
    echo "<h3>❌ No Password Worked</h3>";
    echo "<p><strong>Possible Solutions:</strong></p>";
    echo "<ol>";
    echo "<li><strong>Reset MySQL root password:</strong>";
    echo "<ul>";
    echo "<li>Stop MySQL in XAMPP Control Panel</li>";
    echo "<li>Open Command Prompt as Administrator</li>";
    echo "<li>Navigate to: <code>C:\\xampp\\mysql\\bin</code></li>";
    echo "<li>Run: <code>mysqld --skip-grant-tables</code></li>";
    echo "<li>Open another Command Prompt and run: <code>mysql -u root</code></li>";
    echo "<li>In MySQL, run: <code>UPDATE mysql.user SET Password=PASSWORD('') WHERE User='root';</code></li>";
    echo "<li>Restart MySQL in XAMPP</li>";
    echo "</ul></li>";
    echo "<li><strong>Check XAMPP MySQL configuration:</strong>";
    echo "<ul>";
    echo "<li>Look in <code>C:\\xampp\\mysql\\data\\mysql\\user.MYD</code></li>";
    echo "<li>Check <code>C:\\xampp\\phpMyAdmin\\config.inc.php</code></li>";
    echo "</ul></li>";
    echo "<li><strong>Try connecting with phpMyAdmin:</strong>";
    echo "<ul>";
    echo "<li>Go to: <code>http://localhost/phpmyadmin</code></li>";
    echo "<li>Try logging in with different passwords</li>";
    echo "</ul></li>";
    echo "</ol>";
    
    echo "<h3>Manual Password Entry:</h3>";
    echo "<p>If you know your MySQL root password, we can update the connection files manually.</p>";
    echo "<p>What is your MySQL root password? (if you know it)</p>";
    
    exit();
}

echo "<hr>";
echo "<h3>🎉 Success!</h3>";
echo "<p><strong>Working password:</strong> <code>'$workingPassword'</code></p>";

// Test if we can create databases
try {
    $pdo->exec("CREATE DATABASE IF NOT EXISTS test_connection");
    echo "<div style='background: #d4edda; color: #155724; padding: 10px; margin: 5px; border: 1px solid #c3e6cb; border-radius: 5px;'>";
    echo "✅ Can create databases successfully";
    echo "</div>";
    
    // Clean up test database
    $pdo->exec("DROP DATABASE test_connection");
} catch (Exception $e) {
    echo "<div style='background: #fff3cd; color: #856404; padding: 10px; margin: 5px; border: 1px solid #ffeaa7; border-radius: 5px;'>";
    echo "⚠️ Cannot create databases: " . $e->getMessage();
    echo "</div>";
}

echo "<p><a href='setup_database.php' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Continue to Database Setup</a></p>";
?> 