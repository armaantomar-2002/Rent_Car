<?php
include('../config/db.php');
session_start();

// Fetch available cars from the database
$query = "SELECT * FROM cars WHERE is_rented = 0";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Home</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Rent a Car</h2>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="home.php">Home</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="user_login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="user_register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="about_us.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="my_car.php">My Car</a></li>
                    <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Admin Dashboard</a></li>
                </ul>
            </div>
        </nav>

        <!-- Available Cars Section -->
        <h3 class="mt-4">Available Cars</h3>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-3 mb-3 ml-3">
                    <div class="card" style="width: 18rem; margin-left:3rem;">
                        <img src="../images/<?= $row['vehicle_image'] ?>" class="card-img-top" alt="Car Image">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['vehicle_model'] ?></h5>
                            <p class="card-text">
                                <strong>Vehicle Number:</strong> <?= $row['vehicle_number'] ?><br>
                                <strong>Seating Capacity:</strong> <?= $row['seating_capacity'] ?><br>
                                <strong>Rent per Day:</strong> Rs<?= $row['rent_per_day'] ?><br>
                                <strong>Description:</strong> <?= $row['vehicle_description'] ?>
                            </p>
                            <?php if (isset($_SESSION['user_id'])) { ?>
                                <a href="rent_page.php?car_id=<?= $row['id'] ?>" class="btn btn-primary">Rent Car</a>
                            <?php } else { ?>
                                <button onclick="alert('Please login to rent a car.');" class="btn btn-primary">Rent Car</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
