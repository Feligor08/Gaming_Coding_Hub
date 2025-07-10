<?php
include 'db.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $stmt = $conn->prepare("UPDATE users SET verified=1 WHERE verification_token=?");
    $stmt->bind_param("s", $token);
    if ($stmt->execute()) {
        echo "E-Mail erfolgreich verifiziert!";
    } else {
        echo "Fehler beim Verifizieren.";
    }
}
?>
