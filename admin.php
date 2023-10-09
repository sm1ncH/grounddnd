<!-- page where there are all users listed -->
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
    <title>Admin</title>
    <link rel="stylesheet" href="style/admin.css">
</head>
<body>
    <div id="row">
<?php
try {
    $stmt = $pdo->query("SELECT * FROM users");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div id='user'>";
        echo "<p>", htmlspecialchars($row['name']), "</p>";
        echo "<p>", htmlspecialchars($row['surname']), "</p>";
        echo "<p>", htmlspecialchars($row['email']), "</p>";
        echo "<p>", htmlspecialchars($row['password']), "</p>";
        echo "<button><a href='delete_user.php?id=" . $row['id'] . "'>Delete</a></button>";
        echo "</div>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<?php
    require_once 'alerts.php';
    ?>
</div>
</body>
</html>
