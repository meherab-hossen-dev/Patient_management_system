<?php
session_start();
require 'config/db.php';

if (!isset($_GET['id'])) {
    echo "Patient ID missing.";
    exit();
}

$patient_id = $_GET['id'];

// Get patient details
$stmt = $conn->prepare("SELECT * FROM Patients WHERE patient_id = :id");
$stmt->execute(['id' => $patient_id]);
$patient = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$patient) {
    echo "Patient not found.";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE Patients SET name = :name, age = :age, contact = :contact, address = :address, medical_history = :medical_history WHERE patient_id = :id");
    $stmt->execute([
        'name' => $_POST['name'],
        'age' => $_POST['age'],
        'contact' => $_POST['contact'],
        'address' => $_POST['address'],
        'medical_history' => $_POST['medical_history'],
        'id' => $patient_id
    ]);

    header("Location: edit_patients.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
        }
        input, textarea {
            width: 300px;
            padding: 10px;
            margin: 10px 0;
        }
        button {
            padding: 10px 20px;
        }
    </style>
</head>
<body>

    <h2>Edit Patient</h2>

    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($patient['name']) ?>" required><br>

        <label>Age:</label><br>
        <input type="number" name="age" value="<?= $patient['age'] ?>" required><br>

        <label>Contact:</label><br>
        <input type="text" name="contact" value="<?= htmlspecialchars($patient['contact']) ?>" required><br>

        <label>Address:</label><br>
        <input type="text" name="address" value="<?= htmlspecialchars($patient['address']) ?>" required><br>

        <label>Medical History:</label><br>
        <textarea name="medical_history"><?= htmlspecialchars($patient['medical_history']) ?></textarea><br>

        <button type="submit">Update Patient</button>
    </form>

</body>
</html>
