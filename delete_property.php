<?php
require_once 'baza.php';
require_once 'cookie.php';

if (!isset($_SESSION['id'])) {
    echo "nisi prijavljen";
} else {
    echo "<a href='logout.php'>logout</a>";
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        //delete bookings from property
        $stmt = $pdo->prepare("DELETE FROM bookings WHERE property_id = ?");
        $stmt->execute([$id]);
        // Delete associated images from the 'slike' table
        $stmt = $pdo->prepare("DELETE FROM slike WHERE property_id = ?");
        $stmt->execute([$id]);
        // Delete property from the 'properties' table
        $stmt = $pdo->prepare("DELETE FROM properties WHERE id = ?");
        $stmt->execute([$id]);
        setcookie('alert', 'Property deleted successfully');
        setcookie('good', 1);
        header("Location: index.php");
    } catch (PDOException $e) {
        setcookie('alert', 'Error: ' . $e->getMessage());
        setcookie('error', 1);
        header("Location: index.php");
    }
}
?>
