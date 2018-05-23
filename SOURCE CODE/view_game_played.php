<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Game Playing</title>
  </head>
  <body>
  <?php
  require_once 'config.php';
  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  // Check connection
  if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  $query = "SELECT TEAM_ID FROM TEAMS WHERE TMANAGER_ID = (SELECT MANAGER_ID FROM MANAGER WHERE MUSER_ID = ?)";

  $stmt = $db->prepare($query);
  $stmt->bind_param('i', $user_id);
  $stmt->execute();
  $stmt->bind_result($_teamid);
  $stmt->fetch();
  $stmt->free_result();

  $query = "SELECT GAME_ID, START_DAY, END_DAY, SCORE FROM GAMES LEFT JOIN PLAY ON GAME_ID = PGAME_ID WHERE PTEAM_ID = ? AND SCORE IS NOT NULL";

  $stmt = $db->prepare($query);
  $stmt->bind_param('i', $_teamid);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result(
    $game_id,
    $start_day,
    $end_day,
    $score
  );
  ?>

  <table class="table table-bordered table-hover">
    <thead class="thead-dark">
      <tr class="info">
        <th scope="col">GAME ID</th>
        <th scope="col">START DAY</th>
        <th scope="col">END DAY</th>
        <th scope="col">SCORE</th>
      </tr>
  </thead>

  <?php

  $toggle = "table-active";
  $switch_color = false;
  while ($stmt->fetch()){
    if ($switch_color) {
        $toggle = "table-success";
        $switch_color = false;
      } else {
        $toggle = "table-light";
        $switch_color = true;
      }
    echo "<tr class=\"$toggle\">\n";
    echo "<th scope=\"row\">".$game_id."</th>\n";
    echo "<td>".$start_day."</td>\n";
    echo "<td>".$end_day."</td>\n";
    echo "<td>".$score."</td>\n";

    echo "</tr>";
  }
 ?>
</table>

  </body>
</html>
