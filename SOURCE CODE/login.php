<?php

$email = $password ="";
$id = "";
$email_err = $password_err = "";

if( empty($email) ) $email = null;
if( empty($password)  ) $password  = null;

if($_SERVER["REQUEST_METHOD"]== "POST"){
  if(empty(trim(preg_replace("/\t|\R/",' ',$_POST['email'])))){
        $email_err = 'Please enter email.';
    } else{
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if(empty(trim(preg_replace("/\t|\R/",' ',$_POST['password'])))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
  require_once 'config_for_register.php';
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


  // Check connection
  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }

// users check
if ( empty($email)){
    $email_err= 'Please enter your email here.';
}else {
    $email = $email;
}

// password check

if ( empty($password)){
    $password_err= 'Please enter your password here.';
}else {
    $password = $password;
}
// check validate credentials

if(empty($email_err) &&empty($password_err) ){

    $query= " SELECT
              USERS.USER_ID,
              USERS.EMAIL,
              USERS.PASSWORD_HASH,
              USERS.TYPE

              FROM USERS
              WHERE USERS.EMAIL = ?";
    $stmt = $link->prepare($query);
    $stmt-> bind_param("s", $email_check);
    $email_check = $email;
    if($stmt->execute()){
    $stmt->store_result();
    $stmt->bind_result($id,
                      $email,
                      $hashed_password,
                      $type);

      while($stmt->fetch()==1){


        if(password_verify($password,$hashed_password)){


                  session_start();
                  $_SESSION['email'] = $email;
                  $_SESSION['id'] = $id;
                  $_SESSION['type'] = $type;
                if($type == 'M'){
                  header("location: manager_page.php");
                  exit;
                }
                else if ($type =='A'){
                  header("location: admin_page.php");
                  exit;

                }
                else if($type =='P')
                  {
                    header("location:player_page.php");
                    exit;

                  }

                else  {
                    header("location:regular_page.php");
                    exit;
                      }

                }
                else{
                  $password_err = "\n The password Incorrect ):";
                  session_start();
                  $_SESSION['email'] = $email;
                }
              }
    }

    else
    {
      echo "something wrong with the query!!!!";
    }


}
}
?>
