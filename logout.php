<?php
// initialize the session
ob_start();
session_start();

// unsets the session variables
$_SESSION = array();

// destroys that aforementioned session
session_destroy();

// redirects to login page
header("location: login");
?>
