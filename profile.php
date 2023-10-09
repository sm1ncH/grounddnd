<!-- your profile page where you can upload your photo and change your name and such -->
<?php
require_once 'baza.php';
require_once 'cookie.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileError = $_FILES['file']['error'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = ['jpg', 'jpeg', 'png'];

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            $fileNameNew = $_SESSION['id'] . "." . $fileActualExt;
            $fileDestination = 'slike/profile/' . $fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
            $sql = "UPDATE users SET profile_picture = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$fileNameNew, $_SESSION['id']]);
            header("Location: profile.php");
            exit();
        } else {
            echo "There was an error uploading your file.";
        }
    } else {
        echo "You cannot upload files of this type.";
    }
}

if (isset($_POST['submit2'])) {
    $ime = $_POST['ime'];
    $priimek = $_POST['priimek'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $id = $_SESSION['id'];

    $sql = "UPDATE users SET ime = ?, priimek = ?, email = ?, telefon = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ime, $priimek, $email, $telefon, $id]);
    header("Location: profile.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="style/profile.css">
</head>
<body>
    <header>
        <?php
        require_once 'baza.php';
        require_once 'cookie.php';
        if (!isset($_SESSION['id'])) {
            echo '<a href="login.html">Login</a>';
            echo "<a href='signup.php'>signup</a>";
        } else {
            echo "<a href='logout.php'>logout</a>";
        }
        if (isset($_SESSION['id'])) {
            echo "<a href='add_property.php'>Add property</a>";
        }
        
        // profile icon svg link with link to profile.php
        if (isset($_SESSION['id'])) {
            echo "<a href='index.php'>Home</a>"; }

        ?>
    </header>
    <main>
        <div id="profile">
            <div id="profile_details">
            <?php
                $sql = "SELECT * FROM users WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$_SESSION['id']]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <form action="profile.php" method="post">
                    <label for="ime">Name:</label>
                    <input type="text" name="ime" value="<?php echo htmlspecialchars($row['name']); ?>">
                    <label for="priimek">Surname:</label>
                    <input type="text" name="priimek" value="<?php echo htmlspecialchars($row['surname']); ?>">
                    <label for="email">Email:</label>
                    <input type="text" name="email" value="<?php echo htmlspecialchars($row['email']); ?>">
                    <label for="telefon">Phone number:</label>
                    <input type="text" name="telefon" value="<?php echo htmlspecialchars($row['phone']); ?>">
                    <button type="submit" name="submit2">Save</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
