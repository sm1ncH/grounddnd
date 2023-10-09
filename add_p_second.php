<?php
require_once 'baza.php';
require_once 'cookie.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$ime = $_POST['ime'];
$metri = $_POST['metri'];
$cena = $_POST['cena'];
$kraj_id = $_POST['kraj_id'];
$user_id = $_SESSION['id'];

try {
    $stmt = $pdo->prepare("INSERT INTO properties (`ime`, `metri`, `cena`, `user_id`, `kraj_id`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $ime);
    $stmt->bindParam(2, $metri);
    $stmt->bindParam(3, $cena);
    $stmt->bindParam(4, $user_id);
    $stmt->bindParam(5, $kraj_id);

    if ($stmt->execute()) {
        $propertyId = $pdo->lastInsertId();

        // Handle multiple image uploads
        if (!empty($_FILES['slika']['name'][0])) {
            $imageUploadDir = 'slike/';
            $uploadedImageIds = [];

            foreach ($_FILES['slika']['tmp_name'] as $key => $imageTmpPath) {
                $imageName = $_FILES['slika']['name'][$key];
                $imageSize = $_FILES['slika']['size'][$key];
                $imageType = $_FILES['slika']['type'][$key];
                $imageNameCmps = explode(".", $imageName);
                $imageExtension = strtolower(end($imageNameCmps));
                $allowedExtensions = ["jpg", "jpeg", "png", "gif"]; // Add more as needed

                // Validate file type and extension
                if (in_array($imageExtension, $allowedExtensions) && getimagesize($imageTmpPath)) {
                    $newImageFileName = md5(time() . $imageName) . '.' . $imageExtension;
                    $destImagePath = $newImageFileName;

                    if (move_uploaded_file($imageTmpPath, $destImagePath)) {
                        // Insert each image into the 'slika' table
                        $slika_id = insertSlika($pdo, $destImagePath);

                        if ($slika_id !== false) {
                            // Store the uploaded image IDs
                            $uploadedImageIds[] = $slika_id;
                        }
                    }
                } else {
                    // Handle invalid file types or extensions
                    // You can set an error message and redirect here
                }
            }

            // Update the 'slika' table with property IDs for each image
            if (!empty($uploadedImageIds)) {
                $updateImagesSql = "UPDATE slike SET property_id = :propertyId WHERE id IN ("
                    . implode(",", $uploadedImageIds) . ")";
                $stmt3 = $pdo->prepare($updateImagesSql);
                $stmt3->bindParam(':propertyId', $propertyId, PDO::PARAM_INT);

                if ($stmt3->execute()) {
                    setcookie('prijava', "Hvala za objavo!");
                    setcookie('good', 1);
                    header('Location: index.php');
                    exit();
                } else {
                    setcookie('prijava', "Error: " . $stmt3->errorInfo()[2]);
                    setcookie('error', 1);
                    header('Location: index.php');
                    exit();
                }
            }
        } else {
            setcookie('prijava', 'Hvala za objavo!');
            setcookie('good', 1);
            header('Location: index.php');
            exit();
        }
    } else {
        setcookie('prijava', "Error: " . $stmt->errorInfo()[2]);
        setcookie('error', 1);
        header('Location: index.php');
        exit();
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

function insertSlika($conn, $url) {
    $slikaSql = "INSERT INTO slike (url) VALUES (:url)";
    $stmt = $conn->prepare($slikaSql);
    $stmt->bindParam(':url', $url, PDO::PARAM_STR);

    if ($stmt->execute()) {
        return $conn->lastInsertId();
    } else {
        return false;
    }
}
?>
