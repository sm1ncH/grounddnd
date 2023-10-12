<?php
require_once 'baza.php';
session_start();
$email = $_POST['email'];
$password = $_POST['geslo'];

echo $email;
echo $password;

$pdo = null; // Close the connection
?>
