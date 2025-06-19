<?php
include 'includes/connection.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: products.php");
    exit();
}

try {
    // Get product details
    $stmt = $connect->prepare("
        SELECT 
            products.*, 
            categories.name AS category_name 
        FROM products 
        INNER JOIN categories ON products.category_id = categories.id 
        WHERE products.id = ?
    ");
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        header("Location: products.php");
        exit();
    }
} catch (PDOException $e) {
    header("Location: products.php");
    exit();
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
    
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="products.php">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($product['name']) ?></li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="card-title mb-4"><?= htmlspecialchars($product['name']) ?></h1>
                        <h4 class="text-primary mb-4">$<?= number_format($product['price'], 2) ?></h4>
                        
                        <div class="mb-4">
                            <h5>Description</h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Product Information</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <strong>Category:</strong> 
                                        <a href="products.php?category_id=<?= htmlspecialchars($product['category_id']) ?>">
                                            <?= htmlspecialchars($product['category_name']) ?>
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <strong>Price:</strong> 
                                        $<?= number_format($product['price'], 2) ?>
                                    </li>
                                    <?php if (isset($product['created_at'])): ?>
                                    <li class="mb-2">
                                        <strong>Added on:</strong> 
                                        <?= date('F j, Y', strtotime($product['created_at'])) ?>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                                
                                <a href="products.php" class="btn btn-outline-primary w-100 mb-2">Back to Products</a>
                                <?php if (isset($product['category_id'])): ?>
                                <a href="products.php?category_id=<?= htmlspecialchars($product['category_id']) ?>" 
                                   class="btn btn-outline-secondary w-100">
                                    View More from <?= htmlspecialchars($product['category_name']) ?>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "includes/scripts.php" ?>
</body>

</html> 