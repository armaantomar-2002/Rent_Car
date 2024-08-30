<?php
include('../config/db.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle_model = $_POST['vehicle_model'];
    $vehicle_number = $_POST['vehicle_number'];
    $seating_capacity = $_POST['seating_capacity'];
    $rent_per_day = $_POST['rent_per_day'];
    $vehicle_description = $_POST['vehicle_description'];

    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["vehicle_image"]["name"]);
    move_uploaded_file($_FILES["vehicle_image"]["tmp_name"], $target_file);

    $stmt = $conn->prepare("INSERT INTO cars (vehicle_model, vehicle_number, seating_capacity, rent_per_day, vehicle_image, vehicle_description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siisss", $vehicle_model, $vehicle_number, $seating_capacity, $rent_per_day, $target_file, $vehicle_description);

    if ($stmt->execute()) {
        echo "<script>alert('Car added successfully.');</script>";
    } else {
        echo "<script>alert('Error in adding car.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Add New Car</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Car</h2>
        <form method="POST" enctype="multipart/form-data" action="">
            <div class="form-group">
                <label>Vehicle Model</label>
                <input type="text" class="form-control" name="vehicle_model" required>
            </div>
            <div class="form-group">
                <label>Vehicle Number</label>
                <input type="number" class="form-control" name="vehicle_number" required>
            </div>
            <div class="form-group">
                <label>Seating Capacity</label>
                <input type="number" class="form-control" name="seating_capacity" required>
            </div>
            <div class="form-group">
                <label>Rent Per Day</label>
                <input type="number" class="form-control" name="rent_per_day" required>
            </div>
            <div class="form-group">
                <label>Vehicle Image</label>
                <input type="file" class="form-control" name="vehicle_image" required>
            </div>
            <div class="form-group">
                <label>Vehicle Description</label>
                <textarea class="form-control" name="vehicle_description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Admin Dashboard</a>
        </form>
    </div>
</body>
</html>
