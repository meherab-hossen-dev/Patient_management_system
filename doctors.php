<?php
session_start();
require 'config/db.php';

/* if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}*/

$stmt = $conn->query("SELECT * FROM Doctors");
$doctors = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctors</title>

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
    <h2>Doctors List</h2>
    <!-- <a href="add_doctor.php">Add New Doctor</a> -->
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Specialization</th>
            <th>Contact</th>
            <th>Status</th>
            <!-- <th>Action</th> -->
        </tr>
        <?php foreach ($doctors as $doc): ?>
        <tr>
            <td><?= $doc['doctor_id'] ?></td>
            <td><?= $doc['name'] ?></td>
            <td><?= $doc['specialization'] ?></td>
            <td><?= $doc['contact'] ?></td>
            <td><?= $doc['availability_status'] ?></td>
            <!-- <td>
                <a href="edit_doctor.php?id=<?= $doc['doctor_id'] ?>">Edit</a> |
                <a href="delete_doctor.php?id=<?= $doc['doctor_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>-->
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
