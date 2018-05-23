<?php
  require "header.php";
  require 'Address.php';

  session_start();
     // if (!isset($_SESSION['PROFILE_ID']) || empty($_SESSION['PROFILE_ID'])) {
     //     header("location: welcome.php");
     //     exit;
     // }
     $user_id = $_SESSION['id'];
     require_once 'config.php';
     $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

     // Check connection
     if ($link === false) {
         die("ERROR: Could not connect. " . mysqli_connect_error());
     }
     $sql = "SELECT
              PROFILE.PROFILE_ID,
               PROFILE.FIRST_NAME,
               PROFILE.LAST_NAME,
               PROFILE.STREET,
               PROFILE.CITY,
               PROFILE.STATE,
               PROFILE.COUNTRY,
               PROFILE.ZIPCODE
              FROM PROFILE
              WHERE PROFILE.PUSER_ID=?
               ";

               $stmt=$link->prepare($sql);
               $stmt->bind_param("s",$user_id);


              if ($stmt->execute()){

                $stmt->store_result();
                $stmt->bind_result(
          $profile_id,
          $firstname,
          $lastname,
          $street ,
          $city,
          $state,
          $country,
          $zip);
$stmt->fetch();

$_SESSION['profile-id'] = $profile_id;

}

?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>EDIT PROFILE</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine:bold,bolditalic|Inconsolata:italic|Droid+Sans|Oxygen|Passion+One|Alfa+Slab+One|Monoton|Ubuntu">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rancho|Orbitron&effect=shadow-multiple|3d-float|fire-animation|neon">
    <link rel="stylesheet" href="css/editProfile.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
  </head>


  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#top">TEAM MANAGEMENT</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <!-- <li class="nav-item active">
              <a class="nav-link" href="welcome.php">Welcome <span class="sr-only">(current)</span></a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="home.php">Home</a>
            </li>
          <li class="nav-item">
            <a class="nav-link" href="rules.php">Rule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <?php echo $_SESSION['email']; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="logout.php">Sign out</a>
            </div>
          </li>
        </ul>

      </div>
    </nav>

<section>
  <div class="container">

    <form action="edit_infor_byuser.php" method="post">
<div class="form-row">
  </div>




<div class="form-group">
  <label for="inputAddress">Address</label>
  <input type="text"  value="<?php $street ?>" name="street"class="form-control" id="inputAddress" placeholder="<?php echo "$street"; ?>">
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="inputCity">First Name</label>
    <input type="text" class="form-control" value="<?php echo "$firstname" ?>" name="firstname" id="inputCity">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Last Name</label>
      <input type="text" class="form-control" value="<?php echo "$lastname" ?>" name="lastname" id="inputCity">
    </div>


<div class="form-row">
  <div class="form-group col-md-6">
    <label for="inputCity">City</label>
    <input type="text" class="form-control" value="<?php echo "$city" ?>" name="city" id="inputCity">
  </div>

  <div class="form-group col-md-6">
    <label for="inputState">Country</label>
    <input value="<?php echo "$country" ?>" name="country" id="inputState" class="form-control">
  </div>

  <div class="form-group col-md-6">
    <label for="inputState">State</label>
    <input value="<?php echo "$state" ?>" name="state" id="inputState" class="form-control">
  </div>
  <div class="form-group col-md-6">
    <label for="inputZip">Zip</label>
    <input value="<?php echo "$zip" ?>" name="zip" id="inputState" class="form-control">  </div>
</div>


<button type="submit" class="btn btn-primary">Update Profile</button>
</form>
</div>

</section>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

  <?php
  require "footer.php";
  ?>
