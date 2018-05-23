<?php


require_once 'config.php';
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// $sd= $_POST['startday'];
// $ed= $_POST['endday'];

if (isset($_POST['startday']) && isset($_POST['endday'])) {
  $sql1="INSERT INTO GAMES
         SET
         GAMES.START_DAY =?,
         GAMES.END_DAY=?

 ";

 $stmt1=$link->prepare($sql1);
 $stmt1->bind_param('ss',
 $_POST['startday'],
 $_POST['endday']

  );
  $stmt1->execute();

}

$link->close();

// header('location: admin_page.php');


?>
