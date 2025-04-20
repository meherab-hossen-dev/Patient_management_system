<?php
session_start();
require 'config/db.php';

if (!isset($_GET['doctor_id'])) {
    echo "Error: Doctor ID is missing.";
    exit();
}

$doctor_id = $_GET['doctor_id'];

// Fetch doctor info
$stmt = $conn->prepare("SELECT * FROM Doctors WHERE doctor_id = :id");
$stmt->execute(['id' => $doctor_id]);
$doctor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$doctor) {
    echo "Doctor not found.";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE Doctors 
        SET name = :name, specialization = :specialization, contact = :contact, availability_status = :status 
        WHERE doctor_id = :id");

    $stmt->execute([
        'name' => $_POST['name'],
        'specialization' => $_POST['specialization'],
        'contact' => $_POST['contact'],
        'status' => $_POST['status'],
        'id' => $doctor_id
    ]);

    header("Location: edit_doctor.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Doctor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
        }
        input, select {
            margin: 10px 0;
            padding: 10px;
            width: 300px;
        }
        button {
            padding: 10px 20px;
        }
    </style>
</head>
<body>

    <h2>Edit Doctor</h2>

    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($doctor['name']) ?>" required><br>

        <label>Specialization:</label><br>
        <input type="text" name="specialization" value="<?= htmlspecialchars($doctor['specialization']) ?>"><br>

        <label>Contact:</label><br>
        <input type="text" name="contact" value="<?= htmlspecialchars($doctor['contact']) ?>" required><br>

        <label>Availability Status:</label><br>
        <select name="status">
            <option value="Available" <?= $doctor['availability_status'] == 'Available' ? 'selected' : '' ?>>Available</option>
            <option value="Unavailable" <?= $doctor['availability_status'] == 'Unavailable' ? 'selected' : '' ?>>Unavailable</option>
        </select><br><br>

        <button type="submit">Update</button>
    </form>

</body>
</html>
