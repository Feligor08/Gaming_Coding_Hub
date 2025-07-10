<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Willkommen, Admin!</h1>
    <p>Nur sichtbar für: <b>FelixFocus@outlook.de</b></p>
    <a href="logout.php">Logout</a>
</body>
</html>
