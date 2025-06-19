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
                <h1 class="display-4 text-primary">Contact Us</h1>
                <p class="lead">Get in touch with our team</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Contact Information</h5>
                        <ul class="list-unstyled">
                            <li><strong>Address:</strong> 123 Store Street, City, State 12345</li>
                            <li><strong>Phone:</strong> (555) 123-4567</li>
                            <li><strong>Email:</strong> info@productstore.com</li>
                            <li><strong>Hours:</strong> Monday - Friday: 9AM - 6PM</li>
                        </ul>
                        <h5 class="card-title mt-4">Follow Us</h5>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-outline-primary">Facebook</a>
                            <a href="#" class="btn btn-outline-info">Twitter</a>
                            <a href="#" class="btn btn-outline-danger">Instagram</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Send us a Message</h5>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/scripts.php" ?>
</body>

</html> 