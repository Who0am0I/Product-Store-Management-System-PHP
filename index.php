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
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h1 class="display-4 text-primary">Welcome to Product Store</h1>
                <p class="lead">Discover amazing products in various categories</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Browse Products</h5>
                        <p class="card-text">Explore our wide range of products</p>
                        <a href="products.php" class="btn btn-primary">View Products</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product Categories</h5>
                        <p class="card-text">Find products by category</p>
                        <a href="categories.php" class="btn btn-success">View Categories</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/scripts.php" ?>
</body>

</html> 