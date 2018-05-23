<!DOCTYPE html>
<html>
  <head>
    <title>Standings</title>
  </head>
  <body>

    <?php
      require_once('config.php');
      // Connect to database

      /* Attempt to connect to MySQL database */
      $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

      // Check connection
      if($link === false){
          die("ERROR: Could not connect. " . mysqli_connect_error());
      }

      $query = "SELECT
              TEAMS.TEAM_NAME,
              TEAMS.WIN,
              TEAMS.LOSS

      FROM TEAMS
      ORDER BY WIN DESC";

      if ($stmt = $link->prepare($query)) {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result(
          $TN,
          $W,
          $L
        );
      }
    ?>

    <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr class="info">

          <th scope="col">TEAM NAME</th>
          <th scope="col">WIN</th>
          <th scope="col">LOSS</th>

        </tr>
      </thead>
      <?php
        // $toggle = "table-active";
        // $switch_color = false;
        while($stmt->fetch()){
          // if ($switch_color) {
          //   $toggle = "table-success";
          //   $switch_color = false;
          // } else {
          //   $toggle = "table-light";
          //   $switch_color = true;
          // }
          // echo "<tr class=\"$toggle\">\n";
          echo "<tr>\n";

          echo "<td>".$TN."</td>\n";
          echo "<td>".$W."</td>\n";
          echo "<td>".$L."</td>\n";

          echo "</tr>";

        }

        $stmt->free_result();

        $link->close();

      ?>

    </table>


  </body>
</html>
