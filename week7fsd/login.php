<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare(
        "SELECT password_hash FROM students WHERE student_id = ?"
    );
    $stmt->execute([$student_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $storedHash = $result['password_hash'];

        if (password_verify($password, $storedHash)) {
            $_SESSION['logged_in'] = true;
            $_SESSION['student_id'] = $student_id;

            header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Student not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>

<form method="post">
    <input type="text" name="student_id" placeholder="Student ID" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>
</body>
</html>
