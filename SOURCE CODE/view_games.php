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
  <title>League Schedule & Games</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="css/regular_page.css"> -->
</head>

<body>
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
        <li class="nav-item active">
          <a class="nav-link" href="view_games.php">Schedule</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view_standings.php">Standings</a>
        </li>
        <li class="nav-item">
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

  <section id="body">
      <div class="container">
        <h1>Upcoming Games</h1>
        <?php
          require_once('config.php');
          // Connect to database

          /* Attempt to connect to MySQL database */
          $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

          // Check connection
          if($link === false){
              die("ERROR: Could not connect. " . mysqli_connect_error());
          }

          $query = "SELECT G.GAME_ID, G.START_DAY, G.END_DAY, T.TEAM_NAME
          FROM PLAY P, GAMES G, TEAMS T
          WHERE T.TEAM_ID = P.PTEAM_ID AND G.GAME_ID = P.PGAME_ID
          ORDER BY GAME_ID;";

          if ($stmt = $link->prepare($query)) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result(
              $GID,
              $STD,
              $ETD,
              $TN
            );
          }
        ?>

        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr class="info">
              <th scope="col">GAME</th>
              <th scope="col">START TIME</th>
              <th scope="col">END TIME</th>

              <th scope="col">HOME TEAM</th>

              <th scope="col">AWAY TEAM</th>

            </tr>
          </thead>
          <?php

            while($stmt->fetch()){

              echo "<tr>\n";
              echo "<th scope=\"row\">".$GID."</th>\n";
              echo "<td>".$STD."</td>\n";
              echo "<td>".$ETD."</td>\n";

              echo "<td>".$TN."</td>\n";

              $stmt->fetch();
              echo "<td>".$TN."</td>\n";
              echo "</tr>";

            }

            $stmt->free_result();

            $link->close();

          ?>

        </table>

      </body>

      </div>
  </section>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>


  <?php
  require "footer.php";
  ?>
