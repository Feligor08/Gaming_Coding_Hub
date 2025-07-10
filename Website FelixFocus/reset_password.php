<?php
include 'db.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $stmt = $conn->prepare("SELECT email FROM users WHERE reset_token = ? AND reset_expires > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newpass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, reset_expires=NULL WHERE reset_token=?");
            $stmt->bind_param("ss", $newpass, $token);
            $stmt->execute();
            echo "Passwort aktualisiert!";
        } else {
            echo '<form method="POST">
                    <h2>Neues Passwort</h2>
                    <input type="password" name="password" required>
                    <button type="submit">Zurücksetzen</button>
                  </form>';
        }
    } else {
        echo "Ungültiger oder abgelaufener Token.";
    }
}
?>
