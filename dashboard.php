
    <?php
    // Database connection

    $host = 'localhost'; // Server hostname
    $user = 'root';      // MySQL username
    $password = 'ROOT';  // MySQL password
    $database = 'Blog-datab'; // Database name

    $conn = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

// Handle form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogtitle = $_POST['blogtitle'];
    $blogcategory = $_POST['blogcategory'];
    $blog = $_POST['blog'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO Blogstable (blogtitle, blogcategory, blog) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $blogtitle, $blogcategory, $blog);

    if ($stmt->execute()) {
        $message = '<div class="alert alert-success" role="alert">Blog post added successfully!</div>';
    } else {
        $message = '<div class="alert alert-danger" role="alert">Error: ' . $stmt->error . '</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>
    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="flex">
        <div class="sidebar">
            <ul>
                <li><a href="dashboard.php">Dashboard </a></li>
                <li><a href="mansge.php">Update blog</a></li>
                <li><a href="viewcontact.php">People contacted us</a></li>
            </ul>
        </div>
        <div class="main">
            <div class="container mt-5">
            <h2>Create a New Blog Post</h2>
            <?php echo $message; ?>
            <form action="" method="post" class="mt-4">
                <div class="mb-3">
                    <label for="blogtitle" class="form-label">Blog Title</label>
                    <input type="text" name="blogtitle" id="blogtitle" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="blogcategory" class="form-label">Blog Category</label>
                    <select name="blogcategory" id="blogcategory" class="form-select" required>
                        <option value="Automotive">Automotive</option>
                        <option value="Lifestyle">Lifestyle</option>
                        <option value="Food and Agri-business">Food and Agri-business</option>
                        <option value="Technology">Technology</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="blog" class="form-label">Blog Content</label>
                    <textarea name="blog" id="blog" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Blog</button>
            </form>
        </div>

        </div>
    </div>
    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
