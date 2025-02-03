<?php

// Connection
$host = 'localhost';
$user = 'root';
$password = 'ROOT';
$database = 'Blog-datab';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch people contact messages
$result = $conn->query("SELECT * FROM contact");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="flex">
        <div class="sidebar">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="mansge.php">Update blog</a></li>
                <li><a href="viewcontact.php">People contacted us</a></li>
            </ul>
        </div>
        <div class="main">
            <h3 class="text-center my-4 mx-3">People feed back </h3>
            <table class="table table-bordered table-hover table-responsive table-striped ">
                <thead>
                    <tr>
                        <td>Photo</td>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>MESSAGE</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($result && $result->num_rows > 0): ?> 
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><i class="fa fa-user" aria-hidden="true"></i></td>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['emal']); ?></td>
                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">No messages found</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
