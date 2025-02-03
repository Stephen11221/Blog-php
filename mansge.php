<?php


$host = 'localhost';
$user = 'root';
$password = 'ROOT';
$database = 'Blog-datab';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetch blogs
$result = $conn->query("SELECT * FROM Blogstable");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blogs</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="flex">
    <div class="sidebar">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="">Update blog</a></li>
            <li><a href="viewcontact.php">People contacted us</a></li>
        </ul>
    </div>
    <div class="main">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Blog Title</th>
                    <th>Category</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['blogtitle']; ?></td>
                        <td><?php echo $row['blogcategory']; ?></td>
                        <td><?php echo substr($row['blog'], 0, 50) . '...'; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>
