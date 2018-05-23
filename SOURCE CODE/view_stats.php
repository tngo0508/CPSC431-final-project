<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>View Stats</title>
  </head>
  <body>
    <?php

  require_once('./config.php');

  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if ($db === false) {
    die("ERROR: COULD NOT CONNECT. ".mysqli_connect_error());
  }

  $user_id = $_SESSION['id'];
  $query = "SELECT
  PLAYER_ID, FIRST_NAME, LAST_NAME, SGAME_ID, PLAYINGTIMEMIN, PLAYINGTIMESEC, POINTS, ASSISTS, REBOUNDS, THREE_POINTS, FTA, STEAL, FOUL, BLOCK, FTM
  FROM PLAYER P, STATS S , PROFILE, USERS
  WHERE P.PLAYER_ID = SPLAYER_ID AND PLUSER_ID = USER_ID AND USER_ID = PUSER_ID
  AND PLTEAM_ID = (SELECT TEAM_ID FROM TEAMS WHERE TMANAGER_ID= (SELECT MANAGER_ID FROM MANAGER WHERE MUSER_ID = ?)) ORDER BY SGAME_ID, P.PLAYER_ID";

  $stmt = $db->prepare($query);
  $stmt->bind_param('i', $user_id);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result(
    $player_id,
    $first_name,
    $last_name,
    $sgame_id,
    $playing_time_min,
    $playing_time_sec,
    $points,
    $assits,
    $rebounds,
    $three_points,
    $fta,
    $steal,
    $foul,
    $block,
    $ftm
  );
  ?>

  <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr class="info">
          <th scope="col">GAME</th>
          <th scope="col">PLAYER ID</th>
          <th scope="col">FIRST NAME</th>
          <th scope="col">LAST NAME</th>
          <th scope="col">MINUTE</th>
          <th scope="col">SECOND</th>
          <th scope="col">POINTS</th>
          <th scope="col">ASSISTS</th>
          <th scope="col">REBOUNDS</th>
          <th scope="col">THREE POINTS</th>
          <th scope="col">FTA</th>
          <th scope="col">STEAL</th>
          <th scope="col">FOUL</th>
          <th scope="col">BLOCK</th>
          <th scope="col">FTM</th>
        </tr>
      </thead>

      <?php
      $toggle = "table-active";
      $switch_color = false;

        while ($stmt->fetch()) {
          if ($switch_color) {
            $toggle = "table-success";
            $switch_color = false;
          } else {
            $toggle = "table-light";
            $switch_color = true;
          }
          echo "<tr class=\"$toggle\">\n";
          echo "<th scope=\"row\">".$sgame_id."</th>\n";
          echo "<td>".$player_id."</td>\n";
          echo "<td>".$first_name."</td>\n";
          echo "<td>".$last_name."</td>\n";
          echo "<td>".$playing_time_min."</td>\n";
          echo "<td>".$playing_time_sec."</td>\n";
          echo "<td>".$points."</td>\n";
          echo "<td>".$assits."</td>\n";
          echo "<td>".$rebounds."</td>\n";
          echo "<td>".$three_points."</td>\n";
          echo "<td>".$fta."</td>\n";
          echo "<td>".$steal."</td>\n";
          echo "<td>".$foul."</td>\n";
          echo "<td>".$block."</td>\n";
          echo "<td>".$ftm."</td>\n";
        }
       ?>

  </table>

  </body>
</html>
