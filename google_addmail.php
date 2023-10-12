<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google povezava</title>
</head>
<body>
<?php
session_start();
include_once "alerts.php"; // Include this at the beginning
?>

<div class='content-below-navbar'>
    <br>
    <div class="container">
        <h1>Google povezava</h1>
        <p>Poveži svoj trenutni račun z svojim Google računom za lažjo prijavo:</p>
        <form action="googlelink.php" method="post">
            <label for="email">Mail:</label>
            <input type="text" id="email" name="email" required readonly value="<?php echo $_SESSION['email'] ?>"><br><br>
            <label for="geslo">Geslo:</label>
            <input type="password" id="geslo" name="geslo" required><br><br>
            <input type="submit" value="Pošlji">
        </form>
        <p>Nočeš povezati računa? <a href="login.php">Pojdi na prijavo</a></p>
    </div>
</div>

</body>
</html>
