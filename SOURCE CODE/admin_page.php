<?php
     require "header.php";

     session_start();
     if ($_SESSION['type'] !== 'A') {
       $_SESSION = array();
       session_destroy();
       header("location: welcome.php");
       exit;
     }

     if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
       header("location: welcome.php");
       exit;
     }
     if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
       header("location: welcome.php");
       exit;
     }
     require_once 'config.php';
     require_once 'Address.php';
     $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

     // Check connection
     if($link === false){
         die("ERROR: Could not connect. " . mysqli_connect_error());
     }
     $type = $type_err ="";


      $sql = "
      SELECT USER_ID, EMAIL
      FROM USERS
      GROUP BY EMAIL
      ORDER BY EMAIL
      ";
      $stmt = $link->prepare($sql);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result(
        $user_id,
        $email
      );



?>

  <head>
    <meta charset="utf-8">
    <title>Manager Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine:bold,bolditalic|Inconsolata:italic|Droid+Sans|Oxygen|Passion+One|Alfa+Slab+One|Monoton|Ubuntu">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple|3d-float|fire-animation|fire|neon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <link rel="stylesheet" href="css/admin.css">
  </head>

  <body>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab" aria-controls="schedule" aria-selected="false">Schedule Game</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="team-tab" data-toggle="tab" href="#team" role="tab" aria-controls="team" aria-selected="false">Team</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="view-tab" data-toggle="tab" href="#view" role="tab" aria-controls="view" aria-selected="false">Stats</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['email']; ?>
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="edit-profile.php">Profile</a>
          <a class="dropdown-item" href="admin_page.php">Refresh</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="user_changepass.php">change password</a>

          <a class="dropdown-item" href="logout.php">Log out</a>
        </div>
      </li>
    </ul>

    <!-- home tab -->
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <h1 id="promote-user">PROMOTE</h1>
        <div class="container">
          <table class="table table-bordered table-hover">
            <thead class="thead-dark">
              <tr class="info">
                <th scope="col">TITLE</th>
                <th scope="col">SENDER NAME</th>
                <th scope="col">DATE SENT</th>
                <th scope="col">MESSAGE</th>

              </tr>
            </thead>
            <?php require_once ('admin_mailboxs.php') ?>

          </table>

          <form action="promote_update.php" method="post">
            <div>
              <select name="user_id" required>
                <option value="" selected disabled hidden>Choose user's acount order by email</option>
              <?php

                $stmt->data_seek(0);
                while( $stmt->fetch() )
                {
                  echo "<option value=\"$user_id\">".$email."</option>\n";
                }

                $stmt->free_result();
                $link->close();
                // header("location: admin_page.php");
              ?>

              </select>
              <select name="type">
                <option value="" selected disabled hidden>Their New Position</option>
                <option value="M">MANAGER</option>
                <option value="A">ADMIN</option>
                <option value="P">PLAYER</option>
              </select>
              <input type="submit" class="btn btn-primary" value="Promote Now">
              <input type="reset" class="btn btn-default" value="Reset">
            </div>
          </form>

        </div>

        <a name="form-create-game"></a>

        <h1 id="create-assign"> CREATING GAME </h1>
        <div class="container">
          <?php require 'create_game.php'; ?>
          <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"].'#form-create-game'); ?>" method="post">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">Start Day</div>
              </div>
              <input type="date" name="startday" class="form-control" value="" placeholder="mm/dd/yyyy" required>
            </div>

            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">End Day</div>
              </div>
              <input type="date" name="endday" class="form-control" value="" placeholder="mm/dd/yyyy" required>
            </div>

            <div class="form-check">
              <input type="submit" class="btn btn-primary" value="Create">
              <input type="reset" class="btn btn-default" value="Reset">
            </div>
          </form>

        </div>

        <a name="form-assigning-game"></a>
        <h1 id="assign-team">GAMES AVALIBALE FOR ASSIGNING </h1>
        <div class="container">
          <?php require_once ('assign_game.php'); ?>
        </div>

      </div>


      <!-- schedule tab -->
      <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
        <h1 id="schedule-games">SCHEDULE ALL GAMES</h1>
        <div class="container">
          <?php require ('schedule_game.php'); ?>
          <?php require ('editing_scores.php'); ?>

        </div>


      </div>
      <div class="tab-pane fade" id="team" role="tabpanel" aria-labelledby="team-tab">
        <h1>CREATE TEAM</h1>
        <div class="container">
          <?php require 'team_manager_table.php'; ?>
          <div class="container">
        <?php require_once ('create_team.php'); ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="form-group row">
          <label for="TMANAGER_ID" class="col-sm-2 col-form-label">Team Manager ID</label>
            <div class="col-sm-10">
              <input type="number" min="1" class="form-control" name="TMANAGER_ID" placeholder="Manager ID">
            </div>
          </div>
          <div class="form-group row">
            <label for="TEAM_NAME" class="col-sm-2 col-form-label">Team Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="TEAM_NAME" placeholder="Team Name">
            </div>
          </div>
          <div class="form-group row">
            <input type="submit" class="btn btn-primary" value="Create">
            <input type="reset" class="btn btn-default" value="Reset">
          </div>
        </form>
      </div>


        </div>
      </div>
      <div class="tab-pane fade" id="view" role="tabpanel" aria-labelledby="view-tab">
        <h1>Viewing Players Stats</h1>
        <div class="container">
          <?php require 'admin_ViewStats.php'; ?>
        </div>
      </div>




    </div>










    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

  <?php
  require "footer.php";
  ?>
