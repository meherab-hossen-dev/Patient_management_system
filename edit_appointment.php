<?php
session_start();
require 'config/db.php';

// Fetch all appointments
$stmt = $conn->query("SELECT * FROM Appointments");
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
        }
        a.button {
            padding: 6px 12px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a.button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h2>Appointments</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Patient ID</th>
            <th>Doctor ID</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php foreach ($appointments as $appointment): ?>
            <tr>
                <td><?= $appointment['appointment_id'] ?></td>
                <td><?= $appointment['patient_id'] ?></td>
                <td><?= $appointment['doctor_id'] ?></td>
                <td><?= $appointment['date'] ?></td>
                <td><?= $appointment['time'] ?></td>
                <td><?= $appointment['status'] ?></td>
                <td>
                    <a class="button" href="edit_appointment_form.php?id=<?= $appointment['appointment_id'] ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
