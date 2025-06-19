<?php
include 'includes/connection.php';

// Build the query based on whether a category is selected
$query = "SELECT products.id AS product_id, products.name AS product_name, products.price, products.description, categories.name AS category_name 
          FROM products 
          INNER JOIN categories ON products.category_id = categories.id";

if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $query .= " WHERE categories.id = ?";
    $stmt = $connect->prepare($query);
    $stmt->execute([$category_id]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get category name
    $catStmt = $connect->prepare("SELECT name FROM categories WHERE id = ?");
    $catStmt->execute([$category_id]);
    $category = $catStmt->fetch(PDO::FETCH_ASSOC);
} else {
    $result = $connect->query($query);
    $products = $result->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/head.php" ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <?php include 'includes/navbar.php' ?>
    </nav>
    <div class="container">
        <?php if (isset($category)): ?>
            <h1 class="text-primary mt-4 text-center">Products in <?= htmlspecialchars($category['name']) ?></h1>
            <div class="text-center mb-4">
                <a href="products.php" class="btn btn-outline-primary">View All Products</a>
            </div>
        <?php else: ?>
            <h1 class="text-primary mt-4 text-center">All Products</h1>
        <?php endif; ?>
        
        <div class="row">
        <?php if (empty($products)): ?>
            <div class="col-12 text-center">
                <p class="alert alert-info">No products found.</p>
            </div>
        <?php else: ?>
            <?php foreach($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product['product_name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($product['description'], 0, 100)) ?>...</p>
                            <p class="card-text"><strong>Price: $<?= number_format($product['price'], 2) ?></strong></p>
                            <p class="card-text"><small class="text-muted">Category: <?= htmlspecialchars($product['category_name']) ?></small></p>
                            <a href="product-details.php?id=<?= htmlspecialchars($product['product_id']) ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </div>
    <?php include "includes/scripts.php" ?>
</body>

</html> 