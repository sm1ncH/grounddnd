<?php
require_once 'baza.php';
require_once 'cookie.php';

$e = $_POST['email'];
$p = $_POST['password'];

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->execute([$e, $p]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['ime'] = $row['ime'];
        $_SESSION['priimek'] = $row['priimek'];
        $_SESSION['email'] = $row['email'];
        echo "login";
        header("Location: index.php");
    } else {
        echo "login ne obstaja";
        header("Location: login.php");
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
