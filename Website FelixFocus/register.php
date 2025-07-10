$token = bin2hex(random_bytes(16));
$stmt = $conn->prepare("INSERT INTO users (email, password, verification_token) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $password, $token);

if ($stmt->execute()) {
    $link = "http://yourdomain.com/verify.php?token=" . $token;
    mail($email, "E-Mail bestätigen", "Bitte klicke auf diesen Link: $link");
    echo "Bestätigungslink gesendet!";
}
