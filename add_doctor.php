<?php
session_start();
require 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO Doctors (name, specialization, contact, availability_status) VALUES (:name, :specialization, :contact, :status)");
    $stmt->execute([
        'name' => $_POST['name'],
        'specialization' => $_POST['specialization'],
        'contact' => $_POST['contact'],
        'status' => $_POST['status']
    ]);
    header("Location: doctors.php");
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Doctor</title>
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
    <h2>Add New Doctor</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="text" name="specialization" placeholder="Specialization"><br>
        <input type="text" name="contact" placeholder="Contact" required><br>
        <select name="status">
            <option value="Available">Available</option>
            <option value="Unavailable">Unavailable</option>
        </select><br>
        <button type="submit">Add Doctor</button>
    </form>
</body>
</html>
