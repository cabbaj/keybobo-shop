<?php
session_start();

// clear session variable
$_SESSION = array();

// destroy session on the server
session_destroy();

header("location: index.php");
exit;