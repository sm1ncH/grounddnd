<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <header>
    <?php
       require_once 'baza.php';
       require_once 'cookie.php';
    if (!isset($_SESSION['id'])) {
        echo '<a href="loginpage.php">Login</a>';
        echo "<a href='signup.php'>signup</a>";
    } else {
        echo "<a href='logout.php'>logout</a>";
    }
    if (isset($_SESSION['id'])) {
        echo "<a href='add_property.php'>Add property</a>";
    }
    
    // profile icon svg link with link to profile.php
    if (isset($_SESSION['id'])) {
        echo "<a href='profile.php'><img src='slike/profile/user.png' id='user_icon'></a>";
    }
    if (isset($_SESSION['id'])) {
        if($_SESSION['id'] == 7){
        echo "<a href='admin.php'>Admin</a>";
        }
    }

    ?>
    </header>
<main id="main">
    <?php
    try {
        $stmt = $pdo->query('SELECT * FROM properties');
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div id="property">';
            $stmt2 = $pdo->prepare('SELECT * FROM slike WHERE property_id = ?');
            $stmt2->execute([$row['id']]);
            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                echo "<img src='slike/" . $row2['url'] . "'>";
            }
            echo "<div id='details'>";
            echo "<h3>", htmlspecialchars($row['ime']), "</h3>";
            echo "<p>", htmlspecialchars($row['metri']), " m</p>";
            echo "<p>", htmlspecialchars($row['cena']), " €</p>";
            if (isset($_SESSION['id'])) {
                echo "<a href='booking.php?id=" . $row['id'] . "'>Booking</a>";
            }
            if (isset($_SESSION['id'])) {
                if($_SESSION['id'] == 7){
                echo "<a href='edit_property.php?id=" . $row['id'] . "'>Edit</a>";
                echo "<a href='delete_property.php?id=" . $row['id'] . "'>Delete</a>";
                // echo check bookings on bookings.php
                echo "<a href='bookings.php?id=" . $row['id'] . "'>Bookings</a>";
                }
            }
            // if you made a property and your're not admin you can edit or delete it
            if (isset($_SESSION['id'])) {
                if($_SESSION['id'] == $row['user_id']){
                echo "<a href='edit_property.php?id=" . $row['id'] . "'>Edit</a>";
                echo "<a href='delete_property.php?id=" . $row['id'] . "'>Delete</a>";
                // echo check bookings on bookings.php
                echo "<a href='bookings.php?id=" . $row['id'] . "'>Bookings</a>";
                }
            }
            echo "</div>";
            echo "</div>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    </main>
    <?php
    require_once 'alerts.php';
    ?>
</body>
</html>
