<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->query("SELECT * FROM Patients");
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        h2 {
            color: #333;
        }

        .user-options {
            display: flex;
            flex-direction: column;
            max-width: 300px;
        }

        .user-options a {
            margin: 10px 0;
            padding: 10px;
            background-color: #f0f0f0;
            color: #000;
            text-decoration: none;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: 0.2s ease;
        }

        .user-options a:hover {
            background-color: #dcdcdc;
        }

        hr {
            border: 0;
            height: 1px;
            background-color: #ccc;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
    
    <div class="user-options">
        <a href="add_appointment.php">Add Appointment</a>
        <a href="prescriptions.php">View Prescriptions</a>
        <a href="billing.php">View Billing</a>
        <a href="add_patient.php">Add Patient</a>
        <!-- <a href="patient_details.php">Patient Details</a> -->
        <a href="logout.php">Logout</a>
    </div>

    <hr>

</body>
</html>
