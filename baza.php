<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "airbnb";

// try {
//     $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(PDOException $e) {
//     die("Connection failed: " . $e->getMessage());
// }

$host='jure-p.eu';
$user= 'jurep_db';
$password='Jure2406';
$db='jurep_airbnb';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?> 
