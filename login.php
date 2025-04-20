<?php
session_start();
require 'config/db.php';

// Initialize error variable
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // User Login (Hashed)
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM Users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }

    // Admin Login (Plain text)
    if (isset($_POST['AdminID1']) && isset($_POST['password1'])) {
        $adminID = $_POST['AdminID1'];
        $password1 = $_POST['password1'];

        $stmt = $conn->prepare("SELECT * FROM Admin WHERE AdminID = :adminid");
        $stmt->execute(['adminid' => $adminID]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            if ($password1 == $admin['password']) {
                $_SESSION['admin_id'] = $admin['AdminID'];
                $_SESSION['admin_name'] = $admin['AdminName'];
                header("Location: admin.php");
                exit();
            } else {
                $error = "Invalid admin ID or password.";
            }
        } else {
            $error = "Admin not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Hospital Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 400px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h1, h2, h3 {
            text-align: center;
            color: #333;
        }

        input[type="text"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4285f4;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #3367d6;
        }

        .error {
            color: red;
            text-align: center;
        }

        .link {
            text-align: center;
            margin-top: 15px;
        }

        .link a {
            color: #4285f4;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }

        .section {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Patient Management System</h1>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <div class="section">
            <h2>User Login</h2>
            <form method="POST">
                <input type="text" name="username" required placeholder="Username">
                <input type="password" name="password" required placeholder="Password">
                <button type="submit">Login</button>
            </form>
        </div>

        <div class="section">
            <h2>Admin Login</h2>
            <form method="POST">
                <input type="number" name="AdminID1" required placeholder="Admin ID">
                <input type="password" name="password1" required placeholder="Password">
                <button type="submit">Login</button>
            </form>
        </div>

        <div class="link">
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            <p>To see doctor information, <a href="doctors.php">Click here</a></p>
        </div>
    </div>
</body>
</html>
