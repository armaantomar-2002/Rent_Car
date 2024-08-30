<?php
include('../config/db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT bookings.id, cars.vehicle_model, cars.vehicle_number, cars.rent_per_day FROM bookings JOIN cars ON bookings.car_id = cars.id WHERE bookings.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>My Cars</title>
</head>
<body>
    <div class="container mt-5">
        <h2>My Rented Cars</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Vehicle Model</th>
                    <th>Vehicle Number</th>
                    <th>Rent Per Day</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['vehicle_model'] ?></td>
                        <td><?= $row['vehicle_number'] ?></td>
                        <td><?= $row['rent_per_day'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="home.php" class="btn btn-secondary">Home</a>
    </div>
</body>
</html>
