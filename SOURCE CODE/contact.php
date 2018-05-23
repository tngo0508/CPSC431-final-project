<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="FOR WEBSITE CSUF BASKETBALL TEAM">
  <meta name="keywords" content="web design">
  <meta name="author" content="TEAM CPSC431">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine:bold,bolditalic|Inconsolata:italic|Droid+Sans|Oxygen|Passion+One|Alfa+Slab+One|Monoton|Ubuntu">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple|3d-float|fire-animation">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">


  <title>Contact Info</title>
  <link rel="stylesheet" href="css/contact.css">
</head>

<?php require "header.php"; ?>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">TEAM MANAGEMENT</a>
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
  <div class="jumbotron jumbotron-sm">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-lg-12">
          <h1 class="h1">Contact Us</h1>
          <p>we really appreciate your feedback. Feel free to give us any suggestions followed by one of the subjects below</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="well well-sm">
          <form action="feedback.php" method="post">
            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                  <label for="name">
                                Name</label>
                  <input type="text" name="cname" class="form-control" id="name" placeholder="Enter name" required="required" />
                </div>
                <div class="form-group">
                  <label for="email">
                                Email Address</label>
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                    </span>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required="required" /></div>
                </div>
                <div class="form-group">
                  <label for="subject">
                                Subject</label>
                  <select id="subject" name="subject" class="form-control" required="required">
                                <option value="na" selected="">Choose One:</option>
                                <option value="service">General Customer Service</option>
                                <option value="suggestions">Suggestions</option>
                                <option value="product">Product Support</option>
                                <option value="Promote to be Admin">Promote to be ADMIN</option>
                                <option value="Promote to be Manager">Promote to be Manager</option>

                            </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">
                                Message</label>
                  <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required" placeholder="Message"></textarea>
                </div>
              </div>
              <div class="col-md-12">
                <input value="Send Message" type="submit" class="btn btn-primary pull-right" id="btnContactUs"> 
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-4">
        <form>
          <legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
          <address>
                <strong>Basketball Team Management, Inc.</strong><br>
                800 N State College Blvd<br>
                Fullerton, CA 94107<br>
                <span title="Phone">
                    Phone:</span>
                (123) 456-7890
            </address>
          <address>
                <strong>Contact email</strong><br>
                <a href="mailto:#">servicebasketballmanagement@gmail.com</a>
            </address>
        </form>
      </div>
    </div>
  </div>






  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZ"></script>



</body>

<?php require "footer.php"; ?>



</html>
