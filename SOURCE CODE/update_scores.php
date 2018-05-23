<?php
  session_start();
  $game_id =(int)$_POST['score-gameid'];
  $team_id = (int)$_POST['score-teamid'];
  $score = (int)$_POST['edit-score'];
  echo "$game_id

$team_id

$score
  ";
  require_once('./config.php');



  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if ($db === false) {
    die("ERROR: COULD NOT CONNECT. ".mysqli_connect_error());
  }



$query = "UPDATE PLAY

          SET
          SCORE=?
          WHERE PGAME_ID = '$game_id' AND PTEAM_ID = '$team_id'
          ";


$stmt=$db->prepare($query);
$stmt->bind_param('i',

    $score

);
 if($stmt->execute()){


  header('location: admin_page.php');
 exit;

 }

$stmt->close();








 ?>
