<?php
require_once 'baza.php';
session_start();
$email = $_POST['email'];
$password = $_POST['geslo'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]); // Pass parameters as an array
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result !== false) {
    $hash = $result['geslo'];
    if (password_verify($password, $hash)) {
        $sql = "UPDATE users SET google_id = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['google_id'], $result['id']]);

        $_SESSION['id'] = $row['id'];
        $_SESSION['ime'] = $row['ime'];
        $_SESSION['priimek'] = $row['priimek'];
        $_SESSION['email'] = $row['email'];
        setcookie('prijava', "Prijava uspešna.");
        setcookie('good', 1);
        $_SESSION["googleregister"] = 0;
        header('Location: index.php');
        exit();
    } 
    else {
        setcookie('prijava', "Napačno geslo.");
        setcookie('error', 1);
        header('Location: google_addmail.php');
        exit();
    }
} else {
    setcookie('prijava', "Uporabnik z tem mailom ne obstaja.");
    setcookie('error', 1);
    header('Location: google_addmail.php');
    exit();
}

$pdo = null; // Close the connection
?>
