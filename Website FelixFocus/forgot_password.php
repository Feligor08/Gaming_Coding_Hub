<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(16));
    $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

    $stmt = $conn->prepare("UPDATE users SET reset_token=?, reset_expires=? WHERE email=?");
    $stmt->bind_param("sss", $token, $expires, $email);
    $stmt->execute();

    $link = "http://yourdomain.com/reset_password.php?token=" . $token;

    mail($email, "Passwort zurücksetzen", "Hier ist dein Link zum Zurücksetzen: $link");

    echo "E-Mail gesendet!";
}
?>

<form method="POST">
    <h2>Passwort vergessen</h2>
    <input type="email" name="email" required>
    <button type="submit">Link senden</button>
</form>
