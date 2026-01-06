<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare(
        "INSERT INTO students (student_id, full_name, password_hash) VALUES (?, ?, ?)"
    );

    if ($stmt->execute([$student_id, $name, $hashedPassword])) {
        header("Location: login.php");
        exit;
    } else {
        echo "Registration failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h2>Student Registration</h2>

<form method="post">
    <input type="text" name="student_id" placeholder="Student ID" required><br><br>
    <input type="text" name="name" placeholder="Name" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Register</button>
</form>
</body>
</html>
