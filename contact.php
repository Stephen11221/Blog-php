
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
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO contact (name, emal, message) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $name, $email, $message);

    // Execute and check for errors
    if ($stmt->execute()) {
        $successMessage = "Message sent successfully!";
    } else {
        $errorMessage = "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-sm ">
            <a class="navbar-brand" href="#">Blog-Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link">Contact Us</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Contact Form -->
        <div class="container container-b" id="contact">
            <h5 class="text-center text-success">Contact Us</h5>
            <form action="contact.php" method="post" style="margin: 120px;">
                <div class="row row-cols-lg-2 row-cols-sm-1 row-cols-md-2">
                    <div class="col mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
                    </div>
                    <div class="col mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                    </div>
                </div>
                <div class="row row-cols-lg-1">
                    <div class="col mb-3">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="4" placeholder="Enter your message" required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-success text-light mt-3">Send</button>
                <?php if (isset($successMessage)): ?>
                    <p class="text-success mt-3"><?php echo $successMessage; ?></p>
                <?php elseif (isset($errorMessage)): ?>
                    <p class="text-danger mt-3"><?php echo $errorMessage; ?></p>
                <?php endif; ?>
            </form>
        </div>
    
</body>
</html>