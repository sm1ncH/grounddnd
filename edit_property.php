<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/edit_property.css">
</head>
<body>
<?php
require_once 'baza.php';
require_once 'cookie.php';

if (!isset($_SESSION['id'])) {
    echo "nisi prijavljen";
} else {
    echo "<a href='index.php'>Home</a>";
}

$id = $_GET['id'];

try {
    // Select property information from the 'properties' table
    $stmt = $pdo->prepare("SELECT * FROM properties WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<form action="edit_property2.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="text" name="ime" value="<?php echo htmlspecialchars($row['ime']); ?>">
    <input type="text" name="metri" value="<?php echo htmlspecialchars($row['metri']); ?>">
    <input type="text" name="cena" value="<?php echo htmlspecialchars($row['cena']); ?>">
    <input type="submit" value="Submit">
</form>
<?php
    require_once 'alerts.php';
?>

</body>
</html>
