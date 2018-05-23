<?php
  require_once 'config.php';
  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if ($db === false) {
    die("ERROR: COULD NOT CONNECT".mysqli_connect_error());
  }
$id ="";
$na ="";


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['TMANAGER_ID']) && isset($_POST['TEAM_NAME'])) {
    $id = (int) $_POST['TMANAGER_ID'];
    $na = (string) $_POST['TEAM_NAME'];


  $query = "INSERT INTO TEAMS (TMANAGER_ID, TEAM_NAME) VALUES (?, ?)";



  $stmt= $db->prepare($query);
  $stmt->bind_param('is',
  $id,
  $na
);
  if ($stmt->execute()){
  $db->close();
}
}
 ?>
