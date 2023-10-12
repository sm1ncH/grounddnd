<?php
require_once 'baza.php';
session_start();
$email = $_POST['email'];
$password = $_POST['geslo'];
$google_id = $_SESSION['google_id'];

try {
    // Select just the password from the database for the given email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        if (password_verify($p, $row['password'])) {
            // Successful login, password matches hash
            $stmt = $pdo->prepare("UPDATE users SET google_id = ? WHERE id = ?");
            $stmt->execute([$google_id, $row['id']]);
            $_SESSION['id'] = $row['id'];
            $_SESSION['ime'] = $row['ime'];
            $_SESSION['priimek'] = $row['priimek'];
            $_SESSION['email'] = $row['email'];
            setcookie('alert', "Prijava uspešna!");
            setcookie('good', 1);
            header("Location: index.php");
            exit(); // Make sure to exit after a header redirect
        } else {
            // Invalid login credentials
            setcookie('alert', "Napačno geslo.");
            setcookie('error', 1);
            header("Location: index.php");
            exit(); // Make sure to exit after a header redirect
        }
    } else {
        setcookie('alert', "Uporabnik ne obstaja.");
        setcookie('error', 1);
        header("Location: index.php");
        exit(); // Make sure to exit after a header redirect
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null; // Close the connection
?>
