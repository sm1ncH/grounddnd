<?php
require_once 'cookie.php';
session_destroy();
session_start();
setcookie('alert', "Odjava uspešna!");
setcookie('good', 1);
header("Location:index.php");
?>