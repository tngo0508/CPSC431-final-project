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
  <title>Regular User Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Russo+One|Tangerine:bold,bolditalic|Inconsolata:italic|Droid+Sans|Oxygen|Passion+One|Alfa+Slab+One|Monoton|Ubuntu">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple|3d-float|fire-animation|fire|neon">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

  <link rel="stylesheet" href="css/regularpage.css">
</head>

<body>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="navbar-brand" href="regular_page.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="teams-tab" data-toggle="tab" href="#teams" role="tab" aria-controls="teams" aria-selected="false">Standings</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab" aria-controls="schedule" aria-selected="false">All Games</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="upcome-tab" data-toggle="tab" href="#upcome" role="tab" aria-controls="upcome" aria-selected="false">Upcoming Games</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="view-tab" data-toggle="tab" href="#view" role="tab" aria-controls="view" aria-selected="false">Player's Stats</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <?php echo $_SESSION['email']; ?>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="edit-profile.php">Profile</a>
        <a class="dropdown-item" href="contact.php">Contact</a>

        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="user_changepass.php">change password</a>

        <a class="dropdown-item" href="logout.php">Log out</a>

      </div>
    </li>
  </ul>


  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade" id="teams" role="tabpanel" aria-labelledby="teams-tab">
      <h1>STANDINGS</h1>
      <div class="container">
        <?php require ('user_view_teams.php'); ?>
      </div>
    </div>
    <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
      <h1>ALL GAMES</h1>
      <div class="container">
        <?php require ('schedule_game.php'); ?>
      </div>
    </div>
    <div class="tab-pane fade" id="upcome" role="tabpanel" aria-labelledby="upcoming-tab">
    <h1 >UPCOMING GAMES</h1>
    <div class="container">
      <?php require 'User_viewupcominggame.php'; ?>
    </div>
  </div>

  <div class="tab-pane fade" id="view" role="tabpanel" aria-labelledby="view-tab">
  <h1 >PLAYER'S STATS</h1>
  <div class="container">
    <?php require 'User_viewStats.php'; ?>
  </div>
</div>


<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="container">
        <?php require ('schedule_game.php'); ?>
      </div>

    </div>
    <div class="carousel-item">
      <div class="container">
      <?php require 'User_viewupcominggame.php'; ?>
      </div>
    </div>
    <div class="carousel-item">
      <div class="container">
    <?php require 'User_viewStats.php'; ?>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>











  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>


  <?php
  require "footer.php";
  ?>
