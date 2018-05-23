<?php
class account
{

private $username ='';
private $password = '';



function username()
{
  if( func_num_args() == 0 )
  {
    return $this->$username;
  }

  else if( func_num_args() == 1 )
  {
    $this->$username = htmlspecialchars(trim(func_get_arg(0)));
  }

  return $this;

}
// hashing shoulb be here
function password()
{

  if( func_num_args() == 0 )
  {
    return $this->$password ;
  }

  else if( func_num_args() == 1 )
  {
    $this->$password = htmlspecialchars(trim(func_get_arg(0)));
  }

  return $this= password_hash($this);

}

function __construct($username="", $password="")
{
  // delegate setting attributes so validation logic is applied
  $this->username($username);
  $this->password($password);

}



function __toString()
{
  return (var_export($this, true));
}
// ToTSV AND FROM TSV NEED FOR FORGOT PASSWORD


}
?>
