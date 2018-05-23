<?php
session_start();
// Include config file
require_once 'config_for_register.php';
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Define variables and initialize with empty values
$email ="";
$password ="";
$confirm_password="";

$email_err = $password_err = $confirm_password_err = $type_err ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){

  // checking email if valid or not

  if(empty(trim($_POST["email"]))){
      $email_err = "Please enter a email.";
  } else{
      // Prepare a select statement
      $sql = "SELECT USERS.USER_ID FROM USERS WHERE USERS.EMAIL = ?";

      $stmt=$link->prepare($sql);
      $stmt ->bind_param('s', $email_check);
      $email_check = trim( preg_replace("/\t|\R/",' ',$_POST['email']) );
      if($stmt->execute()){
          /* store result */
          $stmt->store_result();
          if($stmt->num_rows() == 1){
              $email_err = "This name already taken.";
          } else{
              $email = trim( preg_replace("/\t|\R/",' ',$_POST['email']) );
          }
      } else{
          echo "Please try again later.";
      }
      $stmt->close();

  }

  // checking password
  if(empty(trim($_POST['password']))){
      $password_err = "Please enter a password.";
  } elseif(strlen(trim($_POST['password'])) < 6){
      $password_err = "Password must have atleast 6 characters.";
  } else{
    $password = trim( preg_replace("/\t|\R/",' ',$_POST['password']) );
  }

  // Validate confirm password
  $password = trim( preg_replace("/\t|\R/",' ',$_POST['password']) );
  $confirm_password=trim( preg_replace("/\t|\R/",' ',$_POST['confirm_password']) );

  if(empty(trim($_POST["confirm_password"]))){
      $confirm_password_err = 'Please confirm password.';
  } else{
      $confirm_password = trim($_POST['confirm_password']);
      if($password != $confirm_password){
          $confirm_password_err = 'Password did not match.';
      }
  }

    // Check input errors before inserting in database
if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO USERS SET
                  USERS.EMAIL = ?,
                  USERS.PASSWORD_HASH= ?
                  ";

        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt=$link->prepare($sql);
        $stmt->bind_param('ss',
        $email,
        $password
      );
        // Attempt to execute the prepared statement
      if($stmt->execute()){
        $stmt->free_result();
        $query = "SELECT USER_ID FROM USERS WHERE EMAIL = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param('s', $email_check);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($puser_id);
        $stmt->fetch();
        $stmt->free_result();
        $query = "INSERT INTO PROFILE (PUSER_ID) VALUES (?)";
        $stmt=$link->prepare($query);
        $stmt->bind_param('i', $puser_id);
        $stmt->execute();

          require_once 'notification.php';
          $npassword = "";
          notify_password($email, $npassword);
          header("location: welcome.php");
          exit;
      }
      else{
          echo "Something went wrong. Please try again later.";
          }
          $stmt->close();

      }



    // Close connection
    $link->close();
}
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine:bold,bolditalic|Inconsolata:italic|Droid+Sans|Oxygen|Passion+One|Alfa+Slab+One|Monoton|Ubuntu">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple|3d-float|fire-animation">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <link rel="stylesheet" href="css/register.css">
  </head>

  <body>
    <?php
    require 'header.php';
  ?>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">TEAM MANAGEMENT</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="welcome.php">Login<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="rules.php">Rule</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>

          </ul>
        </div>
      </nav>
      <section>

      <div class="container">
        <div class="row align-items-center">
          <div class="col">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <h2>Sign Up As </h2>

              <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>EMAIL:<sup>*</sup></label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="example@mail.com" autofocus required>
                <span class="help-block"><?php echo $email_err; ?></span>
              </div>
              <div>


              </div>
              <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="password" required>
                <span class="help-block"><?php echo $password_err; ?></span>
              </div>

              <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password:<sup>*</sup></label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" placeholder="confirmed password" required>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
              </div>


              <div class="form-group">
                <input id="submit" type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
              </div>
              <p>Already have an account? <a href="welcome.php">Login here</a>.</p>
            </form>
          </div>

        </div>
      </div>

    </section>


      <?php
    require 'footer.php';
  ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

  </html>
