<?php
session_start();

// Redirect non-admin users to login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$host = 'localhost';
$user = 'root';
$password = 'ROOT';
$database = 'Blog-datab';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Generate CSRF token if not set
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$error = ""; // Variable to store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "Invalid request.";
    } else {
        // Sanitize inputs
        $username = htmlspecialchars(trim($_POST['username']));
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);

        if (empty($username) || empty($email) || empty($password)) {
            $error = "All fields are required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user'; // Default role

            // Only admin can assign roles
            if (isset($_POST['role']) && $_POST['role'] === 'admin' && $_SESSION['role'] === 'admin') {
                $role = 'admin';
            }

            // Insert user into database
            $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);

            if ($stmt->execute()) {
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Error: " . $stmt->error;
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Signup</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="signup.php" class="w-50 mx-auto">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary w-100">Signup</button>
        <p class="text-center mt-3">
            Already have an account? <a href="login.php">Login here</a>
        </p>
    </form>
</div>
</body>
</html>