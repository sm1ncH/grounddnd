<?php
require_once 'baza.php';
require_once 'cookie.php';

if (isset($_GET['id'])) {
    $property_id = $_GET['id'];
    $_SESSION['property_id'] = $property_id;
} else {
    die("Property ID not provided.");
}

// Initialize $dat_kon_max with a minimum date
$dat_kon_max = date("Y-m-d");

try {
    $sql = "SELECT * FROM bookings WHERE property_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$property_id]);

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/booking.css">
</head>
<body>
    <header>
        <?php
        require_once 'baza.php';
        require_once 'cookie.php';
        // profile icon svg link with link to profile.php
        if (isset($_SESSION['id'])) {
            echo "<a href='index.php'>Home</a>";
        }

        ?>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php
                $sql2 = "SELECT * FROM properties WHERE id = ?";
                $stmt2 = $pdo->prepare($sql);
                $stmt2->execute([$property_id]);

                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                $property_name2 = htmlspecialchars($row2['ime']);

                echo "<h1 class='text-center'>" . $property_name . "</h1>";

                $sql1 = "SELECT * FROM slike WHERE property_id = ?";
                $stmt1 = $pdo->prepare($sql1);
                $stmt1->execute([$property_id]);

                $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

                $picture_path = htmlspecialchars($row1['url']);

                echo "<img src='slike/" . $picture_path . "' alt='Property picture' width='30%' class='img-fluid'>";


                    ?>
                <h2 class="text-center">Bookings</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                // Get start and end dates from the database
                                $start_date = htmlspecialchars($row['dat_zac']);
                                $end_date = htmlspecialchars($row['dat_kon']);

                                // Ensure that the end date isn't before the start date
                                if ($end_date < $start_date) {
                                    // You can handle this case as per your requirements. Here, I'm simply continuing to the next iteration of the loop.
                                    continue;
                                }

                                // Output the dates in the table rows
                                echo "<tr>";
                                echo "<td>" . $start_date . "</td>";
                                echo "<td>" . $end_date . "</td>";
                                echo "</tr>";

                                // Update $dat_kon_max if necessary
                                if ($end_date > $dat_kon_max) {
                                    $dat_kon_max = $end_date;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <h2>Rezerviraj</h2>
        <form action="booking_add.php" method="post">
            <input type="date" name="date_start" min="<?php echo $dat_kon_max; ?>">
            <input type="date" name="date_end" min="<?php echo $dat_kon_max; ?>">
            <input type="submit" value="Rezerviraj">
        </form>
    </div>
    <?php
    require_once 'alerts.php';
    ?>
</body>
</html>
<?php
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
