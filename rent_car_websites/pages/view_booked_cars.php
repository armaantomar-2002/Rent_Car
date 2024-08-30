<?php
include('../config/db.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$query = "SELECT bookings.id, user.name AS user_name, user.contact_number, user.email, cars.vehicle_model FROM bookings JOIN user ON bookings.user_id = user.id JOIN cars ON bookings.car_id = cars.id";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>View Booked Cars</title>
</head>
<body>
    <div class="container mt-5">
        <h2>View Booked Cars</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Vehicle Model</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['user_name'] ?></td>
                        <td><?= $row['contact_number'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['vehicle_model'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="admin_dashboard.php" class="btn btn-secondary">Admin Dashboard</a>
    </div>
</body>
</html>
