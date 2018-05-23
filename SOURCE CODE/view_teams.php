

<?php
      require_once('config.php');
      // Connect to database

      /* Attempt to connect to MySQL database */
      $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

      // Check connection
      if($link === false){
          die("ERROR: Could not connect. " . mysqli_connect_error());
      }

      $query ="SELECT
             TEAMS.TEAM_ID,
             TEAMS.TEAM_NAME,
             TEAMS.TMANAGER_ID


             FROM TEAMS
             ORDER BY TEAMS.TEAM_ID";

    $stmt = $link->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result(
    $TID,
    $TN,
    $TNM



  );


  while($stmt->fetch()){

    echo "<tr>\n";
    echo "<td>".$TID."</td>\n";
    echo "<td>".$TN."</td>\n";
    echo "<td>".$TNM."</td>\n";
    echo "<td><input type='checkbox' name='TEAMID[]' value='$TID' /></td>\n";


  }


  $stmt->free_result();

  $link->close();


?>
