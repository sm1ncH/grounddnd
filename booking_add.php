<?php
//insert booking into database
include_once 'baza.php';
include_once 'cookie.php';

$date_end = $_POST['date_end'];
$date_start = $_POST['date_start'];
$property_id = $_SESSION['property_id'];
$user_id = $_SESSION['id'];
if ($date_end === "" || $date_start === "") {
    header("Location: booking.php?id=" . $property_id);
    exit();
}
else{try {
    $stmt = $pdo->prepare("INSERT INTO bookings (dat_zac, dat_kon, property_id, user_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$date_start, $date_end, $property_id, $user_id]);
    header("Location: index.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}}

?>