<?php
require_once 'baza.php';

$n = $_POST['name'];
$s = $_POST['surname'];
$e = $_POST['email'];
$p = $_POST['password'];
$k = $_POST['kraj_id'];
$ph = $_POST['phone'];
$google_id = $_SESSION['google_id'];

// Hash the password
$hashedPassword = password_hash($p, PASSWORD_DEFAULT);

try {
    // Check if the user already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$e]);
    $rowCount = $stmt->rowCount();

    if ($rowCount == 1) {
        setcookie('alert', "Uporabnik že obstaja.");
        setcookie('error', 1);
        header("Location: signup.html");
        exit; // Make sure you exit after a header redirect
    } else {
        // Insert hashed password instead of plain password
        $stmt = $pdo->prepare("INSERT INTO users (name, surname, email, password, kraj_id, phone, google_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$n, $s, $e, $hashedPassword, $k, $ph, $google_id]);
        setcookie('alert', "Registracija uspešna!");
        setcookie('good', 1);
        header("Location: index.php");
        exit; // Make sure you exit after a header redirect
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>