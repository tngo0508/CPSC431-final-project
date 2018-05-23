<?php


require_once 'config.php';
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


if (isset($_GET['id'])){

  $id= $_GET['id'];
  }
else{
  echo " getting id from vr fail";
}

$sql = "DELETE FROM PLAYER WHERE PLAYER.PLAYER_ID = ? LIMIT 1";
$stmt=$link->prepare($sql);
$stmt->bind_param("i", $id);
if($stmt->execute()){

    $stmt->close();

    header("location: manager_page.php");

    exit;


}

?>
