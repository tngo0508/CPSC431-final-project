<?php
session_start();

$ID       = (int) $_POST['user_id'];
$type     = trim( preg_replace("/\t|\R/",' ',$_POST['type']) );



if( ! empty($ID ))
{
  require_once( 'config.php' );
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  // Check connection
  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }



  $sql ="UPDATE USERS

         SET USERS.TYPE = ?

         WHERE

         USERS.USER_ID  = '$ID'
          ";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('s', $type);
    $stmt->execute();


  if($type === "A"){
    $stmt->execute();

    echo 'promote successfully';

    header('location: admin_page.php');
    exit;
  } elseif ($type === "M") {
    $query = "INSERT INTO MANAGER (MUSER_ID) VALUES (?)";
    $stmt = $link->prepare($query);
    $stmt->bind_param('i', $ID);
    $stmt->execute();

    echo 'promote successfully';
    header('location: admin_page.php');

    exit;
  }
  elseif ($type === "P") {
    $stmt->execute();

    echo 'promote successfully';
    header('location: player_page.php');

    exit;
  }
  else {
    echo 'There is an error. Cannot promote user with '.$ID."\n";
  }


}

?>
