<?php
require_once 'cookie.php';
session_destroy();
header("Location:index.php");
?>