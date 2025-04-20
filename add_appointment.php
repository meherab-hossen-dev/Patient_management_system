<?php
session_start();
require 'config/db.php';

$patients = $conn->query("SELECT * FROM Patients")->fetchAll();
$doctors = $conn->query("SELECT * FROM Doctors")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO Appointments (patient_id, doctor_id, date, time, status) VALUES (:patient_id, :doctor_id, :date, :time, :status)");
    $stmt->execute([
        'patient_id' => $_POST['patient_id'],
        'doctor_id' => $_POST['doctor_id'],
        'date' => $_POST['date'],
        'time' => $_POST['time'],
        'status' => $_POST['status']
    ]);
    header("Location: appointments.php");
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Appointment</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 40px;
    }

    h2, h1 {
        color: #333;
    }

    .container {
        max-width: 600px;
        margin: auto;
    }

    form, table {
        margin-top: 20px;
        width: 100%;
    }

    input, select, button {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        background-color: #f0f0f0;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    button:hover {
        background-color: #dcdcdc;
    }

    a {
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
    }

    table {
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }
</style>

</head>
<body>
    
    <h2>Schedule Appointment</h2>
    <form method="POST">
        <label>Patient:</label>
        <select name="patient_id" required>
            <?php foreach ($patients as $p): ?>
                <option value="<?= $p['patient_id'] ?>"><?= $p['name'] ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Doctor:</label>
        <select name="doctor_id" required>
            <?php foreach ($doctors as $d): ?>
                <option value="<?= $d['doctor_id'] ?>"><?= $d['name'] ?></option>
            <?php endforeach; ?>
        </select><br>
        <input type="date" name="date" required><br>
        <input type="time" name="time" required><br>
        <select name="status">
            <option value="Scheduled">Scheduled</option>
            <option value="Completed">Completed</option>
            <option value="Cancelled">Cancelled</option>
        </select><br>
        <button type="submit">Add Appointment</button>
    </form>
</body>
</html>
