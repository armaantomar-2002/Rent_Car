<?php
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO admin (name, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $username, $hashed_password);

        if ($stmt->execute()) {
            header("Location: admin_dashboard.php");
        } else {
            echo "<script>alert('Error in registration.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Admin Register</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Admin Registration</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <a href="admin_login.php" class="btn btn-link">Already registered? Login</a>
            <a href="admin_dashboard.php" class="btn btn-secondary">Admin Page</a>
        </form>
    </div>
</body>
</html>
