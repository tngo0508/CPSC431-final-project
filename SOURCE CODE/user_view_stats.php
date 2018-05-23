<?php
     require "header.php";
     session_start();
     if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
       header("location: welcome.php");
       exit;
     }
     if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
       header("location: welcome.php");
       exit;
     }
?>
<head>
  <meta charset="utf-8">
  <title>View Stats</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="css/regular_page.css"> -->
</head>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="#">MENU</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">

          <a class="nav-link" href="regular_page.php">Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view_games.php">Schedule</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view_standings.php">Standings</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="user_view_stats.php">Stats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view_teams.php">Teams</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rules.php">Rules</a>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.html">Contact</a>
        </li>

        <li id="info"class="nav-item active">
        <a class="nav-link"    <b><?php
          echo "Hi, " .$_SESSION['email'];
           ?></b>.

        </a>
        </li>

        <li id="Profile"class="nav-item active">
          <a class="nav-link" href="update_profile.php">PROFILE</a>

        </li>
        <li id="logout"class="nav-item active">
          <a class="nav-link" href="logout.php">SIGN OUT</a>
        </li>
      </ul>
    </div>
  </nav>

  <body>
    <?php
  require_once('./config.php');

  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if ($db === false) {
    die("ERROR: COULD NOT CONNECT. ".mysqli_connect_error());
  }

  $user_id = $_SESSION['id'];
  $query = "SELECT
  P.PLAYER_ID, P.FIRST_NAME, P.LAST_NAME, SGAME_ID, PLAYINGTIMEMIN, PLAYINGTIMESEC, POINTS, ASSISTS, REBOUNDS, THREE_POINTS, FTM, FTA, STEAL, FOUL, BLOCK
  FROM PLAYER P, STATS S
  WHERE P.PLAYER_ID = SPLAYER_ID
  AND PLTEAM_ID = (SELECT TEAM_ID FROM TEAMS WHERE TMANAGER_ID= (SELECT MANAGER_ID FROM MANAGER WHERE MUSER_ID = ?)) ORDER BY SGAME_ID";

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
    $ftm,
    $fta,
    $steal,
    $foul,
    $block
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
          <th scope="col">FTM</th>
          <th scope="col">FTA</th>
          <th scope="col">STEAL</th>
          <th scope="col">FOUL</th>
          <th scope="col">BLOCK</th>
        </tr>
      </thead>

      <?php
      // $toggle = "table-active";
      // $switch_color = false;

        while ($stmt->fetch()) {
          // if ($switch_color) {
          //   $toggle = "table-success";
          //   $switch_color = false;
          // } else {
          //   $toggle = "table-light";
          //   $switch_color = true;
          // }
          // echo "<tr class=\"$toggle\">\n";
          echo "<tr>\n";
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
          echo "<td>".$ftm."</td>\n";
          echo "<td>".$fta."</td>\n";
          echo "<td>".$steal."</td>\n";
          echo "<td>".$foul."</td>\n";
          echo "<td>".$block."</td>\n";
        }

        $stmt->free_result();

        $db->close();
       ?>

  </table>

  </body>
</html>
