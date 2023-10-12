<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/signup.css">
</head>
<body>
<?php
  include_once 'libraries/vendor/autoload.php';
  session_start();
  $google_client = new Google_Client();

  $google_client->setClientId('440118314532-k45ih6qshpfj71i72j5ihjlqu5pqh3i9.apps.googleusercontent.com');

  $google_client->setClientSecret('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');

  $google_client->SetRedirectUri('https://grounddnd.jure-p.eu/googlelogin.php'); 

  $google_client->addScope('email');

  $google_client->addScope('profile');
  ?>
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
    <p>Lahko se tudi prijaviš z Google računom: <a href = "<?php echo $google_client->createAuthUrl()?>">Prijavi se z Google računom</a>
</body>
<?php
    require_once 'alerts.php';
    ?>
</html>





