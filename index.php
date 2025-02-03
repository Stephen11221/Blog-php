<?php

// Database connection
$host = 'localhost';
$user = 'root';
$password = 'ROOT';
$database = 'Blog-datab';

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from Blogstable
$result = $conn->query("SELECT * FROM Blogstable");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-sm ">
            <a class="navbar-brand" href="#">Blog-Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#blog" class="nav-link">Our Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link">Contact Us</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Home Section -->
        <div class="container-a home container" id="home">
            <h1>Read our blogs and become part of us</h1>
            <div class="row row-cols-lg-2 row-cols-md-1">
                <div class="col">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis maxime assumenda nostrum?</p>
                    <a class="btn btn-primary">Get Started</a>
                </div>
                <div class="col">
                    <img src="img/img/download.jpeg" alt="Placeholder Image" class="img-fluid">
                </div>
            </div>
        </div>

        <!-- About Section -->
        <div class="container-a container" id="about">
            <h5 class="text-success text-center">About Us</h5>
            <div class="row row-cols-lg-3 ">
                <div class="col">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga iure modi, similique quaerat nihil sit ab perferendis repellendus sed ullam.</p>
                </div>
                <div class="col">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur recusandae necessitatibus omnis ad ipsum impedit quas delectus eum nesciunt numquam?</p>
                </div>
                <div class="col">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni totam commodi deserunt cumque quisquam!</p>
                </div>
            </div>
        </div>

        <!-- Blogs Section -->
        <div class="container-a container" id="blog">
            <h4 class="text-muted text-center">Read Short Blogs</h4>
            <div class="row row-cols-lg-1 row-cols-md-1 g-4">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-header">
                                    <span class="btn btn-dark text-light"><?php echo $row['id']; ?></span>
                                    <h3 class="text-success"><?php echo htmlspecialchars($row['blogtitle']); ?></h3>
                                </div>
                                <div class="card-body">
                                    <h4><?php echo htmlspecialchars($row['blogcategory']); ?></h4>
                                    <p><?php echo htmlspecialchars($row['blog']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-center text-muted">No blogs available at the moment. Please check back later!</p>
                <?php endif; ?>
            </div>
        </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>