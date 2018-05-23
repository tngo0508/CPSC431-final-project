<?php
  require_once 'config.php';
  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if ($db === false) {
    die("ERROR: COULD NOT CONNECT".mysqli_connect_error());
  }

  // $query = "SELECT MANAGER_ID, EMAIL FROM MANAGER, USERS WHERE TYPE = 'M' AND MUSER_ID = USER_ID";
  $query = "SELECT MANAGER_ID, EMAIL FROM USERS, (SELECT MANAGER_ID, MUSER_ID
    FROM MANAGER LEFT JOIN TEAMS
    ON MANAGER_ID = TMANAGER_ID WHERE TMANAGER_ID IS NULL) AS M
    WHERE MUSER_ID = USER_ID";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result(
    $manager_id,
    $email
  );
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>MANAGER TABLE</title>
   </head>
   <body>
     <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr class="info">
          <th scope="col">MANAGER ID</th>
          <th scope="col">EMAIL</th>
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
          echo "<th scope=\"row\">".$manager_id."</th>\n";
          echo "<td>".$email."</td>\n";
      }

      $stmt->free_result();
      $db->close();
       ?>
    </table>

   </body>
 </html>
