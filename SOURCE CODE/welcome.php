<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Welcome page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/welcome.css">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine:bold,bolditalic|Inconsolata:italic|Droid+Sans|Oxygen|Passion+One|Alfa+Slab+One|Monoton|Ubuntu">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple|3d-float|fire-animation">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">



</head>

<body>
  <?php
    require 'header.php';
  ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="index.html">TEAM MANAGEMENT</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="welcome.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
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
        <?php require_once('login.php') ?>
        <div class="row align-items-center">
          <div class="col">
            <form class="form-login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <h2 class="form-login-header">Account Login</h2>
              <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email:<sup>*</sup></label>

                <input type="text" name="email" class="form-control" placeholder="example@email.com" autofocus required>
                <span class="help-block"><?php echo $email_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="password" class="form-control" placeholder="password" required>
                <span class="help-block"><?php echo $password_err; ?></span>
              </div>

              <div class="form-group">
                <button id="submit-button" type="submit" class="btn btn-primary" value="Submit">Submit</button>
                <button type="reset" class="btn btn-primary" name="button">Reset</button>
              </div>
              <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
              <a href="forget_passform.php">Forgot password?</a>
            </form>
          </div>
        </div>

      </div>

    </section>



      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>


<?php
require 'footer.php';
?>


</html>
