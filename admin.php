<?php
session_start();
require 'config/db.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        h2 {
            color: #333;
        }

        .admin-options {
            display: flex;
            flex-direction: column;
            max-width: 300px;
        }

        .admin-options a {
            margin: 10px 0;
            padding: 10px;
            background-color: #f0f0f0;
            color: #000;
            text-decoration: none;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: 0.2s ease;
        }

        .admin-options a:hover {
            background-color: #dcdcdc;
        }
    </style>
</head>
<body>
    <h2>Welcome, Admin <?= htmlspecialchars($_SESSION['admin_name']) ?>!</h2>
    <div class="admin-options">
        <a href="add_doctor.php">Add Doctor</a>
        <a href="edit_doctor.php">Edit Doctor</a>
        <a href="edit_appointment.php">Edit Appointment</a>
        <a href="edit_patient.php">Edit Patient</a>
        <a href="logout.php" class="logout-button">Logout</a>
    </div>
</body>
</html>
