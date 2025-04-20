<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->query("SELECT A.*, P.name AS patient_name, D.name AS doctor_name 
                      FROM Appointments A
                      JOIN Patients P ON A.patient_id = P.patient_id
                      JOIN Doctors D ON A.doctor_id = D.doctor_id
                      ORDER BY A.date DESC");
$appointments = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head><title>Appointments</title></head>
<body>
    <h2>Appointment List</h2>
    <a href="add_appointment.php">Schedule New Appointment</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th><th>Patient</th><th>Doctor</th><th>Date</th><th>Time</th><th>Status</th><th>Action</th>
        </tr>
        <?php foreach ($appointments as $appt): ?>
        <tr>
            <td><?= $appt['appointment_id'] ?></td>
            <td><?= $appt['patient_name'] ?></td>
            <td><?= $appt['doctor_name'] ?></td>
            <td><?= $appt['date'] ?></td>
            <td><?= $appt['time'] ?></td>
            <td><?= $appt['status'] ?></td>
            <td>
                <a href="edit_appointment.php?id=<?= $appt['appointment_id'] ?>">Edit</a> |
                <a href="delete_appointment.php?id=<?= $appt['appointment_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
