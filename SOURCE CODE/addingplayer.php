<?php

  session_start();
require_once 'config.php';
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


  $PLTEAM_ID= $_SESSION['teamid'];

  $PLUSER_ID = $_POST['playerid'];


  $sql = "INSERT INTO PLAYER
            SET
            PLAYER.PLUSER_ID=?,
            PLAYER.PLTEAM_ID=?
              ";

  $stmt1=$link->prepare($sql);
  $stmt1->bind_param('ii',$PLUSER_ID,$PLTEAM_ID);

if ( $stmt1->execute()){
  $stmt1->close();

header('location: manager_page.php');
exit;

}



?>
