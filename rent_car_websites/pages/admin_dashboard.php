<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Admin Page</h2>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="admin_dashboard.php">Dashboard</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="admin_register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin_login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="add_car.php">Add New Car</a></li>
                    <li class="nav-item"><a class="nav-link" href="view_booked_cars.php">View Booked Cars</a></li>
                    <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                </ul>
            </div>
        </nav>
    </div>
</body>
</html>
