<?php
session_start();

// clear session variable
$_SESSION = array();

// destroy sesstion on the server
session_destroy();

header("location: index.php");
exit;