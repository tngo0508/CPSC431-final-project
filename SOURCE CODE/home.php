<?php
  session_start();

  if ($_SESSION['type'] == 'U') {
       header("location: regular_page.php");
       exit;
  } elseif ($_SESSION['type'] == 'M') {
    header("location: manager_page.php");
    exit;
  } elseif ($_SESSION['type'] == 'A') {
    header("location: admin_page.php");
    exit;
  } else {
    $_SESSION = array();
       session_destroy();
    header("location: welcome.php");
    exit;

  }

 ?>
