<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>View Stats</title>
  </head>
  <body>
    <?php

  require_once('./config.php');
  require_once('Address.php');
  require_once('PlayerStatistic.php');

  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if ($db === false) {
    die("ERROR: COULD NOT CONNECT. ".mysqli_connect_error());
  }

  $query = "SELECT  FIRST_NAME, LAST_NAME, SGAME_ID, SUM(PLAYINGTIMEMIN), SUM(PLAYINGTIMESEC), AVG(POINTS), AVG(ASSISTS), AVG(REBOUNDS), AVG(THREE_POINTS), AVG(FTA), AVG(STEAL), AVG(FOUL), AVG(BLOCK), AVG(FTM) FROM (SELECT * FROM PLAYER P RIGHT JOIN STATS S ON PLAYER_ID = SPLAYER_ID )
  AS T , PROFILE PS , USERS WHERE PLUSER_ID = USER_ID AND USER_ID = PUSER_ID


  GROUP BY FIRST_NAME


  ORDER BY SGAME_ID, LAST_NAME,FIRST_NAME";
  // ORDER BY  P.LAST_NAME,P.FIRST_NAME, S.SGAME_ID";

  $stmt = $db->prepare($query);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result(
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


  <table class="table table-bordered table-hover view-stats">
      <thead class="thead-dark">
        <tr class="info">
          <th colspan="1">Player's Info</th>
          <th colspan="2">Total</th>
          <th colspan="8">AVG</th>

        </tr>
        <tr class="info">
          <th scope="col">PLAYER'S NAME</th>
          <th scope="col">MINUTE:SECOND</th>
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
          $player = new PlayerStatistic(
            [$first_name, $last_name],
            [$playing_time_min,$playing_time_sec],$sgame_id,
            $points,$assits,$rebounds,$three_points,$fta,$steal,$foul,$block,$ftm
              );
          echo "<td>".$player->name()."</td>\n";
          echo "<td>".$player->playingTime()."</td>\n";
          echo "<td>".$player->pointsScored()."</td>\n";
          echo "<td>".$player->assists()."</td>\n";
          echo "<td>".$player->rebounds()."</td>\n";
          echo "<td>".$player->three_points()."</td>\n";

          echo "<td>".$player->fta()."</td>\n";
          echo "<td>".$player->steal()."</td>\n";
          echo "<td>".$player->foul()."</td>\n";
          echo "<td>".$player->block()."</td>\n";
          echo "<td>".$player->ftm()."</td>\n";

        }
       ?>

  </table>
  </body>

</html>
