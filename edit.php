<?php
$host = 'localhost';
$user = 'root';
$password = 'ROOT';
$database = 'Blog-datab';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM Blogstable WHERE id = $id");
    $blog = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['blogtitle'];
    $category = $_POST['blogcategory'];
    $content = $_POST['blog'];

    $sql = "UPDATE Blogstable SET blogtitle = ?, blogcategory = ?, blog = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $category, $content, $id);

    if ($stmt->execute()) {
        header("Location: mansge.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Edit Blog</h2>
    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $blog['id']; ?>">
        <div class="mb-3">
            <label for="blogtitle" class="form-label">Title</label>
            <input type="text" class="form-control" name="blogtitle" value="<?php echo $blog['blogtitle']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="blogcategory" class="form-label">Category</label>
            <input type="text" class="form-control" name="blogcategory" value="<?php echo $blog['blogcategory']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="blog" class="form-label">Content</label>
            <textarea class="form-control" name="blog" required><?php echo $blog['blog']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="manage_blogs.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
