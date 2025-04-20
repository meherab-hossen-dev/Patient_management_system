<?php
session_start();
require 'config/db.php';

if (!isset($_GET['id'])) {
    echo "Appointment ID missing.";
    exit();
}

$appointment_id = $_GET['id'];

// Fetch the appointment details
$stmt = $conn->prepare("SELECT * FROM Appointments WHERE appointment_id = :id");
$stmt->execute(['id' => $appointment_id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    echo "Appointment not found.";
    exit();
}

// On form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE Appointments 
        SET patient_id = :patient_id, doctor_id = :doctor_id, date = :date, time = :time, status = :status 
        WHERE appointment_id = :id");

    $stmt->execute([
        'patient_id' => $_POST['patient_id'],
        'doctor_id' => $_POST['doctor_id'],
        'date' => $_POST['date'],
        'time' => $_POST['time'],
        'status' => $_POST['status'],
        'id' => $appointment_id
    ]);

    header("Location: edit_appointments.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
        }
        input, select {
            padding: 10px;
            margin: 10px 0;
            width: 300px;
        }
        button {
            padding: 10px 20px;
        }
    </style>
</head>
<body>

    <h2>Edit Appointment</h2>

    <form method="POST">
        <label>Patient ID:</label><br>
        <input type="number" name="patient_id" value="<?= $appointment['patient_id'] ?>" required><br>

        <label>Doctor ID:</label><br>
        <input type="number" name="doctor_id" value="<?= $appointment['doctor_id'] ?>" required><br>

        <label>Date:</label><br>
        <input type="date" name="date" value="<?= $appointment['date'] ?>" required><br>

        <label>Time:</label><br>
        <input type="time" name="time" value="<?= $appointment['time'] ?>" required><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="Scheduled" <?= $appointment['status'] == 'Scheduled' ? 'selected' : '' ?>>Scheduled</option>
            <option value="Completed" <?= $appointment['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
            <option value="Cancelled" <?= $appointment['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
        </select><br><br>

        <button type="submit">Update Appointment</button>
    </form>

</body>
</html>
