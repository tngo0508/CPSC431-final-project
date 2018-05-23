<?php
require_once 'config.php';
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$sql2="SELECT TEAMS.TEAM_ID FROM TEAMS WHERE TEAMS.TMANAGER_ID= (SELECT MANAGER_ID FROM MANAGER WHERE MUSER_ID = ?)";
$stmt2=$link->prepare($sql2);
$stmt2->bind_param('i',$user_id);
$stmt2->execute();
$stmt2->store_result();
$stmt2->bind_result($M_teamid);
$stmt2->fetch();
$M_teamid;
$stmt2->close();

  $sql3="SELECT
  PLAYER.PLAYER_ID ,
   FIRST_NAME,
 LAST_NAME

  FROM PLAYER, USERS, TEAMS, PROFILE

  WHERE PLAYER.PLTEAM_ID = '$M_teamid' AND PLUSER_ID = USER_ID AND USER_ID = PUSER_ID
  GROUP BY FIRST_NAME,
            LAST_NAME
  ORDER BY LAST_NAME
  ";
  $stmt3=$link->prepare($sql3);

  $stmt3->execute();
  $stmt3->store_result();
  $stmt3->bind_result(
    $PLAYERID,
    $PLAYERF,
    $PLAYERL);

    $toggle = "table-active";
    $switch_color = false;
  while ($stmt3 ->fetch()){
    if ($switch_color) {
        $toggle = "table-success";
        $switch_color = false;
      } else {
        $toggle = "table-light";
        $switch_color = true;
      }
    echo "<tr class=\"$toggle\">\n";
    echo "<th scope=\"row\">".$PLAYERID."</th>\n";
    echo "<td>".$PLAYERF."</td>\n";
    echo "<td>".$PLAYERL."</td>\n";
    // echo "<td>";
    // echo "<a href='addPlayerToGame.php?id=" . $PLAYERID . "'>ADD</a>";
    // echo "<a href='removePlayerToGame.php?id=" . $PLAYERID . "'>REMOVE</a>";
    // echo "</td>";


    echo "</tr>";

  }
?>
