<?php
session_start();

// Protect the page
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome to the Dashboard</h2>
<p>Welcome, <?php echo $_SESSION['student_id']; ?>!</p>

<nav>
    <a href="dashboard.php">Dashboard</a> |
    <a href="logout.php">Logout</a>
</nav>

</body>
</html>
