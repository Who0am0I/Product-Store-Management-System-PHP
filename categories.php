<?php
include 'includes/connection.php';
$result = $connect->query("SELECT * FROM categories"); 
$categories = $result->fetchAll(PDO::FETCH_ASSOC);
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
        <h1 class="text-success mt-4 text-center">All Categories</h1>
        <div class="row">
        <?php foreach($categories as $category){ ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($category['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($category['description']) ?></p>
                        <a href="products.php?category_id=<?= htmlspecialchars($category['id']) ?>" class="btn btn-success">View Products</a>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
    <?php include "includes/scripts.php" ?>
</body>

</html> 