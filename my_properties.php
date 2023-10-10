<!-- display my properties where i can edit them delete them and see bookings -->
<?php
require_once 'baza.php';
require_once 'cookie.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My properties</title>
    <link rel="stylesheet" href="style/my_properties.css">
    <link rel="stylesheet" href="style/my_properties.css">
</head>
<body>
    <div id="row">
<?php
try {
    $stmt = $pdo->query("SELECT * FROM properties WHERE user_id = " . $_SESSION['id']);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div id='property'>";
        $stmt2 = $pdo->prepare('SELECT * FROM slike WHERE property_id = ?');
        $stmt2->execute([$row['id']]);
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            echo "<img src='slike/" . $row2['url'] . "'>";
        }
        echo "<div id='details'>";
        echo "<h3>", htmlspecialchars($row['ime']), "</h3>";
        echo "<p>", htmlspecialchars($row['metri']), " m</p>";
        echo "<p>", htmlspecialchars($row['cena']), " €</p>";
        echo "<a href='edit_property.php?id=" . $row['id'] . "'>Edit</a>";
        echo "<a href='delete_property.php?id=" . $row['id'] . "'>Delete</a>";
        echo "</div>";
        echo "</div>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>