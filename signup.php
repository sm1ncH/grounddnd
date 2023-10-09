<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/signup.css">
</head>
<body>
    <form action="signup_insert.php" method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="surname" placeholder="Surname" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <select name="kraj_id" required> <!-- Use name="kraj_id" -->
            <option value="nikraja">Izberi kraj</option>
            <?php
            require_once "baza.php";
            $query = "SELECT * FROM kraji;";
            $stmt = $pdo->query($query);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['id'] . "'>" . $row['ime'] . "</option>";
            }
            ?>
        </select>
        <input type="text" name="phone" placeholder="Phone" >
        <input type="submit" name="submit" value="Sign Up" />
    </form>
</body>
<?php
    require_once 'alerts.php';
    ?>
</html>





