<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->query("SELECT * FROM Doctors");
$doctors = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctors</title>
</head>
<body>
    <h2>Doctors List</h2>
    <a href="add_doctor.php">Add New Doctor</a>
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
            <td>
                <a href="edit_doctor.php?id=<?= $doc['doctor_id'] ?>">Edit</a> |
                <a href="delete_doctor.php?id=<?= $doc['doctor_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
