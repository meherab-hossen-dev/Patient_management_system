<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->query("
    SELECT PR.*, P.name AS patient_name, D.name AS doctor_name 
    FROM Prescriptions PR
    JOIN Patients P ON PR.patient_id = P.patient_id
    JOIN Doctors D ON PR.doctor_id = D.doctor_id
    ORDER BY PR.date DESC
");
$prescriptions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Prescriptions</title>
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
    <h2>Prescription Records</h2>
    <a href="index.php">← Back to Dashboard</a>
    <table border="1">
        <tr>
            <th>Prescription ID</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Medicine</th>
            <th>Dosage</th>
            <th>Date</th>
        </tr>
        <?php foreach ($prescriptions as $pres): ?>
        <tr>
            <td><?= $pres['prescription_id'] ?></td>
            <td><?= $pres['patient_name'] ?></td>
            <td><?= $pres['doctor_name'] ?></td>
            <td><?= $pres['medicine'] ?></td>
            <td><?= $pres['dosage'] ?></td>
            <td><?= $pres['date'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
