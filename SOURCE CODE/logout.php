<?php
session_start();

$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: welcome.php");
// the script execution is not terminated. Setting another header alone is not enough to redirect.
exit;
?>
