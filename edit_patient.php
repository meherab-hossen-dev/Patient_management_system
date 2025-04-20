<?php
session_start();
require 'config/db.php';

// Fetch all patients
$stmt = $conn->query("SELECT * FROM Patients");
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Patients</title>
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
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a.button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <h2>Patient List</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Medical History</th>
            <th>Action</th>
        </tr>
        <?php foreach ($patients as $patient): ?>
        <tr>
            <td><?= $patient['patient_id'] ?></td>
            <td><?= $patient['name'] ?></td>
            <td><?= $patient['age'] ?></td>
            <td><?= $patient['contact'] ?></td>
            <td><?= $patient['address'] ?></td>
            <td><?= $patient['medical_history'] ?></td>
            <td>
                <a class="button" href="edit_patient_form.php?id=<?= $patient['patient_id'] ?>">Edit</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
