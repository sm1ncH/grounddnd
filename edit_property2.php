<?php
require_once 'baza.php';
require_once 'cookie.php';

if (!isset($_SESSION['id'])) {
    echo "nisi prijavljen";
} else {
    echo "<a href='logout.php'>logout</a>";
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $ime = $_POST['ime'];
    $metri = $_POST['metri'];
    $cena = $_POST['cena'];

    try {
        // Update property information in the 'properties' table using prepared statement
        $stmt = $pdo->prepare("UPDATE properties SET ime = ?, metri = ?, cena = ? WHERE id = ?");
        $stmt->execute([$ime, $metri, $cena, $id]);
        setcookie('alert', 'Property updated successfully');
        setcookie('good', 1);
        header("Location: index.php");
    } catch (PDOException $e) {
        setcookie('alert', 'Error: ' . $e->getMessage());
        setcookie('error', 1);
        header("Location: index.php");
    }
}
?>
