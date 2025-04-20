<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO Patients (name, age, contact, address, medical_history) 
                            VALUES (:name, :age, :contact, :address, :medical_history)");
    $stmt->execute([
        'name' => $_POST['name'],
        'age' => $_POST['age'],
        'contact' => $_POST['contact'],
        'address' => $_POST['address'],
        'medical_history' => $_POST['medical_history']
    ]);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Patient</title>
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
    <h2>Add Patient</h2>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="number" name="age" placeholder="Age" required><br>
        <input type="text" name="contact" placeholder="Contact" required><br>
        <textarea name="address" placeholder="Address" required></textarea><br>
        <textarea name="medical_history" placeholder="Medical History" required></textarea><br>
        <button type="submit">Add Patient</button>
    </form>
</body>
</html>
