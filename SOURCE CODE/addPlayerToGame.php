<?php
session_start();
  require_once 'config.php';
  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if ($db === false) {
    die("ERROR: COULD NOT CONNECT".mysqli_connect_error());
  }

  if (isset($_GET['player_id']) && isset($_GET['game_id'])) {
    $player_id = $_GET['player_id'];
    $game_id = $_GET['game_id'];
    echo "$player_id\n";
    echo "$game_id";
    $query = "INSERT INTO STATS (SPLAYER_ID, SGAME_ID) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ii', $player_id, $game_id);
    $stmt->execute();

    // if ($stmt->affected_rows > 0) {
    //   echo 'add player to stats table successfully';
    // } else {
    //   echo 'an error has occurred';
    // }
    $db->close();

    header("location: manager_page.php#$player_id-$game_id");
    exit;

  }
  $db->close();



 ?>
