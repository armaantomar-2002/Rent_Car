<?php
include('../config/db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM cars WHERE is_rented = 0";
$result = $conn->query($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = $_POST['car_id'];
    $rent_days = $_POST['rent_days'];

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, car_id, rent_days) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $user_id, $car_id, $rent_days);

    if ($stmt->execute()) {
        $update_car_status = $conn->prepare("UPDATE cars SET is_rented = 1 WHERE id = ?");
        $update_car_status->bind_param("i", $car_id);
        $update_car_status->execute();
        echo "<script>alert('Car booked successfully.');</script>";
    } else {
        echo "<script>alert('Error in booking car.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Rent A Car</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Rent A Car</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Select Car</label>
                <select class="form-control" name="car_id" required>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <option value="<?= $row['id'] ?>"><?= $row['vehicle_model'] ?> - <?= $row['vehicle_number'] ?> (<?= $row['rent_per_day'] ?> per day)</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Rent Days</label>
                <input type="number" class="form-control" name="rent_days" required>
            </div>
            <button type="submit" class="btn btn-primary">Rent</button>
            <a href="my_car.php" class="btn btn-secondary">My Cars</a>
            <a href="home.php" class="btn btn-secondary">Home</a>
        </form>
    </div>
</body>
</html>
