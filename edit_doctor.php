<?php
session_start();
require 'config/db.php';

// Fetch all doctors
$stmt = $conn->query("SELECT * FROM Doctors");
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Doctors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
        }
        a.button {
            padding: 6px 12px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a.button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h2>Doctors List</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Specialization</th>
            <th>Contact</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php foreach ($doctors as $doctor): ?>
            <tr>
                <td><?= $doctor['doctor_id'] ?></td>
                <td><?= htmlspecialchars($doctor['name']) ?></td>
                <td><?= htmlspecialchars($doctor['specialization']) ?></td>
                <td><?= htmlspecialchars($doctor['contact']) ?></td>
                <td><?= htmlspecialchars($doctor['availability_status']) ?></td>
                <td><a class="button" href="edit_doctor_form.php?doctor_id=<?= $doctor['doctor_id'] ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
