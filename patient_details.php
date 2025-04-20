<?php
session_start();
require 'config/db.php';

// Optional: Only allow logged-in users or admins
if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all patients
$stmt = $conn->query("SELECT * FROM Patients");
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f8f9fa;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ccc;
        }
        th {
            background-color: #343a40;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a.back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
        }
        a.back:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<h2>All Patient Details</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Medical History</th>
    </tr>
    <?php foreach ($patients as $patient): ?>
        <tr>
            <td><?= htmlspecialchars($patient['patient_id']) ?></td>
            <td><?= htmlspecialchars($patient['name']) ?></td>
            <td><?= htmlspecialchars($patient['age']) ?></td>
            <td><?= htmlspecialchars($patient['contact']) ?></td>
            <td><?= htmlspecialchars($patient['address']) ?></td>
            <td><?= nl2br(htmlspecialchars($patient['medical_history'])) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<a class="back" href="<?= isset($_SESSION['admin_id']) ? 'admin.php' : 'index.php' ?>">← Back to Dashboard</a>

</body>
</html>
