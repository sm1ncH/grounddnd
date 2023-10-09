<!-- deletes booking from bookings.php -->
<?php
require_once 'baza.php';
require_once 'cookie.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$booking_id = $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->execute([$booking_id]);
    setcookie('alert', 'Booking deleted successfully');
    setcookie('good', 1);
    header("Location: index.php");
} catch (PDOException $e) {
    setcookie('alert', 'Error: ' . $e->getMessage());
    setcookie('error', 1);
    header("Location: index.php");
}
?>