<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Miha Šafranko"/>
	<meta name="author" content="Miha Šafranko" />
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/navbar.css">
    <title>Registracija</title>
</head>
<body>
  <?php
  session_start();
  ?>
  <div class='content-below-navbar'>
  <br>
  <div class = "container">
    <h1>Registracija</h1>
    <p>Potrebno je še izpolniti dodatna polja:</p>
 <form action="google_register_insert.php" method="post">
  <input type="text" name="name" placeholder="Name" required value = "<?php echo $_SESSION['ime'] ?>">
        <input type="text" name="surname" placeholder="Surname" required value = "<?php echo $_SESSION['priimek'] ?>">
        <input type="email" name="email" placeholder="Email" required value = "<?php echo $_SESSION['email'] ?>">
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
<p>Ste že uporabnik? <a href = "loginpage.php">Pojdite na prijavo</a>
  </div>
  <div id="loginWindow">
    <?php
    include_once "alerts.php";
    ?>
</body>
</html>