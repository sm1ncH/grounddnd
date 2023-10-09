<?php
// require_once 'baza.php';
// require_once 'cookie.php';

// $e = $_POST['email'];
// $p = $_POST['password'];

// try {
//     $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
//     $stmt->execute([$e, $p]);
//     $row = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($row) {
//         $_SESSION['id'] = $row['id'];
//         $_SESSION['ime'] = $row['ime'];
//         $_SESSION['priimek'] = $row['priimek'];
//         $_SESSION['email'] = $row['email'];
//         echo "login";
//         header("Location: index.php");
//     } else {
//         echo "login ne obstaja";
//         header("Location: login.php");
//     }
// } catch (PDOException $e) {
//     echo "Error: " . $e->getMessage();
// }
?>
<?php
require_once 'baza.php';
require_once 'cookie.php';

$e = $_POST['email'];
$p = $_POST['password'];

try {
    // Select just the password from the database for the given email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$e]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($p, $row['password'])) {
        // Successful login, password matches hash
        $_SESSION['id'] = $row['id'];
        $_SESSION['ime'] = $row['ime'];
        $_SESSION['priimek'] = $row['priimek'];
        $_SESSION['email'] = $row['email'];
        echo "login";
        header("Location: index.php");
    } else {
        // Invalid login credentials
        echo "login ne obstaja";
        header("Location: login.php");
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
