<html>

<head>
    <link rel="stylesheet" href="style/bookings.css">
</head>
<?php
require_once 'baza.php';
require_once 'cookie.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$property_id = $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE property_id = ?");
    $stmt->execute([$property_id]);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $stmt2 = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt2->execute([$row['user_id']]);
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            echo "<p>", htmlspecialchars($row2['name']), "</p>";
            echo "<p>", htmlspecialchars($row2['surname']), "</p>";
            // date
            echo "<p>", htmlspecialchars($row['dat_zac']), "</p>";
            echo "<p>", htmlspecialchars($row['dat_kon']), "</p>";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
</html>