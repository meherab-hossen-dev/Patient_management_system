<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->query("
    SELECT B.*, P.name 
    FROM Billing B 
    JOIN Patients P ON B.patient_id = P.patient_id
    ORDER BY B.date DESC
");
$billings = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Billing List</title>
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
    <h2>Billing Records</h2>
    <a href="index.php">← Back to Dashboard</a>
    <table border="1">
        <tr>
            <th>Bill ID</th>
            <th>Patient Name</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
        <?php foreach ($billings as $bill): ?>
        <tr>
            <td><?= $bill['bill_id'] ?></td>
            <td><?= $bill['name'] ?></td>
            <td><?= $bill['amount'] ?></td>
            <td><?= $bill['payment_status'] ?></td>
            <td><?= $bill['date'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
