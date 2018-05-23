<?php
session_start();
  $email =$_SESSION['email'];
  $NEWPASS="";
    $oldpassword="";
   $oldpassword_err="";
   $password_err="";
  $confirm_password_err="";
 if($_SERVER["REQUEST_METHOD"] == "POST"){
   require_once 'config_for_register.php';
   $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

   // Check connection
   if($link === false){
       die("ERROR: Could not connect. " . mysqli_connect_error());
   }
if (!empty($_POST['oldpassword'])){

    $oldpassword = trim( preg_replace("/\t|\R/",' ',$_POST['oldpassword']) );
    $query= " SELECT USERS.PASSWORD_HASH


              FROM USERS
              WHERE USERS.EMAIL = ?";
    $stmt1 = $link->prepare($query);
    $stmt1-> bind_param("s", $email);
    $email_check = $email;
    if($stmt1->execute()){
    $stmt1->store_result();
    $stmt1->bind_result($hashed_password);

      while($stmt1->fetch()==1){


        if(password_verify($oldpassword,$hashed_password)){
             $NEWPASS= trim( preg_replace("/\t|\R/",' ',$_POST['newpass']) );
             echo $NEWPASS;
               $sql = "UPDATE USERS SET USERS.PASSWORD_HASH =? WHERE USERS.EMAIL = '$email' ";

               $stmt=$link->prepare($sql);
               $NEWPASS=PASSWORD_HASH($NEWPASS,PASSWORD_DEFAULT);
               $stmt->bind_param('s', $NEWPASS);
               echo $NEWPASS;
               if($stmt->execute()){
                    header('location: welcome.php');
                    exit;
               } else{
                   echo "Please try again later.";

               $stmt->close();

           }

        }
        else {
          $oldpassword_err=" Your old password doesnt match with our record";

        }



}

}

}else {
     $oldpassword_err = " Please input something";
}


}
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="css/user_changepass.css">
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <h2>CHANGING PASSWORD </h2>

                            <div class="form-group <?php echo (!empty($oldpassword_err)) ? 'has-error' : ''; ?>">
                              <label>Old Password:<sup>*</sup></label>
                              <input type="password" name="oldpassword" class="form-control"  placeholder="old password" required>
                              <span class="help-block"><?php echo $oldpassword_err; ?></span>
                            </div>
              <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>New Password:<sup>*</sup></label>
                <input type="password" name="newpass" class="form-control"  placeholder="New password" required>
                <span class="help-block"><?php echo $password_err; ?></span>
              </div>

              <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm New Password:<sup>*</sup></label>
                <input type="password" name="confirm_password" class="form-control" " placeholder="confirmed password" required>
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
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>

<?php require 'footer.php' ?>
  </html>
