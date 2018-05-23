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

  $query = "SELECT PLAYER_ID, FIRST_NAME, LAST_NAME, SGAME_ID, PLAYINGTIMEMIN, PLAYINGTIMESEC, POINTS, ASSISTS, REBOUNDS, THREE_POINTS, FTA, STEAL, FOUL, BLOCK, FTM FROM (SELECT * FROM PLAYER P RIGHT JOIN STATS S ON PLAYER_ID = SPLAYER_ID )
  AS T , PROFILE PS , USERS WHERE PLUSER_ID = USER_ID AND USER_ID = PUSER_ID ORDER BY SGAME_ID, LAST_NAME,FIRST_NAME";
  // ORDER BY  P.LAST_NAME,P.FIRST_NAME, S.SGAME_ID";

  $stmt = $db->prepare($query);
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


  <table class="table table-bordered table-hover view-stats">
      <thead class="thead-dark">
        <tr class="info">
          <th scope="col">GAMEID</th>
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
          echo "<td>".$player->gameid()."</td>\n";
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



  <form action="processStatisticUpdate.php" method="post">

  <td style="vertical-align:top; border:1px solid black;">
          <!-- FORM to enter game statistics for a particular player -->
            <table style="margin: 0px auto; border: 0px; border-collapse:separate;">
              <tr>
                <td style="text-align: right; background: lightblue;">Name (Last, First)</td>
                <td>
                <select name="name_ID" required>
                  <option value="" selected disabled hidden>Choose player's name here</option>
                  <?php
                  $query1 = "SELECT
                              PLAYER_ID,
                              FIRST_NAME,
                              LAST_NAME
                              FROM PLAYER , USERS, PROFILE
                              WHERE PLUSER_ID = USER_ID AND USER_ID = PUSER_ID 
                              GROUP BY PLAYER_ID
                            ORDER BY  LAST_NAME,FIRST_NAME";

                  $stmt1 = $db->prepare($query1);
                  $stmt1->execute();
                  $stmt1->store_result();
                  $stmt1->bind_result(
                    $player_id,
                    $first_name,
                    $last_name
                  );
                    $stmt->data_seek(0);
                     while( $stmt1->fetch())
                     {
                       $player = new PlayerStatistic([$first_name, $last_name]);
                       echo "<option value=\"$player_id\">".$player->name()."</option>\n";

                     }
                     ?>
                  </select>

               </td>


               <td style="text-align: right; background: lightblue;">GAMEID</td>
               <td>
               <select name="GAMEID" required>

                 <option value="" selected disabled hidden>Choose GAME ID  here</option>
                 <?php
                 // $query2 = "SELECT
                 //             G.GAME_ID
                 //
                 //             FROM GAMES G
                 //
                 //           ORDER BY  G.GAME_ID";
                 $query2 = "SELECT DISTINCT GAME_ID FROM STATS LEFT JOIN GAMES ON GAME_ID = SGAME_ID WHERE GAME_ID IS NOT NULL";

                 $stmt2 = $db->prepare($query2);
                 $stmt2->execute();
                 $stmt2->store_result();
                 $stmt2->bind_result(
                  $game_id
                 );
                   $stmt2->data_seek(0);
                    while( $stmt2->fetch())
                    {
                      echo "<option value=\"$game_id\">".$game_id."</option>\n";

                    }
                    ?>
                 </select>

              </td>






               <tr>
                 <td style="text-align: right; background: lightblue;">Playing Time (min:sec)</td>
                <td><input type="text" name="time" value="" size="5" maxlength="5"/></td>
               </tr>

               <tr>
                 <td style="text-align: right; background: lightblue;">Points Scored</td>
                <td><input type="text" name="points" value="" size="3" maxlength="3"/></td>
               </tr>

               <tr>
                 <td style="text-align: right; background: lightblue;">Assist</td>
                 <td><input type="text" name="assists" value="" size="2" maxlength="2"/></td>
               </tr>
               <tr>
                 <td style="text-align: right; background: lightblue;">FTA</td>
                 <td><input type="text" name="FTA" value="" size="2" maxlength="2"/></td>
               </tr>
                 <tr>
                   <td style="text-align: right; background: lightblue;">Rebounds</td>
                   <td><input type="text" name="rebounds" value="" size="2" maxlength="2"/></td>
                 </tr>
                 <tr>
                   <td style="text-align: right; background: lightblue;">Steal</td>
                   <td><input type="text" name="steal" value="" size="2" maxlength="2"/></td>
                 </tr>
               <tr>
                 <td style="text-align: right; background: lightblue;">Three_points</td>
                 <td><input type="text" name="three_points" value="" size="2" maxlength="2"/></td>
               </tr>
               <tr>
                 <td style="text-align: right; background: lightblue;">Block</td>
                 <td><input type="text" name="block" value="" size="2" maxlength="2"/></td>
               </tr>
               <tr>
                 <td style="text-align: right; background: lightblue;">Foul</td>
                 <td><input type="text" name="foul" value="" size="2" maxlength="2"/></td>
               </tr>
               <tr>
                 <td style="text-align: right; background: lightblue;">FTM</td>
                 <td><input type="text" name="ftm" value="" size="2" maxlength="2"/></td>
               </tr>
               <tr>
                <td colspan="2" style="text-align: center;"><input type="submit" value="Update Stats" /></td>
               </tr>
             </table>
           </form>
         </td>
       </tr>
     </table>

  </body>

</html>
