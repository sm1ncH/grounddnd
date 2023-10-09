<?php
require_once 'baza.php';
require_once 'cookie.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/add_property.css">
</head>
<body>
    <form action="add_p_second.php" method="post" enctype="multipart/form-data">
    <input type="text" name="ime" placeholder="ime">
    <input type="text" name="metri" placeholder="metri">
    <input type="number" name="cena" placeholder="cena">
    <select name="kraj_id" id="">
        <?php
        try {
            $stmt = $pdo->prepare('SELECT * FROM kraji');
            $stmt->execute();
            $kraji = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($kraji as $row) {
                echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['ime']) . "</option>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </select>
    <input type="file" name="slika[]" accept=".png, .jpg" required multiple/>
    <input type="submit" name="submit" placeholder="submit">
    </form>
</body>
</html>
