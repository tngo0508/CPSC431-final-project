<?php
  $email ="";
  $email_err="";
 if($_SERVER["REQUEST_METHOD"] == "POST"){
   require_once 'config_for_register.php';
   $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

   // Check connection
   if($link === false){
       die("ERROR: Could not connect. " . mysqli_connect_error());
   }
   if(empty(trim($_POST["email"]))){
       $email_err = "Please enter a email.";
   } else{
       $sql = "SELECT USERS.USER_ID FROM USERS WHERE USERS.EMAIL = ?";

       $stmt=$link->prepare($sql);
       $stmt ->bind_param('s', $email_check);
       $email_check = trim( preg_replace("/\t|\R/",' ',$_POST['email']) );
       if($stmt->execute()){
           /* store result */
           $stmt->store_result();
           if($stmt->num_rows() == 0){
               $email_err = "Your email is wrong( not in the database)";
           } else{
               $email = trim( preg_replace("/\t|\R/",' ',$_POST['email']) );
               try {
                 require_once 'random_password.php';
                 $password = reset_password($email);
                 require_once 'notification.php';
                 notify_password($email, $password);
                 header('location: welcome.php');
               }
               catch (Exception $e) {
                 echo 'Your password could not be reset - please try again later.';
               }
           }
       } else{
           echo "Please try again later.";
       }
       $stmt->close();

   }



  }

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="css/forgot_pass.css">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine:bold,bolditalic|Inconsolata:italic|Droid+Sans|Oxygen|Passion+One|Alfa+Slab+One|Monoton|Ubuntu">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple|3d-float|fire-animation">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">


  </head>


  <?php require 'header.php' ?>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">TEAM MANAGEMENT</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="welcome.php">Login<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="rules.php">Rules</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact</a>
          </li>

        </ul>
      </div>
    </nav>

    <section>
      <div class="container">
        <div class="row align-items-center">
          <div class="col">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
              <h2>Forgot Password</h2>

              <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>EMAIL:<sup>*</sup></label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="example@email.com">
                <span class="help-block"><?php echo $email_err; ?></span>
              </div>


                <div class="form-group">
                  <input id="submit" type="submit" class="btn btn-primary" value="Submit">
                  <input id="reset" type="reset" class="btn btn-default" value="Reset">
                </div>
            </form>
          </div>
        </div>
    </div>





      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>

<?php require 'footer.php' ?>
  </html>
