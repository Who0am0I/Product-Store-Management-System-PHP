<?php
echo "<h2>MySQL Connection Test</h2>";

// Common XAMPP passwords to try
$passwords = ['', 'root', 'admin', 'password', '123456', 'xampp'];

foreach ($passwords as $password) {
    try {
        $connect = new PDO("mysql:host=localhost;dbname=product_store","root",$password);
        echo "<div style='background: #d4edda; color: #155724; padding: 10px; margin: 5px; border: 1px solid #c3e6cb; border-radius: 5px;'>";
        echo "✅ <strong>SUCCESS!</strong> Password found: <code>'$password'</code>";
        echo "</div>";
        
        // Test if database exists
        try {
            $result = $connect->query("SELECT COUNT(*) as count FROM categories");
            $count = $result->fetch(PDO::FETCH_ASSOC)['count'];
            echo "<div style='background: #d1ecf1; color: #0c5460; padding: 10px; margin: 5px; border: 1px solid #bee5eb; border-radius: 5px;'>";
            echo "✅ Database 'product_store' exists with $count categories";
            echo "</div>";
        } catch (Exception $e) {
            echo "<div style='background: #fff3cd; color: #856404; padding: 10px; margin: 5px; border: 1px solid #ffeaa7; border-radius: 5px;'>";
            echo "⚠️ Database 'product_store' does not exist. Please import the database.sql file.";
            echo "</div>";
        }
        
        break;
    } catch (Exception $e) {
        echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; margin: 5px; border: 1px solid #f5c6cb; border-radius: 5px;'>";
        echo "❌ Failed with password: <code>'$password'</code> - " . $e->getMessage();
        echo "</div>";
    }
}

echo "<hr>";
echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>If you found a working password, update both connection files</li>";
echo "<li>If no password worked, check your XAMPP MySQL settings</li>";
echo "<li>Make sure the 'product_store' database exists</li>";
echo "</ol>";
?> 