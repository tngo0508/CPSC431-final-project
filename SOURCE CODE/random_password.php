<?php

function reset_password($email) {


  $new_password="";
  $rand_number ="";
  require_once 'random_word.php';
  $new_password = get_random_word(6, 13);


  if($new_password == false) {
    // give a default password
    $new_password = "changeMe!";
  }

  // add a number between 0 and 999 to it
  // to make it a slightly better password
  $rand_number = rand(0, 999);
  $new_passwordhash = $new_password . $rand_number;
  $realpassword=   $new_passwordhash;

  if(!empty($new_passwordhash))  // Verify required fields are present
  {
    require_once( 'config_for_register.php' );
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }



    $sql ="UPDATE USERS

           SET   USERS.PASSWORD_HASH= ?

           WHERE

           USERS.EMAIL='$email' ";
    if($stmt = $link->prepare($sql)){
      $new_passwordhash= password_hash($new_passwordhash, PASSWORD_DEFAULT);
       $stmt->bind_param('s',$new_passwordhash);

    $stmt->execute();

           }
   }


return $realpassword;
}

?>
